<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once 'libs/contents.php';
require_once 'libs/options.php';
require_once 'libs/utils.php';
require_once 'libs/pageNav.php';
/**
 * 注册文章解析 hook
 * From AlanDecode(https://imalan.cn)
 */
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('contents','parseContent');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('contents','parseContent');

/**
 * 文章与独立页自定义字段
 */
function themeFields(Typecho_Widget_Helper_Layout $layout) {
    $banner = new Typecho_Widget_Helper_Form_Element_Text('banner', NULL, NULL,_t('文章头图'), _t('输入一个图片 url，作为缩略图显示在文章列表，没有则不显示'));
    $layout->addItem($banner);
    $excerpt = new Typecho_Widget_Helper_Form_Element_Text('excerpt', NULL, NULL,_t('文章摘要'), _t('输入一段文本来自定义摘要，如果为空则自动提取文章前 70 字。'));
    $layout->addItem($excerpt);
}
function themeInit($archive){
    //评论回复楼层最高999层.这个正常设置最高只有7层
    Helper::options()->commentsMaxNestingLevels = 999;
    //强制评论关闭反垃圾保护
    Helper::options()->commentsAntiSpam = false;
    if ($archive->is('single')){
    		$archive->content = image_class_replace($archive->content);
    }
}

function image_class_replace($content){
    $content = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#', '<a$1 href="$2$3"$5 target="_blank">', $content);
    return $content;
}

function img_postthumb($html) { 
	preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $html, $thumbUrl);  //通过正则式获取图片地址
	
	if(isset($thumbUrl[1][0])){
		$img_src = $thumbUrl[1][0];  //将赋值给img_src
		$img_counter = count($thumbUrl[0]);  //一个src地址的计数器
		 
		switch ($img_counter > 0) {
			case $allPics = 1:
			return $img_src;  //当找到一个src地址的时候，输出缩略图
			break;
			default:
			echo '';  //没找到(默认情况下)，不输出任何内容
		}
	} else {
		return false;
	}
}

function get_user_title($name = NULL){
    $options = Helper::options();
    switch(get_user_group($name)){
        case 'administrator':
            return isset($options->groupTitleA) ? $options->groupTitleA: ''; break;
        case 'editor':
            return isset($options->groupTitleE) ? $options->groupTitleE: ''; break;
        case 'contributor':
            return isset($options->groupTitleC) ? $options->groupTitleC: ''; break;
        case 'subscriber':
            return isset($options->groupTitleS) ? $options->groupTitleS: ''; break;
        case 'visitor':
            return isset($options->groupTitleV) ? $options->groupTitleV: ''; break;
    }
    return isset($options->groupTitleV) ? $options->groupTitleV: '';
}
function get_user_group($name = NULL){
    $options = Helper::options();
    $db = Typecho_Db::get();
    if($name === NULL)
        $profile = $db->fetchRow($db->select('group', 'uid')->from('table.users')->where('uid = ?', intval(Typecho_Cookie::get('__typecho_uid'))));
    else
        $profile = $db->fetchRow($db->select('group', 'name', 'screenName')->from('table.users')->where('name=? OR screenName=?', $name, $name));
    if(sizeof($profile) == 0) return isset($options->groupTitleV) ? $options->groupTitleV: '';
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
                            <div class="label btn1">下一篇 &gt;</div>
                            <div class="title text-right" title="'. $content['title'] .'">'. $content['title'] .'</div>
                        </div>
                    </a>';
        echo $link;
    } else {
        echo '<div class="button btn2 off">
                  <div class="label">下一篇 &gt;</div>
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
                            <div class="label btn1">&lt; 上一篇</div>
                            <div class="title text-left" title="'. $content['title'] .'">'. $content['title'] .'</div>
                        </div>
                    </a>';
        echo $link;
    } else {
        echo '<div class="button btn2 off">
                  <div class="label">&lt; 上一篇</div>
                  <div class="title">没有更多了</div>
              </div>';
    }
}
