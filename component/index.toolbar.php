<?php
/**
 * author:染念
 * time：2022-3-20 21：04
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="fixed-body"></div>
<div class="toolbar">
    <div class="toolbar-left">
        <span class="header">
            <?php if ($this->is('index')): ?>
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-shouye1"></use>
                </svg>首页
            <?php else: ?>
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-biaoti-"></use>
                </svg> 博客内容
            <?php endif; ?>
        </span>
        <div class="mobile-left">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-daohang1"></use>
            </svg>
        </div>
    </div>
    <div class="toolbar-right">
        <div class="mobile-right">
            <?php if ($this->options->asideAvatar): ?>
                <img title="<?php $this->options->title(); ?>"
                     src="<?php $this->options->asideAvatar(); ?>" alt="logo">
            <?php else: ?>
                <img title="<?php $this->options->title(); ?>"
                     src="<?php utils::indexTheme('assets/img/logo.png'); ?>" alt="logo">
            <?php endif; ?>
        </div>
    </div>
</div>



