<?php

namespace App\Models;

use Database\Factories\ChecklistFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    /** @use HasFactory<ChecklistFactory> */
    use HasFactory;

    protected $table = 'checklist';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['activities_id', 'notes'];
}
