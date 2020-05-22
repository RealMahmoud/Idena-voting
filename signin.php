<?php
session_start();
<<<<<<< HEAD
include_once(dirname(__FILE__)."/common/_config.php");
include_once(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
        <div class="card" style="text-align:center;height:70vh">
                <div>
                    <img src="./images/idena_black.svg" alt="Idena" width="100px" style="margin:60px">
                    <h3 class="info_block__accent">Idena Polls</h3>
                    <div class="text_block" style="display: block;padding-bottom: 2rem;">Make polls great again</div>
                    <br/>
                    <a class="btn btn-signin" href="./signingin.php">
                    <img alt="signin" class="icon icon-logo-white-small" src="https://scan.idena.io/static/images/idena_white_small.svg" width="24px"/>
                    <span style="color: #fff;">Sign-in with Idena</span>
                    </a>
                </div>
        </div>
</section>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<?php
include_once(dirname(__FILE__)."/partials/footer.php");
?>
=======
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/partials/header.php");
?>
      <section class="section section_info">
        <div class="card" style="text-align:center;height:70vh">
                <div>
                    <img src="./images/idena_black.svg" alt="Idena" width="100px" style="margin:60px"/>
                    <h3 class="info_block__accent">Launching Idena App...</h3>
                    <br/>
                    <br/>
                    <div class="text_block">If you do not have Idena app installed on your computer, please open <br/>the <a href="https://idena.io?view=download">download page</a> to install it and then try again</div>
                </div>
        </div>
      </section>
  
 <!-- this is to close main, div opened in the header -->     
 </div>
</main>

<!-- add page specific js code below -->

<script type="text/javascript">

// then to call it, plus stitch in '4' in the third group
function opendnaurl(){
  var urlofwebsite = '<?php echo $url;?>';
   var token = '<?php $guid = GUID();
   echo $guid;
     $_SESSION["token"] = $guid;?>';
   var url = 'dna://signin/v1?nonce_endpoint=<?php echo $url;?>services/start-session.php&token='+token+'&callback_url=<?php echo $url;?>polls.php&authentication_endpoint=<?php echo $url;?>services/auth.php';
   window.open(encodeURI(url), '_self');
   console.log(encodeURI(url));
}

window.onload = function() {
    opendnaurl();
}

</script>

<?php 
include(dirname(__FILE__)."/partials/footer.php");
?>
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
