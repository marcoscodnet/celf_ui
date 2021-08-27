<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\TipoReclamoCriteria;

/**
 * Representa un criterio de búsqueda
 * para clientes.
 * 
 * @author Marcos
 * @since 13/05/2020
 *
 */
class UITipoReclamoCriteria extends UICelfCriteria{


	private $nombre;
	
	
	private $area;
	
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new TipoReclamoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		$criteria->setArea( $this->getArea() );
		
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

	public function getArea()
	{
	    return $this->area;
	}

	public function setArea($area)
	{
	    $this->area = $area;
	}
}