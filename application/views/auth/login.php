<p class="login-box-msg">Sign in to start your session</p>
<?= $this->session->flashdata('message'); ?>
<form class="user" action="<?= base_url('auth'); ?>" method="post">
    <div class="input-group mb-3">
        <input type="text" class="form-control form-control-user" placeholder="Email" id="email" name="email" value="<?= set_value('email') ?>">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
    <div class="input-group mb-3">
        <input type="password" class="form-control form-control-user" placeholder="Password" id="password" name="password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>


<p class="mb-1">
    <a href="forgot-password.html">I forgot my password</a>
</p>
<p class="mb-0">
    <a href="<?= base_url('auth/registration'); ?>" class="text-center">Register a new membership</a>
</p>
</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->