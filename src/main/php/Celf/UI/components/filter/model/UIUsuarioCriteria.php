<?php
namespace Celf\UI\components\filter\model;


use Celf\UI\components\filter\model\UICelfCriteria;

use Rasty\utils\RastyUtils;
use  Cose\Security\criteria\UserCriteria;

/**
 * Representa un criterio de búsqueda
 * para usuarios.
 * 
 * @author Marcos
 * @since 12/05/2020
 *
 */
class UIUsuarioCriteria extends UICelfCriteria{


	private $username;
	private $usergroupNotIn;
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new UserCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setUsernameLike( $this->getUsername() );
		$criteria->setUsergroupNotIn( $this->getUsergroupNotIn() );
		
		return $criteria;
	}


	public function getUsername()
	{
	    return $this->username;
	}

	public function setUsername($username)
	{
	    $this->username = $username;
	}

	public function getUsergroupNotIn()
	{
	    return $this->usergroupNotIn;
	}

	public function setUsergroupNotIn($usergroupNotIn)
	{
	    $this->usergroupNotIn = $usergroupNotIn;
	}
}