<script type="text/javascript">
				  google.charts.load('current', {'packages':['bar']});
				  google.charts.setOnLoadCallback(drawChart);

function drawChart() {
				var data = google.visualization.arrayToDataTable([
				  ['Class', 'Student', 'Not Mark', 'Leave','Present','Absent']
				  
				  
		  
,['NURSERY', 19, 19, 0, 0, 0]
		  
		  
,['LKG', 15, 15, 0, 0, 0]
		  
		  
,['UKG', 42, 42, 0, 0, 0]
		  
		  
,['1ST', 12, 12, 0, 0, 0]
		  
		  
,['2ND', 59, 59, 0, 0, 0]
		  
		  
,['3RD', 9, 9, 0, 0, 0]
		  
		  
,['4TH', 14, 14, 0, 0, 0]
		  
		  
,['5TH', 13, 13, 0, 0, 0]
		  
		  
,['6TH', 12, 12, 0, 0, 0]
		  
		  
,['7TH', 18, 0, 0, 16, 2]
		  
		  
,['8TH', 29, 29, 0, 0, 0]
		  
		  
,['9TH', 6, 6, 0, 0, 0]
		  
		  
,['10TH', 1, 1, 0, 0, 0]
		  
		  
,['11TH', 5, 5, 0, 0, 0]
		  
		  
,['12TH', 3, 3, 0, 0, 0]
		  
				  
				]);

				var options = {
				  chart: {
					title: 'Classwise Attendance Report',
				  },
				  bars: 'horizontal' // Required for Material Bar Charts.
				};

				var chart = new google.charts.Bar(document.getElementById('barchart_material'));

				chart.draw(data, google.charts.Bar.convertOptions(options));
			  }
</script>
<div id="barchart_material" style="width: 100%; height: 800px;"></div>