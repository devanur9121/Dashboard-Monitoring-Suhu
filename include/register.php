<?php include("include/konfirmasi-register.php") ?>

<body style="overflow-y: hidden;">
  <?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error == 'gagal_register') {
      echo "<script>
            Swal.fire({
              title: 'Woops! Terjadi kesalahan.',
              icon: 'error',
              confirmButtonText: 'OK',
              confirmButtonColor: ' #ff0000'
            });
          </script>";
    } else if ($error == 'email_sudah_terdaftar') {
      echo "<script>
            Swal.fire({
              title: 'Maaf Email Anda Telah Terdaftar!!',
              icon: 'error',
              confirmButtonText: 'OK',
              confirmButtonColor: ' #ff0000'
            });
          </script>";
    } else if ($error == 'password_tidak_sesuai') {
      echo "<script>
            Swal.fire({
              title: 'Maaf Password Anda Tidak Sesuai!!',
              icon: 'error',
              confirmButtonText: 'OK',
              confirmButtonColor: ' #ff0000'
            });
          </script>";
    } else if ($error == 'terms_not_agreed') {
      echo "<script>
            Swal.fire({
              title: 'Anda harus menyetujui Terms & Conditions untuk melanjutkan!!',
              icon: 'error',
              confirmButtonText: 'OK',
              confirmButtonColor: ' #ff0000'
            });
          </script>";
    }
  }
  ?>
  <!--wrapper-->
  <div class="section-authentication-cover">
    <div class="">
      <div class="row g-0">

        <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left bg-gradient-deepblue align-items-center justify-content-center d-none d-xl-flex">

          <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
            <div class="card-body">
              <img src="assets/images/login-images/register-cover.svg" class="img-fluid auth-img-cover-login" width="550" alt="" />
            </div>
          </div>

        </div>

        <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
          <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
            <div class="card-body p-sm-2">
              <div class="">
                <div class="mb-1 text-center">
                  <img src="assets/images/LOGO.png" width="60" alt="" />
                </div>
                <div class="text-center mb-2">
                  <h5 class="">TILIK KEBON DASHBOARD</h5>
                  <p class="mb-0">Please fill the below details to create your account</p>
                </div>
                <div class="form-body">
                  <form action="index.php?include=konfirmasi-register" method="POST" class="row g-2">
                    <div class="col-sm-6">
                      <label for="inputFirstName" class="form-label">Nama</label>
                      <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" id="inputFirstName" placeholder="" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="inputLastName" class="form-label">Username</label>
                      <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" id="inputLastName" placeholder="" required>
                    </div>
                    <div class="col-12">
                      <label for="inputEmailAddress" class="form-label">Alamat Email</label>
                      <input type="email" class="form-control" id="inputEmailAddress" value="<?php echo $email; ?>" name="email" placeholder="example@user.com" required>
                    </div>
                    <div class="col-12">
                      <label for="inputChoosePassword" class="form-label">Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control border-end-0" name="password" value="<?php echo $password; ?>" id="inputChoosePassword" value="" placeholder="Enter Password" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="inputChoosePassword" class="form-label">Konfirmasi Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control border-end-0" name="cpassword" value="<?php echo $password; ?>" id="inputChoosePassword" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="terms_agreed">
                        <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" name="register" class="btn btn-success"><i class="bx bx-user me-1"></i>Sign up</button>
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <p>Already have an account? <a href="index.php?include=login">Sign in here</a></p>
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
  <!--end wrapper-->
  <?php include("layouts/scripts.php") ?>
</body>