<?php

namespace App\Repository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
/**
 * InfoClienteEncuestaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoClienteEncuestaRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Documentación para la función 'getClienteEncuestaRepetida'
     * Método encargado de retornar si la encuenta enviada existe.
     * 
     * @author El Kevin Baque de Mucho Lote
     * @version 1.0 11-02-2020
     * 
     * @return array  $arrayCltEncuesta
     * 
     */    
    public function getClienteEncuestaRepetida($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']: 'PENDIENTE';
        $intClienteId       = $arrayParametros['intClienteId'] ? $arrayParametros['intClienteId']:'';
        $intSucursalId      = $arrayParametros['intSucursalId'] ? $arrayParametros['intSucursalId']:'';
        $intEncuestaId      = $arrayParametros['intEncuestaId'] ? $arrayParametros['intEncuestaId']:'';
        $intContenidoId     = $arrayParametros['intContenidoId'] ? $arrayParametros['intContenidoId']:'';
        $strFecha           = $arrayParametros['strFecha'] ? $arrayParametros['strFecha']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT ice.ID_CLT_ENCUESTA ";
            $strFrom        = "FROM INFO_CLIENTE_ENCUESTA ice ";
            $strWhere       = "WHERE ice.SUCURSAL_ID = :IDSUCURSAL ".
                                     " AND ice.CLIENTE_ID = :IDCLIENTE ".
                                     " AND ice.ENCUESTA_ID = :IDENCUESTA ".
                                     " AND ice.CONTENIDO_ID = :IDCONTENIDO ".
                                     " AND ice.ESTADO = :ESTADO ".
                                     " AND DATE(ice.FE_CREACION) = :FECHA ";
            $objQuery->setParameter("IDSUCURSAL", $intSucursalId);
            $objQuery->setParameter("IDCLIENTE", $intClienteId);
            $objQuery->setParameter("IDENCUESTA", $intEncuestaId);
            $objQuery->setParameter("IDCONTENIDO", $intContenidoId);
            $objQuery->setParameter("ESTADO", $strEstado);
            $objQuery->setParameter("FECHA", $strFecha);
            $objRsmBuilder->addScalarResult('ID_CLT_ENCUESTA', 'ID_ENCUESTA', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }


    /**
     * Documentación para la función 'getClienteEncuesta'
     * Método encargado de retornar las relaciones entre cliente y encuesta según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 27-09-2019
     * 
     * @return array  $arrayCltEncuesta
     * 
     */    
    public function getClienteEncuesta($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $strMes             = $arrayParametros['strMes'] ? $arrayParametros['strMes']:'';
        $strAnio            = $arrayParametros['strAnio'] ? $arrayParametros['strAnio']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT IE.ID_ENCUESTA, IE.TITULO,
                                IFNULL( (SELECT COUNT(*) 
                                            FROM INFO_CLIENTE_ENCUESTA ICE
                                            WHERE ICE.ENCUESTA_ID = IE.ID_ENCUESTA 
                                            AND EXTRACT(MONTH FROM ICE.FE_CREACION) = :strMes
                                            AND EXTRACT(YEAR  FROM ICE.FE_CREACION) = :strAnio
                                            GROUP BY ICE.ENCUESTA_ID) ,0) AS CANTIDAD ";
            $strFrom        = "FROM INFO_ENCUESTA IE ";
            $strWhere       = "WHERE IE.ESTADO in (:ESTADO) ";
            $objQuery->setParameter("ESTADO",$strEstado);
            $objQuery->setParameter("strMes", $strMes);
            $objQuery->setParameter("strAnio", $strAnio);
            $objRsmBuilder->addScalarResult('ID_ENCUESTA', 'ID_ENCUESTA', 'string');
            $objRsmBuilder->addScalarResult('TITULO', 'TITULO', 'string');
            $objRsmBuilder->addScalarResult('CANTIDAD', 'CANTIDAD', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }
    /**
     * Documentación para la función 'getClienteEncuestaSemestral'
     * Método encargado de retornar las relaciones entre cliente y encuesta semestrales 
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     * 
     * @return array  $arrayCltEncuesta
     * 
     */
    public function getClienteEncuestaSemestral($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $strLimite          = $arrayParametros['strLimite'] ? $arrayParametros['strLimite']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT IE.ID_ENCUESTA, IE.TITULO,
                                    EXTRACT(MONTH FROM ICE.FE_CREACION) AS MES,
                                    EXTRACT(YEAR  FROM ICE.FE_CREACION) AS ANIO, 
                                    IFNULL(COUNT(*),0) AS CANTIDAD ";
            $strFrom        = " FROM INFO_CLIENTE_ENCUESTA ICE
                                    INNER JOIN INFO_ENCUESTA IE ON ICE.ENCUESTA_ID = IE.ID_ENCUESTA ";
            $strWhere       = " WHERE IE.ESTADO in (:ESTADO) ";
            $strGroup       = " GROUP BY ICE.ENCUESTA_ID,EXTRACT(MONTH FROM ICE.FE_CREACION),EXTRACT(YEAR  FROM ICE.FE_CREACION) ";
            $strOrder       = " ORDER BY ICE.FE_CREACION DESC ";
            $strLimit       = " LIMIT ".$strLimite." ";
            $objQuery->setParameter("ESTADO",$strEstado);

            $objRsmBuilder->addScalarResult('ID_ENCUESTA', 'ID_ENCUESTA', 'string');
            $objRsmBuilder->addScalarResult('TITULO', 'TITULO', 'string');
            $objRsmBuilder->addScalarResult('MES', 'MES', 'string');
            $objRsmBuilder->addScalarResult('ANIO', 'ANIO', 'string');
            $objRsmBuilder->addScalarResult('CANTIDAD', 'CANTIDAD', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroup.$strOrder.$strLimit;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }
    /**
     * Documentación para la función 'getClienteEncuestaSemanal'
     * Método encargado de retornar las relaciones entre cliente y encuesta semanal 
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     * 
     * @return array  $arrayCltEncuesta
     * 
     */
    public function getClienteEncuestaSemanal($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:array('ACTIVO','INACTIVO','ELIMINADO');
        $strLimite          = $arrayParametros['strLimite'] ? $arrayParametros['strLimite']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT IE.ID_ENCUESTA, 
                                IE.TITULO,
                                WEEK(ICE.FE_CREACION) AS SEMANA,
                                EXTRACT(YEAR  FROM ICE.FE_CREACION) AS ANIO, 
                                IFNULL(COUNT(*),0) AS CANTIDAD ";
            $strFrom        = " FROM INFO_CLIENTE_ENCUESTA ICE
                                    INNER JOIN INFO_ENCUESTA IE ON ICE.ENCUESTA_ID = IE.ID_ENCUESTA ";
            $strWhere       = " WHERE IE.ESTADO in (:ESTADO) ";
            $strGroup       = " GROUP BY ICE.ENCUESTA_ID,WEEK(ICE.FE_CREACION),EXTRACT(YEAR  FROM ICE.FE_CREACION) ";
            $strOrder       = " ORDER BY ICE.FE_CREACION DESC ";
            $strLimit       = " LIMIT ".$strLimite." ";
            $objQuery->setParameter("ESTADO",$strEstado);

            $objRsmBuilder->addScalarResult('ID_ENCUESTA', 'ID_ENCUESTA', 'string');
            $objRsmBuilder->addScalarResult('TITULO', 'TITULO', 'string');
            $objRsmBuilder->addScalarResult('SEMANA', 'SEMANA', 'string');
            $objRsmBuilder->addScalarResult('ANIO', 'ANIO', 'string');
            $objRsmBuilder->addScalarResult('CANTIDAD', 'CANTIDAD', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroup.$strOrder.$strLimit;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }
    /**
     * Documentación para la función 'getClienteGenero'
     * Método encargado de retornar los generos de los clientes
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     * 
     * @return array  $arrayCltEncuesta
     * 
     */
    public function getClienteGenero($arrayParametros)
    {
        $strMes             = $arrayParametros['strMes'] ? $arrayParametros['strMes']:'';
        $strAnio            = $arrayParametros['strAnio'] ? $arrayParametros['strAnio']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT UPPER(IC.GENERO) AS GENERO,COUNT(*) AS CANTIDAD ";
            $strFrom        = " FROM INFO_CLIENTE_ENCUESTA ICE
                                INNER JOIN INFO_CLIENTE IC ON ICE.CLIENTE_ID = IC.ID_CLIENTE ";
            $strWhere       = " WHERE EXTRACT(MONTH FROM ICE.FE_CREACION)  = :MES
                                    AND EXTRACT(YEAR FROM ICE.FE_CREACION) = :ANIO ";
            $strGroup       = " GROUP BY IC.GENERO ";
            $objQuery->setParameter("MES",$strMes);
            $objQuery->setParameter("ANIO",$strAnio);

            $objRsmBuilder->addScalarResult('CANTIDAD', 'CANTIDAD', 'string');
            $objRsmBuilder->addScalarResult('GENERO', 'GENERO', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroup;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }
    /**
     * Documentación para la función 'getClienteEdad'
     * Método encargado de retornar las edades de los clientes
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     * 
     * @return array  $arrayCltEncuesta
     * 
     */
    public function getClienteEdad($arrayParametros)
    {
        $strMes             = $arrayParametros['strMes'] ? $arrayParametros['strMes']:'';
        $strAnio            = $arrayParametros['strAnio'] ? $arrayParametros['strAnio']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            $strSelect      = "SELECT (SELECT CONCAT(VALOR1,' (',YEAR(NOW())-VALOR3, ' A ',YEAR(NOW())-VALOR2,' AÑOS)')
                                        FROM ADMI_PARAMETRO
                                        WHERE DESCRIPCION = 'EDAD' 
                                        AND EXTRACT(YEAR FROM IC.EDAD) >= VALOR2 
                                        AND EXTRACT(YEAR FROM IC.EDAD) <= VALOR3) AS GENERACION,
                                    COUNT(*) AS CANTIDAD  ";
            $strFrom        = " FROM INFO_CLIENTE_ENCUESTA ICE
                                    INNER JOIN INFO_CLIENTE IC 
                                        ON ICE.CLIENTE_ID = IC.ID_CLIENTE ";
            $strWhere       = " WHERE EXTRACT(MONTH FROM ICE.FE_CREACION)  = :MES
                                    AND EXTRACT(YEAR FROM ICE.FE_CREACION) = :ANIO ";
            $strGroup       = " GROUP BY GENERACION ";
            $objQuery->setParameter("MES",$strMes);
            $objQuery->setParameter("ANIO",$strAnio);

            $objRsmBuilder->addScalarResult('CANTIDAD', 'CANTIDAD', 'string');
            $objRsmBuilder->addScalarResult('GENERACION', 'GENERACION', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroup;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }
    /**
     * Documentación para la función 'getVigenciaEncuesta'
     * Método encargado de validar si el cliente ya generó una encuesta en el día
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 28-10-2019
     * 
     * @return array  $arrayCltEncuesta
     * 
     */
    public function getVigenciaEncuesta($arrayParametros)
    {
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $intIdSucursal      = $arrayParametros['intIdSucursal'] ? $arrayParametros['intIdSucursal']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $date               = date('Y-m-d H:i:s');
        try
        {
            $strSelect      = "SELECT COUNT(*) AS CANTIDAD ";
            $strFrom        = " FROM INFO_CLIENTE_ENCUESTA ICE ";
            $strWhere       = " WHERE TIMESTAMPDIFF(HOUR,ICE.FE_CREACION,'".$date."') < 24 
                                    AND ICE.CLIENTE_ID  = :CLIENTE_ID
                                    AND ICE.SUCURSAL_ID = :SUCURSAL_ID ";
            $objQuery->setParameter("CLIENTE_ID",$intIdCliente);
            $objQuery->setParameter("SUCURSAL_ID",$intIdSucursal);

            $objRsmBuilder->addScalarResult('CANTIDAD', 'CANTIDAD', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }
    /**
     * Documentación para la función 'getCantPtosResEnc'
     * Método encargado de que me retorne los restaurantes que yo he comido y llenado encuestas, 
     * devolviendo adicional el puntaje por restaurante.
     * 
     * @author Kevin Baque
     * @version 1.0 28-10-2019
     * 
     * @return array  $arrayCltEncuesta
     *
     * @author Kevin Baque
     * @version 1.0 25-01-2020 - Se agrega nueva forma para retornar los puntos pendientes.
     *
     */
    public function getCantPtosResEnc($arrayParametros)
    {
        $intIdCliente       = $arrayParametros['intIdCliente'] ? $arrayParametros['intIdCliente']:'';
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:'';
        $arrayCantPtos      = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        try
        {
            //SUM(ICE.CANTIDAD_PUNTOS) AS CANT_PUNTOS,
            $strSelect      = "SELECT IRE.NOMBRE_COMERCIAL,
                                      IRE.ID_RESTAURANTE,
                                      IRE.ICONO ";
            $strFrom        = " FROM INFO_CLIENTE_ENCUESTA ICE
                                JOIN INFO_SUCURSAL         ISUR ON ISUR.ID_SUCURSAL   = ICE.SUCURSAL_ID
                                JOIN INFO_RESTAURANTE      IRE  ON IRE.ID_RESTAURANTE = ISUR.RESTAURANTE_ID ";
            $strWhere       = " WHERE ISUR.ESTADO = :ESTADO
                                    AND IRE.ESTADO  = :ESTADO ";
            $strGroupBy     = " GROUP BY IRE.ID_RESTAURANTE ";
            $objQuery->setParameter("ESTADO",$strEstado);
            if(!empty($intIdCliente))
            {
                $strSelect .= ", (SELECT IFNULL(SUM(ICP.CANTIDAD_PUNTOS ),0) 
                                    FROM INFO_CLIENTE_PUNTO ICP 
                                    WHERE CLIENTE_ID = :CLIENTE_ID 
                                        AND ICP.RESTAURANTE_ID = IRE.ID_RESTAURANTE) AS CANT_PUNTOS ";
                $strSelect .= ", (SELECT IFNULL(SUM(ICEP.CANTIDAD_PUNTOS+ICSP.CANTIDAD_PUNTOS),0) 
                                  FROM INFO_CLIENTE_ENCUESTA ICEP 
                                    JOIN INFO_CONTENIDO_SUBIDO ICSP ON ICSP.ID_CONTENIDO_SUBIDO = ICEP.CONTENIDO_ID 
                                    JOIN INFO_SUCURSAL ISURP        ON ISURP.ID_SUCURSAL        = ICEP.SUCURSAL_ID
                                  WHERE ICEP.ESTADO          ='PENDIENTE' 
                                    AND ICEP.CLIENTE_ID      = :CLIENTE_ID 
                                    AND ISURP.RESTAURANTE_ID = IRE.ID_RESTAURANTE
                                    AND ICSP.ESTADO='PENDIENTE') AS CANT_PUNTOS_PENDIENTE ";
                $strWhere .= " AND ICE.CLIENTE_ID= :CLIENTE_ID ";
                $objQuery->setParameter("CLIENTE_ID",$intIdCliente);
            }

            $objRsmBuilder->addScalarResult('CANT_PUNTOS', 'CANT_PUNTOS', 'string');
            $objRsmBuilder->addScalarResult('CANT_PUNTOS_PENDIENTE', 'CANT_PUNTOS_PENDIENTE', 'string');
            $objRsmBuilder->addScalarResult('NOMBRE_COMERCIAL', 'RAZON_SOCIAL', 'string');
            $objRsmBuilder->addScalarResult('ICONO', 'ICONO', 'string');
            $objRsmBuilder->addScalarResult('ID_RESTAURANTE', 'IDRESTAURANTE', 'string');
            $strSql       = $strSelect.$strFrom.$strWhere.$strGroupBy;
            $objQuery->setSQL($strSql);
            $arrayCantPtos['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCantPtos['error'] = $strMensajeError;
        return $arrayCantPtos;
    }
    /**
     * Documentación para la función 'getVigenciaEncuestaPend'
     * Método encargado de retornar todas las encuestas en estado pendiente
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 28-10-2019
     * 
     * @return array  $arrayCltEncuesta
     * 
     */
    public function getVigenciaEncuestaPend($arrayParametros)
    {
        $strEstado          = $arrayParametros['strEstado'] ? $arrayParametros['strEstado']:'PENDIENTE';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $objRsmBuilder      = new ResultSetMappingBuilder($this->_em);
        $objQuery           = $this->_em->createNativeQuery(null, $objRsmBuilder);
        $date               = date('Y-m-d H:i:s');
        try
        {
           
            $strSelect      = "SELECT ICE.ID_CLT_ENCUESTA AS ID_CLT_ENCUESTA ";
            $strFrom        = " FROM INFO_CLIENTE_ENCUESTA ICE ";
            $strWhere       = " WHERE TIMESTAMPDIFF(HOUR,ICE.FE_CREACION,'".$date."') > 24
                                    AND ICE.ESTADO  = :ESTADO ";
            $objQuery->setParameter("ESTADO",$strEstado);

            $objRsmBuilder->addScalarResult('ID_CLT_ENCUESTA', 'ID_CLT_ENCUESTA', 'integer');
            $strSql       = $strSelect.$strFrom.$strWhere;
            $objQuery->setSQL($strSql);
            $arrayCltEncuesta['resultados'] = $objQuery->getResult();
        }
        catch(\Exception $ex)
        {
            $strMensajeError = $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        return $arrayCltEncuesta;
    }
}
