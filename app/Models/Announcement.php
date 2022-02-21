<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'announcement';
    protected $primaryKey = 'announcement_id';
    
    protected $fillable = [
        'subject',
        'intended_to',
        'content',
        'published_by'
    ];
}
