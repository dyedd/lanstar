const pjax = new Pjax({
    elements:"a:not(.js-pjax)",
    selectors: [
        "title",
        "meta[name=description]",
        "meta[name=keywords]",
        ".main"
    ],
    timeout:3000,
    cacheBust: false
})
document.addEventListener('pjax:send', function (){
    NProgress.start();
})
document.addEventListener('pjax:complete', function (){
    NProgress.done();
    lanstar.addEmoji();
    lanstar.addDarkMode();
    lanstar.addTa();
    lanstar.copyToClipBoard()
    lanstar.addHighLight()
    lanstar.addAsyncComment()
    lanstar.addArchiveToggle()
    utils.loadScript('toastify.min.js')
});