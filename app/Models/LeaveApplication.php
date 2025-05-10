<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $table = 'leave_applications';

    protected $fillable = [
        'user_id',
        'submitted_by',
        'commence_date',
        'end_date',
        'leave_type',
        'reason',
        'attachment_url_1',
        'attachment_url_2',
        'attachment_url_3',
    ];

    protected $dates = [
        'commence_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function statuses()
    {
        return $this->hasMany(LeaveStatus::class, 'leave_id');
    }

    public function latestStatus()
    {
        return $this->hasOne(LeaveStatus::class, 'leave_id')->latestOfMany();
    }

    public function getLeaveDaysAttribute()
    {
        if ($this->leave_type === 'SHORT') {
            return 0.5; // Short leave is half a day
        }

        $start = Carbon::parse($this->commence_date);
        $end = Carbon::parse($this->end_date);
        return $start->diffInDays($end) + 1; // Include both start and end dates
    }

    public function getLeaveDaysByYearAttribute()
    {
        $start = Carbon::parse($this->commence_date);
        $end = Carbon::parse($this->end_date);
        $daysByYear = [];

        if ($this->leave_type === 'SHORT') {
            $year = $start->year;
            $daysByYear[$year] = 0.5;
            return $daysByYear;
        }

        $currentDate = $start->copy();
        while ($currentDate <= $end) {
            $year = $currentDate->year;
            if (!isset($daysByYear[$year])) {
                $daysByYear[$year] = 0;
            }

            $daysByYear[$year]++;
            $currentDate->addDay();
        }

        return $daysByYear;
    }
}