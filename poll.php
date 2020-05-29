<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");

if(empty($conn->real_escape_string($_GET["id"]))){
  header("location:index.php");
}
$pagetitle = 'Poll - '.$_GET['id'];
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
                          <h4 class="info_block__accent">Question</h4>
                            <p><?php echo  nl2br($row['pdesc']); ?></p>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-4 col-sm-4 bordered-col">
                        <h4 class="info_block__accent">Start Time</h4>
                        <p><?php echo  date('Y-m-d H:i A', strtotime($row['addtime'])); ?></p>
                      </div>
                      <div class="col-4 col-sm-4 bordered-col">
                      <h4 class="info_block__accent">End Time</h4>
                      <p><?php echo  date('Y-m-d H:i A', strtotime($row['endtime'])); ?></p>
                    </div>
                    <?php

if(isset($_SESSION["addr"])){
  if ($owner == $_SESSION["addr"]){
echo '<div class="col-4 col-sm-4 bordered-col">
  <h4 class="info_block__accent">Administration</h4>
  <div class="input-group">
  <a class="btn btn-secondary btn-small" href="#"  onclick="Delete('.$row['id'].');" style="margin-top: 1em;">
      <span>DELETE</span>
  </a>
  </div>
</div>';}
}



                   ?>

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
                                          if (!date(strtotime('now')) < Date(strtotime($row['endtime']))&&isset($_SESSION["addr"])){
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
                                      }elseif(!isset($_SESSION["addr"])) {
                                          echo "<p>You have to be signed in to vote</p>";
                                      }}}

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


    $json = curl_get($url.'services/stats.php?pid='.$id.'&type=poll');

    $labelsHuman  =array();
    if(!empty($json['result']['option1']['Desc'])){
    array_push($labelsHuman,$json['result']['option1']['Desc']);
    }
    if(!empty($json['result']['option2']['Desc'])){
      array_push($labelsHuman,$json['result']['option2']['Desc']);
    }
    if(!empty($json['result']['option3']['Desc'])){
      array_push($labelsHuman,$json['result']['option3']['Desc']);
    }
    if(!empty($json['result']['option4']['Desc'])){
      array_push($labelsHuman,$json['result']['option4']['Desc']);
    }
    if(!empty($json['result']['option5']['Desc'])){
      array_push($labelsHuman,$json['result']['option5']['Desc']);
    }
    if(!empty($json['result']['option6']['Desc'])){
      array_push($labelsHuman,$json['result']['option6']['Desc']);
    }
$labelsHuman=  substr(json_encode($labelsHuman), 1, -1);


$DataHuman  =array();

array_push($DataHuman,$json['result']['option1']['Human']);
array_push($DataHuman,$json['result']['option2']['Human']);
array_push($DataHuman,$json['result']['option3']['Human']);
array_push($DataHuman,$json['result']['option4']['Human']);
array_push($DataHuman,$json['result']['option5']['Human']);
array_push($DataHuman,$json['result']['option6']['Human']);

$DataHuman=  substr(json_encode($DataHuman), 1, -1);

  echo '<section class="section section_info">
        <div class="row">
        <div class="col-12 col-sm-12">
        <div class="card">
        <div>
        <div class="row">
        <div class="col-10 col-sm-10 bordered-col">
        <h4 class="info_block__accent">Humans</h4>
        <div style="width:40%; height:40%">
       <canvas id="ChartHuman" width="400" height="400"></canvas>
       <div>
        <p></p>
        </div></div></div></div></div></div></section>';

    echo "<script>
    var ctx = document.getElementById('ChartHuman').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [".$labelsHuman."],
            datasets: [{
                label: '# of Votes',
                data: [".$DataHuman."],
                backgroundColor: [
  						window.chartColors.purple,
  						window.chartColors.orange,
  						window.chartColors.yellow,
  						window.chartColors.green,
  						window.chartColors.blue,
              window.chartColors.red,
  					],borderWidth: 1}]},});
    </script>";








    $labelsVerified  =array();
    if(!empty($json['result']['option1']['Desc'])){
    array_push($labelsVerified,$json['result']['option1']['Desc']);
    }
    if(!empty($json['result']['option2']['Desc'])){
    	array_push($labelsVerified,$json['result']['option2']['Desc']);
    }
    if(!empty($json['result']['option3']['Desc'])){
    	array_push($labelsVerified,$json['result']['option3']['Desc']);
    }
    if(!empty($json['result']['option4']['Desc'])){
    	array_push($labelsVerified,$json['result']['option4']['Desc']);
    }
    if(!empty($json['result']['option5']['Desc'])){
    	array_push($labelsVerified,$json['result']['option5']['Desc']);
    }
    if(!empty($json['result']['option6']['Desc'])){
    	array_push($labelsVerified,$json['result']['option6']['Desc']);
    }
    $labelsVerified=  substr(json_encode($labelsVerified), 1, -1);


    $DataVerified  =array();

    array_push($DataVerified,$json['result']['option1']['Verified']);
    array_push($DataVerified,$json['result']['option2']['Verified']);
    array_push($DataVerified,$json['result']['option3']['Verified']);
    array_push($DataVerified,$json['result']['option4']['Verified']);
    array_push($DataVerified,$json['result']['option5']['Verified']);
    array_push($DataVerified,$json['result']['option6']['Verified']);

    $DataVerified=  substr(json_encode($DataVerified), 1, -1);

    echo '<section class="section section_info">
    		<div class="row">
    		<div class="col-12 col-sm-12">
    		<div class="card">
    		<div>
    		<div class="row">
    		<div class="col-10 col-sm-10 bordered-col">
    		<h4 class="info_block__accent">Verified</h4>
    		<div style="width:40%; height:40%">
    	 <canvas id="ChartVerified" width="400" height="400"></canvas>
    	 <div>
    		<p></p>
    		</div></div></div></div></div></div></section>';

    echo "<script>
    var ctx = document.getElementById('ChartVerified').getContext('2d');
    var myChart = new Chart(ctx, {
    		type: 'pie',
    		data: {
    				labels: [".$labelsVerified."],
    				datasets: [{
    						label: '# of Votes',
    						data: [".$DataVerified."],
    						backgroundColor: [
    					window.chartColors.purple,
    					window.chartColors.orange,
    					window.chartColors.yellow,
    					window.chartColors.green,
    					window.chartColors.blue,
    					window.chartColors.red,
    				],borderWidth: 1}]},});
    </script>";

    $labelsNewbie  =array();
    if(!empty($json['result']['option1']['Desc'])){
    array_push($labelsNewbie,$json['result']['option1']['Desc']);
    }
    if(!empty($json['result']['option2']['Desc'])){
    	array_push($labelsNewbie,$json['result']['option2']['Desc']);
    }
    if(!empty($json['result']['option3']['Desc'])){
    	array_push($labelsNewbie,$json['result']['option3']['Desc']);
    }
    if(!empty($json['result']['option4']['Desc'])){
    	array_push($labelsNewbie,$json['result']['option4']['Desc']);
    }
    if(!empty($json['result']['option5']['Desc'])){
    	array_push($labelsNewbie,$json['result']['option5']['Desc']);
    }
    if(!empty($json['result']['option6']['Desc'])){
    	array_push($labelsNewbie,$json['result']['option6']['Desc']);
    }
    $labelsNewbie=  substr(json_encode($labelsNewbie), 1, -1);


    $DataNewbie  =array();

    array_push($DataNewbie,$json['result']['option1']['Newbie']);
    array_push($DataNewbie,$json['result']['option2']['Newbie']);
    array_push($DataNewbie,$json['result']['option3']['Newbie']);
    array_push($DataNewbie,$json['result']['option4']['Newbie']);
    array_push($DataNewbie,$json['result']['option5']['Newbie']);
    array_push($DataNewbie,$json['result']['option6']['Newbie']);

    $DataNewbie=  substr(json_encode($DataNewbie), 1, -1);

    echo '<section class="section section_info">
    		<div class="row">
    		<div class="col-12 col-sm-12">
    		<div class="card">
    		<div>
    		<div class="row">
    		<div class="col-10 col-sm-10 bordered-col">
    		<h4 class="info_block__accent">Newbies</h4>
    		<div style="width:40%; height:40%">
    	 <canvas id="ChartNewbie" width="400" height="400"></canvas>
    	 <div>
    		<p></p>
    		</div></div></div></div></div></div></section>';

    echo "<script>
    var ctx = document.getElementById('ChartNewbie').getContext('2d');
    var myChart = new Chart(ctx, {
    		type: 'pie',
    		data: {
    				labels: [".$labelsNewbie."],
    				datasets: [{
    						label: '# of Votes',
    						data: [".$DataNewbie."],
    						backgroundColor: [
    					window.chartColors.purple,
    					window.chartColors.orange,
    					window.chartColors.yellow,
    					window.chartColors.green,
    					window.chartColors.blue,
    					window.chartColors.red,
    				],borderWidth: 1}]},});
    </script>";

    $labelsHumanAndVerified  =array();
    if(!empty($json['result']['option1']['Desc'])){
    array_push($labelsHumanAndVerified,$json['result']['option1']['Desc']);
    }
    if(!empty($json['result']['option2']['Desc'])){
    	array_push($labelsHumanAndVerified,$json['result']['option2']['Desc']);
    }
    if(!empty($json['result']['option3']['Desc'])){
    	array_push($labelsHumanAndVerified,$json['result']['option3']['Desc']);
    }
    if(!empty($json['result']['option4']['Desc'])){
    	array_push($labelsHumanAndVerified,$json['result']['option4']['Desc']);
    }
    if(!empty($json['result']['option5']['Desc'])){
    	array_push($labelsHumanAndVerified,$json['result']['option5']['Desc']);
    }
    if(!empty($json['result']['option6']['Desc'])){
    	array_push($labelsHumanAndVerified,$json['result']['option6']['Desc']);
    }
    $labelsHumanAndVerified=  substr(json_encode($labelsHumanAndVerified), 1, -1);


    $DataHumanAndVerified  =array();

    array_push($DataHumanAndVerified,$json['result']['option1']['HumanAndVerified']);
    array_push($DataHumanAndVerified,$json['result']['option2']['HumanAndVerified']);
    array_push($DataHumanAndVerified,$json['result']['option3']['HumanAndVerified']);
    array_push($DataHumanAndVerified,$json['result']['option4']['HumanAndVerified']);
    array_push($DataHumanAndVerified,$json['result']['option5']['HumanAndVerified']);
    array_push($DataHumanAndVerified,$json['result']['option6']['HumanAndVerified']);

    $DataHumanAndVerified=  substr(json_encode($DataHumanAndVerified), 1, -1);

    echo '<section class="section section_info">
    		<div class="row">
    		<div class="col-12 col-sm-12">
    		<div class="card">
    		<div>
    		<div class="row">
    		<div class="col-10 col-sm-10 bordered-col">
    		<h4 class="info_block__accent">Humans And Verified</h4>
    		<div style="width:40%; height:40%">
    	 <canvas id="ChartHumanAndVerified" width="400" height="400"></canvas>
    	 <div>
    		<p></p>
    		</div></div></div></div></div></div></section>';

    echo "<script>
    var ctx = document.getElementById('ChartHumanAndVerified').getContext('2d');
    var myChart = new Chart(ctx, {
    		type: 'pie',
    		data: {
    				labels: [".$labelsHumanAndVerified."],
    				datasets: [{
    						label: '# of Votes',
    						data: [".$DataHumanAndVerified."],
    						backgroundColor: [
    					window.chartColors.purple,
    					window.chartColors.orange,
    					window.chartColors.yellow,
    					window.chartColors.green,
    					window.chartColors.blue,
    					window.chartColors.red,
    				],borderWidth: 1}]},});
    </script>";

  }}}} ?>


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
