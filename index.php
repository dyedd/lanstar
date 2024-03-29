<?php
/**
 * 自制简单主题，你的star就是我的动力
 *
 * @package Lanstar
 * @author 染念
 * @version 4.0.4
 * @link https://dyedd.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>
<div class="container">
    <div class="loader">
        <div class="plane"></div>
    </div>
    <div class="row">
        <div class="col col-lg-2 col-md-2 col-sm-2 col-xs-2 d-none d-lg-block left">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col-lg-10 col-md-12 col-xs-10">
            <div class="container">
                <div class="row">
                    <div class="main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <?php if ($this->options->notice): ?>
                            <div class="alert alert-primary" role="alert">
                                <?php $this->options->notice(); ?>
                            </div>
                        <?php endif; ?>
                        <?php $this->need('component/index.banner.php') ?>
                        <?php $this->need('component/index.category.php'); ?>
                        <div class="articles">
                            <?php $this->need('component/index.article.php'); ?>
                        </div>
                        <div class="page-pagination">
                            <?php $this->pageLink('加载更多','next'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 right d-none d-lg-block">
                        <?php $this->need('layout/right.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-lg-none" style="text-align:center">
            <?php $this->need('layout/footer.php'); ?>
        </div>
    </div>
</div>
<?php $this->need('component/js.php'); ?>
<div class="rainbow-loader" style="display: none;">
    <div class="loader-inner">
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
    </div>
</div>
</body>
</html>
