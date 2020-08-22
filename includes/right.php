<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-12 col-md-3 text-center text-md-left">
    <div class="random-post d-none d-md-block">
        <h4 class="title">可能感兴趣</h4>
        <?php theme_random_posts();?>
    </div>
    <?php $this->need('includes/footer.php');?>
</div>

