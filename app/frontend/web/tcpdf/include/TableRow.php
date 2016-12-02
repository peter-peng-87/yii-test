<?php 
class TableRow
{
    private $header_option = ['align' => 'C', 'valign' => 'M', 'width' => []];
    private $body_option   = ['align' => 'L', 'valign' => 'T'];
    private $header_data    = [];
    private $body_data      = [];
    private $op_obj         = [];
   
    public static function install(){
        return new self();
    }
     /**
     * @return the $header_option
     */
    public function getHeaderOption($key)
    {
        return $key ? $this->header_option[$key] : $this->header_option;
    }

    /**
     * @return the $body_option
     */
    public function getBodyOption($key)
    {
        return $key ? $this->body_option[$key] : $this->body_option;
    }

    /**
     * @param multitype:string multitype:  $header_option
     */
    public function setHeaderOption($header_option)
    {
        $this->header_option = $header_option;
    }

     /**
      * @param multitype:string  $body_option
     */
    public function setBodyOption($body_option)
    {
        $this->body_option = $body_option;
    }

 /**
     * @return the $header_data
     */
    public function getHeaderData()
    {
        return $this->header_data;
    }

    /**
     * @return the $body_data
     */
    public function getBodyData()
    {
        return $this->body_data;
    }


    /**
     * @param multitype: $header_data
     */
    public function setHeaderData($header_data)
    {
        $this->header_data = $header_data;
    }

   /**
     * @param multitype: $body_data
     */
    public function setBodyData($body_data)
    {
        $this->body_data = $body_data;
    }

     /**
     * @return the $op_obj
     */
    public function getOpObj()
    {
        return $this->op_obj;
    }

    /**
     * @param multitype: $op_obj
     */
    public function setOpObj($op_obj)
    {
        $this->op_obj = $op_obj;
    }

    public function writeTableText(){
        $header = $this->getHeaderData();
        $body   = $this->getBodyData();
        $obj    = $this->getOpObj();
        if (empty($header) && empty($body)){
            return false;
        }
        if ($header){
            $this->writeRowText($header, 'h');
        }
        if ($body){
             foreach ($body as $row_list) 
             {
                  $this->writeRowText($row_list, 'b');
             }           
        }
        
    }
    
    public function writeRowText($row_list, $type){
        $obj    = $this->getOpObj();
        $height = $type == 'h' ? 20: $this->getRowMaxHeight($row_list) + 8;
        $page_start = $obj->getPage();
        $y_start = $obj->GetY();
        $page_end   = 0;
        $y_end      = 0;
        $count = count($row_list);
        $count_i = 1;
        // print_r($row_list);die;
        foreach ($row_list as $key => $content){
           
            $ln = $count_i == $count ? 2 : 1;
            $option = $this->getItemOption($type, $key);
            $x = $count_i === 1 ? '' : $obj->GetX();
            $y = $count_i === 1 ? '' : $y_start;
            $ln = $count_i == $count ? 1 : 2;
           // echo $count .":" . $count_i . "x:$x Y:$y". "<br/>";
            $obj->MultiCell($option['width'], $height, $content, 1, $option['align'], 0, $ln, $x, $y, 
                true, 0, $ishtml=false, $autopadding=true, $maxh=$height, $valign=$option['valign']);
           
            if ($count != $count_i){
                $obj->setPage($page_start);
            }
            $page_end = max($page_end, $obj->getPage());
            $y_end    = max($y_end, $obj->GetY());
            $count_i++;
            
        }   
        $obj->setPage($page_end);
        $obj->SetXY($obj->GetX(), $y_end);
       // die;
        /**
        $page_start = $obj->getPage();
        $y_start = $obj->GetY();
        
        // write the left cell
        // $w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='M'
        $m_height = 50;// $obj->getStringHeight(100, $row_list['1'], $reseth=false, $autopadding=true, 0, $border=1) + 3;
        $obj->MultiCell(40, $m_height, $row_list['2'], 1, 'R', 0, 2, '', '', true, 0, $ishtml=false, $autopadding=true, $maxh=$m_height, $valign='T');
        //echo "M:$m_height<br/>";
        $obj->setPage($page_start);
        
        $page_end_1 = $obj->getPage();
        $y_end_1 = $obj->GetY();
        $obj->MultiCell(40, $m_height, $row_list['2'], 1, 'C', 0, 2, $obj->GetX(), $y_start, true, 0,  $ishtml=false, $autopadding=true, $maxh=$m_height, $valign='M');
        
        $page_end_2 = $obj->getPage();
        $y_end_2 = $obj->GetY();
        
        $obj->setPage($page_start);
        
        // write the right cell
        $obj->MultiCell(100, $m_height, $row_list['3'], 1, 'L', 0, 1, $obj->GetX() ,$y_start, true, 0, $ishtml=false, $autopadding=true, $maxh=$m_height, $valign='T');
        //	$m_height = $obj->getStringHeight(0, $right, $reseth=false, $autopadding=false, 0, $border=1);
        //echo "Y:$m_height";die;
        $page_end_3 = $obj->getPage();
        $y_end_3 = $obj->GetY();

        // set the new row position by case

        $obj->setPage(max($page_end_1,$page_end_2, $page_end_3));
        $obj->SetXY($obj->GetX(), max($y_end_1, $y_end_2, $y_end_3));
        **/
       
    }
    
    /**
     * get row max height
     * @param array $row_list
     * @return float
     */
    private function getRowMaxHeight($row_list){
        $height = 0;
        $option = $this->getHeaderOption('width');
        $obj    = $this->getOpObj();
        foreach ($row_list as $key => $content){
            $width = floatval($option[$key]);
            $m_height = $obj->getStringHeight($width, $content, $reseth=false, $autopadding=true, 0, $border=1);
            $height   = max($height, $m_height);
        }
        return number_format($height, 2);
    }
    
    /**
     * 
     * @param string $type h:header, b:body
     * @param string $key
     * @return ['width' => '宽度', 'align' => '水平方向', 'valign' => '垂直方向']
     */
    private function getItemOption($type = 'b', $key){
        if ($type == 'h'){
            $option = $this->getHeaderOption();
        }else{
            $option = $this->getBodyOption();
        }
        
        return [
            'width'  => $option['width'][$key],
            'align'  => $option['align'],
            'valign' => $option['valign'],
        ];
    }
    
    
}