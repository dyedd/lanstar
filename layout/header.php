<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
<body style="background-image:url('<?php echo utils::indexTheme('assets/img/bg.png'); ?>')">
    
