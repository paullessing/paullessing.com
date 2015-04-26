<?php 
defined('PHONE') or die ('No direct access');

$apps = array();
$apps[] = array(
    'name' => 'Tichu Counter',
    'id' => 'tichucounter',
    'urlid' => 'com.invisiblecreations.tichucounter'
);
$apps[] = array(
    'name' => 'Doorcode Manager',
    'id' => 'doorcodes',
    'urlid' => 'com.invisiblecreations.doorcodes'
);
$apps[] = array(
    'name' => 'St. Anne\'s Hall Menu',
    'id' => 'stanneshall',
    'urlid' => 'com.invisiblecreations.stanneshall'
);
$marketUrl = 'https://play.google.com/store/apps/details?id=';

?>
<div class="screen" id="apps">
  <h2 id="menu-header">My Apps</h2>
  <div id="app-list"><?php foreach ($apps as $app): ?>
<a class="app-link" href="<?php echo $marketUrl . $app['urlid'] ?>" id="<?php echo $app['id'] ?>" target="_blank"><?php echo $app['name'] ?></a><?php endforeach;?>
  </div>
</div>