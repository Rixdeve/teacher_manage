<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone_office extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zone_offices'; // Ensure Laravel maps it to the correct table

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'zone_name',
        'zone_address_no',
        'zone_address_street',
        'zone_address_city',
        'zone_email',
        'password',
    ];

    /**
     * A zone office has many schools.
     */
    public function schools(): HasMany
    {
        return $this->hasMany(School::class, 'zonal_id');
    }
}
