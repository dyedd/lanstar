<?php
/**
 * 归档页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>
<div class="container">
    <div class="row">
        <?php $this->need('layout/left.php'); ?>
        <div class="col-xl-6 col-md-6 col-12" id="pjax-container">
            <?php $this->need('layout/head.php'); ?>
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
                    </p>
                </div>
                <div class="article-cover-inner">
                    <img src="<?php echo $this->fields->banner ?: utils::getAssets('img/default.jpg'); ?>" alt="cover">
                </div>
            </section>
            <main class="article-main" id="post-<?php $this->cid(); ?>">
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
                                    <use xlink:href="#icon-fenlei1"></use>
                                </svg>
                                <?php $this->archiveTitle('&raquo;', '', ''); ?>
                            </li>
                        <?php endif; ?>
                    </ol>
                </nav>
                <!--文章内容-->
                <div class="article-content">
                    <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true))->to($tags); ?>
                    <?php if ($tags->have()) : ?>
                        <div class="article-label">
                            <ul>
                                <?php while ($tags->next()) : ?>
                                    <li class="tags-item">
                                        <a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="article-archives">
                        <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
                        $year = 0;
                        $mon = 0;
                        $i = 0;
                        $j = 0;
                        $output = '';
                        while ($archives->next()) :
                            $year_tmp = date('Y', $archives->created);
                            $mon_tmp = date('m', $archives->created);
                            if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></div>';
                            if ($year != $year_tmp && $year > 0) $output .= '</ul></div>';
                            if ($mon != $mon_tmp) {
                                $mon = $mon_tmp;
                                $output .= '<div class="item"><span class="panel">' . $year_tmp . ' 年 ' . $mon . ' 月<svg class="icon" aria-hidden="true"><use xlink:href="#icon-xiala-"></use></svg></span><ul class="panel-body">';
                            }
                            $output .= '<li><a href="' . $archives->permalink . '">' . date('m/d：', $archives->created) . $archives->title . '</a>';
                            $output .= '</li>';
                        endwhile;
                        $output .= '</ul></div>';
                        echo $output;
                        ?>
                    </div>
                </div>
            </main>
        </div>
        <?php $this->need('layout/right.php'); ?>
    </div>
</div>
<?php $this->need('component/index.footer.php'); ?>
</body>
</html>
