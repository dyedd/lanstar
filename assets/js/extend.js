console.log(' %c Theme lanstar %c https://github.com/dyedd/lanstar', 'color:#444;background:#eee;padding:5px 0', 'color:#eee;background:#444;padding:5px');

//初始化tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
// 根据时间
let timeNow = new Date();
// 获取当前小时
let hours = timeNow.getHours();
if (hours > 6 && hours < 19) {
    $('body').removeClass('theme-dark')
} else {
    $('body').addClass('theme-dark')
}
