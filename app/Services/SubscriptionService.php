<?php

namespace App\Services;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Plan;
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

    /**
     * Display a listing of the resource.
     */
    public function showAllMySubscriptions()
    {
        $subscriptions = Subscription::where('user_id', auth()->id())->get();
        return $subscriptions ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createNewSupscription(SubscriptionRequest $request)
    {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->start)->format('Y-m-d');
        $plan = Plan::where('id', $request->plan_id)->first();
        $end = Carbon::parse($startDate)->addDays($plan->period);

        $subscription = Subscription::create([
            'user_id' => auth()->id(),
            'plan_id' => $request->plan_id,
            'start'   => $startDate,
            'end' => $end,
        ]);

        return $subscription;
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return $subscription;
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateMySubscription(SubscriptionRequest $request, Subscription $subscription)
    {
       
        $startDate = Carbon::createFromFormat('d-m-Y', $request->start)->format('Y-m-d');
        $plan = Plan::where('id', $request->plan_id)->first();
        $end = Carbon::parse($startDate)->addDays($plan->period);

        
        $subscription->update([
            'start' => $startDate,
            'end' => $end,
            'plan_id' => $request->plan_id,
        ]);
        return $subscription;
    }
}
