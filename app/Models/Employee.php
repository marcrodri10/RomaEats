<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';

    protected $table = 'employees';
    protected $fillable = [
        'hire_date',
        'schedule',
        'user_id',
    ];
}
