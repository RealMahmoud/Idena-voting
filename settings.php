<?php
session_start();

include(dirname(__FILE__)."/common/_protected.php");
$pagetitle = 'Settings';
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
            <a href="<?php echo $url.'profile.php?user='.$_SESSION["username"];?>">
              <img src="https://robohash.org/<?php echo $_SESSION["pic"]; ?>" alt="pic" width="80"/>
            </a>
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



      <div class="col-12 col-sm-4">
        <div class="card">
          <div>
            <div class="row">

                <div class=" bordered-col">

                      <h4 class="info_block__accent">Credits</h4>
                      <p><?php echo $_SESSION["credits"]; ?></p>
                      <br/>
                      <h4 class="info_block__accent">Status</h4>
                      <p><?php echo $_SESSION["state"]; ?></p>
                      <br/>
                        <h4 class="info_block__accent">Age</h4>
                        <p><?php echo $_SESSION["age"]; ?></p>
                        <br/>
                        <h4 class="info_block__accent" >Current Secret Token</h4>
                        <p id="currST">  <?php echo $_SESSION["password"];?></p>
                        <br/>
                        <h4 class="info_block__accent">Current Hidden Status</h4>
                        <p id='hiddenlbl'><?php echo $_SESSION["hidden"];?></p>
                        <h4 class="info_block__accent">Current Pic</h4>
                        <p>  <?php echo $_SESSION["pic"];?></p>



                      </div>


                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-8">
              <div class="card">
                <div>
                  <div class="row">

                    <div class="col-12 col-sm-12 bordered-col">
                      <div class="warning rem" id="warning-username">
                      </div>
                      <div class="success rem" id="success-username">
                      </div>

                        <h4 class="info_block__accent">Change username :</h4>
                        <form id="name_form" METHOD="POST"onsubmit="changeName(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" maxlength="25" minlength="1" name="username" class="formValUsername form-control" value="" placeholder="your new username goes here..."/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit-username" onclick="changeName(); return false;" style="margin-top: 1em;">
                                <span id="text_submit-username"> Change</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>
                        <br>
                        <div class="warning rem" id="warning-ST">
                        </div>
                        <div class="success rem" id="success-ST">
                        </div>
                        <h4 class="info_block__accent">Change Secret Token : </h4>

                        <form id="name_form" METHOD="POST" onsubmit="changeST(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="hidden" maxlength="7" minlength="1" name="password" class="formValST form-control" value="confirm" placeholder=""/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit-ST" onclick="changeST(); return false;" style="margin-top: 1em;">
                                <span id="text_submit-ST">RESET Secret Token</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>


                        <br>
                        <div class="warning rem" id="warning-bio">
                        </div>
                        <div class="success rem" id="success-bio">
                        </div>
                        <h4 class="info_block__accent">Change Bio : </h4>

                        <form id="name_form" METHOD="POST" onsubmit="changeBio(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" maxlength="250" minlength="1" name="bio" class="formValBio form-control" value="" placeholder="Your new Bio goes here"/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit-bio" onclick="changeBio(); return false;" style="margin-top: 1em;">
                                <span id="text_submit-bio"> Change</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>
                        <br>
                        <div class="warning rem" id="warning-hidden">
                        </div>
                        <div class="success rem" id="success-hidden">
                        </div>
                        <h4 class="info_block__accent">Change address Hidden Status : </h4>



                            <div class="input-group">
                              <?php
                              if($_SESSION["hidden"] == 'public'){
                                echo '<a class="btn btn-secondary btn-small" href="#" id="submit-hidden-private" onclick="ChangeHidden('."'private'".'); return false;" style="margin-top: 1em;">
                                    <span id="text_submit-hidden-private">Make Private</span>
                                    <i class="icon icon--thin_arrow_right"></i>
                                </a>';
                              }else{
                                echo '<a class="btn btn-secondary btn-small" href="#" id="submit-hidden-public" onclick="ChangeHidden('."'public'".'); return false;" style="margin-top: 1em;">
                                    <span id="text_submit-hidden-public">Make Public</span>
                                    <i class="icon icon--thin_arrow_right"></i>
                                </a>';
                              }

                            ?>
                            </div>




                        <br>
                        <div class="warning rem" id="warning-donate">
                        </div>
                        <div class="success rem" id="success-donate">
                        </div>
                        <h4 class="info_block__accent">Change Donation Address : </h4>

                        <form id="name_form" METHOD="POST" onsubmit="changedonate(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" maxlength="42" minlength="1" name="donate" class="formValDonate form-control" value="" placeholder="Please type the new address"/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit-donate" onclick="changedonate(); return false;" style="margin-top: 1em;">
                                <span id="text_submit-donate"> Change</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>

                        <br>
                                                <h4 class="info_block__accent">Change Profile Pic : </h4>
                                                <a class="btn btn-secondary btn-small" href="./profilePicChanger.php"  style="margin-top: 1em;">
                                                    <span >Change</span>
                                                    <i class="icon icon--thin_arrow_right"></i>
                                                </a>
                        <br>




                  </div>

                </div>
              </div>
            </div>
          </div>

    </div><!-- row end -->

</section>



 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script type="text/javascript">
function changeName()
{
    toggle(true,'username');
    var elements = document.getElementsByClassName("formValUsername");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/changeUsername.php', formData, function(data) {
        toggle(false,'username');
        if(data["success"]){
            document.getElementById("success-username").classList.remove("rem");
            document.getElementById("warning-username").classList.add("rem");
            document.getElementById("success-username").innerHTML = '&#x2705; username changed successfully';

        } else {
            document.getElementById("success-username").classList.add("rem");
            document.getElementById("warning-username").classList.remove("rem");
            document.getElementById("warning-username").innerHTML = '&#x274C; '+data["data"];
        }
    });
}

function changedonate()
{
    toggle(true,'donate');
    var elements = document.getElementsByClassName("formValDonate");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/changeDonate.php', formData, function(data) {
        toggle(false,'donate');
        if(data["success"]){
            document.getElementById("success-donate").classList.remove("rem");
            document.getElementById("warning-donate").classList.add("rem");
            document.getElementById("success-donate").innerHTML = '&#x2705; Donate Address changed successfully';

        } else {
            document.getElementById("success-donate").classList.add("rem");
            document.getElementById("warning-donate").classList.remove("rem");
            document.getElementById("warning-donate").innerHTML = '&#x274C; '+data["data"];
        }
    });
}
function ChangeHidden(value)
{

var formData = new FormData();
    formData.append('hidden', value);
    document.getElementById("text_submit-hidden-"+value).innerHTML = "Changing...";
    document.getElementById("submit-hidden-"+value).classList.add("disabled");
    ajax_post('./services/changeHidden.php', formData, function(data) {

        if(data["success"]){
            document.getElementById("success-hidden").classList.remove("rem");
            document.getElementById("warning-hidden").classList.add("rem");
            document.getElementById("success-hidden").innerHTML = '&#x2705; address hidden Status changed successfully';
            document.getElementById("hiddenlbl").innerHTML = value;

        } else {
            document.getElementById("success-hidden").classList.add("rem");
            document.getElementById("warning-hidden").classList.remove("rem");
            document.getElementById("warning-hidden").innerHTML = '&#x274C; '+data["data"];
        }
        document.getElementById("text_submit-hidden-"+value).innerHTML = "Change To "+value;
        document.getElementById("submit-hidden-"+value).classList.remove("disabled");
    });
}

function changeST()
{
    toggle(true,'ST');
    var elements = document.getElementsByClassName("formValST");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/changeST.php', formData, function(data) {
        toggle(false,'ST');
        if(data["success"]){
            document.getElementById("success-ST").classList.remove("rem");
            document.getElementById("warning-ST").classList.add("rem");
            document.getElementById("currST").innerHTML = data["ST"];
            document.getElementById("success-ST").innerHTML = '&#x2705; Your new Secret Token is : '+data["ST"];

        } else {
            document.getElementById("success-ST").classList.add("rem");
            document.getElementById("warning-ST").classList.remove("rem");

            document.getElementById("warning-ST").innerHTML = '&#x274C; '+data["data"];
        }
    });
}

function changeBio()
{
    toggle(true,'bio');
    var elements = document.getElementsByClassName("formValBio");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/changeBio.php', formData, function(data) {
        toggle(false,'bio');
        if(data["success"]){
            document.getElementById("success-bio").classList.remove("rem");
            document.getElementById("warning-bio").classList.add("rem");
            document.getElementById("success-bio").innerHTML = '&#x2705; Bio changed successfully';

        } else {
            document.getElementById("success-bio").classList.add("rem");
            document.getElementById("warning-bio").classList.remove("rem");
            document.getElementById("warning-bio").innerHTML = '&#x274C; '+data["data"];
        }
    });
}





function toggle(change,k) {
    if(change == true) {
            document.getElementById("text_submit-"+k).innerHTML = "Changing...";
            document.getElementById("submit-"+k).classList.add("disabled");
    } else {
            document.getElementById("text_submit-"+k).innerHTML = "Change";
            document.getElementById("submit-"+k).classList.remove("disabled");
    }
}


</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
