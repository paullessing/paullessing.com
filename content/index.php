<?php
define('PHONE',true);

$pages = array(
    'home' => 'home',
    'default' => 'home',
    'index' => 'home',
    'qr' => 'qr',
    'contact' => 'qr',
    'mail' => 'mail',
    'email' => 'mail',
    'sendmail' => 'mail',
    'apps' => 'apps',
    'blank' => 'blank',
);
$defaultPage = 'home';

if (isset($_REQUEST['page'])) {
  $demand = $_REQUEST['page'];
} else {
  $request_uri = $_SERVER['REQUEST_URI'];
  $pos = strrpos($request_uri, '/');
  if ($pos !== false) {
    $demand = substr($request_uri, $pos+1);
  }
}

if (!empty($demand) && array_key_exists($demand, $pages)) {
  $page = $pages[$demand];
} else {
  $page = $defaultPage;
}

if (isset($_REQUEST['ajax'])) {
  include 'pages/' . $page . '.php';
  exit;
}

?><!DOCTYPE html>
<html>
<head>
  <title>Paul Lessing</title>
  <meta name="description" content="Paul Lessing's web portfolio" />
  <meta name="keywords" content="Paul Lessing, Paul, Lessing, Web developer, HTML, HTML5, CSS, CSS3" />
  <meta name="author" content="Paul Lessing" />
  <link rel="stylesheet" type="text/css" href="main.css" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<div id="phone">
  <a href="/blank" onclick="return false;" onmousedown="power();" id="power"></a>
  <h1 id="logo">Paul Lessing</h1>
  <div id="screen">
    <?php include "pages/$page.php"; ?>
  </div>
  <a id="home-button" class="textless" onclick="home(); return false;" href="home"></a>
  <a id="options-button" onclick="toggleMenu(); return false;" class="textless"></a>
  <a id="back-button" onclick="back(); return false;" class="no-back textless"></a>
</div>
<pre>
</pre>
</body>
</html>