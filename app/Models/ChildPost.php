<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'judul', 'konten', 'tanggal', 'gambar', 'author', 'parent_post_uuid'
    ];

    public function parentpost()
    {
        return $this->belongsTo(Parentpost::class, 'parent_post_uuid', 'uuid');
    }
}
