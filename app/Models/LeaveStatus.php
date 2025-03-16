<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveStatus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leave_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'leave_id',
        'user_id',
        'status',
        'comment',
    ];

    /**
     * A leave status belongs to a leave application.
     */
    public function leaveApplication(): BelongsTo
    {
        return $this->belongsTo(LeaveApplication::class, 'leave_id');
    }

    /**
     * A leave status belongs to a user (who approved/rejected it).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
