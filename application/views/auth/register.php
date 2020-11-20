</div>
</nav>
<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" data-image="<?= base_url(); ?>assets/img/register.jpg">
        <div class="container mx-0 justify-content-center">
            <div class="row text-center">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card card-signup ">
                        <h2 class="card-title">Register</h2>
                        <div class="row">
                            <div class="col-md">
                                <div class="card-content bg-info text-primary">
                                    <div class="icon icon-info">
                                        <i class="material-icons">group</i>
                                    </div>
                                    <div class="info info-horizontal">
                                        <small class="form-text text-muted">Silahkan register akun anda!!!</small>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-5 col-md-offset-1">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <div class="icon icon-rose">
                                            <i class="material-icons">timeline</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Marketing</h4>
                                            <p class="description">
                                                We've created the marketing campaign of the website. It was a very interesting collaboration.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="info info-horizontal">
                                        <div class="icon icon-primary">
                                            <i class="material-icons">code</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Fully Coded in HTML5</h4>
                                            <p class="description">
                                                We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="info info-horizontal">
                                        <div class="icon icon-info">
                                            <i class="material-icons">group</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Built Audience</h4>
                                            <p class="description">
                                                There is also a Fully Customizable CMS Admin Dashboard for this product.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md social text-center">
                                <form class="form" method="POST" action="<?= base_url('auth/register') ?>">
                                    <div class="card-content mx-0">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Masukkan Nama Anda" name="nama" id="nama" value="<?= set_value('nama'); ?>">
                                            <?= form_error('nama', '<small class="text-danger col-md">', '</small>'); ?>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Masukkan Email Anda" id="email" name="email" value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger col-md">', '</small>'); ?>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <input type="password" placeholder="Masukkan Password Anda" class="form-control" id="password1" name="password1" />
                                            <?= form_error('password1', '<small class="text-danger col-md">', '</small>'); ?>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <input type="password" placeholder="Ulangi Password Anda" class="form-control" id="password2" name="password2" />
                                        </div>
                                        <!-- Tidak Perlu :D -->
                                        <!-- If you want to add a checkbox to this form, uncomment this code -->
                                        <!-- <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="optionsCheckboxes" checked> I agree to the
                                                    <a href="#something">terms and conditions</a>.
                                                </label>
                                            </div> -->
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-primary btn-round">Daftar</button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p>Sudah punya akun?<a href="<?= base_url(); ?>" class="small"> Login disini!</a></p>
                                    <p>Lupa Password ?<a href="<?= base_url('auth/lupapassword'); ?>" class="small"> Forget Password!</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>