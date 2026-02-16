<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lesson';

    public $timestamps = false;

    protected $fillable =
    [
        'id',
        'admin_id',
        'category_id',
        'name',
        'thumbnail',
        'description',
        'link',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getEmbedLinkAttribute()
    {
        try {
            $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
            $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

            if (preg_match($longUrlRegex, $this->link, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }

            if (preg_match($shortUrlRegex, $this->link, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }

            return 'https://www.youtube.com/embed/' . $youtube_id ;
        } catch (Exception $e) {
            return $this->link;
        }
    }
}
