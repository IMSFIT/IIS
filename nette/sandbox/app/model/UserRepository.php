<?php
namespace Todo;
use Nette;

/**
 * Tabulka user
 */
class UserRepository extends Repository
{
	public function findByName($username)
	{
    	return $this->findAll()->where('login', $username)->fetch();
	}
	
	public function setPassword($id, $password)
	{
    	$this->getTable()->where(array('id' => $id))->update(array(
        'password' => Authenticator::calculateHash($password)));
	}
	
	 public function createUser($user, $username, $password,$role)
      {
                return $this->getTable()->insert(array(
                        'username' => $username,
                        //'rc_pacienta' => $rodne_cislo,
                        'name' => $user,
						'password' => $password,
                        'id_role' => $role,
                ));
        }
}

