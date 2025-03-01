<?php
namespace App\Services\Webhooks;

use App\Models\WebhookEvent;
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
        Log::info($this->load);
        $this->saveEvent();

        switch ($this->load['messages']) {
            case 'updatedCustomer':
                $this->updatedEvent();
                break;
            default:
                return 'Desculpe! Não estamos preparados para este evento :(';
        }
    }

    private function saveEvent()
    {
        $this->webhookEvent = WebhookEvent::create([
            'load' => json_encode($this->load),
        ]);
    }

    private function updatedEvent()
    {

    }
}
