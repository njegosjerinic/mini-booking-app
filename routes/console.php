<?php

use Illuminate\Support\Facades\Schedule;

// Delete old reservations daily at midnight
Schedule::command('reservations:delete-old-reservations')
    ->daily()
    ->withoutOverlapping();
