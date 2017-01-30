<?php

/*
 * This file is part of the simagdigital package.
 *
 * (c) Farid Hernández <farid.hdz.64@gmail.com>
 *
 */

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class MinsalSimagdBundleGeneralAdmin extends Admin
{
    //////// << Imagenología >>
    const ___XRAY_CLINICAL_SERVICE___   = '97';
    ////////

    const ___CLASS_REGEX_MINIMAL___     = '^[a-zA-Z0-9_-]+$';
    const ___CLASS_REGEX_GENERAL___     = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$';
    const ___CLASS_REGEX_EXTENDED___    = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()\^\[\]\{\}\\\/\'"_-\s]+$';
    const ___CLASS_REGEX_TEXT_ONLY___   = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ,\.()_-\s]+$';
    const ___CLASS_REGEX_NUMBER_ONLY___ = '^[0-9,\.-\s]+$';

    /**
     * @var \UserInterface
     */
    protected $___session_system_USER_LOGGED___;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    protected $___session_system_USER_LOGGED_EMPLOYEE___;

    /**
     * @var \string
     */
    protected $___session_system_USER_LOGGED_EMPLOYEE_CODE___ = '';

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    protected $___session_system_USER_LOGGED_LOCATION___;

    /**
     * Get ___session_system_USER_LOGGED___
     *
     * @return \UserInterface 
     */
    public function getSessionSystemUserLogged()
    {
        return $this->___session_system_USER_LOGGED___;
    }

    /**
     * Get ___session_system_USER_LOGGED_EMPLOYEE___
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getSessionSystemUserLoggedEmployee()
    {
        return $this->___session_system_USER_LOGGED_EMPLOYEE___;
    }

    /**
     * Get ___session_system_USER_LOGGED_EMPLOYEE_CODE___
     *
     * @return \string 
     */
    public function getSessionSystemUserLoggedEmployeeCode()
    {
        return $this->___session_system_USER_LOGGED_EMPLOYEE_CODE___;
    }

    /**
     * Get ___session_system_USER_LOGGED_LOCATION___
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getSessionSystemUserLoggedLocation()
    {
        return $this->___session_system_USER_LOGGED_LOCATION___;
    }

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    // public function __construct($code, $class, $baseControllerName)
    // {
    //     parent::__construct($code, $class, $baseControllerName);
    // }

    public function prepareAdminInstance()
    {
        $container          = $this->getConfigurationPool()->getContainer();
        $securityContext    = $container->get('security.context');
        $session_USER       = $securityContext->getToken()->getUser();

        try {
            $this->___session_system_USER_LOGGED___             = $session_USER;    //////// --| user logged
            $this->___session_system_USER_LOGGED_EMPLOYEE___    = $session_USER->getIdEmpleado();   //////// --| employee asociated
            $this->___session_system_USER_LOGGED_LOCATION___    = $session_USER->getIdEstablecimiento();    //////// --| location asociated

            if ($this->___session_system_USER_LOGGED_EMPLOYEE___ !== null)
            {
                $this->___session_system_USER_LOGGED_EMPLOYEE_CODE___   = $this->___session_system_USER_LOGGED_EMPLOYEE___->getIdTipoEmpleado()->getCodigo();
            }
        }
        catch (Exception $e)
        {
        }
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->remove('delete');
        $collection->add('delete', 'borrar', [], [], ['expose' => true]);
        $collection->add('create', 'crear', [], [], ['expose' => true]);
        $collection->add('edit', 'editar', [], [], ['expose' => true]);
        $collection->add('list', 'listar', [], [], ['expose' => true]);
        $collection->add('show', 'consultar', [], [], ['expose' => true]);
    }
    
    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:CRUD:base_edit.html.twig';
                break;
            case 'list':
            //     return 'MinsalSimagdBundle:CRUD:base_list.html.twig';
            //     break;
            case 'show':
            //     return 'MinsalSimagdBundle:CRUD:base_show.html.twig';
            //     break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    // public function getFormTheme()
    // {
    //     return array_merge(
    //         parent::getFormTheme(),
    //         array('MinsalSimagdBundle:Form:simagd_form_admin_fields.html.twig'),
    //         array('MinsalSimagdBundle:Form:simagd_doctrine_orm_form_admin_fields.html.twig')
    //    );
    // }

    public function prePersist($entity)
    {
        $entity->setIdUserReg($this->___session_system_USER_LOGGED___);
        $entity->setFechaHoraReg(new \DateTime('now'));
    }
    
    public function preUpdate($entity)
    {
        $entity->setIdUserMod($this->___session_system_USER_LOGGED___);
        $entity->setFechaHoraMod(new \DateTime('now'));
    }
    
    public function getNewInstance()
    {
        $instance = parent::getNewInstance();

        $instance->setFechaHoraReg(new \DateTime('now'));
        $instance->setIdUserReg($this->___session_system_USER_LOGGED___);
        
        return $instance;
    }

}