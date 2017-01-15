(
	select m.id as m_id, tcnl.id as tcnl_id, concat(tcnl.nombre, ' ', tcnl.apellido) as nombre, count(tcnl.id) as num
	from img_procedimiento_realizado prz
		inner join mnt_empleado tcnl 
			on tcnl.id = prz.id_tecnologo_realiza
		left join img_solicitud_estudio prc 
			on prc.id = prz.id_solicitud_estudio
		left join ctl_area_servicio_apoyo m
			on m.id = prc.id_area_servicio_diagnostico
	where prc.id_establecimiento_referido = 30
	group by m.id, tcnl.id
	order by m_id asc, num desc, tcnl.id asc
)

union

(
	select mcmpl.id as mcmpl_id, tcnl.id as tcnl_id, concat(tcnl.nombre, ' ', tcnl.apellido) as nombre, count(tcnl.id) as num
	from img_procedimiento_realizado prz
		inner join mnt_empleado tcnl 
			on tcnl.id = prz.id_tecnologo_realiza
		left join img_solicitud_estudio_complementario solcmpl 
			on solcmpl.id = prz.id_solicitud_estudio_complementario
		left join ctl_area_servicio_apoyo mcmpl
			on mcmpl.id = solcmpl.id_area_servicio_diagnostico
	where solcmpl.id_establecimiento_solicitado = 30
	group by mcmpl.id, tcnl.id
	order by mcmpl_id asc, num desc, tcnl.id asc
);


select distinct prz.id_tecnologo_realiza
from img_procedimiento_realizado prz
	inner join fos_user_user usRg 
		on usRg.id = prz.id_user_reg
where usRg.id_establecimiento = 30;



/***********************************************************************************/
cambio a la base
/***********************************************************************************/
ALTER TABLE ctl_area_servicio_apoyo
   ALTER COLUMN nombrearea TYPE character varying(75);
COMMENT ON COLUMN ctl_area_servicio_apoyo.nombrearea IS 'Nombre de Área';
/***********************************************************************************/


/***********************************************************************************/
select mr.id as mr_id, m.nombrearea as area, m.img_codigo as area_cod, 
exm.descripcion as examen, exm.img_codigo as exm_cod, img_habilitado as hbl, 
img_realiza_lectura as lct from mnt_area_examen_establecimiento mr inner join 
ctl_area_servicio_apoyo m on m.id = mr.id_area_servicio_apoyo inner join 
ctl_examen_servicio_apoyo exm on exm.id = mr.id_examen_servicio_diagnostico where 
mr.id_establecimiento = 30 and m.id_atencion = 97 and exm.id_atencion = 97 
order by mr.id desc;
/***********************************************************************************/

/***********************************************************************************/
select x.nombre, x.codigo from img_ctl_exploracion x 
inner join img_ctl_exploracion_realizable xr on x.id = xr.id_proyeccion;
/***********************************************************************************/

/***********************************************************************************/
select e.id, e.numero, concat(pct.primer_apellido, ' ', coalesce(pct.segundo_apellido, ''), ', ', pct.primer_nombre, ' ', coalesce(pct.segundo_nombre, '')) as pct_nombreCompleto from mnt_expediente e inner join mnt_paciente pct on pct.id = e.id_paciente where e.numero like '%1%' and id_establecimiento = 30 order by e.numero, pct_nombreCompleto;
/***********************************************************************************/
