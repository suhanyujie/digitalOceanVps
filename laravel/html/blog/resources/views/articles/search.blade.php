@extends('app')
@section('title')
<title>
    搜索列表-爱生活，锲而不舍
</title>
@stop



@section('content')
    @if($searchList)
    	@foreach($searchList as $k=>$v)
            <div class="bs-callout bs-callout-warning" id="callout-tables-responsive-overflow" style="margin-top:30px;">
                <h4>{{$v['title']}}</h4>
                <div class="post-content">
                	{!!mb_substr(strip_tags($v['content']),0,200,'utf-8')!!}
                </div>
            </div>
    	@endforeach
    @endif
@stop

