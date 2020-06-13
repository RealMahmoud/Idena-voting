<?php
session_start();

include(dirname(__FILE__)."/common/_config.php");

$pagetitle = 'Polls';

include(dirname(__FILE__)."/partials/header.php");


if(isset($_GET["cat"])){
$title = '<h3 id="page_title" class="info_block__accent rem">Top Polls '.'- <a href="./polls.php?cat='.$conn->real_escape_string($_GET["cat"]).'">#'.$conn->real_escape_string($_GET["cat"]).'</a></h3>';
}else {
  $title = '<h3 id="page_title" class="info_block__accent rem">Top Polls</h3>';
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
            <h3 class="info_block__accent" style="margin-top: 3em;">Running Polls</h3>
            <div class="text_block" id="none">No Polls Available</div>
            </div>
            </div>
          </div>
          <div class="row row-fluid" id="poll-list-running-vip">
          </div>
          <div class="row row-fluid" id="poll-list-running">

          </div>
        </div>

        <div class="tab-pane " id="2Con">
          <div id="none2">  <div class="card" id="empty_card" style="text-align:center;height:60vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">Ended Polls</h3>
                            <div class="text_block" id="none">No Polls Available</div>
                         </div>
            </div>
          </div>
          <div class="row row-fluid" id="poll-list-ended-vip">
          </div>
          <div class="row row-fluid" id="poll-list-ended">

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
var pollsrunninglist = document.getElementById("poll-list-running");
var pollsrunningviplist = document.getElementById("poll-list-running-vip");
var pollsrunningcontent = '';
var pollsrunningvipcontent = '';

var pollsendedlist = document.getElementById("poll-list-ended");
var pollsendedviplist = document.getElementById("poll-list-ended-vip");
var pollsendedcontent = '';
var pollsendedvipcontent = '';



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
  ajax_get('./services/getPollsRunning.php?vip=1'+catv, function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           pollsrunningvipcontent = pollsrunningvipcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card vip">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                           +obj.title
                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./poll.php?id='+obj.id+'">'
                                            +'<span>Check out poll</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user polls
  document.getElementById("none1").innerHTML = '';
   pollsrunningviplist.innerHTML =   pollsrunningvipcontent;
      }

  });


  ajax_get('./services/getPollsEnded.php?vip=1'+catv, function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           pollsendedvipcontent = pollsendedvipcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card vip">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                           +obj.title
                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./poll.php?id='+obj.id+'">'
                                            +'<span>Check out poll</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user polls
         document.getElementById("none2").innerHTML = '';
           pollsendedviplist.innerHTML =  pollsendedvipcontent;
      }
  });




  ajax_get('./services/getPollsRunning.php'+cat, function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           pollsrunningcontent = pollsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                           +obj.title
                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./poll.php?id='+obj.id+'">'
                                            +'<span>Check out poll</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user polls
         document.getElementById("none1").innerHTML = '';
           pollsrunninglist.innerHTML =  pollsrunningcontent;
      }
  });



  ajax_get('./services/getPollsEnded.php'+cat, function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           pollsendedcontent = pollsendedcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                           +obj.title
                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./poll.php?id='+obj.id+'">'
                                            +'<span>Check out poll</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user polls
         document.getElementById("none2").innerHTML = '';
           pollsendedlist.innerHTML =  pollsendedcontent;
      }

  });



  ajax_get('./services/getpollscat.php', function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           catcontent = catcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card vip">'
                                          +'<p class="info_block__accent desc" style="color: #9447bb; ">'

                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Polls Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./polls.php?cat='+obj.category+'">'
                                            +'<span>Polls</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user polls
  document.getElementById("none3").innerHTML = '';
   catlist.innerHTML =   catcontent;
      }

  });

}

</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
