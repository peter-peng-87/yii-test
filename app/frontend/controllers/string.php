<?php
$string = 'var $hello_world; 
    var $goods_list=234;  
    $min_goods_num = 87; 
    $item_987_op ;
    $index_num = 2;
    echo $goods_store[$index_num]
    ';
echo "source:" . $string;
echo "current:" . preg_replace('/(\$\w+)/ies', "\$this->convertUnderline('\\1', false)", $string);

/**
 * 
 * @param string  $str
 * @param boolean $ucfirst 首字母是否大写
 * @return string
 */
function convertUnderline($str, $ucfirst = true)
{
    $str = ucwords(str_replace('_', ' ', $str));
    $str = str_replace(' ', '', lcfirst($str));
    $str = $ucfirst ? ucfirst($str) : $str;
    return $str;
}
