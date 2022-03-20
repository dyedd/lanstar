<?php
/**
 * author:染念
 * time：2020-8-19 19：39
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col d-none d-md-block mobile-nav">
    <div class="d-md-none mobile-close">
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
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
                <a<?php if ($this->is('index')): ?> class="nav-link active"<?php else: ?> class="nav-link"<?php endif; ?>
                        href="<?php $this->options->siteUrl(); ?>">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-shouye"></use>
                    </svg>
                    <span class="nav-item-text"><?php _e('首页'); ?></span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#" role="button" id="MenuSort" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-fenlei4-copy"></use>
                    </svg>
                    <span class="nav-item-text">分类&#x25bc;</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="MenuSort">
                    <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                    <?php while ($category->next()): ?>
                        <li>
                            <a<?php if ($this->is('category', $category->slug)): ?> class="dropdown-item active" <?php else: ?> class="dropdown-item"<?php endif; ?>
                                    href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>">
                                <span><?php $category->name(); ?></span>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
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
</div>
