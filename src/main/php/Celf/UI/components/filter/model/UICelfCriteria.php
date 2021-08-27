<?php
namespace Celf\UI\components\filter\model;

use Rasty\Grid\filter\model\UICriteria;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;

/**
 * Representa un criterio de b�squeda.
 * 
 * @author Marcos
 *
 */
abstract class UICelfCriteria extends UICriteria{

	const SI = 2;
	const NO = 1;
	
	/**
	 * @var Criteria
	 */
	protected abstract function newCoreCriteria();
	
	public function buildCoreCriteria(){
		
		$criteria = $this->newCoreCriteria();
				
		$criteria->setOrders( $this->getOrders() );
		
		//paginación.
		$criteria->setMaxResult( $this->getRowPerPage() );
		
		$offset = (($this->getPage()-1) * $this->getRowPerPage() ) ;
		$criteria->setOffset( $offset );
		
					
		
		
		return $criteria;
	}

	
}