<?php

namespace App\Observers;

use App\Models\PpdbUser;
use Illuminate\Support\Facades\Mail;
use App\Mail\PpdbUserCreated;

class PpdbUserObserver
{
    /**
     * Handle the PpdbUser "created" event.
     */
    public function created(PpdbUser $ppdbUser): void
    {
        Mail::to($ppdbUser->email)->send(new PpdbUserCreated($ppdbUser));
    }

    /**
     * Handle the PpdbUser "updated" event.
     */
    public function updated(PpdbUser $ppdbUser): void
    {
        //
    }

    /**
     * Handle the PpdbUser "deleted" event.
     */
    public function deleted(PpdbUser $ppdbUser): void
    {
        //
    }

    /**
     * Handle the PpdbUser "restored" event.
     */
    public function restored(PpdbUser $ppdbUser): void
    {
        //
    }

    /**
     * Handle the PpdbUser "force deleted" event.
     */
    public function forceDeleted(PpdbUser $ppdbUser): void
    {
        //
    }
}
