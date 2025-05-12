<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;


class ReliefAssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $relief_teacher_name;
    public $relief_teacher_email;
    public $relief_teacher_subject;
    public $leaveApplication;
    public $relief_teacher_date;
    public $relief_teacher_time_slot;
    public $relief_teacher_class;
    public $relief_teacher_subjects;
    public $leave_applied_teacher;

    /**
     * Create a new message instance.
     */
    public function __construct($relief_teacher_name, $relief_teacher_subject, $leave_applied_teacher, $relief_teacher_date, $relief_teacher_time_slot, $relief_teacher_class, $relief_teacher_subjects)
    {
        $this->relief_teacher_name = $relief_teacher_name;
        $this->relief_teacher_subject = $relief_teacher_subject;
        $this->leave_applied_teacher = $leave_applied_teacher;
        $this->relief_teacher_date = $relief_teacher_date;
        $this->relief_teacher_time_slot = $relief_teacher_time_slot;
        $this->relief_teacher_class = $relief_teacher_class;
        $this->relief_teacher_subjects = $relief_teacher_subjects;
    }
    public function build()
    {
        return $this->view('emails.releif_assignment')
            ->with([
                'releifTeacherName' => $this->relief_teacher_name,
                'releifTeacherSubject' => $this->relief_teacher_subject,
                'leaveAppliedTeacher' => $this->leave_applied_teacher,
                'releifTeacherDate' => $this->relief_teacher_date,
                'releifTeacherTimeSlot' => $this->relief_teacher_time_slot,
                'releifTeacherClass' => $this->relief_teacher_class,
                'releifTeacherSubjects' => $this->relief_teacher_subjects,
            ]);
    }
}
