<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'))?>
<div class="container container-alt">
	<?php include(T('Image/Header'))?>
    <div class="card">
        <div class="action-header clearfix">
            <div class="c-blue ah-label hidden-xs"><?=$I['Image']['Dir']['Name']?></div>
            <div class="c-green ah-label hidden-xs"><br><?=$I['Image']['Dir']['Bewrite']?></div>
        </div>
        <div class="card-body card-padding">
			<?php
			$ImageList = $I['Image']['Dir']['Pics'];
			include(T('_Common/ImageShow'));
			?>
			
            <div class="clearfix"></div>

            <div class="text-center m-t-30">
                <?php if($I['Image']['Dir']['AnybodyUpload'] or $I['Image']['Dir']['CreaterId'] == $UserInfo['ID']){?><a class="btn btn-primary btn-lg" href="<?=U('Image','Edit','Edit',$I['Image']['Dir']['ID']);?>"><?=($I['Image']['Dir']['CreaterId'] == $UserInfo['ID'] ? '<i class="fa fa-edit"></i> 编辑/上传' : '<i class="fa fa-image"></i> 上传图片')?></a><?php } ?>
            </div>
        </div>
    </div>
	
	<?php $CommentList=$I['CommentList']; $ImgDirId=$I['Image']['Dir']['ID']; $IsHr=true; $IsImg=true; include(T('_Common/Comment'));?>
</div>
<?php include(T('_Common/Footer'))?>