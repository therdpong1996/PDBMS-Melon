
            <div class="container warpper">
                <div class="row">
                    <div class="col-12">
                        <h4><i class="fa fa-clock-o"></i> Lasted</h4>
                        <?php
                                $stm = $con->prepare("SELECT * FROM pdbms_data JOIN pdbms_picture ON pdbms_data.identity = pdbms_picture.identity ORDER BY pdbms_data.datetime DESC LIMIT 1");
                                try {
                                    $stm->execute();
                                } catch (Exception $e) {
                                    $e->getMessage();
                                }
                                $lasted = $stm->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-dark">
                                                <div class="card-body">
                                                    <h2>
                                                        <?php echo date('d-m-Y H:i:s', $lasted['datetime']); ?> <small>หรือ <?php echo ago($lasted['datetime']);?>ที่ผ่านมา</small>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-inverse border-success">
                                                <div class="card-block text-success">
                                                    <div class="rotate">
                                                        <i class="fa fa-thermometer-quarter fa-5x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-thermometer-quarter"></i> Temperature</h6>
                                                    <h1 class="display-1" id="sql-display-temp"><?php echo $lasted['temp']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-inverse border-info">
                                                <div class="card-block text-info">
                                                    <div class="rotate">
                                                        <i class="fa fa-tint fa-5x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-tint"></i> Humidity</h6>
                                                    <h1 class="display-1" id="sql-display-humi"><?php echo $lasted['humi']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-inverse border-warning">
                                                <div class="card-block text-warning">
                                                    <div class="rotate">
                                                        <i class="fa fa-sun-o fa-5x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-sun-o"></i> Light</h6>
                                                    <h1 class="display-1" id="sql-display-light"><?php echo $lasted['light']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-inverse border-danger">
                                                <div class="card-block text-danger">
                                                    <div class="rotate">
                                                        <i class="fa fa-object-ungroup fa-5x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-object-ungroup"></i> Weight</h6>
                                                    <h1 class="display-1" id="sql-display-weight"><?php echo $lasted['weight']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="<?php echo $lasted['base64pic'];?>" class="img-thumbnail">
                                </div>
                            </div>
                        <hr>
                        <h4><i class="fa fa-clock-o"></i> History</h4>
                        <div class="list-group">
                            <?php
                                $stm2 = $con->prepare("SELECT * FROM pdbms_data ORDER BY datetime DESC");
                                try {
                                    $stm2->execute();
                                } catch (Exception $e) {
                                    $e->getMessage();
                                }
                                while ($rows = $stm2->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<a href="' . $rows['identity'] . '/" class="list-group-item list-group-item-action"><h4 class="list-group-item-heading">' . date('d-m-Y H:i:s', $rows['datetime']) . '</h4><small class="list-group-item-text">Temperature: ' . $rows['temp'] . '°C / Humidity: ' . $rows['humi'] . '</small></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
