<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">

        <h3 id="page_title" class="info_block__accent rem">All Polls</h3>



            <div class="card" id="empty_card" style="text-align:center;height:60vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">Home Page</h3>
                            <div class="text_block" id="none">Welcome to Home Page</div>
                         </div>
            </div>

            <div class="row row-fluid" id="poll-list">


          </div><!-- polls end -->


</section>

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>


<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
