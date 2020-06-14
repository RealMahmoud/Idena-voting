<?php
session_start();
if(!empty($_GET['logged'])){
  include(dirname(__FILE__)."/common/_protected.php");
}
$pagetitle = 'FAQ';
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_content menu_section_content menu_faq" id="faq">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6">

        <div class="section_header">
          <br><h3 class="info_block__accent" style="text-align:center;" class="h1">FAQ</h3>
          <p class="hint text-center">We are here to help to you. Browse through the most frequently asked questions. Can’t find an answer? contact me at
            <a href="https://t.me/RealMahmoud">@RealMahmoud</a>.
          </p>
          <p class="hint text-center"></p>
        </div>

<p>

        <br>


      </p><br><h3 class="info_block__accent" style="text-align:center;">Questions</h3>
        <div class="faq accordion" id="accordion">

          <div class="card">
            <div class="card-header" id="faq-pop-1">
              <a class="collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                What is credits ?
              </a>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="faq-pop-1" data-parent="#accordion">
              <div class="card-body">
                <p>
                  credits is a token that you can use to create polls , proposals and fvfs
                </p>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="faq-pop-2">
              <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Why i should pay to get credits ?
              </a>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="faq-pop-2" data-parent="#accordion">
              <div class="card-body">
                <p>
                  You don't have to pay dna to get credits As you get free credits daily based on your identity status
                </p>
                <p>
                  Human gets 5
                </p>
                <p>
                  Verified gets 3
                </p>
                <p>
                  Newbie gets 1
                </p>

              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="faq-pop-3">
              <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          What is FvF ?
              </a>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="faq-pop-3" data-parent="#accordion">
              <div class="card-body">
                <p>
                  Flip Vs Flip is a game where you compete with another person on creating best flip
                </p>


              </div>
            </div>
          </div>








        </div>


      </div>
    </div>
  </div>
</section>

<?php
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->
 </div>
</main>


<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
