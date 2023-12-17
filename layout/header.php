<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/toastify.min.css');?>">
    <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/main.css');?>">
    <?php if(!$this->is('index')): ?>
        <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/extend/OwO.min.css');?>">
        <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/post.css');?>">
        <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/comments.css');?>">
        <link rel="stylesheet" href="<?php utils::indexTheme('assets/css/prism.css');?>">
    <?php endif; ?>

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
    
