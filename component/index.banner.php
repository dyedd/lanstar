<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php if($this->options->bannerBtn):?>
<div id="carouselCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselCaptions" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselCaptions" data-bs-slide-to="2"></li>
    </ol>
        <div class="carousel-inner">
            <?=  utils::bannerHandle($this->options->bannerUrl); ?>
        </div>
    <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselCaptions" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
<?php endif;?>
