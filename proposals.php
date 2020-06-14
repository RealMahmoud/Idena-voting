<?php
session_start();

include(dirname(__FILE__)."/common/_public.php");

$pagetitle = 'Proposals';

include(dirname(__FILE__)."/partials/header.php");


if(isset($_GET["cat"])){
$title = '<h3 id="page_title" class="info_block__accent rem">Top Proposals '.'- <a href="./proposals.php?cat='.$conn->real_escape_string($_GET["cat"]).'">#'.$conn->real_escape_string($_GET["cat"]).'</a></h3>';
}else {
  $title = '<h3 id="page_title" class="info_block__accent rem">Top Proposals</h3>';
}
?>


<section class="section section_tabs">
   <div class="tabs">
      <div class="section__header">
         <div class="row align-items-center justify-content-between">
            <div class="col">
               <ul class="nav nav-tabs" role="tablist">
                 <li class="nav-item">
                    <a onclick="Change('1');" id='1Nav'class="nav-link active">
                       <h3>Running</h3>
                    </a>
                 </li>
                  <li class="nav-item">
                     <a onclick="Change('2');" id='2Nav' class="nav-link ">
                        <h3>Ended</h3>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a onclick="Change('3');" id='3Nav' class="nav-link ">
                        <h3>Categories List</h3>
                     </a>
                  </li>


               </ul>
            </div>
         </div>
      </div>
      <div class="tab-content">





        <div class="tab-pane active" id="1Con">
          <div id="none1">
            <div class="card" id="empty_card" style="text-align:center;height:60vh">
            <div>
            <h3 class="info_block__accent" style="margin-top: 3em;">Running Proposals</h3>
            <div class="text_block" id="none">No Proposals Available</div>
            </div>
            </div>
          </div>
          <div class="row row-fluid" id="proposal-list-running">
          </div>
        </div>

        <div class="tab-pane " id="2Con">
          <div id="none2">  <div class="card" id="empty_card" style="text-align:center;height:60vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">Ended Proposals</h3>
                            <div class="text_block" id="none">No Proposals Available</div>
                         </div>
            </div>
          </div>
          <div class="row row-fluid" id="proposal-list-ended">

          </div>
        </div>
        <div class="tab-pane " id="3Con">
          <div id="none3">  <div class="card" id="empty_card" style="text-align:center;height:60vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">Categories</h3>
                            <div class="text_block" id="none">No Categories Available</div>
                         </div>
            </div>
          </div>

          <div class="row row-fluid" id="cat-list">

          </div>
        </div>





      </div>
   </div>
</section>


<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

<script>
   function Change(Newl) {
     if(Newl == '1') {
    document.getElementById("1Con").classList.add("active");
    document.getElementById("1Nav").classList.add("active");

    document.getElementById("2Nav").classList.remove("active");
    document.getElementById("2Con").classList.remove("active");
    document.getElementById("3Nav").classList.remove("active");
    document.getElementById("3Con").classList.remove("active");



     }
     if(Newl == '2') {
    document.getElementById("2Con").classList.add("active");
    document.getElementById("2Nav").classList.add("active");

    document.getElementById("1Nav").classList.remove("active");
    document.getElementById("1Con").classList.remove("active");
    document.getElementById("3Nav").classList.remove("active");
    document.getElementById("3Con").classList.remove("active");



     }
     if(Newl == '3') {
    document.getElementById("3Con").classList.add("active");
    document.getElementById("3Nav").classList.add("active");

    document.getElementById("2Nav").classList.remove("active");
    document.getElementById("2Con").classList.remove("active");
    document.getElementById("1Nav").classList.remove("active");
    document.getElementById("1Con").classList.remove("active");



     }






}


</script>


 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script type="text/javascript">
var proposalsrunninglist = document.getElementById("proposal-list-running");
var proposalsrunningcontent = '';

var proposalsendedlist = document.getElementById("proposal-list-ended");
var proposalsendedcontent = '';



var catlist = document.getElementById("cat-list");
var catcontent = '';
<?php
if(isset($_GET['cat'])){
  $cat = $conn->real_escape_string($_GET['cat']);
  echo "var catv = '&cat=".$cat."';";
  echo "var cat = '?cat=".$cat."';";
}else{
    echo "var cat = '';";
    echo "var catv = '';";
}
?>


window.onload = function() {

  ajax_get('./services/getProposalsRunning.php'+cat, function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {
          if(obj.vip == 1){
            proposalsrunningcontent = proposalsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                           +'<div class="mini-card">'
                                           +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                            +obj.title
                                           +'</p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #FFD700;"> - VIP - </p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./proposals.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                             +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                           +'<a class="btn btn-secondary btn-small" href="./proposal.php?id='+obj.id+'">'
                                             +'<span>Check out Proposal</span>'
                                             +'<i class="icon icon--thin_arrow_right"></i>'
                                           +'</a>'
                                           +'</div>'
                                         +'</div>';
          }else{
            proposalsrunningcontent = proposalsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                           +'<div class="mini-card">'
                                           +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                            +obj.title
                                           +'</p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #84ce84;"> - Normal - </p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./proposals.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                             +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                           +'<a class="btn btn-secondary btn-small" href="./proposal.php?id='+obj.id+'">'
                                             +'<span>Check out Proposal</span>'
                                             +'<i class="icon icon--thin_arrow_right"></i>'
                                           +'</a>'
                                           +'</div>'
                                         +'</div>';
          }


         });
         document.getElementById("none1").innerHTML = '';
           proposalsrunninglist.innerHTML =  proposalsrunningcontent;
      }
  });



  ajax_get('./services/getProposalsEnded.php'+cat, function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {
          if(obj.vip == 1){
            proposalsrunningcontent = proposalsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                           +'<div class="mini-card">'
                                           +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                            +obj.title
                                           +'</p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #FFD700;"> - VIP - </p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./proposals.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                             +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                           +'<a class="btn btn-secondary btn-small" href="./proposal.php?id='+obj.id+'">'
                                             +'<span>Check out Proposal</span>'
                                             +'<i class="icon icon--thin_arrow_right"></i>'
                                           +'</a>'
                                           +'</div>'
                                         +'</div>';
          }else{
            proposalsrunningcontent = proposalsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                           +'<div class="mini-card">'
                                           +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                            +obj.title
                                           +'</p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color:  #84ce84;"> - Normal - </p>'
                                           +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./proposals.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                             +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                           +'<a class="btn btn-secondary btn-small" href="./proposal.php?id='+obj.id+'">'
                                             +'<span>Check out Proposal</span>'
                                             +'<i class="icon icon--thin_arrow_right"></i>'
                                           +'</a>'
                                           +'</div>'
                                         +'</div>';
          }


         });
         document.getElementById("none2").innerHTML = '';
           proposalsendedlist.innerHTML =  proposalsendedcontent;
      }

  });



  ajax_get('./services/getProposalsCat.php', function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           catcontent = catcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'

                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./proposals.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Proposals Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./proposals.php?cat='+obj.category+'">'
                                            +'<span>Proposals</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user Proposals
  document.getElementById("none3").innerHTML = '';
   catlist.innerHTML =   catcontent;
      }

  });

}

</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
