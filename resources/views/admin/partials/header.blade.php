<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header col-xs-2">
        <a class="navbar-brand" href="{{ url('/') }}" target="_blank" style="padding-left: 0.3rem;">Ouzi</a>
    </div>
    <div class="col-xs-8">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('admin') }}">首页</a></li>
            <li><a href="{{ url('admin/article/index') }}">博客</a></li>
            <li><a href="">配置</a></li>
        </ul>
    </div>
    <div class="col-xs-2">
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (!Auth::guest())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url('/password/reset') }}">修改密码</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                退出
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>