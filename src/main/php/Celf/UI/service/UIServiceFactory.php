<?php

namespace Celf\UI\service;


/**
 * Factory de servicios de UI
 *  
 * @author Marcos
 * @since 04/05/2018
 *
 */
class UIServiceFactory {

	

	/**
	 * @return UIUserService
	 */
	public static function getUIUserService(){
	
		return UIUserService::getInstance();	
	}
	
	

	
	/**
	 * @return UIAbonadoService
	 */
	public static function getUIAbonadoService(){
	
		return UIAbonadoService::getInstance();	
	}
	
	/**
	 * @return UICorreoService
	 */
	public static function getUICorreoService(){
	
		return UICorreoService::getInstance();	
	}
	
	
	
	/**
	 * @return UINecrologicaService
	 */
	public static function getUINecrologicaService(){
	
		return UINecrologicaService::getInstance();	
	}
	
	/**
	 * @return UIFacturaService
	 */
	public static function getUIFacturaService(){
	
		return UIFacturaService::getInstance();	
	}
	
	/**
	 * @return UIRegistracionService
	 */
	public static function getUIRegistracionService(){
	
		return UIRegistracionService::getInstance();	
	}
	
	/**
	 * @return UIUsuarioService
	 */
	public static function getUIUsuarioService(){
	
		return UIUsuarioService::getInstance();	
	}
	
	/**
	 * @return UIAsociadoService
	 */
	public static function getUIAsociadoService(){
	
		return UIAsociadoService::getInstance();	
	}
	
	/**
	 * @return UIAreaService
	 */
	public static function getUIAreaService(){
	
		return UIAreaService::getInstance();	
	}
	
	/**
	 * @return UITipoReclamoService
	 */
	public static function getUITipoReclamoService(){
	
		return UITipoReclamoService::getInstance();	
	}
	
	/**
	 * @return UIEstadoReclamoService
	 */
	public static function getUIEstadoReclamoService(){
	
		return UIEstadoReclamoService::getInstance();	
	}
	
	/**
	 * @return UIReclamoService
	 */
	public static function getUIReclamoService(){
	
		return UIReclamoService::getInstance();	
	}
	
	/**
	 * @return UIInstanciaReclamoService
	 */
	public static function getUIInstanciaReclamoService(){
	
		return UIInstanciaReclamoService::getInstance();	
	}
}