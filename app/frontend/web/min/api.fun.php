<?php

function getGroupData($groupConfigList)
{
    $data = [];
    foreach ($groupConfigList as $key => $group) {
        $data[$key] = $group['source'];
    }
    return $data;
}

function saveFile($path, $content)
{
    //echo substr($content, 0, 3);die;
    //$encode = mb_detect_encoding($content); 
    //$content = mb_convert_encoding($content, 'ASCII', 'UTF-8');
    
    $content =  (pack("CCC",0xef,0xbb,0xbf) === substr($content, 0, 3))
    ? substr($content, 3)
    : $content;
    @file_put_contents($path, $content);
}

function getGroupConfig()
{
    $staticUrl = 'D:/wnmp/www/gitapi/cheyiweb/static';
    $memberWebUrl = 'D:/wnmp/www/gitapi/cheyiweb/b2c/member/web';
    return [
            'js' => [
                'documentRoot' => $staticUrl,
                'target' => $staticUrl . '/js/all.js',
                'source' => [
                    $staticUrl . '/ui/jquery-easyui-1.4.2/jquery.min.js',
                        $staticUrl . '/ns/b2c/member/js/jquery-migrate-1.2.1.min.js',
                        $staticUrl . '/ui/jquery-easyui-1.4.2/jquery.easyui.min.js',
                        $staticUrl . '/ui/jquery-easyui-1.4.2/easyui.common.js',
                        $staticUrl . '/js/miniui/utils.js',
                        $staticUrl . '/ns/b2c/member/js/ser_common.js'
                    ],
                ],
        'webcss' =>
                [
                    'documentRoot' => $memberWebUrl,
                    'target' => $memberWebUrl . '/members.css',
                    'source' => [
                        $memberWebUrl . '/assets/css/buttons.css',
                        $memberWebUrl . '/assets/css/font-awesome.min.css',
                        $memberWebUrl . '/assets/css/switch.css',
                        $memberWebUrl . '/assets/css/common.css',
                    ]
                ],
        'css' => [
            'documentRoot' => $staticUrl . '',
            'target' => $staticUrl . '/css/base.css',
            'source' => [
                $staticUrl . '/ns/b2c/member/css/ser_common.css',
                $staticUrl . '/ns/b2c/member/css/ucenter.css',
                $staticUrl . '/ns/b2c/member/css/collection-attr.css',
                $staticUrl . '/ns/b2c/member/css/ser_newstyle.css'
            ]
        ],
        'ui' => [
            'documentRoot' => $staticUrl . '',
            'target' => $staticUrl . '/css/ui.css',
            'source' => [
                $staticUrl . '/ui/jquery-easyui-1.4.2/themes/bootstrap/easyui.css',
                $staticUrl . '/ui/jquery-easyui-1.4.2/themes/icon.css',
                $staticUrl . '/ui/jquery-easyui-1.4.2/themes/bootstrap/bootstrap.min.css',
                $staticUrl . '/ui/jquery-easyui-1.4.2/themes/bootstrap/components.css',
            ]
        ],
    ];
}