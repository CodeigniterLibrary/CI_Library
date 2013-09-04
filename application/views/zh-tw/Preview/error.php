<script>
//<![CDATA[

var $pd = parent.document;
/* 把父窗口顯示消息的層打開 */
$pd.getElementById("valid-msg").style.display = "block";

/* 把本窗口獲取的消息寫上去 */
$pd.getElementById("valid-msg").innerHTML = "<?php echo $error; ?>";

/* 並且設置為10秒後自動關閉父窗口的消息顯示*/
setTimeout("$pd.getElementById('valid-msg').style.display = 'none'", 10000);

//]]>
</script>