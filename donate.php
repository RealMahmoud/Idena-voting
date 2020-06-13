<?php
session_start();

include(dirname(__FILE__)."/common/protected.php");
if(isset($_GET['user'])){
$usernamea = $_GET['user'];
}

if(empty($usernamea)){
  header("location:./404.php");
}
$pagetitle = 'Send Donations';
include(dirname(__FILE__)."/partials/header.php");
?>
<section class="section section_info">

            <div class="card" id="empty_card" style="text-align:center;height:60vh">

              <h4 class="info_block__accent">Donate DNA To : <?php echo $usernamea?></h4>
              <div class="warning rem" id="warning">
              </div>
              <div class="success rem" id="success">
              </div>
              <form id="fvf_form" METHOD="POST" onsubmit="SendDna(); return false;"style="margin-left:20%;margin-right:20%;">
                  <div class="input-group">
                    <p>Amount</p><input id="amount"type="number" class="formVal form-control" value="1"></input><br>
                    <p>Comment</p><input id="comment" class="formVal form-control" value="Hello ,<?php echo $usernamea;?> I have just sent you some DNA"></input><br>
                  </div>
                  <div class="input-group">
                  <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="SendDna(); return false;">
                      <span id="text_submit">Donate</span>
                      <i class="icon icon--thin_arrow_right"></i>
                  </a>
                  </div>

              </form>
</div>



</section>

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script>
function SendDna()
{

      ajax_get('./services/checkDonate.php?user=<?php echo $usernamea; ?>', function(data) {
        if(data['donateAddress'].length == 42){
          setTimeout(() => {  window.location.replace("dna://send/v1?address="+data['donateAddress']+"&amount="+document.getElementById("amount").value+"&comment="+document.getElementById("comment").value); }, 250);
        }else{

          document.getElementById("success").classList.add("rem");
          document.getElementById("warning").classList.remove("rem");
          document.getElementById("warning").innerHTML = '&#x274C; Something went wrong. Please try again';
        }

      });



}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
