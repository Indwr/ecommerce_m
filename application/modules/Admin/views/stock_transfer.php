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
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" class="form-control" name="user_id" value="<?php echo set_value('user_id');?>" placeholder="Enter Franchise/User ID">
                    <span class="text-danger"><?php echo form_error('user_id')?></span>
                    <span id="errorMessage"></span>
                </div>
                <div class="form-group">
                    <label>Select Product</label>
                    <select class="form-control" name="product">
                        <?php foreach($data as $d):?>
                        <option value="<?php echo $d['id'];?>"><?php echo $d['title'];?> (<?php echo $d['quantity'];?>)</option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" name="quantity" value="<?php echo set_value('quantity');?>" placeholder="Enter Qunatity">
                    <span class="text-danger"><?php echo form_error('quantity')?></span>
                    <span id="errorMessage"></span>
                </div>
                <div class="form-group">
                    <label>Transaction ID</label>
                    <input type="text" class="form-control" name="tranxid" value="<?php echo set_value('tranxid');?>" placeholder="Enter Transaction ID">
                    <span class="text-danger"><?php echo form_error('tranxid')?></span>
                    <span id="errorMessage"></span>
                </div>
                <div class="form-group">
                    <button type="subimt" name="save" class="btn btn-success" />Transfer</button>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once 'footer.php'; ?>