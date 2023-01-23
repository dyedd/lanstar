<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form)
{
    $version = themeVersion();
    $str1 = explode('/themes/', Helper::options()->themeUrl);
    $str2 = explode('/', $str1[1]);
    $name = $str2[0];
    $db = Typecho_Db::get();
    $sjdq = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name));
    $ysj = $sjdq['value'];
    if (isset($_POST['type'])) {
        if ($_POST["type"] == "备份模板") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $update = $db->update('table.options')->rows(array('value' => $ysj))->where('name = ?', 'theme:' . $name . 'bf');
                $updateRows = $db->query($update);
                ?>
                <script>
                    let flag = confirm("备份更新成功!");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>'
                <?php
            } else {
                if ($ysj) {
                    $insert = $db->insert('table.options')
                        ->rows(array('name' => 'theme:' . $name . 'bf', 'user' => '0', 'value' => $ysj));
                    $insertId = $db->query($insert);
                    ?>
                    <script>
                        let flag = confirm("备份成功!");
                        if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                    </script>
                    <?php
                }
            }
        }
        if ($_POST["type"] == "还原模板") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $sjdub = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'));
                $bsj = $sjdub['value'];
                $update = $db->update('table.options')->rows(array('value' => $bsj))->where('name = ?', 'theme:' . $name);
                $updateRows = $db->query($update);
                ?>
                <script>
                    let flag = confirm("恢复成功！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
                <?php
            } else {
                ?>
                <script>
                    let flag = confirm("未备份过数据，无法恢复！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
                <?php
            }
        }
        if ($_POST["type"] == "删除备份") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $delete = $db->delete('table.options')->where('name = ?', 'theme:' . $name . 'bf');
                $deletedRows = $db->query($delete);
                ?>
                <script>
                    let flag = confirm("删除成功！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script> 2500);</script>
                <?php
            } else {
                ?>
                <script>
                    let flag = confirm("没有备份内容，无法删除！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
                <?php
            }
        }
    }
    echo '<link href="' . Helper::options()->themeUrl . '/assets/css/setting.css" rel="stylesheet" type="text/css" />';
    echo <<<EOF
<div class="theme-setting-contain">
    <div class="theme-setting-left-aside">
        <ul class="theme-setting-tab">
            <li data-current="theme-setting-notice">最新公告</li>
            <li data-current="theme-setting-global">公共设置</li>
            <li data-current="theme-setting-post">文章设置</li>
            <li data-current="theme-setting-aside">侧边栏设置</li>
            <li data-current="theme-setting-development">开发者设置</li>
            <li data-current="theme-setting-pjax">PJAX设置</li>
            <li data-current="theme-setting-music">音乐功能</li>
            <li data-current="theme-setting-couple">情侣功能</li>
        </ul>
    </div>
    <span id="theme-version" style="display: none;">$version</span>
    <div class="theme-setting-notice">请求数据中...</div>
EOF;
    echo '<script src="' . Helper::options()->themeUrl . '/assets/js/setting.js"></script>';
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text('logoUrl', NULL, NULL, '站点 LOGO 地址', '在这里填入一个图片 URL 地址, 以在头部加上一个 LOGO');
    $logoUrl->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($logoUrl);

    $darkBtn = new \Typecho\Widget\Helper\Form\Element\Radio('darkBtn',
        array(1 => '启用',
            0 => '关闭'),
        1, '是否开启暗黑模式', '默认关闭');
    $darkBtn->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($darkBtn);

    $bannerBtn = new \Typecho\Widget\Helper\Form\Element\Radio('bannerBtn',
        array(1 => '启用',
            0 => '关闭'),
        1, '是否开启首页幻灯片', '默认关闭');
    $bannerBtn->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($bannerBtn);

    $bannerUrl = new \Typecho\Widget\Helper\Form\Element\Textarea('bannerUrl', NULL, NULL, '首页幻灯片', '一行一个链接,大于3行将随机<br>注意最后一行不能为空');
    $bannerUrl->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($bannerUrl);

    $recordNo = new \Typecho\Widget\Helper\Form\Element\Text('recordNo', NULL, NULL, '网站备案号', '根据要求，每个备案网站必须填写备案号，不然得罚款');
    $recordNo->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($recordNo);

    $footerName = new \Typecho\Widget\Helper\Form\Element\Text('footerName', NULL, NULL, '自定义脚部版权名称', '默认为@ 日期 站点名称');
    $footerName->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($footerName);

    $startTime = new \Typecho\Widget\Helper\Form\Element\Text('startTime', NULL, NULL, '建站时间', '格式为2022-03-28 13:55:00');
    $startTime->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($startTime);

    $customNavIcon = new \Typecho\Widget\Helper\Form\Element\Textarea('customNavIcon', NULL, NULL, '自定义导航小图标', '按照格式书写，自定义内导航栏右侧的小图标，留空则展示默认的图标按钮，书写的格式请查看 wiki');
    $customNavIcon->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($customNavIcon);

    $compressHtml = new \Typecho\Widget\Helper\Form\Element\Radio('compressHtml',
        array(1 => '启用',
            0 => '关闭'),
        0, 'HTML压缩', '默认关闭，启用则会对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情选择开启或者关闭');
    $compressHtml->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($compressHtml);

    $LoadingOptions = [
        'block' => "交错方块",
        'custom' => "自定义"
    ];
    $LoadingImage = new \Typecho\Widget\Helper\Form\Element\Radio('loading_image', $LoadingOptions, 'block', '图片懒加载动画', "选择懒加载动画的图片，若选择自定义，则需要在 images/loading 目录下添加名为 custom.gif 的文件");
    $LoadingImage->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($LoadingImage);

    $jsPushBaidu = new \Typecho\Widget\Helper\Form\Element\Select('jsPushBaidu', array('0' => '关闭', '1' => '开启'), '0', '自动推送', '使用通用js自动推荐给百度引擎，增快收录');
    $jsPushBaidu->setAttribute('class', 'theme-setting-content theme-setting-post');
    $form->addInput($jsPushBaidu);

    // 侧边栏
    $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox('sidebarBlock',
        array(
            'ShowBlogInfo' => '显示博主信息',
            'ShowYourCouple' => '显示情侣功能',
            'ShowRecentComments' => '显示最近评论',
            'ShowInterestPosts' => '显示可能感觉兴趣的文章',
        ),
        array('ShowBlogInfo','ShowyourCouple','ShowRecentComments', 'ShowInterestPosts'), '<h2>侧边栏功能</h2>', '在这里选择需要展示在侧边栏的内容');
    $sidebarBlock->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($sidebarBlock->multiMode());
    
    $LicenseInfo = new \Typecho\Widget\Helper\Form\Element\Text('LicenseInfo', NULL, NULL, '文章许可信息', '填入后将在文章底部显示你填入的许可信息（支持HTML标签），留空则默认为 (CC BY-SA 4.0)国际许可协议。');
    $LicenseInfo->setAttribute('class', 'theme-setting-content theme-setting-post');
    $form->addInput($LicenseInfo);

    $rightMotto = new \Typecho\Widget\Helper\Form\Element\Text('rightMotto', NULL, NULL, '侧边栏格言', '');
    $rightMotto->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightMotto);

    $rightAvatar = new \Typecho\Widget\Helper\Form\Element\Text('rightAvatar', NULL, NULL, '侧边栏头像', '填写图片链接');
    $rightAvatar->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightAvatar);

    $rightName = new \Typecho\Widget\Helper\Form\Element\Text('rightName', NULL, NULL, '侧边栏名称', '填写你自己的昵称');
    $rightName->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightName);

    $rightIcon = new \Typecho\Widget\Helper\Form\Element\Textarea('rightIcon', NULL, NULL, '媒体信息', '名称+图标+地址，一行一个');
    $rightIcon->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightIcon);

    $extraIcon = new \Typecho\Widget\Helper\Form\Element\Text('extraIcon', NULL, NULL, '媒体额外引用', '当主题自带的icon不满足你的时候，可以在这里添加iconfont的js链接，增加网站图标');
    $extraIcon->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($extraIcon);

    $pjax = new \Typecho\Widget\Helper\Form\Element\Select('pjax', array(
        '0' => '关闭',
        '1' => '开启'
    ), '0', '是否开启', 'Pjax 预加载功能的开关');
    $pjax->setAttribute('class', 'theme-setting-content theme-setting-pjax');
    $form->addInput($pjax);

    $pjax_complete = new \Typecho\Widget\Helper\Form\Element\Textarea('pjax_complete', NULL, NULL, 'Pjax 回调函数', 'Pjax 跳转页面后执行的事件，写入 js 代码(不带script)，一般将 Pjax 重载(回调)函数写在这里。');
    $pjax_complete->setAttribute('class', 'theme-setting-content theme-setting-pjax');
    $form->addInput($pjax_complete);

    $headerEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('headerEcho', NULL, NULL, '自定义头部信息', '填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码');
    $headerEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($headerEcho);

    $footerEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('footerEcho', NULL, NULL, '自定义脚部信息', '填写 html 代码，将输出在 &lt;footer&gt; 标签中，可以在这里写上统计代码');
    $footerEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($footerEcho);

    $cssEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('cssEcho', NULL, NULL, '自定义 CSS', '填写 CSS 代码，输出在 head 标签结束之前的 style 标签内');
    $cssEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($cssEcho);

    $jsEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('jsEcho', NULL, NULL, '自定义 JavaScript', '填写 JavaScript代码，输出在 body 标签结束之前');
    $jsEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($jsEcho);


    $music = new \Typecho\Widget\Helper\Form\Element\Text('music', NULL, NULL, '歌单地址', '填写格式，	server="netease"
	type="playlist"
	id="60198"');
    $music->setAttribute('class', 'theme-setting-content theme-setting-music');
    $form->addInput($music);

    $taAvatar = new \Typecho\Widget\Helper\Form\Element\Text('taAvatar', NULL, NULL, '<h2>情侣功能</h2>其它头像地址', '你的另一半~');
    $taAvatar->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($taAvatar);

    $company = new \Typecho\Widget\Helper\Form\Element\Text('company', NULL, NULL, '开始在一起的日期', '2020-12-28');
    $company->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($company);

}
