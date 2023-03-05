<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BNIInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailable.bni-invoice')->subject('Panduan pembayaran pendaftaran Universitas Gresik');
    }
}
