<?php
defined('PHONE') or die ('No direct access');
?>
<div class="screen" id="home">
  <div id="clock">
    <div id="time">
      <div id="hour">00</div>
      <div id="minutes">00</div>
    </div>
  </div>
  <script type="text/javascript">
  var currentTime = new Date();
  function checkTime() {
    var newTime = new Date();
    if (newTime.getMinutes() != currentTime.getMinutes() || newTime.getHours() != currentTime.getHours()) {
      $('#hour').html(padTime(newTime.getHours()));
      $('#minutes').html(padTime(newTime.getMinutes()));
      currentTime = newTime;
    }
  }
  setInterval(checkTime,500);
  
  function padTime(currentTime) {
    return (currentTime < 10 ? '0' + currentTime : currentTime);
  }
  
  document.getElementById('hour').innerHTML = padTime(currentTime.getHours());
  document.getElementById('minutes').innerHTML = padTime(currentTime.getMinutes());
  </script>
  <div id="launcher">
    <a onclick="clickLink('contact'); return false;" id="contact" href="contact">Contact</a>
    <a onclick="clickLink('mail'); return false;" id="email" href="mail">Send Mail</a>
    <a onclick="clickLink('apps'); return false;" id="apps" href="apps">Apps</a>
    <a></a>
    <a></a>
  </div>
  <script type="text/javascript">currentPage = 'home';</script>
</div>