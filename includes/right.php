<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="col-12 col-md-3 text-center text-md-left">
    <div class="card user-container">
        <div class="card-header user-info" style="background-image: url(<?php $this->options->rightImg()?>);">
            <div class="info">
                <img class="pic" src="<?php $this->options->rightAvatar();?>">
                <p><?php $this->options->rightName();?></p>
            </div>
        </div>
        <div class="card-footer user-detail">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <ul class="list-group list-group-horizontal">
                <li>
                    <div class="detail-title" title="文章">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1 2.828v9.923c.918-.35 2.107-.692 3.287-.81 1.094-.111 2.278-.039 3.213.492V2.687c-.654-.689-1.782-.886-3.112-.752-1.234.124-2.503.523-3.388.893zm7.5-.141v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                        </svg>
                    </div>
                    <div class="detail-num">
                        <?php $stat->publishedPostsNum(); ?>
                    </div>
                </li>
                <li>
                    <div class="detail-title" title="评论">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-square-quote-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm7.194 2.766c.087.124.163.26.227.401.428.948.393 2.377-.942 3.706a.446.446 0 0 1-.612.01.405.405 0 0 1-.011-.59c.419-.416.672-.831.809-1.22-.269.165-.588.26-.93.26C4.775 7.333 4 6.587 4 5.667 4 4.747 4.776 4 5.734 4c.271 0 .528.06.756.166l.008.004c.169.07.327.182.469.324.085.083.161.174.227.272zM11 7.073c-.269.165-.588.26-.93.26-.958 0-1.735-.746-1.735-1.666 0-.92.777-1.667 1.734-1.667.271 0 .528.06.756.166l.008.004c.17.07.327.182.469.324.085.083.161.174.227.272.087.124.164.26.228.401.428.948.392 2.377-.942 3.706a.446.446 0 0 1-.613.01.405.405 0 0 1-.011-.59c.42-.416.672-.831.81-1.22z"/>
                        </svg>
                    </div>
                    <div class="detail-num">
                        <?php $stat->publishedCommentsNum(); ?>
                    </div>
                </li>
                <li>
                    <div class="detail-title" title="分类">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmarks" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                            <path fill-rule="evenodd" d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                        </svg>
                    </div>
                    <div class="detail-num">
                        <?php $stat->categoriesNum(); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="card recent-box d-none d-md-block">
        <h4 class="title">最近回复</h4>
        <ul class="list-unstyled">
            <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true&pageSize=5')->to($comments);?>
            <?php while ($comments->next()): ?>
                <li class="media my-4">
                    <img class="recent-avatar mr-3" src="//cdn.v2ex.com/gravatar/<?php echo md5($comments->mail); ?>?s=40&d=mp" />
                    <div class="media-body">
                        <h6 class="mt-0 mb-1"><?php $comments->author(false);?></h6>
                        <a class="content" href="<?php $comments->permalink();?>" target="<?php $this->options->sidebarLinkOpen();?>">
                            <?php echo contents::parseHide(contents::parseOwo($comments->excerpt(35, '...')));?>
                        </a>
                    </div>
                </li>
            <?php endwhile;?>
        </ul>
    </div>
    <div class="random-post d-none d-md-block">
        <h4 class="title">可能感兴趣</h4>
        <?php theme_random_posts();?>
    </div>
    <?php $this->need('includes/footer.php');?>
</div>

