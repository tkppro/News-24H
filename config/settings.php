<?php

return [    
    'crawl' => [
        'cron' => env('CRAWL_ARTICLES', "0 * * * *"),
        'rss' => 'https://vnexpress.net/rss/',
        'limit_article' => 5,
    ]
];