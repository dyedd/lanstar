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
        if ($_POST["type"] == "备份模板设置数据") {
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
        if ($_POST["type"] == "还原模板设置数据") {
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
        if ($_POST["type"] == "删除备份数据") {
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
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在头部加上一个 LOGO'));
    $logoUrl->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($logoUrl);

    $bannerUrl = new Typecho_Widget_Helper_Form_Element_Textarea('bannerUrl', NULL, NULL, _t('首页幻灯片'), _t('一行一个链接,大于3行将随机<br>注意最后一行不能为空'));
    $bannerUrl->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($bannerUrl);

    $recordNo = new Typecho_Widget_Helper_Form_Element_Text('recordNo', NULL, NULL, _t('网站备案号'), _t('根据要求，每个备案网站必须填写备案号，不然得罚款'));
    $recordNo->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($recordNo);

    $footerName = new Typecho_Widget_Helper_Form_Element_Text('footerName', NULL, NULL, _t('自定义脚部版权名称'), _t('默认为@ 日期 站点名称'));
    $footerName->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($footerName);

    $startTime = new Typecho_Widget_Helper_Form_Element_Text('startTime', NULL, NULL, _t('建站时间'), _t('格式为2022-03-28 13:55:00'));
    $startTime->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($startTime);

    $customNavIcon = new Typecho_Widget_Helper_Form_Element_Textarea('customNavIcon', NULL, NULL, _t('自定义导航小图标'), _t('按照格式书写，自定义内导航栏右侧的小图标，留空则展示默认的图标按钮，书写的格式请查看 wiki'));
    $customNavIcon->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($customNavIcon);

    $compressHtml = new Typecho_Widget_Helper_Form_Element_Radio('compressHtml',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('HTML压缩'), _t('默认关闭，启用则会对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情选择开启或者关闭'));
    $compressHtml->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($compressHtml);

    $cdn = new Typecho_Widget_Helper_Form_Element_Radio('cdn',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('使用jsdelivr加速'), _t('默认关闭，开启后不再调用本地css，js等资源'));
    $cdn->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($cdn);

    $LoadingOptions = [
        'block' => "交错方块",
        'custom' => "自定义"
    ];
    $LoadingImage = new Typecho_Widget_Helper_Form_Element_Radio('loading_image', $LoadingOptions, 'block', _t('图片懒加载动画'), _t("选择懒加载动画的图片，若选择自定义，则需要在 images/loading 目录下添加名为 custom.gif 的文件"));
    $LoadingImage->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($LoadingImage);

    $jsPushBaidu = new Typecho_Widget_Helper_Form_Element_Select('jsPushBaidu', array('0' => '关闭', '1' => '开启'), '0', _t('自动推送'), _t('使用通用js自动推荐给百度引擎，增快收录'));
    $jsPushBaidu->setAttribute('class', 'theme-setting-content theme-setting-post');
    $form->addInput($jsPushBaidu);

    // 侧边栏
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock',
        array(
            'ShowBlogInfo' => _t('显示博主信息'),
            'ShowYourCouple' => _t('显示情侣功能'),
            'ShowRecentComments' => _t('显示最近评论'),
            'ShowInterestPosts' => _t('显示可能感觉兴趣的文章'),
        ),
        array('ShowBlogInfo','ShowyourCouple','ShowRecentComments', 'ShowInterestPosts'), _t('<h2>侧边栏功能</h2>'), _t('在这里选择需要展示在侧边栏的内容'));
    $sidebarBlock->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($sidebarBlock->multiMode());
    
    $LicenseInfo = new Typecho_Widget_Helper_Form_Element_Text('LicenseInfo', NULL, NULL, _t('文章许可信息'), _t('填入后将在文章底部显示你填入的许可信息（支持HTML标签），留空则默认为 (CC BY-SA 4.0)国际许可协议。'));
    $LicenseInfo->setAttribute('class', 'theme-setting-content theme-setting-post');
    $form->addInput($LicenseInfo);

    $rightMotto = new Typecho_Widget_Helper_Form_Element_Text('rightMotto', NULL, NULL, _t('侧边栏格言'), _t(''));
    $rightMotto->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightMotto);

    $rightAvatar = new Typecho_Widget_Helper_Form_Element_Text('rightAvatar', NULL, NULL, _t('侧边栏头像'), _t('填写图片链接'));
    $rightAvatar->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightAvatar);

    $rightName = new Typecho_Widget_Helper_Form_Element_Text('rightName', NULL, NULL, _t('侧边栏名称'), _t('填写你自己的昵称'));
    $rightName->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightName);

    $rightIcon = new Typecho_Widget_Helper_Form_Element_Textarea('rightIcon', NULL, NULL, _t('媒体信息'), _t('名称+图标+地址，一行一个'));
    $rightIcon->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightIcon);
    

    $pjax = new Typecho_Widget_Helper_Form_Element_Select('pjax', array(
        '0' => '关闭',
        '1' => '开启'
    ), '0', '是否开启', 'Pjax 预加载功能的开关');
    $pjax->setAttribute('class', 'theme-setting-content theme-setting-pjax');
    $form->addInput($pjax);

    $pjax_complete = new Typecho_Widget_Helper_Form_Element_Textarea('pjax_complete', NULL, NULL, _t('Pjax 回调函数'), _t('Pjax 跳转页面后执行的事件，写入 js 代码(不带script)，一般将 Pjax 重载(回调)函数写在这里。'));
    $pjax_complete->setAttribute('class', 'theme-setting-content theme-setting-pjax');
    $form->addInput($pjax_complete);

    $headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码'));
    $headerEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($headerEcho);

    $footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义脚部信息'), _t('填写 html 代码，将输出在 &lt;footer&gt; 标签中，可以在这里写上统计代码'));
    $footerEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($footerEcho);

    $cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $cssEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($cssEcho);

    $jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $jsEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($jsEcho);


    $music = new Typecho_Widget_Helper_Form_Element_Text('music', NULL, NULL, _t('歌单地址'), _t('填写格式，	server="netease"
	type="playlist"
	id="60198"'));
    $music->setAttribute('class', 'theme-setting-content theme-setting-music');
    $form->addInput($music);

    $taAvatar = new Typecho_Widget_Helper_Form_Element_Text('taAvatar', NULL, NULL, _t('<h2>情侣功能</h2>其它头像地址'), _t('你的另一半~'));
    $taAvatar->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($taAvatar);

    $company = new Typecho_Widget_Helper_Form_Element_Text('company', NULL, NULL, _t('开始在一起的日期'), _t('2020-12-28'));
    $company->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($company);

}
