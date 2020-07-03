<?php
session_start();
if(isset($_SESSION["addr"])) {
include(dirname(__FILE__)."/common/_protected.php");
}else{
  include(dirname(__FILE__)."/common/_public.php");
}

if(empty($conn->real_escape_string($_GET["id"]))){
  header("location:index.php");
}

$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `polls` WHERE `id` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

}else{
  header("location:404.php");
}
$pagetitle = 'Poll - '.$conn->real_escape_string($_GET["id"]);
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
              <h4 style="text-align:center;"class="info_block__accent"><?php echo $row['title']; ?>  - <a href="./polls.php?cat=<?php echo $row['category']; ?>">#<?php echo $row['category']; ?></a></h4>

              <div>
                <div class="row">

                  <div class="col-12 col-sm-7 bordered-col">





                        <h4 class="info_block__accent">Added by</h4>
                        <p style="vertical-align: middle;">
                          <a href="<?php echo $url.'profile.php?user='.$owner;?>">
                            <img class="user-pic user-avatar" src="https://robohash.org/<?php echo curl_get($url.'services/checkPic.php?user='.urlencode($owner))['pic']; ?>" alt="pic" width="40" style="margin-right: 1em;background: #f5f6f7;" />
                          </a>
                            <a href="<?php echo $url.'profile.php?user='.$owner;?>"><?php echo $owner; ?></a>
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
                        <h4 class="info_block__accent ">Start Time</h4>
                        <p class="timeUTC"><?php echo  date('Y-m-d H:i', strtotime($row['addtime'])); ?></p>
                      </div>
                      <div class="col-4 col-sm-4 bordered-col">
                      <h4 class="info_block__accent ">End Time</h4>
                      <p class="timeUTC"><?php echo  date('Y-m-d H:i', strtotime($row['endtime'])); ?></p>
                    </div>


                    <?php if(isset($_SESSION["addr"])){
                      if ($owneraddress == $_SESSION["addr"]){
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

                        <h4 class="info_block__accent">Voting Panel</h4>
                        <div id="vote_container"><?php
                                      $id = $conn->real_escape_string($_GET["id"]);
                                      $sql = "SELECT * FROM `polls` WHERE `id` = '".$id."' LIMIT 1;";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        while($row2 = $result->fetch_assoc()) {

echo '<div id="checker"></div>
<form id="vote_form" METHOD="POST">
        <div class="input-group" >';
                                          if (!$row2['option1'] == null){
                                          echo $row2['option1'].'  <input type="radio" class="formVal" name="vote" value="1" checked /><br>';
                                          }
                                          if (!$row2['option2'] == null){
                                          echo $row2['option2'].'  <input type="radio" class="formVal" name="vote" value="2" /><br>';
                                          }
                                          if (!$row2['option3'] == null){
                                          echo $row2['option3'].'  <input type="radio" class="formVal" name="vote" value="3" /><br>';
                                          }
                                          if (!$row2['option4'] == null){
                                          echo $row2['option4'].'  <input type="radio" class="formVal" name="vote" value="4" /><br>';
                                          }
                                          if (!$row2['option5'] == null){
                                          echo $row2['option5'].'  <input type="radio" class="formVal" name="vote" value="5" /><br>';
                                          }
                                          if (!$row2['option6'] == null){
                                          echo $row2['option6'].'  <input type="radio" class="formVal" name="vote" value="6" /><br>';
                                        }
                                      echo  '<input type="hidden" class="formVal" name="id" value="'.$id.'"/>
                                        <input type="hidden" class="formVal" name="type" value="poll"/>
                                        <div class="input-group">
                                        <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="castVote(); return false;" style="margin-top: 1em;">
                                            <span id="text_submit">Cast My Vote</span>
                                            <i class="icon icon--thin_arrow_right"></i>
                                        </a>
                                        </div>
                                            </div>';
                                      }}

                                        ?>
                                </form>
                        </div>
                        <br>
                        <h4 class="info_block__accent">Share</h4>
                         <input type="text" class="form-control" name="shareurl" value="<?php echo $url.'poll.php?id='.$id;?>"/>
                         <!-- I got these buttons from simplesharebuttons.com -->
                         <br>
<div id="share-buttons" style="margin-left:20%;margin-right:20%"class="row justify-content-between align-items-center">

    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer.php?u=<?php echo $url.'poll.php?id='.$id;?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
    </a>

    <!-- Google+ -->
    <a href="https://plus.google.com/share?url=<?php echo $url.'poll.php?id='.$id;?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
    </a>

    <!-- LinkedIn -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url.'poll.php?id='.$id;?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
    </a>


    <!-- Reddit -->
    <a href="http://reddit.com/submit?url=<?php echo $url.'poll.php?id='.$id;?>&amp;title=<?php echo $row['title'];?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
    </a>

    <!-- Twitter -->
    <a href="https://twitter.com/share?url=<?php echo $url.'poll.php?id='.$id;?>&amp;text=<?php echo $row['title'];?>&amp;hashtags=<?php echo $row['category'];?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
    </a>

    <!-- VK -->
    <a href="http://vkontakte.ru/share.php?url=<?php echo $url.'poll.php?id='.$id;?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK" />
    </a>


</div>
                  </div>

                </div>
              </div>
            </div>
          </div>

    </div>
</section>
  <?php
  $id = $conn->real_escape_string($_GET["id"]);}} ?>






    <section class="section section_tabs">
      <div class="tabs">
        <div class="section__header">
          <div class="row align-items-center justify-content-between">
            <div class="col">
              <ul class="nav nav-tabs row justify-content-between align-items-center" role="tablist">
                <li class="nav-item">
                  <a onclick="Change('Va');" id='VaNav' class="nav-link active">
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
                  <a onclick="Change('N');" id='NNav' class="nav-link ">
                    <h3>Newbies</h3>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="Change('HAndV');" id='HAndVNav' class="nav-link ">
                    <h3>Humans And Verified</h3>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="Change('All');" id='AllNav' class="nav-link ">
                    <h3>All identities</h3>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div class="tab-pane active" id="VaCon">
            <div class="card">
              <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
              <div class="row">
                <div class="col-12 col-sm-6 bordered-col">
                  <canvas id="ChartVa" width="100%" height="70%"></canvas><br><h4 style="text-align:center;" id="TotalVa">Total : 0</h4>
                </div>
                <div class="col-12 col-sm-6 bordered-col">

                  <form id="name_form" METHOD="POST" oninput="changeChartVa(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="VaChartAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>
                   <br><br><br>
                  <h3 class="info_block__accent" style="text-align:center;">Notice</h3>
                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                  <h4 style="text-align:center;">Only validated identities counted</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="row">
                <div class="col-12 col-sm-8 bordered-col">
                  <canvas id="BarVa" width="100%" height="60%"></canvas>
                </div>
                <div class="col-12 col-sm-4 bordered-col">
                  <br>
                  <form id="name_form" METHOD="POST" oninput="changeScoreVa(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Score Calculator</h2>

                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <p  style="text-align:center;"> . Human Vote Value .</p>
                      <input type="number" class=" form-control" id="1-H" value="1" min="0" placeholder="Human Vote Value" />

                      <p  style="text-align:center;"> . Verified Vote Value .</p>
                      <input type="number" class=" form-control" id="1-V" value="1" min="0" placeholder="Verified Vote Value" />

                      <p  style="text-align:center;"> . Newbie Vote Value .</p>
                      <input type="number" class=" form-control" id="1-N" value="1" min="0" placeholder="Newbie Vote Value" />

                    </div>
                   <br><h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="VaScoreAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>

                </div>
              </div>

            </div>

            <div class="card">
              <div class="row">
                <div class="col-12 col-sm-12 bordered-col">
                  <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                  <canvas id="BarAgeVa" width="100%" height="40%"></canvas>
                </div>
              </div>
            </div>
          </div>



          <div class="tab-pane" id="HCon">
            <div class="card">
              <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
              <div class="row">
                <div class="col-12 col-sm-6 bordered-col">
                  <canvas id="ChartH" width="100%" height="70%"></canvas><br><h4 style="text-align:center;" id="TotalH">Total : 0</h4>
                </div>
                <div class="col-12 col-sm-6 bordered-col">
                  <form id="name_form" METHOD="POST" oninput="changeChartH(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="HChartAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>
                  <br><br><br>
                 <h3 class="info_block__accent" style="text-align:center;">Notice</h3>
                 <div class="input-group" style="width: 60%;margin: 0 auto;">
                 <h4 style="text-align:center;">Only Humans counted</h4>
                 </div>
                </div>
              </div>
            </div>
            <div class="card">

              <div class="row">
                <div class="col-12 col-sm-8 bordered-col">
                  <canvas id="BarH" width="100%" height="60%"></canvas>
                </div>
                <div class="col-12 col-sm-4 bordered-col">
                  <br>
                  <form id="name_form" METHOD="POST" oninput="changeScoreH(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Score Calculator</h2>
<br>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <p  style="text-align:center;"> . Human Vote Value .</p>
                      <input type="number" class="form-control" id="2-H" value="1" min="0" placeholder="Human Vote Value" />
<br>
                    </div>


                   <br><h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="HScoreAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>


                  </form>




                </div>
              </div>
            </div>
            <div class="card">
              <div class="row">
                <div class="col-12 col-sm-12 bordered-col">
                  <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                  <canvas id="BarAgeH" width="100%" height="40%"></canvas>
                </div>
              </div>
            </div>
          </div>



          <div class="tab-pane" id="VCon">
            <div class="card">
              <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
              <div class="row">
                <div class="col-12 col-sm-6 bordered-col">
                  <canvas id="ChartV" width="100%" height="70%"></canvas><br><h4 style="text-align:center;" id="TotalV">Total : 0</h4>
                </div>
                <div class="col-12 col-sm-6 bordered-col">
                  <form id="name_form" METHOD="POST" oninput="changeChartV(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="VChartAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>
                  <br><br><br>
                 <h3 class="info_block__accent" style="text-align:center;">Notice</h3>
                 <div class="input-group" style="width: 60%;margin: 0 auto;">
                 <h4 style="text-align:center;">Only Verified counted</h4>
                 </div>
                </div>
              </div>
            </div>
            <div class="card">

              <div class="row">
                <div class="col-12 col-sm-8 bordered-col">
                  <canvas id="BarV" width="100%" height="60%"></canvas>
                </div>
                <div class="col-12 col-sm-4 bordered-col">
                  <br>
                  <form id="name_form" METHOD="POST" oninput="changeScoreV(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Score Calculator</h2>
<br>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <p  style="text-align:center;"> . Verified Vote Value .</p>
                      <input type="number" class=" form-control" id="3-V" value="1" min="0" placeholder="Verified Vote Value" />
<br>
                    </div>
                   <br><h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="VScoreAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <div class="card">
              <div class="row">
                <div class="col-12 col-sm-12 bordered-col">
                  <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                  <canvas id="BarAgeV" width="100%" height="40%"></canvas>
                </div>
              </div>
            </div>
          </div>



          <div class="tab-pane" id="NCon">
            <div class="card">
              <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
              <div class="row">
                <div class="col-12 col-sm-6 bordered-col">
                  <canvas id="ChartN" width="100%" height="70%"></canvas><br><h4 style="text-align:center;" id="TotalN">Total : 0</h4>
                </div>
                <div class="col-12 col-sm-6 bordered-col">
                  <form id="name_form" METHOD="POST" oninput="changeChartN(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="NChartAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>
                  <br><br><br>
                 <h3 class="info_block__accent" style="text-align:center;">Notice</h3>
                 <div class="input-group" style="width: 60%;margin: 0 auto;">
                 <h4 style="text-align:center;">Only Newbies counted</h4>
                 </div>
                </div>
              </div>
            </div>
            <div class="card">

              <div class="row">
                <div class="col-12 col-sm-8 bordered-col">
                  <canvas id="BarN" width="100%" height="60%"></canvas>
                </div>
                <div class="col-12 col-sm-4 bordered-col">
                  <br>
                  <form id="name_form" METHOD="POST" oninput="changeScoreN(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Score Calculator</h2>
<br>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <p  style="text-align:center;"> . Newbie Vote Value .</p>
                      <input type="number" class=" form-control" id="4-N" value="1" min="0" placeholder="Newbie Vote Value" />
<br>
                    </div>
                   <br><h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="NScoreAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <div class="card">
              <div class="row">
                <div class="col-12 col-sm-12 bordered-col">
                  <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                  <canvas id="BarAgeN" width="100%" height="40%"></canvas>
                </div>
              </div>
            </div>
          </div>



          <div class="tab-pane" id="HAndVCon">
            <div class="card">
              <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
              <div class="row">
                <div class="col-12 col-sm-6 bordered-col">
                  <canvas id="ChartHAndV" width="100%" height="70%"></canvas><br><h4 style="text-align:center;" id="TotalHAndV">Total : 0</h4>
                </div>
                <div class="col-12 col-sm-6 bordered-col">
                  <form id="name_form" METHOD="POST" oninput="changeChartHAndV(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="HAndVChartAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>
                  <br><br><br>
                 <h3 class="info_block__accent" style="text-align:center;">Notice</h3>
                 <div class="input-group" style="width: 60%;margin: 0 auto;">
                 <h4 style="text-align:center;">Only Humans And Verifed counted</h4>
                 </div>
                </div>
              </div>
            </div>
            <div class="card">

              <div class="row">
                <div class="col-12 col-sm-8 bordered-col">
                  <canvas id="BarHAndV" width="100%" height="60%"></canvas>
                </div>
                <div class="col-12 col-sm-4 bordered-col">
                  <br>
                  <form id="name_form" METHOD="POST" oninput="changeScoreHAndV(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Score Calculator</h2>
<br>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <p  style="text-align:center;"> . Human Vote Value .</p>
                      <input type="number" class=" form-control" id="5-H" value="1" min="0" placeholder="Human Vote Value" />
<br>
                      <p  style="text-align:center;"> . Verified Vote Value .</p>
                      <input type="number" class=" form-control" id="5-V" value="1" min="0" placeholder="Verified Vote Value" />
<br>
                    </div>
                   <br><h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="HAndVScoreAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <div class="card">
              <div class="row">
                <div class="col-12 col-sm-12 bordered-col">
                  <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                  <canvas id="BarAgeHAndV" width="100%" height="40%"></canvas>
                </div>
              </div>
            </div>
          </div>






          <div class="tab-pane" id="AllCon">
            <div class="card">
              <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
              <div class="row">
                <div class="col-12 col-sm-6 bordered-col">
                  <canvas id="ChartAll" width="100%" height="70%"></canvas><br><h4 style="text-align:center;" id="TotalAll">Total : 0</h4>
                </div>
                <div class="col-12 col-sm-6 bordered-col">
                  <form id="name_form" METHOD="POST" oninput="changeChartAll(); return false;">
                    <br><h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="AllChartAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>
                  <br><br><br>
                 <h3 class="info_block__accent" style="text-align:center;">Notice</h3>
                 <div class="input-group" style="width: 60%;margin: 0 auto;">
                 <h4 style="text-align:center;">All identities counted</h4>
                 </div>
                </div>
              </div>
            </div>
            <div class="card">

              <div class="row">
                <div class="col-12 col-sm-8 bordered-col">
                  <canvas id="BarAll" width="100%" height="60%"></canvas>
                </div>
                <div class="col-12 col-sm-4 bordered-col">
                  <br>
                  <form id="name_form" METHOD="POST" oninput="changeScoreAll(); return false;">
                    <h2 class="info_block__accent" style="text-align:center;">Score Calculator</h2>
<br>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <p  style="text-align:center;"> . Human Vote Value .</p>
                      <input type="number" class=" form-control" id="6-H" value="1" min="0" placeholder="Human Vote Value" />
<br>
                      <p  style="text-align:center;"> . Verified Vote Value .</p>
                      <input type="number" class=" form-control" id="6-V" value="1" min="0" placeholder="Verified Vote Value" />
<br>
                      <p  style="text-align:center;"> . Newbie Vote Value .</p>
                      <input type="number" class=" form-control" id="6-N" value="1" min="0" placeholder="Newbie Vote Value" />
<br>

                    </div>
                    <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                    <div class="input-group" style="width: 60%;margin: 0 auto;">
                      <input type="number" name="age" style="text-align:center;" id="AllScoreAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <div class="card">
              <div class="row">
                <div class="col-12 col-sm-12 bordered-col">
                  <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                  <canvas id="BarAgeAll" width="100%" height="40%"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>





















    <script>
    function Change(Newl) {
 if (Newl == 'H') {
     document.getElementById("HCon").classList.add("active");
     document.getElementById("HNav").classList.add("active");
     document.getElementById("VCon").classList.remove("active");
     document.getElementById("NCon").classList.remove("active");
     document.getElementById("HAndVCon").classList.remove("active");
     document.getElementById("VaCon").classList.remove("active");
     document.getElementById("AllCon").classList.remove("active");

     document.getElementById("VNav").classList.remove("active");
     document.getElementById("NNav").classList.remove("active");
     document.getElementById("HAndVNav").classList.remove("active");
     document.getElementById("VaNav").classList.remove("active");
     document.getElementById("AllNav").classList.remove("active");



 }



 if (Newl == 'V') {
     document.getElementById("VCon").classList.add("active");
     document.getElementById("VNav").classList.add("active");

     document.getElementById("HCon").classList.remove("active");
     document.getElementById("NCon").classList.remove("active");
     document.getElementById("HAndVCon").classList.remove("active");
     document.getElementById("VaCon").classList.remove("active");
     document.getElementById("AllCon").classList.remove("active");


     document.getElementById("HNav").classList.remove("active");
     document.getElementById("NNav").classList.remove("active");
     document.getElementById("HAndVNav").classList.remove("active");
     document.getElementById("VaNav").classList.remove("active");
     document.getElementById("AllNav").classList.remove("active");

 }



 if (Newl == 'N') {
     document.getElementById("NCon").classList.add("active");
     document.getElementById("NNav").classList.add("active");
     document.getElementById("HCon").classList.remove("active");
     document.getElementById("VCon").classList.remove("active");
     document.getElementById("HAndVCon").classList.remove("active");
     document.getElementById("VaCon").classList.remove("active");
     document.getElementById("AllCon").classList.remove("active");



     document.getElementById("HNav").classList.remove("active");
     document.getElementById("VNav").classList.remove("active");
     document.getElementById("HAndVNav").classList.remove("active");
     document.getElementById("VaNav").classList.remove("active");
     document.getElementById("AllNav").classList.remove("active");

 }




 if (Newl == 'HAndV') {
     document.getElementById("HAndVCon").classList.add("active");
     document.getElementById("HAndVNav").classList.add("active");
     document.getElementById("HCon").classList.remove("active");
     document.getElementById("VCon").classList.remove("active");
     document.getElementById("NCon").classList.remove("active");
     document.getElementById("VaCon").classList.remove("active");
     document.getElementById("AllCon").classList.remove("active");


     document.getElementById("HNav").classList.remove("active");
     document.getElementById("VNav").classList.remove("active");
     document.getElementById("NNav").classList.remove("active");
     document.getElementById("VaNav").classList.remove("active");
     document.getElementById("AllNav").classList.remove("active");

 }

 if (Newl == 'Va') {
     document.getElementById("VaCon").classList.add("active");
     document.getElementById("VaNav").classList.add("active");
     document.getElementById("HCon").classList.remove("active");
     document.getElementById("VCon").classList.remove("active");
     document.getElementById("NCon").classList.remove("active");
     document.getElementById("HAndVCon").classList.remove("active");
     document.getElementById("AllCon").classList.remove("active");



     document.getElementById("HNav").classList.remove("active");
     document.getElementById("VNav").classList.remove("active");
     document.getElementById("NNav").classList.remove("active");
     document.getElementById("HAndVNav").classList.remove("active");
     document.getElementById("AllNav").classList.remove("active");

 }
 if (Newl == 'All') {
     document.getElementById("AllCon").classList.add("active");
     document.getElementById("AllNav").classList.add("active");
     document.getElementById("HCon").classList.remove("active");
     document.getElementById("VCon").classList.remove("active");
     document.getElementById("NCon").classList.remove("active");
     document.getElementById("HAndVCon").classList.remove("active");
     document.getElementById("VaCon").classList.remove("active");



     document.getElementById("HNav").classList.remove("active");
     document.getElementById("VNav").classList.remove("active");
     document.getElementById("NNav").classList.remove("active");
     document.getElementById("HAndVNav").classList.remove("active");
     document.getElementById("VaNav").classList.remove("active");

 }

}

    </script>




 <!-- this is to close main, div opened in the header -->
 </div>
</main>



<script>
var scoreurl = "./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=1";
var ageurl = "./services/ageStats.php?pid=<?php echo $id; ?>&type=poll&age=1";

function httpGet(theUrl) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl, false); // false for synchronous request
    xmlHttp.send(null);
    return xmlHttp.responseText;
}

var scoreData = httpGet(scoreurl);
var chartData = scoreData;
var ageData = httpGet(ageurl);

function changeScoreVa(useData) {
    age = document.getElementById("VaScoreAge").value;
    var humanValue = document.getElementById("1-H").value;
    var verifiedValue = document.getElementById("1-V").value;
    var newbieValue = document.getElementById("1-N").value;
    let chartdata = [];
    let chartlabels = [];
    var humansCount = 0;
    var verifiedCount = 0;
    var newbieCount = 0;
    if (!useData == '0') {
        data = JSON.parse(scoreData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#BarVa').replaceWith('<canvas id="BarVa" width="100%" height="60%"></canvas>');
    }

    // option 1
    chartdata.push((Number(data['result']['option1']['Human']) * humanValue) +
        (Number(data['result']['option1']['Verified']) * verifiedValue) +
        (Number(data['result']['option1']['Newbie']) * newbieValue));
    //option2
    chartdata.push((Number(data['result']['option2']['Human']) * humanValue) +
        (Number(data['result']['option2']['Verified']) * verifiedValue) +
        (Number(data['result']['option2']['Newbie']) * newbieValue));
    //option3
    chartdata.push((Number(data['result']['option3']['Human']) * humanValue) +
        (Number(data['result']['option3']['Verified']) * verifiedValue) +
        (Number(data['result']['option3']['Newbie']) * newbieValue));
    //option4
    chartdata.push((Number(data['result']['option4']['Human']) * humanValue) +
        (Number(data['result']['option4']['Verified']) * verifiedValue) +
        (Number(data['result']['option4']['Newbie']) * newbieValue));
    //option5
    chartdata.push((Number(data['result']['option5']['Human']) * humanValue) +
        (Number(data['result']['option5']['Verified']) * verifiedValue) +
        (Number(data['result']['option5']['Newbie']) * newbieValue));
    //option6
    chartdata.push((Number(data['result']['option6']['Human']) * humanValue) +
        (Number(data['result']['option6']['Verified']) * verifiedValue) +
        (Number(data['result']['option6']['Newbie']) * newbieValue));
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }
    var ctx = document.getElementById('BarVa').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Score',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function changeScoreH(useData) {
    age = document.getElementById("HScoreAge").value;
    var humanValue = document.getElementById("2-H").value;
    let chartdata = [];
    let chartlabels = [];
    var humansCount = 0;
    if (!useData == '0') {
        data = JSON.parse(scoreData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#BarH').replaceWith('<canvas id="BarH" width="100%" height="60%"></canvas>');
    }

    // option 1
    chartdata.push((Number(data['result']['option1']['Human']) * humanValue));
    //option2
    chartdata.push((Number(data['result']['option2']['Human']) * humanValue));
    //option3
    chartdata.push((Number(data['result']['option3']['Human']) * humanValue));
    //option4
    chartdata.push((Number(data['result']['option4']['Human']) * humanValue));
    //option5
    chartdata.push((Number(data['result']['option5']['Human']) * humanValue));
    //option6
    chartdata.push((Number(data['result']['option6']['Human']) * humanValue));
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }
    var ctx = document.getElementById('BarH').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Score',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function changeScoreV(useData) {
    age = document.getElementById("VScoreAge").value;
    var verifiedValue = document.getElementById("3-V").value;

    let chartdata = [];
    let chartlabels = [];
    var verifiedCount = 0;
    if (!useData == '0') {
        data = JSON.parse(scoreData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#BarV').replaceWith('<canvas id="BarV" width="100%" height="60%"></canvas>');
    }
    // option 1
    chartdata.push((Number(data['result']['option1']['Verified']) * verifiedValue));
    //option2
    chartdata.push((Number(data['result']['option2']['Verified']) * verifiedValue));
    //option3
    chartdata.push((Number(data['result']['option3']['Verified']) * verifiedValue));
    //option4
    chartdata.push((Number(data['result']['option4']['Verified']) * verifiedValue));
    //option5
    chartdata.push((Number(data['result']['option5']['Verified']) * verifiedValue));
    //option6
    chartdata.push((Number(data['result']['option6']['Verified']) * verifiedValue));
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }
    var ctx = document.getElementById('BarV').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Score',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function changeScoreN(useData) {

    age = document.getElementById("NScoreAge").value;
    var newbieValue = document.getElementById("4-N").value;
    let chartdata = [];
    let chartlabels = [];
    var newbieCount = 0;
    if (!useData == '0') {
        data = JSON.parse(scoreData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#BarN').replaceWith('<canvas id="BarN" width="100%" height="60%"></canvas>');
    }
    // option 1
    chartdata.push((Number(data['result']['option1']['Newbie']) * newbieValue));
    //option2
    chartdata.push((Number(data['result']['option2']['Newbie']) * newbieValue));
    //option3
    chartdata.push((Number(data['result']['option3']['Newbie']) * newbieValue));
    //option4
    chartdata.push((Number(data['result']['option4']['Newbie']) * newbieValue));
    //option5
    chartdata.push((Number(data['result']['option5']['Newbie']) * newbieValue));
    //option6
    chartdata.push((Number(data['result']['option6']['Newbie']) * newbieValue));
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }
    var ctx = document.getElementById('BarN').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Score',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function changeScoreHAndV(useData) {
    age = document.getElementById("HAndVScoreAge").value;
    var humanValue = document.getElementById("5-H").value;
    var verifiedValue = document.getElementById("5-V").value;
    let chartdata = [];
    let chartlabels = [];
    var humansCount = 0;
    var verifiedCount = 0;
    var newbieCount = 0;

    if (!useData == '0') {
        data = JSON.parse(scoreData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#BarHAndV').replaceWith('<canvas id="BarHAndV" width="100%" height="60%"></canvas>');
    }


    // option 1
    chartdata.push((Number(data['result']['option1']['Human']) * humanValue) +
        (Number(data['result']['option1']['Verified']) * verifiedValue));
    //option2
    chartdata.push((Number(data['result']['option2']['Human']) * humanValue) +
        (Number(data['result']['option2']['Verified']) * verifiedValue));
    //option3
    chartdata.push((Number(data['result']['option3']['Human']) * humanValue) +
        (Number(data['result']['option3']['Verified']) * verifiedValue));
    //option4
    chartdata.push((Number(data['result']['option4']['Human']) * humanValue) +
        (Number(data['result']['option4']['Verified']) * verifiedValue));
    //option5
    chartdata.push((Number(data['result']['option5']['Human']) * humanValue) +
        (Number(data['result']['option5']['Verified']) * verifiedValue));
    //option6
    chartdata.push((Number(data['result']['option6']['Human']) * humanValue) +
        (Number(data['result']['option6']['Verified']) * verifiedValue));
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }
    var ctx = document.getElementById('BarHAndV').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Score',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function changeScoreAll(useData) {
    age = document.getElementById("AllScoreAge").value;
    var humanValue = document.getElementById("6-H").value;
    var verifiedValue = document.getElementById("6-V").value;
    var newbieValue = document.getElementById("6-N").value;

    let chartdata = [];
    let chartlabels = [];
    var humansCount = 0;
    var verifiedCount = 0;
    var newbieCount = 0;
    if (!useData == '0') {
        data = JSON.parse(scoreData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#BarAll').replaceWith('<canvas id="BarAll" width="100%" height="60%"></canvas>');
    }

    // option 1
    chartdata.push((Number(data['result']['option1']['Human']) * humanValue) +
        (Number(data['result']['option1']['Verified']) * verifiedValue) +
        (Number(data['result']['option1']['Newbie']) * newbieValue));
    //option2
    chartdata.push((Number(data['result']['option2']['Human']) * humanValue) +
        (Number(data['result']['option2']['Verified']) * verifiedValue) +
        (Number(data['result']['option2']['Newbie']) * newbieValue));
    //option3
    chartdata.push((Number(data['result']['option3']['Human']) * humanValue) +
        (Number(data['result']['option3']['Verified']) * verifiedValue) +
        (Number(data['result']['option3']['Newbie']) * newbieValue));
    //option4
    chartdata.push((Number(data['result']['option4']['Human']) * humanValue) +
        (Number(data['result']['option4']['Verified']) * verifiedValue) +
        (Number(data['result']['option4']['Newbie']) * newbieValue));
    //option5
    chartdata.push((Number(data['result']['option5']['Human']) * humanValue) +
        (Number(data['result']['option5']['Verified']) * verifiedValue) +
        (Number(data['result']['option5']['Newbie']) * newbieValue));
    //option6
    chartdata.push((Number(data['result']['option6']['Human']) * humanValue) +
        (Number(data['result']['option6']['Verified']) * verifiedValue) +
        (Number(data['result']['option6']['Newbie']) * newbieValue));

    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }
    var ctx = document.getElementById('BarAll').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Score',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

</script>


<script>
function loadBarVa() {

    let chartdata = [];
    let chartlabels = [];


    data = JSON.parse(ageData);


    // option 1

    var _E0To2Total = Number(data['result']['Human']['E0To2']) + Number(data['result']['Verified']['E0To2']) + Number(data['result']['Newbie']['E0To2']);
    var _E3To6Total = Number(data['result']['Human']['E3To6']) + Number(data['result']['Verified']['E3To6']) + Number(data['result']['Newbie']['E3To6']);
    var _E7To11Total = Number(data['result']['Human']['E7To11']) + Number(data['result']['Verified']['E7To11']) + Number(data['result']['Newbie']['E7To11']);
    var _E12To17Total = Number(data['result']['Human']['E12To17']) + Number(data['result']['Verified']['E12To17']) + Number(data['result']['Newbie']['E12To17']);
    var _E18To25Total = Number(data['result']['Human']['E18To25']) + Number(data['result']['Verified']['E18To25']) + Number(data['result']['Newbie']['E18To25']);
    var _E26To32Total = Number(data['result']['Human']['E26To32']) + Number(data['result']['Verified']['E26To32']) + Number(data['result']['Newbie']['E26To32']);
    var _E33To40Total = Number(data['result']['Human']['E33To40']) + Number(data['result']['Verified']['E33To40']) + Number(data['result']['Newbie']['E33To40']);
    var _E41To47Total = Number(data['result']['Human']['E41To47']) + Number(data['result']['Verified']['E41To47']) + Number(data['result']['Newbie']['E41To47']);


    chartdata.push(_E0To2Total);
    chartdata.push(_E3To6Total);
    chartdata.push(_E7To11Total);
    chartdata.push(_E12To17Total);
    chartdata.push(_E18To25Total);
    chartdata.push(_E26To32Total);
    chartdata.push(_E33To40Total);
    chartdata.push(_E41To47Total);


    for (k in data['result']['Human']) {
        chartlabels.push(k)
    }


    var ctx = document.getElementById('BarAgeVa').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Age',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}


function loadBarH() {

    let chartdata = [];
    let chartlabels = [];

    data = JSON.parse(ageData);
    // option 1

    var _E0To2Total = Number(data['result']['Human']['E0To2']);
    var _E3To6Total = Number(data['result']['Human']['E3To6']);
    var _E7To11Total = Number(data['result']['Human']['E7To11']);
    var _E12To17Total = Number(data['result']['Human']['E12To17']);
    var _E18To25Total = Number(data['result']['Human']['E18To25']);
    var _E26To32Total = Number(data['result']['Human']['E26To32']);
    var _E33To40Total = Number(data['result']['Human']['E33To40']);
    var _E41To47Total = Number(data['result']['Human']['E41To47']);


    chartdata.push(_E0To2Total);
    chartdata.push(_E3To6Total);
    chartdata.push(_E7To11Total);
    chartdata.push(_E12To17Total);
    chartdata.push(_E18To25Total);
    chartdata.push(_E26To32Total);
    chartdata.push(_E33To40Total);
    chartdata.push(_E41To47Total);


    for (k in data['result']['Human']) {
        chartlabels.push(k)
    }


    var ctx = document.getElementById('BarAgeH').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Age',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}


function loadBarV() {

    let chartdata = [];
    let chartlabels = [];

    data = JSON.parse(ageData);
    // option 1

    var _E0To2Total = Number(data['result']['Verified']['E0To2']);
    var _E3To6Total = Number(data['result']['Verified']['E3To6']);
    var _E7To11Total = Number(data['result']['Verified']['E7To11']);
    var _E12To17Total = Number(data['result']['Verified']['E12To17']);
    var _E18To25Total = Number(data['result']['Verified']['E18To25']);
    var _E26To32Total = Number(data['result']['Verified']['E26To32']);
    var _E33To40Total = Number(data['result']['Verified']['E33To40']);
    var _E41To47Total = Number(data['result']['Verified']['E41To47']);


    chartdata.push(_E0To2Total);
    chartdata.push(_E3To6Total);
    chartdata.push(_E7To11Total);
    chartdata.push(_E12To17Total);
    chartdata.push(_E18To25Total);
    chartdata.push(_E26To32Total);
    chartdata.push(_E33To40Total);
    chartdata.push(_E41To47Total);


    for (k in data['result']['Verified']) {
        chartlabels.push(k)
    }


    var ctx = document.getElementById('BarAgeV').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Age',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function loadBarN() {

    let chartdata = [];
    let chartlabels = [];

    data = JSON.parse(ageData);
    // option 1

    var _E0To2Total = Number(data['result']['Newbie']['E0To2']);
    var _E3To6Total = Number(data['result']['Newbie']['E3To6']);
    var _E7To11Total = Number(data['result']['Newbie']['E7To11']);
    var _E12To17Total = Number(data['result']['Newbie']['E12To17']);
    var _E18To25Total = Number(data['result']['Newbie']['E18To25']);
    var _E26To32Total = Number(data['result']['Newbie']['E26To32']);
    var _E33To40Total = Number(data['result']['Newbie']['E33To40']);
    var _E41To47Total = Number(data['result']['Newbie']['E41To47']);


    chartdata.push(_E0To2Total);
    chartdata.push(_E3To6Total);
    chartdata.push(_E7To11Total);
    chartdata.push(_E12To17Total);
    chartdata.push(_E18To25Total);
    chartdata.push(_E26To32Total);
    chartdata.push(_E33To40Total);
    chartdata.push(_E41To47Total);


    for (k in data['result']['Human']) {
        chartlabels.push(k)
    }


    var ctx = document.getElementById('BarAgeN').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Age',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function loadBarHAndV() {

    let chartdata = [];
    let chartlabels = [];

    data = JSON.parse(ageData);
    // option 1

    var _E0To2Total = Number(data['result']['Human']['E0To2']) + Number(data['result']['Verified']['E0To2']);
    var _E3To6Total = Number(data['result']['Human']['E3To6']) + Number(data['result']['Verified']['E3To6']);
    var _E7To11Total = Number(data['result']['Human']['E7To11']) + Number(data['result']['Verified']['E7To11']);
    var _E12To17Total = Number(data['result']['Human']['E12To17']) + Number(data['result']['Verified']['E12To17']);
    var _E18To25Total = Number(data['result']['Human']['E18To25']) + Number(data['result']['Verified']['E18To25']);
    var _E26To32Total = Number(data['result']['Human']['E26To32']) + Number(data['result']['Verified']['E26To32']);
    var _E33To40Total = Number(data['result']['Human']['E33To40']) + Number(data['result']['Verified']['E33To40']);
    var _E41To47Total = Number(data['result']['Human']['E41To47']) + Number(data['result']['Verified']['E41To47']);


    chartdata.push(_E0To2Total);
    chartdata.push(_E3To6Total);
    chartdata.push(_E7To11Total);
    chartdata.push(_E12To17Total);
    chartdata.push(_E18To25Total);
    chartdata.push(_E26To32Total);
    chartdata.push(_E33To40Total);
    chartdata.push(_E41To47Total);


    for (k in data['result']['Human']) {
        chartlabels.push(k)
    }


    var ctx = document.getElementById('BarAgeHAndV').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Age',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function loadBarAll() {

    let chartdata = [];
    let chartlabels = [];

    data = JSON.parse(ageData);
    // option 1

    var _E0To2Total = Number(data['result']['Human']['E0To2']) + Number(data['result']['Verified']['E0To2']) + Number(data['result']['Newbie']['E0To2']);
    var _E3To6Total = Number(data['result']['Human']['E3To6']) + Number(data['result']['Verified']['E3To6']) + Number(data['result']['Newbie']['E3To6']);
    var _E7To11Total = Number(data['result']['Human']['E7To11']) + Number(data['result']['Verified']['E7To11']) + Number(data['result']['Newbie']['E7To11']);
    var _E12To17Total = Number(data['result']['Human']['E12To17']) + Number(data['result']['Verified']['E12To17']) + Number(data['result']['Newbie']['E12To17']);
    var _E18To25Total = Number(data['result']['Human']['E18To25']) + Number(data['result']['Verified']['E18To25']) + Number(data['result']['Newbie']['E18To25']);
    var _E26To32Total = Number(data['result']['Human']['E26To32']) + Number(data['result']['Verified']['E26To32']) + Number(data['result']['Newbie']['E26To32']);
    var _E33To40Total = Number(data['result']['Human']['E33To40']) + Number(data['result']['Verified']['E33To40']) + Number(data['result']['Newbie']['E33To40']);
    var _E41To47Total = Number(data['result']['Human']['E41To47']) + Number(data['result']['Verified']['E41To47']) + Number(data['result']['Newbie']['E41To47']);


    chartdata.push(_E0To2Total);
    chartdata.push(_E3To6Total);
    chartdata.push(_E7To11Total);
    chartdata.push(_E12To17Total);
    chartdata.push(_E18To25Total);
    chartdata.push(_E26To32Total);
    chartdata.push(_E33To40Total);
    chartdata.push(_E41To47Total);


    for (k in data['result']['Human']) {
        chartlabels.push(k)
    }


    var ctx = document.getElementById('BarAgeAll').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartlabels,
            datasets: [{
                label: 'Age',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,

            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

}

function changeChartVa(useData) {

    age = document.getElementById("VaChartAge").value;
    let chartdata = [];
    let chartlabels = [];


    if (!useData == '0') {
        data = JSON.parse(chartData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#ChartVa').replaceWith('<canvas id="ChartVa" width="100%" height="70%"></canvas>');
    }

    // Count
    if (!data['result']['option1']['Validated'] == 0) {
        chartdata.push(data['result']['option1']['Validated']);
    }
    if (!data['result']['option2']['Validated'] == 0) {
        chartdata.push(data['result']['option2']['Validated']);
    }
    if (!data['result']['option3']['Validated'] == 0) {
        chartdata.push(data['result']['option3']['Validated']);
    }
    if (!data['result']['option4']['Validated'] == 0) {
        chartdata.push(data['result']['option4']['Validated']);
    }
    if (!data['result']['option5']['Validated'] == 0) {
        chartdata.push(data['result']['option5']['Validated']);
    }
    if (!data['result']['option6']['Validated'] == 0) {
        chartdata.push(data['result']['option6']['Validated']);
    }
    // Description
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }

    document.getElementById('TotalVa').innerHTML = "Total : " + eval(chartdata.join('+'));
    var ctx = document.getElementById('ChartVa').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartlabels,
            datasets: [{
                label: '# of Votes',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
    });




}

function changeChartH(useData) {

    age = document.getElementById("HChartAge").value;
    let chartdata = [];
    let chartlabels = [];


    if (!useData == '0') {
        data = JSON.parse(chartData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#ChartH').replaceWith('<canvas id="ChartH" width="100%" height="70%"></canvas>');
    }


    // Count
    if (!data['result']['option1']['Human'] == 0) {
        chartdata.push(data['result']['option1']['Human']);
    }
    if (!data['result']['option2']['Human'] == 0) {
        chartdata.push(data['result']['option2']['Human']);
    }
    if (!data['result']['option3']['Human'] == 0) {
        chartdata.push(data['result']['option3']['Human']);
    }
    if (!data['result']['option4']['Human'] == 0) {
        chartdata.push(data['result']['option4']['Human']);
    }
    if (!data['result']['option5']['Human'] == 0) {
        chartdata.push(data['result']['option5']['Human']);
    }
    if (!data['result']['option6']['Human'] == 0) {
        chartdata.push(data['result']['option6']['Human']);
    }
    // Description
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }

    document.getElementById('TotalH').innerHTML = "Total : " + eval(chartdata.join('+'));
    var ctx = document.getElementById('ChartH').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartlabels,
            datasets: [{
                label: '# of Votes',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
    });




}

function changeChartV(useData) {

    age = document.getElementById("VChartAge").value;
    let chartdata = [];
    let chartlabels = [];

    if (!useData == '0') {
        data = JSON.parse(chartData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#ChartV').replaceWith('<canvas id="ChartV" width="100%" height="70%"></canvas>');
    }

    // Count
    if (!data['result']['option1']['Verified'] == 0) {
        chartdata.push(data['result']['option1']['Verified']);
    }
    if (!data['result']['option2']['Verified'] == 0) {
        chartdata.push(data['result']['option2']['Verified']);
    }
    if (!data['result']['option3']['Verified'] == 0) {
        chartdata.push(data['result']['option3']['Verified']);
    }
    if (!data['result']['option4']['Verified'] == 0) {
        chartdata.push(data['result']['option4']['Verified']);
    }
    if (!data['result']['option5']['Verified'] == 0) {
        chartdata.push(data['result']['option5']['Verified']);
    }
    if (!data['result']['option6']['Verified'] == 0) {
        chartdata.push(data['result']['option6']['Verified']);
    }
    // Description
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }

    document.getElementById('TotalV').innerHTML = "Total : " + eval(chartdata.join('+'));
    var ctx = document.getElementById('ChartV').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartlabels,
            datasets: [{
                label: '# of Votes',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
    });




}

function changeChartN(useData) {

    age = document.getElementById("NChartAge").value;
    let chartdata = [];
    let chartlabels = [];

    if (!useData == '0') {
        data = JSON.parse(chartData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#ChartN').replaceWith('<canvas id="ChartN" width="100%" height="70%"></canvas>');
    }

    // Count
    if (!data['result']['option1']['Newbie'] == 0) {
        chartdata.push(data['result']['option1']['Newbie']);
    }
    if (!data['result']['option2']['Newbie'] == 0) {
        chartdata.push(data['result']['option2']['Newbie']);
    }
    if (!data['result']['option3']['Newbie'] == 0) {
        chartdata.push(data['result']['option3']['Newbie']);
    }
    if (!data['result']['option4']['Newbie'] == 0) {
        chartdata.push(data['result']['option4']['Newbie']);
    }
    if (!data['result']['option5']['Newbie'] == 0) {
        chartdata.push(data['result']['option5']['Newbie']);
    }
    if (!data['result']['option6']['Newbie'] == 0) {
        chartdata.push(data['result']['option6']['Newbie']);
    }
    // Description
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }

    document.getElementById('TotalN').innerHTML = "Total : " + eval(chartdata.join('+'));
    var ctx = document.getElementById('ChartN').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartlabels,
            datasets: [{
                label: '# of Votes',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
    });




}

function changeChartHAndV(useData) {
    age = document.getElementById("HAndVChartAge").value;
    let chartdata = [];
    let chartlabels = [];

    if (!useData == '0') {
        data = JSON.parse(chartData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#ChartHAndV').replaceWith('<canvas id="ChartHAndV" width="100%" height="70%"></canvas>');
    }

    // Count
    if (!data['result']['option1']['HumanAndVerified'] == 0) {
        chartdata.push(data['result']['option1']['HumanAndVerified']);
    }
    if (!data['result']['option2']['HumanAndVerified'] == 0) {
        chartdata.push(data['result']['option2']['HumanAndVerified']);
    }
    if (!data['result']['option3']['HumanAndVerified'] == 0) {
        chartdata.push(data['result']['option3']['HumanAndVerified']);
    }
    if (!data['result']['option4']['HumanAndVerified'] == 0) {
        chartdata.push(data['result']['option4']['HumanAndVerified']);
    }
    if (!data['result']['option5']['HumanAndVerified'] == 0) {
        chartdata.push(data['result']['option5']['HumanAndVerified']);
    }
    if (!data['result']['option6']['HumanAndVerified'] == 0) {
        chartdata.push(data['result']['option6']['HumanAndVerified']);
    }
    // Description
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }

    document.getElementById('TotalHAndV').innerHTML = "Total : " + eval(chartdata.join('+'));
    var ctx = document.getElementById('ChartHAndV').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartlabels,
            datasets: [{
                label: '# of Votes',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
    });




}

function changeChartAll(useData) {

    age = document.getElementById("AllChartAge").value;
    let chartdata = [];
    let chartlabels = [];
    if (!useData == '0') {
        data = JSON.parse(chartData);
    } else {
        data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=poll&age=' + age);
        data = JSON.parse(data);
        $('#ChartAll').replaceWith('<canvas id="ChartAll" width="100%" height="70%"></canvas>');
    }

    // Count
    if (!data['result']['option1']['All'] == 0) {
        chartdata.push(data['result']['option1']['All']);
    }
    if (!data['result']['option2']['All'] == 0) {
        chartdata.push(data['result']['option2']['All']);
    }
    if (!data['result']['option3']['All'] == 0) {
        chartdata.push(data['result']['option3']['All']);
    }
    if (!data['result']['option4']['All'] == 0) {
        chartdata.push(data['result']['option4']['All']);
    }
    if (!data['result']['option5']['All'] == 0) {
        chartdata.push(data['result']['option5']['All']);
    }
    if (!data['result']['option6']['All'] == 0) {
        chartdata.push(data['result']['option6']['All']);
    }
    // Description
    if (!data['result']['option1']['Desc'] == '') {
        chartlabels.push(data['result']['option1']['Desc']);
    }
    if (!data['result']['option2']['Desc'] == '') {
        chartlabels.push(data['result']['option2']['Desc']);
    }
    if (!data['result']['option3']['Desc'] == '') {
        chartlabels.push(data['result']['option3']['Desc']);
    }
    if (!data['result']['option4']['Desc'] == '') {
        chartlabels.push(data['result']['option4']['Desc']);
    }
    if (!data['result']['option5']['Desc'] == '') {
        chartlabels.push(data['result']['option5']['Desc']);
    }
    if (!data['result']['option6']['Desc'] == '') {
        chartlabels.push(data['result']['option6']['Desc']);
    }

    document.getElementById('TotalAll').innerHTML = "Total : " + eval(chartdata.join('+'));
    var ctx = document.getElementById('ChartAll').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartlabels,
            datasets: [{
                label: '# of Votes',
                data: chartdata,
                backgroundColor: [
                    window.chartColors.purple,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.red,
                ],
                borderWidth: 2
            }]
        },
    });




}

function toggle(change) {
    if (change == true) {
        document.getElementById("text_submit").innerHTML = "Casting...";
        document.getElementById("submit").classList.add("disabled");
    } else {
        document.getElementById("text_submit").innerHTML = "Cast my Vote";
        document.getElementById("submit").classList.remove("disabled");
    }
}

function castVote() {
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for (var i = 0; i < elements.length; i++) {

        if (elements[i].name == 'vote') {
            if (elements[i].checked) {
                formData.append(elements[i].name, elements[i].value);
            }
        } else {
            formData.append(elements[i].name, elements[i].value);
        }

    }

    ajax_post('./services/vote.php', formData, function(data) {
        toggle(false);
        if (data["success"]) {
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Vote made successfully';
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("submit").classList.add("disabled");
            document.getElementById("warning").innerHTML = '&#x274C; Error!';
        }
    });
    ajax_get('./services/checkVote.php?id=<?php echo $id; ?>&type=poll', function(data) {
        if (data["status"] == 'true') {
            document.getElementById("vote_container").innerHTML = '<br><h4 style="text-align: center;">You have voted "' + data["vote"] + '".</h4>';
        }
        if (data["status"] == 'login') {
            document.getElementById("vote_container").innerHTML = '<br><h4 style="text-align: center;">You have to be signed in to vote</h4>';

        }
        if (data["status"] == 'ended') {
            document.getElementById("vote_container").innerHTML = '<br><h4 style="text-align: center;">Poll Ended</h4>';
        }

    });
}

function Delete(id) {
    ajax_get('./services/deletePoll.php?id=' + id, function(data) {


        window.location.replace("<?php echo $url;?>polls.php");

    });
}

function timechanging() {
    var elements = document.getElementsByClassName("timeUTC");

    for (var i = 0; i < elements.length; i++) {


        let utcTime = elements[i].innerHTML;
        elements[i].innerHTML = moment.utc(utcTime).local().format('YYYY-MM-DD HH:mm A');

    }

}
window.onload = function() {

    timechanging();
    changeChartVa(chartData);
    changeChartH(chartData);
    changeChartV(chartData);
    changeChartN(chartData);
    changeChartHAndV(chartData);
    changeChartAll(chartData);

    changeScoreVa(scoreData);
    changeScoreH(scoreData);
    changeScoreV(scoreData);
    changeScoreN(scoreData);
    changeScoreHAndV(scoreData);
    changeScoreAll(scoreData);



    loadBarVa();
    loadBarH();
    loadBarV();
    loadBarN();
    loadBarHAndV();
    loadBarAll();

    ajax_get('./services/checkVote.php?id=<?php echo $id; ?>&type=poll', function(data) {
        if (data["status"] == 'true') {
            document.getElementById("vote_container").innerHTML = '<br><h4 style="text-align: center;">You have voted "' + data["vote"] + '".</h4>';
        }
        if (data["status"] == 'login') {
            document.getElementById("vote_container").innerHTML = '<br><h4 style="text-align: center;">You have to be signed in to vote</h4>';

        }
        if (data["status"] == 'ended') {
            document.getElementById("vote_container").innerHTML = '<br><h4 style="text-align: center;">Poll Ended</h4>';
        }
    });
}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
