<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoRestaurante;
use App\Entity\InfoSucursal;
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
        $strDatetimeActual    = new \DateTime('now');
        $strMensajeError      = '';
        $strStatus            = 400;
        $objResponse          = new Response;
        $strDatetimeActual    = new \DateTime('now');
        $em                   = $this->getDoctrine()->getManager();

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


            $em->persist($entitySucursal);
            $em->flush();
            $strMensajeError = 'Sucursal creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
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
        $strUsuarioModificacion         = $request->query->get("usuarioModificacion")         ? $request->query->get("usuarioModificacion")         :'';
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
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();

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
            $entitySucursal = $em->getRepository(InfoSucursal::class)->find($intIdSucursal);
            $entitySucursal->setRESTAURANTEID($objRestaurante);
            if(!empty($strDescripcion))
            {
                $entitySucursal->setDESCRIPCION($strDescripcion);
            }
            if(!empty($strEsMatriz))
            {
                $entitySucursal->setESMATRIZ($strEsMatriz);
            }
            if(!empty($strEnCentroComercial))
            {
                $entitySucursal->setENCENTROCOMERCIAL($strEnCentroComercial);
            }
            if(!empty($strDireccion))
            {
                $entitySucursal->setDIRECCION($strDireccion);
            }
            if(!empty($strNumeroContacto))
            {
                $entitySucursal->setNUMEROCONTACTO($strNumeroContacto);
            }
            if(!empty($strEstadoFacturacion))
            {
                $entitySucursal->setESTADOFACTURACION(strtoupper($strEstadoFacturacion));
            }
            if(!empty($strEstado))
            {
                $entitySucursal->setESTADO(strtoupper($strEstado));
            }
            if(!empty($floatLatitud))
            {
                $entitySucursal->setLATITUD($floatLatitud);
            }
            if(!empty($floatLongitud))
            {
                $entitySucursal->setLONGITUD($floatLongitud);
            }
            if(!empty($strPais))
            {
                $entitySucursal->setPAIS($strPais);
            }
            if(!empty($strProvincia))
            {
                $entitySucursal->setPROVINCIA($strProvincia);
            }
            if(!empty($strCiudad))
            {
                $entitySucursal->setCIUDAD($strCiudad);
            }
            if(!empty($strParroquia))
            {
                $entitySucursal->setPARROQUIA($strParroquia);
            }
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
            $entitySucursal->setUSRMODIFICACION($strUsuarioModificacion);
            $entitySucursal->setFEMODIFICACION($strDatetimeActual);
            $em->persist($entitySucursal);
            $em->flush();
            $strMensajeError = 'Sucursal editada con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar una sucursal, intente nuevamente.\n ". $ex->getMessage();
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

}
