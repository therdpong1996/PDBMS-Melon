<?php 

class firebase {
    
    private $url = '';
    private $path = '';
    private $data = '';

    function __construct($url){
        $this->url = $url;
    }

    public function path($path){
        $this->path = $path;
    }

    public function data($data = []){
        $this->data = [
                'http' => [
                    'method'  => 'PUT',
                    'header'  => 'Content-type: application/json',
                    'content' => json_encode($data)]
        ];
    }

    public function execute()
    {
        $context = stream_context_create($this->data);
        $contents = file_get_contents($this->url . "/" . $this->path . ".json", false, $context);
        return ($contents != false) ? true : false;
    }

}

?>
