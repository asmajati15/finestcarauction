<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    /* protected $fillable = [
        'name',
        'description',
        'min_price',
        'max_price',
        'buyout_price',
        'end_time',
        'image',
        'user_id',
        'category_id',
        'end_time',
        'created_at',
        'updated_at',
    ]; */

    protected $guarded = ['id'];   
    
    public function user(){

        return $this->belongsTo(User::class);

    }
}
