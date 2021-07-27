<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = "services";
    protected $fillable = ['name'];
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_services', 'service_id', 'room_id');
                                //  bang n-n         bang trung gian   lk voi nhau
    }

}
