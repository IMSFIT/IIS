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
    return $this->findAll()->where('username', $username)->fetch();
}
	
	public function setPassword($id, $password)
{
    $this->getTable()->where(array('id' => $id))->update(array(
        'password' => Authenticator::calculateHash($password)
    ));
}
	
	 public function deleteUser($id)
      {
                return $this->findBy(array('id' => $id))->delete();
        }
	public function createUser($user, $username, $password,$role)
      {
                return $this->getTable()->insert(array(
                        'username' => $username,
                        //'rc_pacienta' => $rodne_cislo,
                        'name' => $user,
						'password' => Authenticator::calculateHash($password),
                        'id_role' => $role,
                ));
        }	
		
	public function editUser($id, $id_role, $meno,$password)
      {
                return $this->findBy(array('id' => $id ))->update(array(
                        
                        
                        'name' => $meno,
						'password' => Authenticator::calculateHash($password),
                        'id_role' => $id_role,
                ));
        }			
		
		
		
}

