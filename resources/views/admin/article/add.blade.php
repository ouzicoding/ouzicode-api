@extends('admin.layout')

@section('title', '添加文章')

@section('main')
    @parent
    <div class="container col-xs-9">
        <form class="form-horizontal" role="form" enctype="multipart/form-data"
              action="{{ url('article/add_data') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">文章标题</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname"
                           placeholder="" name="Article[title]">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">文章内容</label>
                <div class="col-sm-10">
                    @include('editor::head')
                    <div class="editor">
                        <textarea id='myEditor' name="Article[content]"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">所属分类</label>
                <div class="col-sm-10">
                    <select class="form-control" name="Article[cate_id]">
                        @foreach($category as $v)
                            <option value="{{ $v['id'] }}">{{ $v['_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">所属标签</label>
                <div class="col-sm-10">
                    @foreach($tag as $v)
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="tag_id[]" value="{{ $v->id }}">{{ $v->name }}
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">关键字</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname"
                           placeholder="" name="Article[keywords]">
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">摘要</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="Article[digest]"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputfile" class="col-sm-2 control-label">缩略图</label>
                <div class="col-sm-10">
                    <input type="file" id="inputfile" name="Article[thumb]">
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">浏览量</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname"
                           placeholder="" name="Article[browse]">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否发布</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="Article[release]"  value="0" checked> 不发布
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="Article[release]"  value="1"> 发布
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否公开</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="Article[access]"  value="1" checked> 公开
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="Article[access]"  value="2"> 私密
                    </label>
                </div>
            </div>
            <div class="form-group submit-form">
                <div class="submit-div">
                    <button type="submit" class="btn btn-info">提交</button>
                    <button type="button" class="btn btn-info" onclick="Location:history.back();">返回</button>
                </div>
            </div>
        </form>
    </div>
@endsection