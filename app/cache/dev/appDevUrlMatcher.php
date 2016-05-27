<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        // minsal_simagd_default_index
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'minsal_simagd_default_index')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\DefaultController::indexAction',));
        }

        // buscar_estudio
        if ($pathinfo === '/buscar/estudio') {
            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteController::buscarEstudioAction',  '_route' => 'buscar_estudio',);
        }

        if (0 === strpos($pathinfo, '/c')) {
            // cargar_estudio
            if ($pathinfo === '/cargar/estudio') {
                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteController::cargarEstudioJSON',  '_route' => 'cargar_estudio',);
            }

            // origen_dato_conexion_probar
            if ($pathinfo === '/conexion/probar') {
                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\OrigenDatoController::probarConexionAction',  '_route' => 'origen_dato_conexion_probar',);
            }

        }

        // origen_dato_conexion_probar_sentencia
        if ($pathinfo === '/sentencia/probar') {
            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\OrigenDatoController::probarSentenciaAction',  '_route' => 'origen_dato_conexion_probar_sentencia',);
        }

        // origen_dato_leer
        if (0 === strpos($pathinfo, '/origen_dato') && preg_match('#^/origen_dato/(?P<id>[^/]++)/leer$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'origen_dato_leer')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\OrigenDatoController::leerOrigenAction',));
        }

        // configurar_campo
        if ($pathinfo === '/configurar/campo') {
            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\OrigenDatoController::configurarCampoAction',  '_route' => 'configurar_campo',);
        }

        // origen_dato_get_campos
        if (0 === strpos($pathinfo, '/origen_dato/get_campos') && preg_match('#^/origen_dato/get_campos/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'origen_dato_get_campos')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\OrigenDatoController::getCamposAction',));
        }

        // _inicio
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_inicio');
            }

            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => '_inicio',);
        }

        // root
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'root');
            }

            return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::urlRedirectAction',  'path' => '/admin/login',  'permanent' => true,  '_route' => 'root',);
        }

        // get_departamentos
        if ($pathinfo === '/departamentos/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_departamentos;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getDepartamentosAction',  '_route' => 'get_departamentos',);
        }
        not_get_departamentos:

        // get_municipios
        if ($pathinfo === '/municipios/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_municipios;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getMunicipiosAction',  '_route' => 'get_municipios',);
        }
        not_get_municipios:

        // get_cantones
        if ($pathinfo === '/cantones/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_cantones;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getCantonesAction',  '_route' => 'get_cantones',);
        }
        not_get_cantones:

        if (0 === strpos($pathinfo, '/pais')) {
            // get_paises
            if ($pathinfo === '/paises/get') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getPaisesHabilitadosAction',  '_route' => 'get_paises',);
            }

            // get_pais_depto
            if ($pathinfo === '/pais/depto/get') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerPaisPorDeptoAction',  '_route' => 'get_pais_depto',);
            }

        }

        // obtener_usuarios_archivo
        if ($pathinfo === '/usuarios/archivos/get') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getUsuariosArchivosAction',  '_route' => 'obtener_usuarios_archivo',);
        }

        if (0 === strpos($pathinfo, '/siaps')) {
            // verify_medic_service
            if ($pathinfo === '/siaps/verify/medicservice') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::verifyMedicServiceAction',  '_route' => 'verify_medic_service',);
            }

            // set_emp_especialidad_estab
            if ($pathinfo === '/siaps/set/empespecialidad/estab') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_set_emp_especialidad_estab;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::setEmpEspecialidadEstabAction',  '_route' => 'set_emp_especialidad_estab',);
            }
            not_set_emp_especialidad_estab:

        }

        // get_areas_modalidades
        if ($pathinfo === '/areas/modalidades/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_areas_modalidades;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::getAreaModalidadAction',  '_route' => 'get_areas_modalidades',);
        }
        not_get_areas_modalidades:

        // get_especialidades_hospitalizacion
        if ($pathinfo === '/especialidades/hospitalizacion/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_especialidades_hospitalizacion;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::getEspecialidadesHospitalizacionAction',  '_route' => 'get_especialidades_hospitalizacion',);
        }
        not_get_especialidades_hospitalizacion:

        if (0 === strpos($pathinfo, '/servicios')) {
            // get_servicios
            if ($pathinfo === '/servicios/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_servicios;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::getServiciosHospitalariosAction',  '_route' => 'get_servicios',);
            }
            not_get_servicios:

            // generar_servicios_hospitalarios
            if ($pathinfo === '/servicios/hospitalarios/generar') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_generar_servicios_hospitalarios;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::generarServiciosHospitalariosAction',  '_route' => 'generar_servicios_hospitalarios',);
            }
            not_generar_servicios_hospitalarios:

        }

        // guardar_hopitalizacion
        if (0 === strpos($pathinfo, '/guardar/hospitalizacion') && preg_match('#^/guardar/hospitalizacion/(?P<sexo>[^/]++)/(?P<numero_ambientes>[^/]++)/(?P<id_aten_area_mod_estab>[^/]++)$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_guardar_hopitalizacion;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'guardar_hopitalizacion')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::guardarHospitalizacionAction',));
        }
        not_guardar_hopitalizacion:

        // get_atenciones
        if ($pathinfo === '/atenciones/get') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAreaModEstabController::getAtencionesAction',  '_route' => 'get_atenciones',);
        }

        if (0 === strpos($pathinfo, '/e')) {
            // get_especialidades
            if ($pathinfo === '/especialidades/get') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAreaModEstabController::getEspecialidadesAction',  '_route' => 'get_especialidades',);
            }

            if (0 === strpos($pathinfo, '/expedientes/creados')) {
                // expedientes_creados
                if ($pathinfo === '/expedientes/creados') {
                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteController::expedientesCreados',  '_route' => 'expedientes_creados',);
                }

                // expedientes_creados_listado
                if ($pathinfo === '/expedientes/creados/listado') {
                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteController::expedientesCreadosListado',  '_route' => 'expedientes_creados_listado',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/buscar/paciente')) {
            // buscar_paciente
            if ($pathinfo === '/buscar/paciente') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteController::buscarPacienteAction',  '_route' => 'buscar_paciente',);
            }

            // buscar_paciente_global
            if ($pathinfo === '/buscar/paciente/global') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteController::buscarPacienteGlobalAction',  '_route' => 'buscar_paciente_global',);
            }

        }

        // cargar_paciente
        if ($pathinfo === '/cargar/paciente') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteController::cargarBusquedaJSON',  '_route' => 'cargar_paciente',);
        }

        // edad_paciente
        if ($pathinfo === '/paciente/edad}') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_edad_paciente;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteController::edad_paciente',  '_route' => 'edad_paciente',);
        }
        not_edad_paciente:

        if (0 === strpos($pathinfo, '/report')) {
            // _report_show
            if (0 === strpos($pathinfo, '/report/show') && preg_match('#^/report/show/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_report_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\ReporteController::showAction',));
            }

            // _report_paciente
            if (0 === strpos($pathinfo, '/report/paciente') && preg_match('#^/report/paciente/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_report_paciente')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\ReporteController::pacienteAction',));
            }

        }

        // _exportar_reporte
        if (0 === strpos($pathinfo, '/exportar') && preg_match('#^/exportar/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_exportar_reporte')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\ReporteController::exportarReporteAction',));
        }

        // hoja_ingreso_egreso
        if (0 === strpos($pathinfo, '/hoja/ingreso/egreso') && preg_match('#^/hoja/ingreso/egreso/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'hoja_ingreso_egreso')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::hojaIngresoEgresoAction',));
        }

        // total_ingresos
        if (0 === strpos($pathinfo, '/total/ingresos') && preg_match('#^/total/ingresos/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)/(?P<fecha_inicio>[^/]++)/(?P<fecha_fin>[^/]++)(?:/(?P<id_servicio>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'total_ingresos')), array (  'id_servicio' => 0,  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::totalIngresosAction',));
        }

        // _report_seguimiento_paciente
        if (0 === strpos($pathinfo, '/report/seguimiento/paciente') && preg_match('#^/report/seguimiento/paciente/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_report_seguimiento_paciente')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::pacienteAction',));
        }

        // total_emergencias
        if (0 === strpos($pathinfo, '/total/emergencias') && preg_match('#^/total/emergencias/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)/(?P<fecha_inicio>[^/]++)/(?P<fecha_fin>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'total_emergencias')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::totalEmergenciasAction',));
        }

        // buscar_emergencias
        if ($pathinfo === '/buscar/emergencias') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaController::buscarEmergenciasAction',  '_route' => 'buscar_emergencias',);
        }

        // cargar_emergencias
        if ($pathinfo === '/cargar/emergencias') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaController::cargarEmergenciasAction',  '_route' => 'cargar_emergencias',);
        }

        // buscar_emergencias_pacientes
        if ($pathinfo === '/buscar/emergencias/pacientes') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaController::buscarEmergenciasPacienteAction',  '_route' => 'buscar_emergencias_pacientes',);
        }

        // pacientes_en_emergencia
        if ($pathinfo === '/pacientes/en/emergencia') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaController::cargarReporteEmergenciaAction',  '_route' => 'pacientes_en_emergencia',);
        }

        if (0 === strpos($pathinfo, '/obtener')) {
            // get_especialidad_ingresos
            if ($pathinfo === '/obtener/especialidades/ingresos') {
                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getEspecialidadesIngresoAction',  '_route' => 'get_especialidad_ingresos',);
            }

            if (0 === strpos($pathinfo, '/obtener/servicios/hospitalarios')) {
                // get_servicios_hospitalarios
                if ($pathinfo === '/obtener/servicios/hospitalarios') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getServiciosHospitalariosAction',  '_route' => 'get_servicios_hospitalarios',);
                }

                // get_servicios_hospitalarios_otros
                if ($pathinfo === '/obtener/servicios/hospitalarios/otros') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getServiciosHospitalariosOtrosAction',  '_route' => 'get_servicios_hospitalarios_otros',);
                }

                // get_servicios_hospitalarios_todos
                if ($pathinfo === '/obtener/servicios/hospitalarios/todos') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getServiciosHospitalariosTodosAction',  '_route' => 'get_servicios_hospitalarios_todos',);
                }

            }

        }

        // buscar_ingresos
        if ($pathinfo === '/buscar/ingresos') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::buscarIngresosAction',  '_route' => 'buscar_ingresos',);
        }

        // cargar_ingresos
        if ($pathinfo === '/cargar/ingresos') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::cargarIngresosAction',  '_route' => 'cargar_ingresos',);
        }

        // buscar_ingresos_pacientes
        if ($pathinfo === '/buscar/ingresos/pacientes') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::buscarIngresosPacienteAction',  '_route' => 'buscar_ingresos_pacientes',);
        }

        // pacientes_ingresados
        if ($pathinfo === '/pacientes/ingresado') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::cargarReporteIngresoAction',  '_route' => 'pacientes_ingresados',);
        }

        if (0 === strpos($pathinfo, '/citas')) {
            // citasdiaxmedico
            if ($pathinfo === '/citas/dia/medico/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_citasdiaxmedico;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getCitCitasDiaxMedicoAction',  '_route' => 'citasdiaxmedico',);
            }
            not_citasdiaxmedico:

            // citashorariomedico
            if ($pathinfo === '/citas/horario/medico/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_citashorariomedico;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getHorarioMedicoAction',  '_route' => 'citashorariomedico',);
            }
            not_citashorariomedico:

            // citasverificarevento
            if ($pathinfo === '/citas/verificar/evento/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_citasverificarevento;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::verifyMedicEventAction',  '_route' => 'citasverificarevento',);
            }
            not_citasverificarevento:

            // citasdetallehora
            if ($pathinfo === '/citas/detalle/hora/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_citasdetallehora;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getDetalleCitaHoraAction',  '_route' => 'citasdetallehora',);
            }
            not_citasdetallehora:

            // citasexpedientepaciente
            if ($pathinfo === '/citas/expediente/paciente/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_citasexpedientepaciente;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getExpedientePacienteAction',  '_route' => 'citasexpedientepaciente',);
            }
            not_citasexpedientepaciente:

            if (0 === strpos($pathinfo, '/citas/medicos')) {
                // citasgetmedico
                if ($pathinfo === '/citas/medicos/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citasgetmedico;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getMedicoAction',  '_route' => 'citasgetmedico',);
                }
                not_citasgetmedico:

                // citasgetmedicoespecilidadestab
                if ($pathinfo === '/citas/medicos/especilidad/estab/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citasgetmedicoespecilidadestab;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getMedicoEspecilidadEstabAction',  '_route' => 'citasgetmedicoespecilidadestab',);
                }
                not_citasgetmedicoespecilidadestab:

            }

            // citaspacienteposeecita
            if ($pathinfo === '/citas/paciente/poseecita/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_citaspacienteposeecita;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::pacientePoseeCitaAction',  '_route' => 'citaspacienteposeecita',);
            }
            not_citaspacienteposeecita:

            if (0 === strpos($pathinfo, '/citas/comproba')) {
                // citascomprobardisponibilidad
                if ($pathinfo === '/citas/comprobar/disponibilidad') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citascomprobardisponibilidad;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::comprobarDisponibilidadAction',  '_route' => 'citascomprobardisponibilidad',);
                }
                not_citascomprobardisponibilidad:

                // citasgetcomprobante
                if (0 === strpos($pathinfo, '/citas/comprobante/get') && preg_match('#^/citas/comprobante/get(?:/(?P<report_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_citasgetcomprobante;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'citasgetcomprobante')), array (  'report_format' => 'HTML',  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getComprobanteCitaAction',));
                }
                not_citasgetcomprobante:

            }

            // citasbuildcomprobante
            if (0 === strpos($pathinfo, '/citas/buildcomprobante/get') && preg_match('#^/citas/buildcomprobante/get/(?P<id>[^/]++)(?:/(?P<report_format>[^/]++))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_citasbuildcomprobante;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'citasbuildcomprobante')), array (  'report_format' => 'HTML',  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::buildComprobanteCitaAction',));
            }
            not_citasbuildcomprobante:

        }

        if (0 === strpos($pathinfo, '/admin')) {
            // sonata_admin_redirect
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
            }

            // sonata_admin_dashboard
            if ($pathinfo === '/admin/dashboard') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
            }

            if (0 === strpos($pathinfo, '/admin/core')) {
                // sonata_admin_retrieve_form_element
                if ($pathinfo === '/admin/core/get-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
                }

                // sonata_admin_append_form_element
                if ($pathinfo === '/admin/core/append-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
                }

                // sonata_admin_short_object_information
                if (0 === strpos($pathinfo, '/admin/core/get-short-object-description') && preg_match('#^/admin/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
                }

                // sonata_admin_set_object_field_value
                if ($pathinfo === '/admin/core/set-object-field-value') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
                }

            }

            // sonata_admin_search
            if ($pathinfo === '/admin/search') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
            }

            // sonata_admin_retrieve_autocomplete_items
            if ($pathinfo === '/admin/core/get-autocomplete-items') {
                return array (  '_controller' => 'sonata.admin.controller.admin:retrieveAutocompleteItemsAction',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
            }

            if (0 === strpos($pathinfo, '/admin/minsal/s')) {
                if (0 === strpos($pathinfo, '/admin/minsal/siaps')) {
                    if (0 === strpos($pathinfo, '/admin/minsal/siaps/ctlestablecimiento')) {
                        // admin_minsal_siaps_ctlestablecimiento_list
                        if ($pathinfo === '/admin/minsal/siaps/ctlestablecimiento/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_list',  '_route' => 'admin_minsal_siaps_ctlestablecimiento_list',);
                        }

                        // admin_minsal_siaps_ctlestablecimiento_batch
                        if ($pathinfo === '/admin/minsal/siaps/ctlestablecimiento/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_batch',  '_route' => 'admin_minsal_siaps_ctlestablecimiento_batch',);
                        }

                        // admin_minsal_siaps_ctlestablecimiento_edit
                        if (preg_match('#^/admin/minsal/siaps/ctlestablecimiento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlestablecimiento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_edit',));
                        }

                        // admin_minsal_siaps_ctlestablecimiento_show
                        if (preg_match('#^/admin/minsal/siaps/ctlestablecimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlestablecimiento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_show',));
                        }

                        // admin_minsal_siaps_ctlestablecimiento_export
                        if ($pathinfo === '/admin/minsal/siaps/ctlestablecimiento/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_export',  '_route' => 'admin_minsal_siaps_ctlestablecimiento_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/siaps/mnt')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntmodalidadestablecimiento')) {
                            // admin_minsal_siaps_mntmodalidadestablecimiento_list
                            if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_list',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_list',);
                            }

                            // admin_minsal_siaps_mntmodalidadestablecimiento_create
                            if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_create',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_create',);
                            }

                            // admin_minsal_siaps_mntmodalidadestablecimiento_batch
                            if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_batch',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_batch',);
                            }

                            // admin_minsal_siaps_mntmodalidadestablecimiento_edit
                            if (preg_match('#^/admin/minsal/siaps/mntmodalidadestablecimiento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_edit',));
                            }

                            // admin_minsal_siaps_mntmodalidadestablecimiento_delete
                            if (preg_match('#^/admin/minsal/siaps/mntmodalidadestablecimiento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_delete',));
                            }

                            // admin_minsal_siaps_mntmodalidadestablecimiento_show
                            if (preg_match('#^/admin/minsal/siaps/mntmodalidadestablecimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_show',));
                            }

                            // admin_minsal_siaps_mntmodalidadestablecimiento_export
                            if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_export',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mnta')) {
                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntareamodestab')) {
                                // admin_minsal_siaps_mntareamodestab_list
                                if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_list',  '_route' => 'admin_minsal_siaps_mntareamodestab_list',);
                                }

                                // admin_minsal_siaps_mntareamodestab_create
                                if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_create',  '_route' => 'admin_minsal_siaps_mntareamodestab_create',);
                                }

                                // admin_minsal_siaps_mntareamodestab_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_batch',  '_route' => 'admin_minsal_siaps_mntareamodestab_batch',);
                                }

                                // admin_minsal_siaps_mntareamodestab_edit
                                if (preg_match('#^/admin/minsal/siaps/mntareamodestab/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareamodestab_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_edit',));
                                }

                                // admin_minsal_siaps_mntareamodestab_delete
                                if (preg_match('#^/admin/minsal/siaps/mntareamodestab/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareamodestab_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_delete',));
                                }

                                // admin_minsal_siaps_mntareamodestab_show
                                if (preg_match('#^/admin/minsal/siaps/mntareamodestab/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareamodestab_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_show',));
                                }

                                // admin_minsal_siaps_mntareamodestab_export
                                if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_export',  '_route' => 'admin_minsal_siaps_mntareamodestab_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntatenareamodestab')) {
                                // admin_minsal_siaps_mntatenareamodestab_list
                                if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/list') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::listAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_list',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_list',);
                                }

                                // admin_minsal_siaps_mntatenareamodestab_create
                                if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/create') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::createAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_create',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_create',);
                                }

                                // admin_minsal_siaps_mntatenareamodestab_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/batch') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_batch',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_batch',);
                                }

                                // admin_minsal_siaps_mntatenareamodestab_edit
                                if (preg_match('#^/admin/minsal/siaps/mntatenareamodestab/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntatenareamodestab_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::editAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_edit',));
                                }

                                // admin_minsal_siaps_mntatenareamodestab_delete
                                if (preg_match('#^/admin/minsal/siaps/mntatenareamodestab/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntatenareamodestab_delete')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_delete',));
                                }

                                // admin_minsal_siaps_mntatenareamodestab_show
                                if (preg_match('#^/admin/minsal/siaps/mntatenareamodestab/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntatenareamodestab_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::showAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_show',));
                                }

                                // admin_minsal_siaps_mntatenareamodestab_export
                                if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/export') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_export',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_export',);
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntconexion')) {
                            // admin_minsal_siaps_mntconexion_list
                            if ($pathinfo === '/admin/minsal/siaps/mntconexion/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_list',  '_route' => 'admin_minsal_siaps_mntconexion_list',);
                            }

                            // admin_minsal_siaps_mntconexion_create
                            if ($pathinfo === '/admin/minsal/siaps/mntconexion/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_create',  '_route' => 'admin_minsal_siaps_mntconexion_create',);
                            }

                            // admin_minsal_siaps_mntconexion_batch
                            if ($pathinfo === '/admin/minsal/siaps/mntconexion/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_batch',  '_route' => 'admin_minsal_siaps_mntconexion_batch',);
                            }

                            // admin_minsal_siaps_mntconexion_edit
                            if (preg_match('#^/admin/minsal/siaps/mntconexion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntconexion_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_edit',));
                            }

                            // admin_minsal_siaps_mntconexion_delete
                            if (preg_match('#^/admin/minsal/siaps/mntconexion/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntconexion_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_delete',));
                            }

                            // admin_minsal_siaps_mntconexion_show
                            if (preg_match('#^/admin/minsal/siaps/mntconexion/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntconexion_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_show',));
                            }

                            // admin_minsal_siaps_mntconexion_export
                            if ($pathinfo === '/admin/minsal/siaps/mntconexion/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_export',  '_route' => 'admin_minsal_siaps_mntconexion_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntpaciente')) {
                            // admin_minsal_siaps_mntpaciente_list
                            if ($pathinfo === '/admin/minsal/siaps/mntpaciente/list') {
                                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::listAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_list',  '_route' => 'admin_minsal_siaps_mntpaciente_list',);
                            }

                            // admin_minsal_siaps_mntpaciente_create
                            if ($pathinfo === '/admin/minsal/siaps/mntpaciente/create') {
                                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::createAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_create',  '_route' => 'admin_minsal_siaps_mntpaciente_create',);
                            }

                            // admin_minsal_siaps_mntpaciente_batch
                            if ($pathinfo === '/admin/minsal/siaps/mntpaciente/batch') {
                                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_batch',  '_route' => 'admin_minsal_siaps_mntpaciente_batch',);
                            }

                            // admin_minsal_siaps_mntpaciente_edit
                            if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::editAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_edit',));
                            }

                            // admin_minsal_siaps_mntpaciente_delete
                            if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_delete')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_delete',));
                            }

                            // admin_minsal_siaps_mntpaciente_show
                            if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::showAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_show',));
                            }

                            // admin_minsal_siaps_mntpaciente_export
                            if ($pathinfo === '/admin/minsal/siaps/mntpaciente/export') {
                                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_export',  '_route' => 'admin_minsal_siaps_mntpaciente_export',);
                            }

                            // admin_minsal_siaps_mntpaciente_view
                            if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_view')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::viewAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_view',));
                            }

                            // admin_minsal_siaps_mntpaciente_buscaremergencia
                            if ($pathinfo === '/admin/minsal/siaps/mntpaciente/consulta/emergencia') {
                                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::buscaremergenciaAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_buscaremergencia',  '_route' => 'admin_minsal_siaps_mntpaciente_buscaremergencia',);
                            }

                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sec')) {
                    if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secingreso')) {
                        // admin_minsal_seguimiento_secingreso_list
                        if ($pathinfo === '/admin/minsal/seguimiento/secingreso/list') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::listAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_list',  '_route' => 'admin_minsal_seguimiento_secingreso_list',);
                        }

                        // admin_minsal_seguimiento_secingreso_create
                        if ($pathinfo === '/admin/minsal/seguimiento/secingreso/create/id_paciente') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::createAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_create',  '_route' => 'admin_minsal_seguimiento_secingreso_create',);
                        }

                        // admin_minsal_seguimiento_secingreso_batch
                        if ($pathinfo === '/admin/minsal/seguimiento/secingreso/batch') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_batch',  '_route' => 'admin_minsal_seguimiento_secingreso_batch',);
                        }

                        // admin_minsal_seguimiento_secingreso_edit
                        if (preg_match('#^/admin/minsal/seguimiento/secingreso/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secingreso_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::editAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_edit',));
                        }

                        // admin_minsal_seguimiento_secingreso_delete
                        if (preg_match('#^/admin/minsal/seguimiento/secingreso/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secingreso_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_delete',));
                        }

                        // admin_minsal_seguimiento_secingreso_show
                        if (preg_match('#^/admin/minsal/seguimiento/secingreso/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secingreso_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::showAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_show',));
                        }

                        // admin_minsal_seguimiento_secingreso_export
                        if ($pathinfo === '/admin/minsal/seguimiento/secingreso/export') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_export',  '_route' => 'admin_minsal_seguimiento_secingreso_export',);
                        }

                        // admin_minsal_seguimiento_secingreso_resumen
                        if (rtrim($pathinfo, '/') === '/admin/minsal/seguimiento/secingreso/resumen') {
                            if (substr($pathinfo, -1) !== '/') {
                                return $this->redirect($pathinfo.'/', 'admin_minsal_seguimiento_secingreso_resumen');
                            }

                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::resumenAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_resumen',  '_route' => 'admin_minsal_seguimiento_secingreso_resumen',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secemergencia')) {
                        // admin_minsal_seguimiento_secemergencia_list
                        if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/list') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::listAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_list',  '_route' => 'admin_minsal_seguimiento_secemergencia_list',);
                        }

                        // admin_minsal_seguimiento_secemergencia_batch
                        if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/batch') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_batch',  '_route' => 'admin_minsal_seguimiento_secemergencia_batch',);
                        }

                        // admin_minsal_seguimiento_secemergencia_show
                        if (preg_match('#^/admin/minsal/seguimiento/secemergencia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secemergencia_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::showAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_show',));
                        }

                        // admin_minsal_seguimiento_secemergencia_export
                        if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/export') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_export',  '_route' => 'admin_minsal_seguimiento_secemergencia_export',);
                        }

                        // admin_minsal_seguimiento_secemergencia_resumen_emergencia
                        if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/resumen/emergencia') {
                            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::resumenEmergenciaAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_resumen_emergencia',  '_route' => 'admin_minsal_seguimiento_secemergencia_resumen_emergencia',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntexpediente')) {
                    // admin_minsal_siaps_mntexpediente_list
                    if ($pathinfo === '/admin/minsal/siaps/mntexpediente/list') {
                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::listAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_list',  '_route' => 'admin_minsal_siaps_mntexpediente_list',);
                    }

                    // admin_minsal_siaps_mntexpediente_create
                    if ($pathinfo === '/admin/minsal/siaps/mntexpediente/create') {
                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::createAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_create',  '_route' => 'admin_minsal_siaps_mntexpediente_create',);
                    }

                    // admin_minsal_siaps_mntexpediente_batch
                    if ($pathinfo === '/admin/minsal/siaps/mntexpediente/batch') {
                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_batch',  '_route' => 'admin_minsal_siaps_mntexpediente_batch',);
                    }

                    // admin_minsal_siaps_mntexpediente_edit
                    if (preg_match('#^/admin/minsal/siaps/mntexpediente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntexpediente_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::editAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_edit',));
                    }

                    // admin_minsal_siaps_mntexpediente_show
                    if (preg_match('#^/admin/minsal/siaps/mntexpediente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntexpediente_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::showAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_show',));
                    }

                    // admin_minsal_siaps_mntexpediente_export
                    if ($pathinfo === '/admin/minsal/siaps/mntexpediente/export') {
                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_export',  '_route' => 'admin_minsal_siaps_mntexpediente_export',);
                    }

                    // admin_minsal_siaps_mntexpediente_listarexpedientes
                    if ($pathinfo === '/admin/minsal/siaps/mntexpediente/listarexpedientes') {
                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::listarexpedientesAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_listarexpedientes',  '_route' => 'admin_minsal_siaps_mntexpediente_listarexpedientes',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secprocedenciaingreso')) {
                    // admin_minsal_seguimiento_secprocedenciaingreso_list
                    if ($pathinfo === '/admin/minsal/seguimiento/secprocedenciaingreso/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_list',  '_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_list',);
                    }

                    // admin_minsal_seguimiento_secprocedenciaingreso_batch
                    if ($pathinfo === '/admin/minsal/seguimiento/secprocedenciaingreso/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_batch',  '_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_batch',);
                    }

                    // admin_minsal_seguimiento_secprocedenciaingreso_show
                    if (preg_match('#^/admin/minsal/seguimiento/secprocedenciaingreso/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_show',));
                    }

                    // admin_minsal_seguimiento_secprocedenciaingreso_export
                    if ($pathinfo === '/admin/minsal/seguimiento/secprocedenciaingreso/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_export',  '_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntci')) {
                    if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntcie10')) {
                        // admin_minsal_siaps_mntcie10_list
                        if ($pathinfo === '/admin/minsal/siaps/mntcie10/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_list',  '_route' => 'admin_minsal_siaps_mntcie10_list',);
                        }

                        // admin_minsal_siaps_mntcie10_batch
                        if ($pathinfo === '/admin/minsal/siaps/mntcie10/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_batch',  '_route' => 'admin_minsal_siaps_mntcie10_batch',);
                        }

                        // admin_minsal_siaps_mntcie10_show
                        if (preg_match('#^/admin/minsal/siaps/mntcie10/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntcie10_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_show',));
                        }

                        // admin_minsal_siaps_mntcie10_export
                        if ($pathinfo === '/admin/minsal/siaps/mntcie10/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_export',  '_route' => 'admin_minsal_siaps_mntcie10_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntciq')) {
                        // admin_minsal_siaps_mntciq_list
                        if ($pathinfo === '/admin/minsal/siaps/mntciq/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_list',  '_route' => 'admin_minsal_siaps_mntciq_list',);
                        }

                        // admin_minsal_siaps_mntciq_batch
                        if ($pathinfo === '/admin/minsal/siaps/mntciq/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_batch',  '_route' => 'admin_minsal_siaps_mntciq_batch',);
                        }

                        // admin_minsal_siaps_mntciq_show
                        if (preg_match('#^/admin/minsal/siaps/mntciq/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntciq_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_show',));
                        }

                        // admin_minsal_siaps_mntciq_export
                        if ($pathinfo === '/admin/minsal/siaps/mntciq/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_export',  '_route' => 'admin_minsal_siaps_mntciq_export',);
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/sonata/user/user')) {
                // admin_sonata_user_user_list
                if ($pathinfo === '/admin/sonata/user/user/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_list',  '_route' => 'admin_sonata_user_user_list',);
                }

                // admin_sonata_user_user_create
                if ($pathinfo === '/admin/sonata/user/user/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_create',  '_route' => 'admin_sonata_user_user_create',);
                }

                // admin_sonata_user_user_batch
                if ($pathinfo === '/admin/sonata/user/user/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_batch',  '_route' => 'admin_sonata_user_user_batch',);
                }

                // admin_sonata_user_user_edit
                if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_edit',));
                }

                // admin_sonata_user_user_delete
                if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_delete',));
                }

                // admin_sonata_user_user_show
                if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_show',));
                }

                // admin_sonata_user_user_export
                if ($pathinfo === '/admin/sonata/user/user/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_export',  '_route' => 'admin_sonata_user_user_export',);
                }

            }

            if (0 === strpos($pathinfo, '/admin/minsal')) {
                if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntempleado')) {
                    // admin_minsal_siaps_mntempleado_list
                    if ($pathinfo === '/admin/minsal/siaps/mntempleado/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_list',  '_route' => 'admin_minsal_siaps_mntempleado_list',);
                    }

                    // admin_minsal_siaps_mntempleado_create
                    if ($pathinfo === '/admin/minsal/siaps/mntempleado/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_create',  '_route' => 'admin_minsal_siaps_mntempleado_create',);
                    }

                    // admin_minsal_siaps_mntempleado_batch
                    if ($pathinfo === '/admin/minsal/siaps/mntempleado/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_batch',  '_route' => 'admin_minsal_siaps_mntempleado_batch',);
                    }

                    // admin_minsal_siaps_mntempleado_edit
                    if (preg_match('#^/admin/minsal/siaps/mntempleado/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntempleado_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_edit',));
                    }

                    // admin_minsal_siaps_mntempleado_delete
                    if (preg_match('#^/admin/minsal/siaps/mntempleado/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntempleado_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_delete',));
                    }

                    // admin_minsal_siaps_mntempleado_show
                    if (preg_match('#^/admin/minsal/siaps/mntempleado/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntempleado_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_show',));
                    }

                    // admin_minsal_siaps_mntempleado_export
                    if ($pathinfo === '/admin/minsal/siaps/mntempleado/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_export',  '_route' => 'admin_minsal_siaps_mntempleado_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/minsal/citas/citcitasdia')) {
                    // admin_minsal_citas_citcitasdia_list
                    if ($pathinfo === '/admin/minsal/citas/citcitasdia/list') {
                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::listAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_list',  '_route' => 'admin_minsal_citas_citcitasdia_list',);
                    }

                    // admin_minsal_citas_citcitasdia_create
                    if ($pathinfo === '/admin/minsal/citas/citcitasdia/create') {
                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::createAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_create',  '_route' => 'admin_minsal_citas_citcitasdia_create',);
                    }

                    // admin_minsal_citas_citcitasdia_edit
                    if (preg_match('#^/admin/minsal/citas/citcitasdia/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citcitasdia_edit')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::editAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_edit',));
                    }

                    // admin_minsal_citas_citcitasdia_show
                    if (preg_match('#^/admin/minsal/citas/citcitasdia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citcitasdia_show')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::showAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_show',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/rayos-x-')) {
                if (0 === strpos($pathinfo, '/admin/rayos-x-imagenologia-')) {
                    if (0 === strpos($pathinfo, '/admin/rayos-x-imagenologia-digital')) {
                        // simagd_imagenologia_digital_list
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/inicio') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_list',  '_route' => 'simagd_imagenologia_digital_list',);
                        }

                        // simagd_imagenologia_digital_busquedaPaciente
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/busqueda-paciente') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::busquedaPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_busquedaPaciente',  '_route' => 'simagd_imagenologia_digital_busquedaPaciente',);
                        }

                        // simagd_imagenologia_digital_obtenerDatosBusqueda
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/obtenerDatosBusqueda') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::obtenerDatosBusquedaAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_obtenerDatosBusqueda',  '_route' => 'simagd_imagenologia_digital_obtenerDatosBusqueda',);
                        }

                        // simagd_imagenologia_digital_resultadosBusquedaPaciente
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/resultadosBusquedaPaciente') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::resultadosBusquedaPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_resultadosBusquedaPaciente',  '_route' => 'simagd_imagenologia_digital_resultadosBusquedaPaciente',);
                        }

                        // simagd_imagenologia_digital_historialImagenologiaPaciente
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/historialImagenologiaPaciente') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::historialImagenologiaPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_historialImagenologiaPaciente',  '_route' => 'simagd_imagenologia_digital_historialImagenologiaPaciente',);
                        }

                        // simagd_imagenologia_digital_obtenerHistorialImagenologiaPaciente
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/obtenerHistorialImagenologiaPaciente') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::obtenerHistorialImagenologiaPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_obtenerHistorialImagenologiaPaciente',  '_route' => 'simagd_imagenologia_digital_obtenerHistorialImagenologiaPaciente',);
                        }

                        // simagd_imagenologia_digital_accesoDenegado
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/acceso-no-autorizado') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::accesoDenegadoAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_accesoDenegado',  '_route' => 'simagd_imagenologia_digital_accesoDenegado',);
                        }

                        // simagd_imagenologia_digital_registroNoEncontrado
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/registro-no-encontrado') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::registroNoEncontradoAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_registroNoEncontrado',  '_route' => 'simagd_imagenologia_digital_registroNoEncontrado',);
                        }

                        if (0 === strpos($pathinfo, '/admin/rayos-x-imagenologia-digital/listar')) {
                            // simagd_imagenologia_digital_listarDatosPaciente
                            if ($pathinfo === '/admin/rayos-x-imagenologia-digital/listarDatosPaciente') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::listarDatosPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_listarDatosPaciente',  '_route' => 'simagd_imagenologia_digital_listarDatosPaciente',);
                            }

                            // simagd_imagenologia_digital_listarSolicitudesEstudioPaciente
                            if ($pathinfo === '/admin/rayos-x-imagenologia-digital/listarSolicitudesEstudioPaciente') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::listarSolicitudesEstudioPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_listarSolicitudesEstudioPaciente',  '_route' => 'simagd_imagenologia_digital_listarSolicitudesEstudioPaciente',);
                            }

                            // simagd_imagenologia_digital_listarCitasPaciente
                            if ($pathinfo === '/admin/rayos-x-imagenologia-digital/listarCitasPaciente') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::listarCitasPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_listarCitasPaciente',  '_route' => 'simagd_imagenologia_digital_listarCitasPaciente',);
                            }

                            // simagd_imagenologia_digital_listarExamenesPaciente
                            if ($pathinfo === '/admin/rayos-x-imagenologia-digital/listarExamenesPaciente') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::listarExamenesPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_listarExamenesPaciente',  '_route' => 'simagd_imagenologia_digital_listarExamenesPaciente',);
                            }

                            // simagd_imagenologia_digital_listarDiagnosticosPaciente
                            if ($pathinfo === '/admin/rayos-x-imagenologia-digital/listarDiagnosticosPaciente') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::listarDiagnosticosPacienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_listarDiagnosticosPaciente',  '_route' => 'simagd_imagenologia_digital_listarDiagnosticosPaciente',);
                            }

                        }

                        // simagd_imagenologia_digital_asignarNuevoExpediente
                        if ($pathinfo === '/admin/rayos-x-imagenologia-digital/asignarNuevoExpediente') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_imagenologia_digital_asignarNuevoExpediente;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::asignarNuevoExpedienteAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_asignarNuevoExpediente',  '_route' => 'simagd_imagenologia_digital_asignarNuevoExpediente',);
                        }
                        not_simagd_imagenologia_digital_asignarNuevoExpediente:

                        if (0 === strpos($pathinfo, '/admin/rayos-x-imagenologia-digital/getJson')) {
                            // simagd_imagenologia_digital_getJsonFiltersForBsTables
                            if ($pathinfo === '/admin/rayos-x-imagenologia-digital/getJsonFiltersForBsTables') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::getJsonFiltersForBsTablesAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_getJsonFiltersForBsTables',  '_route' => 'simagd_imagenologia_digital_getJsonFiltersForBsTables',);
                            }

                            // simagd_imagenologia_digital_getJsonGroupDependentEntities
                            if ($pathinfo === '/admin/rayos-x-imagenologia-digital/getJsonGroupDependentEntities') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImagenologiaDigitalAdminController::getJsonGroupDependentEntitiesAction',  '_sonata_admin' => 'minsal_simagd.admin.imagenologia_digital',  '_sonata_name' => 'simagd_imagenologia_digital_getJsonGroupDependentEntities',  '_route' => 'simagd_imagenologia_digital_getJsonGroupDependentEntities',);
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/rayos-x-imagenologia-reportes')) {
                        if (0 === strpos($pathinfo, '/admin/rayos-x-imagenologia-reportes/reporte')) {
                            // simagd_generacion_reporte_list
                            if ($pathinfo === '/admin/rayos-x-imagenologia-reportes/reportes') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\GeneracionReporteImagenologiaAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.generacion_reporte_imagenologia',  '_sonata_name' => 'simagd_generacion_reporte_list',  '_route' => 'simagd_generacion_reporte_list',);
                            }

                            // simagd_generacion_reporte_generarReporteImagenologico
                            if ($pathinfo === '/admin/rayos-x-imagenologia-reportes/reporte') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\GeneracionReporteImagenologiaAdminController::generarReporteImagenologicoAction',  '_sonata_admin' => 'minsal_simagd.admin.generacion_reporte_imagenologia',  '_sonata_name' => 'simagd_generacion_reporte_generarReporteImagenologico',  '_route' => 'simagd_generacion_reporte_generarReporteImagenologico',);
                            }

                        }

                        // simagd_generacion_reporte_resultadoGeneracionReporte
                        if ($pathinfo === '/admin/rayos-x-imagenologia-reportes/generar-reporte') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\GeneracionReporteImagenologiaAdminController::resultadoGeneracionReporteAction',  '_sonata_admin' => 'minsal_simagd.admin.generacion_reporte_imagenologia',  '_sonata_name' => 'simagd_generacion_reporte_resultadoGeneracionReporte',  '_route' => 'simagd_generacion_reporte_resultadoGeneracionReporte',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-proyeccion')) {
                    if (0 === strpos($pathinfo, '/admin/rayos-x-proyecciones')) {
                        // simagd_proyeccion_list
                        if ($pathinfo === '/admin/rayos-x-proyecciones/lista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_list',  '_route' => 'simagd_proyeccion_list',);
                        }

                        // simagd_proyeccion_create
                        if ($pathinfo === '/admin/rayos-x-proyecciones/crear') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_create',  '_route' => 'simagd_proyeccion_create',);
                        }

                        // simagd_proyeccion_batch
                        if ($pathinfo === '/admin/rayos-x-proyecciones/batch') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_batch',  '_route' => 'simagd_proyeccion_batch',);
                        }

                        // simagd_proyeccion_edit
                        if ($pathinfo === '/admin/rayos-x-proyecciones/editar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_edit',  '_route' => 'simagd_proyeccion_edit',);
                        }

                        // simagd_proyeccion_show
                        if (preg_match('#^/admin/rayos\\-x\\-proyecciones/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_proyeccion_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_show',));
                        }

                        // simagd_proyeccion_export
                        if ($pathinfo === '/admin/rayos-x-proyecciones/export') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_export',  '_route' => 'simagd_proyeccion_export',);
                        }

                        // simagd_proyeccion_agregarEnMiCatalogo
                        if ($pathinfo === '/admin/rayos-x-proyecciones/agregarEnMiCatalogo') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::agregarEnMiCatalogoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_agregarEnMiCatalogo',  '_route' => 'simagd_proyeccion_agregarEnMiCatalogo',);
                        }

                        // simagd_proyeccion_obtenerModalidades
                        if ($pathinfo === '/admin/rayos-x-proyecciones/obtenerModalidades') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::obtenerModalidadesAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_obtenerModalidades',  '_route' => 'simagd_proyeccion_obtenerModalidades',);
                        }

                        // simagd_proyeccion_listarProyecciones
                        if ($pathinfo === '/admin/rayos-x-proyecciones/listarProyecciones') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::listarProyeccionesAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_listarProyecciones',  '_route' => 'simagd_proyeccion_listarProyecciones',);
                        }

                        // simagd_proyeccion_crearProyeccion
                        if ($pathinfo === '/admin/rayos-x-proyecciones/crearProyeccion') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_crearProyeccion;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::crearProyeccionAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_crearProyeccion',  '_route' => 'simagd_proyeccion_crearProyeccion',);
                        }
                        not_simagd_proyeccion_crearProyeccion:

                        // simagd_proyeccion_editarProyeccion
                        if ($pathinfo === '/admin/rayos-x-proyecciones/editarProyeccion') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_editarProyeccion;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::editarProyeccionAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_editarProyeccion',  '_route' => 'simagd_proyeccion_editarProyeccion',);
                        }
                        not_simagd_proyeccion_editarProyeccion:

                        // simagd_proyeccion_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-proyecciones/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_getObjectVarsAsArray',  '_route' => 'simagd_proyeccion_getObjectVarsAsArray',);
                        }
                        not_simagd_proyeccion_getObjectVarsAsArray:

                        // simagd_proyeccion_asignarElementoListaLocal
                        if ($pathinfo === '/admin/rayos-x-proyecciones/asignarElementoListaLocal') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_asignarElementoListaLocal;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionAdminController::asignarElementoListaLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion',  '_sonata_name' => 'simagd_proyeccion_asignarElementoListaLocal',  '_route' => 'simagd_proyeccion_asignarElementoListaLocal',);
                        }
                        not_simagd_proyeccion_asignarElementoListaLocal:

                    }

                    if (0 === strpos($pathinfo, '/admin/rayos-x-proyeccion-realizable')) {
                        // simagd_proyeccion_establecimiento_list
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/lista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_list',  '_route' => 'simagd_proyeccion_establecimiento_list',);
                        }

                        // simagd_proyeccion_establecimiento_create
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/crear') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_create',  '_route' => 'simagd_proyeccion_establecimiento_create',);
                        }

                        // simagd_proyeccion_establecimiento_batch
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/batch') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_batch',  '_route' => 'simagd_proyeccion_establecimiento_batch',);
                        }

                        // simagd_proyeccion_establecimiento_edit
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/editar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_edit',  '_route' => 'simagd_proyeccion_establecimiento_edit',);
                        }

                        // simagd_proyeccion_establecimiento_show
                        if (preg_match('#^/admin/rayos\\-x\\-proyeccion\\-realizable/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_proyeccion_establecimiento_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_show',));
                        }

                        // simagd_proyeccion_establecimiento_export
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/export') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_export',  '_route' => 'simagd_proyeccion_establecimiento_export',);
                        }

                        // simagd_proyeccion_establecimiento_agregarProyeccionEnLocal
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/agregarProyeccionEnLocal') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::agregarProyeccionEnLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_agregarProyeccionEnLocal',  '_route' => 'simagd_proyeccion_establecimiento_agregarProyeccionEnLocal',);
                        }

                        // simagd_proyeccion_establecimiento_listarProyeccionesLocales
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/listarProyeccionesLocales') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::listarProyeccionesLocalesAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_listarProyeccionesLocales',  '_route' => 'simagd_proyeccion_establecimiento_listarProyeccionesLocales',);
                        }

                        // simagd_proyeccion_establecimiento_crearProyeccionLocal
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/crearProyeccionLocal') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_establecimiento_crearProyeccionLocal;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::crearProyeccionLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_crearProyeccionLocal',  '_route' => 'simagd_proyeccion_establecimiento_crearProyeccionLocal',);
                        }
                        not_simagd_proyeccion_establecimiento_crearProyeccionLocal:

                        // simagd_proyeccion_establecimiento_editarProyeccionLocal
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/editarProyeccionLocal') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_establecimiento_editarProyeccionLocal;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::editarProyeccionLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_editarProyeccionLocal',  '_route' => 'simagd_proyeccion_establecimiento_editarProyeccionLocal',);
                        }
                        not_simagd_proyeccion_establecimiento_editarProyeccionLocal:

                        // simagd_proyeccion_establecimiento_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_establecimiento_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_getObjectVarsAsArray',  '_route' => 'simagd_proyeccion_establecimiento_getObjectVarsAsArray',);
                        }
                        not_simagd_proyeccion_establecimiento_getObjectVarsAsArray:

                        // simagd_proyeccion_establecimiento_habilitarLocal
                        if ($pathinfo === '/admin/rayos-x-proyeccion-realizable/habilitarLocal') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_proyeccion_establecimiento_habilitarLocal;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlProyeccionEstablecimientoAdminController::habilitarLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_proyeccion_establecimiento',  '_sonata_name' => 'simagd_proyeccion_establecimiento_habilitarLocal',  '_route' => 'simagd_proyeccion_establecimiento_habilitarLocal',);
                        }
                        not_simagd_proyeccion_establecimiento_habilitarLocal:

                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-modalidad')) {
                    // admin_minsal_siaps_ctlareaserviciodiagnostico_list
                    if ($pathinfo === '/admin/rayos-x-modalidad/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_area_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_list',  '_route' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_list',);
                    }

                    // admin_minsal_siaps_ctlareaserviciodiagnostico_create
                    if ($pathinfo === '/admin/rayos-x-modalidad/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_area_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_create',  '_route' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_create',);
                    }

                    // admin_minsal_siaps_ctlareaserviciodiagnostico_batch
                    if ($pathinfo === '/admin/rayos-x-modalidad/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_area_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_batch',  '_route' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_batch',);
                    }

                    // admin_minsal_siaps_ctlareaserviciodiagnostico_edit
                    if (preg_match('#^/admin/rayos\\-x\\-modalidad/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_area_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_edit',));
                    }

                    // admin_minsal_siaps_ctlareaserviciodiagnostico_delete
                    if (preg_match('#^/admin/rayos\\-x\\-modalidad/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_area_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_delete',));
                    }

                    // admin_minsal_siaps_ctlareaserviciodiagnostico_show
                    if (preg_match('#^/admin/rayos\\-x\\-modalidad/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_area_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_show',));
                    }

                    // admin_minsal_siaps_ctlareaserviciodiagnostico_export
                    if ($pathinfo === '/admin/rayos-x-modalidad/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_area_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_export',  '_route' => 'admin_minsal_siaps_ctlareaserviciodiagnostico_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-examen')) {
                    // admin_minsal_siaps_ctlexamenserviciodiagnostico_list
                    if ($pathinfo === '/admin/rayos-x-examen/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_examen_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_list',  '_route' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_list',);
                    }

                    // admin_minsal_siaps_ctlexamenserviciodiagnostico_create
                    if ($pathinfo === '/admin/rayos-x-examen/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_examen_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_create',  '_route' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_create',);
                    }

                    // admin_minsal_siaps_ctlexamenserviciodiagnostico_batch
                    if ($pathinfo === '/admin/rayos-x-examen/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_examen_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_batch',  '_route' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_batch',);
                    }

                    // admin_minsal_siaps_ctlexamenserviciodiagnostico_edit
                    if (preg_match('#^/admin/rayos\\-x\\-examen/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_examen_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_edit',));
                    }

                    // admin_minsal_siaps_ctlexamenserviciodiagnostico_delete
                    if (preg_match('#^/admin/rayos\\-x\\-examen/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_examen_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_delete',));
                    }

                    // admin_minsal_siaps_ctlexamenserviciodiagnostico_show
                    if (preg_match('#^/admin/rayos\\-x\\-examen/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_examen_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_show',));
                    }

                    // admin_minsal_siaps_ctlexamenserviciodiagnostico_export
                    if ($pathinfo === '/admin/rayos-x-examen/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.ctl_examen_servicio_diagnostico',  '_sonata_name' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_export',  '_route' => 'admin_minsal_siaps_ctlexamenserviciodiagnostico_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-realizable')) {
                    // admin_minsal_siaps_mntareaexamenestablecimiento_list
                    if ($pathinfo === '/admin/rayos-x-realizable/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_area_examen_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareaexamenestablecimiento_list',  '_route' => 'admin_minsal_siaps_mntareaexamenestablecimiento_list',);
                    }

                    // admin_minsal_siaps_mntareaexamenestablecimiento_create
                    if ($pathinfo === '/admin/rayos-x-realizable/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_area_examen_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareaexamenestablecimiento_create',  '_route' => 'admin_minsal_siaps_mntareaexamenestablecimiento_create',);
                    }

                    // admin_minsal_siaps_mntareaexamenestablecimiento_batch
                    if ($pathinfo === '/admin/rayos-x-realizable/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_area_examen_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareaexamenestablecimiento_batch',  '_route' => 'admin_minsal_siaps_mntareaexamenestablecimiento_batch',);
                    }

                    // admin_minsal_siaps_mntareaexamenestablecimiento_edit
                    if (preg_match('#^/admin/rayos\\-x\\-realizable/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareaexamenestablecimiento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_area_examen_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareaexamenestablecimiento_edit',));
                    }

                    // admin_minsal_siaps_mntareaexamenestablecimiento_delete
                    if (preg_match('#^/admin/rayos\\-x\\-realizable/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareaexamenestablecimiento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_area_examen_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareaexamenestablecimiento_delete',));
                    }

                    // admin_minsal_siaps_mntareaexamenestablecimiento_show
                    if (preg_match('#^/admin/rayos\\-x\\-realizable/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareaexamenestablecimiento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_area_examen_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareaexamenestablecimiento_show',));
                    }

                    // admin_minsal_siaps_mntareaexamenestablecimiento_export
                    if ($pathinfo === '/admin/rayos-x-realizable/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_area_examen_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareaexamenestablecimiento_export',  '_route' => 'admin_minsal_siaps_mntareaexamenestablecimiento_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-solicitud-estudio')) {
                    // simagd_solicitud_estudio_list
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_list',  '_route' => 'simagd_solicitud_estudio_list',);
                    }

                    // simagd_solicitud_estudio_create
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_create',  '_route' => 'simagd_solicitud_estudio_create',);
                    }

                    // simagd_solicitud_estudio_batch
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_batch',  '_route' => 'simagd_solicitud_estudio_batch',);
                    }

                    // simagd_solicitud_estudio_edit
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_edit',  '_route' => 'simagd_solicitud_estudio_edit',);
                    }

                    // simagd_solicitud_estudio_show
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/consultar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_show',  '_route' => 'simagd_solicitud_estudio_show',);
                    }

                    // simagd_solicitud_estudio_export
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_export',  '_route' => 'simagd_solicitud_estudio_export',);
                    }

                    // simagd_solicitud_estudio_citar
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/citar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::citarAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_citar',  '_route' => 'simagd_solicitud_estudio_citar',);
                    }

                    // simagd_solicitud_estudio_requiereCita
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/requiereCita') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::requiereCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_requiereCita',  '_route' => 'simagd_solicitud_estudio_requiereCita',);
                    }

                    // simagd_solicitud_estudio_solicitarDiag
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/solicitarDiag') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::solicitarDiagAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_solicitarDiag',  '_route' => 'simagd_solicitud_estudio_solicitarDiag',);
                    }

                    // simagd_solicitud_estudio_valorCampoCompuesto
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/valorCampoCompuesto') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_valorCampoCompuesto;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::valorCampoCompuestoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_valorCampoCompuesto',  '_route' => 'simagd_solicitud_estudio_valorCampoCompuesto',);
                    }
                    not_simagd_solicitud_estudio_valorCampoCompuesto:

                    // simagd_solicitud_estudio_extractCamposComponentes
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/extractCamposComponentes') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_extractCamposComponentes;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::extractCamposComponentesAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_extractCamposComponentes',  '_route' => 'simagd_solicitud_estudio_extractCamposComponentes',);
                    }
                    not_simagd_solicitud_estudio_extractCamposComponentes:

                    // simagd_solicitud_estudio_cargarDatosPorFiltro
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/cargarDatosPorFiltro') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::cargarDatosPorFiltroAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_cargarDatosPorFiltro',  '_route' => 'simagd_solicitud_estudio_cargarDatosPorFiltro',);
                    }

                    // simagd_solicitud_estudio_mostrarInformacionModal
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/mostrarInformacionModal') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_mostrarInformacionModal',  '_route' => 'simagd_solicitud_estudio_mostrarInformacionModal',);
                    }

                    // simagd_solicitud_estudio_listarSolicitudesEstudio
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/listarSolicitudesEstudio') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::listarSolicitudesEstudioAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_listarSolicitudesEstudio',  '_route' => 'simagd_solicitud_estudio_listarSolicitudesEstudio',);
                    }

                    // simagd_solicitud_estudio_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_getObjectVarsAsArray',  '_route' => 'simagd_solicitud_estudio_getObjectVarsAsArray',);
                    }
                    not_simagd_solicitud_estudio_getObjectVarsAsArray:

                    // simagd_solicitud_estudio_cambiarPrioridadAtencionSolicitud
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/cambiarPrioridadAtencionSolicitud') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_cambiarPrioridadAtencionSolicitud;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::cambiarPrioridadAtencionSolicitudAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_cambiarPrioridadAtencionSolicitud',  '_route' => 'simagd_solicitud_estudio_cambiarPrioridadAtencionSolicitud',);
                    }
                    not_simagd_solicitud_estudio_cambiarPrioridadAtencionSolicitud:

                    // simagd_solicitud_estudio_obtenerPrioridadesAtencion
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/obtenerPrioridadesAtencion') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::obtenerPrioridadesAtencionAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_obtenerPrioridadesAtencion',  '_route' => 'simagd_solicitud_estudio_obtenerPrioridadesAtencion',);
                    }

                    // simagd_solicitud_estudio_agregarIndicacionesRadiologo
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/agregarIndicacionesRadiologo') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_agregarIndicacionesRadiologo;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::agregarIndicacionesRadiologoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_agregarIndicacionesRadiologo',  '_route' => 'simagd_solicitud_estudio_agregarIndicacionesRadiologo',);
                    }
                    not_simagd_solicitud_estudio_agregarIndicacionesRadiologo:

                    // simagd_solicitud_estudio_listarPacientesSinCita
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/listarPacientesSinCita') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::listarPacientesSinCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_listarPacientesSinCita',  '_route' => 'simagd_solicitud_estudio_listarPacientesSinCita',);
                    }

                    // simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/crearSolicitudEstudioFormatoRapido') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::crearSolicitudEstudioFormatoRapidoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido',  '_route' => 'simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido',);
                    }
                    not_simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido:

                    // simagd_solicitud_estudio_editarSolicitudEstudioFormatoRapido
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio/editarSolicitudEstudioFormatoRapido') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_editarSolicitudEstudioFormatoRapido;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioAdminController::editarSolicitudEstudioFormatoRapidoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio',  '_sonata_name' => 'simagd_solicitud_estudio_editarSolicitudEstudioFormatoRapido',  '_route' => 'simagd_solicitud_estudio_editarSolicitudEstudioFormatoRapido',);
                    }
                    not_simagd_solicitud_estudio_editarSolicitudEstudioFormatoRapido:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-proyecciones-solicitadas')) {
                    // simagd_solicitud_estudio_proyeccion_list
                    if ($pathinfo === '/admin/rayos-x-proyecciones-solicitadas/list') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioProyeccionAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_proyeccion_list',  '_route' => 'simagd_solicitud_estudio_proyeccion_list',);
                    }

                    // simagd_solicitud_estudio_proyeccion_create
                    if ($pathinfo === '/admin/rayos-x-proyecciones-solicitadas/create') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioProyeccionAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_proyeccion_create',  '_route' => 'simagd_solicitud_estudio_proyeccion_create',);
                    }

                    // simagd_solicitud_estudio_proyeccion_batch
                    if ($pathinfo === '/admin/rayos-x-proyecciones-solicitadas/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioProyeccionAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_proyeccion_batch',  '_route' => 'simagd_solicitud_estudio_proyeccion_batch',);
                    }

                    // simagd_solicitud_estudio_proyeccion_edit
                    if (preg_match('#^/admin/rayos\\-x\\-proyecciones\\-solicitadas/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_solicitud_estudio_proyeccion_edit')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioProyeccionAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_proyeccion_edit',));
                    }

                    // simagd_solicitud_estudio_proyeccion_delete
                    if (preg_match('#^/admin/rayos\\-x\\-proyecciones\\-solicitadas/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_solicitud_estudio_proyeccion_delete')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioProyeccionAdminController::deleteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_proyeccion_delete',));
                    }

                    // simagd_solicitud_estudio_proyeccion_show
                    if (preg_match('#^/admin/rayos\\-x\\-proyecciones\\-solicitadas/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_solicitud_estudio_proyeccion_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioProyeccionAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_proyeccion_show',));
                    }

                    // simagd_solicitud_estudio_proyeccion_export
                    if ($pathinfo === '/admin/rayos-x-proyecciones-solicitadas/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioProyeccionAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_proyeccion_export',  '_route' => 'simagd_solicitud_estudio_proyeccion_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-solicitud-diagnostico')) {
                    // simagd_solicitud_diagnostico_list
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_list',  '_route' => 'simagd_solicitud_diagnostico_list',);
                    }

                    // simagd_solicitud_diagnostico_create
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_create',  '_route' => 'simagd_solicitud_diagnostico_create',);
                    }

                    // simagd_solicitud_diagnostico_batch
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_batch',  '_route' => 'simagd_solicitud_diagnostico_batch',);
                    }

                    // simagd_solicitud_diagnostico_edit
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_edit',  '_route' => 'simagd_solicitud_diagnostico_edit',);
                    }

                    // simagd_solicitud_diagnostico_show
                    if (preg_match('#^/admin/rayos\\-x\\-solicitud\\-diagnostico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_solicitud_diagnostico_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_show',));
                    }

                    // simagd_solicitud_diagnostico_export
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_export',  '_route' => 'simagd_solicitud_diagnostico_export',);
                    }

                    // simagd_solicitud_diagnostico_mostrarInformacionModal
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/mostrarInformacionModal') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_mostrarInformacionModal',  '_route' => 'simagd_solicitud_diagnostico_mostrarInformacionModal',);
                    }

                    // simagd_solicitud_diagnostico_listarSolicitudesDiagnostico
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/listarSolicitudesDiagnostico') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::listarSolicitudesDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_listarSolicitudesDiagnostico',  '_route' => 'simagd_solicitud_diagnostico_listarSolicitudesDiagnostico',);
                    }

                    // simagd_solicitud_diagnostico_crearSolicitudDiag
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/crearSolicitudDiag') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_diagnostico_crearSolicitudDiag;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::crearSolicitudDiagAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_crearSolicitudDiag',  '_route' => 'simagd_solicitud_diagnostico_crearSolicitudDiag',);
                    }
                    not_simagd_solicitud_diagnostico_crearSolicitudDiag:

                    // simagd_solicitud_diagnostico_editarSolicitudDiag
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/editarSolicitudDiag') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_diagnostico_editarSolicitudDiag;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::editarSolicitudDiagAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_editarSolicitudDiag',  '_route' => 'simagd_solicitud_diagnostico_editarSolicitudDiag',);
                    }
                    not_simagd_solicitud_diagnostico_editarSolicitudDiag:

                    // simagd_solicitud_diagnostico_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-solicitud-diagnostico/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_diagnostico_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudDiagnosticoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_diagnostico',  '_sonata_name' => 'simagd_solicitud_diagnostico_getObjectVarsAsArray',  '_route' => 'simagd_solicitud_diagnostico_getObjectVarsAsArray',);
                    }
                    not_simagd_solicitud_diagnostico_getObjectVarsAsArray:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-c')) {
                    if (0 === strpos($pathinfo, '/admin/rayos-x-citas')) {
                        // simagd_cita_list
                        if ($pathinfo === '/admin/rayos-x-citas/agenda') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_list',  '_route' => 'simagd_cita_list',);
                        }

                        // simagd_cita_create
                        if ($pathinfo === '/admin/rayos-x-citas/create') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_create',  '_route' => 'simagd_cita_create',);
                        }

                        // simagd_cita_batch
                        if ($pathinfo === '/admin/rayos-x-citas/batch') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_batch',  '_route' => 'simagd_cita_batch',);
                        }

                        // simagd_cita_edit
                        if (preg_match('#^/admin/rayos\\-x\\-citas/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_cita_edit')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_edit',));
                        }

                        // simagd_cita_show
                        if (preg_match('#^/admin/rayos\\-x\\-citas/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_cita_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_show',));
                        }

                        // simagd_cita_export
                        if ($pathinfo === '/admin/rayos-x-citas/export') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_export',  '_route' => 'simagd_cita_export',);
                        }

                        // simagd_cita_obtenerEventosCalendario
                        if ($pathinfo === '/admin/rayos-x-citas/obtenerEventosCalendario') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::obtenerEventosCalendarioAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_obtenerEventosCalendario',  '_route' => 'simagd_cita_obtenerEventosCalendario',);
                        }

                        // simagd_cita_espaciosReservados
                        if ($pathinfo === '/admin/rayos-x-citas/espaciosReservados') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::espaciosReservadosAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_espaciosReservados',  '_route' => 'simagd_cita_espaciosReservados',);
                        }

                        if (0 === strpos($pathinfo, '/admin/rayos-x-citas/c')) {
                            // simagd_cita_confirmarCita
                            if ($pathinfo === '/admin/rayos-x-citas/confirmarCita') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_simagd_cita_confirmarCita;
                                }

                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::confirmarCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_confirmarCita',  '_route' => 'simagd_cita_confirmarCita',);
                            }
                            not_simagd_cita_confirmarCita:

                            // simagd_cita_cancelarCita
                            if ($pathinfo === '/admin/rayos-x-citas/cancelarCita') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_simagd_cita_cancelarCita;
                                }

                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::cancelarCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_cancelarCita',  '_route' => 'simagd_cita_cancelarCita',);
                            }
                            not_simagd_cita_cancelarCita:

                        }

                        // simagd_cita_mostrarInformacionModal
                        if ($pathinfo === '/admin/rayos-x-citas/mostrarInformacionModal') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_mostrarInformacionModal',  '_route' => 'simagd_cita_mostrarInformacionModal',);
                        }

                        if (0 === strpos($pathinfo, '/admin/rayos-x-citas/c')) {
                            // simagd_cita_citaCancelable
                            if ($pathinfo === '/admin/rayos-x-citas/citaCancelable') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::citaCancelableAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_citaCancelable',  '_route' => 'simagd_cita_citaCancelable',);
                            }

                            // simagd_cita_calendario
                            if ($pathinfo === '/admin/rayos-x-citas/calendario') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::calendarioAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_calendario',  '_route' => 'simagd_cita_calendario',);
                            }

                        }

                        // simagd_cita_nuevaCita
                        if ($pathinfo === '/admin/rayos-x-citas/nuevaCita') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_cita_nuevaCita;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::nuevaCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_nuevaCita',  '_route' => 'simagd_cita_nuevaCita',);
                        }
                        not_simagd_cita_nuevaCita:

                        // simagd_cita_actualizarCita
                        if ($pathinfo === '/admin/rayos-x-citas/actualizarCita') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_cita_actualizarCita;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::actualizarCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_actualizarCita',  '_route' => 'simagd_cita_actualizarCita',);
                        }
                        not_simagd_cita_actualizarCita:

                        // simagd_cita_obtenerExpedientesEstab
                        if ($pathinfo === '/admin/rayos-x-citas/obtenerExpedientesEstab') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::obtenerExpedientesEstabAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_obtenerExpedientesEstab',  '_route' => 'simagd_cita_obtenerExpedientesEstab',);
                        }

                        // simagd_cita_editarCita
                        if ($pathinfo === '/admin/rayos-x-citas/editarCita') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_cita_editarCita;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::editarCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_editarCita',  '_route' => 'simagd_cita_editarCita',);
                        }
                        not_simagd_cita_editarCita:

                        // simagd_cita_cargarPacientesSinCita
                        if ($pathinfo === '/admin/rayos-x-citas/cargarPacientesSinCita') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_cita_cargarPacientesSinCita;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::cargarPacientesSinCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_cargarPacientesSinCita',  '_route' => 'simagd_cita_cargarPacientesSinCita',);
                        }
                        not_simagd_cita_cargarPacientesSinCita:

                        // simagd_cita_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-citas/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_cita_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_getObjectVarsAsArray',  '_route' => 'simagd_cita_getObjectVarsAsArray',);
                        }
                        not_simagd_cita_getObjectVarsAsArray:

                        // simagd_cita_listarCitasProgramadas
                        if ($pathinfo === '/admin/rayos-x-citas/listarCitasProgramadas') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::listarCitasProgramadasAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_listarCitasProgramadas',  '_route' => 'simagd_cita_listarCitasProgramadas',);
                        }

                        // simagd_cita_imprimirComprobante
                        if ($pathinfo === '/admin/rayos-x-citas/imprimir-comprobante') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCitaAdminController::imprimirComprobanteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_cita',  '_sonata_name' => 'simagd_cita_imprimirComprobante',  '_route' => 'simagd_cita_imprimirComprobante',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/rayos-x-configuracion-agenda')) {
                        // simagd_configuracion_agenda_list
                        if ($pathinfo === '/admin/rayos-x-configuracion-agenda/lista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlConfiguracionAgendaAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_configuracion_agenda',  '_sonata_name' => 'simagd_configuracion_agenda_list',  '_route' => 'simagd_configuracion_agenda_list',);
                        }

                        // simagd_configuracion_agenda_create
                        if ($pathinfo === '/admin/rayos-x-configuracion-agenda/crear') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlConfiguracionAgendaAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_configuracion_agenda',  '_sonata_name' => 'simagd_configuracion_agenda_create',  '_route' => 'simagd_configuracion_agenda_create',);
                        }

                        // simagd_configuracion_agenda_batch
                        if ($pathinfo === '/admin/rayos-x-configuracion-agenda/batch') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlConfiguracionAgendaAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_configuracion_agenda',  '_sonata_name' => 'simagd_configuracion_agenda_batch',  '_route' => 'simagd_configuracion_agenda_batch',);
                        }

                        // simagd_configuracion_agenda_edit
                        if ($pathinfo === '/admin/rayos-x-configuracion-agenda/editar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlConfiguracionAgendaAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_configuracion_agenda',  '_sonata_name' => 'simagd_configuracion_agenda_edit',  '_route' => 'simagd_configuracion_agenda_edit',);
                        }

                        // simagd_configuracion_agenda_show
                        if (preg_match('#^/admin/rayos\\-x\\-configuracion\\-agenda/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_configuracion_agenda_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlConfiguracionAgendaAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_configuracion_agenda',  '_sonata_name' => 'simagd_configuracion_agenda_show',));
                        }

                        // simagd_configuracion_agenda_export
                        if ($pathinfo === '/admin/rayos-x-configuracion-agenda/export') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlConfiguracionAgendaAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_configuracion_agenda',  '_sonata_name' => 'simagd_configuracion_agenda_export',  '_route' => 'simagd_configuracion_agenda_export',);
                        }

                        // simagd_configuracion_agenda_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-configuracion-agenda/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_configuracion_agenda_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlConfiguracionAgendaAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_configuracion_agenda',  '_sonata_name' => 'simagd_configuracion_agenda_getObjectVarsAsArray',  '_route' => 'simagd_configuracion_agenda_getObjectVarsAsArray',);
                        }
                        not_simagd_configuracion_agenda_getObjectVarsAsArray:

                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-pacs-establecimiento')) {
                    // simagd_pacs_list
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_list',  '_route' => 'simagd_pacs_list',);
                    }

                    // simagd_pacs_create
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_create',  '_route' => 'simagd_pacs_create',);
                    }

                    // simagd_pacs_batch
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_batch',  '_route' => 'simagd_pacs_batch',);
                    }

                    // simagd_pacs_edit
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_edit',  '_route' => 'simagd_pacs_edit',);
                    }

                    // simagd_pacs_show
                    if (preg_match('#^/admin/rayos\\-x\\-pacs\\-establecimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_pacs_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_show',));
                    }

                    // simagd_pacs_export
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_export',  '_route' => 'simagd_pacs_export',);
                    }

                    // simagd_pacs_listarPacsEstablecimiento
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/listarPacsEstablecimiento') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::listarPacsEstablecimientoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_listarPacsEstablecimiento',  '_route' => 'simagd_pacs_listarPacsEstablecimiento',);
                    }

                    // simagd_pacs_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_pacs_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_getObjectVarsAsArray',  '_route' => 'simagd_pacs_getObjectVarsAsArray',);
                    }
                    not_simagd_pacs_getObjectVarsAsArray:

                    // simagd_pacs_habilitarPacs
                    if ($pathinfo === '/admin/rayos-x-pacs-establecimiento/habilitarPacs') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_pacs_habilitarPacs;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPacsEstablecimientoAdminController::habilitarPacsAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_pacs_establecimiento',  '_sonata_name' => 'simagd_pacs_habilitarPacs',  '_route' => 'simagd_pacs_habilitarPacs',);
                    }
                    not_simagd_pacs_habilitarPacs:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-motor-bd')) {
                    // simagd_motor_bd_list
                    if ($pathinfo === '/admin/rayos-x-motor-bd/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMotorBdAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_motor_bd',  '_sonata_name' => 'simagd_motor_bd_list',  '_route' => 'simagd_motor_bd_list',);
                    }

                    // simagd_motor_bd_create
                    if ($pathinfo === '/admin/rayos-x-motor-bd/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMotorBdAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_motor_bd',  '_sonata_name' => 'simagd_motor_bd_create',  '_route' => 'simagd_motor_bd_create',);
                    }

                    // simagd_motor_bd_batch
                    if ($pathinfo === '/admin/rayos-x-motor-bd/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMotorBdAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_motor_bd',  '_sonata_name' => 'simagd_motor_bd_batch',  '_route' => 'simagd_motor_bd_batch',);
                    }

                    // simagd_motor_bd_edit
                    if ($pathinfo === '/admin/rayos-x-motor-bd/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMotorBdAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_motor_bd',  '_sonata_name' => 'simagd_motor_bd_edit',  '_route' => 'simagd_motor_bd_edit',);
                    }

                    // simagd_motor_bd_show
                    if (preg_match('#^/admin/rayos\\-x\\-motor\\-bd/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_motor_bd_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMotorBdAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_motor_bd',  '_sonata_name' => 'simagd_motor_bd_show',));
                    }

                    // simagd_motor_bd_export
                    if ($pathinfo === '/admin/rayos-x-motor-bd/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMotorBdAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_motor_bd',  '_sonata_name' => 'simagd_motor_bd_export',  '_route' => 'simagd_motor_bd_export',);
                    }

                    // simagd_motor_bd_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-motor-bd/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_motor_bd_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMotorBdAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_motor_bd',  '_sonata_name' => 'simagd_motor_bd_getObjectVarsAsArray',  '_route' => 'simagd_motor_bd_getObjectVarsAsArray',);
                    }
                    not_simagd_motor_bd_getObjectVarsAsArray:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-sin-realizar')) {
                    // simagd_sin_realizar_list
                    if ($pathinfo === '/admin/rayos-x-sin-realizar/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteRealizacionAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_realizacion',  '_sonata_name' => 'simagd_sin_realizar_list',  '_route' => 'simagd_sin_realizar_list',);
                    }

                    if (0 === strpos($pathinfo, '/admin/rayos-x-sin-realizar/re')) {
                        // simagd_sin_realizar_realizar
                        if ($pathinfo === '/admin/rayos-x-sin-realizar/realizar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteRealizacionAdminController::realizarAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_realizacion',  '_sonata_name' => 'simagd_sin_realizar_realizar',  '_route' => 'simagd_sin_realizar_realizar',);
                        }

                        // simagd_sin_realizar_registrarEnMiLista
                        if ($pathinfo === '/admin/rayos-x-sin-realizar/registrarEnMiLista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteRealizacionAdminController::registrarEnMiListaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_realizacion',  '_sonata_name' => 'simagd_sin_realizar_registrarEnMiLista',  '_route' => 'simagd_sin_realizar_registrarEnMiLista',);
                        }

                    }

                    // simagd_sin_realizar_listarPendientesRealizar
                    if ($pathinfo === '/admin/rayos-x-sin-realizar/listarPendientesRealizar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteRealizacionAdminController::listarPendientesRealizarAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_realizacion',  '_sonata_name' => 'simagd_sin_realizar_listarPendientesRealizar',  '_route' => 'simagd_sin_realizar_listarPendientesRealizar',);
                    }

                    // simagd_sin_realizar_registrarEstudioAlmacenado
                    if ($pathinfo === '/admin/rayos-x-sin-realizar/registrarEstudioAlmacenado') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteRealizacionAdminController::registrarEstudioAlmacenadoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_realizacion',  '_sonata_name' => 'simagd_sin_realizar_registrarEstudioAlmacenado',  '_route' => 'simagd_sin_realizar_registrarEstudioAlmacenado',);
                    }

                    // simagd_sin_realizar_agregarEmergencia
                    if ($pathinfo === '/admin/rayos-x-sin-realizar/agregarEmergencia') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_sin_realizar_agregarEmergencia;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteRealizacionAdminController::agregarEmergenciaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_realizacion',  '_sonata_name' => 'simagd_sin_realizar_agregarEmergencia',  '_route' => 'simagd_sin_realizar_agregarEmergencia',);
                    }
                    not_simagd_sin_realizar_agregarEmergencia:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-mi-lista-sin-realizar')) {
                    // simagd_mi_lista_sin_realizar_list
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-realizar/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisExamenesNoConcluidosAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_examenes_no_concluidos',  '_sonata_name' => 'simagd_mi_lista_sin_realizar_list',  '_route' => 'simagd_mi_lista_sin_realizar_list',);
                    }

                    // simagd_mi_lista_sin_realizar_realizar
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-realizar/realizar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisExamenesNoConcluidosAdminController::realizarAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_examenes_no_concluidos',  '_sonata_name' => 'simagd_mi_lista_sin_realizar_realizar',  '_route' => 'simagd_mi_lista_sin_realizar_realizar',);
                    }

                    // simagd_mi_lista_sin_realizar_listarPendientesRealizar
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-realizar/listarPendientesRealizar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisExamenesNoConcluidosAdminController::listarPendientesRealizarAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_examenes_no_concluidos',  '_sonata_name' => 'simagd_mi_lista_sin_realizar_listarPendientesRealizar',  '_route' => 'simagd_mi_lista_sin_realizar_listarPendientesRealizar',);
                    }

                    // simagd_mi_lista_sin_realizar_actualizarEstudioAlmacenado
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-realizar/actualizarEstudioAlmacenado') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisExamenesNoConcluidosAdminController::actualizarEstudioAlmacenadoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_examenes_no_concluidos',  '_sonata_name' => 'simagd_mi_lista_sin_realizar_actualizarEstudioAlmacenado',  '_route' => 'simagd_mi_lista_sin_realizar_actualizarEstudioAlmacenado',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-e')) {
                    if (0 === strpos($pathinfo, '/admin/rayos-x-examenes-realizados')) {
                        // simagd_realizado_list
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/lista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_list',  '_route' => 'simagd_realizado_list',);
                        }

                        // simagd_realizado_create
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/crear') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_create',  '_route' => 'simagd_realizado_create',);
                        }

                        // simagd_realizado_batch
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/batch') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_batch',  '_route' => 'simagd_realizado_batch',);
                        }

                        // simagd_realizado_edit
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/editar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_edit',  '_route' => 'simagd_realizado_edit',);
                        }

                        // simagd_realizado_show
                        if (preg_match('#^/admin/rayos\\-x\\-examenes\\-realizados/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_realizado_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_show',));
                        }

                        // simagd_realizado_export
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/export') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_export',  '_route' => 'simagd_realizado_export',);
                        }

                        // simagd_realizado_agregarPendiente
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/agregarPendiente') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::agregarPendienteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_agregarPendiente',  '_route' => 'simagd_realizado_agregarPendiente',);
                        }

                        // simagd_realizado_mostrarInformacionModal
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/mostrarInformacionModal') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_mostrarInformacionModal',  '_route' => 'simagd_realizado_mostrarInformacionModal',);
                        }

                        // simagd_realizado_obtenerEstudioRealizado
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/obtenerEstudioRealizado') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::obtenerEstudioRealizadoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_obtenerEstudioRealizado',  '_route' => 'simagd_realizado_obtenerEstudioRealizado',);
                        }

                        // simagd_realizado_listarProcedimientosRealizados
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/listarProcedimientosRealizados') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::listarProcedimientosRealizadosAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_listarProcedimientosRealizados',  '_route' => 'simagd_realizado_listarProcedimientosRealizados',);
                        }

                        // simagd_realizado_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_realizado_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_getObjectVarsAsArray',  '_route' => 'simagd_realizado_getObjectVarsAsArray',);
                        }
                        not_simagd_realizado_getObjectVarsAsArray:

                        // simagd_realizado_diagnostico
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/iniciar-diagnostico') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::diagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_diagnostico',  '_route' => 'simagd_realizado_diagnostico',);
                        }

                        // simagd_realizado_registrarEstudioAlmacenado
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/registrarEstudioAlmacenado') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::registrarEstudioAlmacenadoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_registrarEstudioAlmacenado',  '_route' => 'simagd_realizado_registrarEstudioAlmacenado',);
                        }

                        // simagd_realizado_actualizarEstudioAlmacenado
                        if ($pathinfo === '/admin/rayos-x-examenes-realizados/actualizarEstudioAlmacenado') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgProcedimientoRealizadoAdminController::actualizarEstudioAlmacenadoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_procedimiento_realizado',  '_sonata_name' => 'simagd_realizado_actualizarEstudioAlmacenado',  '_route' => 'simagd_realizado_actualizarEstudioAlmacenado',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/rayos-x-estudios')) {
                        // simagd_estudio_list
                        if ($pathinfo === '/admin/rayos-x-estudios/busqueda-estudio') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_list',  '_route' => 'simagd_estudio_list',);
                        }

                        // simagd_estudio_show
                        if (preg_match('#^/admin/rayos\\-x\\-estudios/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_estudio_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_show',));
                        }

                        // simagd_estudio_resultadosBusquedaEstudio
                        if ($pathinfo === '/admin/rayos-x-estudios/resultadosBusquedaEstudio') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::resultadosBusquedaEstudioAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_resultadosBusquedaEstudio',  '_route' => 'simagd_estudio_resultadosBusquedaEstudio',);
                        }

                        // simagd_estudio_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-estudios/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_estudio_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_getObjectVarsAsArray',  '_route' => 'simagd_estudio_getObjectVarsAsArray',);
                        }
                        not_simagd_estudio_getObjectVarsAsArray:

                        // simagd_estudio_download
                        if ($pathinfo === '/admin/rayos-x-estudios/download') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::downloadAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_download',  '_route' => 'simagd_estudio_download',);
                        }

                        // simagd_estudio_obtenerExpedientesEstab
                        if ($pathinfo === '/admin/rayos-x-estudios/obtenerExpedientesEstab') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::obtenerExpedientesEstabAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_obtenerExpedientesEstab',  '_route' => 'simagd_estudio_obtenerExpedientesEstab',);
                        }

                        // simagd_estudio_create
                        if ($pathinfo === '/admin/rayos-x-estudios/crear') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_create',  '_route' => 'simagd_estudio_create',);
                        }

                        // simagd_estudio_edit
                        if ($pathinfo === '/admin/rayos-x-estudios/editar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgEstudioPacienteAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_estudio_paciente',  '_sonata_name' => 'simagd_estudio_edit',  '_route' => 'simagd_estudio_edit',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-sin-lectura')) {
                    if (0 === strpos($pathinfo, '/admin/rayos-x-sin-lectura/l')) {
                        // simagd_sin_lectura_list
                        if ($pathinfo === '/admin/rayos-x-sin-lectura/lista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteLecturaAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_lectura',  '_sonata_name' => 'simagd_sin_lectura_list',  '_route' => 'simagd_sin_lectura_list',);
                        }

                        // simagd_sin_lectura_leer
                        if ($pathinfo === '/admin/rayos-x-sin-lectura/leer') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteLecturaAdminController::leerAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_lectura',  '_sonata_name' => 'simagd_sin_lectura_leer',  '_route' => 'simagd_sin_lectura_leer',);
                        }

                    }

                    // simagd_sin_lectura_registrarEnMiLista
                    if ($pathinfo === '/admin/rayos-x-sin-lectura/registrarEnMiLista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteLecturaAdminController::registrarEnMiListaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_lectura',  '_sonata_name' => 'simagd_sin_lectura_registrarEnMiLista',  '_route' => 'simagd_sin_lectura_registrarEnMiLista',);
                    }

                    // simagd_sin_lectura_listarPendientesLectura
                    if ($pathinfo === '/admin/rayos-x-sin-lectura/listarPendientesLectura') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteLecturaAdminController::listarPendientesLecturaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_lectura',  '_sonata_name' => 'simagd_sin_lectura_listarPendientesLectura',  '_route' => 'simagd_sin_lectura_listarPendientesLectura',);
                    }

                    if (0 === strpos($pathinfo, '/admin/rayos-x-sin-lectura/a')) {
                        // simagd_sin_lectura_anexarEstudioEnListaSinLectura
                        if ($pathinfo === '/admin/rayos-x-sin-lectura/anexarEstudioEnListaSinLectura') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_sin_lectura_anexarEstudioEnListaSinLectura;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteLecturaAdminController::anexarEstudioEnListaSinLecturaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_lectura',  '_sonata_name' => 'simagd_sin_lectura_anexarEstudioEnListaSinLectura',  '_route' => 'simagd_sin_lectura_anexarEstudioEnListaSinLectura',);
                        }
                        not_simagd_sin_lectura_anexarEstudioEnListaSinLectura:

                        // simagd_sin_lectura_asignarElementoListaTrabajo
                        if ($pathinfo === '/admin/rayos-x-sin-lectura/asignarElementoListaTrabajo') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_sin_lectura_asignarElementoListaTrabajo;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteLecturaAdminController::asignarElementoListaTrabajoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_lectura',  '_sonata_name' => 'simagd_sin_lectura_asignarElementoListaTrabajo',  '_route' => 'simagd_sin_lectura_asignarElementoListaTrabajo',);
                        }
                        not_simagd_sin_lectura_asignarElementoListaTrabajo:

                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-mi-lista-sin-lectura/l')) {
                    // simagd_mi_lista_sin_lectura_list
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-lectura/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisLecturasNoConcluidasAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_lecturas_no_concluidas',  '_sonata_name' => 'simagd_mi_lista_sin_lectura_list',  '_route' => 'simagd_mi_lista_sin_lectura_list',);
                    }

                    // simagd_mi_lista_sin_lectura_leer
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-lectura/leer') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisLecturasNoConcluidasAdminController::leerAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_lecturas_no_concluidas',  '_sonata_name' => 'simagd_mi_lista_sin_lectura_leer',  '_route' => 'simagd_mi_lista_sin_lectura_leer',);
                    }

                    // simagd_mi_lista_sin_lectura_listarPendientesLectura
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-lectura/listarPendientesLectura') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisLecturasNoConcluidasAdminController::listarPendientesLecturaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_lecturas_no_concluidas',  '_sonata_name' => 'simagd_mi_lista_sin_lectura_listarPendientesLectura',  '_route' => 'simagd_mi_lista_sin_lectura_listarPendientesLectura',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-lectura')) {
                    // simagd_lectura_list
                    if ($pathinfo === '/admin/rayos-x-lectura/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_list',  '_route' => 'simagd_lectura_list',);
                    }

                    // simagd_lectura_create
                    if ($pathinfo === '/admin/rayos-x-lectura/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_create',  '_route' => 'simagd_lectura_create',);
                    }

                    // simagd_lectura_batch
                    if ($pathinfo === '/admin/rayos-x-lectura/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_batch',  '_route' => 'simagd_lectura_batch',);
                    }

                    // simagd_lectura_edit
                    if ($pathinfo === '/admin/rayos-x-lectura/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_edit',  '_route' => 'simagd_lectura_edit',);
                    }

                    // simagd_lectura_show
                    if (preg_match('#^/admin/rayos\\-x\\-lectura/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_lectura_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_show',));
                    }

                    // simagd_lectura_export
                    if ($pathinfo === '/admin/rayos-x-lectura/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_export',  '_route' => 'simagd_lectura_export',);
                    }

                    // simagd_lectura_agregarPendiente
                    if ($pathinfo === '/admin/rayos-x-lectura/agregarPendiente') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::agregarPendienteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_agregarPendiente',  '_route' => 'simagd_lectura_agregarPendiente',);
                    }

                    // simagd_lectura_mostrarInformacionModal
                    if ($pathinfo === '/admin/rayos-x-lectura/mostrarInformacionModal') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_mostrarInformacionModal',  '_route' => 'simagd_lectura_mostrarInformacionModal',);
                    }

                    // simagd_lectura_proximaConsulta
                    if ($pathinfo === '/admin/rayos-x-lectura/proximaConsulta') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::proximaConsultaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_proximaConsulta',  '_route' => 'simagd_lectura_proximaConsulta',);
                    }

                    // simagd_lectura_listarLecturas
                    if ($pathinfo === '/admin/rayos-x-lectura/listarLecturas') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::listarLecturasAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_listarLecturas',  '_route' => 'simagd_lectura_listarLecturas',);
                    }

                    // simagd_lectura_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-lectura/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_lectura_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura',  '_sonata_name' => 'simagd_lectura_getObjectVarsAsArray',  '_route' => 'simagd_lectura_getObjectVarsAsArray',);
                    }
                    not_simagd_lectura_getObjectVarsAsArray:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-sin-transcribir')) {
                    // simagd_sin_transcribir_list
                    if ($pathinfo === '/admin/rayos-x-sin-transcribir/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteTranscripcionAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_transcripcion',  '_sonata_name' => 'simagd_sin_transcribir_list',  '_route' => 'simagd_sin_transcribir_list',);
                    }

                    // simagd_sin_transcribir_transcribir
                    if ($pathinfo === '/admin/rayos-x-sin-transcribir/transcribir') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteTranscripcionAdminController::transcribirAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_transcripcion',  '_sonata_name' => 'simagd_sin_transcribir_transcribir',  '_route' => 'simagd_sin_transcribir_transcribir',);
                    }

                    // simagd_sin_transcribir_registrarEnMiLista
                    if ($pathinfo === '/admin/rayos-x-sin-transcribir/registrarEnMiLista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteTranscripcionAdminController::registrarEnMiListaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_transcripcion',  '_sonata_name' => 'simagd_sin_transcribir_registrarEnMiLista',  '_route' => 'simagd_sin_transcribir_registrarEnMiLista',);
                    }

                    // simagd_sin_transcribir_listarPendientesTranscripcion
                    if ($pathinfo === '/admin/rayos-x-sin-transcribir/listarPendientesTranscripcion') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteTranscripcionAdminController::listarPendientesTranscripcionAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_transcripcion',  '_sonata_name' => 'simagd_sin_transcribir_listarPendientesTranscripcion',  '_route' => 'simagd_sin_transcribir_listarPendientesTranscripcion',);
                    }

                    // simagd_sin_transcribir_asignarElementoListaTrabajo
                    if ($pathinfo === '/admin/rayos-x-sin-transcribir/asignarElementoListaTrabajo') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_sin_transcribir_asignarElementoListaTrabajo;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteTranscripcionAdminController::asignarElementoListaTrabajoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_transcripcion',  '_sonata_name' => 'simagd_sin_transcribir_asignarElementoListaTrabajo',  '_route' => 'simagd_sin_transcribir_asignarElementoListaTrabajo',);
                    }
                    not_simagd_sin_transcribir_asignarElementoListaTrabajo:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-mi-lista-sin-transcribir')) {
                    // simagd_mi_lista_sin_transcribir_list
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-transcribir/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisTranscripcionesNoConcluidasAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_transcripciones_no_concluidas',  '_sonata_name' => 'simagd_mi_lista_sin_transcribir_list',  '_route' => 'simagd_mi_lista_sin_transcribir_list',);
                    }

                    // simagd_mi_lista_sin_transcribir_transcribir
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-transcribir/transcribir') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisTranscripcionesNoConcluidasAdminController::transcribirAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_transcripciones_no_concluidas',  '_sonata_name' => 'simagd_mi_lista_sin_transcribir_transcribir',  '_route' => 'simagd_mi_lista_sin_transcribir_transcribir',);
                    }

                    // simagd_mi_lista_sin_transcribir_listarPendientesTranscripcion
                    if ($pathinfo === '/admin/rayos-x-mi-lista-sin-transcribir/listarPendientesTranscripcion') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMisTranscripcionesNoConcluidasAdminController::listarPendientesTranscripcionAction',  '_sonata_admin' => 'minsal_simagd.admin.img_mis_transcripciones_no_concluidas',  '_sonata_name' => 'simagd_mi_lista_sin_transcribir_listarPendientesTranscripcion',  '_route' => 'simagd_mi_lista_sin_transcribir_listarPendientesTranscripcion',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-diagnostico')) {
                    // simagd_diagnostico_list
                    if ($pathinfo === '/admin/rayos-x-diagnostico/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_list',  '_route' => 'simagd_diagnostico_list',);
                    }

                    // simagd_diagnostico_create
                    if ($pathinfo === '/admin/rayos-x-diagnostico/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_create',  '_route' => 'simagd_diagnostico_create',);
                    }

                    // simagd_diagnostico_batch
                    if ($pathinfo === '/admin/rayos-x-diagnostico/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_batch',  '_route' => 'simagd_diagnostico_batch',);
                    }

                    // simagd_diagnostico_edit
                    if ($pathinfo === '/admin/rayos-x-diagnostico/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_edit',  '_route' => 'simagd_diagnostico_edit',);
                    }

                    // simagd_diagnostico_show
                    if (preg_match('#^/admin/rayos\\-x\\-diagnostico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_diagnostico_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_show',));
                    }

                    // simagd_diagnostico_export
                    if ($pathinfo === '/admin/rayos-x-diagnostico/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_export',  '_route' => 'simagd_diagnostico_export',);
                    }

                    // simagd_diagnostico_nota
                    if ($pathinfo === '/admin/rayos-x-diagnostico/nota') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::notaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_nota',  '_route' => 'simagd_diagnostico_nota',);
                    }

                    // simagd_diagnostico_agregarPendiente
                    if ($pathinfo === '/admin/rayos-x-diagnostico/agregarPendiente') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::agregarPendienteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_agregarPendiente',  '_route' => 'simagd_diagnostico_agregarPendiente',);
                    }

                    // simagd_diagnostico_mostrarInformacionModal
                    if ($pathinfo === '/admin/rayos-x-diagnostico/mostrarInformacionModal') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_mostrarInformacionModal',  '_route' => 'simagd_diagnostico_mostrarInformacionModal',);
                    }

                    // simagd_diagnostico_listarDiagnosticos
                    if ($pathinfo === '/admin/rayos-x-diagnostico/listarDiagnosticos') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::listarDiagnosticosAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_listarDiagnosticos',  '_route' => 'simagd_diagnostico_listarDiagnosticos',);
                    }

                    // simagd_diagnostico_transcribirDiagnostico
                    if ($pathinfo === '/admin/rayos-x-diagnostico/transcribirDiagnostico') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_diagnostico_transcribirDiagnostico;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::transcribirDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_transcribirDiagnostico',  '_route' => 'simagd_diagnostico_transcribirDiagnostico',);
                    }
                    not_simagd_diagnostico_transcribirDiagnostico:

                    // simagd_diagnostico_editarDiagnostico
                    if ($pathinfo === '/admin/rayos-x-diagnostico/editarDiagnostico') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_diagnostico_editarDiagnostico;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::editarDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_editarDiagnostico',  '_route' => 'simagd_diagnostico_editarDiagnostico',);
                    }
                    not_simagd_diagnostico_editarDiagnostico:

                    // simagd_diagnostico_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-diagnostico/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_diagnostico_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_getObjectVarsAsArray',  '_route' => 'simagd_diagnostico_getObjectVarsAsArray',);
                    }
                    not_simagd_diagnostico_getObjectVarsAsArray:

                    // simagd_diagnostico_aprobarDiagnostico
                    if ($pathinfo === '/admin/rayos-x-diagnostico/aprobarDiagnostico') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_diagnostico_aprobarDiagnostico;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDiagnosticoAdminController::aprobarDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_diagnostico',  '_sonata_name' => 'simagd_diagnostico_aprobarDiagnostico',  '_route' => 'simagd_diagnostico_aprobarDiagnostico',);
                    }
                    not_simagd_diagnostico_aprobarDiagnostico:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-busqueda-diagnostico')) {
                    // simagd_busqueda_diagnostico_list
                    if ($pathinfo === '/admin/rayos-x-busqueda-diagnostico/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\BusquedaDiagnosticoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.busqueda_diagnostico',  '_sonata_name' => 'simagd_busqueda_diagnostico_list',  '_route' => 'simagd_busqueda_diagnostico_list',);
                    }

                    // simagd_busqueda_diagnostico_show
                    if (preg_match('#^/admin/rayos\\-x\\-busqueda\\-diagnostico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_busqueda_diagnostico_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\BusquedaDiagnosticoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.busqueda_diagnostico',  '_sonata_name' => 'simagd_busqueda_diagnostico_show',));
                    }

                    // simagd_busqueda_diagnostico_nota
                    if ($pathinfo === '/admin/rayos-x-busqueda-diagnostico/nota') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\BusquedaDiagnosticoAdminController::notaAction',  '_sonata_admin' => 'minsal_simagd.admin.busqueda_diagnostico',  '_sonata_name' => 'simagd_busqueda_diagnostico_nota',  '_route' => 'simagd_busqueda_diagnostico_nota',);
                    }

                    // simagd_busqueda_diagnostico_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-busqueda-diagnostico/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_busqueda_diagnostico_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\BusquedaDiagnosticoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.busqueda_diagnostico',  '_sonata_name' => 'simagd_busqueda_diagnostico_getObjectVarsAsArray',  '_route' => 'simagd_busqueda_diagnostico_getObjectVarsAsArray',);
                    }
                    not_simagd_busqueda_diagnostico_getObjectVarsAsArray:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-sin-validar')) {
                    // simagd_sin_validar_list
                    if ($pathinfo === '/admin/rayos-x-sin-validar/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteValidacionAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_validacion',  '_sonata_name' => 'simagd_sin_validar_list',  '_route' => 'simagd_sin_validar_list',);
                    }

                    // simagd_sin_validar_validar
                    if ($pathinfo === '/admin/rayos-x-sin-validar/validar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteValidacionAdminController::validarAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_validacion',  '_sonata_name' => 'simagd_sin_validar_validar',  '_route' => 'simagd_sin_validar_validar',);
                    }

                    // simagd_sin_validar_listarPendientesValidacion
                    if ($pathinfo === '/admin/rayos-x-sin-validar/listarPendientesValidacion') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteValidacionAdminController::listarPendientesValidacionAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_validacion',  '_sonata_name' => 'simagd_sin_validar_listarPendientesValidacion',  '_route' => 'simagd_sin_validar_listarPendientesValidacion',);
                    }

                    // simagd_sin_validar_asignarElementoListaTrabajo
                    if ($pathinfo === '/admin/rayos-x-sin-validar/asignarElementoListaTrabajo') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_sin_validar_asignarElementoListaTrabajo;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgPendienteValidacionAdminController::asignarElementoListaTrabajoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_pendiente_validacion',  '_sonata_name' => 'simagd_sin_validar_asignarElementoListaTrabajo',  '_route' => 'simagd_sin_validar_asignarElementoListaTrabajo',);
                    }
                    not_simagd_sin_validar_asignarElementoListaTrabajo:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-nota')) {
                    // simagd_nota_list
                    if ($pathinfo === '/admin/rayos-x-nota/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_list',  '_route' => 'simagd_nota_list',);
                    }

                    // simagd_nota_create
                    if ($pathinfo === '/admin/rayos-x-nota/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_create',  '_route' => 'simagd_nota_create',);
                    }

                    // simagd_nota_batch
                    if ($pathinfo === '/admin/rayos-x-nota/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_batch',  '_route' => 'simagd_nota_batch',);
                    }

                    // simagd_nota_edit
                    if ($pathinfo === '/admin/rayos-x-nota/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_edit',  '_route' => 'simagd_nota_edit',);
                    }

                    // simagd_nota_show
                    if (preg_match('#^/admin/rayos\\-x\\-nota/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_nota_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_show',));
                    }

                    // simagd_nota_export
                    if ($pathinfo === '/admin/rayos-x-nota/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_export',  '_route' => 'simagd_nota_export',);
                    }

                    // simagd_nota_mostrarInformacionModal
                    if ($pathinfo === '/admin/rayos-x-nota/mostrarInformacionModal') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_mostrarInformacionModal',  '_route' => 'simagd_nota_mostrarInformacionModal',);
                    }

                    // simagd_nota_listarNotasDiagnostico
                    if ($pathinfo === '/admin/rayos-x-nota/listarNotasDiagnostico') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::listarNotasDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_listarNotasDiagnostico',  '_route' => 'simagd_nota_listarNotasDiagnostico',);
                    }

                    // simagd_nota_crearNota
                    if ($pathinfo === '/admin/rayos-x-nota/crearNota') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_nota_crearNota;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::crearNotaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_crearNota',  '_route' => 'simagd_nota_crearNota',);
                    }
                    not_simagd_nota_crearNota:

                    // simagd_nota_editarNota
                    if ($pathinfo === '/admin/rayos-x-nota/editarNota') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_nota_editarNota;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::editarNotaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_editarNota',  '_route' => 'simagd_nota_editarNota',);
                    }
                    not_simagd_nota_editarNota:

                    // simagd_nota_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-nota/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_nota_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgNotaDiagnosticoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_nota_diagnostico',  '_sonata_name' => 'simagd_nota_getObjectVarsAsArray',  '_route' => 'simagd_nota_getObjectVarsAsArray',);
                    }
                    not_simagd_nota_getObjectVarsAsArray:

                }

            }

            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico')) {
                // admin_minsal_seguimiento_sechistorialclinico_list
                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/lista') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::listAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_list',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_list',);
                }

                // admin_minsal_seguimiento_sechistorialclinico_create
                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/crear') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::createAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_create',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_create',);
                }

                // admin_minsal_seguimiento_sechistorialclinico_batch
                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/batch') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::batchAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_batch',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_batch',);
                }

                // admin_minsal_seguimiento_sechistorialclinico_edit
                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/editar') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::editAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_edit',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_edit',);
                }

                // admin_minsal_seguimiento_sechistorialclinico_delete
                if (preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::deleteAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_delete',));
                }

                // admin_minsal_seguimiento_sechistorialclinico_show
                if (preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::showAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_show',));
                }

                // admin_minsal_seguimiento_sechistorialclinico_export
                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/export') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::exportAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_export',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_export',);
                }

                // admin_minsal_seguimiento_sechistorialclinico_preinscribir
                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/preinscribir') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::preinscribirAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_historial_clinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_preinscribir',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_preinscribir',);
                }

            }

            if (0 === strpos($pathinfo, '/admin/rayos-x-')) {
                if (0 === strpos($pathinfo, '/admin/rayos-x-material')) {
                    if (0 === strpos($pathinfo, '/admin/rayos-x-material-')) {
                        if (0 === strpos($pathinfo, '/admin/rayos-x-material-utilizado')) {
                            // simagd_material_utilizado_list
                            if ($pathinfo === '/admin/rayos-x-material-utilizado/list') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMaterialUtilizadoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_material_utilizado',  '_sonata_name' => 'simagd_material_utilizado_list',  '_route' => 'simagd_material_utilizado_list',);
                            }

                            // simagd_material_utilizado_create
                            if ($pathinfo === '/admin/rayos-x-material-utilizado/create') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMaterialUtilizadoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_material_utilizado',  '_sonata_name' => 'simagd_material_utilizado_create',  '_route' => 'simagd_material_utilizado_create',);
                            }

                            // simagd_material_utilizado_batch
                            if ($pathinfo === '/admin/rayos-x-material-utilizado/batch') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMaterialUtilizadoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_material_utilizado',  '_sonata_name' => 'simagd_material_utilizado_batch',  '_route' => 'simagd_material_utilizado_batch',);
                            }

                            // simagd_material_utilizado_edit
                            if (preg_match('#^/admin/rayos\\-x\\-material\\-utilizado/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_material_utilizado_edit')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMaterialUtilizadoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_material_utilizado',  '_sonata_name' => 'simagd_material_utilizado_edit',));
                            }

                            // simagd_material_utilizado_delete
                            if (preg_match('#^/admin/rayos\\-x\\-material\\-utilizado/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_material_utilizado_delete')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMaterialUtilizadoAdminController::deleteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_material_utilizado',  '_sonata_name' => 'simagd_material_utilizado_delete',));
                            }

                            // simagd_material_utilizado_show
                            if (preg_match('#^/admin/rayos\\-x\\-material\\-utilizado/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_material_utilizado_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMaterialUtilizadoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_material_utilizado',  '_sonata_name' => 'simagd_material_utilizado_show',));
                            }

                            // simagd_material_utilizado_export
                            if ($pathinfo === '/admin/rayos-x-material-utilizado/export') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgMaterialUtilizadoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_material_utilizado',  '_sonata_name' => 'simagd_material_utilizado_export',  '_route' => 'simagd_material_utilizado_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/rayos-x-material-local')) {
                            // simagd_material_local_list
                            if ($pathinfo === '/admin/rayos-x-material-local/lista') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_list',  '_route' => 'simagd_material_local_list',);
                            }

                            // simagd_material_local_create
                            if ($pathinfo === '/admin/rayos-x-material-local/crear') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_create',  '_route' => 'simagd_material_local_create',);
                            }

                            // simagd_material_local_batch
                            if ($pathinfo === '/admin/rayos-x-material-local/batch') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_batch',  '_route' => 'simagd_material_local_batch',);
                            }

                            // simagd_material_local_edit
                            if ($pathinfo === '/admin/rayos-x-material-local/editar') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_edit',  '_route' => 'simagd_material_local_edit',);
                            }

                            // simagd_material_local_show
                            if (preg_match('#^/admin/rayos\\-x\\-material\\-local/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_material_local_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_show',));
                            }

                            // simagd_material_local_export
                            if ($pathinfo === '/admin/rayos-x-material-local/export') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_export',  '_route' => 'simagd_material_local_export',);
                            }

                            // simagd_material_local_agregarMaterialEnLocal
                            if ($pathinfo === '/admin/rayos-x-material-local/agregarMaterialEnLocal') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::agregarMaterialEnLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_agregarMaterialEnLocal',  '_route' => 'simagd_material_local_agregarMaterialEnLocal',);
                            }

                            // simagd_material_local_crearMaterialLocal
                            if ($pathinfo === '/admin/rayos-x-material-local/crearMaterialLocal') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_simagd_material_local_crearMaterialLocal;
                                }

                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::crearMaterialLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_crearMaterialLocal',  '_route' => 'simagd_material_local_crearMaterialLocal',);
                            }
                            not_simagd_material_local_crearMaterialLocal:

                            // simagd_material_local_editarMaterialLocal
                            if ($pathinfo === '/admin/rayos-x-material-local/editarMaterialLocal') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_simagd_material_local_editarMaterialLocal;
                                }

                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::editarMaterialLocalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_editarMaterialLocal',  '_route' => 'simagd_material_local_editarMaterialLocal',);
                            }
                            not_simagd_material_local_editarMaterialLocal:

                            // simagd_material_local_listarMaterialesLocales
                            if ($pathinfo === '/admin/rayos-x-material-local/listarMaterialesLocales') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::listarMaterialesLocalesAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_listarMaterialesLocales',  '_route' => 'simagd_material_local_listarMaterialesLocales',);
                            }

                            // simagd_material_local_getObjectVarsAsArray
                            if ($pathinfo === '/admin/rayos-x-material-local/getObjectVarsAsArray') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_simagd_material_local_getObjectVarsAsArray;
                                }

                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_getObjectVarsAsArray',  '_route' => 'simagd_material_local_getObjectVarsAsArray',);
                            }
                            not_simagd_material_local_getObjectVarsAsArray:

                            // simagd_material_local_obtenerMaterialesNoAgregados
                            if ($pathinfo === '/admin/rayos-x-material-local/obtenerMaterialesNoAgregados') {
                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::obtenerMaterialesNoAgregadosAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_obtenerMaterialesNoAgregados',  '_route' => 'simagd_material_local_obtenerMaterialesNoAgregados',);
                            }

                            // simagd_material_local_habilitarMaterial
                            if ($pathinfo === '/admin/rayos-x-material-local/habilitarMaterial') {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_simagd_material_local_habilitarMaterial;
                                }

                                return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialEstablecimientoAdminController::habilitarMaterialAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material_establecimiento',  '_sonata_name' => 'simagd_material_local_habilitarMaterial',  '_route' => 'simagd_material_local_habilitarMaterial',);
                            }
                            not_simagd_material_local_habilitarMaterial:

                        }

                    }

                    // simagd_material_list
                    if ($pathinfo === '/admin/rayos-x-material/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_list',  '_route' => 'simagd_material_list',);
                    }

                    // simagd_material_create
                    if ($pathinfo === '/admin/rayos-x-material/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_create',  '_route' => 'simagd_material_create',);
                    }

                    // simagd_material_batch
                    if ($pathinfo === '/admin/rayos-x-material/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_batch',  '_route' => 'simagd_material_batch',);
                    }

                    // simagd_material_edit
                    if ($pathinfo === '/admin/rayos-x-material/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_edit',  '_route' => 'simagd_material_edit',);
                    }

                    // simagd_material_show
                    if (preg_match('#^/admin/rayos\\-x\\-material/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_material_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_show',));
                    }

                    // simagd_material_export
                    if ($pathinfo === '/admin/rayos-x-material/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_export',  '_route' => 'simagd_material_export',);
                    }

                    // simagd_material_agregarEnMiCatalogo
                    if ($pathinfo === '/admin/rayos-x-material/agregarEnMiCatalogo') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::agregarEnMiCatalogoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_agregarEnMiCatalogo',  '_route' => 'simagd_material_agregarEnMiCatalogo',);
                    }

                    // simagd_material_crearMaterial
                    if ($pathinfo === '/admin/rayos-x-material/crearMaterial') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_material_crearMaterial;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::crearMaterialAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_crearMaterial',  '_route' => 'simagd_material_crearMaterial',);
                    }
                    not_simagd_material_crearMaterial:

                    // simagd_material_editarMaterial
                    if ($pathinfo === '/admin/rayos-x-material/editarMaterial') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_material_editarMaterial;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::editarMaterialAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_editarMaterial',  '_route' => 'simagd_material_editarMaterial',);
                    }
                    not_simagd_material_editarMaterial:

                    // simagd_material_listarMateriales
                    if ($pathinfo === '/admin/rayos-x-material/listarMateriales') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::listarMaterialesAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_listarMateriales',  '_route' => 'simagd_material_listarMateriales',);
                    }

                    // simagd_material_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-material/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_material_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlMaterialAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_material',  '_sonata_name' => 'simagd_material_getObjectVarsAsArray',  '_route' => 'simagd_material_getObjectVarsAsArray',);
                    }
                    not_simagd_material_getObjectVarsAsArray:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-bloqueos')) {
                    // simagd_bloqueo_agenda_list
                    if ($pathinfo === '/admin/rayos-x-bloqueos/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_list',  '_route' => 'simagd_bloqueo_agenda_list',);
                    }

                    // simagd_bloqueo_agenda_show
                    if (preg_match('#^/admin/rayos\\-x\\-bloqueos/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_bloqueo_agenda_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_show',));
                    }

                    // simagd_bloqueo_agenda_obtenerBloqueosAgenda
                    if ($pathinfo === '/admin/rayos-x-bloqueos/obtenerBloqueosAgenda') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::obtenerBloqueosAgendaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_obtenerBloqueosAgenda',  '_route' => 'simagd_bloqueo_agenda_obtenerBloqueosAgenda',);
                    }

                    // simagd_bloqueo_agenda_nuevoBloqueo
                    if ($pathinfo === '/admin/rayos-x-bloqueos/nuevoBloqueo') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_bloqueo_agenda_nuevoBloqueo;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::nuevoBloqueoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_nuevoBloqueo',  '_route' => 'simagd_bloqueo_agenda_nuevoBloqueo',);
                    }
                    not_simagd_bloqueo_agenda_nuevoBloqueo:

                    // simagd_bloqueo_agenda_actualizarBloqueo
                    if ($pathinfo === '/admin/rayos-x-bloqueos/actualizarBloqueo') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_bloqueo_agenda_actualizarBloqueo;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::actualizarBloqueoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_actualizarBloqueo',  '_route' => 'simagd_bloqueo_agenda_actualizarBloqueo',);
                    }
                    not_simagd_bloqueo_agenda_actualizarBloqueo:

                    // simagd_bloqueo_agenda_removerBloqueo
                    if ($pathinfo === '/admin/rayos-x-bloqueos/removerBloqueo') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_bloqueo_agenda_removerBloqueo;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::removerBloqueoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_removerBloqueo',  '_route' => 'simagd_bloqueo_agenda_removerBloqueo',);
                    }
                    not_simagd_bloqueo_agenda_removerBloqueo:

                    // simagd_bloqueo_agenda_listarBloqueos
                    if ($pathinfo === '/admin/rayos-x-bloqueos/listarBloqueos') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::listarBloqueosAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_listarBloqueos',  '_route' => 'simagd_bloqueo_agenda_listarBloqueos',);
                    }

                    // simagd_bloqueo_agenda_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-bloqueos/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_bloqueo_agenda_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_getObjectVarsAsArray',  '_route' => 'simagd_bloqueo_agenda_getObjectVarsAsArray',);
                    }
                    not_simagd_bloqueo_agenda_getObjectVarsAsArray:

                    // simagd_bloqueo_agenda_excluirRadiologoBloqueo
                    if ($pathinfo === '/admin/rayos-x-bloqueos/excluirRadiologoBloqueo') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_bloqueo_agenda_excluirRadiologoBloqueo;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgBloqueoAgendaAdminController::excluirRadiologoBloqueoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_bloqueo_agenda',  '_sonata_name' => 'simagd_bloqueo_agenda_excluirRadiologoBloqueo',  '_route' => 'simagd_bloqueo_agenda_excluirRadiologoBloqueo',);
                    }
                    not_simagd_bloqueo_agenda_excluirRadiologoBloqueo:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-solicitud-estudio-complementario')) {
                    // simagd_solicitud_estudio_complementario_list
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_list',  '_route' => 'simagd_solicitud_estudio_complementario_list',);
                    }

                    // simagd_solicitud_estudio_complementario_create
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_create',  '_route' => 'simagd_solicitud_estudio_complementario_create',);
                    }

                    // simagd_solicitud_estudio_complementario_batch
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_batch',  '_route' => 'simagd_solicitud_estudio_complementario_batch',);
                    }

                    // simagd_solicitud_estudio_complementario_edit
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_edit',  '_route' => 'simagd_solicitud_estudio_complementario_edit',);
                    }

                    // simagd_solicitud_estudio_complementario_show
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/consultar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_show',  '_route' => 'simagd_solicitud_estudio_complementario_show',);
                    }

                    // simagd_solicitud_estudio_complementario_export
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_export',  '_route' => 'simagd_solicitud_estudio_complementario_export',);
                    }

                    // simagd_solicitud_estudio_complementario_mostrarInformacionModal
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/mostrarInformacionModal') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::mostrarInformacionModalAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_mostrarInformacionModal',  '_route' => 'simagd_solicitud_estudio_complementario_mostrarInformacionModal',);
                    }

                    // simagd_solicitud_estudio_complementario_listarSolicitudesEstudioComplementario
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/listarSolicitudesEstudioComplementario') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::listarSolicitudesEstudioComplementarioAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_listarSolicitudesEstudioComplementario',  '_route' => 'simagd_solicitud_estudio_complementario_listarSolicitudesEstudioComplementario',);
                    }

                    // simagd_solicitud_estudio_complementario_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_complementario_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_getObjectVarsAsArray',  '_route' => 'simagd_solicitud_estudio_complementario_getObjectVarsAsArray',);
                    }
                    not_simagd_solicitud_estudio_complementario_getObjectVarsAsArray:

                    if (0 === strpos($pathinfo, '/admin/rayos-x-solicitud-estudio-complementario/c')) {
                        // simagd_solicitud_estudio_complementario_cambiarPrioridadAtencionSolicitud
                        if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/cambiarPrioridadAtencionSolicitud') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_solicitud_estudio_complementario_cambiarPrioridadAtencionSolicitud;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::cambiarPrioridadAtencionSolicitudAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_cambiarPrioridadAtencionSolicitud',  '_route' => 'simagd_solicitud_estudio_complementario_cambiarPrioridadAtencionSolicitud',);
                        }
                        not_simagd_solicitud_estudio_complementario_cambiarPrioridadAtencionSolicitud:

                        // simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat
                        if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/crearSolicitudEstudioComplementarioFastFormat') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::crearSolicitudEstudioComplementarioFastFormatAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat',  '_route' => 'simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat',);
                        }
                        not_simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat:

                    }

                    // simagd_solicitud_estudio_complementario_editarSolicitudEstudioComplementarioFastFormat
                    if ($pathinfo === '/admin/rayos-x-solicitud-estudio-complementario/editarSolicitudEstudioComplementarioFastFormat') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_solicitud_estudio_complementario_editarSolicitudEstudioComplementarioFastFormat;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioAdminController::editarSolicitudEstudioComplementarioFastFormatAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_editarSolicitudEstudioComplementarioFastFormat',  '_route' => 'simagd_solicitud_estudio_complementario_editarSolicitudEstudioComplementarioFastFormat',);
                    }
                    not_simagd_solicitud_estudio_complementario_editarSolicitudEstudioComplementarioFastFormat:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-proyecciones-complementarias-solicitadas')) {
                    // simagd_solicitud_estudio_complementario_proyeccion_list
                    if ($pathinfo === '/admin/rayos-x-proyecciones-complementarias-solicitadas/list') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioProyeccionAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_proyeccion_list',  '_route' => 'simagd_solicitud_estudio_complementario_proyeccion_list',);
                    }

                    // simagd_solicitud_estudio_complementario_proyeccion_create
                    if ($pathinfo === '/admin/rayos-x-proyecciones-complementarias-solicitadas/create') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioProyeccionAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_proyeccion_create',  '_route' => 'simagd_solicitud_estudio_complementario_proyeccion_create',);
                    }

                    // simagd_solicitud_estudio_complementario_proyeccion_batch
                    if ($pathinfo === '/admin/rayos-x-proyecciones-complementarias-solicitadas/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioProyeccionAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_proyeccion_batch',  '_route' => 'simagd_solicitud_estudio_complementario_proyeccion_batch',);
                    }

                    // simagd_solicitud_estudio_complementario_proyeccion_edit
                    if (preg_match('#^/admin/rayos\\-x\\-proyecciones\\-complementarias\\-solicitadas/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_solicitud_estudio_complementario_proyeccion_edit')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioProyeccionAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_proyeccion_edit',));
                    }

                    // simagd_solicitud_estudio_complementario_proyeccion_delete
                    if (preg_match('#^/admin/rayos\\-x\\-proyecciones\\-complementarias\\-solicitadas/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_solicitud_estudio_complementario_proyeccion_delete')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioProyeccionAdminController::deleteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_proyeccion_delete',));
                    }

                    // simagd_solicitud_estudio_complementario_proyeccion_show
                    if (preg_match('#^/admin/rayos\\-x\\-proyecciones\\-complementarias\\-solicitadas/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_solicitud_estudio_complementario_proyeccion_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioProyeccionAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_proyeccion_show',));
                    }

                    // simagd_solicitud_estudio_complementario_proyeccion_export
                    if ($pathinfo === '/admin/rayos-x-proyecciones-complementarias-solicitadas/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgSolicitudEstudioComplementarioProyeccionAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_solicitud_estudio_complementario_proyeccion',  '_sonata_name' => 'simagd_solicitud_estudio_complementario_proyeccion_export',  '_route' => 'simagd_solicitud_estudio_complementario_proyeccion_export',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/minsal/simagd/imglecturaestudio')) {
                // admin_minsal_simagd_imglecturaestudio_list
                if ($pathinfo === '/admin/minsal/simagd/imglecturaestudio/list') {
                    return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaEstudioAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura_estudio',  '_sonata_name' => 'admin_minsal_simagd_imglecturaestudio_list',  '_route' => 'admin_minsal_simagd_imglecturaestudio_list',);
                }

                // admin_minsal_simagd_imglecturaestudio_create
                if ($pathinfo === '/admin/minsal/simagd/imglecturaestudio/create') {
                    return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaEstudioAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura_estudio',  '_sonata_name' => 'admin_minsal_simagd_imglecturaestudio_create',  '_route' => 'admin_minsal_simagd_imglecturaestudio_create',);
                }

                // admin_minsal_simagd_imglecturaestudio_batch
                if ($pathinfo === '/admin/minsal/simagd/imglecturaestudio/batch') {
                    return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaEstudioAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura_estudio',  '_sonata_name' => 'admin_minsal_simagd_imglecturaestudio_batch',  '_route' => 'admin_minsal_simagd_imglecturaestudio_batch',);
                }

                // admin_minsal_simagd_imglecturaestudio_edit
                if (preg_match('#^/admin/minsal/simagd/imglecturaestudio/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_simagd_imglecturaestudio_edit')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaEstudioAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura_estudio',  '_sonata_name' => 'admin_minsal_simagd_imglecturaestudio_edit',));
                }

                // admin_minsal_simagd_imglecturaestudio_delete
                if (preg_match('#^/admin/minsal/simagd/imglecturaestudio/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_simagd_imglecturaestudio_delete')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaEstudioAdminController::deleteAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura_estudio',  '_sonata_name' => 'admin_minsal_simagd_imglecturaestudio_delete',));
                }

                // admin_minsal_simagd_imglecturaestudio_show
                if (preg_match('#^/admin/minsal/simagd/imglecturaestudio/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_simagd_imglecturaestudio_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaEstudioAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura_estudio',  '_sonata_name' => 'admin_minsal_simagd_imglecturaestudio_show',));
                }

                // admin_minsal_simagd_imglecturaestudio_export
                if ($pathinfo === '/admin/minsal/simagd/imglecturaestudio/export') {
                    return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgLecturaEstudioAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_lectura_estudio',  '_sonata_name' => 'admin_minsal_simagd_imglecturaestudio_export',  '_route' => 'admin_minsal_simagd_imglecturaestudio_export',);
                }

            }

            if (0 === strpos($pathinfo, '/admin/rayos-x-')) {
                if (0 === strpos($pathinfo, '/admin/rayos-x-dato-autocomplemento')) {
                    // simagd_dato_autocomplemento_list
                    if ($pathinfo === '/admin/rayos-x-dato-autocomplemento/lista') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_list',  '_route' => 'simagd_dato_autocomplemento_list',);
                    }

                    // simagd_dato_autocomplemento_create
                    if ($pathinfo === '/admin/rayos-x-dato-autocomplemento/crear') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_create',  '_route' => 'simagd_dato_autocomplemento_create',);
                    }

                    // simagd_dato_autocomplemento_batch
                    if ($pathinfo === '/admin/rayos-x-dato-autocomplemento/batch') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_batch',  '_route' => 'simagd_dato_autocomplemento_batch',);
                    }

                    // simagd_dato_autocomplemento_edit
                    if ($pathinfo === '/admin/rayos-x-dato-autocomplemento/editar') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_edit',  '_route' => 'simagd_dato_autocomplemento_edit',);
                    }

                    // simagd_dato_autocomplemento_show
                    if (preg_match('#^/admin/rayos\\-x\\-dato\\-autocomplemento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_dato_autocomplemento_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_show',));
                    }

                    // simagd_dato_autocomplemento_export
                    if ($pathinfo === '/admin/rayos-x-dato-autocomplemento/export') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_export',  '_route' => 'simagd_dato_autocomplemento_export',);
                    }

                    // simagd_dato_autocomplemento_listarDatosAutocomplemento
                    if ($pathinfo === '/admin/rayos-x-dato-autocomplemento/listarDatosAutocomplemento') {
                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::listarDatosAutocomplementoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_listarDatosAutocomplemento',  '_route' => 'simagd_dato_autocomplemento_listarDatosAutocomplemento',);
                    }

                    // simagd_dato_autocomplemento_getObjectVarsAsArray
                    if ($pathinfo === '/admin/rayos-x-dato-autocomplemento/getObjectVarsAsArray') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_simagd_dato_autocomplemento_getObjectVarsAsArray;
                        }

                        return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgDatoAutocomplementoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_dato_autocomplemento',  '_sonata_name' => 'simagd_dato_autocomplemento_getObjectVarsAsArray',  '_route' => 'simagd_dato_autocomplemento_getObjectVarsAsArray',);
                    }
                    not_simagd_dato_autocomplemento_getObjectVarsAsArray:

                }

                if (0 === strpos($pathinfo, '/admin/rayos-x-p')) {
                    if (0 === strpos($pathinfo, '/admin/rayos-x-patron-diagnostico')) {
                        // simagd_patron_diagnostico_list
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/lista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_list',  '_route' => 'simagd_patron_diagnostico_list',);
                        }

                        // simagd_patron_diagnostico_create
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/crear') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_create',  '_route' => 'simagd_patron_diagnostico_create',);
                        }

                        // simagd_patron_diagnostico_batch
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/batch') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_batch',  '_route' => 'simagd_patron_diagnostico_batch',);
                        }

                        // simagd_patron_diagnostico_edit
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/editar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_edit',  '_route' => 'simagd_patron_diagnostico_edit',);
                        }

                        // simagd_patron_diagnostico_show
                        if (preg_match('#^/admin/rayos\\-x\\-patron\\-diagnostico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_patron_diagnostico_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_show',));
                        }

                        // simagd_patron_diagnostico_export
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/export') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_export',  '_route' => 'simagd_patron_diagnostico_export',);
                        }

                        // simagd_patron_diagnostico_agregarEnMiCatalogo
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/agregarEnMiCatalogo') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::agregarEnMiCatalogoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_agregarEnMiCatalogo',  '_route' => 'simagd_patron_diagnostico_agregarEnMiCatalogo',);
                        }

                        // simagd_patron_diagnostico_crearPatronDiagnostico
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/crearPatronDiagnostico') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_patron_diagnostico_crearPatronDiagnostico;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::crearPatronDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_crearPatronDiagnostico',  '_route' => 'simagd_patron_diagnostico_crearPatronDiagnostico',);
                        }
                        not_simagd_patron_diagnostico_crearPatronDiagnostico:

                        // simagd_patron_diagnostico_editarPatronDiagnostico
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/editarPatronDiagnostico') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_patron_diagnostico_editarPatronDiagnostico;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::editarPatronDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_editarPatronDiagnostico',  '_route' => 'simagd_patron_diagnostico_editarPatronDiagnostico',);
                        }
                        not_simagd_patron_diagnostico_editarPatronDiagnostico:

                        // simagd_patron_diagnostico_listarPatronesDiagnostico
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/listarPatronesDiagnostico') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::listarPatronesDiagnosticoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_listarPatronesDiagnostico',  '_route' => 'simagd_patron_diagnostico_listarPatronesDiagnostico',);
                        }

                        // simagd_patron_diagnostico_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_patron_diagnostico_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_getObjectVarsAsArray',  '_route' => 'simagd_patron_diagnostico_getObjectVarsAsArray',);
                        }
                        not_simagd_patron_diagnostico_getObjectVarsAsArray:

                        // simagd_patron_diagnostico_addDiagnosisAsPattern
                        if ($pathinfo === '/admin/rayos-x-patron-diagnostico/addDiagnosisAsPattern') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPatronDiagnosticoAdminController::addDiagnosisAsPatternAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_patron_diagnostico',  '_sonata_name' => 'simagd_patron_diagnostico_addDiagnosisAsPattern',  '_route' => 'simagd_patron_diagnostico_addDiagnosisAsPattern',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/rayos-x-preparacion-estudio')) {
                        // simagd_preparacion_estudio_list
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/lista') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::listAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_list',  '_route' => 'simagd_preparacion_estudio_list',);
                        }

                        // simagd_preparacion_estudio_create
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/crear') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::createAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_create',  '_route' => 'simagd_preparacion_estudio_create',);
                        }

                        // simagd_preparacion_estudio_batch
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/batch') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::batchAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_batch',  '_route' => 'simagd_preparacion_estudio_batch',);
                        }

                        // simagd_preparacion_estudio_edit
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/editar') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::editAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_edit',  '_route' => 'simagd_preparacion_estudio_edit',);
                        }

                        // simagd_preparacion_estudio_show
                        if (preg_match('#^/admin/rayos\\-x\\-preparacion\\-estudio/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'simagd_preparacion_estudio_show')), array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::showAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_show',));
                        }

                        // simagd_preparacion_estudio_export
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/export') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::exportAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_export',  '_route' => 'simagd_preparacion_estudio_export',);
                        }

                        // simagd_preparacion_estudio_agregarEnMiCatalogo
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/agregarEnMiCatalogo') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::agregarEnMiCatalogoAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_agregarEnMiCatalogo',  '_route' => 'simagd_preparacion_estudio_agregarEnMiCatalogo',);
                        }

                        // simagd_preparacion_estudio_crearIndicacionCita
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/crearIndicacionCita') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_preparacion_estudio_crearIndicacionCita;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::crearIndicacionCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_crearIndicacionCita',  '_route' => 'simagd_preparacion_estudio_crearIndicacionCita',);
                        }
                        not_simagd_preparacion_estudio_crearIndicacionCita:

                        // simagd_preparacion_estudio_editarIndicacionCita
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/editarIndicacionCita') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_preparacion_estudio_editarIndicacionCita;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::editarIndicacionCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_editarIndicacionCita',  '_route' => 'simagd_preparacion_estudio_editarIndicacionCita',);
                        }
                        not_simagd_preparacion_estudio_editarIndicacionCita:

                        // simagd_preparacion_estudio_listarIndicacionesCita
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/listarIndicacionesCita') {
                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::listarIndicacionesCitaAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_listarIndicacionesCita',  '_route' => 'simagd_preparacion_estudio_listarIndicacionesCita',);
                        }

                        // simagd_preparacion_estudio_getObjectVarsAsArray
                        if ($pathinfo === '/admin/rayos-x-preparacion-estudio/getObjectVarsAsArray') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_simagd_preparacion_estudio_getObjectVarsAsArray;
                            }

                            return array (  '_controller' => 'Minsal\\SimagdBundle\\Controller\\ImgCtlPreparacionEstudioAdminController::getObjectVarsAsArrayAction',  '_sonata_admin' => 'minsal_simagd.admin.img_ctl_preparacion_estudio',  '_sonata_name' => 'simagd_preparacion_estudio_getObjectVarsAsArray',  '_route' => 'simagd_preparacion_estudio_getObjectVarsAsArray',);
                        }
                        not_simagd_preparacion_estudio_getObjectVarsAsArray:

                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/sonata/user/group')) {
                // admin_sonata_user_group_list
                if ($pathinfo === '/admin/sonata/user/group/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_list',  '_route' => 'admin_sonata_user_group_list',);
                }

                // admin_sonata_user_group_create
                if ($pathinfo === '/admin/sonata/user/group/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_create',  '_route' => 'admin_sonata_user_group_create',);
                }

                // admin_sonata_user_group_batch
                if ($pathinfo === '/admin/sonata/user/group/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_batch',  '_route' => 'admin_sonata_user_group_batch',);
                }

                // admin_sonata_user_group_edit
                if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_edit',));
                }

                // admin_sonata_user_group_delete
                if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_delete',));
                }

                // admin_sonata_user_group_show
                if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_show',));
                }

                // admin_sonata_user_group_export
                if ($pathinfo === '/admin/sonata/user/group/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_export',  '_route' => 'admin_sonata_user_group_export',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/sonata/cache')) {
            // sonata_cache_esi
            if (0 === strpos($pathinfo, '/sonata/cache/esi') && preg_match('#^/sonata/cache/esi/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_esi')), array (  '_controller' => 'sonata.cache.esi:cacheAction',));
            }

            // sonata_cache_ssi
            if (0 === strpos($pathinfo, '/sonata/cache/ssi') && preg_match('#^/sonata/cache/ssi/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_ssi')), array (  '_controller' => 'sonata.cache.ssi:cacheAction',));
            }

            if (0 === strpos($pathinfo, '/sonata/cache/js-')) {
                // sonata_cache_js_async
                if ($pathinfo === '/sonata/cache/js-async') {
                    return array (  '_controller' => 'sonata.cache.js_async:cacheAction',  '_route' => 'sonata_cache_js_async',);
                }

                // sonata_cache_js_sync
                if ($pathinfo === '/sonata/cache/js-sync') {
                    return array (  '_controller' => 'sonata.cache.js_sync:cacheAction',  '_route' => 'sonata_cache_js_sync',);
                }

            }

            // sonata_cache_apc
            if (0 === strpos($pathinfo, '/sonata/cache/apc') && preg_match('#^/sonata/cache/apc/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_apc')), array (  '_controller' => 'sonata.cache.apc:cacheAction',));
            }

            // sonata_cache_symfony
            if (0 === strpos($pathinfo, '/sonata/cache/symfony') && preg_match('#^/sonata/cache/symfony/(?P<token>[^/]++)/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_symfony')), array (  '_controller' => 'sonata.cache.symfony:cacheAction',));
            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'fos_user_security_login',);
                }

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'fos_user_security_logout',);
            }

            if (0 === strpos($pathinfo, '/login')) {
                // sonata_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'sonata_user_security_login',);
                }

                // sonata_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_sonata_user_security_check;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'sonata_user_security_check',);
                }
                not_sonata_user_security_check:

            }

            // sonata_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'sonata_user_security_logout',);
            }

        }

        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            if (0 === strpos($pathinfo, '/resetting/re')) {
                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
                }
                not_fos_user_resetting_reset:

                // sonata_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_resetting_request;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'sonata_user_resetting_request',);
                }
                not_sonata_user_resetting_request:

            }

            // sonata_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_sonata_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'sonata_user_resetting_send_email',);
            }
            not_sonata_user_resetting_send_email:

            // sonata_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_resetting_check_email',);
            }
            not_sonata_user_resetting_check_email:

            // sonata_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_sonata_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
            }
            not_sonata_user_resetting_reset:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // fos_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'fos_user_profile_edit_authentication',);
                }

                // fos_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'fos_user_profile_edit',);
                }

            }

            // sonata_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_profile_show');
                }

                return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'sonata_user_profile_show',);
            }
            not_sonata_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // sonata_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'sonata_user_profile_edit_authentication',);
                }

                // sonata_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'sonata_user_profile_edit',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/register')) {
            // fos_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'fos_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // fos_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                }
                not_fos_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // fos_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_fos_user_registration_confirm:

                    // fos_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                    }
                    not_fos_user_registration_confirmed:

                }

            }

            // sonata_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'sonata_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // sonata_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_registration_check_email',);
                }
                not_sonata_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // sonata_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_sonata_user_registration_confirm:

                    // sonata_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'sonata_user_registration_confirmed',);
                    }
                    not_sonata_user_registration_confirmed:

                }

            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/change-password')) {
                // fos_user_change_password
                if ($pathinfo === '/admin/change-password') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_change_password;
                    }

                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'fos_user_change_password',);
                }
                not_fos_user_change_password:

                // sonata_user_change_password
                if ($pathinfo === '/admin/change-password') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_sonata_user_change_password;
                    }

                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'sonata_user_change_password',);
                }
                not_sonata_user_change_password:

            }

            if (0 === strpos($pathinfo, '/admin/log')) {
                if (0 === strpos($pathinfo, '/admin/login')) {
                    // sonata_user_admin_security_login
                    if ($pathinfo === '/admin/login') {
                        return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\AdminSecurityController::loginAction',  '_route' => 'sonata_user_admin_security_login',);
                    }

                    // sonata_user_admin_security_check
                    if ($pathinfo === '/admin/login_check') {
                        return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\AdminSecurityController::checkAction',  '_route' => 'sonata_user_admin_security_check',);
                    }

                }

                // sonata_user_admin_security_logout
                if ($pathinfo === '/admin/logout') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\AdminSecurityController::logoutAction',  '_route' => 'sonata_user_admin_security_logout',);
                }

            }

        }

        // fullcalendar_loader
        if ($pathinfo === '/fc-load-events') {
            return array (  '_controller' => 'ADesigns\\CalendarBundle\\Controller\\CalendarController::loadCalendarAction',  '_route' => 'fullcalendar_loader',);
        }

        // fos_js_routing_js
        if (0 === strpos($pathinfo, '/js/routing') && preg_match('#^/js/routing(?:\\.(?P<_format>js|json))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_js_routing_js')), array (  '_controller' => 'fos_js_routing.controller:indexAction',  '_format' => 'js',));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
