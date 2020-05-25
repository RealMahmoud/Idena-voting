<!doctype html>
<html lang="en">
<head>
  <meta charSet="UTF-8"/>
  <title id="title">Idena Polls - Make Polls Great Again!</Title>

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
        <div class="header_logo">
          <a class="" href="./index.php">
            <img src="./images/idena-logo.svg" alt="Idena" width="40px">
          </a>
        </div>
      </div>

        
        
                <!-- search bar starts -->
        <div class="col">
            <form action="" class="form_search">
            <div class="input-group">
                <div class="input-addon">
                    <button type="submit" class="btn btn-icon">
                        <i class="icon icon--search"></i>
                    </button>
                </div>
                <input type="search" value="" placeholder="Polls, Proposals ..." class="form-control"/>
            </div>
            </form>
        </div>
        
        <!-- search bar ends -->

        <?php if(!empty($_SESSION["addr"])) { ?>
      <div class="col-auto">
          <div class="btn-group">
              <a href=" " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div  class="user-pic" style="margin-right: 0px;">
                      <img  class="user-avatar" src="https://robohash.org/<?php echo $_SESSION["addr"]; ?>" alt="pic" width="40">
                      </div>
              </a>

              <div class="dropdown-menu" aria-hidden="true" role="menu">
                    <li>
                        <a class="btn btn-small" href="./profile.php"><span>My Profile</span></a>
                    </li>
                    <li class="brake"></li>
                    <li>
                        <a class="btn btn-small" href="./logout.php"><span>Log out</span></a>
                    </li>
              </div>


            </div>
            <?php } ?>

      </div>

    </div>
  </div>
  
  <div class="container">
      <div class="row justify-content-between align-items-center">
          <div class="col-12 col=md-12 text-center">
                <ul class="header_nav nav justify-content-center">
                  <li class="nav-item header_nav__item">
                    <a href='./polls.php'class="nav-link header_nav__link" title="Polls" descriptioncontent="Polls">Polls</a>
                  </li>
        
                  <li class="nav-item header_nav__item">
                    <a href='./proposals.php' class="nav-link header_nav__link" title="Proposals" descriptioncontent="Proposals">Proposals</a>
                  </li>
        
                  <li class="nav-item header_nav__item">
                    <a href="#" class="nav-link header_nav__link" title="Registrations" descriptioncontent="Registrations">Registrations</a>
                  </li>
                </ul>
          </div>
      </div>
    </div>
</header>
    

  <main class="main">
    <div class="container">
