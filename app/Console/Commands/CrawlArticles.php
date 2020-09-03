<?php

namespace App\Console\Commands;

use App\Category;
use App\Jobs\CrawlArticle;
use Illuminate\Console\Command;

class CrawlArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl vnexpress articles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = Category::all()->pluck('name')->toArray();
        
        $url = config('settings.crawl.rss');
        
        foreach($categories as $key => $category) {
            CrawlArticle::dispatch($url, $category);
        }
    }
}
