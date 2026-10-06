<?php

namespace App\Models;

use Database\Factories\DepartmentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    /** @use HasFactory<DepartmentFactory> */
    use HasFactory, Notifiable;

    protected $table = 'departments';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['name', 'description'];
}
