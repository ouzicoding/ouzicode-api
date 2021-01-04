@extends('admin.layout')

@section('title', '文章列表')

@section('main')
    @parent
    <div class="container col-xs-9">
        <table class="table table-striped table-hover">
            <caption>
                <a href="{{ url('article/add') }}"><button type="button" class=" btn btn-primary">添加</button></a>
                <a href="javascript:;"><button type="button" class=" btn btn-danger" onclick="dels();">批量删除</button></a>
            </caption>
            <thead>
            <tr>
                <th>
                    <input type="checkbox" id="ids" onclick="checkAll(this);"><label for="ids">编号</label>
                </th>
                <th>标题</th>
                <th>发布</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>
                        <input type="checkbox" id="" name="ids" value=""><label for="">{{ $v->id }}</label>
                    </td>
                    <td>{{ $v->title }}</td>
                    <td>{{ $v->release==1 ? '是' : '否' }}</td>
                    <td>{{ date('Y-m-d',strtotime($v->created_at)) }}</td>
                    <td>
                        <a href="{{ url('article/edit', ['id'=>$v->id]) }}" class="btn btn-info">编辑</a>
                        <a href="{{ url('article/del', ['id'=>$v->id]) }}" class="btn btn-danger">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            @if($data->links() != '')
                {{ $data->links() }}
            @else
                <ul class="pagination">
                    <li class="disabled"><span>&laquo;</span></li>
                    <li class="active"><a href="">1</a></li>
                    <li class="disabled"><span>&raquo;</span></li>
                </ul>
            @endif
        </div>
    </div>
@endsection