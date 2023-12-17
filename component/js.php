<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<script src="<?php utils::indexTheme('assets/js/extend/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/icon.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/view-image.min.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/lazyload.js'); ?>"></script>
<script src="<?php utils::indexTheme('assets/js/extend/toastify.min.js'); ?>"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    const themeUrl = '<?php utils::indexTheme(); ?>';
    const config = {'dark': '<?=  $this->options->darkBtn;?>'};
    const getCookie=(name) => document.cookie.match(`[;\s+]?${name}=([^;]*)`)?.pop();
</script>
<script src="<?php utils::indexTheme('assets/js/lanstar.app.js'); ?>"></script>
<?php if($this->is('page') || $this->is('post')): ?>
    <script src="<?php utils::indexTheme('assets/js/lanstar.content.js'); ?>"></script>
    <script>MathJax={tex:{inlineMath:[["$","$"],["\\(","\\)"]]},svg:{fontCache:"global"}};</script>
    <script defer src="<?php utils::indexTheme('assets/js/extend/tex-svg.js'); ?>"></script>
<?php endif; ?>
<script>
    window.ViewImage && ViewImage.init('.gallery img');
    lazyload(document.querySelectorAll(".lazy"));
</script>
<?php $this->options->jsEcho(); ?>
<?php if($this->is('page')): ?>
    <script>
    content.addArchiveToggle();
    </script>
<?php endif; ?>
<?php if ($this->options->sidebarBlock && in_array('ShowYourCouple', $this->options->sidebarBlock)): ?>
    <script>app.addCoupleTime();</script>
<?php endif; ?>
<?php if ($this->options->jsPushBaidu): ?>
    <script src="<?php utils::indexTheme('assets/js/extend/push.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->options->extraIcon): ?>
    <script src="<?=  $this->options->extraIcon(); ?>"></script>
<?php endif; ?>
<?php if ($this->options->compressHtml):$html_source = ob_get_contents();ob_clean();print utils::compressHtml($html_source);ob_end_flush();endif; ?>
