<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Advertisement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Create Advertisement</li>
                        <li class="breadcrumb-item active">Create Advertisement</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <?php echo form_open_multipart(); ?>
            <div class="form-group">
                <label>Business Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" placeholder="Enter Name" style="max-width: 400px"/>
                <span class="text-danger"><?php echo form_error('name') ?></span>
            </div>
            <div class="form-group">
                <label>Business City</label>
                <input type="text" class="form-control" name="city" value="<?php echo set_value('city'); ?>" placeholder="Enter your City" style="max-width: 400px"/>
                <span class="text-danger"><?php echo form_error('city') ?></span>
            </div>
            <div class="form-group">
                <label>Business State</label>
                <input type="text" class="form-control" name="state" value="<?php echo set_value('state'); ?>" placeholder="Enter your State" style="max-width: 400px"/>
                <span class="text-danger"><?php echo form_error('state') ?></span>
            </div>
            <div class="form-group">
                <label>Upload Visting Card</label>
                <input type="file" class="form-control" name="userfile" style="max-width: 400px"/>
                <span class="text-danger"><?php echo form_error('userfile') ?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Submit</button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
