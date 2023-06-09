<!--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---
    Project     : RealT personal dashboard (RPD)
    Purpose     : build an advanced personal dashboard for RealT tokens management
    File        : gnosis.php
    Description : Gnosis API communication script
    Creation    : 2023-06-09
    Author      : CoinMachine
    Last update : 2023-06-23
 --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --->
 <?php
// Function to execute a request to the API with a contract address parameter
// Parameters   :
//          $module (string) : module to interrogate
//          $action (string) : action to execute
//          $contractAddress (string) : relatedcontract address
// Return       : $response : decoded from json response of the API
function executeGnosisRequest($module, $action, $contractAddress){
    $url = "https://blockscout.com/xdai/mainnet/api";
    $parameters = [
        'module' => $module,
        'action' => $action,
        'contractaddress' => $contractAddress
    ];
    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: ' . constant("GNOSIS_KEY")
    ];
    $qs = http_build_query($parameters);    // query string encode the parameters
    $request = "{$url}?{$qs}";              // create the request URL
    $curl = curl_init();                    // Get cURL resource
    $curlOptions = array(
        CURLOPT_SSL_VERIFYHOST => false,    // Disable SSL verification of host name in the server certificate
        CURLOPT_SSL_VERIFYPEER => false,    // Disable SSL verification of the SSL certificate on the server
        CURLOPT_URL => $request,            // set the request URL
        CURLOPT_HTTPHEADER => $headers,     // set the headers 
        CURLOPT_RETURNTRANSFER => 1,         // ask for raw response instead of bool
        CURLOPT_PIPEWAIT => true               // wait for pipe connection to confirm
    );
    // Set cURL options
    curl_setopt_array($curl, $curlOptions);
    $response = curl_exec($curl);           // Send the request, save the response
    if(curl_errno($curl)){
        echo curl_error($curl);
    }
    curl_close($curl);                      // Close request
    return json_decode($response);
}
// Function to execute a request to the API with an address parameter
// Parameters   :
//          $module (string) : module to interrogate
//          $action (string) : action to execute
//          $address (string) : related address
// Return       : $response : decoded from json response of the API
function execGnosisRequestByAddress($module, $action, $address){
    $url = "https://blockscout.com/xdai/mainnet/api";
    $parameters = [
        'module' => $module,
        'action' => $action,
        'address' => $address
    ];
    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: ' . constant("GNOSIS_KEY")
    ];
    $qs = http_build_query($parameters);    // query string encode the parameters
    $request = "{$url}?{$qs}";              // create the request URL
    $curl = curl_init();                    // Get cURL resource
    $curlOptions = array(
        CURLOPT_SSL_VERIFYHOST => false,    // Disable SSL verification of host name in the server certificate
        CURLOPT_SSL_VERIFYPEER => false,    // Disable SSL verification of the SSL certificate on the server
        CURLOPT_URL => $request,            // set the request URL
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
    return json_decode($response);
}
// Function to execute a request to the API with an address parameter and contract address
// Parameters   :
//          $module (string) : module to interrogate
//          $action (string) : action to execute
//          $address (string) : related wallet address
//          $contractAddress (string) : related contract address
// Return       : $response : decoded from json response of the API
function execGnosisRequestByAddressAndContract($module, $action, $contractAddress, $address){
    $url = "https://blockscout.com/xdai/mainnet/api";
    $parameters = [
        'module' => $module,
        'action' => $action,
        'contractaddress' => $contractAddress,
        'address' => $address
    ];
    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: ' . constant("GNOSIS_KEY")
    ];
    $qs = http_build_query($parameters);    // query string encode the parameters
    $request = "{$url}?{$qs}";              // create the request URL
    $curl = curl_init();                    // Get cURL resource
    $curlOptions = array(
        CURLOPT_SSL_VERIFYHOST => false,    // Disable SSL verification of host name in the server certificate
        CURLOPT_SSL_VERIFYPEER => false,    // Disable SSL verification of the SSL certificate on the server
        CURLOPT_URL => $request,            // set the request URL
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
    return json_decode($response);
}