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
    lanstar.addHighLight();
    NProgress.done();
    lanstar.init();
    lanstar.addEmoji();
    lanstar.addComment();
    lanstar.addPageLike();
    lanstar.addArchiveToggle();
    window.ViewImage && ViewImage.init('.gallery img');
    let images = document.querySelectorAll(".lazy");
    lazyload(images);
    MathJax={tex:{inlineMath:[["$","$"],["\\(","\\)"]]},svg:{fontCache:"global"}};
});