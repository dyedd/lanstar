<?php
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('<h2>普通设置</h2>站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
    $bannerUrl = new Typecho_Widget_Helper_Form_Element_Textarea('bannerUrl', NULL, NULL, _t('首页幻灯片'), _t('一行一个链接,大于3行将随机<br>注意最后一行不能为空'));
    $form->addInput($bannerUrl);
    $recordNo = new Typecho_Widget_Helper_Form_Element_Text('recordNo', NULL, NULL, _t('网站备案号'), _t('根据要求，每个备案网站必须填写备案号，不然得罚款'));
    $form->addInput($recordNo);
    $customNavIcon = new Typecho_Widget_Helper_Form_Element_Textarea('customNavIcon', NULL, NULL, _t('自定义导航小图标'), _t('按照格式书写，自定义内导航栏右侧的小图标，留空则展示默认的图标按钮，书写的格式请查看 wiki<hr>'));
    $form->addInput($customNavIcon);
    //developer
    $headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('<h2>开发者设置</h2>自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码'));
    $form->addInput($headerEcho);
    $footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义脚部信息'), _t('填写 html 代码，将输出在 &lt;footer&gt; 标签中，可以在这里写上统计代码'));
    $form->addInput($footerEcho);
    $cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $form->addInput($cssEcho);
    $jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $form->addInput($jsEcho);
}