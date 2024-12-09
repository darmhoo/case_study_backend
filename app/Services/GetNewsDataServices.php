<?php

namespace App\Services;

use App\Actions\CreateArticle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class GetNewsDataServices
{
    private $createArticle;

    public function __construct()
    {
        $this->createArticle = new CreateArticle();
    }

    public function newsApiOrg()
    {
        try {
            //code...
            $response = Http::get('https://newsapi.org/v2/top-headlines?country=us&apiKey=' . env('NEWS_API_KEY'));
            $data = $response->json();
            $dataToMap = $data['articles'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => $d['author'],
                    'source' => $d['source']['name'],
                    'summary' => $d['content'],
                    'img_url' => $d['urlToImage'],
                    'url' => $d['url'],
                    'publishedAt' => Carbon::parse($d['publishedAt'])->toDateString(),
                    'category' => 'general',
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    public function newYorkTimes()
    {

        try {
            //code...

            $response = Http::get('https://api.nytimes.com/svc/topstories/v2/us.json?api-key=' . env('NYT_API_KEY'));
            $data = $response->json();
            $dataToMap = $data['results'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => str_replace('By ', '',$d['byline']),
                    'source' => 'New York Times',
                    'summary' => $d['abstract'],
                    'img_url' => $d['multimedia'][1]['url'],
                    'url' => $d['url'],
                    'publishedAt' => Carbon::parse($d['published_date'])->toDateString(),
                    'category' => $d['subsection'],
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function bbcNews()
    {
        try {
            //code...

            $response = Http::get('https://bbc-api.vercel.app/news?lang=english');
            $data = $response->json();
            $dataToMap = $data['Analysis'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => 'bbc',
                    'source' => 'BBC',
                    'summary' => $d['summary'],
                    'img_url' => $d['image_link'],
                    'url' => $d['news_link'],
                    'publishedAt' => Carbon::now()->toDateString(),
                    'category' => 'analysis',
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }


            $dataToMap = $data['Innovation'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => 'bbc',
                    'source' => 'BBC',
                    'summary' => $d['summary'],
                    'img_url' => $d['image_link'],
                    'url' => $d['news_link'],
                    'publishedAt' => Carbon::now()->toDateString(),
                    'category' => 'innovation',
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }

            $dataToMap = $data['More world news'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => 'bbc',
                    'source' => 'BBC',
                    'summary' => $d['summary'],
                    'img_url' => $d['image_link'],
                    'url' => $d['news_link'],
                    'publishedAt' => Carbon::now()->toDateString(),
                    'category' => 'world news',
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }

            $dataToMap = $data['Sport'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => 'bbc',
                    'source' => 'BBC',
                    'summary' => $d['summary'],
                    'img_url' => $d['image_link'],
                    'url' => $d['news_link'],
                    'publishedAt' => Carbon::now()->toDateString(),
                    'category' => 'sport',
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }

            $dataToMap = $data['Business'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => 'bbc',
                    'source' => 'BBC',
                    'summary' => $d['summary'],
                    'img_url' => $d['image_link'],
                    'url' => $d['news_link'],
                    'publishedAt' => Carbon::now()->toDateString(),
                    'category' => 'business',
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }

            $dataToMap = $data['Tech'];
            foreach ($dataToMap as $d) {
                $dummy = [
                    'author' => 'bbc',
                    'source' => 'BBC',
                    'summary' => $d['summary'],
                    'img_url' => $d['image_link'],
                    'url' => $d['news_link'],
                    'publishedAt' => Carbon::now()->toDateString(),
                    'category' => 'tech',
                    'title' => $d['title'],
                ];
                $this->createArticle->handle($dummy);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }
}
