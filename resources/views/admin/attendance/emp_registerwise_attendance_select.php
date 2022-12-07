<script>
function emp_attendance(value){
if(value!=''){
    $("#search_list").html(loader_div);
$.ajax({
type: "POST",
url: access_link+"attendance/ajax_emp_registerwise_attendance_search.php?type="+value+"",
cache: false,
success: function(detail){
$("#search_list").html(detail);
  }
});
}else{
$("#search_list").html('');
}
}
function fill_attendance(){
var staff_attendance_date=document.getElementById('staff_attendance_date').value;
var staff_type=document.getElementById('staff_type').value;
if(staff_attendance_date!='' && staff_type!=''){
	var data12="staff_type="+staff_type+"&date="+staff_attendance_date;
	post_content('attendance/emp_registerwise_attendance_update',data12);
	}else{
	alert_new("Please Select Date and Staff Type",'red');
	}

}
function view_attendance(){
var staff_attendance_date=document.getElementById('staff_attendance_date').value;
var staff_type=document.getElementById('staff_type').value;
if(staff_attendance_date!='' && staff_type!=''){
	var data12="staff_type="+staff_type+"&date="+staff_attendance_date;
	post_content('attendance/emp_registerwise_attendance_list',data12);
	}else{
	alert_new("Please Select Date and Staff Type",'red');
	}
}
</script>

    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Attendance Management         <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
	 <li class="active">Staff Attendance Select</li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
   
		<div class="col-md-3">
		
		  <form  method="post" enctype="multipart/form-data">
		  <!-- /.box -->
         <div class="box box-success " style="padding:10px 10px 10px 10px;">
            <div class="box-header with-border">
              <h3 class="box-title">Fill Attendance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			  <div class="form-group">
				<label>Register :</label>
				<select name="staff_type" id="staff_type" class="form-control" onchange="emp_attendance(this.value);" required>
				<option value="">Select </option>
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
			  <div class="form-group">
					<label for="exampleInputEmail1">Date :</label>
										<input  type="date" class="form-control" id='staff_attendance_date' name="staff_attendance_date" max="2022-12-03" min="2020-03-08" value="2022-12-03" >
			  </div>
			  <div class="form-group">
					<center><button type="button" onclick="fill_attendance();" class="btn btn-success">Fill Attendance</button>
					<button type="button" name="view" onclick="view_attendance();" class="btn btn-success">View Attendance</button></center>
			  </div>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  </form>
		
		</div>
		<div class="col-md-9">
         
          <!-- /.box -->
       <div class="box box-success " style="padding:10px 10px 10px 10px;">
            <div class="box-header with-border">
              <h3 class="box-title">Current Month Attenadnce List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" style="height:800px;">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>S.no.</th>
                  <th>Staff Name</th>
                  <th>Type</th>
				  <th>Designation</th>
                  <th>Month</th>
                  <th>Present</th>
                  <th>Absent</th>
                  <th>Leave</th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                  <th>View</th>
                </tr>
                </thead>
                <tbody id="search_list">
                
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
    <!-- /.content -->
<script>
$(function () {
$('#example1').DataTable()
})

</script>    
