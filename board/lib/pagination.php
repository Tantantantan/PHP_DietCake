<?php
class Pagination{

    const MAX_ROWS = 3;         //number of rows displays
    const PAGE_LIMITS = 3;      //number of link pages
    public static $current_page = 1;
    
    public static function setEndPage($total_rows){
        if ($total_rows <= self::MAX_ROWS) {
            return 1;
        }
        return ceil($total_rows/self::MAX_ROWS);
    }//end page

    public static function buildPages($page_number,$total_rows){

        $last_page = self::setEndPage($total_rows);

        if (isset($page_number)) {
           	self::$current_page = preg_replace('/[^0-9]/', '', $page_number);
        }//set page number and make sure it is a number from 0 to 9

        $page_links = '';	//page link initializtion
        $previous_page = self::$current_page - 1;
        $next_page = self::$current_page + 1;
        $left_pagenum = self::$current_page - self::PAGE_LIMITS;
        $right_pagenum = self::$current_page + self::PAGE_LIMITS;

        if ($last_page != 1){
            $page_links .= self::PreviousLinks(self::$current_page, $previous_page);
        }

        for ($i = $left_pagenum; $i < self::$current_page; $i++) {
            $page_links .= self::LeftLinks($i);
        }            
        
        $page_links .= '' . self::$current_page . " "; //added spaces every links
            
        for ($i = $next_page; $i <= $last_page; $i++) {
            $page_links .= self::RightLinks($i,$right_pagenum);
        }

        $page_links .= self::NextLinks(self::$current_page, $last_page, $next_page);
        return $page_links;
    }//end of page_links

    ##############################used methods in BuildPages()######################################

        public static function PreviousLinks($page_number, $previous_page)
        {
            if ($page_number > 1){
            return '<a href="?page=' . $previous_page . '">Previous</a> ';
            }
            else{
            return null;
            }
            
        }

        public static function LeftLinks($page_number)
        {  
            if ($page_number > 0){
                return '<a href="?page=' . $page_number . '">' . $page_number . '</a> '; 
            }
            else{
                return null;
            }
        
        }

        public static function RightLinks($page_number, $right_pagenumber)
        {
            if ($page_number <= $right_pagenumber) {
                return '<a href="?page=' . $page_number . '">' . $page_number . '</a> ' ;
            }
            else{
                return null;
            }
        }

        public static function NextLinks($page_number, $last_page, $next_page)
        {
            if ($page_number != $last_page){
                return ' <a href="?page=' . $next_page . '">Next</a> ';
            }
            else{
                 return null;       
            }
        }
}
?>