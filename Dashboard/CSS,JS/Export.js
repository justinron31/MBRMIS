/** EXPORT TO EXCEL INDIGENCY REQUEST*/
function fnIndigencyReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'indigency-report.xls'
	a.click()
}

/** EXPORT TO EXCEL RESIDENCY REQUEST*/
function fnResidencyReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'residency-report.xls'
	a.click()
}

/** EXPORT TO EXCEL JOBSEEKER REQUEST*/
function fnJobseekerReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'jobseeker-report.xls'
	a.click()
}

/** EXPORT TO EXCEL ALL REQUEST*/
function fnRequestAllReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'all-request-report.xls'
	a.click()
}

/** EXPORT TO EXCEL RESIDENT REPORT*/
function fnResidentReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'resident-report.xls'
	a.click()
}

/** EXPORT TO EXCEL MANAGE USER REPORT*/
function fnManageReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'manage-user.xls'
	a.click()
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