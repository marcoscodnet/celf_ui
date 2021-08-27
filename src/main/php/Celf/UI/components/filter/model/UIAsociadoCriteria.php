<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\AsociadoCriteria;

/**
 * Representa un criterio de búsqueda
 * para clientes.
 * 
 * @author Marcos
 * @since 12/05/2020
 *
 */
class UIAsociadoCriteria extends UICelfCriteria{


	private $nombre;
	
	private $texto;
	
	private $documento;
	
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
		return new AsociadoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombreApellido( $this->getTexto() );
		$criteria->setDocumento( $this->getDocumento() );
		
		return $criteria;
	}


	public function getTexto()
	{
	    return $this->texto;
	}

	public function setTexto($texto)
	{
	    $this->texto = $texto;
	}

	

	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}
}