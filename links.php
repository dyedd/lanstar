<?php
/**
 * 友情链接
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>
<div class="container">
    <div class="row">
        <?php $this->need('layout/left.php'); ?>
        <div class="col-xl-6 col-md-6 col-12" id="pjax-container">
            <?php $this->need('layout/head.php'); ?>
            <section class="article-info mb-3">
                <div class="article-detail">
                    <h1 class="article-title p-3"><a href="<?php $this->permalink(); ?>">
                            <?php $this->title(); ?></a>
                    </h1>
                    <p>
        <span class="article-detail-item">
            <svg class="icon me-1" aria-hidden="true">
                <use xlink:href="#icon-shijian"></use>
            </svg>
            <time class="create-time" datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time>
        </span>
                    </p>
                </div>
                <div class="article-cover-inner">
                    <img src="<?php echo $this->fields->banner ?: utils::getAssets('img/default.jpg'); ?>" alt="cover">
                </div>
            </section>
            <main class="article-main" id="post-<?php $this->cid(); ?>">
                <!--面包屑导航-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pb-2">
                        <li class="breadcrumb-item">
                            <a href="<?php $this->options->siteUrl(); ?>">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-shouye1"></use>
                                </svg>
                                <span>首页</span>
                            </a>
                        </li>
                        <?php if ($this->is('post')): ?>
                            <li class="breadcrumb-item active" aria-current="page">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-fenlei1"></use>
                                </svg>
                                <?php $this->category(','); ?>
                            </li>
                        <?php else: ?>
                            <li class="breadcrumb-item active" aria-current="page">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-fenlei1"></use>
                                </svg>
                                <?php $this->archiveTitle('&raquo;', '', ''); ?>
                            </li>
                        <?php endif; ?>
                    </ol>
                </nav>
                <!--文章内容-->
                <div class="article-content">
                    <?php $this->content(); ?>
                </div>
            </main>
            <?php $this->need('layout/comments.php'); ?>

        </div>
        <?php $this->need('layout/right.php'); ?>
    </div>
</div>
<?php $this->need('component/index.footer.php'); ?>
</body>
</html>
