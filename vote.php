<?php
$pagetitle = 'Vote for idena.vote';
include(dirname(__FILE__)."/partials/header.php");
?>
<section class="section section_info">

            <div class="card" id="empty_card" style="text-align:center;height:60vh">

              <form  onsubmit="SendDna(); return false;"style="margin-left:20%;margin-right:20%;">
                <br>
                <br>
                <br>
                <br>
                  <p class="info_block__accent">Please support Idena.vote by voting for it by sending a 0 SendTx with this button</p>
                  <div style="padding-top:10vh;"class="input-group">
                  <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="SendDna(); return false;">
                      <span id="text_submit">VOTE ON Idena.vote</span>

                  </a>
                  </div>

              </form>
</div>



</section>



 <!-- this is to close main, div opened in the header -->
 </div>
</main>

<script>
function SendDna()
{


          setTimeout(() => {  window.location.replace("dna://send/v1?address=0x4246e99d7D3951412CCbFc45e3EBdD37545e14e2&amount=0&comment=idena.vote")});

  }



window.onload = function() {SendDna();}
</script>
<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
