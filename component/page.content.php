<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="article-info mb-3">
    <div class="article-detail">
        <h1 class="article-title p-3"><a href="<?php $this->permalink(); ?>">
                <?php $this->title(); ?></a>
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
</main>