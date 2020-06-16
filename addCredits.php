<?php
session_start();

include(dirname(__FILE__)."/common/_protected.php");
$pagetitle = 'Add Credits';
include(dirname(__FILE__)."/partials/header.php");
?>
<section class="section section_info">

            <div class="card" id="empty_card" style="text-align:center;height:60vh">

              <h4 class="info_block__accent">Add Credits - (You have <?php echo $_SESSION['credits'];?> credits)</h4>
              <br>
              <h6 >Current price 1 DNA = 4 credits</h6>
              <br>

              <form id="fvf_form" METHOD="POST" onsubmit="addCredits(); return false;"style="margin-left:20%;margin-right:20%;">
                  <div class="input-group">
                    <p>Credits Amounts</p><input id="amount"type="number"style="text-align:center;" class="formVal form-control" value="1"></input><br>

                  </div>
                  <div class="input-group">
                  <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="addCredits(); return false;">
                      <span id="text_submit">Add Credits</span>
                      <i class="icon icon--thin_arrow_right"></i>
                  </a>
                  </div>

              </form>
</div>



</section>



 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script>
function addCredits()
{



            setTimeout(() => {  window.location.replace("dna://send/v1?address=0xa27da2afe2c8e9866ea143b7f495868346090007&amount="+document.getElementById("amount").value+"&comment=<?php echo $_SESSION['addr']; ?>"); }, 250);






}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
