/*
// EXPORT ON REQUEST LIST ON INDIGENCY
function indigencyExcel() {
    var tab = document.getElementById('indigencyTable');
    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'indigency-request.xlsx');

}

// EXPORT ON REQUEST LIST ON RESIDENCY
function residencyExcel() {
    var tab = document.getElementById('residencyTable');
    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'residency-request.xlsx');

}

// EXPORT ON REQUEST LIST ON JOBSEEKER
function jobseekerExcel() {
    var tab = document.getElementById('jobseekerTable');
    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'jobseeker-request.xlsx');

}

// EXPORT ON MANAGE USER TABLE
function manageUserExcel() {
    var tab = document.getElementById('manageUserTable');
    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'manage-user-request.xlsx');

}

// EXPORT ON RESIDENT TABLE
function residentExcel() {
    var tab = document.getElementById('residentTable');
    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'resident-record.xlsx');

}

// EXPORT ON REQUEST LIST ON ALL REQUEST STATUS
function requestExcel() {
    var tab = document.getElementById('requestTable');
    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'request-record.xlsx');

}*/


/**    <script src="../Dashboard/CSS,JS/Export.js" defer></script>  */
/**    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>    */


function fnExcelReport() {
    var indigency = document.getElementById('indigencyTable');
    var residency = document.getElementById('residencyTable');
    var jobseeker = document.getElementById('jobseekerTable');
    var manageUser = document.getElementById('manageUserTable');
    var resident = document.getElementById('residentTable');
    var status = document.getElementById('statusTable');
    
    var indi = XLSX.utils.table_to_book(indigency);
    var resi = XLSX.utils.table_to_book(residency);
    var job = XLSX.utils.table_to_book(jobseeker);
    var manage = XLSX.utils.table_to_book(manageUser);
    var resiDent = XLSX.utils.table_to_book(resident);
    var stat = XLSX.utils.table_to_book(status);

    XLSX.writeFile(indi, 'indigency-request.xlsx');
    XLSX.writeFile(resi, 'residency-request.xlsx');
    XLSX.writeFile(job, 'jobseeker-request.xlsx');
    XLSX.writeFile(manage, 'manage-user-record.xlsx');
    XLSX.writeFile(resiDent, 'resident-record.xlsx');
    XLSX.writeFile(stat, 'status-request.xlsx');

}