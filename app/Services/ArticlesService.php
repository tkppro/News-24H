<?php

namespace App\Services;

use App\Article;
use App\Category;

class ArticlesService {
    const THE_GIOI = 12;
    const TIN_MOI_NHAT = 5;
    const THOI_SU = 9;
    const KINH_DOANH = 4;
    const SKIP_PAGINATION = 4;
    const LIMIT = 4;
    const TRENDING = 9;

    public function index()
    {
        $tinmoinhatArticles = $this->getArticlesByCategory('tin-moi-nhat', self::TIN_MOI_NHAT);

        $thegioiArticles = $this->getArticlesByCategory('the-gioi', self::THE_GIOI);

        $thoisuArticles = $this->getArticlesByCategory('thoi-su', self::THOI_SU);

        $suckhoeArticles = $this->getArticlesByCategory('suc-khoe', self::THOI_SU);

        $kinhdoanhArticles = $this->getArticlesByCategory('kinh-doanh', self::KINH_DOANH);

        $categories = Category::all();

        return response()->json([
            'tinmoinhatArticles' => $tinmoinhatArticles,
            'thegioiArticles' => $thegioiArticles,
            'thoisuArticles' => $thoisuArticles,
            'suckhoeArticles' => $suckhoeArticles,
            'kinhdoanhArticles' => $kinhdoanhArticles,
            'categories' => $categories,
        ], 200);
    }

    public function show($articleSlug)
    {
        if ($articleSlug) {
            $article = Article::with('images')->where('slug', 'like', '%' . $articleSlug . '%')->first();
            
            $trendingArticles = Article::where('id', '!=', $article->id)
                                ->whereCategoryId($article->category_id)
                                ->orderBy('publication_date', 'desc')
                                ->take(self::TRENDING)
                                ->get();

            if ($article)
                return response()->json([
                    'article' => $article,
                    'trendingArticles' => $trendingArticles,
                ], 200);
            else
                return response()->json("Cannot find this article!", 404);
        } else
            return response()->json("Cannot find this article!", 404);
    }

    public function getByCategoryPage($categorySlug)
    {
        $result = $this->getArticlesByCategory($categorySlug, self::LIMIT);
        
        if (sizeof($result['articles']) > 0)
            return response()->json($result, 200);
        else
            return response()->json('There are no articles!', 404);
    }

    public function getArticlesByCategory(String $slug, $take, $offset = 0, $sort='publication_date', $orderBy='desc')
    {
        $articles = Category::with(['articles' => function($query) use ($sort, $orderBy, $take, $offset) {
            $query->orderBy($sort, $orderBy)->take($take)->skip($offset * $take);
        }])->where('slug', 'like', '%' . $slug . '%')->firstOrFail()->toArray();

        return $articles;

    }

    public function getByPageNumber($categorySlug, $pageNumber)
    {
        $result = $this->getArticlesByCategory($categorySlug, self::LIMIT, $pageNumber);

        if (sizeof($result['articles']) > 0)
            return response()->json($result, 200);
        else
            return response()->json([''], 200);
    }

}