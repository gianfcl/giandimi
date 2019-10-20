<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mail extends Mailable {

    use Queueable,
        SerializesModels;

    const TITULO = 'Líneas Automáticas - ';

    protected $_titulo;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('mailtest');
    }

}