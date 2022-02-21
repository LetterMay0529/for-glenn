<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';
    protected $primaryKey = 'subscription_id';
    
    protected $fillable = [
        'users_id',
        'paypal_sub_id',
        'paypal_order_id',
        'plan_subs',
        'date_started',
        'status',
        'date_ended',
        'auto_renew',
    ];
}
