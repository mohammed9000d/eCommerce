<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $articles = Article::Search($request)->orderBy('created_at', 'DESC')->get();
        $tags = Tag::get();
        // dd($articles);
        return view('admin.articles.index', [
            'articles'=>$articles,
            'tags'=>$tags
        ]);
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
        $tags = Tag::all();
        return view('admin.articles.create', ['tags'=>$tags]);
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
        $request->validate(Article::rules());
        if ($request->hasFile('image')) {
            $adminImage = $request->file('image');
            $name = time() . '_' . $adminImage->getClientOriginalExtension();
            $adminImage->move('images/articles', $name);
            Article::merge(['image' => $name]);
        }
        Article::create($request->all());
        return redirect()->back()
        ->with('message', 'Created article successfully');

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
        $tags = Tag::all();
        $article = Article::findOrfail($id);
        return view('admin.articles.create', ['article'=>$article, 'tags' => $tags]);
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
        $request->validate(Article::rules());
        if ($request->hasFile('image')) {
            $adminImage = $request->file('image');
            $name = time() . '_' . $adminImage->getClientOriginalExtension();
            $adminImage->move('images/category', $name);
        }
        Article::merge(['image' => $name,]);
        $article = Article::findOrfail($id);
        $article->update($request->all());
        return redirect()->back()
        ->with('message', 'Updated article successfully');
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
        $isDeleted = Article::destroy($id);
        if($isDeleted){
            return response()->json([
                'title'=>'Success',
                'text'=>'Article deleted successfully',
                'icon'=>'success'
            ]);

        }else{
            return response()->json([
                'title'=>'Failed',
                'text'=>'Failed to delete article',
                'icon'=>'error'
            ]);

        }
    }
}
