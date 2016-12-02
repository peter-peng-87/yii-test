<?php

namespace frontend\controllers\action;

use Yii;
use yii\base\Action;

class IndexAction extends Action
{
	public function init()
	{
		parent::init();
	}

	/**
	 * @return array
	 */
    public function run()
    {
        $result = [
            'test' => 'this is smarty!!!',
            'static_url' => 'this is smarty!!!'
        ];
	    echo "action run now ....!!!";
	    // print_r($result);
	    // $this->smarty->test = 'hahaha';
	    return $this->controller->render('index.html', $result);
    }
}
