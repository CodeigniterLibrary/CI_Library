
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<?php
		$script_name = $_SERVER['SCRIPT_NAME'];
		$ymd_format = ymd_format();
	?>
	<form name="mainform" method="post" action="<?php echo $script_name; ?>/Book/show">
		<noscript>
		<input type="hidden" name="no_script" value="" />
		</noscript>
		<input type="hidden" name="url_seek" value="<?php echo $url_seek; ?>" />
		
		<table id="script-input">
			<tr>
				<td width="120"><span class="blue">id</span></td>
				<td><input type="text" name="id" value="<?php echo set_value('id'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">名称</span></td>
				<td><input type="text" name="name" value="<?php echo set_value('name'); ?>" style="width:130px" /></td>
			</tr>
			<tr>
				<td width="120"><span class="blue">爱好</span></td>
				<td>
					<?php echo form_dropdown('search'
						, $arr_res['arr_search']
						, set_value('search', 'in'));?>
					
					
					<?php foreach ($arr_res['arr_attention'] as $value => $disp):
						echo form_checkbox('attention[]', $value, in_array($value, set_value('attention', array()))),$disp;
					endforeach; ?>
				</td>
			</tr>
		</table>
		
		<input class="submit" type="submit" name="show_cmd" value="OK"/>
		<input class="submit" type="submit" name="del_cmd" value="删除"/>
		<a class="button" href="<?php echo $script_name; ?>/Book/add/" target="_blank">新增</a>
	
	<?php if ( ! isset($res[0])): ?>
		<?php if (isset($res)): ?>
		<br/>没有数据
		<?php else: ?>
		<br/>请输入条件
		<?php endif; ?>
	<?php else: ?>
	
	<table>
		<tr>
			<th>&nbsp;</th>
			<th>id</th>
			<th>名称</th>
			<th>关注</th>
			<th>修改日期</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach ($res as $k => $v): ?>

		<tr>
			<td>
				<input type="checkbox" name="chkopt[]" value="<?php echo $v['book_id']; ?>" >
			</td>
			<td><?php echo $v['book_id']; ?></td>
			<td><?php echo $v['book_name']; ?>&nbsp;</td>
			<td><?php echo say_name($v['book_attention'], $arr_res['arr_attention']); ?>&nbsp;</td>
			<td><?php echo date($ymd_format, $v['up_date']); ?></td>
			<td>
				<a class="button" href="<?php echo $script_name; ?>/Book/edit/?id=<?php echo $v['book_id']; ?>" target="_blank">修改</a>
			</td>
		</tr>
		
		<?php endforeach; ?>
	</table>
	<?php echo $this->pagination->create_links(); ?>
	<?php endif; ?>
	
	</form>
	
</div>	


