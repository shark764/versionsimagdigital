<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImgCtlProyeccionEstablecimientoAdmin extends Admin
{
    protected $baseRouteName    = 'simagd_proyeccion_establecimiento';
    protected $baseRoutePattern = 'rayos-x-proyeccion-realizable';

    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->remove('delete');
        $collection->add('agregarProyeccionEnLocal', null, [], [], ['expose' => true]);
        $collection->add('crearProyeccionLocal', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('editarProyeccionLocal', null, [], ['_method' => 'POST'], ['expose' => true]);
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('habilitarLocal', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idAreaExamenEstab.idAreaServicioDiagnostico', null, array('label' => 'Modalidad'))
            ->add('idAreaExamenEstab.idAreaServicioDiagnostico.imgCodigo', null, array('label' => 'Código de modalidad'))
            ->add('idAreaExamenEstab.idExamenServicioDiagnostico', null, array('label' => 'Examen'))
            ->add('idAreaExamenEstab.idExamenServicioDiagnostico.idsexo', null, array('label' => 'Aplica al sexo'))
            ->add('idAreaExamenEstab.idExamenServicioDiagnostico.imgCodigo', null, array('label' => 'Código de examen'))
            ->add('idProyeccion', null, array('label' => 'Proyección imagenológica'))
            ->add('idProyeccion.codigo', null, array('label' => 'Código de proyección'))
            ->add('fechaHoraReg', null, array('label' => 'Se registró'))
            ->add('habilitado', null, array('label' => 'Habilitada'))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Proyección')
                ->with('Ingreso en Catálogo', array('class' => 'col-md-6', 'description' => 'Con este formulario puede agregar esta proyección a su catálogo local'))->end()
            ->end()
        ;

        $imgAtn = '97';
        $subject = $this->getSubject();

        $formMapper
            ->tab('Proyección')
                ->with('Ingreso en Catálogo')
                    ->add('idAreaServicioDiagnostico', 'entity', array(
                                                            'label' => 'Modalidad',
                                                            'required' => false,
                                                            'mapped' => false,
                                                            'class' => 'MinsalSiapsBundle:CtlAreaServicioDiagnostico',
                                                            'query_builder' => function(EntityRepository $er ) use ($imgAtn ) {
                                                                                    return $er->obtenerModalidadesImagenologia ($imgAtn);
                                                                            },
                                                            'empty_value' => '',
                                                            'group_by' => 'idAtencion',
                                                            'help' => 'Método de diagnóstico por imagen',
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('idExamenServicioDiagnostico', 'entity', array(
                                                            'label' => 'Examen',
                                                            'required' => false, //PONER TODOS LOS QUE DEBEN SER TRUE/FALSE **************************
                                                            'mapped' => false,
                                                            'class' => 'MinsalSiapsBundle:CtlExamenServicioDiagnostico',
                                                            'query_builder' => function(EntityRepository $er ) use ($imgAtn ) {
                                                                                    return $er->obtenerExamenesImagenologia ($imgAtn);
                                                                            },
                                                            'empty_value' => '', //REVISAR TODOS LOS ADMIN PARA QUE QUEDEN BIEN LOS REQUIRED, SIZE, ETC
                                                            'group_by' => 'idsexo',
                                                            'help' => 'Examen en que se agrupa',
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')
                    ))
                    ->add('idAreaExamenEstab', 'sonata_type_model_hidden')
                    ->add('idProyeccion', null, array(
                                                            'label' => 'Proyección imagenológica',
                                                            'required' => true,
                                                            'empty_value' => '',                                    //ATENCIONES PUEDEN ESTAR EN 2 AREAS, PERO EL EMPLEADO NO
                                                            'group_by' => 'idExamenServicioDiagnostico',
                                                            'help' => 'Proyecciones realizables en el Servicio de Apoyo', //ACTIVAR CAMBIAR EMPLEADO AL ON CHANGE DE AREA TAMBIEN
                                                            'attr' => array('style' => 'min-width: 100%; max-width: 100%;')               //UTILIZAR AMBOS SELECT PARA FILTRAR
                    ))
                    ->add('idProyeccionInsertada', 'hidden', array(
                                                            'mapped' => false,
                                                            'data' => $subject->getIdProyeccion() ? $subject->getIdProyeccion()->getId() : '-1',
                    ))
                    ->add('idProyeccionTexto', 'hidden', array(
                                                            'mapped' => false,
                                                            'data' => $subject->getIdProyeccion() ? $subject->getIdProyeccion()->getNombre() : '',
                    ))
                    ->add('habilitado', null, array('label' => 'Habilitada'))
                    ->add('observaciones', 'textarea', array(
                                                            'label' => 'Observaciones',
                                                            'required' => false,
                                                            'help' => '255 carácteres hábiles',
                                                            'attr' => array('rows' => '2',
                                                                            'style' => 'resize:none',
                                                                            'maxlength' => '255',
                                                                            'placeholder' => 'Observaciones'),
                    ))
                ->end()
            ->end()
        ;
    }

    public function prePersist($pryRealizable) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $pryRealizable->setIdUserReg($user);
        $pryRealizable->setFechaHoraReg(new \DateTime('now'));
    }

    public function preUpdate($pryRealizable) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $pryRealizable->setIdUserMod($user);
        $pryRealizable->setFechaHoraMod(new \DateTime('now'));
    }

    public function validate(ErrorElement $errorElement, $pryRealizable) {
        $errorElement
            ->with('idProyeccion') //Nombre de la proyección
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Qué proyección desea agregar a su catálogo de proyecciones realizables?'))
            ->end()
            ->with('observaciones') //Observaciones Proyeccion
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end();

        //AreaExamenEstab
        if (!$pryRealizable->getIdAreaExamenEstab()) {
            $errorElement
                ->with('idAreaServicioDiagnostico')
                    ->addViolation('No puede determinarse la modalidad y examen que contienen a esta proyección')
                ->end()
                ->with('idExamenServicioDiagnostico')
                    ->addViolation('No puede determinarse la modalidad y examen que contienen a esta proyección')
                ->end();
        }

        //Modalidad --> AreaExamenEstab
        if (is_null($this->getForm()->get('idAreaServicioDiagnostico')->getData())) { $errorElement->with ('idAreaServicioDiagnostico')
                                                                        ->addViolation ('¿A cuál modalidad pertenece la proyección?')->end(); }
        //Examen --> AreaExamenEstab
        if (is_null($this->getForm()->get('idExamenServicioDiagnostico')->getData())) { $errorElement->with ('idExamenServicioDiagnostico')
                                                                        ->addViolation ('¿Cuál es el examen que agrupa a esta proyección?')->end(); }
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();

        $query->innerJoin($query->getRootAlias() . '.idAreaExamenEstab', 'mr')
                        ->andWhere('mr.idEstablecimiento = :id_est_rz')
                        ->setParameter('id_est_rz', $estabLocal);

        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:ImgCtlProyeccionEstablecimientoAdmin:explrz_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:ImgCtlProyeccionEstablecimientoAdmin:explrz_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:ImgCtlProyeccionEstablecimientoAdmin:explrz_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}