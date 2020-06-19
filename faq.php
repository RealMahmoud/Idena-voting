<?php
session_start();
if(isset($_SESSION["addr"])) {
include(dirname(__FILE__)."/common/_protected.php");
}else{
  include(dirname(__FILE__)."/common/_public.php");
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
                What are credits?
              </a>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="faq-pop-1" data-parent="#accordion">
              <div class="card-body">
                <p>
                  Credits are a token that you can use to create polls, proposals and fvf's.
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
                You don't have to pay DNA to get credits as you get free credits daily based on your identity status:
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


          <div class="card">
            <div class="card-header" id="faq-pop-4">
              <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
What are proposals?
              </a>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="faq-pop-4" data-parent="#accordion">
              <div class="card-body">
                <p>Proposal is a type of poll where you get:</p>
  <p>1. Two options to vote on/p>
  <p>2. An option to add a donation/funding address</p>
  <p>3. Required funding amount option</p>



              </div>
            </div>
          </div>


          <div class="card">
            <div class="card-header" id="faq-pop-5">
              <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
Why my profile pic is not like the one at explorer ?
              </a>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="faq-pop-5" data-parent="#accordion">
              <div class="card-body">

  <p> it's changed due that You have the option to hide your address instead of being public ..and the profile pic depends on the address SO it here don't depend on that 😅 </p>



              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="faq-pop-6">
              <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
Is the credits going to increase everyday ?
              </a>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="faq-pop-6" data-parent="#accordion">
              <div class="card-body">

  <p> If you are human then your credits amount will be set to  5 if your credits is lower than 5 ( Daily )
and so on for each validated user ( newbie , verified , human)  </p>



              </div>
            </div>
          </div>


          <div class="card">
            <div class="card-header" id="faq-pop-7">
              <a class="collapsed" data-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
what is donate button ?
              </a>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="faq-pop-7" data-parent="#accordion">
              <div class="card-body">

  <p>  It's added so users can accept DNA and without revealing your address  - You can add the donation address at settings  </p>



              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="faq-pop-8">
              <a class="collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
How can i make my address public ?
              </a>
            </div>
            <div id="collapseEight" class="collapse" aria-labelledby="faq-pop-8" data-parent="#accordion">
              <div class="card-body">

  <p>  Just go to the settings and you will find a button to change the status from one to another </p>



              </div>
            </div>
          </div>








        </div>


      </div>
    </div>
  </div>
</section>


 <!-- this is to close main, div opened in the header -->
 </div>
</main>


<?php
include(dirname(__FILE__)."/partials/footer.php");
?>
