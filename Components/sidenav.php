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

                              <li class="item">
                                  <a href="../Dashboard/Staff.php" class="link flex">
                                      <i class='bx bx-street-view'></i>
                                      <span>Staff Database</span>
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

                  function fetchCount(url, badgeClass) {
                      $.ajax({
                          url: url,
                          type: 'GET',
                          success: function(response) {
                              var data = JSON.parse(response);
                              var count = data.count;
                              if (badgeClass === '.badge3') {
                                  count = parseInt(data.count1) + parseInt(data.count2);
                              }
                              if (count > 0) {
                                  $(badgeClass).css('display', 'inline-block');
                                  $(badgeClass).text(count);

                                  if (data.notifCount > 0) {
                                      audio.play();
                                  }
                              } else {
                                  $(badgeClass).css('display', 'none');
                              }
                          }
                      });
                  }

                  fetchCount('../Php/fetchBadge.php', '.badge');
                  fetchCount('../Php/fetchBadge1.php', '.badge1');
                  fetchCount('../Php/fetchBadge2.php', '.badge2');
                  fetchCount('../Php/fetchBadge3.php', '.badge3');

                  setInterval(function() {
                      fetchCount('../Php/fetchBadge.php', '.badge');
                      fetchCount('../Php/fetchBadge1.php', '.badge1');
                      fetchCount('../Php/fetchBadge2.php', '.badge2');
                      fetchCount('../Php/fetchBadge3.php', '.badge3');
                  }, 1000);
              });

              $(document).ready(function() {

                  var activeItem = localStorage.getItem('activeItem');

                  if (activeItem) {
                      $(activeItem).parent().addClass('active');
                  }

                  $('.item').click(function() {

                      $('.item').removeClass('active');

                      $(this).addClass('active');

                      localStorage.setItem('activeItem', '.link:contains("' + $(this).find('span').last()
                          .text() + '")');
                  });

                  if (!activeItem) {
                      $('.item').removeClass('active');

                      $('#overview-item').addClass('active');

                      localStorage.setItem('activeItem', 'overview-item');
                  }
              });
          </script>