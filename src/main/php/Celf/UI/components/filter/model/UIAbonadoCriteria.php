<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\AbonadoCriteria;

/**
 * Representa un criterio de b�squeda
 * para abonados.
 * 
 * @author Marcos
 * @since 04/05/2018
 *
 */
class UIAbonadoCriteria extends UICelfCriteria{


	private $apellido;
	private $nombre;
	private $categoria;
	private $calle;
	private $telefono;
	
	
	public function __construct(){

		parent::__construct();

	}
		
	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	
	protected function newCoreCriteria(){
		return new AbonadoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setApellido( $this->getApellido() );
		$criteria->setCategoria( $this->getCategoria() );
		$criteria->setTelefono( $this->getTelefono() );
		$criteria->setNombre( $this->getNombre() );
		$criteria->setCalle( $this->getCalle() );
		
		return $criteria;
	}


	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	    $this->categoria = $categoria;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getCalle()
	{
	    return $this->calle;
	}

	public function setCalle($calle)
	{
	    $this->calle = $calle;
	}
}