<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'medium_acquisition',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
