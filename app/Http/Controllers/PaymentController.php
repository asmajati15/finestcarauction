<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Services\Midtrans\CreateSnapTokenService;

class PaymentController extends Controller
{
    public function getSnapToken($id) {
        $bid = Bid::find($id);
        $snapToken = $bid->snap_token;
        if (empty($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database

            $midtrans = new CreateSnapTokenService($bid);
            $snapToken = $midtrans->getSnapToken();

            $bid->snap_token = $snapToken;
            $bid->save();
        }

    }
}
