<?php
class utils
{
    /**
     * 首页幻灯片的处理
     * @param $content
     * @return string
     */
    public static function bannerHandle($content)
    {
        $bannerArr = explode(PHP_EOL, $content);
        $text = '';
        if (count($bannerArr) > 3) {
            //打乱数组
            shuffle($bannerArr);
            $bannerArr = array_slice($bannerArr,0,3);
        }
        foreach ($bannerArr as $key => $banner) {
            if ($key) {
                $text .= '<div class="carousel-item">
                    <img src="'.$banner.'" class="d-block w-100" alt="banner">
                </div>';
            } else {
                $text .= '<div class="carousel-item active">
                    <img src="'.$banner.'" class="d-block w-100" alt="banner">
                </div>';
            }
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
     * @param $text
     */
    public static function customNavHandle($nav, $pages, $that)
    {
        $navArr = explode(PHP_EOL, $nav);
        $content = '';
        $count = count($navArr);
        $start = count($navArr);
        while ($pages->next()) {
            if ($that->is('page', $pages->slug)):
                $class="nav-link active";
            else:
                $class="nav-link";
            endif;
            if ($count) {
                $url = Helper::options()->themeUrl .'/assets/img/bootstrap-icons.svg' . '#'. $navArr[$start-$count];
                $content .= '
                <a class="'.$class.'" href="'.$pages->permalink.'" title="'.$pages->title.'">
                        <div class="nav-item">
                        <svg class="nav-icon bi" width="24" height="24" fill="currentColor">
                            <use xlink:href="'.$url.'"/>
                        </svg>
                        <span class="nav-item-text">'.$pages->title.'</span>
                    </div>
                </a>';
                $count--;
            } else {
                $url = Helper::options()->themeUrl.'/assets/img/bootstrap-icons.svg#cursor';
                $content .= '
                    <a class="'.$class.'" href="'.$pages->permalink.'" title="'.$pages->title.'">
                            <div class="nav-item">
                            <svg class="nav-icon bi" width="24" height="24" fill="currentColor">
                                <use xlink:href="'.$url.'"/>
                            </svg>
                            <span class="nav-item-text">'.$pages->title.'</span>
                        </div>
                    </a>';
            }
        }
        echo $content;
    }

}
