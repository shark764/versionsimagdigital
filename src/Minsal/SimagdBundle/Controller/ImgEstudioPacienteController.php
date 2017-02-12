<?php
namespace Minsal\SimagdBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Minsal\Metodos\Funciones;
use Doctrine\DBAL as DBAL;
class ImgEstudioPacienteController extends Controller {
    /**
     * @Route("/buscar/estudio", name="buscar_estudio", options={"expose"=true})
     */
    public function buscarEstudioAction()
    {
        $em = $this->getDoctrine()->getManager();
        //establecimiento donde se realizara la busqueda
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();
        
        return $this->render('MinsalSimagdBundle:RyxEstudioPorImagenesAdmin:resultado_busqueda_estudios.html.twig', array('tipo_busqueda' => 'l'));
       }
        
    /**
     * @Route("/cargar/estudio", name="cargar_estudio", options={"expose"=true})
     */
    public function cargarEstudioJSON()
    {
        /*Recuperar parametros para realizar la busqueda*/
        $request = $this->getRequest();
        $nec = chop(ltrim($request->get('nec')));
        $dui = $request->get('dui');
        $fechaDesde = chop(ltrim($request->get('fecha_desde')));
        $fechaHasta = chop(ltrim($request->get('fecha_hasta')));       
        
        /*Variable Doctrine*/
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $sql = "";
        
        
        /* Valida si el unico parametro de busqueda es el numero de expediente */
        if ($nec && empty($dui) && empty($fechaDesde)
                && empty($fechaHasta))
        {
            $sql = "select est.id as id,est.url as url,exp.numero as expediente,
	pct.primer_nombre || ' ' || pct.primer_apellido as paciente,
	prz.tecnica_utilizada as tecnicautiliza,
	estd_prz.nombre_estado as estado,
	case 
		when estd_prz.id = 2 then prz.fecha_atendido
		when estd_prz.id = 3 then prz.fecha_realizado
		when estd_prz.id = 4 then prz.fecha_procesado
		when estd_prz.id = 5 then prz.fecha_almacenado
		else null
	end as fechaactividad,
	est.fecha_estudio as fechadeestudio, 
	prc.fecha_creacion as sepreinscribio, 
	expl.nombre as exploracion, 
	exm.descripcion as examen, 
	m.nombrearea AS modalidad, 
	emp.nombre || ' ' || emp.apellido as preinscribio,
	tcnl.nombre || ' ' || tcnl.apellido as realizo, 
	atn.nombre as servicioclinico, 
	ar.nombre as procedencia, 
	stdprc.nombre as seprescribio, 
	case
		when exists (		select lct.id 
					from img_lectura lct 
					where est.id = lct.id_estudio
				) then 'diagnosticado'
		else 'sin lectura'
	end as diagnosticado
from img_estudio_paciente est 
	inner join img_procedimiento_realizado prz 	on prz.id = est.id_procedimiento_realizado
	inner join img_ctl_estado_procedimiento_realizado estd_prz on estd_prz.id = prz.id_estado_procedimiento_realizado
	inner join img_solicitud_estudio prc 		on prc.id = prz.id_solicitud_estudio
	inner join mnt_expediente exp 			on exp.id = prc.id_expediente
	inner join mnt_paciente pct 			on pct.id = exp.id_paciente
	inner join img_solicitud_estudio_proyeccion prc_expl on prc.id = prc_expl.id_solicitud_estudio
	inner join img_ctl_proyeccion expl 		on expl.id = prc_expl.id_proyeccion_solicitada
	inner join ctl_examen_servicio_diagnostico exm 	on exm.id = expl.id_examen_servicio_diagnostico
	inner join ctl_area_servicio_diagnostico m 		on m.id = prc.id_area_servicio_diagnostico
	inner join mnt_aten_area_mod_estab aams 	on aams.id = prc.id_aten_area_mod_estab
	inner join mnt_area_mod_estab ams 		on ams.id = aams.id_area_mod_estab
	inner join mnt_empleado emp 			on emp.id = prc.id_empleado
	inner join mnt_empleado tcnl 			on tcnl.id = prz.id_tecnologo_realiza
	inner join ctl_atencion atn 			on atn.id = aams.id_atencion
	inner join ctl_area_atencion ar 		on ar.id = ams.id_area_atencion
	inner join ctl_establecimiento stdprc 		on stdprc.id = aams.id_establecimiento
	where exp.numero = '$nec' order by fechadeestudio desc";
            
        }
        else {
                /* Crea la consulta de busqueda para dui y nec */
                if ($nec && $dui && empty($fechaDesde)
                         && empty($fechaHasta))
                {
                    $sql = "select est.id as id,est.url as url,exp.numero as expediente,
	pct.primer_nombre || ' ' || pct.primer_apellido as paciente,
	prz.tecnica_utilizada as tecnicautiliza,
	estd_prz.nombre_estado as estado,
	case 
		when estd_prz.id = 2 then prz.fecha_atendido
		when estd_prz.id = 3 then prz.fecha_realizado
		when estd_prz.id = 4 then prz.fecha_procesado
		when estd_prz.id = 5 then prz.fecha_almacenado
		else null
	end as fechaactividad,
	est.fecha_estudio as fechadeestudio, 
	prc.fecha_creacion as sepreinscribio, 
	expl.nombre as exploracion, 
	exm.descripcion as examen, 
	m.nombrearea AS modalidad, 
	emp.nombre || ' ' || emp.apellido as preinscribio,
	tcnl.nombre || ' ' || tcnl.apellido as realizo, 
	atn.nombre as servicioclinico, 
	ar.nombre as procedencia, 
	stdprc.nombre as seprescribio, 
	case
		when exists (		select lct.id 
					from img_lectura lct 
					where est.id = lct.id_estudio
				) then 'diagnosticado'
		else 'sin lectura'
	end as diagnosticado
from img_estudio_paciente est 
	inner join img_procedimiento_realizado prz 	on prz.id = est.id_procedimiento_realizado
	inner join img_ctl_estado_procedimiento_realizado estd_prz on estd_prz.id = prz.id_estado_procedimiento_realizado
	inner join img_solicitud_estudio prc 		on prc.id = prz.id_solicitud_estudio
	inner join mnt_expediente exp 			on exp.id = prc.id_expediente
	inner join mnt_paciente pct 			on pct.id = exp.id_paciente
	inner join img_solicitud_estudio_proyeccion prc_expl on prc.id = prc_expl.id_solicitud_estudio
	inner join img_ctl_proyeccion expl 		on expl.id = prc_expl.id_proyeccion_solicitada
	inner join ctl_examen_servicio_diagnostico exm 	on exm.id = expl.id_examen_servicio_diagnostico
	inner join ctl_area_servicio_diagnostico m 		on m.id = prc.id_area_servicio_diagnostico
	inner join mnt_aten_area_mod_estab aams 	on aams.id = prc.id_aten_area_mod_estab
	inner join mnt_area_mod_estab ams 		on ams.id = aams.id_area_mod_estab
	inner join mnt_empleado emp 			on emp.id = prc.id_empleado
	inner join mnt_empleado tcnl 			on tcnl.id = prz.id_tecnologo_realiza
	inner join ctl_atencion atn 			on atn.id = aams.id_atencion
	inner join ctl_area_atencion ar 		on ar.id = ams.id_area_atencion
	inner join ctl_establecimiento stdprc 		on stdprc.id = aams.id_establecimiento
	where exp.numero = '$nec' order by fechadeestudio desc";
                }
                else
                {
                    /* Crea consulta para busqueda por nec, dui y fecha desde */
                    if ($nec && ($dui || empty($dui)) && $fechaDesde && empty($fechaHasta))
                    {
                        $sql = "select est.id as id,est.url as url,exp.numero as expediente,
	pct.primer_nombre || ' ' || pct.primer_apellido as paciente,
	prz.tecnica_utilizada as tecnicautiliza,
	estd_prz.nombre_estado as estado,
	case 
		when estd_prz.id = 2 then prz.fecha_atendido
		when estd_prz.id = 3 then prz.fecha_realizado
		when estd_prz.id = 4 then prz.fecha_procesado
		when estd_prz.id = 5 then prz.fecha_almacenado
		else null
	end as fechaactividad,
	est.fecha_estudio as fechadeestudio, 
	prc.fecha_creacion as sepreinscribio, 
	expl.nombre as exploracion, 
	exm.descripcion as examen, 
	m.nombrearea AS modalidad, 
	emp.nombre || ' ' || emp.apellido as preinscribio,
	tcnl.nombre || ' ' || tcnl.apellido as realizo, 
	atn.nombre as servicioclinico, 
	ar.nombre as procedencia, 
	stdprc.nombre as seprescribio, 
	case
		when exists (		select lct.id 
					from img_lectura lct 
					where est.id = lct.id_estudio
				) then 'diagnosticado'
		else 'sin lectura'
	end as diagnosticado
from img_estudio_paciente est 
	inner join img_procedimiento_realizado prz 	on prz.id = est.id_procedimiento_realizado
	inner join img_ctl_estado_procedimiento_realizado estd_prz on estd_prz.id = prz.id_estado_procedimiento_realizado
	inner join img_solicitud_estudio prc 		on prc.id = prz.id_solicitud_estudio
	inner join mnt_expediente exp 			on exp.id = prc.id_expediente
	inner join mnt_paciente pct 			on pct.id = exp.id_paciente
	inner join img_solicitud_estudio_proyeccion prc_expl on prc.id = prc_expl.id_solicitud_estudio
	inner join img_ctl_proyeccion expl 		on expl.id = prc_expl.id_proyeccion_solicitada
	inner join ctl_examen_servicio_diagnostico exm 	on exm.id = expl.id_examen_servicio_diagnostico
	inner join ctl_area_servicio_diagnostico m 		on m.id = prc.id_area_servicio_diagnostico
	inner join mnt_aten_area_mod_estab aams 	on aams.id = prc.id_aten_area_mod_estab
	inner join mnt_area_mod_estab ams 		on ams.id = aams.id_area_mod_estab
	inner join mnt_empleado emp 			on emp.id = prc.id_empleado
	inner join mnt_empleado tcnl 			on tcnl.id = prz.id_tecnologo_realiza
	inner join ctl_atencion atn 			on atn.id = aams.id_atencion
	inner join ctl_area_atencion ar 		on ar.id = ams.id_area_atencion
	inner join ctl_establecimiento stdprc 		on stdprc.id = aams.id_establecimiento
	where exp.numero = '$nec' and est.fecha_estudio > '$fechaDesde' order by fechadeestudio desc";
                    }
                    else
                    {
                        /* Crea consulta para busqueda por nec,dui, fecha hasta */
                        if ($nec && ($dui || empty($dui)) && $fechaHasta && empty($fechaDesde))
                        {
                           $sql = "select est.id as id,est.url as url,exp.numero as expediente,
	pct.primer_nombre || ' ' || pct.primer_apellido as paciente,
	prz.tecnica_utilizada as tecnicautiliza,
	estd_prz.nombre_estado as estado,
	case 
		when estd_prz.id = 2 then prz.fecha_atendido
		when estd_prz.id = 3 then prz.fecha_realizado
		when estd_prz.id = 4 then prz.fecha_procesado
		when estd_prz.id = 5 then prz.fecha_almacenado
		else null
	end as fechaactividad,
	est.fecha_estudio as fechadeestudio, 
	prc.fecha_creacion as sepreinscribio, 
	expl.nombre as exploracion, 
	exm.descripcion as examen, 
	m.nombrearea AS modalidad, 
	emp.nombre || ' ' || emp.apellido as preinscribio,
	tcnl.nombre || ' ' || tcnl.apellido as realizo, 
	atn.nombre as servicioclinico, 
	ar.nombre as procedencia, 
	stdprc.nombre as seprescribio, 
	case
		when exists (		select lct.id 
					from img_lectura lct 
					where est.id = lct.id_estudio
				) then 'diagnosticado'
		else 'sin lectura'
	end as diagnosticado
from img_estudio_paciente est 
	inner join img_procedimiento_realizado prz 	on prz.id = est.id_procedimiento_realizado
	inner join img_ctl_estado_procedimiento_realizado estd_prz on estd_prz.id = prz.id_estado_procedimiento_realizado
	inner join img_solicitud_estudio prc 		on prc.id = prz.id_solicitud_estudio
	inner join mnt_expediente exp 			on exp.id = prc.id_expediente
	inner join mnt_paciente pct 			on pct.id = exp.id_paciente
	inner join img_solicitud_estudio_proyeccion prc_expl on prc.id = prc_expl.id_solicitud_estudio
	inner join img_ctl_proyeccion expl 		on expl.id = prc_expl.id_proyeccion_solicitada
	inner join ctl_examen_servicio_diagnostico exm 	on exm.id = expl.id_examen_servicio_diagnostico
	inner join ctl_area_servicio_diagnostico m 		on m.id = prc.id_area_servicio_diagnostico
	inner join mnt_aten_area_mod_estab aams 	on aams.id = prc.id_aten_area_mod_estab
	inner join mnt_area_mod_estab ams 		on ams.id = aams.id_area_mod_estab
	inner join mnt_empleado emp 			on emp.id = prc.id_empleado
	inner join mnt_empleado tcnl 			on tcnl.id = prz.id_tecnologo_realiza
	inner join ctl_atencion atn 			on atn.id = aams.id_atencion
	inner join ctl_area_atencion ar 		on ar.id = ams.id_area_atencion
	inner join ctl_establecimiento stdprc 		on stdprc.id = aams.id_establecimiento
	where exp.numero = '$nec' and est.fecha_estudio < '$fechaHasta' order by fechadeestudio desc";
                        }
                        else
                        {
                            $sql = "select est.id as id,est.url as url,exp.numero as expediente,
	pct.primer_nombre || ' ' || pct.primer_apellido as paciente,
	prz.tecnica_utilizada as tecnicautiliza,
	estd_prz.nombre_estado as estado,
	case 
		when estd_prz.id = 2 then prz.fecha_atendido
		when estd_prz.id = 3 then prz.fecha_realizado
		when estd_prz.id = 4 then prz.fecha_procesado
		when estd_prz.id = 5 then prz.fecha_almacenado
		else null
	end as fechaactividad,
	est.fecha_estudio as fechadeestudio, 
	prc.fecha_creacion as sepreinscribio, 
	expl.nombre as exploracion, 
	exm.descripcion as examen, 
	m.nombrearea AS modalidad, 
	emp.nombre || ' ' || emp.apellido as preinscribio,
	tcnl.nombre || ' ' || tcnl.apellido as realizo, 
	atn.nombre as servicioclinico, 
	ar.nombre as procedencia, 
	stdprc.nombre as seprescribio, 
	case
		when exists (		select lct.id 
					from img_lectura lct 
					where est.id = lct.id_estudio
				) then 'diagnosticado'
		else 'sin lectura'
	end as diagnosticado
from img_estudio_paciente est 
	inner join img_procedimiento_realizado prz 	on prz.id = est.id_procedimiento_realizado
	inner join img_ctl_estado_procedimiento_realizado estd_prz on estd_prz.id = prz.id_estado_procedimiento_realizado
	inner join img_solicitud_estudio prc 		on prc.id = prz.id_solicitud_estudio
	inner join mnt_expediente exp 			on exp.id = prc.id_expediente
	inner join mnt_paciente pct 			on pct.id = exp.id_paciente
	inner join img_solicitud_estudio_proyeccion prc_expl on prc.id = prc_expl.id_solicitud_estudio
	inner join img_ctl_proyeccion expl 		on expl.id = prc_expl.id_proyeccion_solicitada
	inner join ctl_examen_servicio_diagnostico exm 	on exm.id = expl.id_examen_servicio_diagnostico
	inner join ctl_area_servicio_diagnostico m 		on m.id = prc.id_area_servicio_diagnostico
	inner join mnt_aten_area_mod_estab aams 	on aams.id = prc.id_aten_area_mod_estab
	inner join mnt_area_mod_estab ams 		on ams.id = aams.id_area_mod_estab
	inner join mnt_empleado emp 			on emp.id = prc.id_empleado
	inner join mnt_empleado tcnl 			on tcnl.id = prz.id_tecnologo_realiza
	inner join ctl_atencion atn 			on atn.id = aams.id_atencion
	inner join ctl_area_atencion ar 		on ar.id = ams.id_area_atencion
	inner join ctl_establecimiento stdprc 		on stdprc.id = aams.id_establecimiento
	where exp.numero = '$nec' and est.fecha_estudio::date between '$fechaDesde' and '$fechaHasta' order by fechadeestudio desc";
                        }
                    }
                }
        }
             
        /* Ejecutar la consulta obtenida en la variable $sql */
        $query = $conn->query($sql);
        
        //$establecimiento = $em->getRepository("MinsalSiapsBundle:CtlEstablecimiento")->obtenerEstablecimientoConfigurado();
        $establecimiento = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();
        $numfilas = count($query->rowCount());
        $i = 0;
        $rows = array();
        if ($numfilas > 0) {
            if ($establecimiento) {
                foreach ($query->fetchAll() as $aux) {
                        /*Modificar este parametro que crea el botton de ver estudios */
                        $link = $aux['url'];
                        $espacio = "<a class=\"btn btn-info btn-sm\" href=\"$link\" role=\"button\"><span class=\"glyphicon glyphicon-cloud-download\" aria-hidden=\"true\">Estudio</span></a>";
                        $numero = $aux['expediente'];
                        $idpaciente = $aux['paciente'];
                        $modalidad = $aux['modalidad'];
                        $seprescribio = $aux['sepreinscribio'];
                        $seprescribioen = $aux['seprescribio'];
                        $estado = $aux['estado'];
                        $procedencia = $aux['procedencia'];
                        $fecha_estudio = $aux['fechadeestudio'];
                        $diagnosticado = $aux['diagnosticado'];
                        $id = $aux['id'];
                        $rows[$i]['id'] = $id;
                        $fechaIngreso = null;
                     $rows[$i]['cell'] = array($id,
                        $espacio, $numero,                                                             
                        $idpaciente,
                        $modalidad,$seprescribio,$seprescribioen,
                         $estado,$procedencia,$fecha_estudio,$diagnosticado
                    );
                    $i++;
                }
            } else {
                foreach ($query->fetchAll() as $aux) {
                    $espacio = $aux['url'];
                    if (strcmp($tipo_busqueda, 'l') == 0) {
                        $numero = $aux['numero'];
                        $id = $aux['id'];
                    } else {
                        $numero = '';
                        $id = $aux['id'];
                    }
                    $rows[$i]['id'] = $id;
                    $rows[$i]['cell'] = array($id,
                        $espacio, $numero,$url,
                        $aux['primer_apellido'] . ' ' . $aux['segundo_apellido'] . ' ' . $aux['apellido_casada'],
                        $aux['primer_nombre'] . ' ' . $aux['segundo_nombre'] . ' ' . $aux['tercer_nombre'],
                        date('d-m-Y', strtotime($aux['fecha_nacimiento'])),
                        substr($aux['nombre'], 0, 4) . ":" . $aux['numero_doc_ide_paciente'],
                        $aux['nombre_madre'],
                        $aux['conocido_por']
                    );
                    $i++;
                }
            }
        }
        
        
        $datos = json_encode($rows);
        $pages = floor($numfilas / 10) + 1;
        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';
        return new Response($jsonresponse);
    }
   
}
