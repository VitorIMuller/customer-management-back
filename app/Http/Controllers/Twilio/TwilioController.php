<?php
namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\Twilio\CallService;

class TwilioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function startCall($customer_id, $type = 'cellphone')
    {
        $customer = Customer::findOrFail($customer_id);

        if ($type == 'cellphone') {
            $to_number = $customer->cellphone;
        } else {
            $to_number = $customer->phone;
        }

        $callService = new CallService($to_number);
        $callService->call();

        return response()->json([
            'message' => 'Call started successfully.',
        ]);
    }
}
