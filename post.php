<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>
<div class="container">
    <div class="row">
        <?php $this->need('includes/nav.php');?>
        <div class="col-xl-7 col-md-6 col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php $this->options->siteUrl();?>">首页</a></li>
                    <?php if ($this->is('post')): ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php $this->title()?></li>
                    <?php else: ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php $this->archiveTitle('&raquo;','',''); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
            <?php if ($this->fields->banner && $this->fields->banner !=''):?>
                <div class="article-cover">
                    <div class="archive-cover-inner">
                        <img src="<?php echo $this->fields->banner;?>" alt="cover">
                    </div>
                </div>
            <? endif; ?>
            <article class="post">
                <h1 class="article-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                <div class="article-auth">
                    <?php echo $this->author->gravatar(32);?>
                    <a href="<?php $this->author->permalink(); ?>"><span><?php $this->author(); ?></span></a>
                </div>
                <div class="article-meta">
                    <span class="article-category">
                        <?php $this->category(' ');?>
                    </span>
                    <time class="create-time" daetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time>
                    <div class="article-data"><span><?php contents::get_post_view($this);?>阅读</span><span>0点赞</span></div>
                </div>
                <div class="article-content">
                    <?php $this->content(); ?>
                </div>
                <p class="tags"><?php $this->tags(' ', true, ''); ?></p>
                <div class="article-list-plane d-flex justify-content-around">
                    <div class="p-2">
                        <?php thePrev($this); ?>
                    </div>
                    <div class="p-2">
                        <div class="button" id="article-list-btn">
                            <div class="label">查看目录</div>
                        </div>
                    </div>
                    <div class="p-2">
                        <?php theNext($this); ?>
                    </div>
                </div>
            </article>
            <div id="article-catalog"></div>
            <?php $this->need('includes/comments.php'); ?>

        </div>
        <?php $this->need('includes/right.php');?>
    </div>
</div>
