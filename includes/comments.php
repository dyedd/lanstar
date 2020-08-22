<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options)
{
  $commentClass = '';
  if ($comments->authorId) {
    if ($comments->authorId == $comments->ownerId) {
      $commentClass .= ' comment-by-author';
    } else {
      $commentClass .= ' comment-by-user';
    }
  }
  $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
  ?>
<li class="comment-list-item<?php
  if ($comments->levels > 0) {
    echo ' comment-child';
  } else {
    echo ' comment-parent';
  }
  echo $commentClass;
?>">

    <div id="<?php $comments->theId(); ?>" class="comment-body">
        <div class="comment-meta">
            <div class="comment-author">
              <?php if ($comments->authorId > 0): ?>
                <a href="/author/<?php echo $comments->authorId ?>" rel="external nofollow">
              <?php elseif ($comments->url): ?>
                <a href="<?php echo $comments->url ?>" target="_blank" rel="external nofollow">
              <?php endif; ?>
              <?php $comments->gravatar('64', 'mp'); echo $comments->author; ?>
              <?php $title = get_user_title($comments->author); if(strlen($title)>0): ?>
              <span class="comment-author-title"><?php echo $title ?></span>
              <?php endif; ?>
              <?php if ($comments->authorId === $comments->ownerId): ?>
              <span class="comment-author-title">作者</span>
              <?php endif ?>
              <?php if ($comments->authorId > 0 || $comments->url): ?>
                </a>
              <?php endif; ?>
            </div>
            <div class="comment-time"><?php $comments->date('Y年m月d日'); ?></div>
            <?php 
              $pcomments = get_comment($comments->parent);
              if($pcomments) echo '<code style="float:left;margin:.1em .5em;padding:0;font-size:.9em;">@'.$pcomments['author'].'</code>';
           echo contents::parseOwo($comments->content);
            ?>
            <div class="comment-reply">
              <?php 
                if(in_array(get_user_group(), ['administrator', 'editor'])):
                  Typecho_Widget::widget('Widget_Security')->to($security);
              ?>
              <a href="javascript:;" data-rel="delete" data-href="<?php $security->index('/action/comments-edit?do=delete&coid='.$comments->coid); ?>"><i data-feather="trash"></i> 删除</a>
              <?php endif ?>
              <?php $comments->reply('<i data-feather="message-square"></i> 回复') ?>
            </div>
        </div>
        <hr />
    </div>
    <?php if ($comments->children): ?>
    <div class="comment-children"><?php $comments->threadedComments($options); ?></div>
    <?php endif; ?>
</li>
<?php } ?>

<div class="article-comments">
    <?php 
      $this->comments()->to($comments);
    ?>
    <h1 id="comments">评论区</h1>
    <hr />

    <?php if ($comments->have()): ?>
    <h2 id="comment-num"><?php $this->commentsNum(_t('暂无评论'), _t('1 条评论'), _t('%d 条评论')); ?></h2>

    <?php $comments->listComments(); ?>

    <?php
        $comments->pageNav('上一页', '下一页');
    ?>

    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="comment-respond">
        <form method="post" action="<?php $this->commentUrl() ?>" class="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <div class="comment-respond-author">
              <a href="<?php $this->options->profileUrl(); ?>" target="_blank" rel="external nofollow">
                <img class="user-head" src="<?php echo Typecho_Common::gravatarUrl($this->user->mail, 80, $this->options->commentsAvatarRating, 'mp', $this->request->isSecure()); ?>">
              </a>
            </div>
            <?php else: ?>
            <div class="comment-respond-author">
              <img class="user-head" src="<?php echo Typecho_Common::gravatarUrl('', 64, $this->options->commentsAvatarRating, 'mp', $this->request->isSecure()); ?>">
              <div class="form-row">
                  <div class="col-6 col-md-4">
                    <input type="text" name="author" class="form-control form-control-sm" 
                        placeholder="昵称" required />
                  </div>
                  <div class="col-6 col-md-4">
                    <input type="text" name="url" class="form-control form-control-sm" 
                        placeholder="网站" 
                        <?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?> />
                  </div>
                  <div class="col">
                    <input type="text" name="mail" class="form-control form-control-sm" 
                        placeholder="邮箱" 
                        <?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?> />
                  </div>
              </div>
            </div>
            <?php endif; ?>
            <div class="form-row">
                <div class="col">
                    <textarea type="text" class="textarea-container form-control form-control-sm owo-textarea" rows="5" name="text" id="textarea" placeholder="发条友善的评论" required></textarea>
                    <span class="OwO"></span>
                </div>
                <div class="col-auto">
                    <button type="submit" class="submit btn btn-sm comment-submit"><?php _e('发表评论'); ?></button>
                </div>
            </div>
            <div class="comment-reply-cancel">
                <?php $comments->cancelReply('<i data-feather="message-square"></i> 取消'); ?>
            </div>
            <hr/>
        </form>
    </div>
    <?php else: ?>
    <h2 id="comment-closed"><?php _e('评论功能已关闭'); ?></h2>
    <?php endif; ?>
</div>