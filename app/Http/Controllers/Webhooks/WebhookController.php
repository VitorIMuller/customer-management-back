<?php
namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Services\Webhooks\WebhookService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function receiveEvent(Request $request)
    {
        $event = $request->validate([
            'messages' => 'nullable|array',
        ]);

        $service = new WebhookService($event);
        $service->handleEvent();

        return response()->json([
            'code' => 200,
            'data' => 'received',
        ]);
    }
}
