<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px;">

    <div
        style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); overflow: hidden;">

        <!-- Header Section -->
        <div style="background-color: #5CE65C; padding: 20px; text-align: center;">
            <img src="https://drive.google.com/uc?export=view&id=1Pvy2upXCGeRAARy9zQRHJEo_aE3z5IrM" alt="TLMS Logo"
                style="width: 150px; height: auto; margin-bottom: 10px;">
            <div style="font-size: 24px; font-weight: bold; color: #ffffff;">
                {{ $subject }}
            </div>
        </div>
        <!-- Divider -->
        <div style="height: 2px; background-color: #5CE65C;"></div>
        <!-- Greeting Section -->
        <div style="padding: 20px; text-align: left;">
            <h2 style="font-size: 16px; color: #333333;">Hi {{ $name }},</h2>
            <p style="font-size: 16px; color: #555555;">You have submitted a leave request.</p>
        </div>
        <!-- Body Section -->
        <div style="padding: 20px; font-size: 16px; color: #555555;">
            <p><strong>Leave Type:</strong> {{ $leaveType }}</p>
            <p><strong>Start Date:</strong> {{ $startDate }}</p>
            <p><strong>End Date:</strong> {{ $endDate }}</p>

            @if (!empty($reason))
            <p><strong>Reason:</strong> {{ $reason }}</p>
            @endif

            <p style="color: #008000; margin-top: 15px;"><strong>Your leave request has been successfully
                    submitted.</strong></p>

            <p>Thank you!</p>
            <p>Best regards,</p>
            <p><strong>TLMS Team</strong></p>

            <p style="font-size: 13px; color: #888888; margin-top: 30px; text-align: center;">
                Note: This is an automated message, please do not reply.
            </p>
        </div>

    </div>

</body>

</html>