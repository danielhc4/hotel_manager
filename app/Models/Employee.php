<?php

namespace App\Models;

use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    /** @use HasFactory<EmployeeFactory> */
    use HasFactory, Notifiable;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'first_name',
        'middle_name',
        'paternal_surename',
        'maternal_surename',
        'departments_id',
        'shifts_id',
        'phone',
        'address',
        'state'
    ];

    public function department() {
        return $this->belongsTo(Department::class, 'departments_id');
    }

    public function shift() {
        return $this->belongsTo(Shift::class, 'shifts_id');
    }
}
