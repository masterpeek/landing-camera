<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageTrait;
use App\Helpers\StringGenerator;
use App\Models\Admin;
use App\Models\Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();

        return view('admin.index', [
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newAdmin = $request->all();

        $newAdmin['slug'] = (new StringGenerator())->generateSlug();
        $newAdmin['password'] = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $this->storeImage($file);
            $newAdmin['image_id'] = $image->id;
        }

        $admin = Admin::create($newAdmin);

        return redirect()->to('admin/' . $admin->slug .'/edit');
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
    public function edit(Admin $admin)
    {
        return view('admin.edit', [
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $updateAdmin = $request->all();

        if ($request->has('password') && $request->filled('password')) {
            $updateAdmin['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $this->storeImage($file);
            $updateAdmin['image_id'] = $image->id;
        }

        $admin->update($updateAdmin);

        return view('admin.edit', [
            'admin' => $admin
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        $image = Image::Where('id', '=', $admin->image_id)->first();
        $response_delete = $this->deleteImage($image, '');
        $image->delete();

        return redirect()->back()->with('success', 'Admin is successfully deleted');
    }
}
