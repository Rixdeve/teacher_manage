<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;


class LeaveRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
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
    public function __construct($name, $subject, $leave_type, $start_date, $end_date, $reason)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->leave_type = $leave_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->reason = $reason;
    }
    public function build()
    {
        return $this->view('emails.leave_request')
            ->with([
                'name' => $this->name,
                'subject' => $this->subject,
                'leaveType' => $this->leave_type,
                'startDate' => $this->start_date,
                'endDate' => $this->end_date,
                'reason' => $this->reason,
            ]);
    }
}

class LeaveReqestRecivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $leave_type;
    public $start_date;
    public $end_date;
    public $reason;
    public $principal_email;
    public $principal_name;
    public $principal_subject;
    /**
     * Create a new message instance.
     */
    public function __construct($principal_name, $principal_email, $name, $principal_subject, $leave_type, $start_date, $end_date, $reason)
    {
        $this->principal_name = $principal_name;
        $this->principal_email = $principal_email;
        $this->name = $name;
        $this->principal_subject = $principal_subject;
        $this->leave_type = $leave_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->reason = $reason;
    }
    public function build()
    {
        return $this->view('emails.leave_request_received')
            ->with([
                'principalName' => $this->principal_name,
                'principalEmail' => $this->principal_email,
                'principalSubject' => $this->principal_subject,
                'name' => $this->name,
                'leaveType' => $this->leave_type,
                'startDate' => $this->start_date,
                'endDate' => $this->end_date,
                'reason' => $this->reason,
            ]);
    }
}
