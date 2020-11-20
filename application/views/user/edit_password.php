<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol> -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="fas fa-lock bg-red p-4 float-left"></i>
                            <h4 class="card-title float-right pt-4">Edit Your Password -
                                <small class="category">Form ganti password anda</small>
                            </h4>
                        </div>
                        <div class="card-content p-4 card-primary card-outline">
                            <?= $this->session->flashdata('message'); ?>
                            <?= form_open_multipart('user/edit_password'); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Your Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="passwordSkrg" id="passwordSkrg" placeholder="Masukkan Password Lama">
                                        </div>
                                        <?= form_error('passwordSkrg', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <input type="email" class="" value="<?= $user['email']; ?>" name="email" id="email" hidden>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="passwordBaru1" id="passwordBaru1" placeholder="Masukkan Password Baru">
                                        </div>
                                        <?= form_error('passwordBaru1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Repeat Your New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="passwordBaru2" id="passwordBaru2" placeholder="Ulangi Password Baru"> 
                                        </div>
                                        <?= form_error('passwordBaru2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Last Update Password </label>
                                    </div>
                                    <?php if($user['update_at']==0){?>
                                        <i class="badge badge-secondary">--</i>
                                    <?php } else { ?>
                                        <i class="badge badge-success col-md-1"><?= date('d F Y', $user['update_at']); ?></i>
                                    <?php } ?>        
                                </div>
                            </div>
                            <div class="clearfix text-right p-4">
                                <button type="submit" class="btn btn-success">Update Password</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>