// ─── Resident Form ────────────────────────────────────────────
function changeFontColor(dropDownId) {
  var selectBox = document.getElementById(dropDownId);
  var selectedOption = selectBox.options[selectBox.selectedIndex].value;

  if (selectedOption !== "") {
    selectBox.style.color = "#000000";
  } else {
    selectBox.style.color = "#757575";
  }
}

// ─── Household number ──────────────────────────────────────────
function validateNumberInput(input) {
  // Remove non-numeric characters
  input.value = input.value.replace(/[^0-9]/g, "");
}

// ─── Philhealth ───────────────────────────────────────────────
function changeToTextbox(selectBox) {
  changeFontColor(selectBox.id);

  if (selectBox.value === "Yes") {
    var textBox = document.createElement("input");
    textBox.type = "text";
    textBox.name = selectBox.name;
    textBox.required = true;
    textBox.placeholder = "Enter your PhilHealth Number";
    textBox.pattern = "[0-9-]*";

    // Add an event listener for input event to restrict the input to numbers and hyphens
    textBox.addEventListener("input", function () {
      this.value = this.value.replace(/[^0-9-]/g, ""); // Replace anything that is not a number or "-"
    });

    // Store the original select box in a variable
    var originalSelectBox = selectBox;

    // Add an event listener for the blur event
    textBox.addEventListener("blur", function () {
      // If the text box is empty, replace it with the original select box
      if (this.value === "") {
        // Set the value of the select box to "No"
        originalSelectBox.value = "No";
        this.parentNode.replaceChild(originalSelectBox, this);
        // Disable the "Category" input and remove the 'required' attribute
        var categoryInput = document.getElementById("Category");
        categoryInput.disabled = true;
        categoryInput.removeAttribute("required");
        categoryInput.value = "";
      } else {
        // If the text box has a value, enable the "Category" input and add the 'required' attribute
        var categoryInput = document.getElementById("Category");
        categoryInput.disabled = false;
        categoryInput.required = true;
      }
    });

    selectBox.parentNode.replaceChild(textBox, selectBox);
  }
}

// ─── Voters Id ────────────────────────────────────────────────
function changeToTextbox1(selectBox) {
  changeFontColor(selectBox.id);

  if (selectBox.value === "Yes") {
    var textBox = document.createElement("input");
    textBox.type = "text";
    textBox.name = selectBox.name;
    textBox.required = true;
    textBox.placeholder = "Enter your Voter's ID Number";

    var originalSelectBox = selectBox;
    // var uploadDiv = document.querySelector(".rInput2");
    var avatarInput = document.getElementById("avatar");

    textBox.addEventListener("blur", function () {
      if (textBox.value === "") {
        originalSelectBox.value = "No";
        textBox.parentNode.replaceChild(originalSelectBox, textBox);
        // uploadDiv.style.display = "none";
        avatarInput.disabled = true;
        avatarInput.removeAttribute("required");
      } else {
        // uploadDiv.style.display = "block";
        avatarInput.disabled = false;
        avatarInput.required = true;
      }
    });

    selectBox.parentNode.replaceChild(textBox, selectBox);
  }
}

// ─── Relationship ─────────────────────────────────────────────
function changeToTextbox2(selectBox) {
  changeFontColor(selectBox.id);

  if (selectBox.value === "Others") {
    var textBox = document.createElement("input");
    textBox.type = "text";
    textBox.name = selectBox.name;
    textBox.required = true;
    textBox.placeholder = "Specify the relationship";

    var originalSelectBox = selectBox;

    textBox.addEventListener("blur", function () {
      if (textBox.value === "") {
        originalSelectBox.value = "";
        textBox.parentNode.replaceChild(originalSelectBox, textBox);
      }
    });

    selectBox.parentNode.replaceChild(textBox, selectBox);
  }
}

// ─── Toggle Resident Add ──────────────────────────────────────
function toggleResidentForm() {
  document.querySelector(".residentsForm").style.display = "block";
  document.querySelector(".overlayR").style.display = "block";
}

function hideResidentForm() {
  document.querySelector(".residentsForm").style.display = "none";
  document.querySelector(".overlayR").style.display = "none";
}

// ─── Add Member ───────────────────────────────────────────────
var memberCount = 0;
function addMember() {
  memberCount++;
  document.querySelector(".addMember7").style.display = "none";
  var newMember = document.createElement("div");
  newMember.className = "addmember";
  newMember.innerHTML = `
               <div class="addmember">
         <div class="rheadTitle">

                        <div class="rheadcon">
                            <div class="line"></div>
                            <p>HOUSEHOLD MEMBER ${memberCount}</p>
                            <div class="line"></div>
                        </div>

                    </div>
                        <div class="rform1">


                            <div class="rInput">
                                <label for="mLastname${memberCount}">Last Name</label>
                                <input type="text" id="mLastname" name="mLastname${memberCount}" placeholder="Enter Lastname" >
                            </div>

                            <div class="rInput">
                                <label for="mFirstname${memberCount}">First Name</label>
                                <input type="text" id="mFirstname" name="mFirstname${memberCount}" placeholder="Enter Firstname" >
                            </div>

                            <div class="rInput">
                                <label for="mMaiden${memberCount}">Mother’s Maiden Name</label>
                                <input type="text" id="textbox" name="mMaiden${memberCount}" placeholder="Enter Mother’s Maiden Name" >
                            </div>

                        </div>

                        <div class="rform1">

                            <div class="rInput">
                                <label for="mRelationship${memberCount}">Relationship</label>
                              <select class="selectbox" id="bussSelect6" name="mRelationship${memberCount}"  onchange="changeToTextbox2(this)">
                                <option value="">Select Relationship</option>
                                <option value="Head">Head</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Son">Son</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Others">Others</option>
                              </select>
                            </div>

                            <div class="rInput">
                                <label for="mGender${memberCount}">Gender</label>
                                <select class="selectbox" id="bussSelect7" name="mGender${memberCount}"  onchange="changeFontColor('bussSelect7')">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="rInput">
                                <label for="mAge${memberCount}">Age</label>
                                <input type="text" id="textbox" name="mAge${memberCount}" placeholder="Enter Age"  oninput="validateAge(this)">
                            </div>

                        </div>

                        <div class="rform1">

                            <div class="rInput">
                                <label for="mRisk${memberCount}">Classification by Age/Health Risk</label>
                                <select class="selectbox" id="bussSelect9" name="mRisk${memberCount}"  onchange="changeFontColor('bussSelect9')">
                                    <option value="">Select</option>
                         <option value="Newborn">Newborn</option>
                         <option value="Infant (29days-11 months old)">Infant (29days-11 months old)</option>
                         <option value="Under-five (1-4 years old)">Under-five (1-4 years old)</option>
                         <option value="School-aged children (5-9 years old)">School-aged children (5-9 years old)
                         </option>
                         <option value="Adolescents (10-19 years old)">Adolescents (10-19 years old)</option>
                         <option value="Pregnant">Pregnant</option>
                         <option value="Persons with disability">Persons with disability</option>
                         <option value="Adult (≥25 years old)">Adult (≥25 years old) </option>
                         <option value="Adolescent-Pregnant">Adolescent-Pregnant</option>
                         <option value="Post Partum">Post Partum</option>
                         <option value="Senior Citizen">Senior Citizen</option>
                                </select>
                            </div>

                            <div class="rInput">
                                <label for="mQuarter${memberCount}">Quarter</label>
                                <select class="selectbox" id="bussSelect10" name="mQuarter${memberCount}"
                                    onchange="changeFontColor('bussSelect10')">
                                    <option value="">Select Quarter</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                    <option value="Fourth">Fourth</option>
                                </select>
                            </div>

                        </div>

                   <div class="addMember1" onclick="removeMember(this.parentElement)">
  <span>- Remove Household Member</span>
</div>

                    </div>

                </div>
        `;
  var formContainer = document.getElementById("formContainer");
  var addMemberButton = document.querySelector(".addMember");

  formContainer.insertBefore(newMember, addMemberButton);

  // Update the total number of family members
  var memberCountField = document.getElementById("memberCount");
  memberCountField.value = memberCount;
}

function removeMember(member) {
  document.querySelector(".addMember7").style.display = "block";
  member.remove();
  memberCount--;

  // Update the total number of family members
  var memberCountField = document.getElementById("memberCount");
  memberCountField.value = memberCount;
}

// ─── Add Member ───────────────────────────────────────────────
var memberCount = 0;
function addMember1() {
  memberCount++;
  var newMember = document.createElement("div");
  newMember.className = "addmember";
  newMember.innerHTML = `
               <div class="addmember">
         <div class="rheadTitle">

                        <div class="rheadcon">
                            <div class="line"></div>
                            <p>ADD HOUSEHOLD MEMBER ${memberCount}</p>
                            <div class="line"></div>
                        </div>

                    </div>
                        <div class="rform1">


                            <div class="rInput">
                                <label for="mLastname${memberCount}">Last Name</label>
                                <input type="text" id="mLastname" name="mLastname${memberCount}" placeholder="Enter Lastname" required>
                            </div>

                            <div class="rInput">
                                <label for="mFirstname${memberCount}">First Name</label>
                                <input type="text" id="mFirstname" name="mFirstname${memberCount}" placeholder="Enter Firstname" required>
                            </div>

                            <div class="rInput">
                                <label for="mMaiden${memberCount}">Mother’s Maiden Name</label>
                                <input type="text" id="textbox" name="mMaiden${memberCount}" placeholder="Enter Mother’s Maiden Name" required>
                            </div>

                        </div>

                        <div class="rform1">

                            <div class="rInput">
                                <label for="mRelationship${memberCount}">Relationship</label>
                              <select class="selectbox" id="bussSelect6" name="mRelationship${memberCount}" required onchange="changeToTextbox2(this)">
                                <option value="">Select Relationship</option>
                                <option value="Head">Head</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Son">Son</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Others">Others</option>
                              </select>
                            </div>

                            <div class="rInput">
                                <label for="mGender${memberCount}">Gender</label>
                                <select class="selectbox" id="bussSelect7" name="mGender${memberCount}" required onchange="changeFontColor('bussSelect7')">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="rInput">
                                <label for="mAge${memberCount}">Age</label>
                                <input type="text" id="textbox" name="mAge${memberCount}" placeholder="Enter Age"  oninput="validateAge(this)"required>
                            </div>

                        </div>

                        <div class="rform1">

                            <div class="rInput">
                                <label for="mRisk${memberCount}">Classification by Age/Health Risk</label>
                                <select class="selectbox" id="bussSelect9" name="mRisk${memberCount}" required onchange="changeFontColor('bussSelect9')">
                                   <option value="">Select</option>
                         <option value="Newborn">Newborn</option>
                         <option value="Infant (29days-11 months old)">Infant (29days-11 months old)</option>
                         <option value="Under-five (1-4 years old)">Under-five (1-4 years old)</option>
                         <option value="School-aged children (5-9 years old)">School-aged children (5-9 years old)
                         </option>
                         <option value="Adolescents (10-19 years old)">Adolescents (10-19 years old)</option>
                         <option value="Pregnant">Pregnant</option>
                         <option value="Persons with disability">Persons with disability</option>
                         <option value="Adult (≥25 years old)">Adult (≥25 years old) </option>
                         <option value="Adolescent-Pregnant">Adolescent-Pregnant</option>
                         <option value="Post Partum">Post Partum</option>
                         <option value="Senior Citizen">Senior Citizen</option>
                                </select>
                            </div>

                            <div class="rInput">
                                <label for="mQuarter${memberCount}">Quarter</label>
                                <select class="selectbox" id="bussSelect10" name="mQuarter${memberCount}" required
                                    onchange="changeFontColor('bussSelect10')">
                                    <option value="">Select Quarter</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                    <option value="Fourth">Fourth</option>
                                </select>
                            </div>

                        </div>

                   <div class="addMember3" onclick="removeMember(this.parentElement)">
  <span>- Remove Household Member</span>
</div>

                    </div>

                </div>
        `;
  var formContainer = document.getElementById("formContainer3");
  var addMemberButton = document.querySelector(".addMember4");

  formContainer.insertBefore(newMember, addMemberButton);

  // Update the total number of family members
  var memberCountField = document.getElementById("memberCount");
  memberCountField.value = memberCount;
}

function removeMember1(member) {
  member.remove();
  memberCount--;

  // Update the total number of family members
  var memberCountField = document.getElementById("memberCount");
  memberCountField.value = memberCount;
}

// ─── Age Validate ─────────────────────────────────────────────
function validateAge(input) {
  // Remove non-numeric characters
  input.value = input.value.replace(/\D/g, "");

  // Limit to two digits
  if (input.value.length > 2) {
    input.value = input.value.slice(0, 2);
  }
}

// ─── View Residents Data ──────────────────────────────────────
var selectedRowId;
function toggleResidentForm1(id) {
  document.querySelector(".residentsForm1").style.display = "block";
  document.querySelector(".overlayR").style.display = "block";
  document.querySelector(".formform").style.display = "block";
  document.querySelector(".formform1").style.display = "none";
  document.querySelector(".residentsForm1").style.border = "";

  selectedRowId = id;

  fetchresidentData(selectedRowId);

  $.ajax({
    url: "../Php/viewResidents.php",
    type: "POST",
    data: { id: selectedRowId },
    success: function (data) {
      var parsedData = JSON.parse(data);

      $("#BHS").val(parsedData[0].rBHS);
      $("#Purok").val(parsedData[0].rPurokSitioSubdivision);
      $("#Household").val(parsedData[0].rHouseholdNumber);
      $("#Lastname").val(parsedData[0].rLastName);
      $("#Firstname").val(parsedData[0].rFirstName);
      $("#Maiden").val(parsedData[0].rMothersMaidenName);
      $("#Age").val(parsedData[0].rAge);
      $("#Gender").val(parsedData[0].rGender);
      $("#VotersID").val(parsedData[0].rVotersID);
      $("#NHTS").val(parsedData[0].rNHTSHousehold);
      $("#IP").val(parsedData[0].rIP);

      var rHHHeadPhilHealthMember = parsedData[0].rHHHeadPhilHealthMember;

      // Check if the fetched data is empty or not
      if (rHHHeadPhilHealthMember) {
        $("#HH").val(rHHHeadPhilHealthMember);
      } else {
        $("#HH").val("No");
      }

      $("#Category1").val(parsedData[0].rCategory);
      // $("#avatar").val(parsedData[0].voters_id_image);

      // Clear the existing members
      $(".membersCon").empty();
      // Loop through each member
      parsedData.forEach(function (member, index) {
        // Create a new member element
        var memberElement = `

<div class="rheadTitle">

            <div class="rheadcon">
                <div class="line"></div>
                <p>HOUSEHOLD MEMBER ${index + 1}</p>
                <div class="line"></div>
            </div>

        </div>

    <div class="rform1">

      <div class="rInput">
        <label for="mLastname">Last Name</label>
        <input type="text" id="mLastname" name="mLastname" placeholder="Enter Lastname" readonly value="${
          member.mLastName
        }">
      </div>

      <div class="rInput">
        <label for="mFirstname">First Name</label>
        <input type="text" id="mFirstname" name="mFirstname" placeholder="Enter Firstname" readonly value="${
          member.mFirstName
        }">
      </div>

      <div class="rInput">
        <label for="mMaiden">Mother’s Maiden Name</label>
        <input type="text" id="mMaiden" name="mMaiden" placeholder="Enter Mother’s Maiden Name" readonly value="${
          member.mMothersMaidenName
        }">
      </div>

      </div>

        <div class="rform1">
      <div class="rInput">
        <label for="mRelationship">Relationship</label>
        <input type="text" id="mRelationship" name="mRelationship" placeholder="Enter Relationship" readonly value="${
          member.mRelationship
        }">
      </div>

      <div class="rInput">
        <label for="mSex">Sex</label>
        <input type="text" id="mSex" name="mSex" placeholder="Enter Sex" readonly value="${
          member.mSex
        }">
      </div>

      <div class="rInput">
        <label for="mAge">Age</label>
        <input type="text" id="mAge" name="mAge" placeholder="Enter Age" readonly value="${
          member.mAge
        }">
      </div>
        </div>

<div class="rform1">
      <div class="rInput">
        <label for="mRisk">Classification By Age Health Risk</label>
        <input type="text" id="mRisk" name="mRisk" placeholder="Enter Classification By Age Health Risk" readonly value="${
          member.mClassificationByAgeHealthRisk
        }">
      </div>

      <div class="rInput">
        <label for="mQuarter">Quarter</label>
        <input type="text" id="mQuarter" name="mQuarter" placeholder="Enter Quarter" readonly value="${
          member.mQuarter
        }">
      </div>
    </div>


        `;
        // Append the new member element to the parent
        $(".membersCon").append(memberElement);
      });
    },
    error: function (jqXHR, textStatus, errorThrown) {},
  });

  // ─── Delete RECORD ─────────────────────────────────────────────
  document.querySelector(".yes1").addEventListener("click", function () {
    // Call the delete function
    deleteRecordAndFamilyMembers(selectedRowId);
  });

  function deleteRecordAndFamilyMembers(id) {
    $.ajax({
      url: "../Php/deleteRecord.php",
      type: "POST",
      data: { id: id },
      success: function (data) {
        if (data === "success") {
          // Redirect on success
          window.location.href = "../Dashboard/ResidentsRecord.php";
        } else {
          // Handle failure case
          console.log("Deletion failed");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Handle the error case
        console.log(textStatus, errorThrown);
      },
    });
  }
}

// ─── Delete Popup ─────────────────────────────────────────────
document.querySelector(".rSubmit1").addEventListener("click", function () {
  document.querySelector(".overlayD").style.display = "block";
  document.querySelector(".modalD").style.display = "block";

  var yesButton = document.querySelector(".yes1");
  yesButton.disabled = true;

  var counter = 5;
  yesButton.innerText = `Yes (${counter})`;

  var intervalId = setInterval(function () {
    counter--;
    if (counter >= 0) {
      yesButton.innerText = `Yes (${counter})`;
    } else {
      yesButton.disabled = false;
      yesButton.innerText = "Yes";
      clearInterval(intervalId);
    }
  }, 1000);

  yesButton.addEventListener("click", function () {
    // Add your delete logic here
    clearInterval(intervalId);
    yesButton.innerText = "Yes";
    yesButton.disabled = true;
  });

  document.querySelector(".no1").addEventListener("click", function () {
    document.querySelector(".overlayD").style.display = "none";
    document.querySelector(".modalD").style.display = "none";
    clearInterval(intervalId);
    yesButton.innerText = "Yes";
    yesButton.disabled = true;
  });
});

// ─── Edit Resident Information ────────────────────────────────
function toggleAndPopulateForms() {
  event.preventDefault();
  var form1 = document.querySelector(".formform");
  var form2 = document.querySelector(".formform1");
  var buttonUp = document.querySelector(".rSubmit2");
  var mainForm = document.querySelector(".residentsForm1");

  // Initially disable the button
  buttonUp.disabled = true;

  // Add event listener to the form
  form2.addEventListener("input", function () {
    // Enable the button when the form changes
    buttonUp.disabled = false;
  });

  if (form1.style.display === "block" || form1.style.display === "") {
    form1.style.display = "none";
    form2.style.display = "block";
    buttonUp.style.display = "block";
    mainForm.style.border = "6px solid #377fb9";
  } else {
    form1.style.display = "block";
    form2.style.display = "none";
    buttonUp.style.display = "none";
    mainForm.style.border = "";
  }
}

function fetchresidentData(id) {
  $.ajax({
    url: "../Php/viewResidents.php",
    type: "POST",
    data: { id: selectedRowId },
    success: function (data) {
      var parsedData = JSON.parse(data);

      if (parsedData.error) {
      } else {
        var record = parsedData[0];

        document.getElementById("BHS1").value = record.rBHS;
        document.getElementById("Purok1").value = record.rPurokSitioSubdivision;
        document.getElementById("Household1").value = record.rHouseholdNumber;

        document.getElementById("Lastname1").value = record.rLastName;
        document.getElementById("Firstname1").value = record.rFirstName;
        document.getElementById("Maiden1").value = record.rMothersMaidenName;

        document.getElementById("Age1").value = record.rAge;
        document.getElementById("bussSelect31").value = record.rGender;

        var votersIDElement = document.getElementById("bussSelect41");
        votersIDElement.value = record.rVotersID;

        if (votersIDElement.value !== "None") {
          var newInput = document.createElement("input");
          newInput.id = "bussSelect41"; // Set the ID to "VotersID"
          newInput.value = votersIDElement.value;
          votersIDElement.parentNode.replaceChild(newInput, votersIDElement);
        }

        document.getElementById("bussSelect11").value = record.rNHTSHousehold;
        document.getElementById("bussSelect81").value = record.rIP;
        if (record.rHHHeadPhilHealthMember === "No") {
          document.getElementById("bussSelect21").value = "";
        } else {
          document.getElementById("bussSelect21").value =
            record.rHHHeadPhilHealthMember;
        }

        document.getElementById("Category11").value = record.rCategory;

        // Clear the existing members
        $(".membersContainer").empty();
        var memberNumber = 1;

        parsedData.forEach(function (member) {
          var memberElement = `

    <div class="membersCon1">
             <div class="rheadTitle">

                 <div class="rheadcon">
                     <div class="line"></div>
                     <p>HOUSEHOLD MEMBER ${memberNumber}</p>
                     <div class="line"></div>
                 </div>

             </div>

             <div class="addmember">
                 <div class="rform1">

                     <div class="rInput">
                         <label for="mLastname">Last Name</label>
                         <input type="text" id="textbox" name="mLastname" placeholder="Enter Lastname" value="${
                           member.mLastName
                         }" >
                     </div>

                     <div class="rInput">
                         <label for="mFirstname">First Name</label>
                         <input type="text" id="textbox" name="mFirstname" placeholder="Enter Firstname" value="${
                           member.mFirstName
                         }" >
                     </div>

                     <div class="rInput">
                         <label for="mMaiden">Mother’s Maiden Name</label>
                         <input type="text" id="textbox" name="mMaiden" placeholder="Enter Mother’s Maiden Name" value="${
                           member.mMothersMaidenName
                         }"
                              >
                     </div>

                 </div>

                 <div class="rform1">

                     <div class="rInput">
                         <label for="mRelationship">Relationship</label>
                        <select class="selectbox" id="bussSelect6" name="mRelationship"  onchange="changeToTextbox2(this)">
                          <option value="">Select Relationship</option>
                          <option value="Head" ${
                            member.mRelationship === "Head" ? "selected" : ""
                          }>Head</option>
                          <option value="Spouse" ${
                            member.mRelationship === "Spouse" ? "selected" : ""
                          }>Spouse</option>
                          <option value="Son" ${
                            member.mRelationship === "Son" ? "selected" : ""
                          }>Son</option>
                          <option value="Daughter" ${
                            member.mRelationship === "Daughter"
                              ? "selected"
                              : ""
                          }>Daughter</option>
                          <option value="Others" ${
                            member.mRelationship === "Others" ? "selected" : ""
                          }>Others</option>
                        </select>
                     </div>

                     <div class="rInput">
                         <label for="mGender">Gender</label>
                         <select class="selectbox" id="bussSelect7" name="mGender"  onchange="changeFontColor('bussSelect7')" value="${
                           member.mAge
                         }">
    <option value="">Select</option>
    <option value="Male" ${
      member.mSex === "Male" ? "selected" : ""
    }>Male</option>
    <option value="Female" ${
      member.mSex === "Female" ? "selected" : ""
    }>Female</option>
</select>
                     </div>




                     <div class="rInput">
                         <label for="mAge">Age</label>
                         <input type="text" id="textbox" name="mAge" placeholder="Enter Age" oninput="validateAge(this)" value="${
                           member.mAge
                         }"
                             >
                     </div>

                 </div>

                 <div class="rform1">
                     <div class="rInput">
                         <label for="mRisk">Classification by Age/Health Risk</label>
                        <select class="selectbox" id="bussSelect9" name="mRisk"  onchange="changeFontColor('bussSelect9')">
                          <option value="">Select</option>
                          <option value="Newborn" ${
                            member.mClassificationByAgeHealthRisk === "Newborn"
                              ? "selected"
                              : ""
                          }>Newborn</option>
                          <option value="Infant (29days-11 months old)" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Infant (29days-11 months old)"
                              ? "selected"
                              : ""
                          }>Infant (29days-11 months old)</option>
                          <option value="Under-five (1-4 years old)" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Under-five (1-4 years old)"
                              ? "selected"
                              : ""
                          }>Under-five (1-4 years old)</option>
                          <option value="School-aged children (5-9 years old)" ${
                            member.mClassificationByAgeHealthRisk ===
                            "School-aged children (5-9 years old)"
                              ? "selected"
                              : ""
                          }>School-aged children (5-9 years old)</option>
                          <option value="Adolescents (10-19 years old)" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Adolescents (10-19 years old)"
                              ? "selected"
                              : ""
                          }>Adolescents (10-19 years old)</option>
                          <option value="Pregnant" ${
                            member.mClassificationByAgeHealthRisk === "Pregnant"
                              ? "selected"
                              : ""
                          }>Pregnant</option>
                          <option value="Persons with disability" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Persons with disability"
                              ? "selected"
                              : ""
                          }>Persons with disability</option>
                          <option value="Adult (≥25 years old)" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Adult (≥25 years old)"
                              ? "selected"
                              : ""
                          }>Adult (≥25 years old)</option>
                          <option value="Adolescent-Pregnant" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Adolescent-Pregnant"
                              ? "selected"
                              : ""
                          }>Adolescent-Pregnant</option>
                          <option value="Post Partum" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Post Partum"
                              ? "selected"
                              : ""
                          }>Post Partum</option>
                          <option value="Senior Citizen" ${
                            member.mClassificationByAgeHealthRisk ===
                            "Senior Citizen"
                              ? "selected"
                              : ""
                          }>Senior Citizen</option>
                        </select>
                     </div>



                     <div class="rInput">
                         <label for="mQuarter">Quarter</label>
                        <select class="selectbox" id="bussSelect10" name="mQuarter" onchange="changeFontColor('bussSelect10')">
                          <option value="">Select Quarter</option>
                          <option value="First" ${
                            member.mQuarter === "First" ? "selected" : ""
                          }>First</option>
                          <option value="Second" ${
                            member.mQuarter === "Second" ? "selected" : ""
                          }>Second</option>
                          <option value="Third" ${
                            member.mQuarter === "Third" ? "selected" : ""
                          }>Third</option>
                          <option value="Fourth" ${
                            member.mQuarter === "Fourth" ? "selected" : ""
                          }>Fourth</option>
                        </select>
                     </div>
                 </div>

             </div>



         </div>
          `;
          // Append the new member element to the parent
          $(".membersContainer").append(memberElement);
          memberNumber++;
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error:", errorThrown);
    },
  });
}

// ─── Information Update ───────────────────────────────────────
function submitFormResident() {
  $("#formContainer3").on("submit", function (event) {
    event.preventDefault();

    var formData = {
      id: selectedRowId,
      rBHS: $("#BHS1").val(),
      rPurokSitioSubdivision: $("#Purok1").val(),
      rHouseholdNumber: $("#Household1").val(),
      rLastName: $("#Lastname1").val(),
      rFirstName: $("#Firstname1").val(),
      rMothersMaidenName: $("#Maiden1").val(),
      rAge: $("#Age1").val(),
      rGender: $("#bussSelect31").val(),
      rVotersID: $("#bussSelect41").val(),
      rNHTSHousehold: $("#bussSelect11").val(),
      rIP: $("#bussSelect81").val(),
      rHHHeadPhilHealthMember: $("#bussSelect21").val(),
      rCategory: $("#Category11").val(),
      members: [],
    };

    $(".membersCon1").each(function () {
      var member = {
        mLastName: $(this).find("input[name='mLastname']").val(),
        mFirstName: $(this).find("input[name='mFirstname']").val(),
        mMothersMaidenName: $(this).find("input[name='mMaiden']").val(),
        mRelationship: $(this).find("select[name='mRelationship']").val(),
        mGender: $(this).find("select[name='mGender']").val(),
        mAge: $(this).find("input[name='mAge']").val(),
        mClassificationByAgeHealthRisk: $(this)
          .find("select[name='mRisk']")
          .val(),
        mQuarter: $(this).find("select[name='mQuarter']").val(),
      };
      formData.members.push(member);
    });

    $.ajax({
      url: "../Php/updateResidents.php",
      type: "POST",
      data: JSON.stringify(formData), // Stringify the formData object
      contentType: "application/json", // Tell the server you're sending JSON
      success: function (response) {
        console.log("Response:", response);
        var results = JSON.parse(response);

        // Initialize a flag to check if all operations were successful
        var allSuccessful = true;

        // Loop through each result
        results.forEach(function (result) {
          if (result.error) {
            console.error("Error:", result.error);
            allSuccessful = false;
          } else if (result.success) {
            console.log("Success:", result.success);
          } else if (result.message) {
            console.log("Message:", result.message);
          }
        });

        // If all operations were successful, redirect to the dashboard
        if (allSuccessful) {
          window.location.href =
            "../Dashboard/ResidentsRecord.php?update=success";
        } else {
          window.location.href =
            "../Dashboard/ResidentsRecord.php?update=error";
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error:", errorThrown);
      },
    });
  });
}

// ─── Toggle Resident View ──────────────────────────────────────
function hideResidentForm1() {
  document.querySelector(".residentsForm1").style.display = "none";
  document.querySelector(".overlayR").style.display = "none";

  var form2 = document.querySelector(".formform1");
  var form1 = document.querySelector(".formform");
  var addMember = document.querySelector(".addMember2");

  addMember.style.display = "";
  formDiv.style.border = "";
  form2.style.display = "none";
  form1.style.display = "block";
}
