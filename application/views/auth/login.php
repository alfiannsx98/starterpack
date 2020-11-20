  <div class="login-logo">
    <a href="<?= base_url('auth'); ?>"><b>YBM - </b>BRI</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login Page</p>

      <?= $this->session->flashdata('message'); ?>

      <form action="<?= base_url('auth'); ?>" method="post" class="user">
        <div class="form-group">
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" placeholder="Your Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1 text-center">
        <a href="<?= base_url('auth/lupapassword') ?>">Forgot Password</a>
      </p>
      <p class="mb-0 text-center">
        <a href="<?= base_url('auth/register'); ?>" class="text-center">Register Here!</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
  <!-- /.login-box -->