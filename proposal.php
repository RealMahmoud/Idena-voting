<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/common/protected.php");
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
    <div class="row">
          <div class="col-12 col-sm-7">
          			<a class="btn btn-small btn-nav" href="./proposals.php">
            		<i class="icon icon--thin_arrow_left"></i>
            		<span id="back">Back to Proposals</span>
            		</a>
          </div>
    </div>
</section>


<?php
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `proposals` WHERE `id` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
$owner = $row['addr'];
?>


<section class="section section_info">

    <div class="row">



          <div class="col-12 col-sm-12">
            <div class="card">
              <div>
                <div class="row">

                  <div class="col-12 col-sm-7 bordered-col">

                        <h4 class="info_block__accent">Added by</h4>
                        <p style="vertical-align: middle;">
                            <img class="user-pic user-avatar" src="https://robohash.org/<?php echo  $owner; ?>" alt="pic" width="40" style="margin-right: 1em;background: #f5f6f7;" />
                            <?php echo  $owner; ?>
                        </p>
                        <br>
                        <div class="row">
                        <div class="col-4 col-sm-4 bordered-col">
                          <h4>Description</h4>
                          <p><?php echo  nl2br($row['pdesc']); ?></p>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-4 col-sm-4 bordered-col">
                        <h4>Start Time</h4>
                        <p><?php echo  date('Y-m-d H:i A', strtotime($row['addtime'])); ?></p>
                      </div>
                      <div class="col-4 col-sm-4 bordered-col">
                      <h4>End Time</h4>
                      <p><?php echo  date('Y-m-d H:i A', strtotime($row['endtime'])); ?></p>
                    </div>
                    <?php if ($owner == $_SESSION["addr"]){
                  echo '<div class="col-4 col-sm-4 bordered-col">
                    <h4>Administration</h4>
                    <div class="input-group">
                    <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="Delete('.$row['id'].');" style="margin-top: 1em;">
                        <span id="text_submit">DELETE</span>

                    </a>
                    </div>
                  </div>';} ?>
              <?php if (strlen($row['fundaddr']) == 42){


              echo '<div class="row">
                  <div class="col-8 col-sm-8 bordered-col">
                    <p>Funding Address</p>
                      <p>'.$row['fundaddr'].'</p>
                    </div>
                  </div>';}?>
                      </div>
                        <br/>
                  </div>


                  <div class="col-12 col-sm-5 bordered-col">
                        <div class="warning rem" id="warning">
                        </div>
                        <div class="success rem" id="success">
                        </div>

                        <h4 class="info_block__accent">Add your vote below</h4>
                        <div id="vote_container"><?php
                                      $id = $conn->real_escape_string($_GET["id"]);
                                      $sql = "SELECT * FROM `proposals` WHERE `id` = '".$id."' LIMIT 1;";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                          if (!date(strtotime('now')) < Date(strtotime($row['endtime']))){
echo '<div id="checker"></div>
<form id="vote_form" METHOD="POST">
        <div class="input-group" style="width: 60%;">';
                                          if (!$row['option1'] == null){
                                          echo $row['option1'].'  <input type="radio" class="formVal" name="vote" value="1" checked/><br>';
                                          }
                                          if (!$row['option2'] == null){
                                          echo $row['option2'].'  <input type="radio" class="formVal" name="vote" value="2" /><br>';
                                          }

                                      echo  '<input type="hidden" class="formVal" name="id" value="'.$id.'"/>
                                        <input type="hidden" class="formVal" name="type" value="proposal"/>
                                        <div class="input-group">
                                        <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeVote(); return false;" style="margin-top: 1em;">
                                            <span id="text_submit">Cast My Vote</span>
                                            <i class="icon icon--thin_arrow_right"></i>
                                        </a>
                                        </div>
                                            </div>';
                                      }else{echo "<h2>Proposal Ended</h2>";}}
                                      }

                                        ?>






                                </form>
                        </div>

                  </div>

                </div>
              </div>
            </div>
          </div>

    </div><!-- row end -->

</section>

<?php
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `proposals` WHERE `id` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if (!$row['option1'] == null){
      $json = curl_get('http://127.0.0.1/Idena-voting/services/option-stats.php?pid='.$id.'&vote=1&type=proposal');
    echo '<section class="section section_info">
          <div class="row">
          <div class="col-12 col-sm-12">
          <div class="card">
          <div>
          <div class="row">
          <div class="col-10 col-sm-5 bordered-col">
          <h4 class="info_block__accent"> Option : '.$row['option1'].'</h4>
          <p>Votes Count : '.$json['all'].'</p>
          <p>Humans Votes Count : '.$json['human'].'</p>
          <p>Verified Count : '.$json['verified'].'</p>
          <p>Newbies Count : '.$json['newbie'].'</p>
          <p>Not Validated Count : '.$json['notvalidated'].'</p>
          </div></div></div></div></div></div></section>';
    }
    if (!$row['option2'] == null){
      $json = curl_get('http://127.0.0.1/Idena-voting/services/option-stats.php?pid='.$id.'&vote=2&type=proposal');
    echo '<section class="section section_info">
          <div class="row">
          <div class="col-12 col-sm-12">
          <div class="card">
          <div>
          <div class="row">
          <div class="col-10 col-sm-5 bordered-col">
          <h4 class="info_block__accent"> Option : '.$row['option2'].'</h4>
          <p>Votes Count : '.$json['all'].'</p>
          <p>Humans Votes Count : '.$json['human'].'</p>
          <p>Verified Count : '.$json['verified'].'</p>
          <p>Newbies Count : '.$json['newbie'].'</p>
          <p>Not Validated Count : '.$json['notvalidated'].'</p>
          </div></div></div></div></div></div></section>';
    }





}}


} //while loop ends

} ?>




<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script>

function toggle(change) {
    if(change == true) {
            document.getElementById("text_submit").innerHTML = "Loading...";
            document.getElementById("submit").classList.add("disabled");
    } else {
            document.getElementById("text_submit").innerHTML = "Cast my Vote";
            document.getElementById("submit").classList.remove("disabled");
    }
}

function changeVote()
{
    // toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {

      if (elements[i].name == 'vote'){
        if (elements[i].checked){
            formData.append(elements[i].name, elements[i].value);
        }
      }else {
        formData.append(elements[i].name, elements[i].value);
      }

    }

    ajax_post('./services/vote.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Vote made successfully';
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("submit").classList.add("disabled");
            document.getElementById("warning").innerHTML = '&#x274C; Your have already voted on this!';
        }
    });
}
function Delete(id)
{
  ajax_get('./services/deleteproposal.php?id='+id, function(data) {


      window.location.replace("<?php echo $url;?>");

  });
}
window.onload = function()
{
    ajax_get('./services/checkvote.php?id=<?php echo $id; ?>&type=proposal', function(data) {
        if(data["status"]=='true'){
            if(document.getElementById("checker") == null){

            }else {
            document.getElementById("vote_container").innerHTML = '<p>You have voted "'+data["vote"]+'".</p>';
            }

        }
    });
}


</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
