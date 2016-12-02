<?php

namespace frontend\controllers\action\jquery;

use Yii;
use yii\base\Action;

class ExtendObjAction extends Action
{
	public function init()
	{
		parent::init();
		$this->controller->layout = 'empty';
	}

	/**
	 * @return array
	 */
    public function run()
    {
        $result = [
            'test' => 'this is smarty!!!',
            'static_url' => STATIC_URL
        ];
	    echo "action run now ....!!!";
	    return $this->controller->render('extendobj.html', $result);
    }
}
