<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="search-bar">
    <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
        <input type="text" id="s" name="s" class="nav-search-input" placeholder="<?php _e('输入关键字搜索'); ?>">
        <button class="nav-search-btn" type="submit">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-sousuo"></use>
            </svg>
        </button>
    </form>
</div>
<?php if ($this->options->sidebarBlock && in_array('ShowBlogInfo', $this->options->sidebarBlock)): ?>
    <div class="card user-container">
        <div class="card-header user-info">
            <div class="info">
                <img class="pic" src="<?php $this->options->rightAvatar(); ?>" alt="博主">
            </div>
        </div>
        <p>
            <?php $this->options->rightName(); ?>
        </p>
        <div class="card-info-description"><?=  $this->options->rightMotto ? $this->options->rightMotto : '博主很懒，啥都没有'; ?></div>
        <?php Typecho_Widget::widget('Widget_Stat')->to($item); ?>
        <div class="count">
            <div class="item" title="累计文章数">
                <span class="num"><?=  number_format($item->publishedPostsNum); ?></span>
                <span>文章数</span>
            </div>
            <div class="item" title="累计评论数">
                <span class="num"><?=  number_format($item->publishedCommentsNum); ?></span>
                <span>评论量</span>
            </div>
            <div class="item" title="累计分类数">
                <span class="num"><?=  number_format($item->categoriesNum); ?></span>
                <span>分类数</span>
            </div>
            <div class="item" title="累计页面数">
                <span class="num"><?=  number_format($item->publishedPagesNum + $item->publishedPostsNum); ?></span>
                <span>页面数</span>
            </div>
        </div>
        <div class="card-icon">
            <a href="<?php $this->options->siteUrl(); ?>/feed" title="rss">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-rss"></use>
                </svg>
            </a>
            <?=  utils::handleRightIcon() ?>
        </div>
        <div class="time-text">
            <span>已在风雨中度过 <?=  utils::getBuildTime($this->options->startTime);?></span>
        </div>
    </div>
<?php endif; ?>
<?php if ($this->options->sidebarBlock && in_array('ShowYourCouple', $this->options->sidebarBlock)): ?>
    <div class="sidebar-box couple">
        <img class="pic" src="<?php $this->options->rightAvatar(); ?>" alt="博主">
        <img class="couple-love" src="<?php utils::indexTheme('assets/img/love.png'); ?>" alt="爱心">
        <img class="pic" src="<?php $this->options->taAvatar(); ?>" alt="另一半">
        <div id="our-company" data-start="<?php $this->options->company(); ?>"></div>
    </div>
<?php endif; ?>
<?php if ($this->options->sidebarBlock && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <?php if ($this->is('index')): ?>
        <div class="sidebar-box">
            <div class="p-3"><h6>最近消息</h6></div>
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
                                            class="text-muted"><?=  date('Y-m-d', $comments->created); ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if ($this->options->sidebarBlock && in_array('ShowInterestPosts', $this->options->sidebarBlock)): ?>
    <div class="sidebar-box">
        <div class="p-3"><h6>可能感兴趣</h6></div>
        <div class="sidebar-content px-3 pb-2">
            <?php utils::getRandomPosts(3); ?>
        </div>
    </div>
<?php endif; ?>
<?php $this->need('layout/footer.php'); ?>

