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
        'password' => ($password)
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
						'password' => ($password),
                        'id_role' => $role,
						'aktivita_uctu' => 2,
                ));
        }	
		
	public function editUser($id, $id_role, $meno,$password,$aktivita)
      {
                return $this->findBy(array('id' => $id ))->update(array(
                        
                        
                        'name' => $meno,
						'password' => ($password),
                        'id_role' => $id_role,
						'aktivita_uctu' => $aktivita,
                ));
        }		
		
			public function editUserActivity($id,$aktivita)
      {
                return $this->findBy(array('id' => $id ))->update(array(
                        
                        
                      						'aktivita_uctu' => $aktivita,
                ));
        }			
		

		
}

