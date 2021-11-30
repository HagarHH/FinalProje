<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(News::with(["comments","user"])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
    {
        $new_news=new News();
        $new_news->user_id = Auth::id();
        $new_news->category_id=$request->category_id;
        $new_news->title=$request->title;
        $new_news->subtitle=$request->subtitle;
        $new_news->article=$request->article;
        $new_news->image=$request->image;
        $new_news->save();
        return response()->json($new_news);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(News::find($id));
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
        $new_news=News::find($id);
        $new_news->user_id = Auth::id();
        $new_news->category_id=$request->category_id;
        $new_news->title=$request->title;
        $new_news->subtitle=$request->subtitle;
        $new_news->article=$request->article;
        $new_news->image=$request->image;
        $new_news->save();
        return response()->json($new_news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $news=News::find($id);
       $news->delete();
       return response()->json("Deleted successfully");
    }
}
