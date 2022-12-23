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
    <div class="markdown-body article-content">
        <?php if ($this->hidden || $this->titleshow): ?>
            <form action="<?=  Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>"
                  class="protected">
                <div class="form-group mb-3 col-md-6 text-center required-password">
                    <label for="passwd">请输入密码访问</label>
                    <div class="input-group">
                        <input type="password" id="passwd" name="protectPassword" class="form-control text"
                               placeholder="请输入密码" aria-label="请输入密码">
                        <input type="hidden" name="protectCid" value="<?php $this->cid(); ?>"/>
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
    <p class="tags"><?php $this->tags(' ', true, ''); ?></p>
    <div class="license">
        <div class="content">
            <div class="item">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-yonghu"></use>
                </svg>
                <span>版权属于：<?php $this->author(); ?></span>
            </div>
            <div class="item">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-lianjie"></use>
                </svg>
                <span>本文链接：<a class="item-link" href="<?php $this->permalink(); ?>" title="转载时请注明本文出处及文章链接">
                <?php $this->permalink(); ?></a></span>
            </div>
            <div class="item">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-A1"></use>
                </svg>
                <span>作品采用：<?=  $this->options->LicenseInfo ? $this->options->LicenseInfo : '本作品采用 <a rel="license nofollow" href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可。' ?></span>
            </div>
        </div>
    </div>
    <div class="article-action mt-1 d-flex justify-content-around">
        <div class="article-action-item p-3 d-flex align-items-center" id="agree-btn" data-cid="<?php $this->cid(); ?>">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-ziyuan"></use>
            </svg>
            <?php $agree = $this->hidden ? array('agree' => 0, 'recording' => true) : utils::agreeNum($this->cid); ?>
            <span class="agree-num"><?=  $agree['agree']; ?></span>
        </div>
        <div class="article-action-item p-3">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-xinbaniconshangchuan-"></use>
            </svg>
        </div>
    </div>
    <div class="article-page">
        <div class="article-page-item prev">
            <?php thePrev($this); ?>
        </div>
        <div class="article-page-item next">
            <?php theNext($this); ?>
        </div>
    </div>
    <?php $this->need('layout/comments.php'); ?>
</main>
<section class="col-12 col-md-4 col-xl-3 article-catalog" id="tocTree">
    <h3 class="article-catalog-title">
        <?php _e('目录'); ?>
        <button type="button" class="btn-close float-end" aria-label="Close" id="catalog-close"></button>
    </h3>
    <div class="article-list-title">来自 《<?php $this->title(); ?>》</div>
    <ul class="article-catalog-list">
    </ul>
</section>
