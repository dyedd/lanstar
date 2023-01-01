<?php
/**
 * author:染念
 * time：2022-3-20 21：04
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="toolbar">
    <div class="toolbar-left">
        <?php if($this->is('index')): ?>
            主页
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
                            <?php $this->category(','); ?>
                        </li>
                    <?php else: ?>
                        <li class="breadcrumb-item">
                            <?php $this->archiveTitle('&raquo;', '', ''); ?>
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
        <button class="float-end d-block d-md-none mobile-button" type="button">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-daohang1"></use>
            </svg>
        </button>
        <?php if($this->options->darkBtn):?>
<!--            <button class="float-end chose-mode-day float-right" id="night-mode" type="button">-->
<!--                <svg class="icon" aria-hidden="true">-->
<!--                    <use xlink:href="#icon-yueliang"></use>-->
<!--                </svg>-->
<!--            </button>-->
            <button class="float-end chose-mode-moon float-right" id="night-mode" type="button">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-taiyang"></use>
                </svg>
            </button>
        <?php endif;?>
    </div>
</div>



