<?php

namespace frontend\controllers\action\zip;

use Yii;
use yii\base\Action;
use MatthiasMullie\Minify;
use yii\helpers\ArrayHelper;

class CssAction extends Action
{
    private $config = [
        'webcss' => 
        [
            'target' => 'D:/wnmp/www/gitapi/cheyiweb/static/css/members.css',
            'source' => [
                'D:/wnmp/www/gitapi/cheyiweb/b2c/member/web/assets/css/buttons.css',
                'D:/wnmp/www/gitapi/cheyiweb/b2c/member/web/assets/css/font-awesome.min.css',
                'D:/wnmp/www/gitapi/cheyiweb/b2c/member/web/assets/css/switch.css',
                'D:/wnmp/www/gitapi/cheyiweb/b2c/member/web/assets/css/common.css',
             ]
        ],
        'css' => [
            'target' => 'D:/wnmp/www/gitapi/cheyiweb/static/css/base.css',
            'source' => [
                 'D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/css/ser_common.css', 
                 'D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/css/ucenter.css', 
                 'D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/css/collection-attr.css', 
                 'D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/css/ser_newstyle.css'
            ]
        ],
        'uiCss' => [
            'target' => 'D:/wnmp/www/gitapi/cheyiweb/static/css/ui.css',
            'source' => [
                        'D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/themes/bootstrap/easyui.css',
                        'D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/themes/icon.css',
                        'D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/themes/bootstrap/bootstrap.min.css',
                        'D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/themes/bootstrap/components.css',
            ]
        ],
        'uijs' => [
            'target' => 'D:/wnmp/www/gitapi/cheyiweb/static/js/ui.js',
            'source' => [
                'D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/jquery.min.js',
                'D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/js/jquery-migrate-1.2.1.min.js',
                'D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/jquery.easyui.min.js',
                'D:/wnmp/www/gitapi/cheyiweb/static/ui/jquery-easyui-1.4.2/easyui.common.js',
                'D:/wnmp/www/gitapi/cheyiweb/static/js/miniui/utils.js',
                'D:/wnmp/www/gitapi/cheyiweb/static/ns/b2c/member/js/ser_common.js',
            ]
        ]
    ];

	public function init()
	{
		parent::init();
		
	}

	private function createFile($groupFile)
	{
	    $minify = new Minify\CSS();
	    $minify->setImportExtensions([]);
	    foreach ($groupFile['source'] as $file){
	        if (!file_exists($file)){
	            echo "$file not exists!!!";exit;
	        }
	        $minify->add($file);
	    }
	    $minify->minify($groupFile['target']);
	    echo $groupFile['target'] . "success!!!<br/>";
	}
	
	/**
	 * @return array
	 */
    public function run()
    {
	   $group = ArrayHelper::getValue($_GET, 'g');
	   if (isset($this->config[$group])){
	       $this->createFile($this->config[$group]);
	   }else{
	       foreach ($this->config as $groupFile){
	           $this->createFile($groupFile);
	       }
	   }
    }
}
