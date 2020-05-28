<?php
session_start();
session_destroy();
session_start();
include_once(dirname(__FILE__)."/common/_config.php");
$pagetitle = 'Sign In';
include_once(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
        <div class="card" style="text-align:center;">
                <div>
                    <img src="./images/idena_black.svg" alt="Idena" width="100px" style="margin:60px">
                    <h3 class="info_block__accent">Idena Polls</h3>
                    <div class="text_block" style="display: block;padding-bottom: 2rem;">Make polls great again</div>
                    <br/>
                    <a class="btn btn-signin" href="./signingin.php">
                    <img alt="signin" class="icon icon-logo-white-small" src="https://scan.idena.io/static/images/idena_white_small.svg" width="24px"/>
                    <span style="color: #fff;">Sign-in with Idena</span>
                    </a>
                    <br>

                        <br>
                    <a class="btn btn-signin" href="./mobile-login.php">
                   <img alt="signin" class="icon icon-logo-white-small" src="https://scan.idena.io/static/images/idena_white_small.svg" width="24px">
                   <span style="color: #fff;">Sign-in with Secret Token</span>
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
