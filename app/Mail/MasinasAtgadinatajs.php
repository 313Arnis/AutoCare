<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MasinasAtgadinatajs extends Mailable
{
    use Queueable, SerializesModels;

    public $car;
    public $type;
    public $days;
    public $extra;

    /**
     * Izveido jaunu e-pasta ziņojumu.
     */
    public function __construct($car, $type, $days, $extra = [])
    {
        $this->car = $car;
        $this->type = $type;
        $this->days = $days;
        $this->extra = $extra;
    }

    /**
     * Uzstāda e-pasta tēmu un skatu.
     */
    public function build()
    {
        return $this->subject("Atgādinājums: {$this->car->razotajs} {$this->type}")
                    ->view('emails.atgadinajums');
    }
}