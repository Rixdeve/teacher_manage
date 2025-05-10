<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schools';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'school_number',
        'zonal_id',
        'school_name',
        'school_address_no',
        'school_address_street',
        'school_address_city',
        'school_email',
        'password',
        'school_phone',
        'status',
    ];
    // protected $guarded = [];

    /**
     * A school belongs to a zone office.
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(ZoneOffice::class, 'zonal_id');
    }

    /**
     * A school has many users (teachers, clerks, principals, etc.).
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function principal(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class)->where('role', 'PRINCIPAL');
    }
}
