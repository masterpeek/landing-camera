<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Traits\ImageTrait;
use App\Helpers\StringGenerator;
use App\Models\Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = $request->all();
        $newCategory['slug'] = (new StringGenerator())->generateSlug();

        if ($request->hasFile('base_image')) {
            $file = $request->file('base_image');
            $image = $this->storeImage($file, "");
            $newCategory['image_id'] = $image->id;
        }

        $category = Category::create($newCategory);

        return redirect()->to('/admin/category/' . $category->slug .'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $products = Product::Where('category_id', '=', $category->id)->get();

        return view('admin.category.show', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $updateCategory = $request->all();

        if ($request->hasFile('base_image')) {
            $file = $request->file('base_image');
            $product_image = $this->storeImage($file, '');
            $updateCategory['image_id'] = $product_image->id;
        }

        $category->update($updateCategory);

        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $image = Image::Where('id', '=', $category->image_id)->first();
        $response_delete = $this->deleteImage($image, '');
        $image->delete();

        return redirect()->back()->with('success', 'Category is successfully deleted');
    }
}
