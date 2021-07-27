<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_service extends Model
{
    use HasFactory;
    protected $table = "room_services";
    public $fillable = [
        'room_id', 'service_id', 'additional_price'
    ];
    public function room(){
        return $this->belongsTo(Room::class,'room_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
