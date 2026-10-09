<?php

namespace App\Models;

use Database\Factories\AttendanceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attendance extends Model
{
    /** @use HasFactory<AttendanceFactory> */
    use HasFactory, Notifiable;

    protected $table = 'attendance';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['employees_id', 'entry', 'ending'];
}
