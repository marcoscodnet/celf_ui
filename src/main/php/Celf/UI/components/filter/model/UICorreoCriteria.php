<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\CorreoCriteria;

/**
 * Representa un criterio de b�squeda
 * para correos.
 * 
 * @author Marcos
 * @since 08/05/2018
 *
 */
class UICorreoCriteria extends UICelfCriteria{

	
	
	private $nombre;
	private $activo;
	private $email;
	
	
	public function __construct(){

		parent::__construct();

	}
		
	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	
	protected function newCoreCriteria(){
		return new CorreoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		$criteria->setActivo( $this->getActivo() );
		$criteria->setEmail( $this->getEmail() );
		
		return $criteria;
	}


	public function getActivo()
	{
	    return $this->activo;
	}

	public function setActivo($activo)
	{
	    $this->activo = $activo;
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