<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use App\Mail\MasinasAtgadinatajs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CheckCarDeadlines extends Command
{
    protected $signature = 'cars:check-deadlines';
    protected $description = 'Pārbauda OCTA/TA termiņus un eļļas maiņas prognozi';

    public function handle()
    {
        // 1. Pārbaudām OCTA un TA (3 un 1 diena pirms termiņa)
        $targetDays = [3, 1]; 
        
        foreach ($targetDays as $days) {
            $dateToCheck = Carbon::today()->addDays($days)->toDateString();

            // Pārbaudām OCTA
            $octaCars = Car::whereDate('octa_beigas', $dateToCheck)->with('user')->get();
            foreach ($octaCars as $car) {
                $this->sendReminder($car, 'OCTA', $days);
            }

            // Pārbaudām TA
            $taCars = Car::whereDate('tehniska_beigas', $dateToCheck)->with('user')->get();
            foreach ($taCars as $car) {
                $this->sendReminder($car, 'Tehniskā apskate', $days);
            }
        }

        // 2. Eļļas maiņas loģika
        // Testēšanai atstāts "true". Vēlāk nomaini uz: if (now()->day == 1)
        if (true) {
            $this->info('Pārbauda eļļas maiņas prognozes...');
            
            $allCars = Car::with('user')->get();
            foreach ($allCars as $car) {
                $ellas_limits = $car->pedeja_ella_km + $car->ellas_intervals_km;
                $prognoze = $car->nobraukums + $car->videjais_menes_km;

                if ($car->nobraukums < $ellas_limits && $prognoze >= $ellas_limits) {
                    
                    // APRĒĶINU LABOJUMI:
                    // 1. Atlikušos kilometrus pārvēršam par veselu skaitli
                    $atlikusie_km = intval($ellas_limits - $car->nobraukums);
                    
                    // 2. Dienas līdz mēneša beigām rēķinām no šodienas sākuma līdz mēneša beigām
                    // diffInDays atgriež veselu skaitli
                    $dienas_beigas = (int) Carbon::today()->diffInDays(Carbon::today()->endOfMonth());

                    // Ja šodien ir mēneša pēdējā diena, diff var būt 0, pieliekam 1 drošībai
                    if ($dienas_beigas <= 0) $dienas_beigas = 1;

                    $this->sendReminder($car, 'Eļļas maiņa', 30, [
                        'km_atlikusi' => $atlikusie_km,
                        'dienas_beigas' => $dienas_beigas
                    ]);
                }
            }
        }

        $this->info('Termiņu pārbaude pabeigta.');
    }

    private function sendReminder($car, $type, $days, $extra = [])
    {
        if ($car->user && $car->user->email) {
            try {
                Mail::to($car->user->email)->send(new MasinasAtgadinatajs($car, $type, $days, $extra));
                $this->line("Nosūtīts atgādinājums {$car->user->email} par {$car->razotajs} {$type}");
            } catch (\Exception $e) {
                Log::error("Kļūda sūtot epastu: " . $e->getMessage());
                $this->error("Kļūda pie auto ID {$car->id}");
            }
        }
    }
}