<?php
/**
 * author:染念
 * time：2020-8-19 19：39
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="collapse d-md-none" id="mobile-nav">
    <div class="list-group">
        <a<?php if ($this->is('index')): ?> class="nav-link active"<?php else: ?> class="nav-link"<?php endif; ?>
                href="<?php $this->options->siteUrl(); ?>">
            <div class="nav-item">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-shouye"></use>
                </svg>
                <span class="nav-item-text"><?php _e('首页'); ?></span>
            </div>
        </a>
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php utils::customNavHandle($this->options->customNavIcon, $pages, $this); ?>
        <?php if ($this->user->hasLogin()): ?>
            <a class="nav-link" href="<?php $this->options->adminUrl(); ?>" title="进入后台">
                <div class="last-nav-item">
                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="nav-icon bi bi-gear" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                        <path fill-rule="evenodd"
                              d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                    </svg>
                    <span class="nav-item-text">后台</span>
                </div>
            </a>
        <?php endif; ?>
    </div>
</div>
<div class="col-md-4 col-xl-2 d-none d-md-block">
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
