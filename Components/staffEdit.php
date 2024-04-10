 <div class="overlayR1"></div>

 <div class="residentsForm2">

     <div class="formform2">

         <div class="rtopheadcon">

             <div class="rheadTitle">

                 <div class="rheadcon">
                     <div class="line"></div>
                     <p>EDIT STAFF INFORMATION</p>
                     <div class="line"></div>
                     <i class='bx bxs-x-circle' onclick='hideElements1()'></i>
                 </div>

             </div>
         </div>
         <!-- form  -->

         <form action="../Php/updateStaff.php" method="post">
             <div class="rform1">
                 <div class="rInput">
                     <label for="idnum">ID Number</label>
                     <input type="text" id="idnum" name="idnum" placeholder="Enter Id Number" required>
                 </div>

                 <div class="rInput">
                     <label for="fname">Firstname</label>
                     <input type="text" id="fname" name="fname" placeholder="Enter Firstname" required>
                 </div>

                 <div class="rInput">
                     <label for="lname">Lastname</label>
                     <input type="text" id="lname" name="lname" placeholder="Enter Lastname" required>
                 </div>
             </div>

             <div class="rButcon">
                 <button type="submit" class="rSubmit2" disabled>SAVE</button>
             </div>
         </form>

     </div>

 </div>