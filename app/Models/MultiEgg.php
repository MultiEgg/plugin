<?php

namespace Pterodactyl\Models;

class MultiEgg extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'multiegg';

    /**
     * Fields that are mass assignable.
     */
    protected $fillable = [
        'updated_at',
        'confirm_key',
        'license_key',
    ];

    public static array $validationRules = [
        'updated_at' => 'required|date',
        'confirm_key' => 'required|string',
        'license_key' => 'required|string',
    ];
}
