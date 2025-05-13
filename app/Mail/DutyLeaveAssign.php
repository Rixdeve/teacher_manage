<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;


class DutyLeaveAssign extends Mailable
{
    use Queueable, SerializesModels;

    public $targetUserId;
    public $targetUserEmail;
    public $targetUserName;
    public $duty_leave_subject;
    public $duty_leave_message;
    public $principal_duty_leave_subject;
    public $principal_duty_leave_message;
    public $leave_type;
    public $start_date;
    public $end_date;
    public $reason;
    public $principal_email;
    public $user_email;
    public $principal_name;
    public $principal;
    public $principal_subject;

    /**
     * Create a new message instance.
     */
    public function __construct($targetUserName, $duty_leave_subject, $leave_type, $start_date, $end_date, $reason)
    {
        $this->targetUserName = $targetUserName;
        $this->duty_leave_subject = $duty_leave_subject;
        $this->leave_type = $leave_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->reason = $reason;
    }
    public function build()
    {
        return $this->view('emails.duty_leave')
            ->with([
                'targetUserName' => $this->targetUserName,
                'dutyLeaveSubject' => $this->duty_leave_subject,
                'leaveType' => $this->leave_type,
                'startDate' => $this->start_date,
                'endDate' => $this->end_date,
                'reason' => $this->reason,
            ]);
    }
}
class DutyLeaveAssignPrincipal extends Mailable
{
    use Queueable, SerializesModels;

    public $targetUserId;
    public $targetUserEmail;
    public $targetUserName;
    public $duty_leave_subject;
    public $duty_leave_message;
    public $principal_duty_leave_subject;
    public $principal_duty_leave_message;
    public $leave_type;
    public $start_date;
    public $end_date;
    public $reason;
    public $principal_email;
    public $user_email;
    public $principal_name;
    public $principal;
    public $principal_subject;

    /**
     * Create a new message instance.
     */
    public function __construct($principal_name, $principal_email, $targetUserName, $principal_duty_leave_subject, $leave_type, $start_date, $end_date, $reason)
    {
        $this->principal_name = $principal_name;
        $this->principal_email = $principal_email;
        $this->targetUserName = $targetUserName;
        $this->principal_duty_leave_subject = $principal_duty_leave_subject;
        $this->leave_type = $leave_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->reason = $reason;
    }
    public function build()
    {
        return $this->view('emails.duty_leave_principal')
            ->with([
                'principalName' => $this->principal_name,
                'principalEmail' => $this->principal_email,
                'targetUserName' => $this->targetUserName,
                'principalDutyLeaveSubject' => $this->principal_duty_leave_subject,
                'leaveType' => $this->leave_type,
                'startDate' => $this->start_date,
                'endDate' => $this->end_date,
                'reason' => $this->reason,
            ]);
    }
}
