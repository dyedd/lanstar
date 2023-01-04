<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/APlayer.min.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/toastify.min.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/OwO.min.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/nprogress.min.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/main.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/post.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/comments.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/prism.css');?>">
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- 通过自有函数输出HTML头部信息 -->
    <meta itemprop="image"
          content="<?php if ($this->fields->banner && $this->fields->banner != ''):$this->fields->banner();
          else: echo explode(PHP_EOL, $this->options->bannerUrl)[0]; endif; ?>"/>
    <meta name="description" itemprop="description" content="<?php if ($this->is('index')) {
        $this->options->description();
    } elseif ($this->is('category')) {
        echo $this->getDescription();
    } elseif ($this->is('single')) {
        $this->excerpt(200, '');
    } ?>">
    <?php $this->header('description=&generator=&template=&pingback=&xmlrpc=&wlw=&commentReply=&rss1=&rss2=&atom='); ?>
    <?php $this->options->cssEcho(); ?>
    <?php $this->options->headerEcho(); ?>
</head>
<body style="background-image:url('<?=  utils::indexTheme('assets/img/bg.png'); ?>')">
<div class="container mobile-nav d-md-none">
    <header class="d-flex flex-wrap justify-content-center mb-4">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <?php if ($this->options->logoUrl): ?>
                <img class="site-logo" title="<?php $this->options->description(); ?>"
                     src="<?php $this->options->logoUrl(); ?>" alt="logo">
            <?php else: ?>
                <img class="site-logo" title="<?php $this->options->description(); ?>"
                     src="<?php utils::indexTheme('assets/img/logo.png'); ?>" alt="logo">
            <?php endif; ?>
            <span class="fs-4 ms-3 text"><?php $this->options->title(); ?></span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="<?php $this->options->siteUrl(); ?>" <?php if ($this->is('index')): ?> class="nav-link active"<?php else: ?> class="nav-link"<?php endif; ?> aria-current="page">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-shouye"></use>
                    </svg>
                    <span class="nav-item-text">首页</span>
                </a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php utils::customNavHandle($this->options->customNavIcon, $pages, $this,1); ?>
            <?php if ($this->user->hasLogin()): ?>
                <li class="nav-item"><a href="<?php $this->options->adminUrl(); ?>" class="nav-link">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-shezhi"></use>
                        </svg>
                        <span class="nav-item-text">后台</span>
                    </a></li>
            <?php endif; ?>
        </ul>
    </header>
</div>
    
