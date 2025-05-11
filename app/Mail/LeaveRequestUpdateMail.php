<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveRequestUpdateMail extends Mailable
{

    use Queueable, SerializesModels;
    public $teacher_name;
    public $subject;
    public $teacher_email;
    public $leave_type;
    public $start_date;
    public $end_date;
    public $status;
    public $reject_comment;

    public function __construct($teacher_name, $subject, $teacher_email, $leave_type, $start_date, $end_date, $status, $reject_comment)
    {
        $this->teacher_name = $teacher_name;
        $this->subject = $subject;
        $this->teacher_email = $teacher_email;
        $this->leave_type = $leave_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->status = $status;
        $this->reject_comment = $reject_comment;
    }

    public function build()
    {
        return $this->view('emails.leave_request_update')
            ->with([
                'teacherName' => $this->teacher_name,
                'subject' => $this->subject,
                'teacherEmail' => $this->teacher_email,
                'leaveType' => $this->leave_type,
                'startDate' => $this->start_date,
                'endDate' => $this->end_date,
                'status' => $this->status,
                'rejectComment' => $this->reject_comment,
            ]);
    }
}
