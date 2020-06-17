<?php
session_start();
if(isset($_SESSION["addr"])) {
include(dirname(__FILE__)."/common/_protected.php");
}else{
  include(dirname(__FILE__)."/common/_public.php");
}

$pagetitle = 'ST Login';
include(dirname(__FILE__)."/partials/header.php");

?>

<section class="section section_info">





            <div class="card" id="empty_card" style="text-align:center;height:60vh">

                         <h4 class="info_block__accent"style="margin-top: 3em;">Login With Secret Token</h4>
                         <h6 >You can get your secret token from settings</h6>
                         <br>
                         <form id="name_form" METHOD="POST" onsubmit="STLogin(); return false;">
                           <div class="warning rem" id="warning">
                           </div>
                           <div class="success rem" id="success">
                           </div>
                             <div class="input-group" style="width: 60%;margin: 0 auto;">
                                 <input name="password" type="text"class="formVal form-control" value="" placeholder="Your secret token goes here..."/>
                             </div>

                             <div class="input-group">
                             <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="STLogin(); return false;" style="margin-top: 1em;">
                                 <span id="text_submit">Login</span>
                                 <i class="icon icon--thin_arrow_right"></i>
                             </a>
                             </div>

                         </form>
            </div>




</section>
<script>
function STLogin()
{
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData();
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }

    ajax_post('./services/stAuth.php', formData, function(data) {

        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Logged in successfully';
            setTimeout(() => {  window.location.replace("<?php echo $url;?>"); }, 2000);

        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("warning").innerHTML = '&#x274C; '+data["data"];
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
