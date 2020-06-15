<?php
session_start();

include (dirname(__FILE__) . "/common/_public.php");
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

                  <div class="col-12 col-sm-7 bordered-col">

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
                        <h4 class="info_block__accent ">Start Time</h4>
                        <p class="timeUTC"><?php echo date('Y-m-d H:i', strtotime($row['addtime'])); ?></p>
                      </div>
                      <div class="col-4 col-sm-4 bordered-col">
                      <h4 class="info_block__accent ">End Time</h4>
                      <p class="timeUTC"><?php echo date('Y-m-d H:i', strtotime($row['endtime'])); ?></p>
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
<div class="col-12 col-sm-5 bordered-col">
  <br>
  <h4 class="info_block__accent">Share</h4>
   <input type="text" class="form-control" name="shareurl" value="<?php echo $url.'fvf.php?id='.$id;?>"/>
   <!-- I got these buttons from simplesharebuttons.com -->
   <br>
<div id="share-buttons" style="margin-left:20%;margin-right:20%"class="row justify-content-between align-items-center">

<!-- Facebook -->
<a href="http://www.facebook.com/sharer.php?u=<?php echo $url.'fvf.php?id='.$id;?>" target="_blank">
<img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
</a>

<!-- Google+ -->
<a href="https://plus.google.com/share?url=<?php echo $url.'fvf.php?id='.$id;?>" target="_blank">
<img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
</a>

<!-- LinkedIn -->
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url.'fvf.php?id='.$id;?>" target="_blank">
<img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
</a>


<!-- Reddit -->
<a href="http://reddit.com/submit?url=<?php echo $url.'fvf.php?id='.$id;?>&amp;title=<?php echo $row['title'];?>" target="_blank">
<img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
</a>

<!-- Twitter -->
<a href="https://twitter.com/share?url=<?php echo $url.'fvf.php?id='.$id;?>&amp;text=<?php echo $row['title'];?>&amp;hashtags=<?php echo $row['category'];?>" target="_blank">
<img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
</a>

<!-- VK -->
<a href="http://vkontakte.ru/share.php?url=<?php echo $url.'fvf.php?id='.$id;?>" target="_blank">
<img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK" />
</a>


</div>
</div>




                </div>
              </div>
            </div>
          </div>

    </div><!-- row end -->

</section>

<section class="section section_info">
   <div class="row " >
   <div class="col-12 col-sm-6 ">
      <div class="card col-auto">
               <img style="width: 100%; height:100%" src="<?php echo $row['location1'];?>" alt="Right">
               <form id="vote_form">
                  <div id="vote_container1">
                    <br>
                    <div class="warning rem" id="warning1">
                    </div>
                    <div class="success rem" id="success1">
                    </div>
                        <div class="input-group">
                           <a class="btn btn-secondary btn-small" href="#" id="submit1" onclick="castVote(1); return false;" >
                           <span id="text_submit1">Choose</span>
                           <i class="icon icon--thin_arrow_right"></i>
                           </a>

                     </div>
               </form>
             </div>
             </div>
                </div>
               <div class="col-12 col-sm-6">
                  <div class="card col-auto">
                 <img style="width: 100%; height:100%"src="<?php echo $row['location2'];?>" alt="Left">

               <form id="vote_form">
                  <div id="vote_container2">
                    <br>
                    <div class="warning rem" id="warning2">
                    </div>
                    <div class="success rem" id="success2">
                    </div>
                        <div class="input-group">
                           <a class=" btn btn-secondary btn-small" href="#" id="submit2" onclick="castVote(2); return false;" >
                           <span id="text_submit2">Choose</span>
                           <i class="icon icon--thin_arrow_right"></i>
                           </a>

                     </div>
               </form>
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
                <canvas id="ChartVa" width="100%" height="70%"></canvas>
              </div>
              <div class="col-12 col-sm-6 bordered-col">
                <form id="name_form" METHOD="POST" oninput="changeChartVa(); return false;">
                  <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                    <input type="number" name="age" style="text-align:center;" id="VaAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                  </div>
                </form>
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
<br>

                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                    <p class="info_block__accent" style="text-align:center;"> . Human Vote Value .</p>
                    <input type="number" class=" form-control" id="1-H" value="1" min="0" placeholder="Human Vote Value" />
<br>
                    <p class="info_block__accent" style="text-align:center;"> . Verified Vote Value .</p>
                    <input type="number" class=" form-control" id="1-V" value="1" min="0" placeholder="Verified Vote Value" />
<br>
                    <p class="info_block__accent" style="text-align:center;"> . Newbie Vote Value .</p>
                    <input type="number" class=" form-control" id="1-N" value="1" min="0" placeholder="Newbie Vote Value" />
<br>
                  </div>
                </form>

              </div>
            </div>

          </div>

          <div class="card">
            <div class="row">
              <div class="col-12 col-sm-12 bordered-col">
                <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                <canvas id="BarAgeVa" width="100%" height="30%"></canvas>
              </div>
            </div>
          </div>
        </div>



        <div class="tab-pane" id="HCon">
          <div class="card">
            <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
            <div class="row">
              <div class="col-12 col-sm-6 bordered-col">
                <canvas id="ChartH" width="100%" height="70%"></canvas>
              </div>
              <div class="col-12 col-sm-6 bordered-col">
                <form id="name_form" METHOD="POST" oninput="changeChartH(); return false;">
                  <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                    <input type="number" name="age" style="text-align:center;" id="HAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                  </div>
                </form>
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
                    <p class="info_block__accent" style="text-align:center;"> . Human Vote Value .</p>
                    <input type="number" class="form-control" id="2-H" value="1" min="0" placeholder="Human Vote Value" />
<br>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="row">
              <div class="col-12 col-sm-12 bordered-col">
                <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                <canvas id="BarAgeH" width="100%" height="30%"></canvas>
              </div>
            </div>
          </div>
        </div>



        <div class="tab-pane" id="VCon">
          <div class="card">
            <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
            <div class="row">
              <div class="col-12 col-sm-6 bordered-col">
                <canvas id="ChartV" width="100%" height="70%"></canvas>
              </div>
              <div class="col-12 col-sm-6 bordered-col">
                <form id="name_form" METHOD="POST" oninput="changeChartV(); return false;">
                  <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                    <input type="number" name="age" style="text-align:center;" id="VAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                  </div>
                </form>
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
                    <p class="info_block__accent" style="text-align:center;"> . Verified Vote Value .</p>
                    <input type="number" class=" form-control" id="3-V" value="1" min="0" placeholder="Verified Vote Value" />
<br>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="row">
              <div class="col-12 col-sm-12 bordered-col">
                <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                <canvas id="BarAgeV" width="100%" height="30%"></canvas>
              </div>
            </div>
          </div>
        </div>



        <div class="tab-pane" id="NCon">
          <div class="card">
            <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
            <div class="row">
              <div class="col-12 col-sm-6 bordered-col">
                <canvas id="ChartN" width="100%" height="70%"></canvas>
              </div>
              <div class="col-12 col-sm-6 bordered-col">
                <form id="name_form" METHOD="POST" oninput="changeChartN(); return false;">
                  <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                    <input type="number" name="age" style="text-align:center;" id="NAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                  </div>
                </form>
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
                    <p class="info_block__accent" style="text-align:center;"> . Newbie Vote Value .</p>
                    <input type="number" class=" form-control" id="4-N" value="1" min="0" placeholder="Newbie Vote Value" />
<br>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="row">
              <div class="col-12 col-sm-12 bordered-col">
                <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                <canvas id="BarAgeN" width="100%" height="30%"></canvas>
              </div>
            </div>
          </div>
        </div>



        <div class="tab-pane" id="HAndVCon">
          <div class="card">
            <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
            <div class="row">
              <div class="col-12 col-sm-6 bordered-col">
                <canvas id="ChartHAndV" width="100%" height="70%"></canvas>
              </div>
              <div class="col-12 col-sm-6 bordered-col">
                <form id="name_form" METHOD="POST" oninput="changeChartHAndV(); return false;">
                  <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                    <input type="number" name="age" style="text-align:center;" id="HAndVAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                  </div>
                </form>
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
                    <p class="info_block__accent" style="text-align:center;"> . Human Vote Value .</p>
                    <input type="number" class=" form-control" id="5-H" value="1" min="0" placeholder="Human Vote Value" />
<br>
                    <p class="info_block__accent" style="text-align:center;"> . Verified Vote Value .</p>
                    <input type="number" class=" form-control" id="5-V" value="1" min="0" placeholder="Verified Vote Value" />
<br>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="row">
              <div class="col-12 col-sm-12 bordered-col">
                <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                <canvas id="BarAgeHAndV" width="100%" height="30%"></canvas>
              </div>
            </div>
          </div>
        </div>






        <div class="tab-pane" id="AllCon">
          <div class="card">
            <h3 class="info_block__accent" style="text-align:center;">Total Votes By Option</h3>
            <div class="row">
              <div class="col-12 col-sm-6 bordered-col">
                <canvas id="ChartAll" width="100%" height="70%"></canvas>
              </div>
              <div class="col-12 col-sm-6 bordered-col">
                <form id="name_form" METHOD="POST" oninput="changeChartAll(); return false;">
                  <h2 class="info_block__accent" style="text-align:center;">Minimum Age</h2>
                  <div class="input-group" style="width: 60%;margin: 0 auto;">
                    <input type="number" name="age" style="text-align:center;" id="AllAge" class="formVal form-control" value="1" placeholder="Minimum age" />
                  </div>
                </form>
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
                    <p class="info_block__accent" style="text-align:center;"> . Human Vote Value .</p>
                    <input type="number" class=" form-control" id="6-H" value="1" min="0" placeholder="Human Vote Value" />
<br>
                    <p class="info_block__accent" style="text-align:center;"> . Verified Vote Value .</p>
                    <input type="number" class=" form-control" id="6-V" value="1" min="0" placeholder="Verified Vote Value" />
<br>
                    <p class="info_block__accent" style="text-align:center;"> . Newbie Vote Value .</p>
                    <input type="number" class=" form-control" id="6-N" value="1" min="0" placeholder="Newbie Vote Value" />
<br>

                  </div>
                </form>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="row">
              <div class="col-12 col-sm-12 bordered-col">
                <h3 class="info_block__accent" style="text-align:center;">Total Votes By Age</h3>
                <canvas id="BarAgeAll" width="100%" height="30%"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>





















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

        document.getElementById("VNav").classList.remove("active");
          document.getElementById("NNav").classList.remove("active");
          document.getElementById("HAndVNav").classList.remove("active");
          document.getElementById("VaNav").classList.remove("active");
          document.getElementById("AllNav").classList.remove("active");



         }



         if(Newl == 'V') {
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



         if(Newl == 'N') {
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




         if(Newl == 'HAndV') {
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

         if(Newl == 'Va') {
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
      if(Newl == 'All') {
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


  <?php
  include(dirname(__FILE__)."/partials/donation.php");
  ?>

  <!-- this is to close main, div opened in the header -->
  </div>
  </main>



  <script>
  var scoreurl = "./services/stats.php?pid=<?php echo $id; ?>&type=fvf&age=1";
  var ageurl = "./services/ageStats.php?pid=<?php echo $id; ?>&type=fvf&age=1";
  function httpGet(theUrl)
  {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
      xmlHttp.send( null );
      return xmlHttp.responseText;
  }

  var scoreData = httpGet(scoreurl);
  var chartData = scoreData;
  var ageData = httpGet(ageurl);

  function changeScoreVa(useData){

  var humanValue = document.getElementById("1-H").value;
  var verifiedValue = document.getElementById("1-V").value;
  var newbieValue = document.getElementById("1-N").value;
  let chartdata = [];
  let chartlabels = [];
  var humansCount = 0;
  var verifiedCount = 0;
  var newbieCount = 0;
  if(!useData == '0'){
    data = JSON.parse(scoreData);
  }else{
    data = JSON.parse(scoreData);
    $('#BarVa').replaceWith('<canvas id="BarVa" width="100%" height="60%"></canvas>');
  }

  // option 1
  chartdata.push((Number(data['result']['Left']['Human'])* humanValue) +
  (Number(data['result']['Left']['Verified'])* verifiedValue) +
  (Number(data['result']['Left']['Newbie'])* newbieValue));
  //Right
  chartdata.push((Number(data['result']['Right']['Human'])* humanValue) +
  (Number(data['result']['Right']['Verified'])* verifiedValue) +
  (Number(data['result']['Right']['Newbie'])* newbieValue));

  if(!data['result']['Left']['Desc'] == ''){
  chartlabels.push(data['result']['Left']['Desc']);
  }
  if(!data['result']['Right']['Desc'] == ''){
  chartlabels.push(data['result']['Right']['Desc']);
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
      ],borderWidth: 1}]},
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
  }
  );

  }
  function changeScoreH(useData){

  var humanValue = document.getElementById("2-H").value;
  let chartdata = [];
  let chartlabels = [];
  var humansCount = 0;
  if(!useData == '0'){
    data = JSON.parse(scoreData);
  }else{
    data = JSON.parse(scoreData);
    $('#BarH').replaceWith('<canvas id="BarH" width="100%" height="60%"></canvas>');
  }

  // option 1
  chartdata.push((Number(data['result']['Left']['Human'])* humanValue));
  //Right
  chartdata.push((Number(data['result']['Right']['Human'])* humanValue));

  if(!data['result']['Left']['Desc'] == ''){
  chartlabels.push(data['result']['Left']['Desc']);
  }
  if(!data['result']['Right']['Desc'] == ''){
  chartlabels.push(data['result']['Right']['Desc']);
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
      ],borderWidth: 1}]},
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
  }
  );

  }
  function changeScoreV(useData){

  var verifiedValue = document.getElementById("3-V").value;

  let chartdata = [];
  let chartlabels = [];
  var verifiedCount = 0;
  if(!useData == '0'){
    data = JSON.parse(scoreData);
  }else{
    data = JSON.parse(scoreData);
  $('#BarV').replaceWith('<canvas id="BarV" width="100%" height="60%"></canvas>');
  }
  // option 1
  chartdata.push((Number(data['result']['Left']['Verified'])* verifiedValue));
  //Right
  chartdata.push((Number(data['result']['Right']['Verified'])* verifiedValue));

  if(!data['result']['Left']['Desc'] == ''){
  chartlabels.push(data['result']['Left']['Desc']);
  }
  if(!data['result']['Right']['Desc'] == ''){
  chartlabels.push(data['result']['Right']['Desc']);
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
      ],borderWidth: 1}]},
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
  }
  );

  }
  function changeScoreN(useData){


  var newbieValue = document.getElementById("4-N").value;
  let chartdata = [];
  let chartlabels = [];
  var newbieCount = 0;
  if(!useData == '0'){
    data = JSON.parse(scoreData);
  }else{
  data = JSON.parse(scoreData);
    $('#BarN').replaceWith('<canvas id="BarN" width="100%" height="60%"></canvas>');
  }
  // option 1
  chartdata.push((Number(data['result']['Left']['Newbie'])* newbieValue));
  //Right
  chartdata.push((Number(data['result']['Right']['Newbie'])* newbieValue));

  if(!data['result']['Left']['Desc'] == ''){
  chartlabels.push(data['result']['Left']['Desc']);
  }
  if(!data['result']['Right']['Desc'] == ''){
  chartlabels.push(data['result']['Right']['Desc']);
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
      ],borderWidth: 1}]},
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
  }
  );

  }
  function changeScoreHAndV(useData){

  var humanValue = document.getElementById("5-H").value;
  var verifiedValue = document.getElementById("5-V").value;
  let chartdata = [];
  let chartlabels = [];
  var humansCount = 0;
  var verifiedCount = 0;
  var newbieCount = 0;

  if(!useData == '0'){
    data = JSON.parse(scoreData);
  }else{
    data = JSON.parse(scoreData);
    $('#BarHAndV').replaceWith('<canvas id="BarHAndV" width="100%" height="60%"></canvas>');
  }


  // option 1
  chartdata.push((Number(data['result']['Left']['Human'])* humanValue) +
  (Number(data['result']['Left']['Verified'])* verifiedValue));
  //Right
  chartdata.push((Number(data['result']['Right']['Human'])* humanValue) +
  (Number(data['result']['Right']['Verified'])* verifiedValue));

  if(!data['result']['Left']['Desc'] == ''){
  chartlabels.push(data['result']['Left']['Desc']);
  }
  if(!data['result']['Right']['Desc'] == ''){
  chartlabels.push(data['result']['Right']['Desc']);
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
      ],borderWidth: 1}]},
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
  }
  );

  }
  function changeScoreAll(useData){

  var humanValue = document.getElementById("6-H").value;
  var verifiedValue = document.getElementById("6-V").value;
  var newbieValue = document.getElementById("6-N").value;

  let chartdata = [];
  let chartlabels = [];
  var humansCount = 0;
  var verifiedCount = 0;
  var newbieCount = 0;
  if(!useData == '0'){
    data = JSON.parse(scoreData);
  }else{
    data = JSON.parse(scoreData);
    $('#BarAll').replaceWith('<canvas id="BarAll" width="100%" height="60%"></canvas>');
  }

  // option 1
  chartdata.push((Number(data['result']['Left']['Human'])* humanValue) +
  (Number(data['result']['Left']['Verified'])* verifiedValue) +
  (Number(data['result']['Left']['Newbie'])* newbieValue));
  //Right
  chartdata.push((Number(data['result']['Right']['Human'])* humanValue) +
  (Number(data['result']['Right']['Verified'])* verifiedValue) +
  (Number(data['result']['Right']['Newbie'])* newbieValue));


  if(!data['result']['Left']['Desc'] == ''){
  chartlabels.push(data['result']['Left']['Desc']);
  }
  if(!data['result']['Right']['Desc'] == ''){
  chartlabels.push(data['result']['Right']['Desc']);
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
      ],borderWidth: 1}]},
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
  }
  );

  }



  </script>


  <script>

  function loadBarVa(){

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


  for(k in data['result']['Human']) {
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
      ],borderWidth: 1}]},
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
  }
  );

  }




  function loadBarH(){

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


  for(k in data['result']['Human']) {
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
      ],borderWidth: 1}]},
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
  }
  );

  }




  function loadBarV(){

  let chartdata = [];
  let chartlabels = [];

    data = JSON.parse(ageData);
  // option 1

  var _E0To2Total =  Number(data['result']['Verified']['E0To2']);
  var _E3To6Total = Number(data['result']['Verified']['E3To6']);
  var _E7To11Total =  Number(data['result']['Verified']['E7To11']);
  var _E12To17Total =  Number(data['result']['Verified']['E12To17']);
  var _E18To25Total =  Number(data['result']['Verified']['E18To25']);
  var _E26To32Total =  Number(data['result']['Verified']['E26To32']);
  var _E33To40Total = Number(data['result']['Verified']['E33To40']);
  var _E41To47Total =  Number(data['result']['Verified']['E41To47']);


  chartdata.push(_E0To2Total);
  chartdata.push(_E3To6Total);
  chartdata.push(_E7To11Total);
  chartdata.push(_E12To17Total);
  chartdata.push(_E18To25Total);
  chartdata.push(_E26To32Total);
  chartdata.push(_E33To40Total);
  chartdata.push(_E41To47Total);


  for(k in data['result']['Verified']) {
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
      ],borderWidth: 1}]},
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
  }
  );

  }






  function loadBarN(){

  let chartdata = [];
  let chartlabels = [];

    data = JSON.parse(ageData);
  // option 1

  var _E0To2Total = Number(data['result']['Newbie']['E0To2']);
  var _E3To6Total =  Number(data['result']['Newbie']['E3To6']);
  var _E7To11Total = Number(data['result']['Newbie']['E7To11']);
  var _E12To17Total = Number(data['result']['Newbie']['E12To17']);
  var _E18To25Total =  Number(data['result']['Newbie']['E18To25']);
  var _E26To32Total =  Number(data['result']['Newbie']['E26To32']);
  var _E33To40Total = Number(data['result']['Newbie']['E33To40']);
  var _E41To47Total =  Number(data['result']['Newbie']['E41To47']);


  chartdata.push(_E0To2Total);
  chartdata.push(_E3To6Total);
  chartdata.push(_E7To11Total);
  chartdata.push(_E12To17Total);
  chartdata.push(_E18To25Total);
  chartdata.push(_E26To32Total);
  chartdata.push(_E33To40Total);
  chartdata.push(_E41To47Total);


  for(k in data['result']['Human']) {
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
      ],borderWidth: 1}]},
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
  }
  );

  }






  function loadBarHAndV(){

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


  for(k in data['result']['Human']) {
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
      ],borderWidth: 1}]},
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
  }
  );

  }





  function loadBarAll(){

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


  for(k in data['result']['Human']) {
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
      ],borderWidth: 1}]},
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
  }
  );

  }



  function changeChartVa(age,useData){

  age = document.getElementById("VaAge").value;
  let chartdata = [];
  let chartlabels = [];


  if(!useData == '0'){
    data = JSON.parse(chartData);
  }else{
    data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=fvf&age='+age);
    data = JSON.parse(data);
    $('#ChartVa').replaceWith('<canvas id="ChartVa" width="100%" height="70%"></canvas>');
  }

  // Count
    if(!data['result']['Left']['Validated'] == 0){
      chartdata.push(data['result']['Left']['Validated']);
    }
    if(!data['result']['Right']['Validated'] == 0){
      chartdata.push(data['result']['Right']['Validated']);
    }

  // Description
    if(!data['result']['Left']['Desc'] == ''){
      chartlabels.push(data['result']['Left']['Desc']);
    }
    if(!data['result']['Right']['Desc'] == ''){
      chartlabels.push(data['result']['Right']['Desc']);
    }



  var ctx = document.getElementById('ChartVa').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
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
          ],borderWidth: 1}]},});





  }
  function changeChartH(age,useData){

    age = document.getElementById("HAge").value;
  let chartdata = [];
  let chartlabels = [];


  if(!useData == '0'){
    data = JSON.parse(chartData);
  }else{
    data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=fvf&age='+age);
    data = JSON.parse(data);
    $('#ChartH').replaceWith('<canvas id="ChartH" width="100%" height="70%"></canvas>');
  }


  // Count
    if(!data['result']['Left']['Human'] == 0){
      chartdata.push(data['result']['Left']['Human']);
    }
    if(!data['result']['Right']['Human'] == 0){
      chartdata.push(data['result']['Right']['Human']);
    }

  // Description
    if(!data['result']['Left']['Desc'] == ''){
      chartlabels.push(data['result']['Left']['Desc']);
    }



  var ctx = document.getElementById('ChartH').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
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
          ],borderWidth: 1}]},});





  }
  function changeChartV(age,useData){

    age = document.getElementById("VAge").value;
  let chartdata = [];
  let chartlabels = [];

  if(!useData == '0'){
    data = JSON.parse(chartData);
  }else{
    data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=fvf&age='+age);
    data = JSON.parse(data);
    $('#ChartV').replaceWith('<canvas id="ChartV" width="100%" height="70%"></canvas>');
  }

  // Count
    if(!data['result']['Left']['Verified'] == 0){
      chartdata.push(data['result']['Left']['Verified']);
    }
    if(!data['result']['Right']['Verified'] == 0){
      chartdata.push(data['result']['Right']['Verified']);
    }

  // Description
    if(!data['result']['Left']['Desc'] == ''){
      chartlabels.push(data['result']['Left']['Desc']);
    }
    if(!data['result']['Right']['Desc'] == ''){
      chartlabels.push(data['result']['Right']['Desc']);
    }



  var ctx = document.getElementById('ChartV').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
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
          ],borderWidth: 1}]},});





  }
  function changeChartN(age,useData){

    age = document.getElementById("NAge").value;
  let chartdata = [];
  let chartlabels = [];

  if(!useData == '0'){
    data = JSON.parse(chartData);
  }else{
    data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=fvf&age='+age);
    data = JSON.parse(data);
    $('#ChartN').replaceWith('<canvas id="ChartN" width="100%" height="70%"></canvas>');
  }

  // Count
    if(!data['result']['Left']['Newbie'] == 0){
      chartdata.push(data['result']['Left']['Newbie']);
    }
    if(!data['result']['Right']['Newbie'] == 0){
      chartdata.push(data['result']['Right']['Newbie']);
    }

  // Description
    if(!data['result']['Left']['Desc'] == ''){
      chartlabels.push(data['result']['Left']['Desc']);
    }
    if(!data['result']['Right']['Desc'] == ''){
      chartlabels.push(data['result']['Right']['Desc']);
    }



  var ctx = document.getElementById('ChartN').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
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
          ],borderWidth: 1}]}
          ,});





  }
  function changeChartHAndV(age,useData){
    age = document.getElementById("HAndVAge").value;
  let chartdata = [];
  let chartlabels = [];

  if(!useData == '0'){
    data = JSON.parse(chartData);
  }else{
    data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=fvf&age='+age);
    data = JSON.parse(data);
    $('#ChartHAndV').replaceWith('<canvas id="ChartHAndV" width="100%" height="70%"></canvas>');
  }

  // Count
    if(!data['result']['Left']['HumanAndVerified'] == 0){
      chartdata.push(data['result']['Left']['HumanAndVerified']);
    }
    if(!data['result']['Right']['HumanAndVerified'] == 0){
      chartdata.push(data['result']['Right']['HumanAndVerified']);
    }

  // Description
    if(!data['result']['Left']['Desc'] == ''){
      chartlabels.push(data['result']['Left']['Desc']);
    }
    if(!data['result']['Right']['Desc'] == ''){
      chartlabels.push(data['result']['Right']['Desc']);
    }



  var ctx = document.getElementById('ChartHAndV').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
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
          ],borderWidth: 1}]},});




        }


  function changeChartAll(age,useData){

    age = document.getElementById("AllAge").value;
  let chartdata = [];
  let chartlabels = [];
  if(!useData == '0'){
    data = JSON.parse(chartData);
  }else{
    data = httpGet('./services/stats.php?pid=<?php echo $id; ?>&type=fvf&age='+age);
    data = JSON.parse(data);
    $('#ChartAll').replaceWith('<canvas id="ChartAll" width="100%" height="70%"></canvas>');
  }

  // Count
    if(!data['result']['Left']['All'] == 0){
      chartdata.push(data['result']['Left']['All']);
    }
    if(!data['result']['Right']['All'] == 0){
      chartdata.push(data['result']['Right']['All']);
    }

  // Description
    if(!data['result']['Left']['Desc'] == ''){
      chartlabels.push(data['result']['Left']['Desc']);
    }
    if(!data['result']['Right']['Desc'] == ''){
      chartlabels.push(data['result']['Right']['Desc']);
    }



  var ctx = document.getElementById('ChartAll').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
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
          ],borderWidth: 1}]},});




        }













function toggle(change,id) {
    if(change == true) {
            document.getElementById("text_submit"+id).innerHTML = "Casting...";
            document.getElementById("submit"+id).classList.add("disabled");
    } else {
            document.getElementById("text_submit"+id).innerHTML = "Choose";
            document.getElementById("submit"+id).classList.remove("disabled");
    }
}



function castVote(vote)
{
  toggle(true,vote)
  var formData = new FormData();
  formData.append('vote',vote);
  formData.append('id',<?php echo $id;?>);
  formData.append('type','fvf');
  ajax_post('./services/vote.php',formData, function(data) {

      if(data["success"]){
          document.getElementById("success"+vote).classList.remove("rem");
          document.getElementById("warning"+vote).classList.add("rem");
          document.getElementById("success"+vote).innerHTML = '&#x2705; Vote made successfully';
      } else {
          document.getElementById("success"+vote).classList.add("rem");
          document.getElementById("warning"+vote).classList.remove("rem");
          document.getElementById("submit"+vote).classList.add("disabled");
          document.getElementById("warning"+vote).innerHTML = '&#x274C; Error!';
      }
  });
  ajax_get('./services/checkVote.php?id=<?php echo $id; ?>&type=fvf', function(data) {
    toggle(false,1)
    toggle(false,2)
    var  vop
      if(data["status"]=='true'){
    if(data["vote"] == '1'){
    vop = 'Left';
    }else{
    vop = 'Right';
    }
          document.getElementById("vote_container1").innerHTML = '<br><h4 style="text-align: center;">You have voted "'+vop+'".</h4>';
            document.getElementById("vote_container2").innerHTML = '<br><h4 style="text-align: center;">You have voted "'+vop+'".</h4>';
}
if(data["status"]=='login'){
  document.getElementById("vote_container1").innerHTML = '<br><h4 style="text-align: center;">You have to be signed in to vote</h4>';
  document.getElementById("vote_container2").innerHTML = '<br><h4 style="text-align: center;">You have to be signed in to vote</h4>';
}

if(data["status"]=='ended'){
    document.getElementById("vote_container1").innerHTML = '<br><h4 style="text-align: center;">FvF Ended</h4>';
    document.getElementById("vote_container2").innerHTML = '<br><h4 style="text-align: center;">FvF Ended</h4>';
}})



}
function Delete(id)
{
ajax_get('./services/deleteFvf.php?id='+id, function(data) {


    window.location.replace("<?php echo $url;?>fvfs.php");

});
}
function timechanging(){
  var elements = document.getElementsByClassName("timeUTC");

  for(var i=0; i<elements.length; i++)
  {


    let utcTime = elements[i].innerHTML;
    elements[i].innerHTML = moment.utc(utcTime ).local().format('YYYY-MM-DD HH:mm A');

  }

}
window.onload = function()
{

timechanging();
  changeChartVa(0,chartData);
  changeChartH(0,chartData);
  changeChartV(0,chartData);
  changeChartN(0,chartData);
  changeChartHAndV(0,chartData);
  changeChartAll(0,chartData);

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


  ajax_get('./services/checkVote.php?id=<?php echo $id; ?>&type=fvf', function(data) {
    var  vop
    if(data["status"]=='true'){
  if(data["vote"] == '1'){
  vop = 'Left';
  }else{
  vop = 'Right';
  }
        document.getElementById("vote_container1").innerHTML = '<br><h4 style="text-align: center;">You have voted "'+vop+'".</h4>';
          document.getElementById("vote_container2").innerHTML = '<br><h4 style="text-align: center;">You have voted "'+vop+'".</h4>';
}
if(data["status"]=='login'){
document.getElementById("vote_container1").innerHTML = '<br><h4 style="text-align: center;">You have to be signed in to vote</h4>';
document.getElementById("vote_container2").innerHTML = '<br><h4 style="text-align: center;">You have to be signed in to vote</h4>';
}

if(data["status"]=='ended'){
  document.getElementById("vote_container1").innerHTML = '<br><h4 style="text-align: center;">FvF Ended</h4>';
  document.getElementById("vote_container2").innerHTML = '<br><h4 style="text-align: center;">FvF Ended</h4>';
}})



}


</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
