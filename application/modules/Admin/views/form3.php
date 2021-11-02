<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $header;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <?php echo form_open_multipart();?>
                <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                <?php foreach($field as $kf => $fi):?>
                <div class="form-group" style="<?php echo $fi['style'];?>" id="<?php echo $fi['id'];?>">
                    <label><?php echo $fi['label'];?></label>
                    <input type="<?php echo $fi['type'];?>" class="form-control" name="<?php echo $fi['name'];?>" value="<?php echo $fi['value'];?>" placeholder="<?php echo $fi['placeholder'];?>">
                    <span class="text-danger"><?php echo form_error($fi['name'])?></span>
                    <span id="errorMessage"></span>
                </div>
                <?php endforeach;?>
                <?php if(!empty($select)){ echo $select;}?>
                <div class="form-group">
                    <button type="subimt" name="save" class="btn btn-success" /><?php echo $submit;?></button>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once 'footer.php'; ?>