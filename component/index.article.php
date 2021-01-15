<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php while ($this->next()): ?>
    <div class="article-list">
        <?php if ($this->fields->banner && $this->fields->banner != ''): ?>
            <div class="post-cover">
                <img src="<?php $this->fields->banner(); ?>" alt="cover">
            </div>
        <?php endif; ?>
        <article>
            <?php $this->sticky(); ?>
            <div class="row">
                <div class="col-2 col-xl-1 post-author">
                    <a href="<?php $this->author->permalink(); ?>">
                        <img class="avatar"
                             src="<?php utils::emailHandle($this->author->mail); ?>s=100"
                             alt="<?php $this->author(); ?>"/>
                    </a>
                </div>
                <div class="col-10 col-xl-11 post-body">
                    <div class="post-meta">
                <span class="item">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-A"></use>
                    </svg>
                    <?php echo formatTime($this->created); ?>
                </span>
                        <span class="item">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-chakan"></use>
                    </svg>
                    <?php utils::getPostView($this); ?>
                </span>
                        <span class="item">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-pinglun"></use>
                    </svg>
                   <?php $this->commentsNum('0', '1', '%d'); ?>
                </span>
                        <span class="item d-none d-md-inline-block">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-A2"></use>
                    </svg>
                   <?php utils::artCount($this->cid); ?>
                </span>
                    </div>
                    <a href="<?php $this->permalink(); ?>" class="post-title">
                        <?php $this->title(); ?>
                    </a>
                    <div class="post-excerpt">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-neirong"></use>
                        </svg>
                        <?php if ($this->fields->excerpt && $this->fields->excerpt != ''): ?>
                            <?php $this->fields->excerpt(); ?>
                        <?php else: ?>
                            <?php $this->excerpt(100); ?>
                        <?php endif; ?>
                    </div>
                    <div class="post-category">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-fenlei"></use>
                        </svg>
                        <?php $this->category(','); ?>
                    </div>
                    <div class="post-action">
                        <a class="post-more" target="_blank" href="<?php $this->permalink(); ?>">查看更多</a>
                        <a class="post-like" data-cid="<?php $this->cid(); ?>">
                            <?php $agree = $this->hidden ? array('agree' => 0, 'recording' => true) : utils::agreeNum($this->cid); ?>
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-dianzan"></use>
                            </svg>
                            <b class="agree-num"><?php echo $agree['agree']; ?></b>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>
<?php endwhile; ?>