<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'user_data' => 'object',
    ];
    public function category()
    {
        return $this->belongsTo(itemCategory::class, 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(itemCategory::class, 'subcategory_id');
    }

    public function unit(){
        return $this->belongsTo(Itemunit::class,'unit_id');
    }
}
