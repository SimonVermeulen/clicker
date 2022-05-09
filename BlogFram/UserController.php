<?php
namespace BlogFram;
 
use \BlogFram\BackController;
use \BlogFram\HTTPRequest;
use \BlogFram\Entity;
use \BlogFram\UserEntity;
 
class UserController extends BackController
{
  public function executeChangePassword(HTTPRequest $request)
  {
	$this->page->addVar('title', 'Changement de mot de passe');
    
    if ($request->postExists('checkCode') && $request->postExists('password') && $request->postExists('confirmPassword'))
    {
      $checkCode = $_POST['checkCode'];
      
      $newPassword = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];
      
      $userId = $request->getData('playerId');
      
      $username = $this->managers->getManagerOf('User')->getUsernameById($userId);
      
      $usernameTest = $username[0];
      
      $user = $this->managers->getManagerOf('User')->getUnique($usernameTest);
      $scrapPassword = substr($user->password(), 12, 5);

      if($newPassword == $confirmPassword &&  $scrapPassword == $checkCode)
      {
		$user->setPassword($newPassword);
		
    	if ($user->isValid())
    	{
      		$this->managers->getManagerOf('User')->save($user);
    	}
    	else
    	{
      		$this->page->addVar('erreurs', $user->erreurs());
    	}
      }
    }
  }

  public function executeLostPassword(HTTPRequest $request)
  {
    if ($request->postExists('username') && $request->postExists('email'))
    {
      $user = $this->managers->getManagerOf('User')->getUnique($request->postData('username'));
      $email = $_POST['email'];
      
      $checkCode = substr($user->password(), 12, 5);
      
      if($email == $user->email());
      {
        $msg = $this->app->config()->get('mail_message');
        $msg .= ": " . $checkCode . "\n Cliquez sur le lien ci-dessous pour changer votre mot de passe : \n http://project-05-oc.simon-vermeulen.fr/changePassword-". $user->id() .".html";
        
        $subject = $this->app->config()->get('subject');
        $cible = $this->app->config()->get('cible');
        
        mail($cible,$subject,$msg);
      }
    }
  }
  
  public function executeRegister(HTTPRequest $request)
  {
    if ($request->postExists('username') && $request->postExists('email'))
    {
      $this->processForm($request);
      $this->app->user()->setFlash('Le nom d\'utilisateur ou le mot de passe est incorrect.');
      $this->app->httpResponse()->redirect('/register.html');
    }
 
    $this->page->addVar('title', 'Inscription');
  }

  public function processForm(HTTPRequest $request)
  {
    $user = new UserEntity([
      'username' => $request->postData('username'),
      'email' => $request->postData('email'),
      'adminBool' => 0,
      'password' => $request->postData('password')
    ]);

    // L'identifiant du chapitre est transmis si on veut la modifier.
    if ($request->postExists('id'))
    {
      $user->setId($request->postData('id'));
    }
 
    if ($user->isValid())
    {
      $this->managers->getManagerOf('User')->save($user);
    }
    else
    {
      $this->page->addVar('erreurs', $user->erreurs());
    }
 
    $this->page->addVar('user', $user);
  }


  public function executeLogin(HTTPRequest $request)
  {
    if ($request->postExists('username'))
    {  
      $user = $this->managers->getManagerOf('User')->getUnique($request->postData('username'));
      $password = $request->postData('password');
      
	  if($user->password() !== null)
      {
        if (password_verify($password, $user->password()))
        {
          $this->app->user()->setAuthenticated(true);
          $this->app->user()->setAttribute('username', $user->username());
		  $this->app->user()->setFlash('Vous êtes maintenant connectés');
          $this->app->httpResponse()->redirect('/login.html');
        }
        else
        {
          $this->app->user()->setFlash('Le nom d\'utilisateur ou le mot de passe est incorrect.');
        }
      }
      else
      {
		  $this->app->user()->setFlash('Le nom d\'utilisateur ou le mot de passe est incorrect.');
      }
    }

    $this->page->addVar('title', 'Connexion');
  }

  public function executeIndexFront(HTTPRequest $request)
  {
      if ($this->app->user()->isAuthenticated())
      {
        $this->isConnected($request);
      }  	
      else
      {
        $this->isNotConnected($request);
      }
  }
  
  public function isConnected(HTTPRequest $request)
  {
    $user = $this->managers->getManagerOf('User')->getUnique($this->app->user()->getAttribute('username'));
    
    $this->page->addVar('indexfront', 1);
    
    if($this->managers->getManagerOf('clicPC')->getListOf($user->id()) !== NULL && $this->managers->getManagerOf('clicPS')->getListOf($user->id() !== NULL))
    {
      $clicPCUser = $this->managers->getManagerOf('clicPC')->getListOf($user->id());
      $clicPSUser = $this->managers->getManagerOf('clicPS')->getListOf($user->id());

      $this->page->addVar('clicPCUser', $clicPCUser);
      $this->page->addVar('clicPSUser', $clicPSUser);
    }
  
    else if(isset($_SESSION['entitiesPS']))
    {
      $entitiesPS = $_SESSION['entitiesPS'];
      $entitiesPC = $_SESSION['clicker'];
      $value = $_SESSION['value'];
		
      $this->page->addVar('clicPSSession', $entitiesPS);
      $this->page->addVar('clicPCSession', $entitiesPC);
      $this->page->addVar('value', $value);
    }
    else
    {
      $clicPCDefault = $this->managers->getManagerOf('clicPC')->getUnique(1);
      $clicPSDefault = $this->managers->getManagerOf('clicPS')->getList(0, 16);

      $this->page->addVar('clicPCDefault', $clicPCDefault);
      $this->page->addVar('clicPSDefault', $clicPSDefault);
    }
  }

  public function isNotConnected(HTTPRequest $request)
  {
	$this->page->addVar('indexfront', 1);
    
    if(isset($_SESSION['entitiesPS']))
    {
      $entitiesPS = $_SESSION['entitiesPS'];
      $entitiesPC = $_SESSION['clicker'];
      $value = $_SESSION['value'];
      
      $this->page->addVar('clicPSSession', $entitiesPS);
      $this->page->addVar('clicPCSession', $entitiesPC);
      $this->page->addVar('value', $value);
    }
    else
    {
      $clicPCDefault = $this->managers->getManagerOf('clicPC')->getUnique(1);
      $clicPSDefault = $this->managers->getManagerOf('clicPS')->getList(0, 16);

      $this->page->addVar('clicPCDefault', $clicPCDefault);
      $this->page->addVar('clicPSDefault', $clicPSDefault);
    }
  }
  
  
  public function executeSave(HTTPRequest $request)
  {
	  $this->processFormSave($request);
      $this->page->addVar('title', 'Save');
  }
  
  public function processFormSave(HTTPRequest $request)
  {
	  $entityPS = $_POST['array'];
      $entityPC = $_POST['clicker'];
      $value = $_POST['value'];

      $arrayPS = [];
    
      if ($this->app->user()->isAuthenticated())
      {
            $userEntity = $this->managers->getManagerOf('User')->getUnique($this->app->user()->getAttribute('username'));  
            foreach($entityPS as $entities)
            {
               $entity = new ClicPSEntity($entities);

               if($entity->playerID() !== 0 && $entity->id() <= 16)
               {
                  $entity->setId(NULL);
               }

               $entity->setPlayerID($userEntity->Id());
               
			   array_push($arrayPS, $entity);
               
               $this->managers->getManagerOf('clicPS')->save($entity);
            }

            $entityClicker = new ClicPCEntity($entityPC);
            if($entityClicker->playerID() !== 0 && $entityClicker->id() <= 1)
            {
              $entityClicker->setID(NULL);
            }

            $entityClicker->setPlayerID($userEntity->id());

            $this->managers->getManagerOf('clicPC')->save($entityClicker);

            $userEntity->setValue($value);

            $this->managers->getManagerOf('User')->save($userEntity);
       
            $_SESSION['entitiesPS'] = $arrayPS;
            $_SESSION['clicker'] = $entityClicker;
            $_SESSION['value'] = $value;	
       }
       else
       { 
			$this->app->user()->setFlash('Merci de vous inscrire ou vous connecter pour sauvegarder');
            
            foreach($entityPS as $entities)
            {
               $entity = new ClicPSEntity($entities);
               array_push($arrayPS, $entity);
            }

			$entityClicker = new ClicPCEntity($entityPC);
            
            $_SESSION['entitiesPS'] = $arrayPS;
            $_SESSION['clicker'] = $entityClicker;
            $_SESSION['value'] = $value;	
       }
  }
}
