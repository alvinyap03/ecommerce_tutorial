<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'amount', 'total_cost',
    ];

    public function user()
    {
        return $this->belongsTo(Login::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
