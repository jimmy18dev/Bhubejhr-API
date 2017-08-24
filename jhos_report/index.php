<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">
<title>JHOS REPORT</title>
</head>
<body>
<h1>JHOS REPORT</h1>
<div id="conteiner">Main Content...</div>
<?php
$json = file_get_contents('http://jhos.api/report?qid=1&token=bd0889c94d3d2957923e89a9ceece126d');
$obj = json_decode($json);
echo'apiVersion: '. $obj->apiVersion;
?>

<pre><?php print_r($obj); ?></pre>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/report.js"></script>
</body>
</html>