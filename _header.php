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

<!--
<div class="col-auto">
<div class="user-pic hidden" id="currentUser">
<img class="user-avatar" src="" alt="pic" width="40" />
<ul class="dropdown-menu">
<li>
<button id="MyAddressMenu" type="button" class="btn btn-small btn-icon">
<span>My address</span>
</button>
</li>
<li class="brake"></li>
<li>
<button id="LogOutMenu" type="button" class="btn btn-small btn-icon" >
<span>Log out</span>
</button>
</li>
</ul>
</div>
-->

<a id="SignInWithIdena" href="signin.php" type="button" class="btn btn-signin">
<img alt="signin" class="icon icon-logo-white-small" width="24px" />
<div class="spinner hidden">
<div class="small progress"><div></div></div>
</div>
<span>Sign-in with Idena</span>
</a>

</div>

</div>
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