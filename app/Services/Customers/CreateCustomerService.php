<?php
namespace App\Services\Customers;

use App\Models\Customer;

class CreateCustomerService
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function create()
    {
        $customer = Customer::create($this->data);

        return $customer;
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
}
