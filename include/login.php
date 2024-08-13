<body style="overflow-y: hidden;">
  <?php
  if (isset($_GET['success'])) {
    $success = $_GET['success'];

    if ($success == 'password_berhasil_diubah') {
      echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Sukses!',
              text: 'Password anda berhasil diubah!',
            });
          </script>";
    } else if ($success == 'berhasil_register') {
      echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Sukses!',
              text: 'Anda berhasil mendaftar!',
            });
          </script>";
    }
  }

  if (isset($_GET['error']) && $_GET['error'] == 'login_failed') {
    echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Maaf Username dan Password Anda Salah!',
            });
          </script>";
  }
  ?>

  <!--wrapper-->
  <div class="wrapper">
    <div class="section-authentication-signin">
      <div class="">
        <div class="row g-0">

          <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left bg-gradient-cosmic align-items-center justify-content-center d-none d-xl-flex">

            <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
              <div class="card-body">
                <img src="assets/images/login-images/login-cover.svg" class="img-fluid auth-img-cover-login" width="650" alt="" />
              </div>
            </div>

          </div>

          <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
            <div class="card rounded-0 shadow-none bg-transparent mb-0">
              <div class="card-body p-sm-5">
                <div class="">
                  <div class="mb-1 text-center">
                    <img src="assets/images/LOGO.png" width="100" alt="">
                  </div>
                  <div class="text-center mb-2">
                    <h5 class="">TILIK KEBON DASHBOARD</h5>
                    <p class="mb-0">Please log in to your account</p>
                  </div>
                  <div class="form-body">
                    <form action="index.php?include=konfirmasi-login" method="POST" class="row g-2">
                      <div class="col-12">
                        <label for="inputEmailAddress" class="form-label">Username</label>
                        <input type="username" name="username" class="form-control" id="inputEmailAddress" placeholder="Username" required>
                      </div>
                      <div class="col-12">
                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
                        <div class="input-group" id="show_hide_password">
                          <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Enter Password" required>
                          <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                        </div>
                      </div>
                      <div class="col-md-12 text-end"> <a href="index.php?include=forgot-password">Forgot Password ?</a>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" name="login" class="btn btn-success"><i class="bx bxs-lock-open"></i>Sign in</button>
                        </div>
                      </div>
                      <div class="col-12 text-center">
                        <p>Don't have an account yet? <a href="index.php?include=register">Sign up here</a></p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!--end row-->
      </div>
    </div>
  </div>
  <!--end wrapper-->
  <?php include("layouts/scripts.php") ?>
</body>