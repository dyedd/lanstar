<?php
/**
 * 自制简单主题，你的star就是我的动力
 *
 * @package Lanstar
 * @author 染念
 * @version 4.0.1
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
        <div class="col col-md-2 d-none d-md-block">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-md-8 col-12 main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <?php $this->need('component/index.category.php'); ?>
                        <?php $this->need('component/index.banner.php') ?>
                        <div class="articles">
                            <?php $this->need('component/index.article.php'); ?>
                        </div>
                        <div class="page-pagination">
                            <?php $this->pageLink('加载更多','next'); ?>
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
