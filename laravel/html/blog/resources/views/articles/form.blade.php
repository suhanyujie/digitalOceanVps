<div class="form-group">
    {!! Form::label('title') !!}
    {!! Form::text('title',null,['class'=>'form-control']) !!}
</div>
<div class="form-group" style="width:100%;">
    {!! Form::label('content','Content:') !!}
    <!-- {!! Form::textarea('content',null,['class'=>'form-control','id'=>'container11','style'=>'height:500px;','type'=>'text/plain']) !!}
    -->
    <div style="width:100%">
        <script type="text/plain" id="container" name="content" style="width:100%;height:260px"></script>
    </div>


</div>
<div class="form-group">
    {!! Form::label('publish_date','Publish_date:') !!}
    {!! Form::input('date','publish_date',date('Y-m-d'),['class'=>'form-control']) !!}
</div>
	{!! Form::submit('发布文章',['class'=>'btn brn-primary']) !!}