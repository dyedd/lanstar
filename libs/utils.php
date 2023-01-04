<?php
error_reporting(0);
class utils
{
    /**
     * 首页幻灯片的处理
     * @param $content
     * @return string
     */
    public static function bannerHandle($content)
    {
        if(empty($content)) {
            $content = Helper::options()->themeUrl("", "lanstar/assets/img").'/bg.jpg|'.'#'.'|标题|简介';
        }
        $bannerArr = explode(PHP_EOL, $content);
        $text = '';
        if (count($bannerArr) > 3) {
            //打乱数组
            shuffle($bannerArr);
            $bannerArr = array_slice($bannerArr, 0, 3);
        }
        foreach ($bannerArr as $key => $banner) {
            $bannerInfo = explode('|', $banner);
            $active = $a = '';
            //激活幻灯片
            if($key == 0){
                $active = ' active';
            }
            if (preg_match('{[a-zA-z]+://[^\s]*}', $bannerInfo[1])) {
                $a = '<a href="' . $bannerInfo[1] . '" target="_blank" class="carousel_link">';
            }
            if(count($bannerInfo) > 4){
                $style = '<h5 style="color: '.$bannerInfo[4].';font-size: '.$bannerInfo[6].'rem">' . $bannerInfo[2] . '</h5>
                            <p style="color: '.$bannerInfo[5].';font-size: '.$bannerInfo[7].'rem">' . $bannerInfo[3] . '</p>';
            }else{
                $style = '<h5>' . $bannerInfo[2] . '</h5><p>' . $bannerInfo[3] . '</p>';
            }
            $text .= '<div class="carousel-item'. $active .'">'. $a .
                '<img class="lazy" src="' . utils::addLoadingImages(Helper::options()->loading_image) . '" data-src="' .
                $bannerInfo[0] .
                '" class="d-block w-100" alt="banner"><div class="carousel-caption d-none d-md-block">'.$style.'</div></a></div>';
        }
        return $text;
    }

    /**
     * 判断插件是否可用（存在且已激活）
     * @param $name
     * @return bool
     */
    public static function hasPlugin($name)
    {
        $plugins = Typecho_Plugin::export();
        $plugins = $plugins['activated'];
        return is_array($plugins) && array_key_exists($name, $plugins);
    }

    /**
     * 给导航添加图标
     * @param $nav
     * @param $pages
     * @param $that
     * @param int $mode
     */
    public static function customNavHandle($nav, $pages, $that, $mode=0)
    {
        $navArr = explode(PHP_EOL, $nav);
        $content = '';
        if (empty($navArr[0])) {
            $count = 0;
        } else {
            $count = count($navArr);
            $start = count($navArr);
        }
        while ($pages->next()) {
            if ($that->is('page', $pages->slug)):
                $class = "nav-link active";
            else:
                $class = "nav-link";
            endif;
            if($mode == 0){

                if ($count) {
                    $content .= '
                <div class="nav-item">
                    <a class="' . $class . '" href="' . $pages->permalink . '" title="' . $pages->title . '">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#' . $navArr[$start - $count] . '"></use>
                            </svg>
                            <span class="nav-item-text">' . $pages->title . '</span>
                    </a>
                </div>';
                    $count--;
                } else {
                    $content .= '<div class="nav-item">
                    <a class="' . $class . '" href="' . $pages->permalink . '" title="' . $pages->title . '">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-daohang"></use>
                            </svg>
                            <span class="nav-item-text">' . $pages->title . '</span>
                    </a></div>';
                }
            }else{
                if ($count) {
                    $content .= '
                <li class="nav-item">
                    <a class="' . $class . '" href="' . $pages->permalink . '" title="' . $pages->title . '">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#' . $navArr[$start - $count] . '"></use>
                            </svg>
                            <span class="nav-item-text">' . $pages->title . '</span>
                    </a>
                </li>';
                    $count--;
                } else {
                    $content .= '<li class="nav-item">
                    <a class="' . $class . '" href="' . $pages->permalink . '" title="' . $pages->title . '">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-daohang"></use>
                            </svg>
                            <span class="nav-item-text">' . $pages->title . '</span>
                    </a></li>';
                }
            }
        }
        echo $content;
    }

    /**
     * 文章中文字数统计
     * @param $cid
     */
    public static function artCount($cid)
    {
        $db = Typecho_Db::get();
        $rs = $db->fetchRow($db->select('table.contents.text')->from('table.contents')->where('table.contents.cid=?', $cid)->order('table.contents.cid', Typecho_Db::SORT_ASC)->limit(1));
        $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
        echo mb_strlen($text, 'UTF-8');
    }

    /**
     * 文章阅读次数统计
     * @param $archive
     */
    public static function getPostView($archive)
    {
        $cid = $archive->cid;
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
            echo 0;
            return;
        }
        $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
        if ($archive->is('single')) {
            $views = Typecho_Cookie::get('extend_contents_views');
            if (empty($views)) {
                $views = array();
            } else {
                $views = explode(',', $views);
            }
            if (!in_array($cid, $views)) {
                $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
                array_push($views, $cid);
                $views = implode(',', $views);
                Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            }
        }
        echo $row['views'];
    }

    /**
     * 编辑界面添加Button
     *
     * @return void
     */
    public static function addButton()
    {
        echo '<script src="';
        self::indexTheme('/assets/js/extend/icon.js');
        echo '"></script>';
        echo '<script src="';
        self::indexTheme('/assets/js/extend/OwO.js');
        echo '"></script>';
        echo '<script>let owoPath ="';
        self::indexTheme('assets/owo/OwO.json');
        echo '"</script>';

        echo '<script src="';
        self::indexTheme('/assets/js/editor.js');
        echo '"></script>';

        echo '<link rel="stylesheet" href="';
        self::indexTheme('/assets/css//extend/OwO.min.css');
        echo '" />';

        echo '<style>#custom-field textarea,#custom-field input{width:100%}
        .OwO span{background:none!important;width:unset!important;height:unset!important}
        .OwO .OwO-body .OwO-items{
            -webkit-overflow-scrolling: touch;
            overflow-x: hidden;
        }
        .OwO .OwO-body .OwO-items-image .OwO-item{
            max-width:-moz-calc(20% - 10px);
            max-width:-webkit-calc(20% - 10px);
            max-width:calc(20% - 10px)
        }
        @media screen and (max-width:767px){	
            .comment-info-input{flex-direction:column;}
            .comment-info-input input{max-width:100%;margin-top:5px}
            #comments .comment-author .avatar{
                width: 2.5rem;
                height: 2.5rem;
            }
        }
        @media screen and (max-width:760px){
            .OwO .OwO-body .OwO-items-image .OwO-item{
                max-width:-moz-calc(25% - 10px);
                max-width:-webkit-calc(25% - 10px);
                max-width:calc(25% - 10px)
            }
        }
        .wmd-button-row{height:unset}
        .icon {
           width: 1.2em; height: 1.2em;
           vertical-align: -0.15em;
           fill: currentColor;
           overflow: hidden;
        }
        .wmd-button {color: #9e9e9e;}
        </style>';
    }

    public static function agreeNum($cid)
    {
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();

        //  判断点赞数量字段是否存在
        if (!array_key_exists('agree', $db->fetchRow($db->select()->from('table.contents')))) {
            //  在文章表中创建一个字段用来存储点赞数量
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `agree` INT(10) NOT NULL DEFAULT 0;');
        }

        //  查询出点赞数量
        $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
        //  获取记录点赞的 Cookie
        $AgreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
        //  判断记录点赞的 Cookie 是否存在
        if (empty($AgreeRecording)) {
            //  如果不存在就写入 Cookie
            Typecho_Cookie::set('typechoAgreeRecording', json_encode(array(0)));
        }

        //  返回
        return array(
            //  点赞数量
            'agree' => $agree['agree'],
            //  文章是否点赞过
            'recording' => in_array($cid, json_decode(Typecho_Cookie::get('typechoAgreeRecording'))) ? true : false
        );
    }

    public static function agree($cid)
    {
        $db = Typecho_Db::get();
        //  根据文章的 `cid` 查询出点赞数量
        $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));

        //  获取点赞记录的 Cookie
        $agreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
        //  判断 Cookie 是否存在
        if (empty($agreeRecording)) {
            //  如果 cookie 不存在就创建 cookie
            Typecho_Cookie::set('typechoAgreeRecording', json_encode(array($cid)));
        } else {
            //  把 Cookie 的 JSON 字符串转换为 PHP 对象
            $agreeRecording = json_decode($agreeRecording);
            //  判断文章是否点赞过
            if (in_array($cid, $agreeRecording)) {
                //  如果当前文章的 cid 在 cookie 中就返回文章的赞数，不再往下执行
                return $agree['agree'];
            }
            //  添加点赞文章的 cid
            array_push($agreeRecording, $cid);
            //  保存 Cookie
            Typecho_Cookie::set('typechoAgreeRecording', json_encode($agreeRecording));
        }

        //  更新点赞字段，让点赞字段 +1
        $db->query($db->update('table.contents')->rows(array('agree' => (int)$agree['agree'] + 1))->where('cid = ?', $cid));
        //  查询出点赞数量
        $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
        //  返回点赞数量
        return $agree['agree'];
    }

    public static function compressHtml($html_source)
    {
        $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
        $compress = '';
        foreach ($chunks as $c) {
            if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
                $c = substr($c, 19, strlen($c) - 19 - 20);
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
                $c = substr($c, 12, strlen($c) - 12 - 13);
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
                $compress .= $c;
                continue;
            } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, PHP_EOL) !== false || strpos($c, PHP_EOL) !== false)) {
                $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
                $c = '';
                foreach ($tmps as $tmp) {
                    if (strpos($tmp, '//') !== false) {
                        if (substr(trim($tmp), 0, 2) == '//') {
                            continue;
                        }
                        $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                        $is_quot = $is_apos = false;
                        foreach ($chars as $key => $char) {
                            if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                                $is_quot = !$is_quot;
                            } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                                $is_apos = !$is_apos;
                            } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                                $tmp = substr($tmp, 0, $key);
                                break;
                            }
                        }
                    }
                    $c .= $tmp;
                }
            }
            $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
            $c = preg_replace('/\\s{2,}/', ' ', $c);
            $c = preg_replace('/>\\s</', '> <', $c);
            $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
            $c = preg_replace('/<!--[^!]*-->/', '', $c);
            $compress .= $c;
        }
        return $compress;
    }


    /**
     * 输出相对首页路由，本方法会自适应伪静态，用于动态文件
     * @param string $path
     */
    public static function index($path = '')
    {
        Helper::options()->index($path);
    }

    /**
     * 输出相对首页路径，本方法用于静态文件
     * @param string $path
     */
    public static function indexHome($path = '')
    {
        Helper::options()->siteUrl($path);
    }

    /**
     * 输出相对主题目录路径，用于静态文件
     * @param string $path
     * @return mixed
     */
    public static function indexTheme($path = '')
    {
        Helper::options()->themeUrl($path);
    }

    /**
     * 图片懒加载的方式
     * @param $image
     * @return string
     */
    public static function addLoadingImages($image)
    {
        return Helper::options()->themeUrl("", "lanstar/assets/img/loading/") . $image . '.gif';
    }


    /**
     * 侧边栏媒体信息
     * @return string
     */
    public static function handleRightIcon()
    {
        $getIconRow = explode(PHP_EOL, Helper::options()->rightIcon);
        if ($getIconRow) {
            $text = '';
            foreach ($getIconRow as $key => $value) {
                $iconInfo = explode('+', $value);
                $content = <<<EOF
                <a href="$iconInfo[2]" title="$iconInfo[0]">
                  <svg class="icon" aria-hidden="true">
                      <use xlink:href="#$iconInfo[1]"></use>
                  </svg>
                  </a>
EOF;
                $text .= $content;

            }
            return $text;
        }
    }

    /**
     * 邮箱处理
     * @param $email
     */
    public static function emailHandle($email)
    {
        if ($email) {
            if (strpos($email, "@qq.com") !== false) {
                $email = str_replace('@qq.com', '', $email);
                if (is_numeric($email)) {
                    echo "//q1.qlogo.cn/g?b=qq&nk=" . $email . "&";
                } else {
                    $mmail = $email . '@qq.com';
                    $email = md5($mmail);
                    echo "https://gravatar.loli.net/avatar/" . $email . "?";
                }

            } else {
                $email = md5($email);
                echo "https://dn-qiniu-avatar.qbox.me/avatar/" . $email . "?";
            }
        } else {
            echo "https://dn-qiniu-avatar.qbox.me/avatar/null?";
        }
    }

    /**
     * 获取文章banner
     * @param $cid
     * @return mixed
     */
    public static function getPostImage($cid)
    {
        $db = Typecho_Db::get();
        $row =  $db->fetchObject($db->select()->from('table.fields')->where('cid = ?', $cid)->where('table.fields.name = ?', 'banner'));
        return $row ? $row->str_value : '';
    }

    /**
     * 随机文章
     * @param int $limit
     */
    public static function getRandomPosts($limit = 10)
    {
        $db = Typecho_Db::get();
        $result = $db->fetchAll($db->select()->from('table.contents')
            ->where('status = ?', 'publish')
            ->where('type = ?', 'post')
            ->where('created <= ?', time())
            ->limit($limit)
            ->order('RAND()')
        );
        if ($result) {
            foreach ($result as $val) {
                $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
                $post_title = htmlspecialchars($val['title']);
                $post_date = date('Y-m-d', $val['created']);
                $permalink = $val['permalink'];
                $post_img = self::getPostImage($val['cid']) ?: Helper::options()->themeUrl("", "lanstar/assets/img/") . 'rand_default.jpg';
                echo <<<EOF
                <div class="sidebar-rand-item">
                    <a href="$permalink" target="_blank" class="sidebar-rand-img" style="background-image: linear-gradient(to right, rgb(144, 148, 148), transparent),url($post_img)"></a>
                    <div class="sidebar-rand-content">
                        <div class="sidebar-rand-body p-2"><a href="$permalink" target="_blank">$post_title</a></div>
                        <div class="sidebar-rand-footer p-2">$post_date</div>
                    </div>
                </div>
EOF;
            }
        }
    }
    /**
     * 秒转时间，格式 年 月 日 时 分 秒
     *
     * @author Roogle
     * @return html
     */
    public static function getBuildTime($time){
        // 设置时区
        date_default_timezone_set('Asia/Shanghai');
        // 在下面按格式输入本站创建的时间
        $options = Typecho_Widget::widget('Widget_Options');
        $start_Time = $options->startTime;
        $site_create_time = strtotime($time);
        if(!empty($start_Time)){
            $site_create_time = strtotime($start_Time);
        }
        $time = time() - $site_create_time;
        if(is_numeric($time)){
            $value = array(
                "years" => 0, "days" => 0, "hours" => 0,
                "minutes" => 0, "seconds" => 0,
            );
            if($time >= 31556926){
                $value["years"] = floor($time/31556926);
                $time = ($time%31556926);
            }
            if($time >= 86400){
                $value["days"] = floor($time/86400);
                $time = ($time%86400);
            }
            if($time >= 3600){
                $value["hours"] = floor($time/3600);
                $time = ($time%3600);
            }
            if($time >= 60){
                $value["minutes"] = floor($time/60);
                $time = ($time%60);
            }
            $value["seconds"] = floor($time);


            if($value['years']>0){
                echo ''.$value['years'].'年'.$value['days'].'天'.$value['hours'].'小时'.$value['minutes'].'分';
            }else{
                echo ''.$value['days'].'天'.$value['hours'].'小时'.$value['minutes'].'分';
            }
        }else{
            echo '';
        }
    }
    // 获取浏览器信息
    public static function getBrowser($agent) {
        if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
            $outputer = '<i class="ua-icon icon-ie"></i>&nbsp;&nbsp;Internet Explore';
        } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
            $str1 = explode('Firefox/', $regs[0]);
            $FireFox_vern = explode('.', $str1[1]);
            $outputer = '<i class="ua-icon icon-firefox"></i>&nbsp;&nbsp;FireFox';
        } else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
            $str1 = explode('Maxthon/', $agent);
            $Maxthon_vern = explode('.', $str1[1]);
            $outputer = '<i class="ua-icon icon-edge"></i>&nbsp;&nbsp;MicroSoft Edge';
        } else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
            $outputer = '<i class="ua-icon icon-360"></i>&nbsp;&nbsp;360极速浏览器';
        } else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
            $str1 = explode('Edge/', $regs[0]);
            $Edge_vern = explode('.', $str1[1]);
            $outputer = '<i class="ua-icon icon-edge"></i>&nbsp;&nbsp;MicroSoft Edge';
        } else if (preg_match('/UC/i', $agent)) {
            $str1 = explode('rowser/',  $agent);
            $UCBrowser_vern = explode('.', $str1[1]);
            $outputer = '<i class="ua-icon icon-uc"></i>&nbsp;&nbsp;UC浏览器';
        }  else if (preg_match('/QQ/i', $agent, $regs)||preg_match('/QQBrowser\/([^\s]+)/i', $agent, $regs)) {
            $str1 = explode('rowser/',  $agent);
            $QQ_vern = explode('.', $str1[1]);
            $outputer = '<i class= "ua-icon icon-qq"></i>&nbsp;&nbsp;QQ浏览器';
        } else if (preg_match('/UBrowser/i', $agent, $regs)) {
            $str1 = explode('rowser/',  $agent);
            $UCBrowser_vern = explode('.', $str1[1]);
            $outputer = '<i class="ua-icon icon-uc"></i>&nbsp;&nbsp;UC浏览器';
        }  else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
            $outputer = '<i class= "ua-icon icon-opera"></i>&nbsp;&nbsp;Opera';
        } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
            $str1 = explode('Chrome/', $agent);
            $chrome_vern = explode('.', $str1[1]);
            $outputer = '<i class="ua-icon icon-chrome"></i>&nbsp;&nbsp;Google Chrome';
        } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
            $str1 = explode('Version/',  $agent);
            $safari_vern = explode('.', $str1[1]);
            $outputer = '<i class="ua-icon icon-safari"></i>&nbsp;&nbsp;Safari';
        } else{
            $outputer = '<i class="ua-icon icon-chrome"></i>&nbsp;&nbsp;Google Chrome';
        }
        echo $outputer;
    }


    // 获取操作系统信息
    public static function getOs($agent) {
        $os = false;

        if (preg_match('/win/i', $agent)) {
            if (preg_match('/nt 6.0/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class= "ua-icon icon-win1"></i>&nbsp;&nbsp;Windows Vista&nbsp;/&nbsp;';
            } else if (preg_match('/nt 6.1/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class= "ua-icon icon-win1"></i>&nbsp;&nbsp;Windows 7&nbsp;/&nbsp;';
            } else if (preg_match('/nt 6.2/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-win2"></i>&nbsp;&nbsp;Windows 8&nbsp;/&nbsp;';
            } else if(preg_match('/nt 6.3/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class= "ua-icon icon-win2"></i>&nbsp;&nbsp;Windows 8.1&nbsp;/&nbsp;';
            } else if(preg_match('/nt 5.1/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-win1"></i>&nbsp;&nbsp;Windows XP&nbsp;/&nbsp;';
            } else if (preg_match('/nt 10.0/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-win2"></i>&nbsp;&nbsp;Windows 10&nbsp;/&nbsp;';
            } else if (preg_match('/nt 11.0/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-win2"></i>&nbsp;&nbsp;Windows 11&nbsp;/&nbsp;';
            } else{
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-win2"></i>&nbsp;&nbsp;Windows X64&nbsp;/&nbsp;';
            }
        } else if (preg_match('/android/i', $agent)) {
            if (preg_match('/android 9/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-android"></i>&nbsp;&nbsp;Android Pie&nbsp;/&nbsp;';
            }
            else if (preg_match('/android 8/i', $agent)) {
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-android"></i>&nbsp;&nbsp;Android Oreo&nbsp;/&nbsp;';
            }
            else{
                $os = '&nbsp;&nbsp;<i class="ua-icon icon-android"></i>&nbsp;&nbsp;Android&nbsp;/&nbsp;';
            }
        }
        else if (preg_match('/ubuntu/i', $agent)) {
            $os = '&nbsp;&nbsp;<i class="ua-icon icon-ubuntu"></i>&nbsp;&nbsp;Ubuntu&nbsp;/&nbsp;';
        } else if (preg_match('/linux/i', $agent)) {
            $os = '&nbsp;&nbsp;<i class= "ua-icon icon-linux"></i>&nbsp;&nbsp;Linux&nbsp;/&nbsp;';
        } else if (preg_match('/iPhone/i', $agent)) {
            $os = '&nbsp;&nbsp;<i class="ua-icon icon-apple"></i>&nbsp;&nbsp;iPhone&nbsp;/&nbsp;';
        } else if (preg_match('/mac/i', $agent)) {
            $os = '&nbsp;&nbsp;<i class="ua-icon icon-mac"></i>&nbsp;&nbsp;MacOS&nbsp;/&nbsp;';
        }else if (preg_match('/fusion/i', $agent)) {
            $os = '&nbsp;&nbsp;<i class="ua-icon icon-android"></i>&nbsp;&nbsp;Android&nbsp;/&nbsp;';
        } else {
            $os = '&nbsp;&nbsp;<i class="ua-icon icon-linux"></i>&nbsp;&nbsp;Linux&nbsp;/&nbsp;';
        }
        echo $os;
    }

    /**
     * 获取文章的评论
     * @param $cid
     * @param $len
     * @return mixed
     */
    public static function get_comment_by_cid($cid, $len = 4)
    {
        $db = Typecho_Db::get();
        $select = $db->select('author,authorId,ownerId,mail,text,created')
            ->from('table.comments')
            ->where('cid = ?', $cid)
            ->order('created', Typecho_Db::SORT_DESC)
            ->limit($len);
        return $db->fetchAll($select);
    }

    /**
     * 摘要内容
     * @param $html
     * @param int $limit
     * @param int $flag
     * @return string
     */
    public static function get_summary($html, int $limit = 3, int $flag = 0)
    {
        // 过滤隐藏
        if (strpos($html, '[hide') !== false) {
            $html = preg_replace('/(?s)\[hide\]([^\]]*?)\[\/hide\]/', '', $html);
        }
        $content = '';
        if($flag == 0) {
            if ($parts = preg_split("/(<\/\s*(?:p|q|h[0-6]|blockquote|ol|ul|pre|')\s*>)/i",
                $html, $limit, PREG_SPLIT_DELIM_CAPTURE)) {
                for ($i = 0; $i < $limit; ++$i) {
                    $content .= $parts[$i];
                }
            }
        }else{
            //图片模式要过滤br标签才好看
            $html = preg_replace('/(?s)\<br\>/', '', $html);
            if ($parts = preg_split("/(<\s*(?:img|')\s*>)/i",
                $html, $limit, PREG_SPLIT_DELIM_CAPTURE)) {
                for ($i = 0; $i < $limit; ++$i) {
                    $content .= $parts[$i];
                }
            }
        }

        return $content;
    }
}
