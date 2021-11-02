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
                <div class="form-group">
                    <label><?php echo $fi['label'];?></label>
                    <input type="<?php echo $fi['type'];?>" class="form-control" name="<?php echo $fi['name'];?>" value="<?php echo set_value($fi['name']);?>" placeholder="<?php echo $fi['placeholder'];?>">
                    <span class="text-danger"><?php echo form_error($fi['name'])?></span>
                    <span id="errorMessage"></span>
                </div>
                <?php endforeach;?>
                <div class="form-group">
                    <button type="subimt" name="save" class="btn btn-success" /><?php echo $submit;?></button>
                </div>
                <?php echo form_close();?>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <?php foreach($thead as $tk => $th): ?>
                                <th><?php echo $th;?></th>
                                <?php endforeach;?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tableRecord as $key => $tRecord):?>
                            <tr>
                                <td><?php echo ($key+1);?></td>
                                <?php 
                                    $cellvalue = count($tbody);
                                    for($j=0;$j<$cellvalue;$j++):
                                ?>
                                <td><?php echo ($tbody[$j] ==  'image' ) ? '<img src="'.base_url('uploads/'.$tRecord[$tbody[$j]]).'" height="150px" width="150px">':$tRecord[$tbody[$j]];?></td>
                                <?php endfor; ?>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once 'footer.php'; ?>