
<script type="text/javascript">
	function student_detail(value){
	$("#student_name1").val("Loading....");
	$("#student_adress1").val("Loading....");
	$("#student_father_contact_no1").val("Loading....");
	$("#student_roll_no1").val("Loading....");
	$.ajax({
	address: "POST",
	url: access_link+"account/ajax_search_student_details.php?id="+value+"",
	cache: false,
	success: function(detail){
	var str =detail;
	var res = str.split("|?|");
	$("#student_name1").val(res[0]);
	$("#student_adress1").val(res[1]);
	$("#student_father_contact_no1").val(res[2]);
	$("#student_roll_no1").val(res[3]);
	}
	});
	}
</script> 
<script type="text/javascript">
    function account_cust(value){
        
        $('#student_name1').val(value);
    }
    
</script>

<script type="text/javascript">
    function account_cust1(value){
        
        $('#student_name11').val(value);
    }
    
</script>
<script type="text/javascript">
	function staff_detail(value){
	$("#student_name1").val("Loading...."); 
	$("#student_adress1").val("Loading...."); 
	$("#student_father_contact_no1").val("Loading....");  
    $("#student_roll_no1").val("Loading....");
    $("#designation").val("Loading....");
	$.ajax({
	address: "POST",
	url: access_link+"account/ajax_search_staff_details.php?id="+value+"",
	cache: false,
	success: function(detail){
	var str =detail;
	var res = str.split("|?|");
	$("#student_name1").val(res[0]); 
	$("#student_adress1").val(res[1]); 
	$("#student_father_contact_no1").val(res[2]);  
    $("#student_roll_no1").val(res[3]);
    $("#designation").val(res[4]);
	}
	});
	}
</script> 

<script>
$( document ).ready(function() { 
party_select('Other');
});
function party_select(value){
$("#div_other_or_advance").hide();
$("#other_or_advance").val('').change();
if(value=='Student'){
	$("#student_name1").val(''); 
	$("#student_adress1").val('');
	$("#student_father_contact_no1").val('');  
    $("#student_roll_no1").val('');
    $("#designation").val('');
$('#student_select').show();
$('#staff_select').hide();
$('#cust_select').hide();
$('#staff_designation').hide();
$('#student_name1').prop("readonly", true);
$('#student_adress1').prop("readonly", true);
$('#student_father_contact_no1').prop("readonly", true);
$('#staff_select1').prop("required", false);
$('#student_select1').prop("required", true);
}else if(value=='Staff'){
    
    $("#div_other_or_advance").show();
    
	$("#student_name1").val('');
	$("#student_adress1").val('');
	$("#student_father_contact_no1").val('');  
    $("#student_roll_no1").val('');
    $("#designation").val('');
$('#staff_select').show();
$('#staff_designation').show();
$('#student_select').hide();
$('#cust_select').hide();
$('#student_name1').prop("readonly", true);
$('#student_adress1').prop("readonly", true);
$('#student_father_contact_no1').prop("readonly", true);
$('#designation').prop("readonly", true);
$('#staff_select1').prop("required", true);
$('#student_select1').prop("required", false);
}else{
	$("#student_name1").val(''); 
	$("#student_adress1").val('');
	$("#student_father_contact_no1").val('');  
    $("#student_roll_no1").val('');
    $("#designation").val('');
$('#staff_select').hide();
$('#cust_select').show();
$('#student_select').hide();
$('#staff_designation').hide();
$('#student_name1').prop("readonly", false);
$('#student_adress1').prop("readonly", false);
$('#student_father_contact_no1').prop("readonly", false);
$('#staff_select1').prop("required", false);
$('#student_select1').prop("required", false);
}
}

function for_advance(value){
    $("#advance_amount").val('');
    $("#advance_installment").val('');
    if(value=='Advance'){
    $("#div_advance_amount").show();
    $("#div_advance_installment").show();
    }else{
    $("#div_advance_amount").hide();
    $("#div_advance_installment").hide();
    }
}

function same_amount(value,id){
    var prty_type=$("input[name='account_party_type']:checked").val();
    if(prty_type=='Staff'){
    $("#"+id).val(value);
    }
    for_inst();
}

function for_inst(){
    var main=document.getElementById('advance_amount').value;
    var inst=document.getElementById('advance_installment').value;
    if(Number(inst)>Number(main)){
    alert_new("Please Enter Valid Installment Amount !!!",'red');
    $("#advance_installment").val('');
    }
}
</script>
<script>
function payment_mode(value){
if(value=='Cheque'){
$('#for_cheque_date').show();
$('#for_cheque_no').show();
$('#for_cheque_name').show();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
}else if(value=='NEFT'){
$('#for_neft_account_no').show();
$('#for_neft_bank_name').show();
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
}else{
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
}
}
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"account/add_income_or_expence_info _api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
		
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				  // $("#123").html(detail);
				 alert_new('Successfully Complete','green');
				 get_content('account/income_or_expence_list');
            }else if(res[1]=='session_not_set'){
                alert_new('Session Expire !!!','red');
            }
			}
         });
      });
</script>  
	
    <section class="content-header">
      <h3>
        Account Management					<small>Control Panel</small>
      </h3>
      <ol class="breadcrumb">
        	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i>Account</a></li>
		<li><a href="javascript:get_content('account/income_or_expence_list')"><i class="fa fa-list"></i>List</a></li>
		<li class="active">Account Info</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-warning  ">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data" id="my_form">
			    <div class="col-md-2">				
					<div class="form-group">
					  <label>Amount Type</label>
					    <select name="account_amount_type" class="form-control" required >
					    <option value="">Select</option>
					    <option value="Debit">Debit</option>
					    <option value="Credit">Credit</option>
					    </select>
					</div>
				</div>
				
				
				
								
					<div class="col-md-3">				
					<div class="form-group">
					  <label>Office Account</label>
					    <select name="office_account_info" class="form-control" >
					    <option value="">Select</option>
					    					    <option value="50">Monika rathore ( 9896384654 )</option>
					    					    <option value="51">nidhi ( 98789787667 )</option>
					    					    <option value="52">Monika rathore ( 757415815 )</option>
					    					    <option value="53">kanhar valley public school ( 7740047 )</option>
					    					    <option value="54">NIDHI SINGH ( 1524624524515 )</option>
					    					    <option value="56">Rajat Sharma  ( 45789654123541 )</option>
					    					    <option value="57">Pokhari ( 100 )</option>
					    					    <option value="58">Laxman ( 1010 )</option>
					    					    <option value="59">Jalgaon Jamod Secondary and Higher Secondary School ( 123456789012345 )</option>
					    					    <option value="60">hemant ( 987654321456987 )</option>
					    					    <option value="61">Sushil ( 89878767655555555 )</option>
					    					    <option value="62">abc ( 12345 )</option>
					    					    <option value="63">aaaa ( 1111 )</option>
					    					    </select>
					</div>
				</div>
				
								
				
				
                <div class="col-md-4">					
					<div class="form-group">
					  <label>Party Type</label><br>
						<div class="form-control">
							<input type="radio" name="account_party_type" id="" value="Other" onclick="party_select(this.value);" checked >&nbsp;&nbsp;<b>Other</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="account_party_type" id="" onclick="party_select(this.value);" value="Staff">&nbsp;&nbsp;<b>Staff</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="account_party_type" id="" onclick="party_select(this.value);" value="Student">&nbsp;&nbsp;<b>Student</b>
					    </div>
					</div>
				</div>
				
				<div class="col-md-2" style="display:none;" id="div_other_or_advance">					
					<div class="form-group">
					  <label>Other Or Advance</label>
					    <select name="other_or_advance" id="other_or_advance" onchange="for_advance(this.value);" class="form-control" >
					    <option value="">Other</option>
					    <option value="Advance">Advance</option>
					    </select>
					</div>
				</div>
				<div class="col-md-2" style="display:none;" id="div_advance_amount">					
					<div class="form-group">
					  <label>Advance Amount</label>
					    <input type="text" name="advance_amount" id="advance_amount" oninput="same_amount(this.value,'account_customer_total_amount');" class="form-control" />
					</div>
				</div>
				<div class="col-md-2" style="display:none;" id="div_advance_installment">					
					<div class="form-group">
					  <label>Advance Installment</label>
					    <input type="text" name="advance_installment" id="advance_installment" oninput="for_inst();" class="form-control" />
					</div>
				</div>
				
				<div class="col-md-4" style="display:none" id="student_select">				
					<div class="form-group">
					  <label>Student Select</label>
					    <select name="account_student_select" class="form-control select2" id="student_select1" onchange="student_detail(this.value);" required style="width:100%">
					    <option value="">Select</option>
					        							<option value="2000298">Umesh[2000298]-[2ND-B]-[Rajesh]</option>
														<option value="2000314">Rajesh Prasad[2000314]-[2ND-B]-[Ananda Prasad]</option>
														<option value="2000332">Palak Kumari[2000332]-[2ND-B]-[Krishna Sahani]</option>
														<option value="2000345">joy[2000345]-[3RD-A]-[peter]</option>
														<option value="2100412">Upen[2100412]-[3RD-A]-[Rajdev Mishra]</option>
														<option value="2100414">Saurya[2100414]-[4TH-A]-[Sanjeev Kumar]</option>
														<option value="2100415">dummy[2100415]-[2ND-B]-[dummy father ]</option>
														<option value="2100427">Akhil[2100427]-[2ND-A]-[Mr. Manoj]</option>
														<option value="2100430">Sangita[2100430]-[UKG-A]-[Ramji]</option>
														<option value="2100437">cddf[2100437]-[3RD-A]-[]</option>
														<option value="2100450">umesh  dhakad[2100450]-[UKG-A]-[mr  ramgopal dhakad]</option>
														<option value="2100451">Humaira[2100451]-[UKG-A]-[Palash]</option>
														<option value="2100458">ayush koli[2100458]-[UKG-A]-[prabhu dayal]</option>
														<option value="2100470">ajay kewat[2100470]-[3RD-A]-[durga kewat]</option>
														<option value="2100471">Aman[2100471]-[4TH-A]-[Asad]</option>
														<option value="2100474">raja[2100474]-[3RD-A]-[raja]</option>
														<option value="2100520">Nikhil  Lodhi[2100520]-[4TH-A]-[Mayank Lodhi]</option>
														<option value="2100536">RAJESH[2100536]-[11TH-A]-[TARACHANDRA]</option>
														<option value="2100537">Vaidik[2100537]-[5TH-A]-[]</option>
														<option value="2100538">Diviya prajapati[2100538]-[4TH-A]-[Shrawan Ram]</option>
														<option value="2100541">Sagar Singh[2100541]-[7TH-A]-[Rakesh Singh]</option>
														<option value="2100544">Jidan uddin[2100544]-[1ST-A]-[riyaz uddin]</option>
														<option value="2100549">Avnish kumar[2100549]-[2ND-A]-[Gopal kumar]</option>
														<option value="2100553">umesh [2100553]-[UKG-A]-[abhishek]</option>
														<option value="2100561">umesh [2100561]-[6TH-A]-[]</option>
														<option value="2100563">umesh [2100563]-[5TH-A]-[]</option>
														<option value="2100571">Anshu[2100571]-[UKG-A]-[Vijay]</option>
														<option value="2100575"> BABALI SAHU[2100575]-[UKG-A]-[SHAIKH]</option>
														<option value="2100583">श्री[2100583]-[2ND-A]-[दीपक]</option>
														<option value="2100585">Muhammed Adnan[2100585]-[4TH-A]-[Muhammed Afnan]</option>
														<option value="2100589">hari[2100589]-[2ND-A]-[hani]</option>
														<option value="2100601">Nidhi Mishra[2100601]-[UKG-A]-[Nidhi Mishra]</option>
														<option value="2100609">SARIKA SULTANE[2100609]-[11TH-A]-[SANJAY]</option>
														<option value="2200612">dummy[2200612]-[2ND-A]-[dummy father ]</option>
														<option value="2200614">balveer singh[2200614]-[LKG-A]-[sukhvinder singh]</option>
														<option value="2200615">mahira khan[2200615]-[LKG-A]-[irfan khan]</option>
														<option value="2200618">sanny[2200618]-[LKG-A]-[soham]</option>
														<option value="2200622">rohan sah[2200622]-[2ND-A]-[ram ]</option>
														<option value="2200623">ishan kumar[2200623]-[2ND-A]-[rohit kumar]</option>
														<option value="2200624">pankaj patel[2200624]-[6TH-A]-[ram ]</option>
														<option value="2200626">kirti panday[2200626]-[LKG-A]-[sumit panday]</option>
														<option value="2200627">lali[2200627]-[LKG-A]-[]</option>
														<option value="2200628">sushant singh[2200628]-[UKG-A]-[nilkamal singh ]</option>
														<option value="2200629">saloni[2200629]-[2ND-A]-[bijay]</option>
														<option value="2200630">suman[2200630]-[6TH-A]-[bijay]</option>
														<option value="2200632">MANVEER SINGH [2200632]-[7TH-A]-[GURDEV SINGH ]</option>
														<option value="2200633">RAM PANDEY[2200633]-[9TH-A]-[KAMLESH PANDEY]</option>
														<option value="2200634">Mayur Mangesh Padvi[2200634]-[2ND-A]-[Mangesh Gorakh Padvi]</option>
														<option value="2200635">Bhavesh Arvind Padvi[2200635]-[2ND-A]-[Arvind Gorakh Padvi]</option>
														<option value="2200636">Nikhil Dinesh Padvi[2200636]-[2ND-A]-[Dinesh Gorakh Padvi]</option>
														<option value="2200637">Kiran Sharma[2200637]-[7TH-A]-[Ramu Sharma]</option>
														<option value="2200638">Riya Sharma[2200638]-[7TH-A]-[Ram Sharma]</option>
														<option value="2200640">Meena Verma[2200640]-[7TH-A]-[Jay Verma]</option>
														<option value="2200641">Heena Mittal[2200641]-[7TH-A]-[Lalu Pasad]</option>
														<option value="2200642">Anamika[2200642]-[7TH-A]-[Yash Kapoor]</option>
														<option value="2200643">Lalu Kumar[2200643]-[7TH-A]-[Raju Kumar]</option>
														<option value="2200644">SK Thakur[2200644]-[UKG-A]-[Aasss]</option>
														<option value="2200645">abcs[2200645]-[2ND-A]-[ebgh]</option>
														<option value="2200646">Jay Sharma[2200646]-[UKG-A]-[Harsh Sharma]</option>
														<option value="2200647">Sikdar[2200647]-[UKG-A]-[]</option>
														<option value="2200648">Bijoy[2200648]-[UKG-A]-[ajoy]</option>
														<option value="2200650">sona[2200650]-[2ND-A]-[rajesh]</option>
														<option value="2200651">RIYA DAS[2200651]-[UKG-A]-[RATAN DAS]</option>
														<option value="2200652">SUMIT KUMAR[2200652]-[UKG-A]-[Anil kumar ]</option>
														<option value="2200653">Somya[2200653]-[UKG-A]-[]</option>
														<option value="2200654">MAHEK DASHORE[2200654]-[11TH-A]-[NAVIN KUMAR DASHORE]</option>
														<option value="2200656">Radha Kumari[2200656]-[UKG-A]-[Ram Kumar]</option>
														<option value="2200657">ARPAN NANDEWAR[2200657]-[UKG-A]-[RAM NANDEWAR]</option>
														<option value="2200659">mahir khan [2200659]-[4TH-A]-[javed khan ]</option>
														<option value="2200661">imran khan [2200661]-[4TH-A]-[waseem khan ]</option>
														<option value="2200662">sajid khan [2200662]-[2ND-A]-[javed khan]</option>
														<option value="2200663">dummy [2200663]-[2ND-A]-[dummy father]</option>
														<option value="2200665">dishika[2200665]-[6TH-A]-[sonu khatri ]</option>
														<option value="2200666">Bhavesh Arvind Padvi[2200666]-[UKG-A]-[]</option>
														<option value="2200667">payal[2200667]-[7TH-A]-[shyamlal]</option>
														<option value="2200668">SAJAL[2200668]-[4TH-A]-[]</option>
														<option value="2200669">sarita[2200669]-[6TH-A]-[ramjee Gupta]</option>
														<option value="2200671">Komal Gupta[2200671]-[2ND-A]-[Pramod Gupta]</option>
														<option value="2200672">Anil Kumar[2200672]-[4TH-A]-[]</option>
														<option value="2200674">Anil Kapoor Dhoom[2200674]-[2ND-A]-[]</option>
														<option value="2200675">Prashant [2200675]-[2ND-A]-[Rammu lal]</option>
														<option value="2200677">RAJ[2200677]-[2ND-A]-[rajesh]</option>
														<option value="2200678">himanshi[2200678]-[UKG-A]-[babl]</option>
														<option value="2200679">Ram[2200679]-[5TH-A]-[Lala seth]</option>
														<option value="2200680">Prashant Kumar[2200680]-[5TH-A]-[Rammu]</option>
														<option value="2200681">GGDFGFDGFDG[2200681]-[UKG-A]-[]</option>
														<option value="2200684">ABHISHEK [2200684]-[UKG-A]-[B L YADAV]</option>
														<option value="2200685">XYZ[2200685]-[2ND-A]-[XYZ]</option>
														<option value="2200686">abc[2200686]-[2ND-A]-[]</option>
														<option value="2200687">rahul[2200687]-[2ND-A]-[]</option>
														<option value="2200688">Prashant rajak[2200688]-[2ND-A]-[Rammu lal]</option>
														<option value="2200689"> Kanika[2200689]-[UKG-A]-[]</option>
														<option value="2200691">Ravi[2200691]-[UKG-A]-[xyz]</option>
														<option value="2200692">Prashant kumar[2200692]-[2ND-A]-[Rammu lal]</option>
														<option value="2200693">RAHUL[2200693]-[UKG-A]-[XYC]</option>
														<option value="2200695">praveen kumar[2200695]-[1ST-A]-[]</option>
														<option value="2200698">bjkb[2200698]-[2ND-A]-[kllkdv]</option>
														<option value="2200699">laxmi[2200699]-[2ND-A]-[venkat]</option>
														<option value="2200702">AJAY[2200702]-[2ND-A]-[SUNIL]</option>
														<option value="2200707">kunal jha[2200707]-[UKG-A]-[]</option>
														<option value="2200708">fgdfg[2200708]-[UKG-A]-[dfgdf]</option>
														<option value="2200709">DISHANT PATIDAR[2200709]-[6TH-A]-[]</option>
														<option value="2200710">vishal jha[2200710]-[UKG-A]-[]</option>
														<option value="2200713">Ram[2200713]-[4TH-A]-[]</option>
														<option value="2200714">vishal jha[2200714]-[UKG-A]-[]</option>
														<option value="2200715">Prashant kumar[2200715]-[1ST-A]-[babl]</option>
														<option value="2200716">AS[2200716]-[3RD-A]-[SS]</option>
														<option value="2200717">muskan ray[2200717]-[UKG-A]-[roshan ray]</option>
														<option value="2200719">Prashant  KUMAR[2200719]-[5TH-A]-[Rammu lal]</option>
														<option value="2200720">xghkjh[2200720]-[LKG-A]-[Anil]</option>
														<option value="2200722">सौरभ[2200722]-[2ND-A]-[sunil  jain]</option>
														<option value="2200723">aashu [2200723]-[3RD-A]-[]</option>
														<option value="2200724">SANJAY KUMAR[2200724]-[UKG-A]-[manoj pandey]</option>
														<option value="2200725">Rahul kumar[2200725]-[5TH-A]-[vijay singh]</option>
														<option value="2200728">saloni karn[2200728]-[2ND-A]-[bijay karn]</option>
														<option value="2200729">sushant karn[2200729]-[UKG-A]-[bijay karn]</option>
														<option value="2200730">sanam karn[2200730]-[LKG-A]-[bijay karn]</option>
														<option value="2200731">simran[2200731]-[5TH-A]-[PRAKASH PATIDAR]</option>
														<option value="2200732">APEKSHIT KOLI[2200732]-[2ND-A]-[MANOJ KUMAR KOLI]</option>
														<option value="2200733">Akshay Karande[2200733]-[LKG-A]-[NILESH PATIDAR]</option>
														<option value="2200734">Rituraj[2200734]-[2ND-A]-[mitu raj]</option>
														<option value="2200735">Aaditya [2200735]-[2ND-A]-[Sujit]</option>
														<option value="2200737">ashok[2200737]-[9TH-A]-[]</option>
														<option value="2200738">mayank[2200738]-[LKG-A]-[demo]</option>
														<option value="2200740">ashok[2200740]-[2ND-A]-[]</option>
														<option value="2200741">Abhay[2200741]-[UKG-A]-[]</option>
														<option value="2200742">vivek[2200742]-[2ND-A]-[]</option>
														<option value="2200743">abhisek[2200743]-[1ST-A]-[]</option>
														<option value="2200744">bbs[2200744]-[2ND-A]-[bbs]</option>
														<option value="2200745">roma[2200745]-[9TH-A]-[]</option>
														<option value="2200746">ravi[2200746]-[2ND-A]-[udham]</option>
														<option value="2200747">Vaishnavi Thakur[2200747]-[LKG-A]-[Mr. Amrendra Pratap Singh ]</option>
														<option value="2200748">AADITYA JHILLE[2200748]-[2ND-A]-[AASHISH JHILLE]</option>
														<option value="2200749">Shifa Meman[2200749]-[8TH-A]-[Shabbir Meman]</option>
														<option value="2200750">ROHIT KUMAR[2200750]-[2ND-A]-[DOODH NATH YADAV]</option>
														<option value="2200751">Prashant  KUMAR[2200751]-[2ND-A]-[Rammu lal]</option>
														<option value="2200752">Urvi sen[2200752]-[LKG-A]-[Prabhash sen]</option>
														<option value="2200753">Akshaj Mishra[2200753]-[3RD-A]-[shesh Narayan Mishra]</option>
														<option value="2200755">priya[2200755]-[4TH-A]-[rahul mehara]</option>
														<option value="2200756">RAJESH KUMAR MAHTO [2200756]-[6TH-A]-[SITA RAM MAHTO ]</option>
														<option value="2200757">Ram[2200757]-[12TH-A]-[Bca]</option>
														<option value="2200758">Aashish[2200758]-[NURSERY-A]-[Ramesh]</option>
														<option value="2200759">INAMUR RAHMAN[2200759]-[LKG-A]-[ATIKUR RAHMAN]</option>
														<option value="2200760">nidhi jain [2200760]-[3RD-A]-[sunil  jain]</option>
														<option value="2200761">rakesh[2200761]-[LKG-A]-[]</option>
														<option value="2200762">Ravi[2200762]-[12TH-A]-[]</option>
														<option value="2200763">VINAYAK PATIDAR[2200763]-[5TH-A]-[rahul mehara]</option>
														<option value="2200765">RAJ  NAYK [2200765]-[6TH-A]-[GOPAL KHATRI]</option>
														<option value="2200767">Praashant [2200767]-[5TH-A]-[rammulal]</option>
														<option value="2200770">raman[2200770]-[NURSERY-A]-[tapan]</option>
														<option value="2200771">Akshay[2200771]-[8TH-A]-[ABC]</option>
														<option value="2200772">Prashant r[2200772]-[5TH-A]-[rahul mehara ]</option>
														<option value="2200776">nidhi jain [2200776]-[4TH-A]-[sunil  jain]</option>
														<option value="2200779">sunil 1[2200779]-[2ND-A]-[Asad]</option>
														<option value="2200780">Nikhil[2200780]-[UKG-A]-[jonh]</option>
														<option value="2200782">yashi[2200782]-[NURSERY-A]-[pushpendra]</option>
														<option value="2200783">Gopi[2200783]-[8TH-A]-[BIKSHAM ]</option>
														<option value="2200785">ABHIMANYU SHARMA[2200785]-[NURSERY-A]-[GOURAV SHARMA]</option>
														<option value="2200786">AVNI SHARMA[2200786]-[2ND-A]-[SOURABH SHARMA]</option>
														<option value="2200788">Fig[2200788]-[7TH-A]-[Niraj Kumar ]</option>
														<option value="2200790">shree[2200790]-[NURSERY-A]-[samay singh ]</option>
														<option value="2200791">shreyansh[2200791]-[1ST-A]-[Neeraj kumar]</option>
														<option value="2200793">Ajay[2200793]-[NURSERY-A]-[Vijay]</option>
														<option value="2200795">Druwa Ganesh Chaudhari[2200795]-[NURSERY-A]-[Ganesh Chaudhari]</option>
														<option value="2200796">SONU PRAJAPATI[2200796]-[2ND-A]-[LALARAM PRAJAPATI]</option>
														<option value="2200797">Md alam ali [2200797]-[UKG-A]-[Ali alam]</option>
														<option value="2200798">dummy [2200798]-[2ND-A]-[dummy]</option>
														<option value="2200799">TABREZ ALAM[2200799]-[2ND-A]-[BAKRIDAN ANSARI]</option>
														<option value="2200800">SHIVANSH RAWAT[2200800]-[NURSERY-A]-[AJAY]</option>
														<option value="2200805">mahi[2200805]-[8TH-A]-[rohit kumar ]</option>
														<option value="2200806">mahi[2200806]-[UKG-A]-[ram singh ]</option>
														<option value="2200810">shahnawaz[2200810]-[1ST-A]-[]</option>
														<option value="2200811">yasin[2200811]-[1ST-A]-[]</option>
														<option value="2200812">sultana[2200812]-[1ST-A]-[]</option>
														<option value="2200814">pragya [2200814]-[6TH-A]-[rajesh]</option>
														<option value="2200817">priya[2200817]-[8TH-A]-[kaml raj]</option>
														<option value="2200822">mahi[2200822]-[8TH-A]-[kaml raj]</option>
														<option value="2200823">Yash [2200823]-[NURSERY-A]-[Soun]</option>
														<option value="2200827">jeet kumar[2200827]-[6TH-A]-[amit kumar ]</option>
														<option value="2200831">PANKAJ KUMAR[2200831]-[2ND-A]-[UPENDRA SHARMA]</option>
														<option value="2200836">Rohit[2200836]-[9TH-A]-[Ram kumar]</option>
														<option value="2200841">vicky uikey[2200841]-[1ST-A]-[jitendrasingh uikey]</option>
														<option value="2200846">penolope [2200846]-[8TH-A]-[jonh]</option>
														<option value="2200854">Abdul sami [2200854]-[12TH-A]-[Mohd Sharif ]</option>
														<option value="2200856">jjlklkk[2200856]-[8TH-A]-[]</option>
														<option value="2200861">VINAYAK PATIDAR[2200861]-[2ND-A]-[SUNIL RAI]</option>
														<option value="2200864">NIDHI SINGH[2200864]-[5TH-A]-[RAMRAJ]</option>
														<option value="2200868">Prashant [2200868]-[7TH-A]-[Rammu lal]</option>
														<option value="2200869">Prashant [2200869]-[7TH-A]-[Rammu lal]</option>
														<option value="2200871">pooja bairagi[2200871]-[8TH-A]-[j. d. bairagi]</option>
														<option value="2200872">pooja bairagi[2200872]-[8TH-A]-[j. d. bairagi]</option>
														<option value="2200879">pooja bairagi[2200879]-[8TH-A]-[Mr. J.D. Bairagi]</option>
														<option value="2200883">Farhan khan[2200883]-[8TH-A]-[Riyaz khan]</option>
														<option value="2200884">पंकज कुमार[2200884]-[NURSERY-A]-[लालू राम]</option>
														<option value="2200886">Mafidul Islam[2200886]-[6TH-A]-[Ali]</option>
														<option value="2200901">neha parihar [2200901]-[UKG-A]-[himanshu parihar ]</option>
														<option value="2200910">Prashant[2200910]-[8TH-A]-[Rammu lal]</option>
														<option value="2200915">mahi[2200915]-[8TH-A]-[kaml raj]</option>
														<option value="2200918">mansha[2200918]-[UKG-A]-[]</option>
														<option value="2200919">riya[2200919]-[8TH-A]-[kaml raj]</option>
														<option value="2200927">VINAYAK PATIDAR[2200927]-[2ND-A]-[RAJENDRA PATIDAR]</option>
														<option value="2200931">ArhN[2200931]-[5TH-A]-[Arqam]</option>
														<option value="2200933">Ariz[2200933]-[UKG-A]-[]</option>
														<option value="2200934">Ariz[2200934]-[UKG-A]-[]</option>
														<option value="2200936">vicky uikey[2200936]-[2ND-A]-[jitendra singh uikey]</option>
														<option value="2200937">Chirag jatav[2200937]-[1ST-A]-[MR.Arjun jatav]</option>
														<option value="2200938">Pooja bairagi [2200938]-[8TH-A]-[Smt. Meenu bairagi]</option>
														<option value="2200939">rajkumar[2200939]-[8TH-A]-[Rammu lal]</option>
														<option value="2200942">priya[2200942]-[8TH-A]-[]</option>
														<option value="2200943">Md. Mokarram alam [2200943]-[UKG-A]-[Md. Siddique alam ]</option>
														<option value="2200945">ashta [2200945]-[8TH-A]-[sanjeev ]</option>
														<option value="2200946">lalit [2200946]-[7TH-A]-[harichandra ]</option>
														<option value="2200947">shikha [2200947]-[8TH-A]-[rajendra ]</option>
														<option value="2200948">SANDEEP[2200948]-[LKG-A]-[PRATHAM SINGH]</option>
														<option value="2200951">Vansh Kumar Pasi[2200951]-[2ND-A]-[Ravi Pasi]</option>
														<option value="2200953">rakesh[2200953]-[LKG-A]-[shaelendra]</option>
														<option value="2200955">RAM KUMAR [2200955]-[2ND-A]-[SHYAM KUMAR ]</option>
														<option value="2200957">Prashant [2200957]-[8TH-A]-[rammu lal ]</option>
														<option value="2200958">Prashant [2200958]-[8TH-A]-[rammu lal ]</option>
														<option value="2200959">Amit rao[2200959]-[2ND-A]-[Sahab rao]</option>
														<option value="2200961">NIDHI SINGH[2200961]-[2ND-A]-[BHARAT PATIDAR]</option>
														<option value="2200962">shravan singh[2200962]-[2ND-A]-[rajaram singh]</option>
														<option value="2200965">asharamk[2200965]-[2ND-A]-[]</option>
														<option value="2200974">kamalkant[2200974]-[8TH-A]-[vasudev dhakad]</option>
														<option value="2200976">Prashant [2200976]-[8TH-A]-[rammu lal ]</option>
														<option value="2200977">Aarunya Raj Sinha[2200977]-[UKG-A]-[tret]</option>
														<option value="2200980">Monali[2200980]-[2ND-A]-[]</option>
														<option value="2200984">lokesh[2200984]-[8TH-A]-[sandeep]</option>
														<option value="2200987">prash[2200987]-[7TH-A]-[rrmm]</option>
														<option value="2200989">Prashant [2200989]-[8TH-A]-[rammu lal ]</option>
														<option value="2200990">Prashant [2200990]-[8TH-A]-[rammu lal ]</option>
														<option value="2200992">Prashant [2200992]-[8TH-A]-[]</option>
														<option value="2200993">VEDANT TIWARI[2200993]-[8TH-A]-[MANOJ KUMAR TIWARI]</option>
														<option value="2201009">Aamna Hussain[2201009]-[NURSERY-A]-[Syed Farhat Hussain]</option>
														<option value="2201010">Prashant [2201010]-[7TH-A]-[rammu lal ]</option>
														<option value="2201015">Prashant [2201015]-[7TH-A]-[rammu lal ]</option>
														<option value="2201032">RAJESH CHOVE[2201032]-[9TH-A]-[MUKESH CHOVE]</option>
														<option value="2201035">Nitya Yadav[2201035]-[NURSERY-A]-[Mr. Mayank Yadav]</option>
														<option value="2201036">Shubh Kashyap[2201036]-[NURSERY-A]-[Mr. Anikesh Kumar]</option>
														<option value="2201037">Arohi Kushwaha[2201037]-[NURSERY-A]-[Mr. Shailendra Singh Kushwaha]</option>
														<option value="2201038">Anikesh[2201038]-[NURSERY-A]-[Mr. Amit Kumar]</option>
														<option value="2201039">Prithviraj[2201039]-[NURSERY-A]-[Dr. Pramod Kumar]</option>
														<option value="2201040">Arushi Diwakar[2201040]-[NURSERY-A]-[Mr. Virendra Kumar]</option>
														<option value="2201041">Kartik Nishad[2201041]-[NURSERY-A]-[Kartik Nishad]</option>
														<option value="2201062">Ramesh[2201062]-[4TH-A]-[Suresh]</option>
														<option value="2201068">AUGUSTAY[2201068]-[10TH-A]-[ SHARMA]</option>
														<option value="2201069">Anamika Agrawal[2201069]-[7TH-A]-[Sushil Agrawal]</option>
														<option value="2201076">Sujata Agrawal[2201076]-[1ST-A]-[Sushil Agrawal]</option>
														<option value="2201077">aman soni[2201077]-[11TH-A]-[ravi soni]</option>
														<option value="2201078">aman soni 2[2201078]-[9TH-A]-[ravi soni]</option>
														<option value="2201079">amit[2201079]-[11TH-A]-[ram chandr]</option>
														<option value="2201080">Roshan [2201080]-[6TH-A]-[Raj Mishra]</option>
														<option value="2201081">NIDHI SINGH [2201081]-[7TH-A]-[Asad]</option>
														<option value="2201082">Rajdeep kumar[2201082]-[4TH-A]-[Mandal himesh]</option>
														<option value="2201084">SURYA PRATAP MAURYA[2201084]-[5TH-A]-[]</option>
														<option value="2201085">Danica Mariam Jacob[2201085]-[1ST-A]-[J P Jacob]</option>
														<option value="2201086">Rahul Kumar[2201086]-[NURSERY-A]-[Lalbabu Ray]</option>
												    </select>
					</div>
				</div>
                <div class="col-md-4" style="display:none" id="staff_select">				
					<div class="form-group" >
					  <label>Staff Select</label>
					    <select name="account_staff_select" class="form-control select2" id="staff_select1" onchange="staff_detail(this.value);" required style="width:100%;">
					    <option value="">Select</option>
					    							<option value="15">kailash soni[15]-[Teacher]</option>
														<option value="19">kailash soni[19]-[Teacher]</option>
														<option value="20">jay kishan[20]-[]</option>
														<option value="29">Abhul Rjaak [29]-[Teacher]</option>
														<option value="70">suresh soni[70]-[Teacher]</option>
														<option value="71">rohan[71]-[Teacher]</option>
														<option value="74">DEMO[74]-[Teacher]</option>
														<option value="75">shreya sharma[75]-[Teacher]</option>
														<option value="78">pravin[78]-[]</option>
														<option value="79">sanjay[79]-[]</option>
														<option value="80">Rashi Saxena[80]-[Teacher]</option>
														<option value="81">Pankajini Patra[81]-[Teacher]</option>
														<option value="82">Jyoti Ranjan Patra[82]-[Teacher]</option>
														<option value="83">Goutam Kumar Das[83]-[Principal]</option>
														<option value="84">Human Ram Bhati[84]-[]</option>
														<option value="85">Premshankar Yadav[85]-[Teacher]</option>
														<option value="86">Amit Kumar Patra[86]-[]</option>
														<option value="87">Sibdutta Negi[87]-[]</option>
														<option value="90">Brahmarao[90]-[]</option>
														<option value="91">srishti gusain[91]-[]</option>
														<option value="92">HARSHALI SHAH[92]-[Teacher]</option>
														<option value="93">tushar modi [93]-[Teacher]</option>
														<option value="94">DS SALUJA[94]-[]</option>
														<option value="95">AYUSH[95]-[Teacher]</option>
														<option value="96">TUSHAR IYRE [96]-[Teacher]</option>
														<option value="97">Rajanikanta Mund[97]-[Other]</option>
														<option value="99">kunal mourya[99]-[]</option>
														<option value="101">MR. SANTOSH KUMAR SAHU[101]-[Teacher]</option>
														<option value="102">MR. BHOOPENDRA LODHI [102]-[]</option>
														<option value="103">Anjali ojha[103]-[Teacher]</option>
														<option value="104">atul singh thakur [104]-[]</option>
														<option value="105">SANTOSH KUMAR SINGH[105]-[Teacher]</option>
														<option value="107">rani[107]-[]</option>
														<option value="108">KUMAR RAVIKANT[108]-[Incharge Principal]</option>
														<option value="123456109">nikhil advin[123456109]-[Teacher]</option>
														<option value="110">sadab[110]-[]</option>
														<option value="111">Ravi[111]-[]</option>
														<option value="Samir 112">Samir harle[Samir 112]-[Librarian]</option>
														<option value="122">umesh mourya[122]-[BDE]</option>
														<option value="124">Neelam jharbade[124]-[Other]</option>
														<option value="125">anand sharma[125]-[]</option>
														<option value="126">jitendra shriwash[126]-[]</option>
														<option value="127">demo faculty[127]-[]</option>
														<option value="128">VATAN VERMA[128]-[ENGINEER]</option>
														<option value="129">user1[129]-[Teacher]</option>
														<option value="Ok show130">Pawan malviya[Ok show130]-[Teacher]</option>
														<option value="131"> teacher[131]-[]</option>
														<option value="1132">ABHISHEK SINGH THAKUR[1132]-[Other]</option>
														<option value="124489134">MONU KUMAR[124489134]-[Accountant]</option>
														<option value="135">abhushek[135]-[]</option>
														<option value="136">Teacher[136]-[]</option>
														<option value="137">Supriya tiwari[137]-[]</option>
														<option value="138">Yashpal Kr[138]-[Accountant]</option>
														<option value="29002139">VAISHNAVI AGRWAL[29002139]-[Teacher]</option>
														<option value="2901140">KAREEM RANA[2901140]-[Principle]</option>
														<option value="AAAA141">PALWINDER KAUR[AAAA141]-[Teacher]</option>
														<option value="142">Supriya Santosh[142]-[]</option>
														<option value="143">MD JAHIR KHAN[143]-[Teacher]</option>
														<option value="144">Supriya Santosh[144]-[]</option>
														<option value="S145">Mr Daya Nand Tiwari[S145]-[Director]</option>
														<option value="146">satyaprakash yadav[146]-[Teacher]</option>
														<option value="1147">praveen[1147]-[Principle]</option>
														<option value="148">Neelam jharbade[148]-[Other]</option>
														<option value="149">Tribhuwan Kumar[149]-[]</option>
														<option value="150">SURAJ KUMAR SINGH[150]-[]</option>
														<option value="151">Rohit [151]-[]</option>
														<option value="152">umesh[152]-[]</option>
														<option value="153">Shiwanand Tiwari[153]-[]</option>
														<option value="154">suresh soni[154]-[]</option>
														<option value="222155">RAYEES[222155]-[Computer INSTRUCTOR]</option>
														<option value="156">ANAYAT ULLAH[156]-[Principal]</option>
														<option value="157">xxx[157]-[]</option>
														<option value="158">AAA[158]-[]</option>
														<option value="159">AA[159]-[]</option>
														<option value="166">JAVID[166]-[Teacher]</option>
														<option value="001175">Hansraj[001175]-[Teacher]</option>
														<option value="199">Mohit nagar[199]-[Teacher]</option>
														<option value="261">PRAKASH KUMAWAT[261]-[]</option>
														<option value="gtttsk280">Sunita Bai[gtttsk280]-[Teacher]</option>
														<option value="281">Rati [281]-[]</option>
														<option value="283">Priyanka kaushik[283]-[Teacher]</option>
														<option value="292">JAGMAL YADAV[292]-[]</option>
														<option value="302">RAMKISHAN JI[302]-[]</option>
														<option value="303">rima d[303]-[]</option>
														<option value="309">nidhi[309]-[Teacher]</option>
														<option value="310">pooja [310]-[Teacher]</option>
														<option value="312">ufgv[312]-[]</option>
														<option value="313">Moniika[313]-[]</option>
														<option value="315">Monika[315]-[]</option>
														<option value="789456123216320">shamli [789456123216320]-[Teacher]</option>
														<option value="322">kundan kumar jha[322]-[]</option>
														<option value="323">JAGMAL YADAV[323]-[Teacher]</option>
														<option value="328">rahul [328]-[Teacher]</option>
														<option value="hi331">eswari[hi331]-[]</option>
														<option value="332">JAGMAL YADAV[332]-[]</option>
														<option value="333">JAGMAL YADAV[333]-[]</option>
														<option value="334">ABJISHEK LAND[334]-[]</option>
														<option value="-335">TUSHAR SULTANE[-335]-[Principle]</option>
														<option value="RP34641645336">PARVATI PATIL[RP34641645336]-[Teacher]</option>
														<option value="1337">ASHADUR RAHMAN MONDAL[1337]-[Principle]</option>
														<option value="0338">TUSHAR[0338]-[Principle]</option>
														<option value="340">VIVEK KUMAR[340]-[]</option>
														<option value="123341">suresh Devashi[123341]-[Driver]</option>
												    </select>
					</div>
				</div>	
				
					  <div class="col-md-4"  id="cust_select">
					<div class="form-group">
						  <label>Name</label>
						     <select name="account_customer_name1" class="form-control select2" onchange="account_cust(this.value);" style="width:100%;">
						         <option value="">Select</option>
						         						         <option value="kailash soni">kailash soni</option>
						         						         <option value="aaaa">aaaa</option>
						         						         <option value="Nidhi ">Nidhi </option>
						         						         <option value="Nidhi ">Nidhi </option>
						         						         <option value="Nidhi ">Nidhi </option>
						         						         <option value="aaaaa">aaaaa</option>
						         						         <option value="aaaaa">aaaaa</option>
						         						         <option value="aaaaa">aaaaa</option>
						         						         <option value=""></option>
						         						     </select>    
					</div>
				</div>
				
				
				
								
			
				<div class="col-md-4">
					 <div class="form-group">
						<label>Name</label>
						<input type="text"  name="account_customer_name" placeholder="Name" id="student_name1" value="" class="form-control" readonly >
					 </div>
				</div>
				
								
				
				
				
				
				
				<div class="col-md-4 ">
						<div class="form-group">
						  <label>Address</label>
						   <input type="text"  name="account_customer_address" id="student_adress1" placeholder="Address"  value="" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-4">		
						<div class="form-group">
						  <label>Contact No.</label>
						   <input type="number" name="account_customer_contact_no" id="student_father_contact_no1" placeholder="Contact No."  value="" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-4" style="display:none" id="staff_designation">		
						<div class="form-group">
						  <label>Designation</label>
						   <input type="text" name="account_customer_designation" placeholder="Designation" id="designation" value="" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-4 ">		
						<div class="form-group">
						  <label>Total Amount<font style="color:red"><b>*</b></font></label>
						   <input type="number" name="account_customer_total_amount" id="account_customer_total_amount" oninput="same_amount(this.value,'advance_amount');" placeholder="Total Amount"  value="" class="form-control" required>
						</div>
				</div>
				<div class="col-md-4 ">	
				    <div class="form-group" >
				     <label>Date<font style="color:red"><b>*</b></font></label>
					 <input type="date"  name="account_customer_date" placeholder="Date"  value="2022-12-03" class="form-control" required>
				    </div>
				</div>
				
                <div class="col-md-2">				
                <div class="form-group">
                  <label>Bill/Quotation No.</label>
                  <input type="text" name="bill_quotation_no" class="form-control" placeholder="Bill/Quotation No." />
                </div>
                </div>
                <div class="col-md-2">				
                <div class="form-group">
                  <label>Bill/Quotation Date</label>
                  <input type="date" name="bill_quotation_date" class="form-control" value="2022-12-03" />
                </div>
                </div>
				
				<div class="col-md-4">				
					<div class="form-group" >
					  <label>Payment Mode</label>
					  <td>
					  <select name="account_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
					  <option value="Cash">Cash</option>
					  <option value="Cheque">Cheque</option>
					  <option value="NEFT">NEFT/Net Banking</option>
					  </select>
					  </td>
					</div>
					</div>
					<div class="col-md-4" id="for_cheque_name" style="display:none;">				
					<div class="form-group" >
					  <label>Bank Name</label>
					  <input type="text" name="account_cheque_bank_name" class="form-control" placeholder="Bank Name" value="">
					</div>
					</div>
					<div class="col-md-4" id="for_cheque_no" style="display:none;">				
					<div class="form-group" >
					  <label>Cheque No</label>
					  <input type="text" name="account_cheque_no" class="form-control" placeholder="Cheque No." value="">
					</div>
					</div>
					<div class="col-md-4" id="for_cheque_date" style="display:none;">				
					<div class="form-group" >
					  <label>Cheque Date</label>
					  <input type="date" name="account_cheque_date" class="form-control" placeholder="Cheque Date" value="2022-12-03">
					</div>
					</div>
					<div class="col-md-4" id="for_neft_bank_name" style="display:none;">				
					<div class="form-group" >
					  <label>Bank Name</label>
					  <input type="text" name="account_neft_bank_name" class="form-control" placeholder="Bank Name" value="">
					</div>
					</div>
					<div class="col-md-4" id="for_neft_account_no" style="display:none;">				
					<div class="form-group" >
					  <label>Account Number</label>
					  <input type="text" name="account_neft_bank_account_no" class="form-control" placeholder="Account No." value="">
					</div>
					</div>
				    <div class="col-md-4">		
						<div class="form-group">
						  <label>Remark</label>
						   <input type="text" name="account_customer_remark" placeholder="Remark"  value="" class="form-control">
						</div>
					</div>
					
				<div class="col-md-3">	
					<div class="form-group">
			          <label>Bill/Quotation Image Upload</label>
					  <input type="file" name="bill_upload" id="bill_upload" placeholder="" onchange="check_file_type(this,'bill_upload','show_bill_upload','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_bill_upload" src='../../school_software_v1_old/images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
					
					 <div class="col-md-4" style="display:none">
						<div class="form-group">
						  <label>Roll No./Emp Id</label>
						   <input type="text"  name="account_student_or_emp_id" placeholder="Roll No./Emp Id" id="student_roll_no1" value="" class="form-control" readonly >
						</div>
				     </div>
				<div class="col-md-12">
		        <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
		        </div>
	</div>
		</form>	
	
    </div>
    </div>
</section>
	<script>
  $(function () {
    $('.select2').select2()
  })
</script>	
 