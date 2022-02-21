<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $table = 'document';
    protected $primaryKey = 'document_id';
    
    protected $fillable = [
        'agent_id',
        'document_name',
        'description',
        'document_img',
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
