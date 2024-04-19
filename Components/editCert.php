 <div class="overlayR1"></div>

 <div class="residentsForm2" style="border: 4px solid #377fb9;">

     <div class=" formform2">

         <div class="rtopheadcon">

             <div class="rheadTitle">

                 <div class="rheadcon">
                     <div class="line"></div>
                     <p>EDIT CERTIFICATE INFORMATION</p>
                     <div class="line"></div>
                     <i class='bx bxs-x-circle' onclick='hideDivs()'></i>
                 </div>

             </div>
         </div>
         <!-- form  -->

         <form action="../Php/updateCert.php" method="post">
             <div class="rform1">

                 <input type="hidden" id="idnumC" name="idnumC">
                 <input type="hidden" id="typeC" name="typeC">
                 <input type="hidden" id="trackingC" name="trackingC">
                 <div class="rInput">
                     <label for="fname">Firstname</label>
                     <input type="text" id="fnameC" name="fnameC" placeholder="Enter Firstname" required>
                 </div>

                 <div class="rInput">
                     <label for="lname">Lastname</label>
                     <input type="text" id="lnameC" name="lnameC" placeholder="Enter Lastname" required>
                 </div>
             </div>

             <div class="rform1">
                 <div class="rInput">
                     <label for="idnum">Purpose</label>
                     <input type="text" id="PurposeC" name="PurposeC" placeholder="Enter Purpose" required>
                 </div>

                 <div class="rInputRe">
                     <label for="ResidencyC">Residency length</label>
                     <input type="text" id="ResidencyC" name="ResidencyC" placeholder="Enter Residency length" required>
                 </div>

                 <div class="rInput">
                     <label for="lname">Address</label>
                     <input type="text" id="AddressC" name="AddressC" placeholder="Enter Address" required>
                 </div>
             </div>

             <div class="rButcon">
                 <button type="submit" class="rSubmit2" disabled>SAVE</button>
             </div>
         </form>

     </div>

 </div>