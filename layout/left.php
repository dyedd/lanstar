<?php
/**
 * author:染念
 * time：2020-8-19 19：39
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="logo-box">
    <?php if ($this->options->logoUrl): ?>
        <img class="site-logo" title="<?php $this->options->description(); ?>"
             src="<?php $this->options->logoUrl(); ?>" alt="logo">
    <?php else: ?>
        <img class="site-logo" title="<?php $this->options->description(); ?>"
             src="<?php utils::indexTheme('assets/img/logo.png'); ?>" alt="logo">
    <?php endif; ?>
    <b class="logo-shine"></b>
</div>
<div class="nav-menu">
    <nav class="nav flex-column">
        <div class="nav-item">
            <a<?php if ($this->is('index')): ?> class="nav-link"<?php else: ?> class="nav-link"<?php endif; ?>
                href="<?php $this->options->siteUrl(); ?>">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-shouye"></use>
                </svg>
                <span class="nav-item-text"><?php _e('首页'); ?></span>
            </a>
        </div>
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php utils::customNavHandle($this->options->customNavIcon, $pages, $this); ?>
    </nav>
    <?php if ($this->user->hasLogin()): ?>
        <div class="nav-item">
            <a class="nav-link" href="<?php $this->options->adminUrl(); ?>" title="进入后台">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-shezhi"></use>
                </svg>
                <span class="nav-item-text">后台</span>
            </a>
        </div>
    <?php endif; ?>
</div>
