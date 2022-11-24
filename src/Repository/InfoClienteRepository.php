<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * InfoClienteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoClienteRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getClienteCriterioMovil'
     * Método encargado de retornar todos los clientes para el movil según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 26-08-2019
     * 
     * @return array  $arrayCliente
     * 
     */    
    public function getClienteCriterioMovil($arrayParametros)
    {
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $strIdentificacion  = $arrayParametros['strIdentificacion'] ? $arrayParametros['strIdentificacion']:'';
        $strNombres         = $arrayParametros['strNombres'] ? $arrayParametros['strNombres']:'';
        $strApellidos       = $arrayParametros['strApellidos'] ? $arrayParametros['strApellidos']:'';
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $arrayCliente       = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount = new ResultSetMappingBuilder($this->_em);
        $objQueryCount      = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        $strOrder           = ' ORDER BY IC.NOMBRE ASC';
        try
        {
            $strSelect      = "SELECT IC.ID_CLIENTE,IC.USUARIO_ID,IC.TIPO_CLIENTE_PUNTAJE_ID,ATCP.DESCRIPCION AS TIPO_CLIENTE, IC.IDENTIFICACION, IC.NOMBRE,IC.APELLIDO,
                                IC.CORREO,IC.DIRECCION,IC.EDAD,IC.TIPO_COMIDA,IC.GENERO,IC.ESTADO,
                                IC.USR_CREACION,IC.FE_CREACION,IC.USR_MODIFICACION,IC.FE_MODIFICACION,
                                IFNULL(SUM(ICP.CANTIDAD_PUNTOS),0) AS PUNTOS_RESTAURANTES ";
            $strSelectCount = "SELECT COUNT(*) AS CANTIDAD ";
            $strFrom        = "FROM INFO_CLIENTE IC 
                                JOIN ADMI_TIPO_CLIENTE_PUNTAJE ATCP ON ATCP.ID_TIPO_CLIENTE_PUNTAJE=IC.TIPO_CLIENTE_PUNTAJE_ID
                                AND ATCP.ESTADO='ACTIVO'
                                LEFT JOIN INFO_CLIENTE_PUNTO ICP ON IC.ID_CLIENTE = ICP.CLIENTE_ID ";
            $strWhere       = "WHERE IC.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO",$strEstado);
            $objQueryCount->setParameter("ESTADO",$strEstado);
            $strGroup = " GROUP BY IC.ID_CLIENTE,IC.USUARIO_ID,IC.TIPO_CLIENTE_PUNTAJE_ID,TIPO_CLIENTE, IC.IDENTIFICACION, IC.NOMBRE,IC.APELLIDO,
                            IC.CORREO,IC.DIRECCION,IC.EDAD,IC.TIPO_COMIDA,IC.GENERO,IC.ESTADO,
                            IC.USR_CREACION,IC.FE_CREACION,IC.USR_MODIFICACION,IC.FE_MODIFICACION ";
            if(!empty($intIdCliente))
            {
                $strWhere .= " AND IC.ID_CLIENTE =:intIdCliente";
                $objQuery->setParameter("intIdCliente", $intIdCliente);
                $objQueryCount->setParameter("intIdCliente", $intIdCliente);
            }
            if(!empty($strNombres))
            {
                $strWhere .= " AND lower(IC.NOMBRE) like lower(:NOMBRE)";
                $objQuery->setParameter("NOMBRE", '%' . trim($strNombres) . '%');
                $objQueryCount->setParameter("NOMBRE", '%' . trim($strNombres) . '%');
            }
            if(!empty($strApellidos))
            {
                $strWhere .= " AND lower(IC.APELLIDO) like lower(:APELLIDO)";
                $objQuery->setParameter("APELLIDO", '%' . trim($strApellidos) . '%');
                $objQueryCount->setParameter("APELLIDO", '%' . trim($strApellidos) . '%');
            }
            if(!empty($strIdentificacion))
            {
                $strWhere .= " AND IC.IDENTIFICACION =:IDENTIFICACION";
                $objQuery->setParameter("IDENTIFICACION", $strIdentificacion);
                $objQueryCount->setParameter("IDENTIFICACION", $strIdentificacion);
            }
            $objRsmBuilder->addScalarResult('ID_CLIENTE', 'ID_CLIENTE', 'string');
            $objRsmBuilder->addScalarResult('USUARIO_ID', 'USUARIO_ID', 'string');
            $objRsmBuilder->addScalarResult('TIPO_CLIENTE_PUNTAJE_ID', 'TIPO_CLIENTE_PUNTAJE_ID', 'string');
            $objRsmBuilder->addScalarResult('TIPO_CLIENTE', 'TIPO_CLIENTE', 'string');
            $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE', 'NOMBRE', 'string');
            $objRsmBuilder->addScalarResult('APELLIDO', 'APELLIDO', 'string');
            $objRsmBuilder->addScalarResult('CORREO', 'CORREO', 'string');
            $objRsmBuilder->addScalarResult('DIRECCION', 'DIRECCION', 'string');
            $objRsmBuilder->addScalarResult('EDAD', 'EDAD', 'string');
            $objRsmBuilder->addScalarResult('TIPO_COMIDA', 'TIPO_COMIDA', 'string');
            $objRsmBuilder->addScalarResult('GENERO', 'GENERO', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('PUNTOS_RESTAURANTES', 'PUNTOS_RESTAURANTES', 'string');
            $objRsmBuilder->addScalarResult('PUNTOS_GLOBALES', 'PUNTOS_GLOBALES', 'string');
            $objRsmBuilder->addScalarResult('USR_CREACION', 'USR_CREACION', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'date');
            $objRsmBuilder->addScalarResult('USR_MODIFICACION', 'USR_MODIFICACION', 'string');
            $objRsmBuilder->addScalarResult('FE_MODIFICACION', 'FE_MODIFICACION', 'date');
            $objRsmBuilderCount->addScalarResult('CANTIDAD', 'Cantidad', 'integer');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroup.$strOrder;
            $objQuery->setSQL($strSql);
            $strSqlCount  = $strSelectCount.$strFrom.$strWhere;
            $objQueryCount->setSQL($strSqlCount);
            $arrayCliente['cantidad']   = $objQueryCount->getSingleScalarResult();
            $arrayCliente['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCliente['error'] = $strMensajeError;
        return $arrayCliente;
    }
    /**
     * Documentación para la función 'getClienteCriterio'
     * Método encargado de retornar todos los clientes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 26-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 10-11-2019 Se agrega filtro por restaurante.
     * 
     * @author Kevin Baque
     * @version 1.2 23-07-2020  - Se agrega filtro por promocion tipo tenedor de oro.
     *
     * @return array  $arrayCliente
     * 
     */
    public function getClienteCriterio($arrayParametros)
    {
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $intIdRestaurante   = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $strIdentificacion  = $arrayParametros['strIdentificacion'] ? $arrayParametros['strIdentificacion']:'';
        $strNombres         = $arrayParametros['strNombres'] ? $arrayParametros['strNombres']:'';
        $strApellidos       = $arrayParametros['strApellidos'] ? $arrayParametros['strApellidos']:'';
        $strContador        = $arrayParametros['strContador'] ? $arrayParametros['strContador']:'NO';
        $strCupoDisponible  = $arrayParametros['strCupoDisponible'] ? $arrayParametros['strCupoDisponible']:'NO';
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO');
        $strListarCltCupon  = $arrayParametros['strListarCltCupon'] ? $arrayParametros['strListarCltCupon']:'NO';
        $arrayCliente       = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount = new ResultSetMappingBuilder($this->_em);
        $objQueryCount      = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        $strOrder           = ' ORDER BY FECHA_MAXIMA_PROMO DESC, IC.NOMBRE ASC';
        try
        {
            if(!empty($strContador) && $strContador == 'SI')
            {
                $strSelectCount = "SELECT COUNT(*) AS CANTIDAD ";
                $strFromCount   = "FROM INFO_CLIENTE IC ";
                $strWhereCount  = "WHERE IC.ESTADO in (:ESTADO) ";
                $objQueryCount->setParameter("ESTADO", $strEstado);
                $objRsmBuilderCount->addScalarResult('CANTIDAD', 'Cantidad', 'integer');

                $strSqlCount  = $strSelectCount.$strFromCount.$strWhereCount;
                $objQueryCount->setSQL($strSqlCount);
                $arrayCliente['cantidad']   = $objQueryCount->getSingleScalarResult();
            }
            else
            {
                $strSelect      = "SELECT IC.ID_CLIENTE,IC.USUARIO_ID,IC.TIPO_CLIENTE_PUNTAJE_ID, ATCP.DESCRIPCION AS TIPO_CLIENTE, IC.IDENTIFICACION, IC.NOMBRE,IC.APELLIDO,
                                concat(IC.NOMBRE,concat(' ',IC.APELLIDO)) AS NOMBRE_COMPLETO,
                                IC.CORREO,IC.DIRECCION,IC.EDAD,IC.TIPO_COMIDA,IC.GENERO,IC.ESTADO,
                                IC.USR_CREACION,IC.FE_CREACION,IC.USR_MODIFICACION,IC.FE_MODIFICACION  ";
                $strFrom        = "FROM INFO_CLIENTE IC 
                                JOIN ADMI_TIPO_CLIENTE_PUNTAJE ATCP ON ATCP.ID_TIPO_CLIENTE_PUNTAJE=IC.TIPO_CLIENTE_PUNTAJE_ID
                                    AND ATCP.ESTADO='ACTIVO'
                                LEFT JOIN INFO_CLIENTE_PUNTO ICP         ON IC.ID_CLIENTE       = ICP.CLIENTE_ID
                                LEFT JOIN INFO_RESTAURANTE IRES          ON IRES.ID_RESTAURANTE = ICP.RESTAURANTE_ID
                                ";
                $strWhere       = "WHERE IC.ESTADO in (:ESTADO) ";
                $objQuery->setParameter("ESTADO",$strEstado);
                $strGroup = " GROUP BY IC.ID_CLIENTE,IC.USUARIO_ID,IC.TIPO_CLIENTE_PUNTAJE_ID, IC.IDENTIFICACION, IC.NOMBRE,IC.APELLIDO,NOMBRE_COMPLETO,
                            IC.CORREO,IC.DIRECCION,IC.EDAD,IC.TIPO_COMIDA,IC.GENERO,IC.ESTADO,
                            IC.USR_CREACION,IC.FE_CREACION,IC.USR_MODIFICACION,IC.FE_MODIFICACION ";
                if(!empty($strCupoDisponible) && $strCupoDisponible == 'SI')
                {
                    $strSelect .= " ,(SELECT COUNT(ID_CLT_ENCUESTA) FROM INFO_CLIENTE_ENCUESTA WHERE CLIENTE_ID=IC.ID_CLIENTE AND EXTRACT(MONTH FROM FE_CREACION) =EXTRACT(MONTH FROM CURRENT_DATE()) AND ESTADO IN('ACTIVO','PENDIENTE') ) AS CANTIDAD_CUPO ";
                    $objRsmBuilder->addScalarResult('CANTIDAD_CUPO', 'CANTIDAD_CUPO', 'string');
                }
                if(!empty($intIdCliente))
                {
                    $strWhere .= " AND IC.ID_CLIENTE =:intIdCliente";
                    $objQuery->setParameter("intIdCliente", $intIdCliente);
                }
                if(!empty($intIdRestaurante))
                {
                    //$strWhere .= " AND IRES.ID_RESTAURANTE =:intIdRestaurante";
                    $strWhere .= "  AND (IRES.ID_RESTAURANTE =:intIdRestaurante OR :intIdRestaurante in 
                                    (SELECT ipo.RESTAURANTE_ID FROM INFO_CLIENTE_PROMOCION_HISTORIAL icph 
                                     INNER JOIN INFO_PROMOCION ipo on ipo.ID_PROMOCION =icph.PROMOCION_ID 
                                     WHERE icph.ESTADO='PENDIENTE' AND icph.CLIENTE_ID = IC.ID_CLIENTE
                                    )) ";
                    $strSelect .= ",IFNULL(SUM(IF(IRES.ID_RESTAURANTE =:intIdRestaurante, ICP.CANTIDAD_PUNTOS, 0)),0) AS PUNTOS_RESTAURANTES
                                   ,IF((SELECT ipo.RESTAURANTE_ID FROM INFO_CLIENTE_PROMOCION_HISTORIAL icph 
                                    INNER JOIN INFO_PROMOCION ipo on ipo.ID_PROMOCION =icph.PROMOCION_ID 
                                    WHERE icph.ESTADO='PENDIENTE' AND ipo.RESTAURANTE_ID = :intIdRestaurante AND icph.CLIENTE_ID = IC.ID_CLIENTE
                                    AND ipo.PREMIO='SI'
                                    AND ipo.ESTADO='ACTIVO'
                                    LIMIT 1
                                    ) IS NOT NULL, 'SI', 'NO') AS TENEDOR, 
                                    (SELECT MAX(FE_CREACION) FROM INFO_CLIENTE_PROMOCION_HISTORIAL icph
                                        WHERE icph.CLIENTE_ID=IC.ID_CLIENTE AND
                                        icph.ESTADO='PENDIENTE' AND  CASE WHEN :intIdRestaurante IS NOT NULL THEN icph.PROMOCION_ID IN (SELECT ip.ID_PROMOCION  
                                        FROM INFO_PROMOCION ip
                                        INNER JOIN INFO_RESTAURANTE ir ON ip.RESTAURANTE_ID=ir.ID_RESTAURANTE
                                        WHERE ID_RESTAURANTE = :intIdRestaurante)
                                        ELSE TRUE END
                                    ) AS FECHA_MAXIMA_PROMO "
                    ;
                    $objQuery->setParameter("intIdRestaurante", $intIdRestaurante);
                }
                else
                {
                    $strSelect .= ",IFNULL(SUM(ICP.CANTIDAD_PUNTOS),0) AS PUNTOS_RESTAURANTES
                                   ,IF((SELECT ipo.RESTAURANTE_ID FROM INFO_CLIENTE_PROMOCION_HISTORIAL icph 
                                    INNER JOIN INFO_PROMOCION ipo on ipo.ID_PROMOCION =icph.PROMOCION_ID
                                    WHERE icph.ESTADO='PENDIENTE' 
                                    AND icph.CLIENTE_ID = IC.ID_CLIENTE
                                    LIMIT 1
                                    ) IS NOT NULL, 'SI', 'NO') AS TENEDOR,
                                    (SELECT MAX(FE_CREACION) FROM INFO_CLIENTE_PROMOCION_HISTORIAL icph
                                    WHERE icph.CLIENTE_ID=IC.ID_CLIENTE AND
                                    icph.ESTADO='PENDIENTE' AND  CASE WHEN IRES.ID_RESTAURANTE IS NOT NULL THEN icph.PROMOCION_ID IN (SELECT ip.ID_PROMOCION 
                                    FROM INFO_PROMOCION ip
                                    INNER JOIN INFO_RESTAURANTE ir ON ip.RESTAURANTE_ID=ir.ID_RESTAURANTE
                                    WHERE ID_RESTAURANTE = IRES.ID_RESTAURANTE)
                                    ELSE TRUE END
                                ) AS FECHA_MAXIMA_PROMO ";
                }
                if(!empty($strNombres))
                {
                    $strWhere .= " AND lower(IC.NOMBRE) like lower(:NOMBRE)";
                    $objQuery->setParameter("NOMBRE", '%' . trim($strNombres) . '%');
                }
                if(!empty($strApellidos))
                {
                    $strWhere .= " AND lower(IC.APELLIDO) like lower(:APELLIDO)";
                    $objQuery->setParameter("APELLIDO", '%' . trim($strApellidos) . '%');
                }
                if(!empty($strIdentificacion))
                {
                    $strWhere .= " AND IC.IDENTIFICACION =:IDENTIFICACION";
                    $objQuery->setParameter("IDENTIFICACION", $strIdentificacion);
                }
                $objRsmBuilder->addScalarResult('TENEDOR', 'TENEDOR', 'string');
                $objRsmBuilder->addScalarResult('ID_CLIENTE', 'ID_CLIENTE', 'string');
                $objRsmBuilder->addScalarResult('USUARIO_ID', 'USUARIO_ID', 'string');
                $objRsmBuilder->addScalarResult('TIPO_CLIENTE', 'TIPO_CLIENTE', 'string');
                $objRsmBuilder->addScalarResult('TIPO_CLIENTE_PUNTAJE_ID', 'TIPO_CLIENTE_PUNTAJE_ID', 'string');
                $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
                $objRsmBuilder->addScalarResult('NOMBRE', 'NOMBRE', 'string');
                $objRsmBuilder->addScalarResult('APELLIDO', 'APELLIDO', 'string');
                $objRsmBuilder->addScalarResult('NOMBRE_COMPLETO', 'NOMBRE_COMPLETO', 'string');
                $objRsmBuilder->addScalarResult('CORREO', 'CORREO', 'string');
                $objRsmBuilder->addScalarResult('DIRECCION', 'DIRECCION', 'string');
                $objRsmBuilder->addScalarResult('EDAD', 'EDAD', 'string');
                $objRsmBuilder->addScalarResult('TIPO_COMIDA', 'TIPO_COMIDA', 'string');
                $objRsmBuilder->addScalarResult('GENERO', 'GENERO', 'string');
                $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
                $objRsmBuilder->addScalarResult('PUNTOS_RESTAURANTES', 'PUNTOS_RESTAURANTES', 'string');
                $objRsmBuilder->addScalarResult('PUNTOS_GLOBALES', 'PUNTOS_GLOBALES', 'string');
                $objRsmBuilder->addScalarResult('USR_CREACION', 'USR_CREACION', 'string');
                $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'date');
                $objRsmBuilder->addScalarResult('USR_MODIFICACION', 'USR_MODIFICACION', 'string');
                $objRsmBuilder->addScalarResult('FE_MODIFICACION', 'FE_MODIFICACION', 'date');
                $strSql       = $strSelect.$strFrom.$strWhere.$strGroup.$strOrder;
                $objQuery->setSQL($strSql);
                $arrayCliente['resultados'] = $objQuery->getResult();
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCliente['error'] = $strMensajeError;
        return $arrayCliente;
    }

    /**
     * Documentación para la función 'getRegistrosClientes'
     *
     * Método encargado de retornar reporte de registros de clientes
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 12-08-2021
     * 
     * @return array  $arrayRespuesta
     * 
     */
    public function getRegistrosClientes($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO');
        $strMes             = $arrayParametros['strMes'] ? $arrayParametros['strMes']:'';
        $strAnio            = $arrayParametros['strAnio'] ? $arrayParametros['strAnio']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = " SELECT IC.ID_CLIENTE, CONCAT (IC.NOMBRE, CONCAT(' ',IC.APELLIDO)) AS CLIENTE, 
                                IC.GENERO, IC.EDAD AS FECHA_NACIMIENTO,IC.CORREO,IC.ESTADO, IC.FE_CREACION AS FECHA_REGISTRO,
                                IC.AUTENTICACION_RS AS RED_SOCIAL,
                                (CASE WHEN IC.AUTENTICACION_RS != \"S\" && IC.ESTADO != \"ACTIVO\"
                                    THEN CONCAT(\"https://bitte.app:8080/editCliente?jklasdqweuiorenm=e5fe01a83387019b\",IC.ID_CLIENTE)
                                    ELSE \"\" END) AS LINK_ACTIVACION ";
            $strFrom        = " FROM INFO_CLIENTE IC ";
            $strWhere       = " WHERE EXTRACT(MONTH FROM IC.FE_CREACION) = :strMes
                                AND EXTRACT(YEAR  FROM IC.FE_CREACION) = :strAnio
                                AND IC.ESTADO=:strEstado ";
            $strOrderBy     = " ORDER BY NOMBRE ASC ";
            $objQuery->setParameter("strEstado",$strEstado);
            $objQuery->setParameter("strMes", $strMes);
            $objQuery->setParameter("strAnio", $strAnio);
            $objRsmBuilder->addScalarResult('ID_CLIENTE',       'ID_CLIENTE',       'string');
            $objRsmBuilder->addScalarResult('CLIENTE',          'CLIENTE',          'string');
            $objRsmBuilder->addScalarResult('GENERO',           'GENERO',           'string');
            $objRsmBuilder->addScalarResult('FECHA_NACIMIENTO', 'FECHA_NACIMIENTO', 'string');
            $objRsmBuilder->addScalarResult('CORREO',           'CORREO',           'string');
            $objRsmBuilder->addScalarResult('ESTADO',           'ESTADO',           'string');
            $objRsmBuilder->addScalarResult('FECHA_REGISTRO',   'FECHA_REGISTRO',   'string');
            $objRsmBuilder->addScalarResult('RED_SOCIAL',       'RED_SOCIAL',       'string');
            $objRsmBuilder->addScalarResult('LINK_ACTIVACION',  'LINK_ACTIVACION',  'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strOrderBy;
            $objQuery->setSQL($strSql);
            $arrayRespuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        return $arrayRespuesta;
    }

    /**
     * Documentación para la función 'getClientePorCuponCriterio'
     * 
     * Método encargado de retornar todos los clientes con cupones canjeados automáticos según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-11-2022
     *
     * @return array  $arrayCliente
     * 
     */
    public function getClientePorCuponCriterio($arrayParametros)
    {
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $intIdRestaurante   = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $strIdentificacion  = $arrayParametros['strIdentificacion'] ? $arrayParametros['strIdentificacion']:'';
        $strNombres         = $arrayParametros['strNombres'] ? $arrayParametros['strNombres']:'';
        $strApellidos       = $arrayParametros['strApellidos'] ? $arrayParametros['strApellidos']:'';
        $strContador        = $arrayParametros['strContador'] ? $arrayParametros['strContador']:'NO';
        $strCupoDisponible  = $arrayParametros['strCupoDisponible'] ? $arrayParametros['strCupoDisponible']:'NO';
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO');
        $strListarCltCupon  = $arrayParametros['strListarCltCupon'] ? $arrayParametros['strListarCltCupon']:'NO';
        $arrayCliente       = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $strOrder           = ' ORDER BY ICU.FE_CREACION DESC ';
        try
        {
            $strSelect      = "SELECT IC.ID_CLIENTE,
                                      ATCP.DESCRIPCION                 AS TIPO_CLIENTE,
                                      IC.IDENTIFICACION,
                                      CONCAT(IC.NOMBRE, CONCAT(' ', IC.APELLIDO)) AS NOMBRE_COMPLETO,
                                      IC.CORREO,
                                      ICU.CUPON,
                                      IPR.DESCRIPCION_TIPO_PROMOCION AS PROMOCION,
                                      ICPH.ESTADO,
                                      ICU.FE_CREACION,
                                      DATE_FORMAT(ICPC.FE_VIGENCIA,'%Y-%m-%d') AS FE_VIGENCIA ";
            $strFrom        = " FROM INFO_CLIENTE IC
                                    JOIN ADMI_TIPO_CLIENTE_PUNTAJE        ATCP ON ATCP.ID_TIPO_CLIENTE_PUNTAJE = IC.TIPO_CLIENTE_PUNTAJE_ID
                                                                            AND ATCP.ESTADO = 'ACTIVO'
                                    JOIN INFO_CUPON_PROMOCION_CLT         ICPC ON ICPC.CLIENTE_ID=IC.ID_CLIENTE
                                    JOIN INFO_CUPON                       ICU ON ICPC.CUPON_ID = ICU.ID_CUPON
                                    JOIN ADMI_TIPO_CUPON                  ATC ON ATC.ID_TIPO_CUPON = ICU.TIPO_CUPON_ID
                                                                AND ATC.ESTADO = 'ACTIVO'
                                                                AND ATC.DESCRIPCION = 'ENCUESTA'
                                    JOIN INFO_CUPON_HISTORIAL             ICH ON ICH.CUPON_ID = ICU.ID_CUPON
                                                                        AND ICH.ESTADO = 'CANJEADO'
                                    JOIN INFO_PROMOCION                   IPR ON IPR.ID_PROMOCION = ICPC.PROMOCION_ID
                                                                AND IPR.ESTADO = 'ACTIVO'
                                    JOIN ADMI_TIPO_PROMOCION              ATP ON ATP.ID_TIPO_PROMOCION = IPR.TIPO_PROMOCION_ID
                                                                    AND ATP.DESCRIPCION = 'ENCUESTA'
                                                                    AND ATP.ESTADO = 'ACTIVO'
                                    JOIN INFO_CLIENTE_PROMOCION_HISTORIAL ICPH ON ICPH.PROMOCION_ID = IPR.ID_PROMOCION
                                                                                    AND ICPC.CLIENTE_ID = ICPH.CLIENTE_ID ";
            $strWhere       = " WHERE IC.ESTADO IN ( 'ACTIVO', 'INACTIVO' )
                                AND ICPC.ESTADO = 'CANJEADO'
                                AND ICU.ESTADO = 'CANJEADO' ";
            $strGroup       = " GROUP BY IC.ID_CLIENTE,TIPO_CLIENTE,IC.IDENTIFICACION,NOMBRE_COMPLETO,
                                IC.CORREO,ICU.CUPON,PROMOCION,ICPH.ESTADO,ICU.FE_CREACION,ICPC.FE_VIGENCIA ";
            if(!empty($intIdRestaurante))
            {
                $strWhere .= " AND ICH.RESTAURANTE_ID = :intIdRestaurante ";
                $objQuery->setParameter("intIdRestaurante", $intIdRestaurante);
            }
            $objRsmBuilder->addScalarResult('ID_CLIENTE', 'ID_CLIENTE', 'string');
            $objRsmBuilder->addScalarResult('TIPO_CLIENTE', 'TIPO_CLIENTE', 'string');
            $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMPLETO', 'NOMBRE_COMPLETO', 'string');
            $objRsmBuilder->addScalarResult('CORREO', 'CORREO', 'string');
            $objRsmBuilder->addScalarResult('CUPON', 'CUPON', 'string');
            $objRsmBuilder->addScalarResult('PROMOCION', 'PROMOCION', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'string');
            $objRsmBuilder->addScalarResult('FE_VIGENCIA', 'FE_VIGENCIA', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroup.$strOrder;
            $objQuery->setSQL($strSql);
            $arrayCliente['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCliente['error'] = $strMensajeError;
        return $arrayCliente;
    }
}
