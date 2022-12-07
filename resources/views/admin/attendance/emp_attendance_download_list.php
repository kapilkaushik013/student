<script>
function for_list(){
var month_name = document.getElementById('month_name').value;
var staff_type = document.getElementById('staff_type').value;
var emp_register = document.getElementById('emp_register').value;
var order_by=document.getElementById('order_by').value;
if(month_name!=''){
$.ajax({
  type: "POST",
  url: access_link+"attendance/ajax_emp_attendance_download_list.php",
  cache: false,
  data: { month_name:month_name, staff_type:staff_type, emp_register:emp_register, order_by:order_by },
  success: function(detail){
     $("#view_detail").html(detail);
  }
});
}else{
    $("#view_detail").html('');
    alert_new('Please Select Month !!!',"red");
}
}
</script>

<script>
function for_print(){
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
//$('#printTable').print();
 }
</script>

    <section class="content-header">
      <h1>
        Download Attendance Info
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		  <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
          <li class="active"><i class="fa fa-user-plus"></i>Download</li>
      </ol>
    </section>
	
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><b>Attendance Download Info</b></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<div class="col-md-12 col-md-offset-2">
			
                    <div class="col-md-2">	
                    <div class="form-group" >
                    <th><b style="font-size:15px">Select Month</b></th>
                    <select class="form-control" name="month_name" id="month_name" required>
                    <option value="" >Select Month</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    <option value="01">Jaunary</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    </select>
                    </div>
                    </div>

                    <div class="col-md-1">
                    <div class="form-group" >
                    <th><b style="font-size:15px">Staff type</b></th>
                    <select name="staff_type" id="staff_type" class="form-control" required>
                    <option value="All">All</option>
                    <option value="Teaching">Teaching</option>
                    <option value="Non Teaching">Non Teaching</option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="col-md-2">
                    <div class="form-group" >
                    <th><b style="font-size:15px">Register</b></th>
                    <select name="emp_register" id="emp_register" class="form-control" required>
                    <option value="All">All</option>
                                        <option value="Register1">Register1</option>
                                        <option value="Register2">Register2</option>
                                        <option value="Register3">Register3</option>
                                        <option value="Register4">Register4</option>
                                        <option value="Register5">Register5</option>
                                        <option value="Register6">Register6</option>
                                        <option value="Register7">Register7</option>
                                        <option value="Register8">Register8</option>
                                        <option value="Register9">Register9</option>
                                        <option value="Register10">Register10</option>
                                        </select>
                    </div>
                    </div>
                    
                    <div class="col-md-2">
                    <label>Order By</label>
                    <select class="form-control" name="order_by" id="order_by" >
                    <option  value="">Select</option>
                    <option value="emp_name">Employee Name</option>
                    <option value="emp_id">Employee Id</option>
                    <option value="emp_priority">Employee Priority</option>
                    </select>
                    </div>
                    
                    <div class="col-md-1">
                    <div class="form-group" >
                    <th><b style="font-size:15px">For List</b></th>
                    <center><button type="button" class="btn btn-primary" onclick="for_list();" >View Print</button></center>
                    </div>
                    </div>
                    
			</div>
		    
		    </br></br></br><hr>
		    
		    <div class="col-md-12" id="view_detail">
            
            </div>
					
			</div>
		
		
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>

</section>
  
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
