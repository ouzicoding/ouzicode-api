$(function(){
    // 文章列表缩略图
    $('article section div.image').hover(function(){
        $(this).find('img').stop().animate({'height':'100%'},500);
        $(this).stop().animate({'padding':'0'},500);
    },function(){
        $(this).stop().animate({'padding':'0.05rem'},500);
        $(this).find('img').stop().animate({'height':'1.58rem'},500);
    });

    // sidebar定位
    var aside = $('#aside');
    var startTop = aside.offset().top;// aside到顶部的初始距离
    var asideWidth = aside.width();

    $(window).bind("scroll",function(){

        var moveTop=$(this).scrollTop();//当前窗口的滚动距离

        var fixedTop = 170;
        if (moveTop<fixedTop) {
            aside.css({
                'position': 'static'
            })
        }else{
            aside.css({
                'position': 'fixed',
                'top': startTop - fixedTop,
                'width': asideWidth,
                'margin-top':0
            })
        }
    });
    // 滚动条记忆
    scroll_memory();






});
// 点击搜索框事件
function change_color(){
    myform = document.getElementById('myform');
    myform.search.style.color = 'black';
    myform.search.style.fontFamily = '微软雅黑';
}

// 滚动条记忆
function scroll_memory() {
    var pathname = window.location.pathname;
    var url_param = pathname.split('/');

    if (url_param[1]==='home' && url_param[2]==='article' && url_param[3]==='index' && url_param[5]>0) {

        $('html,body').animate({scrollTop:url_param[5]},'slow');
    }
}

// 侧边栏tab切换
function tab_change() {
    $('#aside div.intro div').eq(1).hide();
    $('#aside div.intro ul li a').click(function(){
        num = $(this).parent('li').index();
        $('#aside div.intro div').eq(num).show().siblings('div').hide();
    });
}













// 百度统计
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?ab864001e752be6a69efa707e2431bfe";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();

