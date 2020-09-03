<?php

namespace App\Http\Controllers\API;

use App\Article;
use Illuminate\Http\Request;
use App\Services\ArticlesService;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    private $articleService;

    public function __construct(ArticlesService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $response = $this->articleService->index();

        return $response;
    }

    public function show($article)
    {
        $response = $this->articleService->show($article);

        return $response;
    }

    public function getByCategoryPage($categorySlug)
    {
        $response = $this->articleService->getByCategoryPage($categorySlug);

        return $response;
    }

    public function getByPageNumber($categorySlug, $pageNumber)
    {
        $response = $this->articleService->getByPageNumber($categorySlug, $pageNumber);

        return $response;
    }
}
