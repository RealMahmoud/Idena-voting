<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
$pagetitle = 'fvfs';
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">

        <h3 id="page_title" class="info_block__accent rem">All fvfs</h3>

          <div class="fvfs">

            <div class="card" id="empty_card" style="text-align:center;height:60vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">All fvf</h3>
                            <div class="text_block" id="none">Loading... please wait</div>
                         </div>
            </div>

            <div class="row row-fluid" id="fvf-list">
            </div>

          </div><!-- fvfs end -->


</section>

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script type="text/javascript">
var fvflist = document.getElementById("fvf-list");
var fvfcontent = '';


window.onload = function() {
  //load all fvfs
  ajax_get('./services/showAllfvfs.php', function(data) {

      if(data["entries"].length > 0){
          document.getElementById("page_title").classList.remove("rem");
          document.getElementById("empty_card").classList.add("rem");

          data["entries"].forEach(function(obj) {

           fvfcontent = fvfcontent + '<div class="col-12 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="desc" style="padding-bottom: 20px;">'
                                           +obj.description
                                          +'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./fvf.php?id='+obj.id+'">'
                                            +'<span>Check out fvf</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });

      } else {
         document.getElementById("none").innerHTML = "No fvfs on the platform yet.";
      }

      fvflist.innerHTML = fvfcontent;
  });

}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
