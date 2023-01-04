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
        <div class="col col-md-2 d-none d-md-block">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-md-8 col-12 main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <main class="article-main" id="post-<?php $this->cid(); ?>">
                            <!--文章内容-->
                            <div class="markdown-body article-content gallery">
                                <?php $this->content(); ?>
                            </div>
                            <?php $this->need('layout/comments.php'); ?>
                        </main>
                    </div>
                    <div class="col-12 col-md-3 position-relative right d-none d-md-block">
                        <?php $this->need('layout/right.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->need('component/js.php'); ?>
</body>
</html>
