/** EXPORT TO EXCEL INDIGENCY REQUEST*/
function fnIndigencyReport(tableId) {
    let table = document.getElementById(tableId);
    let rows = table.rows;
    let tableData = '<table>';

    // Loop through each row of the table
    for (let i = 0; i < rows.length; i++) {
        let rowData = [];
        let cells = rows[i].cells;

        // Determine if it's the first row (header)
        let isHeaderRow = (i === 0);

        // Loop through each cell of the row
        for (let j = 0; j < cells.length; j++) {
            let cellData = cells[j].innerHTML;

            // Check if the cell belongs to the "ID Img" column or the "Action" column
            if (isHeaderRow && (cellData.trim() === "ID Img" || cellData.trim() === "Action")) {
                continue; // Skip adding data for these columns in the header row
            }

            if (!isHeaderRow && (cells[j].getAttribute('title') === "ID Img" || cells[j].innerText.trim() === "View Valid ID")) {
                continue; // Skip adding data for these columns in non-header rows
            }

            if (isHeaderRow) {
    // Set fixed width for header cells
    rowData.push('<td style="background-color: #266e60; color: white; font-weight: bold; width:auto;">' + cellData + '</td>');
} else {
    // Let the width of data cells adjust to fit content
    rowData.push('<td style="width: auto;">' + cellData + '</td>');
}
        }

        // Join rowData into a table row and add it to tableData
        tableData += '<tr>' + rowData.join('') + '</tr>';
    }

    tableData += '</table>';

    let a = document.createElement('a');
    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableData);
    a.download = 'indigency-report.xls';
    a.click();
}



/** EXPORT TO EXCEL RESIDENCY REQUEST*/
function fnResidencyReport(tableId){
 let table = document.getElementById(tableId);
    let rows = table.rows;
    let tableData = '<table>';

    // Loop through each row of the table
    for (let i = 0; i < rows.length; i++) {
        let rowData = [];
        let cells = rows[i].cells;

        // Determine if it's the first row (header)
        let isHeaderRow = (i === 0);

        // Loop through each cell of the row
        for (let j = 0; j < cells.length; j++) {
            let cellData = cells[j].innerHTML;

            // Check if the cell belongs to the "ID Img" column or the "Action" column
            if (isHeaderRow && (cellData.trim() === "ID Img" || cellData.trim() === "Action")) {
                continue; // Skip adding data for these columns in the header row
            }

            if (!isHeaderRow && (cells[j].getAttribute('title') === "ID Img" || cells[j].innerText.trim() === "View Valid ID")) {
                continue; // Skip adding data for these columns in non-header rows
            }

            if (isHeaderRow) {
    // Set fixed width for header cells
    rowData.push('<td style="background-color: #266e60; color: white; font-weight: bold; width:auto;">' + cellData + '</td>');
} else {
    // Let the width of data cells adjust to fit content
    rowData.push('<td style="width: auto;">' + cellData + '</td>');
}
        }

        // Join rowData into a table row and add it to tableData
        tableData += '<tr>' + rowData.join('') + '</tr>';
    }

    tableData += '</table>';

    let a = document.createElement('a');
    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableData);
    a.download = 'residency-report.xls';
    a.click();
}




/** EXPORT TO EXCEL JOBSEEKER REQUEST*/
function fnJobseekerReport(tableId){
    let table = document.getElementById(tableId);
    let rows = table.rows;
    let tableData = '<table>';

    // Loop through each row of the table
    for (let i = 0; i < rows.length; i++) {
        let rowData = [];
        let cells = rows[i].cells;

        // Determine if it's the first row (header)
        let isHeaderRow = (i === 0);

        // Loop through each cell of the row
        for (let j = 0; j < cells.length; j++) {
            let cellData = cells[j].innerHTML;

            // Check if the cell belongs to the "ID Img" column and skip adding data
            if (cellData.trim() === "ID Img") {
                continue; // Skip adding data for this column
            }

            // Check if it's the header row and skip adding data for the "Action" column
            if (isHeaderRow && cellData.trim() === "Action") {
                continue; // Skip adding data for this column in the header row
            }

            // Check if it's a non-header row and skip adding data for the "View Valid ID" column
            if (!isHeaderRow && cells[j].innerText.trim() === "None") {
                continue; // Skip adding data for this column in non-header rows
            }

            // Add the cell data to rowData
            if (isHeaderRow) {
                // Set fixed width for header cells
                rowData.push('<td style="background-color: #266e60; color: white; font-weight: bold; width:auto;">' + cellData + '</td>');
            } else {
                // Let the width of data cells adjust to fit content
                rowData.push('<td style="width: auto;">' + cellData + '</td>');
            }
        }

        // Join rowData into a table row and add it to tableData
        tableData += '<tr>' + rowData.join('') + '</tr>';
    }

    tableData += '</table>';

    // Create a link element to initiate the download
    let a = document.createElement('a');
    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableData);
    a.download = 'jobseeker-report.xls';
    a.click();
}





/** EXPORT TO EXCEL ALL REQUEST*/
function fnRequestAllReport(tableId){
let table = document.getElementById(tableId);
    let rows = table.rows;
    let tableData = '<table>';

    // Loop through each row of the table
    for (let i = 0; i < rows.length; i++) {
        let rowData = [];
        let cells = rows[i].cells;

        // Determine if it's the first row (header)
        let isHeaderRow = (i === 0);

        // Loop through each cell of the row
        for (let j = 0; j < cells.length; j++) {
            let cellData = cells[j].innerHTML;

  // Check if it's the header row and skip adding data for the "Action" column
            if (isHeaderRow && cellData.trim() === "Action") {
                continue; // Skip adding data for this column in the header row
            }

            if (isHeaderRow) {
    // Set fixed width for header cells
    rowData.push('<td style="background-color: #266e60; color: white; font-weight: bold; width:auto;">' + cellData + '</td>');
} else {
    // Let the width of data cells adjust to fit content
    rowData.push('<td style="width: auto;">' + cellData + '</td>');
}
        }

        // Join rowData into a table row and add it to tableData
        tableData += '<tr>' + rowData.join('') + '</tr>';
    }

    tableData += '</table>';

    let a = document.createElement('a');
    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableData);
    a.download = 'indigency-report.xls';
    a.click();
}


/** EXPORT TO EXCEL MANAGE USER REPORT*/
function fnManageReport(tableId){
    let table = document.getElementById(tableId);
    let rows = table.rows;
    let tableData = '<table>';

    // Loop through each row of the table
    for (let i = 0; i < rows.length; i++) {
        let rowData = [];
        let cells = rows[i].cells;

        // Determine if it's the first row (header)
        let isHeaderRow = (i === 0);

        // Loop through each cell of the row
        for (let j = 0; j < cells.length; j++) {
            let cellData = cells[j].innerHTML;

            // Check if the cell belongs to the "ID Img" column or the "Action" column
            if (isHeaderRow && (cellData.trim() === "ID Img" || cellData.trim() === "Action")) {
                continue; // Skip adding data for these columns in the header row
            }



            // Add the cell data to rowData
            if (isHeaderRow) {
                // Set fixed width for header cells
                rowData.push('<td style="background-color: #266e60; color: white; font-weight: bold; width:auto;">' + cellData + '</td>');
            } else {
                // Let the width of data cells adjust to fit content
                rowData.push('<td style="width: auto;">' + cellData + '</td>');
            }
        }

        // Join rowData into a table row and add it to tableData
        tableData += '<tr>' + rowData.join('') + '</tr>';
    }

    tableData += '</table>';

    let a = document.createElement('a');
    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableData);
    a.download = 'manage-report.xls';
    a.click();
}





function fnResidentReport(tableId){
    let table = document.getElementById(tableId);
    let rows = table.rows;
    let tableData = '<table>';

    // Loop through each row of the table
    for (let i = 0; i < rows.length; i++) {
        let rowData = [];
        let cells = rows[i].cells;

        // Determine if it's the first row (header)
        let isHeaderRow = (i === 0);

        // Loop through each cell of the row
        for (let j = 0; j < cells.length; j++) {
            let cellData = cells[j].innerHTML;
            
             // Check if it's a non-header row and if it's the third column (index 2), skip if it's "None"
            if (!isHeaderRow && j === 2 && cellData.trim() === "None") {
                continue; // Skip adding data for this column in non-header rows
            }

            // Check if the cell belongs to the "Voters ID Img" column and if its value is "None"
            if (!isHeaderRow && cellData.trim() === "None" && cells[j - 1].innerText.trim() === "Voters ID Img") {
                continue; // Skip adding data for this cell
            }
            
            // Check if the cell belongs to the "ID Img" column or the "Action" column
            if (isHeaderRow && (cellData.trim() === "Voters ID Img" || cellData.trim() === "Action")) {
                continue; // Skip adding data for these columns in the header row
            }

 // Check if it's a non-header row and skip adding data for the "View Valid ID" column
            if (!isHeaderRow && cells[j].innerText.trim() === "View") {
                continue; // Skip adding data for this column in non-header rows
            }

             if (!isHeaderRow && cells[j].innerText.trim() === "View Voters ID") {
                continue; // Skip adding data for this column in non-header rows
            }

            // Add the cell data to rowData
            if (isHeaderRow) {
                // Set fixed width for header cells
                rowData.push('<td style="background-color: #266e60; color: white; font-weight: bold; width:auto;">' + cellData + '</td>');
            } else {
                // Let the width of data cells adjust to fit content
                rowData.push('<td style="width: auto;">' + cellData + '</td>');
            }
        }

        // Join rowData into a table row and add it to tableData
        tableData += '<tr>' + rowData.join('') + '</tr>';
    }

    tableData += '</table>';

    // Create a link element to initiate the download
    let a = document.createElement('a');
    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableData);
    a.download = 'resident-report.xls';
    a.click();
}







/** EXPORT TO EXCEL AUDIT LOGS REPORT*/
function fnReportingView(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'audit-logs.xls'
	a.click()
}