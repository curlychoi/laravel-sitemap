<?php


namespace Curlychoi\LaravelSitemap\Models;


use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{
    protected $guarded = [];

    public function getLastmodAttribute()
    {
        return $this->updated_at->toIso8601String();
    }
}