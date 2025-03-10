<?php
include 'headers.php';
?>
<!DOCTYPE HTML>
<html lang="eng">
<head>
<title>Welcome Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="../css/style.css" rel='stylesheet' type='text/css' />
<link href="../css/esdy.css" rel='stylesheet' type='text/css' />
<link href="../css/fontawesome-all.min.css" rel="stylesheet">
</head>
<body>
<?php
	include 'top-nav.php';
?>
<div class="container-fluid">
	<?php
		include 'navigation.php';
	?>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 border-right">
			<?php
				include 'accounts-nav.php';
			?>
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-12">
					<div class="float-right"><a href="accounts-settings.php" class="reset-anchor" target="_blank"><i class="fas fa-cog"></i></a></div>
					<div class="float-right m-r-10">
						<select>
							<option value="">FY 2021-22</option>
						</select>
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">70,000</h3>
						Bank<br>
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">100,000</h3>
						Cash<br>
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">700,000</h3>
						Assets<br>
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">7,530,600</h3>
						Revenue<br>
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">550,300</h3>
						Expense<br>
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">3,000</h3>
						Inventory<br>
					</div>
				</div>
			</div>

			<div class="row m-t-10">
				<div class="col-md-6">
					<center><p style="margin-top:10px"><b>Monthwise Revenue generated for the FY 2020-2021</b></p></center>
					<div id="chart1"></div>
				</div>
				<div class="col-md-6">
					<center><p style="margin-top:10px"><b>Monthwise Orders for the FY 2020-2021</b></p></center>
					<div id="chart2"></div>
				</div>
			</div>

			<div class="row m-t-10">
				<div class="col-md-6">
					<center><p><b>Sales Trend</b></p></center>
					<table style="width:100%" border="1">
						<thead>
							<tr style="background: #55B0D1;color:white">
								<th style="width:100px;">FY</th>
								<th>Month</th>
								<th>Sales</th>
								<th style="width:100px;">%</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>2020-21</td>
								<td>Dec</td>
								<td>210,000</td>
								<td><span style="color:red"><i class="fas fa-arrow-down"></i> 66.67 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Nov</td>
								<td>420,000</td>
								<td><span style="color:green"><i class="fas fa-arrow-up"></i> 80.01 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Oct</td>
								<td>180,000</td>
								<td><span style="color:red"><i class="fas fa-arrow-down"></i> 60.19 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Sept</td>
								<td>335,000</td>
								<td><span style="color:red"><i class="fas fa-arrow-down"></i> 22.51 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Aug</td>
								<td>420,000</td>
								<td><span style="color:green"><i class="fas fa-arrow-up"></i> 43.47 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Jul</td>
								<td>270,000</td>
								<td><span style="color:red"><i class="fas fa-arrow-down"></i> 10.52 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Jun</td>
								<td>300,000</td>
								<td><span style="color:green"><i class="fas fa-arrow-up"></i> 28.57 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>May</td>
								<td>400,000</td>
								<td><span style="color:green"><i class="fas fa-arrow-up"></i> 45.20 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Apr</td>
								<td>240,000</td>
								<td><span style="color:red"><i class="fas fa-arrow-down"></i> 30.14 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Mar</td>
								<td>370,000</td>
								<td><span style="color:green"><i class="fas fa-arrow-up"></i> 102.74 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Feb</td>
								<td>120,000</td>
								<td><span style="color:red"><i class="fas fa-arrow-down"></i> 55.14 %</span></td>
							</tr>
							<tr>
								<td>2020-21</td>
								<td>Jan</td>
								<td>230,000</td>
								<td><span style="color:green"><i class="fas fa-arrow-up"></i> 100.00 %</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<center><p><b>Brand wise sales volume</b></p></center>
					<div id="chart3"></div>
				</div>
			</div>

			<div class="row m-t-10">
				<div class="col-md-6">
					<center><p><b>Account Receivables</b></p></center>
					<div class="accounts_dashboard_box float-left m-r-20 m-b-10">
						<h3 class="no-margin">3</h3>
						Total Invoices
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">390,000</h3>
						Total Receivable
					</div>
					<div class="accounts_dashboard_box float-left m-r-20" style="width:150px;">
						<h3 class="no-margin">20/10/2021</h3>
						Next Rec. Date
					</div><br><br>
					<table style="clear: both;width:100%;margin-top:10px;" border="1">
						<thead>
							<tr style="background: #55B0D1;color:white">
								<th style="width:50px;padding:4px;">#</th>
								<th style="padding:4px;">Ref</th>
								<th style="padding:4px;">From</th>
								<th style="padding:4px;">Due Date</th>
								<th style="padding:4px;">Amount</th>
								<th style="width:100px;padding:4px;"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="padding:4px;">1</td>
								<td style="padding:4px;">#IO20107</td>
								<td style="padding:4px;">Ilias Ahmed</td>
								<td style="padding:4px;">20/10/2021</td>
								<td style="padding:4px;">120,000</td>
								<td style="padding:4px;">
									<center>
										<a href="">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</center>
								</td>
							</tr>
							<tr>
								<td style="padding:4px;">2</td>
								<td style="padding:4px;">#IO20110</td>
								<td style="padding:4px;">Wasi Uddin</td>
								<td style="padding:4px;">24/10/2021</td>
								<td style="padding:4px;">70,000</td>
								<td style="padding:4px;">
									<center>
										<a href="">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</center>
								</td>
							</tr>
							<tr>
								<td style="padding:4px;">3</td>
								<td style="padding:4px;">#IO20112</td>
								<td style="padding:4px;">John Doe</td>
								<td style="padding:4px;">27/10/2021</td>
								<td style="padding:4px;">200,000</td>
								<td style="padding:4px;">
									<center>
										<a href="">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</center>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<center><p><b>Account Payable</b></p></center>
					<div class="accounts_dashboard_box float-left m-r-20 m-b-10">
						<h3 class="no-margin">4</h3>
						Total Invoices
					</div>
					<div class="accounts_dashboard_box float-left m-r-20">
						<h3 class="no-margin">295,000</h3>
						Total Payable
					</div>
					<div class="accounts_dashboard_box float-left m-r-20" style="width:150px;">
						<h3 class="no-margin">15/10/2021</h3>
						Next Pay Date
					</div><br><br>
					<table style="clear: both;width:100%;margin-top:10px;" border="1">
						<thead>
							<tr style="background: #55B0D1;color:white">
								<th style="width:50px;padding:4px;">#</th>
								<th style="padding:4px;">Ref</th>
								<th style="padding:4px;">Payment To</th>
								<th style="padding:4px;">Due Date</th>
								<th style="padding:4px;">Amount</th>
								<th style="width:100px;padding:4px;"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="padding:4px;">1</td>
								<td style="padding:4px;">#PY1014</td>
								<td style="padding:4px;">Vikas Gupta</td>
								<td style="padding:4px;">15/10/2021</td>
								<td style="padding:4px;">20,000</td>
								<td style="padding:4px;">
									<center>
										<a href="">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</center>
								</td>
							</tr>
							<tr>
								<td style="padding:4px;">2</td>
								<td style="padding:4px;">#PY1015</td>
								<td style="padding:4px;">Mourya Chandrika</td>
								<td style="padding:4px;">17/10/2021</td>
								<td style="padding:4px;">75,000</td>
								<td style="padding:4px;">
									<center>
										<a href="">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</center>
								</td>
							</tr>
							<tr>
								<td style="padding:4px;">3</td>
								<td style="padding:4px;">#PY1016</td>
								<td style="padding:4px;">Rizwan Shaik</td>
								<td style="padding:4px;">17/10/2021</td>
								<td style="padding:4px;">120,000</td>
								<td style="padding:4px;">
									<center>
										<a href="">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</center>
								</td>
							</tr>
							<tr>
								<td style="padding:4px;">4</td>
								<td style="padding:4px;">#PY1017</td>
								<td style="padding:4px;">Mohd Shamshaiz</td>
								<td style="padding:4px;">27/10/2021</td>
								<td style="padding:4px;">80,000</td>
								<td style="padding:4px;">
									<center>
										<a href="">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</center>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/apexcharts.min.js"></script>
<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript">
function chart1(){
    var options = {
      series: [{
      name: 'Sales',
      data: [230000, 120000, 370000, 240000, 400000, 300000, 270000, 420000, 335000, 180000, 420000, 210000]
    }],
      chart: {
      height: 350,
      type: 'bar',
    },
    plotOptions: {
      bar: {
        borderRadius: 10,
        dataLabels: {
          position: 'top', // top, center, bottom
        },
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return val;
      },
      offsetY: -20,
      style: {
        fontSize: '12px',
        colors: ["#304758"]
      }
    },
    
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      position: 'top',
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        fill: {
          type: 'gradient',
          gradient: {
            colorFrom: '#0089BA',
            colorTo: '#0089BA',
            stops: [0, 100],
            opacityFrom: 0.4,
            opacityTo: 0.5,
          }
        }
      },
      tooltip: {
        enabled: true,
      }
    },
    yaxis: {
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
        formatter: function (val) {
          return val;
        }
      }
    
    },
    title: {
      text: '',
      floating: true,
      offsetY: 330,
      align: 'center',
      style: {
        color: '#0089BA'
      }
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
}
chart1();

function chart2(){  
        var options = {
          series: [{
            name: "Orders",
            data: [4100, 6100, 4900, 5100, 1800, 2700, 6900, 9100, 4800,3000,4700, 2800]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
      
}
chart2();

function chart3(){
   var options = {
      series: [44, 55, 13, 43, 22],
      chart: {
      width: 380,
      type: 'pie',
    },
    labels: ['BMW', 'Volkswagen', 'Porshe', 'Mercedes', 'Audi'],
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 200
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
    };

    var chart = new ApexCharts(document.querySelector("#chart3"), options);
    chart.render();
}
chart3();
</script>
</body>
</html>