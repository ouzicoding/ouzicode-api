@extends('admin.layout')

@section('title','添加标签')

@section('main')
    @parent
    <div class="container col-xs-9">
        <form class="form-horizontal" role="form" action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">标签名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname"
                           placeholder="添加多个标签按|隔开" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">标签颜色</label>
                <div class="col-sm-10">
                    <select class="form-control tag-color" name="color">
                        <option value="primary" @if(old('color')=='primary') selected @endif>蓝色</option>
                        <option value="danger" @if(old('color')=='danger') selected @endif>红色</option>
                        <option value="success" @if(old('color')=='success') selected @endif>绿色</option>
                        <option value="warning" @if(old('color')=='warning') selected @endif>淡黄色</option>
                        <option value="info" @if(old('color')=='info') selected @endif>浅蓝色</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">排序</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastname"
                           placeholder="" name="sort" value="{{ old('sort') }}">
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