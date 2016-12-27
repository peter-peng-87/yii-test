<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use Curl\Curl;

class CurlController extends Controller
{
    private $data = [];
    private $url = 'http://192.168.110.213:81/';
    /**
     * @var Curl
     */
    private $curl;

    public function init(){
        parent::init();
        // $this->layout = 'empty';
        $this->data = $_REQUEST;
        $this->curl = new Curl();
    }

    public function actionGet()
    {
       $this->curl->get($this->url . 'megacorp/employee/1');
       echo $this->curl->response;
    }
    
    public function actionPut()
    {
        $result = $this->curl->put($this->url . 'megacorp/employee/5', json_encode([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'age' => 25,
            'about' => 'I love to go rock climbing',
            'interests' => ["sports", "music"],
        ]),
        true
        );
        p($this->curl->response); die;
        
        /**
        $this->curl->put($this->url . 'megacorp/employee/2', [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'age' => 25,
            'about' => 'I like to collect rock albums',
            'interests' => ["music"],
        ]);
        $this->curl->put($this->url . 'megacorp/employee/3', [
            'first_name' => 'Douglas',
            'last_name' => 'Fir',
            'age' => 35,
            'about' => 'I like to build cabinets',
            'interests' => [ "forestry"],
        ]);**/
        echo "put";
    }
    
    public function actionPost()
    {
        echo "post";
    }
    
    public function actionDelete()
    {
        echo "delete";
    }
    
    public function actionSearch()
    {
       
    }
}
