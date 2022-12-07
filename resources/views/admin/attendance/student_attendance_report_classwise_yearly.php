
<script>
function for_section(value){
$('#student_class_section').html("<option value='' >Loading....</option>");
$.ajax({
	  type: "POST",
	  url: access_link+"attendance/ajax_class_section.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
		 $("#student_class_section").html(detail);
		 for_list();
	  }
   });
}

function for_list(){
var class_name=document.getElementById('std_class').value;
var section_name=document.getElementById('student_class_section').value;
var order_by=document.getElementById('order_by').value;

var month_val=[];
var month_count=0;
$(".my_month").each(function() {
if($(this).prop("checked") == true){
month_val.push($(this).val());
month_count=Number(month_count+1);
}
});

$("#pdf_detail").html('');

if(class_name!='' && section_name!='' && month_count>0){
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"attendance/ajax_student_attendance_report_classwise_yearly.php",
	  data: { class_name:class_name, section_name:section_name, month_val:month_val, month_count:month_count, order_by:order_by },
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
  });
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
for_list();
}
</script>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Download Student Yearly Attendance Report
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Yearly Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Attendance Yearly Report download</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12 col-md-offset-3" id="search_detail">
								
				<div class="col-md-2">				
				<div class="form-group" >
				<label>Class</label>
				<select name="std_class" class="form-control new_student" id="std_class" onchange="for_section(this.value);" >
				<option value="All">All Class</option>
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

				<div class="col-md-2">
				<div class="form-group">
				<label>Section</label>
				<select class="form-control" name="student_class_section" id="student_class_section" onchange="for_list();">
				<option value="All">All</option>
				</select>
				</div>
				</div>
				
                <div class="col-md-2">
                <label>Order By</label>
                <select class="form-control" name="order_by" id="order_by" onchange="for_list();" >
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
				
			</div>
			<div class="col-md-12"><span style="float:right;font-weight:bold;color:red;"><input type="checkbox" name="" id="my_month" onclick="for_check(this.id);" /> All</span></div>
			<div class="col-md-12">
						<div class="col-md-2">
			<input type="checkbox" name="" value="04" class="my_month" onclick="for_list();" /> April			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="05" class="my_month" onclick="for_list();" /> May			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="06" class="my_month" onclick="for_list();" /> June			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="07" class="my_month" onclick="for_list();" /> July			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="08" class="my_month" onclick="for_list();" /> August			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="09" class="my_month" onclick="for_list();" /> September			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="10" class="my_month" onclick="for_list();" /> October			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="11" class="my_month" onclick="for_list();" /> November			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="12" class="my_month" onclick="for_list();" /> December			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="01" class="my_month" onclick="for_list();" /> January			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="02" class="my_month" onclick="for_list();" /> February			</div>
						<div class="col-md-2">
			<input type="checkbox" name="" value="03" class="my_month" onclick="for_list();" /> March			</div>
						</div>
			
			</br></br></br><hr>
					
			<div class="col-md-12" id="pdf_detail">
			
			</div>
			
	        </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
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
<script>
for_list();
</script>