<?php if(is_array($arrContent)){ ?>
    <h3 class="sub_page_title"><?php echo $arrContent->page_title; ?></h3>
    <div class="sub_page_short"><?php echo $arrContent->short_description; ?></div>
    <div class="sub_page_long"><?php echo $arrContent->long_description; ?></div>
<?php } ?>