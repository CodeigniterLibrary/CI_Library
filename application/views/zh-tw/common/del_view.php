<?php $this->load->view('common/header_view'); ?>

<body>
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<form name="mainform" method="get" action="">
		回到上一界面可按後退鍵。
	<?php if (isset($_GET['chkopt'])): ?>
		<?php echo form_hidden2('chkopt', $_GET['chkopt']); ?>
		<input class="submit" name="del_cmd" value="確定刪除" type="submit">
	<?php else: ?>
		請選刪除內容。
	<?php endif; ?>
	</form>
	
</div>

<?php $this->load->view('common/footer_view'); ?>

</html>