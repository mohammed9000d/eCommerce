<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::paginate();
        return view('admin.tags.index', ['tags' => $tags]);
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
        return view('admin.tags.create');
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
        $request->validate(Tag::rules());
        $request->merge([
            'slug' => Str::slug($request->get('name')),
            'status' => $request->has('status')? 'Active' : 'InActive'
        ]);
        Tag::create($request->all());
        return redirect()->back()
        ->with('message', 'Created Tag Successfully');
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
        $tag = Tag::findOrfail($id);
        return view('admin.tags.edit', ['tag'=>$tag]);
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
        $request->validate(Tag::rules());
        $request->merge([
            'slug' => Str::slug($request->get('name')),
            'status' => $request->has('status')? 'Active' : 'InActive'
        ]);
        $tag = Tag::findOrfail($id);
        $tag->update($request->all());
        return redirect()->route('tags.index')
        ->with('success', 'Created Tag Successfully');
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
        $isDeleted = Tag::destroy($id);
        if($isDeleted){
            return response()->json([
                'title'=>'Success',
                'text'=>'Tag deleted successfully',
                'icon'=>'success'
            ]);

        }else{
            return response()->json([
                'title'=>'Failed',
                'text'=>'Failed to delete tag',
                'icon'=>'error'
            ]);

        }
    }
}
