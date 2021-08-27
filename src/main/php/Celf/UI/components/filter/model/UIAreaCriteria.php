<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\AreaCriteria;

/**
 * Representa un criterio de búsqueda
 * para clientes.
 * 
 * @author Marcos
 * @since 13/05/2020
 *
 */
class UIAreaCriteria extends UICelfCriteria{


	private $nombre;
	
	
	private $email;
	
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new AreaCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		$criteria->setEmail( $this->getEmail() );
		
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

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}
}