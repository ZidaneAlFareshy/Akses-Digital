<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $primaryKey = 'task_id';
    public $timestamps = false;

    protected $fillable = [
        'task_name',
        'assignee',
        'priority',
        'deadline',
        'status',
        'progress'
    ];
}
