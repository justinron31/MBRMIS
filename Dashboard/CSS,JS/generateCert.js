function generateCertificate(
  name,
  date,
  type,
  purpose_description,
  purok,
  tracking_number,
  id
) {
  // Splitting name into first and last names
  var nameParts = name.split(" ");
  var firstName = nameParts.shift();
  var lastName = nameParts.join(" ");
  var fullName = firstName + " " + lastName;
  var fileType = type;
  // Formatting the date
  var pickupDate = new Date(date);
  var day = pickupDate.getDate();
  var month = pickupDate.toLocaleString("default", {
    month: "long",
  });
  var year = pickupDate.getFullYear();

  if (type === "First Time Job Seeker") {
    certificateContent = `

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


            .content{
                font-family: "Inter", sans-serif;
                justify-content: center;
                text-align: justify;

            }

            .titleH{
               margin:0;
               letter-spacing: 7px;
            }


            .contentsub{
              margin:0;
              font-weight:500;
              font-size:1.2rem;
              display: flex;
               align-items: center;
                text-align: center;
            }

            .center1{
              display: flex;
              flex-direction:column;
                align-items: center;
                text-align: center;
                font-size:1.2rem;
                margin-top:50px;
                margin-bottom:40px;
            }

            p {
            text-indent: 50px;
            line-height: 1.2;
            }

       .seal{
    font-family: "Inter", sans-serif;
    padding:0px 20px;
    width: 240px;
    position: relative;
    font-weight:600;

}

.seal p {
    margin-top:0;
    text-indent:0;

}

hr{
    margin-bottom:0;
}
.note{
  width: 215px;
}


.wrap{
  display: flex;
  flex-direction:column;
  align-items: flex-end;
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

            <div class="center1">
            <h3 class="titleH"><u>CERTIFICATION</u></h3>
            <div class="contentsub">(First Time Jobseekers Assistance Act - RA 11261)</div>
            </div>

            <p>This is to certify that <strong>${fullName}</strong>, resident of <strong>${purok}</strong>, Brgy. Makiling, Calamba City for (number of years) is qualified of <strong>RA 11261</strong> or the <strong><em>First Time Jobseekers Act of 2019</em></strong>.</p>

            <p>I further certify that the holder/ bearer was informed of his/ her rights including the
duties and responsibilities accorded by RA 11261 through the <strong>Oath of Undertaking</strong> he/
she has signed and executed in the presence of our Barangay Official.</p>

            <p>Issued this <strong>${day}th</strong> day of <strong>${month} ${year}</strong> at the Office of the Punong Barangay, Brgy. Makiling, Calamba City.</p>
            </div>
            </div>

            <div class="wrap">
            <div class="seal">
             <p style="text-align:center; margin:0;">AIGRETTE P. LAJARA</p>
            <hr>
    <p style="text-align:center">Punong Barangay</p>
    <hr style="margin-top:50px;">
    <p style="text-align:center;">DATE</p>
    <p style="margin-bottom:50px;">Witnessed by:</p>
    </br>
    <hr>
    <p>Barangay Official/ Designation</p>
    </br>
    <hr>
    <p style="text-align:center" >DATE</p>
</div>
</div>

  <div class="wrap">
<div class="note">
<p style="text-indent:0;">*This certification is valid only
One (1) year from the issuance*</p>
</div>

        </div>
          </div>


    `;
  } else {
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
            <p>This is to certify that <strong>${fullName}</strong>, of legal age, and a resident of <strong>${purok}</strong>, Brgy. Makiling, Calamba City, Laguna, has no derogatory record filed in this office.</p>
            <p>This certification is issued upon the request of <strong>${firstName} ${lastName}</strong>, to be used as a requirement for <strong>${purpose_description}</strong>.</p>
            <p>Given this <strong>${day}th</strong> day of <strong>${month} ${year}</strong> at the Office of the Punong Barangay, Brgy. Makiling, Calamba City.</p>
            </div>
            </div>

             <div class="seal">
            <p>**NOT VALID BARANGAY SEAL.**</p>
            </div>


        </div>


    `;
  }
  //   var printWindow = window.open("PRINT", "_blank");
  var printWindow = window.open("", "_blank");
  printWindow.document.write(certificateContent);
  printWindow.document.write("</body></html>");
  printWindow.document.close();

  // Add an onload event to the window
  printWindow.onload = function () {
    printWindow.print();
    setTimeout(function () {
      printWindow.close();

      // Refresh the page after print window is closed

      // Show a confirmation alert
      if (confirm("Mark the certificate DONE?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../Php/printDone.php", true);
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the server if needed
            console.log(xhr.responseText);
            window.location.reload();
          }
        };
        xhr.send(
          "trackingNumber=" +
            encodeURIComponent(tracking_number) +
            "&fileType=" +
            encodeURIComponent(fileType) +
            "&userId=" +
            encodeURIComponent(id) // Pass userId as parameter
        );
      } else {
        // If user cancels, you can handle it accordingly
        console.log("File update cancelled by user.");
      }
    }, 1000); // Adjust the delay as needed
  };
}
