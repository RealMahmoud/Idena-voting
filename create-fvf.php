<?php
session_start();

include(dirname(__FILE__)."/common/_protected.php");
$pagetitle = 'Create FvF';
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
    <div class="row">
          <div class="col-12 col-sm-7">
          			<a class="btn btn-small btn-nav" href="./profile.php">
            		<i class="icon icon--thin_arrow_left"></i>
            		<span id="back">Back to Profile</span>
            		</a>
          </div>
    </div>
</section>


<section class="section section_main">
    <div class="row">
        <div class="col-auto">
            <div class="section_main__image" style="width: 7rem;height: 7rem;">
                <img src="https://robohash.org/<?php echo $_SESSION["username"]; ?>" alt="pic" width="80"/>
            </div>
        </div>
            <div class="col">
              <div class="section_main__group">
                    <h1 class="section_main__title"><a href="<?php echo $url.'profile.php?user='.$_SESSION["username"];?>"><?php echo $_SESSION["username"]; ?></a>


                  </h1>
                  </div>
                    <a class="btn btn-small btn-primary" href="https://scan.idena.io/address/<?php echo $_SESSION["addr"]; ?>" target="_blank">
                        <i class="icon icon--coins"></i><span>Address details on explorer</span>
                    </a>
                </div>
            </div>
</section>


<section class="section section_info">

    <div class="row">



          <div class="col-12 col-sm-3">
            <div class="card">
              <div>
                <div class="row">

                  <div class="col-12 col-sm-12 bordered-col">

                      <h4 class="info_block__accent">Credits</h4>
                      <p><?php echo $_SESSION["credits"]; ?></p>
                      <br/>
                      <h4 class="info_block__accent">Status</h4>
                      <p><?php echo $_SESSION["state"]; ?></p>
                      <br/>
                        <h4 class="info_block__accent">Age</h4>
                        <p><?php echo $_SESSION["age"]; ?></p>

                  </div>


                </div>
              </div>
            </div>
          </div>



          <div class="col-12 col-sm-9">
            <div class="card">
              <div>
                <div class="row">

                  <div class="col-12 col-sm-12 bordered-col">
                        <div class="warning rem" id="warning">
                        </div>
                        <div class="success rem" id="success">
                        </div>

                        <h4 class="info_block__accent">Start a new Flip Vs Flips</h4>
                        <form id="fvf_form" METHOD="POST" onsubmit="createfvf(); return false;">
                            <div class="input-group" style="width: 60%;">
                              <p>Title :</p><input name="title" id="title" class="formVal form-control" value="Round 1 Discord FvF"></input><br>
                              <p>Description :</p><textarea rows = "5" cols = "60"name="desc" id="desc" class="formVal form-control" value="">Round 1 .. Set vs BroBot</textarea><br>
                                <p>Category :</p><input name="category" id="category" class="formVal form-control" value="Idena"></input><br>
                          <br><p> Flip location 1 :</p><input type="text"name="location1" class="formVal form-control" value="https://i.ibb.co/VDzjqrm/windows-10-2018-insider-wallpaper.jpg">
                            <br><p> Flip location2 :</p><input type="text"name="location2" class="formVal form-control" value="https://i.ibb.co/VDzjqrm/windows-10-2018-insider-wallpaper.jpg">
                              <br>  <p> End Time :</p><input type="datetime-local"name="endtime" class="formVal form-control" value="<?php echo date('Y-m-d\TH:i',strtotime('+48 hours'));?>">
                            <br><p> Donations Address :</p><input type="text"name="fundaddr" class="formVal form-control" value="">
                            <br><span> VIP (costs 5 credits):  </span><input type="checkbox"id="vip" name="vip">


                            <input type="hidden" name="type" class="formVal" value="fvf"/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="createfvf(); return false;" style="margin-top: 1em;">
                                <span id="text_submit">Create fvf</span>
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

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script type="text/javascript">
function createfvf()
{
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }
    if(document.getElementById("vip").checked == true){

    formData.append("vip",'1');
  }else{
    formData.append("vip",'0');
  }
    ajax_post('./services/addFvf.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; FvF created successfully';

        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; '+data["data"];
        }
    });
}

function toggle(change) {
    if(change == true) {
            document.getElementById("text_submit").innerHTML = "Creating...";
            document.getElementById("submit").classList.add("disabled");
    } else {
            document.getElementById("text_submit").innerHTML = "Create fvf";
            document.getElementById("submit").classList.remove("disabled");
    }
}


</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
