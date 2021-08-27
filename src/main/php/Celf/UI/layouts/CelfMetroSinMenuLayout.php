<?php

namespace Celf\UI\layouts;

use Rasty\Layout\layout\RastyLayout;

use Rasty\utils\XTemplate;
use Rasty\conf\RastyConfig;

class CelfMetroSinMenuLayout extends RastyLayout{

	
	
	public function getContent(){
		
		
		
			
		//contenido del componente..
				
		$xtpl = $this->getXTemplate( dirname(__DIR__) . "/layouts/CelfMetroSinMenuLayout.htm" );
		$xtpl->assign('WEB_PATH', RastyConfig::getInstance()->getWebPath() );
		
		$this->parseMetaTags($xtpl);
        $this->parseStyles($xtpl);
        $this->parseScripts($xtpl);
        
        
        $this->parseErrors($xtpl);
        
		
		$xtpl->assign('title', $this->oPage->getTitle());
		
		$xtpl->assign('page',   $this->oPage->render() );

		//chequeamos si hay que mostrar errores.
		
		
		$xtpl->parse("main");
		$content = $xtpl->text("main");
		
		/*
		echo "<pre>";
		var_dump($xtpl);
		echo "</pre>";
		*/
		
		return $content;
	}
	
	
	public function getType(){
		
		return "CelfMetroSinMenuLayout";
		
	}	


	protected function initStyles(){
		parent::initStyles();
		
		$webPath = RastyConfig::getInstance()->getWebPath();
		
		
		/*$this->addStyle( "$webPath/css/jquery/jVal.css");
		$this->addStyle( "$webPath/metro/css/jquery/jquery.ui.all.css");*/
		//$this->addStyle( "$webPath/metro/css/metro.css");
		//$this->addStyle( "$webPath/metro/css/rasty.css");
		//$this->addStyle( "$webPath/metro/css/rasty_custom.css");

		/*$this->addStyle( "$webPath/css/jquery.rasty.css");
		
// 		$this->addStyle( "$webPath/metro/less/metro-bootstrap.less");
		
		$this->addStyle( "$webPath/metro/css/cuentas.css");
		$this->addStyle( "$webPath/metro/css/cuentas_forms.css");
		
		$this->addStyle( "$webPath/css/jquery/imgareaselect-default.css");
		
		$this->addStyle( "$webPath/css/menu.css");*/
		
	}
	
	protected function initScripts(){
		parent::initScripts();
		
		$webPath = RastyConfig::getInstance()->getWebPath();
		
		$this->addScript( "$webPath/metro/js/jquery/jquery.min.js");



		
		
		
		
		
		

		

		
		
    	
	
		$this->addScript("$webPath/js/rasty.js");
		
		$this->addScript("$webPath/js/jquery.rasty.js");
		
		$this->addScript("$webPath/js/cuentas.js");
		$this->addScript("$webPath/js/cuentas_utils.js");
		$this->addScript("$webPath/js/cuentas_forms.js");
		
		
		$this->addScript(  "$webPath/js/jquery/jquery.inputmask.js" );
		
		
		
	}
	
	protected function initLinks(){
		parent::initLinks();
	}
	


	protected function parseMetaTags($xtpl) {

		$xtpl->assign('http_equiv', 'X-UA-Compatible');
        $xtpl->assign('meta_content', 'IE=7');
        $xtpl->parse('main.meta_tag');

        $xtpl->assign('http_equiv', 'Content-Type');
        $xtpl->parse('main.meta_tag');
        
        $xtpl->assign('name', 'viewport');
        $xtpl->assign('meta_content', 'width=device-width, initial-scale=1.0');
        $xtpl->assign('http_equiv', '');
        $xtpl->parse('main.meta_tag');
        
    }

    protected function parseStyles($xtpl) {

    	foreach ($this->getStyles() as $style) {
			$xtpl->assign('css', $style);
        	$xtpl->parse('main.style');			
		}
    }
	
	
    
	protected function parseScripts($xtpl) {

		foreach ($this->getScripts() as $script) {
			$xtpl->assign('js', $script);
        	$xtpl->parse('main.script');			
		}

    }

	protected function parseErrors($xtpl) {

		//chequemos los errores en el forward del page.
		$msg = $this->oPage->getMsgError();
		
		if( !empty($msg) ){
			
			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}			
		

    }
    
	
}
?>