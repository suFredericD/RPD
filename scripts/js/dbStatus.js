// =======================================================================================
// Project     : RealT personal dashboard (RPD)
// Purpose     : build an advanced personal dashboard for RealT tokens management
// File        : dbStatus.js
// Description : dbStatus.php JavaScript file for the RPD project
// Creation    : 2023-06-23
// Author      : CoinMachine
// Last update : 2023-06-23
// =======================================================================================
// ==================== Globals and variables
let tokenDetailsData = [];
// ==================== DOM elements
const pageContainer = document.getElementById('dbstatus-container');
const tokenDetails = document.getElementById('token-details');
const tokenDetailsTable = tokenDetails.querySelector('tbody');
const tokenDetailsLines = tokenDetailsTable.querySelectorAll('tr');

// ==================== Functions
tokenDetailsLines.forEach((line) => {
    const tokenInfos = line.querySelectorAll('td');
    let tokenInfoData = [];
    tokenInfos.forEach((tokenInfo) => {
        tokenInfoData.push(tokenInfo.innerHTML);
    });
    tokenDetailsData.push(tokenInfoData);
    
});

