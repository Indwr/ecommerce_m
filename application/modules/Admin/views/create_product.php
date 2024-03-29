<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create New Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Shoppingt</li>
              <li class="breadcrumb-item active">Create New Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
                <?php echo form_open(base_url('Admin/Package/CreateProduct')); ?>
                <div class="kt-portlet__body">
                    <h2><?php echo $this->session->flashdata('message'); ?></h2>
                    <div class="form-group">
                        <label>Product Name</label>
                        <div></div>
                        <?php
                        echo form_input(array('type' => 'text', 'class' => 'form-control', 'name' => 'title', 'value' => set_value('title')));
                        ?>
                        <span class="text-danger"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Select Category</label>
                        <div></div>
                        <?php
                        foreach($category as $key => $cat){
                          $option[$cat['id']] = $cat['category_name'];
                        }
                        echo form_dropdown('category',$option,'','class = form-control');
                        ?>
                        <span class="text-danger"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Select Category Type</label>
                        <?php
                          $option = [
                            '1' => 'Top Saver',
                            '2' => 'Best Seller',
                            '3' => 'New Arrival',
                          ];
                        echo form_dropdown('category_type',$option,'','class = form-control');
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Veg/Non-Veg</label>
                        <?php
                          $option = [
                            '1' => 'Veg',
                            '2' => 'Non-Veg',
                          ];
                        echo form_dropdown('vegtype',$option,'','class = form-control');
                        ?>
                    </div>
                    <div class="form-group">
                        <label>MRP</label>
                        <div></div>
                        <?php
                        echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'mrp', 'value' => set_value('mrp')));
                        ?>
                        <span class="text-danger"><?php echo form_error('mrp'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <div></div>
                        <?php
                        echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'discount', 'value' => set_value('discount')));
                        ?>
                        <span class="text-danger"><?php echo form_error('discount'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>DP</label>
                        <div></div>
                        <?php
                        echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'dp', 'value' => set_value('dp')));
                        ?>
                        <span class="text-danger"><?php echo form_error('dp'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>BV</label>
                        <div></div>
                        <?php
                        echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'bv', 'value' => set_value('bv')));
                        ?>
                        <span class="text-danger"><?php echo form_error('bv'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Available IN</label>
                        <div></div>
                        <?php
                        echo form_input(array('type' => 'text', 'class' => 'form-control', 'name' => 'type', 'value' => set_value('type')));
                        ?>
                        <span class="text-danger"><?php echo form_error('type'); ?></span>
                    </div>
                    <!--<div class="form-group">
                        <label>IGST</label>
                        <div></div>
                        <?php
                        //echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'igst', 'value' => set_value('igst')));
                        ?>
                        <span class="text-danger"><?php //echo form_error('igst'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>SGST</label>
                        <div></div>
                        <?php
                        //echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'sgst', 'value' => set_value('sgst')));
                        ?>
                        <span class="text-danger"><?php //echo form_error('sgst'); ?></span>
                    </div> -->
                    <div class="form-group">
                        <label>Description</label>
                        <div></div>
                        <?php
                        echo form_textarea(array('class' => 'form-control', 'name' => 'description', 'value' => set_value('description'),'cols' => 5,'rows' =>3,'id' => 'long_desc'));
                        ?>
                        <span class="text-danger"><?php echo form_error('description'); ?></span>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <?php
                        echo form_input(array('type' => 'submit', 'class' => 'btn btn-primary pull-right', 'name' => 'create', 'value' => 'Create'));
                        ?>
                    </div>
                </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once'footer.php'; ?>
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('long_desc',{
    width: "500px",
    height: "200px"
  }); 
  </script>
