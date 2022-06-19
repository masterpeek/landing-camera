<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Helpers\StringGenerator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;

class ProductController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProduct = $request->all();
        $newProduct['slug'] = (new StringGenerator())->generateSlug();

        if ($request->hasFile('base_image')) {
            $file = $request->file('base_image');
            $image = $this->storeImage($file, "");
            $newProduct['image_id'] = $image->id;
        }

        $product = Product::create($newProduct);

        return redirect()->to('/admin/product/' . $product->slug .'/edit');
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
    public function edit(Product $product)
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $updateProduct = $request->all();

        if ($request->hasFile('base_image')) {
            $file = $request->file('base_image');
            $base_image = $this->storeImage($file, '');
            $updateProduct['image_id'] = $base_image->id;
        }

        $product->update($updateProduct);

        return redirect()->to('/admin/product/' . $product->slug .'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        $image = Image::Where('id', '=', $product->image_id)->first();
        $response_delete = $this->deleteImage($image, '');
        $image->delete();

        return redirect()->back()->with('success', 'Product is successfully deleted');
    }
}
