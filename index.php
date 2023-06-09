<!--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---
    Project     : RealT personal dashboard (RPD)
    Purpose     : build an advanced personal dashboard for RealT tokens management
    File        : index.php
    Description : home page of the dashboard
    Creation    : 2023-06-08
    Author      : CoinMachine
    Last update : 2023-06-09
 --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --->
 <?php
// Include the API interrogation file
require('scripts/api/alltokens.php');

$totalForAverage = 0;

// Get all RealT tokens informations
$tabAllRealTtokens = getRealTtokens();
foreach($tabAllRealTtokens as $token) {
    if(substr_compare($token->shortName, "OLD-", 0, 4, true) != false) {
        $tabAllRealTtokensWoOlds[] = $token;
    } else {
        $tabOldRealTtokens[] = $token;
    }
}
// Number of RealT tokens
$intRealTtokens = count($tabAllRealTtokensWoOlds);
// Number of old RealT tokens
$intOldRealTtokens = count($tabOldRealTtokens);
// Get latest RealT token informations
$tabLatestRealTtoken = executeRequest("token/lastUpdate");
// Format the latest token date
$datLastestToken = date_format(new DateTime($tabLatestRealTtoken->lastUpdate->date), "d/m/Y");
// Format the latest token localization link
$strLTUrlBase = "https://www.google.fr/maps/place/" . urlencode($tabLatestRealTtoken->fullName);
$strLTUrlContractGnosis = "https://blockscout.com/xdai/mainnet/token/" . $tabLatestRealTtoken->gnosisContract;
$strLTUrlContractEthereum = "https://etherscan.io/token/" . $tabLatestRealTtoken->ethereumContract;
foreach($tabAllRealTtokensWoOlds as $token) {
    $totalForAverage += $token->tokenPrice;
}
$averageTokenPrice = $totalForAverage / $intRealTtokens;
$averageTokenPriceFormatted = number_format($averageTokenPrice, 2, ".", " ");
 ?>
 <!--- --- --- --- --- --- --- --- RealT Personal Dashboard --- --- --- --- --- --- --- --- --- --- --- --->
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <meta charset="UTF-8">
    <title>RPD | RealT personal dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="RealT personal dashboard (RPD): advanced personal dashboard for RealT tokens management">
    <meta name="keywords" content="RealT, blockchain, smart contract, smart contracts, web3, wallet, token, investment, portfolio, dashboard, real estate">
    <meta name="author" content="CoinMachine">
    <favicon href="atom_Hero53.ico" />
<!-- Google fonts, Bootstrap and CSS stylesheet -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="config/bootstrap/css/bootstrap.css">    
    <link rel="stylesheet" type="text/css" href="config/css/main.css">
</head>
<body>
<!-- Modal header -->
    <section class="modal-header row">
        <img src="media/logos/RealT_Logo.svg" alt="modal-icon" class="modal-icon col-xl-2" />
        <nav class="col-xl-5"></nav>
        <h1 id="site-title" class="col-xl-5">RealT Personal Dashboard</h1>
    </section>
<!-- Main menu -->
    <section id="content-container" class="row">
        <nav id="main-nav" class="col-xl-2">
            <ul>
                <img class="nav-logo" src="media/logos/rmmLogo.svg" />
                <li class=""><a href="index.php">Home</a></li>
                <li><a href="pages/portfolio.php">Portfolio</a></li><hr class="nav-hr">
                <img class="nav-logo" src="media/logos/RealT_Logo.svg" />
                <li><a href="https://realt.co/" target="_blank">Site principal</a></li>
                <li><a href="https://rmm.realtoken.network/markets/" target="_blank">RealT Market Maker</a></li><hr>

                <li><a href="https://realt.co/blog/" target="_blank">RealT Blog</a></li>
                <li><a href="https://discord.gg/5TkxpQc" target="_blank">RealT Discord</a></li>
            </ul>
        </nav>
<!-- Home page content -->
        <section id="home-container" class="col-xl-10">
            <article id="home-informations" class="row">
                <div class="hi-legend col-xl-6">RealT tokens actifs:</div>
                <div class="hi-number col-xl-2"><?php echo $intRealTtokens; ?></div>
                <div class="hi-legend col-xl-6">RealT tokens désaffectés :</div>
                <div class="hi-number col-xl-2"><?php echo $intOldRealTtokens; ?></div>
                <div class="hi-legend col-xl-6">Prix moyen d'un token :</div>
                <div class="hi-number col-xl-2"><?php echo "$ " . $averageTokenPriceFormatted; ?></div>
                <div class="offset-xl-1 col-xl-10">
                    <div id="home-last-token" class="row">
                    <h3 class=" col-xl-12">Dernier RealT token : <?php echo $datLastestToken; ?></h3>
                        <div class="hi-legend col-xl-4">Token</div>
                        <div class="latest-infos col-xl-8"><?php echo $tabLatestRealTtoken->shortName; ?></div>
                        <div class="hi-legend col-xl-4">Adresse</div>
                        <div class="latest-geo col-xl-8">
                            <a href="<?php echo $strLTUrlBase;?>" target="_blank" title="Voir la géolocalisation de la propriété associée au token sur Google Maps..."><?php echo $tabLatestRealTtoken->fullName; ?><span class="fa-solid fa-up-right-from-square right-link"></span></a>
                        </div>
                        <div id="hlt-contract-title" class="col-xl-2">Contract</div>
                        <div class="col-xl-10">
                            <div class="row">
                                <div class="latest-infos-title col-xl-4">Ethereum</div>
                                <div class="latest-infos col-xl-8">
                                    <a href="<?php echo $strLTUrlContractEthereum;?>" target="_blank" title="Voir le smart contract du token sur Ethereum..."><?php echo $tabLatestRealTtoken->ethereumContract;?><span class="fa-solid fa-up-right-from-square right-link"></span></a>
                                </div>
                                <div class="latest-infos-title col-xl-4">Gnosis</div>
                                <div class="latest-infos col-xl-8">
                                    <a href="<?php echo $strLTUrlContractGnosis;?>" target="_blank" title="Voir le smart contract du token sur Gnosis..."><?php echo $tabLatestRealTtoken->gnosisContract; ?><span class="fa-solid fa-up-right-from-square right-link"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>



    </section>
<!-- JavaScript animations and DOM manipulations integrated script -->
    <script src="scripts/js/main.js"></script>
    <script src="https://kit.fontawesome.com/91b2ef136e.js" crossorigin="anonymous"></script>
</body>
</html>