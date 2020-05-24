<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/common/protected.php");
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
                    <h1 class="section_main__title">
                        <?php echo $_SESSION["addr"]; ?>

                      <span class="badge badge-secondary" id="nick_name">Loading...</span>
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
                </div>
            </div>
</section>


<section class="section section_info">

        <h3 id="page_title" class="info_block__accent rem">My Polls</h3>

          <div class="polls">

            <div class="card" id="empty_card" style="text-align:center;height:30vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">Your Polls</h3>
                            <div class="text_block" id="none">Loading... please wait</div>
                         </div>
            </div>

            <div class="row row-fluid" id="poll-list">
            </div>

          </div><!-- polls end -->


</section>
<section class="section section_info">

        <h3 id="page_title2" class="info_block__accent rem">My Proposals</h3>

          <div class="proposals">

            <div class="card" id="empty_card2" style="text-align:center;height:30vh">
                        <div>
                            <h3 class="info_block__accent" style="margin-top: 3em;">Your Proposals</h3>
                            <div class="text_block" id="none2">Loading... please wait</div>
                         </div>
            </div>

            <div class="row row-fluid" id="proposal-list">
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
var proposallist = document.getElementById("proposal-list");
var proposalcontent = '';

function checkusername() {
    ajax_get('./services/checkusername.php', function(data) {
            document.getElementById("nick_name").innerHTML = data["nickname"];
    });
}
window.onload = function() {
checkusername();

  //load all polls
  ajax_get('./services/showpolls.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {

      if(data["entries"].length > 0){
          document.getElementById("page_title").classList.remove("rem");
          document.getElementById("empty_card").classList.add("rem");

          data["entries"].forEach(function(obj) {

           pollcontent = pollcontent + '<div class="col-12 col-sm-3 entry">'
                                          +'<div class="mini-card">'
                                          +'<p class="desc" style="padding-bottom: 20px;">'
                                           +obj.description
                                          +'</p>'
                                          +'<a class="btn btn-secondary btn-small" href="./poll.php?id='+obj.id+'">'
                                            +'<span>Check out poll</span>'
                                            +'<i class="icon icon--thin_arrow_right"></i>'
                                          +'</a>'
                                          +'</div>'
                                        +'</div>';

         });//retrieve all user polls

      } else {
         document.getElementById("none").innerHTML = "No Polls made yet. Create a poll";
      }

      polllist.innerHTML = pollcontent;
  });


ajax_get('./services/showproposals.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {

    if(data["entries"].length > 0){
        document.getElementById("page_title2").classList.remove("rem");
        document.getElementById("empty_card2").classList.add("rem");

        data["entries"].forEach(function(obj) {

         proposalcontent = proposalcontent + '<div class="col-12 col-sm-3 entry">'
                                        +'<div class="mini-card">'
                                        +'<p class="desc" style="padding-bottom: 20px;">'
                                         +obj.description
                                        +'</p>'
                                        +'<a class="btn btn-secondary btn-small" href="./proposal.php?id='+obj.id+'">'
                                          +'<span>Check out proposal</span>'
                                          +'<i class="icon icon--thin_arrow_right"></i>'
                                        +'</a>'
                                        +'</div>'
                                      +'</div>';

       });//retrieve all user polls

    } else {
       document.getElementById("none2").innerHTML = "No Proposals made yet. Create a Proposal";
    }

    proposallist.innerHTML = proposalcontent;
});
}

</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
