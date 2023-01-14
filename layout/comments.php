<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
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
    ?>
    <li id="<?php $comments->theId(); ?>"  class="comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
    ?>">
        <div class="comment-author">
            <span>
                <img class="avatar" src="<?php utils::emailHandle($comments->mail); ?>s=100" width="64" height="64">
            </span>
            <cite class="fn" itemprop="name"><a href="<?= $comments->authorId > 0 ? '/author/' . $comments->authorId : $comments->url; ?>" rel="external nofollow"><?= $comments->author; ?></a></cite>
        </div>
        <div class="comment-meta">
            <a href="<?php $comments->permalink(); ?>">
                <time datetime="<?php $comments->date(); ?>"><?php $comments->date('F-jS,Y,g:i:sA'); ?></time>
            </a>
            <div class="comment-ua">
                <span class="author-system"><?php utils::getOs($comments->agent); ?></span>
                <span class="author-browser"><?php utils::getBrowser($comments->agent); ?></span>
            </div>
        </div>
        <div class="comment-content">
            <?php $comments->content(); ?>
        </div>
        <div class="comment-reply">
            <a class="js-pjax" href="javascript:void(0);" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>);">回复</a>
        </div>
        <?php if ($comments->children): ?>
            <div class="comment-children"><?php $comments->threadedComments($options); ?></div>
        <?php endif; ?>
    </li>
<?php } ?>
<div class="comments" id="comments" data-respondId="<?php $this->respondId() ?>">
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <div id="response"><?php _e('发表评论'); ?></div>
            <form method="post" action="<?php $this->commentUrl() ?>" data-login="<?= $this->user->hasLogin()?>" id="comment-form" role="form" >
                <?php if (!$this->user->hasLogin()): ?>
                    <div class="option">
                        <label for="author" class="required"></label>
                        <input placeholder="<?php _e('称呼'); ?>" type="text" name="author" id="author" class="text"
                               value="<?php $this->remember('author'); ?>" required/>
                    </div>
                    <div class="option">
                        <label
                            for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>></label>
                        <input placeholder="<?php _e('邮箱'); ?>" type="email" name="mail" id="mail" class="text"
                               value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </div>
                    <div class="option">
                        <label
                            for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>></label>
                        <input placeholder="<?php _e('网站'); ?>" type="url" name="url" id="url" class="text"
                               placeholder="<?php _e('http://'); ?>"
                               value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </div>
                <?php endif; ?>
                <div class="option">
                    <label for="textarea" class="required"></label>
                    <textarea placeholder="说点什么吗？" rows="8" cols="50" name="text" id="textarea" class="textarea"
                              required><?php $this->remember('text'); ?></textarea>
                </div>
                <div class="comments-toolbar">
                    <div id="OwO" class="OwO"></div>
                    <div class="option">
                        <input type="checkbox" id="secret-button" name="secret">
                        <label for="secret-button" class="secret-label" title="开启该功能，您的评论仅作者和评论双方可见">
                            <span class="circle"></span>
                        </label>
                        <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    <?php endif; ?>
    <?php if ($comments->have()): ?>
        <div class="comments-row">
            <?php $comments->listComments(); ?>
            <div class="page-pagination">
                <?php
                $comments->pageNav(
                    '<svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zuo"></use>
                    </svg>',
                    '<svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-you"></use>
                    </svg>',
                    3, '...', array(
                    'wrapTag' => 'ul',
                    'wrapClass' => 'pagination justify-content-center',
                    'itemTag' => 'li',
                    'itemClass' => 'page-item',
                    'linkClass' => 'page-link',
                    'currentClass' => 'active'
                ));
                ?>
            </div>
        </div>

    <?php endif; ?>
</div>
