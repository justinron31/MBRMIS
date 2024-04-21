<div class="membersContainer1" style="display: none; margin-top: 10px;">

    <div class=" membersCon1">
        <div class="rheadTitle">

            <div class="rheadcon">
                <div class="line"></div>
                <p>ADD HOUSEHOLD MEMBER</p>
                <div class="line"></div>
            </div>

        </div>

        <div class="addmember11">

            <form id="addhousehold" method="post">
                <div class="rform1">
                    <div class="rInput">
                        <label for="addmLastname">Last Name</label>
                        <input type="text" id="addmLastname" name="addmLastname" placeholder="Enter Lastname" required>
                    </div>

                    <div class="rInput">
                        <label for="addmFirstname">First Name</label>
                        <input type="text" id="addmFirstname" name="addmFirstname" placeholder="Enter Firstname"
                            required>
                    </div>

                    <div class="rInput">
                        <label for="addmMaiden">Mother’s Maiden Name</label>
                        <input type="text" id="addmMaiden" name="addmMaiden" placeholder="Enter Mother’s Maiden Name"
                            required>
                    </div>
                </div>

                <div class="rform1">
                    <div class="rInput">
                        <label for="addmRelationship">Relationship</label>
                        <select class="selectbox" id="bussSelect6" name="addmRelationship" required
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
                        <label for="addmGender">Gender</label>
                        <select class="selectbox" id="bussSelect7" name="addmGender" required
                            onchange="changeFontColor('bussSelect7')">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="rInput">
                        <label for="addmAge">Age</label>
                        <input type="text" id="addmAge" name="addmAge" placeholder="Enter Age"
                            oninput="validateAge(this)" required>
                    </div>
                </div>

                <div class="rform1">
                    <div class="rInput">
                        <label for="addmRisk">Classification by Age/Health Risk</label>
                        <select class="selectbox" id="bussSelect9" name="addmRisk" required
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
                        <label for="addmQuarter">Quarter</label>
                        <select class="selectbox" id="bussSelect10" name="addmQuarter" required
                            onchange="changeFontColor('bussSelect10')">
                            <option value="">Select Quarter</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                            <option value="Third">Third</option>
                            <option value="Fourth">Fourth</option>
                        </select>
                    </div>
                </div>
                <div class="buttonaddhouse">
                    <button id="addmo" class="rSubmit3" style="margin:0 !important"
                        onclick="submitAddHousehold()">ADD</button>
                </div>
            </form>

        </div>



    </div>
</div>




<script>
// ─── Addhousehold ─────────────────────────────────────────────
function displayMembersContainer() {
    var membersContainer1 = document.querySelector(".membersContainer1");
    var addButton = document.getElementById("addmo");

    if (membersContainer1.style.display === "none") {
        membersContainer1.style.display = "block";
        addButton.style.display = "block";
    } else {
        membersContainer1.style.display = "none";
        addButton.style.display = "none";
    }
}
// Select the node that will be observed for mutations
var membersContainer1 = document.querySelector(".membersContainer1");
var addButton = document.getElementById("addmo");

// Create a new observer instance
var observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.type == "attributes" && mutation.attributeName == "style") {
            if (membersContainer1.style.display === "block") {
                addButton.style.display = "block";
            } else {
                addButton.style.display = "none";
            }
        }
    });
});

// Configuration of the observer
var config = {
    attributes: true,
    childList: false,
    characterData: false
};

// Pass in the target node, as well as the observer options
observer.observe(membersContainer1, config);
</script>