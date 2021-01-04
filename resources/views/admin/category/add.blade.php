@extends('admin.layout')

@section('title', '添加分类')

@section('main')
    @parent
    <div class="container col-xs-9">
        <form class="form-horizontal" role="form" action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">分类名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">分类标识</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname"  name="title" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">所属分类</label>
                <div class="col-sm-10">
                    <select class="form-control" name="pid">
                        <option value="0">顶级分类</option>
                        @foreach($category as $v)
                            <option value="{{ $v['id'] }}" @if(old('pid')==$v['id']) selected @endif>{{ $v['_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">排序</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastname" name="sort" value="{{ old('sort') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">提交</button>
                    <button type="button" class="btn btn-default" onclick="Location:history.back();">返回</button>
                </div>
            </div>
        </form>
    </div>
@endsection