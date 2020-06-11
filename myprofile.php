<?php
session_start();
include(dirname(__FILE__)."/common/protected.php");

$pagetitle = 'My Profile';
include(dirname(__FILE__)."/partials/header.php");
?>


<section class="section section_main">
    <div class="row">
        <div class="col-auto">
            <div class="section_main__image">
                <img src="https://robohash.org/<?php echo $_SESSION["addr"]; ?>" alt="pic" width="120"/>
            </div>
        </div>
            <div class="col">
                <div class="section_main__group">
                      <h1 class="section_main__title"><a href="<?php echo $url.'profile.php?address='.$_SESSION["addr"];?>"><?php echo $_SESSION["addr"]; ?></a>

                      <span class="badge badge-secondary" id="user_name">Loading...</span>
                    </h1>
                    </div>
                    <a class="btn btn-small btn-primary" href="./settings.php">
                        <span>Edit Settings</span>
                    </a>

                    <a class="btn btn-small btn-primary" href="./create-poll.php">
                        <span>Create New Poll</span>
                    </a>

                    <a class="btn btn-small btn-primary" href="./create-proposal.php">
                        <span>Create New Proposal</span>
                    </a>
                    <a class="btn btn-small btn-primary" href="./create-fvf.php">
                        <span>Create New FvF</span>
                    </a>
<br>
<br>
<div class="card">
<div class="info_block">
<div class="control-label"  id="bio"title="Bio">Loading...</div>
<br>
<div class="control-label"  id="lastseen"title="lastseen">Loading...</div>

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
                       <h3>My Polls</h3>
                    </a>
                 </li>
                  <li class="nav-item">
                     <a onclick="Change('2');" id='2Nav' class="nav-link ">
                        <h3>My Proposals</h3>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a onclick="Change('3');" id='3Nav' class="nav-link ">
                        <h3>My FvFs</h3>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a onclick="Change('4');" id='4Nav'class="nav-link ">
                        <h3>My Pages</h3>
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
        <div class="tab-pane " id="3Con">
          <div class="row row-fluid" id="fvf-list">
          </div>
        </div>
        <div class="tab-pane " id="4Con">
          <div class="row row-fluid" id="page-list">
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
    document.getElementById("4Nav").classList.remove("active");
    document.getElementById("4Con").classList.remove("active");

     }
     if(Newl == '2') {
    document.getElementById("2Con").classList.add("active");
    document.getElementById("2Nav").classList.add("active");

    document.getElementById("1Nav").classList.remove("active");
    document.getElementById("1Con").classList.remove("active");
    document.getElementById("3Nav").classList.remove("active");
    document.getElementById("3Con").classList.remove("active");
    document.getElementById("4Nav").classList.remove("active");
    document.getElementById("4Con").classList.remove("active");

     }
     if(Newl == '3') {
    document.getElementById("3Con").classList.add("active");
    document.getElementById("3Nav").classList.add("active");

    document.getElementById("2Nav").classList.remove("active");
    document.getElementById("2Con").classList.remove("active");
    document.getElementById("1Nav").classList.remove("active");
    document.getElementById("1Con").classList.remove("active");
    document.getElementById("4Nav").classList.remove("active");
    document.getElementById("4Con").classList.remove("active");

     }
     if(Newl == '4') {
    document.getElementById("4Con").classList.add("active");
    document.getElementById("4Nav").classList.add("active");

    document.getElementById("2Nav").classList.remove("active");
    document.getElementById("2Con").classList.remove("active");
    document.getElementById("3Nav").classList.remove("active");
    document.getElementById("3Con").classList.remove("active");
    document.getElementById("1Nav").classList.remove("active");
    document.getElementById("1Con").classList.remove("active");

     }





}


</script>







<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script type="text/javascript">
var polllist = document.getElementById("poll-list");
var pollcontent = '';
var proposallist = document.getElementById("proposal-list");
var proposalcontent = '';

var fvflist = document.getElementById("fvf-list");
var fvfcontent = '';

function checkusername() {
    ajax_get('./services/checkusername.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {
            document.getElementById("user_name").innerHTML = data["username"];
    });
}
function checkbio() {
    ajax_get('./services/checkbio.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {
            document.getElementById("bio").innerHTML = 'Bio : ' + data["bio"];
    });
}
function checklastseen() {
    ajax_get('./services/checklastseen.php?addr=<?php echo $_SESSION["addr"];?>', function(data) {
            document.getElementById("lastseen").innerHTML = 'Last Seen : ' + data["lastseen"];
    });
}



window.onload = function() {
checkusername();
checkbio();
checklastseen();


  //load all polls
  ajax_get('./services/showpolls.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           pollcontent = pollcontent +  '<div class="col-3 col-sm-3 entry">'
                                             +'<div class="mini-card">'
                                             +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                              +obj.description
                                             +'</p>'
                                             +'<p class="desc info_block__accent" style="text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                             +'<a class="btn btn-secondary btn-small" href="./poll.php?id='+obj.id+'">'
                                               +'<span>Check out Poll</span>'
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


ajax_get('./services/showproposals.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {

    if(data["entries"].length > 0){


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




//load all polls
ajax_get('./services/showfvfs.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {

    if(data["entries"].length > 0){


        data["entries"].forEach(function(obj) {

          fvfcontent = fvfcontent +  '<div class="col-3 col-sm-3 entry">'
                                            +'<div class="mini-card">'
                                            +'<p class="info_block__accent desc" style="color: #9447bb; ">'
                                             +obj.description
                                            +'</p>'
                                            +'<p class="desc info_block__accent" style="text-align:center; color: #ffbb1b;">Votes Count : '+obj.count+'</p>'
                                            +'<a class="btn btn-secondary btn-small" href="./fvf.php?id='+obj.id+'">'
                                              +'<span>Check out FvF</span>'
                                              +'<i class="icon icon--thin_arrow_right"></i>'
                                            +'</a>'
                                            +'</div>'
                                          +'</div>';

       });//retrieve all user polls

    } else {
      if(fvfcontent == ''){
        fvfcontent = '<div class="card" id="empty_card" style="text-align:center;">'
+'<div>'
+'<h3 class="info_block__accent" style="margin-top: 3em;">No FvFs</h3>'
+'<div class="text_block" id="none"></div>'
+'</div>'
+'</div>';
fvflist.classList.remove("row");
      }
    }


    fvflist.innerHTML = fvfcontent;
});


}

</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
