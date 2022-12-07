         
		 <div class="box-body table-responsive" id="my_table2">
                  <table id="example7" class="table table-bordered table-striped">
                   <thead >
				    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Amount Type</th>
                        <th>Expence For</th>							
				        <th>Total Amount</th>
				        <th>Details</th>
				        
				        <th>Update By</th>
                        <th>Date</th>
				    </tr>
                    </thead>
                <tbody>



<tr>         
<td>1</td>
<td>2022-12-03</td>
<td>VIVEK KUMAR</td>
<td>Debit</td>
<td>salary</td>
<td>7200.00</td>
<td>			
<button type="button" onclick="post_content('account/ledger_salary_details','id=340&date=2022-12-03&total_amount=7200.00')"  class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>03-12-2022</td>
</tr>	


<tr>         
<td>2</td>
<td>2022-12-02</td>
<td>kailash soni</td>
<td>Debit</td>
<td>account</td>
<td>3000</td>
<td>			

<button type="button" onclick="post_content('account/ledger_details','id=kailash soni&date=2022-12-02&total_amount=3000&amount_type=Debit')" class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>02-12-2022</td>
</tr>	


<tr>         
<td>3</td>
<td>2022-12-02</td>
<td>VIVEK KUMAR</td>
<td>Debit</td>
<td>salary</td>
<td>7200.00</td>
<td>			
<button type="button" onclick="post_content('account/ledger_salary_details','id=340&date=2022-12-02&total_amount=7200.00')"  class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>02-12-2022</td>
</tr>	


<tr>         
<td>4</td>
<td>2022-12-01</td>
<td>VIVEK KUMAR</td>
<td>Debit</td>
<td>salary</td>
<td>14500.00</td>
<td>			
<button type="button" onclick="post_content('account/ledger_salary_details','id=340&date=2022-12-01&total_amount=14500.00')"  class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>01-12-2022</td>
</tr>	


<tr>         
<td>5</td>
<td>2022-12-01</td>
<td>TUSHAR</td>
<td>Debit</td>
<td>salary</td>
<td>4050.00</td>
<td>			
<button type="button" onclick="post_content('account/ledger_salary_details','id=0338&date=2022-12-01&total_amount=4050.00')"  class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>01-12-2022</td>
</tr>	


<tr>         
<td>6</td>
<td>2022-12-01</td>
<td>VIVEK KUMAR</td>
<td>Debit</td>
<td>salary</td>
<td>8100.00</td>
<td>			
<button type="button" onclick="post_content('account/ledger_salary_details','id=340&date=2022-12-01&total_amount=8100.00')"  class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>01-12-2022</td>
</tr>	


<tr>         
<td>7</td>
<td>2022-12-01</td>
<td>VIVEK KUMAR</td>
<td>Debit</td>
<td>salary</td>
<td>14300.00</td>
<td>			
<button type="button" onclick="post_content('account/ledger_salary_details','id=340&date=2022-12-01&total_amount=14300.00')"  class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>01-12-2022</td>
</tr>	


<tr>         
<td>8</td>
<td>2022-12-01</td>
<td>VIVEK KUMAR</td>
<td>Debit</td>
<td>salary</td>
<td>14500.00</td>
<td>			
<button type="button" onclick="post_content('account/ledger_salary_details','id=340&date=2022-12-01&total_amount=14500.00')"  class="btn btn-success" >Details</button>
</td>

<td>rahul@simption.com</td>
<td>01-12-2022</td>
</tr>	
 </tbody>
 </table>
 <script>
  $(function () {
    $('#example7').DataTable()

  })
</script>