<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superadmin extends Model
{
    use HasFactory;
    protected $table = 'superadmin';
    protected $primaryKey = 'super_id';
    
    protected $fillable = [
        'super_admin'
    ];
}
