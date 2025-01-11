<?php


    /**
     * Flash a success or error message to the session based on a condition
     *
     * @param bool $condition condition to evaluate
     * @param string $successMessage The message to flash if the condition is true
     * @param string $errorMessage The message to flash if the condition is false
     */
    if (!function_exists('flashMessage')) {
        function flashMessage($condition, $successMessage, $errorMessage) {
            if ($condition) {
                session()->flash('success', $successMessage);
            } else {
                session()->flash('error', $errorMessage);
            }
        }
    }