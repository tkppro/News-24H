<?php

namespace App\Jobs;

use App\Image;
use App\Article;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CrawlArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;

    private $category;

    const COUNT_TAG_REMOVE = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $category)
    {
        $this->url = $url;
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $categoryRSS = $this->url . Str::slug($this->category, '-') . '.rss';
        
        $lines_array = file($categoryRSS);
        $lines_string = implode('',$lines_array);
        $articles = [];
        
        $xml = simplexml_load_string($lines_string, null, LIBXML_NOCDATA);        
        if ($xml === false) {
            echo "Failed loading XML: ";
            foreach(libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        } else {
            $con = json_encode($xml);           
            // Convert into associative array 
            $newArr = json_decode($con, true);       
            foreach ($newArr['channel']['item'] as $key1 => $item) {     
                if ($key1 < config('settings.crawl.limit_article')) {
                    $article = [];
                    $article['title'] = $item['title'];
                    $article['slug'] = Str::slug($item['title']);
                    $article['category'] = Str::slug($this->category, '-');
                    //extract description
                    $countTagRemove = 0;
                    if (strpos($item['description'], '</br>')) {
                        $countTagRemove = self::COUNT_TAG_REMOVE;
                    }

                    $explodeStringDescription = explode('>', $item['description']);
                    if (isset($explodeStringDescription[1])) {
                        $article['front_image'] = strval(trim(str_replace('"', '', substr($explodeStringDescription[1], (strpos($explodeStringDescription[1], 'https'))))));
                    }
                    $article['description'] = substr($item['description'], (strpos($item['description'], '</br>')) + $countTagRemove);
                    $article['link'] = $item['link'];  
                    //extract and convert to DATETIME
                    $date = explode(', ', $item['pubDate']);
                    $article['publication_date'] = Carbon::createFromDate($date[1])->toDateTimeString();
                    $article['detail'] = $this->getDetailArticle($item['link']);
                    $saveArticle = $this->saveArticle($article);
                    
                    array_push($articles, $article);    
                }
            }
        }  
    }

    public function getDetailArticle($articleURL) 
    {
        $result = [];
        if (!$articleURL)
            return $result;

        $html = file_get_html($articleURL, false, null, 0);
        $content = $html->find('.Normal');
        $text = [];
        $images = [];

        $divImgs = $html->find('.fck_detail .tplCaption');

        foreach($divImgs as $img) {
            $url = '';
            if ($img->find('.fig-picture img', 0)) {          
                $attr = $img->find('.fig-picture img', 0)->getAllAttributes();
                if (array_key_exists('data-src', $attr)) {          
                    $url = $img->find('.fig-picture img', 0)->getAttribute('data-src') ?? null;
                } else {
                    $url = $img->find('.fig-picture img', 0)->getAttribute('src') ?? null;
                }

                array_push($images, [
                    'url' => $url,
                    'caption' => $img->find('figcaption p', 0)->plaintext ?? null,
                ]);
            }
        }
        
        $result['author'] = $this->getAuthorFromArticle($html);
       
        foreach($content as $k => $v) {    
            if ($result['author'] && strpos($v->plaintext, $result['author']) !== false)
                continue;
            array_push($text, $v->plaintext ?? null);
        }

        $result['content'] = json_encode($text);
        $result['images'] = $images;
        
        return $result;
    }

    public function getAuthorFromArticle($html)
    {
        if (!$html) {
            return $html;
        }

        if ($html->find('.author_mail', 0)) {
            return $html->find('.author_mail', 0)->plaintext ?? null;
        }

        if ($html->find('.Normal strong', -1)) {
            return $html->find('.Normal strong', -1)->plaintext ?? null;
        }
    }

    public function saveArticle($data)
    {
        if (!$data) 
            return false;

        $category = Category::where('slug', 'like', '%' . $data['category'] . '%')->first();
        $article = Article::where('title', 'like', '%' . $data['title'] . '%')
                            ->where('category_id', '=', $category->id)
                            ->first();

        if ($article)
            return false;

        DB::beginTransaction();

        try {
            
            $createdArticle = Article::create([
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'description' => $data['description'],
                    'content' => $data['detail']['content'],
                    'author' => $data['detail']['author'],
                    'link' => $data['link'],
                    'publication_date' => $data['publication_date'],
                    'category_id' => $category->id,
                    'front_image' => $data['front_image'],
                ]);
            
            if (!empty($data['detail']['images'])) {
                foreach($data['detail']['images'] as $k => $v)
                    if(!$this->checkIfImageExists($createdArticle->id, $v['url'], $v['caption']))
                        Image::create([
                            'article_id' => $createdArticle->id,
                            'url' => $v['url'],
                            'caption' => $v['caption'],
                        ]);
            }
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
            
    }
    
    public function checkIfImageExists($id, $url='', $caption='')
    {
        if ($id && $url && $caption) {
            return false;
        }

        $image = Image::where('article_id', $id)
                        ->where('url', 'like', '%' . $url . '%')
                        ->where('caption', 'like', '%' . $caption . '%')
                        ->first();
        if($image)
            return true;
        else
            return false;  
    }
}
