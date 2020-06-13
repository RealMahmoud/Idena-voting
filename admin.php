<?php
session_start();
include_once(dirname(__FILE__)."./common/_public.php");
if(empty($_GET['password'])){
  die('GO OUT');
}
$password = $conn->real_escape_string($_GET['password']);
if($password == 'admin'){

}else{
  die('Go OUT');
}

$pagetitle = 'Admin Dashboard';

include(dirname(__FILE__)."./partials/header.php");


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
                       <h3>Accounts</h3>
                    </a>
                 </li>
                  <li class="nav-item">
                     <a onclick="Change('2');" id='2Nav' class="nav-link ">
                        <h3>Website Settings</h3>
                     </a>
                  </li>
                


               </ul>
            </div>
         </div>
      </div>
      <div class="tab-content">





        <div class="tab-pane active" id="1Con">
          <section class="section section_info">

      <div class="row">



            <div class="col-12 col-sm-12">
              <div class="card">
                <div>
                  <div class="row">



                    <div class="col-12 col-sm-6 bordered-col">
                      <div class="warning rem" id="warning">
                      </div>
                      <div class="success rem" id="success">
                      </div>

                          <h4 class="info_block__accent">Delete</h4>
                          <form id="name_form" method="POST" onsubmit="delete(); return false;">
                            <div class="input-group">
                                <input type="text" name="type" class="formVal form-control" value="" placeholder="poll or proposal or fvf?">
                            </div>
                            <br>
                            <div class="input-group">
                                <input type="text" name="id" class="formVal form-control" value="" placeholder="id">
                            </div>

                              <div class="input-group">
                              <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="delete(); return false;" style="margin-top: 1em;">
                                  <span id="text_submit"> Delete</span>
                                  <i class="icon icon--thin_arrow_right"></i>
                              </a>
                              </div>

                          </form>
                          <br>

                          <h4 class="info_block__accent">Delete By Address</h4>

                          <form id="name_form" method="POST" onsubmit="deleteAccount(); return false;">
                              <div class="input-group" >
                                  <input type="text" name="address" class="formVal form-control" value="" placeholder="address">
                              </div>

                              <div class="input-group">
                              <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="deleteAccount(); return false;" style="margin-top: 1em;">
                                  <span id="text_submit"> Delete</span>
                                  <i class="icon icon--thin_arrow_right"></i>
                              </a>
                              </div>

                          </form>



                          <br>

                          <h4 class="info_block__accent">Add Credits</h4>

                          <form id="name_form" method="POST" onsubmit="addCredits(); return false;">
                            <div class="input-group" >
                                <input type="text" name="address" class="formVal form-control" value="" placeholder="Address">
                            </div>
                            <br>
                            <div class="input-group" >
                                <input type="text" name="credits" class="formVal form-control" value="" placeholder="Credits">
                            </div>

                              <div class="input-group">
                              <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="addCredits(); return false;" style="margin-top: 1em;">
                                  <span id="text_submit"> Add Credits</span>
                                  <i class="icon icon--thin_arrow_right"></i>
                              </a>
                              </div>

                          </form>




                    </div>





                    <div class="col-12 col-sm-6 bordered-col">
                          <div class="warning rem" id="warning">
                          </div>
                          <div class="success rem" id="success">
                          </div>



                          <h4 class="info_block__accent">Ban By Address</h4>

                          <form id="name_form" method="POST" onsubmit="banByAddress(); return false;">
                              <div class="input-group" >
                                  <input type="text" name="address" class="formVal form-control" value="" placeholder="Address">
                              </div>

                              <div class="input-group">
                              <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="banByAddress(); return false;" style="margin-top: 1em;">
                                  <span id="text_submit">Ban</span>
                                  <i class="icon icon--thin_arrow_right"></i>
                              </a>
                              </div>

                          </form>



<br>
                          <h4 class="info_block__accent">Check UserName By Address</h4>

                          <form id="name_form" method="POST" onsubmit="banByAddress(); return false;">
                              <div class="input-group" >
                                  <input type="text" name="address" class="formVal form-control" value="" placeholder="Address">
                              </div>

                              <div class="input-group">
                              <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="checkUserName(); return false;" style="margin-top: 1em;">
                                  <span id="text_submit">Check</span>
                                  <i class="icon icon--thin_arrow_right"></i>
                              </a>
                              </div>

                          </form>
<br>
                          <h4 class="info_block__accent">Check Address By UserName</h4>

                          <form id="name_form" method="POST" onsubmit="checkAddress(); return false;">
                              <div class="input-group" >
                                  <input type="text" name="username" class="formVal form-control" value="" placeholder="UserName">
                              </div>

                              <div class="input-group">
                              <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="checkAddress(); return false;" style="margin-top: 1em;">
                                  <span id="text_submit">Check</span>
                                  <i class="icon icon--thin_arrow_right"></i>
                              </a>
                              </div>

                          </form>






                    </div>






                  </div>
                </div>
              </div>
            </div>

      </div><!-- row end -->

  </section>
        </div>
        <div class="tab-pane " id="2Con">
          <section class="section section_info">

        <div class="row">



            <div class="col-12 col-sm-12">
              <div class="card">
                <div>
                  <div class="row">
                    <div class="col-12 col-sm-6 bordered-col">
                      <div class="warning rem" id="warning">
                      </div>
                      <div class="success rem" id="success">
                      </div>
                          <h4 class="info_block__accent">Maintenance</h4>
                          <form id="name_form" method="POST" onsubmit="maintenance(); return false;">
                              <div class="input-group">
                              <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="maintenance(); return false;" style="margin-top: 1em;">
                                  <span id="text_submit">Maintenance Mode</span>
                                  <i class="icon icon--thin_arrow_right"></i>
                              </a>
                              </div>
                          </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </section>
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




     }
     if(Newl == '2') {
    document.getElementById("2Con").classList.add("active");
    document.getElementById("2Nav").classList.add("active");

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


window.onload = function() {
  //load all polls
  ajax_get('./services/showAllPolls.php', function(data) {

      if(data["entries"].length > 0){


          data["entries"].forEach(function(obj) {

           pollcontent = pollcontent + '<div class="col-3 col-sm-3 entry">'
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

      } else {
         document.getElementById("none").innerHTML = "No Polls on the platform yet.";
      }

      polllist.innerHTML = pollcontent;
  });

}
</script>
<?php
include(dirname(__FILE__)."./partials/footer.php");
?>
