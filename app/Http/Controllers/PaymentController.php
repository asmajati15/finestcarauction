<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;
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

    public function tembak(Request $request, $id) {
    // dd($request->result['status_code']);
        DB::table('bids')->where('id', $id)->update([
            'payment_status' => $request->result['status_code'],
            'jumlah_pembayaran' => $request->result['gross_amount'],
            'payment_status_message' => $request->result['status_message'],
            'transaction_time' => $request->result['transaction_time'],
            'payment_type' => $request->result['card_type'],
        ]);

        return response()->json($request->data, 200);
    }
}
