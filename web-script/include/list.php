
            <div class="container warpper">
                <div class="row">
                    <div class="col-12">
                        <h4><i class="fa fa-clock-o"></i> Lasted <small id="sql-update">0000-00-00 00:00:00</small></h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-dark">
                                                <div class="card-body">
                                                    <h2>
                                                        ณ เวลา <span id="sql-datetime">0000-00-00 00:00:00</span> <small>หรือ <span id="sql-ago">0 </span>ที่ผ่านมา</small>
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
                                                    <h1 class="display-1" id="sql-temp">0.00</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-inverse border-info">
                                                <div class="card-block text-info">
                                                    <div class="rotate">
                                                        <i class="fa fa-snowflake-o fa-5x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-snowflake-o"></i> Humidity</h6>
                                                    <h1 class="display-1" id="sql-humi">0.00</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-inverse border-warning">
                                                <div class="card-block text-warning">
                                                    <div class="rotate">
                                                        <i class="fa fa-sun-o fa-4x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-sun-o"></i> Light</h6>
                                                    <h1 class="display-1" id="sql-light">0.00</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-inverse border-info">
                                                <div class="card-block text-info">
                                                    <div class="rotate">
                                                        <i class="fa fa-tint fa-4x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-tint"></i> Mositure</h6>
                                                    <h1 class="display-1" id="sql-mosi">0.00</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-inverse border-danger">
                                                <div class="card-block text-danger">
                                                    <div class="rotate">
                                                        <i class="fa fa-balance-scale fa-4x"></i>
                                                    </div>
                                                    <h6 class="text-uppercase"><i class="fa fa-balance-scale"></i> Weight</h6>
                                                    <h1 class="display-1" id="sql-weight">0.00</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="sql-image">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        getLastedInfo()
                    });
                    setInterval(getLastedInfo, 5000)
                    function getLastedInfo(){
                        $.ajax({
                            url: 'api/lasted/',
                            type: 'POST',
                            dataType: 'json',
                            data: {ondisplay: true},
                        })
                        .done(function(d) {
                            $('#sql-datetime').html(d.datetime)
                            $('#sql-weight').html(d.weight)
                            $('#sql-temp').html(d.temp)
                            $('#sql-humi').html(d.humi)
                            $('#sql-light').html(d.light)
                            $('#sql-mosi').html(d.mosi)
                            $('#sql-ago').html(d.ago)
                            $('#sql-update').html(d.update)
                            $('#sql-image').html('<img src="' + d.base64pic + '" width="100%" class="img-thumbnail">')
                        })
                    }
                </script>
