<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    /*  protected $fillable = [
        'bid_price',
        'lot_id',
        'user_id',
        'created_at',
        'updated_at',
    ]; */

    protected $guarded = ['id']; 

    public function lot() {
        return $this->belongsTo(Lot::class, 'lot_id');
    }
}
