<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use App\Content;
use Carbon\Carbon;
use App\Model;
use App;

use Predis\Client;

class ArticlesController extends Controller
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
        $data['articles'] = Article::latest()->published()->get();
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
            //$redis->set($cacheKey,serialize($dataArticles));
        }else{
            $dataArticles = unserialize($dataArticles);
        }
        
        $data['articles'] = $dataArticles;

        //var_dump($data);exit();
        //dd($data['articles']);
        // $articleArr[0]['relations']['content']['content']

        return view('articles.index')->with('data',$data);
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
        $insertId = Article::create($input)->id;
        $contentInsert = array();
        # 新创建的文章id
        $contentInsert['article_id'] = $insertId;
        $contentInsert['content'] = $input['content'];
        $res1 = Content::create($contentInsert);
        #dd($res1);
        #Article::create($contentInsert);

        #重定向
        return redirect('/articles');
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
        if(\Auth::check() == false){
            return redirect('/auth/login');
        }
    	$articles = Article::findOrFail($id);
        $articles->content = Article::find($id)->hasOneContent->content;
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
        if(\Auth::check() == false){
            return redirect('/auth/login');
        }
        $articles = Article::findOrFail($id)->update(['publish_date'=>time(),]);
        #$articles->update($request->all());
        // 更新到content表中
        $contentArr = ['article_id'=>$id,'content'=>$request->content,];
        //dd($contentArr);
        $content = Content::where('article_id',$id)->update($contentArr);
        //dd($content);
        #$content->update($contentArr);

        return redirect('/articles/');
    }
    // 分词搜索
    public function search($keyword){
        //$keyword = '服务器'; 
        //header("content-type:text/html;charset=utf-8");
        // include('/home/tmp/tool/coreseek-3.2.14/csft-3.2.14/api/sphinxapi.php');
        $s = new \SphinxClient;
        $s->setServer("localhost", 9312);
        $s->setArrayResult(true); 
        // $s->setSelect();
        $s->setMatchMode(SPH_MATCH_ALL);
        $result = array();
        if($keyword){
            $result = $s->query($keyword, 'test1');
            // 获取检索到的文章id 
            $idArr = array();
            $data = $titleArr = array();
            if(isset($result['matches']) && is_array($result['matches'])){
                foreach ($result['matches'] as $k=>$v){
                    $idArr[] = $v['attrs']['article_id'];
                }
                $idStr = implode(',',$idArr);
                // 查找文章 
                $data['articles'] = \DB::table('articles')->whereRaw('id in ('.$idStr.')')->get();
                if($data['articles']){
                    foreach($data['articles'] as $k=>$v){
                        $titleArr[] = $v->title;
                    }
                }
            }else{
                echo '没有查询到任何线索！';
                return;
            }
            
            var_dump($titleArr,$result);
        }else{
            echo '请输入要查询的关键词~';
            return;
        }
        if(!$result){
            echo '没有查询到任何线索！';
            return;
        }
        
        echo "\n<br>";
        var_dump(rand(1000,9999));
        return '';
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

    public function test1(){
        return view('articles/admin/public/siderbar');
    }
}