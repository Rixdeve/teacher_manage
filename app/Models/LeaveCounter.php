<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveCounter extends Model
{
    use HasFactory;

    protected $table = 'leave_counters';

    protected $fillable = [
        'user_id',
        'year',
        'total_casual',
        'total_medical',
        'total_short',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getOrCreateForUser($userId, $year = null)
    {
        if (is_null($year)) {
            $year = now()->year;
        }

        $leaveCounter = self::where('user_id', $userId)
            ->where('year', $year)
            ->first();

        if (!$leaveCounter) {
            $leaveCounter = self::create([
                'user_id' => $userId,
                'year' => $year,
                'total_casual' => 20,
                'total_medical' => 20,
                'total_short' => 2,
            ]);
        }

        return $leaveCounter;
    }
}
