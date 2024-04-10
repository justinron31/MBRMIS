function generateCertificate(name, date, type, purpose_description,purok) {
    // Splitting name into first and last names
    var nameParts = name.split(" ");
    var firstName = nameParts[0]; // First name
    var lastName = nameParts[1]; // Last name

    // Formatting the date
    var pickupDate = new Date(date);
    var day = pickupDate.getDate();
    var month = pickupDate.toLocaleString("default", {
        month: "long",
    });
    var year = pickupDate.getFullYear();

    // Determine the displayed text for the type
    var typeDisplay;
    if (type === "Certificate of Indigency") {
        typeDisplay = "CERTIFICATION <br> INDIGENCY";
    } else if (type === "Certificate of Residency") {
        typeDisplay = "CERTIFICATION <br> RESIDENCY";
    } else {
        typeDisplay = type; 
    }

    var certificateContent = `
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

        <style>
       
        
            .certificate {
                display: flex;
                flex-direction:column;
                margin:15px;
                line-height: 1.1;
               min-height: 90vh;  
               justify-content:space-between;
            }
            
            h5{
                diplay:flex;
                 margin:0;
            }
            
            h6{
                margin:0;
                font-weight:500;
            }
            
            h3{
              display: flex;
                justify-content: center; 
                text-align: center;   
            }
            
            .header {
                display: flex;
                justify-content: center; 
                align-items: center; 
                text-align: center;
                margin-bottom: 20px;
            }

            .header .inner {
                display: flex;
                justify-content: space-between;
                width: 100%; 
            }


            .thick-line {
                width: 100%; /* Adjust the width as needed */
                height: 1.5px; /* Adjust the thickness as needed */
                background-color: black; /* Adjust the color as needed */
            }


            .contact{
                line-height: 1.3;
            }
            .contact1{
                line-height: 1.3;
                
            }
            
            .right{
                justify-content: flex-end;
            }
        
            .center {
              display: flex;
              flex-direction:column;
                justify-content: center; 
                align-items: center; 
                text-align: center;
                font-size:1.2rem;
            }

            .header img {
                width: 110px;
                height: auto;
            }
            
            .typeDoc{
                text-decoration:underline;
                 word-break: break-all;
                 margin-bottom:60px;
            }
            
            
            .content{
                font-family: "Inter", sans-serif;
                justify-content: center; 
                text-align: justify;
              
            }
            
            .seal p {
          
            }

        </style>

        <div class="certificate">
        <div class="ConWrap">
            <div class="header">
              <div class="inner">
                <div class="left">
                    <img src="../images/logo.png" alt="Barangay Makiling Seal">
                </div>

                    <div class="center">
                       <div class="contact">
                        <h5>REPUBLIKA NG PILIPINAS <br> BARANGAY MAKILING <br> KM. 54 Maharlika Highway</h5>
                         </div>
                     
                    <div class="contact1">
                    <h6>Brgy. Makiling, Calamba City</h6>
                    <h6>City Tel No. (049) 502-790</h6>
                    </div>
                    
                </div>

                <div class="right">
                    <img src="../images/calamba.png" alt="Calamba, Laguna Seal">
                </div>
            </div>
                </div>
            
            <div class="thick-line"></div>
            
            
            <div class="content">
            <h3>OFFICE OF THE PUNONG BARANGAY</h3>
            <h3 class="typeDoc">${typeDisplay}</h3>
            <p>To whom it may concern:</p>
            <p>This is to certify that <strong>${firstName} ${lastName}</strong>, of legal age, and a resident of <strong>${purok}</strong>, Brgy. Makiling, Calamba City, Laguna, has no derogatory record filed in this office.</p>
            <p>This certification is issued upon the request of <strong>${firstName} ${lastName}</strong>, to be used as a requirement for <strong>${purpose_description}</strong>.</p>
            <p>Given this <strong>${day}th</strong> day of <strong>${month} ${year}</strong> at the Office of the Punong Barangay, Brgy. Makiling, Calamba City.</p>
            </div>
            </div>
            
             <div class="seal">
            <p>**NOT VALID BARANGAY SEAL.**</p>
            </div>


        </div>
    `;
    
    var printWindow = window.open("PRINT", "_blank");
    printWindow.document.write(certificateContent);
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
}





// function generateResidencyCertificate(name, date, purpose_description) {
//   // Splitting name into first and last names
//   var nameParts = name.split(" ");
//   var firstName = nameParts[0]; // First name
//   var lastName = nameParts[1]; // Last name

//   // Formatting the date
//   var pickupDate = new Date(date);
//   var day = pickupDate.getDate();
//   var month = pickupDate.toLocaleString("default", {
//     month: "long",
//   });
//   var year = pickupDate.getFullYear();

//   var certificateContent = `
//             <style>
//         .certificate {
//             line-height: 1.5;
//         }
//         .h3 {
//             text-align: center;
//         }
//         .header {
//             display: flex;
//             justify-content: space-between;
//             align-items: center;
//             margin-bottom: 20px;
//         }

//         .left,
//         .right {
//             flex-basis: 90%;
//         }

//         .center {
//             text-align: center;
//         }

//         .header img {
//             display: block;
//             width: 97px;
//             height: auto;
//         }


//     </style>
//         <div class="certificate">
//             <div class="header">
//                 <div class="left">
//                     <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Barangay_Makiling_Seal.png" alt="Barangay Makiling Seal" style="width: 97px; height: auto; margin-bottom: 10px;">
//                 </div>
//                 <div class="center">
//                     <h5 class="center-text">REPUBLIKA NG PILIPINAS</h5>
//                     <h5 class="center-text">BARANGAY MAKILING</h5>
//                     <h5 class="center-text">KM. 54 Maharlika Highway</h5>
//                     <h6>Brgy. Makiling, Calamba City</h6>
//                     <h6>City Tel No. (049) 502-790</h6>
//                 </div>
//                 <div class="right">
//                     <img src="https://upload.wikimedia.org/wikipedia/commons/d/da/Calamba%2C_Laguna_Seal.svg" alt="Calamba, Laguna Seal" style="width: 97px; height: auto; margin-bottom: 20px;">
//                 </div>
//             </div>

//             <h3>OFFICE OF THE PUNONG BARANGAY</h3>
//             <h3>CERTIFICATION RESIDENCY</h3>
//             <p>To whom it may concern:</p>
//             <p> This is to certify that <strong>${firstName} ${lastName}</strong>, of legal age, and a resident of _______, Brgy. Makiling, Calamba City, Laguna, has no derogatory record filed in this office.</p>
//             <p>This certification is issued upon the request of ___________, to be used as a requirement for <strong>${purpose_description}</strong>.</p>
//             <p> Given this <strong>${day}</strong> day of <strong>${month} ${year}</strong> at the Office of the Punong Barangay, Brgy. Makiling, Calamba City.</p>
//             <br><br><br><br><br><br><br><br><br><br>
//             <p> **NOT VALID BARANGAY SEAL.**</p>
//         </div>
//             `;
//   var printWindow = window.open("", "_blank");
//   printWindow.document.write(
//     "<html><head><title>Certificate of Indigency</title></head><body>"
//   );
//   printWindow.document.write(certificateContent);
//   printWindow.document.write("</body></html>");
//   printWindow.document.close();
//   printWindow.print();
// }

// function generateJobseekerCertificate(name, date, contact) {
//   // Splitting name into first and last names
//   var nameParts = name.split(" ");
//   var firstName = nameParts[0]; // First name
//   var lastName = nameParts[1]; // Last name

//   // Formatting the date
//   var pickupDate = new Date(date);
//   var day = pickupDate.getDate();
//   var month = pickupDate.toLocaleString("default", {
//     month: "long",
//   });
//   var year = pickupDate.getFullYear();

//   var certificateContent = `
//             <div class="certificate">
//                 <h6 class="center-text">First Time Jobseekers</h6>
//                 <h6 class="center-text">Personal Information Sheet Form</h6>
//                 <h6 class="center-text">APPLICATION FOR BARANGAY CERTIFICATION</h6>
//                 <h6 class="center-text">(RA 11261, JMC No.001, series of 2019 & DILG MC No. 2020-${year})</h6>
//                 <br><br><br>
//                 <p>Name: ${firstName} ${lastName}</p>
//                 <p>Birthdate: </p>
//                 <p>Age: </p>
//                 <p>Complete Address: </p>
//                 <p>Years/Months of residency in the given address: </p>
//                 <p>Contact Number (if any): </p>
//                 <p>Sex/Gender: </p>
//                 <p> Civil Status: </p>
//                 <p>Educational Attainments: </p>
//                 <p>Course (if Applicable, put “NA” if not application): </p>
//                 <p>Question: Are you a beneficiary of a JobStart Program under RA No. 10869, otherwise known as “An Act Institutionalizing the Nationwide Implementation of the JobStart Philippines Program and Providing Funds Therefor”?</p>
//                 <p>(Please check appropriate box)</p>
//                 <br><br><br><br><br>
//                 <p>Signature of Applicant</p>
//                 <br><br><br><br><br><br><br><br>
//                 <p>RA 11261 Form 1</p>
//                 `;
//   var printWindow = window.open("", "_blank");
//   printWindow.document.write(
//     "<html><head><title>Certificate of Indigency</title></head><body>"
//   );
//   printWindow.document.write(certificateContent);
//   printWindow.document.write("</body></html>");
//   printWindow.document.close();
//   printWindow.print();
// }
