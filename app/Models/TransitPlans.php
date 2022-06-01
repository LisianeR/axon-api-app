<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitPlans extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'transit_number', 'client_group_id', 'sender_name', 'sender_city', 'date_start_estimated', 'created_at', 'updated_at', 'deleted_at'];

    protected $table = 'transit_plans';

}
