<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\EstadoReclamoCriteria;

/**
 * Representa un criterio de búsqueda
 * para clientes.
 * 
 * @author Marcos
 * @since 14/05/2020
 *
 */
class UIEstadoReclamoCriteria extends UICelfCriteria{


	private $nombre;
	
	
	
	
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new EstadoReclamoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		
		
		return $criteria;
	}
	
	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	
}