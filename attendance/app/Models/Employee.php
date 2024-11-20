<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $guarded = [];

    protected $casts = [
        'dob' => 'date',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'employee_id');
    }

    public function getStatusTextAttribute()
    {
        switch ($this->attributes['status'])
        {
            case 1:
                return 'Active';

            case 2:
                return 'Inactive';

            default:
                return 'Baru';
        }
    }
}
