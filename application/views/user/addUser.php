<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">

    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Add New User</h3>
            </div>
            <form role="form" method="post" action="<?php base_url(); ?>insertOneUser">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">Full Name</label>
                        <input type="text" class="form-control" id="fullname">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" id="role">
                            <?php if(!empty($userRole)){
                                foreach ($userRole as $row) {
                            ?>
                                    <option value="<?php echo $row->ID?>"><?php echo $row->role?></option>
                            <?php
                                }
                            }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="radio">
                            <label><input type="radio" id="status1" value="active">Active</label>
                            <label><input type="radio" id="status" value="suspend">Suspend</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address">
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                    <button type="submit" class="btn btn-default pull-right cancel">Cancel</button>
                </div>
            </form>
        </div>
    </section>
</div>
