<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * InfoSucursalRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoSucursalRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getSucursalCriterio'
     * Método encargado de retornar todos las sucursales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-07-2019
     *
     * @author Kevin Baque
     * @version 1.1 09-06-2021 - Se agrega horario de atención.
     *
     * @return array  $arraySucursal
     * 
     */
    public function getSucursalCriterio($arrayParametros)
    {
        $intIdUsuario          = $arrayParametros['intIdUsuario'] ? $arrayParametros['intIdUsuario']:'';
        $intIdSucursal         = $arrayParametros['intIdSucursal'] ? $arrayParametros['intIdSucursal']:'';
        $strIdRestaurante      = $arrayParametros['strIdRestaurante'] ? $arrayParametros['strIdRestaurante']:'';
        $strIdentificacionRes  = $arrayParametros['strIdentificacionRes'] ? $arrayParametros['strIdentificacionRes']:'';
        $strEsMatriz           = $arrayParametros['strEsMatriz'] ? $arrayParametros['strEsMatriz']:'';
        $strPais               = $arrayParametros['strPais'] ? $arrayParametros['strPais']:'';
        $strProvincia          = $arrayParametros['strProvincia'] ? $arrayParametros['strProvincia']:'';
        $strCiudad             = $arrayParametros['strCiudad'] ? $arrayParametros['strCiudad']:'';
        $strParroquia          = $arrayParametros['strParroquia'] ? $arrayParametros['strParroquia']:'';
        $strEstado             = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $strEstadoFacturacion  = $arrayParametros['strEstadoFacturacion'] ? $arrayParametros['strEstadoFacturacion']:'';
        $arraySucursal         = array();
        $strMensajeError       = '';
        $objRsmBuilder         = new ResultSetMappingBuilder($this->_em);
        $objQuery              = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount    = new ResultSetMappingBuilder($this->_em);
        $objQueryCount         = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        try
        {
            $strSelect      = "SELECT ISUR.ID_SUCURSAL,ISUR.DESCRIPCION,ISUR.ES_MATRIZ,ISUR.EN_CENTRO_COMERCIAL,ISUR.DIRECCION,ISUR.NUMERO_CONTACTO,
                                      IR.IDENTIFICACION,IR.NOMBRE_COMERCIAL, ISUR.RESTAURANTE_ID,ISUR.ESTADO_FACTURACION,ISUR.ESTADO,ISUR.LATITUD,
                                      ISUR.LONGITUD, ISUR.PAIS,ISUR.PROVINCIA,ISUR.CIUDAD,ISUR.PARROQUIA,ISUR.CODIGO_DIARIO,
                                      ISUR.HORA_LUN_VIE_INI,ISUR.HORA_LUN_VIE_FIN,ISUR.HORA_SABADO_INI,ISUR.HORA_SABADO_FIN,ISUR.HORA_DOMINGO_INI,ISUR.HORA_DOMINGO_FIN,
                                      ISUR.USR_CREACION, ISUR.FE_CREACION,ISUR.USR_MODIFICACION,ISUR.FE_MODIFICACION ";
            $strSelectCount = "SELECT COUNT(*) AS CANTIDAD ";
            $strFrom        = "FROM INFO_SUCURSAL ISUR
                               JOIN INFO_RESTAURANTE IR  ON IR.ID_RESTAURANTE = ISUR.RESTAURANTE_ID ";
            $strWhere       = "WHERE ISUR.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO", $strEstado);
            $objQueryCount->setParameter("ESTADO", $strEstado);
            if(!empty($intIdSucursal))
            {
                $strWhere .= " AND ISUR.ID_SUCURSAL =:ID_SUCURSAL";
                $objQuery->setParameter("ID_SUCURSAL", $intIdSucursal);
                $objQueryCount->setParameter("ID_SUCURSAL", $intIdSucursal);
            }
            if(!empty($strEstadoFacturacion))
            {
                $strWhere .= " AND ISUR.ESTADO_FACTURACION =:strEstadoFacturacion";
                $objQuery->setParameter("strEstadoFacturacion", $strEstadoFacturacion);
                $objQueryCount->setParameter("strEstadoFacturacion", $strEstadoFacturacion);
            }
            if(!empty($intIdUsuario))
            {
                $strFrom  .= " JOIN INFO_USUARIO_RES IUR ON IUR.RESTAURANTE_ID= IR.ID_RESTAURANTE ";
                $strWhere .= " AND IUR.USUARIO_ID =:USUARIO_ID";
                $objQuery->setParameter("USUARIO_ID", $intIdUsuario);
                $objQueryCount->setParameter("USUARIO_ID", $intIdUsuario);
            }
            if(!empty($strEsMatriz))
            {
                $strWhere .= " AND ISUR.ES_MATRIZ =:ES_MATRIZ";
                $objQuery->setParameter("ES_MATRIZ", $strEsMatriz);
                $objQueryCount->setParameter("ES_MATRIZ", $strEsMatriz);
            }
            if(!empty($strIdentificacionRes))
            {
                $strWhere .= " AND IR.IDENTIFICACION = :IDENTIFICACION";
                $objQuery->setParameter("IDENTIFICACION", $strIdentificacionRes);
                $objQueryCount->setParameter("IDENTIFICACION", $strIdentificacionRes);
            }
            if(!empty($strIdRestaurante))
            {
                $strWhere .= " AND IR.ID_RESTAURANTE = :ID_RESTAURANTE";
                $objQuery->setParameter("ID_RESTAURANTE", $strIdRestaurante);
                $objQueryCount->setParameter("ID_RESTAURANTE", $strIdRestaurante);
            }
            $strOrderBy = " Order by IR.NOMBRE_COMERCIAL ASC, ISUR.ESTADO_FACTURACION ASC ";
            $objRsmBuilder->addScalarResult('ID_SUCURSAL', 'ID_SUCURSAL', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION', 'DESCRIPCION', 'string');
            $objRsmBuilder->addScalarResult('ES_MATRIZ', 'ES_MATRIZ', 'string');
            $objRsmBuilder->addScalarResult('EN_CENTRO_COMERCIAL', 'EN_CENTRO_COMERCIAL', 'string');
            $objRsmBuilder->addScalarResult('DIRECCION', 'DIRECCION', 'string');
            $objRsmBuilder->addScalarResult('RESTAURANTE_ID', 'RESTAURANTE_ID', 'string');
            $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'RAZON_SOCIAL', 'string');
            $objRsmBuilder->addScalarResult('NUMERO_CONTACTO', 'NUMERO_CONTACTO', 'string');
            $objRsmBuilder->addScalarResult('ESTADO_FACTURACION', 'ESTADO_FACTURACION', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('LATITUD', 'LATITUD', 'string');
            $objRsmBuilder->addScalarResult('LONGITUD', 'LONGITUD', 'string');
            $objRsmBuilder->addScalarResult('PAIS', 'PAIS', 'string');
            $objRsmBuilder->addScalarResult('PROVINCIA', 'PROVINCIA', 'string');
            $objRsmBuilder->addScalarResult('CIUDAD', 'CIUDAD', 'string');
            $objRsmBuilder->addScalarResult('PARROQUIA', 'PARROQUIA', 'string');
            $objRsmBuilder->addScalarResult('CODIGO_DIARIO', 'CODIGO_DIARIO', 'string');
            $objRsmBuilder->addScalarResult('HORA_LUN_VIE_INI', 'HORA_LUN_VIE_INI', 'string');
            $objRsmBuilder->addScalarResult('HORA_LUN_VIE_FIN', 'HORA_LUN_VIE_FIN', 'string');
            $objRsmBuilder->addScalarResult('HORA_SABADO_INI', 'HORA_SABADO_INI', 'string');
            $objRsmBuilder->addScalarResult('HORA_SABADO_FIN', 'HORA_SABADO_FIN', 'string');
            $objRsmBuilder->addScalarResult('HORA_DOMINGO_INI', 'HORA_DOMINGO_INI', 'string');
            $objRsmBuilder->addScalarResult('HORA_DOMINGO_FIN', 'HORA_DOMINGO_FIN', 'string');
            $objRsmBuilder->addScalarResult('USR_CREACION', 'USR_CREACION', 'string');
            $objRsmBuilder->addScalarResult('FE_CREACION', 'FE_CREACION', 'date');
            $objRsmBuilder->addScalarResult('USR_MODIFICACION', 'USR_MODIFICACION', 'string');
            $objRsmBuilder->addScalarResult('FE_MODIFICACION', 'FE_MODIFICACION', 'date');

            $objRsmBuilderCount->addScalarResult('CANTIDAD', 'Cantidad', 'integer');
            $strSql       = $strSelect.$strFrom.$strWhere.$strOrderBy;
            $objQuery->setSQL($strSql);
            $strSqlCount  = $strSelectCount.$strFrom.$strWhere;
            $objQueryCount->setSQL($strSqlCount);
            $arraySucursal['cantidad']   = $objQueryCount->getSingleScalarResult();
            $arraySucursal['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arraySucursal['error'] = $strMensajeError;
        return $arraySucursal;
    }

    /**
     * Documentación para la función 'getSucursalPorUbicacion'
     * Método encargado de retornar todos las sucursales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 29-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 09-06-2021 - Se agrega horario de atención.
     *
     * @return array  $arraySucursal
     * 
     */
    public function getSucursalPorUbicacion($arrayParametros)
    {
        $strLatitud            = $arrayParametros['latitud'] ? $arrayParametros['latitud']:'';
        $strLongitud           = $arrayParametros['longitud'] ? $arrayParametros['longitud']:'';
        $strMetros             = $arrayParametros['metros'] ? $arrayParametros['metros']:5;
        $strEstado             = $arrayParametros['estado'] ? $arrayParametros['estado']:array('ACTIVO');
        $intIdCliente          = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $strCodigoSucursal     = $arrayParametros['strCodigoSucursal'] ? $arrayParametros['strCodigoSucursal']:'';
        $strDescripcion        = $arrayParametros['strDescripcion'] ? $arrayParametros['strDescripcion']:'';
        $arraySucursal         = array();
        $strMensajeError       = '';
        $date                  = date('Y-m-d H:i:s');
        $objRsmBuilder         = new ResultSetMappingBuilder($this->_em);
        $objQuery              = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount    = new ResultSetMappingBuilder($this->_em);
        try
        {
            $strSelect      = "SELECT T1.CODIGO_DIARIO,T1.ID_SUCURSAL, T1.RESTAURANTE_ID, T1.DESCRIPCION, T1.PAIS, T1.PROVINCIA,
                                T1.CIUDAD,T1.PARROQUIA, T1.NOMBRE_COMERCIAL,T1.DISTANCIA,
                                T1.HORA_LUN_VIE_INI,T1.HORA_LUN_VIE_FIN,T1.HORA_SABADO_INI,T1.HORA_SABADO_FIN,T1.HORA_DOMINGO_INI,T1.HORA_DOMINGO_FIN,
                                T1.VALOR  ";
            $strFrom        ="FROM
                                (SELECT ISU.CODIGO_DIARIO,ISU.ID_SUCURSAL, ISU.RESTAURANTE_ID,
                                    ISU.DESCRIPCION, ISU.PAIS,ISU.PROVINCIA,ISU.CIUDAD,ISU.PARROQUIA,
                                    ISU.HORA_LUN_VIE_INI,ISU.HORA_LUN_VIE_FIN,ISU.HORA_SABADO_INI,ISU.HORA_SABADO_FIN,ISU.HORA_DOMINGO_INI,ISU.HORA_DOMINGO_FIN,
                                    IRE.NOMBRE_COMERCIAL,
                                    (CASE
                                        WHEN 
                                        (SELECT ICE.SUCURSAL_ID
                                        FROM INFO_CLIENTE_ENCUESTA ICE
                                        WHERE 
                                        TIMESTAMPDIFF(HOUR,ICE.FE_CREACION,'".$date."') < 24 
                                        AND ICE.CLIENTE_ID  =  :CLIENTE_ID
                                        AND ICE.SUCURSAL_ID = ISU.ID_SUCURSAL
                                        LIMIT 1
                                    ) IS NOT NULL THEN 1 ELSE 0
                                    END ) AS VALOR,
                                    (6371 * ACOS( 
                                                SIN(RADIANS(ISU.LATITUD)) * SIN(RADIANS(:LATITUD)) 
                                                + COS(RADIANS(ISU.LONGITUD - :LONGITUD)) * COS(RADIANS(ISU.LATITUD)) 
                                                * COS(RADIANS(:LATITUD))
                                                )
                                    ) AS DISTANCIA
                                FROM INFO_SUCURSAL ISU
                                INNER JOIN INFO_RESTAURANTE IRE ON IRE.ID_RESTAURANTE = ISU.RESTAURANTE_ID
                                WHERE ISU.ESTADO_FACTURACION in (:ESTADO)) T1 ";

            if((isset($strCodigoSucursal) && !empty($strCodigoSucursal)) && ($strDescripcion == "CODIGO" && !empty($strDescripcion)))
            {
                $strWhere = " WHERE T1.CODIGO_DIARIO = ".$strCodigoSucursal;
            }
            else
            {
                $strWhere = " WHERE T1.DISTANCIA < (:METROS/1000) ";
                $objQuery->setParameter("METROS", $strMetros);
            }
            $strOrder = " ORDER BY T1.DISTANCIA ASC limit 10 ";
            $objQuery->setParameter("ESTADO", $strEstado);
            $objQuery->setParameter("LATITUD", $strLatitud);
            $objQuery->setParameter("LONGITUD", $strLongitud);
            $objQuery->setParameter("CLIENTE_ID",$intIdCliente);
            $objRsmBuilder->addScalarResult('ID_SUCURSAL', 'ID_SUCURSAL', 'string');
            $objRsmBuilder->addScalarResult('RESTAURANTE_ID', 'RESTAURANTE_ID', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION', 'DESCRIPCION', 'string');
            $objRsmBuilder->addScalarResult('PAIS', 'PAIS', 'string');
            $objRsmBuilder->addScalarResult('PROVINCIA', 'PROVINCIA', 'string');
            $objRsmBuilder->addScalarResult('CIUDAD', 'CIUDAD', 'string');
            $objRsmBuilder->addScalarResult('PARROQUIA', 'PARROQUIA', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
            $objRsmBuilder->addScalarResult('DISTANCIA', 'DISTANCIA', 'string');
            $objRsmBuilder->addScalarResult('VALOR', 'VALOR', 'string');
            $objRsmBuilder->addScalarResult('HORA_LUN_VIE_INI', 'HORA_LUN_VIE_INI', 'string');
            $objRsmBuilder->addScalarResult('HORA_LUN_VIE_FIN', 'HORA_LUN_VIE_FIN', 'string');
            $objRsmBuilder->addScalarResult('HORA_SABADO_INI', 'HORA_SABADO_INI', 'string');
            $objRsmBuilder->addScalarResult('HORA_SABADO_FIN', 'HORA_SABADO_FIN', 'string');
            $objRsmBuilder->addScalarResult('HORA_DOMINGO_INI', 'HORA_DOMINGO_INI', 'string');
            $objRsmBuilder->addScalarResult('HORA_DOMINGO_FIN', 'HORA_DOMINGO_FIN', 'string');

            $strSql       = $strSelect.$strFrom.$strWhere.$strOrder;
            $objQuery->setSQL($strSql);
            $arraySucursal['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arraySucursal['error'] = $strMensajeError;
        return $arraySucursal;
    }
    /**
     * Documentación para la función 'getValidaCoordenadas'
     * Método encargado de retornar Si o No si se encuentra al rededor de la sucursal según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 10-02-2020
     * 
     * @return array  $arraySucursal
     * 
     */
    public function getValidaCoordenadas($arrayParametros)
    {
        $strLatitud            = $arrayParametros['latitud'] ? $arrayParametros['latitud']:'';
        $strLongitud           = $arrayParametros['longitud'] ? $arrayParametros['longitud']:'';
        $strMetros             = $arrayParametros['metros'] ? $arrayParametros['metros']:5;
        $strEstado             = $arrayParametros['estado'] ? $arrayParametros['estado']:array('ACTIVO');
        $intIdRestaurante      = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $arraySucursal         = array();
        $strMensajeError       = '';
        $date                  = date('Y-m-d H:i:s');
        $objRsmBuilder         = new ResultSetMappingBuilder($this->_em);
        $objQuery              = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount    = new ResultSetMappingBuilder($this->_em);
        try
        {
            $strSelect      = "SELECT  T1.DISTANCIA,T1.ID_SUCURSAL,T1.DESCRIPCION FROM (SELECT (6371 * ACOS( 
                                                SIN(RADIANS(ISU.LATITUD)) * SIN(RADIANS(:LATITUD)) 
                                                + COS(RADIANS(ISU.LONGITUD - :LONGITUD)) * COS(RADIANS(ISU.LATITUD)) 
                                                * COS(RADIANS(:LATITUD))
                                        ) )as DISTANCIA , ISU.ID_SUCURSAL,ISU.DESCRIPCION ";
            $strFrom        = " FROM INFO_SUCURSAL ISU
                                JOIN INFO_RESTAURANTE IRE
                                ON IRE.ID_RESTAURANTE=ISU.RESTAURANTE_ID ";
            $strWhere       = " WHERE IRE.ID_RESTAURANTE=:intIdRestaurante) T1 WHERE T1.DISTANCIA < (:METROS/1000) ";

            $objQuery->setParameter("LATITUD", $strLatitud);
            $objQuery->setParameter("LONGITUD", $strLongitud);
            $objQuery->setParameter("METROS", $strMetros);
            $objQuery->setParameter("intIdRestaurante",$intIdRestaurante);

            $objRsmBuilder->addScalarResult('DISTANCIA', 'DISTANCIA', 'string');
            $objRsmBuilder->addScalarResult('ID_SUCURSAL', 'ID_SUCURSAL', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION', 'DESCRIPCION', 'string');

            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arraySucursal['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arraySucursal['error'] = $strMensajeError;
        return $arraySucursal;
    }

    /**
     * Documentación para la función 'getSucursales'
     * Método encargado de retornar todas las sucursales.
     * 
     * @author Kevin Baque
     * @version 1.0 21-06-2020
     * 
     * @return array  $arraySucursal
     * 
     */
    public function getSucursales()
    {
        $arraySucursal         = array();
        $strMensajeError       = '';
        $objRsmBuilder         = new ResultSetMappingBuilder($this->_em);
        $objQuery              = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT isu.ID_SUCURSAL,isu.DESCRIPCION,ires.NOMBRE_COMERCIAL, ius.NOMBRES, ius.APELLIDOS, ius.CORREO ";
            $strFrom        = " FROM INFO_SUCURSAL isu
                                join INFO_RESTAURANTE ires  on ires.id_restaurante = isu.restaurante_id
                                join INFO_USUARIO_RES iresu on iresu.restaurante_id=ires.id_restaurante
                                join INFO_USUARIO     ius   on ius.id_usuario=iresu.usuario_id ";
            $strWhere       = " where isu.estado='ACTIVO' and isu.estado_facturacion = 'ACTIVO' ";


            $objRsmBuilder->addScalarResult('ID_SUCURSAL', 'ID_SUCURSAL', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION', 'DESCRIPCION', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
            $objRsmBuilder->addScalarResult('NOMBRES', 'NOMBRES', 'string');
            $objRsmBuilder->addScalarResult('APELLIDOS', 'APELLIDOS', 'string');
            $objRsmBuilder->addScalarResult('CORREO', 'CORREO', 'string');

            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arraySucursal['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arraySucursal['error'] = $strMensajeError;
        return $arraySucursal;
    }
}
