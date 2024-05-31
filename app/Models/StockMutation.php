<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMutation extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'updated_at'];
    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
}
