<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'category',
        'status',
        'image',
    ];

    protected static function booted(): void
    {
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . uniqid();
            }
        });
    }

    // Excerpt otomatis kalau kosong
    public function getExcerptAttribute($value)
    {
        return $value ?: Str::limit(strip_tags($this->body), 150);
    }

    // Badge status
    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'published'
            ? 'bg-green-500/10 text-green-400 border-green-500/30'
            : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/30';
    }

    // URL gambar: support upload lokal & URL eksternal
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        // Kalau image adalah URL (http:// atau https://)
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        // Kalau file lokal di storage
        return Storage::url($this->image);
    }
}