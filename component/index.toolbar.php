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
        <?php if (!$this->is('post')): ?>
            <span class="header">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-shouye1"></use>
                </svg>首页
            </span>
            <div class="mobile-left">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-daohang1"></use>
                    </svg>
            </div>

        <?php else: ?>
            <!--面包屑导航-->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php $this->options->siteUrl(); ?>">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-shouye1"></use>
                            </svg>
                            <span>首页</span>
                        </a>
                    </li>
                    <?php if ($this->is('post')): ?>
                        <li class="breadcrumb-item">
                            <span><?php $this->category(','); ?></span>
                        </li>
                    <?php else: ?>
                        <li class="breadcrumb-item">
                            <span><?php $this->archiveTitle('&raquo;', '', ''); ?></span>
                        </li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>正文</span>
                    </li>
                </ol>
            </nav>
        <?php endif; ?>
    </div>
    <div class="toolbar-right">
        <?php if (!$this->is('post')): ?>
        <div class="mobile-right">
            <?php if ($this->options->asideAvatar): ?>
                <img title="<?php $this->options->title(); ?>"
                     src="<?php $this->options->asideAvatar(); ?>" alt="logo">
            <?php else: ?>
                <img title="<?php $this->options->title(); ?>"
                     src="<?php utils::indexTheme('assets/img/logo.png'); ?>" alt="logo">
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>



