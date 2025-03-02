<?php
namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    /**
     * Create a new message instance.
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Bem vindo meu cliente querido!')
            ->view('emails.welcome')
            ->with(['customer' => $this->customer]);
    }
}
