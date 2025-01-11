<?php

namespace App\Rules;

use App\Models\Plan;
use App\Models\Session;
use App\Models\Subscription;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\BreakLine;

class ValidSessionForUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $subscriptions = Subscription::all()->where('user_id',auth()->id());
        $ok = false;
        foreach($subscriptions as $subscription){
            $plan = Plan::find($subscription->plan_id);
            $sessions = $plan->sessions;
            foreach($sessions as $session){
                if($session->id == $value){
                    $ok = true ;
                    break; 
                }
                if($ok)break;
            }
        }
        if(!$ok)
            $fail('session not avialable');
        
    }
}
