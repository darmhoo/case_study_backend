<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $guarded = [];

    public function scopeFilter($query)
    {
        if (request('category')) {
            $query->where('category', request('category'));
        }

        if (request('source')) {
            $query->where('source', request('source'));
        }

        if (request('date')) {
            $query->where('publishedAt', request('date'));
        }

        if (request('keyword')) {
            $query->where('title', 'like', '%' . request('keyword') . '%');
        }
    }
}
