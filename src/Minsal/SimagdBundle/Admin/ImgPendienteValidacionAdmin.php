<?php

namespace Minsal\SimagdBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class ImgPendienteValidacionAdmin extends Admin
{
    protected $baseRouteName = 'simagd_sin_validar';
    protected $baseRoutePattern = 'rayos-x-sin-validar';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        $collection->clearExcept(array('list'));
        $collection->add('validar');
        $collection->add('addToWorkList', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();
        
        $datagridMapper
            ->add('idDiagnostico.idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAtenAreaModEstab.idEstablecimiento', null, array('label' => 'Proveniente de'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerEstabSolicitadosRefDiag($estabLocal, 'idEstablecimiento', 'aams');
                                                                                                },
                                                                            'group_by' => 'idTipoEstablecimiento',
            ))
            ->add('idDiagnostico.idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idExpediente.idPaciente', null, array('label' => 'Paciente'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerPacientesPreinscritos($estabLocal);
                                                                                                },
                                                                            'group_by' => 'primerApellido',
            ))
            ->add('idDiagnostico.idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAreaServicioDiagnostico', null, array('label' => 'Modalidad'), null, array(
                                                                            'expanded' => false,
                                                                            'multiple' => true,
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerModalidadesSolicitadasPreinscripcion($estabLocal);
                                                                                                },
                                                                            'group_by' => 'idAtencion',
            ))
//            ->add('idDiagnostico.idLectura.idEstudio.idProcedimientoRealizado.idTecnologoRealiza', null, array('label' => 'Realizó'))
            ->add('idDiagnostico.idLectura.idEmpleado', null, array('label' => 'Interpretó'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerRadiologosInterpretes($estabLocal);
                                                                                                },/** Cambiar método */
                                                                            'group_by' => 'idTipoEmpleado',
            ))
            ->add('idDiagnostico.idEmpleado', null, array('label' => 'Transcribió'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerTranscriptoresDiagnosticos($estabLocal);
                                                                                                },/** Cambiar método */
                                                                            'group_by' => 'idTipoEmpleado',
            ))
            ->add('idDiagnostico.idLectura.correlativo', null, array('label' => 'Correlativo'))
//            ->add('fechaIngresoLista', null, array('label' => 'Ingresó en'))
            ->add('fueCorregido', null, array('label' => 'Corregido'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }
    
    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_diag')
                        )
                        ->setParameter('id_est_diag', $estabLocal);
        
        $query->innerJoin($query->getRootAlias() . '.idDiagnostico', 'diag')
			->innerJoin('diag.idLectura', 'lct')
                        ->andWhere('lct.idUserReg = :id_user')
                        ->setParameter('id_user', $sessionUser->getId());
        
        return $query;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
}
