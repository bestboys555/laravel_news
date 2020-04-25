<?php

namespace App\Http\Controllers;

use App\News_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class News_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:category_news-list|category_news-create|category_news-edit|category_news-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category_news-create', ['only' => ['create','store']]);
        $this->middleware('permission:category_news-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category_news-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $news_categorys = News_category::latest()->paginate(10);
        return view('management.category_news.index',compact('news_categorys'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = News_category::pluck('name','name')->all();
        return view('management.category_news.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        News_category::create($request->all());
        return redirect()->route('category_news.index')->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News_category  $news_category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news_category = News_category::find($id);
        return view('management.category_news.show',compact('news_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News_category  $news_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news_category = News_category::find($id);
        return view('management.category_news.edit',compact('news_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News_category  $news_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $news_category = News_category::find($id);
        $news_category->update($request->all());
        return redirect()->route('category_news.index')
                        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News_category  $news_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = DB::table('news')
            ->where('cat_id', $id)->count();
        if($news==0){
            News_category::find($id)->delete();
            return redirect()->route('category_news.index')->with('success','News deleted successfully');
        }else{
            return back()->withErrors(['Have News data use this category can not remove!'])->withInput();
        }
    }
}
