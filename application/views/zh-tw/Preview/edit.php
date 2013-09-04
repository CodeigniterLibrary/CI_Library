
<div id="container">
	<iframe name="iframe_file" <?php /*style="display:none"*/?>></iframe>

	<h1>Welcome to CodeIgniter!</h1>

	<form name="mainform" method="post" enctype="multipart/form-data">
		<input type="hidden" id="script-name" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>/Preview/" />
		<input type="hidden" id="iframe-target" value="iframe_file" />

		<input type="hidden" name="id" value="" />
		<input type="hidden" id="images" name="images" value="<?php echo isset($images) ? $images : ''; ?>" />

		<div id="valid-msg" style="display:none"></div>
		<table>
			<tr>
				<td><!--onpropertychange-->
					<span class="blue">選擇圖片上傳</span>
					<input type="file" name="userfile">&nbsp;
					<input class="button" type="submit" name="conf_cmd" value=" 保存到相冊 "/>
					<input type="reset" value="撤消" />
					<div id="show-images"></div>
				</td>
			</tr>
		</table>

	</form>
</div>

<script type="text/javascript">
//<![CDATA[

var def_img;
var prepend_img;
window.onload = function() {
	def_img = function(obj) {
		if (confirm("確定要刪除")) {
			remove(obj.parentNode);
		}
	};
	
	prepend_img = function(id, text) {
	
		jQuery("#show-images").prepend('<span>' + text + '</span>');
		
		document.getElementById(id).onclick = wImg;
	};
	
	document.getElementById('valid-msg').onclick= function() {
		this.style.display = 'none';
	};
	
	var destform = document.mainform;
	
	destform.userfile.onchange = function() {
		iframe_submit('upload');
	};
	
	var script_name = document.getElementById('script-name').value;
	var iframe_target = document.getElementById('iframe-target').value;
	function iframe_submit(method) {

		destform.action = script_name + method;
		destform.target = iframe_target

		destform.submit();
	}
	
	destform.conf_cmd.onclick = function() {
	
		destform.action = script_name + 'edit';
		destform.target = iframe_target
		return true;
	};
};
//]]>
</script>