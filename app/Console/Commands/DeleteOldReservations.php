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
    protected $signature = 'reservations:delete-old-reservations';

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
        $query = Reservation::withTrashed()
            ->where('created_at', '<', now()->subMonths(6));

        $count = $query->forceDelete();

        $this->info("Trajno obrisano {$count} rezervacija starijih od 6 mjeseci.");
    }
}
