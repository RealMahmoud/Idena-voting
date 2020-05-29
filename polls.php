<?php
session_start();

include(dirname(__FILE__)."/common/_config.php");

$pagetitle = 'Top Polls';
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">

        <h3 id="page_title" class="info_block__accent rem">All Polls</h3>

          <div class="polls">

            <div class="card" id="empty_card" style="text-align:center;height:60vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">All Polls</h3>
                            <div class="text_block" id="none">Loading... please wait</div>
                         </div>
            </div>

            <div class="row row-fluid" id="poll-list">
            </div>

          </div><!-- polls end -->


</section>

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script type="text/javascript">
var polllist = document.getElementById("poll-list");
var pollcontent = '';


window.onload = function() {
  //load all polls
  ajax_get('./services/showAllPolls.php', function(data) {

      if(data["entries"].length > 0){
          document.getElementById("page_title").classList.remove("rem");
          document.getElementById("empty_card").classList.add("rem");

          data["entries"].forEach(function(obj) {

           pollcontent = pollcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                           +obj.description
                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./poll.php?id='+obj.id+'">'
                                            +'<span>Check out poll</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user polls

      } else {
         document.getElementById("none").innerHTML = "No Polls on the platform yet.";
      }

      polllist.innerHTML = pollcontent;
  });

}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
