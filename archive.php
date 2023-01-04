<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col col-md-2 d-none d-md-block">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-md-8 col-12 main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <section class="article-info mb-3">
                            <div class="article-detail">
                                <h1 class="archive-title text-center p-3"><?php $this->archiveTitle(array(
                                        'category' => _t('分类 %s 下的文章'),
                                        'search' => _t('包含关键字 %s 的文章'),
                                        'tag' => _t('标签 %s 下的文章'),
                                        'author' => _t('%s 发布的文章')
                                    ), '', ''); ?></h1>
                            </div>
                            <div class="article-cover-inner">
                                <img src="<?=  $this->fields->banner ?: utils::indexTheme('assets/img/default.jpg'); ?>" alt="cover">
                            </div>
                        </section>
                        <?php if ($this->have()): ?>
                            <?php $this->need('component/index.article.php'); ?>
                        <?php else: ?>
                            <article class="post">
                                <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
                            </article>
                        <?php endif; ?>

                        <div class="page-pagination">
                            <?php
                            $this->pageNav(
                                '<svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zuo"></use>
                    </svg>',
                                '<svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-you"></use>
                    </svg>',
                                3, '...', array(
                                'wrapTag' => 'ul',
                                'wrapClass' => 'pagination justify-content-center',
                                'itemTag' => 'li',
                                'itemClass' => 'page-item',
                                'linkClass' => 'page-link',
                                'currentClass' => 'active'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 position-relative right d-none d-md-block">
                        <?php $this->need('layout/right.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-md-none">
            <?php $this->need('layout/footer.php'); ?>
        </div>
    </div>
</div>
<?php $this->need('component/js.php'); ?>
</body>
</html>
