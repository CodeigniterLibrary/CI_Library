<?php $this->load->view('common/header_view'); ?>

<body>
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<form name="mainform" method="get" action="">
		回到上一界面可按后退键。
	<?php if (isset($_GET['chkopt'])): ?>
		<?php echo form_hidden2('chkopt', $_GET['chkopt']); ?>
		<input class="submit" name="del_cmd" value="确定删除" type="submit">
	<?php else: ?>
		请选删除内容。
	<?php endif; ?>
	</form>
	
</div>

<?php $this->load->view('common/footer_view'); ?>

</html>