@extends('admin.layout')

@section('title','后台管理')

@section('main')
    <div class="detail">
        <section class="col-xs-6 pull-left">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>类别</th>
                    <th>名称</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>核心框架：</td>
                    <td>Laravel 5.3</td>
                </tr>
                <tr>
                    <td>运行环境：</td>
                    <td>Lamp/Wamp</td>
                </tr>
                <tr>
                    <td>PHP版本：</td>
                    <td>7.0 +</td>
                </tr>
                <tr>
                    <td>Uma</td>
                    <td>Pune</td>
                </tr>
                <tr>
                    <td>作者：</td>
                    <td>欧浩</td>
                </tr>
                </tbody>
            </table>
        </section>
        <section class="col-xs-6 pull-right">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>记录</th>
                    <th>值</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>上次登录 I P ：</td>
                    <td>127.0.0.1</td>
                </tr>
                <tr>
                    <td>上次登录时间：</td>
                    <td>{{ date('Y-m-d H:i:s',$data['last_login_time']) }}</td>
                </tr>
                <tr>
                    <td>项目开始时间：</td>
                    <td id="timestart">2016-10-31</td>
                </tr>
                <tr>
                    <td>项目结束时间：</td>
                    <td id="timeover"></td>
                </tr>
                <tr>
                    <td>项目历时：</td>
                    <td id="timemove"></td>
                </tr>
                </tbody>
            </table>
        </section>
    </div>
    <!-- 个性签名 -->
    <div class="signature">{{ $data['signature'] }}</div>
@endsection