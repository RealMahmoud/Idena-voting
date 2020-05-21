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
          <a class="" href="./polls.php">
            <img src="./images/idena-logo.svg" alt="Idena" width="40px">
          </a>
        </div>
      </div>
      <div class="col col-5">
      </div>

      <div class="col-auto">
          <?php if(!empty($addr)) { ?>
          <div class="btn-group">
              <a type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="user-pic">
                      <img class="user-avatar" src="https://robohash.org/<?php echo $addr; ?>" alt="pic" width="40">
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
</header>

  <main class="main">
    <div class="container">