<div style="width: 100%; padding-bottom: 10px;">
    <div style="float: left;">
        <span class="namecompany">
            <?php
                if(isset($type) && $type == UserItem::TYPE_PRODUCT): 
                    echo 'Danh sách bình luận về sản phẩm: <b>'.$model['title'].'</b>';
                elseif(isset($type) && $type == UserItem::TYPE_SHOP) :
                    echo 'Danh sách bình luận về cửa hàng: <b>'.$model['title'].'</b>';
                endif;    
            ?>
        </span>
    </div>
    <div class="clear"></div>
</div>
<div id="comment_sub">
    <?php
        if(isset($vote_type) && $vote_type == ItemVote::COMPLIMENT_VOTE):
    ?>
    <h3>Danh sách những lý do khen <span class="like">Nên Mua</span></h3>
    <?php elseif(isset($vote_type) && $vote_type == ItemVote::DECRY_VOTE) :?>
    <h3>Danh sách những lý do chê <span class="like">Không Nên Mua</span></h3>
    <?php endif;?>
    <?php
        if(is_array($arrComment) && count($arrComment) > 0){
            foreach($arrComment as $key=>$comment){
            ?>
            <div class="comment">
                <div class="avatar">
                    <img class="Radius" src="<?php echo Yii::app()->theme->baseUrl;?>/images/avatar.png" border="0" /><br />
                    <?php echo $comment['facebook_email'];?>
                </div>
                <div class="info_comment">
                    <?php echo $comment['comment'];?>
                </div>
                <div class="clear"></div>
            </div>
            <?php
            }
        }else{
            echo 'Không có bình luận nào';
        }
    ?>
    <div class="jb_pagination">
        <?php echo $pageInfo['strPager'];?>
    </div>
    <script src="http://connect.facebook.net/vi_VN/all.js#appId=287239248051826&amp;xfbml=1"></script>
    <fb:comments xid="287239248051826" width="920px" num_posts="10"></fb:comments>
</div>
<div class="clear"></div>
