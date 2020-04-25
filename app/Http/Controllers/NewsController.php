<?php

namespace App\Http\Controllers;

use App\News;
use App\News_category;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use File;
use Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $photos_path;

    public function __construct()
    {
        $this->middleware('permission:news-list|news-create|news-edit|news-delete', ['only' => ['index','show']]);
        $this->middleware('permission:news-create', ['only' => ['create','store']]);
        $this->middleware('permission:news-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
        $this->photos_path = public_path('/images/news');
    }

    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('management.news.index',compact('news'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function category($cat_id)
    {
        $news = DB::table('news')
            ->where('cat_id', $cat_id)->latest()
            ->paginate(10);

        $category = DB::table('news_category')
            ->where('id', $cat_id)
            ->get();

        return view('management.news.index',compact('news','category'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = News_category::pluck('name','id')->all();
        return view('management.news.create',compact('category'));
    }

    public function create_ref($ref_id)
    {
        $category = News_category::pluck('name','id')->all();
        return view('management.news.create',compact('category','ref_id'));
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
            'cat_id' => 'required',
            'detail' => 'required',
        ],
        [
            'cat_id.required' => 'The Category select is required'
        ]);

        $data = News::create($request->all()); // save news
        // update picture
        $tmp_key = Session::get('pic_news');

        $picture_select = DB::table('picture')
            ->where('tmp_key', $tmp_key)
            ->orderBy('id', 'asc')
            ->get();

        foreach ($picture_select as $picture_value) {
            $picture_id=$picture_value->id;
            $folder=$picture_value->folder;
            $pic_name=$picture_value->name;
            $pic_thumb_name=$picture_value->name_thumb;

            $old_directory_pic=$this->photos_path."/".$folder."/".$pic_name;
            $old_directory_pic_thumb=$this->photos_path."/".$folder."/".$pic_thumb_name;

            $new_directory_pic=$this->photos_path."/".$data->id."/".$pic_name;
            $new_directory_pic_thumb=$this->photos_path."/".$data->id."/".$pic_thumb_name;

            $directory_save=$this->photos_path."/".$data->id;
            if (!is_dir($directory_save)) {
                mkdir($directory_save, 0777);
            }

            if (file_exists($old_directory_pic)) {
            File::move($old_directory_pic, $new_directory_pic);
            }
            if (file_exists($old_directory_pic_thumb)) {
            File::move($old_directory_pic_thumb, $new_directory_pic_thumb);
            }

            $result = collect($request->picture)
            ->firstWhere('id', $picture_id);
            $title_save = $result['title'];
            DB::table('picture')
            ->where('id', $picture_id)
            ->update(['title' => $title_save, 'ref_table_id' => $data->id, 'tmp_key' => '', 'folder' => $data->id]);

        }
        // update picture
        Session::forget('pic_news');
        //
        if(isset($request->ref_id)){
            return redirect()->route('news.category', ['id' => $request->ref_id])
            ->with('success','News created successfully');
        }else{
            return redirect()->route('news.index')->with('success','News created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $News
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $News
     * @return \Illuminate\Http\Response
     */

    public function edit_ref($id, $ref_id)
    {
        $news = News::find($id);
        $category = News_category::pluck('name','id')->all();
        return view('management.news.edit',compact('news','category','ref_id'));
    }

    public function edit(News $news)
    {
        $category = News_category::pluck('name','id')->all();
        return view('management.news.edit',compact('news','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'name' => 'required',
            'cat_id' => 'required',
            'detail' => 'required',
        ],
        [
            'cat_id.required' => 'The Category select is required'
        ]);

        // update picture
        $picture_select = DB::table('picture')
            ->where('ref_table_id', $news->id)
            ->orderBy('id', 'asc')
            ->get();

        foreach ($picture_select as $picture_value) {
            $picture_id=$picture_value->id;
            $result = collect($request->picture)
            ->firstWhere('id', $picture_id);
            $title_save = $result['title'];
            DB::table('picture')
            ->where('id', $picture_id)
            ->update(['title' => $title_save]);
        }
        // update picture

        $news->update($request->all());

        if(isset($request->ref_id)){
            return redirect()->route('news.category', ['id' => $request->ref_id])
            ->with('success','News updated successfully');
        }else{
            return redirect()->route('news.index')
            ->with('success','News updated successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $News
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('management.news.show',compact('news'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */

    public function destroy(News $news)
    {
        // del pic
        $news_id=$news->id;
        $directory_save=$this->photos_path."/".$news_id;
        if (is_dir($directory_save)) {
            File::deleteDirectory($directory_save);
        }
        DB::table('picture')->where('ref_table_id', $news_id)->delete();
        // del pic
        $news->delete();

        return redirect()->route('news.index')->with('success','News deleted successfully');
    }

    public function upload_pic(Request $request)
    {
        $this->gen_session_file();
        $tmp_key="";

        $ref_table_id=$request->ref_table_id;
        $picture_title=$request->picture_title;
        $this->validate($request,[
            'pic_file' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photos = $request->file('pic_file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        if($ref_table_id!=""){
            $folder_save=$ref_table_id;
            $directory_save=$this->photos_path."/".$folder_save;

            $picture_select = DB::table('picture')
            ->where('ref_table_id', $ref_table_id)
            ->where('is_cover', '1')
            ->count();
        }else{
            $directory_save=$this->photos_path."/tmp";
            $folder_save="tmp";
            $tmp_key=Session::get('pic_news');

            $picture_select = DB::table('picture')
            ->where('tmp_key', $tmp_key)
            ->where('is_cover', '1')
            ->count();
        }

        if (!is_dir($directory_save)) {
            mkdir($directory_save, 0777);
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];

            $name = sha1(date('YmdHis') . Str::random(30));
            $resize_name = $name . Str::random(2) . '.' . $photo->getClientOriginalExtension();
            $thumb_name = 'thumb_'. $resize_name;

            Image::make($photo)
                ->resize(600, null, function ($constraints) { $constraints->aspectRatio();})
                ->save($directory_save . '/' . $resize_name);

            Image::make($photo)
                ->resize(362, null, function ($constraints) {
                    $constraints->aspectRatio();
                })
                ->fit(362, 200)
                ->save($directory_save . '/' . $thumb_name);

            $is_cover="0";
            if($picture_select==0){
                $is_cover="1";
            }

            Picture::create([
                'name' => $resize_name,
                'name_thumb' => $thumb_name,
                'title' => $picture_title,
                'folder' => $folder_save,
                'table_name' => 'news',
                'ref_table_id' => $ref_table_id,
                'is_cover' => $is_cover,
                'tmp_key' => $tmp_key,
            ]);
        }
        return Response::json([
            'message' => 'success'
        ], 200);
    }

    public function show_pic(Request $request)
    {
        $ref_table_id=$request->ref_table_id;
        if($ref_table_id!=""){
            $folder_save=$ref_table_id;
            $directory_save=$this->photos_path."/".$folder_save;
            $directory_show='/images/news/' . $folder_save;

            $picture_select = DB::table('picture')
            ->where('ref_table_id', $ref_table_id)
            ->orderBy('id', 'asc')
            ->get();
        }else{
            $directory_save=$this->photos_path."/tmp";
            $directory_show='/images/news/tmp';
            $folder_save="tmp";
            $tmp_key=Session::get('pic_news');

            $picture_select = DB::table('picture')
            ->where('tmp_key', $tmp_key)
            ->orderBy('id', 'asc')
            ->get();
        }
        $i_pic=0;
        $html="";
        foreach ($picture_select as $picture_value) {

            $picture_id=$picture_value->id;
            $picture_name=$picture_value->name_thumb;
            $picture_title=$picture_value->title;
            $is_cover=$picture_value->is_cover;
            $picture_folder=$picture_value->folder;
            $show_pic_url="";
            if (file_exists($directory_save."/". $picture_name)) {
                $show_pic_url=$directory_show."/". $picture_name;
            }

            $html.="<div class='col-lg-2 col-md-3 col-sm-3 padleft0 mb-3' id='recordsArray_".$picture_id."'>";
            if($is_cover=="1"){
           $html.="<div class='paperclip'><div class='paperclip-inner'><span class='paperclip-label'><i class='ik ik-star-on'></i><br />Cover</span></div></div>";
               }
           $html.="<div class='photoitem thumbnail l-image ";
           if($is_cover=="yes"){$html.="cover";}
           $html.="' style='min-height:170px'>";
           $html.="<a data-toggle='lightbox' data-gallery='multiimages' data-title='".$picture_title."'><img src='".$show_pic_url."' alt='' class='img-thumbnail' style='width:100%'></a>
           <div class='action' id='action'>
           <div class='col group_text_edit'>
       <input name='picture[".$i_pic."][id]' id='pic_".$i_pic."' type='hidden' value='".$picture_id."'><input name='picture[".$i_pic."][title]' type='text' id='alt_".$i_pic."' value='".$picture_title."' class='form-control'></div><div class='group_pic_edit'>";
           if($is_cover=="0"){
           $html.="<a href='#' id='".$picture_id."' class='stcover btn btn-warning' route-data='".route('news.setcover_pic')."'><i class='ik ik-star-on'></i>Set Cover</a> ";
             }
           $html.=" <a href='#' id='".$picture_id."' class='stdelete btn btn-icon btn-danger' route-data='".route('news.delete_pic')."'><i class='ik ik-trash-2'></i></a></div></div></div></div>";

            $i_pic++;
        }

        return Response::json([
            'html_data' => $html
        ], 200);
    }

    public function delete_pic(Request $request)
    {
        if(isset($request->picture_id))
        {
            $picture_id=$request->picture_id;
            $picture_select = DB::table('picture')
            ->where('id', $picture_id)
            ->get();

            $picture_name=$picture_select[0]->name;
            $picture_thumb_name=$picture_select[0]->name_thumb;
            $picture_folder= $picture_select[0]->folder;
            $is_cover= $picture_select[0]->is_cover;
            $ref_table_id= $picture_select[0]->ref_table_id;
            $tmp_key= $picture_select[0]->tmp_key;

            $directory_save=$this->photos_path."/".$picture_folder;

            if (file_exists($directory_save."/". $picture_name)) {
                unlink($directory_save."/". $picture_name);
            }
            if (file_exists($directory_save."/". $picture_thumb_name)) {
                unlink($directory_save."/". $picture_thumb_name);
            }

            if($is_cover=='1'){
                if($ref_table_id!="" or $ref_table_id!=null){
                    $picture_cover_select = DB::table('picture')
                    ->where('ref_table_id', $ref_table_id)
                    ->where('id', '!=' , $picture_id)
                    ->orderBy('id', 'asc')
                    ->limit(1)
                    ->get();
                }else{
                    $picture_cover_select = DB::table('picture')
                    ->where('tmp_key', $tmp_key)
                    ->where('id', '!=' , $picture_id)
                    ->orderBy('id', 'asc')
                    ->limit(1)
                    ->get();
                }

                if(isset($picture_cover_select[0]->id)){
                    $id_update_cover=$picture_cover_select[0]->id;
                    DB::table('picture')
                    ->where('id', $id_update_cover)
                    ->update(['is_cover' => '1']);
                }
            }

            DB::table('picture')->where('id', $picture_id)->delete();

            return Response::json([
                'message' => 'success'
            ], 200);
        }
    }

    public function setcover_pic(Request $request)
    {
        if(isset($request->picture_id))
        {
            $picture_id=$request->picture_id;
            $picture_select = DB::table('picture')
            ->where('id', $picture_id)
            ->get();

            $id_update_cover=$picture_select[0]->id;
            $ref_table_id= $picture_select[0]->ref_table_id;
            $tmp_key= $picture_select[0]->tmp_key;

                DB::table('picture')
                ->where('id', $id_update_cover)
                ->update(['is_cover' => '1']);

            if($ref_table_id!="" or $ref_table_id!=null){
                DB::table('picture')
                ->where('ref_table_id', $ref_table_id)
                ->where('id', '!=' , $id_update_cover)
                ->update(['is_cover' => '0']);
            }else{
                DB::table('picture')
                ->where('tmp_key', $tmp_key)
                ->where('id', '!=' , $id_update_cover)
                ->update(['is_cover' => '0']);
            }

            return Response::json([
                'message' => 'success'
            ], 200);
        }
    }

    function gen_session_file(){
        if (!Session::has('pic_news'))
        {
        Session::put('pic_news', sha1(date('YmdHis') . Str::random(30)));
        }
        Session::save();
    }

    function destroy_session_file(){
        Session::forget('pic_news');
    }
}
