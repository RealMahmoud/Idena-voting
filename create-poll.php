<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/common/protected.php");
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
                <img src="https://robohash.org/<?php echo $addr; ?>" alt="pic" width="80"/>
            </div>
        </div>
            <div class="col">
                <div class="section_main__group">
                    <h1 class="section_main__title">
                        <?php echo $addr; ?>
                        <span class="badge badge-secondary" id="nick_name">Loading...</span>
                    </h1>
                    </div>
                    <a class="btn btn-small btn-primary" href="https://scan.idena.io/address/<?php echo $addr; ?>" target="_blank">
                        <i class="icon icon--coins"></i><span>Address details on explorer</span>
                    </a>
                </div>
            </div>
</section>


<section class="section section_info">

    <div class="row">
<<<<<<< HEAD



=======
        
          
          
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
          <div class="col-12 col-sm-3">
            <div class="card">
              <div>
                <div class="row">
<<<<<<< HEAD

=======
                    
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
                    <div class="col-12 col-sm-12 bordered-col">
                        <h4 class="info_block__accent">Status</h4>
                        <p><?php echo $state; ?></p>
                        <br/>
                        <h4 class="info_block__accent">Age</h4>
                        <p><?php echo $age; ?></p>
                    </div>
<<<<<<< HEAD

=======
                  
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1

                </div>
              </div>
            </div>
          </div>
<<<<<<< HEAD



=======
          
          
          
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
          <div class="col-12 col-sm-9">
            <div class="card">
              <div>
                <div class="row">
<<<<<<< HEAD

=======
                  
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
                  <div class="col-12 col-sm-12 bordered-col">
                        <div class="warning rem" id="warning">
                        </div>
                        <div class="success rem" id="success">
                        </div>
<<<<<<< HEAD

                        <h4 class="info_block__accent">Start a new poll</h4>
                        <form id="poll_form" METHOD="POST">
                            <div class="input-group" style="width: 60%;">
                            <p>Description :</p><input type="text" name="desc" id="desc" class="formVal form-control" value="Do you like Cookies ?" placeholder="Will DNA beat BTC?"required/>
                          <br>  <p> DeadLine :</p><input type="datetime-local"name="endtime" class="formVal form-control" value="<?php echo date('Y-m-d\TH:i',strtotime('+12 hours'));?>">
                            <br><p> Option 1 :</p><input type="text"name="option1" class="formVal form-control" value="Yes">
                            <br><p> Option 2 :</p><input type="text"name="option2" class="formVal form-control" value="No">
                            <br><p> Option 3 :</p><input type="text"name="option3" class="formVal form-control" value="">
                            <br><p> Option 4 :</p><input type="text"name="option4" class="formVal form-control" value="">
                            <br><p> Option 5 :</p><input type="text"name="option5" class="formVal form-control" value="">
                            <br><p> Option 6 :</p><input type="text"name="option6" class="formVal form-control" value="">
                            <input type="hidden" name="type" class="formVal" value="poll"/>
                            </div>

=======
                        
                        <h4 class="info_block__accent">Start a new poll</h4>
                        <form id="poll_form" METHOD="POST">
                            <div class="input-group" style="width: 60%;">
                                <input type="text" name="desc" id="desc" class="formVal form-control" value="" placeholder="Will DNA beat btc?"/>
                                <input type="hidden" name="type" class="formVal" value="poll"/>
                            </div>
                            
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
                            <div class="input-group">
                            <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="createPoll(); return false;" style="margin-top: 1em;">
                                <span id="text_submit">Create Poll</span>
                                <i class="icon icon--thin_arrow_right"></i>
                            </a>
                            </div>
<<<<<<< HEAD

                        </form>

=======
                      
                        </form>
                        
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
                  </div>

                </div>
              </div>
            </div>
          </div>
<<<<<<< HEAD

    </div><!-- row end -->

</section>

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
=======
        
    </div><!-- row end -->
    
</section>

<?php 
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->     
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
 </div>
</main>

<script type="text/javascript">
function createPoll()
{
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
<<<<<<< HEAD
    var formData = new FormData();
=======
    var formData = new FormData(); 
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }
<<<<<<< HEAD

=======
    
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
    ajax_post('./services/addpoll.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Poll created successfully';
            checkusername();
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; Something went wrong. Please try again';
        }
    });
}

function toggle(change) {
    if(change == true) {
            document.getElementById("text_submit").innerHTML = "Creating...";
            document.getElementById("submit").classList.add("disabled");
    } else {
            document.getElementById("text_submit").innerHTML = "Create Poll";
<<<<<<< HEAD
            document.getElementById("submit").classList.remove("disabled");
=======
            document.getElementById("submit").classList.remove("disabled");   
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
    }
}
function checkusername() {
    ajax_get('./services/checkusername.php', function(data) {
            document.getElementById("nick_name").innerHTML = data["nickname"];
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.add("rem");
    });
}
window.onload = function() {
checkusername();
}
</script>
<<<<<<< HEAD
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
=======
<?php 
include(dirname(__FILE__)."/partials/footer.php");
?>
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
