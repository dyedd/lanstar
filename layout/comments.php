<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="comments" id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <div id="response"><?php _e('发表评论'); ?></div>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <?php if (!$this->user->hasLogin()): ?>
                    <div class="option">
                        <label for="author" class="required"></label>
                        <input placeholder="<?php _e('称呼'); ?>" type="text" name="author" id="author" class="text"
                               value="<?php $this->remember('author'); ?>" required/>
                    </div>
                    <div class="option">
                        <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>></label>
                        <input placeholder="<?php _e('邮箱'); ?>" type="email" name="mail" id="mail" class="text"
                               value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </div>
                    <div class="option">
                        <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>></label>
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
                        <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    <?php endif; ?>
    <script type="text/javascript">
        (function () {
            let token = <?= Typecho_Common::shuffleScriptVar(
                $this->security->getToken(
                    pjax_url_filter($this->request->getRequestUrl())
                )); ?>
            lanstar.addCommentInit(
                '<?= $this->respondId; ?>', token
            );
        })();
    </script>
    <?php if ($comments->have()): ?>
        <div class="comments-row">
            <?php $comments->listComments([
                'avatarSize' => 64
            ]); ?>
        </div>

        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>
</div>
