<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Admin extends Entity
{		 
     protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
?>