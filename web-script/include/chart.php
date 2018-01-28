			<div class="container warpper">
                <div class="row">
                    <div class="col-12">

                    	<canvas id="myChart" width="400" height="200"></canvas>

                    </div>
                </div>
            </div>
			<script>
			var ctx = document.getElementById("myChart");
			var myChart = new Chart(ctx, {
			    type: 'line',
			    data: {
			    	<?php
			    		$label = [];
			    		$temp = [];
			    		$humi = [];
			    		$light = [];
			    		$mosi = [];
			    		$weight = [];
			    		$stm2 = $con->prepare("SELECT * FROM pdbms_data ORDER BY datetime ASC LIMIT 10");
                        $stm2->execute();
                        while ($rows = $stm2->fetch(PDO::FETCH_ASSOC)) {
                        	array_push($label, $rows['datetime']);
                        	array_push($temp, $rows['temp']);
                        	array_push($humi, $rows['humi']);
                        	array_push($mosi, $rows['mosi']);
                        	array_push($light, $rows['light']);
                        	array_push($weight, $rows['weight']);
                        }
                        $labels = implode('","', $label);
                        $temps = implode(',', $temp);
			    		$humis = implode(',', $humi);
			    		$mosis = implode(',', $mosi);
			    		$lights = implode(',', $light);
			    		$weights = implode(',', $weight);

			    	?>
			        labels: ["<?=$labels;?>"],
			        datasets: [{
			            label: 'Temperature',
			            data: [<?=$temps;?>],
			            backgroundColor: 'rgb(75, 192, 192)',
                    	borderColor: 'rgb(75, 192, 192)',
			            fill: false
			        },
			        {
			            label: 'Humidity',
			            data: [<?=$humis;?>],
			            backgroundColor: 'rgb(54, 162, 235)',
                    	borderColor: 'rgb(54, 162, 235)',
			            fill: false
			        },
			        {
			            label: 'Light',
			            data: [<?=$lights;?>],
			            backgroundColor: 'rgb(255, 205, 86)',
                    	borderColor: 'rgb(255, 205, 86)',
			            fill: false
			        },
			        {
			            label: 'Mositure',
			            data: [<?=$mosis;?>],
			            backgroundColor: 'rgb(82,5,127)',
                    	borderColor: 'rgb(82,5,127)',
			            fill: false
			        },
			        {
			            label: 'Weight',
			            data: [<?=$weights;?>],
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
			</script>
