<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/aplayer/1.9.1/APlayer.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/toastify-js/1.11.2/toastify.min.css">
    <link rel="stylesheet"
          href="<?php utils::indexTheme('assets/css/main.css');?>">
    <link rel="stylesheet"
          href="<?php utils::indexTheme('assets/css/post.css');?>">
    <link rel="stylesheet"
          href="<?php utils::indexTheme('assets/css/comments.css');?>">
    <link rel="stylesheet"
          href="<?php utils::indexTheme('assets/css/OwO.min.css');?>">
    <link rel="stylesheet"
          href="<?php utils::indexTheme('assets/css/prism.css');?>">
    <link rel="stylesheet"
          href="https://cdn.staticfile.org/nprogress/0.2.0/nprogress.min.css">
    <script src="<?php utils::indexTheme('assets/js/lanstarApp.js'); ?>"></script>
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
    
