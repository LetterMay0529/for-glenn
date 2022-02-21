<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    protected $table = 'investigate';
    protected $primaryKey = 'inv_id';
    
    protected $fillable = [
        'customer_id',
        'property_id',
        'details',
        'status'
    ];
}
