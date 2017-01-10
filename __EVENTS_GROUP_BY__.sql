
-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (day), ESTADO
-- 1: FECHA, 2: ID_STATUS, 3: STATUS, 4: EVENTS
-- //////////////////////////////////////////////////////
select date_trunc('day', c.fecha_hora_inicio) as "fecha", s.id as "s_id", s.nombre_estado, count(c.id) as "eventos"
from img_cita_programada c inner join img_ctl_estado_cita s on s.id = c.id_estado_cita 
where c.fecha_hora_inicio > now() - interval '12 months'
group by 2, 1
order by 1, 3 desc, 4 desc;

select date_trunc('day', c.fecha_hora_inicio) as "fecha", s.id as "s_id", s.nombre_estado, count(c.id) as "eventos"
from img_cita_programada c inner join img_ctl_estado_cita s on s.id = c.id_estado_cita 
where c.fecha_hora_inicio > now() - interval '12 months'
group by 2, 1
order by 3 desc, 1, 4 desc;



-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (day)
-- 1: FECHA, 2: EVENTS
-- //////////////////////////////////////////////////////
select date_trunc('day', fecha_hora_inicio) as "fecha", count(id) as "eventos"
from img_cita_programada                                                               
where fecha_hora_inicio > now() - interval '12 months'
group by 1   
order by 1 desc, 2 desc;



-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (semana)
-- 1: FECHA, 2: EVENTS
-- //////////////////////////////////////////////////////
select date_trunc('week', fecha_hora_inicio) as "fecha", count(id) as "eventos"
from img_cita_programada                                                           
where fecha_hora_inicio > now() - interval '12 months'
group by 1   
order by 2 desc, 1 desc;



-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (semana), ESTADO
-- 1: FECHA, 2: EVENTS
-- //////////////////////////////////////////////////////
select  date_trunc('day', c.fecha_hora_inicio) as "fecha",
		-- s.id as "s_id",
		sum(case when s.codigo = 'ESP' then 1 else 0 end) as "espera",
       	sum(case when s.codigo = 'CNF' then 1 else 0 end) as "confirmada",
       	sum(case when s.codigo = 'ATN' then 1 else 0 end) as "atendido",
       	sum(case when s.codigo = 'RPG' then 1 else 0 end) as "reprogramada",
       	sum(case when s.codigo = 'ANL' then 1 else 0 end) as "anulada",
       	sum(case when s.codigo = 'CNL' then 1 else 0 end) as "cancelada",
		-- s.nombre_estado,
		count(c.id) as "eventos"
from img_cita c
	inner join img_ctl_estado_cita s
		on s.id = c.id_estado_cita 
where c.fecha_hora_inicio > now() - interval '12 months'
group by /*2,*/ 1
order by 1, 8 desc;



-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (semana), ESTADO, MODALIDAD, TEC
-- 1: FECHA, 2: EVENTS
-- //////////////////////////////////////////////////////
select  date_trunc('day', c.fecha_hora_inicio) as "fecha",
		sum(case when s.codigo = 'ESP' then 1 else 0 end) as "ESP",
       	sum(case when s.codigo = 'CNF' then 1 else 0 end) as "CNF",
       	sum(case when s.codigo = 'ATN' then 1 else 0 end) as "ATN",
       	sum(case when s.codigo = 'RPG' then 1 else 0 end) as "RPG",
       	sum(case when s.codigo = 'ANL' then 1 else 0 end) as "ANL",
       	sum(case when s.codigo = 'CNL' then 1 else 0 end) as "CNL",
		count(c.id) as "total"
from img_cita c
	inner join img_ctl_estado_cita s
		on s.id = c.id_estado_cita
	left join img_solicitud_estudio r
		on r.id = c.id_solicitud_estudio
	left join ctl_area_servicio_diagnostico a
		on a.id = r.id_area_servicio_diagnostico
	left join mnt_expediente e
		on e.id = r.id_expediente
	left join mnt_empleado m
		on m.id = c.id_tecnologo_programado
where a.id = 13
	-- c.fecha_hora_inicio > now() - interval '12 months'
	and c.fecha_hora_inicio >= '2015-12-14'::date and c.fecha_hora_fin <= '2015-12-26'::date
group by 1
order by 1, 8 desc;



-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (semana), ESTADO, MODALIDAD, TEC
-- 1: FECHA, 2: EVENTS
-- //////////////////////////////////////////////////////
select  date_trunc('day', c.fecha_hora_inicio) as fecha,
		sum(case when s.codigo = 'ESP' then 1 else 0 end) as ESP,
       	sum(case when s.codigo = 'CNF' then 1 else 0 end) as CNF,
       	sum(case when s.codigo = 'ATN' then 1 else 0 end) as ATN,
       	sum(case when s.codigo = 'RPG' then 1 else 0 end) as RPG,
       	sum(case when s.codigo = 'ANL' then 1 else 0 end) as ANL,
       	sum(case when s.codigo = 'CNL' then 1 else 0 end) as CNL,
		count(c.id) as "total"
from img_cita c
	inner join img_ctl_estado_cita s
		on s.id = c.id_estado_cita
	left join img_solicitud_estudio r
		on r.id = c.id_solicitud_estudio
	left join ctl_area_servicio_diagnostico a
		on a.id = r.id_area_servicio_diagnostico
	left join mnt_expediente e
		on e.id = r.id_expediente
	left join mnt_empleado m
		on m.id = c.id_tecnologo_programado
where a.id = 18
	-- c.fecha_hora_inicio > now() - interval '12 months'
	and c.fecha_hora_inicio >= '2015-12-14'::date and c.fecha_hora_fin <= '2015-12-26'::date
group by 1
order by 1, 8 desc;



-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (semana), ESTADO, MODALIDAD, TEC
-- 1: FECHA, 2: EVENTS
-- //////////////////////////////////////////////////////
select  date_trunc('day', c.fecha_hora_inicio) as fecha,
		sum(case when s.codigo = 'ESP' then 1 else 0 end) as ESP,
       	sum(case when s.codigo = 'CNF' then 1 else 0 end) as CNF,
       	sum(case when s.codigo = 'ATN' then 1 else 0 end) as ATN,
       	sum(case when s.codigo = 'RPG' then 1 else 0 end) as RPG,
       	sum(case when s.codigo = 'CNL' or s.codigo = 'ANL' then 1 else 0 end) as CNL,
		count(c.id) as total
from img_cita c
	inner join img_ctl_estado_cita s
		on s.id = c.id_estado_cita
	left join img_solicitud_estudio r
		on r.id = c.id_solicitud_estudio
	left join ctl_area_servicio_diagnostico a
		on a.id = r.id_area_servicio_diagnostico
	left join mnt_expediente e
		on e.id = r.id_expediente
	left join mnt_empleado m
		on m.id = c.id_tecnologo_programado
where a.id = 18
	and c.fecha_hora_inicio >= '2015-12-14'::date and c.fecha_hora_fin <= '2015-12-26'::date
group by 1
order by 1, 7 desc;




-- //////////////////////////////////////////////////////
-- EVENTOS POR FECHA (semana), ESTADO, MODALIDAD, TEC, LOCALE
-- 1: FECHA, 2: EVENTS
-- //////////////////////////////////////////////////////
select  date_trunc('day', c.fecha_hora_inicio) as fecha,
    sum(case when s.codigo = 'ESP' then 1 else 0 end) as ESP,
    sum(case when s.codigo = 'CNF' then 1 else 0 end) as CNF,
    sum(case when s.codigo = 'ATN' then 1 else 0 end) as ATN,
    sum(case when s.codigo = 'RPG' then 1 else 0 end) as RPG,
    sum(case when s.codigo = 'CNL' or s.codigo = 'ANL' then 1 else 0 end) as CNL,
    count(c.id) as total
from img_cita c
    inner join img_ctl_estado_cita s
        on s.id = c.id_estado_cita
    left join img_solicitud_estudio r
        on r.id = c.id_solicitud_estudio
    left join ctl_area_servicio_diagnostico a
        on a.id = r.id_area_servicio_diagnostico
    left join mnt_expediente e
        on e.id = r.id_expediente
    left join mnt_empleado m
        on m.id = c.id_tecnologo_programado
where c.id_establecimiento = 30
    and a.id = 13
    and c.fecha_hora_inicio >= '2015-12-14'::date and c.fecha_hora_fin <= '2015-12-26'::date
group by 1
order by 1, 7 desc;