<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to CodeIgniter</title>

<style type="text/css">

<?php $this->load->view ('header_view'); ?>

<script>
//<![CDATA[
//]]>
</script>

</head>

<body>
<?php // var_dump($_SERVER); ?>

<iframe name="iframe_file" width="0" height="0" scrolling="no" style="display:none">
</iframe>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<form name="mainform" method="post" enctype="multipart/form-data">
		<input type="hidden" id="script.name" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>/Iframe/" />
		<input type="hidden" id="iframe.target" value="iframe_file" />
		
		<input type="hidden" name="id" value="" />
		<input type="hidden" id="images" name="images" value="<?php echo isset($images) ? $images : ''; ?>" />
		
		<div id="message" style="display:none" onclick="this.style.display='none'"></div>
		<table id="script.input">
			<tr>
				<td><!--onpropertychange-->
					<span class="blue">選擇圖片上傳</span>
					<input type="file" name="userfile" onchange="iframe_submit('upload')">&nbsp;
					<input type="button" onclick="iframe_submit('conf')" value="保存到相冊" />
					<input type="reset" value="撤消" />
					<div id="show_images"></div>
				</td>
			</tr>
		</table>
	
	</form>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>