<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Product extends Model implements AuditableContract
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
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
