<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'importance',
        'theme',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): HasMany
    {
        return $this->hasMany(Tasks::class);
    }
}
