<script>
//<![CDATA[

var $pd = parent.document;
/* 把父窗口显示消息的层打开 */
$pd.getElementById("valid-msg").style.display = "block";

/* 把本窗口获取的消息写上去 */
$pd.getElementById("valid-msg").innerHTML = "<?php echo $error; ?>";

/* 并且设置为10秒后自动关闭父窗口的消息显示 */
setTimeout("$pd.getElementById('valid-msg').style.display = 'none'", 10000);

//]]>
</script>