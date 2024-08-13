<body style="overflow-y: hidden;">
  <?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error == 'password_tidak_sama') {
      echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Password dan konfirmasi password tidak sama!',
              showConfirmButton: false,
              timer: 3000
            });
          </script>";
    } else if ($error == 'token_invalid') {
      echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Token tidak valid atau telah kadaluarsa!',
              showConfirmButton: false,
              timer: 3000
            });
          </script>";
    }
  }
  ?>

  <!--wrapper-->
  <div class="wrapper">
    <div class="section-authentication-cover">
      <div class="">
        <div class="row g-0">
          <div
            class="col-12 col-xl-7 col-xxl-8 auth-cover-left bg-gradient-moonlit align-items-center justify-content-center d-none d-xl-flex">
            <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
              <div class="card-body">
                <img src="assets/images/login-images/reset-password-cover.svg" class="img-fluid" width="600" alt="" />
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
            <div class="card rounded-0 shadow-none bg-transparent mb-0"
              style="margin-top: 50px; margin-left: 3px; margin-right: 3px">
              <div class="card-body p-sm-5">
                <div class="">
                  <div class="mb-4 text-center">
                    <img src="assets/images/LOGO.png" width="100" alt="" />
                  </div>
                  <div class="text-start mb-4">
                    <h5 class="text-center">Generate New Password</h5>
                    <p class="mb-0">We received your reset password request. Please enter your new password!</p>
                  </div>
                  <form action="index.php?include=konfirmasi-reset-password" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="email" value="<?php echo $_GET['email'] ?>">
                    <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>">
                    <div class="mb-3 mt-4">
                      <label class="form-label">Password Baru</label>
                      <div class="input-group" id="show_hide_password">
                        <input type="password" name="password" class="form-control" id="inputChoosePassword" value=""
                          placeholder="Masukan password baru" required>
                        <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Konfirmasi Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input type="password" name="confirm_password" class="form-control" id="inputChoosePassword"
                          value="" placeholder="Konfirmasi password baru" required>
                        <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                      </div>
                    </div>
                    <div class="d-grid gap-2">
                      <button type="submit" name="reset" class="btn btn-success">Reset Password</button>
                      <a href="index.php?include=login" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back
                        to Login</a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                  </form>
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
  <?php include ("layouts/scripts.php") ?>
</body>