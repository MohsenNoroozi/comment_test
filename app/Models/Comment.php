<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'comment_text',
        'parent_id',
    ];

    /**
     * Change created_at format
     *
     * @param $value
     * @return string|null
     */
    public function getCreatedAtAttribute($value): ?string
    {
        return $value ? (new Carbon($value))->diffForHumans() : null;
    }

    /**
     * One level child relationship
     *
     * @return HasMany
     */
    public function child(): HasMany
    {
        return $this->hasMany($this, 'parent_id');
    }

    /**
     * Get all child levels, ordered by the latest
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->child()->latest()->with('children');
    }
}
