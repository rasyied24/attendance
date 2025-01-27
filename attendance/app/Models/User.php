<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'employee_id',
        'email',
        'password',
        'role',
        'status',
        'create_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'create_date' => 'date',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
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
