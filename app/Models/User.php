<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'school_id',
        'school_index',
        'qr_code',
        'first_name',
        'last_name',
        'section',
        'subjects',
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

    protected $hidden = [
        'user_password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'registered_date' => 'date',
        'user_dob' => 'date',
        'user_password' => 'hashed',
        'subjects' => 'array',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveApplications(): HasMany
    {
        return $this->hasMany(LeaveApplication::class);
    }

    public function leaveStatuses(): HasMany
    {
        return $this->hasMany(LeaveStatus::class);
    }

    public function leaveCounter(): HasOne
    {
        return $this->hasOne(LeaveCounter::class);
    }

    public function getNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }


    public function getTotalLeaveDaysTaken($year, $leaveType = null)
    {
        $leaveCounter = LeaveCounter::getOrCreateForUser($this->id, $year);

        if ($leaveType === 'CASUAL') {
            return 20 - $leaveCounter->total_casual;
        } elseif ($leaveType === 'MEDICAL') {
            return 20 - $leaveCounter->total_medical;
        } elseif ($leaveType === 'SHORT') {
            return 2 - $leaveCounter->total_short;
        }

        // If no specific type is requested, return an array of all
        return [
            'casual' => 20 - $leaveCounter->total_casual,
            'medical' => 20 - $leaveCounter->total_medical,
            'short' => 2 - $leaveCounter->total_short,
        ];
    }
    public function syncLeaveCounter($year)
    {
        $leaveCounter = LeaveCounter::getOrCreateForUser($this->id, $year);

        // Calculate total casual leave taken
        $casualLeaveTaken = $this->leaveApplications()
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'APPROVED');
            })
            ->where('leave_type', 'CASUAL')
            ->whereYear('commence_date', $year)
            ->get()
            ->sum(function ($application) use ($year) {
                $start = Carbon::parse($application->commence_date);
                $end = Carbon::parse($application->end_date);
                $daysInYear = 0;
                if ($start->year === $end->year && $start->year === $year) {
                    $daysInYear = $start->diffInDays($end) + 1;
                } elseif ($start->year === $year) {
                    $yearEnd = Carbon::create($year, 12, 31);
                    $daysInYear = $start->diffInDays($yearEnd) + 1;
                } elseif ($end->year === $year) {
                    $yearStart = Carbon::create($year, 1, 1);
                    $daysInYear = $yearStart->diffInDays($end) + 1;
                } elseif ($start->year < $year && $end->year > $year) {
                    $yearStart = Carbon::create($year, 1, 1);
                    $yearEnd = Carbon::create($year, 12, 31);
                    $daysInYear = $yearStart->diffInDays($yearEnd) + 1;
                }
                return $daysInYear;
            });

        // Calculate total medical leave taken
        $medicalLeaveTaken = $this->leaveApplications()
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'APPROVED');
            })
            ->where('leave_type', 'MEDICAL')
            ->whereYear('commence_date', $year)
            ->get()
            ->sum(function ($application) use ($year) {
                $start = Carbon::parse($application->commence_date);
                $end = Carbon::parse($application->end_date);
                $daysInYear = 0;
                if ($start->year === $end->year && $start->year === $year) {
                    $daysInYear = $start->diffInDays($end) + 1;
                } elseif ($start->year === $year) {
                    $yearEnd = Carbon::create($year, 12, 31);
                    $daysInYear = $start->diffInDays($yearEnd) + 1;
                } elseif ($end->year === $year) {
                    $yearStart = Carbon::create($year, 1, 1);
                    $daysInYear = $yearStart->diffInDays($end) + 1;
                } elseif ($start->year < $year && $end->year > $year) {
                    $yearStart = Carbon::create($year, 1, 1);
                    $yearEnd = Carbon::create($year, 12, 31);
                    $daysInYear = $yearStart->diffInDays($yearEnd) + 1;
                }
                return $daysInYear;
            });

        // Calculate total short leave taken
        $shortLeaveTaken = $this->leaveApplications()
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'APPROVED');
            })
            ->where('leave_type', 'SHORT')
            ->whereYear('commence_date', $year)
            ->count();

        // Update the LeaveCounter
        $leaveCounter->total_casual = 20 - $casualLeaveTaken;
        $leaveCounter->total_medical = 20 - $medicalLeaveTaken;
        $leaveCounter->total_short = 2 - $shortLeaveTaken;
        $leaveCounter->save();

        Log::info('Leave Counter Synced', [
            'user_id' => $this->id,
            'year' => $year,
            'casual_leave_taken' => $casualLeaveTaken,
            'medical_leave_taken' => $medicalLeaveTaken,
            'short_leave_taken' => $shortLeaveTaken,
            'total_casual' => $leaveCounter->total_casual,
            'total_medical' => $leaveCounter->total_medical,
            'total_short' => $leaveCounter->total_short,
        ]);
    }
}
