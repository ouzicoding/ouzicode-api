<!-- 侧边栏 -->
<aside id="aside">
    <div class="image">
        <img src="{{ asset('img/code.png') }}">
    </div>
    <div class="tag" v-cloak>
        <a :href="'{{ url('tag') }}/' + tag.id" v-for="tag in aside.tags" :class=" 'label label-' + tag.color" >@{{ tag.name }}</a>
    </div>
    <div class="intro">
        <ul class="intro-choose">
            <li><a href="javascript:;">热门推荐</a></li>
            {{--<li><a href="javascript:;">点击排行</a></li>--}}
        </ul>
        <div class="hot" v-cloak>
            <a v-for="hot in aside.hot_list" :href="'{{ url('/home/article/index') }}/' + hot.id" class="list-group-item">@{{ hot.title }}</a>
        </div>
        {{--<div class="top">--}}
            {{--<a href="#" class="list-group-item">--}}
                {{--<svg class="icon font-tuijan" aria-hidden="true">--}}
                    {{--<use xlink:href="#icon-paixingbang"></use>--}}
                {{--</svg> 1的说法是否--}}
            {{--</a>--}}
            {{--<a href="#" class="list-group-item">24*7 支持</a>--}}
            {{--<a href="#" class="list-group-item">免费 Window 空间托管</a>--}}
        {{--</div>--}}
    </div>
</aside>
