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
function themeFields(Typecho_Widget_Helper_Layout $layout) {
    if (preg_match("/write-post.php/", $_SERVER['REQUEST_URI'])) {
        $banner = new Typecho_Widget_Helper_Form_Element_Text('banner', NULL, NULL, _t('文章头图'), _t('输入一个图片 url，作为缩略图显示在文章列表，没有则不显示'));
        $layout->addItem($banner);
        $excerpt = new Typecho_Widget_Helper_Form_Element_Text('excerpt', NULL, NULL, _t('文章摘要'), _t('输入一段文本来自定义摘要，如果为空则自动提取文章前 70 字。'));
        $layout->addItem($excerpt);
    }
}
function themeInit($archive){
    //评论回复楼层最高999层.这个正常设置最高只有7层
    Helper::options()->commentsMaxNestingLevels = 999;
    //强制评论关闭反垃圾保护
    Helper::options()->commentsAntiSpam = false;
    //  点赞
    if ($archive->request->isPost() && $archive->request->agree) {
        if ($archive->request->agree == $archive->cid) {
            exit(utils::agree($archive->cid));
        }elseif ($archive->is('index')) {
            exit(utils::agree($archive->request->agree));
        }
        exit('error');
    }
}



function get_user_group($name = NULL){
    $db = Typecho_Db::get();
    if($name === NULL)
        $profile = $db->fetchRow($db->select('group', 'uid')->from('table.users')->where('uid = ?', intval(Typecho_Cookie::get('__typecho_uid'))));
    else
        $profile = $db->fetchRow($db->select('group', 'name', 'screenName')->from('table.users')->where('name=? OR screenName=?', $name, $name));
    return $profile['group'];
}
function get_comment($coid){
    $db = Typecho_Db::get();
    return $db->fetchRow($db->select()
            ->from('table.comments')
            ->where('coid = ?', $coid)
            ->limit(1));
}


/**
 * 时间友好化
 *
 * @access public
 * @param mixed
 * @return
 */
function formatTime($time){
    $text = '';
    $time = intval($time);
    $ctime = time();
    $t = $ctime - $time; //时间差
    if ($t < 0) {
        return date('Y-m-d', $time);
    }
    $y = date('Y', $ctime) - date('Y', $time);//是否跨年
    switch ($t) {
        case $t == 0:
            $text = '刚刚';
            break;
        case $t < 60://一分钟内
            $text = $t . '秒前';
            break;
        case $t < 3600://一小时内
            $text = floor($t / 60) . '分钟前';
            break;
        case $t < 86400://一天内
            $text = floor($t / 3600) . '小时前'; // 一天内
            break;
        case $t < 2592000://30天内
            if($time > strtotime(date('Ymd',strtotime("-1 day")))) {
                $text = '昨天';
            } elseif($time > strtotime(date('Ymd',strtotime("-2 days")))) {
                $text = '前天';
            } else {
                $text = floor($t / 86400) . '天前';
            }
            break;
        case $t < 31536000 && $y == 0://一年内 不跨年
            $m = date('m', $ctime) - date('m', $time) -1;
            if($m == 0) {
                $text = floor($t / 86400) . '天前';
            } else {
                $text = $m . '个月前';
            }
            break;
        case $t < 31536000 && $y > 0://一年内 跨年
            $text = (11 - date('m', $time) + date('m', $ctime)) . '个月前';
            break;
        default:
            $text = (date('Y', $ctime) - date('Y', $time)) . '年前';
            break;
    }
    return $text;
}
function theme_random_posts(){
    $defaults = array(
        'number' => 6,
        'before' => '<ul class="archive-posts">',
        'after' => '</ul>',
        'xformat' => '<li class="archive-post"> <a class="archive-post-title" href="{permalink}">{title}</a>
 </li>'
    );
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->limit($defaults['number'])
        ->order('RAND()');
    $result = $db->fetchAll($sql);
    echo $defaults['before'];
    foreach($result as $val){
        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
        echo str_replace(array('{permalink}', '{title}'),array($val['permalink'], $val['title']), $defaults['xformat']);
    }
    echo $defaults['after'];
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
                            <div class="label btn1">下一篇</div>
                            <div class="title" title="'. $content['title'] .'">'. $content['title'] .'</div>
                        </div>
                    </a>';
        echo $link;
    } else {
        echo '<div class="button btn2 off">
                  <div class="label">下一篇</div>
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
                            <div class="label btn1">上一篇</div>
                            <div class="title" title="'. $content['title'] .'">'. $content['title'] .'</div>
                        </div>
                    </a>';
        echo $link;
    } else {
        echo '<div class="button btn2 off">
                  <div class="label">上一篇</div>
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
