<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <link rel="stylesheet"
          href="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@' . themeVersion() . '/assets/css/main.min.css'; else:utils::indexTheme('assets/css/main.css'); endif ?>">
    <link rel="stylesheet"
          href="<?php if ($this->options->cdn): echo 'https://cdn.jsdelivr.net/gh/dyedd/lanstar@' . themeVersion() . '/assets/css/gazeimg.min.css'; else:utils::indexTheme('assets/css/gazeimg.css'); endif ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.1/build/styles/darcula.min.css">
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
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-1 col-md-6">
                <div class="logo-box">
                    <?php if ($this->options->logoUrl): ?>
                        <img class="site-logo" title="<?php $this->options->description(); ?>"
                             src="<?php $this->options->logoUrl(); ?>" alt="logo">
                    <?php else: ?>
                        <img class="site-logo" title="<?php $this->options->description(); ?>"
                             src="<?php utils::indexTheme('assets/img/logo.png'); ?>" alt="logo">
                    <?php endif; ?>
                    <b class="logo-shine"></b>
                </div>
            </div>
            <div class="col">
                <button class="float-end d-block d-md-none mobile-nav" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mobile-nav"
                        aria-expanded="false" aria-controls="mobile-nav">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-daohang1"></use>
                    </svg>
                </button>
                <button class="float-end chose-mode-day float-right" id="night-mode" type="button">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-yueliang"></use>
                    </svg>
                </button>
                <button class="float-end chose-mode-moon float-right" id="night-mode" type="button">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-taiyang"></use>
                    </svg>
                </button>
                <button class="search-area float-end" type="button" data-bs-toggle="collapse"
                        data-bs-target="#search-block" aria-expanded="false" aria-controls="search-block">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-sousuo"></use>
                    </svg>
                </button>
            </div>
            <div class="search-block collapse" id="search-block">
                <h4>
                    搜索
                    <button type="button" class="btn-close close float-end" aria-label="Close"></button>
                </h4>
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" id="s" name="s" class="text form-control"
                           placeholder="<?php _e('输入关键字搜索'); ?>"/>
                    <button type="submit" class="btn btn-primary float-right search-button"><?php _e('搜索'); ?></button>
                </form>
            </div>
        </div>
    </div>
    <section id="progress" class="progress"></section>
</header>
    
    
