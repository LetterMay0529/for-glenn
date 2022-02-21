<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_Property_Photo extends Model
{
    use HasFactory;

    protected $table = 'property_photo';
    protected $primaryKey = 'photo_id';
    
    protected $fillable = [
        'property_id',
        'image_name'
    ];
}
