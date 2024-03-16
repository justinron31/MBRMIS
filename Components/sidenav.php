      <?php include '../Php/db.php'; ?>


      <!-- SIDEBAR-->
      <div class="masterCOn">
          <nav class="sidebar locked">
              <div class="logo_items flex">
                  <span class="nav_image">
                      <img src="../Images/logo.png" alt="logo_img" />
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
                          <li class="item">
                              <a href="/MBRMIS/Dashboard/AdminDashboard.php" class="link flex">
                                  <i class="bx bxs-dashboard"></i>
                                  <span>Overview</span>
                              </a>
                          </li>

                          <li class="item">
                              <a href="#" class="link flex">
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


                          <!-- cert of indigency badge count  -->
                          <?php

                            $count = 0;
                            $query = "SELECT * FROM file_request WHERE datetime_created > NOW() - INTERVAL 1 DAY AND file_status = 'Processing' AND type='Certificate of Indigency'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $count = mysqli_num_rows($result);
                            } else {

                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>

                          <li class="item">
                              <a href="/MBRMIS/Dashboard/AdminCertofIndigency.php" class="link flex">
                                  <i>

                                      <span class="material-symbols-outlined">
                                          badge
                                      </span>
                                      <?php if ($count > 0) : ?>
                                          <span class="badge"><?php echo $count; ?></span>
                                      <?php endif; ?>
                                  </i>

                                  <span>Certificate of Indigency</span>

                              </a>
                          </li>




                          <!-- cert of recidency badge count  -->
                          <?php

                            $count = 0;
                            $query = "SELECT * FROM file_request WHERE datetime_created > NOW() - INTERVAL 1 DAY AND file_status = 'Processing' AND type='Certificate of Residency'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $count = mysqli_num_rows($result);
                            } else {

                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>

                          <li class="item">
                              <a href="/MBRMIS/Dashboard/AdminCertofResidency.php" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          clinical_notes
                                      </span>
                                      <?php if ($count > 0) : ?>
                                          <span class="badge"><?php echo $count; ?></span>
                                      <?php endif; ?>
                                  </i>
                                  <span>Certificate of Residency</span>

                              </a>
                          </li>




                          <!-- First time job seeker badge count  -->
                          <?php

                            $count = 0;
                            $query = "SELECT * FROM first_time_job WHERE datetime_created > NOW() - INTERVAL 1 DAY AND file_status = 'Processing' ";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $count = mysqli_num_rows($result);
                            } else {

                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>

                          <li class="item">
                              <a href="/MBRMIS/Dashboard/AdminFirstTimeJob.php" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          card_membership
                                      </span>
                                      <?php if ($count > 0) : ?>
                                          <span class="badge"><?php echo $count; ?></span>
                                      <?php endif; ?>
                                  </i>
                                  <span>First Time Job Seeker</span>

                              </a>
                          </li>



                          <li class="item">
                              <a href="#" class="link flex">
                                  <i>
                                      <span class="material-symbols-outlined">
                                          home_storage
                                      </span>
                                  </i>
                                  <span>Requested Documents</span>
                              </a>
                          </li>
                      </ul>


                      <ul class="menu_item">
                          <div class="menu_title flex">
                              <span class="title">Others</span>
                              <span class="line"></span>
                          </div>

                          <li class="item">
                              <a href="/MBRMIS/Dashboard/AdminManageUser.php" class="link flex">
                                  <i class='bx bxs-user-detail'></i>
                                  <span>Manage System User</span>
                              </a>
                          </li>

                          <li class="item ">
                              <a href="#" class="link flex">
                                  <i class='bx bxs-report'></i>
                                  <span>Reporting View</span>
                              </a>
                          </li>

                      </ul>

                      <ul class="menu_item">
                          <div class="menu_title flex">
                              <span class="title">System</span>
                              <span class="line"></span>
                          </div>

                          <li class="item">
                              <a href="/MBRMIS/Dashboard/AdminProfile.php" class="link flex">
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