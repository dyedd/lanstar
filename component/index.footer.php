<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.1/build/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<?php $this->options->jsEcho(); ?>
<script>let _owo = '<?php utils::indexTheme('assets/owo/OwO.json'); ?>'</script>
<script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@' . themeVersion() . '/assets/js/OwO.js'; else:utils::indexTheme('assets/js/OwO.js'); endif ?>"></script>
<script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@' . themeVersion() . '/assets/js/lanstarApp.min.js'; else:utils::indexTheme('assets/js/lanstarApp.js'); endif ?>"></script>
<script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@' . themeVersion() . '/assets/js/gazeimg.min.js'; else:utils::indexTheme('assets/js/gazeimg.js'); endif ?>"></script>
<script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@' . themeVersion() . '/assets/js/icon.min.js'; else:utils::indexTheme('assets/js/icon.js'); endif ?>"></script>
<?php if ($this->is('single')): ?>
    <script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@' . themeVersion() . '/assets/js/page.min.js'; else:utils::indexTheme('assets/js/page.js'); endif ?>"></script>
<?php endif; ?>
<script>lanstar.init();</script>
<?php if ($this->options->couple): ?>
    <script>lanstar.addCoupleTime();</script>
<?php endif; ?>
<?php if ($this->options->pjax && $this->options->pjax != 0) : ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.min.js"></script>
    <script>
        $(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax])', {
            container: '#pjax-container',
            fragment: '#pjax-container',
            timeout: 8000
        });
        $(document).on('pjax:send',
            function () {
                NProgress.start();
            });
        $(document).on('pjax:end',
            function () {
                NProgress.done();
            });
        $(document).on('pjax:complete', function () {
            lanstar.addHighLight();
            $('img[data-gisrc]:not([data-gi-init])').giLazy();
        });
        $(document).on('ready pjax:end',
            function () {
                lanstar.init();
                lanstar.addEmoji();
                lanstar.addCatalog();
                lanstar.addComment();
                lanstar.addPageLike();
                lanstar.addArchiveToggle();
                <?php $this->options->pjax_complete(); ?>
            });
    </script>
<?endif;?>
<?php if ($this->options->jsPushBaidu):?>
    <script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@'.themeVersion().'/assets/js/push.min.js';else:utils::indexTheme('assets/js/push.js'); endif?>"></script>
<?php endif;?>
<?php if($this->options->music): ?>
    <meting-js fixed="true" lrc-type="1" <?php $this->options->music(); ?>></meting-js>
    <script src="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/meting@2.0.1/dist/Meting.min.js"></script>
<?php endif;?>
<?php if ($this->options->compressHtml): $html_source = ob_get_contents(); ob_clean(); print utils::compressHtml($html_source); ob_end_flush(); endif; ?>
<div class="back-to-top" onclick="lanstar.addBackTop()">
    <svg class="icon" aria-hidden="true">
        <use xlink:href="#icon-fanhuidingbu"></use>
    </svg>
</div>