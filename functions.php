<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once 'libs/contents.php';
require_once 'libs/options.php';
require_once 'libs/comments.php';
require_once 'libs/utils.php';
require_once 'libs/pageNav.php';
/**
 * 注册文章解析 hook
 * From AlanDecode(https://imalan.cn)
 */
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('contents','parseContent');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('contents','parseContent');
/**
 * 后台编辑按钮
 */
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('utils', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('utils', 'addButton');
/**
 * 评论接口 by 染念
 */
Typecho_Plugin::factory('Widget_Abstract_Comments')->contentEx = array('comments','parseContent');
Typecho_Plugin::factory('Widget_Feedback')->comment = array('comments','insertSecret');
/**
 * 文章与独立页自定义字段
 */
function themeFields($layout) {
    if (preg_match("/write-post.php/", $_SERVER['REQUEST_URI'])) {
        $banner = new \Typecho\Widget\Helper\Form\Element\Text('banner', NULL, NULL, '文章头图', '输入一个图片 url，作为缩略图显示在文章列表，没有则不显示');
        $layout->addItem($banner);
        $article_type = new \Typecho\Widget\Helper\Form\Element\Radio('article_type',
            array(0 => '默认',
                1 => '图文格式',
                2 => '九空格可点击',
                3 => '日记模式',
                4 => '九空格不可点击'),
            0, '文章列表模式', '<b>日记模式类似我的动态，不可点击</b>');
        $layout->addItem($article_type);
    }
}
function themeInit($archive){
    //暴力解决访问加密文章会被 pjax 刷新页面的问题
    if ($archive->hidden) header('HTTP/1.1 200 OK');
    //评论回复楼层最高999层.这个正常设置最高只有7层
    Helper::options()->commentsMaxNestingLevels = 999;
    //强制评论关闭反垃圾保护
    Helper::options()->commentsAntiSpam = false;
    //将最新的评论展示在前
    Helper::options()->commentsOrder = 'DESC';
    //关闭检查评论来源URL与文章链接是否一致判断
    Helper::options()->commentsCheckReferer = false;
    // 强制开启评论markdown
    Helper::options()->commentsMarkdown = '1';
    Helper::options()->commentsHTMLTagAllowed .= '<img class src alt><div class>';
    //  点赞
    if ($archive->request->isPost() && $archive->request->agree) {
        if ($archive->request->agree == $archive->cid) {
            exit(utils::agree($archive->cid));
        } elseif ($archive->is('index')) {
            exit(utils::agree($archive->request->agree));
        }
        exit('error');
    }
}

function get_comment($coid){
    $db = Typecho_Db::get();
    return $db->fetchRow($db->select()
            ->from('table.comments')
            ->where('coid = ?', $coid)
            ->limit(1));
}


/**
 * 显示下一篇
 *
 * @access public
 * @return void
 */
function theNext($widget)
{
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created > ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_ASC)
        ->limit(1);
    $content = $db->fetchRow($sql);

    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" target="_self">
                        <div class="button">
                            <div class="title" title="' . $content['title'] . '">下一篇 > </div>
                        </div>
                    </a>';
        echo $link;
    } else {
        echo '<div class="button btn2 off">
                  <div class="title">没有更多了</div>
              </div>';
    }
}

/**
 * 显示上一篇
 *
 * @access public
 * @return void
 */
function thePrev($widget)
{
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created < ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1);
    $content = $db->fetchRow($sql);
    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" target="_self">
                        <div class="button">
                            <div class="title" title="' . $content['title'] . '">< 上一篇</div>
                        </div>
                    </a>';
        echo $link;
    } else {
        echo '<div class="button btn2 off">
                  <div class="title">没有更多了</div>
              </div>';
    }
}

/**
 * 获取主题版本号
 */
function themeVersion() {
    $info = Typecho_Plugin::parseInfo(__DIR__ . '/index.php');
    return $info['version'];
}
