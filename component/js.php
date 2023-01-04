<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<script src="<?php utils::indexTheme('assets/js/lanstarApp.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/nprogress.min.js'); ?>"></script>
<script>MathJax={tex:{inlineMath:[["$","$"],["\\(","\\)"]]},svg:{fontCache:"global"}};</script>
<script defer src="<?php utils::indexTheme('assets/js/extend/tex-svg.js'); ?>"></script>
<script>
    const themeUrl = '<?php utils::indexTheme(); ?>';
    const config = {'dark': '<?=  $this->options->darkBtn;?>'};
    utils.loadScript('toastify.min.js')
</script>
<script src="<?php utils::indexTheme('assets/js/extend/icon.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/view-image.min.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/lazyload.js'); ?>"></script>
<script>lanstar.init();</script>
<?php $this->options->jsEcho(); ?>
<?php if ($this->options->sidebarBlock && in_array('ShowYourCouple', $this->options->sidebarBlock)): ?>
    <script>lanstar.addCoupleTime();</script>
<?php endif; ?>
<?php if ($this->options->pjax && $this->options->pjax != 0) : ?>
    <script src="<?php utils::indexTheme('assets/js/extend/pjax.min.js'); ?>"></script>
    <script src="<?php utils::indexTheme('assets/js/extend/pjax.auxiliary.js'); ?>"></script>
    <script>document.addEventListener('pjax:complete', function (){<?php $this->options->pjax_complete(); ?>})</script>
<?php endif; ?>
<?php if ($this->options->jsPushBaidu): ?>
    <script src="<?php utils::indexTheme('assets/js/extend/push.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->options->music): ?>
    <meting-js fixed="true" lrc-type="1" <?php $this->options->music(); ?>></meting-js>
    <script src="<?php utils::indexTheme('assets/js/extend/APlayer.min.js') ?>"></script>
    <script src="<?php utils::indexTheme('assets/js/extend/Meting.min.js') ?>"></script>
<?php endif; ?>
<?php if ($this->options->extraIcon): ?>
    <script src="<?=  $this->options->extraIcon(); ?>"></script>
<?php endif; ?>
<?php if ($this->options->compressHtml):$html_source = ob_get_contents();ob_clean();print utils::compressHtml($html_source);ob_end_flush();endif; ?>
