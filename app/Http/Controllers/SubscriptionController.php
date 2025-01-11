<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      /**
     * Service to handle rating-related logic 
     * and separating it from the controller
     * 
     * @var SubscriptionService
     */
    protected $subscriptionService;

    /**
     * RatingController constructor
     *
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(SubscriptionService $subscriptionService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the RatingService to handle rating-related logic
        $this->subscriptionService= $subscriptionService;
    }

    public function index(Request $request)
    {  $subscriptions = $this->subscriptionService->search($request);
        $user = User::whereHas('subscriptions')->get();
        return view('new-dashboard.subscriptions.list_subscription', [

            'subscriptions' => $subscriptions,
            'user' => $user
        ]);
      }
      public function AllMoveToTrash(Request $request)
      {
          $this->subscriptionService->moveFinishedSubscriptionsToTrash();
  
          return redirect()->route('subscription.index')->with('success', 'Finished subscriptions moved to trash.');
      }
      public function trashed(Request $request)
      {
        $entries_number = $request->input('entries_number', 10);
      
          $subscriptions = $this->subscriptionService->getTrashedSubscriptions($entries_number);
  
          return view('new-dashboard.subscriptions.trashed_subscription', compact('subscriptions'));
      }
    public function destroy(Subscription $subscription)
{
    $this->subscriptionService->delete($subscription);

    return redirect()->back()->with('success', 'Subscription moved to trash.');
}

    public function forceDelete($id)
    {
        try {
            $this->subscriptionService->forceDeleteSubscription($id);
            return redirect()->back()->with('success', 'Subscription delete success');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', ' deleted failed');
        }
    }
}
