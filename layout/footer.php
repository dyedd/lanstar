<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="container footer">
    &copy; <?php echo date('Y');?> <a class="footer-item"
                                       href="<?php $this->options->siteUrl();?>"><?php $this->options->title();?></a>
    <br>
    <?php if ($this->options->recordNo):?>
        <a class="footer-item" target="_blank"
           href="http://beian.miit.gov.cn/"> <?php $this->options->recordNo();?></a>
    <?php endif;?>
    <br>
    <?php $this->options->footerEcho();?>
    <p class="footer-item">Theme By <a href="https://dyedd.cn" title="禁止仿制" class="footer-item">Lanstar</a></p>
</footer>
<?php $this->footer(); ?>
