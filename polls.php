<?php
session_start();

if(isset($_SESSION["addr"])) {
include(dirname(__FILE__)."/common/_protected.php");
}else{
  include(dirname(__FILE__)."/common/_public.php");
}

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
var pollsrunningcontent = '';

var pollsendedlist = document.getElementById("poll-list-ended");
var pollsendedcontent = '';



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

  ajax_get('./services/getPollsRunning.php'+cat, function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {
            if(obj.vip == 1){
              pollsrunningcontent = pollsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                             +'<div class="mini-card">'
                                             +'<p class="desc titlelbl" title="'
                                             +obj.fulltitle
                                             +'">'
                                              +obj.title
                                             +'</p>'
                                             +'<p class="desc viplbl" style="padding:0px;text-align:center;"> - VIP - </p>'
                                             +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes Count : '+obj.count+'</p>'
                                            +'<p class="desc timelbl" style="padding:0px;padding-bottom:15px;text-align:center; ">'+'End Time : '+moment.utc(obj.endtime).local().format('YYYY-MM-DD HH:mm A')+'</p>'
                                            +'<a class="btn btn-secondary btn-small" style="width:87%" href="./poll.php?id='+obj.id+'">'
                                              +'<span>Check out Poll</span>'
                                              +'<i class="icon icon--thin_arrow_right"></i>'
                                            +'</a>'
                                             +'</div>'
                                           +'</div>';
            }else{
              pollsrunningcontent = pollsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                             +'<div class="mini-card">'
                                             +'<p class="desc titlelbl" title="'
                                             +obj.fulltitle
                                             +'">'
                                              +obj.title
                                             +'</p>'
                                             +'<p class="desc noramlbl" style="padding:0px;text-align:center;"> - Normal - </p>'
                                             +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                             +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes Count : '+obj.count+'</p>'
                                             +'<p class="desc timelbl" style="padding:0px;padding-bottom:15px;text-align:center; ">'+'End Time : '+moment.utc(obj.endtime).local().format('YYYY-MM-DD HH:mm A')+'</p>'
                                             +'<a class="btn btn-secondary btn-small" style="width:87%" href="./poll.php?id='+obj.id+'">'
                                               +'<span>Check out Poll</span>'
                                               +'<i class="icon icon--thin_arrow_right"></i>'
                                             +'</a>'
                                             +'</div>'
                                           +'</div>';
            }


           });
           pollsrunningcontent = pollsrunningcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="desc titlelbl" title="'
                                          +"Can't see yours ?"
                                          +'">'
                                           +"Can't see yours ?"
                                          +'</p>'
                                          +'<p class="desc noramlbl" style="padding:0px;text-align:center;"do you >Want to create one?</p>'
                                          +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Yoo can choose a category</p>'
                                          +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes count goes here</p>'
                                          +'<p class="desc timelbl" style="padding:0px;padding-bottom:15px;text-align:center; ">End Time will be here</p>'
                                          +'<a class="btn btn-secondary btn-small" style="width:87%" href="./createPolll.php">'
                                            +'<span>Creation Page</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';
           document.getElementById("none1").innerHTML = '';
             pollsrunninglist.innerHTML =  pollsrunningcontent;
        }

    });



  ajax_get('./services/getPollsEnded.php'+cat, function(data) {

          if(data["entries"].length > 0){


              data["entries"].forEach(function(obj) {
                if(obj.vip == 1){
                  pollsendedcontent = pollsendedcontent + '<div class="col-3 col-sm-3 entry">'
                                                 +'<div class="mini-card">'
                                                 +'<p class="desc titlelbl" title="'
                                                 +obj.fulltitle
                                                 +'">'
                                                  +obj.title
                                                 +'</p>'
                                                 +'<p class="desc viplbl" style="padding:0px;text-align:center;"> - VIP - </p>'
                                                 +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                                +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes Count : '+obj.count+'</p>'
                                                +'<p class="desc timelbl" style="padding:0px;padding-bottom:15px;text-align:center; ">'+'End Time : '+moment.utc(obj.endtime).local().format('YYYY-MM-DD HH:mm A')+'</p>'
                                                +'<a class="btn btn-secondary btn-small" style="width:87%" href="./poll.php?id='+obj.id+'">'
                                                  +'<span>Check out Poll</span>'
                                                  +'<i class="icon icon--thin_arrow_right"></i>'
                                                +'</a>'
                                                 +'</div>'
                                               +'</div>';
                }else{
                  pollsendedcontent = pollsendedcontent + '<div class="col-3 col-sm-3 entry">'
                                                 +'<div class="mini-card">'
                                                 +'<p class="desc titlelbl" title="'
                                                 +obj.fulltitle
                                                 +'">'
                                                  +obj.title
                                                 +'</p>'
                                                 +'<p class="desc noramlbl" style="padding:0px;text-align:center;"> - Normal - </p>'
                                                 +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                                 +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes Count : '+obj.count+'</p>'
                                                +'<p class="desc timelbl" style="padding:0px;padding-bottom:15px;text-align:center; ">'+'End Time : '+moment.utc(obj.endtime).local().format('YYYY-MM-DD HH:mm A')+'</p>'
                                                 +'<a class="btn btn-secondary btn-small" style="width:87%" href="./poll.php?id='+obj.id+'">'
                                                   +'<span>Check out Poll</span>'
                                                   +'<i class="icon icon--thin_arrow_right"></i>'
                                                 +'</a>'
                                                 +'</div>'
                                               +'</div>';
                }


             });
             pollsendedcontent = pollsendedcontent + '<div class="col-3 col-sm-3 entry">'
                                            +'<div class="mini-card">'
                                            +'<p class="desc titlelbl" title="'
                                            +"Can't see yours ?"
                                            +'">'
                                             +"Can't see yours ?"
                                            +'</p>'
                                            +'<p class="desc noramlbl" style="padding:0px;text-align:center;"do you >Want to create one?</p>'
                                            +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Yoo can choose a category</p>'
                                            +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes count goes here</p>'
                                            +'<p class="desc timelbl" style="padding:0px;padding-bottom:15px;text-align:center; ">End Time will be here</p>'
                                            +'<a class="btn btn-secondary btn-small" style="width:87%" href="./createPolll.php">'
                                              +'<span>Creation Page</span>'
                                              +'<i class="icon icon--thin_arrow_right"></i>'
                                            +'</a>'
                                            +'</div>'
                                          +'</div>';
             document.getElementById("none2").innerHTML = '';
               pollsendedlist.innerHTML =  pollsendedcontent;
          }


    });


  ajax_get('./services/getPollsCat.php', function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           catcontent = catcontent + '<div class="col-3 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="desc" style="color: #9447bb; ">'

                                          +'</p>'
                                          +'<p class="desc info_block__accent" style="padding:0px;text-align:center; color: #007BBC;">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                            +'<p class="desc info_block__accent" style="padding:0px;padding-bottom:15px;text-align:center; color: #ffbb1b;">Polls Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small"style="width:90%" href="./polls.php?cat='+obj.category+'">'
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
