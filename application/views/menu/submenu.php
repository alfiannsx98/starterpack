<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $title; ?></h1>
            </div>
            <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
            </ol>
            </div> -->
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card"> 
                <div class="card-header"> 
                    <h3 class="card-title"><?= $title ?> Table <button data-toggle="modal" data-target="#newroleModal" class="btn btn-just-icon btn-round btn-success">Add Data <i class="fa fa-plus"></i></button></h3> 
                </div>
            <!-- /.card-header -->
            <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>title</th>
                            <th>url</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $m) :
                        $id_user_sub_menu = $m['id_submenu'];
                        $id_menu = $m['menu'];
                        $title = $m['title'];
                        $url = $m['url'];
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $m['menu']; ?></td>
                            <td><?= $m['title']; ?></td>
                            <td><?= $m['url']; ?></td>
                            <td class="text-right">
                                <button class="btn btn-info btn-xs btn-round" data-toggle="modal" data-target="#modal_edit<?= $id_user_sub_menu; ?>">Edit Submenu</button>
                                <button class="btn btn-danger btn-xs btn-round" data-toggle="modal" data-target="#modal_hapus<?= $id_user_sub_menu; ?>">Hapus Submenu</button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>title</th>
                            <th>url</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>  
<!-- /.content-wrapper -->


<!-- Akhir Pembatas -->

<!--MODAL DIALOG UNTUK CREATE DATA!-->
<div class="modal fade" id="newroleModal" tabindex="-1" role="dialog" aria-labelledby="newroleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newroleModal">Create New Data</h5>
                </button>   
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Pilih Menu</label>
                        <select class="form-control" name="menu_id" id="menu_id">
                        <option disabled selected>Pilih Menu Terlebih Dahulu!</option>
                            <?php foreach($menu as $m) : ?>
                            <option value="<?= $m['id_menu']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Isikan Title Submenunya</label>
                        <input type="text" class="form-control" name="title" placeholder="masukkan title">
                    </div>
                    <div class="form-group">
                        <label for="">Isikan URL Submenunya</label>
                        <input type="text" name="url" placeholder="masukkan url" class="form-control">
                        <input type="hidden" value="1" name="is_active">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
foreach ($subMenu as $i) :
    $id = $i['id_submenu'];
    $title = $i['title'];
    $url = $i['url'];
    $menu_subm = $i['menu_id'];
    ?>

<div class="modal fade" id="modal_edit<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Edit role</h3>
            </div>
            <form action="<?= base_url('menu/edit_submenu'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_submenu" id="id_submenu" value="<?= $id; ?>">
                    <div class="form-group">
                        <label for="">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                        <?php
                            $dt_menu = $this->db->get_where("user_menu", ['id_menu' => $menu_subm])->row_array();
                        ?>
                            <option value="<?= $menu_subm ?>" selected disabled><?= $dt_menu['menu']; ?></option>
                            <option value="<?= $menu_subm ?>" selected hidden><?= $dt_menu['menu']; ?></option>
                        <?php  
                            $q_ktg = $this->db->query("SELECT * FROM user_menu")->result_array();
                            foreach($q_ktg as $menu1):
                        ?>
                            <option value="<?= $menu1['id_menu'] ?>"><?= $menu1['menu'];?></option>
                        <?php
                            endforeach;
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Isikan Title Submenunya</label>
                        <input type="text" class="form-control" name="title" value="<?= $title; ?>" placeholder="masukkan title">
                    </div>
                    <div class="form-group">
                        <label for="">Isikan URL Submenunya</label>
                        <input type="text" name="url" placeholder="masukkan url" value="<?= $url; ?>" class="form-control">
                        <input type="hidden" value="1" name="is_active">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--MODAL HAPUS DATA!-->
<div class="modal fade" id="modal_hapus<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Hapus Menu</h3>
            </div>
            <form action="<?= base_url() . 'menu/hapus_submenu'; ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <p>Apakah Anda yakin mau menghapus data ini? <b><?= $title; ?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_menu" value="<?= $id; ?>">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endforeach; ?>