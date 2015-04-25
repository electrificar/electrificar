<?php
	class homeController extends CController{
        
        function home(){
            $this->display('/home/index.tpl');
        }
	}
?>