<?php
session_start();
include(dirname(__FILE__)."/common/_protected.php");

$pagetitle = 'Profile Pic Randomizer';
include(dirname(__FILE__)."/partials/header.php");

?>

<section class="section section_info">





            <div class="card" id="empty_card" style="text-align:center;height:80vh">

                         <h4 class="info_block__accent"style="margin-top: 3em;">Profile Pic Randomizer</h4>

                           <img style="border-radius: 50%; background-color:#ffffff"src="https://robohash.org/<?php echo $_SESSION['pic'];?>" id="pic" alt="Idena" width="120px" style="">
                           <br>
                           <br>

                         <form id="name_form" METHOD="POST" onsubmit="changePic(); return false;">
                           <div class="warning rem" id="warning">
                           </div>
                           <div class="success rem" id="success">
                           </div>
                             <div class="input-group" style="width: 30%;margin: 0 auto;">
                                 <input type="text" id="hash" class="formVal form-control" oninput="changePic();"value="<?php echo $_SESSION['pic'];?>" placeholder="hash"/>
                             </div>

                             <div class="input-group">
                               <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="newProfilePic(); return false;" style="margin-top: 1em;">
                                   <span id="text_submit">Save</span>

                               </a>
                               <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="random(); return false;" style="margin-top: 1em;">
                                   <span id="text_submit">Randomize</span>

                               </a>
                             </div>

                         </form>
            </div>




</section>
<script>
function changePic()
{
  if(!document.getElementById("hash").value == ''){
      document.getElementById("pic").src = 'https://robohash.org/' + document.getElementById("hash").value;
  }
}
function random(){
  var newdata = Math.random().toString(36).substr(2, 20);
 document.getElementById("pic").src = 'https://robohash.org/' + newdata;
 document.getElementById("hash").value = newdata;
}

function newProfilePic()
{

var formData = new FormData();
    formData.append('pic', document.getElementById("hash").value);
    document.getElementById("headerPic").src = 'https://robohash.org/' + document.getElementById("hash").value;
    ajax_post('./services/changePic.php', formData, function(data) {

        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Profile Pic changed successfully';

        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; '+ data["data"];
        }
    });
}

</script>


 <!-- this is to close main, div opened in the header -->
 </div>
</main>


<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
