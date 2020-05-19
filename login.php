<?php
session_start();
include("_config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("_head.php"); ?>
</head>

<body onload="opendnaurl()">
<header class="header">
<?php include("_header.php"); ?>
</header>
<script>
function S4() {
    return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
}

// then to call it, plus stitch in '4' in the third group
function opendnaurl(){
  var urlofwebsite = '<?php echo $url;?>';
   var token = '<?php $guid = GUID();
   echo $guid;
     $_SESSION["token"] = $guid;?>';
   var url = 'dna://signin/v1?nonce_endpoint=<?php echo $url;?>start-session.php&token='+token+'&callback_url=<?php echo $url;?>index.php&authentication_endpoint=<?php echo $url;?>auth.php';
   window.open(encodeURI(url), '_self');
   console.log(encodeURI(url));
}


</script>
<main class="main">
<div class="container">
<div class="container">
<div class="card" style="text-align:center;height:70vh">
<div>
<img src="images//idena-logo.svg" alt="Idena" width="100px" style="margin:60px"/>
<h3>Launching Idena App...</h3>
<div class="text_block">If you do not have Idena app installed on your computer, please open <br/>the <a href="https://idena.io?view=download">download page</a> to install it and then try again</div>

</div>
</div>
</div>
</div>
</main>

</body>
</html>
