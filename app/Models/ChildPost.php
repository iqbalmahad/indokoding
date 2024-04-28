<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'slug', 'judul', 'konten', 'tanggal', 'gambar', 'author', 'parent_post_uuid'
    ];

    public function parentPost()
    {
        return $this->belongsToMany(ParentPost::class);
    }
}
