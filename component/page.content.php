<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="article-info">
    <div class="article-cover-inner">
        <img src="<?=  $this->fields->banner ?: utils::indexTheme('assets/img/default.jpg'); ?>" alt="cover">
    </div>
    <div class="article-detail">
        <h1 class="article-title">
            <?php if ($this->user->hasLogin()): ?>
                <a class="article-edit" title="编辑"
                   href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?=  $this->cid; ?>">
                    <span><?php $this->title(); ?></span>
                </a>
            <?php else: ?>
                <span><?php $this->title(); ?></span>
            <?php endif; ?>
        </h1>
        <div class="post-info">
            <div class="created">
                <time datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time>
            </div>
            <div class="avatar">
                <img src="<?php utils::emailHandle($this->author->mail) ?>s=100"
                     alt="<?php  $this->author->screenName() ?>">
            </div>
            <div class="display">
                <div class="name"><?php $this->author->screenName(); ?></div>
            </div>
            <div class="extra">
                <div class="post-info-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-redu"></use>
                    </svg>
                    <?php utils::getPostView($this); ?>阅读
                </div>
                <div class="post-info-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-pinglun"></use>
                    </svg>
                    <?php $this->commentsNum(); ?>条评论
                </div>
            </div>
        </div>
    </div>
</section>
<main class="article-main">
    <!--文章内容-->
    <div class="markdown-body article-content gallery">
        <?php if ($this->hidden || $this->titleshow): ?>
            <form action="<?=  Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>"
                  class="protected">
                <div class="form-group mb-3 col-md-12 text-center">
                    <label for="passwd">请输入密码访问</label>
                    <div class="input-group">
                        <input type="password" id="passwd" name="protectPassword" class="form-control text"
                               placeholder="请输入密码" aria-label="请输入密码">
                        <input type="hidden" name="protectCID" value="<?php $this->cid(); ?>"/>
                        <div class="input-group-append">
                            <button class="btn btn-primary protected-btn" type="button">提交</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <?php $this->content(); ?>
        <?php endif; ?>
    </div>
    <div class="other">
        <div class="modified">
            更新于: <?= date('Y年m月d日 H:i', $this->modified) ?>
        </div>
    </div>
    <?php $this->need('layout/comments.php'); ?>
</main>
