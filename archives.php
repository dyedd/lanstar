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
        <div class="col col-md-2 d-none d-md-block">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-md-8 col-12 main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <main class="article-main" id="post-<?php $this->cid(); ?>">
                            <!--文章内容-->
                            <div class="markdown-body article-content gallery">
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
                    <div class="col-12 col-md-3 position-relative right d-none d-md-block">
                        <?php $this->need('layout/right.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-md-none">
            <?php $this->need('layout/footer.php'); ?>
        </div>
    </div>
</div>
<?php $this->need('component/js.php'); ?>
</body>
</html>
