@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('articles.nav')
            <div class="page-header">
                <h1>
                    {{$data->title}}
                </h1>
            </div>
            <article>
                <div class="content">
                    {!! $data->content !!}
                </div>

            </article>
        </div>
    </div>
</div>
@stop