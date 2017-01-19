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

class ImgPendienteTranscripcionAdmin extends Admin
{
    protected $baseRouteName    = 'simagd_sin_transcribir';
    protected $baseRoutePattern = 'rayos-x-sin-transcribir';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'lista');
        // $collection->clearExcept(array('list'));
        $collection->add('transcribir');
        $collection->add('registrarEnMiLista', null, [], [], ['expose' => true]);
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
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAtenAreaModEstab.idEstablecimiento', null, array('label' => 'Proveniente de'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerEstabSolicitadosRefDiag($estabLocal, 'idEstablecimiento', 'aams');
                                                                                                },
                                                                            'group_by' => 'idTipoEstablecimiento',
            ))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idExpediente.idPaciente', null, array('label' => 'Paciente'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerPacientesPreinscritos($estabLocal);
                                                                                                },
                                                                            'group_by' => 'primerApellido',
            ))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.idSolicitudEstudio.idAreaServicioDiagnostico', null, array('label' => 'Modalidad'), null, array(
                                                                            'expanded' => false,
                                                                            'multiple' => true,
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerModalidadesSolicitadasPreinscripcion($estabLocal);
                                                                                                },
                                                                            'group_by' => 'idAtencion',
            ))
//            ->add('idLectura.idEstudio.idProcedimientoRealizado.idTecnologoRealiza', null, array('label' => 'Realizó'))
            ->add('idLectura.idEstudio.idProcedimientoRealizado.fechaNacimientoIndeterminada', null, array('label' => 'Sin fecha de nacimiento'))
            ->add('idLectura.idEmpleado', null, array('label' => 'Interpretó'), null, array(
                                                                            'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                                    return $er->obtenerRadiologosInterpretes($estabLocal);
                                                                                                },/** Cambiar método */
                                                                            'group_by' => 'idTipoEmpleado',
            ))
            ->add('idLectura.correlativo', null, array('label' => 'Correlativo'))
//            ->add('fechaIngresoLista', null, array('label' => 'Ingresó en'))
            ->add('fueImpugnado', null, array('label' => 'Para corrección'))
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        /** SubQuery */
        $subQuery = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\ImgDiagnostico')
                        ->createQueryBuilder()
                            ->select('diag')
                            ->from('MinsalSimagdBundle:ImgDiagnostico', 'diag')
//                            ->where('diag.idEstadoDiagnostico NOT IN ( 3, 5, 6 )')
                            ->andWhere('diag.idLectura = ' . $query->getRootAlias() . '.idLectura');
        
        $sessionUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        
        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();
        
        $query->andWhere(
                            $query->expr()->eq($query->getRootAlias() . '.idEstablecimiento', ':id_est_diag')
                        )
                        ->setParameter('id_est_diag', $estabLocal);
        
        $query->andWhere($query->expr()->not($query->expr()->exists($subQuery->getDql())));
        
        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_list_v2.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}