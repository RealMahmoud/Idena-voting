<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
$pagetitle = 'Errot 404';
include(dirname(__FILE__)."/partials/header.php");
?>
      <section class="section section_info">
        <div class="card" style="text-align:center;height:70vh">
                <div>
                    <img src="./images/idena_black.svg" alt="Idena" width="100px" style="margin:60px"/>
                    <h3 class="info_block__accent">404 Not Found</h3>
                    <br/>
                    <br/>
                    <div class="text_block">The url you were looking for doesn't exist on this server</div>
                </div>
        </div>
      </section>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
