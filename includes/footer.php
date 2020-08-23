<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="container">
    &copy; <?php echo date('Y'); ?> <a class="footer-item" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <br>
    <?php if ($this->options->recordNo):?>
    <a class="footer-item" target="_blank" href="http://beian.miit.gov.cn/"> <?php $this->options->recordNo();?></a>
    <?php endif?>
    <br>
    <?php $this->options->footerEcho();?>
    <p class="footer-item">Designed by <b title="禁止仿制">染念</b></p>
</footer>
<script src="<?php $this->options->themeUrl('assets/js/jquery-3.5.1.slim.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/popper.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/prism.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/extend.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/owo/owo_02.js'); ?>"></script>
<?php $this->options->jsEcho(); ?>
<script>
    if($(".OwO").length > 0){
        new OwO({
            logo: 'OωO',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementsByClassName('owo-textarea')[0],
            api: '<?php $this->options->themeUrl('assets/owo/OwO_02.json'); ?>',
            position: 'down',
            width: '400px',
            maxHeight: '250px'
        });
    }
</script>

<?php $this->footer(); ?>
