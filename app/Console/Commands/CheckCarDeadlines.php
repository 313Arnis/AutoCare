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
        // 1. Pārbauda OCTA un TA 
        $targetDays = [3, 1]; 
        
        foreach ($targetDays as $days) {
            $dateToCheck = Carbon::today()->addDays($days)->toDateString();

            // Pārbauda OCTA
            $octaCars = Car::whereDate('octa_beigas', $dateToCheck)->with('user')->get();
            foreach ($octaCars as $car) {
                $this->sendReminder($car, 'OCTA', $days);
            }

            // Pārbauda TA
            $taCars = Car::whereDate('tehniska_beigas', $dateToCheck)->with('user')->get();
            foreach ($taCars as $car) {
                $this->sendReminder($car, 'Tehniskā apskate', $days);
            }
        }

        // Eļļas maiņas loģika
        
        if (now()->day == 1) {
            $this->info ('Pārbauda eļļas maiņas prognozes...');
            
            $allCars = Car::with('user')->get();
            foreach ($allCars as $car) {
                $ellas_limits = $car->pedeja_ella_km + $car->ellas_intervals_km;
                $prognoze = $car->nobraukums + $car->videjais_menes_km;

                if ($car->nobraukums < $ellas_limits && $prognoze >= $ellas_limits) {
                    
                    
                    $atlikusie_km = intval($ellas_limits - $car->nobraukums);
                    
                   
                    $dienas_beigas = (int) Carbon::today()->diffInDays(Carbon::today()->endOfMonth());

                  
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