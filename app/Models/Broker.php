<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;

    protected $table = 'broker';
    protected $primaryKey = 'broker_id';
    
    protected $fillable = [
        'agent_id',
        'broker_name',
        'broker_details',
        'broker_img_license',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        
        'remember_token',
    ];
}
