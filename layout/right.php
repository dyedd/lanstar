<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-12 col-md-3 position-relative">
    <div class="card user-container">
        <div class="card-header user-info">
            <div class="info<?php if ($this->options->couple):echo ' couple'; endif; ?>">
                <?php if ($this->options->couple): ?>
                    <div class="row">
                        <div class="col-5">
                            <img class="pic" src="<?php $this->options->rightAvatar(); ?>" alt="博主">
                        </div>
                        <div class="col-2">
                            <img class="couple-love" src="<?php utils::indexTheme('assets/img/love.png'); ?>" alt="爱心">
                        </div>
                        <div class="col-5">
                            <img class="pic" src="<?php $this->options->taAvatar(); ?>" alt="另一半">
                        </div>
                    </div>
                <?php else: ?>
                    <img class="pic" src="<?php $this->options->rightAvatar(); ?>" alt="博主">
                <?php endif; ?>
            </div>
        </div>
        <p>
            <?php $this->options->rightName(); ?>
            <svg class="icon" aria-hidden="true" style="width: 1em;">
                <use xlink:href="#icon-renzheng"></use>
            </svg>
        </p>
        <div class="card-info-description"><?php echo $this->options->rightMotto ? $this->options->rightMotto : '博主很懒，啥都没有'; ?></div>
        <?php if ($this->options->couple): ?>
            <div id="our-company" data-start="<?php $this->options->company(); ?>"></div>
        <?php endif; ?>
        <div class="card-footer user-detail">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <ul class="list-group list-group-horizontal">
                <li>
                    <div class="detail-title" title="文章">
                        📝
                    </div>
                    <div class="detail-num">
                        <?php $stat->publishedPostsNum(); ?>
                    </div>
                </li>
                <li>
                    <div class="detail-title" title="评论">
                        💬
                    </div>
                    <div class="detail-num">
                        <?php $stat->publishedCommentsNum(); ?>
                    </div>
                </li>
                <li>
                    <div class="detail-title" title="分类">
                        💊
                    </div>
                    <div class="detail-num">
                        <?php $stat->categoriesNum(); ?>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-icon">
            <a href="<?php $this->options->siteUrl(); ?>/feed" title="rss"><i class="iconfont icon-rss"></i></a>
            <?php echo utils::handleRightIcon() ?>
        </div>
    </div>
    <?php if ($this->is('index')): ?>
        <div class="sidebar-box d-none d-md-block">
            <div class="p-3"><h6>最近回复</h6></div>
            <div class="sidebar-content px-4">
                <?php $this->widget('Widget_Comments_Recent', 'ignoreAuthor=true&pageSize=5')->to($comments); ?>
                <?php while ($comments->next()): ?>
                    <div class="sidebar-reply mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <img class="rounded-circle sidebar-reply-img"
                                     src="<?php utils::emailHandle($comments->mail); ?>s=100"/>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title"><?php $comments->author(false); ?></h5>
                                    <p class="card-text">
                                        <a class="sidebar-reply-content" href="<?php $comments->permalink(); ?>"
                                           target="_blank">
                                            <?php contents::parseHide($comments->excerpt(35, '...')); ?>
                                        </a>
                                    </p>
                                    <p class="card-text"><small
                                                class="text-muted"><?php echo date('Y-m-d', $comments->created); ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="sidebar-box">
        <div class="p-3"><h6>可能感兴趣</h6></div>
        <div class="sidebar-content px-3 pb-2">
            <?php utils::getRandomPosts(3); ?>
        </div>
    </div>
    <?php $this->need('layout/footer.php'); ?>
</div>

