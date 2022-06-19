<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
		'slug',
		'name',
        'description',
        'facebook_link',
		'youtube_link',
        'instagram_link',
        'tiktok_link',
        'image_id'
	];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'portfolio_images', 'portfolio_id', 'image_id');
    }
}
