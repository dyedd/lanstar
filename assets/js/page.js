lanstar.addEmoji()
this.addHighLight();
lanstar.addCatalog()
lanstar.addComment();
lanstar.addPageLike();
$('.protected-btn').click(function() {
    let surl=$(".protected").attr("action");
    $.ajax({
        type: "POST",
        url:surl,
        data:$('.protected').serialize(),
        error: function(request) {
            alert("密码提交失败，请刷新页面重试！");
        },
        success: function(data) {

            if(data.indexOf("密码错误") >= 0 && data.indexOf("<title>Error</title>") >= 0) {
                alert("密码错误，请重试！");
            }else{
                location.reload();
            }
        }
    });
});
// 私密
let holder = $('.comment-respond textarea').attr('placeholder');
$('#secret-button').click(function () {
    let textareaDom = $('.comment-respond textarea');
    if($(this).is(':checked')) {
        textareaDom.attr('placeholder', '私密回复中')
    }else {
        textareaDom.attr('placeholder', holder)
    }
})
