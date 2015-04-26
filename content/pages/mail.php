<?php
defined('PHONE') or die ('No direct access');

if ($_SERVER['REQUEST_METHOD'] == 'POST'):
  $fromPattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i';  // Invalid characters in from
  $subjPattern = "/(\n|\r)/i";  // Invalid characters in subject
  
  $find = array("/bcc\:/i","/Content\-Type\:/i","/cc\:/i","/to\:/i");
  
  $from = preg_replace($fromPattern, '', $_POST['from']);
  $from = preg_replace($find, '#CONTENT REPLACED#', $from);
  $from = filter_var($from, FILTER_VALIDATE_EMAIL);
  
  $subject = preg_replace($subjPattern, '', $_POST['subject']);
  $subject = preg_replace($find, '#CONTENT REPLACED#', $subject);
  
  $content = preg_replace($find, '#CONTENT REPLACED#', $_POST['content']);
  
  if (!empty($from) && !empty($subject) && !empty($content)) {
    $emailcontent = <<<EOM
---------------------------------------
Email from paullessing.com
---------------------------------------

Email: $from
Message: $content

_______________________________________
End of Email
EOM;
      
    $headers = "From: $from\n";
    $headers . "MIME-Version: 1.0\n"
    . "Content-Transfer-Encoding: 7bit\n"
    . "Content-type: text/html;  charset = \"iso-8859-1\";\n\n";
    
    $success = mail('paul@paullessing.com', 'Email from paullessing.com: ' . $subject, $emailcontent, $headers);
  } else {
    $success = false;
  }
  
  if ($success): ?>
<div class="screen" id="mail-success">
  <h2 class="title-bar">Email sent</h2>
  <p>Your email was sent successfully.</p>
  <script type="text/javascript">
  lastItem = history[history.length-1];
  if (lastItem == 'mail' || lastItem == 'email') {
    history.pop();
  }
  </script>
</div>
<?php else: ?>
<div class="screen" id="mail-failure">
  <h2 class="title-bar">Email not sent</h2>
  <p>An error has occurred and your email was not sent.</p>
  <p>Please try again later.</p>
  <script type="text/javascript">
  lastItem = history[history.length-1];
  if (lastItem == 'mail' || lastItem == 'email') {
    history.pop();
  }
  </script>
</div>
<?php
  endif;
else:
?>
<div class="screen" id="mail">
  <script type="text/javascript">
  function formSubmit() {
    var dataString = 'page=sendmail&ajax=1&from='+ $('#from').val() + '&subject=' + $('#subject').val() + '&content=' + $('#content').val();
    $.ajax({  
      type: "POST",
      url: "index.php",
      data: dataString,  
      success: function(data) {
        animateNewPage(data);
      }
    });
    return false;
  }
  </script>
  <h2 class="title-bar">Compose Email</h2>
  <form method="post" action="sendmail">
    <div class="input-row">
      <label for="to">To</label>
      <span id="to" class="input">paul&#64;paullessing.com</span>
    </div>
    <div class="input-row">
      <label for="from">From</label>
      <input type="email" name="from" id="from" placeholder="name@example.com" />
    </div>
    <div class="input-row">
      <label for="subject">Subject</label>
      <input type="text" name="subject" id="subject" />
    </div>
    <textarea id="content" placeholder="Your message here"></textarea>
    <div id="buttons">
      <a id="cancel-button" onclick="back() || home();" href="home">Cancel</a>
      <input type="submit" value="Send" id="send-button" onclick="return formSubmit()" />
    </div>
  </form>
  <script type="text/javascript">currentPage = 'mail';</script>
</div>
<?php endif;