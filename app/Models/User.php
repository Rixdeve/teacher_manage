<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'school_id',
        'school_index',
        'qr_code',
        'first_name',
        'last_name',
        'user_email',
        'role',
        'email_verified_at',
        'user_password',
        'profile_picture',
        'user_phone',
        'registered_date',
        'status',
        'user_nic',
        'user_address_no',
        'user_address_street',
        'user_address_city',
        'user_dob',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'user_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'registered_date' => 'date',
        'user_dob' => 'date',
        'user_password' => 'hashed', // Ensures password is securely hashed
    ];

    /**
     * A user belongs to a school.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * A user has many attendance records.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * A user has many leave applications.
     */
    public function leaveApplications(): HasMany
    {
        return $this->hasMany(LeaveApplication::class);
    }

    /**
     * A user has many leave statuses.
     */
    public function leaveStatuses(): HasMany
    {
        return $this->hasMany(LeaveStatus::class);
    }

    /**
     * A user has one leave counter.
     */
    public function leaveCounter(): HasOne
    {
        return $this->hasOne(LeaveCounter::class);
    }
}
