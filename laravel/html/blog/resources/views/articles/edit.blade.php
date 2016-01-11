@extends('app')
@section('content')

    <div class="container">
        <h1> 编辑文章 </h1>
        <div class="row" style="margin-top:50px;">
           {!! Form::model($articles,['method'=>'PATCH','url'=>'/articles/'.$articles->id]) !!}
           		@include('articles.form');

           {!! Form::close() !!}
            
			@include('errors.articleError');

        </div>



    </div>

@stop