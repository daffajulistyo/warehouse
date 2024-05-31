<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function purchaseDetail()
    {
        return $this->belongsToMany(PurchaseDetail::class)->withPivot(['jumlah']);
    }

    public function sale()
    {
        # code...
        return $this->belongsToMany(Sale::class)->withPivot(['jumlah']);
    }

    public function mutation()
    {
        return $this->hasMany(StockMutation::class);
    }
}