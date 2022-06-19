<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\Image;
use App\Traits\ImageTrait;
use App\Helpers\StringGenerator;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::all();

        return view('admin.portfolio.index', [
            'portfolios' => $portfolios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPortfolio = $request->all();

        $newPortfolio['slug'] = (new StringGenerator())->generateSlug();

        if ($request->hasFile('base_image')) {
            $file = $request->file('base_image');
            $image = $this->storeImage($file, "");
            $newPortfolio['image_id'] = $image->id;
        }

        $portfolio = Portfolio::create($newPortfolio);

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $image = $this->storeImage($file, "");
                $portfolio_image = [
					'portfolio_id' => intval($portfolio->id),
					'image_id' => intval($image->id)
				];
				PortfolioImage::create($portfolio_image);
            }
        }

        return redirect()->to('/admin/portfolio/' . $portfolio->slug .'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $portfolio->images;

        return view('admin.portfolio.edit', [
            'portfolio' => $portfolio
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $updatePortfolio = $request->all();

        if ($request->hasFile('base_image')) {
            $file = $request->file('base_image');
            $image = $this->storeImage($file, "");
            $updatePortfolio['image_id'] = $image->id;
        }

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $image = $this->storeImage($file, "");
                $portfolio_image = [
					'portfolio_id' => intval($portfolio->id),
					'image_id' => intval($image->id)
				];
				PortfolioImage::create($portfolio_image);
            }
        }

        $portfolio->update($updatePortfolio);

        return redirect()->to('/admin/portfolio/' . $portfolio->slug .'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        $image = Image::Where('id', '=', $portfolio->image_id)->first();
        $response_delete = $this->deleteImage($image, '');

        $portfolio_images = PortfolioImage::Where('portfolio_id', '=', $portfolio->id)->get();
        foreach ($portfolio_images as $portfolio_image) {
            $portfolio_image->delete();
        }

        return redirect()->back()->with('success', 'Portfolio is successfully deleted');
    }

    public function destroyImage(Request $request, Portfolio $portfolio)
    {
        $allRequest = $request->all();

        $image_slug = $allRequest['image_slug'];
        $image = Image::Where('slug', '=', $image_slug)->first();

        $portfolio_image = PortfolioImage::Where('portfolio_id', '=', $portfolio->id)
                                        ->where('image_id', '=', $image->id)->first();
        $portfolio_image->delete();

        $response_delete = $this->deleteImage($image, '');
        $image->delete();

        return redirect()->to('/admin/portfolio/' . $portfolio->slug .'/edit')->with('success', 'Portfolio Image is successfully deleted');
    }
}
