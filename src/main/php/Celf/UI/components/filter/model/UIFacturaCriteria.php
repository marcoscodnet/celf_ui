<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\FacturaCriteria;

/**
 * Representa un criterio de b�squeda
 * para abonados.
 * 
 * @author Marcos
 * @since 27/11/2018
 *
 */
class UIFacturaCriteria extends UICelfCriteria{


	private $suministro;
	
	
	
	public function __construct(){

		parent::__construct();

	}
	
	
	public function getSuministro()
	{
	    return $this->suministro;
	}

	public function setSuministro($suministro)
	{
	    $this->suministro = $suministro;
	}

	
	
	
	protected function newCoreCriteria(){
		return new FacturaCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
		
		//$criteria = new FacturaCriteria();
				
		$criteria->setSuministro( $this->getSuministro() );
		
		
		return $criteria;
	}


	
}