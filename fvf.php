<?php
session_start();

include (dirname(__FILE__) . "/common/_config.php");
if (empty($conn->real_escape_string($_GET["id"])))
{
    header("location:index.php");
}
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `fvfs` WHERE `id` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

}else{
  header("location:404.php");
}

$pagetitle = 'FvF - '.$conn->real_escape_string($_GET["id"]);
include (dirname(__FILE__) . "/partials/header.php");
?>

<section class="section section_info">
    <div class="row">
          <div class="col-12 col-sm-12">
          			<a class="btn btn-small btn-nav" href="./fvfs.php">
            		<i class="icon icon--thin_arrow_left"></i>
            		<span id="back">Back to FvFs</span>
            		</a>
          </div>
    </div>
</section>



<?php
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `fvfs` WHERE `id` = '" . $id . "' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data  Of each row
  while($row = $result->fetch_assoc()) {


    $resultf = $conn->query("SELECT `username`,`address` FROM `accounts` WHERE `address` = '".$row['addr']."';");
    $rowf = $resultf->fetch_row();

$owner = $rowf[0];
$owneraddress = $rowf[1];
?>


<section class="section section_info">

    <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card">
              <h4 style="text-align:center;"class="info_block__accent"><?php echo $row['title']; ?>  - <a href="./fvfs.php?cat=<?php echo $row['category']; ?>">#<?php echo $row['category']; ?></a></h4>
              <div>
                <div class="row">

                  <div class="col-12 col-sm-12 bordered-col">

                        <h4 class="info_block__accent">Added by</h4>
                        <p style="vertical-align: middle;">
                            <img class="user-pic user-avatar" src="https://robohash.org/<?php echo $owner; ?>" alt="pic" width="40" style="margin-right: 1em;background: #f5f6f7;" />
                              <a href="<?php echo $url.'profile.php?address='.$owner;?>"><?php echo $owner; ?></a>
                        </p>



                        <div class="row">
                      <div class="col-12 col-sm-12 bordered-col">
                          <h4 class="info_block__accent">Description</h4>
                          <p><?php echo nl2br($row['pdesc']); ?></p>
                          </div>
                        </div>
                          <br>




                        <div class="row">
                        <div class="col-4 col-sm-4 bordered-col">
                        <h4 class="info_block__accent">Start Time</h4>
                        <p><?php echo date('Y-m-d H:i A', strtotime($row['addtime'])); ?></p>
                      </div>
                      <div class="col-4 col-sm-4 bordered-col">
                      <h4 class="info_block__accent">End Time</h4>
                      <p><?php echo date('Y-m-d H:i A', strtotime($row['endtime'])); ?></p>
                    </div>

                    <?php if (isset($_SESSION["addr"]))
        {
            if ($owneraddress == $_SESSION["addr"])
            {
                echo '<div class="col-4 col-sm-4 bordered-col">
                      <h4 class="info_block__accent">Administration</h4>
                      <div class="input-group">
                      <a class="btn btn-secondary btn-small" href="#"  onclick="Delete(' . $row['id'] . ');" style="margin-top: 1em;">
                          <span>DELETE</span>
                      </a>
                      </div>
                    </div>';
            }
        } ?>
                  <?php if (strlen($row['fundaddr']) == 42)
        {

            echo '<div class="row">
                      <div class="col-8 col-sm-8 bordered-col">
                        <p class="info_block__accent">Donations Address</p>
                          <p>' . $row['fundaddr'] . '</p>
                        </div>
                      </div>';
        } ?>

                      </div>
                        <br/>
                  </div>




                </div>
              </div>
            </div>
          </div>

    </div><!-- row end -->

</section>

<section class="section section_info">

    <div class="row " >

          <div class="col-12 col-sm-12 ">
            <div class="card col-auto">
              <div>

                  <div class="bordered-col ">
                        <div class="warning rem" id="warning">
                        </div>
                        <div class="success rem" id="success">
                        </div>

                      <h4 class="info_block__accent">Voting Panel</h4>

                      <?php
        $id = $conn->real_escape_string($_GET["id"]);
        $sql = "SELECT * FROM `fvfs` WHERE `id` = '" . $id . "' LIMIT 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo '<img style="margin-right:10%; width: 40%;" src="' . $row['location1'] . '" alt="Paris">';

                echo '<img style="margin-left:10%; width: 40%;" src="' . $row['location2'] . '" alt="Paris">';
                if (!date(strtotime('now')) < Date(strtotime($row['endtime'])) && isset($_SESSION["addr"]))
                {
?>
<div id="checker"></div>
<form id="vote_form" METHOD="POST">

  <div id="vote_container">
      <div class="input-group">
       Left <input type="radio" class="formVal" name="vote" value="1" checked/><br>
        Right <input type="radio" class="formVal" name="vote" value="2" /><br>
                                      <input type="hidden" class="formVal" name="id" value="<?php echo $id; ?>"/>
                                        <input type="hidden" class="formVal" name="type" value="fvf"/>
                                        <div class="input-group">
                                        <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeVote(); return false;" style="margin-top: 1em;">
                                            <span id="text_submit">Cast My Vote</span>
                                            <i class="icon icon--thin_arrow_right"></i>
                                        </a>
                                        </div>
                                            </div>
                                            <?php
                }
                elseif (!isset($_SESSION["addr"]))
                {
                    echo "<p>You have to be signed in to vote</p>";
                }
            }
        }

?>




</form>

</div>


                  </div>


              </div>
            </div>
          </div>



</section>

<?php
        $id = $conn->real_escape_string($_GET["id"]);
        $sql = "SELECT * FROM `fvfs` WHERE `id` = '" . $id . "' LIMIT 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {

                $json = curl_get($url . 'services/stats.php?pid=' . $id . '&type=fvf');




                $labelsHuman  =array();
                if(!empty($json['result']['Left']['Desc'])){
                array_push($labelsHuman,$json['result']['Left']['Desc']);
                }
                if(!empty($json['result']['Right']['Desc'])){
                  array_push($labelsHuman,$json['result']['Right']['Desc']);
                }
                $labelsHuman=  substr(json_encode($labelsHuman), 1, -1);
                $DataHuman  =array();
                array_push($DataHuman,$json['result']['Left']['Human']);
                array_push($DataHuman,$json['result']['Right']['Human']);
                $DataHuman=  substr(json_encode($DataHuman), 1, -1);




                $labelsVerified  =array();
                if(!empty($json['result']['Left']['Desc'])){
                array_push($labelsVerified,$json['result']['Left']['Desc']);
                }
                if(!empty($json['result']['Right']['Desc'])){
                  array_push($labelsVerified,$json['result']['Right']['Desc']);
                }
                $labelsVerified=  substr(json_encode($labelsVerified), 1, -1);
                $DataVerified  =array();
                array_push($DataVerified,$json['result']['Left']['Verified']);
                array_push($DataVerified,$json['result']['Right']['Verified']);

                $DataVerified=  substr(json_encode($DataVerified), 1, -1);




                $labelsNewbie  =array();
                if(!empty($json['result']['Left']['Desc'])){
                array_push($labelsNewbie,$json['result']['Left']['Desc']);
                }
                if(!empty($json['result']['Right']['Desc'])){
                  array_push($labelsNewbie,$json['result']['Right']['Desc']);
                }
                $labelsNewbie=  substr(json_encode($labelsNewbie), 1, -1);
                $DataNewbie  =array();
                array_push($DataNewbie,$json['result']['Left']['Newbie']);
                array_push($DataNewbie,$json['result']['Right']['Newbie']);
                $DataNewbie=  substr(json_encode($DataNewbie), 1, -1);




                $labelsHumanAndVerified  =array();
                if(!empty($json['result']['Left']['Desc'])){
                array_push($labelsHumanAndVerified,$json['result']['Left']['Desc']);
                }
                if(!empty($json['result']['Right']['Desc'])){
                  array_push($labelsHumanAndVerified,$json['result']['Right']['Desc']);
                }
                $labelsHumanAndVerified=  substr(json_encode($labelsHumanAndVerified), 1, -1);
                $DataHumanAndVerified  =array();
                array_push($DataHumanAndVerified,$json['result']['Left']['HumanAndVerified']);
                array_push($DataHumanAndVerified,$json['result']['Right']['HumanAndVerified']);
                $DataHumanAndVerified=  substr(json_encode($DataHumanAndVerified), 1, -1);


                $labelsAll  =array();
                if(!empty($json['result']['Left']['Desc'])){
                array_push($labelsAll,$json['result']['Left']['Desc']);
                }
                if(!empty($json['result']['Right']['Desc'])){
                  array_push($labelsAll,$json['result']['Right']['Desc']);
                }
                $labelsAll=  substr(json_encode($labelsAll), 1, -1);
                $DataAll  =array();
                array_push($DataAll,$json['result']['Left']['All']);
                array_push($DataAll,$json['result']['Right']['All']);
                $DataAll=  substr(json_encode($DataAll), 1, -1);


                $labelsValidated  =array();
                if(!empty($json['result']['Left']['Desc'])){
                array_push($labelsValidated,$json['result']['Left']['Desc']);
                }
                if(!empty($json['result']['Right']['Desc'])){
                  array_push($labelsValidated,$json['result']['Right']['Desc']);
                }
                $labelsValidated=  substr(json_encode($labelsValidated), 1, -1);
                $DataValidated  =array();
                array_push($DataValidated,$json['result']['Left']['Validated']);
                array_push($DataValidated,$json['result']['Right']['Validated']);
                $DataValidated=  substr(json_encode($DataValidated), 1, -1);



                $labelsNotValidated  =array();
                if(!empty($json['result']['Left']['Desc'])){
                array_push($labelsNotValidated,$json['result']['Left']['Desc']);
                }
                if(!empty($json['result']['Right']['Desc'])){
                  array_push($labelsNotValidated,$json['result']['Right']['Desc']);
                }
                $labelsNotValidated=  substr(json_encode($labelsNotValidated), 1, -1);
                $DataNotValidated  =array();
                array_push($DataNotValidated,$json['result']['Left']['NotValidated']);
                array_push($DataNotValidated,$json['result']['Right']['NotValidated']);
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
  ajax_get('./services/deletefvf.php?id='+id, function(data) {


      window.location.replace("<?php echo $url; ?>fvfs.php");

  });
}
window.onload = function()
{
    ajax_get('./services/checkvote.php?id=<?php echo $id; ?>&type=fvf', function(data) {
        if(data["status"]=='true'){
            if(document.getElementById("checker") == null){

            }else {
              if(data["vote"] == 1){
                document.getElementById("vote_container").innerHTML = '<br><h3 style="text-align: center;">You have voted "Left".</h3>';
              }
              if(data["vote"] == 2){
                document.getElementById("vote_container").innerHTML = '<br><h3 style="text-align: center;">You have voted "Right".</h3>';
              }

            }

        }
    });
}


</script>
<?php
include (dirname(__FILE__) . "/partials/footer.php");
?>
