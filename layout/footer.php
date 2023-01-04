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
    <div class="watch_catalog" onclick="lanstar.addCatalog()">
        <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-mulu"></use>
        </svg>
    </div>
    <div class="back-to-top" onclick="lanstar.addBackTop()">
        <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-fanhuidingbu-"></use>
        </svg>
    </div>
</div>
