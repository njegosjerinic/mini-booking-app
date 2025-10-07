<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;

class DeleteOldReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Izbriši stare rezervacije';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();

        $deletedCount = Reservation::where('end_date', '<', $now)->delete();

        $this->info("Obrisano je $deletedCount starih rezervacija.");
    }
}
