<script type="text/javascript">
function for_section(value){
$.ajax({
  type: "POST",
  url: access_link+"attendance/ajax_class_section.php?class_name="+value+"",
  cache: false,
  success: function(detail){
     $("#student_class_section").html(detail);
  }
});
}
</script>
  
<script>
function for_list(){
var select_date = document.getElementById('select_date').value;
var std_class = document.getElementById('std_class').value;
var student_class_section = document.getElementById('student_class_section').value;
var student_availability = document.getElementById('student_availability').value;
//var order_by=document.getElementById('order_by').value;
if(select_date!=''){
$.ajax({
  type: "POST",
  url: access_link+"attendance/ajax_student_attendance_sms_select.php",
  cache: false,
  data: { select_date:select_date, std_class:std_class, student_class_section:student_class_section, student_availability:student_availability },
  success: function(detail){
     $("#view_detail").html(detail);
  }
});
}else{
    $("#view_detail").html('');
    alert_new('Please Select Date !!!','red');
}
}

function for_check(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
}

function valid(){
var sms_content=document.getElementById('absent_message').value;
var n = sms_content.includes("?");
var m=sms_content.split("?");
var q=m.length;
var num=0;
$(".sel_student").each(function() {
if($(this).prop("checked") == true){
num = Number(parseInt(num)+1);
}
});
if(num>0 && n==true && q==2){
    return true;
}else{
    alert_new("Please Select Atleast One Student and Don't Remove or Add ? Sign !!!",'red');
    return false;
}
}

$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
$.ajax({
	url: access_link+"attendance/student_attendance_sms_select_api.php",
	type: "POST",
	data: formdata,
	mimeTypes:"multipart/form-data",
	contentType: false,
	cache: false,
	processData: false,
	success: function(detail){
	    //alert(detail);
	   var res=detail.split("|?|");
	   if(res[1]=='success'){
		   alert_new('Successfully Mark & Sent SMS','green');
		   get_content('attendance/student_attendance_sms_select');
	}
	}
 });
});
</script>

    <section class="content-header">
      <h1>
        Attendance & SMS
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		  <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
          <li class="active"><i class="fa fa-user-plus"></i>Attendance & SMS</li>
      </ol>
    </section>
	
	
	
    <!-- Main content -->
    <form  method="post" enctype="multipart/form-data" id='my_form'>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"><b>Attendance & SMS Info</b></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<div class="col-md-12 col-md-offset-3">
			
                    <div class="col-md-2">	
                    <div class="form-group" >
                    <th><b style="font-size:15px">Select Date</b></th>
                    <input type="date" class="form-control" name="select_date" id="select_date" value="2022-12-03" required />
                    </div>
                    </div>

                    <div class="col-md-2">
                    <div class="form-group" >
                    <th><b style="font-size:15px">Class</b></th>
                    <select name="std_class" class="form-control new_student" id="std_class" onchange="for_section(this.value);">
                    <option value="All">All</option>
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
                    </div>
                    
                    <div class="col-md-1">
                    <div class="form-group" >
                    <th><b style="font-size:15px">Section</b></th>
                    <select class="form-control" name="student_class_section" id="student_class_section">
                    <option value="All">All</option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="col-md-2" >
                    <div class="form-group" >
                    <th><b style="font-size:15px">Attendance Type</b></th>
                    <select name="student_availability" class="form-control" id="student_availability">
                    <option value="All">All</option>
                    <option value="P">P</option>
                    <option value="P/2">P/2</option>
                    <option value="A">A</option>
                    <option value="L">L</option>
                    <option value="">Not Mark</option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="col-md-2" style="display:none;">
                    <label>Order By</label>
                    <select class="form-control" name="order_by" id="order_by" >
                    <option  value="">Select</option>
                    <option value="student_name">Student Name</option>
                    <option value="student_father_name">Father Name</option>
                    <option value="student_class_section">Class Section</option>
                    <option value="school_roll_no">School Roll No</option>
                    <option value="student_admission_number">Admission No</option>
                    <option value="student_scholar_number">Scholar No</option>
                    <option value="student_registration_number">Registration No</option>
                    <option value="student_enrollment_number">Enrollment No</option>
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
</form>
