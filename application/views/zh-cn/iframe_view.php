<textarea id="show_images">
<?php foreach ($images as $k=>$v): ?>
	<?php $img_title = isset($_POST['img_title'][$k]) ? $_POST['img_title'][$k] : ''; ?>
	<br/>标题:<input type="text" name="img_title[<?php echo $k; ?>]" value="<?php echo ($img_title); ?>" style="width:330px" maxlength="50" />
	<input type="button" onclick=document.mainform.id.value="<?php echo $k; ?>";iframe_submit("delete") value="删除" /><br/>
	<img src="<?php echo $arr_res['temp'],$v; ?>" />
<?php endforeach; ?>
</textarea>

<script>
//<![CDATA[
// alert({elapsed_time});
var $pd = parent.document;

$pd.getElementById("show-images").style.display = "block";

$pd.getElementById("show-images").innerHTML = document.getElementById("show_images").value;


//]]>
</script>