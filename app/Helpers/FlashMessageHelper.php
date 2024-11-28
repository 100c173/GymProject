<?php
namespace App\Helpers;

use Illuminate\Http\RedirectResponse;

class FlashMessageHelper
{
    /**
     * Handle a successful operation.
     *
     * @param string $message
     * @param string|null $redirect
     */
    public static function success(string $message, string $redirect = null)
    {
        session()->flash('success', $message);
        return redirect($redirect ?? url()->previous());
    }

    /**
     * Handle error operation.
     *
     * @param string $message
     * @param string|null $redirect
     */
    public static function error(string $message, string $redirect = null)
    {
        session()->flash('error', $message);
        return redirect($redirect ?? url()->previous());
    }

}