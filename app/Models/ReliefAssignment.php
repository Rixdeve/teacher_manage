<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReliefAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_application_id',
        'absent_teacher_id',
        'relief_teacher_id',
        'date',
        'subjects',
        'time_slot',
        'class',
    ];

    public function leaveApplication()
    {
        return $this->belongsTo(LeaveApplication::class);
    }

    public function absentTeacher()
    {
        return $this->belongsTo(User::class, 'absent_teacher_id');
    }

    public function reliefTeacher()
    {
        return $this->belongsTo(User::class, 'relief_teacher_id');
    }
}