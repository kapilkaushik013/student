<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Attendance per Day'],
          ['Not Mark',      239],
          ['Total Leave',  0],
          ['Total Present', 16],
          ['Total Absent',    2]
        ]);

        var options = {
          title: 'Attendance Graphical Representation',
          pieHole: 0.4,
		  is3D: true,
		  colors: ['#e0440e', '#ff9900', '#109618', '#990099'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
</script>
<div id="donutchart" style="height:400px; width:100%"></div>