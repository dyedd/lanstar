<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-12 col-md-3 text-center text-md-left">
    <div class="card user-container">
        <div class="card-header user-info" style="background-image: url(<?php $this->options->rightImg()?>);">
            <div class="info">
                <img class="pic" src="<?php $this->options->rightAvatar();?>">
                <p><?php $this->options->rightName();?></p>
            </div>
        </div>
        <div class="card-footer user-detail">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <ul class="list-group list-group-horizontal">
                <li>
                    <div class="detail-title" title="文章">📝</div>
                    <div class="detail-num">
                        <?php $stat->publishedPostsNum(); ?>
                    </div>
                </li>
                <li>
                    <div class="detail-title" title="评论">💬</div>
                    <div class="detail-num">
                        <?php $stat->publishedCommentsNum(); ?>
                    </div>
                </li>
                <li>
                    <div class="detail-title" title="分类">🏷</div>
                    <div class="detail-num">
                        <?php $stat->categoriesNum(); ?>
                    </div>
                </li>
            </ul>
            <hr>

        </div>
    </div>
    <div class="card recent-box d-none d-md-block">
        <h4 class="title">最近回复</h4>
        <ul class="list-unstyled">
            <?php $this->widget('Widget_Comments_Recent', 'pageSize=3')->to($comments);?>
            <?php while ($comments->next()): ?>
                <li class="media my-4">
                    <img class="recent-avatar mr-3" src="//cdn.v2ex.com/gravatar/<?php echo md5($comments->mail); ?>?s=40&d=mp" />
                    <div class="media-body">
                        <h6 class="mt-0 mb-1"><?php $comments->author(false);?></h6>
                        <a class="content" href="<?php $comments->permalink();?>" target="<?php $this->options->sidebarLinkOpen();?>">
                            <?php $comments->excerpt(35, '...');?>
                        </a>
                    </div>
                </li>
            <?php endwhile;?>
        </ul>
    </div>
    <div class="random-post d-none d-md-block">
        <h4 class="title">可能感兴趣</h4>
        <?php theme_random_posts();?>
    </div>
    <?php $this->need('includes/footer.php');?>
</div>

