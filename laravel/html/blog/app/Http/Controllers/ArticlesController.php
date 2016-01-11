<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use App\Content;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInfo = \Auth::user();
        $articles = Article::latest()->published()->get();

        return view('articles.index2')->with('articles',$articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::check() == false){
            return redirect('/auth/login');
        }
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateArticleRequest $request)
    {
        #dd($request->all());
        # 接受post过来的数据
        $this->validate($request,['title'=>'required','content'=>'required']);
        $input = $request->except('_token');
        # 存入数据库
        #$input['publish_date'] = time();
        $dataObj = Article::create($input);
        $contentInsert = array();
        # 新创建的文章id
        $contentInsert['article_id'] = $mainId = $dataObj->id;
        $contentInsert['content'] = $input['content'];
        $res1 = Content::create($contentInsert);
        #dd($res1);
        Article::create($contentInsert);



        #重定向
        #return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Article::findOrFail($id);
        $data->content = Article::find($id)->hasOneContent->content;
        #dd($data->created_at->diffForHumans());
        return view('articles.show2',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {	
    	$articles = Article::findOrFail($id);
    	#dd($articles);
        return view('articles.edit',compact('articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateArticleRequest $request, $id)
    {
        $articles = Article::findOrFail($id);
        $articles->update($request->all());
        return redirect('/articles/');
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
    }
}
