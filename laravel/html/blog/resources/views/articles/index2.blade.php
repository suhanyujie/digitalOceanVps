@extends('app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('articles.nav')
            @foreach($articles as $row)
            <div class="page-header">
                <h1>
                    <small><a href="{{url('articles',$row->id)}}">{{$row->title}}</a></small>
                </h1>
            </div>
            @endforeach
            <p style="display:none;">
                Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
            </p>


        </div>
    </div>
</div>

@stop