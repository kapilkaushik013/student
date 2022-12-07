<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_account(s_no);       
 }            
else  {      
return false;
 }       
  }
function  delete_account(s_no){
$.ajax({
type: "POST",
url: access_link+"account/bank_account_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  // alert_new('Successfully Deleted');
				   get_content('account/account_list');
			   }else{
            //    alert_new(detail); 
			   }
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
		            <li class="active">Account List</li>
				  </ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-12">
					 
							<!-- /.box -->

							<div class="box box-success ">
								<div class="box-header with-border">
								  <h3 class="box-title">Account List</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead >
											<tr>
											   <th>S.no.</th>
											   <th>Account Holder Name</th>
											  <th>Account Number</th>
											  <th>Opening Balance</th>
											  <th>Current Balance</th>
											  <th>Bank Name</th>
											  <th>Bank Branch Name</th>
											  <th>Bank IFSC Code</th>
											  <th style="">Edit</th>
											  <th style="">Delete</th>
											</tr>
										</thead>
										<tbody>
																							
                    <tr>
                        <td>1</td>
                        <td>Monika rathore</td>
                        <td>9896384654</td>
                        <td>5000</td>
                        <td>-3000</td>
                        <td>sbi</td>
                        <td>Narela</td>
                        <td>56464</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=50')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('50');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>2</td>
                        <td>nidhi</td>
                        <td>98789787667</td>
                        <td>7000</td>
                        <td>0</td>
                        <td>pnb bank</td>
                        <td>bhopal</td>
                        <td>776587</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=51')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('51');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>3</td>
                        <td>Monika rathore</td>
                        <td>757415815</td>
                        <td>500</td>
                        <td>0</td>
                        <td>sbi</td>
                        <td>Narela</td>
                        <td>5642266</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=52')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('52');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>4</td>
                        <td>kanhar valley public school</td>
                        <td>7740047</td>
                        <td>100</td>
                        <td>0</td>
                        <td>sbi</td>
                        <td>bpl</td>
                        <td>sbin000440</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=53')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('53');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>5</td>
                        <td>NIDHI SINGH</td>
                        <td>1524624524515</td>
                        <td>10000</td>
                        <td>0</td>
                        <td>BANK OF INDIA</td>
                        <td>BOI</td>
                        <td>ifsc234</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=54')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('54');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>6</td>
                        <td>Rajat Sharma </td>
                        <td>45789654123541</td>
                        <td>50000</td>
                        <td>0</td>
                        <td>Union bank </td>
                        <td>Raisen </td>
                        <td>Un1025482</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=56')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('56');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>7</td>
                        <td>Pokhari</td>
                        <td>100</td>
                        <td>0</td>
                        <td>0</td>
                        <td>abc</td>
                        <td>abc</td>
                        <td>111</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=57')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('57');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>8</td>
                        <td>Laxman</td>
                        <td>1010</td>
                        <td>0</td>
                        <td>0</td>
                        <td>Hari Bank</td>
                        <td>ccc</td>
                        <td>cccc</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=58')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('58');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>9</td>
                        <td>Jalgaon Jamod Secondary and Higher Secondary School</td>
                        <td>123456789012345</td>
                        <td>2147483647</td>
                        <td>0</td>
                        <td>Jalgaon Jamod Urban Cooprative Bank Pvt. Ltd.</td>
                        <td>Jalgaon Jamod Main Branch</td>
                        <td>HDFC0CJJUCB</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=59')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('59');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>10</td>
                        <td>hemant</td>
                        <td>987654321456987</td>
                        <td>70000</td>
                        <td>0</td>
                        <td>rahu sir</td>
                        <td>dev sir</td>
                        <td>9074</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=60')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('60');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>11</td>
                        <td>Sushil</td>
                        <td>89878767655555555</td>
                        <td>200</td>
                        <td>0</td>
                        <td>STATE BANK OF INDIA</td>
                        <td>Delhi</td>
                        <td>456546546</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=61')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('61');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>12</td>
                        <td>abc</td>
                        <td>12345</td>
                        <td>99</td>
                        <td>-56</td>
                        <td>state bank of india</td>
                        <td>mau</td>
                        <td>sbin0976554</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=62')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('62');" style="" >Delete</button>
                        </td>
                    </tr>
																							
                    <tr>
                        <td>13</td>
                        <td>aaaa</td>
                        <td>1111</td>
                        <td>1</td>
                        <td>0</td>
                        <td>aaaa</td>
                        <td>aaaa</td>
                        <td>aaaa1111</td>
                        <td>
                        <button type="button"  onclick="post_content('account/edit_account','id=63')" class="btn btn-success" style="" >Edit</button></td><td>
                        <button type="button"  class="btn btn-danger" onclick="return valid('63');" style="" >Delete</button>
                        </td>
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
<script>
  $(function () {
    $('#example1').DataTable()

  })
</script>