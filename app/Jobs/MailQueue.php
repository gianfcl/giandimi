<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Mail as eMail;
use Mail;

class MailQueue implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    protected $_email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Mail\Mail $email) {
        $this->_email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::send($this->_email);
    }

}