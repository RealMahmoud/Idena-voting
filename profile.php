<?php
session_start();

if(isset($_GET['user'])){
$usernamea = $_GET['user'];
if(isset($_SESSION["addr"])) {
include(dirname(__FILE__)."/common/_protected.php");
}else{
  include(dirname(__FILE__)."/common/_public.php");
}

$pic = curl_get($url.'services/checkPic.php?user='.urlencode($usernamea))['pic'];

}
if(empty($usernamea) && isset($_SESSION['username'])){
    include(dirname(__FILE__)."/common/_protected.php");
  $usernamea = $_SESSION['username'];
  $pic = $_SESSION['pic'];
  $owner = true;

}
  if(isset($usernamea) && isset($_SESSION['username'])){
    if($usernamea==$_SESSION['username']){
      $owner = true;
    }
  }


if(empty($usernamea)){
  header("location:.././404.php");
}
$pagetitle = $usernamea.' Profile';
include(dirname(__FILE__)."/partials/header.php");

?>


<section class="section section_main">
    <div class="row">
        <div class="col-auto">
            <div class="section_main__image" >
              <a href="<?php echo $url.'profile.php?user='.$usernamea;?>">
                <img src="https://robohash.org/<?php echo $pic; ?>" alt="pic" width="120"/>
              </a>
            </div>
        </div>
            <div class="col">
                <div class="section_main__group">
                      <h1 class="section_main__title"><a href="<?php echo $url.'profile.php?user='.$usernamea;?>"><?php echo $usernamea; ?></a>



                    </div>

                   <?php if(!isset($owner)){
                     echo '  <a class="btn btn-small btn-primary" href="'.$url.'donate.php?user='.$usernamea.'">
                           <span>Donate</span>
                       </a>';
//    <a class="btn btn-small btn-primary" id="RO"href="'.$url.'reachout.php?user='.$usernamea.'">
    //   <span>Reach Out</span>
  // </a>
                 }else{
echo '  <a class="btn btn-small btn-primary" href="./settings.php">
      <span>Edit Settings</span>
  </a>
  <a class="btn btn-small btn-primary" href="./createPoll.php">
      <span>Create New Poll</span>
  </a>

  <a class="btn btn-small btn-primary" href="./createProposal.php">
      <span>Create New Proposal</span>
  </a>';
}?>



<br>
<br>
<div class="card">
<div class="info_block">
<h4 class="control-label"  id="address2"title="Address">Loading...</h4>
<br>
<div class="control-label"  id="state"title="Status">Loading...</div>
<br>
<div class="control-label"  id="age"title="Age">Loading...</div>
<br>
<div class="control-label"  id="bio"title="Bio">Loading...</div>
<br>
<div class="control-label"  id="credits"title="Credits">Loading...</div>
<br>
<div class="control-label timeUTC"  id="lastseen"title="Lastseen">Loading...</div>

</div>
 </div>
                </div>
            </div>
</section>








<section class="section section_tabs">
   <div class="tabs">
      <div class="section__header">
         <div class="row align-items-center justify-content-between">
            <div class="col">
               <ul class="nav nav-tabs" role="tablist">
                 <li class="nav-item">
                    <a onclick="Change('1');" id='1Nav'class="nav-link active">
                       <h3>Polls</h3>
                    </a>
                 </li>
                  <li class="nav-item">
                     <a onclick="Change('2');" id='2Nav' class="nav-link ">
                        <h3>Proposals</h3>
                     </a>
                  </li>




               </ul>
            </div>
         </div>
      </div>
      <div class="tab-content">





        <div class="tab-pane active" id="1Con">
                       <div class="row row-fluid" id="poll-list">
                       </div>
        </div>
        <div class="tab-pane " id="2Con">
          <div class="row row-fluid" id="proposal-list">
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
var polllist = document.getElementById("poll-list");
var pollcontent = '';
var proposallist = document.getElementById("proposal-list");
var proposalcontent = '';


function checkbio() {
    ajax_get('./services/checkBio.php?user=<?php echo $usernamea; ?>', function(data) {
            document.getElementById("bio").innerHTML = 'Bio : ' + data["bio"];
    });
}
function checklastseen() {
    ajax_get('./services/checkLastseen.php?user=<?php echo $usernamea;?>', function(data) {
      let utcTime = data["lastseen"]

            document.getElementById("lastseen").innerHTML = 'Last Seen : ' + moment.utc(utcTime).local().format('YYYY-MM-DD HH:mm A');
    });
}
function checkCredits() {
    ajax_get('./services/checkCredits.php?user=<?php echo $usernamea;?>', function(data) {

            document.getElementById("credits").innerHTML = 'Credits : ' + data["credits"];
    });
}
function checkaddress() {
    ajax_get('./services/checkAddress.php?user=<?php echo $usernamea;?>', function(data) {
      if(data["address"] == ' - '){

        document.getElementById("address2").innerHTML = 'Address : Private ';
      }else{



        document.getElementById("address2").innerHTML = 'Address : <a href="https://scan.idena.io/identity/' + data["address"] + '"> '+data["address"]+'</a>';

      }

    });
}
function checkstate() {
    ajax_get('./services/checkState.php?user=<?php echo $usernamea;?>', function(data) {
            document.getElementById("state").innerHTML = 'Status : ' + data["state"];
    });
}
function checkage() {
    ajax_get('./services/checkAge.php?user=<?php echo $usernamea;?>', function(data) {
            document.getElementById("age").innerHTML = 'Age : ' + data["age"];
    });
}


window.onload = function() {
checkage();

checkstate();
checkaddress();
checkbio();
checklastseen();
checkCredits();

  //load all polls
  ajax_get('./services/getPollsUser.php?user=<?php echo $usernamea; ?>', function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           pollcontent = pollcontent +  '<div class="col-lg-3 col-sm-6 mb-3 entry">'
                                                 +'<div class="mini-card">'
                                                 +'<div class="titleoutdiv"><p class="desc titlelbl" title="'
                                                 +obj.fulltitle
                                                 +'">'
                                                 +obj.fulltitle
                                                 +'</p></div>'
                                          +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                         +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes Count : '+obj.count+'</p>'
                                          +'<a class="btn btn-secondary btn-small" style="width: -webkit-fill-available;" href="./poll.php?id='+obj.id+'">'
                                            +'<span>Check out poll</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';
         });//retrieve all user polls

      } else {
        if(pollcontent == ''){
          pollcontent = '<div class="card" id="empty_card" style="text-align:center;">'
  +'<div>'
  +'<h3 class="info_block__accent" style="margin-top: 3em;">No Polls</h3>'
  +'<div class="text_block" id="none"></div>'
  +'</div>'
  +'</div>';
  polllist.classList.remove("row");

        }
      }


      polllist.innerHTML = pollcontent;
  });


ajax_get('./services/getProposalsUser.php?user=<?php echo $usernamea; ?>', function(data) {

    if(data["entries"].length > 0){


        data["entries"].forEach(function(obj) {

          proposalcontent = proposalcontent +  '<div class="col-lg-3 col-sm-6 mb-3 entry">'
                                                +'<div class="mini-card">'
                                                +'<div class="titleoutdiv"><p class="desc titlelbl" title="'
                                                +obj.fulltitle
                                                +'">'
                                                +obj.fulltitle
                                                +'</p></div>'
                                         +'<p class="desc categorylbl" style="padding:0px;text-align:center; ">Category : <a href="./polls.php?cat='+obj.category+'">#'+obj.category+'</a></p>'
                                        +'<p class="desc voteslbl" style="padding:0px;padding-bottom:15px;text-align:center; ">Votes Count : '+obj.count+'</p>'
                                         +'<a class="btn btn-secondary btn-small" style="width: -webkit-fill-available;" href="./proposal.php?id='+obj.id+'">'
                                           +'<span>Check out proposal</span>'
                                           +'<i class="icon icon--thin_arrow_right"></i>'
                                         +'</a>'
                                         +'</div>'
                                       +'</div>';

       });//retrieve all user polls

    } else {
      if(proposalcontent == ''){
        proposalcontent = '<div class="card" id="empty_card" style="text-align:center;">'
+'<div>'
+'<h3 class="info_block__accent" style="margin-top: 3em;">No Proposals</h3>'
+'<div class="text_block" id="none"></div>'
+'</div>'
+'</div>';
proposallist.classList.remove("row");
      }
    }


proposallist.innerHTML = proposalcontent;
});







}

</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
