

<script type="text/javascript">
function for_section(){
var class_name=document.getElementById('attendance_student_class').value;
  $('#attendance_student_section').html("<option value='' >Loading....</option>"); 
$.ajax({
type: "POST",
url:access_link+"attendance/ajax_class_section.php?class_name="+class_name+"",
cache: false,
success: function(detail){
$("#attendance_student_section").html(detail);
attendance_list();
}
});
}

function attendance_list(){
var class_name=document.getElementById('attendance_student_class').value;
var class_section=document.getElementById('attendance_student_section').value;
var student_class_stream=document.getElementById('student_class_stream').value;
var student_class_group=document.getElementById('student_class_group').value;
var t=0;
if(class_name=='11TH' || class_name=='12TH'){
if(student_class_group!='' && student_class_stream!=''){
t=1;
}
}else{
t=1;
}
if(class_name!='' && class_section!='' && t==1){
$("#search_list").html(loader_div);
$.ajax({
type: "POST",
url: access_link+"attendance/ajax_attendance_search.php?class_name="+class_name+"&class_section="+class_section+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"",
cache: false,
success: function(detail){
    // alert(detail);
$("#search_list").html(detail);
 $('#example1').DataTable();
  }
});
}else{
$("#search_list").html('');
}
}
function fill_attendance(){

var class_name=document.getElementById('attendance_student_class').value;
var class_section=document.getElementById('attendance_student_section').value;
var student_class_stream=document.getElementById('student_class_stream').value;
var student_class_group=document.getElementById('student_class_group').value;
var attendance_student_date=document.getElementById('attendance_student_date').value;
var t=0;
if(class_name=='11TH' || class_name=='12TH'){
if(student_class_group!='' && student_class_stream!=''){
	
t=1;
}
}else{
t=1;
}
if(class_name!='' && class_section!='' && t==1){
	var data12="attendance_student_class="+class_name+"&attendance_student_date="+attendance_student_date+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&section="+class_section;
	post_content('attendance/student_attendance_update',data12);

}else{
$("#get_content").html('');
}
}
function view_attendance(){
var class_name=document.getElementById('attendance_student_class').value;
var class_section=document.getElementById('attendance_student_section').value;
var student_class_stream=document.getElementById('student_class_stream').value;
var student_class_group=document.getElementById('student_class_group').value;
var attendance_student_date=document.getElementById('attendance_student_date').value;
var t=0;
if(class_name=='11TH' || class_name=='12TH'){
if(student_class_group!='' && student_class_stream!=''){
t=1;
}
}else{
t=1;
}
if(class_name!='' && class_section!='' && t==1){
	
	var data12="attendance_student_class="+class_name+"&attendance_student_date="+attendance_student_date+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&section="+class_section;
	post_content('attendance/student_attendance_list',data12);

}else{
$("#get_content").html('');
}
}
function for_stream(value2){
if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_group_subject_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_group_subject_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
}
}

function get_group(value1){
      $('#student_class_group').html("<option value='' >Loading....</option>"); 
$.ajax({
	  type: "POST",
	  url: access_link+"attendance/ajax_stream_group.php?stream_name="+value1+"",
	  cache: false,
	  success: function(detail1){
		  $("#student_class_group").html(detail1);
		  attendance_list();
	  }
   });
}
</script>


  <section class="content-header">
      <h1>
        Attendance Management         <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
	 <li class="active">Student Attendance Select</li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-3">
		
		  
		  <!-- /.box -->
         <div class="box box-success " style="padding:10px 10px 10px 10px;">
            <div class="box-header with-border">
              <h3 class="box-title">Fill Attendance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			  <div class="form-group">
				<label>Class :</label>
				
			
				 
				<select name="attendance_student_class" id="attendance_student_class" class="form-control" onchange="for_section();for_stream(this.value);" required>
					<option value="">Select</option>
										<option value="NURSERY">NURSERY</option>
										<option value="LKG">LKG</option>
										<option value="UKG">UKG</option>
										<option value="1ST">1ST</option>
										<option value="2ND">2ND</option>
										<option value="3RD">3RD</option>
										<option value="4TH">4TH</option>
										<option value="5TH">5TH</option>
										<option value="6TH">6TH</option>
										<option value="7TH">7TH</option>
										<option value="8TH">8TH</option>
										<option value="9TH">9TH</option>
										<option value="10TH">10TH</option>
										<option value="11TH">11TH</option>
										<option value="12TH">12TH</option>
									</select>
				
			
			  </div>
	
					<div class="form-group"  id="student_class_stream_div" style="display:none;">
					  <label >Stream</label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);" >
						   <option  value="All">All Stream</option>
						   
						   						   <option value="SCIENCE">SCIENCE</option>
						   						   <option value="ARTS">ARTS</option>
						   						   <option value="Commerce ">Commerce </option>
						   						   
					    </select>
					</div>

					<div class="form-group" id="student_class_group_div" style="display:none;">
					  <label >Group</label>
					      <select class="form-control" name="student_class_group" id="student_class_group" onchange="attendance_list();" >
					           <option  value="All">All Group</option>
					    </select>
					  </select>
					</div>
			  <div class="form-group">
				<label>Section :</label>
				<select name="attendance_student_section" id="attendance_student_section" class="form-control" onchange="attendance_list();" required>
					<option value='All'>All</option>
				</select>
			  </div>
			  <div class="form-group">
					<label for="exampleInputEmail1">Date  :</label>
										<input  type="date" class="form-control" name="attendance_student_date" id='attendance_student_date' max="2022-12-03" min="2020-03-08" value="2022-12-03" >
			  </div>
			  <div class="form-group">
					<center><button type="submit" name="fill" onclick="fill_attendance();" class="btn btn-success">Fill Attendance</button>
					<button type="submit" name="view" onclick="view_attendance();" class="btn btn-success">View Attendance </button></center>
			  </div>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		 
		
		</div>
		<div class="col-md-9">
         
          <!-- /.box -->
   <div class="box box-success " style="padding:10px 10px 10px 10px;">
            <div class="box-header with-border">
              <h3 class="box-title">Current Month Attenadnce List </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" style="height:800px;" id="search_list">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>S.no.</th>
                  <th>Roll.No.</th>
                  <th>student Name</th>
                  <th>Class</th>
				  <th>Section</th>
                  <th>Month</th>
                  <th>Present</th>
                  <th>Absent</th>
                  <th>Leave</th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                  <th>View</th>
                </tr>
                </thead>
                <tbody >
                
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
