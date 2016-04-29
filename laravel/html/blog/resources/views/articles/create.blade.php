@include('UEditor::head')
@extends('app')
@section('content')


<div class="container">
    <h1> 撰写新文章 </h1>
    <div class="row" style="margin-top:50px;">
        {!! Form::open(['url'=>'/articles']) !!}
	 
        	@include('articles.form',['initContent'=>'',])


        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
            });
        </script>
        {!! Form::close() !!}
        @if($errors->any())
            <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{$error}}</li>
            @endforeach
            </ul>
        @endif
    </div>

</div>

@stop

