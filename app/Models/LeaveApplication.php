<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveApplication extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leave_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'commence_date',
        'end_date',
        'leave_type',
        'reason',
        'attachment_url_1',
        'attachment_url_2',
        'attachment_url_3',
    ];

    /**
     * A leave application belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A leave application has many statuses (approved/rejected).
     */
    public function leaveStatuses(): HasMany
    {
        return $this->hasMany(LeaveStatus::class, 'leave_id');
    }
}
