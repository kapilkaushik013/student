
<script>
			function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_account(s_no);       
 }else{      
return false;
 }       
  }
function  delete_account(s_no){
$.ajax({
type: "POST",
url: access_link+"account/income_or_expence_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   //alert_new('Successfully Deleted');
				   get_content('account/income_or_expence_list');
			   }else if(res[1]=='session_not_set'){
                alert_new('Session Expire !!!','red');
            }else{
              //  alert_new(detail); 
			   }
}
});
}

function open_file1(image_type,s_no){

$.ajax({
address: "POST",
url: access_link+"account/ajax_open_image.php?image_type="+image_type+"&s_no="+s_no+"",
cache: false,
success: function(detail){
 $("#mypdf_view").html('');
 $("#mypdf_view").html(detail);
}
});
}
</script>
  	
  <section class="content-header">
      <h1>
            Account Management					<small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i>Account</a></li>
		<li><a href="javascript:get_content('account/add_income_or_expence_info')"><i class="fa fa-user-plus"></i>Add Info</a></li>
		<li><i class="Active"></i>List</li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box box-success ">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
				<tr>
                  <th></i>S.no.</th>
                  <th></i>Date</th>
                  <th></i>Customer Name</th>
                  <th></i>Address</th>
                  <th></i>Designation</th>
                  <th></i>Amount Type</th>				  
				  <th></i>Total Amount</th>
				  <th></i>Bill File</th>
				  
				  
				  <th>Update By</th>
                  <th>Date</th>
				  <th style=""></i>Edit</th>
				  <th style=""></i>Delete</th>
				  <th></i>Print Voucher</th>
				</tr>
                </thead>
                <tbody>
				                
				<tr>         
				<td>1</td>
				<td>02-12-2022</td>
				<td>kailash soni</td>
				<td>hoshangabad city</td>
				<td>Teacher</td>
				<td>Debit</td>
				<td>3000</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>02-12-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=333')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('333');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=333' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>2</td>
				<td>30-11-2022</td>
				<td>aaaa</td>
				<td>abc</td>
				<td></td>
				<td>Debit</td>
				<td>1</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>30-11-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=332')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('332');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=332' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>3</td>
				<td>30-11-2022</td>
				<td>Nidhi </td>
				<td>abc</td>
				<td></td>
				<td>Debit</td>
				<td>55</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>30-11-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=331')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('331');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=331' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>4</td>
				<td>25-11-2022</td>
				<td>Nidhi </td>
				<td>nhhj</td>
				<td></td>
				<td>Credit</td>
				<td>800</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>25-11-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=330')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('330');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=330' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>5</td>
				<td>14-08-2022</td>
				<td>Nidhi </td>
				<td>Bhopal </td>
				<td></td>
				<td>Debit</td>
				<td>9000</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>14-08-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=303')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('303');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=303' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>6</td>
				<td>02-05-2022</td>
				<td>aaaaa</td>
				<td></td>
				<td></td>
				<td>Debit</td>
				<td>500</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>02-05-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=277')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('277');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=277' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>7</td>
				<td>02-05-2022</td>
				<td>aaaaa</td>
				<td></td>
				<td></td>
				<td>Credit</td>
				<td>500</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>02-05-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=276')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('276');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=276' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>8</td>
				<td>10-04-2022</td>
				<td>aaaaa</td>
				<td>mbjj h</td>
				<td></td>
				<td>Credit</td>
				<td>2000</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>10-04-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=265')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('265');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=265' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                
				<tr>         
				<td>9</td>
				<td>03-04-2022</td>
				<td></td>
				<td></td>
				<td></td>
				<td>Debit</td>
				<td>500</td>
			
				<td> <img onclick="open_file1('bill_upload','');" src="../../school_software_v1_old/images/student_blank.png"  height="50" width="50" style="margin-top:10px;"></td>
				
				<td>rahul@simption.com</td>
                <td>03-04-2022</td>
				
                <td style=""><button type="button"  onclick="post_content('account/income_or_expence_edit','id=262')" class="btn btn-success" style="">Edit</button></td>
                <td style=""><button type="button"  class="btn btn-danger" onclick="return valid('262');">Delete</button></td>
			    <td><a href='../school_software_v1_old/pdf/pdf/account_voucher/account_payment_voucher.php?id=262' target="_blank"><button type="button" class="btn btn-success" style="">Print</button></a></td>
			
				</tr>				
				                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<div id="mypdf_view">
</div>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
