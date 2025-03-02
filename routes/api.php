<?php

use App\Http\Controllers\Customers\CustomersController;
use App\Http\Controllers\Twilio\TwilioController;
use App\Http\Controllers\Webhooks\WebhookController;
use Illuminate\Support\Facades\Route;

Route::namespace('API')
    ->group(function () {
        Route::get('/customers', [CustomersController::class, 'index']);
        Route::get('/customers/{id}', [CustomersController::class, 'show']);
        Route::post('/customers', [CustomersController::class, 'store']);
        Route::put('/customers/{id}', [CustomersController::class, 'update']);
        Route::delete('/customers/{id}', [CustomersController::class, 'destroy']);

        Route::prefix('webhooks')->group(function () {
            Route::post('/receive-event', [WebhookController::class, 'receiveEvent']);
        });

        Route::post('/twilio/call/{customer_id}/{type?}', [TwilioController::class, 'startCall']);
    });
