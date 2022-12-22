<?php
/**
 * author:染念
 * time：2022-12-22 19：22
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="category">
    <div class="collapse-item active">
        <span>最新</span>
    </div>
    <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
    <?php while ($category->next()): ?>
        <div<?php if ($this->is('category', $category->slug)): ?> class="collapse-item active" <?php else: ?> class="collapse-item"<?php endif; ?>
            data-href="<?php $category->permalink(); ?>">
            <span><?php $category->name(); ?></span>
        </div>
    <?php endwhile; ?>
</div>



