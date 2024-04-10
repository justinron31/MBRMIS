      <?php include '../Php/db.php'; ?>


      <!-- SIDEBAR-->
      <div class="masterCOn">
          <nav class="sidebar locked">
              <div class="logo_items flex">
                  <span class="nav_image">
                      <img src="../images/logo.png" alt="logo_img" />
                  </span>
                  <span class="logo_name"> MBRMI SYSTEM</span>
                  <i class="bx bxs-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
                  <i class="bx bx-x" id="sidebar-close" title="lock Sidebar"></i>
              </div>






              <!--SIDEBAR CONTENT-->
              <div class="menu_container">
                  <div class="menu_items">
                      <ul class="menu_item">
                          <div class="menu_title flex">
                              <span class="title">Dashboard</span>
                              <span class="line"></span>
                          </div>
                          <li class="item" id="overview-item">
                              <a href="../Dashboard/Home.php" class="link flex">
                                  <i class="bx bxs-dashboard"></i>
                                  <span>Overview</span>
                              </a>
                          </li>

                          <li class="item">
                              <a href="../Dashboard/ResidentsRecord.php" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          location_away
                                      </span>
                                  </i>
                                  <span>Residents Record</span>
                              </a>
                          </li>
                      </ul>

                      <ul class="menu_item">
                          <div class="menu_title flex">
                              <span class="title">Menu</span>
                              <span class="line"></span>
                          </div>



                          <li class="item">
                              <a href="../Dashboard/CertofIndigency.php" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          badge
                                      </span>
                                      <span class="badge"></span>
                                  </i>
                                  <span>Certificate of Indigency</span>
                              </a>
                          </li>


                          <li class="item">
                              <a href="../Dashboard/CertofResidency.php" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          clinical_notes
                                      </span>
                                      <span class="badge1"></span>
                                  </i>
                                  <span>Certificate of Residency</span>

                              </a>
                          </li>


                          <li class="item">
                              <a href="../Dashboard/FirstTimeJob.php" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          card_membership
                                      </span>
                                      <span class="badge2"></span>
                                  </i>
                                  <span>First Time Job Seeker</span>

                              </a>
                          </li>



                          <li class="item">
                              <a href="../Dashboard/ReqDocu.php" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          home_storage
                                      </span>
                                      <span class="badge3"></span>
                                  </i>
                                  <span>Requested Documents</span>
                              </a>
                          </li>
                      </ul>


                      <?php
                        if ($_SESSION['user_type'] === 'admin') {
                        ?>
                          <ul class="menu_item">
                              <div class="menu_title flex">
                                  <span class="title">Others</span>
                                  <span class="line"></span>
                              </div>

                              <li class="item">
                                  <a href="../Dashboard/ManageUser.php" class="link flex">
                                      <i class='bx bxs-user-detail'></i>
                                      <span>Manage System User</span>
                                  </a>
                              </li>

                              <li class="item ">
                                  <a href="../Dashboard/Reporting.php" class="link flex">
                                      <i class='bx bxs-report'></i>
                                      <span>Reporting View</span>
                                  </a>
                              </li>
                          </ul>
                      <?php
                        }
                        ?>

                      <ul class="menu_item">
                          <div class="menu_title flex">
                              <span class="title">System</span>
                              <span class="line"></span>
                          </div>

                          <li class="item">
                              <a href="../Dashboard/Profile.php" class="link flex">
                                  <i class='bx bxs-user'></i>
                                  <span>Profile</span>
                              </a>
                          </li>


                          <li class="item1" onclick="openLogoutModal()">
                              <a href="#" class="link flex">
                                  <i class='bx bxs-exit bx-rotate-180'></i>
                                  <span>Logout</span>
                              </a>
                          </li>

                      </ul>
                  </div>
              </div>
          </nav>



          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script>
              $(document).ready(function() {
                  var audio = new Audio('../audio/notif.mp3');

                  function fetchCount() {
                      $.ajax({
                          url: '../Php/fetchBadge.php',
                          type: 'GET',
                          success: function(response) {
                              var data = JSON.parse(response);
                              if (data.count > 0) {
                                  $('.badge').css('display', 'inline-block');
                                  $('.badge').text(data.count);

                                  if (data.notifCount > 0) {
                                      audio.play();
                                  }
                              } else {
                                  $('.badge').css('display', 'none');
                              }
                          }
                      });
                  }

                  fetchCount();
                  setInterval(fetchCount, 1000);
              });
          </script>

          <script>
              $(document).ready(function() {
                  var audio = new Audio('../audio/notif.mp3');

                  function fetchCount() {
                      $.ajax({
                          url: '../Php/fetchBadge1.php',
                          type: 'GET',
                          success: function(response) {
                              var data = JSON.parse(response);
                              if (data.count > 0) {
                                  $('.badge1').css('display', 'inline-block');
                                  $('.badge1').text(data.count);

                                  if (data.notifCount > 0) {
                                      audio.play();
                                  }
                              } else {
                                  $('.badge1').css('display', 'none');
                              }
                          }
                      });
                  }

                  fetchCount();
                  setInterval(fetchCount, 1000);
              });
          </script>

          <script>
              $(document).ready(function() {
                  var audio = new Audio('../audio/notif.mp3');

                  function fetchCount() {
                      $.ajax({
                          url: '../Php/fetchBadge2.php',
                          type: 'GET',
                          success: function(response) {
                              var data = JSON.parse(response);
                              if (data.count > 0) {
                                  $('.badge2').css('display', 'inline-block');
                                  $('.badge2').text(data.count);

                                  if (data.notifCount > 0) {
                                      audio.play();
                                  }
                              } else {
                                  $('.badge2').css('display', 'none');
                              }
                          }
                      });
                  }

                  fetchCount();
                  setInterval(fetchCount, 1000);
              });
          </script>
          
        <script>
    $(document).ready(function() {
         var audio = new Audio('../audio/notif.mp3');
          
        function fetchCount() {
            $.ajax({
                url: '../Php/fetchBadge3.php',
                type: 'GET',
                success: function(response) {
                    var data = JSON.parse(response);
                    var count1 = parseInt(data.count1);
                    var count2 = parseInt(data.count2);
                    var totalCount = count1 + count2;
                    if (totalCount > 0) {
                        $('.badge3').css('display', 'inline-block');
                        $('.badge3').text(totalCount);
                        
                        if (data.notifCount > 0) {
                                      audio.play();
                                  }
                    } else {
                        $('.badge3').css('display', 'none');
                    }
                }
            });
        }

        fetchCount();
        setInterval(fetchCount, 1000);
    });
</script>


          <script>
              $(document).ready(function() {
                  // Get saved 'active' item from localStorage
                  var activeItem = localStorage.getItem('activeItem');

                  // If there is an 'active' item saved, add 'active' class to it
                  if (activeItem) {
                      $(activeItem).addClass('active');
                  }

                  // Handle click event on '.item' class
                  $('.item').click(function() {
                      // Remove 'active' class from all '.item' elements
                      $('.item').removeClass('active');

                      // Add 'active' class to the clicked '.item' element
                      $(this).addClass('active');

                      // Save 'active' item to localStorage
                      localStorage.setItem('activeItem', '.item:contains("' + $(this).text() + '")');
                  });

                  // If the activeItem is not set, set the dashboard as the active item
                  if (!activeItem) {
                      // Remove 'active' class from all '.item' elements
                      $('.item').removeClass('active');

                      // Add 'active' class to the dashboard tab
                      $('#overview-item').addClass('active');

                      // Save 'active' item to localStorage
                      localStorage.setItem('activeItem', 'overview-item');
                  }
              });
          </script>