<?php

namespace App\Actions;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class CreateArticle
{
    /**
     * Handle an authentication attempt.
     */
    public function handle(Array $data){
        // dd($data);
        return Article::create([
            'title' => $data['title'],
            'source' => $data['source'],
            'author' => $data['author'],
            'summary' => $data['summary'],
            'url' => $data['url'],
            'img_url' => $data['img_url'],
            'publishedAt' => $data['publishedAt'],
            'category' => $data['category'],
        ]);
    }
}
