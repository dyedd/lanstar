<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col col-lg-2 col-md-2 col-sm-2 col-xs-2 d-none d-lg-block left">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col-lg-10 col-md-12 col-xs-10">
            <div class="container">
                <div class="row">
                    <div class="main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <?php $this->need('component/breadcrumb.content.php'); ?>
                        <?php $this->need('component/post.content.php'); ?>
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
</body>
</html>
