<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to CodeIgniter</title>


</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<form id="test" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>/Db_forge/show/">
		<input type="hidden" name="ajax" value="no" />
		
		<div name="test">post-iframe</div>
		
		<label>電子郵箱：</label>
			<input id="txtemail" name="email" type="text" value="">
		</p>
		<p>
			<span id="spemail" class="sp" style="display: inline;">郵箱不能為空</span>
		</p>
		
		<p>
			<label>用戶名：</label>
			<input id="username" name="account" type="text" value="">
		</p>
		<p>
			<font style="font-size:12px; color:#666;">用戶名為6到32位，由數字、字母、下劃線組成</font>
		</p>
		
		<input class="button1" type="submit" name="create" value=""/>
		<input class="button1" type="submit" name="drop" value=""/>
	</form>
	

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>

<?php $this->load->view('header_view'); ?>

<script>
//<![CDATA[
//]]>
</script>

</html>