			<div class="container warpper">
                <div class="row">
                    <div class="col-12">

                    	<canvas id="myChart" update-time="0" width="400" height="200"></canvas>

                    </div>
                </div>
            </div>
			<script>
			var ctx = document.getElementById("myChart");

			$.ajax({
				url: '/api/chart/',
				type: 'POST',
				dataType: 'json',
				data: {ondisplay: true},
			})
			.done(function(d) {
				$("canvas#myChart").attr("update-time", d.lasttime);
				var myChart = new Chart(ctx, {
				    type: 'line',
				    data: {
				        labels: d.label,
				        datasets: [{
				            label: 'Temperature',
				            data: d.temp,
				            backgroundColor: 'rgb(75, 192, 192)',
	                    	borderColor: 'rgb(75, 192, 192)',
				            fill: false
				        },
				        {
				            label: 'Humidity',
				            data: d.humi,
				            backgroundColor: 'rgb(54, 162, 235)',
	                    	borderColor: 'rgb(54, 162, 235)',
				            fill: false
				        },
				        {
				            label: 'Light',
				            data: d.light,
				            backgroundColor: 'rgb(255, 205, 86)',
	                    	borderColor: 'rgb(255, 205, 86)',
				            fill: false
				        },
				        {
				            label: 'Mositure',
				            data: d.mosi,
				            backgroundColor: 'rgb(82,5,127)',
	                    	borderColor: 'rgb(82,5,127)',
				            fill: false
				        },
				        {
				            label: 'Weight',
				            data: d.weight,
				            backgroundColor: 'rgb(255, 99, 132)',
	                    	borderColor: 'rgb(255, 99, 132)',
				            fill: false
				        }]
				    },
				    options: {
				    	responsive: true,
				    	title:{
		                    display:true,
		                    text:'History Chart'
		                },
		                tooltips: {
		                    mode: 'index',
		                    intersect: false,
		                },
		                hover: {
		                    mode: 'nearest',
		                    intersect: true
		                },
						scales: {
		                    xAxes: [{
		                        display: true,
		                        scaleLabel: {
		                            display: true,
		                            labelString: 'Date'
		                        }
		                    }],
		                    yAxes: [{
		                        display: true,
		                        scaleLabel: {
		                            display: true,
		                            labelString: 'Value'
		                        }
		                    }]
	                	}
				    }
				});

				setInterval(function(){
					var lasttime = $("canvas#myChart").attr("update-time");
					$.ajax({
						url: '/api/update-chart/',
						type: 'POST',
						dataType: 'json',
						data: {ondisplay: true, lasttime: lasttime},
					})
					.done(function(u) {
						if (u.r == 1) {
							$("canvas#myChart").attr("update-time", u.datetime);
							updateData(myChart, u.datetime, u.temp, u.humi, u.light, u.mosi, u.weight);
						}
					})
				}, 5000);

			});

			function updateData(chart, label, temp, humi, light, mosi, weight) {
				chart.data.labels.splice(0, 1);
			    chart.data.datasets.forEach((dataset) => {
			        dataset.data.splice(0, 1);
			    });
			    chart.update();

			    chart.data.labels.push(label);
			    chart.data.datasets[0].data.push(temp)
			    chart.data.datasets[1].data.push(humi)
			    chart.data.datasets[2].data.push(light)
			    chart.data.datasets[3].data.push(mosi)
			    chart.data.datasets[4].data.push(weight)
			    chart.update();

			}
			</script>
