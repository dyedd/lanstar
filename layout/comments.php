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
    ?>
    <li class="comment-list-item<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
    } else {
        echo ' comment-parent';
    }
    echo $commentClass;
    ?>">
        <img class="comment-user-avatar rounded-circle float-start"
             src="<?php utils::emailHandle($comments->mail); ?>s=100" alt="评论头像"/>
        <div id="<?php $comments->theId(); ?>" class="comment-body">
            <div class="comment-info">
                <div class="comment-head">
                    <?php
                    $pcomments = get_comment($comments->parent);
                    if ($pcomments) echo '<code style="margin:0 .3em 0 0;padding:0;font-size:.9em;">@' . $pcomments['author'] . '</code>';
                    ?>
                    <a class="comment-user-name me-1"
                       href="<?php echo $comments->authorId > 0 ? '/author/' . $comments->authorId : $comments->url; ?>"
                       rel="external nofollow">
                        <?php echo $comments->author; ?>
                    </a>
                    <?php if ($comments->authorId === $comments->ownerId): ?>
                        <span class="badge rounded-pill bg-primary comment-author-title">作者</span>
                    <?php endif; ?>
                </div>
                <div class="comment-meta d-flex justify-content-between">
                    <span class="comment-time"><?php $comments->date('Y-m-d'); ?></span>
                    <span class="comment-reply">
                    <a href="javascript:void(0);"
                       onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>)">
                        <svg class="icon me-1" aria-hidden="true">
                            <use xlink:href="#icon-pinglun2"></use>
                        </svg>
                        回复
                        </a>
                </span>
                    <span class="comment-reply-cancel" style="display: none">
                    <?php $comments->cancelReply('<svg class="icon me-1" aria-hidden="true">
                        <use xlink:href="#icon-quxiao"></use>
                        </svg>
                    取消'); ?>
                </span>
                </div>
                <div class="comment-content">
                    <?php $comments->content(); ?>
                </div>
            </div>
        </div>
        <?php if ($comments->children): ?>
            <div class="comment-children"><?php $comments->threadedComments($options); ?></div>
        <?php endif; ?>
    </li>
<?php } ?>

<div class="article-comments mt-3" data-respondId="<?php $this->respondId() ?>">
    <?php $this->comments()->to($comments); ?>
    <section id="article-comments-nav">
        <svg class="icon me-1" aria-hidden="true">
            <use xlink:href="#icon-talk"></use>
        </svg>
        <span>评论</span>
    </section>
    <hr>
    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="comment-respond">
            <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" role="form">
                <div class="comment-respond-author">
                    <?php if ($this->user->hasLogin()): ?>
                        <div class="row">
                            <input type="text" id="comment-respond-author" name="author" class="comment-input col-sm-4"
                                   placeholder="昵称" required value="<?php $this->user->screenName(); ?>"/>
                            <input type="text" id="comment-respond-url" name="url" class="comment-input col-sm-4"
                                   placeholder="网站" value="<?php $this->remember('url'); ?>"
                                <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                            <input type="text" id="comment-respond-mail" name="mail" class="comment-input col-sm-4"
                                   placeholder="邮箱" value="<?php $this->user->mail(); ?>"
                                <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <input type="text" id="comment-respond-author" name="author" class="comment-input col-sm-4"
                                   placeholder="昵称" required value="<?php $this->remember('author'); ?>"/>
                            <input type="text" id="comment-respond-url" name="url" class="comment-input col-sm-4"
                                   placeholder="网站" value="<?php $this->remember('url'); ?>"
                                <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                            <input type="text" id="comment-respond-mail" name="mail" class="comment-input col-sm-4"
                                   placeholder="邮箱" value="<?php $this->remember('mail'); ?>"
                                <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                        </div>
                    <?php endif; ?>
                    <div class="comment-edit">
                        <textarea class="comment-textarea comment-input owo-textarea" name="text"
                                  id="comment-respond-textarea" placeholder="发条友善的评论" required></textarea>
                    </div>
                    <div class="OwO"></div>
                    <div class="d-flex justify-content-end align-items-center">
                        <?php if (utils::hasPlugin('Comment2Mail')): ?>
                            <span class="comment-mail-me">
                        <input name="receiveMail" type="checkbox" value="yes" id="receiveMail" checked/>
                        <label for="receiveMail"><strong>接收</strong>邮件通知</label>
                    </span>
                        <?php endif; ?>
                        <div class="comment-secret me-1">
                            <input type="checkbox" id="secret-button" name="secret">
                            <label for="secret-button" class="secret-label" title="开启该功能，您的评论仅作者和评论双方可见">
                                <span class="circle"></span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary comment-submit">
                            <span>提交</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="comment-close">本篇文章评论功能已关闭</div>
    <?php endif; ?>
    <section class="comment-detail">
        <?php if ($comments->have()): ?>
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
        <?php endif; ?>
    </section>
</div>
