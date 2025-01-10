<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountVerified extends Mailable
{
    use Queueable, SerializesModels;
    protected $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        //dd($customer);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//dd($settings=Setting::where('id',1)->first());
        return $this->subject('Stores: Account Verified')->view('mail.account_verified')->with('customer', $this->customer);

    }
}
