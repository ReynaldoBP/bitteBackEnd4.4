<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * InfoRestauranteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoRestauranteRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Documentación para la función 'getRestauranteCriterio'
     * Método encargado de retornar todos los restaurantes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-07-2019
     * 
     * @return array  $arrayRestaurante
     *
     * @author Kevin Baque
     * @version 1.0 04-09-2020 - Se agrega bandera para retornar todos los restaurantes menos Bitte
     *
     * @author Kevin Baque
     * @version 1.1 14-06-2021 - Se agrega bandera para retornar si el restaurante es afiliado.
     *
     * @author Kevin Baque
     * @version 1.2 18-06-2021 - Se agrega filtro de ciudad.
     *
     */    
    public function getRestauranteCriterio($arrayParametros)
    {
        $strTipoComida         = $arrayParametros['strTipoComida'] ? $arrayParametros['strTipoComida']:'';
        $strIdentificacion     = $arrayParametros['strIdentificacion'] ? $arrayParametros['strIdentificacion']:'';
        $intIdRestaurante      = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $intIdUsuario          = $arrayParametros['intIdUsuario'] ? $arrayParametros['intIdUsuario']:'';
        $strTipoIdentificacion = $arrayParametros['strTipoIdentificacion'] ? $arrayParametros['strTipoIdentificacion']:'';
        $strRazonSocial        = $arrayParametros['strRazonSocial'] ? $arrayParametros['strRazonSocial']:'';
        $strContador           = $arrayParametros['strContador'] ? $arrayParametros['strContador']:'NO';
        $strBanderaBitte       = $arrayParametros['strBanderaBitte'] ? $arrayParametros['strBanderaBitte']:'N';
        $strEstado             = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $intCiudad             = $arrayParametros['intCiudad'] ? $arrayParametros['intCiudad']:'';
        $arrayRestaurante      = array();
        $strMensajeError       = '';
        $strEstadoActivo       = "ACTIVO";
        $objRsmBuilder         = new ResultSetMappingBuilder($this->_em);
        $objQuery              = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount    = new ResultSetMappingBuilder($this->_em);
        $objQueryCount         = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        try
        {
            if(!empty($strContador) && $strContador == 'SI')
            {
                $strEstado = 'ACTIVO';
                $strSelectCount = "SELECT COUNT(*) AS CANTIDAD ";
                $strFromCount   = "FROM INFO_RESTAURANTE IR ";
                $strWhereCount  = "WHERE IR.ESTADO in (:ESTADO) ";
                $objQueryCount->setParameter("ESTADO", $strEstado);
                $objRsmBuilderCount->addScalarResult('CANTIDAD', 'Cantidad', 'integer');
                $strSqlCount  = $strSelectCount.$strFromCount.$strWhereCount;
                $objQueryCount->setSQL($strSqlCount);
                $arrayRestaurante['cantidad']   = $objQueryCount->getSingleScalarResult();
            }
            else
            {
                $strSelect      = "SELECT IR.ID_RESTAURANTE,IR.TIPO_IDENTIFICACION, IR.IDENTIFICACION, IR.RAZON_SOCIAL, 
                                IR.NOMBRE_COMERCIAL, IR.REPRESENTANTE_LEGAL, IR.TIPO_COMIDA_ID,ATC.DESCRIPCION_TIPO_COMIDA, 
                                IR.DIRECCION_TRIBUTARIO, IR.URL_CATALOGO, IR.URL_RED_SOCIAL, IR.NUMERO_CONTACTO, IR.ESTADO, IR.CODIGO,IR.ES_AFILIADO, IR.IMAGEN, IR.ICONO ";
                $strFrom        = "FROM INFO_RESTAURANTE IR
                                    JOIN ADMI_TIPO_COMIDA ATC
                                    ON IR.TIPO_COMIDA_ID = ATC.ID_TIPO_COMIDA ";
                $strWhere       = "WHERE IR.ESTADO in (:ESTADO) ";
                $strGroupBy     = " GROUP BY IR.ID_RESTAURANTE,IR.TIPO_IDENTIFICACION, IR.IDENTIFICACION, IR.RAZON_SOCIAL, 
                                    IR.NOMBRE_COMERCIAL, IR.REPRESENTANTE_LEGAL, IR.TIPO_COMIDA_ID,ATC.DESCRIPCION_TIPO_COMIDA, 
                                    IR.DIRECCION_TRIBUTARIO, IR.URL_CATALOGO, IR.URL_RED_SOCIAL, IR.NUMERO_CONTACTO, IR.ESTADO, IR.CODIGO,IR.ES_AFILIADO, IR.IMAGEN, IR.ICONO ";
                $strOrder       = " order by IR.NOMBRE_COMERCIAL ASC, IR.ESTADO ASC ";
                $objQuery->setParameter("ESTADO", $strEstado);
                if(!empty($intCiudad) && $intCiudad!="TODAS")
                {
                    $strFrom   .= " LEFT JOIN INFO_SUCURSAL ISUR ON  ISUR.RESTAURANTE_ID     = IR.ID_RESTAURANTE
                                                                 AND ISUR.ESTADO             = :strEstadoActivo
                                                                 AND ISUR.ESTADO_FACTURACION = :strEstadoActivo
                                    LEFT JOIN ADMI_CIUDAD   ACI  ON  ACI.ID_CIUDAD           = ISUR.CIUDAD
                                                                 AND ACI.ESTADO              = :strEstadoActivo ";
                    $strWhere  .= " AND ISUR.CIUDAD = :intCiudad ";
                    $objQuery->setParameter("strEstadoActivo", $strEstadoActivo);
                    $objQuery->setParameter("intCiudad", $intCiudad);
                }
                if(!empty($strRazonSocial))
                {
                $strWhere .= " AND lower(IR.RAZON_SOCIAL) like lower(:RAZON_SOCIAL)";
                $objQuery->setParameter("RAZON_SOCIAL", '%' . trim($strRazonSocial) . '%');
                }
                if(!empty($strTipoIdentificacion))
                {
                $strWhere .= " AND lower(IR.TIPO_IDENTIFICACION) like lower(:TIPO_IDENTIFICACION)";
                $objQuery->setParameter("TIPO_IDENTIFICACION", '%' . trim($strTipoIdentificacion) . '%');
                }
                if(!empty($strIdentificacion))
                {
                $strWhere .= " AND IR.IDENTIFICACION =:IDENTIFICACION";
                $objQuery->setParameter("IDENTIFICACION", $strIdentificacion);
                }
                if(!empty($intIdRestaurante))
                {
                $strWhere .= " AND IR.ID_RESTAURANTE =:ID_RESTAURANTE";
                $objQuery->setParameter("ID_RESTAURANTE", $intIdRestaurante);
                }
                if(!empty($strBanderaBitte) && $strBanderaBitte == "S")
                {
                    $strWhere .= " AND IR.ID_RESTAURANTE != 28 ";
                }
                if(!empty($intIdUsuario))
                {
                $strFrom .= " JOIN INFO_USUARIO_RES IUR 
                                ON IR.ID_RESTAURANTE = IUR.RESTAURANTE_ID ";
                $strWhere .= " AND IUR.USUARIO_ID =:USUARIO_ID";
                $objQuery->setParameter("USUARIO_ID", $intIdUsuario);
                }
                if(!empty($strTipoComida))
                {
                $strWhere  .= " AND ATC.ID_TIPO_COMIDA = :ID_TIPO_COMIDA";
                $objQuery->setParameter("ID_TIPO_COMIDA", $strTipoComida);
                }
                $objRsmBuilder->addScalarResult('ID_RESTAURANTE', 'ID_RESTAURANTE', 'string');
                $objRsmBuilder->addScalarResult('TIPO_IDENTIFICACION', 'TIPO_IDENTIFICACION', 'string');
                $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
                $objRsmBuilder->addScalarResult('RAZON_SOCIAL', 'RAZON_SOCIAL', 'string');
                $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
                $objRsmBuilder->addScalarResult('REPRESENTANTE_LEGAL', 'REPRESENTANTE_LEGAL', 'string');
                $objRsmBuilder->addScalarResult('TIPO_COMIDA_ID', 'TIPO_COMIDA_ID', 'string');
                $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_COMIDA', 'DESCRIPCION_TIPO_COMIDA', 'string');
                $objRsmBuilder->addScalarResult('DIRECCION_TRIBUTARIO', 'DIRECCION_TRIBUTARIO', 'string');
                $objRsmBuilder->addScalarResult('URL_CATALOGO', 'URL_CATALOGO', 'string');
                $objRsmBuilder->addScalarResult('URL_RED_SOCIAL', 'URL_RED_SOCIAL', 'string');
                $objRsmBuilder->addScalarResult('NUMERO_CONTACTO', 'NUMERO_CONTACTO', 'string');
                $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
                $objRsmBuilder->addScalarResult('CODIGO', 'CODIGO', 'string');
                $objRsmBuilder->addScalarResult('ES_AFILIADO', 'ES_AFILIADO', 'string');
                $objRsmBuilder->addScalarResult('IMAGEN', 'IMAGEN', 'string');
                $objRsmBuilder->addScalarResult('ICONO', 'ICONO', 'string');
                $strSql       = $strSelect.$strFrom.$strWhere.$strGroupBy.$strOrder;
                $objQuery->setSQL($strSql);
                $arrayRestaurante['resultados'] = $objQuery->getResult();
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayRestaurante['error'] = $strMensajeError;
        return $arrayRestaurante;
    }
    /**
     * Documentación para la función 'getRestauranteCriterioMovil'
     * Método encargado de retornar todos los restaurantes según los parámetros recibidos desde movil.
     * 
     * @author Kevin Baque
     * @version 1.0 29-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 16-06-2021 - Se agrega filtro de ciudad y si el restaurante es afiliado.
     *
     * @return array  $arrayRestaurante
     * 
     */    
    public function getRestauranteCriterioMovil($arrayParametros)
    {
        $strTipoComida         = $arrayParametros['strTipoComida'] ? $arrayParametros['strTipoComida']:'';
        $strIdentificacion     = $arrayParametros['strIdentificacion'] ? $arrayParametros['strIdentificacion']:'';
        $intIdRestaurante      = $arrayParametros['intIdRestaurante'] ? $arrayParametros['intIdRestaurante']:'';
        $intIdCliente          = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $strTipoIdentificacion = $arrayParametros['strTipoIdentificacion'] ? $arrayParametros['strTipoIdentificacion']:'';
        $strRazonSocial        = $arrayParametros['strRazonSocial'] ? $arrayParametros['strRazonSocial']:'';
        $strEstado             = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO');
        $intEsRestaurante      = $arrayParametros['intEsRestaurante'] ? $arrayParametros['intEsRestaurante']:'';
        $intCiudad             = $arrayParametros['intCiudad'] ? $arrayParametros['intCiudad']:'';
        $strEsAfiliado         = $arrayParametros['strEsAfiliado'] ? $arrayParametros['strEsAfiliado']:'';
        $arrayRestaurante      = array();
        $strMensajeError       = '';
        $objRsmBuilder         = new ResultSetMappingBuilder($this->_em);
        $objQuery              = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $objRsmBuilderCount    = new ResultSetMappingBuilder($this->_em);
        $objQueryCount         = $this->_em->createNativeQuery(null, $objRsmBuilderCount);
        $strEstadoActivo       = "ACTIVO";
        try
        {
            $strSelect      = "SELECT IR.ID_RESTAURANTE,IR.TIPO_IDENTIFICACION, IR.IDENTIFICACION, IR.RAZON_SOCIAL, 
                                      IR.NOMBRE_COMERCIAL, IR.REPRESENTANTE_LEGAL, IR.TIPO_COMIDA_ID,IR.ES_AFILIADO,
                                      ATC.DESCRIPCION_TIPO_COMIDA, 
                                      IR.DIRECCION_TRIBUTARIO, IR.URL_CATALOGO,IR.URL_RED_SOCIAL, IR.NUMERO_CONTACTO, IR.ESTADO, IR.IMAGEN, IR.ICONO
                                      ,(SELECT COUNT(*) FROM INFO_LIKE_RES ILR_RES WHERE ILR_RES.RESTAURANTE_ID=IR.ID_RESTAURANTE AND ILR_RES.ESTADO='ACTIVO') as CANT_LIKE
                                      ,(SELECT IFNULL(round(AVG(SUB_IRES.RESPUESTA),4),0) 
                                            FROM INFO_CLIENTE_ENCUESTA SUB_ICE
                                                INNER JOIN INFO_SUCURSAL SUB_ISU 
                                                    ON SUB_ISU.ID_SUCURSAL = SUB_ICE.SUCURSAL_ID
                                                INNER JOIN INFO_RESPUESTA SUB_IRES 
                                                    ON SUB_IRES.CLT_ENCUESTA_ID = SUB_ICE.ID_CLT_ENCUESTA
                                                INNER JOIN INFO_PREGUNTA SUB_IP 
                                                    ON SUB_IP.ID_PREGUNTA = SUB_IRES.PREGUNTA_ID
                                                INNER JOIN INFO_OPCION_RESPUESTA SUB_IOR 
                                                    ON SUB_IOR.ID_OPCION_RESPUESTA = SUB_IP.OPCION_RESPUESTA_ID
                                                WHERE SUB_IOR.VALOR = 5 
                                                    AND SUB_ICE.ESTADO = 'ACTIVO' 
                                                    AND SUB_ISU.RESTAURANTE_ID = IR.ID_RESTAURANTE) AS PRO_ENCUESTAS ";
            $strSelectCount = "SELECT COUNT(*) AS CANTIDAD ";
            $strFrom        = "FROM INFO_RESTAURANTE IR
                               JOIN ADMI_TIPO_COMIDA ATC ON IR.TIPO_COMIDA_ID = ATC.ID_TIPO_COMIDA ";
            $strWhere       = "WHERE IR.ESTADO in (:ESTADO) ";
            $strGroupBy     = " GROUP BY ID_RESTAURANTE,TIPO_IDENTIFICACION,IDENTIFICACION,RAZON_SOCIAL,NOMBRE_COMERCIAL,REPRESENTANTE_LEGAL,
                                TIPO_COMIDA_ID,ES_AFILIADO,DESCRIPCION_TIPO_COMIDA,DIRECCION_TRIBUTARIO,URL_CATALOGO,URL_RED_SOCIAL,NUMERO_CONTACTO,ESTADO,IMAGEN,ICONO,
                                CANT_LIKE,PRO_ENCUESTAS ";
            $strOrderBy     = " ORDER BY IR.NOMBRE_COMERCIAL ";
            if(!empty($intEsRestaurante))
            {
                $strWhere = $strWhere." AND IR.ID_RESTAURANTE != 28 ";
            }
            $objQuery->setParameter("ESTADO", $strEstado);
            $objQueryCount->setParameter("ESTADO", $strEstado);
            if(!empty($intCiudad))
            {
                $strFrom   .= " LEFT JOIN INFO_SUCURSAL ISUR ON ISUR.RESTAURANTE_ID=IR.ID_RESTAURANTE
                                AND ISUR.ESTADO = :strEstadoActivo AND ISUR.ESTADO_FACTURACION = :strEstadoActivo ";
                $strWhere  .= " AND ISUR.CIUDAD = :intCiudad ";
                $objQuery->setParameter("strEstadoActivo", $strEstadoActivo);
                $objQueryCount->setParameter("strEstadoActivo", $strEstadoActivo);
                $objQuery->setParameter("intCiudad", $intCiudad);
                $objQueryCount->setParameter("intCiudad", $intCiudad);
            }
            if(!empty($strEsAfiliado))
            {
                $strEsAfiliado = $strEsAfiliado == "S" ? "SI":"NO";
                $strWhere     .= " AND IR.ES_AFILIADO = :strEsAfiliado ";
                $objQuery->setParameter("strEsAfiliado", $strEsAfiliado);
                $objQueryCount->setParameter("strEsAfiliado", $strEsAfiliado);
            }
            if(!empty($intIdCliente))
            {
                $strSelect .= " ,(SELECT ILR.ID_LIKE FROM INFO_LIKE_RES ILR WHERE ILR.RESTAURANTE_ID=IR.ID_RESTAURANTE AND ESTADO='ACTIVO' AND CLIENTE_ID=:CLIENTE_ID LIMIT 1) as ID_LIKE 
                                ,(SELECT IFNULL(round(AVG(SUB_IRES.RESPUESTA),4),0) 
                                FROM INFO_CLIENTE_ENCUESTA SUB_ICE
                                    INNER JOIN INFO_SUCURSAL SUB_ISU 
                                        ON SUB_ISU.ID_SUCURSAL = SUB_ICE.SUCURSAL_ID
                                    INNER JOIN INFO_RESPUESTA SUB_IRES 
                                        ON SUB_IRES.CLT_ENCUESTA_ID = SUB_ICE.ID_CLT_ENCUESTA
                                    INNER JOIN INFO_PREGUNTA SUB_IP 
                                        ON SUB_IP.ID_PREGUNTA = SUB_IRES.PREGUNTA_ID
                                    INNER JOIN INFO_OPCION_RESPUESTA SUB_IOR 
                                        ON SUB_IOR.ID_OPCION_RESPUESTA = SUB_IP.OPCION_RESPUESTA_ID
                                    WHERE SUB_IOR.VALOR = 5 
                                        AND SUB_ICE.ESTADO = 'ACTIVO' 
                                        AND SUB_ISU.RESTAURANTE_ID = IR.ID_RESTAURANTE
                                        AND SUB_ICE.CLIENTE_ID=:CLIENTE_ID) AS PRO_ENCUESTAS_CLT ";
                $objQuery->setParameter("CLIENTE_ID", $intIdCliente);
                $objQueryCount->setParameter("CLIENTE_ID", $intIdCliente);
                $objRsmBuilder->addScalarResult('ID_LIKE', 'ID_LIKE', 'string');
                $objRsmBuilder->addScalarResult('PRO_ENCUESTAS_CLT', 'PRO_ENCUESTAS_CLT', 'string');
                $strGroupBy .= " ,ID_LIKE,PRO_ENCUESTAS_CLT ";
            }
            if(!empty($strRazonSocial))
            {
                $strWhere .= " AND lower(IR.RAZON_SOCIAL) like lower(:RAZON_SOCIAL)";
                $objQuery->setParameter("RAZON_SOCIAL", '%' . trim($strRazonSocial) . '%');
                $objQueryCount->setParameter("RAZON_SOCIAL", '%' . trim($strRazonSocial) . '%');
            }
            if(!empty($strTipoIdentificacion))
            {
                $strWhere .= " AND lower(IR.TIPO_IDENTIFICACION) like lower(:TIPO_IDENTIFICACION)";
                $objQuery->setParameter("TIPO_IDENTIFICACION", '%' . trim($strTipoIdentificacion) . '%');
                $objQueryCount->setParameter("TIPO_IDENTIFICACION", '%' . trim($strTipoIdentificacion) . '%');
            }
            if(!empty($strIdentificacion))
            {
                $strWhere .= " AND IR.IDENTIFICACION =:IDENTIFICACION";
                $objQuery->setParameter("IDENTIFICACION", $strIdentificacion);
                $objQueryCount->setParameter("IDENTIFICACION", $strIdentificacion);
            }
            if(!empty($intIdRestaurante))
            {
                $strWhere .= " AND IR.ID_RESTAURANTE =:ID_RESTAURANTE";
                $objQuery->setParameter("ID_RESTAURANTE", $intIdRestaurante);
                $objQueryCount->setParameter("ID_RESTAURANTE", $intIdRestaurante);
            }
            if(!empty($strTipoComida))
            {
                $strWhere .= " AND lower(ATC.DESCRIPCION_TIPO_COMIDA) like lower(:ID_TIPO_COMIDA) ";
                $objQuery->setParameter("ID_TIPO_COMIDA", '%' . trim($strTipoComida) . '%');
                $objQueryCount->setParameter("ID_TIPO_COMIDA", '%' . trim($strTipoComida) . '%');
            }
            $objRsmBuilder->addScalarResult('ID_RESTAURANTE', 'ID_RESTAURANTE', 'string');
            $objRsmBuilder->addScalarResult('TIPO_IDENTIFICACION', 'TIPO_IDENTIFICACION', 'string');
            $objRsmBuilder->addScalarResult('IDENTIFICACION', 'IDENTIFICACION', 'string');
            $objRsmBuilder->addScalarResult('RAZON_SOCIAL', 'RAZON_SOCIAL', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'NOMBRE_COMERCIAL', 'string');
            $objRsmBuilder->addScalarResult('REPRESENTANTE_LEGAL', 'REPRESENTANTE_LEGAL', 'string');
            $objRsmBuilder->addScalarResult('TIPO_COMIDA_ID', 'TIPO_COMIDA_ID', 'string');
            $objRsmBuilder->addScalarResult('ES_AFILIADO', 'ES_AFILIADO', 'string');
            $objRsmBuilder->addScalarResult('DESCRIPCION_TIPO_COMIDA', 'DESCRIPCION_TIPO_COMIDA', 'string');
            $objRsmBuilder->addScalarResult('DIRECCION_TRIBUTARIO', 'DIRECCION_TRIBUTARIO', 'string');
            $objRsmBuilder->addScalarResult('URL_CATALOGO', 'URL_CATALOGO', 'string');
            $objRsmBuilder->addScalarResult('URL_RED_SOCIAL', 'URL_RED_SOCIAL', 'string');
            $objRsmBuilder->addScalarResult('NUMERO_CONTACTO', 'NUMERO_CONTACTO', 'string');
            $objRsmBuilder->addScalarResult('ESTADO', 'ESTADO', 'string');
            $objRsmBuilder->addScalarResult('IMAGEN', 'IMAGEN', 'string');
            $objRsmBuilder->addScalarResult('ICONO', 'ICONO', 'string');
            $objRsmBuilder->addScalarResult('CANT_LIKE', 'CANT_LIKE', 'string');
            $objRsmBuilder->addScalarResult('PRO_ENCUESTAS', 'PRO_ENCUESTAS', 'string');
            $objRsmBuilderCount->addScalarResult('CANTIDAD', 'Cantidad', 'integer');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroupBy.$strOrderBy;
            $objQuery->setSQL($strSql);
            $strSqlCount  = $strSelectCount.$strFrom.$strWhere;
            $objQueryCount->setSQL($strSqlCount);
            $arrayRestaurante['cantidad']   = $objQueryCount->getSingleScalarResult();
            /*if($arrayRestaurante['cantidad'] == 1)
            {
                $arrayRestaurante['resultados'] = $objQuery->getOneOrNullResult();
            }
            else
            {*/
                $arrayRestaurante['resultados'] = $objQuery->getResult();
            //} 

        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayRestaurante['error'] = $strMensajeError;
        return $arrayRestaurante;
    }
    /**
     * Documentación para la función 'getCiudadPorRestaurante'
     *
     * Función encargada de retornar todos las ciudades por restaurantes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 18-06-2021
     * 
     * @return array  $arrayResultado
     *
     */
    public function getCiudadPorRestaurante($arrayParametros)
    {
        $strEstado             = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $arrayResultado        = array();
        $strMensajeError       = '';
        $objRsmBuilder         = new ResultSetMappingBuilder($this->_em);
        $objQuery              = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = " SELECT DISTINCT ID_CIUDAD,CIUDAD_NOMBRE ";
            $strFrom        = " FROM ADMI_CIUDAD ACI
                                JOIN INFO_SUCURSAL ISUR ON ISUR.CIUDAD=ACI.ID_CIUDAD ";
            $strWhere       = " WHERE ACI.ESTADO      = :strEstado
                                      AND ISUR.ESTADO = :strEstado
                                      AND ISUR.ESTADO_FACTURACION = :strEstado ";
            $strOrder       = " ORDER BY ACI.CIUDAD_NOMBRE ASC ";
            $objQuery->setParameter("strEstado", $strEstado);

            $objRsmBuilder->addScalarResult('ID_CIUDAD', 'ID_CIUDAD', 'string');
            $objRsmBuilder->addScalarResult('CIUDAD_NOMBRE', 'CIUDAD_NOMBRE', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strOrder;
            $objQuery->setSQL($strSql);
            $arrayResultado['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayResultado['error'] = $strMensajeError;
        return $arrayResultado;
    }

}
