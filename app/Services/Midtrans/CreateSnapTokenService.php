<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Lot;
use App\Models\User;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateSnapTokenService extends Midtrans
{
    protected $bid;

    public function __construct($bid)
    {
        parent::__construct();
        $this->bid = $bid;
    }

    public function getSnapToken()
    {
        /* $params = [
            'transaction_details' => [
                'order_id' => 100,
                'gross_amount' => 15,
            ],
            'item_details' => [
                [
                    'id' => 1,
                    'price' => '150000',
                    'quantity' => 1,
                    'name' => 'Flashdisk Toshiba 32GB',
                ],
                [
                    'id' => 2,
                    'price' => '60000',
                    'quantity' => 2,
                    'name' => 'Memory Card VGEN 4GB',
                ],
            ],
            'customer_details' => [
                'first_name' => 'Martin Mulyo Syahidin',
                'email' => 'mulyosyahidin95@gmail.com',
                'phone' => '081234567890',
            ]
        // ]; */

        $bid_id = Carbon::now('Asia/Jakarta')->timestamp;
        $user = User::where('id', $this->bid->user_id)->first();
        $item[] = [
            'price' => $this->bid->bid_price,
            'name' => substr($this->bid->lot->name, 0, 7).'...',
            'quantity' => 1,
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $bid_id,
                'gross_amount' => 1,
            ],
            'item_details' => $item,
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ];

        Bid::where('id',$this->bid->id)->update(['transaction_id'=>$bid_id]);
        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
