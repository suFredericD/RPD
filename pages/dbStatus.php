<!--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---
    Project     : RealT personal dashboard (RPD)
    Purpose     : build an advanced personal dashboard for RealT tokens management
    File        : dbStatus.php
    Description : checking datadase status
    Creation    : 2023-06-23
    Author      : CoinMachine
    Last update : 2023-06-23
 --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --->
<?php
require('../admin/access.php');             // Include the access keys file
require('../scripts/api/alltokens.php');    // Include the RealT API interrogation file
require('../scripts/api/gnosis.php');       // Include the Gnosis API interrogation file
require('../admin/db_access.php');          // Include the database access file
require('../admin/db_requestBuilder.php');  // Include the database request builder file

$tabAllRealTtokens = getRealTtokens();      // Get all RealT tokens informations
foreach($tabAllRealTtokens as $token){
    if(substr_compare($token->shortName, "OLD-", 0, 4, true) != false){
        $tabAllRealTtokensWoOlds[] = $token;
    } else {
        $tabOldRealTtokens[] = $token;
    }
}
$intRealTtokens = count($tabAllRealTtokensWoOlds);  // Number of RealT tokens
$tabDbTokens = getDbTokens();                       // Get all tokens from database
$intDbTokens = count($tabDbTokens);                 // Number of tokens in database

// Update database tokens list if requested
if(isset($GET['update']) && $GET['update'] == "yes"){
    foreach($tabAllRealTtokensWoOlds as $token) {
        $boolDetected = false;
        if($tabDbTokens != "") {
            foreach($tabDbTokens as $dbToken){
                if($token->uuid == $dbToken['uuid']){
                    $boolDetected = true;
                }
            }
        }
        if($boolDetected == false){
            $intTokenSupply = executeGnosisRequest("stats", "tokensupply", $token->uuid);
            $intDbTokenSupply = $intTokenSupply / 1000000000000000000;
            insertToken($token, $intDbTokenSupply);
        }
    }
    $tabDbTokens = getDbTokens();                       // Update tokens list from database
    $intDbTokens = count($tabDbTokens);                 // Update number of tokens in database
}

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
    <link href="https://fonts.googleapis.com/css?family=Fira+Mono|Fira+Sans+Condensed|Montserrat|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../config/bootstrap/css/bootstrap.css">    
    <link rel="stylesheet" type="text/css" href="../config/css/main.css">
    <link rel="stylesheet" type="text/css" href="../config/css/dbStatus.css">
</head>
<body>
<!-- Modal header -->
    <section class="modal-header row">
        <img src="../media/logos/RealT_Logo.svg" alt="modal-icon" class="modal-icon col-xl-2" />
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
        <section id="dbstatus-container" class="col-xl-10">
            <div class="row">
                <table id="db-details" class="table table-dark table-striped col-12">
                    <thead>
                        <tr>
                            <th></th>
                            <th>RealT tokens</th>
                            <th>Database tokens</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total active tokens</td>
                            <td><?php echo $intRealTtokens;?></td>
                            <td><?php echo $intDbTokens;?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="dbStatus.php?update=yes" class="btn btn-sm btn-primary">Update DB token list</a>
                <table id="token-details" class="table table-dark table-striped table-bordered table-hover table-sm table-responsive col-12">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th title="Token supply">Supply</th>
                            <th title="Estimated Market Capitalization">EMC</th>
                            <th>Smart contract</th>
                        </tr>
                    </thead>
                    <tbody>
<?php   $boolPairOdd = true;
        foreach($tabDbTokens as $token){
            $strDisplayName = $token['shortName'];
            $strEthereumContractLink = "https://etherscan.io/address/".$token['ethereum'];
            $strGnosisContractLink = "https://blockscout.com/xdai/mainnet/address/".$token['gnosis'];
            $strGnosisLinkTitle = "See token contract on Gnosis...";
            $strEthereumLinkTitle = "See token contract on Ethereum...";
            $strLTUrlBase = "https://www.google.fr/maps/place/" . urlencode($token['fullName']);
            $strTokenSupply = number_format($token['supply'], 0, ",", " ");
            $floMarketCap = $token['supply'] * $token['price'];
?>
                        <tr class="">
                            <td class="token-details-name"><?php echo $strDisplayName;?></td>
                            <td class="token-details-geo">
                                <a href="<?php echo $strLTUrlBase;?>" title="See location on Google Maps..." target="_blank"><?php echo $token['fullName'];?><span class="fa-solid fa-arrow-up-right-from-square"></span></a>
                            </td>
                            <td class="token-details-price"><?php echo $token['currencySymbol'] . " " . $token['price'];?></td>
                            <td class="token-details-supply"><?php echo $strTokenSupply;?></td>
                            <td class="token-details-marketcap"><?php echo "$ ".number_format($floMarketCap, 0, ",", " ");?></td>
                            <td class="token-details-contract">
                                <span><?php echo $token['ethereum'];?></span>
                                <a href="<?php echo $strEthereumContractLink;?>" title="<?php echo $strEthereumLinkTitle;?>" target="_blank">
                                    <img class="token-contract" src="../media/tokens/ethereum.png" />
                                </a>
                                <a href="<?php echo $strGnosisContractLink;?>" title="<?php echo $strGnosisLinkTitle;?>" target="_blank">
                                    <img class="token-contract" src="../media/tokens/gnosis.png" />
                                </a>
                            </td>
                        </tr>
<?php   } ?>
                    </tbody>
                </table>
            </div>
       </section>
<!-- --- --- --- --- END OF CONTENT --- --- --- --- -->
    </section>
<!-- JavaScript animations and DOM manipulations integrated script -->
    <script src="../scripts/js/main.js"></script>
    <script src="../scripts/js/dbStatus.js"></script>
    <script src="https://kit.fontawesome.com/91b2ef136e.js" crossorigin="anonymous"></script>
</body>
</html>
