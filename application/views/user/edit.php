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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="blue">
                            <i class="fas fa-user float-left bg-warning p-4"></i>
                            <h4 class="card-title pt-4 float-right">Edit Your Profile -
                                <small class="category">Here is your bio</small>
                            </h4>
                        </div>
                        <div class="card-content p-4 card-primary card-outline">
                            <?= $this->session->flashdata('message'); ?>
                            <?= form_open_multipart('user/edit'); ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control" value="<?= $user['nama']; ?>" name="nama" id="nama" <?= set_value('nama')?>>
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <input type="email" class="" value="<?= $user['email']; ?>" name="email" id="email" hidden>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email</label>
                                        <label type="email" class="form-control" value=""><?= $user['email']; ?></label>
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">About</label>
                                        <input type="text" class="form-control" value="<?= $user['about']; ?>" name="about" id="about" <?= set_value('about')?>>
                                        <?= form_error('about', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Joined Date </label> <i class="badge badge-success"><?= date('d F Y', $user['date_created']); ?></i>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix p-4 text-right">
                                <button type="submit" class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="form-group">
                        <div class="form-group text-center" style="position: relative;">
                            <span class="img-div">
                                <div class="text-center img-placeholder" onClick="triggerClick()">
                                    <h4>Upload Image</h4>
                                    <label class="sm-0"><small>(Klik gambar untuk mengganti)</label>
                                </div>
                                <div>
                                    <img src="<?= base_url(); ?>assets/dist/img/user/<?= $user['profile_image']; ?>" onClick="triggerClick()" id="profileDisplay" width="200px">
                                </div>
                            </span>
                            <input type="file" name="image" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                            <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                            <label>Profile Image</label>
                            <div>
                                <label class="sm-0"><small>Mohon unggah file image (maximal 2 MB).</label>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/dist/js/display.js"></script>