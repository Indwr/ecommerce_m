
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Fund Transfer (Rs<?php echo $wallet_amount['wallet_amount']?>)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fund Transfer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php echo form_open(base_url('Dashboard/Fund/transfer_fund'), array('method' => 'post')); ?>
                <div class="row">
                    <span class="text-center">
                        <h3><?php echo $this->session->flashdata('message');?></h3>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <?php
                            echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
                            ?>
                        </div>
                        <div class="form-group">
                            <label>User ID:</label>
                            <?php
                            echo form_input(array('type' => 'text', 'name' => 'user_id', 'class' => 'form-control' , 'id' => 'user_id'));
                            ?>
                            <span class="text-danger" id="userName"></span>
                        </div>
                        <div class="form-group">
                            <label>Remark:</label>
                            <?php
                            echo form_input(array('type' => 'text', 'name' => 'remark', 'class' => 'form-control'));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Transfer'));
                            ?>
                        </div>
                    </div>
                </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('footer');?>
<script>
$(document).on('blur','#user_id',function(){
    var url = '<?php echo base_url("Dashboard/User/get_user/")?>'+$(this).val();
    $.get(url,function(res){
        $('#userName').html(res)
    })
})    
</script>