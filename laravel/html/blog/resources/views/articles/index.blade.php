@extends('app')
@section('title')
    <title>
        文章列表-爱生活，锲而不舍
    </title>
@stop
@section('content')
    <div class="container">
        <div class="row">

            <h1>Articles </h1>
            @if(\Auth::user())
                <h5>您好！{{\Auth::user()->name}}</h5>
            @endif
            @foreach($articles as $row)
                <h2> <li><a href="{{url('articles',$row->id)}}">{{$row->title}}</a></li></h2>
            @endforeach

            <hr>

        </div>

    </div>

@stop