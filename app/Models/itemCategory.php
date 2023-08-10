<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function parent(){
        return $this->belongsTo(itemCategory::class,'parent_id');
    }

    public function child()
    {
        return $this->hasMany(itemCategory::class, 'parent_id');
    }
}
