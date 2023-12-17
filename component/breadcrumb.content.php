<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
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
