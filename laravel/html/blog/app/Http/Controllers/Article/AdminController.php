<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 一页多少文章
        $pageNum = 10;
        $userInfo = \Auth::user();
        $data = array();
        $data['articles'] = \App\Article::latest()->get();
        $data['userInfo'] = $userInfo;
        $dataArticles = array();

        $cacheKey = 'laravel:articles:index';
        $redis = new \Predis\Client(array(
            'host' => '127.0.0.1',
            'port' => 6379,
        ));
        $dataArticles = $redis->get($cacheKey);
        if(!$dataArticles || true){
            //$dataArticles = \App\Article::latest()->take($pageNum)->with('content')->get()->toArray();
            $dataArticles = \App\Article::latest()->with('content')->paginate($pageNum)->toArray();
            //var_dump($dataArticles);exit();
            $redis->set($cacheKey,serialize($dataArticles));
        }else{
            $dataArticles = unserialize($dataArticles);
        }

        $data['articles'] = $dataArticles;

        //var_dump($data);exit();
        //dd($data['articles']);
        // $articleArr[0]['relations']['content']['content']

        return view('articles.admin.articleList')->with('data',$data);
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
        //
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
