<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMdl extends Model
{
    use HasFactory;

    protected $table = 'property';
    protected $primaryKey = 'property_id';
    
    protected $fillable = [
        'title',
        'users_id',
        'description',
        'amount',
        'prop_img',
        'property_status',
        'property_size',
        'location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

   // protected $dateFormat = 'Y-m-d';
}
