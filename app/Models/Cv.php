<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cv extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'type',
        'full_name',
        'email',
        'phone',
        'address',
        'objective',
        'education',
        'experience',
        'skills',
        'projects',
        'file_path',
    ];

    protected function casts(): array
    {
        return [
            'education' => 'array',
            'experience' => 'array',
            'skills' => 'array',
            'projects' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
