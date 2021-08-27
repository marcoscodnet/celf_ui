<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use Celf\Core\criteria\InstanciaReclamoCriteria;

/**
 * Representa un criterio de búsqueda
 * para instancias.
 * 
 * @author Marcos
 * @since 17/05/2020
 *
 */
class UIInstanciaReclamoCriteria extends UICelfCriteria{


	private $reclamo;
	private $desde;
	private $hasta;
	private $desdeDesde;
	private $desdeHasta;
	private $hastaDesde;
	private $hastaHasta;
	private $estadoReclamo;
	
	
	public function __construct(){

		parent::__construct();

	}
		
	
	
	protected function newCoreCriteria(){
		return new InstanciaReclamoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setReclamo( $this->getReclamo() );
		$criteria->setDesde( $this->getDesde() );
		$criteria->setHasta( $this->getHasta() );
		$criteria->setDesdeDesde( $this->getDesdeDesde() );
		$criteria->setDesdeHasta( $this->getDesdeHasta() );
		$criteria->setHastaDesde( $this->getHastaDesde() );
		$criteria->setHastaHasta( $this->getHastaHasta() );
		$criteria->setEstadoReclamo( $this->getEstadoReclamo() );
		
		return $criteria;
	}


	

	

	

	

	public function getEstadoReclamo()
	{
	    return $this->estadoReclamo;
	}

	public function setEstadoReclamo($estadoReclamo)
	{
	    $this->estadoReclamo = $estadoReclamo;
	}

    public function getReclamo()
    {
        return $this->reclamo;
    }

    public function setReclamo($reclamo)
    {
        $this->reclamo = $reclamo;
    }

    public function getDesde()
    {
        return $this->desde;
    }

    public function setDesde($desde)
    {
        $this->desde = $desde;
    }


    public function getDesdeDesde()
    {
        return $this->desdeDesde;
    }

    public function setDesdeDesde($desdeDesde)
    {
        $this->desdeDesde = $desdeDesde;
    }

    public function getDesdeHasta()
    {
        return $this->desdeHasta;
    }

    public function setDesdeHasta($desdeHasta)
    {
        $this->desdeHasta = $desdeHasta;
    }

    public function getHastaDesde()
    {
        return $this->hastaDesde;
    }

    public function setHastaDesde($hastaDesde)
    {
        $this->hastaDesde = $hastaDesde;
    }

    public function getHastaHasta()
    {
        return $this->hastaHasta;
    }

    public function setHastaHasta($hastaHasta)
    {
        $this->hastaHasta = $hastaHasta;
    }

    public function getHasta()
    {
        return $this->hasta;
    }

    public function setHasta($hasta)
    {
        $this->hasta = $hasta;
    }
}