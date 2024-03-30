 <!-- RESIDENTS FORM VIEW -->
 <div class="overlayR"></div>

 <div class="residentsForm">

     <div class="rtopheadcon">


         <div class="rheadTitle">

             <div class="rheadcon">
                 <div class="line"></div>
                 <p>ADD RESIDENT'S INFORMATION</p>
                 <div class="line"></div>
                 <i class='bx bxs-x-circle' onclick="hideResidentForm()"></i>
             </div>

         </div>
     </div>
     <!-- form  -->


     <form id="formContainer" action="../php/addResidents.php" method="post" enctype="multipart/form-data">
         <div class=" rform1">

             <input type="hidden" id="memberCount" name="memberCount" value="0">

             <div class="rInput">
                 <label for="BHS">BHS</label>
                 <input type="text" id="textbox" name="BHS" placeholder="Enter BHS" required>
             </div>

             <div class="rInput">
                 <label for="Purok">Purok/Sitio/Subdivision</label>
                 <input type="text" id="textbox" name="Purok" placeholder="Enter Purok/Sitio/Subdivision" required>
             </div>

             <div class="rInput">
                 <label for="Household">Household Number</label>
                 <input type="text" id="textbox" name="Household" placeholder="Enter Household Number" required>
             </div>

         </div>

         <div class="rform1">

             <div class="rInput">
                 <label for="Lastname">Last Name</label>
                 <input type="text" id="textbox" name="Lastname" placeholder="Enter Lastname" required>
             </div>

             <div class="rInput">
                 <label for="Firstname">First Name</label>
                 <input type="text" id="textbox" name="Firstname" placeholder="Enter Firstname" required>
             </div>

             <div class="rInput">
                 <label for="Maiden">Mother’s Maiden Name</label>
                 <input type="text" id="textbox" name="Maiden" placeholder="Enter Mother’s Maiden Name" required>
             </div>

         </div>

         <div class="rform1">

             <div class="rInput">
                 <label for="Age">Age</label>
                 <input type="text" id="textbox" name="Age" placeholder="Enter Age" oninput="validateAge(this)"
                     required>
             </div>

             <div class="rInput">
                 <label for="Gender">Gender</label>
                 <select class="selectbox" id="bussSelect3" name="Gender" required
                     onchange="changeFontColor('bussSelect3')">
                     <option value="">Select Gender</option>
                     <option value="Male">Male</option>
                     <option value="Female">Female</option>
                 </select>
             </div>

             <div class="rInput">
                 <label for="VotersID">Voter's ID</label>
                 <select class="selectbox" id="bussSelect4" name="VotersID" required onchange="changeToTextbox1(this)">
                     <option value="">Select</option>
                     <option value="None">No</option>
                     <option value="Yes">Yes</option>
                 </select>
             </div>

             <div class="rInput2">
                 <label for="avatar" class="required1">Upload Voter's ID</label>
                 <input class="rIDupload" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" required
                     disabled />
             </div>

         </div>

         <div class="rform1">

             <div class="rInput">
                 <label for="NHTS">NHTS Household</label>
                 <select class="selectbox" id="bussSelect1" name="NHTS" required
                     onchange="changeFontColor('bussSelect1')">
                     <option value="">Select</option>
                     <option value="NHTS-4Ps">NHTS-4Ps</option>
                     <option value="NHTS-Non-4Ps">NHTS-Non-4Ps</option>
                     <option value="Non-NHTS">Non-NHTS</option>
                 </select>
             </div>

             <div class="rInput">
                 <label for="IP">IP or Non-IP</label>
                 <select class="selectbox" id="bussSelect8" name="IP" required
                     onchange="changeFontColor('bussSelect8')">
                     <option value="">Select</option>
                     <option value="IP">IP</option>
                     <option value="Non-IP">Non-IP</option>
                 </select>
             </div>

             <div class="rInput">
                 <label for="HH">HH Head PhilHealth Member</label>

                 <select class="selectbox" id="bussSelect2" name="HH" required onchange="changeToTextbox(this)">
                     <option value="">Select</option>
                     <option value="No">No</option>
                     <option value="Yes">Yes</option>
                 </select>
             </div>

             <div class="rInput">
                 <label for="Category">Category</label>
                 <select class="selectbox" id="Category" name="Category" required disabled
                     onchange="changeToTextbox(this)">
                     <option value="">Select</option>
                     <option value="FORMAL ECONOMY">FORMAL ECONOMY</option>
                     <option value="INFORMAL ECONOMY">INFORMAL ECONOMY</option>
                     <option value="INDIGENT">INDIGENT</option>
                     <option value="SPONSORED">SPONSORED</option>
                     <option value="LIFETIME MEMBER">LIFETIME MEMBER</option>
                 </select>
             </div>

         </div>

         <!-- HOUSEHOLD MEMEBERS -->
         <div class="rheadTitle">

             <div class="rheadcon">
                 <div class="line"></div>
                 <p>HOUSEHOLD MEMBER</p>
                 <div class="line"></div>
             </div>

         </div>

         <div class="addmember">
             <div class="rform1">

                 <div class="rInput">
                     <label for="mLastname">Last Name</label>
                     <input type="text" id="textbox" name="mLastname" placeholder="Enter Lastname" required>
                 </div>

                 <div class="rInput">
                     <label for="mFirstname">First Name</label>
                     <input type="text" id="textbox" name="mFirstname" placeholder="Enter Firstname" required>
                 </div>

                 <div class="rInput">
                     <label for="mMaiden">Mother’s Maiden Name</label>
                     <input type="text" id="textbox" name="mMaiden" placeholder="Enter Mother’s Maiden Name" required>
                 </div>

             </div>

             <div class="rform1">

                 <div class="rInput">
                     <label for="mRelationship">Relationship</label>
                     <select class="selectbox" id="bussSelect6" name="mRelationship" required
                         onchange="changeToTextbox2(this)">
                         <option value="">Select Relationship</option>
                         <option value="Head">Head</option>
                         <option value="Spouse">Spouse</option>
                         <option value="Son">Son</option>
                         <option value="Daughter">Daughter</option>
                         <option value="Others">Others</option>
                     </select>
                 </div>

                 <div class="rInput">
                     <label for="mGender">Gender</label>
                     <select class="selectbox" id="bussSelect7" name="mGender" required
                         onchange="changeFontColor('bussSelect7')">
                         <option value="">Select</option>
                         <option value="Male">Male</option>
                         <option value="Female">Female</option>
                     </select>
                 </div>




                 <div class="rInput">
                     <label for="mAge">Age</label>
                     <input type="text" id="textbox" name="mAge" placeholder="Enter Age" oninput="validateAge(this)"
                         required>
                 </div>

             </div>

             <div class="rform1">
                 <div class="rInput">
                     <label for="mRisk">Classification by Age/Health Risk</label>
                     <select class="selectbox" id="bussSelect9" name="mRisk" required
                         onchange="changeFontColor('bussSelect9')">
                         <option value="">Select</option>
                         <option value="Male">Newborn</option>
                         <option value="Female">Infant (29days-11 months old)</option>
                         <option value="Male">Under-five (1-4 years old)</option>
                         <option value="Female">School-aged children (5-9 years old)</option>
                         <option value="Male">Adolescents (10-19 years old)</option>
                         <option value="Female">Pregnant</option>
                         <option value="Male">Persons with disability</option>
                         <option value="Female">Adult (≥25 years old) </option>
                         <option value="Male">Adolescent-Pregnant</option>
                         <option value="Female">Post Partum</option>
                         <option value="Female">Senior Citizen</option>
                     </select>
                 </div>



                 <div class="rInput">
                     <label for="mQuarter">Quarter</label>
                     <select class="selectbox" id="bussSelect10" name="mQuarter" required
                         onchange="changeFontColor('bussSelect10')">
                         <option value="">Select Quarter</option>
                         <option value="First">First</option>
                         <option value="Second">Second</option>
                         <option value="Third">Third</option>
                         <option value="Fourth">Fourth</option>
                     </select>
                 </div>
             </div>

         </div>

         <div class="addMember" onclick="addMember()">
             <span>+ Add Household Member</span>
         </div>

         <div class="rButcon">
             <button type="submit" class="rSubmit">Submit</button>
         </div>

     </form>
 </div>