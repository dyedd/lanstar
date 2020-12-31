<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="article-info mb-3">
    <div class="article-detail">
        <h1 class="article-title p-3"><a href="<?php $this->permalink(); ?>">
                <?php $this->title(); ?></a>
            <?php if ($this->user->hasLogin()): ?>
                <a class="ms-1 article-edit" title="编辑"
                   href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-bianji"></use>
                    </svg>
                </a>
            <?php endif; ?>
        </h1>
        <p>
        <span class="article-detail-item">
            <svg class="icon me-1" aria-hidden="true">
                <use xlink:href="#icon-shijian"></use>
            </svg>
            <time class="create-time" datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time>
        </span>
            <span class="article-detail-item">
            <svg class="icon me-1" aria-hidden="true">
                <use xlink:href="#icon-redu"></use>
            </svg>
            <?php utils::getPostView($this); ?>阅读
        </span>
            <span class="article-detail-item">
            <svg class="icon me-1" aria-hidden="true">
                <use xlink:href="#icon-pinglun1"></use>
            </svg>
            <?php $this->commentsNum(); ?>条评论
        </span>
        </p>
    </div>
    <div class="article-cover-inner">
        <img src="<?php echo $this->fields->banner ?: utils::getAssets('img/default.jpg'); ?>" alt="cover">
    </div>
</section>
<main class="article-main">
    <!--面包屑导航-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pb-2">
            <li class="breadcrumb-item">
                <a href="<?php $this->options->siteUrl(); ?>">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-shouye1"></use>
                    </svg>
                    <span>首页</span>
                </a>
            </li>
            <?php if ($this->is('post')): ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-fenlei1"></use>
                    </svg>
                    <?php $this->category(','); ?>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-leimupinleifenleileibie"></use>
                    </svg>
                    <?php $this->archiveTitle('&raquo;', '', ''); ?>
                </li>
            <?php endif; ?>
        </ol>
    </nav>
    <!--文章内容-->
    <div class="article-content">
        <?php if ($this->hidden || $this->titleshow): ?>
            <form action="<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>"
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
                <span>作品采用：<?php echo $this->options->LicenseInfo ? $this->options->LicenseInfo : '本作品采用 <a rel="license nofollow" href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可。' ?></span>
            </div>
        </div>
    </div>
    <div class="article-action mt-1 d-flex justify-content-around">
        <div class="article-action-item p-3 d-flex align-items-center" id="agree-btn" data-cid="<?php $this->cid(); ?>">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-ziyuan"></use>
            </svg>
            <?php $agree = $this->hidden ? array('agree' => 0, 'recording' => true) : utils::agreeNum($this->cid); ?>
            <span class="agree-num"><?php echo $agree['agree']; ?></span>
        </div>
        <div class="article-action-item p-3">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-fenlei"></use>
            </svg>
        </div>
        <div class="article-action-item p-3">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-xinbaniconshangchuan-"></use>
            </svg>
        </div>
    </div>
    <div class="article-page d-flex justify-content-around align-items-center">
        <div class="article-page-item prev p-2">
            <?php thePrev($this); ?>
        </div>
        <div class="article-page-item p-2">
            <div class="button" id="article-list-btn">
                <div class="label">查看目录</div>
            </div>
        </div>
        <div class="article-page-item next p-2">
            <?php theNext($this); ?>
        </div>
    </div>
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