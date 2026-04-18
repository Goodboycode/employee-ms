<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'store_id',
        'position',
        'is_active',
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }
}
