<div class="login-logo">
    <a href="<?= base_url(); ?>"><b>JTI - </b>PKL</a>
</div>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Reset Password Form</p>
        <?= $this->session->flashdata('message'); ?>
        <form class="user" method="post" action="<?= base_url('auth/gantipassword'); ?>">
        <div class="form-group">
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan Password Baru Anda">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password Baru Anda">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
        </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="<?= base_url('auth'); ?>">Login</a>
        </p>
        <p class="mb-0">
            <a href="<?= base_url('auth/register'); ?>" class="text-center">Register a new membership</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>