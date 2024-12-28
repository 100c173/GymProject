<?php

namespace App\Services;


use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SubscriptionService
{
    /**
     * @param Request 
     *  @return LengthAwarePaginator
     */

     public function moveFinishedSubscriptionsToTrash()
     {
          Subscription::where('status', 'finished')->update(['deleted_at' => Carbon::now()]);
     }
     public function getTrashedSubscriptions($entries_number)
    {
        return Subscription::onlyTrashed()
            ->with(['user', 'plan'])
            ->paginate($entries_number);
    }
    public function forceDeleteSubscription(int $id): bool
    {
        $subscription = Subscription::withTrashed()->findOrFail($id);

        return $subscription->forceDelete();
    }
    public function delete(Subscription $subscription)
    {
        return $subscription->delete();
    }
    public function search(Request $request)
    {
        //Specify the number of entries to display
        $entries_number = $request->input('entries_number', 10);
        $search = $request->search;


        //Update the status of subscriptions that have expired

        Subscription::where('end', '<', Carbon::now())
            ->where('status', '!=', 'finished')
            ->update(['status' => 'finished']);

        $subscriptions = Subscription::query();
        
        //Search by subscriber name

        if ($search) {
            $subscriptions->whereHas('user', function ($query) use ($search) {
                $query->SearchFullName($search);
            });
        }

        //Search by plan name
        if ($search) {
            $subscriptions->orWhereHas('plan', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        }

        //Sort by date or plan name
        if ($request->filled('sort_by') && $request->input('sort_by') !== '') {

            $subscriptions->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
                ->orderBy('start', 'desc')->orderBy('name', 'asc');
        }

        if ($request->filled('status')) {
            $subscriptions->where('status', $request->input('status'));
        }
        
        return $subscriptions->paginate($entries_number);
    }
}
