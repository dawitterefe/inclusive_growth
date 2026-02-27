<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'posted_by', 'expiry_date', 'category'];

    protected function casts(): array
    {
        return [
            'expiry_date' => 'datetime',
        ];
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(AnnouncementAttachment::class);
    }

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expiry_date')->orWhere('expiry_date', '>', now());
        });
    }
}
