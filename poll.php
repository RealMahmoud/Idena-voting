<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/common/protected.php");
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
    <div class="row">
          <div class="col-12 col-sm-7">
          			<a class="btn btn-small btn-nav" href="./polls.php">
            		<i class="icon icon--thin_arrow_left"></i>
            		<span id="back">Back to Polls</span>
            		</a>
          </div>
    </div>
</section>


<?php
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `polls` WHERE `id` = '".$id."' LIMIT 1;";
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
                    <a class="btn btn-secondary btn-small" href="#"  onclick="Delete('.$row['id'].');" style="margin-top: 1em;">
                        <span>DELETE</span>
                    </a>
                    </div>
                  </div>';} ?>

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
                                      $sql = "SELECT * FROM `polls` WHERE `id` = '".$id."' LIMIT 1;";
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
                                          if (!$row['option3'] == null){
                                          echo $row['option3'].'  <input type="radio" class="formVal" name="vote" value="3" /><br>';
                                          }
                                          if (!$row['option4'] == null){
                                          echo $row['option4'].'  <input type="radio" class="formVal" name="vote" value="4" /><br>';
                                          }
                                          if (!$row['option5'] == null){
                                          echo $row['option5'].'  <input type="radio" class="formVal" name="vote" value="5" /><br>';
                                          }
                                          if (!$row['option6'] == null){
                                          echo $row['option6'].'  <input type="radio" class="formVal" name="vote" value="6"/><br>';
                                        }
                                      echo  '<input type="hidden" class="formVal" name="id" value="'.$id.'"/>
                                        <input type="hidden" class="formVal" name="type" value="poll"/>
                                        <div class="input-group">
                                        <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeVote(); return false;" style="margin-top: 1em;">
                                            <span id="text_submit">Cast My Vote</span>
                                            <i class="icon icon--thin_arrow_right"></i>
                                        </a>
                                        </div>
                                            </div>';
                                      }else{echo "<h2>Poll Ended</h2>";}}
                                      }

                                        ?>






                                </form>
                        </div>

                  </div>

                </div>
              </div>
            </div>
          </div>

    </div>
</section>
  <?php
  $id = $conn->real_escape_string($_GET["id"]);
  $sql = "SELECT * FROM `polls` WHERE `id` = '".$id."' LIMIT 1;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $json2 = curl_get($url.'/services/stats.php?pid='.$id.'&type=poll');

        $sql = "SELECT * FROM `net` WHERE `Epoch` = '44' LIMIT 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row2 = $result->fetch_assoc()) {
    $NotValidatedCount = $row2['NotValidated'];
     $ValidatedCount =  $row2['Validated'];
     $HumanCount = $row2['Human'];
    $VerifiedCount =  $row2['Verified'];
    $NewbieCount =  $row2['Newbie'];
    }}
      if (!$row['option1'] == null){
        $json = curl_get($url.'/services/option-stats.php?pid='.$id.'&vote=1&type=poll');
      echo '<section class="section section_info">
            <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card">
            <div>
            <div class="row">
            <div class="col-10 col-sm-10 bordered-col">
            <h4 class="info_block__accent"> Option : '.$row['option1'].'</h4>
            <p>All Votes Count : '.$json['All'].' Of  '.$json2['AllVotesCount'].' Total Participates ||  Accounts : '.$json2['AllAccountsCount'].'</p>
            <p>Validated Votes Count : '.$json['Validated'].' Of  '.$json2['AllVotesCount'].' Total Participates || Accounts  : '.$json2['ValidatedCount'].' || Network : '.$ValidatedCount.'</p>
            <p>Not Validated Count : '.$json['NotValidated'].' Of  '.$json2['NoneValidatedVotesCount'].' Total Participates || Accounts  : '.$json2['NoneValidatedCount'].' || Network : '.$NotValidatedCount.'</p>
            <p>Humans Votes Count : '.$json['Human'].' Of  '.$json2['HumansVotesCount'].' Total Participates || Accounts  : '.$json2['HumansCount'].' || Network : '.$HumanCount.'</p>
            <p>Verified Count : '.$json['Verified'].' Of  '.$json2['VerifiedVotesCount'].' Total Participates || Accounts  : '.$json2['VerifiedCount'].' || Network : '.$VerifiedCount.'</p>
            <p>Newbies Count : '.$json['Newbie'].' Of  '.$json2['NewbieVotesCount'].' Total Participates || Accounts  : '.$json2['NewbieCount'].' || Network : '.$NewbieCount.'</p>
            </div></div></div></div></div></div></section>';
      }
      if (!$row['option2'] == null){
        $json = curl_get('http://127.0.0.1/Idena-voting/services/option-stats.php?pid='.$id.'&vote=2&type=poll');
      echo '<section class="section section_info">
            <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card">
            <div>
            <div class="row">
            <div class="col-10 col-sm-10 bordered-col">
            <h4 class="info_block__accent"> Option : '.$row['option2'].'</h4>
            <p>All Votes Count : '.$json['All'].' Of  '.$json2['AllVotesCount'].' Total Participates ||  Accounts : '.$json2['AllAccountsCount'].'</p>
            <p>Validated Votes Count : '.$json['Validated'].' Of  '.$json2['AllVotesCount'].' Total Participates || Accounts  : '.$json2['ValidatedCount'].' || Network : '.$ValidatedCount.'</p>
            <p>Not Validated Count : '.$json['NotValidated'].' Of  '.$json2['NoneValidatedVotesCount'].' Total Participates || Accounts  : '.$json2['NoneValidatedCount'].' || Network : '.$NotValidatedCount.'</p>
            <p>Humans Votes Count : '.$json['Human'].' Of  '.$json2['HumansVotesCount'].' Total Participates || Accounts  : '.$json2['HumansCount'].' || Network : '.$HumanCount.'</p>
            <p>Verified Count : '.$json['Verified'].' Of  '.$json2['VerifiedVotesCount'].' Total Participates || Accounts  : '.$json2['VerifiedCount'].' || Network : '.$VerifiedCount.'</p>
            <p>Newbies Count : '.$json['Newbie'].' Of  '.$json2['NewbieVotesCount'].' Total Participates || Accounts  : '.$json2['NewbieCount'].' || Network : '.$NewbieCount.'</p>
            </div></div></div></div></div></div></section>';
      }
      if (!$row['option3'] == null){
        $json = curl_get('http://127.0.0.1/Idena-voting/services/option-stats.php?pid='.$id.'&vote=3&type=poll');
      echo '<section class="section section_info">
            <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card">
            <div>
            <div class="row">
            <div class="col-10 col-sm-10 bordered-col">
            <h4 class="info_block__accent"> Option : '.$row['option3'].'</h4>
            <p>All Votes Count : '.$json['All'].' Of  '.$json2['AllVotesCount'].' Total Participates ||  Accounts : '.$json2['AllAccountsCount'].'</p>
            <p>Validated Votes Count : '.$json['Validated'].' Of  '.$json2['AllVotesCount'].' Total Participates || Accounts  : '.$json2['ValidatedCount'].' || Network : '.$ValidatedCount.'</p>
            <p>Not Validated Count : '.$json['NotValidated'].' Of  '.$json2['NoneValidatedVotesCount'].' Total Participates || Accounts  : '.$json2['NoneValidatedCount'].' || Network : '.$NotValidatedCount.'</p>
            <p>Humans Votes Count : '.$json['Human'].' Of  '.$json2['HumansVotesCount'].' Total Participates || Accounts  : '.$json2['HumansCount'].' || Network : '.$HumanCount.'</p>
            <p>Verified Count : '.$json['Verified'].' Of  '.$json2['VerifiedVotesCount'].' Total Participates || Accounts  : '.$json2['VerifiedCount'].' || Network : '.$VerifiedCount.'</p>
            <p>Newbies Count : '.$json['Newbie'].' Of  '.$json2['NewbieVotesCount'].' Total Participates || Accounts  : '.$json2['NewbieCount'].' || Network : '.$NewbieCount.'</p>
            </div></div></div></div></div></div></section>';
      }
      if (!$row['option4'] == null){
        $json = curl_get('http://127.0.0.1/Idena-voting/services/option-stats.php?pid='.$id.'&vote=4&type=poll');
      echo '<section class="section section_info">
            <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card">
            <div>
            <div class="row">
            <div class="col-10 col-sm-10 bordered-col">
            <h4 class="info_block__accent"> Option : '.$row['option4'].'</h4>
            <p>All Votes Count : '.$json['All'].' Of  '.$json2['AllVotesCount'].' Total Participates ||  Accounts : '.$json2['AllAccountsCount'].'</p>
            <p>Validated Votes Count : '.$json['Validated'].' Of  '.$json2['AllVotesCount'].' Total Participates || Accounts  : '.$json2['ValidatedCount'].' || Network : '.$ValidatedCount.'</p>
            <p>Not Validated Count : '.$json['NotValidated'].' Of  '.$json2['NoneValidatedVotesCount'].' Total Participates || Accounts  : '.$json2['NoneValidatedCount'].' || Network : '.$NotValidatedCount.'</p>
            <p>Humans Votes Count : '.$json['Human'].' Of  '.$json2['HumansVotesCount'].' Total Participates || Accounts  : '.$json2['HumansCount'].' || Network : '.$HumanCount.'</p>
            <p>Verified Count : '.$json['Verified'].' Of  '.$json2['VerifiedVotesCount'].' Total Participates || Accounts  : '.$json2['VerifiedCount'].' || Network : '.$VerifiedCount.'</p>
            <p>Newbies Count : '.$json['Newbie'].' Of  '.$json2['NewbieVotesCount'].' Total Participates || Accounts  : '.$json2['NewbieCount'].' || Network : '.$NewbieCount.'</p>
            </div></div></div></div></div></div></section>';
      }
      if (!$row['option5'] == null){
        $json = curl_get('http://127.0.0.1/Idena-voting/services/option-stats.php?pid='.$id.'&vote=5&type=poll');
      echo '<section class="section section_info">
            <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card">
            <div>
            <div class="row">
            <div class="col-10 col-sm-10 bordered-col">
            <h4 class="info_block__accent"> Option : '.$row['option5'].'</h4>
            <p>All Votes Count : '.$json['All'].' Of  '.$json2['AllVotesCount'].' Total Participates ||  Accounts : '.$json2['AllAccountsCount'].'</p>
            <p>Validated Votes Count : '.$json['Validated'].' Of  '.$json2['AllVotesCount'].' Total Participates || Accounts  : '.$json2['ValidatedCount'].' || Network : '.$ValidatedCount.'</p>
            <p>Not Validated Count : '.$json['NotValidated'].' Of  '.$json2['NoneValidatedVotesCount'].' Total Participates || Accounts  : '.$json2['NoneValidatedCount'].' || Network : '.$NotValidatedCount.'</p>
            <p>Humans Votes Count : '.$json['Human'].' Of  '.$json2['HumansVotesCount'].' Total Participates || Accounts  : '.$json2['HumansCount'].' || Network : '.$HumanCount.'</p>
            <p>Verified Count : '.$json['Verified'].' Of  '.$json2['VerifiedVotesCount'].' Total Participates || Accounts  : '.$json2['VerifiedCount'].' || Network : '.$VerifiedCount.'</p>
            <p>Newbies Count : '.$json['Newbie'].' Of  '.$json2['NewbieVotesCount'].' Total Participates || Accounts  : '.$json2['NewbieCount'].' || Network : '.$NewbieCount.'</p>
            </div></div></div></div></div></div></section>';
      }
      if (!$row['option6'] == null){
        $json = curl_get('http://127.0.0.1/Idena-voting/services/option-stats.php?pid='.$id.'&vote=6&type=poll');
      echo '<section class="section section_info">
            <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card">
            <div>
            <div class="row">
            <div class="col-10 col-sm-10 bordered-col">
            <h4 class="info_block__accent"> Option : '.$row['option6'].'</h4>
            <p>All Votes Count : '.$json['All'].' Of  '.$json2['AllVotesCount'].' Total Participates ||  Accounts : '.$json2['AllAccountsCount'].'</p>
            <p>Validated Votes Count : '.$json['Validated'].' Of  '.$json2['AllVotesCount'].' Total Participates || Accounts  : '.$json2['ValidatedCount'].' || Network : '.$ValidatedCount.'</p>
            <p>Not Validated Count : '.$json['NotValidated'].' Of  '.$json2['NoneValidatedVotesCount'].' Total Participates || Accounts  : '.$json2['NoneValidatedCount'].' || Network : '.$NotValidatedCount.'</p>
            <p>Humans Votes Count : '.$json['Human'].' Of  '.$json2['HumansVotesCount'].' Total Participates || Accounts  : '.$json2['HumansCount'].' || Network : '.$HumanCount.'</p>
            <p>Verified Count : '.$json['Verified'].' Of  '.$json2['VerifiedVotesCount'].' Total Participates || Accounts  : '.$json2['VerifiedCount'].' || Network : '.$VerifiedCount.'</p>
            <p>Newbies Count : '.$json['Newbie'].' Of  '.$json2['NewbieVotesCount'].' Total Participates || Accounts  : '.$json2['NewbieCount'].' || Network : '.$NewbieCount.'</p>
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
            document.getElementById("text_submit").innerHTML = "Casting...";
            document.getElementById("submit").classList.add("disabled");
    } else {
            document.getElementById("text_submit").innerHTML = "Cast my Vote";
            document.getElementById("submit").classList.remove("disabled");
    }
}

function changeVote()
{
  //  toggle(true);
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
    ajax_get('./services/checkvote.php?id=<?php echo $id; ?>&type=poll', function(data) {
        if(data["status"]=='true'){
            if(document.getElementById("checker") == null){

            }else {
            document.getElementById("vote_container").innerHTML = '<p>You have voted "'+data["vote"]+'".</p>';
            }

        }
    });
}
function Delete(id)
{
  ajax_get('./services/deletepoll.php?id='+id, function(data) {


      window.location.replace("<?php echo $url;?>");

  });
}
window.onload = function()
{
    ajax_get('./services/checkvote.php?id=<?php echo $id; ?>&type=poll', function(data) {
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
