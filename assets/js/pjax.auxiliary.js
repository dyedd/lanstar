const pjax = new Pjax({
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
    document.querySelector('.loader').classList.add("active")
})
document.addEventListener('pjax:complete', function (){
    document.querySelector('.loader').classList.add("active")
    lanstar.addHighLight();
    NProgress.done();
    lanstar.init();
    lanstar.addEmoji();
    lanstar.addComment();
    lanstar.addPageLike();
    lanstar.addArchiveToggle();
    (function() {
        MathJax.Hub.Config({
            tex2jax: {
                inlineMath: [
                    ['$', '$'],
                    ['\\(', '\\)']
                ]
            }
        });
        var math = document.getElementsByClassName("article-content")[0];
        MathJax.Hub.Config({
            showProcessingMessages: false, //关闭js加载过程信息
            messageStyle: "none", //不显示信息
            extensions: ["tex2jax.js"],
            jax: ["input/TeX", "output/HTML-CSS"],
            tex2jax: {
                inlineMath: [
                    ["$", "$"]
                ], //行内公式选择$
                displayMath: [
                    ["$$", "$$"]
                ], //段内公式选择$$
                skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code', 'a'] //避开某些标签
            },
            "HTML-CSS": {
                availableFonts: ["STIX", "TeX"], //可选字体
                showMathMenu: false //关闭右击菜单显示
            }
        });
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, math]);
    })()
});