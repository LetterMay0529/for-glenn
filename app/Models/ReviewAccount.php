<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewAccount extends Model
{
    use HasFactory;

    protected $table = 'request_for_review';
    protected $primaryKey = 'review_id';
    
    protected $fillable = [
        'agent_id',
        'details_of_result',
        'status',
        'review_by',
        'date_review_completed'
    ];

    protected $hidden = [
        
        'remember_token',
    ];
}
