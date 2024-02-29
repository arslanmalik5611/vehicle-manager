<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    public function service_item(){
        return $this->belongsTo(ServiceItem::class);
    }
}
