<script>
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"account/add_account_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   //alert_new('Successfully Complete');
				   get_content('account/account_list');
            }
			}
         });
      });
</script>
    <section class="content-header">
      <h1>
       Account Management					<small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i>Account</a></li>
		<li class="active">Add Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title" style=" color: red;" > Bank Account Registration Form </h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="col-md-12">
			<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			
			   <div class="col-md-4 ">
						<div class="form-group">
						  <label>Account Holder Name<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="bank_account_holder_name" value="" class="form-control" required>
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Account Number<font style="color:red"><b>*</b></font></label>
						   <input type="number"  name="bank_account_no"  value="" class="form-control" required>
						</div>
				</div>
				
				<div class="col-md-4">		
					<div class="form-group">
						  <label>Account Opening Balance</label>
						  <input type="number" name="account_opening_balance" value="" class="form-control">
					</div>
				</div>
				<div class="col-md-4">    
						<div class="form-group">
						  <label>Bank Name<font style="color:red"><b>*</b></font></label>
						   <input type="text" name="bank_name"  value="" class="form-control" required>
						</div>
				</div>	
				<div class="col-md-4">		
						<div class="form-group">
						  <label>Bank Branch Name</label>
						   <input type="text" name="bank_branch_name" value="" class="form-control" required>
						</div>
				</div>
				<div class="col-md-4">		
						<div class="form-group">
						  <label>Bank IFSC Code</label>
						   <input type="text" name="bank_ifsc_code" value="" class="form-control" required>
						</div>
				</div>	
			<div class="col-md-12">
		        <center><input type="submit" name="submit" value="Submit" class="btn btn-primary"/></center>
		  </div>
		</form>	
</div>
          </div>
    </div>
</section>

 