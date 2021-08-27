<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\ReclamoCriteria;

/**
 * Representa un criterio de búsqueda
 * para clientes.
 * 
 * @author Marcos
 * @since 15/05/2020
 *
 */
class UIReclamoCriteria extends UICelfCriteria{


	private $fechaDesde;
	
	private $fechaHasta;
	
	
	
	private $estadoNotEqual;
	
	private $estado;
	
	private $usuario;
		
	private $tipoReclamo;
	
	private $estadosIn;

	private $estadosNotIn;
	
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new ReclamoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		
		$criteria->setEstadoNotEqual( $this->getEstadoNotEqual() );
		$criteria->setEstado( $this->getEstado() );
		$criteria->setTipoReclamo( $this->getTipoReclamo() );
		$criteria->setUsuario( $this->getUsuario() );
		$criteria->setEstadosIn( $this->getEstadosIn() );
		$criteria->setEstadosNotIn( $this->getEstadosNotIn() );
		
		return $criteria;
	}
	
	

	

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getEstadoNotEqual()
	{
	    return $this->estadoNotEqual;
	}

	public function setEstadoNotEqual($estadoNotEqual)
	{
	    $this->estadoNotEqual = $estadoNotEqual;
	}

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}

	public function getTipoReclamo()
	{
	    return $this->tipoReclamo;
	}

	public function setTipoReclamo($tipoReclamo)
	{
	    $this->tipoReclamo = $tipoReclamo;
	}

	public function getEstadosIn()
	{
	    return $this->estadosIn;
	}

	public function setEstadosIn($estadosIn)
	{
	    $this->estadosIn = $estadosIn;
	}

	public function getEstadosNotIn()
	{
	    return $this->estadosNotIn;
	}

	public function setEstadosNotIn($estadosNotIn)
	{
	    $this->estadosNotIn = $estadosNotIn;
	}
}