<?php



use  Nette\Security,
        Nette\Utils\Strings;


/**
 * Users authenticator.
 */
class Authenticator extends Nette\Object implements Security\IAuthenticator
{
        /** @var UserRepository */
        private $users;



        public function __construct(Todo\UserRepository $users)
        {
                $this->users = $users;
        }



        /**
         * Performs an authentication.
         * @return Nette\Security\Identity
         * @throws Nette\Security\AuthenticationException
         */
        public function authenticate(array $credentials)
        {
                list($username, $password) = $credentials;
    			$row = $this->users->findByName($username);

			    if (!$row) 
				{
        				throw new   Nette\Security\AuthenticationException("Užívateľ '$username' sa nenašiel.", self::IDENTITY_NOT_FOUND);
    			}

   				 if ($row->password !== self::calculateHash($password, $row->password)) {
        			throw new   Nette\Security\AuthenticationException("Neplatné heslo.", self::INVALID_CREDENTIAL);
   			 }
				
    			unset($row->password);
    				return new    Nette\Security\Identity($row->id, $row->role->nazov, $row->toArray());
        }



        /**
         * @param  int $id
         * @param  string $password
         */
        public function setPassword($id, $password)
        {
                $this->users->findBy(array('id' => $id))->update(array(
                        'password' => $this->calculateHash($password),
                ));
        }



        /**
         * Computes salted password hash.
         * @param string
         * @return string
         */
        public static function calculateHash($password, $salt = NULL)
        {
               if ($salt === null) 
			   {
        		$salt = '$2a$07$' . Nette\Utils\Strings::random(22);
    			}
			    return crypt($password, $salt);
        		}

}