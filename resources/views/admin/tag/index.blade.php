@extends('admin.layout')

@section('title','标签列表')

@section('main')
    @parent
    <div class="container col-xs-9">
        <table class="table table-striped table-hover">
            <caption>
                <a href="{{ url('tag/add') }}"><button type="button" class=" btn btn-primary">添加</button></a>
                <a href="javascript:;"><button type="button" class=" btn btn-danger" onclick="dels();">批量删除</button></a>
            </caption>
            <thead>
            <tr>
                <th>
                    <input type="checkbox" id="ids" onclick="checkAll(this);"><label for="ids">&nbsp;编号</label>
                </th>
                <th>名称</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>
                        <input type="checkbox" id="ids{{ $v->id }}" name="ids" value="{{ $v->id }}">
                        <label for="ids{{ $v->id }}">&nbsp;{{ $v->id }}</label>
                    </td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->sort }}</td>
                    <td>
                        <a href="{{ url('tag/edit', ['id'=>$v->id]) }}" class="btn btn-info">编辑</a>
                        <a href="{{ url('tag/del', ['id'=>$v->id]) }}" class="btn btn-danger">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection