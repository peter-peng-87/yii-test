<?php
class DBQuery
{
    /**
     * 批量插入或更新单表数据
     * @param string $tableName 表名
     * @param array $data 要提交更新的数据
     *        $data = array(
     *        'fields' => array(''), // 字段名称
     *        'duplicate' => array(''), // 如果遇到主键或唯一键需要更细的数据
     *        'data' => array(array('字段A' => '字段A的数据', '字段B' => '字段B的数据', ...), array()...)
     *        'actSize' => 100, // 每次执行条数
     *        );
     * @return bool 最后一次操作的返回值
     */
    public function updateList($tableName, $data)
    {
        $fields = implode("`, `", $data['fields']);
        $duplicate_key = $data['duplicate'];
        $actSize = isset($data['actSize']) && $data['actSize'] > 0 ? intval($data['actSize']) : 100;
        $totalNum = count($data['data']); // 总条数
        $sqlStart = "INSERT IGNORE INTO `{$tableName}` (`$fields`) VALUES ";
        // {{{拼接强制更新的key
        $duplicate_sql = '';
        $temp_key = array();
        
        foreach ($duplicate_key as $key) {
            $temp_key[] = "`$key`=values(`$key`)";
        }
        if (count($temp_key)) {
            $duplicate_sql = " ON DUPLICATE KEY UPDATE " . implode(" , ", $temp_key);
        }
        // }}}
        
        $sql_detail_temp = array();
        $query_result = false;
        $i = 0;
        foreach ($data['data'] as $data_detail) {
            $i ++;
            $data_detail_value = array();
            foreach ($data['fields'] as $key) {
                $data_detail_value[] = "'" . ($data_detail[$key]) . "'";
            }
            
            $sql_detail_temp[] = "(" . implode(", ", $data_detail_value) . ")";
            if ($i % $actSize == 0 || $totalNum == $i) {
                $actSql = $sqlStart . implode(", ", $sql_detail_temp) . $duplicate_sql;
                // 执行SQL todo
                $query_result = $this->dbExec($actSql);
                // 执行SQL Sucess
                $sql_detail_temp = array();
            }
        }
        return $query_result;
    }
    
    /**
     * 执行SQL
     * @param string $sql sql语句
     * @return resource
     */
    public function dbExec($sql)
    {
       return mysql_query($sql);
    }
}