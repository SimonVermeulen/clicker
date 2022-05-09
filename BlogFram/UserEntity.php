<?php
namespace BlogFram;

use \BlogFram\Entity;

class UserEntity extends Entity
{
  protected $username,
            $email,
            $adminBool,
            $password,
  			$value;

  public function isValid()
  {
    return !(empty($this->username) || empty($this->email) || empty($this->password));
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setAdminBool($adminBool)
  {
    $this->adminBool = $adminBool;
  }
 
  public function setPassword($password)
  {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }
  
  public function setValue($value)
  {
    $this->value = $value;
  }

  public function username()
  {
    return $this->username;
  }

  public function email()
  {
    return $this->email;
  }

  public function adminBool()
  {
    return $this->adminBool;
  }

  public function password()
  {
    return $this->password;
  }
  
  public function value()
  {
    return $this->value;
  }
}
