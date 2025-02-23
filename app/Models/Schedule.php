<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';
    protected $fillable = [
        'user_id',
        'doctor_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
