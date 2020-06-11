<?php
session_start();

include(dirname(__FILE__)."/common/protected.php");
$pagetitle = 'Settings';
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
    <div class="row">
          <div class="col-12 col-sm-7">
          			<a class="btn btn-small btn-nav" href="./myprofile.php">
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



          <div class="col-12 col-sm-12">
            <div class="card">
              <div>
                <div class="row">

                    <div class="col-12 col-sm-3 bordered-col">

                      <h4 class="info_block__accent">Credits</h4>
                      <p><?php echo $_SESSION["credits"]; ?></p>
                      <br/>
                      <h4 class="info_block__accent">Status</h4>
                      <p><?php echo $_SESSION["state"]; ?></p>
                      <br/>
                        <h4 class="info_block__accent">Age</h4>
                        <p><?php echo $_SESSION["age"]; ?></p>
                        <br/>
                        <h4 class="info_block__accent">Current Secret Token</h4>
                        <p>  <?php echo $_SESSION["password"];?></p>
                        <br/>
                        <h4 class="info_block__accent">Current Hidden Status</h4>
                        <p>  <?php echo $_SESSION["hidden"];?></p>



                  </div>

                  <div class="col-12 col-sm-9 bordered-col">
                        <div class="warning rem" id="warning">
                        </div>
                        <div class="success rem" id="success">
                        </div>

                        <h4 class="info_block__accent">Change username</h4>
                        <form id="name_form" METHOD="POST"onsubmit="changeName(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" name="username" class="formVal form-control" value="" placeholder="your new username goes here..."/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeName(); return false;" style="margin-top: 1em;">
                                <span id="text_submit"> Change</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>
                        <br>

                        <h4 class="info_block__accent">Change Secret Token : </h4>

                        <form id="name_form" METHOD="POST" onsubmit="changeST(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" name="password" class="formVal form-control" value="" placeholder="Please type confirm"/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeST(); return false;" style="margin-top: 1em;">
                                <span id="text_submit"> Change</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>



                        <br>

                        <h4 class="info_block__accent">Change Bio : </h4>

                        <form id="name_form" METHOD="POST" onsubmit="changeBio(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" name="bio" class="formVal form-control" value="" placeholder="Your new Bio goes here"/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeBio(); return false;" style="margin-top: 1em;">
                                <span id="text_submit"> Change</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>
                        <br>

                        <h4 class="info_block__accent">Change Account Hidden Status : </h4>

                        <form id="name_form" METHOD="POST" onsubmit="changeH(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" name="hidden" class="formVal form-control" value="" placeholder="Please type true or false"/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeH(); return false;" style="margin-top: 1em;">
                                <span id="text_submit"> Change</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>

                        </form>
                        <br>

                        <h4 class="info_block__accent">Add Credits : </h4>

                        <form id="name_form" METHOD="POST" onsubmit="addCredits(); return false;">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" name="amount" class="formVal form-control" id='amount'value="" placeholder="Please type the amount"/>
                            </div>

                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="addCredits(); return false;" style="margin-top: 1em;">
                                <span id="text_submit"> Add</span>
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
function changeName()
{
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/changeusername.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; username changed successfully';
            checkusername();
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; Something went wrong. Please try again';
        }
    });
}
function changeST()
{
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/changeST.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; The Secret Token changed successfully';
            checkusername();
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; Something went wrong. Please try again';
        }
    });
}

function changeBio()
{
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/changeBio.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Bio changed successfully';
            checkusername();
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; Something went wrong. Please try again';
        }
    });
}

function addCredits()
{
    setTimeout(() => {  window.location.replace("dna://send/v1?address=0xa27da2afe2c8e9866ea143b7f495868346090007&amount="+document.getElementById("amount").value+"&comment=<?php echo $_SESSION['addr']; ?>"); }, 500);

}



function toggle(change) {
    if(change == true) {
            document.getElementById("text_submit").innerHTML = "Changing...";
            document.getElementById("submit").classList.add("disabled");
    } else {
            document.getElementById("text_submit").innerHTML = "Change";
            document.getElementById("submit").classList.remove("disabled");
    }
}

function checkusername() {
    ajax_get('./services/checkusername.php?addr=<?php echo $_SESSION["addr"]; ?>', function(data) {
            document.getElementById("user_name").innerHTML = data["username"];
    });
}
window.onload = function() {
checkusername();
}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
