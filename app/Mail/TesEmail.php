<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TesEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $transaksi;
    public $cart;
    public $customer;
    public function __construct($transaksi, $cart, $customer)
    {
        $this->transaksi = $transaksi;
        $this->cart = $cart;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@almalikbuku.com')->subject('TOKO ALMALIK BUKU')
                   ->view('emailku');
        // return $this->view('view.name');
    }
}
