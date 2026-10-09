<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ActivityFactory;
use Illuminate\Notifications\Notifiable;

class Activity extends Model
{
    /** @use HasFactory<ActivityFactory> */
    use HasFactory, Notifiable;

    protected $table = 'activities';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
		'name',
		'shifts_id',
		'activity_type',
		'description',
		'employees_id',
        'departments_id'
    ];

    public function shift() {
        return $this->belongsTo(Shift::class, 'shifts_id', 'id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employees_id', 'id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'departments_id', 'id');
    }
}
