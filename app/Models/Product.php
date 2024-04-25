<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'image',
        'description',
        'is_active',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
