@extends('sidebar')

@section('main-content')

<div class="col-xs-12">
    <h1> test-文章列表 </h1>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>序号</th>
                        <th>文章ID</th>
                        <th class="hidden-480">
                            <i class="icon-time bigger-110 hidden-480"></i>
                            发布时间
                        </th>

                        <th>文章标题</th>
                        <th class="hidden-480">文章状态</th>

                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if($data['articles']['data'])
                    @foreach($data['articles']['data'] as $k=>$row)
                    <tr>
                        <td class="center">
                            <label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td>{{$k}}</td>
                        <td>{{$row['id']}}</td>
                        <td class="hidden-480">{{$row['publish_date']}}</td>
                        <td>{{$row['title']}}</td>

                        <td class="hidden-480">
                            <span class="label label-sm label-warning">Expiring</span>
                        </td>

                        <td>
                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                <button class="btn btn-xs btn-success">
                                    <i class="icon-ok bigger-120"></i>
                                </button>

                                <a class="btn btn-xs btn-info" href="/articles/{{$row['id']}}/edit">
                                    <i class="icon-edit bigger-120"></i>
                                </a>

                                <button class="btn btn-xs btn-danger">
                                    <i class="icon-trash bigger-120"></i>
                                </button>

                                <button class="btn btn-xs btn-warning">
                                    <i class="icon-flag bigger-120"></i>
                                </button>
                            </div>

                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="inline position-relative">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-cog icon-only bigger-110"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
																				<span class="blue">
																					<i class="icon-zoom-in bigger-120"></i>
																				</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="/article/{{$row['id']}}/edit" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
																				<span class="green">
																					<i class="icon-edit bigger-120"></i>
																				</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
																				<span class="red">
																					<i class="icon-trash bigger-120"></i>
																				</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /span -->
    </div>
</div>
@stop