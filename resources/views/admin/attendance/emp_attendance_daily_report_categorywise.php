
<script>
function for_list(){
var staff_type=document.getElementById('staff_type').value;
var from_date=document.getElementById('from_date').value;
var to_date=document.getElementById('to_date').value;

$("#pdf_detail").html('');

if(staff_type!='' && from_date!='' && to_date!=''){
var frm_date1=from_date.split('-');
var to_date1=to_date.split('-');
if(frm_date1[0]==to_date1[0] && frm_date1[1]==to_date1[1]){
$("#pdf_detail").html(loader_div);
$.ajax({
	  type: "POST",
	  url: access_link+"attendance/ajax_emp_attendance_daily_report_categorywise.php?staff_type="+staff_type+"&from_date="+from_date+"&to_date="+to_date+"",
	  cache: false,
	  success: function(detail){
		 $("#pdf_detail").html(detail);
	  }
   });
}else{
    alert_new('Please Select Same Month & Year in Both Dates !!!','red');
}
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
        Download Employee Daily Attendance Report
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Categorywise Daily Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Attendance Daily Report download</h3>
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
				<label>From Date</label>
				<input type="date" name="from_date" id="from_date" value="2022-12-03" class="form-control" oninput="for_list();" />
				</div>
				</div>
				
				<div class="col-md-2">
				<div class="form-group">
				<label>To Date</label>
				<input type="date" name="to_date" id="to_date" value="2022-12-03" class="form-control" oninput="for_list();" />
				</div>
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