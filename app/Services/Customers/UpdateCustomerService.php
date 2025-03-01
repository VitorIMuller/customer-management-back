<?php
namespace App\Services\Customers;

use App\Models\Customer;

class UpdateCustomerService
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function update()
    {
        $customer = Customer::update($this->data);

        return $customer;
    }
}
