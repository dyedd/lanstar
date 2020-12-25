<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<?php $this->options->jsEcho();?>
<script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@'.themeVersion().'/assets/js/prism.min.js';else:utils::indexTheme('assets/js/prism.js'); endif?>"></script>
<script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@'.themeVersion().'/assets/owo/owo_02.min.js';else:utils::indexTheme('assets/owo/owo_02.js'); endif?>"></script>
<script>let owoJson = '<?php utils::indexTheme('assets/owo/OwO_02.json'); ?>'</script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.js"></script>
<script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@'.themeVersion().'/assets/js/lanstarApp.min.js';else:utils::indexTheme('assets/js/lanstarApp.js'); endif?>"></script>
<?php if ($this->is('single')):?>
    <script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@'.themeVersion().'/assets/js/page.min.js';else:utils::indexTheme('assets/js/page.js'); endif?>"></script>
<?php endif; ?>
<script>lanstar.init();</script>
<?php if($this->options->pjax && $this->options->pjax!=0) :?>
    <script src="https://cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.min.js"></script>
    <script>
        $(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax])', {
            container: '#pjax-container',
            fragment: '#pjax-container',
            timeout: 8000
        });
        $(document).on('pjax:send',
            function() {
                NProgress.start();
            });
        $(document).on('pjax:end',
            function() {
                NProgress.done();
        });
        $(document).on('ready pjax:end',
            function() {
                lanstar.init();
                lanstar.addEmoji();
                lanstar.addHighLight();
                lanstar.addCatalog();
                lanstar.addComment();
                lanstar.addPageLike();
                <?php $this->options->pjax_complete(); ?>
            });
    </script>
<?endif;?>
<?php if ($this->options->jsPushBaidu):?>
    <script src="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@'.themeVersion().'/assets/js/push.min.js';else:utils::indexTheme('assets/js/push.js'); endif?>"></script>
<?php endif;?>
<?php if($this->options->music): ?>
<meting-js fixed="true" lrc-type="1" <?php $this->options->music(); ?>>
</meting-js>
    <script src="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/meting@2.0.1/dist/Meting.min.js"></script>
<?php endif;?>
<?php if ($this->options->compressHtml): $html_source = ob_get_contents(); ob_clean(); print utils::compressHtml($html_source); ob_end_flush(); endif; ?>
