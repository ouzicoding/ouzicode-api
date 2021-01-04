@extends('home.layout')

@section('title',$article['title'])
@section('keywords',$article['keywords'])
@section('description',$article['digest'])

@section('article')
    <div class="article" article-id="{{ $article['article_id'] }}">
        <div class="title-name">{{ $article['title'] }}</div>
        <div class="detail">
            <div class="author">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#iconfontyonghu"></use>
                </svg>
                欧子
            </div>
            <div class="belong">
                <p class="cate" title="分类">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-fenlei"></use>
                    </svg>
                    <a href="{{ url('cate',['param'=>$article['cate_id']]) }}">{{ $article['category_name'] }}</a>
                </p>
                <p class="tag" title="标签">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-biaoqian"></use>
                    </svg>
                    @foreach($article['tag'] as $k => $v)
                        <a href="{{ url('tag',['param'=>$k]) }}">{{ $v }}</a>
                    @endforeach
                </p>
            </div>
        </div>
        <div class="article-content">{!! $article['content'] !!}</div>
        <div class="sign">
            <p class="updated">发布于 {{ date('Y-m-d H:i:s',$article['created_at']) }}</p>
        </div>
    </div>

{{--评论区--}}
    <script type="text/x-template" id="reply-form-tpl">
        <div class="comment-post">
            <div class="post-show">
                <div class="editor">
                    <textarea></textarea>
                </div>
            </div>
            <div class="post-submit">
                <p class="intro">*支持markdown语法*</p>
                <button class="submit" @click="addComment( article_id,comment_id,parent_key )">发布</button>
            </div>
        </div>
    </script>
    <div id="comment">
        <div class="add-comment commentid0">
            <div class="avatar">
                <img src="{{ session('user_info.avatar') ?? config('oc.avatar_default')}}" alt="">
            </div>
            <div class="post-detail">
                <reply-form article_id="{{ $article['article_id'] }}" comment_id="0"></reply-form>
            </div>
        </div>
        <div class="comment-list">
            <div :class=" 'comment-single commentid' +comment.comment_id" v-for="(comment,key) in comments">
                <div class="avatar">
                    <img :src="comment.avatar" alt="">
                </div>
                <div class="comment-detail">
                    <div class="comment-user">
                        <p>@{{ comment.username }}</p>
                        <p></p>
                    </div>
                    <div class="comment-content" v-html="comment.content"></div>
                    <div class="comment-actions">
                        <span class="post-time">@{{ comment.created_format }}</span>
                        <button class="reply" @click="showForm">回复</button>
                    </div>
                    <reply-form style="display: none;" :parent_key="key" :comment_id="comment.comment_id" article_id="{{ $article['article_id'] }}"></reply-form>
                    <div class="reply-list">
                        <div :class=" 'comment-single reply-single commentid' + reply.comment_id" v-for="reply in comment.reply_list">
                            <div class="avatar">
                                <img :src="reply.avatar" alt="">
                            </div>
                            <div class="comment-detail">
                                <div class="comment-user">
                                    <p>@{{ reply.username }}</p>
                                    <p><b>回复</b></p>
                                    <p>@{{ reply.to_username }}:</p>
                                    <p></p>
                                </div>
                                <div class="comment-content" v-html="reply.content"></div>
                                <div class="comment-actions">
                                    <span class="post-time">@{{ reply.created_format }}</span>
                                    <button class="reply" @click="showForm">回复</button>
                                </div>
                                <reply-form style="display: none;" :parent_key="key" :comment_id="reply.comment_id" article_id="{{ $article['article_id'] }}"></reply-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection