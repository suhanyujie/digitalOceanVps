<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo 'This is SitesCroller~';
    }
    /**
     * 测试用的about方法
     */
    public function about(){
        echo 'This is SitesController @ about~';
        $name = 'Samuel Su';
        $data = [];
        $param1 = 'param1';
        $param2 = 'param2';
        return view('sites.about',compact('param1','param2'))->with([
            'first'=>'Wangliguo',
            'second'=>'Fujunyao',
            'third'=>'Xujingzhong',
            'name'=>'Suhanyu'
        ]);
    }
    /**
     * 测试方法：contact
     */
    public function contact(){
        $people = ['Suhanyu','Huyiping','Fujunyao'];
        return view('sites.contact',compact('people'));
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
