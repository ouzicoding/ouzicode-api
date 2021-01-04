/**
 * vue
 */
$(function () {
    // 组件
    Vue.component('reply-form',{
        data: function () {
            return {
            }
        },
        template:'#reply-form-tpl',
        props: ['article_id','comment_id','parent_key'],
        methods: {
            addComment(article_id,comment_id,parent_key){
                // 验证
                if (!app.userInfo.uid) {
                    return app.login();
                }
                // 获取评论内容
                let textareaEl = $('div.commentid' +comment_id).find('textarea');
                let commentContent = textareaEl.val();
                if (!commentContent) {
                    textareaEl.attr('placeholder','请输入内容');
                    return;
                }else{
                    textareaEl.attr('placeholder','');
                }

                axios.post('/api/comment/add_comment', {
                    content: commentContent,
                    article_id: article_id,
                    comment_id:comment_id,
                }).then(function (response) {
                    if (!response.data.code) {
                        let data = response.data.data.data;
                        data.uid = app.userInfo.uid;
                        data.avatar = app.userInfo.avatar;
                        data.username = app.userInfo.username;
                        if (parent_key === undefined) {// 评论
                            app.comments.unshift(data);
                        }else{// 回复
                            app.comments[parent_key].reply_list.push(data);
                        }
                        $('div.comment-list').find('.comment-post').hide();
                        // 清空输入框
                        textareaEl.val('');
                    }
                });
            }
        }
    });

    let app = new Vue({
        el: '#app',
        data: {
            header: {},
            aside: {},
            footer: {},
            comments: {},
            nowCate:0,
            userInfo:{}
        },
        mounted: function () {
            // 登录信息
            axios.get('/user/user_info').then(function (response) {
                if (!response.data.code) {
                    app.userInfo = response.data.data
                }
            });
            // 头部
            axios.get('/home/header').then(function (response) {
                app.header = response.data;
                let pathname = window.location.pathname;
                let url_param = pathname.split('/');

                if (url_param[1]==='cate') {
                    app.nowCate = url_param[2];
                }
            });
            // 侧边栏
            axios.get('/home/sidebar').then(function (response) {
                app.aside = response.data;
            });
            // 脚部
            axios.get('/home/footer').then(function (response) {
                app.footer = response.data;
            });
            // 评论
            let article_id = $('div.article').attr('article-id');
            if (article_id) {
                axios.get('/api/comment/comment_list/'+article_id).then(function (response) {
                    if (!response.data.code) {
                        app.comments = response.data.data.list;
                    }
                });
            }
        },
        methods:{
            login(){
                // 如果未登录
                if (!app.userInfo.uid) {
                    // 判断是否文章页面
                    let href = location.pathname;
                    if (href.indexOf('/home/article/index/') >= 0) {
                        href_ = href.split('/');
                        arcticle_id = href_[4];
                        href = '/home/article/index/' + arcticle_id + '/' +$(window).scrollTop();
                    }

                    let login_before = href.replace(/\//g,'_');
                    // 跳转登录页面
                    location.href = location.protocol +'//' +location.host +'/login/github/' +login_before;
                }else{
                    $('#header .mine-center img.avatar').attr('data-toggle','dropdown');
                }
            },
            showForm(e){
                let el = e.target;
                // 显示隐藏表单
                $(el).parent().siblings('.comment-post').toggle();
                $(el).parents('.comment-single').siblings().find('.comment-post').hide();
                $(el).parent().siblings().find('.comment-post').hide();
                $(el).parents('.reply-list').siblings('.comment-post').hide();
            }
        }
    });

});
