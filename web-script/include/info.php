		<?php
			$stm = $con->prepare("SELECT * FROM pdbms_data JOIN pdbms_picture ON pdbms_data.identity = pdbms_picture.identity WHERE pdbms_data.identity = :identity LIMIT 1");
			$stm->bindParam(':identity', $_GET['identity'], PDO::PARAM_STR);
            try {
                $stm->execute();
            } catch (Exception $e) {
                 $e->getMessage();
            }
            $rows = $stm->fetch(PDO::FETCH_ASSOC);
		?>
		<script>
			var identity = '<?php echo $_GET['identity']; ?>';
			var config = {
			    databaseURL: '<?php echo $firebase['databaseURL']; ?>'
			};
			firebase.initializeApp(config);
			var fb = firebase.database();

			fb.ref(identity).on('value', function(d){
				var d = d.val()
				console.log(d)
				$('#fb-display-temp').html(d.temp.toFixed(2));
				$('#fb-display-humi').html(d.humi.toFixed(2));
				$('#fb-display-mosi').html(d.mosi.toFixed(2));
				$('#fb-display-light').html(d.light.toFixed(2));
				$('#fb-display-weight').html(d.weight.toFixed(2));
			})
		</script>
			<div class="container warpper">
                <div class="row">
                    <div class="col-12">
                    	<a class="btn btn-primary mb-3" href="<?=$init['url'];?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    	<h2 class="page-header"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $rows['datetime']; ?> น.</h2>
                    </div>
                    <div class="col-sm-12 col-md-6">
                    	<?php
                    		if (empty($rows['base64pic'])) {
                    			echo '<a href="../upload/'.$_GET['identity'].'/"><img id="fb_pic" src="https://i.imgur.com/1EHSW0g.png" width="100%" class="img-thumbnail"></a>';
                    		}else{
                    			echo '<img id="fb_pic" src="'.$rows['base64pic'].'" width="100%" class="img-thumbnail">';
                    		}
                    	?>
                    </div>
                    <div class="col-sm-12 col-md-6">
                    	<h5>MySQL Data</h5>
                    	<div class="row">
                    		<div class="col-md-6">
								<div class="card card-inverse border-success">
			                        <div class="card-block text-success">
			                            <div class="rotate">
			                                <i class="fa fa-thermometer-quarter fa-4x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/zVKZBtU.png" width="20" > Temperature</h6>
			                            <h1 id="sql-display-temp"><?php echo $rows['temp']; ?></h1>
			                        </div>
			                    </div>
		                    </div>
		                    <div class="col-md-6">
			                    <div class="card card-inverse border-info">
			                        <div class="card-block text-info">
			                            <div class="rotate">
			                                <i class="fa fa-snowflake-o fa-4x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/zVKZBtU.png" width="20" > Humidity</h6>
			                            <h1 id="sql-display-humi"><?php echo $rows['humi']; ?></h1>
			                        </div>
			                    </div>
		                	</div>
		                	<div class="col-md-4">
			                    <div class="card card-inverse border-warning">
			                        <div class="card-block text-warning">
			                            <div class="rotate">
			                                <i class="fa fa-sun-o fa-3x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/zVKZBtU.png" width="20" > Light</h6>
			                            <h1 id="sql-display-light"><?php echo $rows['light']; ?></h1>
			                        </div>
			                    </div>
		                    </div>
		                    <div class="col-md-4">
			                    <div class="card card-inverse border-info">
			                        <div class="card-block text-info">
			                            <div class="rotate">
			                                <i class="fa fa-tint fa-3x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/zVKZBtU.png" width="20" > Mositure</h6>
			                            <h1 id="sql-display-mosi"><?php echo $rows['mosi']; ?></h1>
			                        </div>
		                    	</div>
		                	</div>
		                    <div class="col-md-4">
			                    <div class="card card-inverse border-danger">
			                        <div class="card-block text-danger">
			                            <div class="rotate">
			                                <i class="fa fa-balance-scale fa-3x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/zVKZBtU.png" width="20" > Weight</h6>
			                            <h1 id="sql-display-weight"><?php echo $rows['weight']; ?></h1>
			                        </div>
			                    </div>
			                </div>
		                </div>
		                <hr>
		                <h5>Firebase Data</h5>
		                <div class="row">
		                	<div class="col-md-6">
		                		<div class="card card-inverse border-success">
			                        <div class="card-block text-success">
			                            <div class="rotate">
			                                <i class="fa fa-thermometer-quarter fa-4x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/NIL2inB.png" width="20" > Temperature</h6>
			                            <h1 id="fb-display-temp">0.00</h1>
			                        </div>
			                    </div>
		                	</div>
		                	<div class="col-md-6">
		                		<div class="card card-inverse border-info">
			                        <div class="card-block text-info">
			                            <div class="rotate">
			                                <i class="fa fa-snowflake-o fa-4x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/NIL2inB.png" width="20" > Humidity</h6>
			                            <h1 id="fb-display-humi">0.00</h1>
			                        </div>
			                    </div>
		                	</div>
		                	<div class="col-md-4">
		                		<div class="card card-inverse border-warning">
			                        <div class="card-block text-warning">
			                            <div class="rotate">
			                                <i class="fa fa-sun-o fa-4x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/NIL2inB.png" width="20" > Light</h6>
			                            <h1 id="fb-display-light">0.00</h1>
			                        </div>
			                    </div>
		                	</div>
		                	<div class="col-md-4">
		                		<div class="card card-inverse border-info">
			                        <div class="card-block text-info">
			                            <div class="rotate">
			                                <i class="fa fa-tint fa-4x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/NIL2inB.png" width="20" > Mositure</h6>
			                            <h1 id="fb-display-mosi">0.00</h1>
			                        </div>
			                    </div>
		                	</div>
		                	<div class="col-md-4">
		                		<div class="card card-inverse border-danger">
			                        <div class="card-block text-danger">
			                            <div class="rotate">
			                                <i class="fa fa-balance-scale fa-3x"></i>
			                            </div>
			                            <h6 class="text-uppercase"><img align="middle" src="https://i.imgur.com/NIL2inB.png" width="20" > Weight</h6>
			                            <h1 id="fb-display-weight">0.00</h1>
			                        </div>
			                    </div>
		                	</div>
		                </div>
				    </div>
                </div>
            </div>
