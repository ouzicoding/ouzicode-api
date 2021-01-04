$(function(){
    // 项目结束时间
    function timer(){
        var time_over = new Date();
        var year = time_over.getFullYear();
        var month = time_over.getMonth() + 1;
        var date = time_over.getDate();
        var hour = time_over.getHours();
        var minute = time_over.getMinutes();
        var second = time_over.getSeconds();
        // 组合当前日期字符串
        var now_time = year+'-'+month+'-'+date+' '+hour+':'+minute+':'+second;
        $('#timeover').html(now_time);
    }
    timer();
    setInterval(timer,1000);
    // 项目经历时间
    var time_start = new Date('2016-10-31 00:00:00').getTime();
    var time_over = new Date().getTime();
    var time_move = parseInt((time_over - time_start)/(24*3600*1000));
    $('#timemove').html(time_move + '天');

})
// 批量操作
// 全选全不选
function checkAll(obj){
    $("input[type='checkbox']").prop('checked',$(obj).prop('checked'));
}
// 批量删除
function dels(){
    var input = $("input[name='ids']:checked");
    var ids = [];
    input.each(function(k,v){
        var r = v.value;
        ids.push(r);
    })
    $.ajax({
        url: 'dels',
        type: 'post',
        data:{ids:ids},
        dataType: 'json',
    })
    // 刷新当前页面
    window.location.reload();
}
