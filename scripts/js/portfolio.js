// =======================================================================================
// Project     : RealT personal dashboard (RPD)
// Purpose     : build an advanced personal dashboard for RealT tokens management
// File        : portfolio.js
// Description : portfolio JavaScript file for the RPD project
// Creation    : 2023-06-09
// Author      : CoinMachine
// Last update : 2023-06-09
// =======================================================================================
// ==================== Global variables
const urlParams = new URLSearchParams(window.location.search).get("wallet");
const walletAddress = new URLSearchParams(window.location.search).get("wallet");
// ==================== DOM elements
const walletAddressInput = document.getElementById("wallet");





// ==================== MANIPULATIONS
if(walletAddress != null){
    walletAddressInput.value = walletAddress;
}