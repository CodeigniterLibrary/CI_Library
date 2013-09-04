
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<textarea id="show-images">
	<br/>
	&nbsp;標題:&nbsp;<input type="text" name="img_title[]" value="<?php echo $orig_name; ?>" style="width:330px" maxlength="50" />
	<input class="del-cmd" type="button" onclick="def_img(this)" value="刪除" />&nbsp;
	
	<a id="<?php echo $file_name; ?>" class="img-cmd" href="<?php echo $arr_res['temp'], $file_name; ?>" target="_blank">
	看大圖<br/><img src="<?php echo $arr_res['temp'], $file_name_thumb; ?>" /></a>&nbsp;
	
	<input type="hidden" name="images[]" value="<?php echo $file_name; ?>" />
	<br/>
</textarea>

<script>
//<![CDATA[
// alert({elapsed_time});

	parent.prepend_img("<?php echo $file_name; ?>", document.getElementById("show-images").value);

//]]>
</script>