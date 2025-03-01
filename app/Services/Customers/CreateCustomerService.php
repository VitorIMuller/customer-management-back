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
}
