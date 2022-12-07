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
var month_name = document.getElementById('month_name').value;
var std_class = document.getElementById('std_class').value;
var student_class_section = document.getElementById('student_class_section').value;
var order_by=document.getElementById('order_by').value;
if(month_name!=''){
$.ajax({
  type: "POST",
  url: access_link+"attendance/attendance_export.php",
  cache: false,
  data: { month_name:month_name, std_class:std_class, student_class_section:student_class_section, order_by:order_by },
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
                    
                    <div class="col-md-2">
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
