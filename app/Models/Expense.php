<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expense';

    protected $primaryKey = 'expense_id';
    public $timestamps = false;

    protected $fillable = [
        'category',
        'amount',
        'date',
        'description'
    ];
}
