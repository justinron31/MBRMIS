function fnIndigencyReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'indigency-report.xls'
	a.click()
}

function fnResidencyReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'residency-report.xls'
	a.click()
}

function fnJobseekerReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'jobseeker-report.xls'
	a.click()
}

function fnRequestAllReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'all-request-report.xls'
	a.click()
}

function fnResidentReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'resident-report.xls'
	a.click()
}

function fnManageReport(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'manage-user.xls'
	a.click()
}

function fnReportingView(tableId){
	let tableData = document.getElementById(tableId).outerHTML;
	tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    let a = document.createElement('a');
	a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
	a.download = 'audit-logs.xls'
	a.click()
}