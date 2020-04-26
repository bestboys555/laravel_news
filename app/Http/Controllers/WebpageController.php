<?php

namespace App\Http\Controllers;

use App\News;
use App\News_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebpageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('home',compact('news'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function news_category($cat_id)
    {
        $category = DB::table('news_category')
        ->where('name', $cat_id)
        ->first();

        $news = DB::table('news')
            ->where('cat_id', $category->id)->latest()
            ->paginate(10);

        return view('category',compact('news','category'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function show($id)
    {
        $news = DB::table('news')
            ->where('id', $id)
            ->first();
        if($news){
            $category = DB::table('news_category')
            ->where('id', $news->cat_id)
            ->first();

            $pictures = DB::table('picture')
            ->where('ref_table_id', $id)
            ->where('is_cover','!=', '1')
            ->orderBy('section_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

            $documents = DB::table('filedocument')
            ->where('ref_table_id', $id)
            ->orderBy('section_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

            return view('readnews',compact('news','category','pictures','documents'));
        }else{
            return abort(404);
        }
    }

    public function search(Request $request)
    {
        $news = DB::table('news')
        ->where('name', 'LIKE', '%'.$request->search.'%')
        ->orWhere('detail', 'LIKE', '%'.$request->search.'%');

        $news = $news->paginate(10);
        return view('home',compact('news'));
    }
}
