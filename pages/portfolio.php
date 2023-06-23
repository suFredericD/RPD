<!--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---
    Project     : RealT personal dashboard (RPD)
    Purpose     : build an advanced personal dashboard for RealT tokens management
    File        : portfolio.php
    Description : advanced portfolio page of the dashboard
    Creation    : 2023-06-09
    Author      : CoinMachine
    Last update : 2023-06-09
 --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --->
 <?php
 // Include the access keys file
require('../admin/access.php');
// Include the RealT API interrogation file
require('../scripts/api/alltokens.php');
// Include the Gnosis API interrogation file
require('../scripts/api/gnosis.php');

// Check if the wallet address is set in the URL
if(isset($_GET['wallet']) && $_GET['wallet'] != ""){    
    $strPlaceHolder = $_GET['wallet'];
    $objTokensBalances = execGnosisRequestByAddress("account", "tokenlist", $_GET['wallet']);
} else {
    $strPlaceHolder = "0x.....................";
};

if(isset($objTokensBalances)){
    print_r($objTokensBalances);
};

?>
<!--- --- --- --- --- --- --- --- RealT Personal Dashboard --- --- --- --- --- --- --- --- --- --- --- --->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <meta charset="UTF-8">
   <title>RPD | RealT personal dashboard</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="RealT personal dashboard (RPD): advanced personal dashboard for RealT tokens management">
   <meta name="keywords" content="RealT, blockchain, smart contract, smart contracts, web3, wallet, token, investment, portfolio, dashboard, real estate">
   <meta name="author" content="CoinMachine">
   <favicon href="../media/icons/atom_Hero53.ico" />
<!-- Google fonts, Bootstrap and CSS stylesheet -->
   <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Source+Sans+Pro&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../config/bootstrap/css/bootstrap.css">    
   <link rel="stylesheet" type="text/css" href="../config/css/main.css">
   <link rel="stylesheet" type="text/css" href="../config/css/portfolio.css">
</head>
<body>
<!-- Modal header -->
   <section class="modal-header row">
       <img src="../media/logos/RealT_Logo.svg" alt="modal-icon" class="modal-icon col-xl-2" />
       <form action="portfolio.php" method="get" class="col-xl-5">
            <div class="row">
                <input type="text" id="wallet" name="wallet" class="wallet_input offset-xl-2 col-xl-8" placeholder="<?php echo $strPlaceHolder;?>" aria-placeholder="<?php echo $strPlaceHolder;?>" />
                <input type="submit" class="pb_button offset-xl-4 col-xl-4"  value="Check wallet" />
            </div>
        </form>
       <h1 id="site-title" class="col-xl-5">RealT Personal Dashboard</h1>
   </section>
<!-- Main menu -->
   <section id="content-container" class="row">
       <nav id="main-nav" class="col-xl-2">
           <ul>
               <img class="nav-logo" src="../media/logos/rmmLogo.svg" />
               <li class=""><a href="../index.php">Home</a></li>
               <li><a href="portfolio.php">Portfolio</a></li><hr class="nav-hr">
               <img class="nav-logo" src="../media/logos/RealT_Logo.svg" />
               <li><a href="https://realt.co/" target="_blank">Site principal</a></li>
               <li><a href="https://rmm.realtoken.network/markets/" target="_blank">RealT Market Maker</a></li><hr>

               <li><a href="https://realt.co/blog/" target="_blank">RealT Blog</a></li>
               <li><a href="https://discord.gg/5TkxpQc" target="_blank">RealT Discord</a></li>
           </ul>
       </nav>
<!-- Home page content -->
       <section id="portfolio-container" class="col-xl-10">





       </section>
<!-- --- --- --- --- END OF CONTENT --- --- --- --- -->
    </section>
<!-- JavaScript animations and DOM manipulations integrated script -->
    <script src="../scripts/js/main.js"></script>
    <script src="../scripts/js/portfolio.js"></script>
    <script src="https://kit.fontawesome.com/91b2ef136e.js" crossorigin="anonymous"></script>
</body>
</html>