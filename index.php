<!--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---
    Project     : RealT personal dashboard (RPD)
    Purpose     : build an advanced personal dashboard for RealT tokens management
    File        : index.php
    Description : home page of the dashboard
    Creation    : 2023-06-08
    Author      : CoinMachine
    Last update : 2023-06-08
 --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --->
 <?php
 function getRealTtokens() {
    $host = "https://api.realt.community/v1/";
    $path = "tokenList";
    $url = $host . $path;
    $headers = [
    'Accepts: application/json'
    ];
    $curl = curl_init();                    // Get cURL resource
    $curlOptions = array(
        CURLOPT_SSL_VERIFYHOST => false,    // Disable SSL verification of host name in the server certificate
        CURLOPT_SSL_VERIFYPEER => false,    // Disable SSL verification of the SSL certificate on the server
        CURLOPT_URL => $url,                // set the request URL
        CURLOPT_HTTPHEADER => $headers,     // set the headers 
        CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
    );
    // Set cURL options
    curl_setopt_array($curl, $curlOptions);
    $response = curl_exec($curl);           // Send the request, save the response
    if(curl_errno($curl)){
        echo curl_error($curl);
    }
    curl_close($curl);                      // Close request
    return $response;
}
$tabAllRealTtokens = json_decode(getRealTtokens());
$intRealTtokens = count($tabAllRealTtokens->tokens);

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
<!-- CSS parameters and animations script -->
    <link rel="stylesheet" type="text/css" href="config/bootstrap/bootstrap.css">    
    <link rel="stylesheet" type="text/css" href="config/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body>
<!-- Modal header -->
    <section class="modal-header">
    <img src="media/logos/RealT_Logo.svg" alt="modal-icon" class="modal-icon">
        <h1>RealT Personal Dashboard</h1>
    </section>
<!-- Main menu -->
    <section id="content-container" class="col-12">
        <nav id="main-nav" class="col-2">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>


            </ul>
        </nav>

        <div class="col-10">
            Number of RealT tokens : <?php echo $intRealTtokens; ?>
        </div>



    </section>
<!-- JavaScript animations and DOM manipulations integrated script -->
    <script src="index.js"></script>
</body>
</html>