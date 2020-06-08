<?php
session_start();

include(dirname(__FILE__)."/common/_config.php");

if(empty($conn->real_escape_string($_GET["id"]))){
  header("location:index.php");
}

$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `proposals` WHERE `id` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

}else{
  header("location:404.php");
}

$pagetitle = 'Proposal - '.$conn->real_escape_string($_GET["id"]);
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
  // output data  Of each row
  while($row = $result->fetch_assoc()) {
$owner = $row['addr'];
?>


<section class="section section_info">

    <div class="row">



          <div class="col-12 col-sm-12">
            <div class="card">
              <h4 style="text-align:center;"class="info_block__accent"><?php echo $row['title']; ?>  - <a href="./proposals.php?cat=<?php echo $row['category']; ?>">#<?php echo $row['category']; ?></a></h4>
              <div>
                <div class="row">
                  <div class="col-12 col-sm-7 bordered-col">

                        <h4 class="info_block__accent">Added by</h4>
                        <p style="vertical-align: middle;">
                            <img class="user-pic user-avatar" src="https://robohash.org/<?php echo  $owner; ?>" alt="pic" width="40" style="margin-right: 1em;background: #f5f6f7;" />
                              <a href="<?php echo $url.'profile.php?address='.$owner;?>"><?php echo $owner; ?></a>
                        </p>



                        <div class="row">
                      <div class="col-12 col-sm-7 bordered-col">
                          <h4 class="info_block__accent">Description</h4>
                          <p><?php echo nl2br($row['pdesc']); ?></p>
                          </div>
                        </div>
                          <br>
                        <div class="row">
                        <div class="col-4 col-sm-4 bordered-col">
                        <h4 class="info_block__accent">Start Time</h4>
                        <p><?php echo  date('Y-m-d H:i A', strtotime($row['addtime'])); ?></p>
                      </div>
                      <div class="col-4 col-sm-4 bordered-col">
                      <h4 class="info_block__accent">End Time</h4>
                      <p><?php echo  date('Y-m-d H:i A', strtotime($row['endtime'])); ?></p>
                    </div>
                    <?php if(isset($_SESSION["addr"])){
                      if ($owner == $_SESSION["addr"]){
                    echo '<div class="col-4 col-sm-4 bordered-col">
                      <h4 class="info_block__accent">Administration</h4>
                      <div class="input-group">
                      <a class="btn btn-secondary btn-small" href="#"  onclick="Delete('.$row['id'].');" style="margin-top: 1em;">
                          <span>DELETE</span>
                      </a>
                      </div>
                    </div>';}
                    } ?>
                  <?php if (strlen($row['fundaddr']) == 42){


                  echo '<div class="row">
                      <div class="col-8 col-sm-8 bordered-col">
                        <p class="info_block__accent">Donations Address</p>
                          <p>'.$row['fundaddr'].'</p>
                        </div>
                      </div>';}?>
                      <?php if (strlen($row['amount']) > 0){


                      echo '<div class="row">
                          <div class=" bordered-col">
                            <p class="info_block__accent">Amount Required</p>
                              <p>'.$row['amount'].' DNA</p>
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

                        <h4 class="info_block__accent">Voting Panel</h4>
                        <div id="vote_container"><?php
                                      $id = $conn->real_escape_string($_GET["id"]);
                                      $sql = "SELECT * FROM `proposals` WHERE `id` = '".$id."' LIMIT 1;";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                          if (!date(strtotime('now')) < Date(strtotime($row['endtime']))&&isset($_SESSION["addr"])){
echo '<div id="checker"></div>
<form id="vote_form" METHOD="POST">
        <div class="input-group">';
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

    </div><!-- row end -->

</section>

<?php
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `proposals` WHERE `id` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {


$json = curl_get($url.'services/stats.php?pid='.$id.'&type=proposal');


$labelsHuman  =array();
if(!empty($json['result']['option1']['Desc'])){
array_push($labelsHuman,$json['result']['option1']['Desc']);
}
if(!empty($json['result']['option2']['Desc'])){
  array_push($labelsHuman,$json['result']['option2']['Desc']);
}
$labelsHuman=  substr(json_encode($labelsHuman), 1, -1);
$DataHuman  =array();
array_push($DataHuman,$json['result']['option1']['Human']);
array_push($DataHuman,$json['result']['option2']['Human']);
$DataHuman=  substr(json_encode($DataHuman), 1, -1);




$labelsVerified  =array();
if(!empty($json['result']['option1']['Desc'])){
array_push($labelsVerified,$json['result']['option1']['Desc']);
}
if(!empty($json['result']['option2']['Desc'])){
  array_push($labelsVerified,$json['result']['option2']['Desc']);
}
$labelsVerified=  substr(json_encode($labelsVerified), 1, -1);
$DataVerified  =array();
array_push($DataVerified,$json['result']['option1']['Verified']);
array_push($DataVerified,$json['result']['option2']['Verified']);

$DataVerified=  substr(json_encode($DataVerified), 1, -1);




$labelsNewbie  =array();
if(!empty($json['result']['option1']['Desc'])){
array_push($labelsNewbie,$json['result']['option1']['Desc']);
}
if(!empty($json['result']['option2']['Desc'])){
  array_push($labelsNewbie,$json['result']['option2']['Desc']);
}
$labelsNewbie=  substr(json_encode($labelsNewbie), 1, -1);
$DataNewbie  =array();
array_push($DataNewbie,$json['result']['option1']['Newbie']);
array_push($DataNewbie,$json['result']['option2']['Newbie']);
$DataNewbie=  substr(json_encode($DataNewbie), 1, -1);




$labelsHumanAndVerified  =array();
if(!empty($json['result']['option1']['Desc'])){
array_push($labelsHumanAndVerified,$json['result']['option1']['Desc']);
}
if(!empty($json['result']['option2']['Desc'])){
  array_push($labelsHumanAndVerified,$json['result']['option2']['Desc']);
}
$labelsHumanAndVerified=  substr(json_encode($labelsHumanAndVerified), 1, -1);
$DataHumanAndVerified  =array();
array_push($DataHumanAndVerified,$json['result']['option1']['HumanAndVerified']);
array_push($DataHumanAndVerified,$json['result']['option2']['HumanAndVerified']);
$DataHumanAndVerified=  substr(json_encode($DataHumanAndVerified), 1, -1);


$labelsAll  =array();
if(!empty($json['result']['option1']['Desc'])){
array_push($labelsAll,$json['result']['option1']['Desc']);
}
if(!empty($json['result']['option2']['Desc'])){
  array_push($labelsAll,$json['result']['option2']['Desc']);
}
$labelsAll=  substr(json_encode($labelsAll), 1, -1);
$DataAll  =array();
array_push($DataAll,$json['result']['option1']['All']);
array_push($DataAll,$json['result']['option2']['All']);
$DataAll=  substr(json_encode($DataAll), 1, -1);


$labelsValidated  =array();
if(!empty($json['result']['option1']['Desc'])){
array_push($labelsValidated,$json['result']['option1']['Desc']);
}
if(!empty($json['result']['option2']['Desc'])){
  array_push($labelsValidated,$json['result']['option2']['Desc']);
}
$labelsValidated=  substr(json_encode($labelsValidated), 1, -1);
$DataValidated  =array();
array_push($DataValidated,$json['result']['option1']['Validated']);
array_push($DataValidated,$json['result']['option2']['Validated']);
$DataValidated=  substr(json_encode($DataValidated), 1, -1);



$labelsNotValidated  =array();
if(!empty($json['result']['option1']['Desc'])){
array_push($labelsNotValidated,$json['result']['option1']['Desc']);
}
if(!empty($json['result']['option2']['Desc'])){
  array_push($labelsNotValidated,$json['result']['option2']['Desc']);
}
$labelsNotValidated=  substr(json_encode($labelsNotValidated), 1, -1);
$DataNotValidated  =array();
array_push($DataNotValidated,$json['result']['option1']['NotValidated']);
array_push($DataNotValidated,$json['result']['option2']['NotValidated']);
$DataNotValidated=  substr(json_encode($DataNotValidated), 1, -1);










}}


} //while loop ends

} ?>

                <section class="section section_tabs">
                   <div class="tabs">
                      <div class="section__header">
                         <div class="row align-items-center justify-content-between">
                            <div class="col">
                               <ul class="nav nav-tabs" role="tablist">
                                 <li class="nav-item">
                                    <a onclick="Change('Va');" id='VaNav'class="nav-link active">
                                       <h3>Validated</h3>
                                    </a>
                                 </li>
                                  <li class="nav-item">
                                     <a onclick="Change('H');" id='HNav' class="nav-link ">
                                        <h3>Humans</h3>
                                     </a>
                                  </li>
                                  <li class="nav-item">
                                     <a onclick="Change('V');" id='VNav' class="nav-link ">
                                        <h3>Verified</h3>
                                     </a>
                                  </li>
                                  <li class="nav-item">
                                     <a onclick="Change('N');" id='NNav'class="nav-link ">
                                        <h3>Newbies</h3>
                                     </a>
                                  </li>
                                  <li class="nav-item">
                                     <a onclick="Change('HAndV');"id='HAndVNav' class="nav-link ">
                                        <h3>Humans And Verified</h3>
                                     </a>
                                  </li>


                                  <li class="nav-item">
                                     <a onclick="Change('NotVa');"id='NotVaNav' class="nav-link ">
                                        <h3>Not Validated</h3>
                                     </a>
                                  </li>
                                  <li class="nav-item">
                                     <a onclick="Change('All');"id='AllNav' class="nav-link ">
                                        <h3>All</h3>
                                     </a>
                                  </li>
                               </ul>
                            </div>
                         </div>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane active" id="VaCon">
                           <div class="card">
                              <div>
                                 <div class="row">
                                    <div class="col-10 col-sm-10 bordered-col">
                                       <h4 class="info_block__accent">Validated - (Humans + Verified + Newbies)</h4>
                                       <div style="width:40%; height:40%">
                                          <canvas id="ChartVa" width="400" height="400"></canvas>
                                          <div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                         <div class="tab-pane " id="HCon">
                            <div class="card">
                               <div>
                                  <div class="row">
                                     <div class="col-10 col-sm-10 bordered-col">
                                        <h4 class="info_block__accent">Humans</h4>
                                        <div style="width:40%; height:40%">
                                           <canvas id="ChartH" width="400" height="400"></canvas>
                                           <div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="tab-pane" id="VCon">
                            <div class="card">
                               <div>
                                  <div class="row">
                                     <div class="col-10 col-sm-10 bordered-col">
                                        <h4 class="info_block__accent">Verified</h4>
                                        <div style="width:40%; height:40%">
                                           <canvas id="ChartV" width="400" height="400"></canvas>
                                           <div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="tab-pane" id="NCon">
                            <div class="card">
                               <div>
                                  <div class="row">
                                     <div class="col-10 col-sm-10 bordered-col">
                                        <h4 class="info_block__accent">Newbies</h4>
                                        <div style="width:40%; height:40%">
                                           <canvas id="ChartN" width="400" height="400"></canvas>
                                           <div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="tab-pane" id="HAndVCon">
                            <div class="card">
                               <div>
                                  <div class="row">
                                     <div class="col-10 col-sm-10 bordered-col">
                                        <h4 class="info_block__accent">Humans And Verified</h4>
                                        <div style="width:40%; height:40%">
                                           <canvas id="ChartHAndV" width="400" height="400"></canvas>
                                           <div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>


                         <div class="tab-pane" id="NotVaCon">
                            <div class="card">
                               <div>
                                  <div class="row">
                                     <div class="col-10 col-sm-10 bordered-col">
                                        <h4 class="info_block__accent">Not Validated</h4>
                                        <div style="width:40%; height:40%">
                                           <canvas id="ChartNotVa" width="400" height="400"></canvas>
                                           <div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="tab-pane" id="AllCon">
                            <div class="card">
                               <div>
                                  <div class="row">
                                     <div class="col-10 col-sm-10 bordered-col">
                                        <h4 class="info_block__accent">All</h4>
                                        <div style="width:40%; height:40%">
                                           <canvas id="ChartAll" width="400" height="400"></canvas>
                                           <div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </section>




<script>
var ctx = document.getElementById('ChartH').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelsHuman; ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $DataHuman;?>],
            backgroundColor: [
          window.chartColors.purple,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.red,
        ],borderWidth: 1}]},});

var ctx = document.getElementById('ChartV').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelsVerified; ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $DataVerified;?>],
            backgroundColor: [
          window.chartColors.purple,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.red,
        ],borderWidth: 1}]},});

var ctx = document.getElementById('ChartN').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelsNewbie; ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $DataNewbie;?>],
            backgroundColor: [
          window.chartColors.purple,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.red,
        ],borderWidth: 1}]},});

var ctx = document.getElementById('ChartVa').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelsValidated; ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $DataValidated;?>],
            backgroundColor: [
          window.chartColors.purple,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.red,
        ],borderWidth: 1}]},});

var ctx = document.getElementById('ChartAll').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelsAll; ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $DataAll;?>],
            backgroundColor: [
          window.chartColors.purple,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.red,
        ],borderWidth: 1}]},});

var ctx = document.getElementById('ChartNotVa').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelsNotValidated; ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $DataNotValidated;?>],
            backgroundColor: [
          window.chartColors.purple,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.red,
        ],borderWidth: 1}]},});

var ctx = document.getElementById('ChartHAndV').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labelsHumanAndVerified; ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $DataHumanAndVerified;?>],
            backgroundColor: [
          window.chartColors.purple,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.red,
        ],borderWidth: 1}]},});
</script>


<script>
   function Change(Newl) {
       if(Newl == 'H') {
            document.getElementById("HCon").classList.add("active");
			document.getElementById("HNav").classList.add("active");
   			document.getElementById("VCon").classList.remove("active");
   			document.getElementById("NCon").classList.remove("active");
   			document.getElementById("HAndVCon").classList.remove("active");
   			document.getElementById("VaCon").classList.remove("active");
   			document.getElementById("AllCon").classList.remove("active");
            document.getElementById("NotVaCon").classList.remove("active");
			document.getElementById("VNav").classList.remove("active");
   			document.getElementById("NNav").classList.remove("active");
   			document.getElementById("HAndVNav").classList.remove("active");
   			document.getElementById("VaNav").classList.remove("active");
   			document.getElementById("AllNav").classList.remove("active");
            document.getElementById("NotVaNav").classList.remove("active");


       }



   	   if(Newl == 'V') {
		    document.getElementById("VCon").classList.add("active");
			document.getElementById("VNav").classList.add("active");

            document.getElementById("HCon").classList.remove("active");
   			document.getElementById("NCon").classList.remove("active");
   			document.getElementById("HAndVCon").classList.remove("active");
   			document.getElementById("VaCon").classList.remove("active");
   			document.getElementById("AllCon").classList.remove("active");
            document.getElementById("NotVaCon").classList.remove("active");

            document.getElementById("HNav").classList.remove("active");
   			document.getElementById("NNav").classList.remove("active");
   			document.getElementById("HAndVNav").classList.remove("active");
   			document.getElementById("VaNav").classList.remove("active");
   			document.getElementById("AllNav").classList.remove("active");
            document.getElementById("NotVaNav").classList.remove("active");
       }



   	   if(Newl == 'N') {
		    document.getElementById("NCon").classList.add("active");
			document.getElementById("NNav").classList.add("active");
            document.getElementById("HCon").classList.remove("active");
   			document.getElementById("VCon").classList.remove("active");
   			document.getElementById("HAndVCon").classList.remove("active");
   			document.getElementById("VaCon").classList.remove("active");
   			document.getElementById("AllCon").classList.remove("active");
            document.getElementById("NotVaCon").classList.remove("active");


            document.getElementById("HNav").classList.remove("active");
   			document.getElementById("VNav").classList.remove("active");
   			document.getElementById("HAndVNav").classList.remove("active");
   			document.getElementById("VaNav").classList.remove("active");
   			document.getElementById("AllNav").classList.remove("active");
            document.getElementById("NotVaNav").classList.remove("active");
       }




   	   if(Newl == 'HAndV') {
		    document.getElementById("HAndVCon").classList.add("active");
			document.getElementById("HAndVNav").classList.add("active");
            document.getElementById("HCon").classList.remove("active");
   			document.getElementById("VCon").classList.remove("active");
   			document.getElementById("NCon").classList.remove("active");
   			document.getElementById("VaCon").classList.remove("active");
   			document.getElementById("AllCon").classList.remove("active");
            document.getElementById("NotVaCon").classList.remove("active");

            document.getElementById("HNav").classList.remove("active");
   			document.getElementById("VNav").classList.remove("active");
   			document.getElementById("NNav").classList.remove("active");
   			document.getElementById("VaNav").classList.remove("active");
   			document.getElementById("AllNav").classList.remove("active");
            document.getElementById("NotVaNav").classList.remove("active");
       }

   	   if(Newl == 'Va') {
		    document.getElementById("VaCon").classList.add("active");
			document.getElementById("VaNav").classList.add("active");
            document.getElementById("HCon").classList.remove("active");
   			document.getElementById("VCon").classList.remove("active");
   			document.getElementById("NCon").classList.remove("active");
   			document.getElementById("HAndVCon").classList.remove("active");
   			document.getElementById("AllCon").classList.remove("active");
            document.getElementById("NotVaCon").classList.remove("active");


            document.getElementById("HNav").classList.remove("active");
   			document.getElementById("VNav").classList.remove("active");
   			document.getElementById("NNav").classList.remove("active");
   			document.getElementById("HAndVNav").classList.remove("active");
   			document.getElementById("AllNav").classList.remove("active");
            document.getElementById("NotVaNav").classList.remove("active");
       }
   	if(Newl == 'All') {
		    document.getElementById("AllCon").classList.add("active");
			  document.getElementById("AllNav").classList.add("active");
            document.getElementById("HCon").classList.remove("active");
   			document.getElementById("VCon").classList.remove("active");
   			document.getElementById("NCon").classList.remove("active");
   			document.getElementById("HAndVCon").classList.remove("active");
   			document.getElementById("VaCon").classList.remove("active");
   			document.getElementById("NotVaCon").classList.remove("active");


            document.getElementById("HNav").classList.remove("active");
   			document.getElementById("VNav").classList.remove("active");
   			document.getElementById("NNav").classList.remove("active");
   			document.getElementById("HAndVNav").classList.remove("active");
   			document.getElementById("VaNav").classList.remove("active");
   			document.getElementById("NotVaNav").classList.remove("active");
       }
   	   if(Newl == 'NotVa') {
		    document.getElementById("NotVaCon").classList.add("active");
			document.getElementById("NotVaNav").classList.add("active");

            document.getElementById("HCon").classList.remove("active");
   			document.getElementById("VCon").classList.remove("active");
   			document.getElementById("NCon").classList.remove("active");
   			document.getElementById("HAndVCon").classList.remove("active");
   			document.getElementById("VaCon").classList.remove("active");
   			document.getElementById("AllCon").classList.remove("active");


            document.getElementById("HNav").classList.remove("active");
   			document.getElementById("VNav").classList.remove("active");
   			document.getElementById("NNav").classList.remove("active");
   			document.getElementById("HAndVNav").classList.remove("active");
   			document.getElementById("VaNav").classList.remove("active");
   			document.getElementById("AllNav").classList.remove("active");

       }

   }

</script>


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


      window.location.replace("<?php echo $url;?>proposals.php");

  });
}
window.onload = function()
{
    ajax_get('./services/checkvote.php?id=<?php echo $id; ?>&type=proposal', function(data) {
        if(data["status"]=='true'){
            if(document.getElementById("checker") == null){

            }else {
            document.getElementById("vote_container").innerHTML = '<br><h3 style="text-align: center;">You have voted "'+data["vote"]+'".</h3>';
            }

        }
    });
}


</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
