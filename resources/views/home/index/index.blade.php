@extends('home.layout')

@section('title','首页')
@section('keywords','欧子,欧子博客,个人博客,PHP,laravel')
@section('description','欧子博客是欧子基于laravel框架独立开发的php个人博客')

@section('article')
    @forelse($articles as $article)
        <section>
            <div class="section">
                <div class="title"><a href="{{ url('home/article/index').'/'. $article->id }}">{{ $article->title }}</a>
                </div>
                <div class="belong">
                    <p class="cate" title="分类">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-fenlei"></use>
                        </svg>
                        <a href="{{ url('cate',['param'=>$article->cate_id]) }}">{{ $article->category_name }}</a>
                    </p>
                    <p class="tag" title="标签">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-biaoqian"></use>
                        </svg>
                        @foreach($article->tags as $k => $tag)
                            <a href="{{ url('tag',['param'=>$k]) }}" style="padding-right: 0.04rem;">{{ $tag }}</a>
                        @endforeach
                    </p>
                </div>
                <div class="detail">
                    <div class="image"><img src="{{ FILE_HOST. $article->thumb }}"></div>
                    <div class="content">{{ $article->digest }}</div>
                    <div class="show">
                        <p>
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-rili-copy-copy"></use>
                            </svg> {{ $article->created_at }}</p>
                        <a href="{{ url('home/article/index').'/'. $article->id }}">
                            <button class="btn btn-info btn-xs">查看全文>></button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @empty
        <div class="empty"><span>还没有文章 敬请期待</span></div>
    @endforelse

    <div class="oh-page">
        {{ $articles->links() }}
    </div>
@endsection