			<div class="container warpper">
                <div class="row">
                    <div class="col-12">
                    	<h5 class="page-header"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Image to <?php echo $_GET['identity']; ?></h5>
                    </div>
                    <div class="col-12">
                        <div style="display: none;" id="my_camera"></div>
                        <div id="results"><img id="pre_pic" src="https://i.imgur.com/o95HDTU.jpg" width="100%" class="img-thumbnail"></div>
                    	
                    	<form style="margin-top: 1rem">
                    		<div class="form-group">
						      	<input type="button" value="Take Snapshot" onClick="take_snapshot()">
						    </div>
                    	</form>
                    	<form id="upload-img" action="javascript:void(0)" method="POST">
                    		<input type="text" name="identity" value="<?php echo $_GET['identity']; ?>" hidden>
						    <div class="form-group">
						      	<label for="exampleInputPassword1">Upload Password</label>
						      	<input type="password" class="form-control" name="upload_passwd" placeholder="Password">
						    </div>
						    <input type="text" name="pre_img" id="pre_img" value="" hidden>
						    <button type="submit" id="btn-up" class="btn btn-primary">Upload</button>
						    <p class="text-warning" id="upload-help"></p>
                    	</form>
                    </div>
                </div>
            </div>
            <script language="JavaScript">
                Webcam.set({
                    width: <?php echo $camera['width'];?>,
                    height: <?php echo $camera['height'];?>,
                    image_format: 'jpeg',
                    jpeg_quality: <?php echo $camera['quality'];?>
                });
                Webcam.attach( '#my_camera' );
            </script>
            <script language="JavaScript">
                function take_snapshot() {
                    Webcam.snap( function(data_uri) {
                        document.getElementById('results').innerHTML =  '<img id="pre_pic" src="'+data_uri+'" width="100%" class="img-thumbnail">';
                        $('#pre_img').attr('value', data_uri);
                    } );
                }
            </script>
            <script type="text/javascript">

				$('#upload-img').on('submit', function(){
					$('#upload-help').html('');
					$('#btn-up').html('Uploading...');
					$('#btn-up').attr('disabled', true);
					var data = $(this).serialize();
					$.ajax({
                    		url: myurl + 'image/',
                    		type: 'POST',
                    		dataType: 'json',
                    		data: data,
                    })
                    .done(function(d) {
                    	if (d.code) {
                    		$('#btn-up').html('Uploaded');
                    		setInterval(function(){
                    			window.location.href = myurl + d.identity + '/';
                    		}, 2000);
                    	}else{
                    		$('#upload-help').html(d.msg);
                    		$('#btn-up').html('Upload');
							$('#btn-up').removeAttr('disabled');
                    	}
                    })
				})
            </script>
