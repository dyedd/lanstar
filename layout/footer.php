<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="container footer">
    &copy; <?=  date('Y');?>
    <?php if($this->options->footerName):?>
        <?php $this->options->footerName();?>
    <?php else:?>
        <a class="footer-item" href="<?php $this->options->siteUrl();?>"><?php $this->options->title();?></a>
        <span style='color:#d14836'>❤</span>
    <?php endif;?>
    <br>
    <?php if ($this->options->recordNo):?>
        <a class="footer-item" target="_blank"
           href="http://beian.miit.gov.cn/"> <?php $this->options->recordNo();?></a>
    <?php endif;?>
    <div>
        <?php $this->options->footerEcho();?>
    </div>
    <p class="footer-item">Theme By <a href="https://dyedd.cn" title="禁止仿制" class="footer-item">Lanstar</a></p>
</footer>
<?php $this->footer(); ?>
<div class="tools">
    <?php if ($this->options->darkBtn): ?>
        <div class="chose-mode-day" id="night-mode" type="button">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-yueliang"></use>
            </svg><span>暗黑模式</span>
        </div>
        <div class="chose-mode-moon" id="night-mode" type="button">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-taiyang"></use>
            </svg><span>暗黑模式</span>
        </div>
    <?php endif; ?>
    <?php if($this->is('post')): ?>
        <div onclick="location.href='#comment'">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-pinglun2"></use>
            </svg><span>评论</span>
        </div>
    <?php endif; ?>
    <div class="back-to-top" onclick="app.addBackTop()">
        <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-fanhuidingbu-"></use>
        </svg><span>返回顶部</span>
    </div>
</div>
