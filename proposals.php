<?php
session_start();
die("404");
include(dirname(__FILE__)."/common/_config.php");
$pagetitle = 'Proposals';
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">

        <h3 id="page_title" class="info_block__accent rem">All Proposals</h3>

          <div class="proposals">

            <div class="card" id="empty_card" style="text-align:center;height:60vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">All Proposal</h3>
                            <div class="text_block" id="none">Loading... please wait</div>
                         </div>
            </div>

            <div class="row row-fluid" id="proposal-list">
            </div>

          </div><!-- proposals end -->


</section>

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script type="text/javascript">
var proposallist = document.getElementById("proposal-list");
var proposalcontent = '';


window.onload = function() {
  //load all proposals
  ajax_get('./services/showAllproposals.php', function(data) {

      if(data["entries"].length > 0){
          document.getElementById("page_title").classList.remove("rem");
          document.getElementById("empty_card").classList.add("rem");

          data["entries"].forEach(function(obj) {

           proposalcontent = proposalcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                           +obj.description
                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./proposal.php?id='+obj.id+'">'
                                            +'<span>Check out Proposal</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user proposals

      } else {
         document.getElementById("none").innerHTML = "No proposals on the platform yet.";
      }

      proposallist.innerHTML = proposalcontent;
  });

}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
