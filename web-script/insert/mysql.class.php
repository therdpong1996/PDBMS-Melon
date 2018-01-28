<?php
class mysql {

    private $con = '';
    private $identity = '';
    private $data = '';

    function __construct($con) {
        $this->con = $con;
    }

    public function identity($identity){
        $this->identity = $identity;
    }

    public function data($data = []){
        $this->data = $data;
    }

    public function execute(){

        $base64pic = '';

        $stm = $this->con->prepare("INSERT INTO pdbms_data(identity,temp,humi,mosi,light,weight,datetime) VALUES (:identity, :temp, :humi, :mosi, :light, :weight, CURRENT_TIMESTAMP)");
        $stm->bindParam(':identity', $this->identity);
        $stm->bindParam(':temp', $this->data['temp']);
        $stm->bindParam(':humi', $this->data['humi']);
        $stm->bindParam(':mosi', $this->data['mosi']);
        $stm->bindParam(':light', $this->data['light']);
        $stm->bindParam(':weight', $this->data['weight']);

        $stm2 = $this->con->prepare("INSERT INTO pdbms_picture(identity,base64pic) VALUES (:identity, :base64pic)");
        $stm2->bindParam(':identity', $this->identity);
        $stm2->bindParam(':base64pic', $base64pic);

        try {
            $stm->execute();
            $stm2->execute();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return true;
        
    }

}

?>
