<?php
defined('PHONE') or die ('No direct access');
?>
<div class="screen" id="contact">
  <h2 class="title-bar">Contact Details</h2>
  <p>Sharing contact details for:</p>
  <p class="emphasis">Paul Lessing</p>
  <img src="images/qr.png" alt="QR-Code" />
  <p id="contact-details">
    <a href="tel:+447818691276" id="tel-number">+44 7818 691 276</a><br />
    <a href="mailto:paul@paullessing.com" id="mail-address">paul@paullessing.com</a>
  </p>
  <?php /*<a id="download">Download vCard</a>*/ ?>
  <ul id="menu">
    <li><a id="vcf" href="files/Paul%20Lessing.vcf">Download vCard</a></li>
  </ul>
  <script type="text/javascript">currentPage = 'contact';</script>
</div>