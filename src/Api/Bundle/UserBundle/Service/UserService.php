<?php
/**
 * Created by PhpStorm.
 * User: ilham
 * Date: 12/08/15
 * Time: 15:51
 */

namespace Api\Bundle\UserBundle\Service;

use Api\Bundle\CoreBundle\Service\AbstractService;

class UserService extends AbstractService
{
    public function __construct($em, $entity)
    {
        parent::__construct($em, $entity);
    }

    public function getModel()
    {
        return $this->model;
    }
}