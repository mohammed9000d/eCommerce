<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::paginate();
        return view('admin.products.index', ['products' => $products]);
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
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories]);
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
        $request->validate(Product::rules());
        $request->merge([
            'slug' => Str::slug($request->get('name'))
        ]);
        Product::create( $request->all() );
        return redirect()->back()
        ->with('message', 'Created Product Successfully');
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
        $product = product::findOrfail($id);
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories, 'product' => $product]);
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
        $request->validate(Product::rules());
        $request->merge([
            'slug' => Str::slug($request->get('name'))
        ]);
        Product::create( $request->all() );
        return redirect()->route('products.index')
        ->with('success', 'Updated Product Successfully');

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
        $isDeleted = Product::destroy($id);
        if($isDeleted){
            return response()->json([
                'title'=>'Success',
                'text'=>'Product deleted successfully',
                'icon'=>'success'
            ]);

        }else{
            return response()->json([
                'title'=>'Failed',
                'text'=>'Failed to delete product',
                'icon'=>'error'
            ]);
        }
    }
}
