<div class="login-logo">
    <a href="<?= base_url(); ?>"><b><?= $title; ?></b></a>
</div>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Register Form</p>
        <?= $this->session->flashdata('message'); ?>
        <form class="user" method="post" action="<?= base_url('auth/register'); ?>">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="<?= set_value('nama'); ?>">
                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="alamat" cols="20" rows="4" class="form-control"><?= set_value('alamat'); ?></textarea>
                <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="">Nomor Telpon</label>
                <input type="text" class="form-control" id="notelp" name="notelp" placeholder="Masukkan notelp" value="<?= set_value('notelp'); ?>">
                <?= form_error('notelp', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="">About</label>
                <input type="text" class="form-control" id="about" name="about" placeholder="Masukkan about" value="<?= set_value('about'); ?>">
                <?= form_error('about', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="">Password Anda</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" value="<?= set_value('password'); ?>">
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan Data User</button>
            </div>
        </form>

        <p class="mt-3 mb-1">
            Sudah Punya Akun ? <a href="<?= base_url('auth'); ?>">Login</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>