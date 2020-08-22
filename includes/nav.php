<?php
/**
 * author:染念
 * time：2020-8-19 19：39
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-md-3 col-xl-2 collapse" id="mobile-nav">
        <div class="nav-menu">
            <nav class="nav flex-column">
                <a<?php if ($this->is('index')): ?> class="nav-link active"<?php else:?> class="nav-link"<?php endif; ?>
                        href="<?php $this->options->siteUrl(); ?>">
                    <div class="nav-item">
                        <svg viewBox="0 0 24 24" class="nav-icon bi bi-home" fill="currentColor"><g><path fill-rule="evenodd" d="M22.58 7.35L12.475 1.897c-.297-.16-.654-.16-.95 0L1.425 7.35c-.486.264-.667.87-.405 1.356.18.335.525.525.88.525.16 0 .324-.038.475-.12l.734-.396 1.59 11.25c.216 1.214 1.31 2.062 2.66 2.062h9.282c1.35 0 2.444-.848 2.662-2.088l1.588-11.225.737.398c.485.263 1.092.082 1.354-.404.263-.486.08-1.093-.404-1.355zM12 15.435c-1.795 0-3.25-1.455-3.25-3.25s1.455-3.25 3.25-3.25 3.25 1.455 3.25 3.25-1.455 3.25-3.25 3.25z"></path></g></svg>
                        <span class="nav-item-text"><?php _e('首页'); ?></span>
                    </div>
                </a>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php utils::customNavHandle($this->options->customNavIcon, $pages, $this);?>
            </nav>
        </div>
    </div>
