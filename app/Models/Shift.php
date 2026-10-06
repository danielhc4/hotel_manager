<?php

namespace App\Models;

use Database\Factories\ShiftFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Shift extends Model
{
    /** @use HasFactory<ShiftFactory> */
    use HasFactory, Notifiable;

    protected $table = 'shifts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'monday_shift_entry',
        'monday_shift_ending',
        'tuesday_shift_entry',
        'tuesday_shift_ending',
        'wednesday_shift_entry',
        'wednesday_shift_ending',
        'thursday_shift_entry',
        'thursday_shift_ending',
        'friday_shift_entry',
        'friday_shift_ending',
        'saturday_shift_entry',
        'saturday_shift_ending',
        'sunday_shift_entry',
        'sunday_shift_ending',
    ];

}
