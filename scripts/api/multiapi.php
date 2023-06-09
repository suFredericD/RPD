<!--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---
    Project     : RealT personal dashboard (RPD)
    Purpose     : build an advanced personal dashboard for RealT tokens management
    File        : multiapi.php
    Description : multi API communication script
    Creation    : 2023-06-09
    Author      : CoinMachine
    Last update : 2023-06-09
 --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --->
 <?php
// Function to execute a request to the API
// Parameters   : $path (string) : the end of URL to interrogate
// Return       : $response : decoded from json response of the API
function getRealTtvl(){
    $url = "https://api.llama.fi/tvl/realt";
    $headers = [
    'Accepts: */*'
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
    return json_decode($response);
}