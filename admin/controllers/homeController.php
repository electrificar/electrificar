<?php
	class homeController extends CController{
        
        function home(){
        	$this->layout->assign("home", "active");
            $this->display('/home/index.tpl');
        }
	}
?>