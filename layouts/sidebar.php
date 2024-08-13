<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="assets/images/LOGO.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">TILIK KEBON</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <?php
    if (isset($_SESSION['level'])) {
      if ($_SESSION['level'] == "Admin") {
    ?>
        <li>
          <a href="index.php?include=dashboard-admin">
            <div class="parent-icon"><i class='bx bx-home bx-tada' style="color: #ff3030"></i></div>
            <div class="menu-title">Dashboard</div>
          </a>
        </li>
      <?php
      } elseif ($_SESSION['level'] == "User") {
      ?>
        <li>
          <a href="index.php?include=dashboard-user">
            <div class="parent-icon"><i class='bx bx-home bx-tada' style="color: #ff3030"></i></div>
            <div class="menu-title">Dashboard</div>
          </a>
        </li>
        <li>
          <a href="index.php?include=information">
            <div class="parent-icon"><i class='bx bx-info-circle bx-tada' style="color: #03A9F4"></i>
            </div>
            <div class="menu-title">Information</div>
          </a>
        </li>
    <?php
      }
    }
    ?>
    <?php
    if (isset($_SESSION['level'])) {
      if ($_SESSION['level'] == "Admin") {
    ?>
        <li class="menu-label">ACCOUNT</li>
        <li>
          <a href="index.php?include=user-account">
            <div class="parent-icon"><i class='bx bxs-user-plus bx-tada' style="color: #ffc107"></i>
            </div>
            <div class="menu-title">Manage User</div>
          </a>
        </li>
        <li>
          <a href="index.php?include=user-logs">
            <div class="parent-icon"><i class='bx bxs-user-detail bx-tada' style="color: #ff8b01"></i>
            </div>
            <div class="menu-title">Manage Log User</div>
          </a>
        </li>
    <?php
      }
    }
    ?>
    <li class="menu-label">OTHERS</li>
    <?php
    if (isset($_SESSION['level'])) {
      if ($_SESSION['level'] == "Admin") {
    ?>
        <li>
          <a href="index.php?include=manage-komponen">
            <div class="parent-icon"><i class='bx bxs-component bx-tada' style="color: #ff007c "></i>
            </div>
            <div class="menu-title">Manage Komponen</div>
          </a>
        </li>
        <li>
          <a href="index.php?include=information-admin">
            <div class="parent-icon"><i class='bx bx-info-circle bx-tada' style="color: #03A9F4"></i>
            </div>
            <div class="menu-title">Manage Information</div>
          </a>
        </li>
        <li>
          <a href="index.php?include=manage-galeri">
            <div class="parent-icon"><i class='bx bx-images bx-tada' style="color: #673ab7"></i>
            </div>
            <div class="menu-title">Manage Galeri</div>
          </a>
        </li>
        <li>
          <a href="index.php?include=manage-data-sensor">
            <div class="parent-icon"><i class='bx bxs-shapes bx-tada' style="color: #4CAF50"></i>
            </div>
            <div class="menu-title">Manage Data Sensor</div>
          </a>
        </li>
      <?php
      } elseif ($_SESSION['level'] == "User") {
      ?>
        <li>
          <a href="index.php?include=data-sensor">
            <div class="parent-icon"><i class='bx bxs-shapes bx-tada' style="color: #4CAF50"></i>
            </div>
            <div class="menu-title">Data Sensor</div>
          </a>
        </li>
    <?php
      }
    }
    ?>
    <li>
      <a href="index.php?include=all-grafik-chart">
        <div class="parent-icon"><i class='bx bx-chart bx-tada' style="color: #009688"></i>
        </div>
        <div class="menu-title">Grafik Data</div>
      </a>
    </li>
  </ul>
  <!--end navigation-->
</div>