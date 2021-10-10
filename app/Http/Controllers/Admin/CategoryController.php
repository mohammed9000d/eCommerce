<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate();
        return view('admin.categories.index', ['categories' => $categories]);
        session()->get('message');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(Category::rules());
        $request->merge([
            'slug' => Str::slug($request->get('name'))
        ]);
        Category::create($request->all());
        return redirect()->back()
        ->with('message', 'Created Category Successfully');
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
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(Category::rules());
        $request->merge([
            'slug' => Str::slug($request->get('name'))
        ]);
        $category = Category::findOrfail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')
        ->with('message', 'Updated Category Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDeleted = Category::destroy($id);
        if($isDeleted){
            return response()->json([
                'title'=>'Success',
                'text'=>'Category deleted successfully',
                'icon'=>'success'
            ]);

        }else{
            return response()->json([
                'title'=>'Failed',
                'text'=>'Failed to delete category',
                'icon'=>'error'
            ]);

        }
    }
}
