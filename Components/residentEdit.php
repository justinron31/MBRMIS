<!-- RESIDENTS FORM EDIT -->
<div class="overlayR"></div>

<div class="residentsForm1">

    <div class="rtopheadcon">


        <div class="rheadTitle">

            <div class="rheadcon">
                <div class="line"></div>
                <p>RESIDENT'S INFORMATION</p>
                <div class="line"></div>
                <i class='bx bxs-x-circle' onclick="hideResidentForm1()"></i>
            </div>

        </div>
    </div>


    <!-- form  -->
    <form>
        <div class=" rform1">

            <input type="hidden" id="memberCount" name="memberCount" value="0">

            <div class="rInput">
                <label for="BHS">BHS</label>
                <input type="text" id="BHS" name="BHS" placeholder="Enter BHS" readonly>
            </div>

            <div class="rInput">
                <label for="Purok">Purok/Sitio/Subdivision</label>
                <input type="text" id="Purok" name="Purok" placeholder="Enter Purok/Sitio/Subdivision" readonly>
            </div>

            <div class="rInput">
                <label for="Household">Household Number</label>
                <input type="text" id="Household" name="Household" placeholder="Enter Household Number" readonly>
            </div>

        </div>

        <div class="rform1">

            <div class="rInput">
                <label for="Lastname">Last Name</label>
                <input type="text" id="Lastname" name="Lastname" placeholder="Enter Lastname" readonly>
            </div>

            <div class="rInput">
                <label for="Firstname">First Name</label>
                <input type="text" id="Firstname" name="Firstname" placeholder="Enter Firstname" readonly>
            </div>

            <div class="rInput">
                <label for="Maiden">Mother’s Maiden Name</label>
                <input type="text" id="Maiden" name="Maiden" placeholder="Enter Mother’s Maiden Name" readonly>
            </div>

        </div>

        <div class="rform1">

            <div class="rInput">
                <label for="Age">Age</label>
                <input type="text" id="Age" name="Age" placeholder="Enter Age" oninput="validateAge(this)" readonly>
            </div>

            <div class="rInput">
                <label for="Gender">Gender</label>
                <input type="text" id="Gender" name="Gender" placeholder="Enter Gender" readonly>
            </div>

            <div class="rInput">
                <label for="VotersID">Voter's ID</label>
                <input type="text" id="VotersID" name="VotersID" placeholder="Enter VotersID" readonly>
            </div>

            <div class="rInput2">
                <label for="avatar" class="required1">Upload Voter's ID</label>
                <input class="rIDupload" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" readonly />
            </div>

        </div>

        <div class="rform1">

            <div class="rInput">
                <label for="NHTS">NHTS Household</label>
                <input type="text" id="NHTS" name="NHTS" placeholder="Enter NHTS" readonly>
            </div>

            <div class="rInput">
                <label for="IP">IP or Non-IP</label>
                <input type="text" id="IP" name="IP" placeholder="Enter IP" readonly>
            </div>

            <div class="rInput">
                <label for="HH">HH Head PhilHealth Member</label>
                <input type="text" id="HH" name="HH" placeholder="Enter HH" readonly>
            </div>

            <div class="rInput">
                <label for="Category">Category</label>
                <input type="text" id="Category1" name="Category" placeholder="Enter Category" readonly>
            </div>

        </div>

        <!-- HOUSEHOLD MEMEBERS -->

        <div class="membersCon">
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
                        <input type="text" id="mLastname" name="mLastname" placeholder="Enter Lastname" readonly>
                    </div>

                    <div class="rInput">
                        <label for="mFirstname">First Name</label>
                        <input type="text" id="mFirstname" name="mFirstname" placeholder="Enter Firstname" readonly>
                    </div>

                    <div class="rInput">
                        <label for="mMaiden">Mother’s Maiden Name</label>
                        <input type="text" id="mMaiden" name="mMaiden" placeholder="Enter Mother’s Maiden Name" readonly>
                    </div>

                </div>

                <div class="rform1">

                    <div class="rInput">
                        <label for="mRelationship">Relationship</label>
                        <input type="text" id="mRelationship" name="mRelationship" placeholder="Enter Relationship" readonly>
                    </div>

                    <div class="rInput">
                        <label for="mGender">Gender</label>
                        <input type="text" id="mGender" name="mGender" placeholder="Enter Gender" readonly>
                    </div>


                    <div class="rInput">
                        <label for="mAge">Age</label>
                        <input type="text" id="mAge" name="mAge" placeholder="Enter Age" oninput="validateAge(this)" readonly>
                    </div>

                </div>

                <div class="rform1">
                    <div class="rInput">
                        <label for="mRisk">Classification by Age/Health Risk</label>
                        <input type="text" id="mRisk" name="mRisk" placeholder="Enter Risk" readonly>
                    </div>



                    <div class="rInput">
                        <label for="mQuarter">Quarter</label>
                        <input type="text" id="mQuarter" name="mQuarter" placeholder="Enter Quarter" readonly>
                    </div>
                </div>

            </div>

        </div>
    </form>
    <div class="rButcon">
        <?php
        if ($_SESSION['user_type'] === 'admin') {
        ?>
            <button class="rSubmit1">DELETE</button>
        <?php
        }
        ?>
        <button class="rSubmit">EDIT</button>
    </div>





</div>

<div class="overlayD"></div>
<div class="modalD">
    <div class="modal-header1">
        <h2>IMPORTANT</h2>
    </div>

    <div class="modal-body1">
        <div class="modal-message1">

            <p>Are you sure you want to delete this Record?</p>
            <p>It will also delete the <strong>Household Members</strong>.</p>
            <p>This action cannot be <Strong>UNDONE</Strong>.</p>
        </div>
        <div class="modal-buttons1">
            <button class="yes1">Yes</button>
            <button class="no1">No</button>
        </div>
    </div>

</div>