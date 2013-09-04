<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">

<title>Welcome to CodeIgniter</title>
<?php $css_path = "http://{$this->config->config['css']}"; ?>
<!--[if gte IE 7]><!-->
    <link id="artDialog-skin" href="<?php echo $css_path; ?>/green.css" rel="stylesheet" />
<!--<![endif]-->
<!--[if lt IE 7]>
    <link id="artDialog-skin" href="<?php echo $css_path; ?>/default.css" rel="stylesheet" />
<![endif]-->

<style type="text/css">
	body { font-size:14px; color:#666; font-family:'Microsoft Yahei', Tahoma, Arial!important; font-family:Tahoma, Arial; background:#dbdfe3; }
	a { color:#039; }
	a:hover { color:#06C; }
	img { border:none 0; }
	body.showChange .change { background:#FF0; border-radius: 3px; }
	h1.title { text-align:center; color:#30475e; }
	h1.title strong { font-size:42px; position:relative; }
	h1.title strong:after { content:''; display:block; position:absolute; left:0; bottom:24px; width:90%; height:1px; box-shadow:0 20px 15px rgba(0, 0, 0, .8); }
	#header, #main, #footer { width:640px; margin:auto; }
	#header .summary { padding:20px; background:#30475e; color:#FFF; border-radius: 8px; zoom:1; }
	#header .summary:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
	#header .summary a { color:#FFF; }
	#header .summary a:hover { color:#CCC; }
	#header .summary strong { display:inline-block; width:5em; }
	#header .summary dl { padding:0; margin:0; }
	#header .summary dd { margin-left:0; padding:3px 0; }
	#header .summary dt { display:none; }
	#header .summary dd.photo { float:right; }
	#header .summary img { border:1px #506f8e solid; }
	#main .card { padding:20px; margin-top:30px; background: #FFF; border:1px solid #d1d6db; border-radius: 8px; }
	#main .card:after { position:relative; z-index:-1; content: ""; padding:20px; display: block; height: 10px; border-radius: 10px; box-shadow:0 20px 20px rgba(2, 37, 69, .6); }
	#main .card h2 { text-align:center; color:#000; }
	#main .card ul dl { padding-left:1em; border-left:1px dashed #DDD; }
	#main .card ul dt { padding:8px 0; font-weight:bold; }
	#main .card ul dd { margin-left:0; }
	#main .card ul dd dl { margin-left:2em; }
	#footer { padding:20px 0; text-align:center; color:#999; }
	#footer .copyright a { color:#999; }
	/*///// code /////*/
	.runCode:after { content: "..."; }
	.button, .runCode { display:inline-block; padding:1px 12px; text-decoration:none; color: #333 !important; cursor:pointer; border: solid 1px #999; border-radius: 5px; background: #DDD; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#DDDDDD');
						background: linear-gradient(top, #FFF, #DDD); background: -moz-linear-gradient(top, #FFF, #DDD); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFF), to(#DDD)); text-shadow: 0px 1px 1px rgba(255, 255, 255, 1); box-shadow: 0 1px 0 rgba(255, 255, 255, .2), 0 -1px 0 rgba(0, 0, 0, .09); -moz-transition:-moz-box-shadow linear .2s;
						-webkit-transition: -webkit-box-shadow linear .2s;
						transition: box-shadow linear .2s;
						white-space: nowrap; }
	.button:focus, .runCode:focus { outline:none 0; border-color:#426DC9; box-shadow:0 0 8px rgba(66, 109, 201, .9); }
	.button:hover, .runCode:hover { color:#000; border-color:#666; }
	.button:active, .runCode:active { border-color:#666; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#DDDDDD', endColorstr='#FFFFFF');
									  background: linear-gradient(top, #DDD, #FFF); background: -moz-linear-gradient(top, #DDD, #FFF); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#DDD), to(#FFF)); box-shadow:inset 0 1px 5px rgba(66, 109, 201, .9), inset 0 1px 1em rgba(0, 0, 0, .3); }
	.button[disabled] { cursor:default; color:#666; background:#DDD; border: 1px solid #999; filter:alpha(opacity=50); opacity:.5; box-shadow:none; }
	
	pre { position:relative; padding:5px; font-size:12px; border:1px solid #EFEFEF; background:#F9F9F9; z-index:2; border-radius: 5px; }
	pre:before, pre:after { visibility:hidden; display:block; content:""; width:0; height:0; border:9px solid transparent; position:absolute; }
	pre:before { border-top-color:#EEF7F5; position:absolute; left:18px; bottom:-18px; z-index:2; }
	pre:after { border-top-color:#c7dcd3; left:18px; bottom:-19px; z-index:1; }
	pre.select { background:#EEF7F5 !important; border:1px solid #D7EAE2; border-right-color:#c7dcd3; border-bottom-color:#c7dcd3; }
	pre.select:before, pre.select:after { visibility:visible; }
	/*//// skin ////*/
	#skins { width:560px; padding:8px 0; }
	#skins .button { width:82px; text-align:center; }
	#skins ul, #skins li { padding:0; margin:0; list-style:none; }
	#skins li { display:inline; }
	#skins ul { text-align:center; }

	#showChange { position:fixed; bottom:0; right:0; z-index:87; }
	@media only screen and (max-width:980px) {
		h1.title {
			font-size:24px;
		}
		#header, #main, #footer {
			max-width:100%;
		}
		img {
			max-width:100%
		}
	}
	@media print {
		#header .summary, a { color: #000 !important; }
		#header, #main, #footer { width:auto; }
		#main .card { padding:10px; margin-top:10px; box-shadow:none; border:none 0; border-top: 1px dashed #666; border-radius:0; }
		#main .card h2 { text-align:left; }
		#main .card:after { display:none; }
		h1.title strong:after, #index, #print, .runCode, .button, #skin-menu { display:none; }
	}
	
	#header .sort-link { color: #000; }
	#header .sort-link-asc { color: #e10; }
	#header .sort-link-desc { color: #2b1; }
</style>

</head>
<body>