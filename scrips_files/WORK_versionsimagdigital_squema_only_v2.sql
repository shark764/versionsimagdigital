--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: accum(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION accum() RETURNS text[]
    LANGUAGE plpgsql
    AS $$declare s text[] = '{}';
	r record; 

	begin 
	for r in select * from img_ctl_estado_diagnostico
		loop 
			s := s || array[[r.id::text, r.nombre_estado]]; 
		end loop; 
	return s; 
	end;
$$;


ALTER FUNCTION public.accum() OWNER TO simagd;

--
-- Name: distribucion(integer, character varying, character varying, integer, integer, integer, integer, timestamp without time zone); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION distribucion(distribucion integer, rango_anterior character varying, rango_nuevo character varying, cant_primera_vez integer, cant_subsecuente integer, consultorio integer, usuario_mod integer, fecha_mod timestamp without time zone) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	rango_hora_nuevo integer;
	rango_hora_anterior integer;
	empleado integer;
	mes_ingresar integer;
	yrs_ingresar integer;
	dia_ingresar integer;
	especialidad integer;
	contador integer;
BEGIN
  
  --INICIO DE LA TRANSACCION
  --Buscando los Horarios
   BEGIN
   SELECT id into rango_hora_nuevo FROM mnt_rangohora WHERE concat(cast(hora_ini as text),'-',cast(hora_fin as text))=rango_nuevo;
   SELECT id into rango_hora_anterior FROM mnt_rangohora WHERE concat(cast(hora_ini as text),'-',cast(hora_fin as text))=rango_anterior;
   EXCEPTION
     WHEN OTHERS THEN
       RAISE EXCEPTION 'Falló la orden SQL, el error fue: %',SQLERRM;
       --RETURN 'El registro no pudo ser insertado';
   END;
   --Actualizando tabla Distribucion
   UPDATE cit_distribucion
   SET primera=cant_primera_vez,subsecuente=cant_subsecuente, id_consultorio=consultorio,idusuariomod=usuario_mod,
   FechaHoraMod=fecha_mod,id_rangohora=rango_hora_nuevo
   WHERE id=distribucion ;
      
   --Comprobamos cambio de HORARIO
   IF rango_hora_nuevo<>rango_hora_anterior THEN
	--Sacando mes,dia,yr de distribucion
	SELECT id_empleado, mes, yrs, dia, id_aten_area_mod_estab INTO empleado,mes_ingresar,yrs_ingresar,dia_ingresar,especialidad FROM cit_distribucion
	WHERE id=distribucion;
  
	   SELECT count(cit_citas_dia.id) INTO contador FROM cit_citas_dia
	   WHERE DATE_PART('month',cit_citas_dia.fecha)=mes_ingresar AND DATE_PART('dow',cast(cit_citas_dia.fecha as timestamp))+1=dia_ingresar AND 
           DATE_PART('year',cit_citas_dia.fecha)=yrs_ingresar AND cit_citas_dia.id_empleado=empleado
           AND cit_citas_dia.id_aten_area_mod_estab=especialidad;
          
           IF contador > 0 THEN
               --Actualizo tabla cit_citas_dia con nuevo id_rangohora
               UPDATE cit_citas_dia
               SET id_rangohora=rango_hora_nuevo
               WHERE DATE_PART('month',cit_citas_dia.fecha)=mes_ingresar AND DATE_PART('dow',cast(cit_citas_dia.fecha as timestamp))+1=dia_ingresar 
               AND DATE_PART('year',cit_citas_dia.fecha)=yrs_ingresar AND cit_citas_dia.id_empleado=empleado
               AND cit_citas_dia.id_aten_area_mod_estab=especialidad;
           END IF;
   END IF;
   RETURN 'El registro fue insertado con éxito';
END;
$$;


ALTER FUNCTION public.distribucion(distribucion integer, rango_anterior character varying, rango_nuevo character varying, cant_primera_vez integer, cant_subsecuente integer, consultorio integer, usuario_mod integer, fecha_mod timestamp without time zone) OWNER TO simagd;

--
-- Name: distribucion(integer, character varying, character varying, integer, integer, integer, integer, timestamp without time zone, integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION distribucion(distribucion integer, rango_anterior character varying, rango_nuevo character varying, cant_primera_vez integer, cant_subsecuente integer, consultorio integer, usuario_mod integer, fecha_mod timestamp without time zone, max_agregadas integer) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
    rango_hora_nuevo integer;
    rango_hora_anterior integer;
    empleado integer;
    mes_ingresar integer;
    yrs_ingresar integer;
    dia_ingresar integer;
    especialidad integer;
    contador integer;
BEGIN
 
  --INICIO DE LA TRANSACCION
  --Buscando los Horarios
   BEGIN
   SELECT id into rango_hora_nuevo FROM mnt_rangohora WHERE concat(cast(hora_ini as text),'-',cast(hora_fin as text))=rango_nuevo;
   SELECT id into rango_hora_anterior FROM mnt_rangohora WHERE concat(cast(hora_ini as text),'-',cast(hora_fin as text))=rango_anterior;
   EXCEPTION
     WHEN OTHERS THEN
       RAISE EXCEPTION 'Falló la orden SQL, el error fue: %',SQLERRM;
       --RETURN 'El registro no pudo ser insertado';
   END;
   --Actualizando tabla Distribucion
   UPDATE cit_distribucion
   SET primera=cant_primera_vez,subsecuente=cant_subsecuente, id_consultorio=consultorio,idusuariomod=usuario_mod,
   FechaHoraMod=fecha_mod,id_rangohora=rango_hora_nuevo,max_citas_agregadas=max_agregadas
   WHERE id=distribucion ;
     
   --Comprobamos cambio de HORARIO
   IF rango_hora_nuevo<>rango_hora_anterior THEN
    --Sacando mes,dia,yr de distribucion
    SELECT id_empleado, mes, yrs, dia, id_aten_area_mod_estab INTO empleado,mes_ingresar,yrs_ingresar,dia_ingresar,especialidad FROM cit_distribucion
    WHERE id=distribucion;
 
       SELECT count(cit_citas_dia.id) INTO contador FROM cit_citas_dia
       WHERE DATE_PART('month',cit_citas_dia.fecha)=mes_ingresar AND DATE_PART('dow',cast(cit_citas_dia.fecha as timestamp))+1=dia_ingresar AND
           DATE_PART('year',cit_citas_dia.fecha)=yrs_ingresar AND cit_citas_dia.id_empleado=empleado
           AND cit_citas_dia.id_aten_area_mod_estab=especialidad;
         
           IF contador > 0 THEN
               --Actualizo tabla cit_citas_dia con nuevo id_rangohora
               UPDATE cit_citas_dia
               SET id_rangohora=rango_hora_nuevo
               WHERE DATE_PART('month',cit_citas_dia.fecha)=mes_ingresar AND DATE_PART('dow',cast(cit_citas_dia.fecha as timestamp))+1=dia_ingresar
               AND DATE_PART('year',cit_citas_dia.fecha)=yrs_ingresar AND cit_citas_dia.id_empleado=empleado
               AND cit_citas_dia.id_aten_area_mod_estab=especialidad;
           END IF;
   END IF;
   RETURN 'El registro fue insertado con éxito';
END;
$$;


ALTER FUNCTION public.distribucion(distribucion integer, rango_anterior character varying, rango_nuevo character varying, cant_primera_vez integer, cant_subsecuente integer, consultorio integer, usuario_mod integer, fecha_mod timestamp without time zone, max_agregadas integer) OWNER TO simagd;

--
-- Name: drop_tables(character varying); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION drop_tables(username character varying) RETURNS void
    LANGUAGE plpgsql
    AS $$
DECLARE
    statements CURSOR FOR
        SELECT tablename FROM pg_tables
        WHERE tableowner = username AND schemaname = 'public';
BEGIN
    FOR stmt IN statements LOOP
        EXECUTE 'DROP TABLE IF EXISTS ' || quote_ident(stmt.tablename) || ' CASCADE;';
        EXECUTE 'DROP SEQUENCE IF EXISTS ' || quote_ident(stmt.tablename) || ' CASCADE;';
    END LOOP;
END;
$$;


ALTER FUNCTION public.drop_tables(username character varying) OWNER TO simagd;

--
-- Name: fn_actualiza_establecimiento_mntatenareamodestab(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_actualiza_establecimiento_mntatenareamodestab() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
        id_establecimiento_configurado	integer;
BEGIN
	SELECT id INTO id_establecimiento_configurado
	FROM ctl_establecimiento
	WHERE configurado=true;       

	UPDATE mnt_aten_area_mod_estab 
	SET id_establecimiento=id_establecimiento_configurado
	WHERE id=NEW.id;  

	RETURN NULL;      
       
END;
$$;


ALTER FUNCTION public.fn_actualiza_establecimiento_mntatenareamodestab() OWNER TO simagd;

--
-- Name: FUNCTION fn_actualiza_establecimiento_mntatenareamodestab(); Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON FUNCTION fn_actualiza_establecimiento_mntatenareamodestab() IS 'Actualiza el establecimiento configurado para la tabla mnt_aten_area_mod_estab';


--
-- Name: fn_calcular_edad(bigint, text); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_calcular_edad(bigint, text) RETURNS text
    LANGUAGE plpgsql STABLE
    AS $_$
DECLARE
 paciente ALIAS FOR $1;
 completo ALIAS FOR $2;
 cadena_edad text;
 posicion_anio integer;
 posicion_meses integer;
 posicion_mes integer;
 posicion_dias integer;
 posicion_dia integer;
 
begin
	select age(current_date,fecha_nacimiento) into cadena_edad from mnt_paciente where id=paciente;
	
	  IF cadena_edad ~ 'years' OR cadena_edad ~ 'year' THEN
	    cadena_edad:=regexp_replace(cadena_edad, 'years', 'años');
	    cadena_edad:=regexp_replace(cadena_edad, 'year', 'año');
	    IF completo!='completa' THEN 
		    select position('años' in cadena_edad) into posicion_anio;
		    posicion_anio:=posicion_anio+4;
		    select substring(cadena_edad from 1 for posicion_anio) into cadena_edad;
		    return cadena_edad;
	    END IF;
	  END IF;
	  select position('mons' in cadena_edad) into posicion_meses;
	  IF posicion_meses>0 THEN
		cadena_edad:=regexp_replace(cadena_edad, 'mons', 'meses');
		IF completo!='completa' THEN 
		    posicion_meses:=posicion_meses+5;
		    select substring(cadena_edad from 1 for posicion_meses) into cadena_edad;
		    return cadena_edad;
		END IF;
	  ELSE 
		select position('mon' in cadena_edad) into posicion_mes;
		IF posicion_mes>0 THEN
		     cadena_edad:=regexp_replace(cadena_edad, 'mon', 'mes');
		     IF completo!='completa' THEN 
			posicion_mes:=posicion_mes+3;
			select substring(cadena_edad from 1 for posicion_mes) into cadena_edad;
			return cadena_edad;
		     END IF;
		END IF;
	  END IF;
	  select position('days' in cadena_edad) into posicion_dias;
	  IF posicion_dias>0 THEN
		cadena_edad:=regexp_replace(cadena_edad, 'days', 'días');
		IF completo!='completa' THEN 
		    posicion_dias:=posicion_dias+5;
		    select substring(cadena_edad from 1 for posicion_dias) into cadena_edad;
		    return cadena_edad;
		END IF;
	  ELSE 
		select position('day' in cadena_edad) into posicion_dia;
		IF posicion_dia>0 THEN
		     cadena_edad:=regexp_replace(cadena_edad, 'day', 'día');
		     IF completo!='completa' THEN 
			posicion_dia:=posicion_dia+3;
			select substring(cadena_edad from 1 for posicion_dia) into cadena_edad;
			return cadena_edad;
		     END IF;
		END IF;
	  END IF;

	  return cadena_edad;
      
end;
$_$;


ALTER FUNCTION public.fn_calcular_edad(bigint, text) OWNER TO simagd;

--
-- Name: fn_trg_actualizar_estado_solicitud_estudio(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_actualizar_estado_solicitud_estudio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare prc_insertado integer; --id del registro en la lista de trabajo
			status_sc integer;	--estado del registro de solicitud
		begin
			--Consultar si existe un registro en la lista de trabajo
			prc_insertado := new.id;
			
			--Consultar estado de registro de examen
			status_sc := (	select "id"
					from "img_ctl_estado_solicitud"
					where "codigo" = 'SCR'
				      );

			-- Remember who changed the payroll when
			new.id_estado_solicitud := status_sc;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_actualizar_estado_solicitud_estudio() OWNER TO simagd;

--
-- Name: fn_trg_actualizar_estado_solicitud_estudio_examen(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_actualizar_estado_solicitud_estudio_examen() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare pndR_insertado integer[] = '{}'; --id del registro en la lista de trabajo
			prz_insertado integer[] = '{}';	--id del registro de examen
			prz_estado integer;	--estado del registro de examen
			i integer; --contador
			status_sc_cod character(3);	--código del estado del registro de solicitud
			status_sc integer;	--estado del registro de solicitud
		begin
			--Evaluar estado de la cita
			case new.id_estado_procedimiento_realizado
				--estados: confirmado, atendido --> Insertar en lista de pendientes
				when 1, 2, 3, 4 then
					--Actualizar establecimiento en caso de haberse cambiado el referido
					update img_pendiente_realizacion
						set 	fecha_ingreso_lista = now()::timestamp(0)
					where "id_procedimiento_iniciado" = new.id;
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'PRZ';
				when 5 then
					--Existe registro de examen "Almacenado" y existe registro en lista de trabajo, eliminar
					delete 
					from img_pendiente_realizacion
					where "id_procedimiento_iniciado" = new.id;
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'EAP';
				when 6, 7, 8 then
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'SRZ';
				else
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'CIT';
			end case;
					
			--Consultar estado de registro de solicitud
			status_sc := (	select "id"
					from "img_ctl_estado_solicitud"
					where "codigo" = status_sc_cod
				      );
			
			--Actualizar estado de solicitud de estudio
			update "img_solicitud_estudio"
				set "id_estado_solicitud" = status_sc
			where "id" = new.id_solicitud_estudio;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_actualizar_estado_solicitud_estudio_examen() OWNER TO simagd;

--
-- Name: fn_trg_actualizar_inventario_material_utilizado(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_actualizar_inventario_material_utilizado() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare mtrLc_id 	integer;	-- id de registro de material en local
			std_rz 		integer;	-- Establecimiento donde se realizó el estudio
			rz_id 		integer;	-- id de registro de examen, basado en TG_OP
		begin
			--establecer caso de desencadenado
			if (TG_OP = 'DELETE') then
			    rz_id := old.id_procedimiento_realizado;
			else
			    rz_id := new.id_procedimiento_realizado;
			end if;
			
			--Consultar establecimiento donde se realiza estudio
			std_rz := ( select
					case
					    when "prz"."id_solicitud_estudio" is not null then
						"prc"."id_establecimiento_referido"
					    when "prz"."id_solicitud_estudio_complementario" is not null then
						"solcmpl"."id_establecimiento_solicitado"
					    when "prz"."id_cita_programada" is not null then
						"cit"."id_establecimiento"
					    when "prz"."id_user_reg" is not null then
						"usRg"."id_establecimiento"
					    else
						null
					end
				    from "img_procedimiento_realizado" "prz"
					left join "img_solicitud_estudio" "prc" on "prc"."id" = "prz"."id_solicitud_estudio"
					left join "img_solicitud_estudio_complementario" "solcmpl" on "solcmpl"."id" = "prz"."id_solicitud_estudio_complementario"
					left join "img_cita" "cit" on "cit"."id" = "prz"."id_cita_programada"
					left join "fos_user_user" "usRg" on "usRg"."id" = "prz"."id_user_reg"
				    where "prz"."id" = rz_id
				);
			
			--Aumentar cantidad en DELETE
			if (TG_OP = 'DELETE') then
			    --Actualizar cantidad en inventario
			    update "img_ctl_material_establecimiento"
				    set "cantidad_disponible" = coalesce("cantidad_disponible", 0) + coalesce(old.cantidad_utilizada, 0)
			    where "id_material" = old.id_material and "id_establecimiento" = std_rz;

			    return old;
			--Actualizar cantidad en UPDATE
			elsif (TG_OP = 'UPDATE') then
			    --Actualizar cantidad en inventario
			    update "img_ctl_material_establecimiento"
				    set "cantidad_disponible" = coalesce("cantidad_disponible", 0) + coalesce(old.cantidad_utilizada, 0) - coalesce(new.cantidad_utilizada, 0)
			    where "id_material" = new.id_material and "id_establecimiento" = std_rz;

			    return new;
			--Actualizar cantidad en INSERT
			elsif (TG_OP = 'INSERT') then
			    --Actualizar cantidad en inventario
			    update "img_ctl_material_establecimiento"
				    set "cantidad_disponible" = coalesce("cantidad_disponible", 0) - coalesce(new.cantidad_utilizada, 0)
			    where "id_material" = new.id_material and "id_establecimiento" = std_rz;

			    return new;
			end if;
			
			return null; -- result is ignored since this is an AFTER trigger
		end;
	$$;


ALTER FUNCTION public.fn_trg_actualizar_inventario_material_utilizado() OWNER TO simagd;

--
-- Name: fn_trg_anexar_pendiente_lectura_estudio(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_anexar_pendiente_lectura_estudio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare diag_insertado integer;		--id del registro de diagnóstico
			diag_estado integer; 		--estado del diagnóstico
			pndL_insertado integer[] = '{}';--id del registro en lista de lectura
			pndT_insertado integer;		--id del registro en lista de transcripción
			post_estudio boolean := false;	--representa si la solicitud fue post-estudio
			est_leidos integer[] = '{}';	--id del registro de estudios leidos
			lct_estado integer; 		-- estado de la lectura
			lct_estab integer; 		-- establecimiento en el que se da lectura
			envio_radiologo boolean := false; --representa si la solicitud fue por radiólogo
			radiologo_solicita integer;	--radiólogo que ingresa en lista
			est_principal integer;		--id del estudio principal
		begin
			--Obtener el id y estado del registro de diagnóstico, si existe
			select "lct"."id_establecimiento", "lct"."id_estado_lectura", "lct"."solicitada_por_radiologo",
				"lct"."id_radiologo_solicita", "lct"."id_estudio"
				into lct_estab, lct_estado, envio_radiologo, radiologo_solicita, est_principal
			from "img_lectura" as "lct"
			where "lct"."id" = new.id_lectura;
			
			if est_principal is null then
			    est_principal := new.id_estudio;
			end if;

			--Obtener el id del registro en lista de lectura, si existe
			pndL_insertado := array(select "pndL"."id"
						from "img_pendiente_lectura" as "pndL"
						where "pndL"."id_estudio" = est_principal
					);
			
			--Solicitud pre o post-estudio
			if ( exists ( select "id"
					from "img_solicitud_diagnostico"
						where "id_estudio" = est_principal ) ) or envio_radiologo is true then
				post_estudio := true;
			end if;
			
			if lct_estado <> 4 then
			    if ( array_length(pndL_insertado, 1) is not null ) then
				    --Actualizar lista de trabajo
				    update img_pendiente_lectura
					    set fecha_ingreso_lista = now()::timestamp(0),
						id_establecimiento = lct_estab,
						anexado_por_radiologo = envio_radiologo,
						id_radiologo_anexa = radiologo_solicita,
						solicitud_post_estudio = post_estudio
				    where ("id" = any(pndL_insertado::integer[]) and "id_estudio" = est_principal) or "id_estudio" = new.id_estudio;
			    else
				    --Ingresar a lista de pendientes del establecimiento diagnosticante
				    insert into img_pendiente_lectura
					    (	id_establecimiento,
						id_estudio,
						anexado_por_radiologo,
						id_radiologo_anexa,
						solicitud_post_estudio
					    )
					    values
					    (	lct_estab,
						est_principal,
						envio_radiologo,
						radiologo_solicita,
						post_estudio
					    );
			    end if;
			else
			    --Extraer de lista de Lectura (Se ha confirmado como leido)
			    delete from img_pendiente_lectura
			    where ("id" = any(pndL_insertado::integer[]) and "id_estudio" = est_principal) or "id_estudio" = new.id_estudio;
			end if;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_anexar_pendiente_lectura_estudio() OWNER TO simagd;

--
-- Name: fn_trg_extraer_pendiente_lectura_estudio(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_extraer_pendiente_lectura_estudio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare diag_insertado integer;		--id del registro de diagnóstico
			diag_estado integer; 		--estado del diagnóstico
			pndL_insertado integer;		--id del registro en lista de lectura
			pndT_insertado integer;		--id del registro en lista de transcripción
			post_estudio boolean := false;	--representa si la solicitud fue post-estudio
			est_leidos integer[] = '{}';	--id del registro de estudios leidos
			lct_estado integer; 		-- estado de la lectura
			lct_estab integer; 		-- establecimiento en el que se da lectura
			envio_radiologo boolean := false; --representa si la solicitud fue por radiólogo
			radiologo_solicita integer;	--radiólogo que ingresa en lista
		begin
			--Obtener el id y estado del registro de diagnóstico, si existe
			select "lct"."id_establecimiento", "lct"."id_estado_lectura", "lct"."solicitada_por_radiologo", "lct"."id_radiologo_solicita"
				into lct_estab, lct_estado, envio_radiologo, radiologo_solicita
			from "img_lectura" as "lct"
			where "lct"."id" = old.id_lectura;

			--Obtener el id del registro en lista de lectura, si existe
			pndL_insertado := (	select "pndL"."id"
						from "img_pendiente_lectura" as "pndL"
						where "pndL"."id_estudio" = old.id_estudio
					);
			
			--Solicitud pre o post-estudio
			if ( exists ( select "id"
					from "img_solicitud_diagnostico"
						where "id_estudio" = old.id_estudio ) ) or envio_radiologo is true then
				post_estudio := true;
			end if;
			
			--condicionar si debe volver a lista de pendientes
			if ( exists ( select "id"
					from "img_solicitud_diagnostico"
						where "id_estudio" = old.id_estudio ) ) or
			    ( exists ( select "prc"."id"
					from "img_solicitud_estudio" as "prc"
					inner join "img_procedimiento_realizado" as "prz" on ("prc"."id" = "prz"."id_solicitud_estudio")
					inner join "img_estudio_paciente" as "est" on ("prz"."id" = "est"."id_procedimiento_realizado")
						where "est"."id" = old.id_estudio and "prc"."requiere_diagnostico" is true ) ) or
				envio_radiologo is true then
						
			    if ( pndL_insertado is not null ) then
				    --Actualizar lista de trabajo
				    update img_pendiente_lectura
					    set fecha_ingreso_lista = now()::timestamp(0),
						id_establecimiento = lct_estab,
						anexado_por_radiologo = envio_radiologo,
						id_radiologo_anexa = radiologo_solicita,
						solicitud_post_estudio = post_estudio
				    where "id" = pndL_insertado and "id_estudio" = old.id_estudio;
			    else
				    --Ingresar a lista de pendientes del establecimiento diagnosticante
				    insert into img_pendiente_lectura
					    (	id_establecimiento,
						id_estudio,
						anexado_por_radiologo,
						id_radiologo_anexa,
						solicitud_post_estudio
					    )
					    values
					    (	lct_estab,
						old.id_estudio,
						envio_radiologo,
						radiologo_solicita,
						post_estudio
					    );
			    end if;
			else
			    --Extraer de lista de Lectura (no se ha solicitado lectura)
			    delete from img_pendiente_lectura
			    where "id" = pndL_insertado and "id_estudio" = old.id_estudio;
			end if;
			
			return old;
		end;
	$$;


ALTER FUNCTION public.fn_trg_extraer_pendiente_lectura_estudio() OWNER TO simagd;

--
-- Name: fn_trg_generar_numero_expediente_ficticio(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_generar_numero_expediente_ficticio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare exp_max_num	integer;	-- número de expediente máximo dentro de parámetros
			new_number	integer;	-- número de expediente siguiente
			new_text_num	varchar(12);	-- número de expediente máximo dentro de parámetros
		begin
			if new.numero is null then
			    exp_max_num := (
					      select max(cast((string_to_array("numero", '-'))[2] as numeric)) as max_number_exp
					      from "img_expediente_ficticio"
					      where "numero" like concat('%-', substring(to_char(now(), 'yyyy') from 3)) and "id_establecimiento" = new.id_establecimiento
			    );
			    
			    --Aumentar cantidad en numero
			    if exp_max_num is not null then
				new_number := coalesce(exp_max_num, 0) + 1;
			    else
				new_number := 0;
			    end if;
			    
			    if length(new_number::text) < 4 then
				new_text_num := lpad(new_number::text, 4, '0');
			    else
				new_text_num := new_number::text;
			    end if;

			    -- new number
			    new.numero := concat('NI-', new_text_num, '-', substring(to_char(now(), 'yyyy') from 3));
			end if;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_generar_numero_expediente_ficticio() OWNER TO simagd;

--
-- Name: fn_trg_ingresar_pendiente_lectura_estudio(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_ingresar_pendiente_lectura_estudio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare prc_insertado integer; --preinscripción del estudio
			req_diagnostico boolean;  --solicitud de diagnóstico en la preinscripción
			id_diagnosticante integer; --establecimiento al que se pidio diagnóstico
			prz_insertado integer;	--id del registro de examen
			prz_estado integer;	--estado del registro de examen
			pndL_insertado integer;		--id del registro en lista de lectura
			complementario boolean := false;	--estudio es complementario
			solcmpl_insertado integer;	--id del registro de solicitud de complementario
			radiologo_solicita integer;	--id del radiologo de solicitud de complementario
			stdcmpl_solicitado integer;	--id del establecimiento de solicitud de complementario
		begin
			--Asignar id de registro de examen
			prz_insertado := new.id_procedimiento_realizado;

			--Consultar si estudio es complementario
			complementario := ( select case when "id_solicitud_estudio_complementario" is not null
					      then TRUE else FALSE end
					    from "img_procedimiento_realizado"
					    where "id" = prz_insertado
					);

			--Consultar estado de registro de examen
			prz_estado := (	select "id_estado_procedimiento_realizado"
					from "img_procedimiento_realizado"
					where "id" = prz_insertado
					);

			--Obtener el id del registro en lista de lectura, si existe
			pndL_insertado := (	select "pndL"."id"
						from "img_pendiente_lectura" as "pndL"
						where "pndL"."id_estudio" = new.id
					);
					
			--Si es complementario, no proviene de solicitud de médico
			if complementario is false then

			    --Consultar si la preinscripción se marcó para diagnóstico y el establecimiento solicitado
			    select "prc"."id", "prc"."requiere_diagnostico", "prc"."id_establecimiento_diagnosticante"
				    into prc_insertado, req_diagnostico, id_diagnosticante
			    from "img_procedimiento_realizado" as "prz"
				    inner join "img_solicitud_estudio" as "prc"
					    on ("prc"."id" = "prz"."id_solicitud_estudio")
			    where "prz"."id" = prz_insertado;

			    --Existe registro de examen "Almacenado" y existe registro en lista de trabajo, eliminar
			    if ( prz_estado = 5 ) then
				    delete 
				    from img_pendiente_realizacion
				    where "id_solicitud_estudio" = prc_insertado or "id_procedimiento_iniciado" = prz_insertado;
			    end if;
						    
			    --Se solicitó diagnóstico
			    if ( req_diagnostico is true ) and ( prz_estado = 5 ) then
				    if ( pndL_insertado is not null ) then
					    --Actualizar lista de trabajo
					    update img_pendiente_lectura
						    set 	fecha_ingreso_lista = now()::timestamp(0)
					    where "id" = pndL_insertado and "id_estudio" = new.id;
				    else
					    --Ingresar a lista de pendientes del establecimiento diagnosticante
					    insert into img_pendiente_lectura 
						    (	id_establecimiento, 					
							id_estudio
						    )
						    values	
						    (	id_diagnosticante, 
							new.id
						    );
				    end if;
			    end if;
			else
			    --Proviene de una solicitud de complementario, se añade a lista automáticamente

			    --Consultar estado de registro de examen
			    select "solcmpl"."id", "solcmpl"."id_radiologo_solicita", "solcmpl"."id_establecimiento_solicitado"
				    into solcmpl_insertado, radiologo_solicita, stdcmpl_solicitado
			    from "img_procedimiento_realizado" as "prz"
				inner join "img_solicitud_estudio_complementario" as "solcmpl"
					on ("solcmpl"."id" = "prz"."id_solicitud_estudio_complementario")
			    where "prz"."id" = prz_insertado;

			    --Existe registro de examen "Almacenado" y existe registro en lista de trabajo, eliminar
			    if ( prz_estado = 5 ) then
				    delete 
				    from img_pendiente_realizacion
				    where "id_solicitud_estudio_complementario" = solcmpl_insertado or "id_procedimiento_iniciado" = prz_insertado;
			    end if;
						    
			    --Se solicitó complementario
			    if ( solcmpl_insertado is not null ) and ( prz_estado = 5 ) then
				    if ( pndL_insertado is not null ) then
					    --Actualizar lista de trabajo
					    update img_pendiente_lectura
						    set fecha_ingreso_lista = now()::timestamp(0),
							anexado_por_radiologo = true,
							id_radiologo_anexa = radiologo_solicita
					    where "id" = pndL_insertado and "id_estudio" = new.id;
				    else
					    --Ingresar a lista de pendientes del establecimiento diagnosticante
					    insert into img_pendiente_lectura 
						    (	id_establecimiento, 					
							id_estudio,
							anexado_por_radiologo,
							id_radiologo_anexa
						    )
						    values	
						    (	stdcmpl_solicitado, 
							new.id,
							true,
							radiologo_solicita
						    );
				    end if;
			    end if;
			    
			end if;

		return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_ingresar_pendiente_lectura_estudio() OWNER TO simagd;

--
-- Name: fn_trg_ingresar_pendiente_lectura_solicitud_diagnostico(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_ingresar_pendiente_lectura_solicitud_diagnostico() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare lct_insertado integer;		--id del registro de lectura
			lct_estado integer; 		--estado del lectura
			pndL_insertado integer[] = '{}';--id del registro en lista de lectura
			pndR_insertado integer;		--id del registro en lista de tecnólogo
			prz_estado integer;	--estado del registro de examen
			est_realizados integer[] = '{}';--id del registro de estudios realizados
			i integer; --contador
		begin
			--Consultar estudios realizados
			est_realizados := array(select "est"."id"
						from "img_estudio_paciente" as "est"
						inner join "img_procedimiento_realizado" as "prz"
							on "prz"."id" = "est"."id_procedimiento_realizado"
						where "prz"."id_solicitud_estudio" = new.id_solicitud_estudio
						
						union
						
						select "est"."id"
						from "img_estudio_paciente" as "est"
						inner join "img_procedimiento_realizado" as "prz"
							on "prz"."id" = "est"."id_procedimiento_realizado"
						inner join "img_solicitud_estudio_complementario" as "solcmpl"
							on "solcmpl"."id" = "prz"."id_solicitud_estudio_complementario"
						where "solcmpl"."id_solicitud_estudio" = new.id_solicitud_estudio
					);

			--Obtener el id del registro en lista de lectura, si existe
			pndL_insertado := array(select "pndL"."id"
						from "img_pendiente_lectura" as "pndL"
						where "pndL"."id_estudio" = any(est_realizados::integer[])
					);
					
			if array_length(pndL_insertado, 1) is not null then
			    --Actualizar lista de trabajo
			    update img_pendiente_lectura
				set 	id_establecimiento = new.id_establecimiento_solicitado,
					fecha_ingreso_lista = now()::timestamp(0),
					solicitud_post_estudio = true
			    where "id" = any(pndL_insertado::integer[]);
			else
			    foreach i in array est_realizados
				loop
				    --Ingresar a lista de pendientes del establecimiento diagnosticante
				    insert into img_pendiente_lectura 
					    (	id_establecimiento, 
						id_estudio,
						solicitud_post_estudio
					    )
					    values	
					    (	new.id_establecimiento_solicitado,
						i,
						true
					    );
				end loop;
			end if;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_ingresar_pendiente_lectura_solicitud_diagnostico() OWNER TO simagd;

--
-- Name: fn_trg_ingresar_pendiente_realizacion_cita(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_ingresar_pendiente_realizacion_cita() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare pndR_insertado integer[] = '{}'; --id del registro en la lista de trabajo
			prz_insertado integer[] = '{}';	--id del registro de examen
			prz_estado integer;	--estado del registro de examen
			i integer; --contador
			
			status_sc_cod character(3);	--código del estado del registro de solicitud
			status_sc integer;		--estado del registro de solicitud
			prc_insertado integer; 		--id de la solicitud
		begin
			--Consultar si existe un registro en la lista de trabajo
			pndR_insertado := array(select "id"
						from "img_pendiente_realizacion"
						where "id_cita_programada" = new.id
					);
			--Consultar si existe un registro de examen
			prz_insertado := array(	select "id"
						from "img_procedimiento_realizado"
						where "id_cita_programada" = new.id
					);

			--Evaluar estado de la cita
			case new.id_estado_cita
				--estados: confirmado, atendido --> Insertar en lista de pendientes
				when 2, 3 then
					--Existe registro de examen no "Almacenado", o no existe registro
					if array_length(prz_insertado, 1) is null then
					    --No hay registro en la lista, insertar
					    if array_length(pndR_insertado, 1) is null then
						    insert into img_pendiente_realizacion
							    (	id_establecimiento,
								id_solicitud_estudio,
								id_cita_programada
							    )
							    values
							    (	new.id_establecimiento,
								new.id_solicitud_estudio,
								new.id
							    );
					    --Existe un registro, actualizar fecha y establecimiento
					    else
						    --Actualizar establecimiento en caso de haberse cambiado el referido
						    update img_pendiente_realizacion
							    set fecha_ingreso_lista = now()::timestamp(0),
								id_establecimiento = new.id_establecimiento
						    where "id" = any(pndR_insertado::integer[]);
					    end if;
					else
					    foreach i in array prz_insertado
						loop
						    --Consultar estado de registro de examen
						    prz_estado := (	select "id_estado_procedimiento_realizado"
									from "img_procedimiento_realizado"
									where "id" = i
								    );
						    if prz_estado <> 5 then
							--No hay registro en la lista, insertar
							if array_length(pndR_insertado, 1) is null then
								insert into img_pendiente_realizacion
									(	id_establecimiento,
										id_solicitud_estudio,
										id_cita_programada,
										id_procedimiento_iniciado
									)
									values
									(	new.id_establecimiento,
										new.id_solicitud_estudio,
										new.id,
										i
									);
							--Existe un registro, actualizar fecha y establecimiento
							else
								--Actualizar establecimiento en caso de haberse cambiado el referido
								update img_pendiente_realizacion
									set 	fecha_ingreso_lista = now()::timestamp(0),
										id_establecimiento = new.id_establecimiento
								where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" = i;
							end if;
						    else
							--Existe registro de examen "Almacenado" y existe registro en lista de trabajo, eliminar
							delete 
							from img_pendiente_realizacion
							where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" = i;
						    end if;
						end loop;
					    -- No iniciados, existiendo exámenes
					    update img_pendiente_realizacion
						    set fecha_ingreso_lista = now()::timestamp(0),
							id_establecimiento = new.id_establecimiento
					    where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" is null;
					end if;
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'CCN';
				else
					--Cita No confirmada --> Extraer de lista de pendientes por realizar
					delete 
					from img_pendiente_realizacion
					where "id" = any(pndR_insertado::integer[]);
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'CIT';
					
					if new.id_estado_cita = 4 then
						--asignar código de estado de registro de solicitud
						status_sc_cod := 'CRP';
					elsif new.id_estado_cita in (5, 6) then
						--asignar código de estado de registro de solicitud
						status_sc_cod := 'CCL';
					end if;
					
					--reprogramada
					if (TG_OP = 'UPDATE') then
						if (new.reprogramada is true) and (old.reprogramada is false) then
							--asignar código de estado de registro de solicitud
							status_sc_cod := 'CRP';
						end if;
					end if;
			end case;
					
			--Consultar estado de registro de solicitud
			status_sc := (	select "id"
					from "img_ctl_estado_solicitud"
					where "codigo" = status_sc_cod
				      );
			
			--Actualizar estado de solicitud de estudio
			update "img_solicitud_estudio"
				set "id_estado_solicitud" = status_sc
			where "id" = new.id_solicitud_estudio;

		return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_ingresar_pendiente_realizacion_cita() OWNER TO simagd;

--
-- Name: fn_trg_ingresar_pendiente_realizacion_estudio_complementario(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_ingresar_pendiente_realizacion_estudio_complementario() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare pndR_insertado integer[] = '{}'; --id del registro en la lista de trabajo
			prz_insertado integer[] = '{}';	--id del registro de examen
			prz_estado integer;	--estado del registro de examen
			i integer; --contador
		begin
			--Consultar si existe un registro en la lista de trabajo
			pndR_insertado := array(select "id"
						from "img_pendiente_realizacion"
						where "id_solicitud_estudio_complementario" = new.id
					);
			--Consultar si existe un registro de examen
			prz_insertado := array(	select "id"
						from "img_procedimiento_realizado"
						where "id_solicitud_estudio_complementario" = new.id
					);
					
			-- Registros en lista no iniciados
			if array_length(prz_insertado, 1) is null then
			    --No existe un registro en la lista de trabajo, insertar nuevo
			    if array_length(pndR_insertado, 1) is null then
				    insert into img_pendiente_realizacion
					    (	id_establecimiento,
						id_solicitud_estudio,
						id_solicitud_estudio_complementario
					    )
					    values
					    (	new.id_establecimiento_solicitado,
						new.id_solicitud_estudio,
						new.id
					    );
			    --Existe un registro, actualizar fecha y establecimiento
			    else
				    --Actualizar establecimiento en caso de haberse cambiado el referido
				    update img_pendiente_realizacion
					    set fecha_ingreso_lista = now()::timestamp(0),
						id_solicitud_estudio = new.id_solicitud_estudio,
						id_establecimiento = new.id_establecimiento_solicitado
				    where "id" = any(pndR_insertado::integer[]);
			    end if;
			else
			    -- Registros ya iniciados, cuando existen iniciados
			    foreach i in array prz_insertado
				loop
				    --Consultar estado de registro de examen
				    prz_estado := (	select "id_estado_procedimiento_realizado"
							from "img_procedimiento_realizado"
							where "id" = i
						    );
						    
				    --Existe registro de examen no "Almacenado", o no existe registro
				    if prz_estado <> 5 then
					    --No existe un registro en la lista de trabajo, insertar nuevo
					    if array_length(pndR_insertado, 1) is null then
						    insert into img_pendiente_realizacion
							    (	id_establecimiento,
								id_solicitud_estudio,
								id_solicitud_estudio_complementario,
								id_procedimiento_iniciado
							    )
							    values
							    (	new.id_establecimiento_solicitado,
								new.id_solicitud_estudio,
								new.id,
								i
							    );
					    --Existe un registro, actualizar fecha y establecimiento
					    else
						    --Actualizar establecimiento en caso de haberse cambiado el referido
						    update img_pendiente_realizacion
							    set fecha_ingreso_lista = now()::timestamp(0),
								id_solicitud_estudio = new.id_solicitud_estudio,
								id_establecimiento = new.id_establecimiento_solicitado
						    where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" = i;
					    end if;
				    else
					    --Existe registro de examen "Almacenado" y existe registro en lista de trabajo, eliminar
					    delete 
					    from img_pendiente_realizacion
					    where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" = i;
				    end if;
				end loop;
			    -- Registros no iniciados, cuando existen iniciados
			    --Actualizar establecimiento en caso de haberse cambiado el referido
			    update img_pendiente_realizacion
				    set fecha_ingreso_lista = now()::timestamp(0),
					id_solicitud_estudio = new.id_solicitud_estudio,
					id_establecimiento = new.id_establecimiento_solicitado
			    where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" is null;
			end if;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_ingresar_pendiente_realizacion_estudio_complementario() OWNER TO simagd;

--
-- Name: fn_trg_ingresar_pendiente_realizacion_solicitud_estudio(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_ingresar_pendiente_realizacion_solicitud_estudio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare pndR_insertado integer[] = '{}'; --id del registro en la lista de trabajo
			prz_insertado integer[] = '{}';	--id del registro de examen
			prz_estado integer;	--estado del registro de examen
			i integer; --contador
		begin
			--Consultar si existe un registro en la lista de trabajo
			pndR_insertado := array(select "id"
						from "img_pendiente_realizacion"
						where "id_solicitud_estudio" = new.id
					);
			--Consultar si existe un registro de examen
			prz_insertado := array(	select "id"
						from "img_procedimiento_realizado"
						where "id_solicitud_estudio" = new.id
					);
					
			-- Registros en lista no iniciados
			if array_length(prz_insertado, 1) is null then
			    --Verificando si la preinscripción se desmarcó para citación
			    if new.requiere_cita is false then
				--No existe un registro en la lista de trabajo, insertar nuevo
				if array_length(pndR_insertado, 1) is null then
					insert into img_pendiente_realizacion
						(	id_establecimiento,
							id_solicitud_estudio
						)
						values
						(	new.id_establecimiento_referido,
							new.id
						);
				--Existe un registro, actualizar fecha y establecimiento
				else
					--Actualizar establecimiento en caso de haberse cambiado el referido
					update img_pendiente_realizacion
						set 	fecha_ingreso_lista = now()::timestamp(0),
							id_establecimiento = new.id_establecimiento_referido
					where "id" = any(pndR_insertado::integer[]);
				end if;
			    end if;
			else
			    -- Registros ya iniciados, cuando existen iniciados
			    foreach i in array prz_insertado
				loop
				    --Consultar estado de registro de examen
				    prz_estado := (	select "id_estado_procedimiento_realizado"
							from "img_procedimiento_realizado"
							where "id" = i
						    );
						    
				    --Existe registro de examen no "Almacenado", o no existe registro
				    if prz_estado <> 5 then
					if new.requiere_cita is false then
					    --No existe un registro en la lista de trabajo, insertar nuevo
					    if array_length(pndR_insertado, 1) is null then
						    insert into img_pendiente_realizacion
							    (	id_establecimiento,
								id_solicitud_estudio,
								id_procedimiento_iniciado
							    )
							    values
							    (	new.id_establecimiento_referido,
								new.id,
								i
							    );
					    --Existe un registro, actualizar fecha y establecimiento
					    else
						    --Actualizar establecimiento en caso de haberse cambiado el referido
						    update img_pendiente_realizacion
							    set fecha_ingreso_lista = now()::timestamp(0),
								id_establecimiento = new.id_establecimiento_referido
						    where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" = i;
					    end if;
					end if;
				    else
					--Existe registro de examen "Almacenado" y existe registro en lista de trabajo, eliminar
					delete 
					from img_pendiente_realizacion
					where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" = i;
				    end if;
				end loop;
			    -- Registros no iniciados, cuando existen iniciados
			    if new.requiere_cita is false then
				--Actualizar establecimiento en caso de haberse cambiado el referido
				update img_pendiente_realizacion
					set 	fecha_ingreso_lista = now()::timestamp(0),
						id_establecimiento = new.id_establecimiento_referido
				where "id" = any(pndR_insertado::integer[]) and "id_procedimiento_iniciado" is null;
			    end if;
			end if;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_ingresar_pendiente_realizacion_solicitud_estudio() OWNER TO simagd;

--
-- Name: fn_trg_ingresar_pendiente_transcripcion_lectura(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_ingresar_pendiente_transcripcion_lectura() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare diag_insertado integer;		--id del registro de diagnóstico
			diag_estado integer; 		--estado del diagnóstico
			pndL_insertado integer[] = '{}';--id del registro en lista de lectura
			pndT_insertado integer;		--id del registro en lista de transcripción
			post_estudio boolean := false;	--representa si la solicitud fue post-estudio
			est_leidos integer[] = '{}';--id del registro de estudios leidos
			
			status_sc_cod character(3);	--código del estado del registro de solicitud
			status_sc integer;	--estado del registro de solicitud
			prc_insertado integer; --id del registro en la lista de trabajo
		begin
			--Obtener el id y estado del registro de diagnóstico, si existe
			select "diag"."id", "diag"."id_estado_diagnostico"
				into diag_insertado, diag_estado
			from "img_diagnostico" as "diag"
			where "diag"."id_lectura" = new.id;

			--Obtener el id del registro en lista de trabajo, si existe
			pndT_insertado := (	select "pndT"."id"
						from "img_pendiente_transcripcion" as "pndT"
						where "pndT"."id_lectura" = new.id
					);

			--Obtener el id de los estudios leidos
			est_leidos := array(	select "lctEst"."id_estudio"
						from "img_lectura_estudio" as "lctEst"
							where "lctEst"."id_lectura" = new.id
					);

			--Obtener el id del registro en lista de lectura, si existe
			pndL_insertado := array(select "pndL"."id"
						from "img_pendiente_lectura" as "pndL"
						where "pndL"."id_estudio" = any(est_leidos::integer[])
					);
			
			--Asignar solicitud padre
			prc_insertado := ( 	select "prz"."id_solicitud_estudio"
						from "img_estudio_paciente" as "est"
						    inner join "img_procedimiento_realizado" as "prz"
							on "prz"."id" = "est"."id_procedimiento_realizado"
						where "est"."id" = new.id_estudio
					);
			
			--Solicitud pre o post-estudio
			if ( exists ( select "id" 
					from "img_solicitud_diagnostico" 
						where "id_estudio" = any(est_leidos::integer[]) ) ) or new.solicitada_por_radiologo is true then
				post_estudio := true; 
			end if;

			if ( ( diag_insertado is not null ) and ( diag_estado not in (3, 6) ) ) or ( diag_insertado is null ) then
				case new.id_estado_lectura
					when 4 then
						if ( pndT_insertado is not null ) then
							--Actualizar lista de trabajo
							update img_pendiente_transcripcion
								set 	fecha_ingreso_lista = now()::timestamp(0)
							where "id" = pndT_insertado and "id_lectura" = new.id;
						else
							--Ingresar a lista de pendientes del establecimiento diagnosticante
							insert into img_pendiente_transcripcion
								(	id_establecimiento,
									id_lectura
								)
								values
								(	new.id_establecimiento,
									new.id
								);
						end if;

						--Extraer de lista de Lectura (Se ha confirmado como leido)
						delete from img_pendiente_lectura
						where "id" = any(pndL_insertado::integer[]);
						
						--asignar código de estado de registro de solicitud
						status_sc_cod := 'EIR';
					else
						if ( array_length(pndL_insertado, 1) is not null ) then
							--Actualizar lista de trabajo
							update img_pendiente_lectura
								set 	fecha_ingreso_lista = now()::timestamp(0),
									solicitud_post_estudio = post_estudio
							where "id" = any(pndL_insertado::integer[]);
-- 						else
-- 							--Ingresar a lista de pendientes del establecimiento diagnosticante
-- 							insert into img_pendiente_lectura
-- 								(	id_establecimiento,
-- 									id_estudio,
-- 									solicitud_post_estudio
-- 								)
-- 								values
-- 								(	new.id_establecimiento,
-- 									new.id_estudio,
-- 									post_estudio
-- 								);
						end if;
						
						--Extraer de lista de transcripción
						delete from img_pendiente_transcripcion
						where "id" = pndT_insertado and "id_lectura" = new.id;
						
						--asignar código de estado de registro de solicitud
						status_sc_cod := 'EAP';
						
						--asignar código de estado de registro de solicitud
						if new.id_estado_lectura not in (1, 2, 3, 4) then
							--asignar código de estado de registro de solicitud
							status_sc_cod := 'SRZ';
						end if;
				end case;
			else
				if ( diag_insertado is not null ) and ( diag_estado in (3, 6) ) then
					case new.id_estado_lectura
						when 4 then
							--Extraer de lista de Lectura (Se ha confirmado como leido)
							delete from img_pendiente_lectura
							where "id" = any(pndL_insertado::integer[]);
							
							--asignar código de estado de registro de solicitud
							status_sc_cod := 'EIR';
						else
							if ( array_length(pndL_insertado, 1) is not null ) then
								--Actualizar lista de trabajo
								update img_pendiente_lectura
									set 	fecha_ingreso_lista = now()::timestamp(0),
										solicitud_post_estudio = post_estudio
								where "id" = any(pndL_insertado::integer[]);
-- 							else
-- 								--Ingresar a lista de pendientes del establecimiento diagnosticante
-- 								insert into img_pendiente_lectura
-- 									(	id_establecimiento,
-- 										id_estudio,
-- 										solicitud_post_estudio
-- 									)
-- 									values
-- 									(	new.id_establecimiento,
-- 										new.id_estudio,
-- 										post_estudio
-- 									);
							end if;
							
							--asignar código de estado de registro de solicitud
							status_sc_cod := 'EAP';
							
							--asignar código de estado de registro de solicitud
							if new.id_estado_lectura not in (1, 2, 3, 4) then
								--asignar código de estado de registro de solicitud
								status_sc_cod := 'SRZ';
							end if;
					end case;
					
					--Extraer de lista de transcripción
					delete from img_pendiente_transcripcion
					where "id" = pndT_insertado and "id_lectura" = new.id;
				end if;
			end if;
					
			--Consultar estado de registro de solicitud
			status_sc := (	select "id"
					from "img_ctl_estado_solicitud"
					where "codigo" = status_sc_cod
				      );
			
			--Actualizar estado de solicitud de estudio
			update "img_solicitud_estudio"
				set "id_estado_solicitud" = status_sc
			where "id" = prc_insertado;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_ingresar_pendiente_transcripcion_lectura() OWNER TO simagd;

--
-- Name: fn_trg_ingresar_pendiente_validacion_diagnostico(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION fn_trg_ingresar_pendiente_validacion_diagnostico() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		declare id_diagnosticante integer;	--establecimiento diagnosticante
			pndV_insertado integer;		--id del registro en lista de validación
			pndT_insertado integer;		--id del registro en lista de transcripción
			pndL_insertado integer[] = '{}';--id del registro en lista de lectura
			corregido boolean := false;	--proviene de transcripción o corrección
			
			status_sc_cod character(3);	--código del estado del registro de solicitud
			status_sc integer;		--estado del registro de solicitud
			prc_insertado integer; 		--id de la solicitud
		begin		
			--Obtener el establecimiento marcado para diagnóstico, en caso de haberse requerido.	
			id_diagnosticante := (	select "lct"."id_establecimiento"
						from "img_lectura" as "lct"
						where "lct"."id" = new.id_lectura
					);

			--Obtener el id del registro en lista de lectura, si existe
			pndL_insertado := array(select "pndL"."id"
						from "img_pendiente_lectura" as "pndL"
						where "pndL"."id_estudio" in (
							select "lctEst"."id_estudio"
							from "img_lectura_estudio" as "lctEst"
							where "lctEst"."id_lectura" = new.id_lectura )
					);
			
			--Obtener el id del registro en lista de transcripción, si existe
			pndT_insertado := (	select "pndT"."id"
						from "img_pendiente_transcripcion" as "pndT"
						where "pndT"."id_lectura" = new.id_lectura
					);

			--Obtener el id del registro en lista de validación, si existe
			pndV_insertado := (	select "pndV"."id"
						from "img_pendiente_validacion" as "pndV"
						where "pndV"."id_diagnostico" = new.id
					);
			
			--Asignar solicitud padre
			prc_insertado := ( 	select "prz"."id_solicitud_estudio"
						from "img_lectura" as "lct"
						    inner join "img_estudio_paciente" as "est"
							on "est"."id" = "lct"."id_estudio"
						    inner join "img_procedimiento_realizado" as "prz"
							on "prz"."id" = "est"."id_procedimiento_realizado"
						where "lct"."id" = new.id_lectura
					);
			
			--Diagnóstico "corregido", se marca para identificarlo, fue_corregido = true
			if (new.id_estado_diagnostico = 5) then
				corregido := true;
			end if;
		
			--Estado en el que se guarda el diagnóstico
			case new.id_estado_diagnostico
				--Insertar si el registro se marcó como "Transcrito" o "Corregido"
				when 3, 5 then 
					if ( pndV_insertado is not null ) then
						--Actualizar lista de trabajo
						update img_pendiente_validacion
							set 	fecha_ingreso_lista = now()::timestamp(0),
								fue_corregido = corregido
						where "id" = pndV_insertado and "id_diagnostico" = new.id;
					else
						--Ingresar a lista de pendientes del establecimiento diagnosticante
						insert into img_pendiente_validacion 
							(	id_establecimiento, 					
								id_diagnostico,
								fue_corregido					
							)
							values	
							(	id_diagnosticante, 
								new.id,
								corregido
							);
					end if;
					
					--Extraer de la lista de transcripción
					delete from img_pendiente_transcripcion
					where "id_lectura" = new.id_lectura;

					--Extraer de lista de Lectura
					delete from img_pendiente_lectura
					where "id" = any(pndL_insertado::integer[]);
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'DTR';
					
				--Regresar a "Corrección" si el diagnóstico se marcó como "Impugnado"
				when 4 then
					if ( pndT_insertado is not null ) then
						--Actualizar lista de trabajo
						update img_pendiente_transcripcion
							set 	fecha_ingreso_lista = now()::timestamp(0),
								fue_impugnado = true
						where "id" = pndT_insertado and "id_lectura" = new.id_lectura;
					else
						--Regresar a lista de pendientes por transcripción, para corrección
						insert into img_pendiente_transcripcion 
							(	id_establecimiento, 					
								id_lectura,
								fue_impugnado					
							)
							values	
							(	id_diagnosticante,
								new.id_lectura,
								true
							);
					end if;
						
					--Extraer de la lista de validación
					delete from img_pendiente_validacion
					where "id_diagnostico" = new.id;

					--Extraer de lista de Lectura
					delete from img_pendiente_lectura
					where "id" = any(pndL_insertado::integer[]);
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'DTR';
					
				--caso 6: Diagnóstico Aprobado por Radiólogo dictante
				when 6 then						
					--Extraer de la lista de transcripción
					delete from img_pendiente_transcripcion
					where "id_lectura" = new.id_lectura;
					
					--Extraer de la lista de validación
					delete from img_pendiente_validacion
					where "id_diagnostico" = new.id;

					--Extraer de lista de Lectura
					delete from img_pendiente_lectura
					where "id" = any(pndL_insertado::integer[]);
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'DAP';
																	
				else
					if ( pndT_insertado is not null ) then
						--Actualizar lista de trabajo
						update img_pendiente_transcripcion
							set 	fecha_ingreso_lista = now()::timestamp(0),
								fue_impugnado = false
						where "id" = pndT_insertado and "id_lectura" = new.id_lectura;
					else
						--Regresar a lista de pendientes por transcripción, para corrección
						insert into img_pendiente_transcripcion 
							(	id_establecimiento, 					
								id_lectura					
							)
							values	
							(	id_diagnosticante,
								new.id_lectura
							);
					end if;
					
					--Extraer de la lista de validación (Comprende 2: No Concluido)
					delete from img_pendiente_validacion
					where "id_diagnostico" = new.id;
					
					--asignar código de estado de registro de solicitud
					status_sc_cod := 'LTR';
			end case;
					
			--Consultar estado de registro de solicitud
			status_sc := (	select "id"
					from "img_ctl_estado_solicitud"
					where "codigo" = status_sc_cod
				      );
			
			--Actualizar estado de solicitud de estudio
			update "img_solicitud_estudio"
				set "id_estado_solicitud" = status_sc
			where "id" = prc_insertado;
			
			return new;
		end;
	$$;


ALTER FUNCTION public.fn_trg_ingresar_pendiente_validacion_diagnostico() OWNER TO simagd;

--
-- Name: foo(integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION foo(integer) RETURNS integer[]
    LANGUAGE plpgsql
    AS $_$
DECLARE x integer[] = '{}';
BEGIN x[1] := $1;
RETURN x;
END; $_$;


ALTER FUNCTION public.foo(integer) OWNER TO simagd;

--
-- Name: foo2(integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION foo2(integer) RETURNS integer[]
    LANGUAGE plpgsql
    AS $_$
DECLARE x integer[] = '{}';
	y boolean := false;
BEGIN 
	x := array(
		select "lctEst"."id_estudio"
			from "img_lectura_estudio" as "lctEst"
				where "lctEst"."id_lectura" = $1
	);

	--update img_cita set incidencias_cita = 'prueba de nuevos trigger' where id = any(x::integer[]);
RETURN x;
END; $_$;


ALTER FUNCTION public.foo2(integer) OWNER TO simagd;

--
-- Name: foo3(integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION foo3(integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
DECLARE x integer[] = '{}';
y boolean := false;
i integer;
BEGIN 

if $1 > 0 then
x[0] := $1;
x[1] := $1 * 2;
x[2] := $1 * 4;  
end if;

if array_length(x, 1) is null then
y := true;
end if;

FOREACH i IN ARRAY x
LOOP 
   RAISE NOTICE '%', i;
END LOOP;

FOREACH i IN ARRAY x
LOOP 
   RAISE NOTICE '%', i*2;
END LOOP;

FOREACH i IN ARRAY x
LOOP 
   RAISE NOTICE '%', i*4;
END LOOP;

RETURN y;
END; $_$;


ALTER FUNCTION public.foo3(integer) OWNER TO simagd;

--
-- Name: foo4(integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION foo4(integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
DECLARE x integer[] = '{}';
	y boolean := false;
BEGIN 
	y := (
		select 
			case
				when id_user_mod is not null
					then TRUE
				else FALSE
			end
		from img_procedimiento_realizado where id = $1
	);

	/*update img_cita set incidencias_cita = 'prueba de nuevos trigger' where id = any(x::integer[]);*/
RETURN y;
END; $_$;


ALTER FUNCTION public.foo4(integer) OWNER TO simagd;

--
-- Name: llenarexpl(integer, integer, integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION llenarexpl(integer, integer, integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE i integer;
	s integer := $3;
	n integer := 0;
	
BEGIN
	FOR i IN $1..$2 LOOP

	    insert into img_ctl_exploracion_realizable (id_exploracion, id_user_reg, id_area_examen_estab)
	    select id, 51, s from img_ctl_exploracion
	    where id_examen_servicio_apoyo = i;

	    s := s + 1;
	    n := n + 1;
	    
	END LOOP;

RETURN n;
END; $_$;


ALTER FUNCTION public.llenarexpl(integer, integer, integer) OWNER TO simagd;

--
-- Name: llenarprc(integer, integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION llenarprc(integer, integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
DECLARE i integer;
BEGIN
	FOR i IN 1..$2 LOOP
	    insert into img_preinscripcion ( id_aten_area_mod_estab,
						  id_modalidad_solicitada,
						  id_solicitudestudios,
						  id_user_reg,
						  id_empleado,
						  id_expediente,
						  id_establecimiento_referido,
						  datos_clinicos,
						  hipotesis_diagnostica,
						  investigar,
						  justificacion_medica_preinscripcion,
						  fecha_proxima_consulta )
					  ( select id_aten_area_mod_estab,
						  id_modalidad_solicitada,
						  id_solicitudestudios,
						  id_user_reg,
						  id_empleado,
						  id_expediente,
						  id_establecimiento_referido,
						  datos_clinicos,
						  hipotesis_diagnostica,
						  investigar,
						  justificacion_medica_preinscripcion,
						  fecha_proxima_consulta
					  from img_preinscripcion where id = $1 );
	END LOOP;

RETURN true;
END; $_$;


ALTER FUNCTION public.llenarprc(integer, integer) OWNER TO simagd;

--
-- Name: totalrecords(); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION totalrecords() RETURNS integer
    LANGUAGE plpgsql
    AS $$
	declare
		total integer;
		mayor integer;
		pndR_insertado integer;
		referido_anterior integer;
	BEGIN
	   SELECT count(*), max(id) into total, mayor FROM img_pendiente_realizacion;

	   select "pndR"."id", "pndR".id_establecimiento
			into pndR_insertado, referido_anterior
		from img_pendiente_realizacion as "pndR"
		where "pndR".id_preinscripcion = 149;
			
	   RETURN total + mayor;-- + pndR_insertado + referido_anterior;
	END;
	$$;


ALTER FUNCTION public.totalrecords() OWNER TO simagd;

--
-- Name: totalrecords(integer); Type: FUNCTION; Schema: public; Owner: simagd
--

CREATE FUNCTION totalrecords(prc integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
	declare
		total integer;
		mayor integer;
		pndR_insertado integer;
		referido_anterior integer;
	BEGIN
	   SELECT count(*), max(id) into total, mayor FROM img_pendiente_realizacion;

	   select "pndR"."id", "pndR".id_establecimiento
			into pndR_insertado, referido_anterior
		from img_pendiente_realizacion as "pndR"
		where "pndR".id_preinscripcion = prc;
			
	   RETURN total + mayor + pndR_insertado + referido_anterior;
	END;
	$$;


ALTER FUNCTION public.totalrecords(prc integer) OWNER TO simagd;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cit_citas_dia; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_citas_dia (
    id integer NOT NULL,
    id_tipocita integer,
    id_aten_area_mod_estab integer,
    id_estado integer,
    fecha date,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    id_motivo integer,
    ipcita character varying(15),
    ipconfirmado character varying(15),
    id_empleado integer,
    id_expediente integer,
    id_establecimiento integer,
    id_establecimiento_referencia integer,
    id_rangohora integer NOT NULL,
    id_area_mod_estab integer NOT NULL
);


ALTER TABLE cit_citas_dia OWNER TO simagd;

--
-- Name: TABLE cit_citas_dia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_citas_dia IS 'Contiene todas las citas medicas de los pacientes.';


--
-- Name: COLUMN cit_citas_dia.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.id IS 'Llave PK';


--
-- Name: COLUMN cit_citas_dia.id_tipocita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.id_tipocita IS 'Tipo de la cita, relacionado con cit_tipocita';


--
-- Name: COLUMN cit_citas_dia.id_aten_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.id_aten_area_mod_estab IS 'especialidad médica de la cita';


--
-- Name: COLUMN cit_citas_dia.id_estado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.id_estado IS 'Estado de la cita, relacionado con cit_estado_cita';


--
-- Name: COLUMN cit_citas_dia.fecha; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.fecha IS 'Fecha de la cita medica';


--
-- Name: COLUMN cit_citas_dia.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.idusuarioreg IS 'Usuario que otorga la cita, relacionado con mnt_empleados.';


--
-- Name: COLUMN cit_citas_dia.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.fechahorareg IS 'Fecha y hora en que se ingresa la cita.';


--
-- Name: COLUMN cit_citas_dia.id_motivo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.id_motivo IS 'idmotivo por el cual se agrega la cita, relacionado con cit_motivoagregados';


--
-- Name: COLUMN cit_citas_dia.ipcita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.ipcita IS 'IP de la maquina donde se ingreso la cita.';


--
-- Name: COLUMN cit_citas_dia.ipconfirmado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.ipconfirmado IS 'Ip de la maquina donde se confirma la cita.';


--
-- Name: COLUMN cit_citas_dia.id_rangohora; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.id_rangohora IS 'Campo adicional, originario de la tabla cit_fechas que fue eliminada para ser unificada con cit_citas_dia';


--
-- Name: COLUMN cit_citas_dia.id_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_dia.id_area_mod_estab IS 'Campo adicional, originario de la tabla cit_fechas que fue eliminada para ser unificada con cit_citas_dia';


--
-- Name: cit_citas_dia_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_citas_dia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_citas_dia_id_seq OWNER TO simagd;

--
-- Name: cit_citas_dia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_citas_dia_id_seq OWNED BY cit_citas_dia.id;


--
-- Name: cit_citas_serviciodeapoyo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_citas_serviciodeapoyo (
    id integer NOT NULL,
    fecha date,
    id_solicitudestudios integer,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    id_detallesolicitudestudios integer
);


ALTER TABLE cit_citas_serviciodeapoyo OWNER TO simagd;

--
-- Name: TABLE cit_citas_serviciodeapoyo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_citas_serviciodeapoyo IS 'Contiene todas las citas de servicio de apoyo';


--
-- Name: COLUMN cit_citas_serviciodeapoyo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_serviciodeapoyo.id IS 'Llave PK';


--
-- Name: COLUMN cit_citas_serviciodeapoyo.fecha; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_serviciodeapoyo.fecha IS 'Fecha de cita programada.';


--
-- Name: COLUMN cit_citas_serviciodeapoyo.id_solicitudestudios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_serviciodeapoyo.id_solicitudestudios IS 'idsolicitudestudio, relacionado con sec_solicitudestudios';


--
-- Name: COLUMN cit_citas_serviciodeapoyo.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_serviciodeapoyo.idusuarioreg IS 'Usuario que ingresa la cita, relacionado con mnt_empleados.';


--
-- Name: COLUMN cit_citas_serviciodeapoyo.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_serviciodeapoyo.fechahorareg IS 'Fecha y hora en que se ingresa la cita.';


--
-- Name: COLUMN cit_citas_serviciodeapoyo.id_detallesolicitudestudios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citas_serviciodeapoyo.id_detallesolicitudestudios IS 'iddetalle, relacionado con sec_detallesolicitudestudios';


--
-- Name: cit_citas_serviciodeapoyo_idcitaservapoyo_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_citas_serviciodeapoyo_idcitaservapoyo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_citas_serviciodeapoyo_idcitaservapoyo_seq OWNER TO simagd;

--
-- Name: cit_citas_serviciodeapoyo_idcitaservapoyo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_citas_serviciodeapoyo_idcitaservapoyo_seq OWNED BY cit_citas_serviciodeapoyo.id;


--
-- Name: cit_citasprocedimientos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_citasprocedimientos (
    id integer NOT NULL,
    id_aten_area_mod_estab integer,
    id_expediente integer,
    id_estado integer,
    id_empleado integer,
    fecha date,
    id_rangohora integer,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    ipcita character varying(15) DEFAULT NULL::character varying,
    ipconfirmada character varying(15) DEFAULT NULL::character varying,
    id_establecimiento integer,
    id_ciq_establecimiento integer,
    id_establecimiento_referencia integer,
    numero_expediente_referencia character varying(20),
    id_area_mod_estab integer
);


ALTER TABLE cit_citasprocedimientos OWNER TO simagd;

--
-- Name: TABLE cit_citasprocedimientos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_citasprocedimientos IS 'almacenamiento de citas de procedimientos';


--
-- Name: COLUMN cit_citasprocedimientos.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id IS 'Llave PK';


--
-- Name: COLUMN cit_citasprocedimientos.id_aten_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id_aten_area_mod_estab IS 'Idsubservicio, relacionado con mnt_subservicio (ctl_atencion)';


--
-- Name: COLUMN cit_citasprocedimientos.id_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id_expediente IS 'Numero de Expediente';


--
-- Name: COLUMN cit_citasprocedimientos.id_estado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id_estado IS 'Estado de la cita, relacionado con cit_estado_cita';


--
-- Name: COLUMN cit_citasprocedimientos.id_empleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id_empleado IS 'IdEmpleado que solicita el Procedimiento, relacionado con mnt_empleados';


--
-- Name: COLUMN cit_citasprocedimientos.fecha; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.fecha IS 'Fecha de la cita de procedimiento';


--
-- Name: COLUMN cit_citasprocedimientos.id_rangohora; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id_rangohora IS 'Idrnghr, relacionado con mnt_rangohoras';


--
-- Name: COLUMN cit_citasprocedimientos.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.idusuarioreg IS 'Usuario que otorga la cita, relacionado con mnt_empleados';


--
-- Name: COLUMN cit_citasprocedimientos.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.fechahorareg IS 'Fecha y hora en que se almacena la cita';


--
-- Name: COLUMN cit_citasprocedimientos.ipcita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.ipcita IS 'IP de la maquina donde se esta ingreso la cita.';


--
-- Name: COLUMN cit_citasprocedimientos.ipconfirmada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.ipconfirmada IS 'Ip de la maquina donde se confirma la cita.';


--
-- Name: COLUMN cit_citasprocedimientos.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id_establecimiento IS 'Establicimiento al que pertenece esta tupla';


--
-- Name: COLUMN cit_citasprocedimientos.id_ciq_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_citasprocedimientos.id_ciq_establecimiento IS 'Llave foránea a un procedimiento';


--
-- Name: cit_citasprocedimientos_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_citasprocedimientos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_citasprocedimientos_id_seq OWNER TO simagd;

--
-- Name: cit_citasprocedimientos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_citasprocedimientos_id_seq OWNED BY cit_citasprocedimientos.id;


--
-- Name: cit_distribucion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_distribucion (
    id integer NOT NULL,
    id_rangohora integer,
    id_empleado integer,
    primera integer,
    subsecuente integer,
    mes integer,
    yrs integer,
    dia integer,
    id_consultorio integer DEFAULT 0,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    id_aten_area_mod_estab integer,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    tipocon character varying(5),
    id_area_mod_estab integer,
    distribucionmed character varying(6),
    max_citas_agregadas integer DEFAULT 0 NOT NULL
);


ALTER TABLE cit_distribucion OWNER TO simagd;

--
-- Name: COLUMN cit_distribucion.tipocon; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_distribucion.tipocon IS 'tipo de consulta de la cita';


--
-- Name: COLUMN cit_distribucion.max_citas_agregadas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_distribucion.max_citas_agregadas IS 'Numero maximo de citas que se permiten agregar';


--
-- Name: cit_distribucion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_distribucion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_distribucion_id_seq OWNER TO simagd;

--
-- Name: cit_distribucion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_distribucion_id_seq OWNED BY cit_distribucion.id;


--
-- Name: cit_estado_cita; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_estado_cita (
    id integer NOT NULL,
    estado character varying(20) DEFAULT NULL::character varying,
    descripcion character varying(250) DEFAULT NULL::character varying,
    idusuarioreg smallint,
    fechahorareg timestamp without time zone
);


ALTER TABLE cit_estado_cita OWNER TO simagd;

--
-- Name: TABLE cit_estado_cita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_estado_cita IS 'Los estados que puede tener una cita.';


--
-- Name: COLUMN cit_estado_cita.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_estado_cita.id IS 'Representa el código del estado de la cita y es la llave primaria.';


--
-- Name: COLUMN cit_estado_cita.estado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_estado_cita.estado IS 'Nombre del estado de la cita';


--
-- Name: COLUMN cit_estado_cita.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_estado_cita.descripcion IS 'Descripción del estado de la cita';


--
-- Name: COLUMN cit_estado_cita.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_estado_cita.idusuarioreg IS 'Usuario que ingresa el registro, relacionado con mnt_empleados.';


--
-- Name: COLUMN cit_estado_cita.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_estado_cita.fechahorareg IS 'Fecha y hora en que se ingresa el registro';


--
-- Name: cit_estado_cita_idestado_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_estado_cita_idestado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_estado_cita_idestado_seq OWNER TO simagd;

--
-- Name: cit_estado_cita_idestado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_estado_cita_idestado_seq OWNED BY cit_estado_cita.id;


--
-- Name: cit_evento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_evento (
    id integer NOT NULL,
    idempleado integer,
    fechaini date,
    horaini time without time zone,
    fechafin date,
    horafin time without time zone,
    descripcion character varying(750) DEFAULT NULL::character varying,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    id_ciq_establecimiento integer,
    id_rangohora integer,
    dia_semana smallint,
    id_area_mod_estab integer,
    id_establecimiento integer,
    id_tipoevento integer
);


ALTER TABLE cit_evento OWNER TO simagd;

--
-- Name: cit_evento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_evento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_evento_id_seq OWNER TO simagd;

--
-- Name: cit_evento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_evento_id_seq OWNED BY cit_evento.id;


--
-- Name: cit_motivoagregados; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_motivoagregados (
    id integer NOT NULL,
    motivo character varying(500) DEFAULT NULL::character varying,
    idestado integer NOT NULL
);


ALTER TABLE cit_motivoagregados OWNER TO simagd;

--
-- Name: TABLE cit_motivoagregados; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_motivoagregados IS 'Descripcion del motivo por el cual se agrega el registro.';


--
-- Name: COLUMN cit_motivoagregados.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_motivoagregados.id IS 'Llave PK';


--
-- Name: COLUMN cit_motivoagregados.motivo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_motivoagregados.motivo IS 'Descripcion del motivo por el cual se agrega el registro.';


--
-- Name: cit_motivoagregados_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_motivoagregados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_motivoagregados_id_seq OWNER TO simagd;

--
-- Name: cit_motivoagregados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_motivoagregados_id_seq OWNED BY cit_motivoagregados.id;


--
-- Name: cit_programacion_exams; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_programacion_exams (
    id integer NOT NULL,
    rangotiempoprev integer,
    id_aten_area_mod_estab integer,
    id_establecimiento integer,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    id_examen_establecimiento integer
);


ALTER TABLE cit_programacion_exams OWNER TO simagd;

--
-- Name: TABLE cit_programacion_exams; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_programacion_exams IS 'Almacena los dias en que se tarda cada exam de laboratorio.';


--
-- Name: COLUMN cit_programacion_exams.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_programacion_exams.id IS 'Llave PK';


--
-- Name: COLUMN cit_programacion_exams.rangotiempoprev; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_programacion_exams.rangotiempoprev IS 'Cantidad en dias del tiempo previo para realizarse el estudio';


--
-- Name: COLUMN cit_programacion_exams.id_aten_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_programacion_exams.id_aten_area_mod_estab IS 'idServicio, relacionado con mnt_servicio';


--
-- Name: COLUMN cit_programacion_exams.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_programacion_exams.id_establecimiento IS 'idestablecimiento,Conectado con mnt_establecimiento';


--
-- Name: COLUMN cit_programacion_exams.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_programacion_exams.idusuarioreg IS 'Usuario que ingresa el registro, relacionado con mnt_empleados';


--
-- Name: COLUMN cit_programacion_exams.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_programacion_exams.fechahorareg IS 'Fecha y hora en la que se ingresa el registro';


--
-- Name: cit_programacion_exams_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_programacion_exams_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_programacion_exams_id_seq OWNER TO simagd;

--
-- Name: cit_programacion_exams_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_programacion_exams_id_seq OWNED BY cit_programacion_exams.id;


--
-- Name: cit_referentes; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_referentes (
    id integer NOT NULL,
    idestablecimiento integer,
    referente character varying(100) DEFAULT NULL::character varying,
    tel1 character varying(30) DEFAULT NULL::character varying,
    tel2 character varying(30) DEFAULT NULL::character varying,
    email character varying(50) DEFAULT NULL::character varying,
    estado character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE cit_referentes OWNER TO simagd;

--
-- Name: cit_referentes_idreferente_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_referentes_idreferente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_referentes_idreferente_seq OWNER TO simagd;

--
-- Name: cit_referentes_idreferente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_referentes_idreferente_seq OWNED BY cit_referentes.id;


--
-- Name: cit_tipocita; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_tipocita (
    id integer NOT NULL,
    tipocita character varying(50) DEFAULT NULL::character varying,
    idusuarioreg integer,
    fechahorareg timestamp without time zone
);


ALTER TABLE cit_tipocita OWNER TO simagd;

--
-- Name: TABLE cit_tipocita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_tipocita IS 'Tipo de Citas';


--
-- Name: COLUMN cit_tipocita.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_tipocita.id IS 'Llave PK';


--
-- Name: COLUMN cit_tipocita.tipocita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_tipocita.tipocita IS 'Descripcion del tipo de cita';


--
-- Name: COLUMN cit_tipocita.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_tipocita.idusuarioreg IS 'Usuario que ingresa el registro, relacionado con mnt_empledos';


--
-- Name: COLUMN cit_tipocita.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_tipocita.fechahorareg IS 'Fecha y hora en que se ingresa el registro';


--
-- Name: cit_tipocita_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_tipocita_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_tipocita_id_seq OWNER TO simagd;

--
-- Name: cit_tipocita_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_tipocita_id_seq OWNED BY cit_tipocita.id;


--
-- Name: cit_tipoevento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE cit_tipoevento (
    id integer NOT NULL,
    nombretipo character(50) DEFAULT NULL::bpchar
);


ALTER TABLE cit_tipoevento OWNER TO simagd;

--
-- Name: TABLE cit_tipoevento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE cit_tipoevento IS 'Opciones de los diferentes tipos de eventos.';


--
-- Name: COLUMN cit_tipoevento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_tipoevento.id IS 'Llave PK';


--
-- Name: COLUMN cit_tipoevento.nombretipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN cit_tipoevento.nombretipo IS 'Descripcion del tipo de evento.';


--
-- Name: cit_tipoevento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE cit_tipoevento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cit_tipoevento_id_seq OWNER TO simagd;

--
-- Name: cit_tipoevento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE cit_tipoevento_id_seq OWNED BY cit_tipoevento.id;


--
-- Name: ctl_area_atencion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_area_atencion (
    id integer NOT NULL,
    nombre character varying(25)
);


ALTER TABLE ctl_area_atencion OWNER TO simagd;

--
-- Name: TABLE ctl_area_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_area_atencion IS 'Contiene las áreas de atención al paciente en que  se divide un establecimiento';


--
-- Name: COLUMN ctl_area_atencion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_atencion.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_area_atencion.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_atencion.nombre IS 'Nombre del área de atención';


--
-- Name: ctl_area_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_area_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_area_atencion_id_seq OWNER TO simagd;

--
-- Name: ctl_area_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_area_atencion_id_seq OWNED BY ctl_area_atencion.id;


--
-- Name: ctl_area_cotizante; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_area_cotizante (
    nombre character varying(300) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE ctl_area_cotizante OWNER TO simagd;

--
-- Name: TABLE ctl_area_cotizante; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_area_cotizante IS 'Representa el área de cotización a la que pertenece el paciente';


--
-- Name: COLUMN ctl_area_cotizante.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_cotizante.nombre IS 'Nombre del área a la que cotiza';


--
-- Name: COLUMN ctl_area_cotizante.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_cotizante.id IS 'Llave primaria';


--
-- Name: ctl_area_cotizante_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_area_cotizante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_area_cotizante_id_seq OWNER TO simagd;

--
-- Name: ctl_area_cotizante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_area_cotizante_id_seq OWNED BY ctl_area_cotizante.id;


--
-- Name: ctl_area_geografica; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_area_geografica (
    id integer NOT NULL,
    nombre character varying(15) NOT NULL,
    abreviatura character(2) NOT NULL
);


ALTER TABLE ctl_area_geografica OWNER TO simagd;

--
-- Name: TABLE ctl_area_geografica; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_area_geografica IS 'Tabla que representa el área geográfica en la que se encuentra clasificada una persona';


--
-- Name: COLUMN ctl_area_geografica.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_geografica.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_area_geografica.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_geografica.nombre IS 'Nombre del área geográfica';


--
-- Name: COLUMN ctl_area_geografica.abreviatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_geografica.abreviatura IS 'Letra con la que se presentan el área geográfica';


--
-- Name: ctl_area_geografica_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_area_geografica_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_area_geografica_id_seq OWNER TO simagd;

--
-- Name: ctl_area_geografica_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_area_geografica_id_seq OWNED BY ctl_area_geografica.id;


--
-- Name: ctl_area_servicio_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_area_servicio_diagnostico_id_seq
    START WITH 22
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_area_servicio_diagnostico_id_seq OWNER TO simagd;

--
-- Name: ctl_area_servicio_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_area_servicio_diagnostico (
    idarea character varying(4) NOT NULL,
    nombrearea character varying(75),
    administrativa character varying DEFAULT 'N'::character varying,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    id integer DEFAULT nextval('ctl_area_servicio_diagnostico_id_seq'::regclass) NOT NULL,
    id_atencion integer NOT NULL,
    img_codigo character(10),
    img_descripcion text,
    img_observaciones character varying(255)
);


ALTER TABLE ctl_area_servicio_diagnostico OWNER TO simagd;

--
-- Name: TABLE ctl_area_servicio_diagnostico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_area_servicio_diagnostico IS 'Contiene los nombres de las áreas del Laboratorio';


--
-- Name: COLUMN ctl_area_servicio_diagnostico.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_servicio_diagnostico.idarea IS 'Id del área de laboratorio';


--
-- Name: COLUMN ctl_area_servicio_diagnostico.nombrearea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_servicio_diagnostico.nombrearea IS 'Nombre de Área';


--
-- Name: COLUMN ctl_area_servicio_diagnostico.administrativa; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_servicio_diagnostico.administrativa IS 'Bandera para saber si es área administrativa del laboratorio';


--
-- Name: COLUMN ctl_area_servicio_diagnostico.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_servicio_diagnostico.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN ctl_area_servicio_diagnostico.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_servicio_diagnostico.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN ctl_area_servicio_diagnostico.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_servicio_diagnostico.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN ctl_area_servicio_diagnostico.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_area_servicio_diagnostico.id IS 'Identificador unico de ctl_area_servicio_apoyo, llave primaria';


--
-- Name: ctl_area_servicio_apoyo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_area_servicio_apoyo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_area_servicio_apoyo_id_seq OWNER TO simagd;

--
-- Name: ctl_area_servicio_apoyo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_area_servicio_apoyo_id_seq OWNED BY ctl_area_servicio_diagnostico.id;


--
-- Name: ctl_atencion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_atencion (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    id_atencion_padre integer,
    id_tipo_atencion integer,
    codigo_busqueda character varying(6)
);


ALTER TABLE ctl_atencion OWNER TO simagd;

--
-- Name: TABLE ctl_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_atencion IS 'Contiene todas la atenciones que un paciente puede recibir como especiales u otras atenciones en salud';


--
-- Name: COLUMN ctl_atencion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_atencion.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN ctl_atencion.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_atencion.nombre IS 'Nombre de la atención a recibir por el paciente';


--
-- Name: COLUMN ctl_atencion.id_atencion_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_atencion.id_atencion_padre IS 'Llave recursiva para determinar a que área superior pertenece.';


--
-- Name: COLUMN ctl_atencion.id_tipo_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_atencion.id_tipo_atencion IS 'Foránea para representar el tipo de atención';


--
-- Name: ctl_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_atencion_id_seq OWNER TO simagd;

--
-- Name: ctl_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_atencion_id_seq OWNED BY ctl_atencion.id;


--
-- Name: ctl_campo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_campo (
    id integer NOT NULL,
    nombre character varying(30) NOT NULL,
    tamano integer,
    es_nulo boolean NOT NULL,
    id_tipo_campo integer NOT NULL,
    id_tabla integer NOT NULL
);


ALTER TABLE ctl_campo OWNER TO simagd;

--
-- Name: TABLE ctl_campo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_campo IS 'Contiene datos de los campos que conforman las tablas catalogo.';


--
-- Name: COLUMN ctl_campo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_campo.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_campo.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_campo.nombre IS 'Nombre del Campo';


--
-- Name: COLUMN ctl_campo.id_tipo_campo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_campo.id_tipo_campo IS 'El Tipo asociado del Campo';


--
-- Name: COLUMN ctl_campo.id_tabla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_campo.id_tabla IS 'Tabla a la que pertenece el Campo';


--
-- Name: ctl_campo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_campo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_campo_id_seq OWNER TO simagd;

--
-- Name: ctl_campo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_campo_id_seq OWNED BY ctl_campo.id;


--
-- Name: ctl_canton; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_canton (
    id integer NOT NULL,
    nombre character varying(150),
    codigo_digestyc character varying(5),
    id_municipio smallint
);


ALTER TABLE ctl_canton OWNER TO simagd;

--
-- Name: TABLE ctl_canton; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_canton IS 'Lista de los cantones que conforman un municipio';


--
-- Name: COLUMN ctl_canton.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_canton.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_canton.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_canton.nombre IS 'Nombre del cantón';


--
-- Name: COLUMN ctl_canton.codigo_digestyc; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_canton.codigo_digestyc IS 'Codigo asignado por la Digestyc para un cantón en especifico';


--
-- Name: COLUMN ctl_canton.id_municipio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_canton.id_municipio IS 'Representa la llave foranea que proviene de ctl_municipio';


--
-- Name: ctl_canton_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_canton_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_canton_id_seq OWNER TO simagd;

--
-- Name: ctl_canton_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_canton_id_seq OWNED BY ctl_canton.id;


--
-- Name: ctl_catalogo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_catalogo (
    id integer NOT NULL,
    nombre character varying(40) NOT NULL,
    id_campo_id integer NOT NULL,
    id_campo_descripcion integer NOT NULL,
    descripcion text
);


ALTER TABLE ctl_catalogo OWNER TO simagd;

--
-- Name: TABLE ctl_catalogo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_catalogo IS 'Contiene las Tablas Catalogos a las que se hace referencia, su campo id y descripctor.';


--
-- Name: COLUMN ctl_catalogo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_catalogo.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_catalogo.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_catalogo.nombre IS 'Nombre del Catalogo';


--
-- Name: COLUMN ctl_catalogo.id_campo_id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_catalogo.id_campo_id IS 'Determina el campo id o identificador de la tabla catalogo a la que se hace referencia.';


--
-- Name: COLUMN ctl_catalogo.id_campo_descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_catalogo.id_campo_descripcion IS 'Determina el campo de descripcion de la Tabla Catalogo a la que se hace referencia.';


--
-- Name: COLUMN ctl_catalogo.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_catalogo.descripcion IS 'Descripcion del Catalogo';


--
-- Name: ctl_catalogo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_catalogo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_catalogo_id_seq OWNER TO simagd;

--
-- Name: ctl_catalogo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_catalogo_id_seq OWNED BY ctl_catalogo.id;


--
-- Name: ctl_condicion_persona; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_condicion_persona (
    id integer NOT NULL,
    nombre character varying NOT NULL,
    descripcion text
);


ALTER TABLE ctl_condicion_persona OWNER TO simagd;

--
-- Name: TABLE ctl_condicion_persona; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_condicion_persona IS 'Contiene los tipos de condicion que puede tener una persona en un determinado momento.';


--
-- Name: COLUMN ctl_condicion_persona.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_condicion_persona.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_condicion_persona.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_condicion_persona.nombre IS 'Nombre de la Condicion de la Persona';


--
-- Name: COLUMN ctl_condicion_persona.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_condicion_persona.descripcion IS 'Descripcion de la Condicion de la Persona';


--
-- Name: ctl_condicion_persona_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_condicion_persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_condicion_persona_id_seq OWNER TO simagd;

--
-- Name: ctl_condicion_persona_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_condicion_persona_id_seq OWNED BY ctl_condicion_persona.id;


--
-- Name: ctl_creacion_expediente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_creacion_expediente (
    id integer NOT NULL,
    area character varying(25) NOT NULL
);


ALTER TABLE ctl_creacion_expediente OWNER TO simagd;

--
-- Name: TABLE ctl_creacion_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_creacion_expediente IS 'Lugar del establecimiento en donde se crea el expediente';


--
-- Name: COLUMN ctl_creacion_expediente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_creacion_expediente.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_creacion_expediente.area; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_creacion_expediente.area IS 'Nombre del área de creación del expediente';


--
-- Name: ctl_creacion_expediente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_creacion_expediente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_creacion_expediente_id_seq OWNER TO simagd;

--
-- Name: ctl_creacion_expediente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_creacion_expediente_id_seq OWNED BY ctl_creacion_expediente.id;


--
-- Name: ctl_departamento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_departamento (
    id integer NOT NULL,
    nombre character varying(150),
    codigo_cnr character varying(5),
    abreviatura character varying(5),
    id_pais integer,
    id_establecimiento_region integer
);


ALTER TABLE ctl_departamento OWNER TO simagd;

--
-- Name: TABLE ctl_departamento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_departamento IS 'Lista de los departamentos que conforman un pais';


--
-- Name: COLUMN ctl_departamento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_departamento.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_departamento.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_departamento.nombre IS 'Nombre del departamento';


--
-- Name: COLUMN ctl_departamento.codigo_cnr; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_departamento.codigo_cnr IS 'Codigo asignado por la Digestyc para un departamento en especifico';


--
-- Name: COLUMN ctl_departamento.abreviatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_departamento.abreviatura IS 'Abreviatura asignada al departamento';


--
-- Name: COLUMN ctl_departamento.id_pais; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_departamento.id_pais IS 'Representa la llave foranea que proviene de ctl_pais';


--
-- Name: COLUMN ctl_departamento.id_establecimiento_region; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_departamento.id_establecimiento_region IS 'Foránea que representa el la región a la que pertenece administrativamente el departamento';


--
-- Name: ctl_departamento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_departamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_departamento_id_seq OWNER TO simagd;

--
-- Name: ctl_departamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_departamento_id_seq OWNED BY ctl_departamento.id;


--
-- Name: ctl_documento_identidad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_documento_identidad (
    id integer NOT NULL,
    nombre character varying(20)
);


ALTER TABLE ctl_documento_identidad OWNER TO simagd;

--
-- Name: TABLE ctl_documento_identidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_documento_identidad IS 'Lista de todos los documentos de identidad permitidos';


--
-- Name: COLUMN ctl_documento_identidad.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_documento_identidad.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_documento_identidad.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_documento_identidad.nombre IS 'Descripción o nombre del documento';


--
-- Name: ctl_documento_identidad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_documento_identidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_documento_identidad_id_seq OWNER TO simagd;

--
-- Name: ctl_documento_identidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_documento_identidad_id_seq OWNED BY ctl_documento_identidad.id;


--
-- Name: ctl_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_establecimiento (
    id integer NOT NULL,
    id_tipo_establecimiento integer NOT NULL,
    nombre character varying(150) NOT NULL,
    direccion character varying(250),
    telefono character varying(15),
    fax character varying(15),
    latitud numeric(10,4),
    longitud numeric(10,4),
    id_municipio integer,
    id_nivel_minsal integer,
    cod_ucsf integer,
    activo boolean,
    id_establecimiento_padre integer,
    tipo_expediente character(1),
    configurado boolean,
    tipo_farmacia boolean
);


ALTER TABLE ctl_establecimiento OWNER TO simagd;

--
-- Name: TABLE ctl_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_establecimiento IS 'Contiene los tipos de establecimiento que conforman el MINSAL';


--
-- Name: COLUMN ctl_establecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_establecimiento.id_tipo_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.id_tipo_establecimiento IS 'Llave foránea del tipo de establecimiento';


--
-- Name: COLUMN ctl_establecimiento.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.nombre IS 'Nombre del establecimiento de salud';


--
-- Name: COLUMN ctl_establecimiento.direccion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.direccion IS 'Lugar físico del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.telefono; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.telefono IS 'Teléfono de contacto del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.fax; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.fax IS 'Fax del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.latitud; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.latitud IS 'Coordenadas de latitud para sistema georeferencial';


--
-- Name: COLUMN ctl_establecimiento.longitud; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.longitud IS 'Coordenadas de longitud para sistema georeferencial';


--
-- Name: COLUMN ctl_establecimiento.id_municipio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.id_municipio IS 'Llave foránea del municipio al que pertenece el establecimiento';


--
-- Name: COLUMN ctl_establecimiento.id_nivel_minsal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.id_nivel_minsal IS 'Representa el nivel del establecimiento, pueden ser 1,2,3';


--
-- Name: COLUMN ctl_establecimiento.cod_ucsf; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.cod_ucsf IS 'Código asignados a la Unidad Comunitaria de Salud Familiar.';


--
-- Name: COLUMN ctl_establecimiento.activo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.activo IS 'Estado del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.id_establecimiento_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.id_establecimiento_padre IS 'Llave foránea del establecimiento que es su supervisor';


--
-- Name: COLUMN ctl_establecimiento.tipo_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.tipo_expediente IS 'Los tipos de expedientes son: G = Utiliza guión (xxx-xx); I = Infinito';


--
-- Name: COLUMN ctl_establecimiento.tipo_farmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_establecimiento.tipo_farmacia IS 'Representa el tipo de farmacia que opera en el establecimiento';


--
-- Name: ctl_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_establecimiento_id_seq OWNER TO simagd;

--
-- Name: ctl_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_establecimiento_id_seq OWNED BY ctl_establecimiento.id;


--
-- Name: ctl_estado_civil; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_estado_civil (
    id integer NOT NULL,
    nombre character varying(15) NOT NULL
);


ALTER TABLE ctl_estado_civil OWNER TO simagd;

--
-- Name: TABLE ctl_estado_civil; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_estado_civil IS 'Contiene los estados civiles permitidos';


--
-- Name: COLUMN ctl_estado_civil.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_estado_civil.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_estado_civil.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_estado_civil.nombre IS 'Nombre del estado civil';


--
-- Name: ctl_estado_civil_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_estado_civil_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_estado_civil_id_seq OWNER TO simagd;

--
-- Name: ctl_estado_civil_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_estado_civil_id_seq OWNED BY ctl_estado_civil.id;


--
-- Name: ctl_estado_servicio_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_estado_servicio_diagnostico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_estado_servicio_diagnostico_id_seq OWNER TO simagd;

--
-- Name: ctl_estado_servicio_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_estado_servicio_diagnostico (
    idestado character varying(2) NOT NULL,
    descripcion character varying(40),
    id integer DEFAULT nextval('ctl_estado_servicio_diagnostico_id_seq'::regclass) NOT NULL,
    id_atencion integer NOT NULL
);


ALTER TABLE ctl_estado_servicio_diagnostico OWNER TO simagd;

--
-- Name: TABLE ctl_estado_servicio_diagnostico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_estado_servicio_diagnostico IS 'Contiene los códigos sobre los estados de la solicitud';


--
-- Name: COLUMN ctl_estado_servicio_diagnostico.idestado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_estado_servicio_diagnostico.idestado IS 'Código del estado de la solicitud';


--
-- Name: COLUMN ctl_estado_servicio_diagnostico.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_estado_servicio_diagnostico.descripcion IS 'Descripción o nombre del estado de la solicitud';


--
-- Name: COLUMN ctl_estado_servicio_diagnostico.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_estado_servicio_diagnostico.id IS 'Llave primaria';


--
-- Name: ctl_estado_servicio_apoyo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_estado_servicio_apoyo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_estado_servicio_apoyo_id_seq OWNER TO simagd;

--
-- Name: ctl_estado_servicio_apoyo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_estado_servicio_apoyo_id_seq OWNED BY ctl_estado_servicio_diagnostico.id;


--
-- Name: ctl_examen_servicio_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_examen_servicio_diagnostico_id_seq
    START WITH 126
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_examen_servicio_diagnostico_id_seq OWNER TO simagd;

--
-- Name: ctl_examen_servicio_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_examen_servicio_diagnostico (
    idestandar character varying(4) NOT NULL,
    descripcion character varying(250),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    id integer DEFAULT nextval('ctl_examen_servicio_diagnostico_id_seq'::regclass) NOT NULL,
    idsexo integer,
    id_atencion integer NOT NULL,
    idgrupo integer,
    img_codigo character(10),
    img_observaciones character varying(255)
);


ALTER TABLE ctl_examen_servicio_diagnostico OWNER TO simagd;

--
-- Name: TABLE ctl_examen_servicio_diagnostico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_examen_servicio_diagnostico IS 'Contiene códigos estándar de los Exámenes';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.idestandar; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.idestandar IS 'Código del estándar';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.descripcion IS 'Nombre del estándar';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.idsexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.idsexo IS 'Campo que permite determinar el sexo al cual aplica un examen';


--
-- Name: COLUMN ctl_examen_servicio_diagnostico.idgrupo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_examen_servicio_diagnostico.idgrupo IS 'Campo que se relaciona con id de la tabla lab_estandarxgrupo(id)';


--
-- Name: ctl_examen_servicio_apoyo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_examen_servicio_apoyo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_examen_servicio_apoyo_id_seq OWNER TO simagd;

--
-- Name: ctl_examen_servicio_apoyo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_examen_servicio_apoyo_id_seq OWNED BY ctl_examen_servicio_diagnostico.id;


--
-- Name: ctl_modalidad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_modalidad (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL
);


ALTER TABLE ctl_modalidad OWNER TO simagd;

--
-- Name: TABLE ctl_modalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_modalidad IS 'Modalidades que pueden estar presentes en los establecimientos de salud';


--
-- Name: COLUMN ctl_modalidad.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_modalidad.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_modalidad.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_modalidad.nombre IS 'Nombre de la modalidad';


--
-- Name: ctl_modalidad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_modalidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_modalidad_id_seq OWNER TO simagd;

--
-- Name: ctl_modalidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_modalidad_id_seq OWNED BY ctl_modalidad.id;


--
-- Name: ctl_municipio; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_municipio (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    codigo_cnr character varying(5),
    abreviatura character varying(5),
    id_departamento integer NOT NULL
);


ALTER TABLE ctl_municipio OWNER TO simagd;

--
-- Name: TABLE ctl_municipio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_municipio IS 'Lista de los municipios que conforman un departamento';


--
-- Name: COLUMN ctl_municipio.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_municipio.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_municipio.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_municipio.nombre IS 'Nombre del municipio';


--
-- Name: COLUMN ctl_municipio.codigo_cnr; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_municipio.codigo_cnr IS 'Codigo asignado por la Digestyc para un municipio en especifico';


--
-- Name: COLUMN ctl_municipio.abreviatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_municipio.abreviatura IS 'Abreviatura asignada al municipio';


--
-- Name: COLUMN ctl_municipio.id_departamento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_municipio.id_departamento IS 'Representa la llave foranea que proviene de ctl_departamento';


--
-- Name: ctl_municipio_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_municipio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_municipio_id_seq OWNER TO simagd;

--
-- Name: ctl_municipio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_municipio_id_seq OWNED BY ctl_municipio.id;


--
-- Name: ctl_nacionalidad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_nacionalidad (
    id integer NOT NULL,
    nacionalidad character varying(50) NOT NULL
);


ALTER TABLE ctl_nacionalidad OWNER TO simagd;

--
-- Name: TABLE ctl_nacionalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_nacionalidad IS 'Catálogo de las nacionalidades existentes';


--
-- Name: COLUMN ctl_nacionalidad.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_nacionalidad.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_nacionalidad.nacionalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_nacionalidad.nacionalidad IS 'Nombre de la nacionalidad';


--
-- Name: ctl_nacionalidad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_nacionalidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_nacionalidad_id_seq OWNER TO simagd;

--
-- Name: ctl_nacionalidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_nacionalidad_id_seq OWNED BY ctl_nacionalidad.id;


--
-- Name: ctl_ocupacion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_ocupacion (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL
);


ALTER TABLE ctl_ocupacion OWNER TO simagd;

--
-- Name: TABLE ctl_ocupacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_ocupacion IS 'Lista de las ocupaciones que un paciente puede tener';


--
-- Name: COLUMN ctl_ocupacion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_ocupacion.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_ocupacion.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_ocupacion.nombre IS 'Nombre de la ocupación';


--
-- Name: ctl_ocupacion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_ocupacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_ocupacion_id_seq OWNER TO simagd;

--
-- Name: ctl_ocupacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_ocupacion_id_seq OWNED BY ctl_ocupacion.id;


--
-- Name: ctl_pais; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_pais (
    id integer NOT NULL,
    nombre character varying(150),
    activo boolean
);


ALTER TABLE ctl_pais OWNER TO simagd;

--
-- Name: TABLE ctl_pais; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_pais IS 'Lista del pais originario del paciente';


--
-- Name: COLUMN ctl_pais.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_pais.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_pais.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_pais.nombre IS 'Nombre del pais';


--
-- Name: COLUMN ctl_pais.activo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_pais.activo IS 'Si el país está activo para ser presentado en las aplicaciones del sistema';


--
-- Name: ctl_pais_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_pais_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_pais_id_seq OWNER TO simagd;

--
-- Name: ctl_pais_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_pais_id_seq OWNED BY ctl_pais.id;


--
-- Name: ctl_parentesco; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_parentesco (
    id integer NOT NULL,
    parentesco character varying(15) NOT NULL
);


ALTER TABLE ctl_parentesco OWNER TO simagd;

--
-- Name: TABLE ctl_parentesco; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_parentesco IS 'Lista de los parentesco que una persona puede tener dentro de su grupo familiar';


--
-- Name: COLUMN ctl_parentesco.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_parentesco.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_parentesco.parentesco; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_parentesco.parentesco IS 'Parentesco del paciente';


--
-- Name: ctl_parentesco_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_parentesco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_parentesco_id_seq OWNER TO simagd;

--
-- Name: ctl_parentesco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_parentesco_id_seq OWNED BY ctl_parentesco.id;


--
-- Name: ctl_programa; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_programa (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    fecha_inicio date NOT NULL,
    fecha_fin date,
    edad_minima integer NOT NULL,
    edad_maxima integer,
    id_sexo integer
);


ALTER TABLE ctl_programa OWNER TO simagd;

--
-- Name: TABLE ctl_programa; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_programa IS 'Contiene todos los programas los cuales puede recibir un paciente ';


--
-- Name: COLUMN ctl_programa.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_programa.id IS 'Llave Primaria';


--
-- Name: COLUMN ctl_programa.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_programa.nombre IS 'Nombre del programa';


--
-- Name: COLUMN ctl_programa.fecha_inicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_programa.fecha_inicio IS 'Fecha en que se inicio el programa';


--
-- Name: COLUMN ctl_programa.fecha_fin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_programa.fecha_fin IS 'Fecha en que finaliza el programa. Si es null es porque sigue vigente';


--
-- Name: COLUMN ctl_programa.edad_minima; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_programa.edad_minima IS 'Edad mínima a la que un paciente puede aplicar para un programa';


--
-- Name: COLUMN ctl_programa.edad_maxima; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_programa.edad_maxima IS 'Edad máxima a la que un paciente puede aplicar. Si es null es porque no hay una edad maxima';


--
-- Name: COLUMN ctl_programa.id_sexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_programa.id_sexo IS 'Foránea que representa el sexo del paciente. Si es null es porque aplica a ambos sexos';


--
-- Name: ctl_programa_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_programa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_programa_id_seq OWNER TO simagd;

--
-- Name: ctl_programa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_programa_id_seq OWNED BY ctl_programa.id;


--
-- Name: ctl_rango_edad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_rango_edad (
    id integer NOT NULL,
    cod_modulo character varying(3),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    nombre character varying(50),
    edad_minima_meses integer DEFAULT 0 NOT NULL,
    edad_minima_anios integer DEFAULT 0 NOT NULL,
    edad_minima_dias integer DEFAULT 0 NOT NULL,
    edad_minima_horas integer DEFAULT 0 NOT NULL,
    edad_minima_minutos integer DEFAULT 0 NOT NULL,
    edad_maxima_anios integer DEFAULT 0 NOT NULL,
    edad_maxima_meses integer DEFAULT 0 NOT NULL,
    edad_maxima_dias integer DEFAULT 0 NOT NULL,
    edad_maxima_horas integer DEFAULT 0 NOT NULL,
    edad_maxima_minutos integer DEFAULT 0 NOT NULL
);


ALTER TABLE ctl_rango_edad OWNER TO simagd;

--
-- Name: TABLE ctl_rango_edad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_rango_edad IS 'Catalogo que contiene rangos de edad aplicables a los formularios dinamicos de consulta y otros.';


--
-- Name: COLUMN ctl_rango_edad.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_rango_edad.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.nombre IS 'Nombre del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_minima_meses; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_minima_meses IS 'Meses minimo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_minima_anios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_minima_anios IS 'Años minimo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_minima_dias; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_minima_dias IS 'Dias minimo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_minima_horas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_minima_horas IS 'Horas minimo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_minima_minutos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_minima_minutos IS 'Minutos minimo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_maxima_anios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_maxima_anios IS 'Años maximo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_maxima_meses; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_maxima_meses IS 'Meses maximo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_maxima_dias; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_maxima_dias IS 'Dias maximo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_maxima_horas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_maxima_horas IS 'Horas maximo del Rango';


--
-- Name: COLUMN ctl_rango_edad.edad_maxima_minutos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_rango_edad.edad_maxima_minutos IS 'Minutos maximo del Rango';


--
-- Name: ctl_rango_edad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_rango_edad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_rango_edad_id_seq OWNER TO simagd;

--
-- Name: ctl_rango_edad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_rango_edad_id_seq OWNED BY ctl_rango_edad.id;


--
-- Name: ctl_sexo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_sexo (
    id integer NOT NULL,
    nombre character varying(20) NOT NULL,
    abreviatura character(1) NOT NULL
);


ALTER TABLE ctl_sexo OWNER TO simagd;

--
-- Name: TABLE ctl_sexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_sexo IS 'Catálogo del sexo del paciente';


--
-- Name: COLUMN ctl_sexo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_sexo.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_sexo.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_sexo.nombre IS 'Nombre del sexo de la persona';


--
-- Name: COLUMN ctl_sexo.abreviatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_sexo.abreviatura IS 'Letra con la que se representara el sexo de una persona';


--
-- Name: ctl_sexo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_sexo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_sexo_id_seq OWNER TO simagd;

--
-- Name: ctl_sexo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_sexo_id_seq OWNED BY ctl_sexo.id;


--
-- Name: ctl_tabla; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_tabla (
    id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    descripcion text,
    tipo_tabla integer DEFAULT 1 NOT NULL,
    tipo_transaccion integer NOT NULL
);


ALTER TABLE ctl_tabla OWNER TO simagd;

--
-- Name: TABLE ctl_tabla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_tabla IS 'Tabla que almacena datos sobre otras tablas catalogo, a las cuales se hara referencia.';


--
-- Name: COLUMN ctl_tabla.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tabla.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_tabla.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tabla.nombre IS 'Nombre de la Tabla';


--
-- Name: COLUMN ctl_tabla.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tabla.descripcion IS 'Descripcion de la Tabla';


--
-- Name: COLUMN ctl_tabla.tipo_tabla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tabla.tipo_tabla IS 'Determina si la tabla es de tipo Catalogo (1) o Transaccional (2).';


--
-- Name: ctl_tabla_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_tabla_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tabla_id_seq OWNER TO simagd;

--
-- Name: ctl_tabla_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_tabla_id_seq OWNED BY ctl_tabla.id;


--
-- Name: ctl_tipo_atencion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_tipo_atencion (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL
);


ALTER TABLE ctl_tipo_atencion OWNER TO simagd;

--
-- Name: TABLE ctl_tipo_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_tipo_atencion IS 'Determina los tipos de atención que pueden existir en un establecimiento de salud';


--
-- Name: COLUMN ctl_tipo_atencion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_atencion.id IS 'Llave primaria ';


--
-- Name: COLUMN ctl_tipo_atencion.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_atencion.nombre IS 'Nombre del tipo de atención';


--
-- Name: ctl_tipo_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_tipo_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tipo_atencion_id_seq OWNER TO simagd;

--
-- Name: ctl_tipo_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_tipo_atencion_id_seq OWNED BY ctl_tipo_atencion.id;


--
-- Name: ctl_tipo_campo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_tipo_campo (
    id integer NOT NULL,
    nombre character varying(30) NOT NULL
);


ALTER TABLE ctl_tipo_campo OWNER TO simagd;

--
-- Name: TABLE ctl_tipo_campo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_tipo_campo IS 'Tabla que almacena los tipos de campo (integer, date, ...) disponibles.';


--
-- Name: COLUMN ctl_tipo_campo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_campo.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_tipo_campo.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_campo.nombre IS 'Nombre del Tipo de Campo';


--
-- Name: ctl_tipo_campo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_tipo_campo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tipo_campo_id_seq OWNER TO simagd;

--
-- Name: ctl_tipo_campo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_tipo_campo_id_seq OWNED BY ctl_tipo_campo.id;


--
-- Name: ctl_tipo_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_tipo_establecimiento (
    id integer NOT NULL,
    nombre character varying(150),
    codigo character varying(4)
);


ALTER TABLE ctl_tipo_establecimiento OWNER TO simagd;

--
-- Name: TABLE ctl_tipo_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_tipo_establecimiento IS 'Contiene los tipos de establecimiento que conforman el MINSAL';


--
-- Name: COLUMN ctl_tipo_establecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_establecimiento.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_tipo_establecimiento.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_establecimiento.nombre IS 'Nombre del tipo de establecimiento';


--
-- Name: COLUMN ctl_tipo_establecimiento.codigo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_establecimiento.codigo IS 'Código que distingue al tipo establecimiento';


--
-- Name: ctl_tipo_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_tipo_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tipo_establecimiento_id_seq OWNER TO simagd;

--
-- Name: ctl_tipo_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_tipo_establecimiento_id_seq OWNED BY ctl_tipo_establecimiento.id;


--
-- Name: ctl_tipo_objeto; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_tipo_objeto (
    id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    codigo text,
    aplica_para integer NOT NULL,
    descripcion text
);


ALTER TABLE ctl_tipo_objeto OWNER TO simagd;

--
-- Name: TABLE ctl_tipo_objeto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_tipo_objeto IS 'Representa un Tipo de Objeto a generar en el formulario para una determinada pregunta. (select, checkboxes, etc.)';


--
-- Name: COLUMN ctl_tipo_objeto.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_objeto.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_tipo_objeto.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_objeto.nombre IS 'Nombre de Objeto html';


--
-- Name: COLUMN ctl_tipo_objeto.codigo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_objeto.codigo IS 'Codigo html base del objeto';


--
-- Name: COLUMN ctl_tipo_objeto.aplica_para; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_objeto.aplica_para IS 'Indica si el Tipo de Objeto aplica para Catalogos (1), Campos (2) o Ambos (3).';


--
-- Name: COLUMN ctl_tipo_objeto.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_tipo_objeto.descripcion IS 'Descripcion de Objeto';


--
-- Name: ctl_tipo_objeto_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_tipo_objeto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tipo_objeto_id_seq OWNER TO simagd;

--
-- Name: ctl_tipo_objeto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_tipo_objeto_id_seq OWNED BY ctl_tipo_objeto.id;


--
-- Name: ctl_validacion_campo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE ctl_validacion_campo (
    id integer NOT NULL,
    nombre character varying(30) NOT NULL,
    codigo_validacion text,
    aplica_para integer NOT NULL,
    requiere_comparacion boolean NOT NULL,
    valor_numerico boolean DEFAULT false,
    aplica_item_pool boolean NOT NULL
);


ALTER TABLE ctl_validacion_campo OWNER TO simagd;

--
-- Name: TABLE ctl_validacion_campo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE ctl_validacion_campo IS 'Contiene los tipos de validacion que se pueden realizar sobre campos de formularios.';


--
-- Name: COLUMN ctl_validacion_campo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_validacion_campo.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_validacion_campo.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_validacion_campo.nombre IS 'Nombre de la Validacion';


--
-- Name: COLUMN ctl_validacion_campo.codigo_validacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_validacion_campo.codigo_validacion IS 'Código a ejecutar para realizar la validacion sobre el campo.';


--
-- Name: COLUMN ctl_validacion_campo.aplica_para; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_validacion_campo.aplica_para IS 'Indica si la Validacion aplica para Catalogos (1), Campos (2) o Ambos (3).';


--
-- Name: COLUMN ctl_validacion_campo.requiere_comparacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_validacion_campo.requiere_comparacion IS 'Indica si la Validacion requiere un valor de comparacion (Registrado en frm_validacion_campo_form_item).';


--
-- Name: COLUMN ctl_validacion_campo.valor_numerico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_validacion_campo.valor_numerico IS 'Especifica si el valor contra el cual se debe comparar, o ejecutar la comparacion, debe ser numérico.';


--
-- Name: COLUMN ctl_validacion_campo.aplica_item_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN ctl_validacion_campo.aplica_item_pool IS 'Determina si puede ser utilizado, en caso de ser TRUE, como una validacion que aplica para registros de la tabla frm_form_item_pool que son padres, al momento de crear subitems.';


--
-- Name: ctl_validacion_campo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE ctl_validacion_campo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_validacion_campo_id_seq OWNER TO simagd;

--
-- Name: ctl_validacion_campo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE ctl_validacion_campo_id_seq OWNED BY ctl_validacion_campo.id;


--
-- Name: farm_ajustes; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_ajustes (
    id integer NOT NULL,
    actanumero character varying(60) NOT NULL,
    idmedicina integer NOT NULL,
    idarea integer NOT NULL,
    existencia numeric(11,3) NOT NULL,
    idlote integer NOT NULL,
    fechaajuste date NOT NULL,
    justificacion text NOT NULL,
    idpersonal integer NOT NULL,
    idexistencia integer NOT NULL,
    idestado character(1) DEFAULT 'X'::bpchar NOT NULL,
    fechahoraingreso timestamp without time zone NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_ajustes OWNER TO simagd;

--
-- Name: TABLE farm_ajustes; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_ajustes IS 'Contiene los ajustes de existencias realizadas a las Farmacia';


--
-- Name: COLUMN farm_ajustes.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_ajustes.actanumero; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.actanumero IS 'Numero de Acta legal del ajuste realizado';


--
-- Name: COLUMN farm_ajustes.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idmedicina IS 'Llave foranea del catalogo productos';


--
-- Name: COLUMN farm_ajustes.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idarea IS 'Llave foranea de area farmacia';


--
-- Name: COLUMN farm_ajustes.existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.existencia IS 'Existencia de ajuste ingresada al sistema';


--
-- Name: COLUMN farm_ajustes.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idlote IS 'Llave foranea de area farmacia';


--
-- Name: COLUMN farm_ajustes.fechaajuste; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.fechaajuste IS 'Fecha en que se elaboro el ajuste';


--
-- Name: COLUMN farm_ajustes.justificacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.justificacion IS 'Justificacion valida del ajuste realizado';


--
-- Name: COLUMN farm_ajustes.idpersonal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idpersonal IS 'IdPersonal que ingresa el registro';


--
-- Name: COLUMN farm_ajustes.idexistencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idexistencia IS 'IdExistencia, contiene la llave de farm_medicinaexistenciaxarea';


--
-- Name: COLUMN farm_ajustes.idestado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idestado IS 'X: en ingreso, D: Digitados';


--
-- Name: COLUMN farm_ajustes.fechahoraingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.fechahoraingreso IS 'Fecha y hora de ingreso del registro';


--
-- Name: COLUMN farm_ajustes.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idestablecimiento IS 'Codigo de Establecimiento, conectado a establecimientios';


--
-- Name: COLUMN farm_ajustes.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_ajustes.idmodalidad IS 'Indicador de Modalidades, conectado a modalidades';


--
-- Name: farm_ajustes_idajuste_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_ajustes_idajuste_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_ajustes_idajuste_seq OWNER TO simagd;

--
-- Name: farm_ajustes_idajuste_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_ajustes_idajuste_seq OWNED BY farm_ajustes.id;


--
-- Name: farm_bitacoraentregamedicamento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_bitacoraentregamedicamento (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    existencia numeric(11,3) NOT NULL,
    idlote integer NOT NULL,
    identregaorigen integer,
    fechahoraingreso timestamp without time zone NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_bitacoraentregamedicamento OWNER TO simagd;

--
-- Name: TABLE farm_bitacoraentregamedicamento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_bitacoraentregamedicamento IS 'Bitacora de ingreso de existencias en Bodega de Farmacia';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.id IS 'Llave primaroa de la tabla Bitacora entrega medicamento';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.idmedicina IS 'Medicina, conectado con catalogo';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.existencia IS 'Valor numerico de la existencia entrante';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.idlote IS 'Lote, conectado a Lotes';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.identregaorigen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.identregaorigen IS 'Hace referencia a campo original de la tabla entregas';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.fechahoraingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.fechahoraingreso IS 'Fecha y hora de ingreso del registro';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN farm_bitacoraentregamedicamento.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoraentregamedicamento.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: farm_bitacoraentregamedicamento_identrega_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_bitacoraentregamedicamento_identrega_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_bitacoraentregamedicamento_identrega_seq OWNER TO simagd;

--
-- Name: farm_bitacoraentregamedicamento_identrega_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_bitacoraentregamedicamento_identrega_seq OWNED BY farm_bitacoraentregamedicamento.id;


--
-- Name: farm_bitacoramedicinaexistenciaxarea; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_bitacoramedicinaexistenciaxarea (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    idarea integer NOT NULL,
    existencia numeric(11,3) NOT NULL,
    idlote integer NOT NULL,
    idexistenciaorigen integer,
    fechahoraingreso timestamp without time zone NOT NULL,
    idpersonal integer NOT NULL,
    idtransferencia integer DEFAULT 0 NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_bitacoramedicinaexistenciaxarea OWNER TO simagd;

--
-- Name: TABLE farm_bitacoramedicinaexistenciaxarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_bitacoramedicinaexistenciaxarea IS 'Bitacora de despacho de medicamento de bodega a farmacias';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idmedicina IS 'Llave foranea del catalogo de productos';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idarea IS 'Llave foranea de areas de farmacia';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.existencia IS 'Valo numerico de existencia enviado a las areas de la farmacia';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idlote IS 'Lote, conectado con lotes';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idexistenciaorigen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idexistenciaorigen IS 'ExistenciaOrigen, Id de la tabla original existencias por area';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.fechahoraingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.fechahoraingreso IS 'Fecha y hora de ingreso de los datos';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idpersonal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idpersonal IS 'IdPersonal, que es encargado de ingresar movimientos de existencias';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idtransferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idtransferencia IS 'Conectado a tabla tranferencias para determinar si el movimiento es una tranferencia interna o entrada desde bodega';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idestablecimiento IS 'Codigo de Establecimiento, ';


--
-- Name: COLUMN farm_bitacoramedicinaexistenciaxarea.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_bitacoramedicinaexistenciaxarea.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: farm_bitacoramedicinaexistenciaxarea_idexistencia_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_bitacoramedicinaexistenciaxarea_idexistencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_bitacoramedicinaexistenciaxarea_idexistencia_seq OWNER TO simagd;

--
-- Name: farm_bitacoramedicinaexistenciaxarea_idexistencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_bitacoramedicinaexistenciaxarea_idexistencia_seq OWNED BY farm_bitacoramedicinaexistenciaxarea.id;


--
-- Name: farm_catalogoproductos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_catalogoproductos (
    id integer NOT NULL,
    codigo character varying(8) NOT NULL,
    idtipoproducto integer,
    idunidadmedida integer DEFAULT 0 NOT NULL,
    nombre text NOT NULL,
    niveluso integer,
    concentracion character varying(382),
    formafarmaceutica character varying(91),
    presentacion character(150),
    prioridad integer,
    precioactual numeric(20,3),
    aplicalote integer DEFAULT 0,
    existenciaactual numeric(15,3) DEFAULT 0,
    especificacionestecnicas text,
    codigonacionesunidas character varying(20),
    pertenecelistadooficial integer,
    estadoproducto integer DEFAULT 1,
    observacion text,
    auusuariocreacion character(15),
    aufechacreacion timestamp without time zone,
    auusuariomodificacion character varying(15),
    aufechamodificacion timestamp without time zone,
    estasincronizada integer DEFAULT 0,
    idestablecimiento integer,
    clasificacion character(1),
    areatecnica integer,
    tipouaci integer,
    idespecificogasto integer,
    ultimoprecio numeric(20,3),
    idterapeutico integer DEFAULT 0,
    idhospital integer DEFAULT 0,
    idestado character(1) DEFAULT 'H'::bpchar
);


ALTER TABLE farm_catalogoproductos OWNER TO simagd;

--
-- Name: TABLE farm_catalogoproductos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_catalogoproductos IS 'Catalogo general de medicamentos';


--
-- Name: COLUMN farm_catalogoproductos.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.id IS 'Llave de la tabla';


--
-- Name: COLUMN farm_catalogoproductos.codigo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.codigo IS 'codigo compuesto del medicamento';


--
-- Name: COLUMN farm_catalogoproductos.idtipoproducto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.idtipoproducto IS 'tipo de producto';


--
-- Name: COLUMN farm_catalogoproductos.idunidadmedida; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.idunidadmedida IS 'pk foranea de la tabla farm_unidadmedida';


--
-- Name: COLUMN farm_catalogoproductos.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.nombre IS 'Nombre del medicamento';


--
-- Name: COLUMN farm_catalogoproductos.niveluso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.niveluso IS 'Nivel de uso del medicamento';


--
-- Name: COLUMN farm_catalogoproductos.concentracion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.concentracion IS 'concentracion del medicamento';


--
-- Name: COLUMN farm_catalogoproductos.formafarmaceutica; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.formafarmaceutica IS 'forma farmauceituca del medicamto';


--
-- Name: COLUMN farm_catalogoproductos.presentacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.presentacion IS 'Presentacion del medicamento';


--
-- Name: COLUMN farm_catalogoproductos.prioridad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductos.prioridad IS 'prioridad del medicamento';


--
-- Name: farm_catalogoproductos_idmedicina_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_catalogoproductos_idmedicina_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_catalogoproductos_idmedicina_seq OWNER TO simagd;

--
-- Name: farm_catalogoproductos_idmedicina_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_catalogoproductos_idmedicina_seq OWNED BY farm_catalogoproductos.id;


--
-- Name: farm_catalogoproductosxestablecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_catalogoproductosxestablecimiento (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    idestablecimiento integer NOT NULL,
    condicion character(1) DEFAULT 'H'::bpchar NOT NULL,
    estupefaciente character(1) DEFAULT 'N'::bpchar NOT NULL,
    idmodalidad integer NOT NULL,
    idusuarioreg integer NOT NULL,
    fechahorareg timestamp without time zone NOT NULL,
    idusuariomod integer,
    fechahoramod timestamp without time zone
);


ALTER TABLE farm_catalogoproductosxestablecimiento OWNER TO simagd;

--
-- Name: TABLE farm_catalogoproductosxestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_catalogoproductosxestablecimiento IS 'levantamiento de medicamentos por hospital';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.idmedicina IS 'Llave foranea de farm_catalogoproductos';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.idestablecimiento IS 'Llave foranea de establecimientos';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.condicion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.condicion IS 'estado de la medicamento ''H'' : Habilitado ''I'': Inhabilitado';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.estupefaciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.estupefaciente IS 'N: No es estupefaciente S: Es estupefaciente';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.idmodalidad IS 'Llave foranea de modalidades, Indicador de Modalidades';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.idusuarioreg IS 'Usuario que ingresa el registro';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.fechahorareg IS 'Fecha y hora que se ingresa el regitro';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.idusuariomod IS 'Usuario que lo modifica el reguistro';


--
-- Name: COLUMN farm_catalogoproductosxestablecimiento.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_catalogoproductosxestablecimiento.fechahoramod IS 'Fecha y hora que se modifica el registro';


--
-- Name: farm_catalogoproductosxestablecimi_idcatproxestablecimiento_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_catalogoproductosxestablecimi_idcatproxestablecimiento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_catalogoproductosxestablecimi_idcatproxestablecimiento_seq OWNER TO simagd;

--
-- Name: farm_catalogoproductosxestablecimi_idcatproxestablecimiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_catalogoproductosxestablecimi_idcatproxestablecimiento_seq OWNED BY farm_catalogoproductosxestablecimiento.id;


--
-- Name: farm_cierre; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_cierre (
    id integer NOT NULL,
    anocierre integer,
    mescierre character varying(15),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_cierre OWNER TO simagd;

--
-- Name: TABLE farm_cierre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_cierre IS 'Cierre de periodo de introduccion de datos';


--
-- Name: COLUMN farm_cierre.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_cierre.id IS 'Llave primaria';


--
-- Name: COLUMN farm_cierre.anocierre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_cierre.anocierre IS 'Se cierra un anio entero de interaccion de farmacia';


--
-- Name: COLUMN farm_cierre.mescierre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_cierre.mescierre IS 'Se cierra un Mes de movimientos de farmacia';


--
-- Name: COLUMN farm_cierre.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_cierre.idusuarioreg IS 'Usuario que registra el cierre';


--
-- Name: COLUMN farm_cierre.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_cierre.fechahorareg IS 'fecha y hora que se registra el cierre';


--
-- Name: COLUMN farm_cierre.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_cierre.idestablecimiento IS 'Llave foranea de mnt_establecimientos';


--
-- Name: COLUMN farm_cierre.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_cierre.idmodalidad IS 'Llave foranea de mnt_modalidades, Indicador de Modalidades';


--
-- Name: farm_cierre_idcierre_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_cierre_idcierre_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_cierre_idcierre_seq OWNER TO simagd;

--
-- Name: farm_cierre_idcierre_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_cierre_idcierre_seq OWNED BY farm_cierre.id;


--
-- Name: farm_divisores; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_divisores (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    divisormedicina integer NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_divisores OWNER TO simagd;

--
-- Name: TABLE farm_divisores; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_divisores IS 'Unidades de medicamento que se despache en otra unidad de medida';


--
-- Name: COLUMN farm_divisores.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_divisores.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_divisores.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_divisores.idmedicina IS 'Llave foranea de farm_catalogoproductos';


--
-- Name: COLUMN farm_divisores.divisormedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_divisores.divisormedicina IS 'Valor numerico de divisor de presentacion';


--
-- Name: COLUMN farm_divisores.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_divisores.idestablecimiento IS 'Llave foranea de mnt_establecimientos';


--
-- Name: COLUMN farm_divisores.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_divisores.idmodalidad IS 'Llave foranea de mnt_modalidades, Indicador de Modalidades';


--
-- Name: farm_divisores_iddivisor_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_divisores_iddivisor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_divisores_iddivisor_seq OWNER TO simagd;

--
-- Name: farm_divisores_iddivisor_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_divisores_iddivisor_seq OWNED BY farm_divisores.id;


--
-- Name: farm_entregamedicamento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_entregamedicamento (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    existencia numeric(11,3) NOT NULL,
    idlote integer NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_entregamedicamento OWNER TO simagd;

--
-- Name: TABLE farm_entregamedicamento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_entregamedicamento IS 'Ingreso de medicamento proveniente de almacen';


--
-- Name: COLUMN farm_entregamedicamento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_entregamedicamento.id IS 'Llave primaria';


--
-- Name: COLUMN farm_entregamedicamento.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_entregamedicamento.idmedicina IS 'Llave foranea de catalogo de productos';


--
-- Name: COLUMN farm_entregamedicamento.existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_entregamedicamento.existencia IS 'valor numerico de entrada de existencia a farmacia';


--
-- Name: COLUMN farm_entregamedicamento.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_entregamedicamento.idlote IS 'Lote, conectado a Lotes';


--
-- Name: COLUMN farm_entregamedicamento.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_entregamedicamento.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN farm_entregamedicamento.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_entregamedicamento.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: farm_entregamedicamento_identrega_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_entregamedicamento_identrega_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_entregamedicamento_identrega_seq OWNER TO simagd;

--
-- Name: farm_entregamedicamento_identrega_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_entregamedicamento_identrega_seq OWNED BY farm_entregamedicamento.id;


--
-- Name: farm_estados; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_estados (
    id integer NOT NULL,
    idestado character(2) NOT NULL,
    descripcion character varying(50) NOT NULL
);


ALTER TABLE farm_estados OWNER TO simagd;

--
-- Name: COLUMN farm_estados.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_estados.id IS 'Llave primaria de la tabla.';


--
-- Name: COLUMN farm_estados.idestado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_estados.idestado IS 'Estados de las recetas en farm_recetas';


--
-- Name: COLUMN farm_estados.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_estados.descripcion IS 'Descripcion de los estados de las recetas.';


--
-- Name: farm_estados_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_estados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_estados_id_seq OWNER TO simagd;

--
-- Name: farm_estados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_estados_id_seq OWNED BY farm_estados.id;


--
-- Name: farm_lotes; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_lotes (
    id integer NOT NULL,
    lote character varying(60) NOT NULL,
    preciolote numeric(5,2) NOT NULL,
    fechavencimiento date NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_lotes OWNER TO simagd;

--
-- Name: TABLE farm_lotes; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_lotes IS 'Codigo de lotes ingresados al sistema';


--
-- Name: COLUMN farm_lotes.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_lotes.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_lotes.lote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_lotes.lote IS 'Codigo del lote';


--
-- Name: COLUMN farm_lotes.preciolote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_lotes.preciolote IS 'Precio del lote';


--
-- Name: COLUMN farm_lotes.fechavencimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_lotes.fechavencimiento IS 'Fecha de vencimiento del lote';


--
-- Name: COLUMN farm_lotes.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_lotes.idestablecimiento IS 'Codigo del establecimiento.';


--
-- Name: COLUMN farm_lotes.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_lotes.idmodalidad IS 'Indicador de modalidades';


--
-- Name: farm_lotes_idlote_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_lotes_idlote_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_lotes_idlote_seq OWNER TO simagd;

--
-- Name: farm_lotes_idlote_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_lotes_idlote_seq OWNED BY farm_lotes.id;


--
-- Name: farm_medicinadespachada; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_medicinadespachada (
    id integer NOT NULL,
    idmedicinarecetada integer NOT NULL,
    idlote integer NOT NULL,
    cantidaddespachada numeric(11,3) NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_medicinadespachada OWNER TO simagd;

--
-- Name: TABLE farm_medicinadespachada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_medicinadespachada IS 'Medicamento despachado al paciente asi como lote utilizado';


--
-- Name: COLUMN farm_medicinadespachada.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinadespachada.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_medicinadespachada.idmedicinarecetada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinadespachada.idmedicinarecetada IS 'Llave foranea de medicina recetada';


--
-- Name: COLUMN farm_medicinadespachada.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinadespachada.idlote IS 'Llave foranea de lotes';


--
-- Name: COLUMN farm_medicinadespachada.cantidaddespachada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinadespachada.cantidaddespachada IS 'Cantidad de medicamento despachado';


--
-- Name: COLUMN farm_medicinadespachada.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinadespachada.idestablecimiento IS 'Codigo de Establecimiento, conectado con establecimientos';


--
-- Name: COLUMN farm_medicinadespachada.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinadespachada.idmodalidad IS 'Indicador de Modalidades, conectado a modalidades';


--
-- Name: farm_medicinadespachada_idmedicinadespachada_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_medicinadespachada_idmedicinadespachada_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_medicinadespachada_idmedicinadespachada_seq OWNER TO simagd;

--
-- Name: farm_medicinadespachada_idmedicinadespachada_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_medicinadespachada_idmedicinadespachada_seq OWNED BY farm_medicinadespachada.id;


--
-- Name: farm_medicinaexistenciaxarea; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_medicinaexistenciaxarea (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    idarea integer NOT NULL,
    existencia numeric(11,3) NOT NULL,
    idlote integer NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_medicinaexistenciaxarea OWNER TO simagd;

--
-- Name: TABLE farm_medicinaexistenciaxarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_medicinaexistenciaxarea IS 'Existencia de medicamento por area de farmacia';


--
-- Name: COLUMN farm_medicinaexistenciaxarea.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinaexistenciaxarea.id IS 'Llave primaria de la tabla.';


--
-- Name: COLUMN farm_medicinaexistenciaxarea.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinaexistenciaxarea.idmedicina IS 'Llave foranea del catalogo de productos.';


--
-- Name: COLUMN farm_medicinaexistenciaxarea.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinaexistenciaxarea.idarea IS 'Llave foranea de areas de farmacia';


--
-- Name: COLUMN farm_medicinaexistenciaxarea.existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinaexistenciaxarea.existencia IS 'Valo numerico de existencia de las areas de farmacia';


--
-- Name: COLUMN farm_medicinaexistenciaxarea.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinaexistenciaxarea.idlote IS 'Lote, conectado con lotes';


--
-- Name: COLUMN farm_medicinaexistenciaxarea.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinaexistenciaxarea.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN farm_medicinaexistenciaxarea.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinaexistenciaxarea.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: farm_medicinaexistenciaxarea_idexistencia_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_medicinaexistenciaxarea_idexistencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_medicinaexistenciaxarea_idexistencia_seq OWNER TO simagd;

--
-- Name: farm_medicinaexistenciaxarea_idexistencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_medicinaexistenciaxarea_idexistencia_seq OWNED BY farm_medicinaexistenciaxarea.id;


--
-- Name: farm_medicinarecetada; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_medicinarecetada (
    id integer NOT NULL,
    idreceta integer NOT NULL,
    idmedicina integer NOT NULL,
    cantidad numeric(11,3) NOT NULL,
    dosis text NOT NULL,
    fechaentrega date,
    idestado character(1),
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_medicinarecetada OWNER TO simagd;

--
-- Name: TABLE farm_medicinarecetada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_medicinarecetada IS 'Registro de medicamento prescrito por el medico';


--
-- Name: COLUMN farm_medicinarecetada.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_medicinarecetada.idreceta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.idreceta IS 'Receta, Conectado con farm_recetas';


--
-- Name: COLUMN farm_medicinarecetada.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.idmedicina IS 'Medicina, conectado a catalogo de medicamentos';


--
-- Name: COLUMN farm_medicinarecetada.cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.cantidad IS 'Valor numerico de medicamentos recetado';


--
-- Name: COLUMN farm_medicinarecetada.dosis; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.dosis IS 'Dosificacion del medicamentos';


--
-- Name: COLUMN farm_medicinarecetada.fechaentrega; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.fechaentrega IS 'Fecha en la que fue entregado en ventanilla el medicamento';


--
-- Name: COLUMN farm_medicinarecetada.idestado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.idestado IS 'Estado del medicamento, S: Satisfecha I: Insatisfecha';


--
-- Name: COLUMN farm_medicinarecetada.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.idestablecimiento IS 'foranea de establecimientos ';


--
-- Name: COLUMN farm_medicinarecetada.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinarecetada.idmodalidad IS 'Indicador de Modalidades, conectado con modalidades';


--
-- Name: farm_medicinarecetada_idmedicinarecetada_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_medicinarecetada_idmedicinarecetada_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_medicinarecetada_idmedicinarecetada_seq OWNER TO simagd;

--
-- Name: farm_medicinarecetada_idmedicinarecetada_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_medicinarecetada_idmedicinarecetada_seq OWNED BY farm_medicinarecetada.id;


--
-- Name: farm_medicinavencida; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_medicinavencida (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    existencia numeric(11,3) NOT NULL,
    idlote integer NOT NULL,
    idarea integer,
    justificacion text,
    fecha date NOT NULL,
    fechahoraingreso timestamp without time zone NOT NULL,
    idpersonal integer NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_medicinavencida OWNER TO simagd;

--
-- Name: TABLE farm_medicinavencida; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_medicinavencida IS 'Medicamento vencido previo al uso del sistema';


--
-- Name: COLUMN farm_medicinavencida.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.id IS 'llave primaria de la tabla';


--
-- Name: COLUMN farm_medicinavencida.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.idmedicina IS 'Llave foranea de catalogo productos';


--
-- Name: COLUMN farm_medicinavencida.existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.existencia IS 'Valor numerico de la existencia vencida';


--
-- Name: COLUMN farm_medicinavencida.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.idlote IS 'Lote, conectado a Lotes';


--
-- Name: COLUMN farm_medicinavencida.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.idarea IS 'Area, conecta con area de farmacia';


--
-- Name: COLUMN farm_medicinavencida.justificacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.justificacion IS 'Comentario del vencimiento de medicamento';


--
-- Name: COLUMN farm_medicinavencida.fecha; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.fecha IS 'Fecha que se detecto el vencimiento';


--
-- Name: COLUMN farm_medicinavencida.fechahoraingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.fechahoraingreso IS 'Fecha y hora que se ingresa el regitro';


--
-- Name: COLUMN farm_medicinavencida.idpersonal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.idpersonal IS 'Personal que ingresa el registro';


--
-- Name: COLUMN farm_medicinavencida.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN farm_medicinavencida.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_medicinavencida.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: farm_medicinavencida_identrega_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_medicinavencida_identrega_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_medicinavencida_identrega_seq OWNER TO simagd;

--
-- Name: farm_medicinavencida_identrega_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_medicinavencida_identrega_seq OWNED BY farm_medicinavencida.id;


--
-- Name: farm_periododesabastecido; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_periododesabastecido (
    id integer NOT NULL,
    idmedicina integer NOT NULL,
    fechainicio date NOT NULL,
    fechafin date NOT NULL,
    promediorecetas integer NOT NULL,
    promediodiarias numeric(11,3) NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_periododesabastecido OWNER TO simagd;

--
-- Name: TABLE farm_periododesabastecido; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_periododesabastecido IS 'Desabastecimiento de medicamento y promedio de demanda insatisfecha';


--
-- Name: COLUMN farm_periododesabastecido.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_periododesabastecido.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.idmedicina IS 'Llave foranea de catalogo productos';


--
-- Name: COLUMN farm_periododesabastecido.fechainicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.fechainicio IS 'Fecha en la que inicio el desabastecimiento del medicamento';


--
-- Name: COLUMN farm_periododesabastecido.fechafin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.fechafin IS 'Fecha que finaliza el periodo de desabastecimiento';


--
-- Name: COLUMN farm_periododesabastecido.promediorecetas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.promediorecetas IS 'Promedio de recetas insatisfechas (Generado pro medio del sistema)';


--
-- Name: COLUMN farm_periododesabastecido.promediodiarias; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.promediodiarias IS 'Promedio de recetas diarias (Generado por medio del sistema)';


--
-- Name: COLUMN farm_periododesabastecido.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.idestablecimiento IS 'Codigo de establecimiento, conectado a establecimientos';


--
-- Name: COLUMN farm_periododesabastecido.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_periododesabastecido.idmodalidad IS 'Indicador de modalidades';


--
-- Name: farm_periododesabastecido_idperiodo_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_periododesabastecido_idperiodo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_periododesabastecido_idperiodo_seq OWNER TO simagd;

--
-- Name: farm_periododesabastecido_idperiodo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_periododesabastecido_idperiodo_seq OWNED BY farm_periododesabastecido.id;


--
-- Name: farm_recetas; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_recetas (
    id integer NOT NULL,
    idhistorialclinico integer NOT NULL,
    fecha date NOT NULL,
    idestado character(2) NOT NULL,
    idarea integer NOT NULL,
    idpersonal integer,
    numeroreceta integer,
    idpersonalintro integer,
    idfarmacia integer,
    idareaorigen integer,
    correlativo integer,
    correlativoanual character varying(100),
    idpersonaldespacho integer,
    idestablecimiento integer,
    idmodalidad integer
);


ALTER TABLE farm_recetas OWNER TO simagd;

--
-- Name: TABLE farm_recetas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_recetas IS 'Tabla principal de control de recetas vs Historia clinica';


--
-- Name: COLUMN farm_recetas.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_recetas.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idhistorialclinico IS 'Llave foranea de la tabla de seguimiento clinico';


--
-- Name: COLUMN farm_recetas.fecha; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.fecha IS 'Fecha de la receta';


--
-- Name: COLUMN farm_recetas.idestado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idestado IS 'Estado de la receta, coneca con farm_estados';


--
-- Name: COLUMN farm_recetas.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idarea IS 'Area de la receta';


--
-- Name: COLUMN farm_recetas.idpersonal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idpersonal IS 'IdPersonal, quien recepciona la receta en ventanilla';


--
-- Name: COLUMN farm_recetas.numeroreceta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.numeroreceta IS 'Numero correlativo diario de la receta';


--
-- Name: COLUMN farm_recetas.idpersonalintro; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idpersonalintro IS 'IdPersonal, si la receta ha sido digitada por computo de farmacia';


--
-- Name: COLUMN farm_recetas.idfarmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idfarmacia IS 'Farmacia a la que le pertenece la receta.';


--
-- Name: COLUMN farm_recetas.idareaorigen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idareaorigen IS 'Si viene de una area diferente';


--
-- Name: COLUMN farm_recetas.correlativo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.correlativo IS 'Correlativo de digitacion';


--
-- Name: COLUMN farm_recetas.correlativoanual; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.correlativoanual IS 'Correlativo anual de digitacion con diferenciacion de mes';


--
-- Name: COLUMN farm_recetas.idpersonaldespacho; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idpersonaldespacho IS 'Personal que despacha el medicamento en ventanilla';


--
-- Name: COLUMN farm_recetas.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idestablecimiento IS 'Codigo de Establecimiento, relacionado con establecimiento';


--
-- Name: COLUMN farm_recetas.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_recetas.idmodalidad IS 'Indicador de modalidad, conectado con modalidades';


--
-- Name: farm_recetas_idreceta_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_recetas_idreceta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_recetas_idreceta_seq OWNER TO simagd;

--
-- Name: farm_recetas_idreceta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_recetas_idreceta_seq OWNED BY farm_recetas.id;


--
-- Name: farm_transferencias; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_transferencias (
    id integer NOT NULL,
    cantidad numeric(11,3) NOT NULL,
    idmedicina integer NOT NULL,
    idareaorigen integer NOT NULL,
    idareadestino integer,
    justificacion text NOT NULL,
    fechatransferencia date NOT NULL,
    idpersonal integer NOT NULL,
    idestado character(1) NOT NULL,
    cantidad1 numeric(11,3),
    idlote integer NOT NULL,
    cantidad2 numeric(11,3),
    idlote2 integer,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_transferencias OWNER TO simagd;

--
-- Name: TABLE farm_transferencias; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_transferencias IS 'transferencias de medicamentos entre las diferentes areas de la farmacia.';


--
-- Name: COLUMN farm_transferencias.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.id IS 'Llave primaria de la tabla.';


--
-- Name: COLUMN farm_transferencias.cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.cantidad IS 'Valor numero de la existencia transferida';


--
-- Name: COLUMN farm_transferencias.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idmedicina IS 'Medicina, conectado a catalogo de medicamentos';


--
-- Name: COLUMN farm_transferencias.idareaorigen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idareaorigen IS 'Area de farmacia origen de la que se descontaran las existencias a hacer transferidas';


--
-- Name: COLUMN farm_transferencias.idareadestino; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idareadestino IS 'Area de destino en la que se cargaran las existencias a hacer transferidas (Opcional si es area externa a farmacia [Bodega])';


--
-- Name: COLUMN farm_transferencias.justificacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.justificacion IS 'Motivo por el cual se realiza la transferencia de dicho medicamento';


--
-- Name: COLUMN farm_transferencias.fechatransferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.fechatransferencia IS 'Fecha en la que se realizo la transferencia';


--
-- Name: COLUMN farm_transferencias.idpersonal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idpersonal IS 'IdPersonal del quien realiza el ingreso del registro';


--
-- Name: COLUMN farm_transferencias.idestado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idestado IS 'Estado de la transferencia XX: En modificacion  D:Finalizada';


--
-- Name: COLUMN farm_transferencias.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idlote IS 'Idlote de la tabla farm_lotes';


--
-- Name: COLUMN farm_transferencias.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idestablecimiento IS 'Codigo de Establecimiento ';


--
-- Name: COLUMN farm_transferencias.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferencias.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: farm_transferencias_idtransferencia_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_transferencias_idtransferencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_transferencias_idtransferencia_seq OWNER TO simagd;

--
-- Name: farm_transferencias_idtransferencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_transferencias_idtransferencia_seq OWNED BY farm_transferencias.id;


--
-- Name: farm_transferenciashospitales; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_transferenciashospitales (
    id integer NOT NULL,
    cantidad numeric(11,3) NOT NULL,
    idmedicina integer NOT NULL,
    idestablecimientoorigen integer NOT NULL,
    idestablecimientodestino integer NOT NULL,
    justificacion text NOT NULL,
    fechatransferencia timestamp without time zone NOT NULL,
    idpersonal integer NOT NULL,
    idestado character(1) NOT NULL,
    cantidad1 numeric(11,3),
    idlote integer,
    cantidad2 numeric(11,3),
    idlote2 numeric(11,3),
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_transferenciashospitales OWNER TO simagd;

--
-- Name: TABLE farm_transferenciashospitales; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_transferenciashospitales IS 'Transferencia de medicamento hacia otra institucion de salud';


--
-- Name: COLUMN farm_transferenciashospitales.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_transferenciashospitales.cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.cantidad IS 'valor numerico de la existencia transferida';


--
-- Name: COLUMN farm_transferenciashospitales.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idmedicina IS 'Medicina, conectado a catalogo de medicamentos';


--
-- Name: COLUMN farm_transferenciashospitales.idestablecimientoorigen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idestablecimientoorigen IS 'Establecimiento origen, conectado a establecimientos';


--
-- Name: COLUMN farm_transferenciashospitales.idestablecimientodestino; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idestablecimientodestino IS 'Establecimiento a donde es enviada la existencia transferida conectado a establecimiento';


--
-- Name: COLUMN farm_transferenciashospitales.justificacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.justificacion IS 'Comentario de la transferencia';


--
-- Name: COLUMN farm_transferenciashospitales.fechatransferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.fechatransferencia IS 'Fecha que se realizo la transferencia de existencias';


--
-- Name: COLUMN farm_transferenciashospitales.idpersonal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idpersonal IS 'IdPersonal que ingresa el registro de la transferencia';


--
-- Name: COLUMN farm_transferenciashospitales.idestado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idestado IS 'Estado del registro XX: En modificacion D: Finalizado';


--
-- Name: COLUMN farm_transferenciashospitales.cantidad1; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.cantidad1 IS 'Cantidad de medicamentos del lote 1';


--
-- Name: COLUMN farm_transferenciashospitales.idlote; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idlote IS 'Lote 1 conectado con Lotes';


--
-- Name: COLUMN farm_transferenciashospitales.cantidad2; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.cantidad2 IS 'Cantidad de medicamentos del lote 2';


--
-- Name: COLUMN farm_transferenciashospitales.idlote2; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idlote2 IS 'Lote2 conectado con Lotes';


--
-- Name: COLUMN farm_transferenciashospitales.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_transferenciashospitales.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: farm_transferenciashospitales_idtransferencia_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_transferenciashospitales_idtransferencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_transferenciashospitales_idtransferencia_seq OWNER TO simagd;

--
-- Name: farm_transferenciashospitales_idtransferencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_transferenciashospitales_idtransferencia_seq OWNED BY farm_transferenciashospitales.id;


--
-- Name: farm_unidadmedidas; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_unidadmedidas (
    id integer NOT NULL,
    descripcion character varying(6) NOT NULL,
    descripcionlarga character varying(30),
    unidadescontenidas integer NOT NULL,
    cantidaddecimal integer,
    auusuariocreacion character varying(15),
    aufechacreacion timestamp without time zone,
    auusuariomodificacion character(15),
    aufechamodificacion timestamp without time zone,
    estasincronizada integer
);


ALTER TABLE farm_unidadmedidas OWNER TO simagd;

--
-- Name: TABLE farm_unidadmedidas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_unidadmedidas IS 'Unidad de medida utilizada para los medicamentos';


--
-- Name: COLUMN farm_unidadmedidas.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_unidadmedidas.id IS 'Unidad de medida utilizada para los medicamentos';


--
-- Name: COLUMN farm_unidadmedidas.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_unidadmedidas.descripcion IS 'Contiene las siglas de la unidad de medida';


--
-- Name: COLUMN farm_unidadmedidas.descripcionlarga; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_unidadmedidas.descripcionlarga IS 'Descripcion de la unidad de medida';


--
-- Name: COLUMN farm_unidadmedidas.unidadescontenidas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_unidadmedidas.unidadescontenidas IS 'Cuantas unidad contiene CTO:100 C/U:1 etc';


--
-- Name: farm_unidadmedidas_idunidadmedida_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_unidadmedidas_idunidadmedida_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_unidadmedidas_idunidadmedida_seq OWNER TO simagd;

--
-- Name: farm_unidadmedidas_idunidadmedida_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_unidadmedidas_idunidadmedida_seq OWNED BY farm_unidadmedidas.id;


--
-- Name: farm_usuarios; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE farm_usuarios (
    id integer NOT NULL,
    nick character varying(15) NOT NULL,
    password character varying(32) NOT NULL,
    nombre character varying(75) NOT NULL,
    idfarmacia integer,
    nivel integer NOT NULL,
    datos integer DEFAULT 0 NOT NULL,
    reportes integer DEFAULT 0 NOT NULL,
    administracion integer DEFAULT 0 NOT NULL,
    primeravez integer DEFAULT 1 NOT NULL,
    idarea integer,
    idestadocuenta character(1) DEFAULT 'H'::bpchar NOT NULL,
    idestablecimiento integer NOT NULL,
    conectado character(1) DEFAULT 'N'::bpchar NOT NULL,
    ultimaconexion timestamp without time zone,
    idmodalidad integer NOT NULL
);


ALTER TABLE farm_usuarios OWNER TO simagd;

--
-- Name: TABLE farm_usuarios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE farm_usuarios IS 'Usuarios y niveles de acceso para los usuarios de farmacia';


--
-- Name: COLUMN farm_usuarios.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN farm_usuarios.nick; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.nick IS 'Usuario con el que se hace el inicio de sesion';


--
-- Name: COLUMN farm_usuarios.password; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.password IS 'contraseña de usuarios con MD5';


--
-- Name: COLUMN farm_usuarios.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.nombre IS 'Nombre del usuario';


--
-- Name: COLUMN farm_usuarios.idfarmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.idfarmacia IS 'Farmacia a la que pertenece el usuario';


--
-- Name: COLUMN farm_usuarios.nivel; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.nivel IS 'Nivel de acceso';


--
-- Name: COLUMN farm_usuarios.datos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.datos IS 'Permiso para ingreso/modificacion de datos';


--
-- Name: COLUMN farm_usuarios.reportes; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.reportes IS 'Permisos para generacion de reportes';


--
-- Name: COLUMN farm_usuarios.administracion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.administracion IS 'Permisos especiales de Administracion del sistema';


--
-- Name: COLUMN farm_usuarios.primeravez; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.primeravez IS 'SI es primera vez que inicia sesion para actualizar los datos del usuario';


--
-- Name: COLUMN farm_usuarios.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.idarea IS 'Area de Farmacia al que esta ligado el usuario [Ventanilla]';


--
-- Name: COLUMN farm_usuarios.idestadocuenta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.idestadocuenta IS 'Estado de la cuenta H:Habilitada I:Inhabilitada';


--
-- Name: COLUMN farm_usuarios.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.idestablecimiento IS 'Establecimiento al que pertenece el usuario';


--
-- Name: COLUMN farm_usuarios.ultimaconexion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.ultimaconexion IS 'Fecha y hora de la ultima conexion al sistema';


--
-- Name: COLUMN farm_usuarios.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN farm_usuarios.idmodalidad IS 'Indicador de modalidades';


--
-- Name: farm_usuarios_idpersonal_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE farm_usuarios_idpersonal_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE farm_usuarios_idpersonal_seq OWNER TO simagd;

--
-- Name: farm_usuarios_idpersonal_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE farm_usuarios_idpersonal_seq OWNED BY farm_usuarios.id;


--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE fos_user_group (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    roles text NOT NULL
);


ALTER TABLE fos_user_group OWNER TO simagd;

--
-- Name: TABLE fos_user_group; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE fos_user_group IS 'Maneja los grupo de roles para el BUNDLE SONATAADMINBUNDLE de symfony';


--
-- Name: COLUMN fos_user_group.roles; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN fos_user_group.roles IS '(DC2Type:array)';


--
-- Name: fos_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE fos_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_group_id_seq OWNER TO simagd;

--
-- Name: fos_user_user; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE fos_user_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255),
    email character varying(255),
    email_canonical character varying(255),
    enabled boolean,
    salt character varying(255),
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean,
    expired boolean,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text,
    credentials_expired boolean,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    date_of_birth timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    firstname character varying(64) DEFAULT NULL::character varying,
    lastname character varying(64) DEFAULT NULL::character varying,
    website character varying(64) DEFAULT NULL::character varying,
    biography character varying(255) DEFAULT NULL::character varying,
    gender character varying(1) DEFAULT NULL::character varying,
    locale character varying(8) DEFAULT NULL::character varying,
    timezone character varying(64) DEFAULT NULL::character varying,
    phone character varying(64) DEFAULT NULL::character varying,
    facebook_uid character varying(255) DEFAULT NULL::character varying,
    facebook_name character varying(255) DEFAULT NULL::character varying,
    facebook_data text,
    twitter_uid character varying(255) DEFAULT NULL::character varying,
    twitter_name character varying(255) DEFAULT NULL::character varying,
    twitter_data text,
    gplus_uid character varying(255) DEFAULT NULL::character varying,
    gplus_name character varying(255) DEFAULT NULL::character varying,
    gplus_data text,
    token character varying(255) DEFAULT NULL::character varying,
    two_step_code character varying(255) DEFAULT NULL::character varying,
    id_establecimiento integer,
    id_empleado integer,
    modulo character varying(4),
    id_area_mod_estab integer,
    nivel smallint,
    grupo smallint,
    id_farmacia integer,
    datos integer,
    reportes integer,
    administracion integer,
    primeravez integer,
    conectado character(1),
    id_modalidad_estab integer,
    id_area integer
);


ALTER TABLE fos_user_user OWNER TO simagd;

--
-- Name: TABLE fos_user_user; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE fos_user_user IS 'Maneja los usuarios tanto para los módulos en Symfony como para los de PHP puro';


--
-- Name: COLUMN fos_user_user.roles; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN fos_user_user.roles IS '(DC2Type:array)';


--
-- Name: COLUMN fos_user_user.facebook_data; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN fos_user_user.facebook_data IS '(DC2Type:json)';


--
-- Name: COLUMN fos_user_user.twitter_data; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN fos_user_user.twitter_data IS '(DC2Type:json)';


--
-- Name: COLUMN fos_user_user.gplus_data; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN fos_user_user.gplus_data IS '(DC2Type:json)';


--
-- Name: fos_user_user_group; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE fos_user_user_group (
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE fos_user_user_group OWNER TO simagd;

--
-- Name: TABLE fos_user_user_group; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE fos_user_user_group IS 'Tabla intermedia para saber que usuarios poseen que grupos dentro de los modulos con Symfony';


--
-- Name: fos_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE fos_user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_user_id_seq OWNER TO simagd;

--
-- Name: frm_form_item; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_form_item (
    id integer NOT NULL,
    nombre_descriptivo text NOT NULL,
    tipo_origen integer NOT NULL,
    id_tipo_objeto integer NOT NULL,
    mensaje_ayuda text,
    inscripcion integer,
    validacion_especial text,
    activo boolean DEFAULT true NOT NULL,
    fecha_inicio date DEFAULT ('now'::text)::date NOT NULL,
    fecha_fin date
);


ALTER TABLE frm_form_item OWNER TO simagd;

--
-- Name: TABLE frm_form_item; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_form_item IS 'Representa un detemrinado item o pregunta de formularios.';


--
-- Name: COLUMN frm_form_item.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN frm_form_item.nombre_descriptivo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.nombre_descriptivo IS 'Contiene la pregunta a realizar en el formulario.';


--
-- Name: COLUMN frm_form_item.tipo_origen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.tipo_origen IS 'Indica si el Item es de Tipo Catalogo (lista de opciones - 1) o Campo Normal (respuesta libre - 2).';


--
-- Name: COLUMN frm_form_item.id_tipo_objeto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.id_tipo_objeto IS 'Define el tipo de objeto a generar en el formulario (select, checkboxes, etc.)';


--
-- Name: COLUMN frm_form_item.mensaje_ayuda; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.mensaje_ayuda IS 'Mensaje de ayuda para el usuario segun la pregunta (tooltip).';


--
-- Name: COLUMN frm_form_item.validacion_especial; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.validacion_especial IS 'Codigo o condicion a evaluar en la respuesta del usuario.';


--
-- Name: COLUMN frm_form_item.activo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.activo IS 'Determina si es un Item activo o no.';


--
-- Name: COLUMN frm_form_item.fecha_inicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.fecha_inicio IS 'Indica la fecha en que el Item fue creado o activado.';


--
-- Name: COLUMN frm_form_item.fecha_fin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item.fecha_fin IS 'Indica la fecha en que el Item fue desactivado.';


--
-- Name: frm_form_item_catalogo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_form_item_catalogo (
    id integer NOT NULL,
    id_form_item integer NOT NULL,
    id_catalogo integer NOT NULL,
    condicion_habilitacion integer DEFAULT 1 NOT NULL
);


ALTER TABLE frm_form_item_catalogo OWNER TO simagd;

--
-- Name: TABLE frm_form_item_catalogo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_form_item_catalogo IS 'Representa un item de formularios de tipo catalogo, es decir, que presenta opciones o respuestas predefinidas.';


--
-- Name: COLUMN frm_form_item_catalogo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_catalogo.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN frm_form_item_catalogo.id_form_item; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_catalogo.id_form_item IS 'Item de referencia para el item catalogo';


--
-- Name: COLUMN frm_form_item_catalogo.id_catalogo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_catalogo.id_catalogo IS 'Indica el catalogo que contiene las opciones o respuestas predefinidas a mostrar al usuario.';


--
-- Name: COLUMN frm_form_item_catalogo.condicion_habilitacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_catalogo.condicion_habilitacion IS 'Indica la condicion utilizada para la seleccion o habilitacion de registros de catalogos. Ej: Todos, Todos Excepto, Solamente, etc.';


--
-- Name: frm_form_item_catalogo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_form_item_catalogo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_form_item_catalogo_id_seq OWNER TO simagd;

--
-- Name: frm_form_item_catalogo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_form_item_catalogo_id_seq OWNED BY frm_form_item_catalogo.id;


--
-- Name: frm_form_item_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_form_item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_form_item_id_seq OWNER TO simagd;

--
-- Name: frm_form_item_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_form_item_id_seq OWNED BY frm_form_item.id;


--
-- Name: frm_form_item_pool; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_form_item_pool (
    id integer NOT NULL,
    id_seccion_pool integer NOT NULL,
    id_form_item integer NOT NULL,
    id_padre integer,
    validacion_padre integer,
    valor_padre text,
    orden integer NOT NULL
);


ALTER TABLE frm_form_item_pool OWNER TO simagd;

--
-- Name: TABLE frm_form_item_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_form_item_pool IS 'Contiene los diferentes items o preguntas que conforman un pool.';


--
-- Name: COLUMN frm_form_item_pool.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_pool.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_form_item_pool.id_seccion_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_pool.id_seccion_pool IS 'Seccion en la que sera incluido el Item';


--
-- Name: COLUMN frm_form_item_pool.id_form_item; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_pool.id_form_item IS 'Item que esta siendo incluido en la seccion';


--
-- Name: COLUMN frm_form_item_pool.id_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_pool.id_padre IS 'Determina si el Item depende de otro, en la seccion actual, para ser mostrado.';


--
-- Name: COLUMN frm_form_item_pool.validacion_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_pool.validacion_padre IS 'Representa la condicion que el padre debe cumplir (en conjunto con valor_padre) para que el item sea mostrado.';


--
-- Name: COLUMN frm_form_item_pool.valor_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_pool.valor_padre IS 'Orden del Item o pregunta dentro del pool.';


--
-- Name: COLUMN frm_form_item_pool.orden; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_item_pool.orden IS 'Orden del Item o pregunta dentro del pool.';


--
-- Name: frm_form_item_pool_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_form_item_pool_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_form_item_pool_id_seq OWNER TO simagd;

--
-- Name: frm_form_item_pool_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_form_item_pool_id_seq OWNED BY frm_form_item_pool.id;


--
-- Name: frm_form_seccion_item; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_form_seccion_item (
    id integer NOT NULL,
    id_form_item_pool integer NOT NULL,
    id_formulario_seccion_pool integer NOT NULL,
    id_grupo_insercion integer NOT NULL,
    campo_destino text NOT NULL
);


ALTER TABLE frm_form_seccion_item OWNER TO simagd;

--
-- Name: TABLE frm_form_seccion_item; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_form_seccion_item IS 'Determina el Campo asociado a un determinado Item de una determinada Seccion del Formulario, y el Grupo de Insercion al cual pertenece.';


--
-- Name: COLUMN frm_form_seccion_item.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_seccion_item.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_form_seccion_item.id_form_item_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_seccion_item.id_form_item_pool IS 'Item asociado.';


--
-- Name: COLUMN frm_form_seccion_item.id_formulario_seccion_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_seccion_item.id_formulario_seccion_pool IS 'Seccion o Pool del Formulario asociada al Item.';


--
-- Name: COLUMN frm_form_seccion_item.id_grupo_insercion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_seccion_item.id_grupo_insercion IS 'Grupo de Insercion al cual pertenece.';


--
-- Name: COLUMN frm_form_seccion_item.campo_destino; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_form_seccion_item.campo_destino IS 'Campo de Destino de la Data obtenida del Item o Pregunta, segun la Tabla Destino del Grupo de Insercion.';


--
-- Name: frm_form_seccion_item_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_form_seccion_item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_form_seccion_item_id_seq OWNER TO simagd;

--
-- Name: frm_form_seccion_item_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_form_seccion_item_id_seq OWNED BY frm_form_seccion_item.id;


--
-- Name: frm_formulario; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_formulario (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    codigo character varying(10) NOT NULL,
    descripcion text,
    activo boolean DEFAULT true NOT NULL,
    fecha_inicio date DEFAULT ('now'::text)::date NOT NULL,
    fecha_fin date,
    publicado boolean DEFAULT false NOT NULL,
    fecha_publicacion date,
    config_guardado boolean DEFAULT false
);


ALTER TABLE frm_formulario OWNER TO simagd;

--
-- Name: TABLE frm_formulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_formulario IS 'Contiene los diversos Formularios Dinamicos creados.';


--
-- Name: COLUMN frm_formulario.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_formulario.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.nombre IS 'Nombre del Formulario';


--
-- Name: COLUMN frm_formulario.codigo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.codigo IS 'Codigo asignado al Formulario por el comite de creacion. (no generado automaticamente)';


--
-- Name: COLUMN frm_formulario.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.descripcion IS 'Descripcion del Formulario.';


--
-- Name: COLUMN frm_formulario.activo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.activo IS 'Determina si es un formulario activo o no (no vigente).';


--
-- Name: COLUMN frm_formulario.fecha_inicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.fecha_inicio IS 'Indica la fecha en que el formulario fue creado o activado.';


--
-- Name: COLUMN frm_formulario.fecha_fin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.fecha_fin IS 'Indica la fecha en que el formulario fue desactivado, es decir que ya no esta vigente.';


--
-- Name: COLUMN frm_formulario.publicado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.publicado IS 'Determina si el formulario ha sido publicado, por lo cual no puede ser modificado.';


--
-- Name: COLUMN frm_formulario.fecha_publicacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.fecha_publicacion IS 'Indica la fecha en que el formulario fue publicado para su utilizacion.';


--
-- Name: COLUMN frm_formulario.config_guardado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario.config_guardado IS 'Indica la fecha en que el formulario fue publicado para su utilizacion.';


--
-- Name: frm_formulario_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_formulario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_formulario_id_seq OWNER TO simagd;

--
-- Name: frm_formulario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_formulario_id_seq OWNED BY frm_formulario.id;


--
-- Name: frm_formulario_seccion_pool; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_formulario_seccion_pool (
    id integer NOT NULL,
    id_formulario integer NOT NULL,
    id_seccion_pool integer NOT NULL,
    id_padre integer,
    orden integer NOT NULL,
    is_collection boolean DEFAULT false NOT NULL
);


ALTER TABLE frm_formulario_seccion_pool OWNER TO simagd;

--
-- Name: TABLE frm_formulario_seccion_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_formulario_seccion_pool IS 'Registra las diversas Secciones o Pool de Items que conforman el formulario.';


--
-- Name: COLUMN frm_formulario_seccion_pool.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario_seccion_pool.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_formulario_seccion_pool.id_formulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario_seccion_pool.id_formulario IS 'Formulario al que pertenece la Seccion o Pool de Items.';


--
-- Name: COLUMN frm_formulario_seccion_pool.id_seccion_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario_seccion_pool.id_seccion_pool IS 'Seccion o Pool de Items al que se hace referencia.';


--
-- Name: COLUMN frm_formulario_seccion_pool.id_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario_seccion_pool.id_padre IS 'Determina si la Seccion o Pool depende de otra (es Subseccion).';


--
-- Name: COLUMN frm_formulario_seccion_pool.orden; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario_seccion_pool.orden IS 'Determina el orden del pool de items dentro del formulario.';


--
-- Name: COLUMN frm_formulario_seccion_pool.is_collection; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_formulario_seccion_pool.is_collection IS 'Determina si los Items de la Seccion seran tomados como un Collection.';


--
-- Name: frm_formulario_seccion_pool_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_formulario_seccion_pool_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_formulario_seccion_pool_id_seq OWNER TO simagd;

--
-- Name: frm_formulario_seccion_pool_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_formulario_seccion_pool_id_seq OWNED BY frm_formulario_seccion_pool.id;


--
-- Name: frm_grupo_formulario; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_grupo_formulario (
    id integer NOT NULL,
    id_atencion integer NOT NULL,
    id_sexo integer,
    id_rango_edad integer NOT NULL,
    id_condicion_persona integer NOT NULL,
    id_formulario integer NOT NULL
);


ALTER TABLE frm_grupo_formulario OWNER TO simagd;

--
-- Name: TABLE frm_grupo_formulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_grupo_formulario IS 'Define, segun el cumplimiento de los criterios,  el formulario a aplicar a un determinado paciente.';


--
-- Name: COLUMN frm_grupo_formulario.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_formulario.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_grupo_formulario.id_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_formulario.id_atencion IS 'Especialidad a la que aplica el Formulario.';


--
-- Name: COLUMN frm_grupo_formulario.id_sexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_formulario.id_sexo IS 'Sexo al que aplica el Formulario.';


--
-- Name: COLUMN frm_grupo_formulario.id_rango_edad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_formulario.id_rango_edad IS 'Rando de Edad al que aplica el Formulario.';


--
-- Name: COLUMN frm_grupo_formulario.id_condicion_persona; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_formulario.id_condicion_persona IS 'Condicion del Paciente a la que aplica el Formulario.';


--
-- Name: COLUMN frm_grupo_formulario.id_formulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_formulario.id_formulario IS 'Formulario al que se aplican los criterios o condiciones.';


--
-- Name: frm_grupo_formulario_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_grupo_formulario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_grupo_formulario_id_seq OWNER TO simagd;

--
-- Name: frm_grupo_formulario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_grupo_formulario_id_seq OWNED BY frm_grupo_formulario.id;


--
-- Name: frm_grupo_insercion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_grupo_insercion (
    id integer NOT NULL,
    tabla_destino character varying NOT NULL,
    id_formulario integer NOT NULL
);


ALTER TABLE frm_grupo_insercion OWNER TO simagd;

--
-- Name: TABLE frm_grupo_insercion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_grupo_insercion IS 'Representa un grupo de campos que pertenecen a una misma tabla, y que conforman un nuevo registro o insert.';


--
-- Name: COLUMN frm_grupo_insercion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_insercion.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_grupo_insercion.tabla_destino; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_insercion.tabla_destino IS 'Tabla de Destino de la Data, donde se realizara el insert.';


--
-- Name: COLUMN frm_grupo_insercion.id_formulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_grupo_insercion.id_formulario IS 'Formulario al que pertence el Grupo.';


--
-- Name: frm_grupo_insercion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_grupo_insercion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_grupo_insercion_id_seq OWNER TO simagd;

--
-- Name: frm_grupo_insercion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_grupo_insercion_id_seq OWNED BY frm_grupo_insercion.id;


--
-- Name: frm_insercion_dependencia; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_insercion_dependencia (
    id integer NOT NULL,
    id_grupo_insercion_dependiente integer NOT NULL,
    id_grupo_insercion_padre integer NOT NULL,
    campo_destino text NOT NULL,
    campo_origen text NOT NULL
);


ALTER TABLE frm_insercion_dependencia OWNER TO simagd;

--
-- Name: TABLE frm_insercion_dependencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_insercion_dependencia IS 'Determina si la creacion de un registro (Grupo de Insercion), depende de la creacion de otro anteriormente, y el campo con el cual esta asociado algun campo resultante.';


--
-- Name: COLUMN frm_insercion_dependencia.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_dependencia.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_insercion_dependencia.id_grupo_insercion_dependiente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_dependencia.id_grupo_insercion_dependiente IS 'Grupo de Insercion Dependiente.';


--
-- Name: COLUMN frm_insercion_dependencia.id_grupo_insercion_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_dependencia.id_grupo_insercion_padre IS 'Grupo de Insercion Padre o del cual se Depende.';


--
-- Name: COLUMN frm_insercion_dependencia.campo_destino; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_dependencia.campo_destino IS 'Campo Destino de la data, del Grupo Dependiente.';


--
-- Name: COLUMN frm_insercion_dependencia.campo_origen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_dependencia.campo_origen IS 'Campo del Grupo Dependiente, cuya Data que sera copiada o referenciada por el Campo Destino.';


--
-- Name: frm_insercion_dependencia_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_insercion_dependencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_insercion_dependencia_id_seq OWNER TO simagd;

--
-- Name: frm_insercion_dependencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_insercion_dependencia_id_seq OWNED BY frm_insercion_dependencia.id;


--
-- Name: frm_insercion_parametro; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_insercion_parametro (
    id integer NOT NULL,
    nombre text NOT NULL,
    id_grupo_insercion integer NOT NULL,
    campo_destino text NOT NULL
);


ALTER TABLE frm_insercion_parametro OWNER TO simagd;

--
-- Name: TABLE frm_insercion_parametro; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_insercion_parametro IS 'Indica los demas parametros necesarios para crear exitosamente un nuevo registro (Grupo de Insercion) y al Campo asociado al mismo.';


--
-- Name: COLUMN frm_insercion_parametro.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_parametro.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_insercion_parametro.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_parametro.nombre IS 'Nombre del Parametro.';


--
-- Name: COLUMN frm_insercion_parametro.id_grupo_insercion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_parametro.id_grupo_insercion IS 'Grupo de Insercion al cual pertenece.';


--
-- Name: COLUMN frm_insercion_parametro.campo_destino; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_insercion_parametro.campo_destino IS 'Campo de Destino de la Data obtenida, segun la Tabla Destino del Grupo de Insercion.';


--
-- Name: frm_insercion_parametro_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_insercion_parametro_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_insercion_parametro_id_seq OWNER TO simagd;

--
-- Name: frm_insercion_parametro_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_insercion_parametro_id_seq OWNED BY frm_insercion_parametro.id;


--
-- Name: frm_item_catalogo_reg; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_item_catalogo_reg (
    id integer NOT NULL,
    id_form_item_catalogo integer NOT NULL,
    id_registro integer NOT NULL,
    indica_alerta boolean DEFAULT false NOT NULL
);


ALTER TABLE frm_item_catalogo_reg OWNER TO simagd;

--
-- Name: TABLE frm_item_catalogo_reg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_item_catalogo_reg IS 'Contiene los Id de los registros a mostrar del catalogo referenciado por el item.';


--
-- Name: COLUMN frm_item_catalogo_reg.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_item_catalogo_reg.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN frm_item_catalogo_reg.id_form_item_catalogo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_item_catalogo_reg.id_form_item_catalogo IS 'Hace referencia al Item Catalogo';


--
-- Name: COLUMN frm_item_catalogo_reg.id_registro; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_item_catalogo_reg.id_registro IS 'Contiene el Id del registro habilitado del catalogo.';


--
-- Name: COLUMN frm_item_catalogo_reg.indica_alerta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_item_catalogo_reg.indica_alerta IS 'Indica si el registro del catalogo referenciado se mostrara como alerta.';


--
-- Name: frm_item_catalogo_reg_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_item_catalogo_reg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_item_catalogo_reg_id_seq OWNER TO simagd;

--
-- Name: frm_item_catalogo_reg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_item_catalogo_reg_id_seq OWNED BY frm_item_catalogo_reg.id;


--
-- Name: frm_seccion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_seccion (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    descripcion text
);


ALTER TABLE frm_seccion OWNER TO simagd;

--
-- Name: TABLE frm_seccion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_seccion IS 'Seccion que es estandar para diversos formularios (Ej. Datos Personales).';


--
-- Name: COLUMN frm_seccion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN frm_seccion.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion.nombre IS 'Nombre de la Seccion';


--
-- Name: COLUMN frm_seccion.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion.descripcion IS 'Descripcion de la Seccion';


--
-- Name: frm_seccion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_seccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_seccion_id_seq OWNER TO simagd;

--
-- Name: frm_seccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_seccion_id_seq OWNED BY frm_seccion.id;


--
-- Name: frm_seccion_pool; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_seccion_pool (
    id integer NOT NULL,
    id_seccion integer NOT NULL,
    nombre character varying(100) NOT NULL,
    descripcion text,
    activo boolean DEFAULT true NOT NULL,
    fecha_inicio date DEFAULT ('now'::text)::date NOT NULL,
    fecha_fin date
);


ALTER TABLE frm_seccion_pool OWNER TO simagd;

--
-- Name: TABLE frm_seccion_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_seccion_pool IS 'Representa una coleccion o pool conformado por diversos items o preguntas, pertenecientes a una determinada seccion de formulario.';


--
-- Name: COLUMN frm_seccion_pool.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion_pool.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN frm_seccion_pool.id_seccion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion_pool.id_seccion IS 'Seccion General a la que pertenece.';


--
-- Name: COLUMN frm_seccion_pool.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion_pool.nombre IS 'Nombre especifico del Pool.';


--
-- Name: COLUMN frm_seccion_pool.activo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion_pool.activo IS 'Determina si es una Seccion activo o no.';


--
-- Name: COLUMN frm_seccion_pool.fecha_inicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion_pool.fecha_inicio IS 'Indica la fecha en que la Seccion fue creada o activada.';


--
-- Name: COLUMN frm_seccion_pool.fecha_fin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_seccion_pool.fecha_fin IS 'Indica la fecha en que la seccion fue desactivada.';


--
-- Name: frm_seccion_pool_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_seccion_pool_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_seccion_pool_id_seq OWNER TO simagd;

--
-- Name: frm_seccion_pool_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_seccion_pool_id_seq OWNED BY frm_seccion_pool.id;


--
-- Name: frm_validacion_campo_form_item; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE frm_validacion_campo_form_item (
    id integer NOT NULL,
    id_form_item integer NOT NULL,
    id_validacion_campo integer NOT NULL,
    valor_comparacion text
);


ALTER TABLE frm_validacion_campo_form_item OWNER TO simagd;

--
-- Name: TABLE frm_validacion_campo_form_item; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE frm_validacion_campo_form_item IS 'Registra las diferentes validaciones correspondientes a un Item.';


--
-- Name: COLUMN frm_validacion_campo_form_item.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_validacion_campo_form_item.id IS 'Identificador o Llave Primaria.';


--
-- Name: COLUMN frm_validacion_campo_form_item.id_form_item; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_validacion_campo_form_item.id_form_item IS 'Item al que se hace referencia.';


--
-- Name: COLUMN frm_validacion_campo_form_item.id_validacion_campo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_validacion_campo_form_item.id_validacion_campo IS 'Validacion aplicada al Item.';


--
-- Name: COLUMN frm_validacion_campo_form_item.valor_comparacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN frm_validacion_campo_form_item.valor_comparacion IS 'Valor contra el cual se compara (en caso de que ctl_validacion_campo requiera comparacion).';


--
-- Name: frm_validacion_campo_form_item_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE frm_validacion_campo_form_item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE frm_validacion_campo_form_item_id_seq OWNER TO simagd;

--
-- Name: frm_validacion_campo_form_item_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE frm_validacion_campo_form_item_id_seq OWNED BY frm_validacion_campo_form_item.id;


--
-- Name: img_bloqueo_agenda; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_bloqueo_agenda (
    id integer NOT NULL,
    id_empleado_registra integer NOT NULL,
    fecha_creacion timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    id_area_servicio_diagnostico integer,
    id_radiologo_bloqueo integer,
    titulo character varying(75) DEFAULT 'Horario Bloqueado'::character varying,
    descripcion character varying(255) DEFAULT 'Este horario se encuentra bloqueado, no puede programar citas en este intervalo'::character varying,
    dia_completo boolean DEFAULT false,
    fecha_inicio date NOT NULL,
    fecha_fin date NOT NULL,
    hora_inicio time without time zone NOT NULL,
    hora_fin time without time zone NOT NULL,
    color character varying(15) DEFAULT 'yellow'::character varying,
    id_user_reg integer NOT NULL,
    id_user_mod integer,
    fecha_ultima_edicion timestamp without time zone,
    id_establecimiento integer NOT NULL
);


ALTER TABLE img_bloqueo_agenda OWNER TO simagd;

--
-- Name: img_bloqueo_agenda_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_bloqueo_agenda_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_bloqueo_agenda_id_seq OWNER TO simagd;

--
-- Name: img_bloqueo_agenda_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_bloqueo_agenda_id_seq OWNED BY img_bloqueo_agenda.id;


--
-- Name: img_cita; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_cita (
    id bigint NOT NULL,
    id_tecnologo_programado integer,
    id_configuracion_agenda integer,
    id_solicitud_estudio bigint,
    id_responsable_autoriza integer,
    id_user_reprg integer,
    id_user_prg integer NOT NULL,
    id_empleado integer NOT NULL,
    id_establecimiento integer NOT NULL,
    id_estado_cita smallint NOT NULL,
    reprogramada boolean DEFAULT false,
    incidencias character varying(255),
    observaciones character varying(255),
    razon_anulada character varying(150),
    fecha_creacion timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_confirmacion timestamp without time zone,
    fecha_reprogramacion timestamp without time zone,
    necesita_autorizacion boolean DEFAULT false,
    cita_autorizada boolean DEFAULT false,
    nombre_responsable_autoriza character(75),
    dia_completo boolean DEFAULT false,
    fecha_hora_inicio timestamp without time zone NOT NULL,
    fecha_hora_fin timestamp without time zone NOT NULL,
    color character varying(15) DEFAULT '#31708f'::character varying,
    fecha_hora_inicio_anterior timestamp without time zone,
    fecha_hora_fin_anterior timestamp without time zone
);


ALTER TABLE img_cita OWNER TO simagd;

--
-- Name: img_cita_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_cita_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_cita_id_seq OWNER TO simagd;

--
-- Name: img_cita_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_cita_id_seq OWNED BY img_cita.id;


--
-- Name: img_ctl_campo_autocomplementar; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_campo_autocomplementar (
    id smallint NOT NULL,
    nombre character varying(50) NOT NULL,
    codigo character(4) NOT NULL,
    descripcion character varying(255),
    nombre_campo character varying(50) DEFAULT 'datos_clinicos'::character varying NOT NULL
);


ALTER TABLE img_ctl_campo_autocomplementar OWNER TO simagd;

--
-- Name: img_ctl_campo_autocomplementar_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_campo_autocomplementar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_campo_autocomplementar_id_seq OWNER TO simagd;

--
-- Name: img_ctl_campo_autocomplementar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_campo_autocomplementar_id_seq OWNED BY img_ctl_campo_autocomplementar.id;


--
-- Name: img_ctl_configuracion_agenda; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_configuracion_agenda (
    id integer NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    id_area_examen_estab integer NOT NULL,
    maximo_citas_dia smallint DEFAULT 15,
    maximo_citas_turno smallint,
    maximo_citas_hora smallint,
    maximo_citas_medico smallint
);


ALTER TABLE img_ctl_configuracion_agenda OWNER TO simagd;

--
-- Name: img_ctl_configuracion_agenda_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_configuracion_agenda_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_configuracion_agenda_id_seq OWNER TO simagd;

--
-- Name: img_ctl_configuracion_agenda_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_configuracion_agenda_id_seq OWNED BY img_ctl_configuracion_agenda.id;


--
-- Name: img_ctl_estado_cita; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_estado_cita (
    id smallint NOT NULL,
    nombre_estado character(35) NOT NULL,
    codigo character(3) NOT NULL,
    estilo_presentacion character(15) DEFAULT 'element-v2'::bpchar
);


ALTER TABLE img_ctl_estado_cita OWNER TO simagd;

--
-- Name: img_ctl_estado_cita_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_estado_cita_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_estado_cita_id_seq OWNER TO simagd;

--
-- Name: img_ctl_estado_cita_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_estado_cita_id_seq OWNED BY img_ctl_estado_cita.id;


--
-- Name: img_ctl_estado_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_estado_diagnostico (
    id smallint NOT NULL,
    nombre_estado character(35) NOT NULL,
    codigo character(3) NOT NULL,
    estilo_presentacion character(15) DEFAULT 'primary-v2'::bpchar
);


ALTER TABLE img_ctl_estado_diagnostico OWNER TO simagd;

--
-- Name: img_ctl_estado_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_estado_diagnostico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_estado_diagnostico_id_seq OWNER TO simagd;

--
-- Name: img_ctl_estado_diagnostico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_estado_diagnostico_id_seq OWNED BY img_ctl_estado_diagnostico.id;


--
-- Name: img_ctl_estado_lectura; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_estado_lectura (
    id smallint NOT NULL,
    nombre_estado character(35),
    codigo character(3) NOT NULL,
    estilo_presentacion character(15) DEFAULT 'primary-v2'::bpchar
);


ALTER TABLE img_ctl_estado_lectura OWNER TO simagd;

--
-- Name: img_ctl_estado_lectura_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_estado_lectura_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_estado_lectura_id_seq OWNER TO simagd;

--
-- Name: img_ctl_estado_lectura_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_estado_lectura_id_seq OWNED BY img_ctl_estado_lectura.id;


--
-- Name: img_ctl_estado_procedimiento_realizado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_estado_procedimiento_realizado (
    id smallint NOT NULL,
    nombre_estado character(35) NOT NULL,
    codigo character(3) NOT NULL,
    estilo_presentacion character(15) DEFAULT 'primary-v2'::bpchar
);


ALTER TABLE img_ctl_estado_procedimiento_realizado OWNER TO simagd;

--
-- Name: img_ctl_estado_procedimiento_realizado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_estado_procedimiento_realizado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_estado_procedimiento_realizado_id_seq OWNER TO simagd;

--
-- Name: img_ctl_estado_procedimiento_realizado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_estado_procedimiento_realizado_id_seq OWNED BY img_ctl_estado_procedimiento_realizado.id;


--
-- Name: img_ctl_estado_solicitud; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_estado_solicitud (
    id smallint NOT NULL,
    nombre_estado character(35) NOT NULL,
    codigo character(3) NOT NULL,
    estilo_presentacion character(15) DEFAULT 'primary-v2'::bpchar
);


ALTER TABLE img_ctl_estado_solicitud OWNER TO simagd;

--
-- Name: img_ctl_estado_solicitud_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_estado_solicitud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_estado_solicitud_id_seq OWNER TO simagd;

--
-- Name: img_ctl_estado_solicitud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_estado_solicitud_id_seq OWNED BY img_ctl_estado_solicitud.id;


--
-- Name: img_ctl_forma_contacto; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_forma_contacto (
    id smallint NOT NULL,
    nombre character(35) DEFAULT 'Teléfono Casa'::bpchar NOT NULL
);


ALTER TABLE img_ctl_forma_contacto OWNER TO simagd;

--
-- Name: img_ctl_forma_contacto_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_forma_contacto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_forma_contacto_id_seq OWNER TO simagd;

--
-- Name: img_ctl_forma_contacto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_forma_contacto_id_seq OWNED BY img_ctl_forma_contacto.id;


--
-- Name: img_ctl_grupo_material; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_grupo_material (
    id smallint NOT NULL,
    nombre character varying(255) NOT NULL,
    codigo character(4),
    descripcion text
);


ALTER TABLE img_ctl_grupo_material OWNER TO simagd;

--
-- Name: img_ctl_grupo_material_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_grupo_material_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_grupo_material_id_seq OWNER TO simagd;

--
-- Name: img_ctl_grupo_material_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_grupo_material_id_seq OWNED BY img_ctl_grupo_material.id;


--
-- Name: img_ctl_material; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_material (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    codigo character(12),
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_mod timestamp without time zone,
    id_subgrupo_material smallint NOT NULL
);


ALTER TABLE img_ctl_material OWNER TO simagd;

--
-- Name: img_ctl_material_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_material_establecimiento (
    id integer NOT NULL,
    id_material integer NOT NULL,
    id_establecimiento integer NOT NULL,
    cantidad_disponible integer DEFAULT 0 NOT NULL,
    descripcion text,
    habilitado boolean DEFAULT true,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_mod timestamp without time zone,
    id_user_reg integer NOT NULL,
    id_user_mod integer
);


ALTER TABLE img_ctl_material_establecimiento OWNER TO simagd;

--
-- Name: img_ctl_material_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_material_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_material_establecimiento_id_seq OWNER TO simagd;

--
-- Name: img_ctl_material_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_material_establecimiento_id_seq OWNED BY img_ctl_material_establecimiento.id;


--
-- Name: img_ctl_material_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_material_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_material_id_seq OWNER TO simagd;

--
-- Name: img_ctl_material_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_material_id_seq OWNED BY img_ctl_material.id;


--
-- Name: img_ctl_motor_bd_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_motor_bd_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_motor_bd_id_seq OWNER TO simagd;

--
-- Name: img_ctl_motor_bd; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_motor_bd (
    id smallint DEFAULT nextval('img_ctl_motor_bd_id_seq'::regclass) NOT NULL,
    nombre character varying(50) NOT NULL,
    codigo character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE img_ctl_motor_bd OWNER TO simagd;

--
-- Name: img_ctl_pacs_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_pacs_establecimiento (
    id smallint NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    id_motor smallint NOT NULL,
    id_establecimiento integer NOT NULL,
    nombre_conexion character(100) DEFAULT 'conn_pacsdb_local'::bpchar,
    ip character(50) NOT NULL,
    usuario character(15) NOT NULL,
    clave character varying(255) NOT NULL,
    puerto integer DEFAULT 5432 NOT NULL,
    host character(35) NOT NULL,
    duracion_estudio smallint DEFAULT 48,
    nombre_base_datos character(25) DEFAULT 'dcm4chee'::bpchar NOT NULL,
    habilitado boolean DEFAULT true,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_mod timestamp without time zone
);


ALTER TABLE img_ctl_pacs_establecimiento OWNER TO simagd;

--
-- Name: img_ctl_pacs_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_pacs_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_pacs_establecimiento_id_seq OWNER TO simagd;

--
-- Name: img_ctl_pacs_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_pacs_establecimiento_id_seq OWNED BY img_ctl_pacs_establecimiento.id;


--
-- Name: img_ctl_patron_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_patron_diagnostico (
    id integer NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    id_empleado_registra integer NOT NULL,
    id_area_servicio_diagnostico integer NOT NULL,
    id_tipo_resultado smallint NOT NULL,
    hallazgos text,
    conclusion text,
    recomendaciones text,
    indicaciones_generales character varying(255),
    observaciones character varying(255),
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_mod timestamp without time zone,
    nombre character varying(255) NOT NULL,
    codigo character(6),
    id_radiologo_define integer,
    id_establecimiento integer NOT NULL,
    habilitado boolean DEFAULT true
);


ALTER TABLE img_ctl_patron_diagnostico OWNER TO simagd;

--
-- Name: img_ctl_patron_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_patron_diagnostico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_patron_diagnostico_id_seq OWNER TO simagd;

--
-- Name: img_ctl_patron_diagnostico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_patron_diagnostico_id_seq OWNED BY img_ctl_patron_diagnostico.id;


--
-- Name: img_ctl_preparacion_estudio; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_preparacion_estudio (
    id integer NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    id_empleado_registra integer NOT NULL,
    id_area_servicio_diagnostico_aplica integer NOT NULL,
    preparacion_estudio text,
    recomendaciones text,
    observaciones character varying(255),
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_mod timestamp without time zone,
    id_establecimiento integer NOT NULL,
    nombre character varying(150),
    codigo character(6)
);


ALTER TABLE img_ctl_preparacion_estudio OWNER TO simagd;

--
-- Name: img_ctl_preparacion_estudio_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_preparacion_estudio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_preparacion_estudio_id_seq OWNER TO simagd;

--
-- Name: img_ctl_preparacion_estudio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_preparacion_estudio_id_seq OWNED BY img_ctl_preparacion_estudio.id;


--
-- Name: img_ctl_prioridad_atencion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_prioridad_atencion (
    id smallint NOT NULL,
    nombre character(25) DEFAULT 'Normal'::bpchar NOT NULL,
    descripcion character varying(100) DEFAULT 'Paciente puede esperar para ser atendido'::character varying,
    codigo character(3) DEFAULT 'NRM'::bpchar NOT NULL,
    estilo_presentacion character(15) DEFAULT 'success-v2'::bpchar
);


ALTER TABLE img_ctl_prioridad_atencion OWNER TO simagd;

--
-- Name: img_ctl_prioridad_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_prioridad_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_prioridad_atencion_id_seq OWNER TO simagd;

--
-- Name: img_ctl_prioridad_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_prioridad_atencion_id_seq OWNED BY img_ctl_prioridad_atencion.id;


--
-- Name: img_ctl_proyeccion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_proyeccion (
    id integer NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    nombre character varying(100) NOT NULL,
    codigo character(12),
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_mod timestamp without time zone,
    tiempo_ocupacion_sala smallint DEFAULT 5,
    tiempo_medico smallint DEFAULT 5,
    descripcion text,
    observaciones character varying(255),
    id_examen_servicio_diagnostico integer NOT NULL
);


ALTER TABLE img_ctl_proyeccion OWNER TO simagd;

--
-- Name: img_ctl_proyeccion_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_proyeccion_establecimiento (
    id bigint NOT NULL,
    id_proyeccion integer NOT NULL,
    id_area_examen_estab integer NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_mod timestamp without time zone,
    habilitado boolean DEFAULT true,
    observaciones character varying(255)
);


ALTER TABLE img_ctl_proyeccion_establecimiento OWNER TO simagd;

--
-- Name: img_ctl_proyeccion_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_proyeccion_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_proyeccion_establecimiento_id_seq OWNER TO simagd;

--
-- Name: img_ctl_proyeccion_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_proyeccion_establecimiento_id_seq OWNED BY img_ctl_proyeccion_establecimiento.id;


--
-- Name: img_ctl_proyeccion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_proyeccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_proyeccion_id_seq OWNER TO simagd;

--
-- Name: img_ctl_proyeccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_proyeccion_id_seq OWNED BY img_ctl_proyeccion.id;


--
-- Name: img_ctl_subgrupo_material; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_subgrupo_material (
    id smallint NOT NULL,
    nombre character varying(255) NOT NULL,
    codigo character(6),
    descripcion text,
    id_grupo_material smallint NOT NULL
);


ALTER TABLE img_ctl_subgrupo_material OWNER TO simagd;

--
-- Name: img_ctl_subgrupo_material_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_subgrupo_material_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_subgrupo_material_id_seq OWNER TO simagd;

--
-- Name: img_ctl_subgrupo_material_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_subgrupo_material_id_seq OWNED BY img_ctl_subgrupo_material.id;


--
-- Name: img_ctl_tipo_nota_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_tipo_nota_diagnostico (
    id smallint NOT NULL,
    nombre_tipo character(35) NOT NULL,
    codigo character(3) NOT NULL,
    estilo_presentacion character(15) DEFAULT 'primary-v2'::bpchar
);


ALTER TABLE img_ctl_tipo_nota_diagnostico OWNER TO simagd;

--
-- Name: img_ctl_tipo_nota_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_tipo_nota_diagnostico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_tipo_nota_diagnostico_id_seq OWNER TO simagd;

--
-- Name: img_ctl_tipo_nota_diagnostico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_tipo_nota_diagnostico_id_seq OWNED BY img_ctl_tipo_nota_diagnostico.id;


--
-- Name: img_ctl_tipo_resultado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_ctl_tipo_resultado (
    id smallint NOT NULL,
    nombre_tipo character varying(50) NOT NULL,
    indeterminado boolean DEFAULT false,
    descripcion character varying(255),
    codigo character(3) NOT NULL,
    estilo_presentacion character(15) DEFAULT 'primary-v2'::bpchar
);


ALTER TABLE img_ctl_tipo_resultado OWNER TO simagd;

--
-- Name: img_ctl_tipo_resultado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_ctl_tipo_resultado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_ctl_tipo_resultado_id_seq OWNER TO simagd;

--
-- Name: img_ctl_tipo_resultado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_ctl_tipo_resultado_id_seq OWNED BY img_ctl_tipo_resultado.id;


--
-- Name: img_dato_autocomplemento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_dato_autocomplemento (
    id integer NOT NULL,
    id_campo_autocomplementar smallint NOT NULL,
    id_area_servicio_diagnostico integer,
    dato character varying(100) NOT NULL
);


ALTER TABLE img_dato_autocomplemento OWNER TO simagd;

--
-- Name: img_dato_autocomplemento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_dato_autocomplemento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_dato_autocomplemento_id_seq OWNER TO simagd;

--
-- Name: img_dato_autocomplemento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_dato_autocomplemento_id_seq OWNED BY img_dato_autocomplemento.id;


--
-- Name: img_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_diagnostico (
    id bigint NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    id_empleado integer NOT NULL,
    id_estado_diagnostico smallint NOT NULL,
    id_lectura bigint NOT NULL,
    hallazgos text,
    conclusion text,
    fecha_transcrito timestamp without time zone,
    fecha_corregido timestamp without time zone,
    fecha_aprobado timestamp without time zone,
    errores text,
    incidencias character varying(255),
    observaciones character varying(255),
    recomendaciones text,
    id_radiologo_aprueba integer,
    fecha_registro timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    id_patron_aplicado integer
);


ALTER TABLE img_diagnostico OWNER TO simagd;

--
-- Name: img_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_diagnostico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_diagnostico_id_seq OWNER TO simagd;

--
-- Name: img_diagnostico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_diagnostico_id_seq OWNED BY img_diagnostico.id;


--
-- Name: img_estudio_paciente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_estudio_paciente (
    id bigint NOT NULL,
    id_expediente bigint,
    id_establecimiento integer NOT NULL,
    id_procedimiento_realizado bigint NOT NULL,
    fecha_estudio timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    estudio_uid text NOT NULL,
    series_uid text NOT NULL,
    servidor character(35) DEFAULT 'MINSAL'::bpchar,
    url text,
    eliminado_en_pacs boolean DEFAULT false,
    id_estudio_padre bigint,
    id_expediente_ficticio bigint
);


ALTER TABLE img_estudio_paciente OWNER TO simagd;

--
-- Name: img_estudio_paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_estudio_paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_estudio_paciente_id_seq OWNER TO simagd;

--
-- Name: img_estudio_paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_estudio_paciente_id_seq OWNED BY img_estudio_paciente.id;


--
-- Name: img_exclusion_bloqueo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_exclusion_bloqueo (
    id integer NOT NULL,
    id_bloqueo_agenda integer NOT NULL,
    id_radiologo_excluido integer NOT NULL
);


ALTER TABLE img_exclusion_bloqueo OWNER TO simagd;

--
-- Name: img_exclusion_bloqueo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_exclusion_bloqueo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_exclusion_bloqueo_id_seq OWNER TO simagd;

--
-- Name: img_exclusion_bloqueo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_exclusion_bloqueo_id_seq OWNED BY img_exclusion_bloqueo.id;


--
-- Name: img_expediente_ficticio_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_expediente_ficticio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_expediente_ficticio_id_seq OWNER TO simagd;

--
-- Name: img_expediente_ficticio; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_expediente_ficticio (
    id bigint DEFAULT nextval('img_expediente_ficticio_id_seq'::regclass) NOT NULL,
    numero character varying(12),
    id_establecimiento integer NOT NULL,
    habilitado boolean DEFAULT true,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    id_user_reg integer NOT NULL,
    nombre_ficticio character varying(75) DEFAULT 'Paciente desconocido'::character varying,
    caracteristicas character varying(255) DEFAULT 'El paciente se encuentra inconsciente'::character varying
);


ALTER TABLE img_expediente_ficticio OWNER TO simagd;

--
-- Name: img_lectura; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_lectura (
    id bigint NOT NULL,
    id_user_reg integer NOT NULL,
    id_empleado integer NOT NULL,
    id_establecimiento integer NOT NULL,
    id_tipo_resultado smallint,
    id_estado_lectura smallint NOT NULL,
    id_estudio bigint,
    correlativo character(10),
    fecha_lectura timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    lectura_remota boolean DEFAULT false,
    indicaciones character varying(255),
    observaciones character varying(255),
    id_radiologo_designado_aprobacion integer,
    solicitada_por_radiologo boolean DEFAULT false,
    id_radiologo_solicita integer,
    id_patron_asociado integer,
    id_expediente bigint,
    id_expediente_ficticio bigint,
    id_transcriptor_asignado integer,
    id_solicitud_diagnostico bigint
);


ALTER TABLE img_lectura OWNER TO simagd;

--
-- Name: img_lectura_estudio; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_lectura_estudio (
    id bigint NOT NULL,
    id_estudio bigint NOT NULL,
    id_lectura bigint NOT NULL
);


ALTER TABLE img_lectura_estudio OWNER TO simagd;

--
-- Name: img_lectura_estudio_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_lectura_estudio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_lectura_estudio_id_seq OWNER TO simagd;

--
-- Name: img_lectura_estudio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_lectura_estudio_id_seq OWNED BY img_lectura_estudio.id;


--
-- Name: img_lectura_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_lectura_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_lectura_id_seq OWNER TO simagd;

--
-- Name: img_lectura_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_lectura_id_seq OWNED BY img_lectura.id;


--
-- Name: img_material_utilizado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_material_utilizado (
    id bigint NOT NULL,
    id_procedimiento_realizado bigint NOT NULL,
    id_material integer NOT NULL,
    cantidad_utilizada integer DEFAULT 0,
    otras_especificaciones character varying(100)
);


ALTER TABLE img_material_utilizado OWNER TO simagd;

--
-- Name: img_material_utilizado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_material_utilizado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_material_utilizado_id_seq OWNER TO simagd;

--
-- Name: img_material_utilizado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_material_utilizado_id_seq OWNED BY img_material_utilizado.id;


--
-- Name: img_nota_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_nota_diagnostico (
    id bigint NOT NULL,
    id_user_reg integer NOT NULL,
    id_empleado integer NOT NULL,
    id_tipo_nota_diagnostico smallint NOT NULL,
    id_diagnostico bigint NOT NULL,
    id_establecimiento integer NOT NULL,
    contenido text,
    fecha_emision timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    observaciones character varying(255)
);


ALTER TABLE img_nota_diagnostico OWNER TO simagd;

--
-- Name: img_nota_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_nota_diagnostico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_nota_diagnostico_id_seq OWNER TO simagd;

--
-- Name: img_nota_diagnostico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_nota_diagnostico_id_seq OWNED BY img_nota_diagnostico.id;


--
-- Name: img_pendiente_lectura; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_pendiente_lectura (
    id bigint NOT NULL,
    id_establecimiento integer NOT NULL,
    id_estudio bigint NOT NULL,
    fecha_ingreso_lista timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    solicitud_post_estudio boolean DEFAULT false,
    anexado_por_radiologo boolean DEFAULT false,
    id_radiologo_anexa integer,
    id_radiologo_asignado integer,
    id_solicitud_diagnostico bigint,
    id_asigna_radiologo integer
);


ALTER TABLE img_pendiente_lectura OWNER TO simagd;

--
-- Name: img_pendiente_lectura_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_pendiente_lectura_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_pendiente_lectura_id_seq OWNER TO simagd;

--
-- Name: img_pendiente_lectura_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_pendiente_lectura_id_seq OWNED BY img_pendiente_lectura.id;


--
-- Name: img_pendiente_realizacion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_pendiente_realizacion (
    id bigint NOT NULL,
    id_solicitud_estudio bigint,
    id_establecimiento integer NOT NULL,
    fecha_ingreso_lista timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    id_solicitud_estudio_complementario bigint,
    id_cita_programada bigint,
    id_procedimiento_iniciado bigint,
    es_emergencia boolean DEFAULT false,
    id_registra_emergencia integer,
    es_complementario boolean DEFAULT false,
    id_tecnologo_asignado integer,
    id_asigna_examinante integer
);


ALTER TABLE img_pendiente_realizacion OWNER TO simagd;

--
-- Name: img_pendiente_realizacion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_pendiente_realizacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_pendiente_realizacion_id_seq OWNER TO simagd;

--
-- Name: img_pendiente_realizacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_pendiente_realizacion_id_seq OWNED BY img_pendiente_realizacion.id;


--
-- Name: img_pendiente_transcripcion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_pendiente_transcripcion (
    id bigint NOT NULL,
    id_establecimiento integer NOT NULL,
    id_lectura bigint NOT NULL,
    fecha_ingreso_lista timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fue_impugnado boolean DEFAULT false,
    id_transcriptor_asignado integer,
    id_asigna_transcriptor integer
);


ALTER TABLE img_pendiente_transcripcion OWNER TO simagd;

--
-- Name: img_pendiente_transcripcion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_pendiente_transcripcion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_pendiente_transcripcion_id_seq OWNER TO simagd;

--
-- Name: img_pendiente_transcripcion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_pendiente_transcripcion_id_seq OWNED BY img_pendiente_transcripcion.id;


--
-- Name: img_pendiente_validacion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_pendiente_validacion (
    id bigint NOT NULL,
    id_establecimiento integer NOT NULL,
    id_diagnostico bigint NOT NULL,
    fecha_ingreso_lista timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fue_corregido boolean DEFAULT false,
    id_asigna_validador integer,
    id_radiologo_asignado integer
);


ALTER TABLE img_pendiente_validacion OWNER TO simagd;

--
-- Name: img_pendiente_validacion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_pendiente_validacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_pendiente_validacion_id_seq OWNER TO simagd;

--
-- Name: img_pendiente_validacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_pendiente_validacion_id_seq OWNED BY img_pendiente_validacion.id;


--
-- Name: img_procedimiento_realizado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_procedimiento_realizado (
    id bigint NOT NULL,
    id_tecnologo_realiza integer NOT NULL,
    id_user_mod integer,
    id_user_reg integer NOT NULL,
    id_solicitud_estudio bigint,
    id_estado_procedimiento_realizado smallint NOT NULL,
    fecha_atendido timestamp without time zone,
    fecha_realizado timestamp without time zone,
    fecha_procesado timestamp without time zone,
    fecha_almacenado timestamp without time zone,
    equipo_utilizado character varying(100),
    tecnica_utilizada character varying(150),
    hipotesis_diagnostica character varying(150),
    incidencias character varying(255),
    fecha_nacimiento_indeterminada boolean DEFAULT false,
    observaciones character varying(255),
    sala_realizado character varying(50),
    id_cita_programada bigint,
    id_solicitud_estudio_complementario bigint,
    fecha_registro timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    es_emergencia boolean DEFAULT false,
    id_registra_emergencia integer,
    id_establecimiento integer NOT NULL,
    es_complementario boolean DEFAULT false
);


ALTER TABLE img_procedimiento_realizado OWNER TO simagd;

--
-- Name: img_procedimiento_realizado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_procedimiento_realizado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_procedimiento_realizado_id_seq OWNER TO simagd;

--
-- Name: img_procedimiento_realizado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_procedimiento_realizado_id_seq OWNED BY img_procedimiento_realizado.id;


--
-- Name: img_solicitud_diagnostico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_solicitud_diagnostico (
    id bigint NOT NULL,
    id_user_reg integer NOT NULL,
    id_solicitud_estudio bigint NOT NULL,
    id_estudio bigint,
    id_empleado integer NOT NULL,
    id_establecimiento_solicitado integer NOT NULL,
    solicitud_remota boolean DEFAULT false,
    fecha_creacion timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    justificacion character varying(255) NOT NULL,
    fecha_proxima_consulta date,
    observaciones character varying(255),
    id_estado_solicitud smallint
);


ALTER TABLE img_solicitud_diagnostico OWNER TO simagd;

--
-- Name: img_solicitud_diagnostico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_solicitud_diagnostico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_solicitud_diagnostico_id_seq OWNER TO simagd;

--
-- Name: img_solicitud_diagnostico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_solicitud_diagnostico_id_seq OWNED BY img_solicitud_diagnostico.id;


--
-- Name: img_solicitud_estudio; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_solicitud_estudio (
    id bigint NOT NULL,
    id_user_mod integer,
    id_aten_area_mod_estab integer,
    id_area_servicio_diagnostico integer NOT NULL,
    id_solicitudestudios integer,
    id_user_reg integer NOT NULL,
    id_empleado integer,
    id_expediente bigint,
    id_establecimiento_diagnosticante integer,
    id_establecimiento_referido integer NOT NULL,
    datos_clinicos character varying(150),
    consulta_por character varying(255),
    estado_clinico character varying(50),
    hipotesis_diagnostica character varying(100),
    investigando character varying(150),
    antecedentes_clinicos_relevantes text,
    justificacion_medica character varying(150),
    fecha_creacion timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    referir_paciente boolean DEFAULT false,
    justificacion_referencia character varying(255),
    fecha_proxima_consulta date,
    requiere_cita boolean DEFAULT true,
    requiere_diagnostico boolean DEFAULT false,
    justificacion_diagnostico character varying(255),
    paciente_ambulatorio boolean DEFAULT true,
    numero_sala integer,
    numero_cama integer,
    paciente_desconocido boolean DEFAULT false,
    peso_actual_lb numeric(6,2),
    peso_actual_kg numeric(6,2),
    talla_paciente numeric(6,2),
    id_forma_contacto smallint,
    id_contacto_paciente smallint,
    contacto character varying(75) DEFAULT 'No posee'::character varying,
    nombre_contacto character varying(75),
    id_prioridad_atencion smallint,
    indicaciones_medico_radiologo text,
    id_radiologo_agrega_indicaciones integer,
    id_estado_solicitud smallint,
    id_expediente_ficticio bigint
);


ALTER TABLE img_solicitud_estudio OWNER TO simagd;

--
-- Name: img_solicitud_estudio_complementario; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_solicitud_estudio_complementario (
    id bigint NOT NULL,
    id_user_reg integer NOT NULL,
    id_radiologo_solicita integer NOT NULL,
    id_estudio_padre bigint NOT NULL,
    fecha_solicitud timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    justificacion character varying(255),
    id_area_servicio_diagnostico integer NOT NULL,
    id_prioridad_atencion smallint,
    id_solicitud_estudio bigint,
    id_establecimiento_solicitado integer NOT NULL,
    indicaciones_estudio text,
    id_estado_solicitud smallint
);


ALTER TABLE img_solicitud_estudio_complementario OWNER TO simagd;

--
-- Name: img_solicitud_estudio_complementario_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_solicitud_estudio_complementario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_solicitud_estudio_complementario_id_seq OWNER TO simagd;

--
-- Name: img_solicitud_estudio_complementario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_solicitud_estudio_complementario_id_seq OWNED BY img_solicitud_estudio_complementario.id;


--
-- Name: img_solicitud_estudio_complementario_proyeccion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_solicitud_estudio_complementario_proyeccion (
    id bigint NOT NULL,
    id_solicitud_estudio_complementario bigint NOT NULL,
    id_proyeccion_solicitada integer NOT NULL,
    vistas_requeridas smallint DEFAULT 1,
    dimensiones character varying(25),
    otras_especificaciones character varying(100)
);


ALTER TABLE img_solicitud_estudio_complementario_proyeccion OWNER TO simagd;

--
-- Name: img_solicitud_estudio_complementario_proyeccion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_solicitud_estudio_complementario_proyeccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_solicitud_estudio_complementario_proyeccion_id_seq OWNER TO simagd;

--
-- Name: img_solicitud_estudio_complementario_proyeccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_solicitud_estudio_complementario_proyeccion_id_seq OWNED BY img_solicitud_estudio_complementario_proyeccion.id;


--
-- Name: img_solicitud_estudio_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_solicitud_estudio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_solicitud_estudio_id_seq OWNER TO simagd;

--
-- Name: img_solicitud_estudio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_solicitud_estudio_id_seq OWNED BY img_solicitud_estudio.id;


--
-- Name: img_solicitud_estudio_proyeccion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE img_solicitud_estudio_proyeccion (
    id bigint NOT NULL,
    id_solicitud_estudio bigint NOT NULL,
    id_proyeccion_solicitada integer NOT NULL,
    vistas_requeridas smallint DEFAULT 1,
    dimensiones character varying(25),
    otras_especificaciones character varying(100)
);


ALTER TABLE img_solicitud_estudio_proyeccion OWNER TO simagd;

--
-- Name: img_solicitud_estudio_proyeccion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE img_solicitud_estudio_proyeccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE img_solicitud_estudio_proyeccion_id_seq OWNER TO simagd;

--
-- Name: img_solicitud_estudio_proyeccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE img_solicitud_estudio_proyeccion_id_seq OWNED BY img_solicitud_estudio_proyeccion.id;


--
-- Name: its_departamentos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_departamentos (
    id_expediente_its integer NOT NULL,
    id_departamento integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_departamentos OWNER TO simagd;

--
-- Name: TABLE its_departamentos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_departamentos IS 'Tablaque contiene el departamento en el que ha trabajado el o la paciente';


--
-- Name: COLUMN its_departamentos.id_expediente_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_departamentos.id_expediente_its IS 'ID del expediente de its';


--
-- Name: COLUMN its_departamentos.id_departamento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_departamentos.id_departamento IS 'id del departamento';


--
-- Name: its_departamentos_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_departamentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_departamentos_id_seq OWNER TO simagd;

--
-- Name: its_departamentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_departamentos_id_seq OWNED BY its_departamentos.id;


--
-- Name: its_drg_old; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_drg_old (
    id_expediente_its integer NOT NULL,
    id_tipo_consumo_drg integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_drg_old OWNER TO simagd;

--
-- Name: TABLE its_drg_old; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_drg_old IS 'Tabla de consumo de droga por parte del o la paciente';


--
-- Name: COLUMN its_drg_old.id_expediente_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_drg_old.id_expediente_its IS 'Id del expediente de its';


--
-- Name: COLUMN its_drg_old.id_tipo_consumo_drg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_drg_old.id_tipo_consumo_drg IS 'ID tipo de droga que consume';


--
-- Name: its_drg_old_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_drg_old_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_drg_old_id_seq OWNER TO simagd;

--
-- Name: its_drg_old_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_drg_old_id_seq OWNED BY its_drg_old.id;


--
-- Name: its_examen_paciente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_examen_paciente (
    id_consulta integer NOT NULL,
    id_anormalidad integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_examen_paciente OWNER TO simagd;

--
-- Name: TABLE its_examen_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_examen_paciente IS 'En esta tabla se almacena los resultados anormales del exame fisico por parte del medico';


--
-- Name: COLUMN its_examen_paciente.id_consulta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_examen_paciente.id_consulta IS 'ID de la consulta a la que corresponde la anormalidad del examen medico';


--
-- Name: COLUMN its_examen_paciente.id_anormalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_examen_paciente.id_anormalidad IS 'ID de la anormalidad observada';


--
-- Name: its_examen_paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_examen_paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_examen_paciente_id_seq OWNER TO simagd;

--
-- Name: its_examen_paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_examen_paciente_id_seq OWNED BY its_examen_paciente.id;


--
-- Name: its_its_old; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_its_old (
    id_expediente_its integer NOT NULL,
    id_its_mnt_tipo_metodo integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_its_old OWNER TO simagd;

--
-- Name: TABLE its_its_old; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_its_old IS 'Tabla almacena las its padecidas antes de la creacion del expediente';


--
-- Name: COLUMN its_its_old.id_expediente_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_its_old.id_expediente_its IS 'ID del expediente de usuario';


--
-- Name: COLUMN its_its_old.id_its_mnt_tipo_metodo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_its_old.id_its_mnt_tipo_metodo IS 'ID del tipo de ITS padecida porel usuario';


--
-- Name: its_its_old_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_its_old_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_its_old_id_seq OWNER TO simagd;

--
-- Name: its_its_old_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_its_old_id_seq OWNED BY its_its_old.id;


--
-- Name: its_lugar_trabajo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_lugar_trabajo (
    id_expediente_its integer NOT NULL,
    id_its_mnt_tipo_trabajo integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_lugar_trabajo OWNER TO simagd;

--
-- Name: TABLE its_lugar_trabajo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_lugar_trabajo IS 'Tabla almacena los lugares de trabajo de en los que ejercen trabajo sexual';


--
-- Name: COLUMN its_lugar_trabajo.id_expediente_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_lugar_trabajo.id_expediente_its IS 'ID del expediente de usuario';


--
-- Name: COLUMN its_lugar_trabajo.id_its_mnt_tipo_trabajo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_lugar_trabajo.id_its_mnt_tipo_trabajo IS 'ID del tipo de lugares de trabajo';


--
-- Name: its_lugar_trabajo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_lugar_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_lugar_trabajo_id_seq OWNER TO simagd;

--
-- Name: its_lugar_trabajo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_lugar_trabajo_id_seq OWNED BY its_lugar_trabajo.id;


--
-- Name: its_metodo_atc_usado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_metodo_atc_usado (
    id_consulta integer NOT NULL,
    id_its_mnt_tipo_metodo integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_metodo_atc_usado OWNER TO simagd;

--
-- Name: TABLE its_metodo_atc_usado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_metodo_atc_usado IS 'Tabla almacena los metodos anticonceptivos usados';


--
-- Name: COLUMN its_metodo_atc_usado.id_consulta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_metodo_atc_usado.id_consulta IS 'ID del expediente de usuario';


--
-- Name: COLUMN its_metodo_atc_usado.id_its_mnt_tipo_metodo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_metodo_atc_usado.id_its_mnt_tipo_metodo IS 'ID del tipo de metodo anticonceptivo usado por la usuaria';


--
-- Name: its_metodo_atc_usado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_metodo_atc_usado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_metodo_atc_usado_id_seq OWNER TO simagd;

--
-- Name: its_metodo_atc_usado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_metodo_atc_usado_id_seq OWNED BY its_metodo_atc_usado.id;


--
-- Name: its_mnt_anormalidad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_anormalidad (
    id_anormalidad integer NOT NULL,
    anormalidad character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_anormalidad OWNER TO simagd;

--
-- Name: TABLE its_mnt_anormalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_anormalidad IS 'Tabla almacena los las diferentes anormalidades observadas en los oprganos o partes del cuerpo observados por el o la profesional de la salud';


--
-- Name: COLUMN its_mnt_anormalidad.id_anormalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_anormalidad.id_anormalidad IS 'ID de la anormalidad';


--
-- Name: COLUMN its_mnt_anormalidad.anormalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_anormalidad.anormalidad IS 'El Nombre de la anormalidad';


--
-- Name: its_mnt_anormalidad_id_anormalidad_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_anormalidad_id_anormalidad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_anormalidad_id_anormalidad_seq OWNER TO simagd;

--
-- Name: its_mnt_anormalidad_id_anormalidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_anormalidad_id_anormalidad_seq OWNED BY its_mnt_anormalidad.id_anormalidad;


--
-- Name: its_mnt_anormalidad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_anormalidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_anormalidad_id_seq OWNER TO simagd;

--
-- Name: its_mnt_anormalidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_anormalidad_id_seq OWNED BY its_mnt_anormalidad.id;


--
-- Name: its_mnt_flujo_aspecto; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_flujo_aspecto (
    id_flujo_aspecto integer NOT NULL,
    flujo_aspecto character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_flujo_aspecto OWNER TO simagd;

--
-- Name: TABLE its_mnt_flujo_aspecto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_flujo_aspecto IS 'Tabla que almacena los las diferentes aspectos del flujo';


--
-- Name: COLUMN its_mnt_flujo_aspecto.id_flujo_aspecto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_aspecto.id_flujo_aspecto IS 'ID de la aspectos del flujo';


--
-- Name: COLUMN its_mnt_flujo_aspecto.flujo_aspecto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_aspecto.flujo_aspecto IS 'El Nombre de la aspectos del flujo';


--
-- Name: its_mnt_flujo_aspecto_id_flujo_aspecto_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_aspecto_id_flujo_aspecto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_aspecto_id_flujo_aspecto_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_aspecto_id_flujo_aspecto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_aspecto_id_flujo_aspecto_seq OWNED BY its_mnt_flujo_aspecto.id_flujo_aspecto;


--
-- Name: its_mnt_flujo_aspecto_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_aspecto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_aspecto_id_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_aspecto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_aspecto_id_seq OWNED BY its_mnt_flujo_aspecto.id;


--
-- Name: its_mnt_flujo_cantidad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_flujo_cantidad (
    id_flujo_cantidad integer NOT NULL,
    flujo_cantidad character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_flujo_cantidad OWNER TO simagd;

--
-- Name: TABLE its_mnt_flujo_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_flujo_cantidad IS 'Tabla que almacena los las diferentes cantidad del flujo';


--
-- Name: COLUMN its_mnt_flujo_cantidad.id_flujo_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_cantidad.id_flujo_cantidad IS 'ID de la cantidad del flujo';


--
-- Name: COLUMN its_mnt_flujo_cantidad.flujo_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_cantidad.flujo_cantidad IS 'El Nombre de la cantidad del flujo';


--
-- Name: its_mnt_flujo_cantidad_id_flujo_cantidad_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_cantidad_id_flujo_cantidad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_cantidad_id_flujo_cantidad_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_cantidad_id_flujo_cantidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_cantidad_id_flujo_cantidad_seq OWNED BY its_mnt_flujo_cantidad.id_flujo_cantidad;


--
-- Name: its_mnt_flujo_cantidad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_cantidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_cantidad_id_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_cantidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_cantidad_id_seq OWNED BY its_mnt_flujo_cantidad.id;


--
-- Name: its_mnt_flujo_color; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_flujo_color (
    id_flujo_color integer NOT NULL,
    flujo_color character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_flujo_color OWNER TO simagd;

--
-- Name: TABLE its_mnt_flujo_color; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_flujo_color IS 'Tabla que almacena los las diferentes color del flujo';


--
-- Name: COLUMN its_mnt_flujo_color.id_flujo_color; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_color.id_flujo_color IS 'ID de la color del flujo';


--
-- Name: COLUMN its_mnt_flujo_color.flujo_color; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_color.flujo_color IS 'El Nombre de la color del flujo';


--
-- Name: its_mnt_flujo_color_id_flujo_color_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_color_id_flujo_color_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_color_id_flujo_color_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_color_id_flujo_color_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_color_id_flujo_color_seq OWNED BY its_mnt_flujo_color.id_flujo_color;


--
-- Name: its_mnt_flujo_color_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_color_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_color_id_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_color_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_color_id_seq OWNED BY its_mnt_flujo_color.id;


--
-- Name: its_mnt_flujo_olor; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_flujo_olor (
    id_flujo_olor integer NOT NULL,
    flujo_olor character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_flujo_olor OWNER TO simagd;

--
-- Name: TABLE its_mnt_flujo_olor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_flujo_olor IS 'Tabla almacena los las diferentes olor del flujo';


--
-- Name: COLUMN its_mnt_flujo_olor.id_flujo_olor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_olor.id_flujo_olor IS 'ID de la olor del flujo';


--
-- Name: COLUMN its_mnt_flujo_olor.flujo_olor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_flujo_olor.flujo_olor IS 'El Nombre de la olor del flujo';


--
-- Name: its_mnt_flujo_olor_id_flujo_olor_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_olor_id_flujo_olor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_olor_id_flujo_olor_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_olor_id_flujo_olor_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_olor_id_flujo_olor_seq OWNED BY its_mnt_flujo_olor.id_flujo_olor;


--
-- Name: its_mnt_flujo_olor_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_flujo_olor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_flujo_olor_id_seq OWNER TO simagd;

--
-- Name: its_mnt_flujo_olor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_flujo_olor_id_seq OWNED BY its_mnt_flujo_olor.id;


--
-- Name: its_mnt_its; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_its (
    id_its integer NOT NULL,
    cod_cie10 character varying(12) NOT NULL,
    its character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_its OWNER TO simagd;

--
-- Name: TABLE its_mnt_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_its IS 'Esta tabla contiene las ITS padecidas según el paciente';


--
-- Name: COLUMN its_mnt_its.id_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_its.id_its IS 'Id de la its';


--
-- Name: COLUMN its_mnt_its.cod_cie10; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_its.cod_cie10 IS 'Codigo de CIE10';


--
-- Name: COLUMN its_mnt_its.its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_its.its IS 'Nombre de la ITS';


--
-- Name: its_mnt_its_id_its_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_its_id_its_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_its_id_its_seq OWNER TO simagd;

--
-- Name: its_mnt_its_id_its_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_its_id_its_seq OWNED BY its_mnt_its.id_its;


--
-- Name: its_mnt_its_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_its_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_its_id_seq OWNER TO simagd;

--
-- Name: its_mnt_its_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_its_id_seq OWNED BY its_mnt_its.id;


--
-- Name: its_mnt_ocupacion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_ocupacion (
    id_ocupacion integer NOT NULL,
    ocupacion character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_ocupacion OWNER TO simagd;

--
-- Name: TABLE its_mnt_ocupacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_ocupacion IS 'Tabla que contiene los datos de ocupacion igual al sumeve';


--
-- Name: COLUMN its_mnt_ocupacion.id_ocupacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_ocupacion.id_ocupacion IS 'ID de ocupacion';


--
-- Name: COLUMN its_mnt_ocupacion.ocupacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_ocupacion.ocupacion IS 'Nombre de la ocupacion';


--
-- Name: its_mnt_ocupacion_id_ocupacion_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_ocupacion_id_ocupacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_ocupacion_id_ocupacion_seq OWNER TO simagd;

--
-- Name: its_mnt_ocupacion_id_ocupacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_ocupacion_id_ocupacion_seq OWNED BY its_mnt_ocupacion.id_ocupacion;


--
-- Name: its_mnt_ocupacion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_ocupacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_ocupacion_id_seq OWNER TO simagd;

--
-- Name: its_mnt_ocupacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_ocupacion_id_seq OWNED BY its_mnt_ocupacion.id;


--
-- Name: its_mnt_organo_anormalidad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_organo_anormalidad (
    id_organo_anormalidad integer NOT NULL,
    id_organo integer NOT NULL,
    id_anormalidad integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_organo_anormalidad OWNER TO simagd;

--
-- Name: TABLE its_mnt_organo_anormalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_organo_anormalidad IS 'Tabla que almacena la asociacion entre el organo o parte del cuerpo';


--
-- Name: COLUMN its_mnt_organo_anormalidad.id_organo_anormalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_organo_anormalidad.id_organo_anormalidad IS 'ID de la relacion organo anormalidad';


--
-- Name: COLUMN its_mnt_organo_anormalidad.id_organo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_organo_anormalidad.id_organo IS 'ID del organo o parte del cuerpo observada';


--
-- Name: COLUMN its_mnt_organo_anormalidad.id_anormalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_organo_anormalidad.id_anormalidad IS 'ID la anormalidad';


--
-- Name: its_mnt_organo_anormalidad_id_organo_anormalidad_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_organo_anormalidad_id_organo_anormalidad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_organo_anormalidad_id_organo_anormalidad_seq OWNER TO simagd;

--
-- Name: its_mnt_organo_anormalidad_id_organo_anormalidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_organo_anormalidad_id_organo_anormalidad_seq OWNED BY its_mnt_organo_anormalidad.id_organo_anormalidad;


--
-- Name: its_mnt_organo_anormalidad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_organo_anormalidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_organo_anormalidad_id_seq OWNER TO simagd;

--
-- Name: its_mnt_organo_anormalidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_organo_anormalidad_id_seq OWNED BY its_mnt_organo_anormalidad.id;


--
-- Name: its_mnt_organos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_organos (
    id_organo integer NOT NULL,
    organo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_organos OWNER TO simagd;

--
-- Name: TABLE its_mnt_organos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_organos IS 'Tabla almacena los las diferentes organos o partes del cuerpo';


--
-- Name: COLUMN its_mnt_organos.id_organo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_organos.id_organo IS 'ID del organo';


--
-- Name: COLUMN its_mnt_organos.organo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_organos.organo IS 'El Nombre del organo';


--
-- Name: its_mnt_organos_id_organo_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_organos_id_organo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_organos_id_organo_seq OWNER TO simagd;

--
-- Name: its_mnt_organos_id_organo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_organos_id_organo_seq OWNED BY its_mnt_organos.id_organo;


--
-- Name: its_mnt_organos_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_organos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_organos_id_seq OWNER TO simagd;

--
-- Name: its_mnt_organos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_organos_id_seq OWNED BY its_mnt_organos.id;


--
-- Name: its_mnt_tipos_consumo_drg; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_tipos_consumo_drg (
    id_tipo_consumo_drg integer NOT NULL,
    consumo_drg_tipo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_tipos_consumo_drg OWNER TO simagd;

--
-- Name: TABLE its_mnt_tipos_consumo_drg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_tipos_consumo_drg IS 'Tabla almacena los tipos de consumo de droga';


--
-- Name: COLUMN its_mnt_tipos_consumo_drg.id_tipo_consumo_drg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_consumo_drg.id_tipo_consumo_drg IS 'ID del tipo consumo de droga';


--
-- Name: COLUMN its_mnt_tipos_consumo_drg.consumo_drg_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_consumo_drg.consumo_drg_tipo IS 'El Nombre del tipo de consumo de droga';


--
-- Name: its_mnt_tipos_consumo_drg_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_consumo_drg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_consumo_drg_id_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_consumo_drg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_consumo_drg_id_seq OWNED BY its_mnt_tipos_consumo_drg.id;


--
-- Name: its_mnt_tipos_consumo_drg_id_tipo_consumo_drg_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_consumo_drg_id_tipo_consumo_drg_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_consumo_drg_id_tipo_consumo_drg_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_consumo_drg_id_tipo_consumo_drg_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_consumo_drg_id_tipo_consumo_drg_seq OWNED BY its_mnt_tipos_consumo_drg.id_tipo_consumo_drg;


--
-- Name: its_mnt_tipos_hsc; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_tipos_hsc (
    id_tipos_hsc integer NOT NULL,
    hsc_tipo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_tipos_hsc OWNER TO simagd;

--
-- Name: TABLE its_mnt_tipos_hsc; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_tipos_hsc IS 'Tabla almacena los tipos de hsc';


--
-- Name: COLUMN its_mnt_tipos_hsc.id_tipos_hsc; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_hsc.id_tipos_hsc IS 'ID del tipo hsc';


--
-- Name: COLUMN its_mnt_tipos_hsc.hsc_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_hsc.hsc_tipo IS 'El Nombre del tipo HSH';


--
-- Name: its_mnt_tipos_hsc_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_hsc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_hsc_id_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_hsc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_hsc_id_seq OWNED BY its_mnt_tipos_hsc.id;


--
-- Name: its_mnt_tipos_hsc_id_tipos_hsc_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_hsc_id_tipos_hsc_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_hsc_id_tipos_hsc_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_hsc_id_tipos_hsc_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_hsc_id_tipos_hsc_seq OWNED BY its_mnt_tipos_hsc.id_tipos_hsc;


--
-- Name: its_mnt_tipos_metodo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_tipos_metodo (
    id_tipo_metodo integer NOT NULL,
    metodo_tipo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_tipos_metodo OWNER TO simagd;

--
-- Name: TABLE its_mnt_tipos_metodo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_tipos_metodo IS 'Tabla almacena los tipos de metodos de planificacion';


--
-- Name: COLUMN its_mnt_tipos_metodo.id_tipo_metodo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_metodo.id_tipo_metodo IS 'ID del tipo de metodo de planificacion';


--
-- Name: COLUMN its_mnt_tipos_metodo.metodo_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_metodo.metodo_tipo IS 'El Nombre del tipo de metodo de planificacion';


--
-- Name: its_mnt_tipos_metodo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_metodo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_metodo_id_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_metodo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_metodo_id_seq OWNED BY its_mnt_tipos_metodo.id;


--
-- Name: its_mnt_tipos_metodo_id_tipo_metodo_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_metodo_id_tipo_metodo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_metodo_id_tipo_metodo_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_metodo_id_tipo_metodo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_metodo_id_tipo_metodo_seq OWNED BY its_mnt_tipos_metodo.id_tipo_metodo;


--
-- Name: its_mnt_tipos_pareja; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_tipos_pareja (
    id_tipo_pareja integer NOT NULL,
    pareja_tipo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_tipos_pareja OWNER TO simagd;

--
-- Name: TABLE its_mnt_tipos_pareja; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_tipos_pareja IS 'Tabla almacena los tipos de pareja';


--
-- Name: COLUMN its_mnt_tipos_pareja.id_tipo_pareja; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_pareja.id_tipo_pareja IS 'ID del tipo pareja';


--
-- Name: COLUMN its_mnt_tipos_pareja.pareja_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_pareja.pareja_tipo IS 'El Nombre del tipo pareja';


--
-- Name: its_mnt_tipos_pareja_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_pareja_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_pareja_id_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_pareja_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_pareja_id_seq OWNED BY its_mnt_tipos_pareja.id;


--
-- Name: its_mnt_tipos_pareja_id_tipo_pareja_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_pareja_id_tipo_pareja_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_pareja_id_tipo_pareja_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_pareja_id_tipo_pareja_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_pareja_id_tipo_pareja_seq OWNED BY its_mnt_tipos_pareja.id_tipo_pareja;


--
-- Name: its_mnt_tipos_relaciones; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_tipos_relaciones (
    id_tipos_relaciones integer NOT NULL,
    relaciones_tipo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_tipos_relaciones OWNER TO simagd;

--
-- Name: TABLE its_mnt_tipos_relaciones; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_tipos_relaciones IS 'Tabla almacena los tipos de relaciones';


--
-- Name: COLUMN its_mnt_tipos_relaciones.id_tipos_relaciones; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_relaciones.id_tipos_relaciones IS 'ID del tipo relaciones';


--
-- Name: COLUMN its_mnt_tipos_relaciones.relaciones_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_tipos_relaciones.relaciones_tipo IS 'El Nombre del tipo relaciones';


--
-- Name: its_mnt_tipos_relaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_relaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_relaciones_id_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_relaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_relaciones_id_seq OWNED BY its_mnt_tipos_relaciones.id;


--
-- Name: its_mnt_tipos_relaciones_id_tipos_relaciones_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_tipos_relaciones_id_tipos_relaciones_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_tipos_relaciones_id_tipos_relaciones_seq OWNER TO simagd;

--
-- Name: its_mnt_tipos_relaciones_id_tipos_relaciones_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_tipos_relaciones_id_tipos_relaciones_seq OWNED BY its_mnt_tipos_relaciones.id_tipos_relaciones;


--
-- Name: its_mnt_vih_consejeria; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_mnt_vih_consejeria (
    id_vih_consejeria integer NOT NULL,
    vih_consejeria character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_mnt_vih_consejeria OWNER TO simagd;

--
-- Name: TABLE its_mnt_vih_consejeria; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_mnt_vih_consejeria IS 'Tabla almacena los las diferentes consejerias de VIH';


--
-- Name: COLUMN its_mnt_vih_consejeria.id_vih_consejeria; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_vih_consejeria.id_vih_consejeria IS 'ID de las diferentes consejerias de VIH';


--
-- Name: COLUMN its_mnt_vih_consejeria.vih_consejeria; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_mnt_vih_consejeria.vih_consejeria IS 'El Nombre de la consejeria de VIH';


--
-- Name: its_mnt_vih_consejeria_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_vih_consejeria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_vih_consejeria_id_seq OWNER TO simagd;

--
-- Name: its_mnt_vih_consejeria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_vih_consejeria_id_seq OWNED BY its_mnt_vih_consejeria.id;


--
-- Name: its_mnt_vih_consejeria_id_vih_consejeria_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_mnt_vih_consejeria_id_vih_consejeria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_mnt_vih_consejeria_id_vih_consejeria_seq OWNER TO simagd;

--
-- Name: its_mnt_vih_consejeria_id_vih_consejeria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_mnt_vih_consejeria_id_vih_consejeria_seq OWNED BY its_mnt_vih_consejeria.id_vih_consejeria;


--
-- Name: its_paises; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_paises (
    id_expediente_its integer NOT NULL,
    id_paises integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_paises OWNER TO simagd;

--
-- Name: TABLE its_paises; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_paises IS 'tabla que contiene los paises en los que ha trabajado';


--
-- Name: COLUMN its_paises.id_expediente_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_paises.id_expediente_its IS 'ID expediente its';


--
-- Name: COLUMN its_paises.id_paises; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_paises.id_paises IS 'id paices';


--
-- Name: its_paises_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_paises_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_paises_id_seq OWNER TO simagd;

--
-- Name: its_paises_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_paises_id_seq OWNED BY its_paises.id;


--
-- Name: its_primeravez; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_primeravez (
    id_its_primeravez integer NOT NULL,
    its_expediente character varying(10) DEFAULT NULL::character varying,
    id_historial integer NOT NULL,
    sif_prueba smallint,
    sif_conoce_resultado smallint,
    sif_tratamiento smallint,
    abs_abusado smallint,
    abs_edad integer,
    hsd_tipo integer,
    rlc_genero integer,
    rlc_inicio_edad integer,
    ts_ejerce smallint,
    ts_ejerce_actualmente smallint,
    drg_consumo smallint,
    sif_cumplio_tratamiento smallint,
    its_old smallint,
    vih_cul_pareja smallint,
    ocp_adicional integer,
    trb_lugar integer,
    vih_cul_uso smallint,
    ts_otro_depto smallint,
    ts_otro_pais smallint,
    vih_cul_apariencia smallint,
    ts_tiempo smallint,
    vih_old_consejeria smallint,
    vih_old_prueba smallint,
    vih_old_resultado smallint,
    vih_old_resultado_resultado smallint,
    fecha timestamp without time zone,
    vih_cul_mosquito smallint,
    cih_cul_utencilios smallint,
    vigilancia smallint,
    cnd_quien_entrego smallint,
    gravidez smallint,
    partos smallint,
    nac_vivos smallint,
    abortos smallint,
    id integer NOT NULL
);


ALTER TABLE its_primeravez OWNER TO simagd;

--
-- Name: TABLE its_primeravez; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_primeravez IS 'Tabla que contiene los datos de ITS primera vez';


--
-- Name: COLUMN its_primeravez.id_its_primeravez; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.id_its_primeravez IS 'UNO';


--
-- Name: COLUMN its_primeravez.its_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.its_expediente IS 'UNO';


--
-- Name: COLUMN its_primeravez.id_historial; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.id_historial IS 'UNO';


--
-- Name: COLUMN its_primeravez.sif_prueba; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.sif_prueba IS '¿Se ha realizado la prueba de sífilis en los últimos 12 meses?';


--
-- Name: COLUMN its_primeravez.sif_conoce_resultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.sif_conoce_resultado IS '¿Conoce el resultado de la prueba de sífilis?';


--
-- Name: COLUMN its_primeravez.sif_tratamiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.sif_tratamiento IS '¿Recibió tratamiento contra la sífilis?';


--
-- Name: COLUMN its_primeravez.abs_abusado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.abs_abusado IS 'Â¿Ha sufrido abuso sexual?';


--
-- Name: COLUMN its_primeravez.abs_edad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.abs_edad IS 'Â¿A quÃ© edad?';


--
-- Name: COLUMN its_primeravez.hsd_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.hsd_tipo IS 'Â¿CÃ³mo se auto identifica usted sexualmente?';


--
-- Name: COLUMN its_primeravez.rlc_genero; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.rlc_genero IS 'Â¿Ha tenido relaciones sexuales con?';


--
-- Name: COLUMN its_primeravez.rlc_inicio_edad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.rlc_inicio_edad IS 'Edad inicio de relaciones sexuales';


--
-- Name: COLUMN its_primeravez.ts_ejerce; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.ts_ejerce IS 'Â¿Alguna vez ha ejercido el trabajo sexual?';


--
-- Name: COLUMN its_primeravez.ts_ejerce_actualmente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.ts_ejerce_actualmente IS 'Â¿Actualmente ejerce el trabajo sexual?';


--
-- Name: COLUMN its_primeravez.drg_consumo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.drg_consumo IS 'Alguna vez ha utilizado drogas?';


--
-- Name: COLUMN its_primeravez.sif_cumplio_tratamiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.sif_cumplio_tratamiento IS '¿Cumplió el tratamiento completo?';


--
-- Name: COLUMN its_primeravez.its_old; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.its_old IS 'Â¿En los Ãºltimos 12 meses tuvo una ITS?';


--
-- Name: COLUMN its_primeravez.vih_cul_pareja; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_cul_pareja IS '¿Tener una pareja fiel puede prevenir la transmisión del VIH?';


--
-- Name: COLUMN its_primeravez.ocp_adicional; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.ocp_adicional IS 'A que se dedica?';


--
-- Name: COLUMN its_primeravez.trb_lugar; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.trb_lugar IS 'Lugar de trabajo actual';


--
-- Name: COLUMN its_primeravez.vih_cul_uso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_cul_uso IS '¿El uso del condón en todas las relaciones sexuales puede prevenir la transmisión del VIH ?';


--
-- Name: COLUMN its_primeravez.ts_otro_depto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.ts_otro_depto IS 'Â¿El Ãºltimo aÃ±o realizÃ³ TS en otro departamento?';


--
-- Name: COLUMN its_primeravez.ts_otro_pais; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.ts_otro_pais IS 'Â¿En el Ãºltimo aÃ±o realizÃ³ TS en otro paÃ­s?';


--
-- Name: COLUMN its_primeravez.vih_cul_apariencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_cul_apariencia IS '¿Una persona de aspecto sano puede tener el VIH?';


--
-- Name: COLUMN its_primeravez.ts_tiempo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.ts_tiempo IS 'DESDE HACE CUANTO TIEMPO TRABAJA COMO TS';


--
-- Name: COLUMN its_primeravez.vih_old_consejeria; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_old_consejeria IS 'RecibiÃ³ConsejerÃ­a?';


--
-- Name: COLUMN its_primeravez.vih_old_prueba; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_old_prueba IS 'Se ha realizado la prueba de VIHen los Ãºltimos 12 meses:';


--
-- Name: COLUMN its_primeravez.vih_old_resultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_old_resultado IS 'Conoce el resultado?:';


--
-- Name: COLUMN its_primeravez.vih_old_resultado_resultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_old_resultado_resultado IS 'Si conoce el resultado; cual fue? :';


--
-- Name: COLUMN its_primeravez.fecha; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.fecha IS 'UNO';


--
-- Name: COLUMN its_primeravez.vih_cul_mosquito; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vih_cul_mosquito IS '¿Los mosquitos o zancudos no transmiten el VIH?';


--
-- Name: COLUMN its_primeravez.cih_cul_utencilios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.cih_cul_utencilios IS '¿No se puede infectar con VIH al usar tenedores; vasos u otros utensilios usados poruna persona con sida?';


--
-- Name: COLUMN its_primeravez.vigilancia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.vigilancia IS '0 es declinicas VISITS; 1 es de VIGILANCIA y 2 ambas ';


--
-- Name: COLUMN its_primeravez.cnd_quien_entrego; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.cnd_quien_entrego IS 'Quien entrego 1 MINSAL; 2 ONG';


--
-- Name: COLUMN its_primeravez.gravidez; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.gravidez IS 'Gravidez';


--
-- Name: COLUMN its_primeravez.partos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.partos IS 'No de Partos(Ya sea cesárea o vaginal)';


--
-- Name: COLUMN its_primeravez.nac_vivos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.nac_vivos IS 'Nacidos vivos';


--
-- Name: COLUMN its_primeravez.abortos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_primeravez.abortos IS 'Abortos';


--
-- Name: its_primeravez_id_its_primeravez_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_primeravez_id_its_primeravez_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_primeravez_id_its_primeravez_seq OWNER TO simagd;

--
-- Name: its_primeravez_id_its_primeravez_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_primeravez_id_its_primeravez_seq OWNED BY its_primeravez.id_its_primeravez;


--
-- Name: its_primeravez_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_primeravez_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_primeravez_id_seq OWNER TO simagd;

--
-- Name: its_primeravez_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_primeravez_id_seq OWNED BY its_primeravez.id;


--
-- Name: its_relaciones; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_relaciones (
    id_consulta integer NOT NULL,
    id_tipo_relacion integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_relaciones OWNER TO simagd;

--
-- Name: TABLE its_relaciones; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_relaciones IS 'tabla que almacena los tios de ralaciones sexuales que pactica el o la paciente';


--
-- Name: COLUMN its_relaciones.id_consulta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_relaciones.id_consulta IS 'ID tipo de realacion';


--
-- Name: COLUMN its_relaciones.id_tipo_relacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_relaciones.id_tipo_relacion IS 'Tipo de realaciones';


--
-- Name: its_relaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_relaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_relaciones_id_seq OWNER TO simagd;

--
-- Name: its_relaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_relaciones_id_seq OWNED BY its_relaciones.id;


--
-- Name: its_subsecuente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_subsecuente (
    id_consulta_subsecuente integer NOT NULL,
    id_historial integer NOT NULL,
    cnd_uso_old_pareja_casual smallint,
    cnd_uso_old_pareja_fija smallint,
    cnd_uso_pareja_casual smallint,
    cnd_uso_pareja_fija smallint,
    exa_bim_anexo smallint,
    exa_bim_anexo_hipogastrio smallint,
    exa_bim_anexo_masa smallint,
    exa_bim_anexo_palpacion_dolor smallint,
    exa_bim_anexo_sangrado smallint,
    cnd_uso_vi_pareja_fija_m smallint,
    exa_bim_cervix_dolor smallint,
    exa_bim_cervix_existencia smallint,
    exa_bim_utero smallint,
    exa_bim_utero_exixtencia smallint,
    exa_bim_volumen_aumento smallint,
    exa_gral_uretra smallint,
    exa_gral_vulva smallint,
    exa_spc_aminas_prueba smallint,
    exa_spc_cervix smallint,
    exa_spc_cervix_existencia smallint,
    exa_spc_flujo_aspecto integer,
    exa_spc_flujo_cantidad integer,
    exa_spc_flujo_color integer,
    exa_spc_flujo_olor integer,
    exa_spc_menstruacion smallint,
    exa_spc_vagina smallint,
    pja_casual smallint,
    pja_fija smallint,
    rlc_festivos_incrementa smallint,
    rlc_festivos_incrementa_cantidad integer,
    cnd_uso_anal smallint,
    cnd_uso_old_anal smallint,
    cnd_uso_old_pareja_casual_f smallint,
    cnd_uso_old_pareja_casual_m smallint,
    cnd_uso_old_pareja_fija_f smallint,
    cnd_uso_old_pareja_fija_m smallint,
    cnd_uso_pareja_casual_f smallint,
    cnd_uso_pareja_casual_m smallint,
    cnd_uso_pareja_fija_f smallint,
    cnd_uso_pareja_fija_m smallint,
    exa_gral_meatouretral smallint,
    exa_gral_pene smallint,
    exa_gral_prepucio_existencia smallint,
    exa_gral_testiculos smallint,
    pja_casual_f smallint,
    pja_casual_m smallint,
    pja_fija_f smallint,
    pja_fija_m smallint,
    alh_consumo smallint,
    cnd_recepcion smallint,
    cnd_entrega smallint,
    cnd_entrega_cantidad integer,
    cnd_relacion_tipo smallint,
    cnd_uso_old_cliente smallint,
    cnd_uso_ultimo_cliente smallint,
    exa_gral_abdomen smallint,
    exa_gral_adomegalia_ganglio smallint,
    exa_gral_ano smallint,
    exa_gral_boca smallint,
    exa_gral_ganglios smallint,
    exa_gral_rash smallint,
    pja_old_cantidad integer,
    rlc_old_cantidad integer,
    vih_consejeria integer,
    vih_old_informacion smallint,
    vih_prueba smallint,
    vih_referencia_pareja smallint,
    vih_solicitar_prueba smallint,
    its_expediente character varying(10) DEFAULT NULL::character varying,
    fecha timestamp without time zone,
    atc_uso smallint,
    fec_ult_regla date,
    embarazada smallint,
    diagnostico_confirmado smallint,
    alta smallint,
    id integer NOT NULL
);


ALTER TABLE its_subsecuente OWNER TO simagd;

--
-- Name: TABLE its_subsecuente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_subsecuente IS 'Tabla que contiene los datos de ITS consultas subsecuentes';


--
-- Name: COLUMN its_subsecuente.id_consulta_subsecuente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.id_consulta_subsecuente IS 'UNO';


--
-- Name: COLUMN its_subsecuente.id_historial; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.id_historial IS 'uno';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_pareja_casual; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_pareja_casual IS 'La Ãºltima vez con su pareja casual Â¿usÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_pareja_fija; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_pareja_fija IS 'Â¿Con su pareja estable utilizÃ³ condÃ³n en los Ãºltimos 30 dÃ­as?:';


--
-- Name: COLUMN its_subsecuente.cnd_uso_pareja_casual; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_pareja_casual IS 'UNO';


--
-- Name: COLUMN its_subsecuente.cnd_uso_pareja_fija; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_pareja_fija IS 'La Ãºltima vez con su pareja estable Â¿usÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.exa_bim_anexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_anexo IS 'Anexo';


--
-- Name: COLUMN its_subsecuente.exa_bim_anexo_hipogastrio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_anexo_hipogastrio IS 'Hipogastrio';


--
-- Name: COLUMN its_subsecuente.exa_bim_anexo_masa; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_anexo_masa IS 'Masa';


--
-- Name: COLUMN its_subsecuente.exa_bim_anexo_palpacion_dolor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_anexo_palpacion_dolor IS 'Dolor a la palpaciÃ³n';


--
-- Name: COLUMN its_subsecuente.exa_bim_anexo_sangrado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_anexo_sangrado IS 'Sangrado anormal';


--
-- Name: COLUMN its_subsecuente.cnd_uso_vi_pareja_fija_m; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_vi_pareja_fija_m IS '¿Utilizo condón en las relaciones sexuales con su pareja estable hombre en los últimos 6 meses?';


--
-- Name: COLUMN its_subsecuente.exa_bim_cervix_dolor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_cervix_dolor IS 'Dolor con movimiento';


--
-- Name: COLUMN its_subsecuente.exa_bim_cervix_existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_cervix_existencia IS 'Existencia del Cervix';


--
-- Name: COLUMN its_subsecuente.exa_bim_utero; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_utero IS 'Ãštero';


--
-- Name: COLUMN its_subsecuente.exa_bim_utero_exixtencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_utero_exixtencia IS 'Existencia del Ãštero';


--
-- Name: COLUMN its_subsecuente.exa_bim_volumen_aumento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_bim_volumen_aumento IS 'Aumentado de volumen';


--
-- Name: COLUMN its_subsecuente.exa_gral_uretra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_uretra IS 'Uretra';


--
-- Name: COLUMN its_subsecuente.exa_gral_vulva; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_vulva IS 'Vulva';


--
-- Name: COLUMN its_subsecuente.exa_spc_aminas_prueba; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_aminas_prueba IS 'Prueba aminas';


--
-- Name: COLUMN its_subsecuente.exa_spc_cervix; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_cervix IS 'Cevix';


--
-- Name: COLUMN its_subsecuente.exa_spc_cervix_existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_cervix_existencia IS 'Existencia del Cervix';


--
-- Name: COLUMN its_subsecuente.exa_spc_flujo_aspecto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_flujo_aspecto IS 'Aspecto';


--
-- Name: COLUMN its_subsecuente.exa_spc_flujo_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_flujo_cantidad IS 'Cantidad';


--
-- Name: COLUMN its_subsecuente.exa_spc_flujo_color; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_flujo_color IS 'Color';


--
-- Name: COLUMN its_subsecuente.exa_spc_flujo_olor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_flujo_olor IS 'Olor fÃ©tido';


--
-- Name: COLUMN its_subsecuente.exa_spc_menstruacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_menstruacion IS 'MenstruaciÃ³n presente';


--
-- Name: COLUMN its_subsecuente.exa_spc_vagina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_spc_vagina IS 'Vagina';


--
-- Name: COLUMN its_subsecuente.pja_casual; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.pja_casual IS 'Â¿Tiene pareja CASUAL?';


--
-- Name: COLUMN its_subsecuente.pja_fija; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.pja_fija IS 'Â¿Tiene pareja ESTABLE o FIJA?';


--
-- Name: COLUMN its_subsecuente.rlc_festivos_incrementa; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.rlc_festivos_incrementa IS 'Incrementa el numero de relaciones sexuales en Ã©poca de vacaciones o dÃ­as festivos';


--
-- Name: COLUMN its_subsecuente.rlc_festivos_incrementa_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.rlc_festivos_incrementa_cantidad IS 'Cuantas relaciones se incrementan por dÃ­a en esta Ã©poca';


--
-- Name: COLUMN its_subsecuente.cnd_uso_anal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_anal IS 'Â¿En suÃºltima relaciÃ³n sexual anal utilizÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_anal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_anal IS 'Â¿Ha tenido relaciones sexuales anales con otros hombres diferentes de su pareja enlos Ãºltimos 6 meses?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_pareja_casual_f; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_pareja_casual_f IS 'Â¿UtilizÃ³ condÃ³n en los Ãºltimos 30 dÃ­as?:';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_pareja_casual_m; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_pareja_casual_m IS 'Â¿UtilizÃ³ condÃ³n en los Ãºltimos 30 dÃ­as?: ';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_pareja_fija_f; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_pareja_fija_f IS 'Â¿UtilizÃ³ condÃ³n en los Ãºltimos 30 dÃ­as?: ';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_pareja_fija_m; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_pareja_fija_m IS 'Â¿UtilizÃ³ condÃ³n en los Ãºltimos 30 dÃ­as?: ';


--
-- Name: COLUMN its_subsecuente.cnd_uso_pareja_casual_f; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_pareja_casual_f IS 'La Ãºltima vezÂ¿usÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_pareja_casual_m; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_pareja_casual_m IS 'La Ãºltima vezÂ¿usÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_pareja_fija_f; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_pareja_fija_f IS 'La Ãºltima vezÂ¿usÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_pareja_fija_m; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_pareja_fija_m IS 'La Ãºltima vezÂ¿usÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.exa_gral_meatouretral; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_meatouretral IS 'Meato uretral';


--
-- Name: COLUMN its_subsecuente.exa_gral_pene; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_pene IS 'Pene';


--
-- Name: COLUMN its_subsecuente.exa_gral_prepucio_existencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_prepucio_existencia IS 'Prepucio';


--
-- Name: COLUMN its_subsecuente.exa_gral_testiculos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_testiculos IS 'TestÃ­culos';


--
-- Name: COLUMN its_subsecuente.pja_casual_f; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.pja_casual_f IS 'Tiene pareja CASUAL Mujer?';


--
-- Name: COLUMN its_subsecuente.pja_casual_m; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.pja_casual_m IS 'Tiene pareja CASUAL Hombre?';


--
-- Name: COLUMN its_subsecuente.pja_fija_f; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.pja_fija_f IS 'Â¿Tiene pareja ESTABLE o FIJA Mujer?';


--
-- Name: COLUMN its_subsecuente.pja_fija_m; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.pja_fija_m IS 'Â¿Tiene pareja ESTABLE o FIJA Hombre?';


--
-- Name: COLUMN its_subsecuente.alh_consumo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.alh_consumo IS 'En los Ãºltimos 30 dÃ­as; consumiÃ³ bebidas alcohÃ³licascerveza; ron; whisky;etc.';


--
-- Name: COLUMN its_subsecuente.cnd_recepcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_recepcion IS 'Â¿Ha recibido condones en los Ãºltimos doce meses?';


--
-- Name: COLUMN its_subsecuente.cnd_entrega; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_entrega IS 'Preservativos entregados:';


--
-- Name: COLUMN its_subsecuente.cnd_entrega_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_entrega_cantidad IS 'Cantidad';


--
-- Name: COLUMN its_subsecuente.cnd_relacion_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_relacion_tipo IS 'Â¿En los Ãºltimos 30 dÃ­as ha tenido relaciones anales?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_old_cliente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_old_cliente IS 'Â¿Con sus clientes usÃ³ condÃ³n en los Ãºltimos 30 dÃ­as?';


--
-- Name: COLUMN its_subsecuente.cnd_uso_ultimo_cliente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.cnd_uso_ultimo_cliente IS 'La Ãºltima vez con un cliente Â¿usÃ³ condÃ³n?';


--
-- Name: COLUMN its_subsecuente.exa_gral_abdomen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_abdomen IS 'Abdomen (dolor a la palpaciÃ³n)';


--
-- Name: COLUMN its_subsecuente.exa_gral_adomegalia_ganglio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_adomegalia_ganglio IS 'Es adenomegalia';


--
-- Name: COLUMN its_subsecuente.exa_gral_ano; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_ano IS 'Ano';


--
-- Name: COLUMN its_subsecuente.exa_gral_boca; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_boca IS 'Boca';


--
-- Name: COLUMN its_subsecuente.exa_gral_ganglios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_ganglios IS 'Ganglios';


--
-- Name: COLUMN its_subsecuente.exa_gral_rash; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.exa_gral_rash IS 'Rash';


--
-- Name: COLUMN its_subsecuente.pja_old_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.pja_old_cantidad IS 'Â¿NÃºmero de parejas en la Ãºltima quincena?';


--
-- Name: COLUMN its_subsecuente.rlc_old_cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.rlc_old_cantidad IS 'Â¿NÃºmero de relaciones en la Ãºltima quincena?';


--
-- Name: COLUMN its_subsecuente.vih_consejeria; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.vih_consejeria IS 'RecibiÃ³ consejerÃ­a VIH';


--
-- Name: COLUMN its_subsecuente.vih_old_informacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.vih_old_informacion IS 'Â¿Ha recibido informaciÃ³n sobre prevenciÃ³n del VIH en los Ãºltimos 12 meses?';


--
-- Name: COLUMN its_subsecuente.vih_prueba; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.vih_prueba IS 'Se prescribe prueba de VIH';


--
-- Name: COLUMN its_subsecuente.vih_referencia_pareja; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.vih_referencia_pareja IS 'Referencia de pareja/contactos para tratamiento';


--
-- Name: COLUMN its_subsecuente.vih_solicitar_prueba; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.vih_solicitar_prueba IS 'Â¿Sabea donde puede ir asolicitarlaprueba de VIH?';


--
-- Name: COLUMN its_subsecuente.its_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.its_expediente IS 'ID del expediente de laconsulta';


--
-- Name: COLUMN its_subsecuente.fecha; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.fecha IS 'fecha en que se realizo la consulta';


--
-- Name: COLUMN its_subsecuente.fec_ult_regla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.fec_ult_regla IS 'Fecha de Ultima Regla';


--
-- Name: COLUMN its_subsecuente.embarazada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_subsecuente.embarazada IS 'Esta embarazada';


--
-- Name: its_subsecuente_id_consulta_subsecuente_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_subsecuente_id_consulta_subsecuente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_subsecuente_id_consulta_subsecuente_seq OWNER TO simagd;

--
-- Name: its_subsecuente_id_consulta_subsecuente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_subsecuente_id_consulta_subsecuente_seq OWNED BY its_subsecuente.id_consulta_subsecuente;


--
-- Name: its_subsecuente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_subsecuente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_subsecuente_id_seq OWNER TO simagd;

--
-- Name: its_subsecuente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_subsecuente_id_seq OWNED BY its_subsecuente.id;


--
-- Name: its_tipos_its; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_tipos_its (
    id_tipo_its integer NOT NULL,
    its_tipo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_tipos_its OWNER TO simagd;

--
-- Name: TABLE its_tipos_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_tipos_its IS 'Tabla almacena los tipos de infecciones de transmision sexua';


--
-- Name: COLUMN its_tipos_its.id_tipo_its; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_tipos_its.id_tipo_its IS 'ID del tipo de infecciones de transmision sexual';


--
-- Name: COLUMN its_tipos_its.its_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_tipos_its.its_tipo IS 'El Nombre del tipo de infecciones de transmision sexual';


--
-- Name: its_tipos_its_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_tipos_its_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_tipos_its_id_seq OWNER TO simagd;

--
-- Name: its_tipos_its_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_tipos_its_id_seq OWNED BY its_tipos_its.id;


--
-- Name: its_tipos_trabajo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE its_tipos_trabajo (
    id_tipo_trabajo integer NOT NULL,
    trabajo_tipo character varying(30) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE its_tipos_trabajo OWNER TO simagd;

--
-- Name: TABLE its_tipos_trabajo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE its_tipos_trabajo IS 'Tabla almacena los tipos de trabajo: local, calle, etc';


--
-- Name: COLUMN its_tipos_trabajo.id_tipo_trabajo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_tipos_trabajo.id_tipo_trabajo IS 'ID del tipo de trabajo: local; calle; etc';


--
-- Name: COLUMN its_tipos_trabajo.trabajo_tipo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN its_tipos_trabajo.trabajo_tipo IS 'El Nombre del tipo de trabajo: local; calle; etc';


--
-- Name: its_tipos_trabajo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE its_tipos_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE its_tipos_trabajo_id_seq OWNER TO simagd;

--
-- Name: its_tipos_trabajo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE its_tipos_trabajo_id_seq OWNED BY its_tipos_trabajo.id;


--
-- Name: lab_antibioticos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_antibioticos (
    id integer NOT NULL,
    antibiotico character varying(75) NOT NULL,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone
);


ALTER TABLE lab_antibioticos OWNER TO simagd;

--
-- Name: COLUMN lab_antibioticos.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticos.id IS 'Identificador unico de la tabla';


--
-- Name: lab_antibioticos_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_antibioticos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_antibioticos_id_seq OWNER TO simagd;

--
-- Name: lab_antibioticos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_antibioticos_id_seq OWNED BY lab_antibioticos.id;


--
-- Name: lab_antibioticosportarjeta; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_antibioticosportarjeta (
    id integer NOT NULL,
    idantibiotico integer,
    idtarjeta integer,
    idestablecimiento integer,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    habilitado boolean DEFAULT true NOT NULL
);


ALTER TABLE lab_antibioticosportarjeta OWNER TO simagd;

--
-- Name: TABLE lab_antibioticosportarjeta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_antibioticosportarjeta IS 'Tabla que contiene la configuración de los antibióticos que tiene cada tarjeta vitek o manual';


--
-- Name: COLUMN lab_antibioticosportarjeta.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.id IS 'Id correlativo del registro';


--
-- Name: COLUMN lab_antibioticosportarjeta.idantibiotico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.idantibiotico IS 'Id del antibiótico';


--
-- Name: COLUMN lab_antibioticosportarjeta.idtarjeta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.idtarjeta IS 'Código de la tarjeta';


--
-- Name: COLUMN lab_antibioticosportarjeta.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.idestablecimiento IS 'Código del establecimiento';


--
-- Name: COLUMN lab_antibioticosportarjeta.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_antibioticosportarjeta.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_antibioticosportarjeta.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_antibioticosportarjeta.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_antibioticosportarjeta.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: lab_antibioticosportarjeta_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_antibioticosportarjeta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_antibioticosportarjeta_id_seq OWNER TO simagd;

--
-- Name: lab_antibioticosportarjeta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_antibioticosportarjeta_id_seq OWNED BY lab_antibioticosportarjeta.id;


--
-- Name: lab_areasxestablecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_areasxestablecimiento (
    id integer NOT NULL,
    idestablecimiento integer NOT NULL,
    condicion character(1) DEFAULT true NOT NULL,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    idarea integer NOT NULL
);


ALTER TABLE lab_areasxestablecimiento OWNER TO simagd;

--
-- Name: TABLE lab_areasxestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_areasxestablecimiento IS 'Contiene las Áreas por cada Establecimieno';


--
-- Name: COLUMN lab_areasxestablecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_areasxestablecimiento.id IS 'Id del registro';


--
-- Name: COLUMN lab_areasxestablecimiento.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_areasxestablecimiento.idestablecimiento IS 'Id del establecimiento de salud';


--
-- Name: COLUMN lab_areasxestablecimiento.condicion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_areasxestablecimiento.condicion IS 'Bandera que indica si una área esta habilitado o no';


--
-- Name: COLUMN lab_areasxestablecimiento.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_areasxestablecimiento.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_areasxestablecimiento.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_areasxestablecimiento.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_areasxestablecimiento.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_areasxestablecimiento.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_areasxestablecimiento.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_areasxestablecimiento.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: lab_areasxestablecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_areasxestablecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_areasxestablecimiento_id_seq OWNER TO simagd;

--
-- Name: lab_areasxestablecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_areasxestablecimiento_id_seq OWNED BY lab_areasxestablecimiento.id;


--
-- Name: lab_bacterias; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_bacterias (
    id integer NOT NULL,
    bacteria character varying(75),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    habilitado character(1) DEFAULT NULL::bpchar
);


ALTER TABLE lab_bacterias OWNER TO simagd;

--
-- Name: TABLE lab_bacterias; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_bacterias IS 'Contiene las Áreas por cada Establecimieno';


--
-- Name: COLUMN lab_bacterias.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_bacterias.id IS 'Id del registro de la bacteria';


--
-- Name: COLUMN lab_bacterias.bacteria; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_bacterias.bacteria IS 'Nombre de la Bacteria';


--
-- Name: COLUMN lab_bacterias.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_bacterias.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_bacterias.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_bacterias.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_bacterias.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_bacterias.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_bacterias.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_bacterias.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: COLUMN lab_bacterias.habilitado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_bacterias.habilitado IS 'Activar o desactivar una bacteria';


--
-- Name: lab_bacterias_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_bacterias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_bacterias_id_seq OWNER TO simagd;

--
-- Name: lab_bacterias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_bacterias_id_seq OWNED BY lab_bacterias.id;


--
-- Name: lab_cantidadestincion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_cantidadestincion (
    id integer NOT NULL,
    cantidadtincion character varying(100),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone
);


ALTER TABLE lab_cantidadestincion OWNER TO simagd;

--
-- Name: TABLE lab_cantidadestincion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_cantidadestincion IS 'Tabla que contiene el catálogo de cantidades usadas en el resultado de la coloración de gram.';


--
-- Name: COLUMN lab_cantidadestincion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_cantidadestincion.id IS 'Id del registro del nombre de la cantidad';


--
-- Name: COLUMN lab_cantidadestincion.cantidadtincion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_cantidadestincion.cantidadtincion IS 'Nombre de la cantidad de tinción';


--
-- Name: COLUMN lab_cantidadestincion.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_cantidadestincion.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_cantidadestincion.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_cantidadestincion.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_cantidadestincion.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_cantidadestincion.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_cantidadestincion.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_cantidadestincion.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: lab_cantidadestincion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_cantidadestincion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_cantidadestincion_id_seq OWNER TO simagd;

--
-- Name: lab_cantidadestincion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_cantidadestincion_id_seq OWNED BY lab_cantidadestincion.id;


--
-- Name: lab_codigosresultados; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_codigosresultados (
    id integer NOT NULL,
    resultado character varying(25)
);


ALTER TABLE lab_codigosresultados OWNER TO simagd;

--
-- Name: TABLE lab_codigosresultados; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_codigosresultados IS 'Tabla de Códigos de resultados para tabular';


--
-- Name: COLUMN lab_codigosresultados.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_codigosresultados.id IS 'Id del registro del resultado';


--
-- Name: COLUMN lab_codigosresultados.resultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_codigosresultados.resultado IS 'Descripción del resultado';


--
-- Name: lab_codigosresultados_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_codigosresultados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_codigosresultados_id_seq OWNER TO simagd;

--
-- Name: lab_codigosresultados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_codigosresultados_id_seq OWNED BY lab_codigosresultados.id;


--
-- Name: lab_codigosxexamen; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_codigosxexamen (
    id integer NOT NULL,
    idresultado integer,
    idestandar integer
);


ALTER TABLE lab_codigosxexamen OWNER TO simagd;

--
-- Name: COLUMN lab_codigosxexamen.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_codigosxexamen.id IS 'Identificador unico de la tabla';


--
-- Name: COLUMN lab_codigosxexamen.idresultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_codigosxexamen.idresultado IS 'Campo que se relaciona con la tabla lab_codigosresultados';


--
-- Name: COLUMN lab_codigosxexamen.idestandar; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_codigosxexamen.idestandar IS 'Campo que se relaciona con la tabla ctl_examen_servicio_apoyo';


--
-- Name: lab_codigosxexamen_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_codigosxexamen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_codigosxexamen_id_seq OWNER TO simagd;

--
-- Name: lab_codigosxexamen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_codigosxexamen_id_seq OWNED BY lab_codigosxexamen.id;


--
-- Name: lab_datosfijosresultado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_datosfijosresultado (
    id integer NOT NULL,
    unidades character varying(20),
    rangoinicio double precision,
    rangofin double precision,
    nota character varying(250),
    idestablecimiento integer NOT NULL,
    fechaini date,
    fechafin date,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    idsexo integer,
    idedad integer NOT NULL,
    idarea integer,
    idexamen integer
);


ALTER TABLE lab_datosfijosresultado OWNER TO simagd;

--
-- Name: TABLE lab_datosfijosresultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_datosfijosresultado IS 'Tabla de maneja los datos de unidades y rangos para la plantilla A';


--
-- Name: COLUMN lab_datosfijosresultado.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.id IS 'Id del registro';


--
-- Name: COLUMN lab_datosfijosresultado.unidades; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.unidades IS 'Unidades el examen';


--
-- Name: COLUMN lab_datosfijosresultado.rangoinicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.rangoinicio IS 'valor de inicio de los valores normales';


--
-- Name: COLUMN lab_datosfijosresultado.rangofin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.rangofin IS 'valor fin de los valores normales';


--
-- Name: COLUMN lab_datosfijosresultado.nota; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.nota IS 'Comentario que debe aparecer en el examen';


--
-- Name: COLUMN lab_datosfijosresultado.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.idestablecimiento IS 'Código del establecimiento';


--
-- Name: COLUMN lab_datosfijosresultado.fechaini; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.fechaini IS 'Fecha en que entra en vigencia estos rangos y valores normales';


--
-- Name: COLUMN lab_datosfijosresultado.fechafin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.fechafin IS 'Fecha en que finaliza la vigencia de los valores y rangos de referencia';


--
-- Name: COLUMN lab_datosfijosresultado.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_datosfijosresultado.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_datosfijosresultado.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_datosfijosresultado.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: COLUMN lab_datosfijosresultado.idsexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.idsexo IS 'Sexo del dato de valor normal';


--
-- Name: COLUMN lab_datosfijosresultado.idedad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_datosfijosresultado.idedad IS 'Edad del dato de valor normal';


--
-- Name: lab_datosfijosresultado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_datosfijosresultado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_datosfijosresultado_id_seq OWNER TO simagd;

--
-- Name: lab_datosfijosresultado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_datosfijosresultado_id_seq OWNED BY lab_datosfijosresultado.id;


--
-- Name: lab_detalleresultado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_detalleresultado (
    id integer NOT NULL,
    idresultado integer,
    idelemento integer,
    idsubelemento integer,
    resultado character varying(200),
    idbacteria integer,
    idtarjeta integer,
    observacion character varying(250),
    cantidad text,
    idcantidad integer,
    idprocedimiento integer,
    idestablecimiento integer NOT NULL
);


ALTER TABLE lab_detalleresultado OWNER TO simagd;

--
-- Name: COLUMN lab_detalleresultado.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.id IS 'Id del registro';


--
-- Name: COLUMN lab_detalleresultado.idresultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.idresultado IS 'Código del resultado ';


--
-- Name: COLUMN lab_detalleresultado.idelemento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.idelemento IS 'Código del elemento del examen';


--
-- Name: COLUMN lab_detalleresultado.idsubelemento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.idsubelemento IS 'Códico del sub-elemento';


--
-- Name: COLUMN lab_detalleresultado.resultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.resultado IS 'Resultado del exámen';


--
-- Name: COLUMN lab_detalleresultado.idbacteria; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.idbacteria IS 'Código de la bacteria';


--
-- Name: COLUMN lab_detalleresultado.idtarjeta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.idtarjeta IS 'Código de la tarjeta utilizada';


--
-- Name: COLUMN lab_detalleresultado.observacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.observacion IS 'Observación del resultado';


--
-- Name: COLUMN lab_detalleresultado.cantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.cantidad IS 'Cantidad de Bacterias encontradas';


--
-- Name: COLUMN lab_detalleresultado.idcantidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.idcantidad IS 'Código de la cantidad de bacterias encontradas';


--
-- Name: COLUMN lab_detalleresultado.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_detalleresultado.idestablecimiento IS 'Código del establecimiento';


--
-- Name: lab_detalleresultado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_detalleresultado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_detalleresultado_id_seq OWNER TO simagd;

--
-- Name: lab_detalleresultado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_detalleresultado_id_seq OWNED BY lab_detalleresultado.id;


--
-- Name: lab_elementos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_elementos (
    id integer NOT NULL,
    subelemento character varying(1),
    elemento character varying(150),
    unidadelem character varying(30),
    observelem character varying(250),
    idestablecimiento integer NOT NULL,
    fechaini date,
    fechafin date,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    idexamen integer
);


ALTER TABLE lab_elementos OWNER TO simagd;

--
-- Name: COLUMN lab_elementos.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.id IS 'Id del registro';


--
-- Name: COLUMN lab_elementos.subelemento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.subelemento IS 'Bandera que indica si el elemento tiene o no sub-elementos';


--
-- Name: COLUMN lab_elementos.elemento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.elemento IS 'Nombre del Elemento';


--
-- Name: COLUMN lab_elementos.unidadelem; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.unidadelem IS 'Unidad del Elemento';


--
-- Name: COLUMN lab_elementos.observelem; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.observelem IS 'Observación del Elemento';


--
-- Name: COLUMN lab_elementos.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN lab_elementos.fechaini; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.fechaini IS 'Fecha de inicio del formato del examen';


--
-- Name: COLUMN lab_elementos.fechafin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.fechafin IS 'Fecha Final del Formato del examen';


--
-- Name: COLUMN lab_elementos.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_elementos.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_elementos.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_elementos.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: COLUMN lab_elementos.idexamen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementos.idexamen IS 'Identificador del examen al que pertenece el elemento';


--
-- Name: lab_elementos_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_elementos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_elementos_id_seq OWNER TO simagd;

--
-- Name: lab_elementos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_elementos_id_seq OWNED BY lab_elementos.id;


--
-- Name: lab_elementostincion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_elementostincion (
    elementotincion character varying(200),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    id integer NOT NULL
);


ALTER TABLE lab_elementostincion OWNER TO simagd;

--
-- Name: COLUMN lab_elementostincion.elementotincion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementostincion.elementotincion IS 'Nombre del Elemento de Tinción';


--
-- Name: COLUMN lab_elementostincion.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementostincion.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_elementostincion.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementostincion.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_elementostincion.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementostincion.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_elementostincion.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementostincion.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: COLUMN lab_elementostincion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_elementostincion.id IS 'Llave primaria';


--
-- Name: lab_elementostincion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_elementostincion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_elementostincion_id_seq OWNER TO simagd;

--
-- Name: lab_elementostincion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_elementostincion_id_seq OWNED BY lab_elementostincion.id;


--
-- Name: lab_estandarxgrupo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_estandarxgrupo (
    idgrupo character varying(4) NOT NULL,
    nombregrupo character varying(50),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    id integer NOT NULL
);


ALTER TABLE lab_estandarxgrupo OWNER TO simagd;

--
-- Name: COLUMN lab_estandarxgrupo.idgrupo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_estandarxgrupo.idgrupo IS 'Código del Grupo de Estandares';


--
-- Name: COLUMN lab_estandarxgrupo.nombregrupo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_estandarxgrupo.nombregrupo IS 'Nombre del grupo de estandares ';


--
-- Name: COLUMN lab_estandarxgrupo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_estandarxgrupo.id IS 'Llave primaria';


--
-- Name: lab_estandarxgrupo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_estandarxgrupo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_estandarxgrupo_id_seq OWNER TO simagd;

--
-- Name: lab_estandarxgrupo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_estandarxgrupo_id_seq OWNED BY lab_estandarxgrupo.id;


--
-- Name: lab_examenesxestablecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_examenesxestablecimiento (
    id integer NOT NULL,
    condicion character varying NOT NULL,
    idformulario integer NOT NULL,
    urgente integer,
    impresion character(1),
    ubicacion smallint,
    codigosumi character varying(8),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    nombre_examen character varying(250),
    idestandarrep integer NOT NULL,
    idplantilla integer NOT NULL
);


ALTER TABLE lab_examenesxestablecimiento OWNER TO simagd;

--
-- Name: TABLE lab_examenesxestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_examenesxestablecimiento IS 'Contiene la informacion de los exámenes por establecimiento';


--
-- Name: COLUMN lab_examenesxestablecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_examenesxestablecimiento.id IS 'Id del registro';


--
-- Name: COLUMN lab_examenesxestablecimiento.condicion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_examenesxestablecimiento.condicion IS 'Bandera que indica si una Examen esta habilitado o no en el establecimiento';


--
-- Name: COLUMN lab_examenesxestablecimiento.idformulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_examenesxestablecimiento.idformulario IS 'Código del Programa de salud al que pertenece el examen';


--
-- Name: lab_examenesxestablecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_examenesxestablecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_examenesxestablecimiento_id_seq OWNER TO simagd;

--
-- Name: lab_examenesxestablecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_examenesxestablecimiento_id_seq OWNED BY lab_examenesxestablecimiento.id;


--
-- Name: lab_observaciones; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_observaciones (
    observacion character varying(250),
    tiporespuesta character(1),
    idusuarioreg smallint,
    fechahorareg timestamp without time zone,
    idusuariomod smallint,
    fechahoramod timestamp without time zone,
    id integer NOT NULL,
    idarea integer NOT NULL
);


ALTER TABLE lab_observaciones OWNER TO simagd;

--
-- Name: COLUMN lab_observaciones.observacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_observaciones.observacion IS 'Descripción de la Observación';


--
-- Name: COLUMN lab_observaciones.tiporespuesta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_observaciones.tiporespuesta IS 'Tipo de Respuesta P=Positiva N=negativa O=otros';


--
-- Name: COLUMN lab_observaciones.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_observaciones.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_observaciones.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_observaciones.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_observaciones.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_observaciones.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_observaciones.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_observaciones.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: lab_observaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_observaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_observaciones_id_seq OWNER TO simagd;

--
-- Name: lab_observaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_observaciones_id_seq OWNED BY lab_observaciones.id;


--
-- Name: lab_plantilla; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_plantilla (
    idplantilla character(1) NOT NULL,
    plantilla character varying(30),
    id integer NOT NULL
);


ALTER TABLE lab_plantilla OWNER TO simagd;

--
-- Name: TABLE lab_plantilla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_plantilla IS 'contiene los nombre de las plantillas para los exámenes';


--
-- Name: COLUMN lab_plantilla.idplantilla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_plantilla.idplantilla IS 'Código de la Platilla';


--
-- Name: COLUMN lab_plantilla.plantilla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_plantilla.plantilla IS 'Nombre de la plantilla';


--
-- Name: lab_plantilla_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_plantilla_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_plantilla_id_seq OWNER TO simagd;

--
-- Name: lab_plantilla_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_plantilla_id_seq OWNED BY lab_plantilla.id;


--
-- Name: lab_procedimientosporexamen; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_procedimientosporexamen (
    id integer NOT NULL,
    nombreprocedimiento character varying(150),
    unidades character varying(60),
    rangoinicio double precision,
    rangofin double precision,
    controldiario character varying(150),
    idestablecimiento integer NOT NULL,
    fechaini date,
    fechafin date,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    idsexo integer,
    idrangoedad integer NOT NULL,
    idarea integer NOT NULL,
    idexamen integer NOT NULL
);


ALTER TABLE lab_procedimientosporexamen OWNER TO simagd;

--
-- Name: COLUMN lab_procedimientosporexamen.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.id IS 'Id del registro';


--
-- Name: COLUMN lab_procedimientosporexamen.nombreprocedimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.nombreprocedimiento IS 'Código del resultado';


--
-- Name: COLUMN lab_procedimientosporexamen.unidades; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.unidades IS 'Resultado del exámen';


--
-- Name: COLUMN lab_procedimientosporexamen.rangoinicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.rangoinicio IS 'Código de la bacteria';


--
-- Name: COLUMN lab_procedimientosporexamen.rangofin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.rangofin IS 'Código de la tarjeta utilizada';


--
-- Name: COLUMN lab_procedimientosporexamen.controldiario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.controldiario IS 'Observación del resultado';


--
-- Name: COLUMN lab_procedimientosporexamen.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.idestablecimiento IS 'Código del establecimiento';


--
-- Name: COLUMN lab_procedimientosporexamen.fechaini; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.fechaini IS 'Fecha en que inicia los valores y rango de referencia';


--
-- Name: COLUMN lab_procedimientosporexamen.fechafin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.fechafin IS 'Fecha en que finaliza los valores y rangos de referencia';


--
-- Name: COLUMN lab_procedimientosporexamen.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_procedimientosporexamen.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_procedimientosporexamen.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_procedimientosporexamen.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_procedimientosporexamen.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: lab_procedimientosporexamen_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_procedimientosporexamen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_procedimientosporexamen_id_seq OWNER TO simagd;

--
-- Name: lab_procedimientosporexamen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_procedimientosporexamen_id_seq OWNED BY lab_procedimientosporexamen.id;


--
-- Name: lab_recepcionmuestra; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_recepcionmuestra (
    id integer NOT NULL,
    numeromuestra integer,
    fecharecepcion date,
    idsolicitudestudio integer,
    fechacita date NOT NULL,
    idestablecimiento integer NOT NULL,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    observacion character varying(250)
);


ALTER TABLE lab_recepcionmuestra OWNER TO simagd;

--
-- Name: TABLE lab_recepcionmuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_recepcionmuestra IS 'contiene la información sobre la recepción de las muestras';


--
-- Name: COLUMN lab_recepcionmuestra.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_recepcionmuestra.id IS 'Id del registro';


--
-- Name: COLUMN lab_recepcionmuestra.numeromuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_recepcionmuestra.numeromuestra IS 'Número de  la muestra';


--
-- Name: COLUMN lab_recepcionmuestra.fecharecepcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_recepcionmuestra.fecharecepcion IS 'Fecha de recepción de la muestra';


--
-- Name: COLUMN lab_recepcionmuestra.fechacita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_recepcionmuestra.fechacita IS 'Fecha de la cita';


--
-- Name: COLUMN lab_recepcionmuestra.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_recepcionmuestra.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN lab_recepcionmuestra.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_recepcionmuestra.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_recepcionmuestra.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_recepcionmuestra.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: lab_recepcionmuestra_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_recepcionmuestra_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_recepcionmuestra_id_seq OWNER TO simagd;

--
-- Name: lab_recepcionmuestra_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_recepcionmuestra_id_seq OWNED BY lab_recepcionmuestra.id;


--
-- Name: lab_resultados; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_resultados (
    idsolicitudestudio integer,
    iddetallesolicitud integer,
    idrecepcionmuestra integer,
    resultado character varying(250),
    lectura character varying(100),
    interpretacion character varying(100),
    observacion character varying(250),
    responsable character varying(7),
    idcodigoresultado integer,
    idestablecimiento integer,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    id integer NOT NULL,
    id_observacion integer,
    idexamen integer NOT NULL
);


ALTER TABLE lab_resultados OWNER TO simagd;

--
-- Name: COLUMN lab_resultados.idsolicitudestudio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.idsolicitudestudio IS 'Código de la solicitud de estudios';


--
-- Name: COLUMN lab_resultados.iddetallesolicitud; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.iddetallesolicitud IS 'Código de la solicitud';


--
-- Name: COLUMN lab_resultados.idrecepcionmuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.idrecepcionmuestra IS 'Código del recepción de la solicitud en el laboratorio';


--
-- Name: COLUMN lab_resultados.resultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.resultado IS 'Resultado de la prueba validada';


--
-- Name: COLUMN lab_resultados.lectura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.lectura IS 'lectura de la prueba';


--
-- Name: COLUMN lab_resultados.interpretacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.interpretacion IS 'Interpretación del resultado de la prueba';


--
-- Name: COLUMN lab_resultados.observacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.observacion IS 'Observación sobre el resultado de la muestra';


--
-- Name: COLUMN lab_resultados.responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.responsable IS 'Código del empleado que valida la prueba';


--
-- Name: COLUMN lab_resultados.idcodigoresultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.idcodigoresultado IS 'Codificación del resultado 1 normal 2 anormal etc.';


--
-- Name: COLUMN lab_resultados.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.idestablecimiento IS 'Código del establecimiento que realizó la prueba';


--
-- Name: COLUMN lab_resultados.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.idusuarioreg IS 'Correlativo del usuario que ingresa el registro';


--
-- Name: COLUMN lab_resultados.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.fechahorareg IS 'Fecha y Hora en que se ingreso el registro';


--
-- Name: COLUMN lab_resultados.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_resultados.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultados.fechahoramod IS 'Fecha y hora en que se modifica el registro';


--
-- Name: lab_resultados_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_resultados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_resultados_id_seq OWNER TO simagd;

--
-- Name: lab_resultados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_resultados_id_seq OWNED BY lab_resultados.id;


--
-- Name: lab_resultadosportarjeta; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_resultadosportarjeta (
    iddetalleresultado integer,
    idantibiotico integer,
    resultado character varying(10),
    valor character varying(20),
    idestablecimiento integer,
    id integer NOT NULL
);


ALTER TABLE lab_resultadosportarjeta OWNER TO simagd;

--
-- Name: COLUMN lab_resultadosportarjeta.iddetalleresultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultadosportarjeta.iddetalleresultado IS 'Código del detalle del resultado';


--
-- Name: COLUMN lab_resultadosportarjeta.idantibiotico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultadosportarjeta.idantibiotico IS 'Código del antibiotico';


--
-- Name: COLUMN lab_resultadosportarjeta.resultado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultadosportarjeta.resultado IS 'Resultado de la sensibilidad o resistencia para eliminar la bateria';


--
-- Name: COLUMN lab_resultadosportarjeta.valor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultadosportarjeta.valor IS 'valor de la sensibilidad o resistencia para eliminarl la bacteria';


--
-- Name: COLUMN lab_resultadosportarjeta.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_resultadosportarjeta.idestablecimiento IS 'Código del establecimiento';


--
-- Name: lab_resultadosportarjeta_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_resultadosportarjeta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_resultadosportarjeta_id_seq OWNER TO simagd;

--
-- Name: lab_resultadosportarjeta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_resultadosportarjeta_id_seq OWNED BY lab_resultadosportarjeta.id;


--
-- Name: lab_subelementos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_subelementos (
    id integer NOT NULL,
    idelemento integer,
    subelemento character varying(80),
    observsubelem character varying(250),
    idestablecimiento integer,
    fechaini date,
    fechafin date,
    rangoinicio double precision,
    rangofin double precision,
    idsexo integer,
    idedad integer NOT NULL,
    unidad character varying(12)
);


ALTER TABLE lab_subelementos OWNER TO simagd;

--
-- Name: COLUMN lab_subelementos.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_subelementos.id IS 'Id del registro';


--
-- Name: COLUMN lab_subelementos.idelemento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_subelementos.idelemento IS 'Código del Elemento al que pertenece el sub_elemento';


--
-- Name: COLUMN lab_subelementos.subelemento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_subelementos.subelemento IS 'Nombre del Sub_Elemento';


--
-- Name: COLUMN lab_subelementos.observsubelem; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_subelementos.observsubelem IS 'Observación del sub-elemento';


--
-- Name: COLUMN lab_subelementos.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_subelementos.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN lab_subelementos.fechaini; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_subelementos.fechaini IS 'Fecha de inicio del sub-elemento';


--
-- Name: COLUMN lab_subelementos.fechafin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_subelementos.fechafin IS 'Fecha limite para el sub-elemento';


--
-- Name: lab_subelementos_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_subelementos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_subelementos_id_seq OWNER TO simagd;

--
-- Name: lab_subelementos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_subelementos_id_seq OWNED BY lab_subelementos.id;


--
-- Name: lab_tarjetasvitek; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_tarjetasvitek (
    id integer NOT NULL,
    nombretarjeta character varying(75),
    idestablecimiento integer NOT NULL,
    fechaini date,
    fechafin date,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone
);


ALTER TABLE lab_tarjetasvitek OWNER TO simagd;

--
-- Name: TABLE lab_tarjetasvitek; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_tarjetasvitek IS 'Nombre de las tarjetad Vitek o manuales utilizadas para los antibiogramas de los cultivos';


--
-- Name: COLUMN lab_tarjetasvitek.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.id IS 'Id correlativo del registro';


--
-- Name: COLUMN lab_tarjetasvitek.nombretarjeta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.nombretarjeta IS 'Id del antibiótico';


--
-- Name: COLUMN lab_tarjetasvitek.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.idestablecimiento IS 'Código del establecimiento';


--
-- Name: COLUMN lab_tarjetasvitek.fechaini; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.fechaini IS 'Código de la tarjeta';


--
-- Name: COLUMN lab_tarjetasvitek.fechafin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.fechafin IS 'Código del establecimiento';


--
-- Name: COLUMN lab_tarjetasvitek.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_tarjetasvitek.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_tarjetasvitek.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_tarjetasvitek.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tarjetasvitek.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: lab_tarjetasvitek_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_tarjetasvitek_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_tarjetasvitek_id_seq OWNER TO simagd;

--
-- Name: lab_tarjetasvitek_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_tarjetasvitek_id_seq OWNED BY lab_tarjetasvitek.id;


--
-- Name: lab_tipomuestra; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_tipomuestra (
    id integer NOT NULL,
    tipomuestra character varying(25) NOT NULL,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    habilitado boolean DEFAULT true NOT NULL
);


ALTER TABLE lab_tipomuestra OWNER TO simagd;

--
-- Name: TABLE lab_tipomuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_tipomuestra IS 'Contiene la información de los tipos de muestra';


--
-- Name: COLUMN lab_tipomuestra.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestra.id IS 'id del registro';


--
-- Name: COLUMN lab_tipomuestra.tipomuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestra.tipomuestra IS 'Nombre del tipo de muestra';


--
-- Name: COLUMN lab_tipomuestra.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestra.idusuarioreg IS 'Correlativo del usuario que ingreso el registro';


--
-- Name: COLUMN lab_tipomuestra.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestra.fechahorareg IS 'Fecha y hora en que se ingreso el registro';


--
-- Name: COLUMN lab_tipomuestra.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestra.idusuariomod IS 'Correlativo del usuario que modifica el registro';


--
-- Name: COLUMN lab_tipomuestra.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestra.fechahoramod IS 'Fecha y hora que se modificó el registro';


--
-- Name: lab_tipomuestra_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_tipomuestra_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_tipomuestra_id_seq OWNER TO simagd;

--
-- Name: lab_tipomuestra_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_tipomuestra_id_seq OWNED BY lab_tipomuestra.id;


--
-- Name: lab_tipomuestraporexamen; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_tipomuestraporexamen (
    id integer NOT NULL,
    idtipomuestra integer,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    habilitado boolean DEFAULT true NOT NULL,
    idexamen integer
);


ALTER TABLE lab_tipomuestraporexamen OWNER TO simagd;

--
-- Name: TABLE lab_tipomuestraporexamen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE lab_tipomuestraporexamen IS 'contiene los diferentes tipos de muestra por examen';


--
-- Name: COLUMN lab_tipomuestraporexamen.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestraporexamen.id IS 'Id del registro';


--
-- Name: COLUMN lab_tipomuestraporexamen.idtipomuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tipomuestraporexamen.idtipomuestra IS 'Código del tipo de muestra asignada al exámen';


--
-- Name: lab_tipomuestraporexamen_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_tipomuestraporexamen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_tipomuestraporexamen_id_seq OWNER TO simagd;

--
-- Name: lab_tipomuestraporexamen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_tipomuestraporexamen_id_seq OWNED BY lab_tipomuestraporexamen.id;


--
-- Name: lab_tiposolicitud; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE lab_tiposolicitud (
    idtiposolicitud character varying(1) NOT NULL,
    tiposolicitud character varying(25),
    id integer NOT NULL
);


ALTER TABLE lab_tiposolicitud OWNER TO simagd;

--
-- Name: COLUMN lab_tiposolicitud.idtiposolicitud; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tiposolicitud.idtiposolicitud IS 'Código del tipo de solicitud';


--
-- Name: COLUMN lab_tiposolicitud.tiposolicitud; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN lab_tiposolicitud.tiposolicitud IS 'Nombre del tipo de solicitud';


--
-- Name: lab_tiposolicitud_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE lab_tiposolicitud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lab_tiposolicitud_id_seq OWNER TO simagd;

--
-- Name: lab_tiposolicitud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE lab_tiposolicitud_id_seq OWNED BY lab_tiposolicitud.id;


--
-- Name: mnt_ambiente_independiente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_ambiente_independiente (
    id integer NOT NULL,
    nombre character varying(50),
    abreviatura character varying(8)
);


ALTER TABLE mnt_ambiente_independiente OWNER TO simagd;

--
-- Name: TABLE mnt_ambiente_independiente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_ambiente_independiente IS 'Almacena los ambientes que no pertenecen a una especialidad médica en particular';


--
-- Name: COLUMN mnt_ambiente_independiente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_ambiente_independiente.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_ambiente_independiente.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_ambiente_independiente.nombre IS 'Nombre del ambiente';


--
-- Name: COLUMN mnt_ambiente_independiente.abreviatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_ambiente_independiente.abreviatura IS 'abreviatura para el ambiente independiente';


--
-- Name: mnt_ambiente_independiente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_ambiente_independiente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_ambiente_independiente_id_seq OWNER TO simagd;

--
-- Name: mnt_ambiente_independiente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_ambiente_independiente_id_seq OWNED BY mnt_ambiente_independiente.id;


--
-- Name: mnt_area_examen_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_area_examen_establecimiento (
    id integer NOT NULL,
    id_area_servicio_diagnostico integer NOT NULL,
    id_examen_servicio_diagnostico integer NOT NULL,
    id_establecimiento integer NOT NULL,
    id_usuario_reg integer NOT NULL,
    fecha_hora_reg date NOT NULL,
    id_usuario_mod integer,
    fecha_hora_mod date,
    img_habilitado boolean DEFAULT true,
    img_realiza_lectura boolean DEFAULT false,
    img_duracion_clinica_estudio smallint DEFAULT 6,
    img_descripcion character varying(255)
);


ALTER TABLE mnt_area_examen_establecimiento OWNER TO simagd;

--
-- Name: mnt_area_examen_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_area_examen_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_area_examen_establecimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_area_examen_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_area_examen_establecimiento_id_seq OWNED BY mnt_area_examen_establecimiento.id;


--
-- Name: mnt_area_mod_estab; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_area_mod_estab (
    id integer NOT NULL,
    id_area_atencion integer NOT NULL,
    id_modalidad_estab integer NOT NULL,
    id_establecimiento integer NOT NULL,
    id_servicio_externo_estab integer
);


ALTER TABLE mnt_area_mod_estab OWNER TO simagd;

--
-- Name: TABLE mnt_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_area_mod_estab IS 'representa las modalidades por area en un establecimiento';


--
-- Name: COLUMN mnt_area_mod_estab.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_area_mod_estab.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN mnt_area_mod_estab.id_area_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_area_mod_estab.id_area_atencion IS 'Llave foranea de la tabla area_atencion';


--
-- Name: COLUMN mnt_area_mod_estab.id_modalidad_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_area_mod_estab.id_modalidad_estab IS 'Llave foranea para la tabla modalidad_establecimiento';


--
-- Name: COLUMN mnt_area_mod_estab.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_area_mod_estab.id_establecimiento IS 'Foránea que representa el establecimiento que es esta programando';


--
-- Name: mnt_area_mod_estab_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_area_mod_estab_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_area_mod_estab_id_seq OWNER TO simagd;

--
-- Name: mnt_area_mod_estab_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_area_mod_estab_id_seq OWNED BY mnt_area_mod_estab.id;


--
-- Name: mnt_areafarmacia; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_areafarmacia (
    id integer NOT NULL,
    area character varying(30) NOT NULL,
    idfarmacia integer NOT NULL,
    habilitado character(1) DEFAULT 'N'::bpchar NOT NULL
);


ALTER TABLE mnt_areafarmacia OWNER TO simagd;

--
-- Name: TABLE mnt_areafarmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_areafarmacia IS 'tabla que contiene las areas que conforman las farmacias';


--
-- Name: COLUMN mnt_areafarmacia.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmacia.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_areafarmacia.area; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmacia.area IS 'Nombre del Area de la Farmacia';


--
-- Name: COLUMN mnt_areafarmacia.idfarmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmacia.idfarmacia IS 'Llave foranea de mnt_farmacia';


--
-- Name: COLUMN mnt_areafarmacia.habilitado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmacia.habilitado IS 'S: Habilitado N: No habilitado';


--
-- Name: mnt_areafarmacia_idarea_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_areafarmacia_idarea_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_areafarmacia_idarea_seq OWNER TO simagd;

--
-- Name: mnt_areafarmacia_idarea_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_areafarmacia_idarea_seq OWNED BY mnt_areafarmacia.id;


--
-- Name: mnt_areafarmaciaxestablecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_areafarmaciaxestablecimiento (
    idrelacion integer NOT NULL,
    idarea integer NOT NULL,
    habilitado character(1) DEFAULT 'S'::bpchar NOT NULL,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE mnt_areafarmaciaxestablecimiento OWNER TO simagd;

--
-- Name: TABLE mnt_areafarmaciaxestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_areafarmaciaxestablecimiento IS 'relacion de areas versus establecimiento';


--
-- Name: COLUMN mnt_areafarmaciaxestablecimiento.idrelacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmaciaxestablecimiento.idrelacion IS 'Llave primaria';


--
-- Name: COLUMN mnt_areafarmaciaxestablecimiento.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmaciaxestablecimiento.idarea IS 'Area de farmacia';


--
-- Name: COLUMN mnt_areafarmaciaxestablecimiento.habilitado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmaciaxestablecimiento.habilitado IS 'Estado de Area de farmacia';


--
-- Name: COLUMN mnt_areafarmaciaxestablecimiento.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmaciaxestablecimiento.idestablecimiento IS 'Identificador del establecimiento ';


--
-- Name: COLUMN mnt_areafarmaciaxestablecimiento.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areafarmaciaxestablecimiento.idmodalidad IS 'Identificador del tipo de modalidad en las que se desenvuelve el establecimiento';


--
-- Name: mnt_areafarmaciaxestablecimiento_idrelacion_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_areafarmaciaxestablecimiento_idrelacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_areafarmaciaxestablecimiento_idrelacion_seq OWNER TO simagd;

--
-- Name: mnt_areafarmaciaxestablecimiento_idrelacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_areafarmaciaxestablecimiento_idrelacion_seq OWNED BY mnt_areafarmaciaxestablecimiento.idrelacion;


--
-- Name: mnt_areamedicina; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_areamedicina (
    id integer NOT NULL,
    idarea integer NOT NULL,
    idmedicina integer NOT NULL,
    dispensada integer,
    idestablecimiento integer NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE mnt_areamedicina OWNER TO simagd;

--
-- Name: TABLE mnt_areamedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_areamedicina IS 'Contiene los medicamentos que maneja cada area de Farmacia.';


--
-- Name: COLUMN mnt_areamedicina.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areamedicina.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN mnt_areamedicina.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areamedicina.idarea IS 'IdArea, Conectado con mnt_areafarmacia';


--
-- Name: COLUMN mnt_areamedicina.idmedicina; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areamedicina.idmedicina IS 'Medicina, conectado a catalogo de medicamentos';


--
-- Name: COLUMN mnt_areamedicina.dispensada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areamedicina.dispensada IS 'Contiene el IdArea donde se dispensa el medicamento en dado caso sea especial y se dispense en otra area de la farmacia';


--
-- Name: COLUMN mnt_areamedicina.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areamedicina.idestablecimiento IS 'Codigo de Establecimiento';


--
-- Name: COLUMN mnt_areamedicina.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_areamedicina.idmodalidad IS 'Indicador de Modalidades';


--
-- Name: mnt_areamedicina_idareamedicina_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_areamedicina_idareamedicina_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_areamedicina_idareamedicina_seq OWNER TO simagd;

--
-- Name: mnt_areamedicina_idareamedicina_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_areamedicina_idareamedicina_seq OWNED BY mnt_areamedicina.id;


--
-- Name: mnt_aten_area_mod_estab; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_aten_area_mod_estab (
    id integer NOT NULL,
    id_atencion integer,
    id_area_mod_estab integer,
    id_establecimiento integer,
    nombre_ambiente character varying(80),
    id_ambiente_independiente integer,
    codigo_farmacia smallint,
    condicion character(1)
);


ALTER TABLE mnt_aten_area_mod_estab OWNER TO simagd;

--
-- Name: TABLE mnt_aten_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_aten_area_mod_estab IS 'Representa las atenciones habilitadas por modalidad en las áreas del establecimiento';


--
-- Name: COLUMN mnt_aten_area_mod_estab.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN mnt_aten_area_mod_estab.id_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.id_atencion IS 'Foránea que representa a la atención recibida en el establecimiento de salud';


--
-- Name: COLUMN mnt_aten_area_mod_estab.id_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.id_area_mod_estab IS 'llave foranea para la tabla area_mod_estab';


--
-- Name: COLUMN mnt_aten_area_mod_estab.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.id_establecimiento IS 'llave foranea para la tabla establecimiento';


--
-- Name: COLUMN mnt_aten_area_mod_estab.nombre_ambiente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.nombre_ambiente IS 'Contendrá el nombre del ambiente de hospitalización al que pertenece el hospital';


--
-- Name: COLUMN mnt_aten_area_mod_estab.id_ambiente_independiente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.id_ambiente_independiente IS 'Foránea que representa el ambiente independiente a contener';


--
-- Name: COLUMN mnt_aten_area_mod_estab.codigo_farmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.codigo_farmacia IS 'Codigo de farmacia para la digitacion.';


--
-- Name: COLUMN mnt_aten_area_mod_estab.condicion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_aten_area_mod_estab.condicion IS 'estado del servicio de farmacia H habilitado I inhabilitado';


--
-- Name: mnt_aten_area_mod_estab_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_aten_area_mod_estab_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_aten_area_mod_estab_id_seq OWNER TO simagd;

--
-- Name: mnt_aten_area_mod_estab_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_aten_area_mod_estab_id_seq OWNED BY mnt_aten_area_mod_estab.id;


--
-- Name: mnt_auditoria_paciente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_auditoria_paciente (
    id integer NOT NULL,
    id_paciente bigint NOT NULL,
    primer_nombre character varying(25),
    segundo_nombre character varying(25),
    tercer_nombre character varying(25),
    primer_apellido character varying(25),
    segundo_apellido character varying(25),
    apellido_casada character varying(25),
    fecha_nacimiento date,
    hora_nacimiento time without time zone,
    id_departamento_domicilio integer,
    id_municipio_domicilio integer,
    id_canton_domicilio integer,
    area_geografica_domicilio integer,
    direccion character varying(100),
    nombre_padre character varying(80),
    nombre_madre character varying(80),
    nombre_responsable character varying(80),
    observacion text,
    conocido_por character varying(20),
    id_sexo integer,
    fecha_modificacion date NOT NULL,
    id_user integer NOT NULL,
    id_establecimiento integer NOT NULL
);


ALTER TABLE mnt_auditoria_paciente OWNER TO simagd;

--
-- Name: TABLE mnt_auditoria_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_auditoria_paciente IS 'Almacena los registros de las operaciones realizadas sobre la tabla paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id IS 'Este será considerado como el identificador único del paciente a nivel local; dentro de cada establecimiento';


--
-- Name: COLUMN mnt_auditoria_paciente.id_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id_paciente IS 'Foránea que representa el id del paciente en la tabla paciente del establecimiento';


--
-- Name: COLUMN mnt_auditoria_paciente.primer_nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.primer_nombre IS 'Primer nombre del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.segundo_nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.segundo_nombre IS 'Segundo nombre del paciente es opcional';


--
-- Name: COLUMN mnt_auditoria_paciente.tercer_nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.tercer_nombre IS 'Tercer nombre del paciente es opcional';


--
-- Name: COLUMN mnt_auditoria_paciente.primer_apellido; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.primer_apellido IS 'Primer apellido del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.segundo_apellido; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.segundo_apellido IS 'Segundo apellido del paciente es opcional';


--
-- Name: COLUMN mnt_auditoria_paciente.apellido_casada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.apellido_casada IS 'Apellido de casada para paciente mujer';


--
-- Name: COLUMN mnt_auditoria_paciente.fecha_nacimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.fecha_nacimiento IS 'Fecha de nacimiento del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.hora_nacimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.hora_nacimiento IS 'Hora de nacimiento en caso se conociera';


--
-- Name: COLUMN mnt_auditoria_paciente.id_departamento_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id_departamento_domicilio IS 'Foránea que representa el departamento de domicilio del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.id_municipio_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id_municipio_domicilio IS 'Foránea que representa el municipio en donde vive el paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.id_canton_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id_canton_domicilio IS 'Foránea que representa el cantón en donde vive el paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.area_geografica_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.area_geografica_domicilio IS 'Determina si vive en un área rural o urbana. 1=Rural; 2=Urbana';


--
-- Name: COLUMN mnt_auditoria_paciente.direccion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.direccion IS 'Direccion de donde vive el paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.nombre_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.nombre_padre IS 'Nombre del padre, en caso lo conozca';


--
-- Name: COLUMN mnt_auditoria_paciente.nombre_madre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.nombre_madre IS 'Nombre de la madre, en caso lo conozca';


--
-- Name: COLUMN mnt_auditoria_paciente.nombre_responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.nombre_responsable IS 'Nombre del responsable del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.observacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.observacion IS 'Observaciones del expediente del paciente, Fusiones de expedientes, etc';


--
-- Name: COLUMN mnt_auditoria_paciente.conocido_por; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.conocido_por IS 'Campo que representa la forma en que es conocido el paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.id_sexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id_sexo IS 'Foránea que representa el sexo del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.fecha_modificacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.fecha_modificacion IS 'Fecha en que fue modificado el registro del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.id_user; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id_user IS 'Foránea que representa el usuario que realizó la modificación del registro del paciente';


--
-- Name: COLUMN mnt_auditoria_paciente.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_auditoria_paciente.id_establecimiento IS 'Foránea que represeneta el establecimiento de salud en donde se hizo la modificación';


--
-- Name: mnt_auditoria_paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_auditoria_paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_auditoria_paciente_id_seq OWNER TO simagd;

--
-- Name: mnt_auditoria_paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_auditoria_paciente_id_seq OWNED BY mnt_auditoria_paciente.id;


--
-- Name: mnt_cargoempleados; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_cargoempleados (
    id integer NOT NULL,
    cargo character varying(50),
    id_atencion integer
);


ALTER TABLE mnt_cargoempleados OWNER TO simagd;

--
-- Name: mnt_cargo_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_cargo_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_cargo_empleado_id_seq OWNER TO simagd;

--
-- Name: mnt_cargo_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_cargo_empleado_id_seq OWNED BY mnt_cargoempleados.id;


--
-- Name: mnt_cie10; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_cie10 (
    id integer NOT NULL,
    codigo character varying(5) DEFAULT ''::character varying NOT NULL,
    grupom integer DEFAULT 0 NOT NULL,
    codgrupo integer DEFAULT 0 NOT NULL,
    diagnostico character varying(130) DEFAULT NULL::character varying,
    alarma smallint DEFAULT (0)::smallint,
    sexo_cie10 smallint DEFAULT (0)::smallint NOT NULL,
    c_salida integer,
    mayor integer,
    menor integer,
    critico smallint DEFAULT (0)::smallint
);


ALTER TABLE mnt_cie10 OWNER TO simagd;

--
-- Name: TABLE mnt_cie10; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_cie10 IS 'Enfermedades codificadas internacionalmente';


--
-- Name: mnt_cie10_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_cie10_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_cie10_id_seq OWNER TO simagd;

--
-- Name: mnt_cie10_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_cie10_id_seq OWNED BY mnt_cie10.id;


--
-- Name: mnt_ciq; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_ciq (
    codigo character varying(6) DEFAULT ''::character varying NOT NULL,
    procedimiento character varying(250) DEFAULT ''::character varying NOT NULL,
    idusuarioreg smallint DEFAULT (0)::smallint,
    idusuariomod smallint DEFAULT (0)::smallint,
    fechahorareg timestamp without time zone,
    fechahoramod timestamp without time zone,
    id integer NOT NULL,
    id_tipo_procedimiento integer
);


ALTER TABLE mnt_ciq OWNER TO simagd;

--
-- Name: TABLE mnt_ciq; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_ciq IS 'Procedimientos Quirugicos';


--
-- Name: COLUMN mnt_ciq.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_ciq.id IS 'Llave primaria';


--
-- Name: mnt_ciq_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_ciq_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_ciq_id_seq OWNER TO simagd;

--
-- Name: mnt_ciq_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_ciq_id_seq OWNED BY mnt_ciq.id;


--
-- Name: mnt_condicionegreso; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_condicionegreso (
    idcondicion integer NOT NULL,
    desccondicion character varying(25) DEFAULT ''::character varying NOT NULL,
    idusuarioreg smallint DEFAULT (0)::smallint NOT NULL,
    idusuariomod smallint DEFAULT (0)::smallint NOT NULL,
    fechahorareg timestamp without time zone NOT NULL,
    fechahoramod timestamp without time zone NOT NULL
);


ALTER TABLE mnt_condicionegreso OWNER TO simagd;

--
-- Name: TABLE mnt_condicionegreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_condicionegreso IS 'TABLA AUXILIAR DE DE LAS CONDICIONES DE EGRESO';


--
-- Name: COLUMN mnt_condicionegreso.idcondicion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_condicionegreso.idcondicion IS 'Id de Condicion, Llave primaria';


--
-- Name: COLUMN mnt_condicionegreso.desccondicion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_condicionegreso.desccondicion IS 'Descripcion de condicion de egreso';


--
-- Name: COLUMN mnt_condicionegreso.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_condicionegreso.idusuarioreg IS 'IdUsuario que ingresa el registra';


--
-- Name: COLUMN mnt_condicionegreso.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_condicionegreso.idusuariomod IS 'IdUsuario que modifica el registro';


--
-- Name: COLUMN mnt_condicionegreso.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_condicionegreso.fechahorareg IS 'Fecha y hora de ingreso del registro';


--
-- Name: COLUMN mnt_condicionegreso.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_condicionegreso.fechahoramod IS 'Fecha y Hora de modificacion del registro';


--
-- Name: mnt_condicionegreso_idcondicion_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_condicionegreso_idcondicion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_condicionegreso_idcondicion_seq OWNER TO simagd;

--
-- Name: mnt_condicionegreso_idcondicion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_condicionegreso_idcondicion_seq OWNED BY mnt_condicionegreso.idcondicion;


--
-- Name: mnt_conexion; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_conexion (
    id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    host character varying(20) NOT NULL,
    usuario character varying(15) NOT NULL,
    contrasenia character varying(150) NOT NULL,
    puerto integer NOT NULL,
    base_de_datos character varying(20) NOT NULL,
    id_establecimiento integer NOT NULL,
    gestor_base character varying(10) NOT NULL
);


ALTER TABLE mnt_conexion OWNER TO simagd;

--
-- Name: TABLE mnt_conexion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_conexion IS 'Tabla que manejará las conexiones a las bases de datos regionales realizadas para el SIAP';


--
-- Name: COLUMN mnt_conexion.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_conexion.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.nombre IS 'Nombre asignado a la conexión de la base de datos';


--
-- Name: COLUMN mnt_conexion.host; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.host IS 'Nombre del host o IP de conexión al servidor de base de datos';


--
-- Name: COLUMN mnt_conexion.usuario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.usuario IS 'Nombre del usuario para conectarse a la base de datos';


--
-- Name: COLUMN mnt_conexion.contrasenia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.contrasenia IS 'Contraseña del usuario dueño de la base de datos.';


--
-- Name: COLUMN mnt_conexion.puerto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.puerto IS 'Número del puerto a utilizar para el gestor de base de datos.';


--
-- Name: COLUMN mnt_conexion.base_de_datos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.base_de_datos IS 'Nombre de la base de datos a conectarse.';


--
-- Name: COLUMN mnt_conexion.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.id_establecimiento IS 'Foránea que representa la región a la que pertenece la conexión al servidor regional.';


--
-- Name: COLUMN mnt_conexion.gestor_base; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_conexion.gestor_base IS 'Nombre del gestor de base de datos a utilizar';


--
-- Name: mnt_conexion_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_conexion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_conexion_id_seq OWNER TO simagd;

--
-- Name: mnt_conexion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_conexion_id_seq OWNED BY mnt_conexion.id;


--
-- Name: mnt_consultorio; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_consultorio (
    id integer NOT NULL,
    descripcion character varying(100),
    area smallint,
    idusuarioreg integer,
    fechahorareg timestamp without time zone
);


ALTER TABLE mnt_consultorio OWNER TO simagd;

--
-- Name: mnt_consultorio_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_consultorio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_consultorio_id_seq OWNER TO simagd;

--
-- Name: mnt_consultorio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_consultorio_id_seq OWNED BY mnt_consultorio.id;


--
-- Name: mnt_empleado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_empleado (
    id integer NOT NULL,
    nombre character varying(100),
    apellido character varying(100),
    fecha_nacimiento date,
    dui character varying(12),
    numero_junta_vigilancia character varying(20),
    numero_celular character varying(10),
    correo_electronico character varying(50),
    id_establecimiento integer,
    correlativo smallint,
    id_cargo_empleado integer,
    codigo_farmacia character varying(15),
    habilitado_farmacia character(1) DEFAULT 'H'::bpchar,
    firma_digital text,
    id_tipo_empleado integer,
    idempleado character varying(7) DEFAULT ''::character varying,
    idusuarioreg smallint,
    fechahorareg timestamp without time zone,
    idusuariomod smallint,
    fechahoramod timestamp without time zone,
    nombreempleado character varying(200),
    habilitado boolean DEFAULT true,
    idarea integer,
    id_establecimiento_externo integer
);


ALTER TABLE mnt_empleado OWNER TO simagd;

--
-- Name: TABLE mnt_empleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_empleado IS 'Contiene los empleados del sistema';


--
-- Name: COLUMN mnt_empleado.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.id IS 'Llave Primaria';


--
-- Name: COLUMN mnt_empleado.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.nombre IS 'Nombre del empleado';


--
-- Name: COLUMN mnt_empleado.apellido; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.apellido IS 'Apellidos del Empleado';


--
-- Name: COLUMN mnt_empleado.fecha_nacimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.fecha_nacimiento IS 'Fecha de nacimiento del empleado';


--
-- Name: COLUMN mnt_empleado.dui; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.dui IS 'DUI del empleado';


--
-- Name: COLUMN mnt_empleado.numero_junta_vigilancia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.numero_junta_vigilancia IS 'Numero de junta de vigilancia en caso de que sea medico';


--
-- Name: COLUMN mnt_empleado.numero_celular; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.numero_celular IS 'Telefono celular de contacto';


--
-- Name: COLUMN mnt_empleado.correo_electronico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.correo_electronico IS 'Correo electronico';


--
-- Name: COLUMN mnt_empleado.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.id_establecimiento IS 'Llave foranea del establecimiento';


--
-- Name: COLUMN mnt_empleado.id_cargo_empleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.id_cargo_empleado IS 'Cargo del empleado para el modulo de laboratorio';


--
-- Name: COLUMN mnt_empleado.codigo_farmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.codigo_farmacia IS 'Codigo del usuario en farmacia';


--
-- Name: COLUMN mnt_empleado.habilitado_farmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.habilitado_farmacia IS 'Si esta habilitado en farmacia';


--
-- Name: COLUMN mnt_empleado.firma_digital; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.firma_digital IS 'Campo para setearle el hash de la firma digital del empleado';


--
-- Name: COLUMN mnt_empleado.id_tipo_empleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.id_tipo_empleado IS 'Almacena el tipo de empleado de la persona para el SIAP';


--
-- Name: COLUMN mnt_empleado.nombreempleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.nombreempleado IS 'Nombre Unido para los modulos de PHP Puro y POstgresql';


--
-- Name: COLUMN mnt_empleado.idarea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.idarea IS 'ID de la tabla lab_areas, llave foranea, indica a que area de laboratorio pertenece el empleado';


--
-- Name: COLUMN mnt_empleado.id_establecimiento_externo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado.id_establecimiento_externo IS 'ID para empleados externos al establecimiento, se usa para el modulo de laboratorio';


--
-- Name: mnt_empleado_especialidad; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_empleado_especialidad (
    id integer NOT NULL,
    id_empleado integer NOT NULL,
    id_atencion integer NOT NULL
);


ALTER TABLE mnt_empleado_especialidad OWNER TO simagd;

--
-- Name: TABLE mnt_empleado_especialidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_empleado_especialidad IS 'Contiene el grado de estudio del medico';


--
-- Name: COLUMN mnt_empleado_especialidad.id_empleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado_especialidad.id_empleado IS 'Foranea del empleado que registra';


--
-- Name: COLUMN mnt_empleado_especialidad.id_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado_especialidad.id_atencion IS 'Foranea de la especialidad que tiene como estudio';


--
-- Name: mnt_empleado_especialidad_estab; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_empleado_especialidad_estab (
    id integer NOT NULL,
    id_empleado integer NOT NULL,
    id_aten_area_mod_estab integer NOT NULL
);


ALTER TABLE mnt_empleado_especialidad_estab OWNER TO simagd;

--
-- Name: TABLE mnt_empleado_especialidad_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_empleado_especialidad_estab IS 'Contiene las especialidades con la que trabajo el empleado en el establecimiento';


--
-- Name: COLUMN mnt_empleado_especialidad_estab.id_empleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado_especialidad_estab.id_empleado IS 'Llave foranea del empleado al que hace referencia';


--
-- Name: COLUMN mnt_empleado_especialidad_estab.id_aten_area_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_empleado_especialidad_estab.id_aten_area_mod_estab IS 'Foranea que representa la atencion para el area en la que trabaja el empleado';


--
-- Name: mnt_empleado_especialidad_estab_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_empleado_especialidad_estab_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_empleado_especialidad_estab_id_seq OWNER TO simagd;

--
-- Name: mnt_empleado_especialidad_estab_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_empleado_especialidad_estab_id_seq OWNED BY mnt_empleado_especialidad_estab.id;


--
-- Name: mnt_empleado_especialidad_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_empleado_especialidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_empleado_especialidad_id_seq OWNER TO simagd;

--
-- Name: mnt_empleado_especialidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_empleado_especialidad_id_seq OWNED BY mnt_empleado_especialidad.id;


--
-- Name: mnt_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_empleado_id_seq OWNER TO simagd;

--
-- Name: mnt_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_empleado_id_seq OWNED BY mnt_empleado.id;


--
-- Name: mnt_expediente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_expediente (
    id bigint NOT NULL,
    numero character varying(12) NOT NULL,
    id_paciente bigint NOT NULL,
    id_establecimiento integer,
    habilitado boolean DEFAULT true NOT NULL,
    id_creacion_expediente integer,
    fecha_creacion date,
    hora_creacion time without time zone
);


ALTER TABLE mnt_expediente OWNER TO simagd;

--
-- Name: TABLE mnt_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_expediente IS 'Tabla que guarda los números de expediente clinico';


--
-- Name: COLUMN mnt_expediente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_expediente.id IS 'Expediente generado para el paciente';


--
-- Name: COLUMN mnt_expediente.numero; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_expediente.numero IS 'Número de expediente de un paciente en el SIAPS local';


--
-- Name: COLUMN mnt_expediente.id_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_expediente.id_paciente IS 'Foránea que representa el identificador único del paciente dentro de la base de datos local';


--
-- Name: COLUMN mnt_expediente.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_expediente.id_establecimiento IS 'Foránea que se relaciona con el establecimiento para saber a que establecimiento pertenece ese expediente';


--
-- Name: COLUMN mnt_expediente.habilitado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_expediente.habilitado IS 'Para determinar si el expediente esta habilitado. TRUE=Habilitado; FALSE= Deshabilitado';


--
-- Name: COLUMN mnt_expediente.id_creacion_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_expediente.id_creacion_expediente IS 'Fóranea que representa el área en donde se creo el expediente del paciente';


--
-- Name: mnt_expediente_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_expediente_establecimiento (
    id bigint NOT NULL,
    id_paciente_inicial bigint,
    id_establecimiento integer,
    id_paciente_siap_local bigint,
    id_numero_expediente bigint
);


ALTER TABLE mnt_expediente_establecimiento OWNER TO simagd;

--
-- Name: mnt_expediente_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_expediente_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_expediente_establecimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_expediente_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_expediente_establecimiento_id_seq OWNED BY mnt_expediente_establecimiento.id;


--
-- Name: mnt_expediente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_expediente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_expediente_id_seq OWNER TO simagd;

--
-- Name: mnt_expediente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_expediente_id_seq OWNED BY mnt_expediente.id;


--
-- Name: mnt_farmacia; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_farmacia (
    id integer NOT NULL,
    farmacia character varying(50) NOT NULL,
    habilitadofarmacia character(1) DEFAULT 'S'::bpchar NOT NULL
);


ALTER TABLE mnt_farmacia OWNER TO simagd;

--
-- Name: TABLE mnt_farmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_farmacia IS 'Nombre de las farmacias existentes en el centro de salud';


--
-- Name: COLUMN mnt_farmacia.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_farmacia.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_farmacia.farmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_farmacia.farmacia IS 'Nombre de la Farmacia';


--
-- Name: mnt_farmacia_idfarmacia_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_farmacia_idfarmacia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_farmacia_idfarmacia_seq OWNER TO simagd;

--
-- Name: mnt_farmacia_idfarmacia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_farmacia_idfarmacia_seq OWNED BY mnt_farmacia.id;


--
-- Name: mnt_farmaciaxestablecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_farmaciaxestablecimiento (
    id integer NOT NULL,
    idfarmacia integer NOT NULL,
    idestablecimiento integer NOT NULL,
    habilitadofarmacia character(1) DEFAULT 'N'::bpchar NOT NULL,
    idmodalidad integer NOT NULL
);


ALTER TABLE mnt_farmaciaxestablecimiento OWNER TO simagd;

--
-- Name: TABLE mnt_farmaciaxestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_farmaciaxestablecimiento IS 'configuraciones de las farmacias por establecimiento';


--
-- Name: COLUMN mnt_farmaciaxestablecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_farmaciaxestablecimiento.id IS 'Llave de la tabla farmacia por establecimiento';


--
-- Name: COLUMN mnt_farmaciaxestablecimiento.idfarmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_farmaciaxestablecimiento.idfarmacia IS 'configuracion de las farmacia del establecimiento';


--
-- Name: COLUMN mnt_farmaciaxestablecimiento.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_farmaciaxestablecimiento.idestablecimiento IS 'Llave foranea de establecimientos';


--
-- Name: COLUMN mnt_farmaciaxestablecimiento.habilitadofarmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_farmaciaxestablecimiento.habilitadofarmacia IS 'Estado de Farmacia, ''H'' : Habilitado I: Inhabilitado';


--
-- Name: mnt_farmaciaxestablecimiento_idfarxestablecimiento_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_farmaciaxestablecimiento_idfarxestablecimiento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_farmaciaxestablecimiento_idfarxestablecimiento_seq OWNER TO simagd;

--
-- Name: mnt_farmaciaxestablecimiento_idfarxestablecimiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_farmaciaxestablecimiento_idfarxestablecimiento_seq OWNED BY mnt_farmaciaxestablecimiento.id;


--
-- Name: mnt_formularios; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_formularios (
    id integer NOT NULL,
    nombreformulario character varying(100) NOT NULL,
    idusuarioreg smallint,
    fechahorareg timestamp without time zone,
    idusuariomod smallint,
    fechahoramod timestamp without time zone
);


ALTER TABLE mnt_formularios OWNER TO simagd;

--
-- Name: TABLE mnt_formularios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_formularios IS 'Formularios que estan registrados los establecimientos de salud';


--
-- Name: COLUMN mnt_formularios.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_formularios.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_formularios.nombreformulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_formularios.nombreformulario IS 'Nombre del Formulario';


--
-- Name: mnt_formularios_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_formularios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_formularios_id_seq OWNER TO simagd;

--
-- Name: mnt_formularios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_formularios_id_seq OWNED BY mnt_formularios.id;


--
-- Name: mnt_formulariosxestablecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_formulariosxestablecimiento (
    id integer NOT NULL,
    idformulario integer NOT NULL,
    idestablecimiento integer NOT NULL,
    condicion character varying(1) DEFAULT true,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    id_atencion integer
);


ALTER TABLE mnt_formulariosxestablecimiento OWNER TO simagd;

--
-- Name: COLUMN mnt_formulariosxestablecimiento.id_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_formulariosxestablecimiento.id_atencion IS 'ID de la tabla ctl_atencion, sustituye al campo idprograma, el cual ahora se encuentra en ctl_atencion';


--
-- Name: mnt_formulariosxestablecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_formulariosxestablecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_formulariosxestablecimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_formulariosxestablecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_formulariosxestablecimiento_id_seq OWNED BY mnt_formulariosxestablecimiento.id;


--
-- Name: mnt_fuentefinanciamiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_fuentefinanciamiento (
    idfuentefinanciamiento integer NOT NULL,
    nombre character varying(50) NOT NULL
);


ALTER TABLE mnt_fuentefinanciamiento OWNER TO simagd;

--
-- Name: TABLE mnt_fuentefinanciamiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_fuentefinanciamiento IS 'Fuentes de Financiamiento';


--
-- Name: COLUMN mnt_fuentefinanciamiento.idfuentefinanciamiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_fuentefinanciamiento.idfuentefinanciamiento IS 'Pk de fuente de financiamientoo';


--
-- Name: COLUMN mnt_fuentefinanciamiento.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_fuentefinanciamiento.nombre IS 'Nombre de la fuente de financiamiento';


--
-- Name: mnt_fuentefinanciamiento_idfuentefinanciamiento_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_fuentefinanciamiento_idfuentefinanciamiento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_fuentefinanciamiento_idfuentefinanciamiento_seq OWNER TO simagd;

--
-- Name: mnt_fuentefinanciamiento_idfuentefinanciamiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_fuentefinanciamiento_idfuentefinanciamiento_seq OWNED BY mnt_fuentefinanciamiento.idfuentefinanciamiento;


--
-- Name: mnt_grupoterapeutico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_grupoterapeutico (
    id integer NOT NULL,
    grupoterapeutico character varying(50) NOT NULL
);


ALTER TABLE mnt_grupoterapeutico OWNER TO simagd;

--
-- Name: TABLE mnt_grupoterapeutico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_grupoterapeutico IS 'Grup. terapeutico que dividen los medicamentos';


--
-- Name: COLUMN mnt_grupoterapeutico.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_grupoterapeutico.id IS 'clave primaria';


--
-- Name: COLUMN mnt_grupoterapeutico.grupoterapeutico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_grupoterapeutico.grupoterapeutico IS 'Nombre de Grupo Terapeutico';


--
-- Name: mnt_grupoterapeutico_IdTerapeutico_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE "mnt_grupoterapeutico_IdTerapeutico_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "mnt_grupoterapeutico_IdTerapeutico_seq" OWNER TO simagd;

--
-- Name: mnt_grupoterapeutico_IdTerapeutico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE "mnt_grupoterapeutico_IdTerapeutico_seq" OWNED BY mnt_grupoterapeutico.id;


--
-- Name: mnt_indicacionesporexamen; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_indicacionesporexamen (
    id integer NOT NULL,
    indicacion character varying(250) DEFAULT '0'::character varying NOT NULL,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    idexamen integer NOT NULL,
    idservicio integer NOT NULL,
    idarea integer NOT NULL
);


ALTER TABLE mnt_indicacionesporexamen OWNER TO simagd;

--
-- Name: mnt_indicacionesporexamen_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_indicacionesporexamen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_indicacionesporexamen_id_seq OWNER TO simagd;

--
-- Name: mnt_indicacionesporexamen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_indicacionesporexamen_id_seq OWNED BY mnt_indicacionesporexamen.id;


--
-- Name: mnt_modalidad_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_modalidad_establecimiento (
    id integer NOT NULL,
    id_establecimiento integer NOT NULL,
    id_modalidad integer NOT NULL,
    tiene_farmacia boolean NOT NULL,
    repetitiva boolean NOT NULL
);


ALTER TABLE mnt_modalidad_establecimiento OWNER TO simagd;

--
-- Name: TABLE mnt_modalidad_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_modalidad_establecimiento IS 'Llevara el control de que modalidades aplican a un establecimiento';


--
-- Name: COLUMN mnt_modalidad_establecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_modalidad_establecimiento.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_modalidad_establecimiento.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_modalidad_establecimiento.id_establecimiento IS 'Foránea que representa el establecimiento de salud';


--
-- Name: COLUMN mnt_modalidad_establecimiento.id_modalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_modalidad_establecimiento.id_modalidad IS 'Foránea que representa la modalidad a aplicar al establecimiento de salud';


--
-- Name: COLUMN mnt_modalidad_establecimiento.tiene_farmacia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_modalidad_establecimiento.tiene_farmacia IS 'Configuracion de Farmacia, Si posee bodega TRUE=tiene; FALSE=no tiene';


--
-- Name: COLUMN mnt_modalidad_establecimiento.repetitiva; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_modalidad_establecimiento.repetitiva IS 'Bandera para configuración de emision de recetas repetitivas';


--
-- Name: mnt_modalidad_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_modalidad_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_modalidad_establecimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_modalidad_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_modalidad_establecimiento_id_seq OWNED BY mnt_modalidad_establecimiento.id;


--
-- Name: mnt_origenmuestra; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_origenmuestra (
    id integer NOT NULL,
    idtipomuestra integer NOT NULL,
    origenmuestra character varying(60) DEFAULT NULL::character varying,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    idusuariomod integer,
    fechahoramod timestamp without time zone,
    habilitado boolean DEFAULT true NOT NULL
);


ALTER TABLE mnt_origenmuestra OWNER TO simagd;

--
-- Name: mnt_origenmuestra_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_origenmuestra_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_origenmuestra_id_seq OWNER TO simagd;

--
-- Name: mnt_origenmuestra_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_origenmuestra_id_seq OWNED BY mnt_origenmuestra.id;


--
-- Name: mnt_paciente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_paciente (
    id bigint NOT NULL,
    primer_nombre character varying(25) NOT NULL,
    segundo_nombre character varying(25),
    tercer_nombre character varying(25),
    primer_apellido character varying(25) NOT NULL,
    segundo_apellido character varying(25),
    apellido_casada character varying(25),
    fecha_nacimiento date,
    hora_nacimiento time without time zone,
    id_pais_nacimiento integer,
    id_departamento_nacimiento integer,
    id_municipio_nacimiento integer,
    id_estado_civil integer,
    id_doc_ide_paciente integer,
    numero_doc_ide_paciente character varying(20),
    id_ocupacion integer,
    direccion character varying(200),
    telefono_casa character varying(10),
    id_departamento_domicilio integer,
    id_municipio_domicilio integer,
    id_canton_domicilio integer,
    area_geografica_domicilio integer,
    lugar_trabajo character varying(50),
    telefono_trabajo character varying(10),
    id_area_cotizacion integer,
    asegurado boolean,
    numero_afiliacion character varying(12),
    cotizante boolean,
    nombre_padre character varying(80),
    nombre_madre character varying(80),
    nombre_conyuge character varying(80),
    nombre_responsable character varying(80),
    direccion_responsable character varying(200),
    telefono_responsable character varying(10),
    id_parentesco_responsable integer,
    id_doc_ide_responsable integer,
    numero_doc_ide_responsable character varying(20),
    nombre_proporciono_datos character varying(80),
    id_doc_ide_proporciono_datos integer,
    numero_doc_ide_propor_datos character varying(20),
    observacion text,
    conocido_por character varying(70),
    id_siff integer,
    estado integer DEFAULT 1 NOT NULL,
    dispensarizacion_individual integer,
    id_paciente_inicial bigint,
    id_nacionalidad integer,
    id_sexo integer NOT NULL,
    id_parentesco_propor_datos integer,
    fecha_registro timestamp without time zone,
    id_user integer,
    id_user_mod integer,
    fecha_mod timestamp without time zone
);


ALTER TABLE mnt_paciente OWNER TO simagd;

--
-- Name: TABLE mnt_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_paciente IS 'Datos generales del paciente';


--
-- Name: COLUMN mnt_paciente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id IS 'Este será considerado como el identificador único del paciente a nivel local; dentro de cada establecimiento';


--
-- Name: COLUMN mnt_paciente.primer_nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.primer_nombre IS 'Primer nombre del paciente';


--
-- Name: COLUMN mnt_paciente.segundo_nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.segundo_nombre IS 'Segundo nombre del paciente es opcional';


--
-- Name: COLUMN mnt_paciente.tercer_nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.tercer_nombre IS 'Tercer nombre del paciente es opcional';


--
-- Name: COLUMN mnt_paciente.primer_apellido; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.primer_apellido IS 'Primer apellido del paciente';


--
-- Name: COLUMN mnt_paciente.segundo_apellido; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.segundo_apellido IS 'Segundo apellido del paciente es opcional';


--
-- Name: COLUMN mnt_paciente.apellido_casada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.apellido_casada IS 'Apellido de casada para paciente mujer';


--
-- Name: COLUMN mnt_paciente.fecha_nacimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.fecha_nacimiento IS 'Fecha de nacimiento del paciente';


--
-- Name: COLUMN mnt_paciente.hora_nacimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.hora_nacimiento IS 'Hora de nacimiento en caso se conociera';


--
-- Name: COLUMN mnt_paciente.id_pais_nacimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_pais_nacimiento IS 'Foránea que representa el pais de nacimiento';


--
-- Name: COLUMN mnt_paciente.id_municipio_nacimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_municipio_nacimiento IS 'Foránea que representa el municipio de nacimiento; sinonimo de Lugar de Nacimiento';


--
-- Name: COLUMN mnt_paciente.id_estado_civil; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_estado_civil IS 'Foránea que representa el estado civil del paciente';


--
-- Name: COLUMN mnt_paciente.id_doc_ide_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_doc_ide_paciente IS 'Foránea que representa el tipo de documento de identidad del paciente';


--
-- Name: COLUMN mnt_paciente.numero_doc_ide_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.numero_doc_ide_paciente IS 'Número del documento de identidad seleccionado para el paciente';


--
-- Name: COLUMN mnt_paciente.id_ocupacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_ocupacion IS 'Foránea que representa la ocupacion a la que se dedica el paciente';


--
-- Name: COLUMN mnt_paciente.direccion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.direccion IS 'Direccion de donde vive el paciente';


--
-- Name: COLUMN mnt_paciente.telefono_casa; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.telefono_casa IS 'Teléfono de contacto de casa en caso existiera';


--
-- Name: COLUMN mnt_paciente.id_departamento_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_departamento_domicilio IS 'Foránea que representa el departamento de domicilio del paciente';


--
-- Name: COLUMN mnt_paciente.id_municipio_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_municipio_domicilio IS 'Foránea que representa el municipio en donde vive el paciente';


--
-- Name: COLUMN mnt_paciente.id_canton_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_canton_domicilio IS 'Foránea que representa el cantón en donde vive el paciente';


--
-- Name: COLUMN mnt_paciente.area_geografica_domicilio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.area_geografica_domicilio IS 'Determina si vive en un área rural o urbana. 1=Rural; 2=Urbana';


--
-- Name: COLUMN mnt_paciente.lugar_trabajo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.lugar_trabajo IS 'Lugar donde trabaja el paciente, En caso trabajara';


--
-- Name: COLUMN mnt_paciente.telefono_trabajo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.telefono_trabajo IS 'Teléfono del trabajo, en caso existiera';


--
-- Name: COLUMN mnt_paciente.id_area_cotizacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_area_cotizacion IS 'Foránea que representa el área de cotización';


--
-- Name: COLUMN mnt_paciente.asegurado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.asegurado IS 'Para saber si es asegurado o beneficiario. Asegurado=True; Beneficiario=F';


--
-- Name: COLUMN mnt_paciente.numero_afiliacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.numero_afiliacion IS 'Número de afiliación ya sea del asegurado o del beneficiario';


--
-- Name: COLUMN mnt_paciente.cotizante; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.cotizante IS 'Para saber si el paciente es cotizante. True=Es cotizante; False=NO es cotizante';


--
-- Name: COLUMN mnt_paciente.nombre_padre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.nombre_padre IS 'Nombre del padre, en caso lo conozca';


--
-- Name: COLUMN mnt_paciente.nombre_madre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.nombre_madre IS 'Nombre de la madre, en caso lo conozca';


--
-- Name: COLUMN mnt_paciente.nombre_conyuge; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.nombre_conyuge IS 'Nombre de conyuge en caso este acompañado';


--
-- Name: COLUMN mnt_paciente.nombre_responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.nombre_responsable IS 'Nombre del responsable del paciente';


--
-- Name: COLUMN mnt_paciente.direccion_responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.direccion_responsable IS 'Direccion del responsable';


--
-- Name: COLUMN mnt_paciente.telefono_responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.telefono_responsable IS 'Telefono del responsable del paciente en caso existiera';


--
-- Name: COLUMN mnt_paciente.id_parentesco_responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_parentesco_responsable IS 'Foránea que representa el parentesco del paciente con el responsable';


--
-- Name: COLUMN mnt_paciente.id_doc_ide_responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_doc_ide_responsable IS 'Foránea que representa el documento de identidad del responsable';


--
-- Name: COLUMN mnt_paciente.numero_doc_ide_responsable; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.numero_doc_ide_responsable IS 'Número del documento de identidad seleccionado para el responsable';


--
-- Name: COLUMN mnt_paciente.nombre_proporciono_datos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.nombre_proporciono_datos IS 'Persona que proporciono los datos del paciente';


--
-- Name: COLUMN mnt_paciente.id_doc_ide_proporciono_datos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_doc_ide_proporciono_datos IS 'Foránea que representa el documento de identidad del que proporciono datos';


--
-- Name: COLUMN mnt_paciente.numero_doc_ide_propor_datos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.numero_doc_ide_propor_datos IS 'Número del documento de identidad seleccionado para el proporciono datos';


--
-- Name: COLUMN mnt_paciente.observacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.observacion IS 'Observaciones del expediente del paciente, Fusiones de expedientes, etc';


--
-- Name: COLUMN mnt_paciente.conocido_por; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.conocido_por IS 'Sobre-Nombre con el que es conocido popularmente el paciente';


--
-- Name: COLUMN mnt_paciente.id_siff; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_siff IS 'Id de la ficha familiar. Proviene del sistema de ficha familiar';


--
-- Name: COLUMN mnt_paciente.estado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.estado IS 'Estado del paciente. 1=Vivo; 2= Fallecido; 3=Inactivo ';


--
-- Name: COLUMN mnt_paciente.dispensarizacion_individual; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.dispensarizacion_individual IS 'Grupo dispensarial en que se ubica en la ficha familiar: 1: Aparentemente sano; 2:Riesgo; 3: Enfermo; 4:Con discapacidad o secuela';


--
-- Name: COLUMN mnt_paciente.id_paciente_inicial; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_paciente_inicial IS 'Número global del paciente';


--
-- Name: COLUMN mnt_paciente.id_nacionalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_nacionalidad IS 'Foránea para la nacionalidad del paciente';


--
-- Name: COLUMN mnt_paciente.id_sexo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_sexo IS 'Foránea que representa el sexo del paciente';


--
-- Name: COLUMN mnt_paciente.id_parentesco_propor_datos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_parentesco_propor_datos IS 'Foránea que representa el parentesco del paciente con la persona que proporionó los datos';


--
-- Name: COLUMN mnt_paciente.fecha_registro; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.fecha_registro IS 'Fecha en que fue creado el registro del paciente';


--
-- Name: COLUMN mnt_paciente.id_user; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_user IS 'Foránea que representa el usuario que registro los datos por primera vez del paciente';


--
-- Name: COLUMN mnt_paciente.id_user_mod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.id_user_mod IS 'Foránea que representa el usuario que ha realizado la última modificación a los datos del paciente';


--
-- Name: COLUMN mnt_paciente.fecha_mod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente.fecha_mod IS 'Fecha de última modificación de datos de paciente
';


--
-- Name: mnt_paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_paciente_id_seq OWNER TO simagd;

--
-- Name: mnt_paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_paciente_id_seq OWNED BY mnt_paciente.id;


--
-- Name: mnt_paciente_programa_estab; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_paciente_programa_estab (
    id integer NOT NULL,
    id_paciente integer NOT NULL,
    id_programa_establecimiento integer NOT NULL,
    id_establecimiento integer NOT NULL,
    fecha_inscripcion date NOT NULL,
    fecha_alta date
);


ALTER TABLE mnt_paciente_programa_estab OWNER TO simagd;

--
-- Name: TABLE mnt_paciente_programa_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_paciente_programa_estab IS 'Contiene el historial de los programas que un paciente ha consultado
';


--
-- Name: COLUMN mnt_paciente_programa_estab.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente_programa_estab.id IS 'Llave Primaria';


--
-- Name: COLUMN mnt_paciente_programa_estab.id_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente_programa_estab.id_paciente IS 'Foránea que representa el paciente';


--
-- Name: COLUMN mnt_paciente_programa_estab.id_programa_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente_programa_estab.id_programa_establecimiento IS 'Foránea que representa el programa levantado en el establecimiento';


--
-- Name: COLUMN mnt_paciente_programa_estab.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente_programa_estab.id_establecimiento IS 'Foránea que representa el establecimiento';


--
-- Name: COLUMN mnt_paciente_programa_estab.fecha_inscripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente_programa_estab.fecha_inscripcion IS 'Fecha en que se inscribio el paciente al programa';


--
-- Name: COLUMN mnt_paciente_programa_estab.fecha_alta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_paciente_programa_estab.fecha_alta IS 'Fecha en que se dio de alta el paciente. Si no tiene fecha de finalización es porque todavía esta inscrito';


--
-- Name: mnt_paciente_programa_estab_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_paciente_programa_estab_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_paciente_programa_estab_id_seq OWNER TO simagd;

--
-- Name: mnt_paciente_programa_estab_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_paciente_programa_estab_id_seq OWNED BY mnt_paciente_programa_estab.id;


--
-- Name: mnt_procedimiento_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_procedimiento_establecimiento (
    id integer NOT NULL,
    id_ciq integer NOT NULL,
    id_rangohora integer,
    id_empleado integer,
    techomaximo integer,
    cantidadacupo integer DEFAULT 0,
    tiempoprevio integer,
    dia integer,
    id_area_mod_estab integer,
    id_establecimiento integer,
    yrs integer,
    idusuarioreg smallint,
    fechahorareg timestamp without time zone,
    idusuariomod smallint,
    fechahoramod timestamp without time zone
);


ALTER TABLE mnt_procedimiento_establecimiento OWNER TO simagd;

--
-- Name: mnt_procedimiento_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_procedimiento_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_procedimiento_establecimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_procedimiento_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_procedimiento_establecimiento_id_seq OWNED BY mnt_procedimiento_establecimiento.id;


--
-- Name: mnt_programa_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_programa_establecimiento (
    id integer NOT NULL,
    id_establecimiento integer NOT NULL,
    id_programa integer NOT NULL,
    condicion character(1)
);


ALTER TABLE mnt_programa_establecimiento OWNER TO simagd;

--
-- Name: TABLE mnt_programa_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_programa_establecimiento IS 'Contiene la oferta de programas que contiene un establecimiento';


--
-- Name: COLUMN mnt_programa_establecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_programa_establecimiento.id IS 'Llave Primaria';


--
-- Name: COLUMN mnt_programa_establecimiento.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_programa_establecimiento.id_establecimiento IS 'Foránea que representa el establecimiento';


--
-- Name: COLUMN mnt_programa_establecimiento.id_programa; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_programa_establecimiento.id_programa IS 'Foránea que representa el programa';


--
-- Name: mnt_programa_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_programa_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_programa_establecimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_programa_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_programa_establecimiento_id_seq OWNED BY mnt_programa_establecimiento.id;


--
-- Name: mnt_rangohora; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_rangohora (
    id integer NOT NULL,
    hora_ini time without time zone,
    hora_fin time without time zone,
    modulo character varying(60),
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    meridianoini character varying(2),
    meridianofin character varying(2)
);


ALTER TABLE mnt_rangohora OWNER TO simagd;

--
-- Name: TABLE mnt_rangohora; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_rangohora IS 'Los horarios para las citas medicas.';


--
-- Name: COLUMN mnt_rangohora.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_rangohora.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_rangohora.hora_ini; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_rangohora.hora_ini IS 'Hora inicio';


--
-- Name: COLUMN mnt_rangohora.hora_fin; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_rangohora.hora_fin IS 'Hora final';


--
-- Name: COLUMN mnt_rangohora.modulo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_rangohora.modulo IS 'Identificador del modulo';


--
-- Name: COLUMN mnt_rangohora.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_rangohora.idusuarioreg IS 'Usuario que ingresa el registro, relacionado con mnt_empleados';


--
-- Name: COLUMN mnt_rangohora.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_rangohora.fechahorareg IS 'Fecha y hora en la que se ingresa el registro';


--
-- Name: mnt_rangohora_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_rangohora_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_rangohora_id_seq OWNER TO simagd;

--
-- Name: mnt_rangohora_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_rangohora_id_seq OWNED BY mnt_rangohora.id;


--
-- Name: mnt_servicio_externo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_servicio_externo (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    descripcion text,
    abreviatura character varying(10)
);


ALTER TABLE mnt_servicio_externo OWNER TO simagd;

--
-- Name: TABLE mnt_servicio_externo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_servicio_externo IS 'Lista todos aquellos servicios que ofrece el establecimiento pero son cobrados hacia otras entidades a las que el paciente puede estar afiliado';


--
-- Name: COLUMN mnt_servicio_externo.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_servicio_externo.id IS 'Llave primaria';


--
-- Name: COLUMN mnt_servicio_externo.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_servicio_externo.nombre IS 'Nombre de la entidad a la que se le cobrarán los servicios de atención';


--
-- Name: COLUMN mnt_servicio_externo.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_servicio_externo.descripcion IS 'Breve descripción de la entidad si así se considera';


--
-- Name: COLUMN mnt_servicio_externo.abreviatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_servicio_externo.abreviatura IS 'Abreviatura para el servicio  externo definido';


--
-- Name: mnt_servicio_externo_establecimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_servicio_externo_establecimiento (
    id integer NOT NULL,
    id_establecimiento integer NOT NULL,
    id_servicio_externo integer NOT NULL
);


ALTER TABLE mnt_servicio_externo_establecimiento OWNER TO simagd;

--
-- Name: TABLE mnt_servicio_externo_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_servicio_externo_establecimiento IS 'Contiene las entidades ';


--
-- Name: COLUMN mnt_servicio_externo_establecimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_servicio_externo_establecimiento.id IS 'Llave Primaria';


--
-- Name: COLUMN mnt_servicio_externo_establecimiento.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_servicio_externo_establecimiento.id_establecimiento IS 'Foránea que representa el establecimiento';


--
-- Name: COLUMN mnt_servicio_externo_establecimiento.id_servicio_externo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_servicio_externo_establecimiento.id_servicio_externo IS 'Foránea que representa el servicio externo';


--
-- Name: mnt_servicio_externo_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_servicio_externo_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_servicio_externo_establecimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_servicio_externo_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_servicio_externo_establecimiento_id_seq OWNED BY mnt_servicio_externo_establecimiento.id;


--
-- Name: mnt_servicio_externo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_servicio_externo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_servicio_externo_id_seq OWNER TO simagd;

--
-- Name: mnt_servicio_externo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_servicio_externo_id_seq OWNED BY mnt_servicio_externo.id;


--
-- Name: mnt_tipo_empleado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_tipo_empleado (
    id integer NOT NULL,
    codigo character varying(3) NOT NULL,
    tipo character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE mnt_tipo_empleado OWNER TO simagd;

--
-- Name: mnt_tipo_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_tipo_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_tipo_empleado_id_seq OWNER TO simagd;

--
-- Name: mnt_tipo_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_tipo_empleado_id_seq OWNED BY mnt_tipo_empleado.id;


--
-- Name: mnt_tipo_procedimiento; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_tipo_procedimiento (
    nombre character varying(10) NOT NULL,
    descripcion character varying(50),
    id integer NOT NULL
);


ALTER TABLE mnt_tipo_procedimiento OWNER TO simagd;

--
-- Name: COLUMN mnt_tipo_procedimiento.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_tipo_procedimiento.nombre IS 'Nombre del tipo de procedimiento';


--
-- Name: COLUMN mnt_tipo_procedimiento.descripcion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_tipo_procedimiento.descripcion IS 'Descripción del tipo';


--
-- Name: COLUMN mnt_tipo_procedimiento.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_tipo_procedimiento.id IS 'Llave Primaria de la tabla';


--
-- Name: mnt_tipo_procedimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_tipo_procedimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_tipo_procedimiento_id_seq OWNER TO simagd;

--
-- Name: mnt_tipo_procedimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_tipo_procedimiento_id_seq OWNED BY mnt_tipo_procedimiento.id;


--
-- Name: mnt_tiposdiagnosticos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_tiposdiagnosticos (
    idtipodiagnostico integer NOT NULL,
    descripcion character varying(50) DEFAULT '0'::character varying
);


ALTER TABLE mnt_tiposdiagnosticos OWNER TO simagd;

--
-- Name: mnt_tiposdiagnosticos_idtipodiagnostico_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_tiposdiagnosticos_idtipodiagnostico_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_tiposdiagnosticos_idtipodiagnostico_seq OWNER TO simagd;

--
-- Name: mnt_tiposdiagnosticos_idtipodiagnostico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_tiposdiagnosticos_idtipodiagnostico_seq OWNED BY mnt_tiposdiagnosticos.idtipodiagnostico;


--
-- Name: mnt_usuarios; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE mnt_usuarios (
    id integer NOT NULL,
    login character varying(25) DEFAULT NULL::character varying,
    password character varying(32) DEFAULT NULL::character varying,
    nivel integer,
    modulo character varying(3) DEFAULT NULL::character varying,
    grupo integer NOT NULL,
    idempleado character varying(7) DEFAULT NULL::character varying,
    estadocuenta character(1) DEFAULT 'H'::bpchar,
    id_atencion_establecimiento integer,
    idestablecimiento integer NOT NULL,
    idmodalidad integer
);


ALTER TABLE mnt_usuarios OWNER TO simagd;

--
-- Name: TABLE mnt_usuarios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE mnt_usuarios IS 'USURIOS Y CLAVES VALIDAS PARA EL INGRESO AL SISTEMA';


--
-- Name: COLUMN mnt_usuarios.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.id IS 'IdUsuario';


--
-- Name: COLUMN mnt_usuarios.login; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.login IS 'usuario con el que se inicia sesion';


--
-- Name: COLUMN mnt_usuarios.password; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.password IS 'contraseña del usuarios con MD5';


--
-- Name: COLUMN mnt_usuarios.nivel; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.nivel IS 'nivel de acceso';


--
-- Name: COLUMN mnt_usuarios.modulo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.modulo IS 'modulo del SIAP al que puede ingresar';


--
-- Name: COLUMN mnt_usuarios.grupo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.grupo IS 'Grupo al que pertenece (En dado caso esten agrupados sus privilegios)';


--
-- Name: COLUMN mnt_usuarios.idempleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.idempleado IS 'IdEmpleado, Conectado con mnt_empleados';


--
-- Name: COLUMN mnt_usuarios.estadocuenta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.estadocuenta IS 'Estado de la cuenta H: Habilitado I: Inhabilitada';


--
-- Name: COLUMN mnt_usuarios.id_atencion_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.id_atencion_establecimiento IS 'Fk mnt_aten_area_mod_estab';


--
-- Name: COLUMN mnt_usuarios.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.idestablecimiento IS 'IdEstablecimiento, Conectado con mnt_establecimiento';


--
-- Name: COLUMN mnt_usuarios.idmodalidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN mnt_usuarios.idmodalidad IS 'Modalidad a la que pertenece';


--
-- Name: mnt_usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE mnt_usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_usuarios_id_seq OWNER TO simagd;

--
-- Name: mnt_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE mnt_usuarios_id_seq OWNED BY mnt_usuarios.id;


--
-- Name: rx_area; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_area (
    id integer NOT NULL,
    codigo_area character varying(4) DEFAULT NULL::character varying,
    nombre_area character varying(150) DEFAULT NULL::character varying,
    habilitado character varying(1) DEFAULT NULL::character varying,
    direccion character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE rx_area OWNER TO simagd;

--
-- Name: TABLE rx_area; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_area IS 'AREAS DE RAYOS X';


--
-- Name: rx_area_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_area_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_area_id_seq OWNER TO simagd;

--
-- Name: rx_area_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_area_id_seq OWNED BY rx_area.id;


--
-- Name: rx_causa_rechazo; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_causa_rechazo (
    id integer NOT NULL,
    causa character varying(150) DEFAULT NULL::character varying
);


ALTER TABLE rx_causa_rechazo OWNER TO simagd;

--
-- Name: TABLE rx_causa_rechazo; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_causa_rechazo IS 'TABLA TIPO DE RECHAZOS DE PLACAS TOMADAS';


--
-- Name: rx_causa_rechazo_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_causa_rechazo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_causa_rechazo_id_seq OWNER TO simagd;

--
-- Name: rx_causa_rechazo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_causa_rechazo_id_seq OWNED BY rx_causa_rechazo.id;


--
-- Name: rx_estado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_estado (
    id integer NOT NULL,
    codigo_estado character varying(2) NOT NULL,
    estado character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE rx_estado OWNER TO simagd;

--
-- Name: TABLE rx_estado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_estado IS 'TABLA DE ESTADOS DE LA SOLICITUD DE RAYOS X';


--
-- Name: rx_estado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_estado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_estado_id_seq OWNER TO simagd;

--
-- Name: rx_estado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_estado_id_seq OWNED BY rx_estado.id;


--
-- Name: rx_examen; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_examen (
    id integer NOT NULL,
    codigo_examen character varying(6) NOT NULL,
    id_area integer NOT NULL,
    nombre_examen character varying(250) DEFAULT NULL::character varying,
    habilitado character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE rx_examen OWNER TO simagd;

--
-- Name: TABLE rx_examen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_examen IS 'TABLA TIPO DE EXAMENES EXITENTES DE RAYOS X';


--
-- Name: rx_examen_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_examen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_examen_id_seq OWNER TO simagd;

--
-- Name: rx_examen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_examen_id_seq OWNED BY rx_examen.id;


--
-- Name: rx_imagen; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_imagen (
    id integer NOT NULL,
    id_radiografia integer,
    imagen bytea,
    nombre character varying(50),
    tipo character varying(50)
);


ALTER TABLE rx_imagen OWNER TO simagd;

--
-- Name: TABLE rx_imagen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_imagen IS 'TABLA ALMACENAMIENTO DE IMAGEN DIGITAL DE PLACAS';


--
-- Name: rx_imagen_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_imagen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_imagen_id_seq OWNER TO simagd;

--
-- Name: rx_imagen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_imagen_id_seq OWNED BY rx_imagen.id;


--
-- Name: rx_insertado; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_insertado (
    id integer NOT NULL,
    indicacion text,
    id_examen integer
);


ALTER TABLE rx_insertado OWNER TO simagd;

--
-- Name: rx_insertado_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_insertado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_insertado_id_seq OWNER TO simagd;

--
-- Name: rx_insertado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_insertado_id_seq OWNED BY rx_insertado.id;


--
-- Name: rx_radiografia; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_radiografia (
    id integer NOT NULL,
    tamanio character varying(60) DEFAULT NULL::character varying,
    lectura_placa text,
    estado character varying(2) DEFAULT NULL::character varying,
    id_detalle_solicitud integer,
    id_solicitud_estudio integer,
    fecha date,
    id_empleado character varying(50) DEFAULT NULL::character varying,
    encargado_traslado character varying(50) DEFAULT NULL::character varying,
    tecnico character varying(50) DEFAULT NULL::character varying,
    habilitado character varying(2) DEFAULT NULL::character varying
);


ALTER TABLE rx_radiografia OWNER TO simagd;

--
-- Name: TABLE rx_radiografia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_radiografia IS 'TABLA CONTROL DE TOMA DE RADIOGRAFIAS';


--
-- Name: rx_radiografia_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_radiografia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_radiografia_id_seq OWNER TO simagd;

--
-- Name: rx_radiografia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_radiografia_id_seq OWNED BY rx_radiografia.id;


--
-- Name: rx_rechazada; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_rechazada (
    id integer NOT NULL,
    id_detalle_solicitud integer,
    id_tamanio_pelicula integer,
    fecha date,
    buenas integer,
    muy_penetrada integer,
    poco_penetrada integer,
    mal_centrada integer,
    movida integer,
    falla_equipo integer,
    falla_revelado integer,
    velada integer,
    con_artefacto integer,
    no_expuesta integer,
    mal_preparado integer
);


ALTER TABLE rx_rechazada OWNER TO simagd;

--
-- Name: TABLE rx_rechazada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_rechazada IS 'TABLA CONTROL DE PLACAS RECHAZADAS';


--
-- Name: rx_rechazada_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_rechazada_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_rechazada_id_seq OWNER TO simagd;

--
-- Name: rx_rechazada_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_rechazada_id_seq OWNED BY rx_rechazada.id;


--
-- Name: rx_tamanio_pelicula; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE rx_tamanio_pelicula (
    id integer NOT NULL,
    tamanio character varying(60) DEFAULT NULL::character varying,
    habilitado character varying(2) DEFAULT NULL::character varying
);


ALTER TABLE rx_tamanio_pelicula OWNER TO simagd;

--
-- Name: TABLE rx_tamanio_pelicula; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE rx_tamanio_pelicula IS 'TABLA TAMAÑO DE PLACAS';


--
-- Name: rx_tamanio_pelicula_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE rx_tamanio_pelicula_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rx_tamanio_pelicula_id_seq OWNER TO simagd;

--
-- Name: rx_tamanio_pelicula_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE rx_tamanio_pelicula_id_seq OWNED BY rx_tamanio_pelicula.id;


--
-- Name: sec_antecedentes; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_antecedentes (
    id integer NOT NULL,
    idhistorialclinico integer,
    afamiliar text,
    apersonal text,
    aecologicosocial text,
    motivoconsulta text,
    presentaenfermedad text,
    hxexamenes text
);


ALTER TABLE sec_antecedentes OWNER TO simagd;

--
-- Name: TABLE sec_antecedentes; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_antecedentes IS 'Antecedentes clinicos de pacientes';


--
-- Name: COLUMN sec_antecedentes.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.id IS 'Llave primaria';


--
-- Name: COLUMN sec_antecedentes.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.idhistorialclinico IS 'IdHistorialClinico, relacionado con sec_historial_clinico.';


--
-- Name: COLUMN sec_antecedentes.afamiliar; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.afamiliar IS 'Antecedentes Familiares';


--
-- Name: COLUMN sec_antecedentes.apersonal; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.apersonal IS 'Antecedentes Personales';


--
-- Name: COLUMN sec_antecedentes.aecologicosocial; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.aecologicosocial IS 'Antecedentes Ecologico Social';


--
-- Name: COLUMN sec_antecedentes.motivoconsulta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.motivoconsulta IS 'Motivo por el cual consulta';


--
-- Name: COLUMN sec_antecedentes.presentaenfermedad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.presentaenfermedad IS 'Si presenta enfermedad';


--
-- Name: COLUMN sec_antecedentes.hxexamenes; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_antecedentes.hxexamenes IS 'Historial de examanes tomados';


--
-- Name: sec_antecedentes_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_antecedentes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_antecedentes_id_seq OWNER TO simagd;

--
-- Name: sec_antecedentes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_antecedentes_id_seq OWNED BY sec_antecedentes.id;


--
-- Name: sec_circunstancia_ingreso; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_circunstancia_ingreso (
    id integer NOT NULL,
    nombre character varying(25) NOT NULL,
    habilitado boolean DEFAULT true
);


ALTER TABLE sec_circunstancia_ingreso OWNER TO simagd;

--
-- Name: TABLE sec_circunstancia_ingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_circunstancia_ingreso IS 'Contiene las circunstancia del ingreso. Se le agrego el habilitado por si en algun momento alguno dejar de existir para poder tener historicos';


--
-- Name: COLUMN sec_circunstancia_ingreso.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_circunstancia_ingreso.id IS 'Llave primaria';


--
-- Name: COLUMN sec_circunstancia_ingreso.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_circunstancia_ingreso.nombre IS 'Nombre de la circunstancia del ingreso';


--
-- Name: COLUMN sec_circunstancia_ingreso.habilitado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_circunstancia_ingreso.habilitado IS 'estado de la circunstancia';


--
-- Name: sec_circunstancia_ingreso_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_circunstancia_ingreso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_circunstancia_ingreso_id_seq OWNER TO simagd;

--
-- Name: sec_circunstancia_ingreso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_circunstancia_ingreso_id_seq OWNED BY sec_circunstancia_ingreso.id;


--
-- Name: sec_detallediagnosticos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_detallediagnosticos (
    iddetalle integer NOT NULL,
    iddiagnosticosproc integer,
    idcie10 character varying(5),
    idtipodiagnostico integer
);


ALTER TABLE sec_detallediagnosticos OWNER TO simagd;

--
-- Name: TABLE sec_detallediagnosticos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_detallediagnosticos IS 'Detalle de los Dx del paciente.';


--
-- Name: COLUMN sec_detallediagnosticos.iddetalle; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallediagnosticos.iddetalle IS 'Llave primaria';


--
-- Name: COLUMN sec_detallediagnosticos.iddiagnosticosproc; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallediagnosticos.iddiagnosticosproc IS 'FK IdDiagnosticosProc, relacionado con sec_diagnosticos_procedimientos';


--
-- Name: COLUMN sec_detallediagnosticos.idcie10; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallediagnosticos.idcie10 IS 'FK IdCie10, relacionado con mnt_cie10';


--
-- Name: COLUMN sec_detallediagnosticos.idtipodiagnostico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallediagnosticos.idtipodiagnostico IS 'FK IdTipoDiagnostico, relacionado con mnt_tiposdiagnosticos';


--
-- Name: sec_detallediagnosticos_iddetalle_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_detallediagnosticos_iddetalle_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_detallediagnosticos_iddetalle_seq OWNER TO simagd;

--
-- Name: sec_detallediagnosticos_iddetalle_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_detallediagnosticos_iddetalle_seq OWNED BY sec_detallediagnosticos.iddetalle;


--
-- Name: sec_detalleprocedimientos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_detalleprocedimientos (
    idprocedimientos integer NOT NULL,
    iddiagnosticosproc integer,
    idciq character varying(5),
    id_tipo_procedimiento integer
);


ALTER TABLE sec_detalleprocedimientos OWNER TO simagd;

--
-- Name: TABLE sec_detalleprocedimientos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_detalleprocedimientos IS 'Detalle de los Procedimientos medicos del paciente.';


--
-- Name: COLUMN sec_detalleprocedimientos.idprocedimientos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detalleprocedimientos.idprocedimientos IS 'Llave primaria';


--
-- Name: COLUMN sec_detalleprocedimientos.iddiagnosticosproc; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detalleprocedimientos.iddiagnosticosproc IS 'FK IdDiagnosticosProc, relacionado con sec_diagnosticos_procedimientos';


--
-- Name: COLUMN sec_detalleprocedimientos.idciq; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detalleprocedimientos.idciq IS 'FK IdCie10, relacionado con mnt_ciq';


--
-- Name: sec_detalleprocedimientos_idprocedimientos_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_detalleprocedimientos_idprocedimientos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_detalleprocedimientos_idprocedimientos_seq OWNER TO simagd;

--
-- Name: sec_detalleprocedimientos_idprocedimientos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_detalleprocedimientos_idprocedimientos_seq OWNED BY sec_detalleprocedimientos.idprocedimientos;


--
-- Name: sec_detallesolicitudestudios; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_detallesolicitudestudios (
    id integer NOT NULL,
    idsolicitudestudio integer,
    indicacion character varying(250),
    idtipomuestra integer,
    idorigenmuestra integer,
    observacion character varying(250),
    idexamen integer NOT NULL,
    idestablecimiento integer NOT NULL,
    idestablecimientoexterno integer,
    idempleado integer NOT NULL,
    idusuarioreg integer NOT NULL,
    fechahorareg date,
    estadodetalle integer NOT NULL
);


ALTER TABLE sec_detallesolicitudestudios OWNER TO simagd;

--
-- Name: TABLE sec_detallesolicitudestudios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_detallesolicitudestudios IS 'Detalle de la solicitud de estudios por paciente';


--
-- Name: COLUMN sec_detallesolicitudestudios.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.id IS 'Llave primaria';


--
-- Name: COLUMN sec_detallesolicitudestudios.idsolicitudestudio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.idsolicitudestudio IS 'FK IdSolicitudEstudios, relacionado con sec_solicitudestudios';


--
-- Name: COLUMN sec_detallesolicitudestudios.indicacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.indicacion IS 'Indicaciones especificas que asigna el medico sobre el estudio';


--
-- Name: COLUMN sec_detallesolicitudestudios.idtipomuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.idtipomuestra IS 'FK IdTipoMuestra, relacionado con lab_tipomuestra';


--
-- Name: COLUMN sec_detallesolicitudestudios.idorigenmuestra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.idorigenmuestra IS 'FK IdOrigenMuestra, relacionado con mnt_origenmuestra';


--
-- Name: COLUMN sec_detallesolicitudestudios.observacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.observacion IS 'Observaciones ingresadas por el tecnico que realizo el estudio';


--
-- Name: COLUMN sec_detallesolicitudestudios.idexamen; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.idexamen IS 'Fk mnt_area_examen_establecimiento, permite conocer de que area, examen y atencion pertenece a la solicitud';


--
-- Name: COLUMN sec_detallesolicitudestudios.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.idestablecimiento IS 'Fk ctl_establecimiento, determina el establecimiento que esta realizando un nuevo detalle de solicitud';


--
-- Name: COLUMN sec_detallesolicitudestudios.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.idusuarioreg IS 'Fk fos_user_user, para registrar el usuario que solicito un nuevo examen';


--
-- Name: COLUMN sec_detallesolicitudestudios.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_detallesolicitudestudios.fechahorareg IS 'Campo que registra la fecha en la que se solicito el nuevo detalle de solicitud';


--
-- Name: sec_detallesolicitudestudios_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_detallesolicitudestudios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_detallesolicitudestudios_id_seq OWNER TO simagd;

--
-- Name: sec_detallesolicitudestudios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_detallesolicitudestudios_id_seq OWNED BY sec_detallesolicitudestudios.id;


--
-- Name: sec_diagnosticos_procedimientos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_diagnosticos_procedimientos (
    iddiagnosticosproc integer NOT NULL,
    idsubservicio integer DEFAULT 0 NOT NULL
);


ALTER TABLE sec_diagnosticos_procedimientos OWNER TO simagd;

--
-- Name: TABLE sec_diagnosticos_procedimientos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_diagnosticos_procedimientos IS 'Historico de Dx por procedimientos por paciente';


--
-- Name: COLUMN sec_diagnosticos_procedimientos.iddiagnosticosproc; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticos_procedimientos.iddiagnosticosproc IS 'Llave PK';


--
-- Name: COLUMN sec_diagnosticos_procedimientos.idsubservicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticos_procedimientos.idsubservicio IS 'FK IdSubServicio, antes relacionado con mnt_subservicio ( ahora relacionado con ctl_atencion)';


--
-- Name: sec_diagnosticos_procedimientos_iddiagnosticosproc_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_diagnosticos_procedimientos_iddiagnosticosproc_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_diagnosticos_procedimientos_iddiagnosticosproc_seq OWNER TO simagd;

--
-- Name: sec_diagnosticos_procedimientos_iddiagnosticosproc_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_diagnosticos_procedimientos_iddiagnosticosproc_seq OWNED BY sec_diagnosticos_procedimientos.iddiagnosticosproc;


--
-- Name: sec_diagnosticospaciente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_diagnosticospaciente (
    id integer NOT NULL,
    procedimientos text,
    idhistorialclinico integer DEFAULT 0 NOT NULL,
    examenesgabinete text,
    descripcioncie101 text,
    descripcioncie102 text,
    descripcioncie103 text,
    iddiagnostico1 integer,
    iddiagnostico2 integer,
    iddiagnostico3 integer
);


ALTER TABLE sec_diagnosticospaciente OWNER TO simagd;

--
-- Name: TABLE sec_diagnosticospaciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_diagnosticospaciente IS 'Historico de diagnosticos clinicos por paciente';


--
-- Name: COLUMN sec_diagnosticospaciente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticospaciente.id IS 'Llave PK';


--
-- Name: COLUMN sec_diagnosticospaciente.procedimientos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticospaciente.procedimientos IS 'Procedimientos a tomar o realizados.';


--
-- Name: COLUMN sec_diagnosticospaciente.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticospaciente.idhistorialclinico IS 'FK IdHistorialClinico, relacionado con sec_historial_clinico';


--
-- Name: COLUMN sec_diagnosticospaciente.examenesgabinete; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticospaciente.examenesgabinete IS 'Ingreso de Examanes de Gabinetes tomados o realizados';


--
-- Name: COLUMN sec_diagnosticospaciente.descripcioncie101; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticospaciente.descripcioncie101 IS 'Descripcion adicional del Diagnostico primario';


--
-- Name: COLUMN sec_diagnosticospaciente.descripcioncie102; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticospaciente.descripcioncie102 IS 'Descripcion adicional del Diagnostico segundario.';


--
-- Name: COLUMN sec_diagnosticospaciente.descripcioncie103; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_diagnosticospaciente.descripcioncie103 IS 'Descripcion del Diagnostico tercero.';


--
-- Name: sec_diagnosticospaciente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_diagnosticospaciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_diagnosticospaciente_id_seq OWNER TO simagd;

--
-- Name: sec_diagnosticospaciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_diagnosticospaciente_id_seq OWNED BY sec_diagnosticospaciente.id;


--
-- Name: sec_egresos; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_egresos (
    idegreso integer NOT NULL,
    idingreso integer,
    iddiagnosticosproc integer,
    egresosinconsenmedico character varying(150) DEFAULT NULL::character varying,
    fechaegreso date NOT NULL,
    horaegreso time without time zone NOT NULL,
    idcondicion integer,
    fechaentrega date NOT NULL,
    horaentrega time without time zone NOT NULL,
    trasladootrohospital integer DEFAULT 0,
    idsubserviciotraslado integer DEFAULT 0,
    idempleado character varying,
    idusuarioreg smallint DEFAULT (0)::smallint NOT NULL,
    idusuariomod smallint DEFAULT (0)::smallint NOT NULL,
    fechahorareg timestamp without time zone NOT NULL,
    fechahoramod timestamp without time zone NOT NULL,
    diasuci integer DEFAULT 0,
    embpartopuerperio smallint,
    identificador character(1) NOT NULL
);


ALTER TABLE sec_egresos OWNER TO simagd;

--
-- Name: TABLE sec_egresos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_egresos IS 'TABLA DE REGISTROS DE EGRESO';


--
-- Name: COLUMN sec_egresos.idegreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.idegreso IS 'Llave PK';


--
-- Name: COLUMN sec_egresos.idingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.idingreso IS 'FK IdIngreso, relacionado con sec_ingresos';


--
-- Name: COLUMN sec_egresos.iddiagnosticosproc; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.iddiagnosticosproc IS 'FK IdDiagnosticosProc, relacionado con sec_diagnosticos_procedimientos.';


--
-- Name: COLUMN sec_egresos.fechaegreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.fechaegreso IS 'Fecha del egreso';


--
-- Name: COLUMN sec_egresos.horaegreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.horaegreso IS 'Hora del egreso';


--
-- Name: COLUMN sec_egresos.idcondicion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.idcondicion IS 'FK IdCondicion, relacionado con mnt_condicionegreso';


--
-- Name: COLUMN sec_egresos.idsubserviciotraslado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.idsubserviciotraslado IS 'Id del subservicio al que se traslada, ahora relacionado con ctl_atencion';


--
-- Name: COLUMN sec_egresos.idempleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.idempleado IS 'FK IdEmpleado, relacionado con mnt_empleados';


--
-- Name: COLUMN sec_egresos.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.idusuarioreg IS 'Usuario que ingresa el registro, relacionado con mnt_empleados';


--
-- Name: COLUMN sec_egresos.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.idusuariomod IS 'Usuario que modifica el registro, relacionado con mnt_empleados';


--
-- Name: COLUMN sec_egresos.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.fechahorareg IS 'Fecha y hora de ingreso del registro';


--
-- Name: COLUMN sec_egresos.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.fechahoramod IS 'Fecha y hora de modificacion del registro';


--
-- Name: COLUMN sec_egresos.diasuci; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_egresos.diasuci IS 'Dias de estancia en la unidad de cuidados intensivos';


--
-- Name: sec_egresos_idegreso_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_egresos_idegreso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_egresos_idegreso_seq OWNER TO simagd;

--
-- Name: sec_egresos_idegreso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_egresos_idegreso_seq OWNED BY sec_egresos.idegreso;


--
-- Name: sec_emergencia; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_emergencia (
    id integer NOT NULL,
    numero_emergencia character varying(15) NOT NULL,
    id_paciente integer,
    id_usuario_registra integer NOT NULL,
    id_usuario_modifica integer,
    fecha_registra timestamp without time zone NOT NULL,
    fecha_modifica timestamp without time zone,
    anio_emergencia integer NOT NULL
);


ALTER TABLE sec_emergencia OWNER TO simagd;

--
-- Name: TABLE sec_emergencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_emergencia IS 'LLEVA EL REGISTRO DE TODOS LAS EMERGENCIAS, se agregó el campo de año para que cada vez que inicie un año se reinicie
  el numero';


--
-- Name: COLUMN sec_emergencia.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.id IS 'Llave PK';


--
-- Name: COLUMN sec_emergencia.numero_emergencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.numero_emergencia IS 'Correlativo que representa el identificativo de la emergencia';


--
-- Name: COLUMN sec_emergencia.id_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.id_paciente IS 'Foránea, relacionado con mnt_paciente';


--
-- Name: COLUMN sec_emergencia.id_usuario_registra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.id_usuario_registra IS 'Foránea que representa el usuario que ingresa el registro';


--
-- Name: COLUMN sec_emergencia.id_usuario_modifica; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.id_usuario_modifica IS 'Foránea que representa el usuario que modifica el registro';


--
-- Name: COLUMN sec_emergencia.fecha_registra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.fecha_registra IS 'Fecha y hora que se ingresa el registro';


--
-- Name: COLUMN sec_emergencia.fecha_modifica; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.fecha_modifica IS 'Fecha y hora que se modifica el registro';


--
-- Name: COLUMN sec_emergencia.anio_emergencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_emergencia.anio_emergencia IS 'Año en que se guardo la emergencia. Se utilizará para realizar el calculo del numero de la emergencia';


--
-- Name: sec_emergencia_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_emergencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_emergencia_id_seq OWNER TO simagd;

--
-- Name: sec_emergencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_emergencia_id_seq OWNED BY sec_emergencia.id;


--
-- Name: sec_estado_paciente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_estado_paciente (
    id integer NOT NULL,
    nombre character varying(15) NOT NULL,
    abreviatura character varying(2)
);


ALTER TABLE sec_estado_paciente OWNER TO simagd;

--
-- Name: TABLE sec_estado_paciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_estado_paciente IS 'Contiene los estados por los cuales puede estar un paciente en un determinado modulo';


--
-- Name: COLUMN sec_estado_paciente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_estado_paciente.id IS 'Llave primaria';


--
-- Name: COLUMN sec_estado_paciente.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_estado_paciente.nombre IS 'Nombre del estado del paciente';


--
-- Name: COLUMN sec_estado_paciente.abreviatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_estado_paciente.abreviatura IS 'Abreviatura del Estado';


--
-- Name: sec_estado_paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_estado_paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_estado_paciente_id_seq OWNER TO simagd;

--
-- Name: sec_estado_paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_estado_paciente_id_seq OWNED BY sec_estado_paciente.id;


--
-- Name: sec_historial_clinico; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_historial_clinico (
    id integer NOT NULL,
    datosclinicos character varying(200) DEFAULT NULL::character varying,
    fechaconsulta date,
    empleado character varying(7) DEFAULT NULL::character varying,
    idsubservicio integer,
    seguimientoconsultaext character(4) DEFAULT NULL::bpchar,
    idusuarioreg smallint,
    fechahorareg timestamp without time zone,
    piloto character(1) DEFAULT NULL::bpchar,
    ipaddress character varying(15) DEFAULT NULL::character varying,
    idestablecimiento integer,
    idnumeroexp character varying,
    id_numero_expediente integer,
    id_empleado integer,
    idmodalidad integer
);


ALTER TABLE sec_historial_clinico OWNER TO simagd;

--
-- Name: TABLE sec_historial_clinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_historial_clinico IS 'Historial clinico de pacientes atendidos por medicos';


--
-- Name: COLUMN sec_historial_clinico.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.id IS 'Numero de expediente del paciente, conectado con mnt_expediente';


--
-- Name: COLUMN sec_historial_clinico.fechaconsulta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.fechaconsulta IS 'Fecha en la que se genero una nueva historia clinica';


--
-- Name: COLUMN sec_historial_clinico.empleado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.empleado IS 'Medico que realizo la historia clinica';


--
-- Name: COLUMN sec_historial_clinico.idsubservicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.idsubservicio IS 'IdSubServicio/Especialidad en la que se genero la historia clnica, ahora conectado con ctl_atencion';


--
-- Name: COLUMN sec_historial_clinico.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.idusuarioreg IS 'IdUsuario que ingreso el registro';


--
-- Name: COLUMN sec_historial_clinico.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.fechahorareg IS 'Fecha y hora de ingreso del registro';


--
-- Name: COLUMN sec_historial_clinico.piloto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.piloto IS 'Bandera para determinar si es una version piloto y/o ingreso de historias por medio de otro modulo (Farmacia)';


--
-- Name: COLUMN sec_historial_clinico.ipaddress; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.ipaddress IS 'Direccion IP de la maquina en la que se realizo la transaccion';


--
-- Name: COLUMN sec_historial_clinico.idestablecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_historial_clinico.idestablecimiento IS 'IdEstablecimiento, conectado con ctl_establecimiento';


--
-- Name: sec_historial_clinico_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_historial_clinico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_historial_clinico_id_seq OWNER TO simagd;

--
-- Name: sec_historial_clinico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_historial_clinico_id_seq OWNED BY sec_historial_clinico.id;


--
-- Name: sec_hojaindicacionesconsultaexterna; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_hojaindicacionesconsultaexterna (
    idhojaindicacionesconsultaexterna integer NOT NULL,
    idhistorialclinico integer DEFAULT 0 NOT NULL,
    indicacionesmedicas text,
    plantratamiento text,
    otros text
);


ALTER TABLE sec_hojaindicacionesconsultaexterna OWNER TO simagd;

--
-- Name: TABLE sec_hojaindicacionesconsultaexterna; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_hojaindicacionesconsultaexterna IS 'TABLA DE INDICACIONES Y PLAN DE TRATAMIENTO DE PACIENTE';


--
-- Name: COLUMN sec_hojaindicacionesconsultaexterna.idhojaindicacionesconsultaexterna; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_hojaindicacionesconsultaexterna.idhojaindicacionesconsultaexterna IS 'Llave Primaria';


--
-- Name: COLUMN sec_hojaindicacionesconsultaexterna.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_hojaindicacionesconsultaexterna.idhistorialclinico IS 'IdHisotialClinico, Conecta con sec_historial_clinico';


--
-- Name: COLUMN sec_hojaindicacionesconsultaexterna.indicacionesmedicas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_hojaindicacionesconsultaexterna.indicacionesmedicas IS 'Indicaciones de reposo descanso o habitos que mejoren la salud, descritos por el medico';


--
-- Name: COLUMN sec_hojaindicacionesconsultaexterna.plantratamiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_hojaindicacionesconsultaexterna.plantratamiento IS 'Plan de tratamiento como dietas o aplicaciones de medicamentos';


--
-- Name: COLUMN sec_hojaindicacionesconsultaexterna.otros; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_hojaindicacionesconsultaexterna.otros IS 'Otro tipo de indicaciones medicas';


--
-- Name: sec_hojaindicacionesconsultae_idhojaindicacionesconsultaext_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_hojaindicacionesconsultae_idhojaindicacionesconsultaext_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_hojaindicacionesconsultae_idhojaindicacionesconsultaext_seq OWNER TO simagd;

--
-- Name: sec_hojaindicacionesconsultae_idhojaindicacionesconsultaext_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_hojaindicacionesconsultae_idhojaindicacionesconsultaext_seq OWNED BY sec_hojaindicacionesconsultaexterna.idhojaindicacionesconsultaexterna;


--
-- Name: sec_incapacidadmedica; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_incapacidadmedica (
    incapacidadmedica integer NOT NULL,
    idnumeroexp character varying,
    idhistorialclinico integer DEFAULT 0 NOT NULL,
    motivoincapacidad character varying(500) DEFAULT NULL::character varying,
    fechainicioincapacidad date,
    fechaemision date,
    remitente character varying(500) DEFAULT NULL::character varying
);


ALTER TABLE sec_incapacidadmedica OWNER TO simagd;

--
-- Name: TABLE sec_incapacidadmedica; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_incapacidadmedica IS 'TABLA DE INCAPACIDADES MEDICAS EXTENDIDAS A PACIENTES';


--
-- Name: COLUMN sec_incapacidadmedica.incapacidadmedica; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_incapacidadmedica.incapacidadmedica IS 'Llave Primaria';


--
-- Name: COLUMN sec_incapacidadmedica.idnumeroexp; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_incapacidadmedica.idnumeroexp IS 'Conecta con mnt_expediente';


--
-- Name: COLUMN sec_incapacidadmedica.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_incapacidadmedica.idhistorialclinico IS 'Conecta con sec_historial_clinico';


--
-- Name: COLUMN sec_incapacidadmedica.motivoincapacidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_incapacidadmedica.motivoincapacidad IS 'Motivo por el caul se extiende la incapacidad';


--
-- Name: COLUMN sec_incapacidadmedica.fechainicioincapacidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_incapacidadmedica.fechainicioincapacidad IS 'fecha en al que comienza la incapacidad';


--
-- Name: COLUMN sec_incapacidadmedica.fechaemision; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_incapacidadmedica.fechaemision IS 'Fecha en la que se emite la incapacidad medica al paciente';


--
-- Name: sec_incapacidadmedica_incapacidadmedica_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_incapacidadmedica_incapacidadmedica_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_incapacidadmedica_incapacidadmedica_seq OWNER TO simagd;

--
-- Name: sec_incapacidadmedica_incapacidadmedica_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_incapacidadmedica_incapacidadmedica_seq OWNED BY sec_incapacidadmedica.incapacidadmedica;


--
-- Name: sec_ingreso; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_ingreso (
    id integer NOT NULL,
    id_expediente integer NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    id_aten_are_mod_estab integer NOT NULL,
    id_ambiente_ingreso integer NOT NULL,
    diagnostico text NOT NULL,
    id_cie10 integer,
    id_estado integer NOT NULL,
    id_procedencia_ingreso integer NOT NULL,
    id_circunstancia_ingreso integer NOT NULL,
    id_tipo_accidente integer,
    embarazada boolean,
    semanas_amenorrea integer,
    fecha_probable_parto date,
    id_empleado integer,
    id_establecimiento_referencia integer,
    motivo_referencia text,
    id_usuario_registra integer NOT NULL,
    fecha_registro timestamp without time zone NOT NULL,
    id_usuario_modifica integer,
    fecha_modificacion timestamp without time zone,
    tarjetas_entregadas integer,
    responsable_tarjeta character varying(80)
);


ALTER TABLE sec_ingreso OWNER TO simagd;

--
-- Name: TABLE sec_ingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_ingreso IS 'Contiene todos los ingresos que el paciente tenga en el establecimiento configurado';


--
-- Name: COLUMN sec_ingreso.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN sec_ingreso.id_expediente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_expediente IS 'Foránea que representa el numero de expediente del paciente';


--
-- Name: COLUMN sec_ingreso.id_aten_are_mod_estab; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_aten_are_mod_estab IS 'Especialidad en la que ingresado el paciente';


--
-- Name: COLUMN sec_ingreso.id_ambiente_ingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_ambiente_ingreso IS 'Ambiente físico o servicio al que fue ingresado el paciente';


--
-- Name: COLUMN sec_ingreso.diagnostico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.diagnostico IS 'Diagnostico de ingreso del paciente al hospital';


--
-- Name: COLUMN sec_ingreso.id_cie10; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_cie10 IS 'Foránea que representa el código CIE10 relacionado al ingreso del paciente';


--
-- Name: COLUMN sec_ingreso.id_estado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_estado IS 'Foránea que representa estado del paciente';


--
-- Name: COLUMN sec_ingreso.id_procedencia_ingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_procedencia_ingreso IS 'Foránea que representa la procedencia del ingreso del paciente';


--
-- Name: COLUMN sec_ingreso.id_circunstancia_ingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_circunstancia_ingreso IS 'Foránea que representa la circunstancia del ingreso del paciente';


--
-- Name: COLUMN sec_ingreso.id_tipo_accidente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_tipo_accidente IS 'Foránea que representa el tipo de accidente por el cual fue ingresado el paciente. Si no fuese por accidente puede dejarse en blanco este campo';


--
-- Name: COLUMN sec_ingreso.embarazada; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.embarazada IS 'Este valor representa si una mujer esta embarazada';


--
-- Name: COLUMN sec_ingreso.semanas_amenorrea; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.semanas_amenorrea IS 'Número de semanas de amenorrea';


--
-- Name: COLUMN sec_ingreso.fecha_probable_parto; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.fecha_probable_parto IS 'Fecha probable de parto para una mujer embaraza';


--
-- Name: COLUMN sec_ingreso.id_establecimiento_referencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_establecimiento_referencia IS 'Foránea que representa el establecimiento de donde viene referido el paciente';


--
-- Name: COLUMN sec_ingreso.motivo_referencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.motivo_referencia IS 'Mótivo de la referencia del paciente';


--
-- Name: COLUMN sec_ingreso.id_usuario_registra; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_usuario_registra IS 'Foránea que representa el usuario que registra el ingreso';


--
-- Name: COLUMN sec_ingreso.fecha_registro; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.fecha_registro IS 'Fecha y Hora en que se registra en el sistema el ingreso';


--
-- Name: COLUMN sec_ingreso.id_usuario_modifica; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.id_usuario_modifica IS 'Foránea que representa el usuario que modifica el ingreso';


--
-- Name: COLUMN sec_ingreso.fecha_modificacion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.fecha_modificacion IS 'Fecha y Hora en que se modifica el ingreso';


--
-- Name: COLUMN sec_ingreso.tarjetas_entregadas; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.tarjetas_entregadas IS 'Cantidad de tarjetas entregadas al pariente del ingresado';


--
-- Name: COLUMN sec_ingreso.responsable_tarjeta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingreso.responsable_tarjeta IS 'Nombre de la persona a quien se entrega las tarjestas de visita';


--
-- Name: sec_ingreso_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_ingreso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_ingreso_id_seq OWNER TO simagd;

--
-- Name: sec_ingreso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_ingreso_id_seq OWNED BY sec_ingreso.id;


--
-- Name: sec_ingresos_historial; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_ingresos_historial (
    idingreso integer NOT NULL,
    fechaingreso date NOT NULL,
    horaingreso time without time zone NOT NULL,
    idsubservicio integer DEFAULT 0 NOT NULL,
    subespecialidad integer DEFAULT 0 NOT NULL,
    diagnosticodeingreso character varying(100) DEFAULT ''::character varying NOT NULL,
    tarjetasvisita character varying(255) DEFAULT NULL::character varying,
    estado smallint DEFAULT (1)::smallint NOT NULL,
    idusuarioreg smallint DEFAULT (0)::smallint NOT NULL,
    idusuariomod smallint DEFAULT (0)::smallint NOT NULL,
    fechahorareg timestamp without time zone NOT NULL,
    fechahoramod timestamp without time zone NOT NULL,
    idnumeroexp character varying
);


ALTER TABLE sec_ingresos_historial OWNER TO simagd;

--
-- Name: TABLE sec_ingresos_historial; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_ingresos_historial IS 'HISTORICO DE INGRESO DE PACIENTE, DIAGNOSITCO, SERVICIO HOSP';


--
-- Name: COLUMN sec_ingresos_historial.idingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.idingreso IS 'Llave Primaria';


--
-- Name: COLUMN sec_ingresos_historial.fechaingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.fechaingreso IS 'Fecha que el paciente ingresa al hospital';


--
-- Name: COLUMN sec_ingresos_historial.horaingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.horaingreso IS 'Hora de ingreso hospitalario';


--
-- Name: COLUMN sec_ingresos_historial.idsubservicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.idsubservicio IS 'Servicio hospitalario donde es ingresado el paciente, ahora conecta con ctl_atencion';


--
-- Name: COLUMN sec_ingresos_historial.subespecialidad; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.subespecialidad IS 'Especialidad medica que ingresa al paciente';


--
-- Name: COLUMN sec_ingresos_historial.diagnosticodeingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.diagnosticodeingreso IS 'Diagnostico medico de ingreso';


--
-- Name: COLUMN sec_ingresos_historial.tarjetasvisita; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.tarjetasvisita IS 'Tarjetas de visitas generadas a familiares';


--
-- Name: COLUMN sec_ingresos_historial.estado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.estado IS 'Estado del paciente';


--
-- Name: COLUMN sec_ingresos_historial.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.idusuarioreg IS 'IdUsuario que ingreso el registro';


--
-- Name: COLUMN sec_ingresos_historial.idusuariomod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.idusuariomod IS 'IdUsuario que modifica el registro';


--
-- Name: COLUMN sec_ingresos_historial.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.fechahorareg IS 'Fecha y hora que se ingresa el registro';


--
-- Name: COLUMN sec_ingresos_historial.fechahoramod; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_ingresos_historial.fechahoramod IS 'IdUsuario que modifica el registro';


--
-- Name: sec_ingresos_historial_idingreso_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_ingresos_historial_idingreso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_ingresos_historial_idingreso_seq OWNER TO simagd;

--
-- Name: sec_ingresos_historial_idingreso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_ingresos_historial_idingreso_seq OWNED BY sec_ingresos_historial.idingreso;


--
-- Name: sec_motivo_consulta_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_motivo_consulta_id_seq
    START WITH 251
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_motivo_consulta_id_seq OWNER TO simagd;

--
-- Name: sec_motivo_consulta; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_motivo_consulta (
    id integer DEFAULT nextval('sec_motivo_consulta_id_seq'::regclass) NOT NULL,
    idhistorialclinico integer NOT NULL,
    motivoconsulta text NOT NULL,
    evolucionpaciente text NOT NULL,
    hxexamenes text
);


ALTER TABLE sec_motivo_consulta OWNER TO simagd;

--
-- Name: TABLE sec_motivo_consulta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_motivo_consulta IS 'TABLA DE HISTORIA DE CONTINUACION DE CONTROLES CLINICOS';


--
-- Name: COLUMN sec_motivo_consulta.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_motivo_consulta.id IS 'Llave PK';


--
-- Name: COLUMN sec_motivo_consulta.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_motivo_consulta.idhistorialclinico IS 'FK IdHistorialClinico, relacionado con sec_historial_clinico';


--
-- Name: COLUMN sec_motivo_consulta.motivoconsulta; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_motivo_consulta.motivoconsulta IS 'Motivo por el cual pasa consulta';


--
-- Name: COLUMN sec_motivo_consulta.evolucionpaciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_motivo_consulta.evolucionpaciente IS 'Evolucion del paciente';


--
-- Name: COLUMN sec_motivo_consulta.hxexamenes; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_motivo_consulta.hxexamenes IS 'Historia clinica de examanes tomados';


--
-- Name: sec_procedencia_ingreso; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_procedencia_ingreso (
    id integer NOT NULL,
    nombre character varying(25) NOT NULL,
    habilitado boolean DEFAULT true
);


ALTER TABLE sec_procedencia_ingreso OWNER TO simagd;

--
-- Name: TABLE sec_procedencia_ingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_procedencia_ingreso IS 'Contiene las procedencia del ingreso. Se le agrego el habilitado por si en algun momento alguno dejar de existir para poder tener historicos';


--
-- Name: COLUMN sec_procedencia_ingreso.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_procedencia_ingreso.id IS 'Llave primaria';


--
-- Name: COLUMN sec_procedencia_ingreso.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_procedencia_ingreso.nombre IS 'Nombre de la procedencia del ingreso';


--
-- Name: COLUMN sec_procedencia_ingreso.habilitado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_procedencia_ingreso.habilitado IS 'estado de la procedencia';


--
-- Name: sec_procedencia_ingreso_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_procedencia_ingreso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_procedencia_ingreso_id_seq OWNER TO simagd;

--
-- Name: sec_procedencia_ingreso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_procedencia_ingreso_id_seq OWNED BY sec_procedencia_ingreso.id;


--
-- Name: sec_referencias; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_referencias (
    idreferencia integer NOT NULL,
    idhistorialclinico integer NOT NULL,
    idtiporeferencia integer NOT NULL,
    diagnostico character varying(1000) DEFAULT NULL::character varying,
    resumenclinico text,
    tratamientorecibido character varying(1400) DEFAULT NULL::character varying,
    referidoa character varying(100) DEFAULT NULL::character varying,
    parapor character varying(100) DEFAULT NULL::character varying,
    servicio character varying(6) DEFAULT NULL::character varying
);


ALTER TABLE sec_referencias OWNER TO simagd;

--
-- Name: TABLE sec_referencias; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_referencias IS 'HISTORICO DE REFERENCIAS MEDICAS DE PACIENTE';


--
-- Name: COLUMN sec_referencias.idreferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.idreferencia IS 'Llave Primaria';


--
-- Name: COLUMN sec_referencias.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.idhistorialclinico IS 'HistorialClinico, conecta con tabla sec_historial_clinico';


--
-- Name: COLUMN sec_referencias.idtiporeferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.idtiporeferencia IS 'Tipo de referencia, Interna o Externa';


--
-- Name: COLUMN sec_referencias.diagnostico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.diagnostico IS 'Diagnostico de referencia';


--
-- Name: COLUMN sec_referencias.resumenclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.resumenclinico IS 'Resumen clinico del paciente';


--
-- Name: COLUMN sec_referencias.tratamientorecibido; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.tratamientorecibido IS 'Tratamiento que ha recibido a la fecha';


--
-- Name: COLUMN sec_referencias.referidoa; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.referidoa IS 'Especialidad o establecimiento al que es referido';


--
-- Name: COLUMN sec_referencias.parapor; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.parapor IS 'Objetivo del traslado del paciente';


--
-- Name: COLUMN sec_referencias.servicio; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_referencias.servicio IS 'Servicio hopitalario al que sera referido si es de ingreso medico';


--
-- Name: sec_referencias_idreferencia_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_referencias_idreferencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_referencias_idreferencia_seq OWNER TO simagd;

--
-- Name: sec_referencias_idreferencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_referencias_idreferencia_seq OWNED BY sec_referencias.idreferencia;


--
-- Name: sec_segconsultaexterna; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_segconsultaexterna (
    idseguimiento integer NOT NULL,
    idhistorialclinico integer,
    control text,
    ingreso text,
    altapaciente character(1) NOT NULL
);


ALTER TABLE sec_segconsultaexterna OWNER TO simagd;

--
-- Name: TABLE sec_segconsultaexterna; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_segconsultaexterna IS 'TABLA DE CONTROL DE ESTADO PACIENTE, CITAS, ALTAS O INGRESOS';


--
-- Name: COLUMN sec_segconsultaexterna.idseguimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_segconsultaexterna.idseguimiento IS 'Llave Primaria';


--
-- Name: COLUMN sec_segconsultaexterna.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_segconsultaexterna.idhistorialclinico IS 'IdHisotialClinico, Conecta con sec_historial_clinico';


--
-- Name: COLUMN sec_segconsultaexterna.control; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_segconsultaexterna.control IS 'Proximo control de cita medica [Fecha de proxima consulta]';


--
-- Name: COLUMN sec_segconsultaexterna.ingreso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_segconsultaexterna.ingreso IS 'Si se le dara ingreso se especifica a que servicio hospitalario';


--
-- Name: COLUMN sec_segconsultaexterna.altapaciente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_segconsultaexterna.altapaciente IS 'Alta del paciente de la especialidad en la que se encontraba en control';


--
-- Name: sec_segconsultaexterna_idseguimiento_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_segconsultaexterna_idseguimiento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_segconsultaexterna_idseguimiento_seq OWNER TO simagd;

--
-- Name: sec_segconsultaexterna_idseguimiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_segconsultaexterna_idseguimiento_seq OWNED BY sec_segconsultaexterna.idseguimiento;


--
-- Name: sec_signos_vitales_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_signos_vitales_id_seq
    START WITH 243
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_signos_vitales_id_seq OWNER TO simagd;

--
-- Name: sec_signos_vitales; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_signos_vitales (
    id integer DEFAULT nextval('sec_signos_vitales_id_seq'::regclass) NOT NULL,
    idhistorialclinico integer NOT NULL,
    pulso character varying(10) DEFAULT NULL::character varying,
    presionarterial character varying(10) DEFAULT NULL::character varying,
    respiracion character varying(6) DEFAULT NULL::character varying,
    peso smallint,
    talla double precision,
    temperatura smallint,
    observaciones text
);


ALTER TABLE sec_signos_vitales OWNER TO simagd;

--
-- Name: TABLE sec_signos_vitales; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_signos_vitales IS 'TABLA DE SIGNOS VITALES DE PACIENTE';


--
-- Name: COLUMN sec_signos_vitales.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.id IS 'Llave PK';


--
-- Name: COLUMN sec_signos_vitales.idhistorialclinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.idhistorialclinico IS 'FK IdHistorialClinico, relacionado con sec_historial_clinico';


--
-- Name: COLUMN sec_signos_vitales.pulso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.pulso IS 'Pulso del Paciente';


--
-- Name: COLUMN sec_signos_vitales.presionarterial; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.presionarterial IS 'Presion Arterial del Paciente';


--
-- Name: COLUMN sec_signos_vitales.respiracion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.respiracion IS 'Respiracion del Paciente';


--
-- Name: COLUMN sec_signos_vitales.peso; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.peso IS 'Peso del Paciente';


--
-- Name: COLUMN sec_signos_vitales.talla; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.talla IS 'Talla del Paciente';


--
-- Name: COLUMN sec_signos_vitales.temperatura; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.temperatura IS 'Temperatura del Paciente';


--
-- Name: COLUMN sec_signos_vitales.observaciones; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_signos_vitales.observaciones IS 'Observaciones adicionales al examen fisico';


--
-- Name: sec_solicitudestudios; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_solicitudestudios (
    id integer NOT NULL,
    id_historial_clinico integer,
    fecha_solicitud date,
    idusuarioreg integer,
    fechahorareg timestamp without time zone,
    id_atencion integer,
    impresiones integer DEFAULT 0,
    cama integer DEFAULT 0,
    id_establecimiento integer,
    id_establecimiento_externo integer,
    id_expediente integer,
    idtiposolicitud integer,
    estado integer NOT NULL
);


ALTER TABLE sec_solicitudestudios OWNER TO simagd;

--
-- Name: TABLE sec_solicitudestudios; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_solicitudestudios IS 'TABLA PARA GENERACION DE SOLICITUD DE ESTUDIOS ESPECIALES';


--
-- Name: COLUMN sec_solicitudestudios.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.id IS 'Llave primaria, Codigo de solicitud de estudio ';


--
-- Name: COLUMN sec_solicitudestudios.id_historial_clinico; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.id_historial_clinico IS 'IdHisotialClinico, Conecta con sec_historial_clinico';


--
-- Name: COLUMN sec_solicitudestudios.fecha_solicitud; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.fecha_solicitud IS 'Fecha que se hiso la solicitud';


--
-- Name: COLUMN sec_solicitudestudios.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.idusuarioreg IS 'IdUsuario que ingresa el registro';


--
-- Name: COLUMN sec_solicitudestudios.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.fechahorareg IS 'Fecha y hora que se ingresa el regitro';


--
-- Name: COLUMN sec_solicitudestudios.id_atencion; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.id_atencion IS 'IdServicio, conecta con mnt_servicio se determina que servicio de apoyo procesara la solicitud';


--
-- Name: COLUMN sec_solicitudestudios.impresiones; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.impresiones IS 'Si se necesita un impreso fisico de los resultados en casa sean estudio pre-operatorios';


--
-- Name: COLUMN sec_solicitudestudios.cama; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.cama IS 'Cama de servicio hospitalario en la que se genero la solicitud en dado caso el paciente se encuentre ingresado';


--
-- Name: COLUMN sec_solicitudestudios.id_establecimiento; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_solicitudestudios.id_establecimiento IS 'Establecimiento al que pertenece la solicitud';


--
-- Name: sec_solicitudestudios_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_solicitudestudios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_solicitudestudios_id_seq OWNER TO simagd;

--
-- Name: sec_solicitudestudios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_solicitudestudios_id_seq OWNED BY sec_solicitudestudios.id;


--
-- Name: sec_tipo_accidente; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_tipo_accidente (
    id integer NOT NULL,
    nombre character varying(25) NOT NULL,
    habilitado boolean DEFAULT true
);


ALTER TABLE sec_tipo_accidente OWNER TO simagd;

--
-- Name: TABLE sec_tipo_accidente; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_tipo_accidente IS 'Contiene los tipos de accidente que se les puede ocacionar a un paciente';


--
-- Name: COLUMN sec_tipo_accidente.id; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_tipo_accidente.id IS 'Llave primaria';


--
-- Name: COLUMN sec_tipo_accidente.nombre; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_tipo_accidente.nombre IS 'Nombre del accidente';


--
-- Name: COLUMN sec_tipo_accidente.habilitado; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_tipo_accidente.habilitado IS 'Estado del accidente';


--
-- Name: sec_tipo_accidente_id_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_tipo_accidente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_tipo_accidente_id_seq OWNER TO simagd;

--
-- Name: sec_tipo_accidente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_tipo_accidente_id_seq OWNED BY sec_tipo_accidente.id;


--
-- Name: sec_tiporeferencia; Type: TABLE; Schema: public; Owner: simagd; Tablespace: 
--

CREATE TABLE sec_tiporeferencia (
    idtiporeferencia integer NOT NULL,
    tiporeferencia character varying(100) DEFAULT NULL::character varying,
    idusuarioreg smallint,
    fechahorareg timestamp without time zone
);


ALTER TABLE sec_tiporeferencia OWNER TO simagd;

--
-- Name: TABLE sec_tiporeferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON TABLE sec_tiporeferencia IS 'Tipos de referencias clinicas';


--
-- Name: COLUMN sec_tiporeferencia.idtiporeferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_tiporeferencia.idtiporeferencia IS 'Llave Primaria';


--
-- Name: COLUMN sec_tiporeferencia.tiporeferencia; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_tiporeferencia.tiporeferencia IS 'Codigo de Referencia';


--
-- Name: COLUMN sec_tiporeferencia.idusuarioreg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_tiporeferencia.idusuarioreg IS 'IdUsuario que ingresa el registra';


--
-- Name: COLUMN sec_tiporeferencia.fechahorareg; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON COLUMN sec_tiporeferencia.fechahorareg IS 'Fecha y hora que se ingresa el registro';


--
-- Name: sec_tiporeferencia_idtiporeferencia_seq; Type: SEQUENCE; Schema: public; Owner: simagd
--

CREATE SEQUENCE sec_tiporeferencia_idtiporeferencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sec_tiporeferencia_idtiporeferencia_seq OWNER TO simagd;

--
-- Name: sec_tiporeferencia_idtiporeferencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simagd
--

ALTER SEQUENCE sec_tiporeferencia_idtiporeferencia_seq OWNED BY sec_tiporeferencia.idtiporeferencia;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia ALTER COLUMN id SET DEFAULT nextval('cit_citas_dia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_serviciodeapoyo ALTER COLUMN id SET DEFAULT nextval('cit_citas_serviciodeapoyo_idcitaservapoyo_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos ALTER COLUMN id SET DEFAULT nextval('cit_citasprocedimientos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion ALTER COLUMN id SET DEFAULT nextval('cit_distribucion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_estado_cita ALTER COLUMN id SET DEFAULT nextval('cit_estado_cita_idestado_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento ALTER COLUMN id SET DEFAULT nextval('cit_evento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_motivoagregados ALTER COLUMN id SET DEFAULT nextval('cit_motivoagregados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_programacion_exams ALTER COLUMN id SET DEFAULT nextval('cit_programacion_exams_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_referentes ALTER COLUMN id SET DEFAULT nextval('cit_referentes_idreferente_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_tipocita ALTER COLUMN id SET DEFAULT nextval('cit_tipocita_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_tipoevento ALTER COLUMN id SET DEFAULT nextval('cit_tipoevento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_area_atencion ALTER COLUMN id SET DEFAULT nextval('ctl_area_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_area_cotizante ALTER COLUMN id SET DEFAULT nextval('ctl_area_cotizante_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_area_geografica ALTER COLUMN id SET DEFAULT nextval('ctl_area_geografica_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_atencion ALTER COLUMN id SET DEFAULT nextval('ctl_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_campo ALTER COLUMN id SET DEFAULT nextval('ctl_campo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_canton ALTER COLUMN id SET DEFAULT nextval('ctl_canton_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_catalogo ALTER COLUMN id SET DEFAULT nextval('ctl_catalogo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_condicion_persona ALTER COLUMN id SET DEFAULT nextval('ctl_condicion_persona_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_creacion_expediente ALTER COLUMN id SET DEFAULT nextval('ctl_creacion_expediente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_departamento ALTER COLUMN id SET DEFAULT nextval('ctl_departamento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_documento_identidad ALTER COLUMN id SET DEFAULT nextval('ctl_documento_identidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_establecimiento ALTER COLUMN id SET DEFAULT nextval('ctl_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_estado_civil ALTER COLUMN id SET DEFAULT nextval('ctl_estado_civil_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_modalidad ALTER COLUMN id SET DEFAULT nextval('ctl_modalidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_municipio ALTER COLUMN id SET DEFAULT nextval('ctl_municipio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_nacionalidad ALTER COLUMN id SET DEFAULT nextval('ctl_nacionalidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_ocupacion ALTER COLUMN id SET DEFAULT nextval('ctl_ocupacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_pais ALTER COLUMN id SET DEFAULT nextval('ctl_pais_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_parentesco ALTER COLUMN id SET DEFAULT nextval('ctl_parentesco_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_programa ALTER COLUMN id SET DEFAULT nextval('ctl_programa_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_rango_edad ALTER COLUMN id SET DEFAULT nextval('ctl_rango_edad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_sexo ALTER COLUMN id SET DEFAULT nextval('ctl_sexo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_tabla ALTER COLUMN id SET DEFAULT nextval('ctl_tabla_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_tipo_atencion ALTER COLUMN id SET DEFAULT nextval('ctl_tipo_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_tipo_campo ALTER COLUMN id SET DEFAULT nextval('ctl_tipo_campo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_tipo_establecimiento ALTER COLUMN id SET DEFAULT nextval('ctl_tipo_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_tipo_objeto ALTER COLUMN id SET DEFAULT nextval('ctl_tipo_objeto_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_validacion_campo ALTER COLUMN id SET DEFAULT nextval('ctl_validacion_campo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_ajustes ALTER COLUMN id SET DEFAULT nextval('farm_ajustes_idajuste_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_bitacoraentregamedicamento ALTER COLUMN id SET DEFAULT nextval('farm_bitacoraentregamedicamento_identrega_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_bitacoramedicinaexistenciaxarea ALTER COLUMN id SET DEFAULT nextval('farm_bitacoramedicinaexistenciaxarea_idexistencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_catalogoproductos ALTER COLUMN id SET DEFAULT nextval('farm_catalogoproductos_idmedicina_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_catalogoproductosxestablecimiento ALTER COLUMN id SET DEFAULT nextval('farm_catalogoproductosxestablecimi_idcatproxestablecimiento_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_cierre ALTER COLUMN id SET DEFAULT nextval('farm_cierre_idcierre_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_divisores ALTER COLUMN id SET DEFAULT nextval('farm_divisores_iddivisor_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_entregamedicamento ALTER COLUMN id SET DEFAULT nextval('farm_entregamedicamento_identrega_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_estados ALTER COLUMN id SET DEFAULT nextval('farm_estados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_lotes ALTER COLUMN id SET DEFAULT nextval('farm_lotes_idlote_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinadespachada ALTER COLUMN id SET DEFAULT nextval('farm_medicinadespachada_idmedicinadespachada_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinaexistenciaxarea ALTER COLUMN id SET DEFAULT nextval('farm_medicinaexistenciaxarea_idexistencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinarecetada ALTER COLUMN id SET DEFAULT nextval('farm_medicinarecetada_idmedicinarecetada_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinavencida ALTER COLUMN id SET DEFAULT nextval('farm_medicinavencida_identrega_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_periododesabastecido ALTER COLUMN id SET DEFAULT nextval('farm_periododesabastecido_idperiodo_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_recetas ALTER COLUMN id SET DEFAULT nextval('farm_recetas_idreceta_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_transferencias ALTER COLUMN id SET DEFAULT nextval('farm_transferencias_idtransferencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_transferenciashospitales ALTER COLUMN id SET DEFAULT nextval('farm_transferenciashospitales_idtransferencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_unidadmedidas ALTER COLUMN id SET DEFAULT nextval('farm_unidadmedidas_idunidadmedida_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_usuarios ALTER COLUMN id SET DEFAULT nextval('farm_usuarios_idpersonal_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item ALTER COLUMN id SET DEFAULT nextval('frm_form_item_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_catalogo ALTER COLUMN id SET DEFAULT nextval('frm_form_item_catalogo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_pool ALTER COLUMN id SET DEFAULT nextval('frm_form_item_pool_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_seccion_item ALTER COLUMN id SET DEFAULT nextval('frm_form_seccion_item_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_formulario ALTER COLUMN id SET DEFAULT nextval('frm_formulario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_formulario_seccion_pool ALTER COLUMN id SET DEFAULT nextval('frm_formulario_seccion_pool_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_formulario ALTER COLUMN id SET DEFAULT nextval('frm_grupo_formulario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_insercion ALTER COLUMN id SET DEFAULT nextval('frm_grupo_insercion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_insercion_dependencia ALTER COLUMN id SET DEFAULT nextval('frm_insercion_dependencia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_insercion_parametro ALTER COLUMN id SET DEFAULT nextval('frm_insercion_parametro_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_item_catalogo_reg ALTER COLUMN id SET DEFAULT nextval('frm_item_catalogo_reg_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_seccion ALTER COLUMN id SET DEFAULT nextval('frm_seccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_seccion_pool ALTER COLUMN id SET DEFAULT nextval('frm_seccion_pool_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_validacion_campo_form_item ALTER COLUMN id SET DEFAULT nextval('frm_validacion_campo_form_item_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_bloqueo_agenda ALTER COLUMN id SET DEFAULT nextval('img_bloqueo_agenda_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita ALTER COLUMN id SET DEFAULT nextval('img_cita_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_campo_autocomplementar ALTER COLUMN id SET DEFAULT nextval('img_ctl_campo_autocomplementar_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_configuracion_agenda ALTER COLUMN id SET DEFAULT nextval('img_ctl_configuracion_agenda_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_estado_cita ALTER COLUMN id SET DEFAULT nextval('img_ctl_estado_cita_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_estado_diagnostico ALTER COLUMN id SET DEFAULT nextval('img_ctl_estado_diagnostico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_estado_lectura ALTER COLUMN id SET DEFAULT nextval('img_ctl_estado_lectura_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_estado_procedimiento_realizado ALTER COLUMN id SET DEFAULT nextval('img_ctl_estado_procedimiento_realizado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_estado_solicitud ALTER COLUMN id SET DEFAULT nextval('img_ctl_estado_solicitud_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_forma_contacto ALTER COLUMN id SET DEFAULT nextval('img_ctl_forma_contacto_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_grupo_material ALTER COLUMN id SET DEFAULT nextval('img_ctl_grupo_material_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material ALTER COLUMN id SET DEFAULT nextval('img_ctl_material_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material_establecimiento ALTER COLUMN id SET DEFAULT nextval('img_ctl_material_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_pacs_establecimiento ALTER COLUMN id SET DEFAULT nextval('img_ctl_pacs_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico ALTER COLUMN id SET DEFAULT nextval('img_ctl_patron_diagnostico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_preparacion_estudio ALTER COLUMN id SET DEFAULT nextval('img_ctl_preparacion_estudio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_prioridad_atencion ALTER COLUMN id SET DEFAULT nextval('img_ctl_prioridad_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion ALTER COLUMN id SET DEFAULT nextval('img_ctl_proyeccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion_establecimiento ALTER COLUMN id SET DEFAULT nextval('img_ctl_proyeccion_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_subgrupo_material ALTER COLUMN id SET DEFAULT nextval('img_ctl_subgrupo_material_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_tipo_nota_diagnostico ALTER COLUMN id SET DEFAULT nextval('img_ctl_tipo_nota_diagnostico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_tipo_resultado ALTER COLUMN id SET DEFAULT nextval('img_ctl_tipo_resultado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_dato_autocomplemento ALTER COLUMN id SET DEFAULT nextval('img_dato_autocomplemento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico ALTER COLUMN id SET DEFAULT nextval('img_diagnostico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_estudio_paciente ALTER COLUMN id SET DEFAULT nextval('img_estudio_paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_exclusion_bloqueo ALTER COLUMN id SET DEFAULT nextval('img_exclusion_bloqueo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura ALTER COLUMN id SET DEFAULT nextval('img_lectura_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura_estudio ALTER COLUMN id SET DEFAULT nextval('img_lectura_estudio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_material_utilizado ALTER COLUMN id SET DEFAULT nextval('img_material_utilizado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_nota_diagnostico ALTER COLUMN id SET DEFAULT nextval('img_nota_diagnostico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_lectura ALTER COLUMN id SET DEFAULT nextval('img_pendiente_lectura_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion ALTER COLUMN id SET DEFAULT nextval('img_pendiente_realizacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_transcripcion ALTER COLUMN id SET DEFAULT nextval('img_pendiente_transcripcion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_validacion ALTER COLUMN id SET DEFAULT nextval('img_pendiente_validacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado ALTER COLUMN id SET DEFAULT nextval('img_procedimiento_realizado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_diagnostico ALTER COLUMN id SET DEFAULT nextval('img_solicitud_diagnostico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio ALTER COLUMN id SET DEFAULT nextval('img_solicitud_estudio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario ALTER COLUMN id SET DEFAULT nextval('img_solicitud_estudio_complementario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario_proyeccion ALTER COLUMN id SET DEFAULT nextval('img_solicitud_estudio_complementario_proyeccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_proyeccion ALTER COLUMN id SET DEFAULT nextval('img_solicitud_estudio_proyeccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_departamentos ALTER COLUMN id SET DEFAULT nextval('its_departamentos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_drg_old ALTER COLUMN id SET DEFAULT nextval('its_drg_old_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_examen_paciente ALTER COLUMN id SET DEFAULT nextval('its_examen_paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_its_old ALTER COLUMN id SET DEFAULT nextval('its_its_old_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_lugar_trabajo ALTER COLUMN id SET DEFAULT nextval('its_lugar_trabajo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_metodo_atc_usado ALTER COLUMN id SET DEFAULT nextval('its_metodo_atc_usado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_anormalidad ALTER COLUMN id SET DEFAULT nextval('its_mnt_anormalidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_flujo_aspecto ALTER COLUMN id SET DEFAULT nextval('its_mnt_flujo_aspecto_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_flujo_cantidad ALTER COLUMN id SET DEFAULT nextval('its_mnt_flujo_cantidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_flujo_color ALTER COLUMN id SET DEFAULT nextval('its_mnt_flujo_color_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_flujo_olor ALTER COLUMN id SET DEFAULT nextval('its_mnt_flujo_olor_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_its ALTER COLUMN id SET DEFAULT nextval('its_mnt_its_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_ocupacion ALTER COLUMN id SET DEFAULT nextval('its_mnt_ocupacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_organo_anormalidad ALTER COLUMN id SET DEFAULT nextval('its_mnt_organo_anormalidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_organos ALTER COLUMN id SET DEFAULT nextval('its_mnt_organos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_tipos_consumo_drg ALTER COLUMN id SET DEFAULT nextval('its_mnt_tipos_consumo_drg_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_tipos_hsc ALTER COLUMN id SET DEFAULT nextval('its_mnt_tipos_hsc_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_tipos_metodo ALTER COLUMN id SET DEFAULT nextval('its_mnt_tipos_metodo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_tipos_pareja ALTER COLUMN id SET DEFAULT nextval('its_mnt_tipos_pareja_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_tipos_relaciones ALTER COLUMN id SET DEFAULT nextval('its_mnt_tipos_relaciones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_mnt_vih_consejeria ALTER COLUMN id SET DEFAULT nextval('its_mnt_vih_consejeria_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_paises ALTER COLUMN id SET DEFAULT nextval('its_paises_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_primeravez ALTER COLUMN id SET DEFAULT nextval('its_primeravez_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_relaciones ALTER COLUMN id SET DEFAULT nextval('its_relaciones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_subsecuente ALTER COLUMN id SET DEFAULT nextval('its_subsecuente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_tipos_its ALTER COLUMN id SET DEFAULT nextval('its_tipos_its_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY its_tipos_trabajo ALTER COLUMN id SET DEFAULT nextval('its_tipos_trabajo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticos ALTER COLUMN id SET DEFAULT nextval('lab_antibioticos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticosportarjeta ALTER COLUMN id SET DEFAULT nextval('lab_antibioticosportarjeta_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_areasxestablecimiento ALTER COLUMN id SET DEFAULT nextval('lab_areasxestablecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_bacterias ALTER COLUMN id SET DEFAULT nextval('lab_bacterias_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_cantidadestincion ALTER COLUMN id SET DEFAULT nextval('lab_cantidadestincion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_codigosresultados ALTER COLUMN id SET DEFAULT nextval('lab_codigosresultados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_codigosxexamen ALTER COLUMN id SET DEFAULT nextval('lab_codigosxexamen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado ALTER COLUMN id SET DEFAULT nextval('lab_datosfijosresultado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado ALTER COLUMN id SET DEFAULT nextval('lab_detalleresultado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementos ALTER COLUMN id SET DEFAULT nextval('lab_elementos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementostincion ALTER COLUMN id SET DEFAULT nextval('lab_elementostincion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_estandarxgrupo ALTER COLUMN id SET DEFAULT nextval('lab_estandarxgrupo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_examenesxestablecimiento ALTER COLUMN id SET DEFAULT nextval('lab_examenesxestablecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_observaciones ALTER COLUMN id SET DEFAULT nextval('lab_observaciones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_plantilla ALTER COLUMN id SET DEFAULT nextval('lab_plantilla_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen ALTER COLUMN id SET DEFAULT nextval('lab_procedimientosporexamen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_recepcionmuestra ALTER COLUMN id SET DEFAULT nextval('lab_recepcionmuestra_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados ALTER COLUMN id SET DEFAULT nextval('lab_resultados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultadosportarjeta ALTER COLUMN id SET DEFAULT nextval('lab_resultadosportarjeta_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_subelementos ALTER COLUMN id SET DEFAULT nextval('lab_subelementos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tarjetasvitek ALTER COLUMN id SET DEFAULT nextval('lab_tarjetasvitek_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestra ALTER COLUMN id SET DEFAULT nextval('lab_tipomuestra_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestraporexamen ALTER COLUMN id SET DEFAULT nextval('lab_tipomuestraporexamen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tiposolicitud ALTER COLUMN id SET DEFAULT nextval('lab_tiposolicitud_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_ambiente_independiente ALTER COLUMN id SET DEFAULT nextval('mnt_ambiente_independiente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_examen_establecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_area_examen_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_mod_estab ALTER COLUMN id SET DEFAULT nextval('mnt_area_mod_estab_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_areafarmacia ALTER COLUMN id SET DEFAULT nextval('mnt_areafarmacia_idarea_seq'::regclass);


--
-- Name: idrelacion; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_areafarmaciaxestablecimiento ALTER COLUMN idrelacion SET DEFAULT nextval('mnt_areafarmaciaxestablecimiento_idrelacion_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_areamedicina ALTER COLUMN id SET DEFAULT nextval('mnt_areamedicina_idareamedicina_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_aten_area_mod_estab ALTER COLUMN id SET DEFAULT nextval('mnt_aten_area_mod_estab_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente ALTER COLUMN id SET DEFAULT nextval('mnt_auditoria_paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_cargoempleados ALTER COLUMN id SET DEFAULT nextval('mnt_cargo_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_cie10 ALTER COLUMN id SET DEFAULT nextval('mnt_cie10_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_ciq ALTER COLUMN id SET DEFAULT nextval('mnt_ciq_id_seq'::regclass);


--
-- Name: idcondicion; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_condicionegreso ALTER COLUMN idcondicion SET DEFAULT nextval('mnt_condicionegreso_idcondicion_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_conexion ALTER COLUMN id SET DEFAULT nextval('mnt_conexion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_consultorio ALTER COLUMN id SET DEFAULT nextval('mnt_consultorio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado ALTER COLUMN id SET DEFAULT nextval('mnt_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado_especialidad ALTER COLUMN id SET DEFAULT nextval('mnt_empleado_especialidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado_especialidad_estab ALTER COLUMN id SET DEFAULT nextval('mnt_empleado_especialidad_estab_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_expediente ALTER COLUMN id SET DEFAULT nextval('mnt_expediente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_expediente_establecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_expediente_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_farmacia ALTER COLUMN id SET DEFAULT nextval('mnt_farmacia_idfarmacia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_farmaciaxestablecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_farmaciaxestablecimiento_idfarxestablecimiento_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_formularios ALTER COLUMN id SET DEFAULT nextval('mnt_formularios_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_formulariosxestablecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_formulariosxestablecimiento_id_seq'::regclass);


--
-- Name: idfuentefinanciamiento; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_fuentefinanciamiento ALTER COLUMN idfuentefinanciamiento SET DEFAULT nextval('mnt_fuentefinanciamiento_idfuentefinanciamiento_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_grupoterapeutico ALTER COLUMN id SET DEFAULT nextval('"mnt_grupoterapeutico_IdTerapeutico_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_indicacionesporexamen ALTER COLUMN id SET DEFAULT nextval('mnt_indicacionesporexamen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_modalidad_establecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_modalidad_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_origenmuestra ALTER COLUMN id SET DEFAULT nextval('mnt_origenmuestra_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente ALTER COLUMN id SET DEFAULT nextval('mnt_paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente_programa_estab ALTER COLUMN id SET DEFAULT nextval('mnt_paciente_programa_estab_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_procedimiento_establecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_procedimiento_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_programa_establecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_programa_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_rangohora ALTER COLUMN id SET DEFAULT nextval('mnt_rangohora_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_servicio_externo ALTER COLUMN id SET DEFAULT nextval('mnt_servicio_externo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_servicio_externo_establecimiento ALTER COLUMN id SET DEFAULT nextval('mnt_servicio_externo_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_tipo_empleado ALTER COLUMN id SET DEFAULT nextval('mnt_tipo_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_tipo_procedimiento ALTER COLUMN id SET DEFAULT nextval('mnt_tipo_procedimiento_id_seq'::regclass);


--
-- Name: idtipodiagnostico; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_tiposdiagnosticos ALTER COLUMN idtipodiagnostico SET DEFAULT nextval('mnt_tiposdiagnosticos_idtipodiagnostico_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_usuarios ALTER COLUMN id SET DEFAULT nextval('mnt_usuarios_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_area ALTER COLUMN id SET DEFAULT nextval('rx_area_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_causa_rechazo ALTER COLUMN id SET DEFAULT nextval('rx_causa_rechazo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_estado ALTER COLUMN id SET DEFAULT nextval('rx_estado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_examen ALTER COLUMN id SET DEFAULT nextval('rx_examen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_imagen ALTER COLUMN id SET DEFAULT nextval('rx_imagen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_insertado ALTER COLUMN id SET DEFAULT nextval('rx_insertado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_radiografia ALTER COLUMN id SET DEFAULT nextval('rx_radiografia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_rechazada ALTER COLUMN id SET DEFAULT nextval('rx_rechazada_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_tamanio_pelicula ALTER COLUMN id SET DEFAULT nextval('rx_tamanio_pelicula_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_antecedentes ALTER COLUMN id SET DEFAULT nextval('sec_antecedentes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_circunstancia_ingreso ALTER COLUMN id SET DEFAULT nextval('sec_circunstancia_ingreso_id_seq'::regclass);


--
-- Name: iddetalle; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallediagnosticos ALTER COLUMN iddetalle SET DEFAULT nextval('sec_detallediagnosticos_iddetalle_seq'::regclass);


--
-- Name: idprocedimientos; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detalleprocedimientos ALTER COLUMN idprocedimientos SET DEFAULT nextval('sec_detalleprocedimientos_idprocedimientos_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios ALTER COLUMN id SET DEFAULT nextval('sec_detallesolicitudestudios_id_seq'::regclass);


--
-- Name: iddiagnosticosproc; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_diagnosticos_procedimientos ALTER COLUMN iddiagnosticosproc SET DEFAULT nextval('sec_diagnosticos_procedimientos_iddiagnosticosproc_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_diagnosticospaciente ALTER COLUMN id SET DEFAULT nextval('sec_diagnosticospaciente_id_seq'::regclass);


--
-- Name: idegreso; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_egresos ALTER COLUMN idegreso SET DEFAULT nextval('sec_egresos_idegreso_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_emergencia ALTER COLUMN id SET DEFAULT nextval('sec_emergencia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_estado_paciente ALTER COLUMN id SET DEFAULT nextval('sec_estado_paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_historial_clinico ALTER COLUMN id SET DEFAULT nextval('sec_historial_clinico_id_seq'::regclass);


--
-- Name: idhojaindicacionesconsultaexterna; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_hojaindicacionesconsultaexterna ALTER COLUMN idhojaindicacionesconsultaexterna SET DEFAULT nextval('sec_hojaindicacionesconsultae_idhojaindicacionesconsultaext_seq'::regclass);


--
-- Name: incapacidadmedica; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_incapacidadmedica ALTER COLUMN incapacidadmedica SET DEFAULT nextval('sec_incapacidadmedica_incapacidadmedica_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso ALTER COLUMN id SET DEFAULT nextval('sec_ingreso_id_seq'::regclass);


--
-- Name: idingreso; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingresos_historial ALTER COLUMN idingreso SET DEFAULT nextval('sec_ingresos_historial_idingreso_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_procedencia_ingreso ALTER COLUMN id SET DEFAULT nextval('sec_procedencia_ingreso_id_seq'::regclass);


--
-- Name: idreferencia; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_referencias ALTER COLUMN idreferencia SET DEFAULT nextval('sec_referencias_idreferencia_seq'::regclass);


--
-- Name: idseguimiento; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_segconsultaexterna ALTER COLUMN idseguimiento SET DEFAULT nextval('sec_segconsultaexterna_idseguimiento_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios ALTER COLUMN id SET DEFAULT nextval('sec_solicitudestudios_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_tipo_accidente ALTER COLUMN id SET DEFAULT nextval('sec_tipo_accidente_id_seq'::regclass);


--
-- Name: idtiporeferencia; Type: DEFAULT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_tiporeferencia ALTER COLUMN idtiporeferencia SET DEFAULT nextval('sec_tiporeferencia_idtiporeferencia_seq'::regclass);


--
-- Name: Pk_recepcionmuestra; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_recepcionmuestra
    ADD CONSTRAINT "Pk_recepcionmuestra" PRIMARY KEY (id);


--
-- Name: fos_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY fos_user_group
    ADD CONSTRAINT fos_user_group_pkey PRIMARY KEY (id);


--
-- Name: fos_user_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fos_user_user_group_pkey PRIMARY KEY (user_id, group_id);


--
-- Name: fos_user_user_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fos_user_user_pkey PRIMARY KEY (id);


--
-- Name: idx_clasificacion_form_unica; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_grupo_formulario
    ADD CONSTRAINT idx_clasificacion_form_unica UNIQUE (id_formulario, id_atencion, id_sexo, id_rango_edad, id_condicion_persona);


--
-- Name: CONSTRAINT idx_clasificacion_form_unica ON frm_grupo_formulario; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON CONSTRAINT idx_clasificacion_form_unica ON frm_grupo_formulario IS 'Unique Constraint aplicado a los campos id_formulario, id_atencion, id_sexo, id_rango_edad e id_condicion_persona.';


--
-- Name: idx_codigo_estado_cita; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_cita
    ADD CONSTRAINT idx_codigo_estado_cita UNIQUE (codigo);


--
-- Name: idx_codigo_estado_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_diagnostico
    ADD CONSTRAINT idx_codigo_estado_diagnostico UNIQUE (codigo);


--
-- Name: idx_codigo_estado_lectura; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_lectura
    ADD CONSTRAINT idx_codigo_estado_lectura UNIQUE (codigo);


--
-- Name: idx_codigo_estado_procedimiento_realizado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_procedimiento_realizado
    ADD CONSTRAINT idx_codigo_estado_procedimiento_realizado UNIQUE (codigo);


--
-- Name: idx_codigo_estado_solicitud; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_solicitud
    ADD CONSTRAINT idx_codigo_estado_solicitud UNIQUE (codigo);


--
-- Name: idx_codigo_grupo_material; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_grupo_material
    ADD CONSTRAINT idx_codigo_grupo_material UNIQUE (codigo);


--
-- Name: idx_codigo_material; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_material
    ADD CONSTRAINT idx_codigo_material UNIQUE (codigo);


--
-- Name: idx_codigo_motor_bd; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_motor_bd
    ADD CONSTRAINT idx_codigo_motor_bd UNIQUE (codigo);


--
-- Name: idx_codigo_patron_diagnostico_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT idx_codigo_patron_diagnostico_establecimiento UNIQUE (codigo, id_establecimiento);


--
-- Name: idx_codigo_preparacion_estudio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_preparacion_estudio
    ADD CONSTRAINT idx_codigo_preparacion_estudio UNIQUE (codigo);


--
-- Name: idx_codigo_prioridad_atencion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_prioridad_atencion
    ADD CONSTRAINT idx_codigo_prioridad_atencion UNIQUE (codigo);


--
-- Name: idx_codigo_proyeccion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_proyeccion
    ADD CONSTRAINT idx_codigo_proyeccion UNIQUE (codigo);


--
-- Name: idx_codigo_subgrupo_material; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_subgrupo_material
    ADD CONSTRAINT idx_codigo_subgrupo_material UNIQUE (codigo);


--
-- Name: idx_codigo_tipo_nota_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_tipo_nota_diagnostico
    ADD CONSTRAINT idx_codigo_tipo_nota_diagnostico UNIQUE (codigo);


--
-- Name: idx_codigo_tipo_resultado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_tipo_resultado
    ADD CONSTRAINT idx_codigo_tipo_resultado UNIQUE (codigo);


--
-- Name: idx_formulario_seccion_pool; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_formulario_seccion_pool
    ADD CONSTRAINT idx_formulario_seccion_pool UNIQUE (id_formulario, id_seccion_pool);


--
-- Name: CONSTRAINT idx_formulario_seccion_pool ON frm_formulario_seccion_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON CONSTRAINT idx_formulario_seccion_pool ON frm_formulario_seccion_pool IS 'Unique Constraint aplicado a los campos id_formulario e id_seccion_pool.';


--
-- Name: idx_id_id_paciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT idx_id_id_paciente UNIQUE (id, id_paciente);


--
-- Name: idx_id_mod_estab_id_area; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_area_mod_estab
    ADD CONSTRAINT idx_id_mod_estab_id_area UNIQUE (id_area_atencion, id_modalidad_estab, id_servicio_externo_estab, id_establecimiento);


--
-- Name: idx_id_mod_id_estab; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_modalidad_establecimiento
    ADD CONSTRAINT idx_id_mod_id_estab UNIQUE (id_establecimiento, id_modalidad);


--
-- Name: idx_idcie10; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_cie10
    ADD CONSTRAINT idx_idcie10 UNIQUE (codigo);


--
-- Name: idx_lectura_estudio_paciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_lectura_estudio
    ADD CONSTRAINT idx_lectura_estudio_paciente UNIQUE (id_estudio, id_lectura);


--
-- Name: idx_material_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_material_establecimiento
    ADD CONSTRAINT idx_material_establecimiento UNIQUE (id_material, id_establecimiento);


--
-- Name: idx_material_procedimiento_realizado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_material_utilizado
    ADD CONSTRAINT idx_material_procedimiento_realizado UNIQUE (id_material, id_procedimiento_realizado);


--
-- Name: idx_mnt_ciq; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_ciq
    ADD CONSTRAINT idx_mnt_ciq UNIQUE (codigo);


--
-- Name: idx_nombre_conexion_pacs; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_pacs_establecimiento
    ADD CONSTRAINT idx_nombre_conexion_pacs UNIQUE (nombre_conexion);


--
-- Name: idx_numero_emergencia_anio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_emergencia
    ADD CONSTRAINT idx_numero_emergencia_anio UNIQUE (numero_emergencia, anio_emergencia);


--
-- Name: idx_numero_expediente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT idx_numero_expediente UNIQUE (numero);


--
-- Name: idx_numero_expediente_ficticio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_expediente_ficticio
    ADD CONSTRAINT idx_numero_expediente_ficticio UNIQUE (id_establecimiento, numero);


--
-- Name: idx_proyeccion_area_examen_estab; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_proyeccion_establecimiento
    ADD CONSTRAINT idx_proyeccion_area_examen_estab UNIQUE (id_area_examen_estab, id_proyeccion);


--
-- Name: idx_radiologo_bloqueo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_exclusion_bloqueo
    ADD CONSTRAINT idx_radiologo_bloqueo UNIQUE (id_radiologo_excluido, id_bloqueo_agenda);


--
-- Name: idx_seccion_pool_form_item; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_form_item_pool
    ADD CONSTRAINT idx_seccion_pool_form_item UNIQUE (id_seccion_pool, id_form_item);


--
-- Name: CONSTRAINT idx_seccion_pool_form_item ON frm_form_item_pool; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON CONSTRAINT idx_seccion_pool_form_item ON frm_form_item_pool IS 'Unique Constraint aplicado a los campos id_seccion_pool e id_form_item.';


--
-- Name: idx_solicitud_estudio_complementario_proyeccion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_solicitud_estudio_complementario_proyeccion
    ADD CONSTRAINT idx_solicitud_estudio_complementario_proyeccion UNIQUE (id_solicitud_estudio_complementario, id_proyeccion_solicitada);


--
-- Name: idx_solicitud_estudio_proyeccion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_solicitud_estudio_proyeccion
    ADD CONSTRAINT idx_solicitud_estudio_proyeccion UNIQUE (id_solicitud_estudio, id_proyeccion_solicitada);


--
-- Name: its_departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_departamentos
    ADD CONSTRAINT its_departamentos_pkey PRIMARY KEY (id);


--
-- Name: its_drg_old_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_drg_old
    ADD CONSTRAINT its_drg_old_pkey PRIMARY KEY (id);


--
-- Name: its_examen_paciente_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_examen_paciente
    ADD CONSTRAINT its_examen_paciente_pkey PRIMARY KEY (id);


--
-- Name: its_its_old_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_its_old
    ADD CONSTRAINT its_its_old_pkey PRIMARY KEY (id);


--
-- Name: its_lugar_trabajo_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_lugar_trabajo
    ADD CONSTRAINT its_lugar_trabajo_pkey PRIMARY KEY (id);


--
-- Name: its_metodo_atc_usado_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_metodo_atc_usado
    ADD CONSTRAINT its_metodo_atc_usado_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_anormalidad_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_anormalidad
    ADD CONSTRAINT its_mnt_anormalidad_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_flujo_aspecto_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_flujo_aspecto
    ADD CONSTRAINT its_mnt_flujo_aspecto_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_flujo_cantidad_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_flujo_cantidad
    ADD CONSTRAINT its_mnt_flujo_cantidad_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_flujo_color_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_flujo_color
    ADD CONSTRAINT its_mnt_flujo_color_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_flujo_olor_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_flujo_olor
    ADD CONSTRAINT its_mnt_flujo_olor_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_its_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_its
    ADD CONSTRAINT its_mnt_its_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_ocupacion_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_ocupacion
    ADD CONSTRAINT its_mnt_ocupacion_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_organo_anormalidad_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_organo_anormalidad
    ADD CONSTRAINT its_mnt_organo_anormalidad_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_organos_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_organos
    ADD CONSTRAINT its_mnt_organos_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_tipos_consumo_drg_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_tipos_consumo_drg
    ADD CONSTRAINT its_mnt_tipos_consumo_drg_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_tipos_hsc_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_tipos_hsc
    ADD CONSTRAINT its_mnt_tipos_hsc_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_tipos_metodo_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_tipos_metodo
    ADD CONSTRAINT its_mnt_tipos_metodo_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_tipos_pareja_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_tipos_pareja
    ADD CONSTRAINT its_mnt_tipos_pareja_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_tipos_relaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_tipos_relaciones
    ADD CONSTRAINT its_mnt_tipos_relaciones_pkey PRIMARY KEY (id);


--
-- Name: its_mnt_vih_consejeria_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_mnt_vih_consejeria
    ADD CONSTRAINT its_mnt_vih_consejeria_pkey PRIMARY KEY (id);


--
-- Name: its_paises_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_paises
    ADD CONSTRAINT its_paises_pkey PRIMARY KEY (id);


--
-- Name: its_primeravez_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_primeravez
    ADD CONSTRAINT its_primeravez_pkey PRIMARY KEY (id);


--
-- Name: its_relaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_relaciones
    ADD CONSTRAINT its_relaciones_pkey PRIMARY KEY (id);


--
-- Name: its_subsecuente_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_subsecuente
    ADD CONSTRAINT its_subsecuente_pkey PRIMARY KEY (id);


--
-- Name: its_tipos_its_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_tipos_its
    ADD CONSTRAINT its_tipos_its_pkey PRIMARY KEY (id);


--
-- Name: its_tipos_trabajo_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY its_tipos_trabajo
    ADD CONSTRAINT its_tipos_trabajo_pkey PRIMARY KEY (id);


--
-- Name: lab_codigosxexamen_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_codigosxexamen
    ADD CONSTRAINT lab_codigosxexamen_pkey PRIMARY KEY (id);


--
-- Name: lab_dato_fijo_resultado_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT lab_dato_fijo_resultado_pkey PRIMARY KEY (id);


--
-- Name: mnt_area_examen_establecimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_area_examen_establecimiento
    ADD CONSTRAINT mnt_area_examen_establecimiento_pkey PRIMARY KEY (id);


--
-- Name: mnt_farmacia_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_farmacia
    ADD CONSTRAINT mnt_farmacia_pkey PRIMARY KEY (id);


--
-- Name: mnt_grupoterapeutico_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_grupoterapeutico
    ADD CONSTRAINT mnt_grupoterapeutico_pkey PRIMARY KEY (id);


--
-- Name: mnt_indicacionesporexamen_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_indicacionesporexamen
    ADD CONSTRAINT mnt_indicacionesporexamen_pkey PRIMARY KEY (id);


--
-- Name: mnt_procedimiento_establecimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_procedimiento_establecimiento
    ADD CONSTRAINT mnt_procedimiento_establecimiento_pkey PRIMARY KEY (id);


--
-- Name: mnt_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_usuarios
    ADD CONSTRAINT mnt_usuarios_pkey PRIMARY KEY (id);


--
-- Name: pk_ajustes_idajuste; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_ajustes
    ADD CONSTRAINT pk_ajustes_idajuste PRIMARY KEY (id);


--
-- Name: pk_antibioticoportarjeta; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_antibioticosportarjeta
    ADD CONSTRAINT pk_antibioticoportarjeta PRIMARY KEY (id);


--
-- Name: pk_area_atencion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_area_atencion
    ADD CONSTRAINT pk_area_atencion PRIMARY KEY (id);


--
-- Name: pk_areaxestablecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_areasxestablecimiento
    ADD CONSTRAINT pk_areaxestablecimiento PRIMARY KEY (id);


--
-- Name: pk_bacteria; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_bacterias
    ADD CONSTRAINT pk_bacteria PRIMARY KEY (id);


--
-- Name: pk_bitacoramedicinaexistenciaxarea_idexistencia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_bitacoramedicinaexistenciaxarea
    ADD CONSTRAINT pk_bitacoramedicinaexistenciaxarea_idexistencia PRIMARY KEY (id);


--
-- Name: pk_campo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_campo
    ADD CONSTRAINT pk_campo PRIMARY KEY (id);


--
-- Name: pk_cantidad_tincion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_cantidadestincion
    ADD CONSTRAINT pk_cantidad_tincion PRIMARY KEY (id);


--
-- Name: pk_catalogo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_catalogo
    ADD CONSTRAINT pk_catalogo PRIMARY KEY (id);


--
-- Name: pk_catproxestablecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_catalogoproductosxestablecimiento
    ADD CONSTRAINT pk_catproxestablecimiento PRIMARY KEY (id);


--
-- Name: pk_cit_citasprocedimientos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT pk_cit_citasprocedimientos PRIMARY KEY (id);


--
-- Name: pk_cit_citasxdia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT pk_cit_citasxdia PRIMARY KEY (id);


--
-- Name: pk_cit_citasxserviciodeapoyo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_citas_serviciodeapoyo
    ADD CONSTRAINT pk_cit_citasxserviciodeapoyo PRIMARY KEY (id);


--
-- Name: pk_cit_distribucion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT pk_cit_distribucion PRIMARY KEY (id);


--
-- Name: pk_cit_estado_cita; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_estado_cita
    ADD CONSTRAINT pk_cit_estado_cita PRIMARY KEY (id);


--
-- Name: pk_cit_eventos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT pk_cit_eventos PRIMARY KEY (id);


--
-- Name: pk_cit_motivoagregados; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_motivoagregados
    ADD CONSTRAINT pk_cit_motivoagregados PRIMARY KEY (id);


--
-- Name: pk_cit_programacionxexams; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_programacion_exams
    ADD CONSTRAINT pk_cit_programacionxexams PRIMARY KEY (id);


--
-- Name: pk_cit_referentes; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_referentes
    ADD CONSTRAINT pk_cit_referentes PRIMARY KEY (id);


--
-- Name: pk_cit_tipocita; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_tipocita
    ADD CONSTRAINT pk_cit_tipocita PRIMARY KEY (id);


--
-- Name: pk_cit_tipoevento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY cit_tipoevento
    ADD CONSTRAINT pk_cit_tipoevento PRIMARY KEY (id);


--
-- Name: pk_codigo_resultado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_codigosresultados
    ADD CONSTRAINT pk_codigo_resultado PRIMARY KEY (id);


--
-- Name: pk_condicion_persona; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_condicion_persona
    ADD CONSTRAINT pk_condicion_persona PRIMARY KEY (id);


--
-- Name: pk_ctl_area_cotizante; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_area_cotizante
    ADD CONSTRAINT pk_ctl_area_cotizante PRIMARY KEY (id);


--
-- Name: pk_ctl_area_geografica; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_area_geografica
    ADD CONSTRAINT pk_ctl_area_geografica PRIMARY KEY (id);


--
-- Name: pk_ctl_area_servicio_apoyo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_area_servicio_diagnostico
    ADD CONSTRAINT pk_ctl_area_servicio_apoyo PRIMARY KEY (id);


--
-- Name: pk_ctl_canton; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_canton
    ADD CONSTRAINT pk_ctl_canton PRIMARY KEY (id);


--
-- Name: pk_ctl_cie10; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_cie10
    ADD CONSTRAINT pk_ctl_cie10 PRIMARY KEY (id);


--
-- Name: pk_ctl_creacion_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_creacion_expediente
    ADD CONSTRAINT pk_ctl_creacion_establecimiento PRIMARY KEY (id);


--
-- Name: pk_ctl_departamento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_departamento
    ADD CONSTRAINT pk_ctl_departamento PRIMARY KEY (id);


--
-- Name: pk_ctl_especialidad; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_atencion
    ADD CONSTRAINT pk_ctl_especialidad PRIMARY KEY (id);


--
-- Name: pk_ctl_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT pk_ctl_establecimiento PRIMARY KEY (id);


--
-- Name: pk_ctl_estado_civil; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_estado_civil
    ADD CONSTRAINT pk_ctl_estado_civil PRIMARY KEY (id);


--
-- Name: pk_ctl_estado_servicio_apoyo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_estado_servicio_diagnostico
    ADD CONSTRAINT pk_ctl_estado_servicio_apoyo PRIMARY KEY (id);


--
-- Name: pk_ctl_examen_servicio_apoyo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_examen_servicio_diagnostico
    ADD CONSTRAINT pk_ctl_examen_servicio_apoyo PRIMARY KEY (id);


--
-- Name: pk_ctl_formulario; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_formularios
    ADD CONSTRAINT pk_ctl_formulario PRIMARY KEY (id);


--
-- Name: pk_ctl_modalidad; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_modalidad
    ADD CONSTRAINT pk_ctl_modalidad PRIMARY KEY (id);


--
-- Name: pk_ctl_modalidad_ctl_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_modalidad_establecimiento
    ADD CONSTRAINT pk_ctl_modalidad_ctl_establecimiento PRIMARY KEY (id);


--
-- Name: pk_ctl_municipio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_municipio
    ADD CONSTRAINT pk_ctl_municipio PRIMARY KEY (id);


--
-- Name: pk_ctl_nacionalidad; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_nacionalidad
    ADD CONSTRAINT pk_ctl_nacionalidad PRIMARY KEY (id);


--
-- Name: pk_ctl_ocupacion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_ocupacion
    ADD CONSTRAINT pk_ctl_ocupacion PRIMARY KEY (id);


--
-- Name: pk_ctl_pais; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_pais
    ADD CONSTRAINT pk_ctl_pais PRIMARY KEY (id);


--
-- Name: pk_ctl_parentesco; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_parentesco
    ADD CONSTRAINT pk_ctl_parentesco PRIMARY KEY (id);


--
-- Name: pk_ctl_programa; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_programa
    ADD CONSTRAINT pk_ctl_programa PRIMARY KEY (id);


--
-- Name: pk_ctl_tipo_atencion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_tipo_atencion
    ADD CONSTRAINT pk_ctl_tipo_atencion PRIMARY KEY (id);


--
-- Name: pk_ctl_tipo_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_tipo_establecimiento
    ADD CONSTRAINT pk_ctl_tipo_establecimiento PRIMARY KEY (id);


--
-- Name: pk_detalle_resultado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT pk_detalle_resultado PRIMARY KEY (id);


--
-- Name: pk_edadpaciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_rango_edad
    ADD CONSTRAINT pk_edadpaciente PRIMARY KEY (id);


--
-- Name: pk_elemento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_elementos
    ADD CONSTRAINT pk_elemento PRIMARY KEY (id);


--
-- Name: pk_entrega; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_bitacoraentregamedicamento
    ADD CONSTRAINT pk_entrega PRIMARY KEY (id);


--
-- Name: pk_examenesxestablecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_examenesxestablecimiento
    ADD CONSTRAINT pk_examenesxestablecimiento PRIMARY KEY (id);


--
-- Name: pk_existencia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_medicinaexistenciaxarea
    ADD CONSTRAINT pk_existencia PRIMARY KEY (id);


--
-- Name: pk_expediente_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_expediente_establecimiento
    ADD CONSTRAINT pk_expediente_establecimiento PRIMARY KEY (id);


--
-- Name: pk_farxestablecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_farmaciaxestablecimiento
    ADD CONSTRAINT pk_farxestablecimiento PRIMARY KEY (id);


--
-- Name: pk_form_item; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_form_item
    ADD CONSTRAINT pk_form_item PRIMARY KEY (id);


--
-- Name: pk_form_item_catalogo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_form_item_catalogo
    ADD CONSTRAINT pk_form_item_catalogo PRIMARY KEY (id);


--
-- Name: pk_form_item_pool; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_form_item_pool
    ADD CONSTRAINT pk_form_item_pool PRIMARY KEY (id);


--
-- Name: pk_form_seccion_item; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_form_seccion_item
    ADD CONSTRAINT pk_form_seccion_item PRIMARY KEY (id);


--
-- Name: pk_formulario; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_formulario
    ADD CONSTRAINT pk_formulario PRIMARY KEY (id);


--
-- Name: pk_formulario_seccion_pool; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_formulario_seccion_pool
    ADD CONSTRAINT pk_formulario_seccion_pool PRIMARY KEY (id);


--
-- Name: pk_fuente_financiamiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_fuentefinanciamiento
    ADD CONSTRAINT pk_fuente_financiamiento PRIMARY KEY (idfuentefinanciamiento);


--
-- Name: pk_grupo_formulario; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_grupo_formulario
    ADD CONSTRAINT pk_grupo_formulario PRIMARY KEY (id);


--
-- Name: pk_grupo_insercion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_grupo_insercion
    ADD CONSTRAINT pk_grupo_insercion PRIMARY KEY (id);


--
-- Name: pk_grupo_insercion_dependencia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_insercion_dependencia
    ADD CONSTRAINT pk_grupo_insercion_dependencia PRIMARY KEY (id);


--
-- Name: pk_id; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_estados
    ADD CONSTRAINT pk_id PRIMARY KEY (id);


--
-- Name: pk_id_ctl_sexo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_sexo
    ADD CONSTRAINT pk_id_ctl_sexo PRIMARY KEY (id);


--
-- Name: pk_idarea; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_areafarmacia
    ADD CONSTRAINT pk_idarea PRIMARY KEY (id);


--
-- Name: pk_idareamedicina; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_areamedicina
    ADD CONSTRAINT pk_idareamedicina PRIMARY KEY (id);


--
-- Name: pk_idcierre; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_cierre
    ADD CONSTRAINT pk_idcierre PRIMARY KEY (id);


--
-- Name: pk_iddivisor; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_divisores
    ADD CONSTRAINT pk_iddivisor PRIMARY KEY (id);


--
-- Name: pk_identrega; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_entregamedicamento
    ADD CONSTRAINT pk_identrega PRIMARY KEY (id);


--
-- Name: pk_idlote; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_lotes
    ADD CONSTRAINT pk_idlote PRIMARY KEY (id);


--
-- Name: pk_idmedicina; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_catalogoproductos
    ADD CONSTRAINT pk_idmedicina PRIMARY KEY (id);


--
-- Name: pk_idmedicinarecetada; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_medicinarecetada
    ADD CONSTRAINT pk_idmedicinarecetada PRIMARY KEY (id);


--
-- Name: pk_idpersonal; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_usuarios
    ADD CONSTRAINT pk_idpersonal PRIMARY KEY (id);


--
-- Name: pk_idreceta; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_recetas
    ADD CONSTRAINT pk_idreceta PRIMARY KEY (id);


--
-- Name: pk_idrelacion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_areafarmaciaxestablecimiento
    ADD CONSTRAINT pk_idrelacion PRIMARY KEY (idrelacion);


--
-- Name: pk_idtransferencia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_transferencias
    ADD CONSTRAINT pk_idtransferencia PRIMARY KEY (id);


--
-- Name: pk_idtransferenciahospitalarias; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_transferenciashospitales
    ADD CONSTRAINT pk_idtransferenciahospitalarias PRIMARY KEY (id);


--
-- Name: pk_idunidadmedida; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_unidadmedidas
    ADD CONSTRAINT pk_idunidadmedida PRIMARY KEY (id);


--
-- Name: pk_img_bloqueo_agenda; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_bloqueo_agenda
    ADD CONSTRAINT pk_img_bloqueo_agenda PRIMARY KEY (id);


--
-- Name: pk_img_cita; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT pk_img_cita PRIMARY KEY (id);


--
-- Name: pk_img_ctl_campo_autocomplementar; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_campo_autocomplementar
    ADD CONSTRAINT pk_img_ctl_campo_autocomplementar PRIMARY KEY (id);


--
-- Name: pk_img_ctl_configuracion_agenda; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_configuracion_agenda
    ADD CONSTRAINT pk_img_ctl_configuracion_agenda PRIMARY KEY (id);


--
-- Name: pk_img_ctl_estado_cita; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_cita
    ADD CONSTRAINT pk_img_ctl_estado_cita PRIMARY KEY (id);


--
-- Name: pk_img_ctl_estado_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_diagnostico
    ADD CONSTRAINT pk_img_ctl_estado_diagnostico PRIMARY KEY (id);


--
-- Name: pk_img_ctl_estado_lectura; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_lectura
    ADD CONSTRAINT pk_img_ctl_estado_lectura PRIMARY KEY (id);


--
-- Name: pk_img_ctl_estado_procedimiento_realizado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_procedimiento_realizado
    ADD CONSTRAINT pk_img_ctl_estado_procedimiento_realizado PRIMARY KEY (id);


--
-- Name: pk_img_ctl_estado_solicitud; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_estado_solicitud
    ADD CONSTRAINT pk_img_ctl_estado_solicitud PRIMARY KEY (id);


--
-- Name: pk_img_ctl_forma_contacto; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_forma_contacto
    ADD CONSTRAINT pk_img_ctl_forma_contacto PRIMARY KEY (id);


--
-- Name: pk_img_ctl_grupo_material; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_grupo_material
    ADD CONSTRAINT pk_img_ctl_grupo_material PRIMARY KEY (id);


--
-- Name: pk_img_ctl_material; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_material
    ADD CONSTRAINT pk_img_ctl_material PRIMARY KEY (id);


--
-- Name: pk_img_ctl_material_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_material_establecimiento
    ADD CONSTRAINT pk_img_ctl_material_establecimiento PRIMARY KEY (id);


--
-- Name: pk_img_ctl_motor_bd; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_motor_bd
    ADD CONSTRAINT pk_img_ctl_motor_bd PRIMARY KEY (id);


--
-- Name: pk_img_ctl_pacs_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_pacs_establecimiento
    ADD CONSTRAINT pk_img_ctl_pacs_establecimiento PRIMARY KEY (id);


--
-- Name: pk_img_ctl_patron_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT pk_img_ctl_patron_diagnostico PRIMARY KEY (id);


--
-- Name: pk_img_ctl_preparacion_estudio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_preparacion_estudio
    ADD CONSTRAINT pk_img_ctl_preparacion_estudio PRIMARY KEY (id);


--
-- Name: pk_img_ctl_prioridad_atencion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_prioridad_atencion
    ADD CONSTRAINT pk_img_ctl_prioridad_atencion PRIMARY KEY (id);


--
-- Name: pk_img_ctl_proyeccion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_proyeccion
    ADD CONSTRAINT pk_img_ctl_proyeccion PRIMARY KEY (id);


--
-- Name: pk_img_ctl_proyeccion_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_proyeccion_establecimiento
    ADD CONSTRAINT pk_img_ctl_proyeccion_establecimiento PRIMARY KEY (id);


--
-- Name: pk_img_ctl_subgrupo_material; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_subgrupo_material
    ADD CONSTRAINT pk_img_ctl_subgrupo_material PRIMARY KEY (id);


--
-- Name: pk_img_ctl_tipo_nota_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_tipo_nota_diagnostico
    ADD CONSTRAINT pk_img_ctl_tipo_nota_diagnostico PRIMARY KEY (id);


--
-- Name: pk_img_ctl_tipo_resultado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_ctl_tipo_resultado
    ADD CONSTRAINT pk_img_ctl_tipo_resultado PRIMARY KEY (id);


--
-- Name: pk_img_dato_autocomplemento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_dato_autocomplemento
    ADD CONSTRAINT pk_img_dato_autocomplemento PRIMARY KEY (id);


--
-- Name: pk_img_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT pk_img_diagnostico PRIMARY KEY (id);


--
-- Name: pk_img_estudio_paciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_estudio_paciente
    ADD CONSTRAINT pk_img_estudio_paciente PRIMARY KEY (id);


--
-- Name: pk_img_exclusion_bloqueo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_exclusion_bloqueo
    ADD CONSTRAINT pk_img_exclusion_bloqueo PRIMARY KEY (id);


--
-- Name: pk_img_expediente_ficticio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_expediente_ficticio
    ADD CONSTRAINT pk_img_expediente_ficticio PRIMARY KEY (id);


--
-- Name: pk_img_lectura; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT pk_img_lectura PRIMARY KEY (id);


--
-- Name: pk_img_lectura_estudio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_lectura_estudio
    ADD CONSTRAINT pk_img_lectura_estudio PRIMARY KEY (id);


--
-- Name: pk_img_material_utilizado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_material_utilizado
    ADD CONSTRAINT pk_img_material_utilizado PRIMARY KEY (id);


--
-- Name: pk_img_nota_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_nota_diagnostico
    ADD CONSTRAINT pk_img_nota_diagnostico PRIMARY KEY (id);


--
-- Name: pk_img_pendiente_lectura; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_pendiente_lectura
    ADD CONSTRAINT pk_img_pendiente_lectura PRIMARY KEY (id);


--
-- Name: pk_img_pendiente_realizacion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT pk_img_pendiente_realizacion PRIMARY KEY (id);


--
-- Name: pk_img_pendiente_transcripcion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_pendiente_transcripcion
    ADD CONSTRAINT pk_img_pendiente_transcripcion PRIMARY KEY (id);


--
-- Name: pk_img_pendiente_validacion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_pendiente_validacion
    ADD CONSTRAINT pk_img_pendiente_validacion PRIMARY KEY (id);


--
-- Name: pk_img_procedimiento_realizado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT pk_img_procedimiento_realizado PRIMARY KEY (id);


--
-- Name: pk_img_solicitud_diagnostico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_solicitud_diagnostico
    ADD CONSTRAINT pk_img_solicitud_diagnostico PRIMARY KEY (id);


--
-- Name: pk_img_solicitud_estudio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT pk_img_solicitud_estudio PRIMARY KEY (id);


--
-- Name: pk_img_solicitud_estudio_complementario; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT pk_img_solicitud_estudio_complementario PRIMARY KEY (id);


--
-- Name: pk_img_solicitud_estudio_complementario_proyeccion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_solicitud_estudio_complementario_proyeccion
    ADD CONSTRAINT pk_img_solicitud_estudio_complementario_proyeccion PRIMARY KEY (id);


--
-- Name: pk_img_solicitud_estudio_proyeccion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY img_solicitud_estudio_proyeccion
    ADD CONSTRAINT pk_img_solicitud_estudio_proyeccion PRIMARY KEY (id);


--
-- Name: pk_insercion_parametro; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_insercion_parametro
    ADD CONSTRAINT pk_insercion_parametro PRIMARY KEY (id);


--
-- Name: pk_insertado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_insertado
    ADD CONSTRAINT pk_insertado PRIMARY KEY (id);


--
-- Name: pk_item_catalogo_reg; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_item_catalogo_reg
    ADD CONSTRAINT pk_item_catalogo_reg PRIMARY KEY (id);


--
-- Name: pk_lab_antibiotico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_antibioticos
    ADD CONSTRAINT pk_lab_antibiotico PRIMARY KEY (id);


--
-- Name: CONSTRAINT pk_lab_antibiotico ON lab_antibioticos; Type: COMMENT; Schema: public; Owner: simagd
--

COMMENT ON CONSTRAINT pk_lab_antibiotico ON lab_antibioticos IS 'tabla que contiene el catálogo de antibiótico';


--
-- Name: pk_lab_elementostincion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_elementostincion
    ADD CONSTRAINT pk_lab_elementostincion PRIMARY KEY (id);


--
-- Name: pk_lab_estandarxgrupo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_estandarxgrupo
    ADD CONSTRAINT pk_lab_estandarxgrupo PRIMARY KEY (id);


--
-- Name: pk_lab_observaciones; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_observaciones
    ADD CONSTRAINT pk_lab_observaciones PRIMARY KEY (id);


--
-- Name: pk_lab_plantilla; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_plantilla
    ADD CONSTRAINT pk_lab_plantilla PRIMARY KEY (id);


--
-- Name: pk_lab_resultados; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT pk_lab_resultados PRIMARY KEY (id);


--
-- Name: pk_lab_resultadosportarjeta; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_resultadosportarjeta
    ADD CONSTRAINT pk_lab_resultadosportarjeta PRIMARY KEY (id);


--
-- Name: pk_lab_tiposolicitud; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_tiposolicitud
    ADD CONSTRAINT pk_lab_tiposolicitud PRIMARY KEY (id);


--
-- Name: pk_medicinadespachada_idmedicinadespachada; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_medicinadespachada
    ADD CONSTRAINT pk_medicinadespachada_idmedicinadespachada PRIMARY KEY (id);


--
-- Name: pk_medicinavencida_identrega; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_medicinavencida
    ADD CONSTRAINT pk_medicinavencida_identrega PRIMARY KEY (id);


--
-- Name: pk_mnt_ambiente_independiente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_ambiente_independiente
    ADD CONSTRAINT pk_mnt_ambiente_independiente PRIMARY KEY (id);


--
-- Name: pk_mnt_area_mod_estab; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_area_mod_estab
    ADD CONSTRAINT pk_mnt_area_mod_estab PRIMARY KEY (id);


--
-- Name: pk_mnt_aten_area_mod_estab; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_aten_area_mod_estab
    ADD CONSTRAINT pk_mnt_aten_area_mod_estab PRIMARY KEY (id);


--
-- Name: pk_mnt_auditoria_paciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT pk_mnt_auditoria_paciente PRIMARY KEY (id);


--
-- Name: pk_mnt_cargo_empleado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_cargoempleados
    ADD CONSTRAINT pk_mnt_cargo_empleado PRIMARY KEY (id);


--
-- Name: pk_mnt_ciq; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_ciq
    ADD CONSTRAINT pk_mnt_ciq PRIMARY KEY (id);


--
-- Name: pk_mnt_condicionegreso; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_condicionegreso
    ADD CONSTRAINT pk_mnt_condicionegreso PRIMARY KEY (idcondicion);


--
-- Name: pk_mnt_conexion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_conexion
    ADD CONSTRAINT pk_mnt_conexion PRIMARY KEY (id);


--
-- Name: pk_mnt_consultorio; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_consultorio
    ADD CONSTRAINT pk_mnt_consultorio PRIMARY KEY (id);


--
-- Name: pk_mnt_documento_identidad; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_documento_identidad
    ADD CONSTRAINT pk_mnt_documento_identidad PRIMARY KEY (id);


--
-- Name: pk_mnt_empleado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT pk_mnt_empleado PRIMARY KEY (id);


--
-- Name: pk_mnt_empleado_especialidad; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_empleado_especialidad
    ADD CONSTRAINT pk_mnt_empleado_especialidad PRIMARY KEY (id);


--
-- Name: pk_mnt_especialidad; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_empleado_especialidad_estab
    ADD CONSTRAINT pk_mnt_especialidad PRIMARY KEY (id);


--
-- Name: pk_mnt_expediente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT pk_mnt_expediente PRIMARY KEY (id);


--
-- Name: pk_mnt_formulariosxestablecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_formulariosxestablecimiento
    ADD CONSTRAINT pk_mnt_formulariosxestablecimiento PRIMARY KEY (id);


--
-- Name: pk_mnt_origenmuestra; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_origenmuestra
    ADD CONSTRAINT pk_mnt_origenmuestra PRIMARY KEY (id);


--
-- Name: pk_mnt_paciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT pk_mnt_paciente PRIMARY KEY (id);


--
-- Name: pk_mnt_programa_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_programa_establecimiento
    ADD CONSTRAINT pk_mnt_programa_establecimiento PRIMARY KEY (id);


--
-- Name: pk_mnt_rangohoras; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_rangohora
    ADD CONSTRAINT pk_mnt_rangohoras PRIMARY KEY (id);


--
-- Name: pk_mnt_servicio_externo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_servicio_externo
    ADD CONSTRAINT pk_mnt_servicio_externo PRIMARY KEY (id);


--
-- Name: pk_mnt_servicio_externo_establecimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_servicio_externo_establecimiento
    ADD CONSTRAINT pk_mnt_servicio_externo_establecimiento PRIMARY KEY (id);


--
-- Name: pk_mnt_tipo_empleado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_tipo_empleado
    ADD CONSTRAINT pk_mnt_tipo_empleado PRIMARY KEY (id);


--
-- Name: pk_mnt_tipo_procedimiento; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_tipo_procedimiento
    ADD CONSTRAINT pk_mnt_tipo_procedimiento PRIMARY KEY (id);


--
-- Name: pk_mnt_tiposdiagnosticos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_tiposdiagnosticos
    ADD CONSTRAINT pk_mnt_tiposdiagnosticos PRIMARY KEY (idtipodiagnostico);


--
-- Name: pk_paciente_programa_estab; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY mnt_paciente_programa_estab
    ADD CONSTRAINT pk_paciente_programa_estab PRIMARY KEY (id);


--
-- Name: pk_periododesabastecido_idperiodo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY farm_periododesabastecido
    ADD CONSTRAINT pk_periododesabastecido_idperiodo PRIMARY KEY (id);


--
-- Name: pk_procedimientosporexamen; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT pk_procedimientosporexamen PRIMARY KEY (id);


--
-- Name: pk_rechazada; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_rechazada
    ADD CONSTRAINT pk_rechazada PRIMARY KEY (id);


--
-- Name: pk_rx_area; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_area
    ADD CONSTRAINT pk_rx_area PRIMARY KEY (id);


--
-- Name: pk_rx_causa_rechazo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_causa_rechazo
    ADD CONSTRAINT pk_rx_causa_rechazo PRIMARY KEY (id);


--
-- Name: pk_rx_estado; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_estado
    ADD CONSTRAINT pk_rx_estado PRIMARY KEY (id);


--
-- Name: pk_rx_examen; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_examen
    ADD CONSTRAINT pk_rx_examen PRIMARY KEY (id);


--
-- Name: pk_rx_imagen; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_imagen
    ADD CONSTRAINT pk_rx_imagen PRIMARY KEY (id);


--
-- Name: pk_rx_radiografia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_radiografia
    ADD CONSTRAINT pk_rx_radiografia PRIMARY KEY (id);


--
-- Name: pk_rx_tamanio_pelicula; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY rx_tamanio_pelicula
    ADD CONSTRAINT pk_rx_tamanio_pelicula PRIMARY KEY (id);


--
-- Name: pk_sec_antecedentes; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_antecedentes
    ADD CONSTRAINT pk_sec_antecedentes PRIMARY KEY (id);


--
-- Name: pk_sec_circunstancia_ingreso; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_circunstancia_ingreso
    ADD CONSTRAINT pk_sec_circunstancia_ingreso PRIMARY KEY (id);


--
-- Name: pk_sec_detallediagnosticos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_detallediagnosticos
    ADD CONSTRAINT pk_sec_detallediagnosticos PRIMARY KEY (iddetalle);


--
-- Name: pk_sec_detalleprocedimientos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_detalleprocedimientos
    ADD CONSTRAINT pk_sec_detalleprocedimientos PRIMARY KEY (idprocedimientos);


--
-- Name: pk_sec_detallesolicitudestudios; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT pk_sec_detallesolicitudestudios PRIMARY KEY (id);


--
-- Name: pk_sec_diagnosticos_procedimientos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_diagnosticos_procedimientos
    ADD CONSTRAINT pk_sec_diagnosticos_procedimientos PRIMARY KEY (iddiagnosticosproc);


--
-- Name: pk_sec_diagnosticospaciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_diagnosticospaciente
    ADD CONSTRAINT pk_sec_diagnosticospaciente PRIMARY KEY (id);


--
-- Name: pk_sec_egresos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_egresos
    ADD CONSTRAINT pk_sec_egresos PRIMARY KEY (idegreso);


--
-- Name: pk_sec_emergencia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_emergencia
    ADD CONSTRAINT pk_sec_emergencia PRIMARY KEY (id);


--
-- Name: pk_sec_estado_paciente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_estado_paciente
    ADD CONSTRAINT pk_sec_estado_paciente PRIMARY KEY (id);


--
-- Name: pk_sec_historial_clinico; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_historial_clinico
    ADD CONSTRAINT pk_sec_historial_clinico PRIMARY KEY (id);


--
-- Name: pk_sec_hojaindicacionesconsultaexterna; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_hojaindicacionesconsultaexterna
    ADD CONSTRAINT pk_sec_hojaindicacionesconsultaexterna PRIMARY KEY (idhojaindicacionesconsultaexterna);


--
-- Name: pk_sec_incapacidadmedica; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_incapacidadmedica
    ADD CONSTRAINT pk_sec_incapacidadmedica PRIMARY KEY (incapacidadmedica);


--
-- Name: pk_sec_ingreso; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT pk_sec_ingreso PRIMARY KEY (id);


--
-- Name: pk_sec_ingresos_historial; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_ingresos_historial
    ADD CONSTRAINT pk_sec_ingresos_historial PRIMARY KEY (idingreso);


--
-- Name: pk_sec_motivo_consulta; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_motivo_consulta
    ADD CONSTRAINT pk_sec_motivo_consulta PRIMARY KEY (id);


--
-- Name: pk_sec_procedencia_ingreso; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_procedencia_ingreso
    ADD CONSTRAINT pk_sec_procedencia_ingreso PRIMARY KEY (id);


--
-- Name: pk_sec_referencias; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_referencias
    ADD CONSTRAINT pk_sec_referencias PRIMARY KEY (idreferencia);


--
-- Name: pk_sec_segconsultaexterna; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_segconsultaexterna
    ADD CONSTRAINT pk_sec_segconsultaexterna PRIMARY KEY (idseguimiento);


--
-- Name: pk_sec_signos_vitales; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_signos_vitales
    ADD CONSTRAINT pk_sec_signos_vitales PRIMARY KEY (id);


--
-- Name: pk_sec_solicitudestudios; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT pk_sec_solicitudestudios PRIMARY KEY (id);


--
-- Name: pk_sec_tipo_accidente; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_tipo_accidente
    ADD CONSTRAINT pk_sec_tipo_accidente PRIMARY KEY (id);


--
-- Name: pk_sec_tiporeferencia; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY sec_tiporeferencia
    ADD CONSTRAINT pk_sec_tiporeferencia PRIMARY KEY (idtiporeferencia);


--
-- Name: pk_seccion; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_seccion
    ADD CONSTRAINT pk_seccion PRIMARY KEY (id);


--
-- Name: pk_seccion_pool; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_seccion_pool
    ADD CONSTRAINT pk_seccion_pool PRIMARY KEY (id);


--
-- Name: pk_subelementos; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_subelementos
    ADD CONSTRAINT pk_subelementos PRIMARY KEY (id);


--
-- Name: pk_tabla; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_tabla
    ADD CONSTRAINT pk_tabla PRIMARY KEY (id);


--
-- Name: pk_tarjetas_vitek; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_tarjetasvitek
    ADD CONSTRAINT pk_tarjetas_vitek PRIMARY KEY (id);


--
-- Name: pk_tipo_campo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_tipo_campo
    ADD CONSTRAINT pk_tipo_campo PRIMARY KEY (id);


--
-- Name: pk_tipo_muestra; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_tipomuestra
    ADD CONSTRAINT pk_tipo_muestra PRIMARY KEY (id);


--
-- Name: pk_tipo_muestraxamen; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY lab_tipomuestraporexamen
    ADD CONSTRAINT pk_tipo_muestraxamen PRIMARY KEY (id);


--
-- Name: pk_tipo_objeto; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_tipo_objeto
    ADD CONSTRAINT pk_tipo_objeto PRIMARY KEY (id);


--
-- Name: pk_validacion_campo; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY ctl_validacion_campo
    ADD CONSTRAINT pk_validacion_campo PRIMARY KEY (id);


--
-- Name: pk_validacion_campo_form_item; Type: CONSTRAINT; Schema: public; Owner: simagd; Tablespace: 
--

ALTER TABLE ONLY frm_validacion_campo_form_item
    ADD CONSTRAINT pk_validacion_campo_form_item PRIMARY KEY (id);


--
-- Name: fki_antibioticos_antibioticosportarjeta; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_antibioticos_antibioticosportarjeta ON lab_antibioticosportarjeta USING btree (idantibiotico);


--
-- Name: fki_aten_mod_area_estab_usuarios; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_aten_mod_area_estab_usuarios ON mnt_usuarios USING btree (id_atencion_establecimiento);


--
-- Name: fki_b3c77447a76ed395; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_b3c77447a76ed395 ON fos_user_user_group USING btree (user_id);


--
-- Name: fki_baterias_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_baterias_detalleresultado ON lab_detalleresultado USING btree (idbacteria);


--
-- Name: fki_cantidad_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_cantidad_detalleresultado ON lab_detalleresultado USING btree (idcantidad);


--
-- Name: fki_cit_tipoevento_cit_evento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_cit_tipoevento_cit_evento ON cit_evento USING btree (id_tipoevento);


--
-- Name: fki_ctl_establecimiento_cit_evento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_ctl_establecimiento_cit_evento ON cit_evento USING btree (id_establecimiento);


--
-- Name: fki_ctl_establecimiento_mnt_procedimiento_establecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_ctl_establecimiento_mnt_procedimiento_establecimiento ON mnt_procedimiento_establecimiento USING btree (id_establecimiento);


--
-- Name: fki_elementos_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_elementos_detalleresultado ON lab_detalleresultado USING btree (idelemento);


--
-- Name: fki_establecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_establecimiento ON lab_detalleresultado USING btree (idestablecimiento);


--
-- Name: fki_establecimiento_areasxestablecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_establecimiento_areasxestablecimiento ON lab_areasxestablecimiento USING btree (idestablecimiento);


--
-- Name: fki_establecimiento_elementos; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_establecimiento_elementos ON lab_elementos USING btree (idestablecimiento);


--
-- Name: fki_fos_user_user_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_cit_distribucion ON cit_distribucion USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_cit_programacion_exams; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_cit_programacion_exams ON cit_programacion_exams USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_cit_tipocita; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_cit_tipocita ON cit_tipocita USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_mod_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_mod_cit_distribucion ON cit_distribucion USING btree (idusuariomod);


--
-- Name: fki_fos_user_user_reg_cit_citas_diaa; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_reg_cit_citas_diaa ON cit_citas_dia USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_reg_cit_citas_serviciodeapoyo; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_reg_cit_citas_serviciodeapoyo ON cit_citas_serviciodeapoyo USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_reg_cit_citasprocedimientos; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_reg_cit_citasprocedimientos ON cit_citasprocedimientos USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_reg_cit_estado_cita; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_reg_cit_estado_cita ON cit_estado_cita USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_reg_cit_evento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_reg_cit_evento ON cit_evento USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_sec_historial_clinico; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_sec_historial_clinico ON sec_historial_clinico USING btree (idusuarioreg);


--
-- Name: fki_fos_user_user_sec_solicitudestudios; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_fos_user_user_sec_solicitudestudios ON sec_solicitudestudios USING btree (idusuarioreg);


--
-- Name: fki_lab_examen_establecimiento_cit_programacion_examen; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_lab_examen_establecimiento_cit_programacion_examen ON cit_programacion_exams USING btree (id_examen_establecimiento);


--
-- Name: fki_lab_examenes_cit_programacion_exams; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_lab_examenes_cit_programacion_exams ON cit_programacion_exams USING btree (id_examen_establecimiento);


--
-- Name: fki_mnt_area_mod_estab_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_area_mod_estab_cit_distribucion ON cit_distribucion USING btree (id_area_mod_estab);


--
-- Name: fki_mnt_area_mod_estab_cit_evento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_area_mod_estab_cit_evento ON cit_evento USING btree (id_area_mod_estab);


--
-- Name: fki_mnt_area_mod_estab_mnt_procedimiento_establecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_area_mod_estab_mnt_procedimiento_establecimiento ON mnt_procedimiento_establecimiento USING btree (id_area_mod_estab);


--
-- Name: fki_mnt_aten_area_mod_estab_cit_programacion_exams; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_aten_area_mod_estab_cit_programacion_exams ON cit_programacion_exams USING btree (id_aten_area_mod_estab);


--
-- Name: fki_mnt_aten_area_mod_estab_sec_historial_clinico; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_aten_area_mod_estab_sec_historial_clinico ON sec_historial_clinico USING btree (idsubservicio);


--
-- Name: fki_mnt_ciq_cit_citasprocedimientos; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_ciq_cit_citasprocedimientos ON cit_citasprocedimientos USING btree (id_ciq_establecimiento);


--
-- Name: fki_mnt_ciq_cit_eventos; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_ciq_cit_eventos ON cit_evento USING btree (id_ciq_establecimiento);


--
-- Name: fki_mnt_ciq_mnt_procedimiento_establecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_ciq_mnt_procedimiento_establecimiento ON mnt_procedimiento_establecimiento USING btree (id_ciq);


--
-- Name: fki_mnt_ciq_sec_detalleprocedimientos; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_ciq_sec_detalleprocedimientos ON sec_detalleprocedimientos USING btree (idciq);


--
-- Name: fki_mnt_consultorios_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_consultorios_cit_distribucion ON cit_distribucion USING btree (id_consultorio);


--
-- Name: fki_mnt_empleado_cit_citas_dia; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_empleado_cit_citas_dia ON cit_citas_dia USING btree (id_empleado);


--
-- Name: fki_mnt_empleado_mnt_procedimiento_establecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_empleado_mnt_procedimiento_establecimiento ON mnt_procedimiento_establecimiento USING btree (id_empleado);


--
-- Name: fki_mnt_empleados_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_empleados_cit_distribucion ON cit_distribucion USING btree (id_empleado);


--
-- Name: fki_mnt_empleados_mod_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_empleados_mod_cit_distribucion ON cit_distribucion USING btree (idusuariomod);


--
-- Name: fki_mnt_empleados_reg_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_empleados_reg_cit_distribucion ON cit_distribucion USING btree (idusuarioreg);


--
-- Name: fki_mnt_expediente_cit_citas_dia; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_expediente_cit_citas_dia ON cit_citas_dia USING btree (id_expediente);


--
-- Name: fki_mnt_procedimiento_establecimiento_cit_citasprocedimientos; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_procedimiento_establecimiento_cit_citasprocedimientos ON cit_citasprocedimientos USING btree (id_ciq_establecimiento);


--
-- Name: fki_mnt_procedimiento_establecimiento_cit_evento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_procedimiento_establecimiento_cit_evento ON cit_evento USING btree (id_ciq_establecimiento);


--
-- Name: fki_mnt_rango_hora_cit_evento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_rango_hora_cit_evento ON cit_evento USING btree (id_rangohora);


--
-- Name: fki_mnt_rango_hora_mnt_procedimiento_establecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_rango_hora_mnt_procedimiento_establecimiento ON mnt_procedimiento_establecimiento USING btree (id_rangohora);


--
-- Name: fki_mnt_rangohoras_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_rangohoras_cit_distribucion ON cit_distribucion USING btree (id_rangohora);


--
-- Name: fki_mnt_usuarios_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_usuarios_cit_distribucion ON cit_distribucion USING btree (idusuarioreg);


--
-- Name: fki_mnt_usuarios_mod_cit_distribucion; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_mnt_usuarios_mod_cit_distribucion ON cit_distribucion USING btree (idusuariomod);


--
-- Name: fki_procedimientos; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_procedimientos ON lab_detalleresultado USING btree (idprocedimiento);


--
-- Name: fki_procedimientosxexamen_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_procedimientosxexamen_detalleresultado ON lab_detalleresultado USING btree (idprocedimiento);


--
-- Name: fki_resultado_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_resultado_detalleresultado ON lab_detalleresultado USING btree (idresultado);


--
-- Name: fki_resultados_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_resultados_detalleresultado ON lab_detalleresultado USING btree (idresultado);


--
-- Name: fki_sec_solicitud_estudfios_mnt_aten_area_mod_estab; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_sec_solicitud_estudfios_mnt_aten_area_mod_estab ON sec_solicitudestudios USING btree (id_atencion);


--
-- Name: fki_servicio_externo_servicio_externo_establecimiento; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_servicio_externo_servicio_externo_establecimiento ON mnt_servicio_externo_establecimiento USING btree (id_servicio_externo);


--
-- Name: fki_subelemento_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_subelemento_detalleresultado ON lab_detalleresultado USING btree (idsubelemento);


--
-- Name: fki_subelementos_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_subelementos_detalleresultado ON lab_detalleresultado USING btree (idsubelemento);


--
-- Name: fki_tarjeta_detalleresultado; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_tarjeta_detalleresultado ON lab_detalleresultado USING btree (idtarjeta);


--
-- Name: fki_tipomuestra_tipomuestraporexamen; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX fki_tipomuestra_tipomuestraporexamen ON lab_tipomuestraporexamen USING btree (idtipomuestra);


--
-- Name: idx_b3c77447fe54d947; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE INDEX idx_b3c77447fe54d947 ON fos_user_user_group USING btree (group_id);


--
-- Name: uniq_583d1f3e5e237e06; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE UNIQUE INDEX uniq_583d1f3e5e237e06 ON fos_user_group USING btree (name);


--
-- Name: uniq_c560d76192fc23a8; Type: INDEX; Schema: public; Owner: simagd; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c560d76192fc23a8 ON fos_user_user USING btree (username_canonical);


--
-- Name: tgr_actualiza_establecimiento_mntatenareamodestab; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER tgr_actualiza_establecimiento_mntatenareamodestab AFTER INSERT ON mnt_aten_area_mod_estab FOR EACH ROW EXECUTE PROCEDURE fn_actualiza_establecimiento_mntatenareamodestab();


--
-- Name: trg_actualizar_estado_solicitud_estudio; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_actualizar_estado_solicitud_estudio BEFORE INSERT ON img_solicitud_estudio FOR EACH ROW EXECUTE PROCEDURE fn_trg_actualizar_estado_solicitud_estudio();


--
-- Name: trg_actualizar_estado_solicitud_estudio_examen; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_actualizar_estado_solicitud_estudio_examen AFTER INSERT OR UPDATE ON img_procedimiento_realizado FOR EACH ROW EXECUTE PROCEDURE fn_trg_actualizar_estado_solicitud_estudio_examen();


--
-- Name: trg_actualizar_inventario_material_utilizado; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_actualizar_inventario_material_utilizado AFTER INSERT OR DELETE OR UPDATE ON img_material_utilizado FOR EACH ROW EXECUTE PROCEDURE fn_trg_actualizar_inventario_material_utilizado();


--
-- Name: trg_anexar_pendiente_lectura_estudio; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_anexar_pendiente_lectura_estudio AFTER INSERT OR UPDATE ON img_lectura_estudio FOR EACH ROW EXECUTE PROCEDURE fn_trg_anexar_pendiente_lectura_estudio();


--
-- Name: trg_extraer_pendiente_lectura_estudio; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_extraer_pendiente_lectura_estudio AFTER DELETE ON img_lectura_estudio FOR EACH ROW EXECUTE PROCEDURE fn_trg_extraer_pendiente_lectura_estudio();


--
-- Name: trg_generar_numero_expediente_ficticio; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_generar_numero_expediente_ficticio BEFORE INSERT OR UPDATE ON img_expediente_ficticio FOR EACH ROW EXECUTE PROCEDURE fn_trg_generar_numero_expediente_ficticio();


--
-- Name: trg_ingresar_pendiente_lectura_estudio; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_ingresar_pendiente_lectura_estudio AFTER INSERT OR UPDATE ON img_estudio_paciente FOR EACH ROW EXECUTE PROCEDURE fn_trg_ingresar_pendiente_lectura_estudio();


--
-- Name: trg_ingresar_pendiente_lectura_solicitud_diagnostico; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_ingresar_pendiente_lectura_solicitud_diagnostico AFTER INSERT OR UPDATE ON img_solicitud_diagnostico FOR EACH ROW EXECUTE PROCEDURE fn_trg_ingresar_pendiente_lectura_solicitud_diagnostico();


--
-- Name: trg_ingresar_pendiente_realizacion_cita; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_ingresar_pendiente_realizacion_cita AFTER INSERT OR UPDATE ON img_cita FOR EACH ROW EXECUTE PROCEDURE fn_trg_ingresar_pendiente_realizacion_cita();


--
-- Name: trg_ingresar_pendiente_realizacion_estudio_complementario; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_ingresar_pendiente_realizacion_estudio_complementario AFTER INSERT OR UPDATE ON img_solicitud_estudio_complementario FOR EACH ROW EXECUTE PROCEDURE fn_trg_ingresar_pendiente_realizacion_estudio_complementario();


--
-- Name: trg_ingresar_pendiente_realizacion_solicitud_estudio; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_ingresar_pendiente_realizacion_solicitud_estudio AFTER INSERT OR UPDATE ON img_solicitud_estudio FOR EACH ROW EXECUTE PROCEDURE fn_trg_ingresar_pendiente_realizacion_solicitud_estudio();


--
-- Name: trg_ingresar_pendiente_transcripcion_lectura; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_ingresar_pendiente_transcripcion_lectura AFTER INSERT OR UPDATE ON img_lectura FOR EACH ROW EXECUTE PROCEDURE fn_trg_ingresar_pendiente_transcripcion_lectura();


--
-- Name: trg_ingresar_pendiente_validacion_diagnostico; Type: TRIGGER; Schema: public; Owner: simagd
--

CREATE TRIGGER trg_ingresar_pendiente_validacion_diagnostico AFTER INSERT OR UPDATE ON img_diagnostico FOR EACH ROW EXECUTE PROCEDURE fn_trg_ingresar_pendiente_validacion_diagnostico();


--
-- Name: fk_ambiente_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_ambiente_ingreso FOREIGN KEY (id_ambiente_ingreso) REFERENCES mnt_aten_area_mod_estab(id) ON UPDATE CASCADE;


--
-- Name: fk_antibioticos_antibioticosportarjeta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticosportarjeta
    ADD CONSTRAINT fk_antibioticos_antibioticosportarjeta FOREIGN KEY (idantibiotico) REFERENCES lab_antibioticos(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_antibioticos_resultadosportarjeta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultadosportarjeta
    ADD CONSTRAINT fk_antibioticos_resultadosportarjeta FOREIGN KEY (idantibiotico) REFERENCES lab_antibioticos(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_area__indicacionesporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_indicacionesporexamen
    ADD CONSTRAINT fk_area__indicacionesporexamen FOREIGN KEY (idarea) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_area_atencion_area_mod_estab; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_mod_estab
    ADD CONSTRAINT fk_area_atencion_area_mod_estab FOREIGN KEY (id_area_atencion) REFERENCES ctl_area_atencion(id);


--
-- Name: fk_area_cotizante_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_area_cotizante_paciente FOREIGN KEY (id_area_cotizacion) REFERENCES ctl_area_cotizante(id);


--
-- Name: fk_area_examen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_examen
    ADD CONSTRAINT fk_area_examen FOREIGN KEY (id_area) REFERENCES rx_area(id);


--
-- Name: fk_area_examen_establecimiento_configuracion_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_configuracion_agenda
    ADD CONSTRAINT fk_area_examen_establecimiento_configuracion_agenda FOREIGN KEY (id_area_examen_estab) REFERENCES mnt_area_examen_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_examen_establecimiento_proyeccion_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion_establecimiento
    ADD CONSTRAINT fk_area_examen_establecimiento_proyeccion_establecimiento FOREIGN KEY (id_area_examen_estab) REFERENCES mnt_area_examen_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_geografica_auditoria_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT fk_area_geografica_auditoria_paciente FOREIGN KEY (area_geografica_domicilio) REFERENCES ctl_area_geografica(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_area_geografica_domicio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_area_geografica_domicio FOREIGN KEY (area_geografica_domicilio) REFERENCES ctl_area_geografica(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_mod_estab_esp_area_mod_estab; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_aten_area_mod_estab
    ADD CONSTRAINT fk_area_mod_estab_esp_area_mod_estab FOREIGN KEY (id_area_mod_estab) REFERENCES mnt_area_mod_estab(id);


--
-- Name: fk_area_servicio_apoyo_empleado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_area_servicio_apoyo_empleado FOREIGN KEY (idarea) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_diagnostico_bloqueo_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_bloqueo_agenda
    ADD CONSTRAINT fk_area_servicio_diagnostico_bloqueo_agenda FOREIGN KEY (id_area_servicio_diagnostico) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_diagnostico_dato_autocomplemento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_dato_autocomplemento
    ADD CONSTRAINT fk_area_servicio_diagnostico_dato_autocomplemento FOREIGN KEY (id_area_servicio_diagnostico) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_diagnostico_patron_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT fk_area_servicio_diagnostico_patron_diagnostico FOREIGN KEY (id_area_servicio_diagnostico) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_diagnostico_preparacion_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_preparacion_estudio
    ADD CONSTRAINT fk_area_servicio_diagnostico_preparacion_estudio FOREIGN KEY (id_area_servicio_diagnostico_aplica) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_diagnostico_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_area_servicio_diagnostico_solicitud_estudio FOREIGN KEY (id_area_servicio_diagnostico) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_diagnostico_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_area_servicio_diagnostico_solicitud_estudio_complementario FOREIGN KEY (id_area_servicio_diagnostico) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_areafarmacia_bitacoramedicinaexistenciaxarea ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_bitacoramedicinaexistenciaxarea
    ADD CONSTRAINT "fk_areafarmacia_bitacoramedicinaexistenciaxarea " FOREIGN KEY (idarea) REFERENCES mnt_areafarmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_areafarmacia_medicinaexistenciaxarea; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinaexistenciaxarea
    ADD CONSTRAINT fk_areafarmacia_medicinaexistenciaxarea FOREIGN KEY (idarea) REFERENCES mnt_areafarmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_areafarmacia_medicinavencida; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinavencida
    ADD CONSTRAINT fk_areafarmacia_medicinavencida FOREIGN KEY (idarea) REFERENCES mnt_areafarmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_areafarmacia_recetas ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_recetas
    ADD CONSTRAINT "fk_areafarmacia_recetas " FOREIGN KEY (idarea) REFERENCES mnt_areafarmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_areafarmacia_usuarios ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_usuarios
    ADD CONSTRAINT "fk_areafarmacia_usuarios " FOREIGN KEY (idarea) REFERENCES mnt_areafarmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_areas_areasxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_areasxestablecimiento
    ADD CONSTRAINT fk_areas_areasxestablecimiento FOREIGN KEY (idarea) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_areas_datosfijosresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT fk_areas_datosfijosresultado FOREIGN KEY (idarea) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_areas_observaciones; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_observaciones
    ADD CONSTRAINT fk_areas_observaciones FOREIGN KEY (idarea) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_areas_procedimientosporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT fk_areas_procedimientosporexamen FOREIGN KEY (idarea) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_areasfarmacia_ajustes; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_ajustes
    ADD CONSTRAINT fk_areasfarmacia_ajustes FOREIGN KEY (idarea) REFERENCES mnt_farmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asigna_examinante_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_asigna_examinante_pendiente_realizacion FOREIGN KEY (id_asigna_examinante) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asigna_radiologo_pendiente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_lectura
    ADD CONSTRAINT fk_asigna_radiologo_pendiente_lectura FOREIGN KEY (id_asigna_radiologo) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asigna_transcriptor_pendiente_transcripcion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_transcripcion
    ADD CONSTRAINT fk_asigna_transcriptor_pendiente_transcripcion FOREIGN KEY (id_asigna_transcriptor) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asigna_validador_pendiente_validacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_validacion
    ADD CONSTRAINT fk_asigna_validador_pendiente_validacion FOREIGN KEY (id_asigna_validador) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_aten_area_mod_estab_cit_distribucion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT fk_aten_area_mod_estab_cit_distribucion FOREIGN KEY (id_aten_area_mod_estab) REFERENCES mnt_aten_area_mod_estab(id);


--
-- Name: fk_aten_area_mod_estab_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_aten_area_mod_estab_ingreso FOREIGN KEY (id_aten_are_mod_estab) REFERENCES mnt_aten_area_mod_estab(id) ON UPDATE CASCADE;


--
-- Name: fk_aten_area_mod_estab_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_aten_area_mod_estab_solicitud_estudio FOREIGN KEY (id_aten_area_mod_estab) REFERENCES mnt_aten_area_mod_estab(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_aten_mod_area_estab_usuarios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_usuarios
    ADD CONSTRAINT fk_aten_mod_area_estab_usuarios FOREIGN KEY (id_atencion_establecimiento) REFERENCES mnt_aten_area_mod_estab(id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_atencion__indicacionesporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_indicacionesporexamen
    ADD CONSTRAINT fk_atencion__indicacionesporexamen FOREIGN KEY (idservicio) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_atencion_area_servicio_apoyo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_area_servicio_diagnostico
    ADD CONSTRAINT fk_atencion_area_servicio_apoyo FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_atencion_atencion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_atencion
    ADD CONSTRAINT fk_atencion_atencion FOREIGN KEY (id_atencion_padre) REFERENCES ctl_atencion(id);


--
-- Name: fk_atencion_cargo_empleado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_cargoempleados
    ADD CONSTRAINT fk_atencion_cargo_empleado FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_atencion_empleado_especialidad; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado_especialidad
    ADD CONSTRAINT fk_atencion_empleado_especialidad FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_atencion_esp_area_mod_estab; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_aten_area_mod_estab
    ADD CONSTRAINT fk_atencion_esp_area_mod_estab FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_atencion_estado_servicio_apoyo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_estado_servicio_diagnostico
    ADD CONSTRAINT fk_atencion_estado_servicio_apoyo FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_atencion_examen_servicio_apoyo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_examen_servicio_diagnostico
    ADD CONSTRAINT fk_atencion_examen_servicio_apoyo FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_atencion_formulariosxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_formulariosxestablecimiento
    ADD CONSTRAINT fk_atencion_formulariosxestablecimiento FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_atencion_grupo_formulario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_formulario
    ADD CONSTRAINT fk_atencion_grupo_formulario FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON DELETE RESTRICT;


--
-- Name: fk_atencion_solicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_atencion_solicitudestudios FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_b3c77447a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447a76ed395 FOREIGN KEY (user_id) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_b3c77447fe54d947; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447fe54d947 FOREIGN KEY (group_id) REFERENCES fos_user_group(id);


--
-- Name: fk_bacterias_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_bacterias_detalleresultado FOREIGN KEY (idbacteria) REFERENCES lab_bacterias(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_bloqueo_agenda_exclusion_bloqueo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_exclusion_bloqueo
    ADD CONSTRAINT fk_bloqueo_agenda_exclusion_bloqueo FOREIGN KEY (id_bloqueo_agenda) REFERENCES img_bloqueo_agenda(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_campo_autocomplementar_dato_autocomplemento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_dato_autocomplemento
    ADD CONSTRAINT fk_campo_autocomplementar_dato_autocomplemento FOREIGN KEY (id_campo_autocomplementar) REFERENCES img_ctl_campo_autocomplementar(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_campo_catalogo_campo_desc; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_catalogo
    ADD CONSTRAINT fk_campo_catalogo_campo_desc FOREIGN KEY (id_campo_descripcion) REFERENCES ctl_campo(id);


--
-- Name: fk_campo_catalogo_campo_id; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_catalogo
    ADD CONSTRAINT fk_campo_catalogo_campo_id FOREIGN KEY (id_campo_id) REFERENCES ctl_campo(id);


--
-- Name: fk_cantidad_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_cantidad_detalleresultado FOREIGN KEY (idcantidad) REFERENCES lab_cantidadestincion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_canton_auditoria_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT fk_canton_auditoria_paciente FOREIGN KEY (id_canton_domicilio) REFERENCES ctl_canton(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_canton_paciente_domicilio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_canton_paciente_domicilio FOREIGN KEY (id_canton_domicilio) REFERENCES ctl_canton(id);


--
-- Name: fk_cargoempleados_empleado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_cargoempleados_empleado FOREIGN KEY (id_cargo_empleado) REFERENCES mnt_cargoempleados(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_catalogo_form_item_catalogo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_catalogo
    ADD CONSTRAINT fk_catalogo_form_item_catalogo FOREIGN KEY (id_catalogo) REFERENCES ctl_catalogo(id) ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_ajustes; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_ajustes
    ADD CONSTRAINT fk_catalogoproductos_ajustes FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_bitacoraentregamedicamento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_bitacoraentregamedicamento
    ADD CONSTRAINT fk_catalogoproductos_bitacoraentregamedicamento FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_bitacoramedicinaexistenciaxarea ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_bitacoramedicinaexistenciaxarea
    ADD CONSTRAINT "fk_catalogoproductos_bitacoramedicinaexistenciaxarea " FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_catalogoproductosxestablecimiento ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_catalogoproductosxestablecimiento
    ADD CONSTRAINT "fk_catalogoproductos_catalogoproductosxestablecimiento " FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_medicinaexistenciaxarea; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinaexistenciaxarea
    ADD CONSTRAINT fk_catalogoproductos_medicinaexistenciaxarea FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_medicinarecetada ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinarecetada
    ADD CONSTRAINT "fk_catalogoproductos_medicinarecetada " FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_medicinavencida; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinavencida
    ADD CONSTRAINT fk_catalogoproductos_medicinavencida FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_periododesabastecido ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_periododesabastecido
    ADD CONSTRAINT "fk_catalogoproductos_periododesabastecido " FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_transferencias; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_transferencias
    ADD CONSTRAINT fk_catalogoproductos_transferencias FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_catalogoproductos_transferenciashospitales ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_transferenciashospitales
    ADD CONSTRAINT "fk_catalogoproductos_transferenciashospitales " FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_cie10_diagnosticospaciente_1; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_diagnosticospaciente
    ADD CONSTRAINT fk_cie10_diagnosticospaciente_1 FOREIGN KEY (iddiagnostico1) REFERENCES mnt_cie10(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_cie10_diagnosticospaciente_2; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_diagnosticospaciente
    ADD CONSTRAINT fk_cie10_diagnosticospaciente_2 FOREIGN KEY (iddiagnostico2) REFERENCES mnt_cie10(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_cie10_diagnosticospaciente_3; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_diagnosticospaciente
    ADD CONSTRAINT fk_cie10_diagnosticospaciente_3 FOREIGN KEY (iddiagnostico3) REFERENCES mnt_cie10(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_cie10_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_cie10_ingreso FOREIGN KEY (id_cie10) REFERENCES mnt_cie10(id) ON UPDATE CASCADE;


--
-- Name: fk_cit_estado_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_cit_estado_cita FOREIGN KEY (id_estado) REFERENCES cit_estado_cita(id);


--
-- Name: fk_cit_estado_cita_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_cit_estado_cita_cit_citasprocedimientos FOREIGN KEY (id_estado) REFERENCES cit_estado_cita(id);


--
-- Name: fk_cit_estado_cita_cit_motivoagregados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_motivoagregados
    ADD CONSTRAINT fk_cit_estado_cita_cit_motivoagregados FOREIGN KEY (idestado) REFERENCES cit_estado_cita(id);


--
-- Name: fk_cit_motivoagregados_cit_citasxdia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_cit_motivoagregados_cit_citasxdia FOREIGN KEY (id_motivo) REFERENCES cit_motivoagregados(id);


--
-- Name: fk_cit_tipocita_cit_citasxdia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_cit_tipocita_cit_citasxdia FOREIGN KEY (id_tipocita) REFERENCES cit_tipocita(id);


--
-- Name: fk_cit_tipoevento_cit_evento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT fk_cit_tipoevento_cit_evento FOREIGN KEY (id_tipoevento) REFERENCES cit_tipoevento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_cita_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_cita_procedimiento_realizado FOREIGN KEY (id_cita_programada) REFERENCES img_cita(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_cita_programada_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_cita_programada_pendiente_realizacion FOREIGN KEY (id_cita_programada) REFERENCES img_cita(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_codigosresultados_codigosxexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_codigosxexamen
    ADD CONSTRAINT fk_codigosresultados_codigosxexamen FOREIGN KEY (idresultado) REFERENCES lab_codigosresultados(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_codigosresultados_resultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_codigosresultados_resultados FOREIGN KEY (idcodigoresultado) REFERENCES lab_codigosresultados(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_condicion_persona_grupo_formulario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_formulario
    ADD CONSTRAINT fk_condicion_persona_grupo_formulario FOREIGN KEY (id_condicion_persona) REFERENCES ctl_condicion_persona(id) ON DELETE RESTRICT;


--
-- Name: fk_configuracion_agenda_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_configuracion_agenda_cita FOREIGN KEY (id_configuracion_agenda) REFERENCES img_ctl_configuracion_agenda(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_consultorio_distribucion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT fk_consultorio_distribucion FOREIGN KEY (id_consultorio) REFERENCES mnt_consultorio(id);


--
-- Name: fk_creacion_expediente_expediente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT fk_creacion_expediente_expediente FOREIGN KEY (id_creacion_expediente) REFERENCES ctl_creacion_expediente(id);


--
-- Name: fk_ctl_atencion_sec_diagnosticos_procedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_diagnosticos_procedimientos
    ADD CONSTRAINT fk_ctl_atencion_sec_diagnosticos_procedimientos FOREIGN KEY (idsubservicio) REFERENCES ctl_atencion(id);


--
-- Name: fk_ctl_atencion_sec_egresos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_egresos
    ADD CONSTRAINT fk_ctl_atencion_sec_egresos FOREIGN KEY (idsubserviciotraslado) REFERENCES ctl_atencion(id);


--
-- Name: fk_ctl_atencion_sec_ingresos_historial; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingresos_historial
    ADD CONSTRAINT fk_ctl_atencion_sec_ingresos_historial FOREIGN KEY (idsubservicio) REFERENCES ctl_atencion(id);


--
-- Name: fk_ctl_establecimiento_cit_citas_dia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_ctl_establecimiento_cit_citas_dia FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ctl_establecimiento_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_ctl_establecimiento_cit_citasprocedimientos FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_ctl_establecimiento_cit_evento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT fk_ctl_establecimiento_cit_evento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ctl_establecimiento_cit_referentes; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_referentes
    ADD CONSTRAINT fk_ctl_establecimiento_cit_referentes FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ctl_establecimiento_ctl_programacionxexams; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_programacion_exams
    ADD CONSTRAINT fk_ctl_establecimiento_ctl_programacionxexams FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ctl_establecimiento_mnt_procedimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_procedimiento_establecimiento
    ADD CONSTRAINT fk_ctl_establecimiento_mnt_procedimiento_establecimiento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ctl_establecimiento_referencia_cit_citas_dia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_ctl_establecimiento_referencia_cit_citas_dia FOREIGN KEY (id_establecimiento_referencia) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ctl_establecimiento_referencia_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_ctl_establecimiento_referencia_cit_citasprocedimientos FOREIGN KEY (id_establecimiento_referencia) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_ctl_rango_edad_lab_subelementos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_subelementos
    ADD CONSTRAINT fk_ctl_rango_edad_lab_subelementos FOREIGN KEY (idedad) REFERENCES ctl_rango_edad(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ctl_sexo_lab_subelementos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_subelementos
    ADD CONSTRAINT fk_ctl_sexo_lab_subelementos FOREIGN KEY (idsexo) REFERENCES ctl_sexo(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_departamento_auditoria_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT fk_departamento_auditoria_paciente FOREIGN KEY (id_departamento_domicilio) REFERENCES ctl_departamento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_departamento_municipio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_municipio
    ADD CONSTRAINT fk_departamento_municipio FOREIGN KEY (id_departamento) REFERENCES ctl_departamento(id);


--
-- Name: fk_departamento_paciente_domicilio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_departamento_paciente_domicilio FOREIGN KEY (id_departamento_domicilio) REFERENCES ctl_departamento(id);


--
-- Name: fk_departamento_paciente_nacimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_departamento_paciente_nacimiento FOREIGN KEY (id_departamento_nacimiento) REFERENCES ctl_departamento(id);


--
-- Name: fk_detalleresultado_resultadosportarjeta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultadosportarjeta
    ADD CONSTRAINT fk_detalleresultado_resultadosportarjeta FOREIGN KEY (iddetalleresultado) REFERENCES lab_detalleresultado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_detallesolicitud_resultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_detallesolicitud_resultados FOREIGN KEY (iddetallesolicitud) REFERENCES sec_detallesolicitudestudios(id);


--
-- Name: fk_diagnostico_nota_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_nota_diagnostico
    ADD CONSTRAINT fk_diagnostico_nota_diagnostico FOREIGN KEY (id_diagnostico) REFERENCES img_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_diagnostico_pendiente_validacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_validacion
    ADD CONSTRAINT fk_diagnostico_pendiente_validacion FOREIGN KEY (id_diagnostico) REFERENCES img_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_documente_identidad_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_documente_identidad_paciente FOREIGN KEY (id_doc_ide_paciente) REFERENCES ctl_documento_identidad(id);


--
-- Name: fk_documento_identidad_proporciono_datos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_documento_identidad_proporciono_datos FOREIGN KEY (id_doc_ide_proporciono_datos) REFERENCES ctl_documento_identidad(id);


--
-- Name: fk_documento_identidad_responsable; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_documento_identidad_responsable FOREIGN KEY (id_doc_ide_responsable) REFERENCES ctl_documento_identidad(id);


--
-- Name: fk_elementos_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_elementos_detalleresultado FOREIGN KEY (idelemento) REFERENCES lab_elementos(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_empleado_bloqueo_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_bloqueo_agenda
    ADD CONSTRAINT fk_empleado_bloqueo_agenda FOREIGN KEY (id_empleado_registra) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_empleado_cita FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_empleado_detallesolicitudestudios FOREIGN KEY (idempleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_empleado_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT fk_empleado_diagnostico FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_empleado_especialidad; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado_especialidad
    ADD CONSTRAINT fk_empleado_empleado_especialidad FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_empleado_fos_user; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_empleado_fos_user FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_empleado_historial_clinico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_historial_clinico
    ADD CONSTRAINT fk_empleado_historial_clinico FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_empleado_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_empleado_ingreso FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE;


--
-- Name: fk_empleado_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_empleado_lectura FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_nota_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_nota_diagnostico
    ADD CONSTRAINT fk_empleado_nota_diagnostico FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_patron_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT fk_empleado_patron_diagnostico FOREIGN KEY (id_empleado_registra) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_preparacion_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_preparacion_estudio
    ADD CONSTRAINT fk_empleado_preparacion_estudio FOREIGN KEY (id_empleado_registra) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_empleado_procedimiento_realizado FOREIGN KEY (id_tecnologo_realiza) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_solicitud_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_diagnostico
    ADD CONSTRAINT fk_empleado_solicitud_diagnostico FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_empleado_solicitud_estudio FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estabblecimiento_antibioticosportarjeta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticosportarjeta
    ADD CONSTRAINT fk_estabblecimiento_antibioticosportarjeta FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_departamento
    ADD CONSTRAINT fk_establecimiento FOREIGN KEY (id_establecimiento_region) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_area_mod_estab; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_mod_estab
    ADD CONSTRAINT fk_establecimiento_area_mod_estab FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_areasxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_areasxestablecimiento
    ADD CONSTRAINT fk_establecimiento_areasxestablecimiento FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_auditoria_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT fk_establecimiento_auditoria_paciente FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_bloqueo_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_bloqueo_agenda
    ADD CONSTRAINT fk_establecimiento_bloqueo_agenda FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_establecimiento_cita FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_conexion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_conexion
    ADD CONSTRAINT fk_establecimiento_conexion FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_datosfijosresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT fk_establecimiento_datosfijosresultado FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_establecimiento_detalleresultado FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_establecimiento_detallesolicitudestudios FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_diagnosticante_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_establecimiento_diagnosticante_solicitud_estudio FOREIGN KEY (id_establecimiento_diagnosticante) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_elementos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementos
    ADD CONSTRAINT fk_establecimiento_elementos FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_empleado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_establecimiento_empleado FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_esp_area_mod_estab; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_aten_area_mod_estab
    ADD CONSTRAINT fk_establecimiento_esp_area_mod_estab FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT fk_establecimiento_establecimiento FOREIGN KEY (id_establecimiento_padre) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_estudio_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_estudio_paciente
    ADD CONSTRAINT fk_establecimiento_estudio_paciente FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_expediente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT fk_establecimiento_expediente FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_expediente_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_expediente_establecimiento
    ADD CONSTRAINT fk_establecimiento_expediente_establecimiento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_expediente_ficticio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_expediente_ficticio
    ADD CONSTRAINT fk_establecimiento_expediente_ficticio FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_externo_solicitudestudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_establecimiento_externo_solicitudestudio FOREIGN KEY (id_establecimiento_externo) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_formulariosxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_formulariosxestablecimiento
    ADD CONSTRAINT fk_establecimiento_formulariosxestablecimiento FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_fos_user_user; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_establecimiento_fos_user_user FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_establecimiento_lectura FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_material_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material_establecimiento
    ADD CONSTRAINT fk_establecimiento_material_establecimiento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_modalidad_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_modalidad_establecimiento
    ADD CONSTRAINT fk_establecimiento_modalidad_establecimiento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_nota_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_nota_diagnostico
    ADD CONSTRAINT fk_establecimiento_nota_diagnostico FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_paciente_programa; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente_programa_estab
    ADD CONSTRAINT fk_establecimiento_paciente_programa FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_pacs_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_pacs_establecimiento
    ADD CONSTRAINT fk_establecimiento_pacs_establecimiento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_patron_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT fk_establecimiento_patron_diagnostico FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_pendiente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_lectura
    ADD CONSTRAINT fk_establecimiento_pendiente_lectura FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_establecimiento_pendiente_realizacion FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_pendiente_transcripcion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_transcripcion
    ADD CONSTRAINT fk_establecimiento_pendiente_transcripcion FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_pendiente_validacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_validacion
    ADD CONSTRAINT fk_establecimiento_pendiente_validacion FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_preparacion_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_preparacion_estudio
    ADD CONSTRAINT fk_establecimiento_preparacion_estudio FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_establecimiento_procedimiento_realizado FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_procedimientoporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT fk_establecimiento_procedimientoporexamen FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_programa_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_programa_establecimiento
    ADD CONSTRAINT fk_establecimiento_programa_establecimiento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_recepcionmuestra; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_recepcionmuestra
    ADD CONSTRAINT fk_establecimiento_recepcionmuestra FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_referido_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_establecimiento_referido_solicitud_estudio FOREIGN KEY (id_establecimiento_referido) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_resultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_establecimiento_resultados FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_resultadosportarjeta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultadosportarjeta
    ADD CONSTRAINT fk_establecimiento_resultadosportarjeta FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_servicio_externo_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_servicio_externo_establecimiento
    ADD CONSTRAINT fk_establecimiento_servicio_externo_establecimiento FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_solicitud_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_diagnostico
    ADD CONSTRAINT fk_establecimiento_solicitud_diagnostico FOREIGN KEY (id_establecimiento_solicitado) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_establecimiento_solicitud_estudio_complementario FOREIGN KEY (id_establecimiento_solicitado) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_solicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_establecimiento_solicitudestudios FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimientoexterno_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_establecimientoexterno_detallesolicitudestudios FOREIGN KEY (idestablecimientoexterno) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_subelementos
    ADD CONSTRAINT fk_establecimientos FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimientos_tarjetasvitek; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tarjetasvitek
    ADD CONSTRAINT fk_establecimientos_tarjetasvitek FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecmiento_empleado_ext; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_establecmiento_empleado_ext FOREIGN KEY (id_establecimiento_externo) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_estado_cita_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_estado_cita_cita FOREIGN KEY (id_estado_cita) REFERENCES img_ctl_estado_cita(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_civil_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_estado_civil_paciente FOREIGN KEY (id_estado_civil) REFERENCES ctl_estado_civil(id);


--
-- Name: fk_estado_diagnostico_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT fk_estado_diagnostico_diagnostico FOREIGN KEY (id_estado_diagnostico) REFERENCES img_ctl_estado_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_estado_ingreso FOREIGN KEY (id_estado) REFERENCES sec_estado_paciente(id) ON UPDATE CASCADE;


--
-- Name: fk_estado_lectura_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_estado_lectura_lectura FOREIGN KEY (id_estado_lectura) REFERENCES img_ctl_estado_lectura(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_procedimiento_realizado_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_estado_procedimiento_realizado_procedimiento_realizado FOREIGN KEY (id_estado_procedimiento_realizado) REFERENCES img_ctl_estado_procedimiento_realizado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_servicio_apoyo_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_estado_servicio_apoyo_detallesolicitudestudios FOREIGN KEY (estadodetalle) REFERENCES ctl_estado_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_estado_servicio_apoyo_solicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_estado_servicio_apoyo_solicitudestudios FOREIGN KEY (estado) REFERENCES ctl_estado_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_estado_solicitud_solicitud_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_diagnostico
    ADD CONSTRAINT fk_estado_solicitud_solicitud_diagnostico FOREIGN KEY (id_estado_solicitud) REFERENCES img_ctl_estado_solicitud(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_solicitud_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_estado_solicitud_solicitud_estudio FOREIGN KEY (id_estado_solicitud) REFERENCES img_ctl_estado_solicitud(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_solicitud_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_estado_solicitud_solicitud_estudio_complementario FOREIGN KEY (id_estado_solicitud) REFERENCES img_ctl_estado_solicitud(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estandarxgrupo_examen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_examen_servicio_diagnostico
    ADD CONSTRAINT fk_estandarxgrupo_examen FOREIGN KEY (idgrupo) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_estudio_lectura_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura_estudio
    ADD CONSTRAINT fk_estudio_lectura_estudio FOREIGN KEY (id_estudio) REFERENCES img_estudio_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estudio_paciente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_estudio_paciente_lectura FOREIGN KEY (id_estudio) REFERENCES img_estudio_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estudio_paciente_pendiente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_lectura
    ADD CONSTRAINT fk_estudio_paciente_pendiente_lectura FOREIGN KEY (id_estudio) REFERENCES img_estudio_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estudio_paciente_solicitud_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_diagnostico
    ADD CONSTRAINT fk_estudio_paciente_solicitud_diagnostico FOREIGN KEY (id_estudio) REFERENCES img_estudio_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estudio_padre_estudio_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_estudio_paciente
    ADD CONSTRAINT fk_estudio_padre_estudio_paciente FOREIGN KEY (id_estudio_padre) REFERENCES img_estudio_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estudio_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_estudio_solicitud_estudio_complementario FOREIGN KEY (id_estudio_padre) REFERENCES img_estudio_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_examen_codigosxexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_codigosxexamen
    ADD CONSTRAINT fk_examen_codigosxexamen FOREIGN KEY (idestandar) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_datosfijosresultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT fk_examen_datosfijosresultados FOREIGN KEY (idexamen) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_examen_detallesolicitudestudios FOREIGN KEY (idexamen) REFERENCES mnt_area_examen_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_elementos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementos
    ADD CONSTRAINT fk_examen_elementos FOREIGN KEY (idexamen) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_examenesxestablecimiento_reporta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_examenesxestablecimiento
    ADD CONSTRAINT fk_examen_examenesxestablecimiento_reporta FOREIGN KEY (idestandarrep) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_indicacionesporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_indicacionesporexamen
    ADD CONSTRAINT fk_examen_indicacionesporexamen FOREIGN KEY (idexamen) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_insertado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_insertado
    ADD CONSTRAINT fk_examen_insertado FOREIGN KEY (id_examen) REFERENCES rx_examen(id);


--
-- Name: fk_examen_procedimientosporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT fk_examen_procedimientosporexamen FOREIGN KEY (idexamen) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_resultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_examen_resultados FOREIGN KEY (idexamen) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_examen_servicio_diagnostico_proyeccion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion
    ADD CONSTRAINT fk_examen_servicio_diagnostico_proyeccion FOREIGN KEY (id_examen_servicio_diagnostico) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_examen_tipomuestraxexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestraporexamen
    ADD CONSTRAINT fk_examen_tipomuestraxexamen FOREIGN KEY (idexamen) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_expediente_estudio_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_estudio_paciente
    ADD CONSTRAINT fk_expediente_estudio_paciente FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_expediente_ficticio_estudio_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_estudio_paciente
    ADD CONSTRAINT fk_expediente_ficticio_estudio_paciente FOREIGN KEY (id_expediente_ficticio) REFERENCES img_expediente_ficticio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_expediente_ficticio_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_expediente_ficticio_lectura FOREIGN KEY (id_expediente_ficticio) REFERENCES img_expediente_ficticio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_expediente_ficticio_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_expediente_ficticio_solicitud_estudio FOREIGN KEY (id_expediente_ficticio) REFERENCES img_expediente_ficticio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_expediente_historial_clinico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_historial_clinico
    ADD CONSTRAINT fk_expediente_historial_clinico FOREIGN KEY (id_numero_expediente) REFERENCES mnt_expediente(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_expediente_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_expediente_ingreso FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE CASCADE;


--
-- Name: fk_expediente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_expediente_lectura FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_expediente_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_expediente_solicitud_estudio FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_expediente_solicitudestudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_expediente_solicitudestudio FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_farm_catalogoproductos_farm_divisores; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_divisores
    ADD CONSTRAINT fk_farm_catalogoproductos_farm_divisores FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_farm_unidadmedidas_farm_catalogoproductos ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_catalogoproductos
    ADD CONSTRAINT "fk_farm_unidadmedidas_farm_catalogoproductos " FOREIGN KEY (idunidadmedida) REFERENCES farm_unidadmedidas(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_farmacia_farmaciaxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_farmaciaxestablecimiento
    ADD CONSTRAINT fk_farmacia_farmaciaxestablecimiento FOREIGN KEY (idfarmacia) REFERENCES mnt_farmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_farmacia_recetas; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_recetas
    ADD CONSTRAINT fk_farmacia_recetas FOREIGN KEY (idfarmacia) REFERENCES mnt_farmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_farmacia_usuarios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_usuarios
    ADD CONSTRAINT fk_farmacia_usuarios FOREIGN KEY (idfarmacia) REFERENCES mnt_farmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_form_item_form_item_catalogo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_catalogo
    ADD CONSTRAINT fk_form_item_form_item_catalogo FOREIGN KEY (id_form_item) REFERENCES frm_form_item(id) ON DELETE RESTRICT;


--
-- Name: fk_form_item_form_item_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_pool
    ADD CONSTRAINT fk_form_item_form_item_pool FOREIGN KEY (id_form_item) REFERENCES frm_form_item(id) ON DELETE RESTRICT;


--
-- Name: fk_form_item_validacion_form_item; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_validacion_campo_form_item
    ADD CONSTRAINT fk_form_item_validacion_form_item FOREIGN KEY (id_form_item) REFERENCES frm_form_item(id) ON DELETE RESTRICT;


--
-- Name: fk_forma_contacto_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_forma_contacto_solicitud_estudio FOREIGN KEY (id_forma_contacto) REFERENCES img_ctl_forma_contacto(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_formulario_formulario_seccion_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_formulario_seccion_pool
    ADD CONSTRAINT fk_formulario_formulario_seccion_pool FOREIGN KEY (id_formulario) REFERENCES frm_formulario(id) ON DELETE CASCADE;


--
-- Name: fk_formulario_grupo_formulario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_formulario
    ADD CONSTRAINT fk_formulario_grupo_formulario FOREIGN KEY (id_formulario) REFERENCES frm_formulario(id) ON DELETE RESTRICT;


--
-- Name: fk_formulario_grupo_insercion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_insercion
    ADD CONSTRAINT fk_formulario_grupo_insercion FOREIGN KEY (id_formulario) REFERENCES frm_formulario(id) ON DELETE CASCADE;


--
-- Name: fk_formularios_formulariosxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_formulariosxestablecimiento
    ADD CONSTRAINT fk_formularios_formulariosxestablecimiento FOREIGN KEY (idformulario) REFERENCES mnt_formularios(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_antibioticos_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticos
    ADD CONSTRAINT fk_fos_user_user_antibioticos_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_antibioticos_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticos
    ADD CONSTRAINT fk_fos_user_user_antibioticos_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_antibioticosportarjeta_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticosportarjeta
    ADD CONSTRAINT fk_fos_user_user_antibioticosportarjeta_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_antibioticosportarjeta_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticosportarjeta
    ADD CONSTRAINT fk_fos_user_user_antibioticosportarjeta_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_areas_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_area_servicio_diagnostico
    ADD CONSTRAINT fk_fos_user_user_areas_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_areas_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_area_servicio_diagnostico
    ADD CONSTRAINT fk_fos_user_user_areas_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_areasxestablecimiento_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_areasxestablecimiento
    ADD CONSTRAINT fk_fos_user_user_areasxestablecimiento_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_areasxestablecimiento_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_areasxestablecimiento
    ADD CONSTRAINT fk_fos_user_user_areasxestablecimiento_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_bacterias_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_bacterias
    ADD CONSTRAINT fk_fos_user_user_bacterias_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_bacterias_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_bacterias
    ADD CONSTRAINT fk_fos_user_user_bacterias_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_bitacoraexistenciaxarea; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_bitacoramedicinaexistenciaxarea
    ADD CONSTRAINT fk_fos_user_user_bitacoraexistenciaxarea FOREIGN KEY (idpersonal) REFERENCES fos_user_user(id) MATCH FULL;


--
-- Name: fk_fos_user_user_cantidadestincion_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_cantidadestincion
    ADD CONSTRAINT fk_fos_user_user_cantidadestincion_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_cantidadestincion_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_cantidadestincion
    ADD CONSTRAINT fk_fos_user_user_cantidadestincion_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_cit_distribucion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT fk_fos_user_user_cit_distribucion FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_cit_programacion_exams; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_programacion_exams
    ADD CONSTRAINT fk_fos_user_user_cit_programacion_exams FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_cit_tipocita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_tipocita
    ADD CONSTRAINT fk_fos_user_user_cit_tipocita FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_codigosestandar_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_examen_servicio_diagnostico
    ADD CONSTRAINT fk_fos_user_user_codigosestandar_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_codigosestandar_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_examen_servicio_diagnostico
    ADD CONSTRAINT fk_fos_user_user_codigosestandar_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_datosfijosresultado_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT fk_fos_user_user_datosfijosresultado_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_datosfijosresultado_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT fk_fos_user_user_datosfijosresultado_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_detallesolicitudestudios_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_fos_user_user_detallesolicitudestudios_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_elementos_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementos
    ADD CONSTRAINT fk_fos_user_user_elementos_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_elementos_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementos
    ADD CONSTRAINT fk_fos_user_user_elementos_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_estandarxgrupo_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_estandarxgrupo
    ADD CONSTRAINT fk_fos_user_user_estandarxgrupo_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_estandarxgrupo_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_estandarxgrupo
    ADD CONSTRAINT fk_fos_user_user_estandarxgrupo_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_examenesxestablecimiento_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_examenesxestablecimiento
    ADD CONSTRAINT fk_fos_user_user_examenesxestablecimiento_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_examenesxestablecimiento_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_examenesxestablecimiento
    ADD CONSTRAINT fk_fos_user_user_examenesxestablecimiento_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_formulariosxestablecimiento_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_formulariosxestablecimiento
    ADD CONSTRAINT fk_fos_user_user_formulariosxestablecimiento_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_formulariosxestablecimiento_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_formulariosxestablecimiento
    ADD CONSTRAINT fk_fos_user_user_formulariosxestablecimiento_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_indicacionxexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_indicacionesporexamen
    ADD CONSTRAINT fk_fos_user_user_indicacionxexamen FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_fos_user_user_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_mod_cit_distribucion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT fk_fos_user_user_mod_cit_distribucion FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_modifica_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_fos_user_user_modifica_ingreso FOREIGN KEY (id_usuario_modifica) REFERENCES fos_user_user(id) ON UPDATE CASCADE;


--
-- Name: fk_fos_user_user_observaciones_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_observaciones
    ADD CONSTRAINT fk_fos_user_user_observaciones_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_observaciones_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_observaciones
    ADD CONSTRAINT fk_fos_user_user_observaciones_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_origenmuestra_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_origenmuestra
    ADD CONSTRAINT fk_fos_user_user_origenmuestra_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_origenmuestra_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_origenmuestra
    ADD CONSTRAINT fk_fos_user_user_origenmuestra_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_procedimientosporexamen_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT fk_fos_user_user_procedimientosporexamen_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_procedimientosporexamen_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT fk_fos_user_user_procedimientosporexamen_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_rangoedad_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_rango_edad
    ADD CONSTRAINT fk_fos_user_user_rangoedad_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_rangoedad_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_rango_edad
    ADD CONSTRAINT fk_fos_user_user_rangoedad_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_recepcionmuestra_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_recepcionmuestra
    ADD CONSTRAINT fk_fos_user_user_recepcionmuestra_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_fos_user_user_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_reg_cit_citas_diaa; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_fos_user_user_reg_cit_citas_diaa FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_reg_cit_citas_serviciodeapoyo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_serviciodeapoyo
    ADD CONSTRAINT fk_fos_user_user_reg_cit_citas_serviciodeapoyo FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_reg_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_fos_user_user_reg_cit_citasprocedimientos FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_reg_cit_estado_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_estado_cita
    ADD CONSTRAINT fk_fos_user_user_reg_cit_estado_cita FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_reg_cit_evento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT fk_fos_user_user_reg_cit_evento FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_reg_indicacionxexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_indicacionesporexamen
    ADD CONSTRAINT fk_fos_user_user_reg_indicacionxexamen FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_registra_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_fos_user_user_registra_ingreso FOREIGN KEY (id_usuario_registra) REFERENCES fos_user_user(id) ON UPDATE CASCADE;


--
-- Name: fk_fos_user_user_sec_historial_clinico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_historial_clinico
    ADD CONSTRAINT fk_fos_user_user_sec_historial_clinico FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_solicitudestudios_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_fos_user_user_solicitudestudios_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_tarjatasvitek_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tarjetasvitek
    ADD CONSTRAINT fk_fos_user_user_tarjatasvitek_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_tarjatasvitek_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tarjetasvitek
    ADD CONSTRAINT fk_fos_user_user_tarjatasvitek_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_tipomuestra_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestra
    ADD CONSTRAINT fk_fos_user_user_tipomuestra_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_tipomuestra_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestra
    ADD CONSTRAINT fk_fos_user_user_tipomuestra_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_tipomuestraporexamen_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestraporexamen
    ADD CONSTRAINT fk_fos_user_user_tipomuestraporexamen_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_tipomuestraporexamen_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestraporexamen
    ADD CONSTRAINT fk_fos_user_user_tipomuestraporexamen_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_fos_user_user_usuario_modifica; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_emergencia
    ADD CONSTRAINT fk_fos_user_user_usuario_modifica FOREIGN KEY (id_usuario_modifica) REFERENCES fos_user_user(id) ON UPDATE CASCADE;


--
-- Name: fk_fos_user_user_usuario_registra; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_emergencia
    ADD CONSTRAINT fk_fos_user_user_usuario_registra FOREIGN KEY (id_usuario_registra) REFERENCES fos_user_user(id) ON UPDATE CASCADE;


--
-- Name: fk_frm_form_item_frm_seccion_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_seccion_item
    ADD CONSTRAINT fk_frm_form_item_frm_seccion_pool FOREIGN KEY (id_form_item_pool) REFERENCES frm_form_item_pool(id) ON DELETE RESTRICT;


--
-- Name: fk_frm_seccion_pool_frm_seccion_item; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_seccion_item
    ADD CONSTRAINT fk_frm_seccion_pool_frm_seccion_item FOREIGN KEY (id_formulario_seccion_pool) REFERENCES frm_formulario_seccion_pool(id) ON DELETE RESTRICT;


--
-- Name: fk_grupo_insercion_dependiente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_insercion_dependencia
    ADD CONSTRAINT fk_grupo_insercion_dependiente FOREIGN KEY (id_grupo_insercion_dependiente) REFERENCES frm_grupo_insercion(id) ON DELETE CASCADE;


--
-- Name: fk_grupo_insercion_frm_seccion_item; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_seccion_item
    ADD CONSTRAINT fk_grupo_insercion_frm_seccion_item FOREIGN KEY (id_grupo_insercion) REFERENCES frm_grupo_insercion(id) ON DELETE CASCADE;


--
-- Name: fk_grupo_insercion_padre; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_insercion_dependencia
    ADD CONSTRAINT fk_grupo_insercion_padre FOREIGN KEY (id_grupo_insercion_padre) REFERENCES frm_grupo_insercion(id) ON DELETE CASCADE;


--
-- Name: fk_grupo_insercion_parametro; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_insercion_parametro
    ADD CONSTRAINT fk_grupo_insercion_parametro FOREIGN KEY (id_grupo_insercion) REFERENCES frm_grupo_insercion(id) ON DELETE CASCADE;


--
-- Name: fk_grupo_material_subgrupo_material; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_subgrupo_material
    ADD CONSTRAINT fk_grupo_material_subgrupo_material FOREIGN KEY (id_grupo_material) REFERENCES img_ctl_grupo_material(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_historial_clinico_solicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_historial_clinico_solicitudestudios FOREIGN KEY (id_historial_clinico) REFERENCES sec_historial_clinico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_item_catalogo_item_catalogo_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_item_catalogo_reg
    ADD CONSTRAINT fk_item_catalogo_item_catalogo_reg FOREIGN KEY (id_form_item_catalogo) REFERENCES frm_form_item_catalogo(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: fk_lab_elementos_lab_subelementos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_subelementos
    ADD CONSTRAINT fk_lab_elementos_lab_subelementos FOREIGN KEY (idelemento) REFERENCES lab_elementos(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_lab_examen_establecimiento_cit_programacion_examen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_programacion_exams
    ADD CONSTRAINT fk_lab_examen_establecimiento_cit_programacion_examen FOREIGN KEY (id_examen_establecimiento) REFERENCES lab_examenesxestablecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_lectura_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT fk_lectura_diagnostico FOREIGN KEY (id_lectura) REFERENCES img_lectura(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_lectura_lectura_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura_estudio
    ADD CONSTRAINT fk_lectura_lectura_estudio FOREIGN KEY (id_lectura) REFERENCES img_lectura(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_lectura_pendiente_transcripcion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_transcripcion
    ADD CONSTRAINT fk_lectura_pendiente_transcripcion FOREIGN KEY (id_lectura) REFERENCES img_lectura(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_lotes_ajustes; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_ajustes
    ADD CONSTRAINT fk_lotes_ajustes FOREIGN KEY (idlote) REFERENCES farm_lotes(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_lotes_bitacoramedicinaexistenciaxarea; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_bitacoramedicinaexistenciaxarea
    ADD CONSTRAINT fk_lotes_bitacoramedicinaexistenciaxarea FOREIGN KEY (idlote) REFERENCES farm_lotes(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_lotes_medicinadespachada ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinadespachada
    ADD CONSTRAINT "fk_lotes_medicinadespachada " FOREIGN KEY (idlote) REFERENCES farm_lotes(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_lotes_medicinaexistenciaxarea ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinaexistenciaxarea
    ADD CONSTRAINT "fk_lotes_medicinaexistenciaxarea " FOREIGN KEY (idlote) REFERENCES farm_lotes(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_lotes_medicinavencida; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinavencida
    ADD CONSTRAINT fk_lotes_medicinavencida FOREIGN KEY (idlote) REFERENCES farm_lotes(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_material_material_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material_establecimiento
    ADD CONSTRAINT fk_material_material_establecimiento FOREIGN KEY (id_material) REFERENCES img_ctl_material(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_material_material_utilizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_material_utilizado
    ADD CONSTRAINT fk_material_material_utilizado FOREIGN KEY (id_material) REFERENCES img_ctl_material(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_medicinaexistenciaxarea_ajustes; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_ajustes
    ADD CONSTRAINT fk_medicinaexistenciaxarea_ajustes FOREIGN KEY (idexistencia) REFERENCES farm_medicinaexistenciaxarea(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_medicinarecetada_medicinadespachada; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinadespachada
    ADD CONSTRAINT fk_medicinarecetada_medicinadespachada FOREIGN KEY (idmedicinarecetada) REFERENCES farm_medicinarecetada(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_mnt_area_farmacia_fos_user_user; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_mnt_area_farmacia_fos_user_user FOREIGN KEY (id_area) REFERENCES mnt_areafarmacia(id);


--
-- Name: fk_mnt_area_mod_estab_cit_citas_dia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_mnt_area_mod_estab_cit_citas_dia FOREIGN KEY (id_area_mod_estab) REFERENCES mnt_area_mod_estab(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_area_mod_estab_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_mnt_area_mod_estab_cit_citasprocedimientos FOREIGN KEY (id_area_mod_estab) REFERENCES mnt_area_mod_estab(id);


--
-- Name: fk_mnt_area_mod_estab_cit_distribucion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT fk_mnt_area_mod_estab_cit_distribucion FOREIGN KEY (id_area_mod_estab) REFERENCES mnt_area_mod_estab(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_area_mod_estab_cit_evento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT fk_mnt_area_mod_estab_cit_evento FOREIGN KEY (id_area_mod_estab) REFERENCES mnt_area_mod_estab(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_area_mod_estab_fos_user_user; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_mnt_area_mod_estab_fos_user_user FOREIGN KEY (id_area_mod_estab) REFERENCES mnt_area_mod_estab(id);


--
-- Name: fk_mnt_area_mod_estab_mnt_procedimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_procedimiento_establecimiento
    ADD CONSTRAINT fk_mnt_area_mod_estab_mnt_procedimiento_establecimiento FOREIGN KEY (id_area_mod_estab) REFERENCES mnt_area_mod_estab(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_areafarmacia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_areamedicina
    ADD CONSTRAINT fk_mnt_areafarmacia FOREIGN KEY (idarea) REFERENCES mnt_areafarmacia(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_mnt_areafarmacia_mnt_areafarmaciaxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_areafarmaciaxestablecimiento
    ADD CONSTRAINT fk_mnt_areafarmacia_mnt_areafarmaciaxestablecimiento FOREIGN KEY (idarea) REFERENCES mnt_areafarmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_mnt_aten_area_mod_estab_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_mnt_aten_area_mod_estab_cit_citasprocedimientos FOREIGN KEY (id_aten_area_mod_estab) REFERENCES mnt_aten_area_mod_estab(id);


--
-- Name: fk_mnt_aten_area_mod_estab_cit_programacion_exams; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_programacion_exams
    ADD CONSTRAINT fk_mnt_aten_area_mod_estab_cit_programacion_exams FOREIGN KEY (id_aten_area_mod_estab) REFERENCES mnt_aten_area_mod_estab(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_aten_area_mod_estab_citas; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_mnt_aten_area_mod_estab_citas FOREIGN KEY (id_aten_area_mod_estab) REFERENCES mnt_aten_area_mod_estab(id);


--
-- Name: fk_mnt_aten_area_mod_estab_mnt_especialidad; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado_especialidad_estab
    ADD CONSTRAINT fk_mnt_aten_area_mod_estab_mnt_especialidad FOREIGN KEY (id_aten_area_mod_estab) REFERENCES mnt_aten_area_mod_estab(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_aten_area_mod_estab_sec_historial_clinico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_historial_clinico
    ADD CONSTRAINT fk_mnt_aten_area_mod_estab_sec_historial_clinico FOREIGN KEY (idsubservicio) REFERENCES mnt_aten_area_mod_estab(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_ciq_mnt_procedimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_procedimiento_establecimiento
    ADD CONSTRAINT fk_mnt_ciq_mnt_procedimiento_establecimiento FOREIGN KEY (id_ciq) REFERENCES mnt_ciq(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_ciq_sec_detalleprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detalleprocedimientos
    ADD CONSTRAINT fk_mnt_ciq_sec_detalleprocedimientos FOREIGN KEY (idciq) REFERENCES mnt_ciq(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_condicionegreso_sec_egresos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_egresos
    ADD CONSTRAINT fk_mnt_condicionegreso_sec_egresos FOREIGN KEY (idcondicion) REFERENCES mnt_condicionegreso(idcondicion);


--
-- Name: fk_mnt_empleado_cit_citas_dia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_mnt_empleado_cit_citas_dia FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_empleado_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_mnt_empleado_cit_citasprocedimientos FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_empleado_mnt_especialidad; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado_especialidad_estab
    ADD CONSTRAINT fk_mnt_empleado_mnt_especialidad FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_empleado_mnt_procedimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_procedimiento_establecimiento
    ADD CONSTRAINT fk_mnt_empleado_mnt_procedimiento_establecimiento FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_empleados_cit_distribucion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT fk_mnt_empleados_cit_distribucion FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id);


--
-- Name: fk_mnt_empleados_cit_evento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT fk_mnt_empleados_cit_evento FOREIGN KEY (idempleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_empleados_sec_ingresos_historial_usuariomod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingresos_historial
    ADD CONSTRAINT fk_mnt_empleados_sec_ingresos_historial_usuariomod FOREIGN KEY (idusuariomod) REFERENCES mnt_empleado(id);


--
-- Name: fk_mnt_empleados_sec_ingresos_historial_usuarioreg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingresos_historial
    ADD CONSTRAINT fk_mnt_empleados_sec_ingresos_historial_usuarioreg FOREIGN KEY (idusuarioreg) REFERENCES mnt_empleado(id);


--
-- Name: fk_mnt_establecimiento_sec_historial_clinico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_historial_clinico
    ADD CONSTRAINT fk_mnt_establecimiento_sec_historial_clinico FOREIGN KEY (idestablecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_mnt_expediente_cit_citas_dia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_mnt_expediente_cit_citas_dia FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_expediente_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_mnt_expediente_cit_citasprocedimientos FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id);


--
-- Name: fk_mnt_expediente_sec_incapacidadmedica; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_incapacidadmedica
    ADD CONSTRAINT fk_mnt_expediente_sec_incapacidadmedica FOREIGN KEY (idnumeroexp) REFERENCES mnt_expediente(numero);


--
-- Name: fk_mnt_expediente_sec_ingresos_historial; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingresos_historial
    ADD CONSTRAINT fk_mnt_expediente_sec_ingresos_historial FOREIGN KEY (idnumeroexp) REFERENCES mnt_expediente(numero);


--
-- Name: fk_mnt_expediente_sechistorial_clinico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_historial_clinico
    ADD CONSTRAINT fk_mnt_expediente_sechistorial_clinico FOREIGN KEY (idnumeroexp) REFERENCES mnt_expediente(numero);


--
-- Name: fk_mnt_farmacia_mnt_areafarmacia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_areafarmacia
    ADD CONSTRAINT fk_mnt_farmacia_mnt_areafarmacia FOREIGN KEY (idfarmacia) REFERENCES mnt_farmacia(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_mnt_modalidad_establecimiento_fos_user_user; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_mnt_modalidad_establecimiento_fos_user_user FOREIGN KEY (id_modalidad_estab) REFERENCES mnt_modalidad_establecimiento(id);


--
-- Name: fk_mnt_procedimiento_establecimiento_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_mnt_procedimiento_establecimiento_cit_citasprocedimientos FOREIGN KEY (id_ciq_establecimiento) REFERENCES mnt_procedimiento_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_procedimiento_establecimiento_cit_evento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT fk_mnt_procedimiento_establecimiento_cit_evento FOREIGN KEY (id_ciq_establecimiento) REFERENCES mnt_procedimiento_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_rango_hora_cit_evento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_evento
    ADD CONSTRAINT fk_mnt_rango_hora_cit_evento FOREIGN KEY (id_rangohora) REFERENCES mnt_rangohora(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_rango_hora_mnt_procedimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_procedimiento_establecimiento
    ADD CONSTRAINT fk_mnt_rango_hora_mnt_procedimiento_establecimiento FOREIGN KEY (id_rangohora) REFERENCES mnt_rangohora(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_rangohora_cit_citas_dia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_dia
    ADD CONSTRAINT fk_mnt_rangohora_cit_citas_dia FOREIGN KEY (id_rangohora) REFERENCES mnt_rangohora(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_rangohora_cit_citasprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citasprocedimientos
    ADD CONSTRAINT fk_mnt_rangohora_cit_citasprocedimientos FOREIGN KEY (id_rangohora) REFERENCES mnt_rangohora(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_rangohoras_cit_distribucion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_distribucion
    ADD CONSTRAINT fk_mnt_rangohoras_cit_distribucion FOREIGN KEY (id_rangohora) REFERENCES mnt_rangohora(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_mnt_tiposdiagnosticos_sec_detallediagnosticos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallediagnosticos
    ADD CONSTRAINT fk_mnt_tiposdiagnosticos_sec_detallediagnosticos FOREIGN KEY (idtipodiagnostico) REFERENCES mnt_tiposdiagnosticos(idtipodiagnostico);


--
-- Name: fk_mnt_usuarios_sec_egresos_usuariomodifica; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_egresos
    ADD CONSTRAINT fk_mnt_usuarios_sec_egresos_usuariomodifica FOREIGN KEY (idusuariomod) REFERENCES mnt_usuarios(id);


--
-- Name: fk_mnt_usuarios_sec_egresos_usuarioreg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_egresos
    ADD CONSTRAINT fk_mnt_usuarios_sec_egresos_usuarioreg FOREIGN KEY (idusuarioreg) REFERENCES mnt_empleado(id);


--
-- Name: fk_modalidad_estab_area_mod_estab; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_mod_estab
    ADD CONSTRAINT fk_modalidad_estab_area_mod_estab FOREIGN KEY (id_modalidad_estab) REFERENCES mnt_modalidad_establecimiento(id);


--
-- Name: fk_modalidad_modalidad_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_modalidad_establecimiento
    ADD CONSTRAINT fk_modalidad_modalidad_establecimiento FOREIGN KEY (id_modalidad) REFERENCES ctl_modalidad(id);


--
-- Name: fk_motor_bd_pacs_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_pacs_establecimiento
    ADD CONSTRAINT fk_motor_bd_pacs_establecimiento FOREIGN KEY (id_motor) REFERENCES img_ctl_motor_bd(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_municipio_auditoria_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT fk_municipio_auditoria_paciente FOREIGN KEY (id_municipio_domicilio) REFERENCES ctl_municipio(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_municipio_canton; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_canton
    ADD CONSTRAINT fk_municipio_canton FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id);


--
-- Name: fk_municipio_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT fk_municipio_establecimiento FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id);


--
-- Name: fk_municipio_paciente_domicilio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_municipio_paciente_domicilio FOREIGN KEY (id_municipio_domicilio) REFERENCES ctl_municipio(id);


--
-- Name: fk_municipio_paciente_nacimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_municipio_paciente_nacimiento FOREIGN KEY (id_municipio_nacimiento) REFERENCES ctl_municipio(id);


--
-- Name: fk_nacionalidad_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_nacionalidad_paciente FOREIGN KEY (id_nacionalidad) REFERENCES ctl_nacionalidad(id);


--
-- Name: fk_observaciones_resultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_observaciones_resultados FOREIGN KEY (id_observacion) REFERENCES lab_observaciones(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_ocupacion_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_ocupacion_paciente FOREIGN KEY (id_ocupacion) REFERENCES ctl_ocupacion(id);


--
-- Name: fk_origenmuestra_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_origenmuestra_detallesolicitudestudios FOREIGN KEY (idorigenmuestra) REFERENCES mnt_origenmuestra(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_paciente_emergencia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_emergencia
    ADD CONSTRAINT fk_paciente_emergencia FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id);


--
-- Name: fk_paciente_expediente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT fk_paciente_expediente FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id);


--
-- Name: fk_paciente_paciente_programa; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente_programa_estab
    ADD CONSTRAINT fk_paciente_paciente_programa FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_padre_form_item_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_pool
    ADD CONSTRAINT fk_padre_form_item_pool FOREIGN KEY (id_padre) REFERENCES frm_form_item_pool(id) ON DELETE CASCADE;


--
-- Name: fk_padre_formulario_seccion_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_formulario_seccion_pool
    ADD CONSTRAINT fk_padre_formulario_seccion_pool FOREIGN KEY (id_padre) REFERENCES frm_formulario_seccion_pool(id) ON DELETE CASCADE;


--
-- Name: fk_pais_departamento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_departamento
    ADD CONSTRAINT fk_pais_departamento FOREIGN KEY (id_pais) REFERENCES ctl_pais(id);


--
-- Name: fk_pais_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_pais_paciente FOREIGN KEY (id_pais_nacimiento) REFERENCES ctl_pais(id);


--
-- Name: fk_parentesco_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_parentesco_cita FOREIGN KEY (id_responsable_autoriza) REFERENCES ctl_parentesco(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_parentesco_paciente_propor_datos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_parentesco_paciente_propor_datos FOREIGN KEY (id_parentesco_propor_datos) REFERENCES ctl_parentesco(id);


--
-- Name: fk_parentesco_paciente_responsable; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_parentesco_paciente_responsable FOREIGN KEY (id_parentesco_responsable) REFERENCES ctl_parentesco(id);


--
-- Name: fk_parentesco_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_parentesco_solicitud_estudio FOREIGN KEY (id_contacto_paciente) REFERENCES ctl_parentesco(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_patron_diagnostico_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT fk_patron_diagnostico_diagnostico FOREIGN KEY (id_patron_aplicado) REFERENCES img_ctl_patron_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_patron_diagnostico_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_patron_diagnostico_lectura FOREIGN KEY (id_patron_asociado) REFERENCES img_ctl_patron_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_plantilla_examenesxestablecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_examenesxestablecimiento
    ADD CONSTRAINT fk_plantilla_examenesxestablecimiento FOREIGN KEY (idplantilla) REFERENCES lab_plantilla(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_prioridad_atencion_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_prioridad_atencion_solicitud_estudio FOREIGN KEY (id_prioridad_atencion) REFERENCES img_ctl_prioridad_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_prioridad_atencion_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_prioridad_atencion_solicitud_estudio_complementario FOREIGN KEY (id_prioridad_atencion) REFERENCES img_ctl_prioridad_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_procedencia_ingreso_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_procedencia_ingreso_ingreso FOREIGN KEY (id_procedencia_ingreso) REFERENCES sec_procedencia_ingreso(id) ON UPDATE CASCADE;


--
-- Name: fk_procedimiento_iniciado_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_procedimiento_iniciado_pendiente_realizacion FOREIGN KEY (id_procedimiento_iniciado) REFERENCES img_procedimiento_realizado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_procedimiento_realizado_estudio_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_estudio_paciente
    ADD CONSTRAINT fk_procedimiento_realizado_estudio_paciente FOREIGN KEY (id_procedimiento_realizado) REFERENCES img_procedimiento_realizado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_procedimiento_realizado_material_utilizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_material_utilizado
    ADD CONSTRAINT fk_procedimiento_realizado_material_utilizado FOREIGN KEY (id_procedimiento_realizado) REFERENCES img_procedimiento_realizado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_procedimientoporexamen_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_procedimientoporexamen_detalleresultado FOREIGN KEY (idprocedimiento) REFERENCES lab_procedimientosporexamen(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_programa_estab_paciente_programa; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente_programa_estab
    ADD CONSTRAINT fk_programa_estab_paciente_programa FOREIGN KEY (id_programa_establecimiento) REFERENCES mnt_programa_establecimiento(id);


--
-- Name: fk_programa_programa_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_programa_establecimiento
    ADD CONSTRAINT fk_programa_programa_establecimiento FOREIGN KEY (id_programa) REFERENCES ctl_programa(id);


--
-- Name: fk_proyeccion_proyeccion_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion_establecimiento
    ADD CONSTRAINT fk_proyeccion_proyeccion_establecimiento FOREIGN KEY (id_proyeccion) REFERENCES img_ctl_proyeccion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_proyeccion_solicitud_estudio_complementario_proyeccion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario_proyeccion
    ADD CONSTRAINT fk_proyeccion_solicitud_estudio_complementario_proyeccion FOREIGN KEY (id_proyeccion_solicitada) REFERENCES img_ctl_proyeccion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_proyeccion_solicitud_estudio_proyeccion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_proyeccion
    ADD CONSTRAINT fk_proyeccion_solicitud_estudio_proyeccion FOREIGN KEY (id_proyeccion_solicitada) REFERENCES img_ctl_proyeccion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_anexa_pendiente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_lectura
    ADD CONSTRAINT fk_radiologo_anexa_pendiente_lectura FOREIGN KEY (id_radiologo_anexa) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_aprueba_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT fk_radiologo_aprueba_diagnostico FOREIGN KEY (id_radiologo_aprueba) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_asignado_pendiente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_lectura
    ADD CONSTRAINT fk_radiologo_asignado_pendiente_lectura FOREIGN KEY (id_radiologo_asignado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_asignado_pendiente_validacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_validacion
    ADD CONSTRAINT fk_radiologo_asignado_pendiente_validacion FOREIGN KEY (id_radiologo_asignado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_bloqueo_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_bloqueo_agenda
    ADD CONSTRAINT fk_radiologo_bloqueo_agenda FOREIGN KEY (id_radiologo_bloqueo) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_define_patron_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT fk_radiologo_define_patron_diagnostico FOREIGN KEY (id_radiologo_define) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_designado_aprobacion_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_radiologo_designado_aprobacion_lectura FOREIGN KEY (id_radiologo_designado_aprobacion) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_exclusion_bloqueo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_exclusion_bloqueo
    ADD CONSTRAINT fk_radiologo_exclusion_bloqueo FOREIGN KEY (id_radiologo_excluido) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_solicita_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_radiologo_solicita_lectura FOREIGN KEY (id_radiologo_solicita) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_radiologo_solicitud_estudio FOREIGN KEY (id_radiologo_agrega_indicaciones) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_radiologo_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_radiologo_solicitud_estudio_complementario FOREIGN KEY (id_radiologo_solicita) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_rango_edad_grupo_formulario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_formulario
    ADD CONSTRAINT fk_rango_edad_grupo_formulario FOREIGN KEY (id_rango_edad) REFERENCES ctl_rango_edad(id) ON DELETE RESTRICT;


--
-- Name: fk_rangoedad_datosfijosresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT fk_rangoedad_datosfijosresultado FOREIGN KEY (idedad) REFERENCES ctl_rango_edad(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_rangoedad_procedimientosporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT fk_rangoedad_procedimientosporexamen FOREIGN KEY (idrangoedad) REFERENCES ctl_rango_edad(id);


--
-- Name: fk_recepcionmuestra_resultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_recepcionmuestra_resultados FOREIGN KEY (idrecepcionmuestra) REFERENCES lab_recepcionmuestra(id);


--
-- Name: fk_recetas_medicinarecetada; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_medicinarecetada
    ADD CONSTRAINT fk_recetas_medicinarecetada FOREIGN KEY (idreceta) REFERENCES farm_recetas(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_registra_emergencia_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_registra_emergencia_pendiente_realizacion FOREIGN KEY (id_registra_emergencia) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_registra_emergencia_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_registra_emergencia_procedimiento_realizado FOREIGN KEY (id_registra_emergencia) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_resultados_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_resultados_detalleresultado FOREIGN KEY (idresultado) REFERENCES lab_resultados(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_sec_circunstancia_ingreso_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_sec_circunstancia_ingreso_ingreso FOREIGN KEY (id_circunstancia_ingreso) REFERENCES sec_circunstancia_ingreso(id) ON UPDATE CASCADE;


--
-- Name: fk_sec_diagnosticos_procedimientos_sec_detallediagnosticos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallediagnosticos
    ADD CONSTRAINT fk_sec_diagnosticos_procedimientos_sec_detallediagnosticos FOREIGN KEY (iddiagnosticosproc) REFERENCES sec_diagnosticos_procedimientos(iddiagnosticosproc);


--
-- Name: fk_sec_diagnosticos_procedimientos_sec_detalleprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detalleprocedimientos
    ADD CONSTRAINT fk_sec_diagnosticos_procedimientos_sec_detalleprocedimientos FOREIGN KEY (iddiagnosticosproc) REFERENCES sec_diagnosticos_procedimientos(iddiagnosticosproc);


--
-- Name: fk_sec_diagnosticos_procedimientos_sec_egresos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_egresos
    ADD CONSTRAINT fk_sec_diagnosticos_procedimientos_sec_egresos FOREIGN KEY (iddiagnosticosproc) REFERENCES sec_diagnosticos_procedimientos(iddiagnosticosproc);


--
-- Name: fk_sec_historial_clinico_sec_antecedentes; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_antecedentes
    ADD CONSTRAINT fk_sec_historial_clinico_sec_antecedentes FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_historial_clinico_sec_diagnosticopaciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_diagnosticospaciente
    ADD CONSTRAINT fk_sec_historial_clinico_sec_diagnosticopaciente FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_historial_clinico_sec_hojaindicacionesconsulta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_hojaindicacionesconsultaexterna
    ADD CONSTRAINT fk_sec_historial_clinico_sec_hojaindicacionesconsulta FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_historial_clinico_sec_incapacidadmedia; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_incapacidadmedica
    ADD CONSTRAINT fk_sec_historial_clinico_sec_incapacidadmedia FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_historial_clinico_sec_motivo_consulta; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_motivo_consulta
    ADD CONSTRAINT fk_sec_historial_clinico_sec_motivo_consulta FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_historial_clinico_sec_referencias; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_referencias
    ADD CONSTRAINT fk_sec_historial_clinico_sec_referencias FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_historial_clinico_sec_signos_vitales; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_signos_vitales
    ADD CONSTRAINT fk_sec_historial_clinico_sec_signos_vitales FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_historial_clinico_segconsultaexterna; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_segconsultaexterna
    ADD CONSTRAINT fk_sec_historial_clinico_segconsultaexterna FOREIGN KEY (idhistorialclinico) REFERENCES sec_historial_clinico(id);


--
-- Name: fk_sec_solicitudestudios_cit_citasxserviciodeapoyo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY cit_citas_serviciodeapoyo
    ADD CONSTRAINT fk_sec_solicitudestudios_cit_citasxserviciodeapoyo FOREIGN KEY (id_solicitudestudios) REFERENCES sec_solicitudestudios(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_sec_tiporeferencia_sec_referencias; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_referencias
    ADD CONSTRAINT fk_sec_tiporeferencia_sec_referencias FOREIGN KEY (idtiporeferencia) REFERENCES sec_tiporeferencia(idtiporeferencia);


--
-- Name: fk_seccion_pool_form_item_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_pool
    ADD CONSTRAINT fk_seccion_pool_form_item_pool FOREIGN KEY (id_seccion_pool) REFERENCES frm_seccion_pool(id) ON DELETE CASCADE;


--
-- Name: fk_seccion_pool_formulario_seccion_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_formulario_seccion_pool
    ADD CONSTRAINT fk_seccion_pool_formulario_seccion_pool FOREIGN KEY (id_seccion_pool) REFERENCES frm_seccion_pool(id) ON DELETE RESTRICT;


--
-- Name: fk_seccion_seccion_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_seccion_pool
    ADD CONSTRAINT fk_seccion_seccion_pool FOREIGN KEY (id_seccion) REFERENCES frm_seccion(id) ON DELETE RESTRICT;


--
-- Name: fk_servicio_externo_estab_area_mod_estab; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_mod_estab
    ADD CONSTRAINT fk_servicio_externo_estab_area_mod_estab FOREIGN KEY (id_servicio_externo_estab) REFERENCES mnt_servicio_externo_establecimiento(id);


--
-- Name: fk_servicio_externo_servicio_externo_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_servicio_externo_establecimiento
    ADD CONSTRAINT fk_servicio_externo_servicio_externo_establecimiento FOREIGN KEY (id_servicio_externo) REFERENCES mnt_servicio_externo(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_sexo__paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_sexo__paciente FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id);


--
-- Name: fk_sexo_datosfijosresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_datosfijosresultado
    ADD CONSTRAINT fk_sexo_datosfijosresultado FOREIGN KEY (idsexo) REFERENCES ctl_sexo(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_sexo_examen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_examen_servicio_diagnostico
    ADD CONSTRAINT fk_sexo_examen FOREIGN KEY (idsexo) REFERENCES ctl_sexo(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_sexo_grupo_formulario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_grupo_formulario
    ADD CONSTRAINT fk_sexo_grupo_formulario FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id) ON DELETE RESTRICT;


--
-- Name: fk_sexo_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT fk_sexo_paciente FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_sexo_procedimientosporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_procedimientosporexamen
    ADD CONSTRAINT fk_sexo_procedimientosporexamen FOREIGN KEY (idsexo) REFERENCES ctl_sexo(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_sexo_programa; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_programa
    ADD CONSTRAINT fk_sexo_programa FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id);


--
-- Name: fk_solicitud_diagnostico_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_solicitud_diagnostico_lectura FOREIGN KEY (id_solicitud_diagnostico) REFERENCES img_solicitud_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_diagnostico_pendiente_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_lectura
    ADD CONSTRAINT fk_solicitud_diagnostico_pendiente_lectura FOREIGN KEY (id_solicitud_diagnostico) REFERENCES img_solicitud_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_solicitud_estudio_cita FOREIGN KEY (id_solicitud_estudio) REFERENCES img_solicitud_estudio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_complementario_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_solicitud_estudio_complementario_pendiente_realizacion FOREIGN KEY (id_solicitud_estudio_complementario) REFERENCES img_solicitud_estudio_complementario(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_complementario_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_solicitud_estudio_complementario_procedimiento_realizado FOREIGN KEY (id_solicitud_estudio_complementario) REFERENCES img_solicitud_estudio_complementario(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_solicitud_estudio_pendiente_realizacion FOREIGN KEY (id_solicitud_estudio) REFERENCES img_solicitud_estudio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_solicitud_estudio_procedimiento_realizado FOREIGN KEY (id_solicitud_estudio) REFERENCES img_solicitud_estudio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_solicitud_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_diagnostico
    ADD CONSTRAINT fk_solicitud_estudio_solicitud_diagnostico FOREIGN KEY (id_solicitud_estudio) REFERENCES img_solicitud_estudio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_solicitud_estudio_solicitud_estudio_complementario FOREIGN KEY (id_solicitud_estudio) REFERENCES img_solicitud_estudio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_estudio_solicitud_estudio_proyeccion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_proyeccion
    ADD CONSTRAINT fk_solicitud_estudio_solicitud_estudio_proyeccion FOREIGN KEY (id_solicitud_estudio) REFERENCES img_solicitud_estudio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitud_solicitud_estudio_complementario_proyeccion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario_proyeccion
    ADD CONSTRAINT fk_solicitud_solicitud_estudio_complementario_proyeccion FOREIGN KEY (id_solicitud_estudio_complementario) REFERENCES img_solicitud_estudio_complementario(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solicitudes_resultados; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_resultados
    ADD CONSTRAINT fk_solicitudes_resultados FOREIGN KEY (idsolicitudestudio) REFERENCES sec_solicitudestudios(id);


--
-- Name: fk_solicitudestudio_recepcionmuestra; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_recepcionmuestra
    ADD CONSTRAINT fk_solicitudestudio_recepcionmuestra FOREIGN KEY (idsolicitudestudio) REFERENCES sec_solicitudestudios(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_solicitudestudios_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_solicitudestudios_detallesolicitudestudios FOREIGN KEY (idsolicitudestudio) REFERENCES sec_solicitudestudios(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_solicitudestudios_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_solicitudestudios_solicitud_estudio FOREIGN KEY (id_solicitudestudios) REFERENCES sec_solicitudestudios(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_subelementos_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_subelementos_detalleresultado FOREIGN KEY (idsubelemento) REFERENCES lab_subelementos(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_subgrupo_material_material; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material
    ADD CONSTRAINT fk_subgrupo_material_material FOREIGN KEY (id_subgrupo_material) REFERENCES img_ctl_subgrupo_material(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tabla_campo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_campo
    ADD CONSTRAINT fk_tabla_campo FOREIGN KEY (id_tabla) REFERENCES ctl_tabla(id) ON DELETE RESTRICT;


--
-- Name: fk_tamanio_pelicula_rechazada; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY rx_rechazada
    ADD CONSTRAINT fk_tamanio_pelicula_rechazada FOREIGN KEY (id_tamanio_pelicula) REFERENCES rx_tamanio_pelicula(id);


--
-- Name: fk_tarjeta_detalleresultado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_detalleresultado
    ADD CONSTRAINT fk_tarjeta_detalleresultado FOREIGN KEY (idtarjeta) REFERENCES lab_tarjetasvitek(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_tarjetasvitek_antibioticosportarjeta_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_antibioticosportarjeta
    ADD CONSTRAINT fk_tarjetasvitek_antibioticosportarjeta_reg FOREIGN KEY (idtarjeta) REFERENCES lab_tarjetasvitek(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_tecnologo_asignado_pendiente_realizacion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_realizacion
    ADD CONSTRAINT fk_tecnologo_asignado_pendiente_realizacion FOREIGN KEY (id_tecnologo_asignado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tecnologo_programado_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_tecnologo_programado_cita FOREIGN KEY (id_tecnologo_programado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_accidente_ingreso; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_ingreso
    ADD CONSTRAINT fk_tipo_accidente_ingreso FOREIGN KEY (id_tipo_accidente) REFERENCES sec_tipo_accidente(id) ON UPDATE CASCADE;


--
-- Name: fk_tipo_atencion_atencion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_atencion
    ADD CONSTRAINT fk_tipo_atencion_atencion FOREIGN KEY (id_tipo_atencion) REFERENCES ctl_tipo_atencion(id);


--
-- Name: fk_tipo_campo_campo; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_campo
    ADD CONSTRAINT fk_tipo_campo_campo FOREIGN KEY (id_tipo_campo) REFERENCES ctl_tipo_campo(id) ON DELETE RESTRICT;


--
-- Name: fk_tipo_empleado_empleado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_tipo_empleado_empleado FOREIGN KEY (id_tipo_empleado) REFERENCES mnt_tipo_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_tipo_establecimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT fk_tipo_establecimiento_establecimiento FOREIGN KEY (id_tipo_establecimiento) REFERENCES ctl_tipo_establecimiento(id);


--
-- Name: fk_tipo_nota_diagnostico_nota_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_nota_diagnostico
    ADD CONSTRAINT fk_tipo_nota_diagnostico_nota_diagnostico FOREIGN KEY (id_tipo_nota_diagnostico) REFERENCES img_ctl_tipo_nota_diagnostico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_objeto; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item
    ADD CONSTRAINT fk_tipo_objeto FOREIGN KEY (id_tipo_objeto) REFERENCES ctl_tipo_objeto(id);


--
-- Name: fk_tipo_procedimiento_ciq; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_ciq
    ADD CONSTRAINT fk_tipo_procedimiento_ciq FOREIGN KEY (id_tipo_procedimiento) REFERENCES mnt_tipo_procedimiento(id);


--
-- Name: fk_tipo_procedimiento_detalleprocedimientos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detalleprocedimientos
    ADD CONSTRAINT fk_tipo_procedimiento_detalleprocedimientos FOREIGN KEY (id_tipo_procedimiento) REFERENCES mnt_tipo_procedimiento(id);


--
-- Name: fk_tipo_resultado_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_tipo_resultado_lectura FOREIGN KEY (id_tipo_resultado) REFERENCES img_ctl_tipo_resultado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_resultado_patron_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT fk_tipo_resultado_patron_diagnostico FOREIGN KEY (id_tipo_resultado) REFERENCES img_ctl_tipo_resultado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipomuestra_detallesolicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_detallesolicitudestudios
    ADD CONSTRAINT fk_tipomuestra_detallesolicitudestudios FOREIGN KEY (idtipomuestra) REFERENCES lab_tipomuestra(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_tipomuestra_origenmuestra; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_origenmuestra
    ADD CONSTRAINT fk_tipomuestra_origenmuestra FOREIGN KEY (idtipomuestra) REFERENCES lab_tipomuestra(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_tipomuestra_tipomuestraporexamen; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_tipomuestraporexamen
    ADD CONSTRAINT fk_tipomuestra_tipomuestraporexamen FOREIGN KEY (idtipomuestra) REFERENCES lab_tipomuestra(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_tiposolicitud_solicitudestudios; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY sec_solicitudestudios
    ADD CONSTRAINT fk_tiposolicitud_solicitudestudios FOREIGN KEY (idtiposolicitud) REFERENCES lab_tiposolicitud(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_transcriptor_asignado_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_transcriptor_asignado_lectura FOREIGN KEY (id_transcriptor_asignado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_transcriptor_asignado_pendiente_transcripcion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_pendiente_transcripcion
    ADD CONSTRAINT fk_transcriptor_asignado_pendiente_transcripcion FOREIGN KEY (id_transcriptor_asignado) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_auditoria_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_auditoria_paciente
    ADD CONSTRAINT fk_user_auditoria_paciente FOREIGN KEY (id_user) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_mod_bloqueo_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_bloqueo_agenda
    ADD CONSTRAINT fk_user_mod_bloqueo_agenda FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_configuracion_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_configuracion_agenda
    ADD CONSTRAINT fk_user_mod_configuracion_agenda FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT fk_user_mod_diagnostico FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_material; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material
    ADD CONSTRAINT fk_user_mod_material FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_material_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material_establecimiento
    ADD CONSTRAINT fk_user_mod_material_establecimiento FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_pacs_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_pacs_establecimiento
    ADD CONSTRAINT fk_user_mod_pacs_establecimiento FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_patron_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT fk_user_mod_patron_diagnostico FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_preparacion_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_preparacion_estudio
    ADD CONSTRAINT fk_user_mod_preparacion_estudio FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_user_mod_procedimiento_realizado FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_proyeccion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion
    ADD CONSTRAINT fk_user_mod_proyeccion FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_proyeccion_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion_establecimiento
    ADD CONSTRAINT fk_user_mod_proyeccion_establecimiento FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_user_mod_solicitud_estudio FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_paciente; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_user_paciente FOREIGN KEY (id_user) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_paciente_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_user_paciente_mod FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_prg_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_user_prg_cita FOREIGN KEY (id_user_prg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_bloqueo_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_bloqueo_agenda
    ADD CONSTRAINT fk_user_reg_bloqueo_agenda FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_configuracion_agenda; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_configuracion_agenda
    ADD CONSTRAINT fk_user_reg_configuracion_agenda FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_diagnostico
    ADD CONSTRAINT fk_user_reg_diagnostico FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_expediente_ficticio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_expediente_ficticio
    ADD CONSTRAINT fk_user_reg_expediente_ficticio FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_lectura; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_lectura
    ADD CONSTRAINT fk_user_reg_lectura FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_material; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material
    ADD CONSTRAINT fk_user_reg_material FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_material_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_material_establecimiento
    ADD CONSTRAINT fk_user_reg_material_establecimiento FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_nota_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_nota_diagnostico
    ADD CONSTRAINT fk_user_reg_nota_diagnostico FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_pacs_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_pacs_establecimiento
    ADD CONSTRAINT fk_user_reg_pacs_establecimiento FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_patron_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_patron_diagnostico
    ADD CONSTRAINT fk_user_reg_patron_diagnostico FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_preparacion_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_preparacion_estudio
    ADD CONSTRAINT fk_user_reg_preparacion_estudio FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_procedimiento_realizado; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_procedimiento_realizado
    ADD CONSTRAINT fk_user_reg_procedimiento_realizado FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_proyeccion; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion
    ADD CONSTRAINT fk_user_reg_proyeccion FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_proyeccion_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_ctl_proyeccion_establecimiento
    ADD CONSTRAINT fk_user_reg_proyeccion_establecimiento FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_solicitud_diagnostico; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_diagnostico
    ADD CONSTRAINT fk_user_reg_solicitud_diagnostico FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_solicitud_estudio; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio
    ADD CONSTRAINT fk_user_reg_solicitud_estudio FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_solicitud_estudio_complementario; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_solicitud_estudio_complementario
    ADD CONSTRAINT fk_user_reg_solicitud_estudio_complementario FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reprg_cita; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY img_cita
    ADD CONSTRAINT fk_user_reprg_cita FOREIGN KEY (id_user_reprg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_usuarios_ajustes; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_ajustes
    ADD CONSTRAINT fk_usuarios_ajustes FOREIGN KEY (idpersonal) REFERENCES fos_user_user(id) MATCH FULL;


--
-- Name: fk_usuarios_transferenciashospitales; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_transferenciashospitales
    ADD CONSTRAINT fk_usuarios_transferenciashospitales FOREIGN KEY (idpersonal) REFERENCES farm_usuarios(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_validacion_campo_form_item_pool; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_form_item_pool
    ADD CONSTRAINT fk_validacion_campo_form_item_pool FOREIGN KEY (validacion_padre) REFERENCES ctl_validacion_campo(id) ON DELETE RESTRICT;


--
-- Name: fk_validacion_campo_validacion_form_item; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY frm_validacion_campo_form_item
    ADD CONSTRAINT fk_validacion_campo_validacion_form_item FOREIGN KEY (id_validacion_campo) REFERENCES ctl_validacion_campo(id) ON DELETE RESTRICT;


--
-- Name: fp_catalogoproductos; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_areamedicina
    ADD CONSTRAINT fp_catalogoproductos FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: mnt_area_examen_establecimiento_id_area_servicio_apoyo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_examen_establecimiento
    ADD CONSTRAINT mnt_area_examen_establecimiento_id_area_servicio_apoyo_fkey FOREIGN KEY (id_area_servicio_diagnostico) REFERENCES ctl_area_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: mnt_area_examen_establecimiento_id_establecimiento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_examen_establecimiento
    ADD CONSTRAINT mnt_area_examen_establecimiento_id_establecimiento_fkey FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: mnt_area_examen_establecimiento_id_examen_servicio_apoyo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_examen_establecimiento
    ADD CONSTRAINT mnt_area_examen_establecimiento_id_examen_servicio_apoyo_fkey FOREIGN KEY (id_examen_servicio_diagnostico) REFERENCES ctl_examen_servicio_diagnostico(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: mnt_area_examen_establecimiento_id_usuario_mod_fkey; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_examen_establecimiento
    ADD CONSTRAINT mnt_area_examen_establecimiento_id_usuario_mod_fkey FOREIGN KEY (id_usuario_mod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: mnt_area_examen_establecimiento_id_usuario_reg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY mnt_area_examen_establecimiento
    ADD CONSTRAINT mnt_area_examen_establecimiento_id_usuario_reg_fkey FOREIGN KEY (id_usuario_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: pk_catalogoproductos ; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY farm_entregamedicamento
    ADD CONSTRAINT "pk_catalogoproductos " FOREIGN KEY (idmedicina) REFERENCES farm_catalogoproductos(id) MATCH FULL ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: pk_fos_user_user_elementostincion_mod; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementostincion
    ADD CONSTRAINT pk_fos_user_user_elementostincion_mod FOREIGN KEY (idusuariomod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: pk_fos_user_user_elementostincion_reg; Type: FK CONSTRAINT; Schema: public; Owner: simagd
--

ALTER TABLE ONLY lab_elementostincion
    ADD CONSTRAINT pk_fos_user_user_elementostincion_reg FOREIGN KEY (idusuarioreg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: mnt_empleado; Type: ACL; Schema: public; Owner: simagd
--

REVOKE ALL ON TABLE mnt_empleado FROM PUBLIC;
REVOKE ALL ON TABLE mnt_empleado FROM simagd;
GRANT ALL ON TABLE mnt_empleado TO simagd;
GRANT ALL ON TABLE mnt_empleado TO siap;


--
-- PostgreSQL database dump complete
--

