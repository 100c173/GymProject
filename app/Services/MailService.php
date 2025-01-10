<?php

namespace App\Services;

use App\Http\Requests\EquipmentRequest;
use App\Mail\ActivateEmail;
use App\Models\SportEquipment;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailService
{

    /**
     * To Create a new equipment
     * 
     * @param User $user The create data
     * @param Subscription $subscription The create data
     */
    public function SendActivateSubscriptionEmail(User $user, Subscription $subscription)
    {
        $mailData = [
            'subscription' => $subscription,
            'user' => $user
        ];
       return Mail::to(auth()->user()->email)->send(new ActivateEmail($mailData));
    }
}
