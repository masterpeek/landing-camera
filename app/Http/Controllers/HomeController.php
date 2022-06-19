<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $portfolios = Portfolio::all();

        return view('home', [
            'portfolios' => $portfolios,
            'categories' => $categories
        ]);
    }

    public function category(Category $category)
    {
        $category->products;

        return view('category', [
            'category' => $category
        ]);
    }

    public function product(Product $product)
    {
        return view('product', [
            'product' => $product
        ]);
    }

    public function portfolio(Portfolio $portfolio)
    {
        $portfolio->images;

        return view('portfolio', [
            'portfolio' => $portfolio
        ]);
    }

    public function contact()
    {

        return view('contact');
    }
}
