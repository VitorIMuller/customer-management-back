<?php
namespace App\Services\Webhooks;

use App\Models\Customer;
use App\Models\WebhookEvent;
use App\Services\Customers\CreateCustomerService;
use App\Services\Customers\UpdateCustomerService;
use Illuminate\Support\Facades\Log;

class WebhookService
{

    protected $load;

    protected WebhookEvent $webhookEvent;

    public function __construct($load)
    {
        $this->load = $load;
    }

    public function handleEvent()
    {
        $this->saveEvent();

        Log::info($this->load['messages']);
        if (isset($this->load['messages']['createdCustomer'])) {
            $this->createEvent();
        } else if (isset($this->load['messages']['updatedCustomer'])) {
            $this->updateEvent();
        } else {
            return 'Desculpe! Não estamos preparados para este evento :(';
        }
    }

    private function saveEvent()
    {
        $this->webhookEvent = WebhookEvent::create([
            'load' => json_encode($this->load),
        ]);
    }

    protected function createEvent()
    {
        $customerService = new CreateCustomerService($this->load['messages']['createdCustomer'][0]);
        $customerService->create(true);
    }

    protected function updateEvent()
    {
        $eventData = $this->load['messages']['updatedCustomer'][0];

        $customer = Customer::where('huggy_customer_id', $eventData['id'])->first();

        if (! $customer) {
            $customerService = new CreateCustomerService($eventData);
            $data            = $customerService->normalizeData();
            $customer        = Customer::create($data);
        }

        $updateCustomer = new UpdateCustomerService($eventData, $customer->id);
        $updateCustomer->update(true);
    }
}
