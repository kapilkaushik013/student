 

<style>
.panel-default>.panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #e4e5e7;
  padding: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.panel-default>.panel-heading a {
  display: block;
  padding: 10px 15px;
}

.panel-default>.panel-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
  background-color: #eee;
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}
.panel-default>.panel-heading a:after{
font-size:12px;
margin-top:5px;
}
.panel-group .panel {
    margin-bottom: 0;
}
.panel-body{
padding-top:10px;
padding-bottom:10px;
padding-right:50px;
padding-left:50px;
}
.panel-group{
margin-bottom:10px;
}
.panel-default>.panel-heading+.panel-collapse>.panel-body{
font-weight:600;
}
#hover_hand:hover{
cursor: pointer; 
}
#default_dropdown li{
padding:10px;
border-bottom: 1px solid #b0da9f;
font-weight:bold;
}
#default_dropdown .active{
background:#3c8dbc;
color:#FFF;
}
#default_dropdown{
min-width:40px;
background:#dff0d8;
}
#clas_student span{
font-size:18px;
padding:0 20px;
}
#clas_student span:hover{
cursor: pointer;
}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
</head>

<script>
function graphic_detail(){
	var current_date=document.getElementById('attendance_date').value;
	$.ajax({
		type:"POST",
		url:access_link+"attendance/ajax_get_graphical_attendance.php?current_date="+current_date+"",
		cache:false,
		success:function(data)
		{
		$("#attendance_chart").html(data);
		}
	});
}

function another_chart(){
	var current_date=document.getElementById('attendance_date').value;
	$.ajax({
		type:"POST",
		url:access_link+"attendance/ajax_get_bar_chart_graphical_attendance.php?current_date="+current_date+"",
		cache:false,
		success:function(data)
		{
		$("#classwise_chart").html(data);
		}
	});
}

function strengths(){
	var current_date=document.getElementById('attendance_date').value;
	$.ajax({
		type:"POST",
		url:access_link+"attendance/ajax_get_classwise_strength.php?current_date="+current_date+"",
		cache:false,
		success:function(data)
		{
		    //alert(data);
		var total_student=0;
		var total_present=0;
		var total_absent=0;
		var total_leave=0;
		var not_mark=0;
		var res=data.split('|??|');
		var class_count=res.length;
		for(var i=1; i<class_count;i++){
		var res2=res[i].split('|?|');
		$('#strength_'+res2[0]).html('S : '+res2[1]+',');
		$('#present_'+res2[0]).html('P : '+res2[2]+',');
		$('#absent_'+res2[0]).html('A : '+res2[3]+',');
		$('#leave_'+res2[0]).html('L : '+res2[4]+',');
		$('#not_mark_'+res2[0]).html('N : '+res2[5]+',');
		total_student+=Number(res2[1]);
		total_present+=Number(res2[2]);
		total_absent+=Number(res2[3]);
		total_leave+=Number(res2[4]);
		not_mark+=Number(res2[5]);
		}
		$('#total_student').html(total_student);
		$('#total_present').html(total_present);
		$('#total_absent').html(total_absent);
		$('#total_leave').html(total_leave);
		$('#not_mark').html(not_mark);
		}
	});
}

setInterval(function(){
    graphic_detail()
	another_chart()
	strengths()
}, 60000);

function set_attendance(student_roll_no,att_id,attendance,student_rf_id_number){
var current_date=document.getElementById('attendance_date').value;

	$.ajax({
		type:"POST",
		url:access_link+"attendance/ajax_set_student_attendance.php?current_date="+current_date+"&student_roll_no="+student_roll_no+"&attendance="+attendance+"&student_rf_id_number="+student_rf_id_number+"",
		cache:false,
		success:function(data)
		{
		//alert(data);
		$('.'+student_roll_no).removeClass('active');
		$('#'+att_id+student_roll_no).addClass('active');
		}
	});
}

function for_date(value){
post_content('attendance/attendance_graphical_report','select_date='+value);
}

function mark_attendance(student_class,mark){
var current_date=document.getElementById('attendance_date').value;

	$.ajax({
		type:"POST",
		url:access_link+"attendance/ajax_set_student_attendance_markwise.php?current_date="+current_date+"&student_class="+student_class+"&mark="+mark+"",
		cache:false,
		success:function(data)
		{
		$('#mark_details').html(data);
		$('#my_model').click();
		}
	});

}

function validity_checked(student_roll_no,preword){
if($('#'+preword+student_roll_no).is(':checked')){
$('.'+student_roll_no).prop('checked',false);
$('#'+preword+student_roll_no).prop('checked',true);
}else{
$('.'+student_roll_no).prop('checked',false);
}
}


	  		    function form_submit(){
          
		    $.ajax({
           type: "POST",
            url: access_link+"attendance/attendance_graphical_report_api.php",
           data: $("#my_form").serialize(), 
           success: function(detail)
           { 
		    $("#modal_close").click();
           $("#myModal").close();
		   var res=detail.split("|?|");
			   if(res[1]=='success'){
				   post_content('attendance/attendance_graphical_report',res[2]);
            }
			}
         });
      }
</script>

    <section class="content-header">
      <h1>
        Student Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
		 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('attendance/attendance')"><i class="fa fa-child"></i> Attendance</a></li>
	  <li class="active">Graphical Representation</li>
      </ol>
    </section>
	
      <!-- Small boxes (Stat box) -->
	   <section class="content">
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            <div class="col-md-9"><h3 class="box-title">Attendance Graphical Report</h3></div>
			
			<div class="col-md-3">	
				<label>Date : </label>
				<input type="date" name="attendance_date" id="attendance_date" value="2022-12-03" oninput="for_date(this.value);strengths();graphic_detail();another_chart();" />
			</div>
            </div>
			
		
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="col-md-12">
			
			<div class="col-md-12" style="background-color:#dff0d8;">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-2">
			<label><h4>Total Student : <span id="total_student"></span></h4></label>
			</div>
			<div class="col-md-2">
			<label><h4>Total Present : <span id="total_present"></span></h4></label>
			</div>
			<div class="col-md-2">
			<label><h4>Total Absent : <span id="total_absent"></span></h4></label>
			</div>
			<div class="col-md-2">
			<label><h4>Total Leave : <span id="total_leave"></span></h4></label>
			</div>
			<div class="col-md-2">
			<label><h4>Not Mark : <span id="not_mark"></span></h4></label>
			</div>
			<div class="col-md-1">&nbsp;</div>
			</div>
			
			</div>
			<div class="col-md-12">&nbsp;</div>
			<div class="col-md-6">

			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class1" aria-expanded="false" aria-controls="collapseOne">
          1.&nbsp;&nbsp;&nbsp;NURSERY&nbsp;&nbsp;[A,B,C,D,E]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_NURSERY">S : ,</span>
		  <span onclick="mark_attendance('NURSERY','P');" style="color:rgb(16, 150, 24);" id="present_NURSERY">P : ,</span>
		  <span onclick="mark_attendance('NURSERY','A');" style="color:rgb(153, 0, 153);" id="absent_NURSERY">A : ,</span>
		  <span onclick="mark_attendance('NURSERY','L');" style="color:rgb(255, 153, 0);"id="leave_NURSERY">L : ,</span>
		  <span onclick="mark_attendance('NURSERY','');" style="color:rgb(220, 57, 18);" id="not_mark_NURSERY">N : </span>
		</div>
      </div>
      <div id="class1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Aashish [Ramesh][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200758" class=" 2200758" onclick="set_attendance('2200758','set_present_','P','');">P</li>
      <li id="set_present2_2200758" class=" 2200758" onclick="set_attendance('2200758','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200758" class=" 2200758" onclick="set_attendance('2200758','set_absent_','A','');">A</li>
      <li id="set_leave_2200758" class=" 2200758" onclick="set_attendance('2200758','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;raman [tapan][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200770" class=" 2200770" onclick="set_attendance('2200770','set_present_','P','');">P</li>
      <li id="set_present2_2200770" class=" 2200770" onclick="set_attendance('2200770','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200770" class=" 2200770" onclick="set_attendance('2200770','set_absent_','A','');">A</li>
      <li id="set_leave_2200770" class=" 2200770" onclick="set_attendance('2200770','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;yashi [pushpendra][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200782" class=" 2200782" onclick="set_attendance('2200782','set_present_','P','');">P</li>
      <li id="set_present2_2200782" class=" 2200782" onclick="set_attendance('2200782','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200782" class=" 2200782" onclick="set_attendance('2200782','set_absent_','A','');">A</li>
      <li id="set_leave_2200782" class=" 2200782" onclick="set_attendance('2200782','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;ABHIMANYU SHARMA [GOURAV SHARMA][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200785" class=" 2200785" onclick="set_attendance('2200785','set_present_','P','');">P</li>
      <li id="set_present2_2200785" class=" 2200785" onclick="set_attendance('2200785','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200785" class=" 2200785" onclick="set_attendance('2200785','set_absent_','A','');">A</li>
      <li id="set_leave_2200785" class=" 2200785" onclick="set_attendance('2200785','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;shree [samay singh ][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200790" class=" 2200790" onclick="set_attendance('2200790','set_present_','P','');">P</li>
      <li id="set_present2_2200790" class=" 2200790" onclick="set_attendance('2200790','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200790" class=" 2200790" onclick="set_attendance('2200790','set_absent_','A','');">A</li>
      <li id="set_leave_2200790" class=" 2200790" onclick="set_attendance('2200790','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;Ajay [Vijay][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200793" class=" 2200793" onclick="set_attendance('2200793','set_present_','P','');">P</li>
      <li id="set_present2_2200793" class=" 2200793" onclick="set_attendance('2200793','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200793" class=" 2200793" onclick="set_attendance('2200793','set_absent_','A','');">A</li>
      <li id="set_leave_2200793" class=" 2200793" onclick="set_attendance('2200793','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;Druwa Ganesh Chaudhari [Ganesh Chaudhari][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200795" class=" 2200795" onclick="set_attendance('2200795','set_present_','P','');">P</li>
      <li id="set_present2_2200795" class=" 2200795" onclick="set_attendance('2200795','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200795" class=" 2200795" onclick="set_attendance('2200795','set_absent_','A','');">A</li>
      <li id="set_leave_2200795" class=" 2200795" onclick="set_attendance('2200795','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;SHIVANSH RAWAT [AJAY][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200800" class=" 2200800" onclick="set_attendance('2200800','set_present_','P','');">P</li>
      <li id="set_present2_2200800" class=" 2200800" onclick="set_attendance('2200800','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200800" class=" 2200800" onclick="set_attendance('2200800','set_absent_','A','');">A</li>
      <li id="set_leave_2200800" class=" 2200800" onclick="set_attendance('2200800','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;Yash  [Soun][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200823" class=" 2200823" onclick="set_attendance('2200823','set_present_','P','');">P</li>
      <li id="set_present2_2200823" class=" 2200823" onclick="set_attendance('2200823','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200823" class=" 2200823" onclick="set_attendance('2200823','set_absent_','A','');">A</li>
      <li id="set_leave_2200823" class=" 2200823" onclick="set_attendance('2200823','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;पंकज कुमार [लालू राम][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200884" class=" 2200884" onclick="set_attendance('2200884','set_present_','P','');">P</li>
      <li id="set_present2_2200884" class=" 2200884" onclick="set_attendance('2200884','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200884" class=" 2200884" onclick="set_attendance('2200884','set_absent_','A','');">A</li>
      <li id="set_leave_2200884" class=" 2200884" onclick="set_attendance('2200884','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;Aamna Hussain [Syed Farhat Hussain][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201009" class=" 2201009" onclick="set_attendance('2201009','set_present_','P','');">P</li>
      <li id="set_present2_2201009" class=" 2201009" onclick="set_attendance('2201009','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201009" class=" 2201009" onclick="set_attendance('2201009','set_absent_','A','');">A</li>
      <li id="set_leave_2201009" class=" 2201009" onclick="set_attendance('2201009','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;Nitya Yadav [Mr. Mayank Yadav][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201035" class=" 2201035" onclick="set_attendance('2201035','set_present_','P','');">P</li>
      <li id="set_present2_2201035" class=" 2201035" onclick="set_attendance('2201035','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201035" class=" 2201035" onclick="set_attendance('2201035','set_absent_','A','');">A</li>
      <li id="set_leave_2201035" class=" 2201035" onclick="set_attendance('2201035','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;Shubh Kashyap [Mr. Anikesh Kumar][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201036" class=" 2201036" onclick="set_attendance('2201036','set_present_','P','');">P</li>
      <li id="set_present2_2201036" class=" 2201036" onclick="set_attendance('2201036','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201036" class=" 2201036" onclick="set_attendance('2201036','set_absent_','A','');">A</li>
      <li id="set_leave_2201036" class=" 2201036" onclick="set_attendance('2201036','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         14.&nbsp;&nbsp;&nbsp;Arohi Kushwaha [Mr. Shailendra Singh Kushwaha][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201037" class=" 2201037" onclick="set_attendance('2201037','set_present_','P','');">P</li>
      <li id="set_present2_2201037" class=" 2201037" onclick="set_attendance('2201037','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201037" class=" 2201037" onclick="set_attendance('2201037','set_absent_','A','');">A</li>
      <li id="set_leave_2201037" class=" 2201037" onclick="set_attendance('2201037','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         15.&nbsp;&nbsp;&nbsp;Anikesh [Mr. Amit Kumar][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201038" class=" 2201038" onclick="set_attendance('2201038','set_present_','P','');">P</li>
      <li id="set_present2_2201038" class=" 2201038" onclick="set_attendance('2201038','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201038" class=" 2201038" onclick="set_attendance('2201038','set_absent_','A','');">A</li>
      <li id="set_leave_2201038" class=" 2201038" onclick="set_attendance('2201038','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         16.&nbsp;&nbsp;&nbsp;Prithviraj [Dr. Pramod Kumar][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201039" class=" 2201039" onclick="set_attendance('2201039','set_present_','P','');">P</li>
      <li id="set_present2_2201039" class=" 2201039" onclick="set_attendance('2201039','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201039" class=" 2201039" onclick="set_attendance('2201039','set_absent_','A','');">A</li>
      <li id="set_leave_2201039" class=" 2201039" onclick="set_attendance('2201039','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         17.&nbsp;&nbsp;&nbsp;Arushi Diwakar [Mr. Virendra Kumar][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201040" class=" 2201040" onclick="set_attendance('2201040','set_present_','P','');">P</li>
      <li id="set_present2_2201040" class=" 2201040" onclick="set_attendance('2201040','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201040" class=" 2201040" onclick="set_attendance('2201040','set_absent_','A','');">A</li>
      <li id="set_leave_2201040" class=" 2201040" onclick="set_attendance('2201040','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         18.&nbsp;&nbsp;&nbsp;Kartik Nishad [Kartik Nishad][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201041" class=" 2201041" onclick="set_attendance('2201041','set_present_','P','');">P</li>
      <li id="set_present2_2201041" class=" 2201041" onclick="set_attendance('2201041','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201041" class=" 2201041" onclick="set_attendance('2201041','set_absent_','A','');">A</li>
      <li id="set_leave_2201041" class=" 2201041" onclick="set_attendance('2201041','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         19.&nbsp;&nbsp;&nbsp;Rahul Kumar [Lalbabu Ray][NURSERY (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201086" class=" 2201086" onclick="set_attendance('2201086','set_present_','P','');">P</li>
      <li id="set_present2_2201086" class=" 2201086" onclick="set_attendance('2201086','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201086" class=" 2201086" onclick="set_attendance('2201086','set_absent_','A','');">A</li>
      <li id="set_leave_2201086" class=" 2201086" onclick="set_attendance('2201086','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class2" aria-expanded="false" aria-controls="collapseOne">
          2.&nbsp;&nbsp;&nbsp;LKG&nbsp;&nbsp;[A,B]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_LKG">S : ,</span>
		  <span onclick="mark_attendance('LKG','P');" style="color:rgb(16, 150, 24);" id="present_LKG">P : ,</span>
		  <span onclick="mark_attendance('LKG','A');" style="color:rgb(153, 0, 153);" id="absent_LKG">A : ,</span>
		  <span onclick="mark_attendance('LKG','L');" style="color:rgb(255, 153, 0);"id="leave_LKG">L : ,</span>
		  <span onclick="mark_attendance('LKG','');" style="color:rgb(220, 57, 18);" id="not_mark_LKG">N : </span>
		</div>
      </div>
      <div id="class2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;balveer singh [sukhvinder singh][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200614" class=" 2200614" onclick="set_attendance('2200614','set_present_','P','0014944965');">P</li>
      <li id="set_present2_2200614" class=" 2200614" onclick="set_attendance('2200614','set_present2_','P/2','0014944965');">P/2</li>
      <li id="set_absent_2200614" class=" 2200614" onclick="set_attendance('2200614','set_absent_','A','0014944965');">A</li>
      <li id="set_leave_2200614" class=" 2200614" onclick="set_attendance('2200614','set_leave_','L','0014944965');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;mahira khan [irfan khan][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200615" class=" 2200615" onclick="set_attendance('2200615','set_present_','P','');">P</li>
      <li id="set_present2_2200615" class=" 2200615" onclick="set_attendance('2200615','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200615" class=" 2200615" onclick="set_attendance('2200615','set_absent_','A','');">A</li>
      <li id="set_leave_2200615" class=" 2200615" onclick="set_attendance('2200615','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;sanny [soham][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200618" class=" 2200618" onclick="set_attendance('2200618','set_present_','P','');">P</li>
      <li id="set_present2_2200618" class=" 2200618" onclick="set_attendance('2200618','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200618" class=" 2200618" onclick="set_attendance('2200618','set_absent_','A','');">A</li>
      <li id="set_leave_2200618" class=" 2200618" onclick="set_attendance('2200618','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;kirti panday [sumit panday][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200626" class=" 2200626" onclick="set_attendance('2200626','set_present_','P','');">P</li>
      <li id="set_present2_2200626" class=" 2200626" onclick="set_attendance('2200626','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200626" class=" 2200626" onclick="set_attendance('2200626','set_absent_','A','');">A</li>
      <li id="set_leave_2200626" class=" 2200626" onclick="set_attendance('2200626','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;lali [][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200627" class=" 2200627" onclick="set_attendance('2200627','set_present_','P','');">P</li>
      <li id="set_present2_2200627" class=" 2200627" onclick="set_attendance('2200627','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200627" class=" 2200627" onclick="set_attendance('2200627','set_absent_','A','');">A</li>
      <li id="set_leave_2200627" class=" 2200627" onclick="set_attendance('2200627','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;xghkjh [Anil][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200720" class=" 2200720" onclick="set_attendance('2200720','set_present_','P','');">P</li>
      <li id="set_present2_2200720" class=" 2200720" onclick="set_attendance('2200720','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200720" class=" 2200720" onclick="set_attendance('2200720','set_absent_','A','');">A</li>
      <li id="set_leave_2200720" class=" 2200720" onclick="set_attendance('2200720','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;sanam karn [bijay karn][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200730" class=" 2200730" onclick="set_attendance('2200730','set_present_','P','');">P</li>
      <li id="set_present2_2200730" class=" 2200730" onclick="set_attendance('2200730','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200730" class=" 2200730" onclick="set_attendance('2200730','set_absent_','A','');">A</li>
      <li id="set_leave_2200730" class=" 2200730" onclick="set_attendance('2200730','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;Akshay Karande [NILESH PATIDAR][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200733" class=" 2200733" onclick="set_attendance('2200733','set_present_','P','');">P</li>
      <li id="set_present2_2200733" class=" 2200733" onclick="set_attendance('2200733','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200733" class=" 2200733" onclick="set_attendance('2200733','set_absent_','A','');">A</li>
      <li id="set_leave_2200733" class=" 2200733" onclick="set_attendance('2200733','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;mayank [demo][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200738" class=" 2200738" onclick="set_attendance('2200738','set_present_','P','');">P</li>
      <li id="set_present2_2200738" class=" 2200738" onclick="set_attendance('2200738','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200738" class=" 2200738" onclick="set_attendance('2200738','set_absent_','A','');">A</li>
      <li id="set_leave_2200738" class=" 2200738" onclick="set_attendance('2200738','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;Vaishnavi Thakur [Mr. Amrendra Pratap Singh ][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200747" class=" 2200747" onclick="set_attendance('2200747','set_present_','P','');">P</li>
      <li id="set_present2_2200747" class=" 2200747" onclick="set_attendance('2200747','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200747" class=" 2200747" onclick="set_attendance('2200747','set_absent_','A','');">A</li>
      <li id="set_leave_2200747" class=" 2200747" onclick="set_attendance('2200747','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;Urvi sen [Prabhash sen][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200752" class=" 2200752" onclick="set_attendance('2200752','set_present_','P','');">P</li>
      <li id="set_present2_2200752" class=" 2200752" onclick="set_attendance('2200752','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200752" class=" 2200752" onclick="set_attendance('2200752','set_absent_','A','');">A</li>
      <li id="set_leave_2200752" class=" 2200752" onclick="set_attendance('2200752','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;INAMUR RAHMAN [ATIKUR RAHMAN][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200759" class=" 2200759" onclick="set_attendance('2200759','set_present_','P','');">P</li>
      <li id="set_present2_2200759" class=" 2200759" onclick="set_attendance('2200759','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200759" class=" 2200759" onclick="set_attendance('2200759','set_absent_','A','');">A</li>
      <li id="set_leave_2200759" class=" 2200759" onclick="set_attendance('2200759','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;rakesh [][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200761" class=" 2200761" onclick="set_attendance('2200761','set_present_','P','');">P</li>
      <li id="set_present2_2200761" class=" 2200761" onclick="set_attendance('2200761','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200761" class=" 2200761" onclick="set_attendance('2200761','set_absent_','A','');">A</li>
      <li id="set_leave_2200761" class=" 2200761" onclick="set_attendance('2200761','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         14.&nbsp;&nbsp;&nbsp;SANDEEP [PRATHAM SINGH][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200948" class=" 2200948" onclick="set_attendance('2200948','set_present_','P','');">P</li>
      <li id="set_present2_2200948" class=" 2200948" onclick="set_attendance('2200948','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200948" class=" 2200948" onclick="set_attendance('2200948','set_absent_','A','');">A</li>
      <li id="set_leave_2200948" class=" 2200948" onclick="set_attendance('2200948','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         15.&nbsp;&nbsp;&nbsp;rakesh [shaelendra][LKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200953" class=" 2200953" onclick="set_attendance('2200953','set_present_','P','');">P</li>
      <li id="set_present2_2200953" class=" 2200953" onclick="set_attendance('2200953','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200953" class=" 2200953" onclick="set_attendance('2200953','set_absent_','A','');">A</li>
      <li id="set_leave_2200953" class=" 2200953" onclick="set_attendance('2200953','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class3" aria-expanded="false" aria-controls="collapseOne">
          3.&nbsp;&nbsp;&nbsp;UKG&nbsp;&nbsp;[A,B,C]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_UKG">S : ,</span>
		  <span onclick="mark_attendance('UKG','P');" style="color:rgb(16, 150, 24);" id="present_UKG">P : ,</span>
		  <span onclick="mark_attendance('UKG','A');" style="color:rgb(153, 0, 153);" id="absent_UKG">A : ,</span>
		  <span onclick="mark_attendance('UKG','L');" style="color:rgb(255, 153, 0);"id="leave_UKG">L : ,</span>
		  <span onclick="mark_attendance('UKG','');" style="color:rgb(220, 57, 18);" id="not_mark_UKG">N : </span>
		</div>
      </div>
      <div id="class3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Sangita [Ramji][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100430" class=" 2100430" onclick="set_attendance('2100430','set_present_','P','');">P</li>
      <li id="set_present2_2100430" class=" 2100430" onclick="set_attendance('2100430','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100430" class=" 2100430" onclick="set_attendance('2100430','set_absent_','A','');">A</li>
      <li id="set_leave_2100430" class=" 2100430" onclick="set_attendance('2100430','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;umesh  dhakad [mr  ramgopal dhakad][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100450" class=" 2100450" onclick="set_attendance('2100450','set_present_','P','');">P</li>
      <li id="set_present2_2100450" class=" 2100450" onclick="set_attendance('2100450','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100450" class=" 2100450" onclick="set_attendance('2100450','set_absent_','A','');">A</li>
      <li id="set_leave_2100450" class=" 2100450" onclick="set_attendance('2100450','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Humaira [Palash][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100451" class=" 2100451" onclick="set_attendance('2100451','set_present_','P','01');">P</li>
      <li id="set_present2_2100451" class=" 2100451" onclick="set_attendance('2100451','set_present2_','P/2','01');">P/2</li>
      <li id="set_absent_2100451" class=" 2100451" onclick="set_attendance('2100451','set_absent_','A','01');">A</li>
      <li id="set_leave_2100451" class=" 2100451" onclick="set_attendance('2100451','set_leave_','L','01');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;ayush koli [prabhu dayal][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100458" class=" 2100458" onclick="set_attendance('2100458','set_present_','P','');">P</li>
      <li id="set_present2_2100458" class=" 2100458" onclick="set_attendance('2100458','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100458" class=" 2100458" onclick="set_attendance('2100458','set_absent_','A','');">A</li>
      <li id="set_leave_2100458" class=" 2100458" onclick="set_attendance('2100458','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;umesh  [abhishek][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100553" class=" 2100553" onclick="set_attendance('2100553','set_present_','P','0014944965');">P</li>
      <li id="set_present2_2100553" class=" 2100553" onclick="set_attendance('2100553','set_present2_','P/2','0014944965');">P/2</li>
      <li id="set_absent_2100553" class=" 2100553" onclick="set_attendance('2100553','set_absent_','A','0014944965');">A</li>
      <li id="set_leave_2100553" class=" 2100553" onclick="set_attendance('2100553','set_leave_','L','0014944965');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;Anshu [Vijay][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100571" class=" 2100571" onclick="set_attendance('2100571','set_present_','P','0011996285');">P</li>
      <li id="set_present2_2100571" class=" 2100571" onclick="set_attendance('2100571','set_present2_','P/2','0011996285');">P/2</li>
      <li id="set_absent_2100571" class=" 2100571" onclick="set_attendance('2100571','set_absent_','A','0011996285');">A</li>
      <li id="set_leave_2100571" class=" 2100571" onclick="set_attendance('2100571','set_leave_','L','0011996285');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp; BABALI SAHU [SHAIKH][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100575" class=" 2100575" onclick="set_attendance('2100575','set_present_','P','0010290419');">P</li>
      <li id="set_present2_2100575" class=" 2100575" onclick="set_attendance('2100575','set_present2_','P/2','0010290419');">P/2</li>
      <li id="set_absent_2100575" class=" 2100575" onclick="set_attendance('2100575','set_absent_','A','0010290419');">A</li>
      <li id="set_leave_2100575" class=" 2100575" onclick="set_attendance('2100575','set_leave_','L','0010290419');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;Nidhi Mishra [Nidhi Mishra][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100601" class=" 2100601" onclick="set_attendance('2100601','set_present_','P','');">P</li>
      <li id="set_present2_2100601" class=" 2100601" onclick="set_attendance('2100601','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100601" class=" 2100601" onclick="set_attendance('2100601','set_absent_','A','');">A</li>
      <li id="set_leave_2100601" class=" 2100601" onclick="set_attendance('2100601','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;sushant singh [nilkamal singh ][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200628" class=" 2200628" onclick="set_attendance('2200628','set_present_','P','');">P</li>
      <li id="set_present2_2200628" class=" 2200628" onclick="set_attendance('2200628','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200628" class=" 2200628" onclick="set_attendance('2200628','set_absent_','A','');">A</li>
      <li id="set_leave_2200628" class=" 2200628" onclick="set_attendance('2200628','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;SK Thakur [Aasss][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200644" class=" 2200644" onclick="set_attendance('2200644','set_present_','P','');">P</li>
      <li id="set_present2_2200644" class=" 2200644" onclick="set_attendance('2200644','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200644" class=" 2200644" onclick="set_attendance('2200644','set_absent_','A','');">A</li>
      <li id="set_leave_2200644" class=" 2200644" onclick="set_attendance('2200644','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;Jay Sharma [Harsh Sharma][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200646" class=" 2200646" onclick="set_attendance('2200646','set_present_','P','');">P</li>
      <li id="set_present2_2200646" class=" 2200646" onclick="set_attendance('2200646','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200646" class=" 2200646" onclick="set_attendance('2200646','set_absent_','A','');">A</li>
      <li id="set_leave_2200646" class=" 2200646" onclick="set_attendance('2200646','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;Sikdar [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200647" class=" 2200647" onclick="set_attendance('2200647','set_present_','P','');">P</li>
      <li id="set_present2_2200647" class=" 2200647" onclick="set_attendance('2200647','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200647" class=" 2200647" onclick="set_attendance('2200647','set_absent_','A','');">A</li>
      <li id="set_leave_2200647" class=" 2200647" onclick="set_attendance('2200647','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;Bijoy [ajoy][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200648" class=" 2200648" onclick="set_attendance('2200648','set_present_','P','');">P</li>
      <li id="set_present2_2200648" class=" 2200648" onclick="set_attendance('2200648','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200648" class=" 2200648" onclick="set_attendance('2200648','set_absent_','A','');">A</li>
      <li id="set_leave_2200648" class=" 2200648" onclick="set_attendance('2200648','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         14.&nbsp;&nbsp;&nbsp;RIYA DAS [RATAN DAS][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200651" class=" 2200651" onclick="set_attendance('2200651','set_present_','P','');">P</li>
      <li id="set_present2_2200651" class=" 2200651" onclick="set_attendance('2200651','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200651" class=" 2200651" onclick="set_attendance('2200651','set_absent_','A','');">A</li>
      <li id="set_leave_2200651" class=" 2200651" onclick="set_attendance('2200651','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         15.&nbsp;&nbsp;&nbsp;SUMIT KUMAR [Anil kumar ][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200652" class=" 2200652" onclick="set_attendance('2200652','set_present_','P','');">P</li>
      <li id="set_present2_2200652" class=" 2200652" onclick="set_attendance('2200652','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200652" class=" 2200652" onclick="set_attendance('2200652','set_absent_','A','');">A</li>
      <li id="set_leave_2200652" class=" 2200652" onclick="set_attendance('2200652','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         16.&nbsp;&nbsp;&nbsp;Somya [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200653" class=" 2200653" onclick="set_attendance('2200653','set_present_','P','');">P</li>
      <li id="set_present2_2200653" class=" 2200653" onclick="set_attendance('2200653','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200653" class=" 2200653" onclick="set_attendance('2200653','set_absent_','A','');">A</li>
      <li id="set_leave_2200653" class=" 2200653" onclick="set_attendance('2200653','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         17.&nbsp;&nbsp;&nbsp;Radha Kumari [Ram Kumar][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200656" class=" 2200656" onclick="set_attendance('2200656','set_present_','P','');">P</li>
      <li id="set_present2_2200656" class=" 2200656" onclick="set_attendance('2200656','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200656" class=" 2200656" onclick="set_attendance('2200656','set_absent_','A','');">A</li>
      <li id="set_leave_2200656" class=" 2200656" onclick="set_attendance('2200656','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         18.&nbsp;&nbsp;&nbsp;ARPAN NANDEWAR [RAM NANDEWAR][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200657" class=" 2200657" onclick="set_attendance('2200657','set_present_','P','');">P</li>
      <li id="set_present2_2200657" class=" 2200657" onclick="set_attendance('2200657','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200657" class=" 2200657" onclick="set_attendance('2200657','set_absent_','A','');">A</li>
      <li id="set_leave_2200657" class=" 2200657" onclick="set_attendance('2200657','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         19.&nbsp;&nbsp;&nbsp;Bhavesh Arvind Padvi [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200666" class=" 2200666" onclick="set_attendance('2200666','set_present_','P','');">P</li>
      <li id="set_present2_2200666" class=" 2200666" onclick="set_attendance('2200666','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200666" class=" 2200666" onclick="set_attendance('2200666','set_absent_','A','');">A</li>
      <li id="set_leave_2200666" class=" 2200666" onclick="set_attendance('2200666','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         20.&nbsp;&nbsp;&nbsp;himanshi [babl][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200678" class=" 2200678" onclick="set_attendance('2200678','set_present_','P','');">P</li>
      <li id="set_present2_2200678" class=" 2200678" onclick="set_attendance('2200678','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200678" class=" 2200678" onclick="set_attendance('2200678','set_absent_','A','');">A</li>
      <li id="set_leave_2200678" class=" 2200678" onclick="set_attendance('2200678','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         21.&nbsp;&nbsp;&nbsp;GGDFGFDGFDG [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200681" class=" 2200681" onclick="set_attendance('2200681','set_present_','P','');">P</li>
      <li id="set_present2_2200681" class=" 2200681" onclick="set_attendance('2200681','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200681" class=" 2200681" onclick="set_attendance('2200681','set_absent_','A','');">A</li>
      <li id="set_leave_2200681" class=" 2200681" onclick="set_attendance('2200681','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         22.&nbsp;&nbsp;&nbsp;ABHISHEK  [B L YADAV][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200684" class=" 2200684" onclick="set_attendance('2200684','set_present_','P','');">P</li>
      <li id="set_present2_2200684" class=" 2200684" onclick="set_attendance('2200684','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200684" class=" 2200684" onclick="set_attendance('2200684','set_absent_','A','');">A</li>
      <li id="set_leave_2200684" class=" 2200684" onclick="set_attendance('2200684','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         23.&nbsp;&nbsp;&nbsp; Kanika [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200689" class=" 2200689" onclick="set_attendance('2200689','set_present_','P','');">P</li>
      <li id="set_present2_2200689" class=" 2200689" onclick="set_attendance('2200689','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200689" class=" 2200689" onclick="set_attendance('2200689','set_absent_','A','');">A</li>
      <li id="set_leave_2200689" class=" 2200689" onclick="set_attendance('2200689','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         24.&nbsp;&nbsp;&nbsp;Ravi [xyz][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200691" class=" 2200691" onclick="set_attendance('2200691','set_present_','P','');">P</li>
      <li id="set_present2_2200691" class=" 2200691" onclick="set_attendance('2200691','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200691" class=" 2200691" onclick="set_attendance('2200691','set_absent_','A','');">A</li>
      <li id="set_leave_2200691" class=" 2200691" onclick="set_attendance('2200691','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         25.&nbsp;&nbsp;&nbsp;RAHUL [XYC][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200693" class=" 2200693" onclick="set_attendance('2200693','set_present_','P','');">P</li>
      <li id="set_present2_2200693" class=" 2200693" onclick="set_attendance('2200693','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200693" class=" 2200693" onclick="set_attendance('2200693','set_absent_','A','');">A</li>
      <li id="set_leave_2200693" class=" 2200693" onclick="set_attendance('2200693','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         26.&nbsp;&nbsp;&nbsp;kunal jha [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200707" class=" 2200707" onclick="set_attendance('2200707','set_present_','P','');">P</li>
      <li id="set_present2_2200707" class=" 2200707" onclick="set_attendance('2200707','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200707" class=" 2200707" onclick="set_attendance('2200707','set_absent_','A','');">A</li>
      <li id="set_leave_2200707" class=" 2200707" onclick="set_attendance('2200707','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         27.&nbsp;&nbsp;&nbsp;fgdfg [dfgdf][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200708" class=" 2200708" onclick="set_attendance('2200708','set_present_','P','');">P</li>
      <li id="set_present2_2200708" class=" 2200708" onclick="set_attendance('2200708','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200708" class=" 2200708" onclick="set_attendance('2200708','set_absent_','A','');">A</li>
      <li id="set_leave_2200708" class=" 2200708" onclick="set_attendance('2200708','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         28.&nbsp;&nbsp;&nbsp;vishal jha [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200710" class=" 2200710" onclick="set_attendance('2200710','set_present_','P','');">P</li>
      <li id="set_present2_2200710" class=" 2200710" onclick="set_attendance('2200710','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200710" class=" 2200710" onclick="set_attendance('2200710','set_absent_','A','');">A</li>
      <li id="set_leave_2200710" class=" 2200710" onclick="set_attendance('2200710','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         29.&nbsp;&nbsp;&nbsp;vishal jha [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200714" class=" 2200714" onclick="set_attendance('2200714','set_present_','P','');">P</li>
      <li id="set_present2_2200714" class=" 2200714" onclick="set_attendance('2200714','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200714" class=" 2200714" onclick="set_attendance('2200714','set_absent_','A','');">A</li>
      <li id="set_leave_2200714" class=" 2200714" onclick="set_attendance('2200714','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         30.&nbsp;&nbsp;&nbsp;muskan ray [roshan ray][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200717" class=" 2200717" onclick="set_attendance('2200717','set_present_','P','');">P</li>
      <li id="set_present2_2200717" class=" 2200717" onclick="set_attendance('2200717','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200717" class=" 2200717" onclick="set_attendance('2200717','set_absent_','A','');">A</li>
      <li id="set_leave_2200717" class=" 2200717" onclick="set_attendance('2200717','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         31.&nbsp;&nbsp;&nbsp;SANJAY KUMAR [manoj pandey][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200724" class=" 2200724" onclick="set_attendance('2200724','set_present_','P','');">P</li>
      <li id="set_present2_2200724" class=" 2200724" onclick="set_attendance('2200724','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200724" class=" 2200724" onclick="set_attendance('2200724','set_absent_','A','');">A</li>
      <li id="set_leave_2200724" class=" 2200724" onclick="set_attendance('2200724','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         32.&nbsp;&nbsp;&nbsp;sushant karn [bijay karn][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200729" class=" 2200729" onclick="set_attendance('2200729','set_present_','P','');">P</li>
      <li id="set_present2_2200729" class=" 2200729" onclick="set_attendance('2200729','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200729" class=" 2200729" onclick="set_attendance('2200729','set_absent_','A','');">A</li>
      <li id="set_leave_2200729" class=" 2200729" onclick="set_attendance('2200729','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         33.&nbsp;&nbsp;&nbsp;Abhay [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200741" class=" 2200741" onclick="set_attendance('2200741','set_present_','P','');">P</li>
      <li id="set_present2_2200741" class=" 2200741" onclick="set_attendance('2200741','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200741" class=" 2200741" onclick="set_attendance('2200741','set_absent_','A','');">A</li>
      <li id="set_leave_2200741" class=" 2200741" onclick="set_attendance('2200741','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         34.&nbsp;&nbsp;&nbsp;Nikhil [jonh][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200780" class=" 2200780" onclick="set_attendance('2200780','set_present_','P','');">P</li>
      <li id="set_present2_2200780" class=" 2200780" onclick="set_attendance('2200780','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200780" class=" 2200780" onclick="set_attendance('2200780','set_absent_','A','');">A</li>
      <li id="set_leave_2200780" class=" 2200780" onclick="set_attendance('2200780','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         35.&nbsp;&nbsp;&nbsp;Md alam ali  [Ali alam][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200797" class=" 2200797" onclick="set_attendance('2200797','set_present_','P','');">P</li>
      <li id="set_present2_2200797" class=" 2200797" onclick="set_attendance('2200797','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200797" class=" 2200797" onclick="set_attendance('2200797','set_absent_','A','');">A</li>
      <li id="set_leave_2200797" class=" 2200797" onclick="set_attendance('2200797','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         36.&nbsp;&nbsp;&nbsp;mahi [ram singh ][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200806" class=" 2200806" onclick="set_attendance('2200806','set_present_','P','');">P</li>
      <li id="set_present2_2200806" class=" 2200806" onclick="set_attendance('2200806','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200806" class=" 2200806" onclick="set_attendance('2200806','set_absent_','A','');">A</li>
      <li id="set_leave_2200806" class=" 2200806" onclick="set_attendance('2200806','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         37.&nbsp;&nbsp;&nbsp;neha parihar  [himanshu parihar ][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200901" class=" 2200901" onclick="set_attendance('2200901','set_present_','P','');">P</li>
      <li id="set_present2_2200901" class=" 2200901" onclick="set_attendance('2200901','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200901" class=" 2200901" onclick="set_attendance('2200901','set_absent_','A','');">A</li>
      <li id="set_leave_2200901" class=" 2200901" onclick="set_attendance('2200901','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         38.&nbsp;&nbsp;&nbsp;mansha [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200918" class=" 2200918" onclick="set_attendance('2200918','set_present_','P','');">P</li>
      <li id="set_present2_2200918" class=" 2200918" onclick="set_attendance('2200918','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200918" class=" 2200918" onclick="set_attendance('2200918','set_absent_','A','');">A</li>
      <li id="set_leave_2200918" class=" 2200918" onclick="set_attendance('2200918','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         39.&nbsp;&nbsp;&nbsp;Ariz [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200933" class=" 2200933" onclick="set_attendance('2200933','set_present_','P','');">P</li>
      <li id="set_present2_2200933" class=" 2200933" onclick="set_attendance('2200933','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200933" class=" 2200933" onclick="set_attendance('2200933','set_absent_','A','');">A</li>
      <li id="set_leave_2200933" class=" 2200933" onclick="set_attendance('2200933','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         40.&nbsp;&nbsp;&nbsp;Ariz [][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200934" class=" 2200934" onclick="set_attendance('2200934','set_present_','P','0002847890');">P</li>
      <li id="set_present2_2200934" class=" 2200934" onclick="set_attendance('2200934','set_present2_','P/2','0002847890');">P/2</li>
      <li id="set_absent_2200934" class=" 2200934" onclick="set_attendance('2200934','set_absent_','A','0002847890');">A</li>
      <li id="set_leave_2200934" class=" 2200934" onclick="set_attendance('2200934','set_leave_','L','0002847890');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         41.&nbsp;&nbsp;&nbsp;Md. Mokarram alam  [Md. Siddique alam ][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200943" class=" 2200943" onclick="set_attendance('2200943','set_present_','P','');">P</li>
      <li id="set_present2_2200943" class=" 2200943" onclick="set_attendance('2200943','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200943" class=" 2200943" onclick="set_attendance('2200943','set_absent_','A','');">A</li>
      <li id="set_leave_2200943" class=" 2200943" onclick="set_attendance('2200943','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         42.&nbsp;&nbsp;&nbsp;Aarunya Raj Sinha [tret][UKG (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200977" class=" 2200977" onclick="set_attendance('2200977','set_present_','P','0007113750');">P</li>
      <li id="set_present2_2200977" class=" 2200977" onclick="set_attendance('2200977','set_present2_','P/2','0007113750');">P/2</li>
      <li id="set_absent_2200977" class=" 2200977" onclick="set_attendance('2200977','set_absent_','A','0007113750');">A</li>
      <li id="set_leave_2200977" class=" 2200977" onclick="set_attendance('2200977','set_leave_','L','0007113750');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class4" aria-expanded="false" aria-controls="collapseOne">
          4.&nbsp;&nbsp;&nbsp;1ST&nbsp;&nbsp;[A,B]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_1ST">S : ,</span>
		  <span onclick="mark_attendance('1ST','P');" style="color:rgb(16, 150, 24);" id="present_1ST">P : ,</span>
		  <span onclick="mark_attendance('1ST','A');" style="color:rgb(153, 0, 153);" id="absent_1ST">A : ,</span>
		  <span onclick="mark_attendance('1ST','L');" style="color:rgb(255, 153, 0);"id="leave_1ST">L : ,</span>
		  <span onclick="mark_attendance('1ST','');" style="color:rgb(220, 57, 18);" id="not_mark_1ST">N : </span>
		</div>
      </div>
      <div id="class4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Jidan uddin [riyaz uddin][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100544" class=" 2100544" onclick="set_attendance('2100544','set_present_','P','');">P</li>
      <li id="set_present2_2100544" class=" 2100544" onclick="set_attendance('2100544','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100544" class=" 2100544" onclick="set_attendance('2100544','set_absent_','A','');">A</li>
      <li id="set_leave_2100544" class=" 2100544" onclick="set_attendance('2100544','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;praveen kumar [][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200695" class=" 2200695" onclick="set_attendance('2200695','set_present_','P','');">P</li>
      <li id="set_present2_2200695" class=" 2200695" onclick="set_attendance('2200695','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200695" class=" 2200695" onclick="set_attendance('2200695','set_absent_','A','');">A</li>
      <li id="set_leave_2200695" class=" 2200695" onclick="set_attendance('2200695','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Prashant kumar [babl][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200715" class=" 2200715" onclick="set_attendance('2200715','set_present_','P','');">P</li>
      <li id="set_present2_2200715" class=" 2200715" onclick="set_attendance('2200715','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200715" class=" 2200715" onclick="set_attendance('2200715','set_absent_','A','');">A</li>
      <li id="set_leave_2200715" class=" 2200715" onclick="set_attendance('2200715','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;abhisek [][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200743" class=" 2200743" onclick="set_attendance('2200743','set_present_','P','');">P</li>
      <li id="set_present2_2200743" class=" 2200743" onclick="set_attendance('2200743','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200743" class=" 2200743" onclick="set_attendance('2200743','set_absent_','A','');">A</li>
      <li id="set_leave_2200743" class=" 2200743" onclick="set_attendance('2200743','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;shreyansh [Neeraj kumar][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200791" class=" 2200791" onclick="set_attendance('2200791','set_present_','P','272');">P</li>
      <li id="set_present2_2200791" class=" 2200791" onclick="set_attendance('2200791','set_present2_','P/2','272');">P/2</li>
      <li id="set_absent_2200791" class=" 2200791" onclick="set_attendance('2200791','set_absent_','A','272');">A</li>
      <li id="set_leave_2200791" class=" 2200791" onclick="set_attendance('2200791','set_leave_','L','272');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;shahnawaz [][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200810" class=" 2200810" onclick="set_attendance('2200810','set_present_','P','');">P</li>
      <li id="set_present2_2200810" class=" 2200810" onclick="set_attendance('2200810','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200810" class=" 2200810" onclick="set_attendance('2200810','set_absent_','A','');">A</li>
      <li id="set_leave_2200810" class=" 2200810" onclick="set_attendance('2200810','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;yasin [][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200811" class=" 2200811" onclick="set_attendance('2200811','set_present_','P','');">P</li>
      <li id="set_present2_2200811" class=" 2200811" onclick="set_attendance('2200811','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200811" class=" 2200811" onclick="set_attendance('2200811','set_absent_','A','');">A</li>
      <li id="set_leave_2200811" class=" 2200811" onclick="set_attendance('2200811','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;sultana [][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200812" class=" 2200812" onclick="set_attendance('2200812','set_present_','P','');">P</li>
      <li id="set_present2_2200812" class=" 2200812" onclick="set_attendance('2200812','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200812" class=" 2200812" onclick="set_attendance('2200812','set_absent_','A','');">A</li>
      <li id="set_leave_2200812" class=" 2200812" onclick="set_attendance('2200812','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;vicky uikey [jitendrasingh uikey][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200841" class=" 2200841" onclick="set_attendance('2200841','set_present_','P','');">P</li>
      <li id="set_present2_2200841" class=" 2200841" onclick="set_attendance('2200841','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200841" class=" 2200841" onclick="set_attendance('2200841','set_absent_','A','');">A</li>
      <li id="set_leave_2200841" class=" 2200841" onclick="set_attendance('2200841','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;Chirag jatav [MR.Arjun jatav][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200937" class=" 2200937" onclick="set_attendance('2200937','set_present_','P','');">P</li>
      <li id="set_present2_2200937" class=" 2200937" onclick="set_attendance('2200937','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200937" class=" 2200937" onclick="set_attendance('2200937','set_absent_','A','');">A</li>
      <li id="set_leave_2200937" class=" 2200937" onclick="set_attendance('2200937','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;Sujata Agrawal [Sushil Agrawal][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201076" class=" 2201076" onclick="set_attendance('2201076','set_present_','P','');">P</li>
      <li id="set_present2_2201076" class=" 2201076" onclick="set_attendance('2201076','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201076" class=" 2201076" onclick="set_attendance('2201076','set_absent_','A','');">A</li>
      <li id="set_leave_2201076" class=" 2201076" onclick="set_attendance('2201076','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;Danica Mariam Jacob [J P Jacob][1ST (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201085" class=" 2201085" onclick="set_attendance('2201085','set_present_','P','');">P</li>
      <li id="set_present2_2201085" class=" 2201085" onclick="set_attendance('2201085','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201085" class=" 2201085" onclick="set_attendance('2201085','set_absent_','A','');">A</li>
      <li id="set_leave_2201085" class=" 2201085" onclick="set_attendance('2201085','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class5" aria-expanded="false" aria-controls="collapseOne">
          5.&nbsp;&nbsp;&nbsp;2ND&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_2ND">S : ,</span>
		  <span onclick="mark_attendance('2ND','P');" style="color:rgb(16, 150, 24);" id="present_2ND">P : ,</span>
		  <span onclick="mark_attendance('2ND','A');" style="color:rgb(153, 0, 153);" id="absent_2ND">A : ,</span>
		  <span onclick="mark_attendance('2ND','L');" style="color:rgb(255, 153, 0);"id="leave_2ND">L : ,</span>
		  <span onclick="mark_attendance('2ND','');" style="color:rgb(220, 57, 18);" id="not_mark_2ND">N : </span>
		</div>
      </div>
      <div id="class5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Umesh [Rajesh][2ND (B)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2000298" class=" 2000298" onclick="set_attendance('2000298','set_present_','P','');">P</li>
      <li id="set_present2_2000298" class=" 2000298" onclick="set_attendance('2000298','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2000298" class=" 2000298" onclick="set_attendance('2000298','set_absent_','A','');">A</li>
      <li id="set_leave_2000298" class=" 2000298" onclick="set_attendance('2000298','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;Rajesh Prasad [Ananda Prasad][2ND (B)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2000314" class=" 2000314" onclick="set_attendance('2000314','set_present_','P','');">P</li>
      <li id="set_present2_2000314" class=" 2000314" onclick="set_attendance('2000314','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2000314" class=" 2000314" onclick="set_attendance('2000314','set_absent_','A','');">A</li>
      <li id="set_leave_2000314" class=" 2000314" onclick="set_attendance('2000314','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Palak Kumari [Krishna Sahani][2ND (B)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2000332" class=" 2000332" onclick="set_attendance('2000332','set_present_','P','IES0001PK');">P</li>
      <li id="set_present2_2000332" class=" 2000332" onclick="set_attendance('2000332','set_present2_','P/2','IES0001PK');">P/2</li>
      <li id="set_absent_2000332" class=" 2000332" onclick="set_attendance('2000332','set_absent_','A','IES0001PK');">A</li>
      <li id="set_leave_2000332" class=" 2000332" onclick="set_attendance('2000332','set_leave_','L','IES0001PK');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;dummy [dummy father ][2ND (B)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100415" class=" 2100415" onclick="set_attendance('2100415','set_present_','P','');">P</li>
      <li id="set_present2_2100415" class=" 2100415" onclick="set_attendance('2100415','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100415" class=" 2100415" onclick="set_attendance('2100415','set_absent_','A','');">A</li>
      <li id="set_leave_2100415" class=" 2100415" onclick="set_attendance('2100415','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;Akhil [Mr. Manoj][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100427" class=" 2100427" onclick="set_attendance('2100427','set_present_','P','');">P</li>
      <li id="set_present2_2100427" class=" 2100427" onclick="set_attendance('2100427','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100427" class=" 2100427" onclick="set_attendance('2100427','set_absent_','A','');">A</li>
      <li id="set_leave_2100427" class=" 2100427" onclick="set_attendance('2100427','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;Avnish kumar [Gopal kumar][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100549" class=" 2100549" onclick="set_attendance('2100549','set_present_','P','');">P</li>
      <li id="set_present2_2100549" class=" 2100549" onclick="set_attendance('2100549','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100549" class=" 2100549" onclick="set_attendance('2100549','set_absent_','A','');">A</li>
      <li id="set_leave_2100549" class=" 2100549" onclick="set_attendance('2100549','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;श्री [दीपक][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100583" class=" 2100583" onclick="set_attendance('2100583','set_present_','P','');">P</li>
      <li id="set_present2_2100583" class=" 2100583" onclick="set_attendance('2100583','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100583" class=" 2100583" onclick="set_attendance('2100583','set_absent_','A','');">A</li>
      <li id="set_leave_2100583" class=" 2100583" onclick="set_attendance('2100583','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;hari [hani][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100589" class=" 2100589" onclick="set_attendance('2100589','set_present_','P','');">P</li>
      <li id="set_present2_2100589" class=" 2100589" onclick="set_attendance('2100589','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100589" class=" 2100589" onclick="set_attendance('2100589','set_absent_','A','');">A</li>
      <li id="set_leave_2100589" class=" 2100589" onclick="set_attendance('2100589','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;dummy [dummy father ][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200612" class=" 2200612" onclick="set_attendance('2200612','set_present_','P','');">P</li>
      <li id="set_present2_2200612" class=" 2200612" onclick="set_attendance('2200612','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200612" class=" 2200612" onclick="set_attendance('2200612','set_absent_','A','');">A</li>
      <li id="set_leave_2200612" class=" 2200612" onclick="set_attendance('2200612','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;rohan sah [ram ][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200622" class=" 2200622" onclick="set_attendance('2200622','set_present_','P','');">P</li>
      <li id="set_present2_2200622" class=" 2200622" onclick="set_attendance('2200622','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200622" class=" 2200622" onclick="set_attendance('2200622','set_absent_','A','');">A</li>
      <li id="set_leave_2200622" class=" 2200622" onclick="set_attendance('2200622','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;ishan kumar [rohit kumar][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200623" class=" 2200623" onclick="set_attendance('2200623','set_present_','P','0014806624');">P</li>
      <li id="set_present2_2200623" class=" 2200623" onclick="set_attendance('2200623','set_present2_','P/2','0014806624');">P/2</li>
      <li id="set_absent_2200623" class=" 2200623" onclick="set_attendance('2200623','set_absent_','A','0014806624');">A</li>
      <li id="set_leave_2200623" class=" 2200623" onclick="set_attendance('2200623','set_leave_','L','0014806624');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;saloni [bijay][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200629" class=" 2200629" onclick="set_attendance('2200629','set_present_','P','');">P</li>
      <li id="set_present2_2200629" class=" 2200629" onclick="set_attendance('2200629','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200629" class=" 2200629" onclick="set_attendance('2200629','set_absent_','A','');">A</li>
      <li id="set_leave_2200629" class=" 2200629" onclick="set_attendance('2200629','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;Mayur Mangesh Padvi [Mangesh Gorakh Padvi][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200634" class=" 2200634" onclick="set_attendance('2200634','set_present_','P','0012660095');">P</li>
      <li id="set_present2_2200634" class=" 2200634" onclick="set_attendance('2200634','set_present2_','P/2','0012660095');">P/2</li>
      <li id="set_absent_2200634" class=" 2200634" onclick="set_attendance('2200634','set_absent_','A','0012660095');">A</li>
      <li id="set_leave_2200634" class=" 2200634" onclick="set_attendance('2200634','set_leave_','L','0012660095');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         14.&nbsp;&nbsp;&nbsp;Bhavesh Arvind Padvi [Arvind Gorakh Padvi][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200635" class=" 2200635" onclick="set_attendance('2200635','set_present_','P','');">P</li>
      <li id="set_present2_2200635" class=" 2200635" onclick="set_attendance('2200635','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200635" class=" 2200635" onclick="set_attendance('2200635','set_absent_','A','');">A</li>
      <li id="set_leave_2200635" class=" 2200635" onclick="set_attendance('2200635','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         15.&nbsp;&nbsp;&nbsp;Nikhil Dinesh Padvi [Dinesh Gorakh Padvi][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200636" class=" 2200636" onclick="set_attendance('2200636','set_present_','P','');">P</li>
      <li id="set_present2_2200636" class=" 2200636" onclick="set_attendance('2200636','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200636" class=" 2200636" onclick="set_attendance('2200636','set_absent_','A','');">A</li>
      <li id="set_leave_2200636" class=" 2200636" onclick="set_attendance('2200636','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         16.&nbsp;&nbsp;&nbsp;abcs [ebgh][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200645" class=" 2200645" onclick="set_attendance('2200645','set_present_','P','');">P</li>
      <li id="set_present2_2200645" class=" 2200645" onclick="set_attendance('2200645','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200645" class=" 2200645" onclick="set_attendance('2200645','set_absent_','A','');">A</li>
      <li id="set_leave_2200645" class=" 2200645" onclick="set_attendance('2200645','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         17.&nbsp;&nbsp;&nbsp;sona [rajesh][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200650" class=" 2200650" onclick="set_attendance('2200650','set_present_','P','0003757961');">P</li>
      <li id="set_present2_2200650" class=" 2200650" onclick="set_attendance('2200650','set_present2_','P/2','0003757961');">P/2</li>
      <li id="set_absent_2200650" class=" 2200650" onclick="set_attendance('2200650','set_absent_','A','0003757961');">A</li>
      <li id="set_leave_2200650" class=" 2200650" onclick="set_attendance('2200650','set_leave_','L','0003757961');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         18.&nbsp;&nbsp;&nbsp;sajid khan  [javed khan][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200662" class=" 2200662" onclick="set_attendance('2200662','set_present_','P','');">P</li>
      <li id="set_present2_2200662" class=" 2200662" onclick="set_attendance('2200662','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200662" class=" 2200662" onclick="set_attendance('2200662','set_absent_','A','');">A</li>
      <li id="set_leave_2200662" class=" 2200662" onclick="set_attendance('2200662','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         19.&nbsp;&nbsp;&nbsp;dummy  [dummy father][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200663" class=" 2200663" onclick="set_attendance('2200663','set_present_','P','');">P</li>
      <li id="set_present2_2200663" class=" 2200663" onclick="set_attendance('2200663','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200663" class=" 2200663" onclick="set_attendance('2200663','set_absent_','A','');">A</li>
      <li id="set_leave_2200663" class=" 2200663" onclick="set_attendance('2200663','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         20.&nbsp;&nbsp;&nbsp;Komal Gupta [Pramod Gupta][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200671" class=" 2200671" onclick="set_attendance('2200671','set_present_','P','');">P</li>
      <li id="set_present2_2200671" class=" 2200671" onclick="set_attendance('2200671','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200671" class=" 2200671" onclick="set_attendance('2200671','set_absent_','A','');">A</li>
      <li id="set_leave_2200671" class=" 2200671" onclick="set_attendance('2200671','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         21.&nbsp;&nbsp;&nbsp;Anil Kapoor Dhoom [][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200674" class=" 2200674" onclick="set_attendance('2200674','set_present_','P','');">P</li>
      <li id="set_present2_2200674" class=" 2200674" onclick="set_attendance('2200674','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200674" class=" 2200674" onclick="set_attendance('2200674','set_absent_','A','');">A</li>
      <li id="set_leave_2200674" class=" 2200674" onclick="set_attendance('2200674','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         22.&nbsp;&nbsp;&nbsp;Prashant  [Rammu lal][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200675" class=" 2200675" onclick="set_attendance('2200675','set_present_','P','');">P</li>
      <li id="set_present2_2200675" class=" 2200675" onclick="set_attendance('2200675','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200675" class=" 2200675" onclick="set_attendance('2200675','set_absent_','A','');">A</li>
      <li id="set_leave_2200675" class=" 2200675" onclick="set_attendance('2200675','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         23.&nbsp;&nbsp;&nbsp;RAJ [rajesh][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200677" class=" 2200677" onclick="set_attendance('2200677','set_present_','P','');">P</li>
      <li id="set_present2_2200677" class=" 2200677" onclick="set_attendance('2200677','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200677" class=" 2200677" onclick="set_attendance('2200677','set_absent_','A','');">A</li>
      <li id="set_leave_2200677" class=" 2200677" onclick="set_attendance('2200677','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         24.&nbsp;&nbsp;&nbsp;XYZ [XYZ][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200685" class=" 2200685" onclick="set_attendance('2200685','set_present_','P','');">P</li>
      <li id="set_present2_2200685" class=" 2200685" onclick="set_attendance('2200685','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200685" class=" 2200685" onclick="set_attendance('2200685','set_absent_','A','');">A</li>
      <li id="set_leave_2200685" class=" 2200685" onclick="set_attendance('2200685','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         25.&nbsp;&nbsp;&nbsp;abc [][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200686" class=" 2200686" onclick="set_attendance('2200686','set_present_','P','');">P</li>
      <li id="set_present2_2200686" class=" 2200686" onclick="set_attendance('2200686','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200686" class=" 2200686" onclick="set_attendance('2200686','set_absent_','A','');">A</li>
      <li id="set_leave_2200686" class=" 2200686" onclick="set_attendance('2200686','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         26.&nbsp;&nbsp;&nbsp;rahul [][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200687" class=" 2200687" onclick="set_attendance('2200687','set_present_','P','');">P</li>
      <li id="set_present2_2200687" class=" 2200687" onclick="set_attendance('2200687','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200687" class=" 2200687" onclick="set_attendance('2200687','set_absent_','A','');">A</li>
      <li id="set_leave_2200687" class=" 2200687" onclick="set_attendance('2200687','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         27.&nbsp;&nbsp;&nbsp;Prashant rajak [Rammu lal][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200688" class=" 2200688" onclick="set_attendance('2200688','set_present_','P','');">P</li>
      <li id="set_present2_2200688" class=" 2200688" onclick="set_attendance('2200688','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200688" class=" 2200688" onclick="set_attendance('2200688','set_absent_','A','');">A</li>
      <li id="set_leave_2200688" class=" 2200688" onclick="set_attendance('2200688','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         28.&nbsp;&nbsp;&nbsp;Prashant kumar [Rammu lal][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200692" class=" 2200692" onclick="set_attendance('2200692','set_present_','P','');">P</li>
      <li id="set_present2_2200692" class=" 2200692" onclick="set_attendance('2200692','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200692" class=" 2200692" onclick="set_attendance('2200692','set_absent_','A','');">A</li>
      <li id="set_leave_2200692" class=" 2200692" onclick="set_attendance('2200692','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         29.&nbsp;&nbsp;&nbsp;bjkb [kllkdv][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200698" class=" 2200698" onclick="set_attendance('2200698','set_present_','P','');">P</li>
      <li id="set_present2_2200698" class=" 2200698" onclick="set_attendance('2200698','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200698" class=" 2200698" onclick="set_attendance('2200698','set_absent_','A','');">A</li>
      <li id="set_leave_2200698" class=" 2200698" onclick="set_attendance('2200698','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         30.&nbsp;&nbsp;&nbsp;laxmi [venkat][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200699" class=" 2200699" onclick="set_attendance('2200699','set_present_','P','');">P</li>
      <li id="set_present2_2200699" class=" 2200699" onclick="set_attendance('2200699','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200699" class=" 2200699" onclick="set_attendance('2200699','set_absent_','A','');">A</li>
      <li id="set_leave_2200699" class=" 2200699" onclick="set_attendance('2200699','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         31.&nbsp;&nbsp;&nbsp;AJAY [SUNIL][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200702" class=" 2200702" onclick="set_attendance('2200702','set_present_','P','');">P</li>
      <li id="set_present2_2200702" class=" 2200702" onclick="set_attendance('2200702','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200702" class=" 2200702" onclick="set_attendance('2200702','set_absent_','A','');">A</li>
      <li id="set_leave_2200702" class=" 2200702" onclick="set_attendance('2200702','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         32.&nbsp;&nbsp;&nbsp;सौरभ [sunil  jain][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200722" class=" 2200722" onclick="set_attendance('2200722','set_present_','P','');">P</li>
      <li id="set_present2_2200722" class=" 2200722" onclick="set_attendance('2200722','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200722" class=" 2200722" onclick="set_attendance('2200722','set_absent_','A','');">A</li>
      <li id="set_leave_2200722" class=" 2200722" onclick="set_attendance('2200722','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         33.&nbsp;&nbsp;&nbsp;saloni karn [bijay karn][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200728" class=" 2200728" onclick="set_attendance('2200728','set_present_','P','');">P</li>
      <li id="set_present2_2200728" class=" 2200728" onclick="set_attendance('2200728','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200728" class=" 2200728" onclick="set_attendance('2200728','set_absent_','A','');">A</li>
      <li id="set_leave_2200728" class=" 2200728" onclick="set_attendance('2200728','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         34.&nbsp;&nbsp;&nbsp;APEKSHIT KOLI [MANOJ KUMAR KOLI][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200732" class=" 2200732" onclick="set_attendance('2200732','set_present_','P','');">P</li>
      <li id="set_present2_2200732" class=" 2200732" onclick="set_attendance('2200732','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200732" class=" 2200732" onclick="set_attendance('2200732','set_absent_','A','');">A</li>
      <li id="set_leave_2200732" class=" 2200732" onclick="set_attendance('2200732','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         35.&nbsp;&nbsp;&nbsp;Rituraj [mitu raj][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200734" class=" 2200734" onclick="set_attendance('2200734','set_present_','P','12345');">P</li>
      <li id="set_present2_2200734" class=" 2200734" onclick="set_attendance('2200734','set_present2_','P/2','12345');">P/2</li>
      <li id="set_absent_2200734" class=" 2200734" onclick="set_attendance('2200734','set_absent_','A','12345');">A</li>
      <li id="set_leave_2200734" class=" 2200734" onclick="set_attendance('2200734','set_leave_','L','12345');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         36.&nbsp;&nbsp;&nbsp;Aaditya  [Sujit][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200735" class=" 2200735" onclick="set_attendance('2200735','set_present_','P','');">P</li>
      <li id="set_present2_2200735" class=" 2200735" onclick="set_attendance('2200735','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200735" class=" 2200735" onclick="set_attendance('2200735','set_absent_','A','');">A</li>
      <li id="set_leave_2200735" class=" 2200735" onclick="set_attendance('2200735','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         37.&nbsp;&nbsp;&nbsp;ashok [][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200740" class=" 2200740" onclick="set_attendance('2200740','set_present_','P','');">P</li>
      <li id="set_present2_2200740" class=" 2200740" onclick="set_attendance('2200740','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200740" class=" 2200740" onclick="set_attendance('2200740','set_absent_','A','');">A</li>
      <li id="set_leave_2200740" class=" 2200740" onclick="set_attendance('2200740','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         38.&nbsp;&nbsp;&nbsp;vivek [][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200742" class=" 2200742" onclick="set_attendance('2200742','set_present_','P','');">P</li>
      <li id="set_present2_2200742" class=" 2200742" onclick="set_attendance('2200742','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200742" class=" 2200742" onclick="set_attendance('2200742','set_absent_','A','');">A</li>
      <li id="set_leave_2200742" class=" 2200742" onclick="set_attendance('2200742','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         39.&nbsp;&nbsp;&nbsp;bbs [bbs][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200744" class=" 2200744" onclick="set_attendance('2200744','set_present_','P','');">P</li>
      <li id="set_present2_2200744" class=" 2200744" onclick="set_attendance('2200744','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200744" class=" 2200744" onclick="set_attendance('2200744','set_absent_','A','');">A</li>
      <li id="set_leave_2200744" class=" 2200744" onclick="set_attendance('2200744','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         40.&nbsp;&nbsp;&nbsp;ravi [udham][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200746" class=" 2200746" onclick="set_attendance('2200746','set_present_','P','');">P</li>
      <li id="set_present2_2200746" class=" 2200746" onclick="set_attendance('2200746','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200746" class=" 2200746" onclick="set_attendance('2200746','set_absent_','A','');">A</li>
      <li id="set_leave_2200746" class=" 2200746" onclick="set_attendance('2200746','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         41.&nbsp;&nbsp;&nbsp;AADITYA JHILLE [AASHISH JHILLE][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200748" class=" 2200748" onclick="set_attendance('2200748','set_present_','P','');">P</li>
      <li id="set_present2_2200748" class=" 2200748" onclick="set_attendance('2200748','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200748" class=" 2200748" onclick="set_attendance('2200748','set_absent_','A','');">A</li>
      <li id="set_leave_2200748" class=" 2200748" onclick="set_attendance('2200748','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         42.&nbsp;&nbsp;&nbsp;ROHIT KUMAR [DOODH NATH YADAV][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200750" class=" 2200750" onclick="set_attendance('2200750','set_present_','P','');">P</li>
      <li id="set_present2_2200750" class=" 2200750" onclick="set_attendance('2200750','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200750" class=" 2200750" onclick="set_attendance('2200750','set_absent_','A','');">A</li>
      <li id="set_leave_2200750" class=" 2200750" onclick="set_attendance('2200750','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         43.&nbsp;&nbsp;&nbsp;Prashant  KUMAR [Rammu lal][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200751" class=" 2200751" onclick="set_attendance('2200751','set_present_','P','744444740000');">P</li>
      <li id="set_present2_2200751" class=" 2200751" onclick="set_attendance('2200751','set_present2_','P/2','744444740000');">P/2</li>
      <li id="set_absent_2200751" class=" 2200751" onclick="set_attendance('2200751','set_absent_','A','744444740000');">A</li>
      <li id="set_leave_2200751" class=" 2200751" onclick="set_attendance('2200751','set_leave_','L','744444740000');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         44.&nbsp;&nbsp;&nbsp;sunil 1 [Asad][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200779" class=" 2200779" onclick="set_attendance('2200779','set_present_','P','');">P</li>
      <li id="set_present2_2200779" class=" 2200779" onclick="set_attendance('2200779','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200779" class=" 2200779" onclick="set_attendance('2200779','set_absent_','A','');">A</li>
      <li id="set_leave_2200779" class=" 2200779" onclick="set_attendance('2200779','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         45.&nbsp;&nbsp;&nbsp;AVNI SHARMA [SOURABH SHARMA][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200786" class=" 2200786" onclick="set_attendance('2200786','set_present_','P','');">P</li>
      <li id="set_present2_2200786" class=" 2200786" onclick="set_attendance('2200786','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200786" class=" 2200786" onclick="set_attendance('2200786','set_absent_','A','');">A</li>
      <li id="set_leave_2200786" class=" 2200786" onclick="set_attendance('2200786','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         46.&nbsp;&nbsp;&nbsp;SONU PRAJAPATI [LALARAM PRAJAPATI][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200796" class=" 2200796" onclick="set_attendance('2200796','set_present_','P','');">P</li>
      <li id="set_present2_2200796" class=" 2200796" onclick="set_attendance('2200796','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200796" class=" 2200796" onclick="set_attendance('2200796','set_absent_','A','');">A</li>
      <li id="set_leave_2200796" class=" 2200796" onclick="set_attendance('2200796','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         47.&nbsp;&nbsp;&nbsp;dummy  [dummy][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200798" class=" 2200798" onclick="set_attendance('2200798','set_present_','P','');">P</li>
      <li id="set_present2_2200798" class=" 2200798" onclick="set_attendance('2200798','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200798" class=" 2200798" onclick="set_attendance('2200798','set_absent_','A','');">A</li>
      <li id="set_leave_2200798" class=" 2200798" onclick="set_attendance('2200798','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         48.&nbsp;&nbsp;&nbsp;TABREZ ALAM [BAKRIDAN ANSARI][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200799" class=" 2200799" onclick="set_attendance('2200799','set_present_','P','');">P</li>
      <li id="set_present2_2200799" class=" 2200799" onclick="set_attendance('2200799','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200799" class=" 2200799" onclick="set_attendance('2200799','set_absent_','A','');">A</li>
      <li id="set_leave_2200799" class=" 2200799" onclick="set_attendance('2200799','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         49.&nbsp;&nbsp;&nbsp;PANKAJ KUMAR [UPENDRA SHARMA][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200831" class=" 2200831" onclick="set_attendance('2200831','set_present_','P','');">P</li>
      <li id="set_present2_2200831" class=" 2200831" onclick="set_attendance('2200831','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200831" class=" 2200831" onclick="set_attendance('2200831','set_absent_','A','');">A</li>
      <li id="set_leave_2200831" class=" 2200831" onclick="set_attendance('2200831','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         50.&nbsp;&nbsp;&nbsp;VINAYAK PATIDAR [SUNIL RAI][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200861" class=" 2200861" onclick="set_attendance('2200861','set_present_','P','');">P</li>
      <li id="set_present2_2200861" class=" 2200861" onclick="set_attendance('2200861','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200861" class=" 2200861" onclick="set_attendance('2200861','set_absent_','A','');">A</li>
      <li id="set_leave_2200861" class=" 2200861" onclick="set_attendance('2200861','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         51.&nbsp;&nbsp;&nbsp;VINAYAK PATIDAR [RAJENDRA PATIDAR][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200927" class=" 2200927" onclick="set_attendance('2200927','set_present_','P','');">P</li>
      <li id="set_present2_2200927" class=" 2200927" onclick="set_attendance('2200927','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200927" class=" 2200927" onclick="set_attendance('2200927','set_absent_','A','');">A</li>
      <li id="set_leave_2200927" class=" 2200927" onclick="set_attendance('2200927','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         52.&nbsp;&nbsp;&nbsp;vicky uikey [jitendra singh uikey][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200936" class=" 2200936" onclick="set_attendance('2200936','set_present_','P','');">P</li>
      <li id="set_present2_2200936" class=" 2200936" onclick="set_attendance('2200936','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200936" class=" 2200936" onclick="set_attendance('2200936','set_absent_','A','');">A</li>
      <li id="set_leave_2200936" class=" 2200936" onclick="set_attendance('2200936','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         53.&nbsp;&nbsp;&nbsp;Vansh Kumar Pasi [Ravi Pasi][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200951" class=" 2200951" onclick="set_attendance('2200951','set_present_','P','');">P</li>
      <li id="set_present2_2200951" class=" 2200951" onclick="set_attendance('2200951','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200951" class=" 2200951" onclick="set_attendance('2200951','set_absent_','A','');">A</li>
      <li id="set_leave_2200951" class=" 2200951" onclick="set_attendance('2200951','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         54.&nbsp;&nbsp;&nbsp;RAM KUMAR  [SHYAM KUMAR ][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200955" class=" 2200955" onclick="set_attendance('2200955','set_present_','P','');">P</li>
      <li id="set_present2_2200955" class=" 2200955" onclick="set_attendance('2200955','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200955" class=" 2200955" onclick="set_attendance('2200955','set_absent_','A','');">A</li>
      <li id="set_leave_2200955" class=" 2200955" onclick="set_attendance('2200955','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         55.&nbsp;&nbsp;&nbsp;Amit rao [Sahab rao][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200959" class=" 2200959" onclick="set_attendance('2200959','set_present_','P','0012022978');">P</li>
      <li id="set_present2_2200959" class=" 2200959" onclick="set_attendance('2200959','set_present2_','P/2','0012022978');">P/2</li>
      <li id="set_absent_2200959" class=" 2200959" onclick="set_attendance('2200959','set_absent_','A','0012022978');">A</li>
      <li id="set_leave_2200959" class=" 2200959" onclick="set_attendance('2200959','set_leave_','L','0012022978');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         56.&nbsp;&nbsp;&nbsp;NIDHI SINGH [BHARAT PATIDAR][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200961" class=" 2200961" onclick="set_attendance('2200961','set_present_','P','');">P</li>
      <li id="set_present2_2200961" class=" 2200961" onclick="set_attendance('2200961','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200961" class=" 2200961" onclick="set_attendance('2200961','set_absent_','A','');">A</li>
      <li id="set_leave_2200961" class=" 2200961" onclick="set_attendance('2200961','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         57.&nbsp;&nbsp;&nbsp;shravan singh [rajaram singh][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200962" class=" 2200962" onclick="set_attendance('2200962','set_present_','P','');">P</li>
      <li id="set_present2_2200962" class=" 2200962" onclick="set_attendance('2200962','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200962" class=" 2200962" onclick="set_attendance('2200962','set_absent_','A','');">A</li>
      <li id="set_leave_2200962" class=" 2200962" onclick="set_attendance('2200962','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         58.&nbsp;&nbsp;&nbsp;asharamk [][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200965" class=" 2200965" onclick="set_attendance('2200965','set_present_','P','');">P</li>
      <li id="set_present2_2200965" class=" 2200965" onclick="set_attendance('2200965','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200965" class=" 2200965" onclick="set_attendance('2200965','set_absent_','A','');">A</li>
      <li id="set_leave_2200965" class=" 2200965" onclick="set_attendance('2200965','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         59.&nbsp;&nbsp;&nbsp;Monali [][2ND (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200980" class=" 2200980" onclick="set_attendance('2200980','set_present_','P','');">P</li>
      <li id="set_present2_2200980" class=" 2200980" onclick="set_attendance('2200980','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200980" class=" 2200980" onclick="set_attendance('2200980','set_absent_','A','');">A</li>
      <li id="set_leave_2200980" class=" 2200980" onclick="set_attendance('2200980','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class6" aria-expanded="false" aria-controls="collapseOne">
          6.&nbsp;&nbsp;&nbsp;3RD&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_3RD">S : ,</span>
		  <span onclick="mark_attendance('3RD','P');" style="color:rgb(16, 150, 24);" id="present_3RD">P : ,</span>
		  <span onclick="mark_attendance('3RD','A');" style="color:rgb(153, 0, 153);" id="absent_3RD">A : ,</span>
		  <span onclick="mark_attendance('3RD','L');" style="color:rgb(255, 153, 0);"id="leave_3RD">L : ,</span>
		  <span onclick="mark_attendance('3RD','');" style="color:rgb(220, 57, 18);" id="not_mark_3RD">N : </span>
		</div>
      </div>
      <div id="class6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;joy [peter][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2000345" class=" 2000345" onclick="set_attendance('2000345','set_present_','P','0004279640');">P</li>
      <li id="set_present2_2000345" class=" 2000345" onclick="set_attendance('2000345','set_present2_','P/2','0004279640');">P/2</li>
      <li id="set_absent_2000345" class=" 2000345" onclick="set_attendance('2000345','set_absent_','A','0004279640');">A</li>
      <li id="set_leave_2000345" class=" 2000345" onclick="set_attendance('2000345','set_leave_','L','0004279640');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;Upen [Rajdev Mishra][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100412" class=" 2100412" onclick="set_attendance('2100412','set_present_','P','');">P</li>
      <li id="set_present2_2100412" class=" 2100412" onclick="set_attendance('2100412','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100412" class=" 2100412" onclick="set_attendance('2100412','set_absent_','A','');">A</li>
      <li id="set_leave_2100412" class=" 2100412" onclick="set_attendance('2100412','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;cddf [][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100437" class=" 2100437" onclick="set_attendance('2100437','set_present_','P','');">P</li>
      <li id="set_present2_2100437" class=" 2100437" onclick="set_attendance('2100437','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100437" class=" 2100437" onclick="set_attendance('2100437','set_absent_','A','');">A</li>
      <li id="set_leave_2100437" class=" 2100437" onclick="set_attendance('2100437','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;ajay kewat [durga kewat][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100470" class=" 2100470" onclick="set_attendance('2100470','set_present_','P','');">P</li>
      <li id="set_present2_2100470" class=" 2100470" onclick="set_attendance('2100470','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100470" class=" 2100470" onclick="set_attendance('2100470','set_absent_','A','');">A</li>
      <li id="set_leave_2100470" class=" 2100470" onclick="set_attendance('2100470','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;raja [raja][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100474" class=" 2100474" onclick="set_attendance('2100474','set_present_','P','');">P</li>
      <li id="set_present2_2100474" class=" 2100474" onclick="set_attendance('2100474','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100474" class=" 2100474" onclick="set_attendance('2100474','set_absent_','A','');">A</li>
      <li id="set_leave_2100474" class=" 2100474" onclick="set_attendance('2100474','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;AS [SS][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200716" class=" 2200716" onclick="set_attendance('2200716','set_present_','P','');">P</li>
      <li id="set_present2_2200716" class=" 2200716" onclick="set_attendance('2200716','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200716" class=" 2200716" onclick="set_attendance('2200716','set_absent_','A','');">A</li>
      <li id="set_leave_2200716" class=" 2200716" onclick="set_attendance('2200716','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;aashu  [][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200723" class=" 2200723" onclick="set_attendance('2200723','set_present_','P','0009240208');">P</li>
      <li id="set_present2_2200723" class=" 2200723" onclick="set_attendance('2200723','set_present2_','P/2','0009240208');">P/2</li>
      <li id="set_absent_2200723" class=" 2200723" onclick="set_attendance('2200723','set_absent_','A','0009240208');">A</li>
      <li id="set_leave_2200723" class=" 2200723" onclick="set_attendance('2200723','set_leave_','L','0009240208');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;Akshaj Mishra [shesh Narayan Mishra][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200753" class=" 2200753" onclick="set_attendance('2200753','set_present_','P','');">P</li>
      <li id="set_present2_2200753" class=" 2200753" onclick="set_attendance('2200753','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200753" class=" 2200753" onclick="set_attendance('2200753','set_absent_','A','');">A</li>
      <li id="set_leave_2200753" class=" 2200753" onclick="set_attendance('2200753','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;nidhi jain  [sunil  jain][3RD (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200760" class=" 2200760" onclick="set_attendance('2200760','set_present_','P','');">P</li>
      <li id="set_present2_2200760" class=" 2200760" onclick="set_attendance('2200760','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200760" class=" 2200760" onclick="set_attendance('2200760','set_absent_','A','');">A</li>
      <li id="set_leave_2200760" class=" 2200760" onclick="set_attendance('2200760','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class7" aria-expanded="false" aria-controls="collapseOne">
          7.&nbsp;&nbsp;&nbsp;4TH&nbsp;&nbsp;[A,B]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_4TH">S : ,</span>
		  <span onclick="mark_attendance('4TH','P');" style="color:rgb(16, 150, 24);" id="present_4TH">P : ,</span>
		  <span onclick="mark_attendance('4TH','A');" style="color:rgb(153, 0, 153);" id="absent_4TH">A : ,</span>
		  <span onclick="mark_attendance('4TH','L');" style="color:rgb(255, 153, 0);"id="leave_4TH">L : ,</span>
		  <span onclick="mark_attendance('4TH','');" style="color:rgb(220, 57, 18);" id="not_mark_4TH">N : </span>
		</div>
      </div>
      <div id="class7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Saurya [Sanjeev Kumar][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100414" class=" 2100414" onclick="set_attendance('2100414','set_present_','P','');">P</li>
      <li id="set_present2_2100414" class=" 2100414" onclick="set_attendance('2100414','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100414" class=" 2100414" onclick="set_attendance('2100414','set_absent_','A','');">A</li>
      <li id="set_leave_2100414" class=" 2100414" onclick="set_attendance('2100414','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;Aman [Asad][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100471" class=" 2100471" onclick="set_attendance('2100471','set_present_','P','');">P</li>
      <li id="set_present2_2100471" class=" 2100471" onclick="set_attendance('2100471','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100471" class=" 2100471" onclick="set_attendance('2100471','set_absent_','A','');">A</li>
      <li id="set_leave_2100471" class=" 2100471" onclick="set_attendance('2100471','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Nikhil  Lodhi [Mayank Lodhi][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100520" class=" 2100520" onclick="set_attendance('2100520','set_present_','P','');">P</li>
      <li id="set_present2_2100520" class=" 2100520" onclick="set_attendance('2100520','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100520" class=" 2100520" onclick="set_attendance('2100520','set_absent_','A','');">A</li>
      <li id="set_leave_2100520" class=" 2100520" onclick="set_attendance('2100520','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;Diviya prajapati [Shrawan Ram][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100538" class=" 2100538" onclick="set_attendance('2100538','set_present_','P','');">P</li>
      <li id="set_present2_2100538" class=" 2100538" onclick="set_attendance('2100538','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100538" class=" 2100538" onclick="set_attendance('2100538','set_absent_','A','');">A</li>
      <li id="set_leave_2100538" class=" 2100538" onclick="set_attendance('2100538','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;Muhammed Adnan [Muhammed Afnan][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100585" class=" 2100585" onclick="set_attendance('2100585','set_present_','P','');">P</li>
      <li id="set_present2_2100585" class=" 2100585" onclick="set_attendance('2100585','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100585" class=" 2100585" onclick="set_attendance('2100585','set_absent_','A','');">A</li>
      <li id="set_leave_2100585" class=" 2100585" onclick="set_attendance('2100585','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;mahir khan  [javed khan ][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200659" class=" 2200659" onclick="set_attendance('2200659','set_present_','P','');">P</li>
      <li id="set_present2_2200659" class=" 2200659" onclick="set_attendance('2200659','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200659" class=" 2200659" onclick="set_attendance('2200659','set_absent_','A','');">A</li>
      <li id="set_leave_2200659" class=" 2200659" onclick="set_attendance('2200659','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;imran khan  [waseem khan ][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200661" class=" 2200661" onclick="set_attendance('2200661','set_present_','P','');">P</li>
      <li id="set_present2_2200661" class=" 2200661" onclick="set_attendance('2200661','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200661" class=" 2200661" onclick="set_attendance('2200661','set_absent_','A','');">A</li>
      <li id="set_leave_2200661" class=" 2200661" onclick="set_attendance('2200661','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;SAJAL [][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200668" class=" 2200668" onclick="set_attendance('2200668','set_present_','P','');">P</li>
      <li id="set_present2_2200668" class=" 2200668" onclick="set_attendance('2200668','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200668" class=" 2200668" onclick="set_attendance('2200668','set_absent_','A','');">A</li>
      <li id="set_leave_2200668" class=" 2200668" onclick="set_attendance('2200668','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;Anil Kumar [][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200672" class=" 2200672" onclick="set_attendance('2200672','set_present_','P','');">P</li>
      <li id="set_present2_2200672" class=" 2200672" onclick="set_attendance('2200672','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200672" class=" 2200672" onclick="set_attendance('2200672','set_absent_','A','');">A</li>
      <li id="set_leave_2200672" class=" 2200672" onclick="set_attendance('2200672','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;Ram [][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200713" class=" 2200713" onclick="set_attendance('2200713','set_present_','P','');">P</li>
      <li id="set_present2_2200713" class=" 2200713" onclick="set_attendance('2200713','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200713" class=" 2200713" onclick="set_attendance('2200713','set_absent_','A','');">A</li>
      <li id="set_leave_2200713" class=" 2200713" onclick="set_attendance('2200713','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;priya [rahul mehara][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200755" class=" 2200755" onclick="set_attendance('2200755','set_present_','P','');">P</li>
      <li id="set_present2_2200755" class=" 2200755" onclick="set_attendance('2200755','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200755" class=" 2200755" onclick="set_attendance('2200755','set_absent_','A','');">A</li>
      <li id="set_leave_2200755" class=" 2200755" onclick="set_attendance('2200755','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;nidhi jain  [sunil  jain][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200776" class=" 2200776" onclick="set_attendance('2200776','set_present_','P','');">P</li>
      <li id="set_present2_2200776" class=" 2200776" onclick="set_attendance('2200776','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200776" class=" 2200776" onclick="set_attendance('2200776','set_absent_','A','');">A</li>
      <li id="set_leave_2200776" class=" 2200776" onclick="set_attendance('2200776','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;Ramesh [Suresh][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201062" class=" 2201062" onclick="set_attendance('2201062','set_present_','P','');">P</li>
      <li id="set_present2_2201062" class=" 2201062" onclick="set_attendance('2201062','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201062" class=" 2201062" onclick="set_attendance('2201062','set_absent_','A','');">A</li>
      <li id="set_leave_2201062" class=" 2201062" onclick="set_attendance('2201062','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         14.&nbsp;&nbsp;&nbsp;Rajdeep kumar [Mandal himesh][4TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201082" class=" 2201082" onclick="set_attendance('2201082','set_present_','P','');">P</li>
      <li id="set_present2_2201082" class=" 2201082" onclick="set_attendance('2201082','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201082" class=" 2201082" onclick="set_attendance('2201082','set_absent_','A','');">A</li>
      <li id="set_leave_2201082" class=" 2201082" onclick="set_attendance('2201082','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class8" aria-expanded="false" aria-controls="collapseOne">
          8.&nbsp;&nbsp;&nbsp;5TH&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_5TH">S : ,</span>
		  <span onclick="mark_attendance('5TH','P');" style="color:rgb(16, 150, 24);" id="present_5TH">P : ,</span>
		  <span onclick="mark_attendance('5TH','A');" style="color:rgb(153, 0, 153);" id="absent_5TH">A : ,</span>
		  <span onclick="mark_attendance('5TH','L');" style="color:rgb(255, 153, 0);"id="leave_5TH">L : ,</span>
		  <span onclick="mark_attendance('5TH','');" style="color:rgb(220, 57, 18);" id="not_mark_5TH">N : </span>
		</div>
      </div>
      <div id="class8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Vaidik [][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100537" class=" 2100537" onclick="set_attendance('2100537','set_present_','P','');">P</li>
      <li id="set_present2_2100537" class=" 2100537" onclick="set_attendance('2100537','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100537" class=" 2100537" onclick="set_attendance('2100537','set_absent_','A','');">A</li>
      <li id="set_leave_2100537" class=" 2100537" onclick="set_attendance('2100537','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;umesh  [][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100563" class=" 2100563" onclick="set_attendance('2100563','set_present_','P','');">P</li>
      <li id="set_present2_2100563" class=" 2100563" onclick="set_attendance('2100563','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100563" class=" 2100563" onclick="set_attendance('2100563','set_absent_','A','');">A</li>
      <li id="set_leave_2100563" class=" 2100563" onclick="set_attendance('2100563','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Ram [Lala seth][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200679" class=" 2200679" onclick="set_attendance('2200679','set_present_','P','');">P</li>
      <li id="set_present2_2200679" class=" 2200679" onclick="set_attendance('2200679','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200679" class=" 2200679" onclick="set_attendance('2200679','set_absent_','A','');">A</li>
      <li id="set_leave_2200679" class=" 2200679" onclick="set_attendance('2200679','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;Prashant Kumar [Rammu][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200680" class=" 2200680" onclick="set_attendance('2200680','set_present_','P','');">P</li>
      <li id="set_present2_2200680" class=" 2200680" onclick="set_attendance('2200680','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200680" class=" 2200680" onclick="set_attendance('2200680','set_absent_','A','');">A</li>
      <li id="set_leave_2200680" class=" 2200680" onclick="set_attendance('2200680','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;Prashant  KUMAR [Rammu lal][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200719" class=" 2200719" onclick="set_attendance('2200719','set_present_','P','577711111111111');">P</li>
      <li id="set_present2_2200719" class=" 2200719" onclick="set_attendance('2200719','set_present2_','P/2','577711111111111');">P/2</li>
      <li id="set_absent_2200719" class=" 2200719" onclick="set_attendance('2200719','set_absent_','A','577711111111111');">A</li>
      <li id="set_leave_2200719" class=" 2200719" onclick="set_attendance('2200719','set_leave_','L','577711111111111');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;Rahul kumar [vijay singh][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200725" class=" 2200725" onclick="set_attendance('2200725','set_present_','P','');">P</li>
      <li id="set_present2_2200725" class=" 2200725" onclick="set_attendance('2200725','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200725" class=" 2200725" onclick="set_attendance('2200725','set_absent_','A','');">A</li>
      <li id="set_leave_2200725" class=" 2200725" onclick="set_attendance('2200725','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;simran [PRAKASH PATIDAR][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200731" class=" 2200731" onclick="set_attendance('2200731','set_present_','P','');">P</li>
      <li id="set_present2_2200731" class=" 2200731" onclick="set_attendance('2200731','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200731" class=" 2200731" onclick="set_attendance('2200731','set_absent_','A','');">A</li>
      <li id="set_leave_2200731" class=" 2200731" onclick="set_attendance('2200731','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;VINAYAK PATIDAR [rahul mehara][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200763" class=" 2200763" onclick="set_attendance('2200763','set_present_','P','');">P</li>
      <li id="set_present2_2200763" class=" 2200763" onclick="set_attendance('2200763','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200763" class=" 2200763" onclick="set_attendance('2200763','set_absent_','A','');">A</li>
      <li id="set_leave_2200763" class=" 2200763" onclick="set_attendance('2200763','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;Praashant  [rammulal][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200767" class=" 2200767" onclick="set_attendance('2200767','set_present_','P','');">P</li>
      <li id="set_present2_2200767" class=" 2200767" onclick="set_attendance('2200767','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200767" class=" 2200767" onclick="set_attendance('2200767','set_absent_','A','');">A</li>
      <li id="set_leave_2200767" class=" 2200767" onclick="set_attendance('2200767','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;Prashant r [rahul mehara ][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200772" class=" 2200772" onclick="set_attendance('2200772','set_present_','P','');">P</li>
      <li id="set_present2_2200772" class=" 2200772" onclick="set_attendance('2200772','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200772" class=" 2200772" onclick="set_attendance('2200772','set_absent_','A','');">A</li>
      <li id="set_leave_2200772" class=" 2200772" onclick="set_attendance('2200772','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;NIDHI SINGH [RAMRAJ][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200864" class=" 2200864" onclick="set_attendance('2200864','set_present_','P','');">P</li>
      <li id="set_present2_2200864" class=" 2200864" onclick="set_attendance('2200864','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200864" class=" 2200864" onclick="set_attendance('2200864','set_absent_','A','');">A</li>
      <li id="set_leave_2200864" class=" 2200864" onclick="set_attendance('2200864','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;ArhN [Arqam][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200931" class=" 2200931" onclick="set_attendance('2200931','set_present_','P','');">P</li>
      <li id="set_present2_2200931" class=" 2200931" onclick="set_attendance('2200931','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200931" class=" 2200931" onclick="set_attendance('2200931','set_absent_','A','');">A</li>
      <li id="set_leave_2200931" class=" 2200931" onclick="set_attendance('2200931','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;SURYA PRATAP MAURYA [][5TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201084" class=" 2201084" onclick="set_attendance('2201084','set_present_','P','');">P</li>
      <li id="set_present2_2201084" class=" 2201084" onclick="set_attendance('2201084','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201084" class=" 2201084" onclick="set_attendance('2201084','set_absent_','A','');">A</li>
      <li id="set_leave_2201084" class=" 2201084" onclick="set_attendance('2201084','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class9" aria-expanded="false" aria-controls="collapseOne">
          9.&nbsp;&nbsp;&nbsp;6TH&nbsp;&nbsp;[A,B,C]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_6TH">S : ,</span>
		  <span onclick="mark_attendance('6TH','P');" style="color:rgb(16, 150, 24);" id="present_6TH">P : ,</span>
		  <span onclick="mark_attendance('6TH','A');" style="color:rgb(153, 0, 153);" id="absent_6TH">A : ,</span>
		  <span onclick="mark_attendance('6TH','L');" style="color:rgb(255, 153, 0);"id="leave_6TH">L : ,</span>
		  <span onclick="mark_attendance('6TH','');" style="color:rgb(220, 57, 18);" id="not_mark_6TH">N : </span>
		</div>
      </div>
      <div id="class9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;umesh  [][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100561" class=" 2100561" onclick="set_attendance('2100561','set_present_','P','');">P</li>
      <li id="set_present2_2100561" class=" 2100561" onclick="set_attendance('2100561','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100561" class=" 2100561" onclick="set_attendance('2100561','set_absent_','A','');">A</li>
      <li id="set_leave_2100561" class=" 2100561" onclick="set_attendance('2100561','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;pankaj patel [ram ][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200624" class=" 2200624" onclick="set_attendance('2200624','set_present_','P','');">P</li>
      <li id="set_present2_2200624" class=" 2200624" onclick="set_attendance('2200624','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200624" class=" 2200624" onclick="set_attendance('2200624','set_absent_','A','');">A</li>
      <li id="set_leave_2200624" class=" 2200624" onclick="set_attendance('2200624','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;suman [bijay][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200630" class=" 2200630" onclick="set_attendance('2200630','set_present_','P','');">P</li>
      <li id="set_present2_2200630" class=" 2200630" onclick="set_attendance('2200630','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200630" class=" 2200630" onclick="set_attendance('2200630','set_absent_','A','');">A</li>
      <li id="set_leave_2200630" class=" 2200630" onclick="set_attendance('2200630','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;dishika [sonu khatri ][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200665" class=" 2200665" onclick="set_attendance('2200665','set_present_','P','');">P</li>
      <li id="set_present2_2200665" class=" 2200665" onclick="set_attendance('2200665','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200665" class=" 2200665" onclick="set_attendance('2200665','set_absent_','A','');">A</li>
      <li id="set_leave_2200665" class=" 2200665" onclick="set_attendance('2200665','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;sarita [ramjee Gupta][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200669" class=" 2200669" onclick="set_attendance('2200669','set_present_','P','');">P</li>
      <li id="set_present2_2200669" class=" 2200669" onclick="set_attendance('2200669','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200669" class=" 2200669" onclick="set_attendance('2200669','set_absent_','A','');">A</li>
      <li id="set_leave_2200669" class=" 2200669" onclick="set_attendance('2200669','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;DISHANT PATIDAR [][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200709" class=" 2200709" onclick="set_attendance('2200709','set_present_','P','');">P</li>
      <li id="set_present2_2200709" class=" 2200709" onclick="set_attendance('2200709','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200709" class=" 2200709" onclick="set_attendance('2200709','set_absent_','A','');">A</li>
      <li id="set_leave_2200709" class=" 2200709" onclick="set_attendance('2200709','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;RAJESH KUMAR MAHTO  [SITA RAM MAHTO ][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200756" class=" 2200756" onclick="set_attendance('2200756','set_present_','P','');">P</li>
      <li id="set_present2_2200756" class=" 2200756" onclick="set_attendance('2200756','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200756" class=" 2200756" onclick="set_attendance('2200756','set_absent_','A','');">A</li>
      <li id="set_leave_2200756" class=" 2200756" onclick="set_attendance('2200756','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;RAJ  NAYK  [GOPAL KHATRI][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200765" class=" 2200765" onclick="set_attendance('2200765','set_present_','P','');">P</li>
      <li id="set_present2_2200765" class=" 2200765" onclick="set_attendance('2200765','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200765" class=" 2200765" onclick="set_attendance('2200765','set_absent_','A','');">A</li>
      <li id="set_leave_2200765" class=" 2200765" onclick="set_attendance('2200765','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;pragya  [rajesh][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200814" class=" 2200814" onclick="set_attendance('2200814','set_present_','P','');">P</li>
      <li id="set_present2_2200814" class=" 2200814" onclick="set_attendance('2200814','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200814" class=" 2200814" onclick="set_attendance('2200814','set_absent_','A','');">A</li>
      <li id="set_leave_2200814" class=" 2200814" onclick="set_attendance('2200814','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;jeet kumar [amit kumar ][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200827" class=" 2200827" onclick="set_attendance('2200827','set_present_','P','');">P</li>
      <li id="set_present2_2200827" class=" 2200827" onclick="set_attendance('2200827','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200827" class=" 2200827" onclick="set_attendance('2200827','set_absent_','A','');">A</li>
      <li id="set_leave_2200827" class=" 2200827" onclick="set_attendance('2200827','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;Mafidul Islam [Ali][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200886" class=" 2200886" onclick="set_attendance('2200886','set_present_','P','');">P</li>
      <li id="set_present2_2200886" class=" 2200886" onclick="set_attendance('2200886','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200886" class=" 2200886" onclick="set_attendance('2200886','set_absent_','A','');">A</li>
      <li id="set_leave_2200886" class=" 2200886" onclick="set_attendance('2200886','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;Roshan  [Raj Mishra][6TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201080" class=" 2201080" onclick="set_attendance('2201080','set_present_','P','');">P</li>
      <li id="set_present2_2201080" class=" 2201080" onclick="set_attendance('2201080','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201080" class=" 2201080" onclick="set_attendance('2201080','set_absent_','A','');">A</li>
      <li id="set_leave_2201080" class=" 2201080" onclick="set_attendance('2201080','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class10" aria-expanded="false" aria-controls="collapseOne">
          10.&nbsp;&nbsp;&nbsp;7TH&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_7TH">S : ,</span>
		  <span onclick="mark_attendance('7TH','P');" style="color:rgb(16, 150, 24);" id="present_7TH">P : ,</span>
		  <span onclick="mark_attendance('7TH','A');" style="color:rgb(153, 0, 153);" id="absent_7TH">A : ,</span>
		  <span onclick="mark_attendance('7TH','L');" style="color:rgb(255, 153, 0);"id="leave_7TH">L : ,</span>
		  <span onclick="mark_attendance('7TH','');" style="color:rgb(220, 57, 18);" id="not_mark_7TH">N : </span>
		</div>
      </div>
      <div id="class10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Sagar Singh [Rakesh Singh][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100541" class="active 2100541" onclick="set_attendance('2100541','set_present_','P','');">P</li>
      <li id="set_present2_2100541" class=" 2100541" onclick="set_attendance('2100541','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100541" class=" 2100541" onclick="set_attendance('2100541','set_absent_','A','');">A</li>
      <li id="set_leave_2100541" class=" 2100541" onclick="set_attendance('2100541','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;MANVEER SINGH  [GURDEV SINGH ][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200632" class="active 2200632" onclick="set_attendance('2200632','set_present_','P','');">P</li>
      <li id="set_present2_2200632" class=" 2200632" onclick="set_attendance('2200632','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200632" class=" 2200632" onclick="set_attendance('2200632','set_absent_','A','');">A</li>
      <li id="set_leave_2200632" class=" 2200632" onclick="set_attendance('2200632','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Kiran Sharma [Ramu Sharma][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200637" class="active 2200637" onclick="set_attendance('2200637','set_present_','P','');">P</li>
      <li id="set_present2_2200637" class=" 2200637" onclick="set_attendance('2200637','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200637" class=" 2200637" onclick="set_attendance('2200637','set_absent_','A','');">A</li>
      <li id="set_leave_2200637" class=" 2200637" onclick="set_attendance('2200637','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;Riya Sharma [Ram Sharma][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200638" class="active 2200638" onclick="set_attendance('2200638','set_present_','P','');">P</li>
      <li id="set_present2_2200638" class=" 2200638" onclick="set_attendance('2200638','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200638" class=" 2200638" onclick="set_attendance('2200638','set_absent_','A','');">A</li>
      <li id="set_leave_2200638" class=" 2200638" onclick="set_attendance('2200638','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;Meena Verma [Jay Verma][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200640" class="active 2200640" onclick="set_attendance('2200640','set_present_','P','');">P</li>
      <li id="set_present2_2200640" class=" 2200640" onclick="set_attendance('2200640','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200640" class=" 2200640" onclick="set_attendance('2200640','set_absent_','A','');">A</li>
      <li id="set_leave_2200640" class=" 2200640" onclick="set_attendance('2200640','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;Heena Mittal [Lalu Pasad][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200641" class=" 2200641" onclick="set_attendance('2200641','set_present_','P','');">P</li>
      <li id="set_present2_2200641" class=" 2200641" onclick="set_attendance('2200641','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200641" class="active 2200641" onclick="set_attendance('2200641','set_absent_','A','');">A</li>
      <li id="set_leave_2200641" class=" 2200641" onclick="set_attendance('2200641','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;Anamika [Yash Kapoor][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200642" class="active 2200642" onclick="set_attendance('2200642','set_present_','P','');">P</li>
      <li id="set_present2_2200642" class=" 2200642" onclick="set_attendance('2200642','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200642" class=" 2200642" onclick="set_attendance('2200642','set_absent_','A','');">A</li>
      <li id="set_leave_2200642" class=" 2200642" onclick="set_attendance('2200642','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;Lalu Kumar [Raju Kumar][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200643" class="active 2200643" onclick="set_attendance('2200643','set_present_','P','0003757438');">P</li>
      <li id="set_present2_2200643" class=" 2200643" onclick="set_attendance('2200643','set_present2_','P/2','0003757438');">P/2</li>
      <li id="set_absent_2200643" class=" 2200643" onclick="set_attendance('2200643','set_absent_','A','0003757438');">A</li>
      <li id="set_leave_2200643" class=" 2200643" onclick="set_attendance('2200643','set_leave_','L','0003757438');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;payal [shyamlal][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200667" class="active 2200667" onclick="set_attendance('2200667','set_present_','P','');">P</li>
      <li id="set_present2_2200667" class=" 2200667" onclick="set_attendance('2200667','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200667" class=" 2200667" onclick="set_attendance('2200667','set_absent_','A','');">A</li>
      <li id="set_leave_2200667" class=" 2200667" onclick="set_attendance('2200667','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;Fig [Niraj Kumar ][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200788" class="active 2200788" onclick="set_attendance('2200788','set_present_','P','No');">P</li>
      <li id="set_present2_2200788" class=" 2200788" onclick="set_attendance('2200788','set_present2_','P/2','No');">P/2</li>
      <li id="set_absent_2200788" class=" 2200788" onclick="set_attendance('2200788','set_absent_','A','No');">A</li>
      <li id="set_leave_2200788" class=" 2200788" onclick="set_attendance('2200788','set_leave_','L','No');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;Prashant  [Rammu lal][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200868" class="active 2200868" onclick="set_attendance('2200868','set_present_','P','');">P</li>
      <li id="set_present2_2200868" class=" 2200868" onclick="set_attendance('2200868','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200868" class=" 2200868" onclick="set_attendance('2200868','set_absent_','A','');">A</li>
      <li id="set_leave_2200868" class=" 2200868" onclick="set_attendance('2200868','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;Prashant  [Rammu lal][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200869" class="active 2200869" onclick="set_attendance('2200869','set_present_','P','');">P</li>
      <li id="set_present2_2200869" class=" 2200869" onclick="set_attendance('2200869','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200869" class=" 2200869" onclick="set_attendance('2200869','set_absent_','A','');">A</li>
      <li id="set_leave_2200869" class=" 2200869" onclick="set_attendance('2200869','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;lalit  [harichandra ][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200946" class="active 2200946" onclick="set_attendance('2200946','set_present_','P','');">P</li>
      <li id="set_present2_2200946" class=" 2200946" onclick="set_attendance('2200946','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200946" class=" 2200946" onclick="set_attendance('2200946','set_absent_','A','');">A</li>
      <li id="set_leave_2200946" class=" 2200946" onclick="set_attendance('2200946','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         14.&nbsp;&nbsp;&nbsp;prash [rrmm][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200987" class="active 2200987" onclick="set_attendance('2200987','set_present_','P','');">P</li>
      <li id="set_present2_2200987" class=" 2200987" onclick="set_attendance('2200987','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200987" class=" 2200987" onclick="set_attendance('2200987','set_absent_','A','');">A</li>
      <li id="set_leave_2200987" class=" 2200987" onclick="set_attendance('2200987','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         15.&nbsp;&nbsp;&nbsp;Prashant  [rammu lal ][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201010" class="active 2201010" onclick="set_attendance('2201010','set_present_','P','');">P</li>
      <li id="set_present2_2201010" class=" 2201010" onclick="set_attendance('2201010','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201010" class=" 2201010" onclick="set_attendance('2201010','set_absent_','A','');">A</li>
      <li id="set_leave_2201010" class=" 2201010" onclick="set_attendance('2201010','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         16.&nbsp;&nbsp;&nbsp;Prashant  [rammu lal ][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201015" class="active 2201015" onclick="set_attendance('2201015','set_present_','P','');">P</li>
      <li id="set_present2_2201015" class=" 2201015" onclick="set_attendance('2201015','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201015" class=" 2201015" onclick="set_attendance('2201015','set_absent_','A','');">A</li>
      <li id="set_leave_2201015" class=" 2201015" onclick="set_attendance('2201015','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         17.&nbsp;&nbsp;&nbsp;Anamika Agrawal [Sushil Agrawal][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201069" class=" 2201069" onclick="set_attendance('2201069','set_present_','P','');">P</li>
      <li id="set_present2_2201069" class=" 2201069" onclick="set_attendance('2201069','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201069" class="active 2201069" onclick="set_attendance('2201069','set_absent_','A','');">A</li>
      <li id="set_leave_2201069" class=" 2201069" onclick="set_attendance('2201069','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         18.&nbsp;&nbsp;&nbsp;NIDHI SINGH  [Asad][7TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201081" class="active 2201081" onclick="set_attendance('2201081','set_present_','P','');">P</li>
      <li id="set_present2_2201081" class=" 2201081" onclick="set_attendance('2201081','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201081" class=" 2201081" onclick="set_attendance('2201081','set_absent_','A','');">A</li>
      <li id="set_leave_2201081" class=" 2201081" onclick="set_attendance('2201081','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class11" aria-expanded="false" aria-controls="collapseOne">
          11.&nbsp;&nbsp;&nbsp;8TH&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_8TH">S : ,</span>
		  <span onclick="mark_attendance('8TH','P');" style="color:rgb(16, 150, 24);" id="present_8TH">P : ,</span>
		  <span onclick="mark_attendance('8TH','A');" style="color:rgb(153, 0, 153);" id="absent_8TH">A : ,</span>
		  <span onclick="mark_attendance('8TH','L');" style="color:rgb(255, 153, 0);"id="leave_8TH">L : ,</span>
		  <span onclick="mark_attendance('8TH','');" style="color:rgb(220, 57, 18);" id="not_mark_8TH">N : </span>
		</div>
      </div>
      <div id="class11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Shifa Meman [Shabbir Meman][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200749" class=" 2200749" onclick="set_attendance('2200749','set_present_','P','');">P</li>
      <li id="set_present2_2200749" class=" 2200749" onclick="set_attendance('2200749','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200749" class=" 2200749" onclick="set_attendance('2200749','set_absent_','A','');">A</li>
      <li id="set_leave_2200749" class=" 2200749" onclick="set_attendance('2200749','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;Akshay [ABC][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200771" class=" 2200771" onclick="set_attendance('2200771','set_present_','P','0014816326');">P</li>
      <li id="set_present2_2200771" class=" 2200771" onclick="set_attendance('2200771','set_present2_','P/2','0014816326');">P/2</li>
      <li id="set_absent_2200771" class=" 2200771" onclick="set_attendance('2200771','set_absent_','A','0014816326');">A</li>
      <li id="set_leave_2200771" class=" 2200771" onclick="set_attendance('2200771','set_leave_','L','0014816326');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Gopi [BIKSHAM ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200783" class=" 2200783" onclick="set_attendance('2200783','set_present_','P','0005981246');">P</li>
      <li id="set_present2_2200783" class=" 2200783" onclick="set_attendance('2200783','set_present2_','P/2','0005981246');">P/2</li>
      <li id="set_absent_2200783" class=" 2200783" onclick="set_attendance('2200783','set_absent_','A','0005981246');">A</li>
      <li id="set_leave_2200783" class=" 2200783" onclick="set_attendance('2200783','set_leave_','L','0005981246');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;mahi [rohit kumar ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200805" class=" 2200805" onclick="set_attendance('2200805','set_present_','P','');">P</li>
      <li id="set_present2_2200805" class=" 2200805" onclick="set_attendance('2200805','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200805" class=" 2200805" onclick="set_attendance('2200805','set_absent_','A','');">A</li>
      <li id="set_leave_2200805" class=" 2200805" onclick="set_attendance('2200805','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;priya [kaml raj][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200817" class=" 2200817" onclick="set_attendance('2200817','set_present_','P','');">P</li>
      <li id="set_present2_2200817" class=" 2200817" onclick="set_attendance('2200817','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200817" class=" 2200817" onclick="set_attendance('2200817','set_absent_','A','');">A</li>
      <li id="set_leave_2200817" class=" 2200817" onclick="set_attendance('2200817','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;mahi [kaml raj][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200822" class=" 2200822" onclick="set_attendance('2200822','set_present_','P','');">P</li>
      <li id="set_present2_2200822" class=" 2200822" onclick="set_attendance('2200822','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200822" class=" 2200822" onclick="set_attendance('2200822','set_absent_','A','');">A</li>
      <li id="set_leave_2200822" class=" 2200822" onclick="set_attendance('2200822','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         7.&nbsp;&nbsp;&nbsp;penolope  [jonh][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200846" class=" 2200846" onclick="set_attendance('2200846','set_present_','P','');">P</li>
      <li id="set_present2_2200846" class=" 2200846" onclick="set_attendance('2200846','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200846" class=" 2200846" onclick="set_attendance('2200846','set_absent_','A','');">A</li>
      <li id="set_leave_2200846" class=" 2200846" onclick="set_attendance('2200846','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         8.&nbsp;&nbsp;&nbsp;jjlklkk [][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200856" class=" 2200856" onclick="set_attendance('2200856','set_present_','P','');">P</li>
      <li id="set_present2_2200856" class=" 2200856" onclick="set_attendance('2200856','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200856" class=" 2200856" onclick="set_attendance('2200856','set_absent_','A','');">A</li>
      <li id="set_leave_2200856" class=" 2200856" onclick="set_attendance('2200856','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         9.&nbsp;&nbsp;&nbsp;pooja bairagi [j. d. bairagi][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200871" class=" 2200871" onclick="set_attendance('2200871','set_present_','P','');">P</li>
      <li id="set_present2_2200871" class=" 2200871" onclick="set_attendance('2200871','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200871" class=" 2200871" onclick="set_attendance('2200871','set_absent_','A','');">A</li>
      <li id="set_leave_2200871" class=" 2200871" onclick="set_attendance('2200871','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         10.&nbsp;&nbsp;&nbsp;pooja bairagi [j. d. bairagi][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200872" class=" 2200872" onclick="set_attendance('2200872','set_present_','P','');">P</li>
      <li id="set_present2_2200872" class=" 2200872" onclick="set_attendance('2200872','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200872" class=" 2200872" onclick="set_attendance('2200872','set_absent_','A','');">A</li>
      <li id="set_leave_2200872" class=" 2200872" onclick="set_attendance('2200872','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         11.&nbsp;&nbsp;&nbsp;pooja bairagi [Mr. J.D. Bairagi][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200879" class=" 2200879" onclick="set_attendance('2200879','set_present_','P','');">P</li>
      <li id="set_present2_2200879" class=" 2200879" onclick="set_attendance('2200879','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200879" class=" 2200879" onclick="set_attendance('2200879','set_absent_','A','');">A</li>
      <li id="set_leave_2200879" class=" 2200879" onclick="set_attendance('2200879','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         12.&nbsp;&nbsp;&nbsp;Farhan khan [Riyaz khan][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200883" class=" 2200883" onclick="set_attendance('2200883','set_present_','P','0010317118');">P</li>
      <li id="set_present2_2200883" class=" 2200883" onclick="set_attendance('2200883','set_present2_','P/2','0010317118');">P/2</li>
      <li id="set_absent_2200883" class=" 2200883" onclick="set_attendance('2200883','set_absent_','A','0010317118');">A</li>
      <li id="set_leave_2200883" class=" 2200883" onclick="set_attendance('2200883','set_leave_','L','0010317118');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         13.&nbsp;&nbsp;&nbsp;Prashant [Rammu lal][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200910" class=" 2200910" onclick="set_attendance('2200910','set_present_','P','');">P</li>
      <li id="set_present2_2200910" class=" 2200910" onclick="set_attendance('2200910','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200910" class=" 2200910" onclick="set_attendance('2200910','set_absent_','A','');">A</li>
      <li id="set_leave_2200910" class=" 2200910" onclick="set_attendance('2200910','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         14.&nbsp;&nbsp;&nbsp;mahi [kaml raj][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200915" class=" 2200915" onclick="set_attendance('2200915','set_present_','P','');">P</li>
      <li id="set_present2_2200915" class=" 2200915" onclick="set_attendance('2200915','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200915" class=" 2200915" onclick="set_attendance('2200915','set_absent_','A','');">A</li>
      <li id="set_leave_2200915" class=" 2200915" onclick="set_attendance('2200915','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         15.&nbsp;&nbsp;&nbsp;riya [kaml raj][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200919" class=" 2200919" onclick="set_attendance('2200919','set_present_','P','');">P</li>
      <li id="set_present2_2200919" class=" 2200919" onclick="set_attendance('2200919','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200919" class=" 2200919" onclick="set_attendance('2200919','set_absent_','A','');">A</li>
      <li id="set_leave_2200919" class=" 2200919" onclick="set_attendance('2200919','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         16.&nbsp;&nbsp;&nbsp;Pooja bairagi  [Smt. Meenu bairagi][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200938" class=" 2200938" onclick="set_attendance('2200938','set_present_','P','');">P</li>
      <li id="set_present2_2200938" class=" 2200938" onclick="set_attendance('2200938','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200938" class=" 2200938" onclick="set_attendance('2200938','set_absent_','A','');">A</li>
      <li id="set_leave_2200938" class=" 2200938" onclick="set_attendance('2200938','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         17.&nbsp;&nbsp;&nbsp;rajkumar [Rammu lal][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200939" class=" 2200939" onclick="set_attendance('2200939','set_present_','P','');">P</li>
      <li id="set_present2_2200939" class=" 2200939" onclick="set_attendance('2200939','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200939" class=" 2200939" onclick="set_attendance('2200939','set_absent_','A','');">A</li>
      <li id="set_leave_2200939" class=" 2200939" onclick="set_attendance('2200939','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         18.&nbsp;&nbsp;&nbsp;priya [][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200942" class=" 2200942" onclick="set_attendance('2200942','set_present_','P','');">P</li>
      <li id="set_present2_2200942" class=" 2200942" onclick="set_attendance('2200942','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200942" class=" 2200942" onclick="set_attendance('2200942','set_absent_','A','');">A</li>
      <li id="set_leave_2200942" class=" 2200942" onclick="set_attendance('2200942','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         19.&nbsp;&nbsp;&nbsp;ashta  [sanjeev ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200945" class=" 2200945" onclick="set_attendance('2200945','set_present_','P','');">P</li>
      <li id="set_present2_2200945" class=" 2200945" onclick="set_attendance('2200945','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200945" class=" 2200945" onclick="set_attendance('2200945','set_absent_','A','');">A</li>
      <li id="set_leave_2200945" class=" 2200945" onclick="set_attendance('2200945','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         20.&nbsp;&nbsp;&nbsp;shikha  [rajendra ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200947" class=" 2200947" onclick="set_attendance('2200947','set_present_','P','');">P</li>
      <li id="set_present2_2200947" class=" 2200947" onclick="set_attendance('2200947','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200947" class=" 2200947" onclick="set_attendance('2200947','set_absent_','A','');">A</li>
      <li id="set_leave_2200947" class=" 2200947" onclick="set_attendance('2200947','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         21.&nbsp;&nbsp;&nbsp;Prashant  [rammu lal ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200957" class=" 2200957" onclick="set_attendance('2200957','set_present_','P','');">P</li>
      <li id="set_present2_2200957" class=" 2200957" onclick="set_attendance('2200957','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200957" class=" 2200957" onclick="set_attendance('2200957','set_absent_','A','');">A</li>
      <li id="set_leave_2200957" class=" 2200957" onclick="set_attendance('2200957','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         22.&nbsp;&nbsp;&nbsp;Prashant  [rammu lal ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200958" class=" 2200958" onclick="set_attendance('2200958','set_present_','P','');">P</li>
      <li id="set_present2_2200958" class=" 2200958" onclick="set_attendance('2200958','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200958" class=" 2200958" onclick="set_attendance('2200958','set_absent_','A','');">A</li>
      <li id="set_leave_2200958" class=" 2200958" onclick="set_attendance('2200958','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         23.&nbsp;&nbsp;&nbsp;kamalkant [vasudev dhakad][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200974" class=" 2200974" onclick="set_attendance('2200974','set_present_','P','');">P</li>
      <li id="set_present2_2200974" class=" 2200974" onclick="set_attendance('2200974','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200974" class=" 2200974" onclick="set_attendance('2200974','set_absent_','A','');">A</li>
      <li id="set_leave_2200974" class=" 2200974" onclick="set_attendance('2200974','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         24.&nbsp;&nbsp;&nbsp;Prashant  [rammu lal ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200976" class=" 2200976" onclick="set_attendance('2200976','set_present_','P','');">P</li>
      <li id="set_present2_2200976" class=" 2200976" onclick="set_attendance('2200976','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200976" class=" 2200976" onclick="set_attendance('2200976','set_absent_','A','');">A</li>
      <li id="set_leave_2200976" class=" 2200976" onclick="set_attendance('2200976','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         25.&nbsp;&nbsp;&nbsp;lokesh [sandeep][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200984" class=" 2200984" onclick="set_attendance('2200984','set_present_','P','');">P</li>
      <li id="set_present2_2200984" class=" 2200984" onclick="set_attendance('2200984','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200984" class=" 2200984" onclick="set_attendance('2200984','set_absent_','A','');">A</li>
      <li id="set_leave_2200984" class=" 2200984" onclick="set_attendance('2200984','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         26.&nbsp;&nbsp;&nbsp;Prashant  [rammu lal ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200989" class=" 2200989" onclick="set_attendance('2200989','set_present_','P','');">P</li>
      <li id="set_present2_2200989" class=" 2200989" onclick="set_attendance('2200989','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200989" class=" 2200989" onclick="set_attendance('2200989','set_absent_','A','');">A</li>
      <li id="set_leave_2200989" class=" 2200989" onclick="set_attendance('2200989','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         27.&nbsp;&nbsp;&nbsp;Prashant  [rammu lal ][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200990" class=" 2200990" onclick="set_attendance('2200990','set_present_','P','');">P</li>
      <li id="set_present2_2200990" class=" 2200990" onclick="set_attendance('2200990','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200990" class=" 2200990" onclick="set_attendance('2200990','set_absent_','A','');">A</li>
      <li id="set_leave_2200990" class=" 2200990" onclick="set_attendance('2200990','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         28.&nbsp;&nbsp;&nbsp;Prashant  [][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200992" class=" 2200992" onclick="set_attendance('2200992','set_present_','P','');">P</li>
      <li id="set_present2_2200992" class=" 2200992" onclick="set_attendance('2200992','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200992" class=" 2200992" onclick="set_attendance('2200992','set_absent_','A','');">A</li>
      <li id="set_leave_2200992" class=" 2200992" onclick="set_attendance('2200992','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         29.&nbsp;&nbsp;&nbsp;VEDANT TIWARI [MANOJ KUMAR TIWARI][8TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200993" class=" 2200993" onclick="set_attendance('2200993','set_present_','P','');">P</li>
      <li id="set_present2_2200993" class=" 2200993" onclick="set_attendance('2200993','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200993" class=" 2200993" onclick="set_attendance('2200993','set_absent_','A','');">A</li>
      <li id="set_leave_2200993" class=" 2200993" onclick="set_attendance('2200993','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class12" aria-expanded="false" aria-controls="collapseOne">
          12.&nbsp;&nbsp;&nbsp;9TH&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_9TH">S : ,</span>
		  <span onclick="mark_attendance('9TH','P');" style="color:rgb(16, 150, 24);" id="present_9TH">P : ,</span>
		  <span onclick="mark_attendance('9TH','A');" style="color:rgb(153, 0, 153);" id="absent_9TH">A : ,</span>
		  <span onclick="mark_attendance('9TH','L');" style="color:rgb(255, 153, 0);"id="leave_9TH">L : ,</span>
		  <span onclick="mark_attendance('9TH','');" style="color:rgb(220, 57, 18);" id="not_mark_9TH">N : </span>
		</div>
      </div>
      <div id="class12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;RAM PANDEY [KAMLESH PANDEY][9TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200633" class=" 2200633" onclick="set_attendance('2200633','set_present_','P','');">P</li>
      <li id="set_present2_2200633" class=" 2200633" onclick="set_attendance('2200633','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200633" class=" 2200633" onclick="set_attendance('2200633','set_absent_','A','');">A</li>
      <li id="set_leave_2200633" class=" 2200633" onclick="set_attendance('2200633','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;ashok [][9TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200737" class=" 2200737" onclick="set_attendance('2200737','set_present_','P','');">P</li>
      <li id="set_present2_2200737" class=" 2200737" onclick="set_attendance('2200737','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200737" class=" 2200737" onclick="set_attendance('2200737','set_absent_','A','');">A</li>
      <li id="set_leave_2200737" class=" 2200737" onclick="set_attendance('2200737','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;roma [][9TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200745" class=" 2200745" onclick="set_attendance('2200745','set_present_','P','');">P</li>
      <li id="set_present2_2200745" class=" 2200745" onclick="set_attendance('2200745','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200745" class=" 2200745" onclick="set_attendance('2200745','set_absent_','A','');">A</li>
      <li id="set_leave_2200745" class=" 2200745" onclick="set_attendance('2200745','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;Rohit [Ram kumar][9TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200836" class=" 2200836" onclick="set_attendance('2200836','set_present_','P','');">P</li>
      <li id="set_present2_2200836" class=" 2200836" onclick="set_attendance('2200836','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200836" class=" 2200836" onclick="set_attendance('2200836','set_absent_','A','');">A</li>
      <li id="set_leave_2200836" class=" 2200836" onclick="set_attendance('2200836','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;RAJESH CHOVE [MUKESH CHOVE][9TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201032" class=" 2201032" onclick="set_attendance('2201032','set_present_','P','');">P</li>
      <li id="set_present2_2201032" class=" 2201032" onclick="set_attendance('2201032','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201032" class=" 2201032" onclick="set_attendance('2201032','set_absent_','A','');">A</li>
      <li id="set_leave_2201032" class=" 2201032" onclick="set_attendance('2201032','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         6.&nbsp;&nbsp;&nbsp;aman soni 2 [ravi soni][9TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201078" class=" 2201078" onclick="set_attendance('2201078','set_present_','P','');">P</li>
      <li id="set_present2_2201078" class=" 2201078" onclick="set_attendance('2201078','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201078" class=" 2201078" onclick="set_attendance('2201078','set_absent_','A','');">A</li>
      <li id="set_leave_2201078" class=" 2201078" onclick="set_attendance('2201078','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class13" aria-expanded="false" aria-controls="collapseOne">
          13.&nbsp;&nbsp;&nbsp;10TH&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_10TH">S : ,</span>
		  <span onclick="mark_attendance('10TH','P');" style="color:rgb(16, 150, 24);" id="present_10TH">P : ,</span>
		  <span onclick="mark_attendance('10TH','A');" style="color:rgb(153, 0, 153);" id="absent_10TH">A : ,</span>
		  <span onclick="mark_attendance('10TH','L');" style="color:rgb(255, 153, 0);"id="leave_10TH">L : ,</span>
		  <span onclick="mark_attendance('10TH','');" style="color:rgb(220, 57, 18);" id="not_mark_10TH">N : </span>
		</div>
      </div>
      <div id="class13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;AUGUSTAY [ SHARMA][10TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201068" class=" 2201068" onclick="set_attendance('2201068','set_present_','P','');">P</li>
      <li id="set_present2_2201068" class=" 2201068" onclick="set_attendance('2201068','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201068" class=" 2201068" onclick="set_attendance('2201068','set_absent_','A','');">A</li>
      <li id="set_leave_2201068" class=" 2201068" onclick="set_attendance('2201068','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class14" aria-expanded="false" aria-controls="collapseOne">
          14.&nbsp;&nbsp;&nbsp;11TH&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_11TH">S : ,</span>
		  <span onclick="mark_attendance('11TH','P');" style="color:rgb(16, 150, 24);" id="present_11TH">P : ,</span>
		  <span onclick="mark_attendance('11TH','A');" style="color:rgb(153, 0, 153);" id="absent_11TH">A : ,</span>
		  <span onclick="mark_attendance('11TH','L');" style="color:rgb(255, 153, 0);"id="leave_11TH">L : ,</span>
		  <span onclick="mark_attendance('11TH','');" style="color:rgb(220, 57, 18);" id="not_mark_11TH">N : </span>
		</div>
      </div>
      <div id="class14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;RAJESH [TARACHANDRA][11TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100536" class=" 2100536" onclick="set_attendance('2100536','set_present_','P','');">P</li>
      <li id="set_present2_2100536" class=" 2100536" onclick="set_attendance('2100536','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100536" class=" 2100536" onclick="set_attendance('2100536','set_absent_','A','');">A</li>
      <li id="set_leave_2100536" class=" 2100536" onclick="set_attendance('2100536','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;SARIKA SULTANE [SANJAY][11TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2100609" class=" 2100609" onclick="set_attendance('2100609','set_present_','P','');">P</li>
      <li id="set_present2_2100609" class=" 2100609" onclick="set_attendance('2100609','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2100609" class=" 2100609" onclick="set_attendance('2100609','set_absent_','A','');">A</li>
      <li id="set_leave_2100609" class=" 2100609" onclick="set_attendance('2100609','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;MAHEK DASHORE [NAVIN KUMAR DASHORE][11TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200654" class=" 2200654" onclick="set_attendance('2200654','set_present_','P','');">P</li>
      <li id="set_present2_2200654" class=" 2200654" onclick="set_attendance('2200654','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200654" class=" 2200654" onclick="set_attendance('2200654','set_absent_','A','');">A</li>
      <li id="set_leave_2200654" class=" 2200654" onclick="set_attendance('2200654','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         4.&nbsp;&nbsp;&nbsp;aman soni [ravi soni][11TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201077" class=" 2201077" onclick="set_attendance('2201077','set_present_','P','');">P</li>
      <li id="set_present2_2201077" class=" 2201077" onclick="set_attendance('2201077','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201077" class=" 2201077" onclick="set_attendance('2201077','set_absent_','A','');">A</li>
      <li id="set_leave_2201077" class=" 2201077" onclick="set_attendance('2201077','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         5.&nbsp;&nbsp;&nbsp;amit [ram chandr][11TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2201079" class=" 2201079" onclick="set_attendance('2201079','set_present_','P','');">P</li>
      <li id="set_present2_2201079" class=" 2201079" onclick="set_attendance('2201079','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2201079" class=" 2201079" onclick="set_attendance('2201079','set_absent_','A','');">A</li>
      <li id="set_leave_2201079" class=" 2201079" onclick="set_attendance('2201079','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
			
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#class15" aria-expanded="false" aria-controls="collapseOne">
          15.&nbsp;&nbsp;&nbsp;12TH&nbsp;&nbsp;[A]
		 
        </a>
      </h4>
		<div style="padding-left:50px;" id="clas_student">
		  <span style="color:rgb(51, 102, 204);" id="strength_12TH">S : ,</span>
		  <span onclick="mark_attendance('12TH','P');" style="color:rgb(16, 150, 24);" id="present_12TH">P : ,</span>
		  <span onclick="mark_attendance('12TH','A');" style="color:rgb(153, 0, 153);" id="absent_12TH">A : ,</span>
		  <span onclick="mark_attendance('12TH','L');" style="color:rgb(255, 153, 0);"id="leave_12TH">L : ,</span>
		  <span onclick="mark_attendance('12TH','');" style="color:rgb(220, 57, 18);" id="not_mark_12TH">N : </span>
		</div>
      </div>
      <div id="class15" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		        <div class="panel-body">
         1.&nbsp;&nbsp;&nbsp;Ram [Bca][12TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200757" class=" 2200757" onclick="set_attendance('2200757','set_present_','P','');">P</li>
      <li id="set_present2_2200757" class=" 2200757" onclick="set_attendance('2200757','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200757" class=" 2200757" onclick="set_attendance('2200757','set_absent_','A','');">A</li>
      <li id="set_leave_2200757" class=" 2200757" onclick="set_attendance('2200757','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         2.&nbsp;&nbsp;&nbsp;Ravi [][12TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200762" class=" 2200762" onclick="set_attendance('2200762','set_present_','P','');">P</li>
      <li id="set_present2_2200762" class=" 2200762" onclick="set_attendance('2200762','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200762" class=" 2200762" onclick="set_attendance('2200762','set_absent_','A','');">A</li>
      <li id="set_leave_2200762" class=" 2200762" onclick="set_attendance('2200762','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		        <div class="panel-body">
         3.&nbsp;&nbsp;&nbsp;Abdul sami  [Mohd Sharif ][12TH (A)]		 <label style="float:right;">
	<div class="dropdown">
    <span class="dropdown-toggle" data-toggle="dropdown" id="hover_hand"><i class="fa fa-sort-desc" style="font-size:20px"></i></span>
    <ul class="dropdown-menu" id="default_dropdown">
      <li id="set_present_2200854" class=" 2200854" onclick="set_attendance('2200854','set_present_','P','');">P</li>
      <li id="set_present2_2200854" class=" 2200854" onclick="set_attendance('2200854','set_present2_','P/2','');">P/2</li>
      <li id="set_absent_2200854" class=" 2200854" onclick="set_attendance('2200854','set_absent_','A','');">A</li>
      <li id="set_leave_2200854" class=" 2200854" onclick="set_attendance('2200854','set_leave_','L','');">L</li>
    </ul>
  </div>
		 </label>
        </div>
		      </div>
    </div>
    
  </div>
 
  
			</div>
			
			<div class="col-md-6">
			<div class="col-md-12" id="attendance_chart"></div>
			<div class="col-md-12" id="classwise_chart">
			
			</div>
			</div>
			
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

      
<!---******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

<!-- Modal Start -->
<button type="button" style="display:none;" id="my_model" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
<form method="post" enctype="multipart/form-data" id="my_form">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="modal_close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Mark / Unmark</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12" id="mark_details" style="max-height:500px;overflow-y:auto;">
		  
		  </div>
        </div>
        <div class="modal-footer">
          <input type="button" onclick="form_submit();" value="Save" class="btn btn-primary" />&nbsp;&nbsp;
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</form>
<!-- Modal End -->


<script>
graphic_detail();
strengths();
another_chart();
</script>
