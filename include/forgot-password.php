<body style="overflow-y: hidden;">
  <?php
  if (isset($_GET['success'])) {
    $success = $_GET['success'];

    if ($success == 'email_sent') {
      echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Reset Password Berhasil Dikirim',
              text: 'Silakan periksa email anda'
            });
          </script>";
    }
  }
  if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error == 'email_not_registered') {
      echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Maaf',
              text: 'Email Tidak Terdaftar!!'
            });
          </script>";
    } else if ($error == 'email_not_sent') {
      echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Maaf',
              text: 'Anda Gagal Mengirim Reset Password!'
            });
          </script>";
    }
  }
  ?>

  <!--wrapper-->
  <div class="wrapper">
    <div class="section-authentication-cover">
      <div class="">
        <div class="row">
          <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left bg-gradient-blues align-items-center justify-content-center d-none d-xl-flex">
            <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
              <div class="card-body">
                <img src="assets/images/login-images/forgot-password-cover.svg" class="img-fluid" width="600" alt="" />
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
            <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
              <div class="card-body p-sm-5">
                <div class="p-3">
                  <div class="text-center">
                    <img src="assets/images/icons/forgot-2.png" width="100" alt="" />
                  </div>
                  <h4 class="mt-5 font-weight-bold text-center">Forgot Password?</h4>
                  <p class="text-muted">Enter your registered email ID to reset the password</p>
                  <form action="index.php?include=konfirmasi-forgot-password" method="POST" enctype="multipart/form-data">
                    <div class="my-4">
                      <label class="form-label">Email id</label>
                      <input type="text" name="email" class="form-control" placeholder="example@user.com" required />
                    </div>
                    <div class="d-grid gap-2">
                      <button type="submit" name="forgot" class="btn btn-success">Send</button>
                      <a href="index.php?include=login" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                    </div>
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
  <?php include("layouts/scripts.php") ?>
</body>