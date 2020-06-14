<!doctype html>
<html lang="en">
<head>
  <meta charSet="UTF-8"/>
  <title id="title"><?php echo $pagetitle;?></Title>

  <meta http-equiv="X-UA-Compatible" content="chrome=1"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="Idena is novel way to create anonymous identity on blockchain.The Idena blockchain is driven by proof-of-person consensus: Every node is linked to a cryptoidentity, one single person with equal voting power."/>


  <link rel="shortcut icon" href="./favicon.ico"/>

  <link rel="apple-touch-icon" sizes="180x180" href="./images/apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png"/>

  <link rel="icon" type="image/png" sizes="192x192" href="./images/android-chrome-192x192.png"/>
  <link rel="icon" type="image/png" sizes="256x256" href=".images/android-chrome-256x256.png"/>
  <meta name="msapplication-TileColor" content="#2456ec"/>
  <meta name="theme-color" content="#ffffff"/>

  <meta property="og:image:width" content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:image" content="./images/og_image.jpg"/>
  <meta property="og:title" content=""/>
  <meta name="description" content=""/>
  <meta property="og:description" content=""/>
  <script src="./js/Chart.min.js"></script>
		<script src="./js/Chart.js"></script>
	<script src="./js/utils.js"></script>
  <link href="./css/index.css" rel="stylesheet"/>
  <link href="./css/styles.css" rel="stylesheet"/>
  <link href="./css/dark-mode.css" rel="stylesheet"/>
  <link href="./css/emoji.css" rel="stylesheet"/>


</head>

<body>
<header class="header">
  <div class="container">
    <div class="row justify-content-between align-items-center">


      <div class="col-auto">
        <div class="dropdown">
        <div class="header_logo">
          <a class="" href="./">
            <img   src="./images/idena-logo.svg" alt="Idena" width="40px">
          </a>
        </div>


      </div>
</div>
<style type="text/css">

#share-buttons img {
width: 35px;
padding: 5px;
border: 0;
box-shadow: 0;
display: inline;
}

</style>
<style>
input[type=text] {
  width: 100%;
  -webkit-transition: width 0.6s ease-in-out;
  justify-content: center;
    align-items: center;
    transition: 0.6s ease-in-out;

   border-radius: 40px;

}

/* When the input field gets focus, change its width to 100% */
input[type=text]:hover {
  width: 100%;
}
/* Dropdown Button */
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
<div class="col-auto">
<li class="nav-item header_nav__item">
<a class="nav-link header_nav__link appslink" href="./polls.php" title="Polls" descriptioncontent="
Polls">
Polls
</a>
</li>

<li class="nav-item header_nav__item">
            <a class="nav-link header_nav__link appslink"href="./proposals.php" title="Proposals" descriptioncontent="Proposals">
              Proposals
            </a>
          </li>
          <li class="nav-item header_nav__item">
            <a class="nav-link header_nav__link appslink" href="./fvfs.php" title="Flip Vs Flip" descriptioncontent="Flip Vs Flip">
              FvFs
            </a>
          </li>
          <li class="nav-item header_nav__item">
            <a class="nav-link header_nav__link appslink" href="./faq.php" title="FAQ" descriptioncontent="FAQ">
              FAQ
            </a>
          </li>


</div>


        <!-- search bar ends -->
  <div class="col-auto">
        <?php if(!empty($_SESSION["addr"])) {
        ?>

          <div class="btn-group">
              <a href=" " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div  class="user-pic" style="margin-right: 0px;">
                      <img  class="user-avatar" src="https://robohash.org/<?php echo $_SESSION["username"]; ?>" alt="pic" width="40">
                      </div>
              </a>

              <div class="dropdown-menu" aria-hidden="true" role="menu">

                <li>
                    <a class="btn btn-small" href="./profile.php"><span>My Profile</span></a>
                </li>
                <li class="brake"></li>
                <li>
                    <a class="btn btn-small" href="./addCredits.php"><span>Add Credits</span></a>
                </li>
                <li class="brake"></li>
                    <li>
                        <a class="btn btn-small" href="./settings.php"><span>Settings</span></a>
                    </li>
                    <li class="brake"></li>
                    <li>
                        <a class="btn btn-small" href="./logout.php"><span>Log out</span></a>
                    </li>


              </div>


            </div>
          <?php }else{
          echo '<a class="btn btn-signin" href="./signin.php">
                    <img alt="signin" class="icon icon-logo-white-small" src="https://scan.idena.io/static/images/idena_white_small.svg" width="24px">
                    <span style="color: #fff;">Sign-in</span>
                    </a>';
          } ?>

      </div>

    </div>
  </div>
</header>


  <main class="main">
    <div class="container">
