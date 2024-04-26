<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'slug',
        'judul',
        'category_id',
    ];

    // Jangan lupa melakukan relasi ini
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function childposts()
    {
        return $this->hasMany(Childpost::class, 'parent_post_uuid', 'uuid');
    }
}
