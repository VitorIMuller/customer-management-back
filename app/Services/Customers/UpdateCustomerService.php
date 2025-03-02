<?php
namespace App\Services\Customers;

use App\Models\Customer;

class UpdateCustomerService
{

    protected $data;

    protected $customer_id;

    public function __construct($data, $id)
    {
        $this->data        = $data;
        $this->customer_id = $id;
    }

    public function update($webhookEvent = null)
    {
        if ($webhookEvent) {
            $this->data = $this->normalizeData();
        }

        $customer = Customer::findOrFail($this->customer_id)->update($this->data);

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
