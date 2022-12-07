
<script type="text/javascript">
   function fill_detail(value){

		$('#rfid_no').val(value);
		set_attendance(value);
		
    }

	function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
		$('#contact').val('Dear Member, You has Come to School.');
		 $('#send_sms').val('Yes');
    } else {
       text.style.display = "none";
	   $('#contact').val('');
	   $('#send_sms').val('No');
    }
}

function set_attendance(value){
   if(value!=''){
var sms=document.getElementById('contact').value;
var send_sms=document.getElementById('send_sms').value;

$.ajax({
	type:"POST",
	url: access_link+"attendance/ajax_set_emp_rfid_attendance.php?rfid="+value+"&sms="+sms+"&send_sms="+send_sms+"",
	cache:false,
	success:function(data)
	{
	$('#rfid_no').val('');
	$('#hidden_rfid').val(value);
	attendance_detail();
	}
});

}
}
function check_same(value){
var len=value.length;
if(len==10){
var hidden_rfid1=document.getElementById('hidden_rfid').value;
if(hidden_rfid1==value){
$('#rfid_no').val('');
}
}
}

function attendance_detail(){
    $("#attendance_list").html(loader_div);
$.ajax({
	type:"POST",
	url:access_link+"attendance/ajax_get_emp_attendance_list.php",
	cache:false,
	success:function(data)
	{
	$('#attendance_list').html(data);
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
	  <li class="active">  Employee RFID Attendance</li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <div class="col-md-8"><h3 class="box-title">RFID Attendance</h3></div>
			  <div class="col-md-4"><button type="button" class="btn btn-success style="float:right;" onclick="attendance_detail();">Refresh List</button></div>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
	
				<div class="col-md-4 box-body table-responsive">
                <table id="table-data" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Enter RFID No</th>
                </tr>
                </thead>
				<tbody>
					<tr>
					<input type="hidden" id="hidden_rfid">
					<td><input type="text" name="rfid_no" id="rfid_no" placeholder="Enter RFID No" autofocus required value="" oninput="check_same(this.value);" onchange="set_attendance(this.value);" autocomplete="off"></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td>
					<label>Employee Name </label>
					  <select name="" id="select_rfid_no" class="form-control select2" onchange="fill_detail(this.value);" style="width:100%;">
					  <option value="">Select Employee</option>
					        							<option value="123456">suresh soni[70]-[123456]-[07878963254]-[something]-[Teaching]</option>
														<option value="0012002881">rohan[71]-[0012002881]-[25625634]-[ajay]-[Teaching]</option>
														<option value="0013678307">DEMO[74]-[0013678307]-[9717386989]-[]-[Teaching]</option>
														<option value="0004261845">Sibdutta Negi[87]-[0004261845]-[9981229723]-[Lalit Mohan Negi]-[Teaching]</option>
														<option value="123456">AYUSH[95]-[123456]-[9406855366]-[GHANSHYAM RATHORE]-[Teaching]</option>
														<option value="0009249336">MR. SANTOSH KUMAR SAHU[101]-[0009249336]-[8718909760]-[TABAL SINGH ]-[Teaching]</option>
														<option value="1">MD JAHIR KHAN[143]-[1]-[+919086669999]-[MD jalaluddin khan]-[Teaching]</option>
														<option value="320401">praveen[147]-[320401]-[8120900282]-[ishwar lal]-[Non Teaching]</option>
														<option value="Dff">RAYEES[155]-[Dff]-[9906412069]-[Mani]-[Teaching]</option>
														<option value="147852369">Sunita Bai[278]-[147852369]-[9992288710]-[Manmohan Raj]-[Teaching]</option>
														<option value="23">nidhi[307]-[23]-[7656754345]-[krishna]-[Teaching]</option>
														<option value="8465847">shamli [317]-[8465847]-[6359874129]-[harichandra]-[Teaching]</option>
												  </select>
					</td>
					</tr>
                    <tr>
					<td>
					<div class="form-group">
					<label><input type="checkbox" name="myCheck" id="myCheck" onclick="myFunction();">&nbsp;&nbsp;&nbsp;Check For Present Employee Message</label>
				    <div class="form-group" id="text" style="display:none">
					
					  <input type="text" name="sms" placeholder="" id="contact"  class="form-control">
					  <input type="hidden" name="send_sms" placeholder="" id="send_sms"  class="form-control">
					 
					</div>
					</div>
					</td>
					</tr>
					</tbody>
				
                </table>
                </div>
	            
				<div class="col-md-8 box-body table-responsive" id="attendance_list">
                
                </div>
				
	      </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

</body>
</html>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>