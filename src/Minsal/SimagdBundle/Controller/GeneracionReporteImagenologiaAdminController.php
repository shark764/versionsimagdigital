<?php
namespace Minsal\SimagdBundle\Controller;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SimagdBundle\Entity\ImgSolicitudEstudio;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Exception\ModelManagerException;

class GeneracionReporteImagenologiaAdminController extends Controller
{
    /**
     * Redirigir inmediatamente hacia la generación de reportes
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        return new RedirectResponse($this->admin->generateUrl('resultadoGeneracionReporte'));
    }
    
    /**
     * 
     * @return type
     */
    public function resultadoGeneracionReporteAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();
        
        $tiposEmpleado = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $tecnologos = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerTecnologosExaminantesEstab($estabLocal);
        
        $modalidades = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesSolicitadasEstab($estabLocal);
        
        $modalidadesPrc = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesPreinscritasEstab($estabLocal);
        
        $modalidadesDiag = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesDiagnosticadasEstab($estabLocal);
        
        $expedientes = $em->getRepository('MinsalSiapsBundle:MntPaciente')->obtenerPacientesAtendidosImagenologiaEstab($estabLocal);
        
        $preinscriptores = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerEmpleadosPreinscriptoresEstab($estabLocal);
        
        $radiologos = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerRadiologosInterpretes($estabLocal)->getQuery()->getResult();
        
        return $this->render($this->admin->getTemplate('resultadoGeneracionReporte'),
                array('tecnologos' => $tecnologos,
                        'tiposEmpleado' => $tiposEmpleado,
                        'modalidades' => $modalidades,
                        'modalidadesPrc' => $modalidadesPrc,
                        'modalidadesDiag' => $modalidadesDiag,
                        'expedientes' => $expedientes,
                        'preinscriptores' => $preinscriptores,
                        'radiologos' => $radiologos
                ));
    }
    
    /**
     * 
     * @return type
     */
    public function generarReporteImagenologicoAction()  {
        /** Captura de parámetros generales */
        $report_format = $this->get('request')->query->get('report_format');
        $report_selector = $this->get('request')->query->get('report_selector');
        $limite_resultados = $this->get('request')->query->get('limite_resultados');
        
        /** Establecimiento en el que se genera */
        $estabLocal = $this->container->get('security.context')->getToken()
                                                    ->getUser()->getIdEstablecimiento()->getId();
        
        $jasperReport = $this->container->get('jasper.build.reports');
        
        $report_path = "/reportes/imagenologia/";
        $report_params = array();
        $report_name = "";
        
        $report_params['limite'] = $limite_resultados ? $limite_resultados : 1000;
        
        switch ($report_selector)  {
            case 1:
                $report_name = "pacientesAtendidos";
                
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_1'));
                $fechaFin= $this->get('request')->query->get('fechaFin_1') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_1')) : new \DateTime('now');
                
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 2:
                $report_name = "pacientesAtendidosMedico";
                
                $tecnologo= $this->get('request')->query->get('tecnologoRealizo_2');
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_2'));
                $fechaFin= $this->get('request')->query->get('fechaFin_2') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_2')) : new \DateTime('now');
                
                $report_params['tecnologo'] = $tecnologo;
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 3:
                $report_name = "examenesRealizados";
                
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_3'));
                $fechaFin= $this->get('request')->query->get('fechaFin_3') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_3')) : new \DateTime('now');
                
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 4:
                $report_name = "examenesRealizadosModalidad";
                
                $modalidad= $this->get('request')->query->get('modalidadRealizada_4');
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_4'));
                $fechaFin= $this->get('request')->query->get('fechaFin_4') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_4')) : new \DateTime('now');
                
                $report_params['modalidad'] = $modalidad;
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 5:
                $report_name = "examenesRealizadosPaciente";
                
                $paciente= $this->get('request')->query->get('pacienteAtendido_5');
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_5'));
                $fechaFin= $this->get('request')->query->get('fechaFin_5') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_5')) : new \DateTime('now');
                
                $report_params['paciente'] = $paciente;
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 6:
                $report_name = "examenesRealizadosTecnologo";
                
                $tecnologo= $this->get('request')->query->get('tecnologoRealizo_6');
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_6'));
                $fechaFin= $this->get('request')->query->get('fechaFin_6') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_6')) : new \DateTime('now');
                
                $report_params['tecnologo'] = $tecnologo;
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 7:	
                $report_name = "estudiosSolicitadosMedicoModalidad";
                
                $preinscriptor= $this->get('request')->query->get('preinscriptorEstudio_7');
                $modalidad= $this->get('request')->query->get('modalidadPreinscrita_7');
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_7'));
                $fechaFin= $this->get('request')->query->get('fechaFin_7') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_7')) : new \DateTime('now');
                
                $report_params['preinscriptor'] = $preinscriptor;
                $report_params['modalidad'] = $modalidad;
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 8:
                $report_name = "estudiosDiagnosticadosRadiologoModalidad";
                
                $radiologo= $this->get('request')->query->get('radiologoDiagnostico_8');
                $modalidad= $this->get('request')->query->get('modalidadDiagnosticada_8');
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_8'));
                $fechaFin= $this->get('request')->query->get('fechaFin_8') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_8')) : new \DateTime('now');
                
                $report_params['radiologo'] = $radiologo;
                $report_params['modalidad'] = $modalidad;
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            case 9:
                $report_name = "pacientesAtendidosTecnologoModalidad";
                
                $tecnologo= $this->get('request')->query->get('tecnologoAtendio_9');
                $modalidad= $this->get('request')->query->get('modalidadRealizada_9');
                $fechaIni= \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaIni_9'));
                $fechaFin= $this->get('request')->query->get('fechaFin_9') ?
                                    \DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaFin_9')) : new \DateTime('now');
                
                $report_params['tecnologo'] = $tecnologo;
                $report_params['modalidad'] = $modalidad;
                $report_params['fechaIni'] = $fechaIni->format('d-m-Y');
                $report_params['fechaFin'] = $fechaFin->modify('+1 day')->format('d-m-Y');
                $report_params['establecimiento'] = $estabLocal;
                break;
            default:
                break;
        }
        
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath($report_path);
        $jasperReport->setReportParams($report_params);
//        var_dump($report_name);
//        var_dump($report_format);
//        var_dump($report_path);
//        var_dump($report_params);
        return $jasperReport->buildReport();
    }
}
