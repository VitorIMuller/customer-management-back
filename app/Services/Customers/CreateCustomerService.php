<?php
namespace App\Services\Customers;

use App\Jobs\SendWelcomeEmail;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CreateCustomerService
{

    protected $data;

    protected $customer;

    public function __construct($data)
    {
        $this->data = $data;

        $this->customer = null;
    }

    public function create($webhookEvent = null)
    {
        if ($webhookEvent) {
            $this->data = $this->normalizeData();
        }

        $this->customer = Customer::create($this->data);

        $this->sendWelcomeEmail();

        return $this->customer;
    }

    public function normalizeData()
    {
        return [
            'huggy_customer_id' => $this->data['id'],
            'name'              => $this->data['name'],
            'email'             => $this->data['email'],
            'phone'             => $this->data['phone'],
            'cellphone'         => $this->data['mobile'],
            'url_photo'         => $this->data['photo'],
            'status'            => 'A',
        ];
    }

    public function sendWelcomeEmail()
    {
        Log::info('Opa');
        SendWelcomeEmail::dispatch($this->customer)->delay(now()->addSecond(5));
    }
}
