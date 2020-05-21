<?php
session_start();
include(dirname(__FILE__)."/common/_config.php");
include(dirname(__FILE__)."/common/protected.php");
include(dirname(__FILE__)."/partials/header.php");
?>

<section class="section section_info">
    <div class="row">
          <div class="col-12 col-sm-7">
          			<a class="btn btn-small btn-nav" href="./polls.php">
            		<i class="icon icon--thin_arrow_left"></i>
            		<span id="back">Back to Polls</span>
            		</a>
          </div>
    </div>
</section>


<?php
$id = $conn->real_escape_string($_GET["id"]);
$sql = "SELECT * FROM `polls` WHERE `id` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

?>


<section class="section section_info">

    <div class="row">
        
          
          
          <div class="col-12 col-sm-12">
            <div class="card">
              <div>
                <div class="row">
                  
                  <div class="col-12 col-sm-7 bordered-col">
                        <h4 class="info_block__accent">Added by</h4>
                        <p style="vertical-align: middle;">
                            <img class="user-avatar" src="https://robohash.org/<?php echo  $row['addr'] ?>" alt="pic" width="40" style="margin-right: 1em;background: #f5f6f7;" />
                            <?php echo  $row['addr'] ?>
                        </p>
                        <br>
                        <h4>Description</h4>
                        <p><?php echo  $row['pdesc'] ?></p>
                        <br/>
                  </div>
                  
                  
                  <div class="col-12 col-sm-5 bordered-col">
                        <div class="warning rem" id="warning">
                        </div>
                        <div class="success rem" id="success">
                        </div>
                        
                        <h4 class="info_block__accent">Add your vote below</h4>
                        <div id="vote_container">
                                <form id="vote_form" METHOD="POST">
                                    <div class="input-group" style="width: 60%;">
                                        Yes: <input type="radio" class="formVal" name="vote" value="0" checked/><br>
                                        No: <input type="radio" class="formVal" name="vote" value="1"/>
                                    </div>
                                    
                                        <input type="hidden" class="formVal" name="id" value="<?php echo  $row['id'] ?>"/>
                                        <input type="hidden" class="formVal" name="type" value="poll"/>
                    
                                    <div class="input-group">
                                    <a class="btn btn-secondary btn-small" href="#" id="submit" onclick="changeVote(); return false;" style="margin-top: 1em;">
                                        <span id="text_submit">Cast My Vote</span>
                                        <i class="icon icon--thin_arrow_right"></i>
                                    </a>
                                    </div>
                              
                                </form>
                        </div>
                        
                  </div>

                </div>
              </div>
            </div>
          </div>
        
    </div><!-- row end -->
    
</section>


<?php 
      
  } //while loop ends

} ?>


<?php 
include(dirname(__FILE__)."/partials/donation.php");
?>

 <!-- this is to close main, div opened in the header -->     
 </div>
</main>

<script>
function toggle(change) {
    if(change == true) {
            document.getElementById("text_submit").innerHTML = "Casting...";
            document.getElementById("submit").classList.add("disabled");
    } else {
            document.getElementById("text_submit").innerHTML = "Cast my Vote";
            document.getElementById("submit").classList.remove("disabled");   
    }
}

function changeVote()
{
    toggle(true);
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData(); 
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }
    
    ajax_post('./services/vote.php', formData, function(data) {
        toggle(false);
        if(data["success"]){
            document.getElementById("success").classList.remove("rem");
            document.getElementById("warning").classList.add("rem");
            document.getElementById("success").innerHTML = '&#x2705; Vote made successfully';
        } else {
            document.getElementById("success").classList.add("rem");
            document.getElementById("warning").classList.remove("rem");
            document.getElementById("submit").classList.add("disabled");
            document.getElementById("warning").innerHTML = '&#x274C; Your have already voted on this!';
        }
    });
}

window.onload = function() 
{
    ajax_get('./services/checkvote.php?id=<?php echo $id; ?>', function(data) {
        if(data["status"]=='voted'){
            if(data["vote"]==1){ var votelng = 'yes'; } else { var votelng = 'no'; }
            document.getElementById("vote_container").innerHTML = '<p>You have voted '+votelng+'.</p>';
        }
    });
}


</script>
<?php 
include(dirname(__FILE__)."/partials/footer.php");
?>