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
use Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes;
use Minsal\SimagdBundle\Controller\OrigenDatoController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\DBAL as DBAL;

class RyxProcedimientoRadiologicoRealizadoAdmin extends Admin {

    protected $baseRouteName    = 'simagd_realizado';
    protected $baseRoutePattern = 'rayos-x-examenes-realizados';
    private $status_exp = 0; /* Variable para difenciar si el establecimiento es local o remoto */
    private $expedienteV; /* guarda el objeto expediente */
    private $entidadConexion; /* guarda la entidad conexion util para generar una conexion a una BD */

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        // $collection->remove('delete');
        $collection->add('addPendingToWorkList', null, [], [], ['expose' => true]);
        // $collection->add('mostrarInformacionModal', null, [], [], ['expose' => true]);
        $collection->add('obtenerEstudioRealizado', null, [], [], ['expose' => true]);
        // $collection->add('getObjectVarsAsArray', null, [], ['_method' => 'POST'], ['expose' => true]);
        $collection->add('diagnostico', 'iniciar-diagnostico', [], [], ['expose' => true]);
        $collection->add('registrarEstudioAlmacenado', null, [], [], ['expose' => true]);
        $collection->add('actualizarEstudioAlmacenado', null, [], [], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');

        $sessionUser = $securityContext->getToken()->getUser();

        $formMapper
            // ->tab('Registro post-examen', array('class' => 'tab-registro-rx', 'tab_icon' => 'glyphicon glyphicon-adjust'))
                ->with('Registro general', array('class' => 'prz-with-registro-general col-md-12', 'description' => ''))->end()
                ->with('Procedimiento realizado e incidencias', array('class' => 'col-md-12', 'description' => ''))->end()
            // ->end()
            // ->tab('Materiales e insumos', array('class' => 'tab-materiales-rx', 'tab_icon' => 'glyphicon glyphicon-shopping-cart'))
                ->with('Listado de Materiales utilizados', array('class' => 'col-md-12', 'description' => ''))->end()
            // ->end()
        ;

        $estabLocal = $sessionUser->getIdEstablecimiento()->getId();

        $setLockEstado = false;

//        if ($this->id($subject)) {
//
//            $setLockEstado = $this->getConfigurationPool()->getContainer()->get('doctrine')
//                                            ->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')
//                                                        ->estudioPreinscritoFueAlmacenado($subject->getIdSolicitudEstudio()->getId());
//
//        }

        $pndR = $this->getRequest()->get('__pndR', null);

        $formMapper
            // ->tab('Registro post-examen')
                ->with('Registro general')
                    ->add('idSolicitudEstudio', 'sonata_type_model_hidden', array(), array('admin_code' => 'minsal_simagd.admin.img_solicitud_estudio'))
                    ->add('idCitaProgramada', 'sonata_type_model_hidden')
                    ->add('idSolicitudEstudioComplementario', 'sonata_type_model_hidden')
		    ->add('idExamenPendienteIniciado', 'hidden', array(
                                                        'mapped' => false,
                                                        'data' => $pndR
		    ))
                    ->add('idTecnologoRealiza', null, array(
                                                        'label' => 'Realiza',
                                                        'required' => true,
                                                        'empty_value' => '',
                                                        'query_builder' => function(EntityRepository $er) use ($estabLocal) {
                                                                                return $er->obtenerEmpleadosRayosXCargoV2($estabLocal, array(4, 5));
                                                                            },
                                                        'group_by' => 'idTipoEmpleado',
//                                                        'help' => 'Tecnólogo que realiza el examen',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-apply-formatter' => 'user',
									'data-apply-formatter-mode' => $setLockEstado ? 'disabled' : 'enabled',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                    ))
                    ->add('idEstadoProcedimientoRealizado', null, array(
                                                        'label' => 'Estado',
                                                        'required' => true,
							'empty_value' => '',
//                                                         'expanded' => true,
//                                                         'multiple' => false,
// 							'help' => 'Seleccione un estado',
                                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
									'data-select2-formatter' => 'studyStatus',

									'data-fv-notempty' => 'true',
									'data-fv-notempty-message' => 'Seleccione un elemento',
							)
                    ))
                    ->add('hipotesisDiagnostica', 'textarea', array(
                                                        'label' => 'Hipótesis diagnóstica del examinante',
                                                        'required' => false,
//                                                        'help' => '150 carácteres hábiles',
                                                        'attr' => array('rows' => '2',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '150',
                                                                        'placeholder' => 'Digite su hipótesis diagnóstica del estudio',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '150',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))
                    ->add('equipoUtilizado', null, array(
                                                        'label' => 'Equipo utilizado en toma de examen',
                                                        'attr' => array('maxlength' => '100',
                                                                        'placeholder' => 'Equipo en que se realizó el examen',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-eye-close',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '5',
									'data-fv-stringlength-max' => '100',
									'data-fv-stringlength-message' => '5 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))
                    ->add('setLockEstado', 'hidden', array(
                                                    'mapped' => false,
                                                    'data' => $setLockEstado
                    ))
                ->end()
                ->with('Procedimiento realizado e incidencias')
                    ->add('tecnicaUtilizada', 'textarea', array(
                                                        'label' => 'Técnica utilizada para el examen',
                                                        'required' => false,
//                                                        'help' => '150 carácteres hábiles',
                                                        'attr' => array('rows' => '2',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '150',
                                                                        'placeholder' => 'Técnica que empleó en la toma del examen',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '150',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))
                    ->add('salaRealizado', null, array(
                                                        'label' => 'Sala en que se realizó',
                                                        'attr' => array('maxlength' => '50',
                                                                        'placeholder' => 'Sala en que se llevó a cabo la toma del examen',

                                                                        'data-add-input-addon' => 'true',
                                                                        'data-add-input-addon-class' => 'primary-v4',
                                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-home',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '1',
									'data-fv-stringlength-max' => '50',
									'data-fv-stringlength-message' => '1 caracter mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9;,:\.()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
							)
                    ))
                    ->add('incidencias', 'textarea', array(
                                                        'label' => 'Incidencias ocurridas',
                                                        'required' => false,
//                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '3', //ESTANDARIZAR LOS TAMAÑOS DE LOS TEXTAREA
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Digite las incidencias ocurridas durante la toma del examen',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '15',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '15 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Necesita llenar este campo',
									'data-fv-callback-callback' => 'checkEstadoProcedimientoRealizado',
							)
                    ))
                    ->add('fechaNacimientoIndeterminada', null, array('label' => 'Fecha de nacimiento no determinada'))
                    ->add('observaciones', 'textarea', array(
                                                        'label' => 'Observaciones',
                                                        'required' => false,
//                                                        'help' => '255 carácteres hábiles',
                                                        'attr' => array('rows' => '3',
                                                                        'style' => 'resize:none',
                                                                        'maxlength' => '255',
                                                                        'placeholder' => 'Digite sus observaciones',

									'data-fv-stringlength' => 'true',
									'data-fv-stringlength-min' => '5',
									'data-fv-stringlength-max' => '255',
									'data-fv-stringlength-message' => '5 caracteres mínimo',

									'data-fv-regexp' => 'true',
									'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
									'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',

									'data-fv-callback' => 'true',
									'data-fv-callback-message' => 'Necesita llenar este campo',
									'data-fv-callback-callback' => 'checkParentsProcedimientoRealizado',
							)
                    ))
                ->end()
            // ->end()
            // ->tab('Materiales e insumos')
                ->with('Listado de Materiales utilizados')
                    ->add('materialUtilizadoV2', 'sonata_type_collection', array(
                                                    'label' =>'Materiales que se utilizaron'),
//                                                    'help' => 'Seleccione los materiales utilizados'),// 'cascade_validation' => true,),
                                                    array('edit' => 'inline', 'inline' => 'table'))
                ->end()
            // ->end()
        ;
    }

    public function prePersist($realizado)
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $realizado->setIdUserReg($user);
        $realizado->setFechaRegistro(new \DateTime('now'));
        $realizado = $this->fechaHoraPorEstado($realizado);

        foreach ($realizado->getMaterialUtilizadoV2() as $materialUtilizadoV2) {
            $materialUtilizadoV2->setIdProcedimientoRealizado($realizado);
        }

        if ($this->hasSubject()) {
	    if ($this->getForm()->get('idExamenPendienteIniciado')->getData()) {
		$pndR = $this->getForm()->get('idExamenPendienteIniciado')->getData();
		$em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion');
		$pndRzReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion', $pndR);

		/** Asignar iniciado en registro en lista vigente */
		$realizado->addExamenPendienteRealizar($pndRzReference);
	    }
        }

	foreach ($realizado->getExamenPendienteRealizar() as $examenPendiente) {
	    $examenPendiente->setIdProcedimientoIniciado($realizado);
	    /** Renovar fecha de ingreso en lista con cada update (no Almacenado) */
	    $examenPendiente->setFechaIngresoLista(new \DateTime('now'));
	}
    }

    public function preUpdate($realizado)
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $realizado->setIdUserMod($user);
        $realizado = $this->fechaHoraPorEstado($realizado);

        foreach ($realizado->getMaterialUtilizadoV2() as $materialUtilizadoV2) {
            $materialUtilizadoV2->setIdProcedimientoRealizado($realizado);
        }

        foreach ($realizado->getExamenPendienteRealizar() as $examenPendiente) {
            $examenPendiente->setIdProcedimientoIniciado($realizado);
            /** Renovar fecha de ingreso en lista con cada update (no Almacenado) */
            $examenPendiente->setFechaIngresoLista(new \DateTime('now'));
        }
    }

    public function postPersist($realizado)
    {
        global $status_exp;
        parent::postPersist($realizado);
        if ($status_exp == 1) {
            $this->crearRyxEstudioPorImagenes($realizado);
            //$this->getRequest()->getSession()->getFlashBag()->add('error', 'No existen estudios asociados al paciente << con #Expediente >> verifique si el estudio ha sido enviado al PACS');
        }
    }

    public function postUpdate($realizado)
    {
        global $status_exp;
        parent::postUpdate($realizado);
        if ($status_exp == 1) {
            $this->crearRyxEstudioPorImagenes($realizado);
            //$this->getRequest()->getSession()->getFlashBag()->add('error', 'No existen estudios asociados al paciente << con #Expediente  >> verifique si el estudio ha sido enviado al PACS');
        }
    }

    public function crearRyxEstudioPorImagenes($object) {
        global $entidadConexion, $expedienteV;

        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
        $estabLocal = $sessionUser->getIdEstablecimiento();

        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getEntityManager();

        /* Recuperar los valores de la conexion y asignarlos a una variable */
        foreach ($entidadConexion as $entity) {
            $nombreConexion = trim($entity->getNombreConexion());
            $ip = trim($entity->getIp());
            $userdb = trim($entity->getUsuario());
            $clave = trim($entity->getClave());
            $puerto = $entity->getPuerto();
            $nombreBase = trim($entity->getNombreBaseDatos());
            $idmotor = $entity->getIdMotor();
            $idconexion = $entity->getId();
        }

        /* Obtengo la conexion generica para conectarse a cualquier PACS */
        $conn = $this->getConexionGenerica('consulta_sql', $idmotor, $idconexion);

        $nu_exp = $expedienteV->getNumero();
        /* Crear consulta para busqueda */
        /* la consulta devuelve el study_iuid y el pat_id */
        $sentenciaSQL = "select study_iuid,pat_id from patient pat inner join study st on pat.pk = st.patient_fk where pat_id ='$nu_exp' and study_status = 0";

        /* Realizo la consulta */
        $consulta = $this->consultaSQL($sentenciaSQL, $conn);

        if ($consulta[0]=='s')
	{
	    $this->getRequest()->getSession()->getFlashBag()->add('error', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
	    return 0;
        }

        /* VER CUANDO NO HAY CONSULTA COMO VALIDAR ESO XD */

        /* Cerrar la conexion */
        $conn->close();

        if ($consulta)/* Si devuelve parametros del paciente entra al IF y asocia estudios */ {
            list($uid, $pac) = explode("-", $consulta);

            /* si no existe crear una nueva insercion en img_estudio_paciente */

            /* Limpiar espacios en blanco de la ip ingresada */
            $ip = trim($ip);
            /* Creo un nuevo estudio para el paciente */
            $estudioPaciente = new RyxEstudioPorImagenes();

            /* setear los atributos de la entidad RyxEstudioPorImagenes */
            $estudioPaciente->setIdEstablecimiento($estabLocal);
            $estudioPaciente->setIdExpediente($expedienteV);
            $estudioPaciente->setFechaEstudio(new \DateTime('now'));
            $estudioPaciente->setEstudioUid($uid);
            $estudioPaciente->setSeriesUid($consulta);
            $estudioPaciente->setServidor('MINSAL');
            $estudioPaciente->setIdProcedimientoRealizado($object);
            if ($object->getIdSolicitudEstudioComplementario()) {
		$estudioPaciente->setIdEstudioPadre($object->getIdSolicitudEstudioComplementario()->getIdEstudioPadre());
            }

           // $estudioPaciente->setUrl("http://$ip:8080/oviyam2/viewer.html?patientID=$pac&studyUID=$uid");
            $estudioPaciente->setUrl("http://$ip:8080/weasis-pacs-connector/viewer.jnlp?studyUID=$uid");


            /* Persistir el objeto estudioPaciente */
            $em->persist($estudioPaciente);
            /* Guardar los cambios */
            $em->flush();
            /* Crear conexion en al PACS para actualizar el campo de estudio asociado */
            $conn = $this->getConexionGenerica('consulta_sql', $idmotor, $idconexion);
            /* Sentencia para actualizar la BD del PACS */
            $sentencia = "update study set study_status = 1 where study_iuid = '$uid'";
            /* Actualizar Campo study status en Base Remota. */
            $result = $this->actualizarBaseRemota($conn, $sentencia);
            $conn->close();
        }
    }

    /* ME QUE CREA UNA CONEXION GENERICA AL PACS DEL ESTABLECIMIENTO QUE
      REALIZA EL ESTUDIO */

    public function getConexionGenerica($objeto_prueba, $idmotor, $idconexion)
    {
        $req = $this->getRequest();
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getEntityManager();

        try {
            if ($objeto_prueba == 'base_datos') {
                $motor = $em->find('MinsalSimagdBundle:RyxCtlMotorBd', $idmotor);
                $datos = array('dbname' => $req->get('nombreBaseDatos'),
                    'user' => trim($req->get('usuario')),
                    'password' => trim($req->get('clavefirst')),
                    'host' => trim($req->get('ip')),
                    'driver' => trim($motor->getCodigo()),
                    'port' => $req->get('puerto')
               );
            } elseif ($objeto_prueba == 'consulta_sql') {
                $conexion = $em->find('MinsalSimagdBundle:RyxCtlConexionPacsEstablecimiento', $idconexion);

                $datos = array('dbname' => $conexion->getNombreBaseDatos(),
                    'user' => trim($conexion->getUsuario()),
                    'password' => trim($conexion->getClave()),
                    'host' => trim($conexion->getIp()),
                    'driver' => trim($conexion->getIdMotor()->getCodigo()),
                    'port' => $conexion->getPuerto()
               );
                //echo trim($conexion->getUsuario())); /* Para probar si realiza la conexion al PACS */
            }
        } catch (\Exception $e) {
            throw new \PDOException($e->getMessage());
        }

        $this->driver = $datos['driver'];
        if ($datos['driver'] == 'pdo_dblib') {
            $servername = $datos['host'];
            if ($datos['port'] != '')
                $servername .= ',' . $datos['port'];
            $conn = mssql_connect($servername, $datos['user'], $datos['password']);
            mssql_select_db($datos['dbname'], $conn);
        } else {
            // Construir el Conector genérico
            $config = new DBAL\Configuration();

            $connectionParams = array(
                'dbname' => $datos['dbname'],
                'user' => $datos['user'],
                'password' => $datos['password'],
                'host' => $datos['host'],
                'driver' => $datos['driver']
           );
            if ($datos['port'] != '' and $datos['driver'] != 'pdo_sqlite') {
                $connectionParams['port'] = $datos['port'];
            }

            $conn = DBAL\DriverManager::getConnection($connectionParams, $config); /* Se crea la conexion */
        }

        return $conn;
    }

    /* METODO DEVUELVE EL RESULTADO DE LA CONSULTA SQL ENVIADA */

    public function consultaSQL($sentenciaSQL, $conn)
    {
        $retorna = null;
        try {
            if ($this->driver == 'pdo_dblib') {
                $query = mssql_query($sentenciaSQL, $conn);
                if (mssql_num_rows($query) > 0) {
                    while ($row = mssql_fetch_assoc($query))
                        $resultado['datos'][] = $row;
                    $resultado['nombre_campos'] = array_keys($resultado['datos'][0]);
                }
            } else {
                $query = $conn->query($sentenciaSQL);
                if ($query->rowCount() > 0) {
                    foreach ($query as $row) {
                        $estudio = $row['study_iuid'];
                        $paciente = $row['pat_id'];
                    }
                    $retorna = $estudio . "-" . $paciente;
                }
            }
            $resultado['conn'] = $query;
            $resultado['estado'] = 'ok';
            $resultado['mensaje'] = 'Conexion';
        } catch (\PDOException $e) {
            $retorna = 's: ' . $e->getMessage();
        } catch (DBAL\DBALException $e) {
            $retorna = 'v: ' . $e->getMessage();
        } catch (\Exception $e) {
            $resultado['mensaje'] = $this->get('translator')->trans('sentencia_error') . ' 3: ' . $e->getMessage();
        }

        return $retorna;
    }

    /* Actualiza la BD del PACS cada ves que un estudio es asociado a un paciente */

    public function actualizarBaseRemota($conn, $sentencia)
    {
        $filasAfectadas = null;
        $conn->prepare($sentencia);
        $filasAfectadas = $conn->exec($sentencia);
        return $filasAfectadas;
    }

    protected function fechaHoraPorEstado($realizado)
    {
        $estado = $realizado->getIdEstadoProcedimientoRealizado()->getCodigo();

        switch ($estado) {
            case 'ATN':
                $realizado->setFechaAtendido(new \DateTime('now'));
                break;
            case 'RLZ':
                $realizado->setFechaRealizado(new \DateTime('now'));
                break;
            case 'PRC':
                $realizado->setFechaProcesado(new \DateTime('now'));
                break;
            case 'ALM':
                $realizado->setFechaAlmacenado(new \DateTime('now'));
                break;
            default:
                break;
        }
        return $realizado;
    }

    public function validate(ErrorElement $errorElement, $realizado) {
        global $status_exp, $expediente, $entidadConexion;

        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();
        $estabLocal = $sessionUser->getIdEstablecimiento();

        $errorElement
            ->with('idTecnologoRealiza')//Tecnólogo
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿Quién es el Tecnólogo que ha realizado el examen?'))
            ->end()
            ->with('idEstadoProcedimientoRealizado') //Estado
                ->assertNotNull(array('message' => 'No ha seleccionado ningún elemento de la lista'))
                ->assertNotBlank(array('message' => '¿En qué estado se encuentra el procedimiento a realizar?'))
            ->end()
            ->with('equipoUtilizado')//Equipo Utilizado
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('tecnicaUtilizada')//Tecnica Utilizada
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('hipotesisDiagnostica')//Hipotesis Diagnostica
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('incidencias')//Incidencias Procedimiento Realizado
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('observaciones')//Observaciones Procedimiento Realizado
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end()
            ->with('salaRealizado')//Sala Realizado
                ->assertRegex(array('pattern' => "/[\'\"\\\\]/", 'match' => false,
                                    'message' => 'Este campo contiene carácteres no permitidos ( \', ", \ ). Por favor elimínelos.'))
            ->end();

        //Solicitud de estudio del estudio
        //CONTROLAR QUE SOLO PUEDA REGISTRAR UN PRZ_ALMAC... PARA UNA PREINSCRIPCION, SI YA EXISTE UNA PARA ESTA PRC, NO DEJAR
        //CONTROLAR QUE NO ACCEDA A UNA PREINSCRIPCION Q NO SEA DE SU ESTABLECIMIENTO
        //DARLE SEGURIDAD A TODOS LOS REGISTROS EN GENERAL, NO DOBLES REGISTROS, NO EDITAR QUIEN NO PUEDA, ETC
        if (!$realizado->getIdSolicitudEstudio()) {
            $errorElement->with('incidencias')
                        ->addViolation('No ha seleccionado la preinscripción, vuelva a la lista y seleccione una para examinar')
                        ->end();
        }
        //Cancelación del estudio
        if ($realizado->getIdEstadoProcedimientoRealizado() && in_array($realizado->getIdEstadoProcedimientoRealizado()->getCodigo(), array('CNL', 'DCT', 'RZD'))) {
            $errorElement
                ->with('incidencias') //Causa de rechazo
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío si ha cancelado el examen'))
                    ->assertNotBlank(array('message' => 'Debe escribir la causa de rechazo|descarto|cancelación de la realización del estudio'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                ->end();
        }
        //Posponer el estudio
        //SI SE POSPONE EL ESTUDIO DEBE SER SIEMPRE LA MISMA CITA, AL POSPONER SE DEBE REPROGRAMAR LA CITA, Y USAR EL MISMO REGISTRO DE EXAMEN
        if ($realizado->getIdEstadoProcedimientoRealizado() && in_array($realizado->getIdEstadoProcedimientoRealizado()->getCodigo(), array('PST'))) {
            $errorElement
                ->with('incidencias') //Causa de posposición
                    ->assertNotNull(array('message' => 'No puede dejar este campo vacío si ha pospuesto el examen'))
                    ->assertNotBlank(array('message' => 'Debe escribir por qué ha pospuesto la realización del estudio'))
                    ->assertLength(array('min' => 15, 'minMessage' => 'Este campo al menos debe contener 15 caracteres'))
                ->end();
        }

        /* Nueva forma de realiazar las validaciones e insercion en la tabla RyxEstudioPorImagenes */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();

 	/* Buscar conexion del PACS registrado en el establecimiento */
        $entities = $em->getRepository('MinsalSimagdBundle:RyxCtlConexionPacsEstablecimiento')->getConnectionData($estabLocal->getId());


        /* Pregunta si el procedimiento realizado se ha cambiado a almacenado
         *
         * Verifica si existe una conexion al PACS del establecimiento para poder asociar estudios con el PACS.
         */
        if ($realizado->getIdEstadoProcedimientoRealizado() && in_array($realizado->getIdEstadoProcedimientoRealizado()->getCodigo(), array('ALM'))) {

            if (!$entities) {
                $this->getRequest()->getSession()->getFlashBag()->add('warning', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
                $errorElement->with('idEstadoProcedimientoRealizado')
                        ->addViolation('No puede guardar el registro con este estado mientras no exista conexión')
                        ->end();
                $errorElement
                        ->addViolation('No Existe una conexion a su base de datos favor comunique al administrador del sistema');
            } else {
                $entidadConexion = $entities;

                /*
                 * Tiene conexión al establecimiento se va a crear una conexion al pacs del establecimiento
                 * buscara si el numero de expediente tiene un estudio con study_status = 0 (verificara si el paciente es referido
                 * o es un estudio que se realiza en el mismo establecimiento) si es asi no hay restricciones de lo contrario el
                 * estudio no ha sido enviado al pacs
                 */

                /* Comprueba si la Preinscripcion es en el mismo establecimiento o fue referido a otro establecimiento */
                if ($realizado->getIdSolicitudEstudio()->getIdEstablecimientoReferido()->getId() != $realizado->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdEstablecimiento()->getId()) {
                    $bandera = 2;
                    /* El establecimiento es distinto al del usuario tendra que buscar el expediente de ese establecimiento */
                    $nu_exp = $this->obtenerNuevoExp($realizado);
                    $expediente = $nu_exp;
                    /* Recuperar los valores de la conexion y asignarlos a una variable */
                    foreach ($entities as $entity) {
                        $nombreConexion = trim($entity->getNombreConexion());
                        $ip = trim($entity->getIp());
                        $userdb = trim($entity->getUsuario());
                        $clave = trim($entity->getClave());
                        $puerto = $entity->getPuerto();
                        $nombreBase = trim($entity->getNombreBaseDatos());
                        $idmotor = $entity->getIdMotor();
                        $idconexion = $entity->getId();
                    }

                    /* Obtengo la conexion generica para conectarse a cualquier PACS */
                    $conn = $this->getConexionGenerica('consulta_sql', $idmotor, $idconexion);


                    /* Crear consulta para busqueda */
                    /* la consulta devuelve el study_iuid y el pat_id */
                    $sentenciaSQL = "select study_iuid,pat_id from patient pat inner join study st on pat.pk = st.patient_fk where pat_id ='$nu_exp' and study_status = 0";
                   // print_r($nu_exp);
                   // return $this->render($this->admin->getTemplate('resultadosBusquedaPaciente'), array('reservas' => '1'));

      /**--------------------->>>>>>>>>>>CORREGIR
                    /* Realizo la consulta */
                    $consulta = $this->consultaSQL($sentenciaSQL, $conn);
		    if ($consulta[0]=='s')
		    {
			$this->getRequest()->getSession()->getFlashBag()->add('error', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
			return 0;
		    }
                    if ($consulta[0]=='v')
                    {
                        $this->getRequest()->getSession()->getFlashBag()->add('error', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
                            return 0;
                    }


                    /* Cerrar la conexion */
                    $conn->close();

                    if ($consulta) {
                        /* No hacer nada porque si existen estudios con status = 0 */
                        $status_exp = 1;
                        //return $this->render($this->admin->getTemplate('resultadosBusquedaPaciente'), array('reservas' => '1'));
                    } else {
                        /* Crear conexion en al PACS para actualizar el campo de estudio asociado */
                        $conn = $this->getConexionGenerica('consulta_sql', $idmotor, $idconexion);
                        /* Sentencia para actualizar la BD del PACS */
                        // $sentencia = "select study_iuid,pat_id from patient pat inner join study st on pat.pk = st.patient_fk where pat_id ='$numero'  ORDER BY st.pk DESC LIMIT 1";
                        $sentenciaSQL = "select study_iuid,pat_id from patient pat inner join study st on pat.pk = st.patient_fk where pat_id ='$nu_exp' ORDER BY st.pk DESC LIMIT 1";
                        /* Actualizar Campo study status en Base Remota. */
                        $result = $this->consultaSQL($sentenciaSQL, $conn);
			if ($result[0]=='s')
			{
                            $this->getRequest()->getSession()->getFlashBag()->add('error', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
                            return 0;
                        }
                        if ($consulta[0]=='v')
			{
			    $this->getRequest()->getSession()->getFlashBag()->add('error', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
				return 0;
			}

                        $conn->close();

                        if ($result) {
                            list($uid, $pac) = explode("-", $result);
//                                    print_r($result);
//                                return $this->render($this->admin->getTemplate('resultadosBusquedaPaciente'), array('reservas' => '1'));
                            /* Comprobar si el uid existe en img_estudio_paciente */
                            $estudioPac = $em->getRepository('MinsalSimagdBundle:RyxEstudioPorImagenes')->verificarUid($uid);
                            if ($estudioPac) {
                                // $this->getRequest()->getSession()->getFlashBag()->add('warning', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
                                $errorElement->with('idEstadoProcedimientoRealizado')
                                        ->addViolation('El estudio ya esta asociado 2')
                                        ->end();
                                $errorElement
                                        ->addViolation('El estudio ya esta asociado');
                                $this->getRequest()->getSession()->getFlashBag()->add('warning', 'El estudio del paciente ya esta asociado a su expediente');
                            } else {
                                $errorElement
                                        ->addViolation('No Existe una conexion a su base de datos favor comunique al administrador del sistema');
                                $this->getRequest()->getSession()->getFlashBag()->add('error', 'No existen estudios asociados al paciente << con #Expediente ' . $nu_exp . ' >> verifique si el estudio ha sido enviado al PACS');
                            }
                        } else {
                            $errorElement
                                    ->addViolation('No Existe una conexion a su base de datos favor comunique al administrador del sistema');
                            $this->getRequest()->getSession()->getFlashBag()->add('error', 'No existen estudios asociados al paciente << con #Expediente ' . $nu_exp . ' >> verifique si el estudio ha sido enviado al PACS');
                        }
                    }

                    $status_exp = 1;
                }/* Cierre de if que verifico si el paciente era del mismo establecimiento */
                else/* El establecimiento referido es el mismo que preinscribio */ {
                    $bandera = 1;
                    /* El establecimiento es distinto al del usuario tendra que buscar el expediente de ese establecimiento */
                    $nu_exp = $this->obtenerNuevoExp($realizado);
                    $expediente = $nu_exp;
                    /* Recuperar los valores de la conexion y asignarlos a una variable */
                    foreach ($entities as $entity) {
                        $nombreConexion = trim($entity->getNombreConexion());
                        $ip = trim($entity->getIp());
                        $userdb = trim($entity->getUsuario());
                        $clave = trim($entity->getClave());
                        $puerto = $entity->getPuerto();
                        $nombreBase = trim($entity->getNombreBaseDatos());
                        $idmotor = $entity->getIdMotor();
                        $idconexion = $entity->getId();
                    }

                    /* Obtengo la conexion generica para conectarse a cualquier PACS */
                    $conn = $this->getConexionGenerica('consulta_sql', $idmotor, $idconexion);


                    /* Crear consulta para busqueda */
                    /* la consulta devuelve el study_iuid y el pat_id */
                    $sentenciaSQL = "select study_iuid,pat_id from patient pat inner join study st on pat.pk = st.patient_fk where pat_id ='$nu_exp' and study_status = 0";

                    /* Realizo la consulta */
                    $consulta = $this->consultaSQL($sentenciaSQL, $conn);
                    if ($consulta[0]=='s')
		    {
			$this->getRequest()->getSession()->getFlashBag()->add('error', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
			return 0;
		    }

                    /* Cerrar la conexion */
                    $conn->close();

                    if ($consulta) {
                        /* No hacer nada porque si existen estudios con status = 0 */
                        $status_exp = 1;
                        //return $this->render($this->admin->getTemplate('resultadosBusquedaPaciente'), array('reservas' => '1'));
                    } else {
                        /* Crear conexion en al PACS para actualizar el campo de estudio asociado */
                        $conn = $this->getConexionGenerica('consulta_sql', $idmotor, $idconexion);
                        /* Sentencia para actualizar la BD del PACS */
                        // $sentencia = "select study_iuid,pat_id from patient pat inner join study st on pat.pk = st.patient_fk where pat_id ='$numero'  ORDER BY st.pk DESC LIMIT 1";
                        $sentenciaSQL = "select study_iuid,pat_id from patient pat inner join study st on pat.pk = st.patient_fk where pat_id ='$nu_exp' ORDER BY st.pk DESC LIMIT 1";
                        /* Actualizar Campo study status en Base Remota. */
                        $result = $this->consultaSQL($sentenciaSQL, $conn);
                        if ($result[0]=='s')
			{
                            $this->getRequest()->getSession()->getFlashBag()->add('error', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
                            return 0;
                        }

                        $conn->close();

                        if ($result) {
                            list($uid, $pac) = explode("-", $result);
//                                    print_r($result);
//                                return $this->render($this->admin->getTemplate('resultadosBusquedaPaciente'), array('reservas' => '1'));
                            /* Comprobar si el uid existe en img_estudio_paciente */
                            $estudioPac = $em->getRepository('MinsalSimagdBundle:RyxEstudioPorImagenes')->verificarUid($uid);
                            if ($estudioPac) {
                                // $this->getRequest()->getSession()->getFlashBag()->add('warning', 'No se puede guardar el registro con este estado mientras no exista una conexión.');
                                $errorElement->with('idEstadoProcedimientoRealizado')
                                        ->addViolation('El estudio ya esta asociado 2')
                                        ->end();
                                $errorElement
                                        ->addViolation('El estudio ya esta asociado');
                                $this->getRequest()->getSession()->getFlashBag()->add('warning', 'El estudio del paciente ya esta asociado a su expediente');
                            } else {
                                $errorElement
                                        ->addViolation('No Existe una conexion a su base de datos favor comunique al administrador del sistema');
                                $this->getRequest()->getSession()->getFlashBag()->add('error', 'No existen estudios asociados al paciente << con #Expediente ' . $nu_exp . ' >> verifique si el estudio ha sido enviado al PACS');
                            }
                        } else {
                            $errorElement
                                    ->addViolation('No Existe una conexion a su base de datos favor comunique al administrador del sistema');
                            $this->getRequest()->getSession()->getFlashBag()->add('error', 'No existen estudios asociados al paciente << con #Expediente ' . $nu_exp . ' >> verifique si el estudio ha sido enviado al PACS');
                        }
                    }
                }
            }//Fin de else if (!entities)
        }

        /* Finaliza la nueva forma de realizar los procesos. */
    }

    public function obtenerNuevoExp($realizado) {

        global $expedienteV;

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $paciente = $realizado->getIdSolicitudEstudio()->getIdExpediente()->getIdPaciente()->getId();

        //Establecimiento que realizara el estudio
        $estabRef = $user->getIdEstablecimiento()->getId();

        /* Obtiene el nuevo expediente */
        $expRef = $this->getModelManager()->findOneBy('MinsalSiapsBundle:MntExpediente',
                                            array('idPaciente' => $paciente, 'idEstablecimiento' => $estabRef));

        $expedienteV = $expRef; //Variable global que guarda el objeto nuevo expediente.

        //Posible correccion cuando existan mas PACS configurados en el establecimiento

        /* Numero de expediente que tiene en el establecimiento referido */
        return $expRef->getNumero();
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();

        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser = $securityContext->getToken()->getUser();

        $estabLocal = $sessionUser->getIdEstablecimiento();

        $instance->setIdEstablecimiento($estabLocal);

        //Estado inicial del registro
        $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\RyxCtlEstadoProcedimientoRealizado');
        $estadoReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxCtlEstadoProcedimientoRealizado', '3');
        $instance->setIdEstadoProcedimientoRealizado($estadoReference);

	if (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) {
	    $instance->setIdTecnologoRealiza($sessionUser->getIdEmpleado());
	}

        //Solicitud de estudio
        if ($this->hasRequest()) {
	    //Tecnologo que ha agregado
            $pndR = $this->getRequest()->get('__pndR', null);
            if ($pndR !== null) {
		if (!$instance->getIdTecnologoRealiza()) {
		    if (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) {
			$instance->setIdTecnologoRealiza($sessionUser->getIdEmpleado());
		    }
		}
		/** add Examen Lista PendienteRealizar */
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion');
                $pndRzReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion', $pndR);
                /** Asignar iniciado en registro en lista vigente */
                $instance->addExamenPendienteRealizar($pndRzReference);
            }

	    //Solicitud de estudio padre
            $preinscripcion = $this->getRequest()->get('__prc', null);
            if ($preinscripcion !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\RyxSolicitudEstudio');
                $preinscripcionReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxSolicitudEstudio', $preinscripcion);
                $instance->setIdSolicitudEstudio($preinscripcionReference);
            }

	    //Cita programada, en caso de haberse requerido
            $cita = $this->getRequest()->get('__cit', null);
            if ($cita !== null) {
		$citaProgramada = $this->getModelManager()->find('MinsalSimagdBundle:RyxCitaProgramada', $cita);
		$instance->setIdCitaProgramada($citaProgramada);

		if ($citaProgramada->getIdTecnologoProgramado() && !$instance->getIdTecnologoRealiza()) {
		    $instance->setIdTecnologoRealiza($citaProgramada->getIdTecnologoProgramado());
		}
            }

	    //Solicitud de complementario padre
            $complementario = $this->getRequest()->get('__cmpl', null);
            if ($complementario !== null) {
                $em = $this->getModelManager()->getEntityManager('Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario');
                $complementarioReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxSolicitudEstudioComplementario', $complementario);
                $instance->setIdSolicitudEstudioComplementario($complementarioReference);
            }
        }

        return $instance;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $estabLocal = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()
                                    ->getUser()->getIdEstablecimiento()->getId();

        $query->innerJoin($query->getRootAlias() . '.idSolicitudEstudio', 'prc')
                        ->andWhere('prc.idEstablecimientoReferido = :id_est_ref')
                        ->setParameter('id_est_ref', $estabLocal);

        return $query;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'MinsalSimagdBundle:RyxProcedimientoRadiologicoRealizadoAdmin:prz_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSimagdBundle:RyxProcedimientoRadiologicoRealizadoAdmin:prz_list_v2.html.twig';
                break;
            case 'show':
                return 'MinsalSimagdBundle:RyxProcedimientoRadiologicoRealizadoAdmin:prz_show.html.twig';
                break;
            case 'diagnostico':
                return 'MinsalSimagdBundle:RyxProcedimientoRadiologicoRealizadoAdmin:prz_diagnostico.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('MinsalSimagdBundle::simagd_form_admin_fields.html.twig')
       );
    }
    
}