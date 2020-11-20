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
    <section class="content justify-content-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <!-- About Me Box -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user float-left bg-warning p-4"></i>
                            <h4 class="card-title pt-4 float-right">Your Profile -
                                <small class="category">Here is your bio</small>
                            </h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body card-primary card-outline">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><i class="fas fa-user mr-1"></i> Name</label>
                                        <label class="form-control" name="about" id="about"><?= $user['nama']; ?></label>
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <input type="email" class="" value="<?= $user['email']; ?>" name="email" id="email" hidden>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><i class="far fa-envelope mr-1"></i> Email</label>
                                        <label type="email" class="form-control" value=""><?= $user['email']; ?></label>
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><i class="far fa-calendar-alt mr-1"></i> Joined Date </label> <i class="badge badge-success"><?= date('d F Y', $user['date_created']); ?></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="clearfix p-4 text-right">
                                <a href="<?= base_url() . 'user/edit_password' ?>" class="btn btn-danger">Update Password</a>
                                <a href="<?= base_url() . 'user/edit' ?>" class="btn btn-info">Update Profile</a>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid" src="<?= base_url() . 'assets/dist/img/user/' . $user['profile_image']; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $user['nama']; ?></h3>

                            <p class="text-muted text-center"><?= $user['about']; ?></p>

                            <ul class="list-group mb-3">
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right"> <?php if ($user['role_id'] == 1) {
                                                                                echo "Administrator";
                                                                            } else {
                                                                                echo "Member";
                                                                            }  ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Joined Date</b> <a class="float-right"><i class="label label-success"><?= date('d F Y', $user['date_created']); ?></i></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Change Date</b> <a class="float-right"><?= date('d F Y', $user['update_at']); ?></i></a>
                                </li>
                            </ul>

                            <div class="text-center"><?php if ($user['is_active'] == 1) {
                                                            echo "<i class='badge badge-success'>Activated</i>";
                                                        }  ?></a>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>