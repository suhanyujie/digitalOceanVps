@extends('app')

@section('title')
<title>爱生活|锲而不舍-访客留言</title>
@stop
@section('content')

    <link rel="stylesheet" type="text/css" media="screen" href="http://www.codingdrama.com/bootstrap-markdown/css/bootstrap-markdown.min.css">

    <div class="container" style="margin-bottom: 20px;">
        @include('articles.nav')
        <h2>尚未实现,请耐心等待哦~  </h2>
        {!! Form::open(['url' => '/articles/message','method'=>'post']) !!}
            <div class="form-group">
                {!! Form::label('username', '您的昵称(nickname)') !!}
                {!! Form::text('username',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', '您的邮箱(E-Mail)') !!}
                {!! Form::text('email',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content', '留言内容(message)') !!}
                {!! Form::textarea('message',null,['class'=>'form-control','data-provide'=>'markdown','placeholder'=>'请输入留言吧~']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('提交留言(submit)',['class'=>'btn btn-default']) !!}
            </div>

        {!! Form::close() !!}
        <!-- markedown来源 :http://www.codingdrama.com/bootstrap-markdown/  -->
        <hr>
        <h2>留言列表</h2>
        <div class="row">

            @foreach($dataList as $k=>$v)
                <div class="media">
                    <div class="media-left">
                        <a href="javascript:void(0)">
                            <img class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTU3NThmOGZkZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NTc1OGY4ZmRkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" alt="...">

                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{$v['username']}}</h4>
                        {!! $v['message'] !!}
                    </div>
                </div>
            @endforeach

        </div>


    </div>
    <script src="http://www.codingdrama.com/bootstrap-markdown/js/markdown.js"></script>
    <script src="http://www.codingdrama.com/bootstrap-markdown/js/to-markdown.js"></script>
    <script src="http://www.codingdrama.com/bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <script src="http://www.codingdrama.com/bootstrap-markdown/locale/bootstrap-markdown.fr.js"></script>
@stop


@section('footer')
    @include('articles.footer')
@stop