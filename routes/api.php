<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransCallbackController;

Route::post(
    '/biteship/webhook',
    [MidtransCallbackController::class, 'biteshipWebhook']
);