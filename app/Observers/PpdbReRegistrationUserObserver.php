<?php

namespace App\Observers;

use App\Models\PpdbReRegistrationUser;

class PpdbReRegistrationUserObserver
{
    /**
     * Handle the PpdbReRegistrationUser "created" event.
     */
    public function created(PpdbReRegistrationUser $ppdbReRegistrationUser): void
    {
        //
    }

    /**
     * Handle the PpdbReRegistrationUser "updated" event.
     */
    public function updated(PpdbReRegistrationUser $ppdbReRegistrationUser): void
    {
        //
    }

    /**
     * Handle the PpdbReRegistrationUser "deleted" event.
     */
    public function deleted(PpdbReRegistrationUser $ppdbReRegistrationUser): void
    {
        //
    }

    /**
     * Handle the PpdbReRegistrationUser "restored" event.
     */
    public function restored(PpdbReRegistrationUser $ppdbReRegistrationUser): void
    {
        //
    }

    /**
     * Handle the PpdbReRegistrationUser "force deleted" event.
     */
    public function forceDeleted(PpdbReRegistrationUser $ppdbReRegistrationUser): void
    {
        //
    }
}
