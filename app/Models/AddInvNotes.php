<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddInvNotes extends Model
{
    use HasFactory;
    
    protected $table = 'add_inv_notes';
    protected $primaryKey = 'notes_id';
    
    protected $fillable = [
        'inv_id',
        'reviewed_by',
        'notes_details',
        'status'
    ];
}
