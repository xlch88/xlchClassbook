<?php include(T('_Common/Header'));?>
<div class="container container-alt">
	<div class="block-header">
		<h2>
			留言板
			<small>您可以在这里发表您的留言、感想。请勿发表过激言论。</small>
		</h2>
	</div>
	<div class="row wall">
		<div class="col-md-8 col-md-offset-2">
			<img src="/Upload/Default/Comment.png" class="img-responsive img-thumbnail" alt="School">
		</div>
		<div class="col-md-12">
		<?php $CommentList=$I['CommentList']; include(T('_Common/Comment'));?>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer'));?>