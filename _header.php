<div class="container">
<div class="row justify-content-between align-items-center">

<div class="col-auto">
<div class="header_logo">
<a href="/"><img src="images//idena-logo.svg" alt="Idena" width="87x" /></a>
</div>
<?php echo $site_name; ?>
</div>

<div class="col">
    <form action="" class="form_search">
        <div class="input-group">
            <div class="input-addon">
                <button type="submit" class="btn btn-icon"><i class="icon icon--search"></i></button>
            </div>
            <input type="search" value="" placeholder="Votings, projects, polls, users" class="form-control" />
        </div>
    </form>
</div>



<?php if(0==1) { ?>
<div class="col-auto">

<div class="dropdown">
<button src="https://robohash.org/0xcbb98843270812eece07bfb82d26b4881a33aa91" alt="pic" width="80"/>
  
  
  <ul class="dropdown-menu">
    <li><a href="#">New voting/project</a></li>
    <li><a href="#">New poll</a></li>
	 <li class="divider"></li> 
    <li><a href="#">Settings</a></li>
    <li><a href="#">Log out</a></li>
  </ul>
</div> 




<!--
<div class="user-pic" id="currentUser">


<ul class="dropdown-menu">
<li>
<button id="MyAddressMenu" type="button" class="btn btn-small btn-icon">
<span></span>
</button>
</li>
<li class="brake"></li>
<li>
<button id="LogOutMenu" type="button" class="btn btn-small btn-icon" >
<span></span>
</button>
</li>
</ul>

</div>
-->





</div>
<?php } else { ?>

<div class="col-auto">
<a id="SignInWithIdena" href="signin.php" type="button" class="btn btn-signin">
<img alt="signin" class="icon icon-logo-white-small" width="24px" />
<div class="spinner hidden">
<div class="small progress"><div></div></div>
</div>
<span>Sign-in with Idena</span>
</a>
</div>

<?php } ?>


</div>







<!-- ORIGINAL
<div class="col-auto">
    <a class="btn btn-signin" href="/signin?callback_url=%2F&amp;attempt=1">
        <img alt="signin" class="icon icon-logo-white-small" width="24px" />
        <div class="spinner hidden">
            <div class="small progress"><div></div></div>
        </div>
        <span>Sign-in with Idena</span>
    </a>
</div>
-->