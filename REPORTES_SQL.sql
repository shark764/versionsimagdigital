-- DIAGNOSIS BY RADIOLOGIST
select 	e.id as id_emp,
	upper(concat(e.nombre, ' ', e.apellido)) as "radiólogo",
	upper(g.tipo) as tipo,
	count(l.id) as produccion
from mnt_empleado e
	left join img_lectura_radiologica l on e.id = l.id_empleado
	left join mnt_tipo_empleado g on g.id = e.id_tipo_empleado
group by g.tipo, e.id
/*having count(l.id) > 0*/
order by produccion desc, e.id;

-- EXAMS BY RADIOTECNICIAN
select 	e.id as id_emp,
	upper(concat(e.nombre, ' ', e.apellido)) as "lic / técnico / radiólogo",
	upper(g.tipo) as tipo,
	count(z.id) as produccion
from mnt_empleado e
	left join img_procedimiento_realizado z on e.id = z.id_tecnologo_realiza
	left join mnt_tipo_empleado g on g.id = e.id_tipo_empleado
group by g.tipo, e.id
/*having count(l.id) > 0*/
order by produccion desc, e.id;

-- EXAMS BY MODALITY AND RADIOTECNICIAN
select 	a.id as a_id,
	a.idarea as codigo,
	a.nombrearea as modalidad,
	e.id as id_emp,
	upper(concat(e.nombre, ' ', e.apellido)) as "lic / técnico / radiólogo",
	upper(g.tipo) as tipo,
	count(z.id) as produccion
from mnt_empleado e
	left join img_procedimiento_realizado z on e.id = z.id_tecnologo_realiza
	left join mnt_tipo_empleado g on g.id = e.id_tipo_empleado
	left join img_solicitud_estudio s on s.id = z.id_solicitud_estudio
	left join ctl_area_servicio_diagnostico a on a.id = s.id_area_servicio_diagnostico
group by g.tipo, e.id, a.id
/*having count(z.id) > 0*/
order by a.id, produccion desc, e.id;
