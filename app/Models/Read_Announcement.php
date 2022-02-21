<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Read_Announcement extends Model
{
    use HasFactory;

    protected $table = 'read_announcement';
    protected $primaryKey = 'read_id';
    
    protected $fillable = [
        'announcement_id', 
        'status', 
        'reader_id'
    ];
}
