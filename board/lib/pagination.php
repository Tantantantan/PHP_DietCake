<?php
class Pagination{
	
    const max_rows = 3;         //number of rows displays
	const page_limit = 6;		//number of link pages
    public static $current_page;

	public static function setcurrentpage($page){
        if ($page>1){
            self::$current_page = preg_replace('/[^0-9]/', '', $page);
        }
       return (int)self::$current_page;
    }//current page

    public static function setendpage($total_rows){
        if ($total_rows <= self::max_rows) {
            return 1;
        }
        return ceil($total_rows/self::max_rows);
    }//end page

	public static function BuildPages($page_number,$total_rows){
		
        $numrows = $total_rows;

		if (isset($page_number)) {
           	self::$current_page = preg_replace('/[^0-9]/', '', $page_number);
        }//set page number and make sure it is a number from 0 to 9

        $page_links = '';	//page link initializtion
        if (is_integer(self::$current_page)){
        	$previous_page = $current_page - 1;
        	$next_page = $current_page + 1;
        	$left_pagenum = $current_page - self::page_limit;
        	$right_pagenum = $current_page + self::page_limit;
        }

        if ($numrows != 1){
        	$page_links .= self::PreviousLinks($current_page, $previous_page);
        }

        for ($i = $left_pagenum; $i < $current_page; $i++) {
                $page_links .= self::LeftLinks($i);
            }            
            
            $page_links .= '' . $current_page . " "; //added spaces every links
            
            for ($i = $next_page; $i <= $numrows; $i++) {
                $page_links .= self::RightLinks($i,$right_pagenum);
            }

             $page_links .= self::NextLinks($current_page, $last, $next_page);

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

    	public static function NextLinks($page_number, $last, $next_page)
    	{	
    		if ($page_number != $last){
                return ' <a href="?page=' . $next_page . '">Next</a> ';
            }
            else{
                 return null;       
            }
    	}
}

?>