<header id="header">
    <div>
        <div class="menu">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ config('oc.logo') }}" alt="欧子博客" title="欧子博客"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="example-navbar-collapse">
                        <ul class="nav navbar-nav" v-cloak>
                            <li class="index"><a href="{{ url('/') }}">首页</a></li>
                            <li :class="{'active': (nowCate==cate.id)}" v-for="cate in header.categories">
                                <a :href="'{{ url('cate') }}/' + cate.id ">@{{ cate._name }}</a>
                            </li>
                            <li>
                                <a href="https://github.com/ouzicoder/ouzicode" target="_blank">源码</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search">
            <form action="{{ url('search') }}" method="post" id="myform">
                {{ csrf_field() }}
                <input type="text" placeholder="Search" name="search"
                       value="{{ old('search') }}" onfocus="return change_color()">
                <button type="submit">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-sousuo"></use>
                    </svg>
                </button>
            </form>
        </div>
        <div class="mine-center dropdown">
            <img src="{{ session('user_info.avatar') ?? config('oc.avatar_default') }}" alt="" class="avatar dropdown-toggle" @click="login"
                 id="dropdownMenu1">
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="javascript:;">@{{ userInfo.login_name }}</a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="javascript:;">@{{ userInfo.username }}</a>
                </li>
                <li role="presentation" class="divider"></li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="{{ url('login/out_login') }}">退出登录</a>
                </li>
            </ul>
        </div>
    </div>
</header>