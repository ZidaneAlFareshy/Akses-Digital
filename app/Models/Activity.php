<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activity';

    protected $primaryKey = 'log_id';
    public $timestamps = false;

    protected $fillable = [
        'role',
        'activity_type',
        'target',
        'timestamp',
        'ip_address'
    ];
}
