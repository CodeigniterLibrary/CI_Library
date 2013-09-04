
<div id="container">


<h1>Welcome to CodeIgniter!</h1>

<form name="mainform" method="post" ">
	<noscript></noscript>
	<div id="message">
		<?php echo validation_errors(); ?>
	</div>

	<table id="script_input">
		<tr>
			<td>名稱<span class="">（※）</span></td>
			<td><input type="text" name="book_name" value="<?php echo ele('book_name', $res); ?>" size="30" maxlength="30" style="" /></td>
		</tr>
		<tr>
			<td>地區<span class="">（※）</span></td>
			<td>
				<input type="hidden" name="book_attention[]" value="" />
				<?php $int = int_arr(ele('book_attention', $res));
				foreach ($arr_res['arr_attention'] as $value => $disp):
					echo form_checkbox('book_attention[]', $value, in_array($value, $int)),$disp;
				endforeach; ?>
			</td>
		</tr>
	</table>
	<div>
		<input type="reset" value="撤消" />
		<input class="submit" type="submit" value="OK"/>
	</div>
</form>

</div>
