<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $table = 'finance';

    protected $primaryKey = 'income_id';
    public $timestamps = false;

    protected $fillable = [
        'customer_name',
        'project_name',
        'amount',
        'date',
        'payment_method'
    ];
}
