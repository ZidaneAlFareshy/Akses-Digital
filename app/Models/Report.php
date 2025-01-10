<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $primaryKey = 'report_id';
    public $timestamps = false;

    protected $fillable = [
        'type',
        'date_generated',
        'generated_by',
        'description'
    ];
}
