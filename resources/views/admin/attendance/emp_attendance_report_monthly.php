
<script>
function for_list(){
var staff_type=document.getElementById('staff_type').value;
var attendance_month=document.getElementById('attendance_month').value;
var order_by=document.getElementById('order_by').value;

$("#pdf_detail").html('');

if(staff_type!='' && attendance_month!=''){
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"attendance/ajax_emp_attendance_report_monthly.php?staff_type="+staff_type+"&attendance_month="+attendance_month+"&order_by="+order_by+"",
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
   });
}

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
        Download Employee Monthly Attendance Report
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Monthly Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Attendance Monthly Report download</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
            <div class="box-body">
			
			<div class="col-md-12 col-md-offset-3" id="search_detail">
				
				<div class="col-md-2">
				<div class="form-group">
				<label>Staff type</label>
				<select name="staff_type" id="staff_type" class="form-control" onchange="for_list();" required>
				<option value="All">All</option>
				<option value="Teaching">Teaching</option>
				<option value="Non Teaching">Non Teaching</option>
				</select>
				</div>
				</div>
				
				<div class="col-md-2">
				<div class="form-group">
				<label>Month</label>
				<select name="attendance_month" id="attendance_month" class="form-control" onchange="for_list();" >
			    <option value="">Select</option>
                <option  value="04">April </option>
                <option  value="05">May </option>
                <option  value="06">June </option>
                <option  value="07">July </option>
                <option  value="08">August </option>
                <option  value="09">September </option>
                <option  value="10">October </option>
                <option  value="11">November </option>
                <option selected value="12">December </option>
                <option  value="01">Jaunary </option>
                <option  value="02">February </option>
                <option  value="03">March </option>
				</select>
				</div>
				</div>
				
				<div class="col-md-2">
                <label>Order By</label>
                <select class="form-control" name="order_by" id="order_by" onchange="for_list();" >
                <option  value="">Select</option>
                <option value="emp_name">Employee Name</option>
                <option value="emp_id">Employee Id</option>
                <option value="emp_priority">Employee Priority</option>
                </select>
                </div>
				
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