<?php
class comments {
    public static function parseContent($text,$widget,$lastResult)
    {
        $text = empty($lastResult)?$text:$lastResult;
        Helper::options()->commentsHTMLTagAllowed .= '<img src alt><div class>';
        if ($widget instanceof Widget_Abstract_Comments) {
            //owo
            $text = contents::parseOwo($text);
            $text = self::parseSecret($text);
        }
        return $text;
    }
    public static function parseSecret($text)
    {
        $reg = '/\[secret\](.*?)\[\/secret\]/sm';
        if (preg_match($reg, $text)) {
            $user = Typecho_Widget::widget('Widget_User');
            $db = Typecho_Db::get();
            $sql = $db->select()->from('table.comments')
                ->where('cid = ?', Typecho_Widget::widget('Widget_Archive')->cid)
                ->where('mail = ?', Typecho_Widget::widget('Widget_Archive')->remember('mail',true))
                ->limit(1);
            $result = $db->fetchAll($sql);
            if ($user->hasLogin() || $result) {
                $text = preg_replace($reg, '私密的回复:${1}', $text);
            } else {
                $text = preg_replace($reg, '<div class="secret text-center">该评论仅登录用户及评论双方可见</div>', $text);
            }
        }
        return $text;
    }
    public static function insertSecret($comment) {
        if ($_POST['secret']) {
            $comment['text'] = '[secret]' .  $comment['text'] . '[/\secret]';
        }
        return $comment;
    }
}
