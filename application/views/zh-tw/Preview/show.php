<textarea id="show_images">
<?php foreach ($images as $k=>$v): ?>
	<?php $img_title = isset($_POST['img_title'][$k]) ? $_POST['img_title'][$k] : ''; ?>
	<br/>標題:<input type="text" name="img_title[<?php echo $k; ?>]" value="<?php echo ($img_title); ?>" style="width:330px" maxlength="50" />
	<input type="button" onclick=document.mainform.id.value="<?php echo $k; ?>";iframe_submit("delete") value="刪除" /><br/>
	<img src="<?php echo $arr_res['temp'],$v; ?>" />
<?php endforeach; ?>
</textarea>

<script>
//<![CDATA[
// alert({elapsed_time});
var $pd = parent.document;
$pd.getElementById("images").value = '<?php echo serialize($images); ?>';

$pd.getElementById("show_images").style.display = "block";

$pd.getElementById("show_images").innerHTML = document.getElementById("show_images").value;


//]]>
</script>