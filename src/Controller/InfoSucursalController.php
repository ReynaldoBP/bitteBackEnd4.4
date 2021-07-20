<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoRestaurante;
use App\Entity\InfoSucursal;
use App\Entity\InfoClienteEncuesta;
use App\Entity\InfoContenidoSubido;
use App\Entity\InfoRespuesta;
use App\Controller\DefaultController;
use App\Controller\ApiWebController;
use App\Entity\InfoBitacora;
use App\Entity\InfoDetalleBitacora;
use App\Entity\AdmiPais;
use App\Entity\AdmiProvincia;
use App\Entity\AdmiCiudad;
use App\Entity\AdmiParroquia;
class InfoSucursalController extends Controller
{
    /**
     * @Route("/getSucursal")
     *
     * Documentación para la función 'getSucursal'
     * Método encargado de listar las sucursales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @return array  $objResponse
     */
    public function getSucursalAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdRestaurante     = $request->query->get("strIdRestaurante") ? $request->query->get("strIdRestaurante"):'';
        $intIdUsuario         = $request->query->get("idUsuario") ? $request->query->get("idUsuario"):'';
        $intIdSucursal        = $request->query->get("idSucursal") ? $request->query->get("idSucursal"):'';
        $strIdentificacionRes = $request->query->get("identificacionRestaurante") ? $request->query->get("identificacionRestaurante"):'';
        $strEsMatriz          = $request->query->get("esMatriz") ? $request->query->get("esMatriz"):'';
        $strPais              = $request->query->get("pais") ? $request->query->get("pais"):'';
        $strProvincia         = $request->query->get("provincia") ? $request->query->get("provincia"):'';
        $strCiudad            = $request->query->get("ciudad") ? $request->query->get("ciudad"):'';
        $strParroquia         = $request->query->get("parroquia") ? $request->query->get("parroquia"):'';
        $strEstado            = $request->query->get("estado") ? $request->query->get("estado"):'';
        $strEstadoFacturacion = $request->query->get("estadoFacturacion") ? $request->query->get("estadoFacturacion"):'';
        $strUsuarioCreacion   = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $arraySucursal        = array();
        $strMensaje           = '';
        $strStatus            = 400;
        $objResponse          = new Response;
        try
        {
            $arrayParametros = array('strIdRestaurante'     => $strIdRestaurante,
                                    'intIdSucursal'         => $intIdSucursal,
                                    'intIdUsuario'          => $intIdUsuario,
                                    'strIdentificacionRes'  => $strIdentificacionRes,
                                    'strEsMatriz'           => $strEsMatriz,
                                    'strPais'               => $strPais,
                                    'strProvincia'          => $strProvincia,
                                    'strCiudad'             => $strCiudad,
                                    'strParroquia'          => $strParroquia,
                                    'strEstado'             => $strEstado,
                                    'strEstadoFacturacion'  => $strEstadoFacturacion
                                    );
            $arraySucursal = $this->getDoctrine()
                                  ->getRepository(InfoSucursal::class)
                                  ->getSucursalCriterio($arrayParametros);
            if(isset($arraySucursal['error']) && !empty($arraySucursal['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arraySucursal['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensaje ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arraySucursal['error'] = $strMensaje;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arraySucursal,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * @Route("/createSucursal")
     *
     * Documentación para la función 'createSucursal'
     * Método encargado de crear las sucursales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     *
     * @author Kevin Baque
     * @version 1.1 09-06-2021 - Se agrega horario de atención.
     *
     * @author Kevin Baque
     * @version 1.2 15-07-2021 - Se agrega lógica para ingresar historial de creación.
     *
     * @return array  $objResponse
     */
    public function createSucursalAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdRestaurante               = $request->query->get("strIdRestaurante")            ? $request->query->get("strIdRestaurante")            :'';
        $strIdentificacionRes           = $request->query->get("identificacionRestaurante")   ? $request->query->get("identificacionRestaurante")   :'';
        $strEsMatriz                    = $request->query->get("esMatriz")                    ? $request->query->get("esMatriz")                    :'';
        $strEnCentroComercial           = $request->query->get("enCentroComercial")           ? $request->query->get("enCentroComercial")           :'';
        $strDescripcion                 = $request->query->get("descripcion")                 ? $request->query->get("descripcion")                 :'';
        $strDireccion                   = $request->query->get("direccion")                   ? $request->query->get("direccion")                   :'';
        $strPais                        = $request->query->get("pais")                        ? $request->query->get("pais")                        :'';
        $strProvincia                   = $request->query->get("provincia")                   ? $request->query->get("provincia")                   :'';
        $strCiudad                      = $request->query->get("ciudad")                      ? $request->query->get("ciudad")                      :'';
        $strParroquia                   = $request->query->get("parroquia")                   ? $request->query->get("parroquia")                   :'';
        $floatLatitud                   = $request->query->get("latitud")                     ? $request->query->get("latitud")                     :'';
        $floatLongitud                  = $request->query->get("longitud")                    ? $request->query->get("longitud")                    :'';
        $strNumeroContacto              = $request->query->get("numeroContacto")              ? $request->query->get("numeroContacto")              :'';
        $strEstado                      = $request->query->get("estado")                      ? $request->query->get("estado")                      :'';
        $strEstadoFacturacion           = $request->query->get("estadoFacturacion")           ? $request->query->get("estadoFacturacion")           :'';
        $strUsuarioCreacion             = $request->query->get("usuarioCreacion")             ? $request->query->get("usuarioCreacion")             :'';
        $strHorarioAtencionLunesIni     = $request->query->get("horarioAtencionLunesIni")     ? $request->query->get("horarioAtencionLunesIni")     :'';
        $strHorarioAtencionLunesFin     = $request->query->get("horarioAtencionLunesFin")     ? $request->query->get("horarioAtencionLunesFin")     :'';
        $strHorarioAtencionMartesIni    = $request->query->get("horarioAtencionMartesIni")    ? $request->query->get("horarioAtencionMartesIni")    :'';
        $strHorarioAtencionMartesFin    = $request->query->get("horarioAtencionMartesFin")    ? $request->query->get("horarioAtencionMartesFin")    :'';
        $strHorarioAtencionMiercolesIni = $request->query->get("horarioAtencionMiercolesIni") ? $request->query->get("horarioAtencionMiercolesIni") :'';
        $strHorarioAtencionMiercolesFin = $request->query->get("horarioAtencionMiercolesFin") ? $request->query->get("horarioAtencionMiercolesFin") :'';
        $strHorarioAtencionJuevesIni    = $request->query->get("horarioAtencionJuevesIni")    ? $request->query->get("horarioAtencionJuevesIni")    :'';
        $strHorarioAtencionJuevesFin    = $request->query->get("horarioAtencionJuevesFin")    ? $request->query->get("horarioAtencionJuevesFin")    :'';
        $strHorarioAtencionViernesIni   = $request->query->get("horarioAtencionViernesIni")   ? $request->query->get("horarioAtencionViernesIni")   :'';
        $strHorarioAtencionViernesFin   = $request->query->get("horarioAtencionViernesFin")   ? $request->query->get("horarioAtencionViernesFin")   :'';
        $strHorarioAtencionSabadoIni    = $request->query->get("horarioAtencionSabadoIni")    ? $request->query->get("horarioAtencionSabadoIni")    :'';
        $strHorarioAtencionSabadoFin    = $request->query->get("horarioAtencionSabadoFin")    ? $request->query->get("horarioAtencionSabadoFin")    :'';
        $strHorarioAtencionDomingoIni   = $request->query->get("horarioAtencionDomingoIni")   ? $request->query->get("horarioAtencionDomingoIni")   :'';
        $strHorarioAtencionDomingoFin   = $request->query->get("horarioAtencionDomingoFin")   ? $request->query->get("horarioAtencionDomingoFin")   :'';
        $arrayBitacoraDetalle = array();
        $strDatetimeActual    = new \DateTime('now');
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $strDatetimeActual    = new \DateTime('now');
        $em                   = $this->getDoctrine()->getManager();
        $objApiWebController  = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();
            $objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->find($strIdRestaurante);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                $objRestaurante = $this->getDoctrine()
                                       ->getRepository(InfoRestaurante::class)
                                       ->findOneBy(array('IDENTIFICACION'=>$strIdentificacionRes));
                if(!is_object($objRestaurante) || empty($objRestaurante))
                {
                    throw new \Exception('No existe restaurante con la parámetros enviados.');
                }
            }
            $entitySucursal = new InfoSucursal();
            $entitySucursal->setRESTAURANTEID($objRestaurante);
            $entitySucursal->setDESCRIPCION($strDescripcion);
            $entitySucursal->setESMATRIZ($strEsMatriz);
            $entitySucursal->setENCENTROCOMERCIAL($strEnCentroComercial);
            $entitySucursal->setDIRECCION($strDireccion);
            $entitySucursal->setNUMEROCONTACTO($strNumeroContacto);
            $entitySucursal->setESTADOFACTURACION(strtoupper($strEstadoFacturacion));
            $entitySucursal->setESTADO(strtoupper($strEstado));
            $entitySucursal->setLATITUD($floatLatitud);
            $entitySucursal->setLONGITUD($floatLongitud);
            $entitySucursal->setPAIS($strPais);
            $entitySucursal->setPROVINCIA($strProvincia);
            $entitySucursal->setCIUDAD($strCiudad);
            $entitySucursal->setCODIGO_DIARIO("");
            $entitySucursal->setPARROQUIA($strParroquia);
            $entitySucursal->setUSRCREACION($strUsuarioCreacion);
            $entitySucursal->setFECREACION($strDatetimeActual);
            if(!empty($strHorarioAtencionLunesIni))
            {
                $entitySucursal->setHORA_LUNES_INI($strHorarioAtencionLunesIni);
            }
            if(!empty($strHorarioAtencionLunesFin))
            {
                $entitySucursal->setHORA_LUNES_FIN($strHorarioAtencionLunesFin);
            }
            if(!empty($strHorarioAtencionMartesIni))
            {
                $entitySucursal->setHORA_MARTES_INI($strHorarioAtencionMartesIni);
            }
            if(!empty($strHorarioAtencionMartesFin))
            {
                $entitySucursal->setHORA_MARTES_FIN($strHorarioAtencionMartesFin);
            }
            if(!empty($strHorarioAtencionMiercolesIni))
            {
                $entitySucursal->setHORA_MIERCOLES_INI($strHorarioAtencionMiercolesIni);
            }
            if(!empty($strHorarioAtencionMiercolesFin))
            {
                $entitySucursal->setHORA_MIERCOLES_FIN($strHorarioAtencionMiercolesFin);
            }
            if(!empty($strHorarioAtencionJuevesIni))
            {
                $entitySucursal->setHORA_JUEVES_INI($strHorarioAtencionJuevesIni);
            }
            if(!empty($strHorarioAtencionJuevesFin))
            {
                $entitySucursal->setHORA_JUEVES_FIN($strHorarioAtencionJuevesFin);
            }
            if(!empty($strHorarioAtencionViernesIni))
            {
                $entitySucursal->setHORA_VIERNES_INI($strHorarioAtencionViernesIni);
            }
            if(!empty($strHorarioAtencionViernesFin))
            {
                $entitySucursal->setHORA_VIERNES_FIN($strHorarioAtencionViernesFin);
            }
            if(!empty($strHorarioAtencionSabadoIni))
            {
                $entitySucursal->setHORA_SABADO_INI($strHorarioAtencionSabadoIni);
            }
            if(!empty($strHorarioAtencionSabadoFin))
            {
                $entitySucursal->setHORA_SABADO_FIN($strHorarioAtencionSabadoFin);
            }
            if(!empty($strHorarioAtencionDomingoIni))
            {
                $entitySucursal->setHORA_DOMINGO_INI($strHorarioAtencionDomingoIni);
            }
            if(!empty($strHorarioAtencionDomingoFin))
            {
                $entitySucursal->setHORA_DOMINGO_FIN($strHorarioAtencionDomingoFin);
            }

            $arrayBitacoraDetalle[]= array('CAMPO'          => "Restaurante",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $objRestaurante->getNOMBRECOMERCIAL(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strDescripcion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Es Matriz",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEsMatriz,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Es Centro Comercial",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEnCentroComercial,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Dirección",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strDireccion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Número de contacto",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strNumeroContacto,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado de Facturación",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEstadoFacturacion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEstado,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Latitud",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $floatLatitud,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Longitud",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $floatLongitud,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($strPais))
            {
                $objPais = $this->getDoctrine()
                                ->getRepository(AdmiPais::class)
                                ->find($strPais);
                if(is_object($objPais) && !empty($objPais))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "País",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => $objPais->getPAIS_NOMBRE(),
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
            }
            if(!empty($strProvincia))
            {
                $objProvincia = $this->getDoctrine()
                                     ->getRepository(AdmiProvincia::class)
                                     ->find($strProvincia);
                if(is_object($objProvincia) && !empty($objProvincia))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Provincia",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => $objProvincia->getPROVINCIANOMBRE(),
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
            }
            if(!empty($strCiudad))
            {
                $objCiudad = $this->getDoctrine()
                                  ->getRepository(AdmiCiudad::class)
                                  ->find($strCiudad);
                if(is_object($objCiudad) && !empty($objCiudad))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Ciudad",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => $objCiudad->getCIUDAD_NOMBRE(),
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
            }
            if(!empty($strParroquia))
            {
                $objParroquia = $this->getDoctrine()
                                     ->getRepository(AdmiParroquia::class)
                                     ->find($strParroquia);
                if(is_object($objParroquia) && !empty($objParroquia))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Parroquia",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => $objParroquia->getPARROQUIANOMBRE(),
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Lunes Ini",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionLunesIni,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Lunes Fin",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionLunesFin,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Martes Ini",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionMartesIni,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Martes Fin",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionMartesFin,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Miercoles Ini",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionMiercolesIni,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Miercoles Fin",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionMiercolesFin,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Jueves Ini",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionJuevesIni,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Jueves Fin",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionJuevesFin,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Viernes Ini",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionViernesIni,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Viernes Fin",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionViernesFin,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Sábado Ini",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionSabadoIni,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Sábado Fin",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionSabadoFin,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Domingo Ini",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionDomingoIni,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Domingo Fin",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strHorarioAtencionDomingoFin,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $em->persist($entitySucursal);
            $em->flush();
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => "Creación",
                                                           "strModulo"            => "Sucursal",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $entitySucursal->getId(),
                                                           "strReferenciaValor"   => $entitySucursal->getRESTAURANTEID()->getNOMBRECOMERCIAL()." / ".$entitySucursal->getDESCRIPCION(),
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Sucursal creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear una sucursal, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $strMensajeError,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * @Route("/editSucursal")
     *
     * Documentación para la función 'editSucursal'
     * Método encargado de editar las sucursales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 09-06-2021 - Se agrega horario de atención.
     *
     * @author Kevin Baque
     * @version 1.2 03-07-2021 - Se agrega bandera para eliminar de forma permanente 
     *                           las sucursales y todo lo relacionado menos puntos.
     *
     * @author Kevin Baque
     * @version 1.3 18-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function editSucursalAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdRestaurante               = $request->query->get("strIdRestaurante")            ? $request->query->get("strIdRestaurante")            :'';
        $strIdentificacionRes           = $request->query->get("identificacionRestaurante")   ? $request->query->get("identificacionRestaurante")   :'';
        $intIdSucursal                  = $request->query->get("idSucursal")                  ? $request->query->get("idSucursal")                  :'';
        $strEsMatriz                    = $request->query->get("esMatriz")                    ? $request->query->get("esMatriz")                    :'';
        $strEnCentroComercial           = $request->query->get("enCentroComercial")           ? $request->query->get("enCentroComercial")           :'';
        $strDescripcion                 = $request->query->get("descripcion")                 ? $request->query->get("descripcion")                 :'';
        $strDireccion                   = $request->query->get("direccion")                   ? $request->query->get("direccion")                   :'';
        $strPais                        = $request->query->get("pais")                        ? $request->query->get("pais")                        :'';
        $strProvincia                   = $request->query->get("provincia")                   ? $request->query->get("provincia")                   :'';
        $strCiudad                      = $request->query->get("ciudad")                      ? $request->query->get("ciudad")                      :'';
        $strParroquia                   = $request->query->get("parroquia")                   ? $request->query->get("parroquia")                   :'';
        $floatLatitud                   = $request->query->get("latitud")                     ? $request->query->get("latitud")                     :'';
        $floatLongitud                  = $request->query->get("longitud")                    ? $request->query->get("longitud")                    :'';
        $strNumeroContacto              = $request->query->get("numeroContacto")              ? $request->query->get("numeroContacto")              :'';
        $strEstado                      = $request->query->get("estado")                      ? $request->query->get("estado")                      :'';
        $strEstadoFacturacion           = $request->query->get("estadoFacturacion")           ? $request->query->get("estadoFacturacion")           :'';
        $strUsuarioCreacion             = $request->query->get("usuarioModificacion")         ? $request->query->get("usuarioModificacion")         :'';
        $strHorarioAtencionLunesIni     = $request->query->get("horarioAtencionLunesIni")     ? $request->query->get("horarioAtencionLunesIni")     :'';
        $strHorarioAtencionLunesFin     = $request->query->get("horarioAtencionLunesFin")     ? $request->query->get("horarioAtencionLunesFin")     :'';
        $strHorarioAtencionMartesIni    = $request->query->get("horarioAtencionMartesIni")    ? $request->query->get("horarioAtencionMartesIni")    :'';
        $strHorarioAtencionMartesFin    = $request->query->get("horarioAtencionMartesFin")    ? $request->query->get("horarioAtencionMartesFin")    :'';
        $strHorarioAtencionMiercolesIni = $request->query->get("horarioAtencionMiercolesIni") ? $request->query->get("horarioAtencionMiercolesIni") :'';
        $strHorarioAtencionMiercolesFin = $request->query->get("horarioAtencionMiercolesFin") ? $request->query->get("horarioAtencionMiercolesFin") :'';
        $strHorarioAtencionJuevesIni    = $request->query->get("horarioAtencionJuevesIni")    ? $request->query->get("horarioAtencionJuevesIni")    :'';
        $strHorarioAtencionJuevesFin    = $request->query->get("horarioAtencionJuevesFin")    ? $request->query->get("horarioAtencionJuevesFin")    :'';
        $strHorarioAtencionViernesIni   = $request->query->get("horarioAtencionViernesIni")   ? $request->query->get("horarioAtencionViernesIni")   :'';
        $strHorarioAtencionViernesFin   = $request->query->get("horarioAtencionViernesFin")   ? $request->query->get("horarioAtencionViernesFin")   :'';
        $strHorarioAtencionSabadoIni    = $request->query->get("horarioAtencionSabadoIni")    ? $request->query->get("horarioAtencionSabadoIni")    :'';
        $strHorarioAtencionSabadoFin    = $request->query->get("horarioAtencionSabadoFin")    ? $request->query->get("horarioAtencionSabadoFin")    :'';
        $strHorarioAtencionDomingoIni   = $request->query->get("horarioAtencionDomingoIni")   ? $request->query->get("horarioAtencionDomingoIni")   :'';
        $strHorarioAtencionDomingoFin   = $request->query->get("horarioAtencionDomingoFin")   ? $request->query->get("horarioAtencionDomingoFin")   :'';
        $strEliminar                    = $request->query->get("eliminar")                    ? $request->query->get("eliminar")                    :'N';
        $arrayBitacoraDetalle   = array();
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        $objApiWebController    = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();
            $objRestaurante = $this->getDoctrine()
                                  ->getRepository(InfoRestaurante::class)
                                  ->find($strIdRestaurante);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                $objRestaurante = $this->getDoctrine()
                                       ->getRepository(InfoRestaurante::class)
                                       ->findOneBy(array('IDENTIFICACION'=>$strIdentificacionRes));
                if(!is_object($objRestaurante) || empty($objRestaurante))
                {
                    throw new \Exception('No existe restaurante con la parámetros enviados.');
                }
            }
            $entitySucursal      = $em->getRepository(InfoSucursal::class)->find($intIdSucursal);
            $strReferenciaValor  = $entitySucursal->getRESTAURANTEID()->getNOMBRECOMERCIAL()." / ".$entitySucursal->getDESCRIPCION();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Restaurante",
                                           'VALOR_ANTERIOR' => $entitySucursal->getRESTAURANTEID()->getNOMBRECOMERCIAL(),
                                           'VALOR_ACTUAL'   => $objRestaurante->getNOMBRECOMERCIAL(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $entitySucursal->setRESTAURANTEID($objRestaurante);
            if(!empty($strDescripcion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                               'VALOR_ANTERIOR' => $entitySucursal->getDESCRIPCION(),
                                               'VALOR_ACTUAL'   => $strDescripcion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setDESCRIPCION($strDescripcion);
            }
            if(!empty($strEsMatriz))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Es Matriz",
                                               'VALOR_ANTERIOR' => $entitySucursal->getESMATRIZ(),
                                               'VALOR_ACTUAL'   => $strEsMatriz,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setESMATRIZ($strEsMatriz);
            }
            if(!empty($strEnCentroComercial))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Es Centro Comercial",
                                               'VALOR_ANTERIOR' => $entitySucursal->getENCENTROCOMERCIAL(),
                                               'VALOR_ACTUAL'   => $strEnCentroComercial,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setENCENTROCOMERCIAL($strEnCentroComercial);
            }
            if(!empty($strDireccion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Dirección",
                                               'VALOR_ANTERIOR' => $entitySucursal->getDIRECCION(),
                                               'VALOR_ACTUAL'   => $strDireccion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setDIRECCION($strDireccion);
            }
            if(!empty($strNumeroContacto))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Número de contacto",
                                               'VALOR_ANTERIOR' => $entitySucursal->getNUMEROCONTACTO(),
                                               'VALOR_ACTUAL'   => $strNumeroContacto,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setNUMEROCONTACTO($strNumeroContacto);
            }
            if(!empty($strEstadoFacturacion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado de Facturación",
                                               'VALOR_ANTERIOR' => $entitySucursal->getESTADOFACTURACION(),
                                               'VALOR_ACTUAL'   => $strEstadoFacturacion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setESTADOFACTURACION(strtoupper($strEstadoFacturacion));
            }
            if(!empty($strEstado))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                               'VALOR_ANTERIOR' => $entitySucursal->getESTADO(),
                                               'VALOR_ACTUAL'   => $strEstado,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setESTADO(strtoupper($strEstado));
            }
            if(!empty($floatLatitud))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Latitud",
                                               'VALOR_ANTERIOR' => $entitySucursal->getLATITUD(),
                                               'VALOR_ACTUAL'   => $floatLatitud,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setLATITUD($floatLatitud);
            }
            if(!empty($floatLongitud))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Longitud",
                                               'VALOR_ANTERIOR' => $entitySucursal->getLONGITUD(),
                                               'VALOR_ACTUAL'   => $floatLongitud,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setLONGITUD($floatLongitud);
            }
            if(!empty($strPais))
            {
                $strNombrePaisAnterior = "";
                if(!empty($entitySucursal->getPAIS()))
                {
                    $objPaisAnterior = $this->getDoctrine()
                                            ->getRepository(AdmiPais::class)
                                            ->find($entitySucursal->getPAIS());
                    $strNombrePaisAnterior = (!empty($objPaisAnterior) && is_object($objPaisAnterior)) ? $objPaisAnterior->getPAIS_NOMBRE():"";
                }
                $objPais = $this->getDoctrine()
                                ->getRepository(AdmiPais::class)
                                ->find($strPais);
                if(is_object($objPais) && !empty($objPais))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "País",
                                                'VALOR_ANTERIOR' => $strNombrePaisAnterior,
                                                'VALOR_ACTUAL'   => $objPais->getPAIS_NOMBRE(),
                                                'USUARIO_ID'     => $strUsuarioCreacion);
                    $entitySucursal->setPAIS($strPais);
                }
            }
            if(!empty($strProvincia))
            {
                $strNombreProvinciaAnterior = "";
                if(!empty($entitySucursal->getPROVINCIA()))
                {
                    $objProvinciaAnterior = $this->getDoctrine()
                                                 ->getRepository(AdmiProvincia::class)
                                                 ->find($entitySucursal->getPROVINCIA());
                    $strNombreProvinciaAnterior = (!empty($objProvinciaAnterior) && is_object($objProvinciaAnterior)) ? $objProvinciaAnterior->getPROVINCIANOMBRE():"";
                }
                $objProvincia = $this->getDoctrine()
                                     ->getRepository(AdmiProvincia::class)
                                     ->find($strProvincia);
                if(is_object($objProvincia) && !empty($objProvincia))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Provincia",
                                                    'VALOR_ANTERIOR' => $strNombreProvinciaAnterior,
                                                    'VALOR_ACTUAL'   => $objProvincia->getPROVINCIANOMBRE(),
                                                    'USUARIO_ID'     => $strUsuarioCreacion);
                    $entitySucursal->setPROVINCIA($strProvincia);
                }
            }
            if(!empty($strCiudad))
            {
                $strNombreCiudadAnterior = "";
                if(!empty($entitySucursal->getCIUDAD()))
                {
                    $objCiudadAnterior = $this->getDoctrine()
                                              ->getRepository(AdmiCiudad::class)
                                              ->find($entitySucursal->getCIUDAD());
                    $strNombreCiudadAnterior = (!empty($objCiudadAnterior) && is_object($objCiudadAnterior)) ? $objCiudadAnterior->getCIUDAD_NOMBRE():"";
                }
                $objCiudad = $this->getDoctrine()
                                  ->getRepository(AdmiCiudad::class)
                                  ->find($strCiudad);
                if(is_object($objCiudad) && !empty($objCiudad))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Ciudad",
                                                   'VALOR_ANTERIOR' => $strNombreCiudadAnterior,
                                                   'VALOR_ACTUAL'   => $objCiudad->getCIUDAD_NOMBRE(),
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                    $entitySucursal->setCIUDAD($strCiudad);
                }
            }
            if(!empty($strParroquia))
            {
                $strNombreParroquiaAnterior = "";
                if(!empty($entitySucursal->getPARROQUIA()))
                {
                    $objParroquiaAnterior = $this->getDoctrine()
                                                 ->getRepository(AdmiParroquia::class)
                                                 ->find($entitySucursal->getPARROQUIA());
                    $strNombreParroquiaAnterior = (!empty($objParroquiaAnterior) && is_object($objParroquiaAnterior)) ? $objParroquiaAnterior->getPARROQUIANOMBRE():"";
                }
                $objParroquia = $this->getDoctrine()
                                     ->getRepository(AdmiParroquia::class)
                                     ->find($strParroquia);
                if(is_object($objParroquia) && !empty($objParroquia))
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Parroquia",
                                                   'VALOR_ANTERIOR' => $strNombreParroquiaAnterior,
                                                   'VALOR_ACTUAL'   => $objParroquia->getPARROQUIANOMBRE(),
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                    $entitySucursal->setPARROQUIA($strParroquia);
                }
            }
            if(!empty($strHorarioAtencionLunesIni))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Lunes Ini",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_LUNES_INI(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionLunesIni,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_LUNES_INI($strHorarioAtencionLunesIni);
            }
            if(!empty($strHorarioAtencionLunesFin))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Lunes Fin",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_LUNES_FIN(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionLunesFin,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_LUNES_FIN($strHorarioAtencionLunesFin);
            }
            if(!empty($strHorarioAtencionMartesIni))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Martes Ini",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_MARTES_INI(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionMartesIni,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_MARTES_INI($strHorarioAtencionMartesIni);
            }
            if(!empty($strHorarioAtencionMartesFin))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Martes Fin",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_MARTES_FIN(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionMartesFin,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_MARTES_FIN($strHorarioAtencionMartesFin);
            }
            if(!empty($strHorarioAtencionMiercolesIni))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Miercoles Ini",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_MIERCOLES_INI(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionMiercolesIni,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_MIERCOLES_INI($strHorarioAtencionMiercolesIni);
            }
            if(!empty($strHorarioAtencionMiercolesFin))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Miercoles Fin",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_MIERCOLES_FIN(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionMiercolesFin,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_MIERCOLES_FIN($strHorarioAtencionMiercolesFin);
            }
            if(!empty($strHorarioAtencionJuevesIni))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Jueves Ini",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_JUEVES_INI(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionJuevesIni,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_JUEVES_INI($strHorarioAtencionJuevesIni);
            }
            if(!empty($strHorarioAtencionJuevesFin))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Jueves Fin",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_JUEVES_FIN(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionJuevesFin,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_JUEVES_FIN($strHorarioAtencionJuevesFin);
            }
            if(!empty($strHorarioAtencionViernesIni))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Viernes Ini",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_VIERNES_INI(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionViernesIni,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_VIERNES_INI($strHorarioAtencionViernesIni);
            }
            if(!empty($strHorarioAtencionViernesFin))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Viernes Fin",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_VIERNES_FIN(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionViernesFin,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_VIERNES_FIN($strHorarioAtencionViernesFin);
            }
            if(!empty($strHorarioAtencionSabadoIni))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Sábado Ini",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_SABADO_INI(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionSabadoIni,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_SABADO_INI($strHorarioAtencionSabadoIni);
            }
            if(!empty($strHorarioAtencionSabadoFin))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Sábado Fin",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_SABADO_FIN(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionSabadoFin,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_SABADO_FIN($strHorarioAtencionSabadoFin);
            }
            if(!empty($strHorarioAtencionDomingoIni))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Domingo Ini",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_DOMINGO_INI(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionDomingoIni,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_DOMINGO_INI($strHorarioAtencionDomingoIni);
            }
            if(!empty($strHorarioAtencionDomingoFin))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Hora Domingo Fin",
                                               'VALOR_ANTERIOR' => $entitySucursal->getHORA_DOMINGO_FIN(),
                                               'VALOR_ACTUAL'   => $strHorarioAtencionDomingoFin,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entitySucursal->setHORA_DOMINGO_FIN($strHorarioAtencionDomingoFin);
            }
            $entitySucursal->setUSRMODIFICACION($strUsuarioCreacion);
            $entitySucursal->setFEMODIFICACION($strDatetimeActual);
            if(!empty($strEliminar) && $strEliminar == "S")
            {
                $objController        = new DefaultController();
                $objController->setContainer($this->container);
                $arrayInfoCltEncuesta = $this->getDoctrine()
                                             ->getRepository(InfoClienteEncuesta::class)
                                             ->findBy(array('SUCURSAL_ID' => $entitySucursal->getId()));
                if(!empty($arrayInfoCltEncuesta) && is_array($arrayInfoCltEncuesta))
                {
                    foreach($arrayInfoCltEncuesta as $objItem)
                    {
                        $arrayContenido = $this->getDoctrine()
                                               ->getRepository(InfoContenidoSubido::class)
                                               ->findBy(array('id' => $objItem->getCONTENIDOID()));
                        if(!empty($arrayContenido) && is_array($arrayContenido))
                        {
                            foreach($arrayContenido as $objItemContenido)
                            {
                                $objController->getEliminarImg($objItemContenido->getIMAGEN());
                                $em->remove($objItemContenido);
                            }
                        }
                        $arrayRespuesta = $this->getDoctrine()
                                               ->getRepository(InfoRespuesta::class)
                                               ->findBy(array('CLT_ENCUESTA_ID' => $objItem->getId()));
                        if(!empty($arrayRespuesta) && is_array($arrayRespuesta))
                        {
                            foreach($arrayRespuesta as $objItemRespuesta)
                            {
                                $em->remove($objItemRespuesta);
                            }
                        }
                        $em->remove($objItem);
                    }
                }
                $em->remove($entitySucursal);
            }
            else
            {
                $em->persist($entitySucursal);
            }
            $em->flush();
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => (!empty($strEliminar) && $strEliminar == "S")? 
                                                                                     "Eliminación":"Modificación",
                                                           "strModulo"            => "Sucursal",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $intIdSucursal,
                                                           "strReferenciaValor"   => $strReferenciaValor,
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Sucursal editada con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar una sucursal, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

}
