<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="input-group">
            <a href="<?php echo base_url(); ?>index.php/addUser"><button class="btn btn-default"><i class="fa fa-plus"></i> Add New Admin</button></a>
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Administrator</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Table Administrator Data</h3>
            </div>
            <div class="box-body">
                <table id="adminTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($adminRecords)) {
                        $no = 1;
                        foreach ($adminRecords as $record) {
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $record->name ?></td>
                                <td><?php echo $record->username ?></td>
                                <td><?php  if($record->id_role == '1') ?>Super Admin</td>
                                <td><?php  if($record->id_role == '2') ?>Admin</td>
                                <td><?php echo $record->status ?></td>
                                <td class="text-center">
                                    <button class="btn btn-small"><i class="icon fa fa-eye" title="edit"></i></button>
                                    <button class="btn btn-small"><i class="icon fa fa-trash" title="delete"></i></button>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>