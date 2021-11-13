<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoRestaurante;
use App\Entity\AdmiTipoComida;
use App\Controller\DefaultController;
use App\Entity\InfoPublicidad;
use App\Entity\InfoPromocion;
use App\Entity\InfoSucursal;
use App\Entity\InfoCliente;
use App\Entity\InfoClienteInfluencer;
use App\Entity\InfoClienteEncuesta;
use App\Entity\InfoPromocionHistorial;
use App\Entity\InfoRespuesta;
use App\Entity\AdmiParametro;
use App\Entity\InfoUsuario;
use App\Entity\InfoRedesSociales;
use App\Entity\InfoVistaPublicidad;
use App\Entity\AdmiTipoRol;
use App\Entity\InfoUsuarioRes;
use App\Entity\InfoContenidoSubido;
use App\Entity\InfoCodigoPromocion;
use App\Entity\InfoBanner;
use App\Entity\InfoBitacora;
use App\Entity\InfoDetalleBitacora;
use App\Entity\AdmiPais;
use App\Entity\AdmiProvincia;
use App\Entity\AdmiCiudad;
use App\Entity\AdmiParroquia;
use App\Entity\InfoPlantilla;
use App\Entity\InfoCupon;
use App\Entity\AdmiTipoCupon;
use App\Entity\InfoCuponHistorial;
use App\Entity\InfoCuponRestaurante;
use App\Entity\InfoTipoComidaRestaurante;
use App\Entity\AdmiTipoPromocion;
use App\Entity\InfoCuponPromocion;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
class ApiWebController extends FOSRestController
{
    /**
     * @Rest\Post("/webBitte/procesar")
     */
    public function postAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strOperacion = $request->get('op');
        $arrayRequest = json_decode($request->getContent(),true);
        $arrayData    = $arrayRequest['data'];
        $objResponse  = new Response;
        if($strOperacion)
        {
            switch($strOperacion)
            {
                case 'createRestaurante':$arrayRespuesta = $this->createRestaurante($arrayData);
                break;
                case 'editRestaurante':$arrayRespuesta = $this->editRestaurante($arrayData);
                break;
                case 'getComidaRestaurante':$arrayRespuesta = $this->getComidaRestaurante($arrayData);
                break;
                case 'createPublicidad':$arrayRespuesta = $this->createPublicidad($arrayData);
                break;
                case 'editPublicidad':$arrayRespuesta = $this->editPublicidad($arrayData);
                break;
                case 'createPromocion':$arrayRespuesta = $this->createPromocion($arrayData);
                break;
                case 'editPromocion':$arrayRespuesta = $this->editPromocion($arrayData);
                break;
                case 'getCliente':$arrayRespuesta = $this->getCliente($arrayData);
                break;
                case 'createCltInfluencer':$arrayRespuesta = $this->createCltInfluencer($arrayData);
                break;
                case 'editCltInfluencer':$arrayRespuesta = $this->editCltInfluencer($arrayData);
                break;
                case 'getCltInfluencer':$arrayRespuesta = $this->getCltInfluencer($arrayData);
                break;
                case 'getClienteEncuesta':$arrayRespuesta = $this->getClienteEncuesta($arrayData);
                break;
                case 'getClienteEncuestaSemestral':$arrayRespuesta = $this->getClienteEncuestaSemestral($arrayData);
                break;
                case 'getClienteEncuestaSemanal':$arrayRespuesta = $this->getClienteEncuestaSemanal($arrayData);
                break;
                case 'editClienteEncuesta':$arrayRespuesta = $this->editClienteEncuesta($arrayData);
                break;
                case 'editSucursalEncuestasRealizadas':$arrayRespuesta = $this->editSucursalEncuestasRealizadas($arrayData);
                break;
                case 'editEstadoEncuestasRealizadas':$arrayRespuesta = $this->editEstadoEncuestasRealizadas($arrayData);
                break;
                case 'editPromocionHistorial':$arrayRespuesta = $this->editPromocionHistorial($arrayData);
                break;
                case 'getPromocionHistorial':$arrayRespuesta = $this->getPromocionHistorial($arrayData);
                break;
                case 'createPromocionHistorial':$arrayRespuesta = $this->createPromocionHistorial($arrayData);
                break;
                case 'getRedesSocialMensual':$arrayRespuesta = $this->getRedesSocialMensual($arrayData);
                break;
                case 'getClienteGenero':$arrayRespuesta = $this->getClienteGenero($arrayData);
                break;
                case 'getClienteEdad':$arrayRespuesta = $this->getClienteEdad($arrayData);
                break;
                case 'getResultadoProEncuesta':$arrayRespuesta = $this->getResultadoProEncuesta($arrayData);
                break;
                case 'getResultadoProPregunta':$arrayRespuesta = $this->getResultadoProPregunta($arrayData);
                break;
                case 'getResultadoProPublicaciones':$arrayRespuesta = $this->getResultadoProPublicaciones($arrayData);
                break;
                case 'getResultadosProIPN':$arrayRespuesta = $this->getResultadosProIPN($arrayData);
                break;
                case 'getPromedioRegistrosClt':$arrayRespuesta = $this->getPromedioRegistrosClt($arrayData);
                break;
                case 'getRegistrosClientes':$arrayRespuesta = $this->getRegistrosClientes($arrayData);
                break;
                case 'getComparativosRestaurantes':$arrayRespuesta = $this->getComparativosRestaurantes($arrayData);
                break;
                case 'getParametro':$arrayRespuesta = $this->getParametro($arrayData);
                break;
                case 'generarPass':$arrayRespuesta = $this->generarPass($arrayData);
                break;
                case 'getVistasPublicidades':$arrayRespuesta = $this->getVistasPublicidades($arrayData);
                break;
                case 'createCodigoPromocion':$arrayRespuesta = $this->createCodigoPromocion($arrayData);
                break;
                case 'editCodigoPromocion':$arrayRespuesta = $this->editCodigoPromocion($arrayData);
                break;
                case 'getCodigoPromocion':$arrayRespuesta = $this->getCodigoPromocion($arrayData);
                break;
                case 'getCiudadPorRestaurante':$arrayRespuesta = $this->getCiudadPorRestaurante($arrayData);
                break;
                case 'createBanner':$arrayRespuesta = $this->createBanner($arrayData);
                break;
                case 'editBanner':$arrayRespuesta = $this->editBanner($arrayData);
                break;
                case 'getBanner':$arrayRespuesta = $this->getBanner($arrayData);
                break;
                case 'getBitacora':$arrayRespuesta = $this->getBitacora($arrayData);
                break;
                case 'getBitacoraDetalle':$arrayRespuesta = $this->getBitacoraDetalle($arrayData);
                break;
                case 'createCupon':$arrayRespuesta = $this->createCupon($arrayData);
                break;
                case 'editCupon':$arrayRespuesta = $this->editCupon($arrayData);
                break;
                case 'getCupon':$arrayRespuesta = $this->getCupon($arrayData);
                break;
                case 'getTipoCupon':$arrayRespuesta = $this->getTipoCupon($arrayData);
                break;
                case 'getResumenCliente':$arrayRespuesta = $this->getResumenCliente($arrayData);
                break;
                case 'getTipoPromocion':$arrayRespuesta  = $this->getTipoPromocion($arrayData);
                break;
                 $objResponse->setContent(json_encode(array('status'    => 204,
                                                            'resultado' => "No existe método con la descripción enviado por parámetro",
                                                            'succes'    => true)));
                 $objResponse->headers->set('Access-Control-Allow-Origin', '*');
                 $arrayRespuesta = $objResponse;
             }
         }
        return $arrayRespuesta;
    }
    /**
     * Documentación para la función 'createRestaurante'
     * Método encargado de crear los restaurantes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 09-09-2019
     * 
     * @author Kevin Baque
     * @version 1.1 17-08-2020 - Se agrega la creación de codigo en el restaurante.
     *
     * @author Kevin Baque
     * @version 1.2 15-06-2021 - Se agrega la creación de afiliado en el restaurante.
     *
     * @author Kevin Baque
     * @version 1.3 15-07-2021 - Se agrega lógica para ingresar historial de creación.
     *
     * @author Kevin Baque
     * @version 1.4 01-09-2021 - Se agrega relación con los tipos de comida.
     *
     * @return array  $objResponse
     */
    public function createRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayTipoComida        = $arrayData['arrayTipoComida'] ? $arrayData['arrayTipoComida']:'';
        $strTipoIdentificacion  = $arrayData['tipoIdentificacion'] ? $arrayData['tipoIdentificacion']:'';
        $strIdentificacion      = $arrayData['identificacion'] ? $arrayData['identificacion']:'';
        $strRazonSocial         = $arrayData['razonSocial'] ? $arrayData['razonSocial']:'';
        $strNombreComercial     = $arrayData['nombreComercial'] ? $arrayData['nombreComercial']:'';
        $strRepresentanteLegal  = $arrayData['representanteLegal'] ? $arrayData['representanteLegal']:'';
        $strDireccionTributario = $arrayData['direcion'] ? $arrayData['direcion']:'';
        $strUrlCatalogo         = $arrayData['urlCatalogo'] ? $arrayData['urlCatalogo']:'';
        $strUrlRedSocial        = $arrayData['urlRedSocial'] ? $arrayData['urlRedSocial']:'';
        $strNumeroContacto      = $arrayData['numeroContacto'] ? $arrayData['numeroContacto']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strCodigo              = $arrayData['codigo'] ? $arrayData['codigo']:'NO';
        $strEsAfiliado          = $arrayData['esAfiliado'] ? $arrayData['esAfiliado']:'NO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $icoBase64              = $arrayData['rutaIcono'] ? $arrayData['rutaIcono']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $arrayBitacoraDetalle   = array();
        $objController->setContainer($this->container);
        try
        {
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,1);
            }
            if(!empty($icoBase64))
            {
                $strRutaIcono  = $objController->subirfichero($icoBase64,2);
            }
            $em->getConnection()->beginTransaction();
            if(strtoupper($strTipoIdentificacion) == 'RUC' && strlen(trim($strIdentificacion))!=13)
            {
                throw new \Exception('cantidad de dígitos incorrecto');
            }
            elseif(strtoupper($strTipoIdentificacion) == 'CED' && strlen(trim($strIdentificacion))!=10)
            {
                throw new \Exception('cantidad de dígitos incorrecto');
            }
            /*$objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->findOneBy(array('IDENTIFICACION'=>$strIdentificacion));
            if(is_object($objRestaurante) && !empty($objRestaurante))
            {
                throw new \Exception('Restaurante ya existente.');
            }*/
            $entityRestaurante = new InfoRestaurante();
            //$entityRestaurante->setTIPOCOMIDAID($objTipoComida);
            $entityRestaurante->setTIPOIDENTIFICACION(strtoupper($strTipoIdentificacion));
            $entityRestaurante->setIDENTIFICACION($strIdentificacion);
            $entityRestaurante->setRAZONSOCIAL($strRazonSocial);
            $entityRestaurante->setNOMBRECOMERCIAL($strNombreComercial);
            $entityRestaurante->setREPRESENTANTELEGAL($strRepresentanteLegal);
            $entityRestaurante->setDIRECCIONTRIBUTARIO($strDireccionTributario);
            $entityRestaurante->setURLCATALOGO($strUrlCatalogo);
            $entityRestaurante->setURLREDSOCIAL($strUrlRedSocial);
            $entityRestaurante->setIMAGEN($strRutaImagen);
            $entityRestaurante->setICONO($strRutaIcono);
            $entityRestaurante->setNUMEROCONTACTO($strNumeroContacto);
            $entityRestaurante->setESTADO(strtoupper($strEstado));
            $entityRestaurante->setCODIGO(strtoupper($strCodigo));
            $entityRestaurante->setES_AFILIADO(strtoupper($strEsAfiliado));
            $entityRestaurante->setUSRCREACION($strUsuarioCreacion);
            $entityRestaurante->setFECREACION($strDatetimeActual);
            $em->persist($entityRestaurante);
            $em->flush();
            if(!empty($arrayTipoComida) && is_array($arrayTipoComida))
            {
                foreach($arrayTipoComida as $arrayItem)
                {
                    $objTipoComida = $this->getDoctrine()
                                          ->getRepository(AdmiTipoComida::class)
                                          ->find($arrayItem);
                    if(!empty($objTipoComida) && is_object($objTipoComida))
                    {
                        $entityComidaRes = new InfoTipoComidaRestaurante();
                        $entityComidaRes->setRESTAURANTEID($entityRestaurante);
                        $entityComidaRes->setTIPOCOMIDAID($objTipoComida);
                        $entityComidaRes->setESTADO(strtoupper($strEstado));
                        $entityComidaRes->setUSRCREACION($strUsuarioCreacion);
                        $entityComidaRes->setFECREACION($strDatetimeActual);
                        $em->persist($entityComidaRes);
                        $em->flush();
                    }
                }
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Tipo Identificación",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strTipoIdentificacion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Identificación",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strIdentificacion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Razón Social",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strRazonSocial,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Nombre Comercial",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strNombreComercial,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Representante Legal",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strRepresentanteLegal,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Dirección Tributario",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strDireccionTributario,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Url Catalogo",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strUrlCatalogo,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Url Red Social",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strUrlRedSocial,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Número Contacto",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strNumeroContacto,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => strtoupper($strEstado),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Genera Código",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => strtoupper($strCodigo),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Es Afiliado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => strtoupper($strEsAfiliado),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Creación",
                                            "strModulo"            => "Restaurante",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $entityRestaurante->getId(),
                                            "strReferenciaValor"   => $entityRestaurante->getNOMBRECOMERCIAL(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Restaurante creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'editRestaurante'
     * Método encargado de editar los restaurantes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 17-08-2020 - Se agrega la edición de codigo en el restaurante.
     * 
     * @author Kevin Baque
     * @version 1.3 15-06-2021 - Se agrega la creación de afiliado en el restaurante.
     *
     * @author Kevin Baque
     * @version 1.4 15-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @author Kevin Baque
     * @version 1.5 01-09-2021 - Se agrega relación con los tipos de comida.
     *
     * @return array  $objResponse
     */
    public function editRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayTipoComida        = $arrayData['arrayTipoComida'] ? $arrayData['arrayTipoComida']:'';
        $strTipoIdentificacion  = $arrayData['tipoIdentificacion'] ? $arrayData['tipoIdentificacion']:'';
        $strIdentificacion      = $arrayData['identificacion'] ? $arrayData['identificacion']:'';
        $strIdRestaurante       = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $strRazonSocial         = $arrayData['razonSocial'] ? $arrayData['razonSocial']:'';
        $strNombreComercial     = $arrayData['nombreComercial'] ? $arrayData['nombreComercial']:'';
        $strRepresentanteLegal  = $arrayData['representanteLegal'] ? $arrayData['representanteLegal']:'';
        $strDireccionTributario = $arrayData['direcion'] ? $arrayData['direcion']:'';
        $strUrlCatalogo         = $arrayData['urlCatalogo'] ? $arrayData['urlCatalogo']:'';
        $strUrlRedSocial        = $arrayData['urlRedSocial'] ? $arrayData['urlRedSocial']:'';
        $strNumeroContacto      = $arrayData['numeroContacto'] ? $arrayData['numeroContacto']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strCodigo              = $arrayData['codigo'] ? $arrayData['codigo']:'NO';
        $strEsAfiliado          = $arrayData['esAfiliado'] ? $arrayData['esAfiliado']:'NO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $icoBase64              = $arrayData['rutaIcono'] ? $arrayData['rutaIcono']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        $arrayBitacoraDetalle   = array();
        try
        {
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,"1");
            }
            if(!empty($icoBase64))
            {
                $strRutaIcono = $objController->subirfichero($icoBase64,"2");
            }

            $em->getConnection()->beginTransaction();
            if(strtoupper($strTipoIdentificacion) == 'RUC' && strlen(trim($strIdentificacion))!=13)
            {
                throw new \Exception('cantidad de dígitos incorrecto');
            }
            elseif(strtoupper($strTipoIdentificacion) == 'CED' && strlen(trim($strIdentificacion))!=10)
            {
                throw new \Exception('cantidad de dígitos incorrecto');
            }
            $objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->find($strIdRestaurante);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                $objRestaurante = $this->getDoctrine()
                                       ->getRepository(InfoRestaurante::class)
                                       ->findOneBy(array('IDENTIFICACION'=>$strIdentificacion));
                if(!is_object($objRestaurante) || empty($objRestaurante))
                {
                    throw new \Exception('Restaurante no existe.');
                }
            }
            if(!empty($arrayTipoComida) && is_array($arrayTipoComida))
            {
                $arrayRelacionComidaRes = $this->getDoctrine()
                                               ->getRepository(InfoTipoComidaRestaurante::class)
                                               ->findBy(array("RESTAURANTE_ID" =>$objRestaurante->getId()));
                if(!empty($arrayRelacionComidaRes) && is_array($arrayRelacionComidaRes))
                {
                    foreach($arrayRelacionComidaRes as $objitem)
                    {
                        $em->remove($objitem);
                    }
                    $em->flush();
                }
                foreach($arrayTipoComida as $arrayItem)
                {
                    $objTipoComida = $this->getDoctrine()
                                          ->getRepository(AdmiTipoComida::class)
                                          ->find($arrayItem);
                    if(!empty($objTipoComida) && is_object($objTipoComida))
                    {
                        $entityComidaRes = new InfoTipoComidaRestaurante();
                        $entityComidaRes->setRESTAURANTEID($objRestaurante);
                        $entityComidaRes->setTIPOCOMIDAID($objTipoComida);
                        $entityComidaRes->setESTADO(strtoupper($strEstado));
                        $entityComidaRes->setUSRCREACION($strUsuarioCreacion);
                        $entityComidaRes->setFECREACION($strDatetimeActual);
                        $em->persist($entityComidaRes);
                        $em->flush();
                    }
                }
            }
            if(!empty($strTipoIdentificacion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Tipo Identificación",
                                               'VALOR_ANTERIOR' => $objRestaurante->getTIPOIDENTIFICACION(),
                                               'VALOR_ACTUAL'   => $strTipoIdentificacion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setTIPOIDENTIFICACION(strtoupper($strTipoIdentificacion));
            }
            if(!empty($strIdentificacion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Identificación",
                                               'VALOR_ANTERIOR' => $objRestaurante->getIDENTIFICACION(),
                                               'VALOR_ACTUAL'   => $strIdentificacion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setIDENTIFICACION($strIdentificacion);
            }
            if(!empty($strRazonSocial))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Razón Social",
                                               'VALOR_ANTERIOR' => $objRestaurante->getRAZONSOCIAL(),
                                               'VALOR_ACTUAL'   => $strRazonSocial,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setRAZONSOCIAL($strRazonSocial);
            }
            if(!empty($strNombreComercial))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Nombre Comercial",
                                               'VALOR_ANTERIOR' => $objRestaurante->getNOMBRECOMERCIAL(),
                                               'VALOR_ACTUAL'   => $strNombreComercial,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setNOMBRECOMERCIAL($strNombreComercial);
            }
            if(!empty($strRepresentanteLegal))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Representante Legal",
                                               'VALOR_ANTERIOR' => $objRestaurante->getREPRESENTANTELEGAL(),
                                               'VALOR_ACTUAL'   => $strRepresentanteLegal,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setREPRESENTANTELEGAL($strRepresentanteLegal);
            }
            if(!empty($strDireccionTributario))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Dirección Tributario",
                                               'VALOR_ANTERIOR' => $objRestaurante->getDIRECCIONTRIBUTARIO(),
                                               'VALOR_ACTUAL'   => $strDireccionTributario,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setDIRECCIONTRIBUTARIO($strDireccionTributario);
            }
            if(!empty($strUrlCatalogo))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Url Catalogo",
                                               'VALOR_ANTERIOR' => $objRestaurante->getURLCATALOGO(),
                                               'VALOR_ACTUAL'   => $strUrlCatalogo,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setURLCATALOGO($strUrlCatalogo);
            }
            if(!empty($strUrlRedSocial))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Url Red Social",
                                               'VALOR_ANTERIOR' => $objRestaurante->getURLREDSOCIAL(),
                                               'VALOR_ACTUAL'   => $strUrlRedSocial,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setURLREDSOCIAL($strUrlRedSocial);
            }
            if(!empty($strNumeroContacto))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Número Contacto",
                                               'VALOR_ANTERIOR' => $objRestaurante->getNUMEROCONTACTO(),
                                               'VALOR_ACTUAL'   => $strNumeroContacto,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setNUMEROCONTACTO($strNumeroContacto);
            }
            if(!empty($strEstado))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                               'VALOR_ANTERIOR' => $objRestaurante->getESTADO(),
                                               'VALOR_ACTUAL'   => strtoupper($strEstado),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setESTADO(strtoupper($strEstado));
            }
            if(!empty($strCodigo))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Genera Código",
                                               'VALOR_ANTERIOR' => $objRestaurante->getCODIGO(),
                                               'VALOR_ACTUAL'   => strtoupper($strCodigo),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setCODIGO(strtoupper($strCodigo));
            }
            if(!empty($strEsAfiliado))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Es Afiliado",
                                               'VALOR_ANTERIOR' => $objRestaurante->getES_AFILIADO(),
                                               'VALOR_ACTUAL'   => strtoupper($strEsAfiliado),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objRestaurante->setES_AFILIADO(strtoupper($strEsAfiliado));
            }
            if(!empty($strRutaImagen))
            {
                $objRestaurante->setIMAGEN($strRutaImagen);
            }
            if(!empty($strRutaIcono))
            {
                $objRestaurante->setICONO($strRutaIcono);
            }
            $objRestaurante->setUSRMODIFICACION($strUsuarioCreacion);
            $objRestaurante->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objRestaurante);
            $em->flush();
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Modificación",
                                            "strModulo"            => "Restaurante",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $objRestaurante->getId(),
                                            "strReferenciaValor"   => $objRestaurante->getNOMBRECOMERCIAL(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Restaurante editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = $ex->getMessage();
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

    /**
     * Documentación para la función 'getComidaRestaurante'
     * Función encargado de retornar las relaciones entre tipo de comida y restaurante, según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 31-08-2021
     *
     * @return array  $objResponse
     */
    public function getComidaRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante       = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $intIdTipoComida        = $arrayData['intIdTipoComida'] ? $arrayData['intIdTipoComida']:'';
        $arrayResultado         = array();
        $strMensajeError        = '';
        $boolSucces             = true;
        $strStatus              = 200;
        $objResponse            = new Response;
        try
        {
            $arrayResultado = $this->getDoctrine()
                                   ->getRepository(InfoTipoComidaRestaurante::class)
                                   ->getRelacionComidaResCriterio(array("intIdRestaurante" => $intIdRestaurante,
                                                                        "intIdTipoComida"  => $intIdTipoComida));
            if(isset($arrayResultado['error']) && !empty($arrayResultado['error']))
            {
                $strStatus  = 204;
                throw new \Exception($arrayResultado['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayResultado['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayResultado,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'createPublicidad'
     * Método encargado de crear las publicidades según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-09-2019
     *
     * @author Kevin Baque
     * @version 1.1 18-07-2021 - Se agrega lógica para ingresar historial de creación.
     *
     * @return array  $objResponse
     */
    public function createPublicidad($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDescrPublicidad     = $arrayData['descrPublicidad'] ? $arrayData['descrPublicidad']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $strOrientacion         = $arrayData['orientacion'] ? $arrayData['orientacion']:'';
        $strEdadMaxima          = $arrayData['edadMaxima'] ? $arrayData['edadMaxima']:'';
        $strEdadMinima          = $arrayData['edadMinima'] ? $arrayData['edadMinima']:'';
        $strGenero              = $arrayData['genero'] ? $arrayData['genero']:'';
        $strPais                = $arrayData['pais'] ? $arrayData['pais']:'TODOS';
        $strProvincia           = $arrayData['provincia'] ? $arrayData['provincia']:'TODOS';
        $strCiudad              = $arrayData['ciudad'] ? $arrayData['ciudad']:'TODOS';
        $strParroquia           = $arrayData['parroquia'] ? $arrayData['parroquia']:'TODOS';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $arrayBitacoraDetalle   = array();
        $objController->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,1);
            }
            $entityPublicidad = new InfoPublicidad();
            $entityPublicidad->setDESCRIPCION($strDescrPublicidad);
            $entityPublicidad->setIMAGEN($strRutaImagen);
            $entityPublicidad->setORIENTACION($strOrientacion);
            $entityPublicidad->setEDADMAXIMA($strEdadMaxima);
            $entityPublicidad->setEDADMINIMA($strEdadMinima);
            $entityPublicidad->setGENERO($strGenero);
            $entityPublicidad->setPAIS($strPais);
            $entityPublicidad->setPROVINCIA($strProvincia);
            $entityPublicidad->setCIUDAD($strCiudad);
            $entityPublicidad->setPARROQUIA($strParroquia);
            $entityPublicidad->setCANTVISTAS(0);
            $entityPublicidad->setESTADO(strtoupper($strEstado));
            $entityPublicidad->setUSRCREACION($strUsuarioCreacion);
            $entityPublicidad->setFECREACION($strDatetimeActual);
            $em->persist($entityPublicidad);
            $em->flush();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strDescrPublicidad,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Orientación",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strOrientacion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Edad máxima",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEdadMaxima,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Edad mínima",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEdadMinima,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Género",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strGenero,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($strPais))
            {
                if($strPais == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "País",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
                else
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
            }
            if(!empty($strProvincia))
            {
                if($strProvincia == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Provincia",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
                else
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
            }
            if(!empty($strCiudad))
            {
                if($strCiudad == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Ciudad",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
                else
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
            }
            if(!empty($strParroquia))
            {
                if($strParroquia == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Parroquia",
                                                   'VALOR_ANTERIOR' => "",
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                }
                else
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
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEstado,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Creación",
                                            "strModulo"            => "Publicidad",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $entityPublicidad->getId(),
                                            "strReferenciaValor"   => $entityPublicidad->getDESCRIPCION(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Publicidad creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear una Publicidad, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }
        $arrayPublicidad = array('id'             => $entityPublicidad->getId(),
                                 'descripcion'    => $entityPublicidad->getDESCRIPCION(),
                                 'edadMaxima'     => $entityPublicidad->getEDADMAXIMA(),
                                 'edadMinima'     => $entityPublicidad->getEDADMINIMA(),
                                 'genero'         => $entityPublicidad->getGENERO(),
                                 'estado'         => $entityPublicidad->getESTADO(),
                                 'usrCreacion'    => $entityPublicidad->getUSRCREACION(),
                                 'feCreacion'     => $entityPublicidad->getFECREACION(),
                                 'mensaje'        => $strMensajeError);
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayPublicidad,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'editPublicidad'
     * Método encargado de crear las publicidades según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-09-2019
     * 
     * @author Kevin Baque
     * @version 1.2 05-07-2021 - Se agrega bandera para eliminar de forma permanente 
     *                           las publicidades y todo lo relacionado.
     *
     * @author Kevin Baque
     * @version 1.3 16-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function editPublicidad($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPublicidad        = $arrayData['idPublicidad'] ? $arrayData['idPublicidad']:'';
        $strDescrPublicidad     = $arrayData['descrPublicidad'] ? $arrayData['descrPublicidad']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $strOrientacion         = $arrayData['orientacion'] ? $arrayData['orientacion']:'';
        $strEdadMaxima          = $arrayData['edadMaxima'] ? $arrayData['edadMaxima']:'';
        $strEdadMinima          = $arrayData['edadMinima'] ? $arrayData['edadMinima']:'';
        $strGenero              = $arrayData['genero'] ? $arrayData['genero']:'';
        $strPais                = $arrayData['pais'] ? $arrayData['pais']:'TODOS';
        $strProvincia           = $arrayData['provincia'] ? $arrayData['provincia']:'TODOS';
        $strCiudad              = $arrayData['ciudad'] ? $arrayData['ciudad']:'TODOS';
        $strParroquia           = $arrayData['parroquia'] ? $arrayData['parroquia']:'TODOS';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strEliminar            = $arrayData['eliminar'] ? $arrayData['eliminar']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $arrayBitacoraDetalle   = array();
        $objController->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();
            $objPublicidad = $this->getDoctrine()
                                  ->getRepository(InfoPublicidad::class)
                                  ->findOneBy(array('id'=>$intIdPublicidad));
            if(!is_object($objPublicidad) || empty($objPublicidad))
            {
                throw new \Exception('No existe publicidad con la identificación enviada por parámetro.');
            }
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,$intIdPublicidad);
                if(!empty($objPublicidad->getIMAGEN()))
                {
                    $objController->getEliminarImg($objPublicidad->getIMAGEN());
                }
            }
            if(!empty($strDescrPublicidad))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                               'VALOR_ANTERIOR' => $objPublicidad->getDESCRIPCION(),
                                               'VALOR_ACTUAL'   => $strDescrPublicidad,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPublicidad->setDESCRIPCION($strDescrPublicidad);
            }
            if(!empty($strRutaImagen))
            {
                $objPublicidad->setIMAGEN($strRutaImagen);
            }
            if(!empty($strOrientacion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Orientación",
                                               'VALOR_ANTERIOR' => $objPublicidad->getORIENTACION(),
                                               'VALOR_ACTUAL'   => $strOrientacion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPublicidad->setORIENTACION($strOrientacion);
            }
            if(!empty($strEdadMaxima))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Edad máxima",
                                               'VALOR_ANTERIOR' => $objPublicidad->getEDADMAXIMA(),
                                               'VALOR_ACTUAL'   => $strEdadMaxima,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPublicidad->setEDADMAXIMA($strEdadMaxima);
            }
            if(!empty($strEdadMinima))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Edad mínima",
                                               'VALOR_ANTERIOR' => $objPublicidad->getEDADMINIMA(),
                                               'VALOR_ACTUAL'   => $strEdadMinima,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPublicidad->setEDADMINIMA($strEdadMinima);
            }
            if(!empty($strGenero))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Género",
                                               'VALOR_ANTERIOR' => $objPublicidad->getGENERO(),
                                               'VALOR_ACTUAL'   => $strGenero,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPublicidad->setGENERO($strGenero);
            }
            if(!empty($strPais))
            {
                $strNombrePaisAnterior = "";
                if(!empty($objPublicidad->getPAIS()) && $objPublicidad->getPAIS() != "TODOS")
                {
                    $objPaisAnterior = $this->getDoctrine()
                                            ->getRepository(AdmiPais::class)
                                            ->find($objPublicidad->getPAIS());
                    $strNombrePaisAnterior = (!empty($objPaisAnterior) && is_object($objPaisAnterior)) ? $objPaisAnterior->getPAIS_NOMBRE():"";
                }
                if($strPais == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "País",
                                                   'VALOR_ANTERIOR' => $strNombrePaisAnterior,
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                    $objPublicidad->setPAIS($strPais);
                }
                else
                {
                    $objPais = $this->getDoctrine()
                                    ->getRepository(AdmiPais::class)
                                    ->find($strPais);
                    if(is_object($objPais) && !empty($objPais))
                    {
                        $arrayBitacoraDetalle[]= array('CAMPO'          => "País",
                                                       'VALOR_ANTERIOR' => $strNombrePaisAnterior,
                                                       'VALOR_ACTUAL'   => $objPais->getPAIS_NOMBRE(),
                                                       'USUARIO_ID'     => $strUsuarioCreacion);
                        $objPublicidad->setPAIS($strPais);
                    }
                }
            }
            if(!empty($strProvincia))
            {
                $strNombreProvinciaAnterior = "";
                if(!empty($objPublicidad->getPROVINCIA()) && $objPublicidad->getPROVINCIA() != "TODOS")
                {
                    $objProvinciaAnterior = $this->getDoctrine()
                                                 ->getRepository(AdmiProvincia::class)
                                                 ->find($objPublicidad->getPROVINCIA());
                    $strNombreProvinciaAnterior = (!empty($objProvinciaAnterior) && is_object($objProvinciaAnterior)) ? $objProvinciaAnterior->getPROVINCIANOMBRE():"";
                }
                if($strProvincia == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Provincia",
                                                   'VALOR_ANTERIOR' => $strNombreProvinciaAnterior,
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                    $objPublicidad->setPROVINCIA($strProvincia);
                }
                else
                {
                    $objProvincia = $this->getDoctrine()
                                         ->getRepository(AdmiProvincia::class)
                                         ->find($strProvincia);
                    if(is_object($objProvincia) && !empty($objProvincia))
                    {
                        $arrayBitacoraDetalle[]= array('CAMPO'          => "Provincia",
                                                       'VALOR_ANTERIOR' => $strNombreProvinciaAnterior,
                                                       'VALOR_ACTUAL'   => $objProvincia->getPROVINCIANOMBRE(),
                                                       'USUARIO_ID'     => $strUsuarioCreacion);
                        $objPublicidad->setPROVINCIA($strProvincia);
                    }
                }
            }
            if(!empty($strCiudad))
            {
                $strNombreCiudadAnterior = "";
                if(!empty($objPublicidad->getCIUDAD()) && $objPublicidad->getCIUDAD() != "TODOS")
                {
                    $objCiudadAnterior = $this->getDoctrine()
                                              ->getRepository(AdmiCiudad::class)
                                              ->find($objPublicidad->getCIUDAD());
                    $strNombreCiudadAnterior = (!empty($objCiudadAnterior) && is_object($objCiudadAnterior)) ? $objCiudadAnterior->getCIUDAD_NOMBRE():"";
                }
                if($strCiudad == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Ciudad",
                                                   'VALOR_ANTERIOR' => $strNombreCiudadAnterior,
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                    $objPublicidad->setCIUDAD($strCiudad);
                }
                else
                {
                    $objCiudad = $this->getDoctrine()
                                      ->getRepository(AdmiCiudad::class)
                                      ->find($strCiudad);
                    if(is_object($objCiudad) && !empty($objCiudad))
                    {
                        $arrayBitacoraDetalle[]= array('CAMPO'          => "Ciudad",
                                                       'VALOR_ANTERIOR' => $strNombreCiudadAnterior,
                                                       'VALOR_ACTUAL'   => $objCiudad->getCIUDAD_NOMBRE(),
                                                       'USUARIO_ID'     => $strUsuarioCreacion);
                        $objPublicidad->setCIUDAD($strCiudad);
                    }
                }
            }
            if(!empty($strParroquia))
            {
                $strNombreParroquiaAnterior = "";
                if(!empty($objPublicidad->getPARROQUIA()) && $objPublicidad->getPARROQUIA() != "TODOS")
                {
                    $objParroquiaAnterior = $this->getDoctrine()
                                                 ->getRepository(AdmiParroquia::class)
                                                 ->find($objPublicidad->getPARROQUIA());
                    $strNombreParroquiaAnterior = (!empty($objParroquiaAnterior) && is_object($objParroquiaAnterior)) ? $objParroquiaAnterior->getPARROQUIANOMBRE():"";
                }
                if($strParroquia == "TODOS")
                {
                    $arrayBitacoraDetalle[]= array('CAMPO'          => "Parroquia",
                                                   'VALOR_ANTERIOR' => $strNombreParroquiaAnterior,
                                                   'VALOR_ACTUAL'   => "TODOS",
                                                   'USUARIO_ID'     => $strUsuarioCreacion);
                    $objPublicidad->setPARROQUIA($strParroquia);
                }
                else
                {
                    $objParroquia = $this->getDoctrine()
                                         ->getRepository(AdmiParroquia::class)
                                         ->find($strParroquia);
                    if(is_object($objParroquia) && !empty($objParroquia))
                    {
                        $arrayBitacoraDetalle[]= array('CAMPO'          => "Parroquia",
                                                       'VALOR_ANTERIOR' => $strNombreParroquiaAnterior,
                                                       'VALOR_ACTUAL'   => $objParroquia->getPARROQUIANOMBRE(),
                                                       'USUARIO_ID'     => $strUsuarioCreacion);
                        $objPublicidad->setPARROQUIA($strParroquia);
                    }
                }
            }
            if(!empty($strEstado))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                               'VALOR_ANTERIOR' => $objPublicidad->getESTADO(),
                                               'VALOR_ACTUAL'   => $strEstado,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPublicidad->setESTADO(strtoupper($strEstado));
            }
            $objPublicidad->setUSRMODIFICACION($strUsuarioCreacion);
            $objPublicidad->setFEMODIFICACION($strDatetimeActual);
            if(!empty($strEliminar) && $strEliminar == "S")
            {
                $objController            = new DefaultController();
                $objController->setContainer($this->container);
                $arrayInfoVistaPublicidad = $this->getDoctrine()
                                                 ->getRepository(InfoVistaPublicidad::class)
                                                 ->findBy(array('PUBLICIDAD_ID' => $objPublicidad->getId()));
                if(!empty($arrayInfoVistaPublicidad) && is_array($arrayInfoVistaPublicidad))
                {
                    foreach($arrayInfoVistaPublicidad as $objItemVistaPublicidad)
                    {
                        $em->remove($objItemVistaPublicidad);
                    }
                }
                $objController->getEliminarImg($objPublicidad->getIMAGEN());
                $em->remove($objPublicidad);
            }
            else
            {
                $em->persist($objPublicidad);
            }
            $em->flush();
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Modificación",
                                            "strModulo"            => "Publicidad",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $objPublicidad->getId(),
                                            "strReferenciaValor"   => $objPublicidad->getDESCRIPCION(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Publicidad editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            
            $strMensajeError = "Fallo al editar un Publicidad, intente nuevamente.\n ". $ex->getMessage();
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

    /**
     * Documentación para la función 'createPromocion'
     * Método encargado de crear las promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-09-2019
     * 
     * @author Kevin Baque Se cambia la sucursalID por RestauranteID
     * @version 1.1 08-11-2019
     * 
     * @author Kevin Baque
     * @version 1.2 17-08-2020 - Se agrega la creación de codigo en la promoción.
     *
     * @author Kevin Baque
     * @version 1.3 19-07-2021 - Se agrega lógica para ingresar historial de creación.
     * 
     * @author Kevin Baque
     * @version 1.4 11-11-2021 - Se agrega lógica para ingresar nuevo tipo de promoción.
     *
     * @return array  $objResponse
     */
    public function createPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante       = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $strDescrPromocion      = $arrayData['descrPromocion'] ? $arrayData['descrPromocion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $intCantPuntos          = ($arrayData['cantPuntos']<0 && $arrayData['cantPuntos'] !="")?0:$arrayData['cantPuntos'];
        $strAceptaGlobal        = $arrayData['aceptaGlobal'] ? $arrayData['aceptaGlobal']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strCodigo              = $arrayData['codigo'] ? $arrayData['codigo']:'NO';
        $strExcel               = $arrayData['excel'] ? $arrayData['excel']:'';
        $strPremio              = $arrayData['premio'] ? $arrayData['premio']:'NO';
        $intIdTipoPromocion     = $arrayData['idTipoPromocion'] ? $arrayData['idTipoPromocion']:1;
        $intIdCupon             = $arrayData['idCupon']         ? $arrayData['idCupon']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $arrayBitacoraDetalle   = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,$intIdRestaurante);
            }
            $arrayParametros = array('ESTADO' => 'ACTIVO',
                                     'id'     => $intIdRestaurante);
            $objRestaurante  = $this->getDoctrine()
                                    ->getRepository(InfoRestaurante::class)
                                    ->findOneBy($arrayParametros);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
            }
            $strRestauranteCodigo = $objRestaurante->getCODIGO();
            if(!empty($strCodigo) && $strCodigo != "NO" && $strRestauranteCodigo == "NO")
            {
                $strStatus = 409;
                throw new \Exception('El restaurante seleccionado no permite el ingreso de códigos.');
            }
            $objTipoPromocion = $this->getDoctrine()
                                     ->getRepository(AdmiTipoPromocion::class)
                                     ->findOneBy(array("id"     =>$intIdTipoPromocion,
                                                       "ESTADO" =>'ACTIVO'));
            if(!is_object($objTipoPromocion) || empty($objTipoPromocion))
            {
                throw new \Exception('No existe el tipo de promoción enviado por parámetro.');
            }
            $entityPromocion = new InfoPromocion();
            $entityPromocion->setRESTAURANTEID($objRestaurante);
            $entityPromocion->setDESCRIPCIONTIPOPROMOCION($strDescrPromocion);
            $entityPromocion->setIMAGEN($strRutaImagen);
            $entityPromocion->setPREMIO($strPremio);
            $entityPromocion->setCANTIDADPUNTOS($intCantPuntos);
            $entityPromocion->setACEPTAGLOBAL($strAceptaGlobal);
            $entityPromocion->setESTADO(strtoupper($strEstado));
            $entityPromocion->setCODIGO(strtoupper($strCodigo));
            $entityPromocion->setTIPOPROMOCIONID($objTipoPromocion);
            $entityPromocion->setUSRCREACION($strUsuarioCreacion);
            $entityPromocion->setFECREACION($strDatetimeActual);
            $em->persist($entityPromocion);
            $em->flush();
            if($objTipoPromocion->getDESCRIPCION()=="CUPON")
            {
                if(!empty($intIdCupon))
                {
                    $objCupon = $this->getDoctrine()
                                     ->getRepository(InfoCupon::class)
                                     ->findOneBy(array("id"     =>$intIdCupon,
                                                       "ESTADO" =>'ACTIVO'));
                    if(is_object($objCupon) && !empty($objCupon))
                    {
                        $entityCuponPromocion = new InfoCuponPromocion();
                        $entityCuponPromocion->setCUPONID($objCupon);
                        $entityCuponPromocion->setPROMOCIONID($entityPromocion);
                        $entityCuponPromocion->setESTADO(strtoupper($strEstado));
                        $entityCuponPromocion->setUSRCREACION($strUsuarioCreacion);
                        $entityCuponPromocion->setFECREACION($strDatetimeActual);
                        $em->persist($entityCuponPromocion);
                        $em->flush();
                    }
                }
            }
            if( (!empty($strRestauranteCodigo) && $strRestauranteCodigo == "SI")&&(!empty($strCodigo) && $strCodigo!="NO") )
            {
                $objBaseToPhp  = explode(',', $strExcel);
                $arrayDataTemp = base64_decode($objBaseToPhp[1]);
                $arrayData     = explode("\n", $arrayDataTemp);
                if(!empty($strExcel))
                {
                    $strRutaExcel = $objController->subirfichero($strExcel,1);
                }
                for($intCont =0; $intCont<sizeof($arrayData); $intCont ++)
                {
                    if($arrayData[$intCont]!="" && $arrayData[$intCont]!=null)
                    {
                        $entityCodigoPromocion = new InfoCodigoPromocion();
                        $entityCodigoPromocion->setRESTAURANTEID($objRestaurante);
                        $entityCodigoPromocion->setPROMOCIONID($entityPromocion->getId());
                        $entityCodigoPromocion->setESTADO(strtoupper($strEstado));
                        $entityCodigoPromocion->setEXCEL($strRutaExcel);
                        $entityCodigoPromocion->setCODIGO(trim($arrayData[$intCont]));
                        $entityCodigoPromocion->setUSRCREACION($strUsuarioCreacion);
                        $entityCodigoPromocion->setFECREACION($strDatetimeActual);
                        $em->persist($entityCodigoPromocion);
                        $em->flush();
                    }
                }
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Restaurante",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $objRestaurante->getNOMBRECOMERCIAL(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strDescrPromocion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Tenedor de Oro",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strPremio,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Cant. Puntos",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $intCantPuntos,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Acepta Puntos Globaless",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strAceptaGlobal,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Tipo",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $objTipoPromocion->getDESCRIPCION(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEstado,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Código",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strCodigo,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Creación",
                                            "strModulo"            => "Promoción",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $entityPromocion->getId(),
                                            "strReferenciaValor"   => $entityPromocion->getDESCRIPCIONTIPOPROMOCION()." / ".$entityPromocion->getRESTAURANTEID()->getNOMBRECOMERCIAL(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Promoción creado con exito.!';
        }
        catch(\Exception $ex)
        {
            $strMensajeError = "Fallo al crear una Promoción, intente nuevamente.\n ". $ex->getMessage();
            if($strStatus == 409)
            {
                $strMensajeError = $ex->getMessage();
            }
            else
            {
                $strStatus = 404;
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'editPromocion'
     * Método encargado de editar las promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-09-2019
     * 
     * @author Kevin Baque Se cambia la sucursalID por RestauranteID.
     * @version 1.1 08-11-2019
     * 
     * @author Kevin Baque
     * @version 1.2 17-08-2020 - Se agrega el ingreso de códigos en la promoción.
     *
     * @author Kevin Baque
     * @version 1.3 05-07-2021 - Se agrega bandera para eliminar de forma permanente 
     *                           las promociones y todo lo relacionado.
     *
     * @author Kevin Baque
     * @version 1.4 19-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @author Kevin Baque
     * @version 1.5 11-11-2021 - Se agrega lógica para ingresar nuevo tipo de promoción.
     *
     * @return array  $objResponse
     */
    public function editPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPromocion         = $arrayData['idPromocion'] ? $arrayData['idPromocion']:'';
        $intIdRestaurante       = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $strDescrPromocion      = $arrayData['descrPromocion'] ? $arrayData['descrPromocion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $intCantPuntos          = ($arrayData['cantPuntos']<0 && $arrayData['cantPuntos'] !="")?0:$arrayData['cantPuntos'];
        $strAceptaGlobal        = $arrayData['aceptaGlobal'] ? $arrayData['aceptaGlobal']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strCodigo              = $arrayData['codigo'] ? $arrayData['codigo']:'NO';
        $strExcel               = $arrayData['excel'] ? $arrayData['excel']:'';
        $strPremio              = $arrayData['premio'] ? $arrayData['premio']:'NO';
        $intIdTipoPromocion     = $arrayData['idTipoPromocion'] ? $arrayData['idTipoPromocion']:1;
        $intIdCupon             = $arrayData['idCupon']         ? $arrayData['idCupon']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strEliminar            = $arrayData['eliminar']        ? $arrayData['eliminar']:'';
        $strDatetimeActual      = new \DateTime('now');
        $arrayBitacoraDetalle   = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();
            $objPromocion = $this->getDoctrine()
                                 ->getRepository(InfoPromocion::class)
                                 ->findOneBy(array('id'=>$intIdPromocion));
            if(!is_object($objPromocion) || empty($objPromocion))
            {
                throw new \Exception('No existe promoción con la identificación enviada por parámetro.');
            }
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,$intIdPromocion);
                if(!empty($objPromocion->getIMAGEN()))
                {
                    $objController->getEliminarImg($objPromocion->getIMAGEN());
                }
            }
            else
            {
                $strRutaImagen = "";
            }
            if(!empty($intIdTipoPromocion))
            {
                $objTipoPromocion = $this->getDoctrine()
                                         ->getRepository(AdmiTipoPromocion::class)
                                         ->findOneBy(array("id"     =>$intIdTipoPromocion,
                                                           "ESTADO" =>'ACTIVO'));
                if(!is_object($objTipoPromocion) || empty($objTipoPromocion))
                {
                    throw new \Exception('No existe el tipo de promoción enviado por parámetro.');
                }
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Tipo",
                                               'VALOR_ANTERIOR' => $objPromocion->getTIPOPROMOCIONID()->getDESCRIPCION(),
                                               'VALOR_ACTUAL'   => $objTipoPromocion->getDESCRIPCION(),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setTIPOPROMOCIONID($objTipoPromocion);
                $arrayCuponPromocion = $this->getDoctrine()
                                            ->getRepository(InfoCuponPromocion::class)
                                            ->findBy(array('PROMOCION_ID' => $objPromocion->getId()));
                if(!empty($arrayCuponPromocion) && is_array($arrayCuponPromocion))
                {
                    foreach($arrayCuponPromocion as $objItemCuponPromocion)
                    {
                        $em->remove($objItemCuponPromocion);
                    }
                }
                if($objTipoPromocion->getDESCRIPCION()=="CUPON")
                {
                    if(!empty($intIdCupon))
                    {
                        $objCupon = $this->getDoctrine()
                                         ->getRepository(InfoCupon::class)
                                         ->findOneBy(array("id"     =>$intIdCupon,
                                                           "ESTADO" =>'ACTIVO'));
                        if(is_object($objCupon) && !empty($objCupon))
                        {
                            $entityCuponPromocion = new InfoCuponPromocion();
                            $entityCuponPromocion->setCUPONID($objCupon);
                            $entityCuponPromocion->setPROMOCIONID($objPromocion);
                            $entityCuponPromocion->setESTADO(strtoupper($strEstado));
                            $entityCuponPromocion->setUSRCREACION($strUsuarioCreacion);
                            $entityCuponPromocion->setFECREACION($strDatetimeActual);
                            $em->persist($entityCuponPromocion);
                            $em->flush();
                        }
                    }
                }
            }
            if(!empty($intIdRestaurante))
            {
                $arrayParametros = array('id'     => $intIdRestaurante);
                $objRestaurante  = $this->getDoctrine()
                                        ->getRepository(InfoRestaurante::class)
                                        ->findOneBy($arrayParametros);
                if(!is_object($objRestaurante) || empty($objRestaurante))
                {
                    throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
                }
                $strRestauranteCodigo = $objRestaurante->getCODIGO();
                if($strRestauranteCodigo == "NO" && (!empty($strCodigo) && $strCodigo == "SI"))
                {
                    $strStatus = 409;
                    throw new \Exception('El restaurante seleccionado no permite el ingreso de códigos.');
                }
                if( (!empty($strRestauranteCodigo) && $strRestauranteCodigo == "SI")&&(!empty($strCodigo) && $strCodigo!="NO") )
                {
                    if(!empty($strExcel))
                    {
                        $objBaseToPhp  = explode(',', $strExcel);
                        $arrayDataTemp = base64_decode($objBaseToPhp[1]);
                        $arrayData     = explode("\n", $arrayDataTemp);
                        $strRutaExcel = $objController->subirfichero($strExcel,1);
                        if(is_array($arrayData) && !empty($arrayData))
                        {
                            for($intCont =0; $intCont<sizeof($arrayData); $intCont ++)
                            {
                                if($arrayData[$intCont]!="" && $arrayData[$intCont]!=null)
                                {
                                    $entityCodigoPromocion = new InfoCodigoPromocion();
                                    $entityCodigoPromocion->setRESTAURANTEID($objRestaurante);
                                    $entityCodigoPromocion->setPROMOCIONID($objPromocion);
                                    if(!empty($strRutaExcel))
                                    {
                                        $entityCodigoPromocion->setEXCEL($strRutaExcel);
                                    }
                                    $entityCodigoPromocion->setESTADO(strtoupper($strEstado));
                                    $entityCodigoPromocion->setCODIGO(trim($arrayData[$intCont]));
                                    $entityCodigoPromocion->setUSRCREACION($strUsuarioCreacion);
                                    $entityCodigoPromocion->setFECREACION($strDatetimeActual);
                                    $em->persist($entityCodigoPromocion);
                                    $em->flush();
                                }
                            }
                        }
                        $strRutaExcel = $objController->subirfichero($strExcel,1);
                    }
                    else
                    {
                        $arrayCodigoPromo = $this->getDoctrine()
                                                 ->getRepository(InfoCodigoPromocion::class)
                                                 ->findby(array("PROMOCION_ID"=>$intIdPromocion));
                        foreach($arrayCodigoPromo as $arrayItem)
                        {
                            $objCodigoPromo = $this->getDoctrine()
                                                   ->getRepository(InfoCodigoPromocion::class)
                                                   ->find($arrayItem->getId());
                            if(is_object($objCodigoPromo) && !empty($objCodigoPromo))
                            {
                                $objCodigoPromo->setRESTAURANTEID($objRestaurante);
                                $objCodigoPromo->setUSRMODIFICACION($strUsuarioCreacion);
                                $objCodigoPromo->setFEMODIFICACION($strDatetimeActual);
                                $em->persist($objCodigoPromo);
                                $em->flush();
                            }
                        }
                    }
                }
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Restaurante",
                                               'VALOR_ANTERIOR' => $objPromocion->getRESTAURANTEID()->getNOMBRECOMERCIAL(),
                                               'VALOR_ACTUAL'   => $objRestaurante->getNOMBRECOMERCIAL(),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setRESTAURANTEID($objRestaurante);
            }
            if(!empty($strDescrPromocion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                               'VALOR_ANTERIOR' => $objPromocion->getDESCRIPCIONTIPOPROMOCION(),
                                               'VALOR_ACTUAL'   => $strDescrPromocion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setDESCRIPCIONTIPOPROMOCION($strDescrPromocion);
            }
            $objPromocion->setIMAGEN($strRutaImagen);
            if(!empty($strPremio))
            {
                if($strPremio == "SI")
                {
                    $intCantPuntos = 0;
                }
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Tenedor de Oro",
                                               'VALOR_ANTERIOR' => $objPromocion->getPREMIO(),
                                               'VALOR_ACTUAL'   => $strPremio,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setPREMIO($strPremio);
            }

            if($intCantPuntos>=0)
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Cant. Puntos",
                                               'VALOR_ANTERIOR' => $objPromocion->getCANTIDADPUNTOS(),
                                               'VALOR_ACTUAL'   => $intCantPuntos,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setCANTIDADPUNTOS($intCantPuntos);
            }

            if(!empty($strAceptaGlobal))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Acepta Puntos Globales",
                                               'VALOR_ANTERIOR' => $objPromocion->getACEPTAGLOBAL(),
                                               'VALOR_ACTUAL'   => $strAceptaGlobal,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setACEPTAGLOBAL($strAceptaGlobal);
            }
            if(!empty($strEstado))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                               'VALOR_ANTERIOR' => $objPromocion->getESTADO(),
                                               'VALOR_ACTUAL'   => $strEstado,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setESTADO(strtoupper($strEstado));
            }
            if(!empty($strCodigo))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Código",
                                               'VALOR_ANTERIOR' => $objPromocion->getCODIGO(),
                                               'VALOR_ACTUAL'   => $strCodigo,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objPromocion->setCODIGO(strtoupper($strCodigo));
            }
            $objPromocion->setUSRMODIFICACION($strUsuarioCreacion);
            $objPromocion->setFEMODIFICACION($strDatetimeActual);
            $intIdPromocion = $objPromocion->getId();
            $strPromocion   = $objPromocion->getDESCRIPCIONTIPOPROMOCION()." / ".$objPromocion->getRESTAURANTEID()->getNOMBRECOMERCIAL();
            if(!empty($strEliminar) && $strEliminar == "S")
            {
                $objController          = new DefaultController();
                $objController->setContainer($this->container);
                $arrayInfoPromocionHist = $this->getDoctrine()
                                               ->getRepository(InfoPromocionHistorial::class)
                                               ->findBy(array('PROMOCION_ID' => $objPromocion->getId()));
                if(!empty($arrayInfoPromocionHist) && is_array($arrayInfoPromocionHist))
                {
                    foreach($arrayInfoPromocionHist as $objItemPromocionHist)
                    {
                        $em->remove($objItemPromocionHist);
                    }
                }
                $arrayInfoCodPromocion  = $this->getDoctrine()
                                               ->getRepository(InfoCodigoPromocion::class)
                                               ->findBy(array('PROMOCION_ID' => $objPromocion->getId()));
                if(!empty($arrayInfoCodPromocion) && is_array($arrayInfoCodPromocion))
                {
                    foreach($arrayInfoCodPromocion as $objItemCodPromocion)
                    {
                        $em->remove($objItemCodPromocion);
                    }
                }
                $objController->getEliminarImg($objPromocion->getIMAGEN());
                $em->remove($objPromocion);
            }
            else
            {
                $em->persist($objPromocion);
            }
            $em->flush();
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $strMensajeError = 'Promoción editado con exito.!';
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => (!empty($strEliminar) && $strEliminar == "S")? 
                                                                       "Eliminación":"Modificación",
                                            "strModulo"            => "Promoción",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $intIdPromocion,
                                            "strReferenciaValor"   => $strPromocion,
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError = "Fallo al editar un Promoción, intente nuevamente.\n ". $ex->getMessage();
            if($strStatus == 409)
            {
                $strMensajeError = $ex->getMessage();
            }
            else
            {
                $strStatus = 404;
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getCliente'
     * Método encargado de retornar todos los clientes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @return array  $objResponse
     */
    public function getCliente($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdUsuario      = $arrayData['id_usuario'] ? $arrayData['id_usuario']:'';
        $intIdCliente      = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strIdentificacion = $arrayData['identificacion'] ? $arrayData['identificacion']:'';
        $intIdRestaurante  = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $strNombres        = $arrayData['nombres'] ? $arrayData['nombres']:'';
        $strApellidos      = $arrayData['apellidos'] ? $arrayData['apellidos']:'';
        $strContador       = $arrayData['strContador'] ? $arrayData['strContador']:'';
        $strCupoDisponible = $arrayData['strCupoDisponible'] ? $arrayData['strCupoDisponible']:'NO';
        $strEstado         = $arrayData['strEstado'] ? $arrayData['strEstado']:'';
        $arrayCliente      = array();
        $strMensajeError   = '';
        $strStatus         = 400;
        $objResponse       = new Response;
        try
        {
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->find($intIdUsuario);
            if(!empty($objUsuario) && is_object($objUsuario))
            {
                $objTipoRol = $this->getDoctrine()
                                    ->getRepository(AdmiTipoRol::class)
                                    ->find($objUsuario->getTIPOROLID()->getId());
                if(!empty($objTipoRol) && is_object($objTipoRol))
                {
                    $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                    if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                    {
                        $intIdRestaurante = '';
                    }
                    else
                    {
                        $objUsuarioRes = $this->getDoctrine()
                                              ->getRepository(InfoUsuarioRes::class)
                                              ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                        $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                        if(empty($intIdRestaurante))
                        {
                            $intIdRestaurante = '';
                        }
                    }
                }
            }
            $arrayParametros = array('intIdCliente'     => $intIdCliente,
                                    'strIdentificacion' => $strIdentificacion,
                                    'intIdRestaurante'  => $intIdRestaurante,
                                    'strNombres'        => $strNombres,
                                    'strApellidos'      => $strApellidos,
                                    'strContador'       => $strContador,
                                    'strCupoDisponible' => $strCupoDisponible,
                                    'strEstado'         => $strEstado
                                    );
            $arrayCliente   = $this->getDoctrine()
                                   ->getRepository(InfoCliente::class)
                                   ->getClienteCriterio($arrayParametros);
            if(isset($arrayCliente['error']) && !empty($arrayCliente['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCliente['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCliente['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCliente,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createCltInfluencer'
     * Método encargado de crear los clt. influencer según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 21-09-2019
     * 
     * @return array  $objResponse
     */
    public function createCltInfluencer($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente           = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,$intIdCliente);
            }
            $em->getConnection()->beginTransaction();
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('Cliente no existe.');
            }
            $entityCliente = new InfoClienteInfluencer();
            $entityCliente->setCLIENTEID($objCliente);
            if(!empty($strRutaImagen))
            {
                $entityCliente->setIMAGEN($strRutaImagen);
            }
            $entityCliente->setESTADO(strtoupper($strEstado));
            $entityCliente->setUSRCREACION($strUsuarioCreacion);
            $entityCliente->setFECREACION($strDatetimeActual);
            $em->persist($entityCliente);
            $em->flush();
            $strMensajeError = 'Cliente Influencer creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un Cliente Influencer, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'editCltInfluencer'
     * Método encargado de crear los clt. influencer según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 21-09-2019
     * 
     * @return array  $objResponse
     */
    public function editCltInfluencer($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCltInfluencer     = $arrayData['idCltInfluencer'] ? $arrayData['idCltInfluencer']:'';
        $intIdCliente           = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64,$intIdCltInfluencer);
            }
            $em->getConnection()->beginTransaction();
            $objCltInfluencer = $this->getDoctrine()
                                     ->getRepository(InfoClienteInfluencer::class)
                                     ->find($intIdCltInfluencer);
            if(!is_object($objCltInfluencer) || empty($objCltInfluencer))
            {
                throw new \Exception('Cliente Influencer no existe.');
            }
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('Cliente no existe.');
            }
            if(!empty($objCliente))
            {
                $objCltInfluencer->setCLIENTEID($objCliente);
            }
            if(!empty($strRutaImagen))
            {
                $objCltInfluencer->setIMAGEN($strRutaImagen);
            }
            if(!empty($strEstado))
            {
                $objCltInfluencer->setESTADO(strtoupper($strEstado));
            }
            
            $objCltInfluencer->setUSRMODIFICACION($strUsuarioCreacion);
            $objCltInfluencer->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objCltInfluencer);
            $em->flush();
            $strMensajeError = 'Cliente Influencer editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un Cliente Influencer, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'getCltInfluencer'
     * Método encargado de retornar todos los clientes Influencer según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 21-09-2019
     * 
     * @return array  $objResponse
     */
    public function getCltInfluencer($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCltInfluencer = $arrayData['idCltInfluencer'] ? $arrayData['idCltInfluencer']:'';
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strContador        = $arrayData['strContador'] ? $arrayData['strContador']:'';
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'';
        $conImagen          = $arrayData['imagen'] ? $arrayData['imagen']:'NO';
        $arrayCltInfluencer = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $objController      = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            $arrayParametros = array('intIdCliente'     => $intIdCliente,
                                    'intIdCltInfluencer'=> $intIdCltInfluencer,
                                    'strContador'       => $strContador,
                                    'strEstado'         => $strEstado
                                    );
            $arrayCltInfluencer   = (array) $this->getDoctrine()
                                                 ->getRepository(InfoClienteInfluencer::class)
                                                 ->getCltInfluencerCriterio($arrayParametros);
            if(isset($arrayCltInfluencer['error']) && !empty($arrayCltInfluencer['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCltInfluencer['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltInfluencer['error'] = $strMensajeError;
        if($conImagen == 'SI')
        {
            foreach ($arrayCltInfluencer['resultados'] as &$item)
            {
                if($item['IMAGEN'])
                {
                    $item['IMAGEN'] = $objController->getImgBase64($item['IMAGEN']);
                }
            }
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltInfluencer,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getClienteEncuesta'
     * Método encargado de retornar todos las relaciones entre clt. y encuestas 
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 27-09-2019
     * 
     * @author Kevin Baque
     * @version 1.1 30-07-2021 - Se agrega parámetro Restaurante, para realizar el filtro.
     *
     * @return array  $objResponse
     */
    public function getClienteEncuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $intIdUsuario       = $arrayData['intIdUsuario']     ? $arrayData['intIdUsuario']:'';
        $strEstado          = $arrayData['strEstado']        ? $arrayData['strEstado']:'';
        $strMes             = $arrayData['strMes']           ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio']          ? $arrayData['strAnio']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            if(empty($intIdRestaurante))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $objTipoRol = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->find($objUsuario->getTIPOROLID()->getId());
                    if(!empty($objTipoRol) && is_object($objTipoRol))
                    {
                        $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                        if(!empty($strTipoRol) && $strTipoRol == "ADMINISTRADOR")
                        {
                            $intIdRestaurante = '';
                        }
                        else
                        {
                            $objUsuarioRes = $this->getDoctrine()
                                                  ->getRepository(InfoUsuarioRes::class)
                                                  ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                            $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                        }
                    }
                }
            }
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEncuesta(array('strEstado'        => $strEstado,
                                                                  'strMes'           => $strMes,
                                                                  'intIdRestaurante' => $intIdRestaurante,
                                                                  'strAnio'          => $strAnio));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strStatus       = 204;
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayCltEncuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getClienteEncuestaSemestral'
     * Método encargado de retornar todos las relaciones entre clt. y encuestas semestrales
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     *
     * @author Kevin Baque
     * @version 1.1 30-07-2021 - Se agrega parámetro Restaurante, para realizar el filtro.
     *
     * @return array  $objResponse
     */
    public function getClienteEncuestaSemestral($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['strEstado']        ? $arrayData['strEstado']:'';
        $strLimite          = $arrayData['strLimite']        ? $arrayData['strLimite']:'';
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $intIdUsuario       = $arrayData['intIdUsuario']     ? $arrayData['intIdUsuario']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            if(empty($intIdRestaurante))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $objTipoRol = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->find($objUsuario->getTIPOROLID()->getId());
                    if(!empty($objTipoRol) && is_object($objTipoRol))
                    {
                        $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                        if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                        {
                            $intIdRestaurante = '';
                        }
                        else
                        {
                            $objUsuarioRes = $this->getDoctrine()
                                                  ->getRepository(InfoUsuarioRes::class)
                                                  ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                            $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                            if(empty($intIdRestaurante))
                            {
                                $intIdRestaurante = '';
                            }
                        }
                    }
                }
            }
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEncuestaSemestral(array('strEstado'        => $strEstado,
                                                                           'intIdRestaurante' => $intIdRestaurante,
                                                                           'strLimite'        => $strLimite));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strStatus       = 204;
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayCltEncuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getClienteEncuestaSemanal'
     * Método encargado de retornar todos las relaciones entre clt. y encuestas semestrales
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     *
     * @author Kevin Baque
     * @version 1.1 30-07-2021 - Se agrega parámetro Restaurante, para realizar el filtro.
     *
     * @return array  $objResponse
     */
    public function getClienteEncuestaSemanal($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['strEstado']        ? $arrayData['strEstado']:'';
        $strLimite          = $arrayData['strLimite']        ? $arrayData['strLimite']:'';
        $intIdUsuario       = $arrayData['intIdUsuario']     ? $arrayData['intIdUsuario']:'';
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            if(empty($intIdRestaurante))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $objTipoRol = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->find($objUsuario->getTIPOROLID()->getId());
                    if(!empty($objTipoRol) && is_object($objTipoRol))
                    {
                        $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                        if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                        {
                            $intIdRestaurante = '';
                        }
                        else
                        {
                            $objUsuarioRes = $this->getDoctrine()
                                                  ->getRepository(InfoUsuarioRes::class)
                                                  ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                            $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                            if(empty($intIdRestaurante))
                            {
                                $intIdRestaurante = '';
                            }
                        }
                    }
                }
            }
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEncuestaSemanal(array('strEstado'        => $strEstado,
                                                                         'intIdRestaurante' => $intIdRestaurante,
                                                                         'strLimite'        => $strLimite));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strStatus       = 204;
            $strMensajeError = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayCltEncuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'editClienteEncuesta'
     * Método encargado de editar la talba cliente encuesta según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 15-10-2019
     *
     * @author Kevin Baque
     * @version 1.1 08-03-2020 - Se envía correo de perdiste puntos.
     *
     * @author Kevin Baque
     * @version 1.2 23-06-2021 - Se agrega lógica para el envío de correos por medio de la tabla InfoPlantilla.
     *
     * @author Kevin Baque
     * @version 1.3 20-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function editClienteEncuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdClienteEncuesta   = $arrayData['idClienteEncuesta'] ? $arrayData['idClienteEncuesta']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ELIMINADO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $arrayBitacoraDetalle   = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $objClienteEncuesta = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->find($intIdClienteEncuesta);
            if(!is_object($objClienteEncuesta) || empty($objClienteEncuesta))
            {
                throw new \Exception('Encuesta del cliente no existe.');
            }
            $objCliente         = $this->getDoctrine()
                                       ->getRepository(InfoCliente::class)
                                       ->find($objClienteEncuesta->getCLIENTEID()->getId());
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('Cliente no existe.');
            }
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->find($objClienteEncuesta->getSUCURSALID()->getId());
            if(!is_object($objSucursal) || empty($objSucursal))
            {
                throw new \Exception('No existe la sucursal con la descripción enviada por parámetro.');
            }
            $objRestaurante = $this->getDoctrine()
                                    ->getRepository(InfoRestaurante::class)
                                    ->find($objSucursal->getRESTAURANTEID()->getId());
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe restaurante con la descripción enviada por parámetro.');
            }
            if(!empty($strEstado))
            {
                $objClienteEncuesta->setESTADO(strtoupper($strEstado));
            }
            $objClienteEncuesta->setUSRMODIFICACION($strUsuarioCreacion);
            $objClienteEncuesta->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objClienteEncuesta);
            $em->flush();
            $objContenido    = $this->getDoctrine()
                                    ->getRepository(InfoContenidoSubido::class)
                                    ->find($objClienteEncuesta->getCONTENIDOID());
            if(!is_object($objContenido) || empty($objContenido))
            {
                throw new \Exception('No existe el contenido con la descripción enviada por parámetro.');
            }
            $objRedSocial = $this->getDoctrine()
                                 ->getRepository(InfoRedesSociales::class)
                                 ->find($objContenido->getREDESSOCIALESID());
            $intPuntosPerdidos = 0;
            if(is_object($objRedSocial) && $objRedSocial->getDESCRIPCION() == "NO COMPARTIDO")
            {
                $intPuntosPerdidos = intval($objClienteEncuesta->getCANTIDADPUNTOS());
            }
            else
            {
                $intPuntosPerdidos = intval($objClienteEncuesta->getCANTIDADPUNTOS()) + intval($objContenido->getCANTIDADPUNTOS());
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => $objContenido->getESTADO(),
                                           'VALOR_ACTUAL'   => "Eliminado",
                                           'USUARIO_ID'     => $strUsuarioCreacion);

            if(!empty($strEstado))
            {
                $objContenido->setESTADO(strtoupper($strEstado));
            }
            $objContenido->setUSRMODIFICACION($strUsuarioCreacion);
            $objContenido->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objContenido);
            $em->flush();
            $strAsunto            = '¡PERDISTE PUNTOS!';
            $strNombre            = "";
            $strApellido          = "";
            if(!empty($objCliente->getNOMBRE()))
            {
                $strNombre = trim($objCliente->getNOMBRE());
            }
            if(!empty($objCliente->getAPELLIDO()))
            {
                $strApellido = trim($objCliente->getAPELLIDO());
            }

            if(!empty($strNombre) && !empty($strApellido))
            {
                $strNombreUsuario = $strNombre .' '.$strApellido;
            }
            else if(!empty($strNombre))
            {
                $strNombreUsuario = $strNombre;
            }
            else if(!empty($strApellido))
            {
                $strNombreUsuario = $strApellido;
            }
            else
            {
                $strNombreUsuario = $objCliente->getCORREO();
            }
            $strNombreImagen  = $objContenido->getIMAGEN();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Foto",
                                           'VALOR_ANTERIOR' => $strNombreImagen,
                                           'VALOR_ACTUAL'   => "",
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $strRutaImagen    = (dirname(__FILE__)."/../../public/images"."/".$strNombreImagen);
            $objPlantilla     = $this->getDoctrine()
                                     ->getRepository(InfoPlantilla::class)
                                     ->findOneBy(array('DESCRIPCION'=>"PERDER_PUNTOS",
                                                       'ESTADO'     =>"ACTIVO"));
            if(!empty($objPlantilla) && is_object($objPlantilla))
            {
                $strMensajeCorreo   = stream_get_contents ($objPlantilla->getPLANTILLA());
                $strCuerpoCorreo1   = "Has perdido ".$intPuntosPerdidos." puntos en el restaurante ".$objRestaurante->getNOMBRECOMERCIAL()."";
                $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);

                $strCuerpoCorreo2   = "A su vez pierdes un cupón para el sorteo mensual del Tenedor de Oro";
                $strMensajeCorreo   = str_replace('strCuerpoCorreo2',$strCuerpoCorreo2,$strMensajeCorreo);
                $strRemitente       = 'notificaciones@bitte.app';
                $arrayParametros    = array('strAsunto'        => $strAsunto,
                                            'strMensajeCorreo' => $strMensajeCorreo,
                                            'strRemitente'     => $strRemitente,
                                            'strRutaImagen'    => $strRutaImagen,
                                            'strDestinatario'  => $objCliente->getCORREO());
                $objController      = new DefaultController();
                $objController->setContainer($this->container);
                $objController->enviaCorreo($arrayParametros);
            }
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Modificación",
                                            "strModulo"            => "Data Encuesta",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $objClienteEncuesta->getId(),
                                            "strReferenciaValor"   => $objRestaurante->getNOMBRECOMERCIAL()." / ".$objSucursal->getDESCRIPCION(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Encuesta del cliente y contenido editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar Encuesta del cliente y contenido, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'editSucursalEncuestasRealizadas'
     * Método encargado de editar la sucursal de la encuesta según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 05-08-2021
     *
     * @return array  $objResponse
     */
    public function editSucursalEncuestasRealizadas($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdClienteEncuesta   = $arrayData['intIdClienteEncuesta'] ? $arrayData['intIdClienteEncuesta']:'';
        $intIdSucursal          = $arrayData['intIdSucursal']        ? $arrayData['intIdSucursal']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion']      ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $arrayBitacoraDetalle   = array();
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $objClienteEncuesta = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->find($intIdClienteEncuesta);
            if(!is_object($objClienteEncuesta) || empty($objClienteEncuesta))
            {
                throw new \Exception('Encuesta del cliente no existe.');
            }
            $strSucursalAnterior = $objClienteEncuesta->getSUCURSALID()->getDESCRIPCION();
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->find($intIdSucursal);
            if(!is_object($objSucursal) || empty($objSucursal))
            {
                throw new \Exception('No existe la sucursal con la descripción enviada por parámetro.');
            }
            $objClienteEncuesta->setSUCURSALID($objSucursal);
            $objClienteEncuesta->setUSRMODIFICACION($strUsuarioCreacion);
            $objClienteEncuesta->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objClienteEncuesta);
            $em->flush();
            $objContenido    = $this->getDoctrine()
                                    ->getRepository(InfoContenidoSubido::class)
                                    ->find($objClienteEncuesta->getCONTENIDOID());
            if(!is_object($objContenido) || empty($objContenido))
            {
                throw new \Exception('No existe el contenido con la descripción enviada por parámetro.');
            }
            $objContenido->setSUCURSALID($objSucursal);
            $objContenido->setUSRMODIFICACION($strUsuarioCreacion);
            $objContenido->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objContenido);
            $em->flush();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Sucursal",
                                           'VALOR_ANTERIOR' => $strSucursalAnterior,
                                           'VALOR_ACTUAL'   => $objSucursal->getDESCRIPCION(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $strNombreImagen  = $objContenido->getIMAGEN();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Foto",
                                           'VALOR_ANTERIOR' => $strNombreImagen,
                                           'VALOR_ACTUAL'   => $strNombreImagen,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Modificación",
                                            "strModulo"            => "Data Encuesta",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $objClienteEncuesta->getId(),
                                            "strReferenciaValor"   => $objSucursal->getRESTAURANTEID()->getNOMBRECOMERCIAL()." / ".$objSucursal->getDESCRIPCION(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Encuesta del cliente y contenido editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar Encuesta del cliente y contenido, intente nuevamente.\n ". $ex->getMessage();
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

    /**
     * Documentación para la función 'editEstadoEncuestasRealizadas'
     * Método encargado de editar el estado de eliminado a Activo, de la encuesta según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 05-08-2021
     *
     * @return array  $objResponse
     */
    public function editEstadoEncuestasRealizadas($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdClienteEncuesta   = $arrayData['intIdClienteEncuesta'] ? $arrayData['intIdClienteEncuesta']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion']      ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $arrayBitacoraDetalle   = array();
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $objClienteEncuesta = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->find($intIdClienteEncuesta);
            if(!is_object($objClienteEncuesta) || empty($objClienteEncuesta))
            {
                throw new \Exception('Encuesta del cliente no existe.');
            }
            $objClienteEncuesta->setESTADO(strtoupper("ACTIVO"));
            $objClienteEncuesta->setUSRMODIFICACION($strUsuarioCreacion);
            $objClienteEncuesta->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objClienteEncuesta);
            $em->flush();
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->find($objClienteEncuesta->getSUCURSALID()->getId());
            if(!is_object($objSucursal) || empty($objSucursal))
            {
                throw new \Exception('No existe la sucursal con la descripción enviada por parámetro.');
            }
            $objContenido    = $this->getDoctrine()
                                    ->getRepository(InfoContenidoSubido::class)
                                    ->find($objClienteEncuesta->getCONTENIDOID());
            if(!is_object($objContenido) || empty($objContenido))
            {
                throw new \Exception('No existe el contenido con la descripción enviada por parámetro.');
            }
            $objContenido->setESTADO(strtoupper("ACTIVO"));
            $objContenido->setUSRMODIFICACION($strUsuarioCreacion);
            $objContenido->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objContenido);
            $em->flush();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "Eliminado",
                                           'VALOR_ACTUAL'   => "Activo",
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $strNombreImagen  = $objContenido->getIMAGEN();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Foto",
                                           'VALOR_ANTERIOR' => $strNombreImagen,
                                           'VALOR_ACTUAL'   => $strNombreImagen,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Modificación",
                                            "strModulo"            => "Data Encuesta",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $objClienteEncuesta->getId(),
                                            "strReferenciaValor"   => $objSucursal->getRESTAURANTEID()->getNOMBRECOMERCIAL()." / ".$objSucursal->getDESCRIPCION(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $strMensajeError = 'Encuesta del cliente y contenido editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar Encuesta del cliente y contenido, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'editPromocionHistorial'
     * Método encargado de editar el historial de la promoción según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 30-09-2019
     *
     * @author Kevin Baque
     * @version 1.1 03-12-2019 - Se agrega envío de correo notificando que canjio puntos.
     *
     * @author Kevin Baque
     * @version 1.2 19-02-2020 - Envío de correo cuando es tenedor de oro.
     *
     * @author Kevin Baque
     * @version 1.3 21-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @author Kevin Baque
     * @version 1.4 21-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function editPromocionHistorial($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPromocionHist     = $arrayData['idPromocionHist'] ? $arrayData['idPromocionHist']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'COMPLETADO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $arrayBitacoraDetalle   = array();
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $objPromocionHist = $this->getDoctrine()
                                       ->getRepository(InfoPromocionHistorial::class)
                                       ->findOneBy(array('id'     => $intIdPromocionHist,
                                                      'ESTADO' => 'PENDIENTE'));
            if(!is_object($objPromocionHist) || empty($objPromocionHist))
            {
                throw new \Exception('Promoción no existe o ha sido completada.');
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "Pendiente",
                                           'VALOR_ACTUAL'   => "Completado",
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $objCliente     = $this->getDoctrine()
                                   ->getRepository(InfoCliente::class)
                                   ->find($objPromocionHist->getCLIENTEID()->getId());
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe el cliente con la descripción enviada por parámetro.');
            }
            $objPromocion   = $this->getDoctrine()
                                   ->getRepository(InfoPromocion::class)
                                   ->find($objPromocionHist->getPROMOCIONID());
            if(!is_object($objPromocion) || empty($objPromocion))
            {
                throw new \Exception('No existe la promoción con la descripción enviada por parámetro.');
            }
            $objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->find($objPromocion->getRESTAURANTEID()->getId());
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
            }
            if(!empty($strEstado))
            {
                $objPromocionHist->setESTADO(strtoupper($strEstado));
            }
            $objPromocionHist->setUSRMODIFICACION($strUsuarioCreacion);
            $objPromocionHist->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objPromocionHist);
            $em->flush();
            $objPromocionOro     = $this->getDoctrine()
                                     ->getRepository(InfoPromocion::class)
                                     ->findOneBy(array('PREMIO'         => 'NO',
                                                       'id'             => $objPromocionHist->getPROMOCIONID()->getId()));
            $boolEnviarCorreo = false;
            if($strEstado == 'COMPLETADO' && !empty($objPromocionOro))
            {
                $boolEnviarCorreo = true;
                $strAsunto            = '¡PROMOCIÓN CANJEADA!';
                $strNombreUsuario     = $objCliente->getNOMBRE() .' '.$objCliente->getAPELLIDO();
                $strMensajeCorreo = '
                <div class="">¡Hola! '.$strNombreUsuario.'.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">FELICITACIONES!!!!&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Acabas de canjear la promoción: <strong>'.$objPromocion->getDESCRIPCIONTIPOPROMOCION().'</strong> en el restaurante <strong>'.$objRestaurante->getNOMBRECOMERCIAL().'</strong> esperamos que tu premio est&eacute; delicioso.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">¡Sigue disfrutando de salir a comer con tus familiares y amigos!&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Recuerda siempre usar tu app BITTE para calificar tu experiencia, compartir en tus redes sociales, ganar m&aacute;s puntos y comer gratis.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div style=\"font-family:Varela Round\"><b>Enjoy your Bitte</b>&nbsp;</div>
                <div class="">&nbsp;</div>';
            }
            if($boolEnviarCorreo)
            {
                $strRemitente            = 'notificaciones@bitte.app';
                $arrayParametros  = array('strAsunto'        => $strAsunto,
                                          'strMensajeCorreo' => $strMensajeCorreo,
                                          'strRemitente'     => $strRemitente,
                                          'strDestinatario'  => $objCliente->getCORREO());
                $objController    = new DefaultController();
                $objController->setContainer($this->container);
                $objController->enviaCorreo($arrayParametros);
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            if(!empty($arrayBitacoraDetalle))
            {
                $strReferenciaValor = $objRestaurante->getNOMBRECOMERCIAL()." / ".$objPromocion->getDESCRIPCIONTIPOPROMOCION()." / ".$objCliente->getNOMBRE()." ".$objCliente->getAPELLIDO();
                $this->createBitacora(array("strAccion"            => "Redimir",
                                            "strModulo"            => "Puntos",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $intIdPromocionHist,
                                            "strReferenciaValor"   => $strReferenciaValor,
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Historial de la promoción editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar Historial de la promoción, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getPromocionHistorial'
     * Método encargado de listar el historial de la promoción según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 30-09-2019
     * 
     * @return array  $objResponse
     */
    public function getPromocionHistorial($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante       = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $intIdSucursal          = $arrayData['intIdSucursal'] ? $arrayData['intIdSucursal']:'';
        $intIdUsuario           = $arrayData['intIdUsuario']  ? $arrayData['intIdUsuario']:'';
        $intIdCliente           = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strMes                 = $arrayData['strMes'] ? $arrayData['strMes']:'';
        $strAnio                = $arrayData['strAnio'] ? $arrayData['strAnio']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $arrayParametros = array('intIdRestaurante' => $intIdRestaurante,
                                     'intIdCliente'     => $intIdCliente,
                                     'strEstado'        => $strEstado,
                                     'strMes'           => $strMes,
                                     'strAnio'          => $strAnio,
                                     'intIdSucursal'    => $intIdSucursal);
            if(!empty($intIdUsuario))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $strTipoRol = !empty($objUsuario->getTIPOROLID()->getDESCRIPCION_TIPO_ROL()) ? $objUsuario->getTIPOROLID()->getDESCRIPCION_TIPO_ROL():'';
                    error_log($strTipoRol);
                    if(!empty($strTipoRol) && ($strTipoRol=="RESTAURANTE" || $strTipoRol=="RESTAURANTE GERENCIA"))
                    {
                        $objUsuarioRes = $this->getDoctrine()
                                              ->getRepository(InfoUsuarioRes::class)
                                              ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                        if(!empty($objUsuarioRes) && is_object($objUsuarioRes))
                        {
                            $arrayParametros["intIdRestauranteUs"] = $objUsuarioRes->getRESTAURANTEID()->getId();
                        }
                    }
                }
            }
            $arrayPromocionHist = $this->getDoctrine()
                                       ->getRepository(InfoPromocionHistorial::class)
                                       ->getPromocionCriterioWeb($arrayParametros);
            if(!is_array($arrayPromocionHist) || empty($arrayPromocionHist))
            {
                throw new \Exception('Promoción no existe o ha sido completada.');
            }
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            $strMensajeError = "Fallo al listar Historial de la promoción, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayPromocionHist,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createPromocionHistorial'
     * Método encargado de crear el historial de las promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 09-10-2019
     * 
     * @author Kevin Baque
     * @version 1.1 02-03-2020 - Se agrega correo para enviar correo de tenedor de oro al cliente y administrador.
     * 
     * @author Kevin Baque
     * @version 1.2 23-09-2020 - Se agrega link de video al correo de tenedor de oro-cliente.
     *
     * @author Kevin Baque
     * @version 1.3 26-06-2021 - Se agrega lógica para el envío de correos por medio de la tabla InfoPlantilla.
     *
     * @author Kevin Baque
     * @version 1.4 19-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function createPromocionHistorial($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPromocion       = $arrayData['idPromocion'] ? $arrayData['idPromocion']:'';
        $intIdCliente         = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado            = $arrayData['estado'] ? $arrayData['estado']:'PENDIENTE';
        $strUsuarioCreacion   = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $arrayBitacoraDetalle = array();
        $strDatetimeActual    = new \DateTime('now');
        $strMensajeError      = '';
        $strStatus            = 400;
        $intCantidadPuntos    = 0;
        $intCantPuntospromo   = 0;
        $objResponse          = new Response;
        $em                   = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe el cliente con identificador enviada por parámetro.');
            }
            //consultar la promocion con valor premio SI
            $objPromocion = $this->getDoctrine()
                                 ->getRepository(InfoPromocion::class)
                                 ->findOneBy(array('id'     => $intIdPromocion,
                                                   'PREMIO' => 'SI'));
            if(!is_object($objPromocion) || empty($objPromocion))
            {
                throw new \Exception('No existe la promoción con identificador enviada por parámetro.');
            }
            $objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->find($objPromocion->getRESTAURANTEID()->getId());
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
            }
            $objRestauranteUS = $this->getDoctrine()
                                   ->getRepository(InfoUsuarioRes::class)
                                   ->findOneBy(array('RESTAURANTEID'     => $objRestaurante->getId()));
            if(!is_object($objRestauranteUS) || empty($objRestauranteUS))
            {
                throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
            }
            $objUsuarioRes = $this->getDoctrine()
                                ->getRepository(InfoUsuarioRes::class)
                                ->findOneBy(array('USUARIOID'=>$objRestauranteUS->getUSUARIOID()));
            if(!is_object($objUsuarioRes) || empty($objUsuarioRes))
            {
                throw new \Exception('No existe el usuario relacionado con el restaurante enviada por parámetro.');
            }
            $objUsuario = $this->getDoctrine()
                                ->getRepository(InfoUsuario::class)
                                ->findOneBy(array('id'=>$objUsuarioRes->getUSUARIOID()));
            if(!is_object($objUsuario) || empty($objUsuario))
            {
                throw new \Exception('No existe el usuario relacionado con el restaurante enviada por parámetro.');
            }
            date_default_timezone_set('America/Guayaquil');
            $strNombreUsuarioOro     = $objCliente->getNOMBRE() .' '.$objCliente->getAPELLIDO();
            $strRemitenteOro         = 'notificaciones@bitte.app';
            $strMes                  = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"][date("n") - 1];
            $strAsuntoOro            = 'TENEDOR DE ORO';
            $strNombreResUsOro       = $objUsuario->getNOMBRES() .' '.$objUsuario->getAPELLIDOS();
            $objPlantillaRes         = $this->getDoctrine()
                                            ->getRepository(InfoPlantilla::class)
                                            ->findOneBy(array('DESCRIPCION'=>"TENEDOR_ORO_RESTAURANTE",
                                                              'ESTADO'     =>"ACTIVO"));
            if(!empty($objPlantillaRes) && is_object($objPlantillaRes))
            {
                $strMensajeCorreoRes     = stream_get_contents ($objPlantillaRes->getPLANTILLA());
                $strCuerpoCorreo1Res     = "En el sorteo de ".$strMes.", ".$strNombreUsuarioOro." ha sido el/la ganador(a) del Tenedor de Oro. Esta persona ir&aacute; al restaurante para recibir su premio.";
                $strMensajeCorreoOroRes  = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1Res,$strMensajeCorreoRes);
                $arrayParametrosResOro   = array('strAsunto'        => $strAsuntoOro,
                                                'strMensajeCorreo' => $strMensajeCorreoOroRes,
                                                'strRemitente'     => $strRemitenteOro,
                                                'strDestinatario'  => $objUsuario->getCORREO());
                $objControllerResOro    = new DefaultController();
                $objControllerResOro->setContainer($this->container);
                $objControllerResOro->enviaCorreo($arrayParametrosResOro);
            }
            sleep(1);
            /* cliente */
            $objPlantilla  = $this->getDoctrine()
                                  ->getRepository(InfoPlantilla::class)
                                  ->findOneBy(array('DESCRIPCION'=>"TENEDOR_ORO",
                                                    'ESTADO'     =>"ACTIVO"));
            if(!empty($objPlantilla) && is_object($objPlantilla))
            {
                $strMensajeCorreo    = stream_get_contents ($objPlantilla->getPLANTILLA());
                $strCuerpoCorreo1    = "En el sorteo de ".$strMes." has sido el ganador de un Tenedor de Oro en el restaurante ".$objRestaurante->getNOMBRECOMERCIAL().".";
                $strMensajeCorreoOro = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);
                $strUrlVideo ="https://youtu.be/MYMbKLR3RoU";

                $arrayParametrosOroCliente  = array('strAsunto'     => $strAsuntoOro,
                                                    'strMensajeCorreo' => $strMensajeCorreoOro,
                                                    'strRemitente'     => $strRemitenteOro,
                                                    'strDestinatario'  => $objCliente->getCORREO());
                $objControllerOroCliente    = new DefaultController();
                $objControllerOroCliente->setContainer($this->container);
                $objControllerOroCliente->enviaCorreo($arrayParametrosOroCliente);
            }
            $entityPromocionHist = new InfoPromocionHistorial();
            $entityPromocionHist->setCLIENTEID($objCliente);
            $entityPromocionHist->setPROMOCIONID($objPromocion);
            $entityPromocionHist->setESTADO(strtoupper($strEstado));
            $entityPromocionHist->setUSRCREACION($strUsuarioCreacion);
            $entityPromocionHist->setFECREACION($strDatetimeActual);
            $em->persist($entityPromocionHist);
            $em->flush();
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => "Pendiente",
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $strReferenciaValor = $objRestaurante->getNOMBRECOMERCIAL()." / ".$objPromocion->getDESCRIPCIONTIPOPROMOCION()." / ".$objCliente->getNOMBRE()." ".$objCliente->getAPELLIDO();
                $this->createBitacora(array("strAccion"            => "Redimir",
                                            "strModulo"            => "Tenedor de Oro",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $entityPromocionHist->getId(),
                                            "strReferenciaValor"   => $strReferenciaValor,
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Historial de la Promoción creado con exito.!';
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear el Historial de la Promoción, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getRedesSocialMensual'
     * Método encargado de retornar las redes sociales mensual.
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 17-10-2019
     *
     * @author Kevin Baque
     * @version 1.1 30-07-2021 - Se agrega parámetro Restaurante, para realizar el filtro.
     *
     * @return array  $objResponse
     */
    public function getRedesSocialMensual($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strMes             = $arrayData['strMes']           ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio']          ? $arrayData['strAnio']:'';
        $intIdUsuario       = $arrayData['intIdUsuario']     ? $arrayData['intIdUsuario']:'';
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $arrayRedSocial     = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            if(empty($intIdRestaurante))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $objTipoRol = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->find($objUsuario->getTIPOROLID()->getId());
                    if(!empty($objTipoRol) && is_object($objTipoRol))
                    {
                        $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                        if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                        {
                            $intIdRestaurante = '';
                        }
                        else
                        {
                            $objUsuarioRes = $this->getDoctrine()
                                                  ->getRepository(InfoUsuarioRes::class)
                                                  ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                            $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                            if(empty($intIdRestaurante))
                            {
                                $intIdRestaurante = '';
                            }
                        }
                    }
                }
            }
            $arrayRedSocial   = $this->getDoctrine()
                                     ->getRepository(InfoRedesSociales::class)
                                     ->getRedesSocialMensual(array('strMes'           => $strMes,
                                                                   'intIdRestaurante' => $intIdRestaurante,
                                                                   'strAnio'          => $strAnio));
            if(isset($arrayRedSocial['error']) && !empty($arrayRedSocial['error']))
            {
                throw new \Exception($arrayRedSocial['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strStatus       = 204;
            $strMensajeError = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRedSocial['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRedSocial,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getClienteGenero'
     * Método encargado de retornar los generos de los clientes
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     *
     * @author Kevin Baque
     * @version 1.1 30-07-2021 - Se agrega parámetro Restaurante, para realizar el filtro.
     *
     * @return array  $objResponse
     */
    public function getClienteGenero($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strMes             = $arrayData['strMes']           ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio']          ? $arrayData['strAnio']:'';
        $intIdUsuario       = $arrayData['intIdUsuario']     ? $arrayData['intIdUsuario']:'';
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            if(empty($intIdRestaurante))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $objTipoRol = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->find($objUsuario->getTIPOROLID()->getId());
                    if(!empty($objTipoRol) && is_object($objTipoRol))
                    {
                        $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                        if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                        {
                            $intIdRestaurante = '';
                        }
                        else
                        {
                            $objUsuarioRes = $this->getDoctrine()
                                                  ->getRepository(InfoUsuarioRes::class)
                                                  ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                            $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                            if(empty($intIdRestaurante))
                            {
                                $intIdRestaurante = '';
                            }
                        }
                    }
                }
            }
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteGenero(array('strMes'           => $strMes,
                                                                'intIdRestaurante' => $intIdRestaurante,
                                                                'strAnio'          => $strAnio));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strStatus       = 204;
            $strMensajeError = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayCltEncuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getClienteEdad'
     * Método encargado de retornar las edades de los clientes
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 16-10-2019
     *
     * @author Kevin Baque
     * @version 1.1 30-07-2021 - Se agrega parámetro Restaurante, para realizar el filtro.
     *
     * @return array  $objResponse
     */
    public function getClienteEdad($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strMes             = $arrayData['strMes']           ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio']          ? $arrayData['strAnio']:'';
        $intIdUsuario       = $arrayData['intIdUsuario']     ? $arrayData['intIdUsuario']:'';
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            if(empty($intIdRestaurante))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $objTipoRol = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->find($objUsuario->getTIPOROLID()->getId());
                    if(!empty($objTipoRol) && is_object($objTipoRol))
                    {
                        $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                        if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                        {
                            $intIdRestaurante = '';
                        }
                        else
                        {
                            $objUsuarioRes = $this->getDoctrine()
                                                  ->getRepository(InfoUsuarioRes::class)
                                                  ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                            $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                            if(empty($intIdRestaurante))
                            {
                                $intIdRestaurante = '';
                            }
                        }
                    }
                }
            }
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEdad(array('strMes'           => $strMes,
                                                              'intIdRestaurante' => $intIdRestaurante,
                                                              'strAnio'          => $strAnio));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strStatus       = 204;
            $strMensajeError = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayCltEncuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getResultadoProEncuesta'
     * Método encargado de retornar el resultado promediado
     * encuesta activa según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-10-2019
     * 
     * @return array  $objResponse
     */
    public function getResultadoProEncuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdUsuario       = $arrayData['id_usuario'] ? $arrayData['id_usuario']:'';
        $strFechaIni        = $arrayData['strFechaIni'] ? $arrayData['strFechaIni']:'';
        $strFechaFin        = $arrayData['strFechaFin'] ? $arrayData['strFechaFin']:'';
        $strGenero          = $arrayData['strGenero'] ? $arrayData['strGenero']:'';
        $strHorario         = $arrayData['strHorario'] ? $arrayData['strHorario']:'';
        $strEdad            = $arrayData['strEdad'] ? $arrayData['strEdad']:'';
        $strPais            = $arrayData['strPais'] ? $arrayData['strPais']:'';
        $strCiudad          = $arrayData['strCiudad'] ? $arrayData['strCiudad']:'';
        $strProvincia       = $arrayData['strProvincia'] ? $arrayData['strProvincia']:'';
        $strParroquia       = $arrayData['strParroquia'] ? $arrayData['strParroquia']:'';
        $intIdSucursal      = $arrayData['intIdSucursal'] ? $arrayData['intIdSucursal']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            if(!empty($strEdad))
            {
                 $arrayEdad = explode("(", $strEdad);
                 if(is_array($arrayEdad))
                 { 
                    $strEdad = trim($arrayEdad[0]);
                 }
            }

            if(!empty($strHorario))
            {
                 $arrayHorario = explode("(", $strHorario);
                 if(is_array($arrayHorario))
                 { 
                    $strHorario = trim($arrayHorario[0]);
                 }
            }
            
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->find($intIdUsuario);
            if(!empty($objUsuario) && is_object($objUsuario))
            {
                $objTipoRol = $this->getDoctrine()
                                    ->getRepository(AdmiTipoRol::class)
                                    ->find($objUsuario->getTIPOROLID()->getId());
                if(!empty($objTipoRol) && is_object($objTipoRol))
                {
                    $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                    if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                    {
                        $intIdRestaurante = '';
                    }
                    else
                    {
                        $objUsuarioRes = $this->getDoctrine()
                                              ->getRepository(InfoUsuarioRes::class)
                                              ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                        $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                        if(empty($intIdRestaurante))
                        {
                            $intIdRestaurante = '';
                        }
                    }
                }
            }
         
            $arrayParametros = array("strMes"      => $strMes,
                                    "strAnio"      => $strAnio,
                                    "strFechaIni"  => $strFechaIni,
                                    "strFechaFin"  => $strFechaFin,
                                    "strGenero"    => $strGenero,
                                    "strHorario"   => $strHorario,
                                    "strEdad"      => $strEdad,
                                    "strPais"      => $strPais,
                                    "strCiudad"    => $strCiudad,
                                    "strProvincia" => $strProvincia,
                                    'intIdRestaurante'=>$intIdRestaurante,
                                    'intIdSucursal'   =>$intIdSucursal,
                                    "strParroquia" => $strParroquia);
            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoRespuesta::class)
                                     ->getResultadoProEncuesta($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRespuesta,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getResultadoProPregunta'
     * Método encargado de retornar el resultado promediado
     * preguntas activa según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 07-11-2019
     * 
     * @return array  $objResponse
     */
    public function getResultadoProPregunta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strGenero          = $arrayData['strGenero'] ? $arrayData['strGenero']:'';
        $strHorario         = $arrayData['strHorario'] ? $arrayData['strHorario']:'';
        $strEdad            = $arrayData['strEdad'] ? $arrayData['strEdad']:'';
        $strPais            = $arrayData['strPais'] ? $arrayData['strPais']:'';
        $strCiudad          = $arrayData['strCiudad'] ? $arrayData['strCiudad']:'';
        $strProvincia       = $arrayData['strProvincia'] ? $arrayData['strProvincia']:'';
        $strParroquia       = $arrayData['strParroquia'] ? $arrayData['strParroquia']:'';
        $intIdPregunta      = $arrayData['intIdPregunta'] ? $arrayData['intIdPregunta']:'';
        $intLimite          = $arrayData['intLimite'] ? $arrayData['intLimite']:'';
        $intIdUsuario       = $arrayData['id_usuario'] ? $arrayData['id_usuario']:'';
        $intIdSucursal      = $arrayData['intIdSucursal'] ? $arrayData['intIdSucursal']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $intIdRestaurante   = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->find($intIdUsuario);
            if(!empty($objUsuario) && is_object($objUsuario))
            {
                $objTipoRol = $this->getDoctrine()
                                    ->getRepository(AdmiTipoRol::class)
                                    ->find($objUsuario->getTIPOROLID()->getId());
                if(!empty($objTipoRol) && is_object($objTipoRol))
                {
                    $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                    if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                    {
                        $intIdRestaurante = '';
                    }
                    else
                    {
                        $objUsuarioRes = $this->getDoctrine()
                                              ->getRepository(InfoUsuarioRes::class)
                                              ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                        $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                        if(empty($intIdRestaurante))
                        {
                            $intIdRestaurante = '';
                        }
                    }
                }
            }

            if(!empty($strEdad))
            {
                 $arrayEdad = explode("(", $strEdad);
                 if(is_array($arrayEdad))
                 { 
                    $strEdad = trim($arrayEdad[0]);
                 }
            }

            if(!empty($strHorario))
            {
                 $arrayHorario = explode("(", $strHorario);
                 if(is_array($arrayHorario))
                 { 
                    $strHorario = trim($arrayHorario[0]);
                 }
            }


            $arrayParametros = array("strMes"      => $strMes,
                                    "strAnio"      => $strAnio,
                                    "strGenero"    => $strGenero,
                                    "strHorario"   => $strHorario,
                                    "strEdad"      => $strEdad,
                                    "strPais"      => $strPais,
                                    "strCiudad"    => $strCiudad,
                                    "strProvincia" => $strProvincia,
                                    "intLimite"    => $intLimite,
                                    "intIdPregunta" => $intIdPregunta,
                                    "intIdRestaurante"=>$intIdRestaurante,
                                    'intIdSucursal'   =>$intIdSucursal,
                                    "strParroquia" => $strParroquia);
            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoRespuesta::class)
                                     ->getResultadoProPregunta($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRespuesta,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getResultadoProPublicaciones'
     * Método encargado de retornar el resultado promediado
     * preguntas activa según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 07-11-2019
     * 
     * @return array  $objResponse
     */
    public function getResultadoProPublicaciones($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strGenero          = $arrayData['strGenero'] ? $arrayData['strGenero']:'';
        $strHorario         = $arrayData['strHorario'] ? $arrayData['strHorario']:'';
        $strEdad            = $arrayData['strEdad'] ? $arrayData['strEdad']:'';
        $strPais            = $arrayData['strPais'] ? $arrayData['strPais']:'';
        $strCiudad          = $arrayData['strCiudad'] ? $arrayData['strCiudad']:'';
        $strProvincia       = $arrayData['strProvincia'] ? $arrayData['strProvincia']:'';
        $strParroquia       = $arrayData['strParroquia'] ? $arrayData['strParroquia']:'';
        $intLimite          = $arrayData['intLimite'] ? $arrayData['intLimite']:'';
        $intIdUsuario       = $arrayData['id_usuario'] ? $arrayData['id_usuario']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $intIdRestaurante   = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->find($intIdUsuario);
            if(!empty($objUsuario) && is_object($objUsuario))
            {
                $objTipoRol = $this->getDoctrine()
                                    ->getRepository(AdmiTipoRol::class)
                                    ->find($objUsuario->getTIPOROLID()->getId());
                if(!empty($objTipoRol) && is_object($objTipoRol))
                {
                    $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                    if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                    {
                        $intIdRestaurante = '';
                    }
                    else
                    {
                        $objUsuarioRes = $this->getDoctrine()
                                              ->getRepository(InfoUsuarioRes::class)
                                              ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                        $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                        if(empty($intIdRestaurante))
                        {
                            $intIdRestaurante = '';
                        }
                    }
                }
            }
            if(!empty($strEdad))
            {
                 $arrayEdad = explode("(", $strEdad);
                 if(is_array($arrayEdad))
                 { 
                    $strEdad = trim($arrayEdad[0]);
                 }
            }

            if(!empty($strHorario))
            {
                 $arrayHorario = explode("(", $strHorario);
                 if(is_array($arrayHorario))
                 { 
                    $strHorario = trim($arrayHorario[0]);
                 }
            }

            $arrayParametros = array("strMes"      => $strMes,
                                    "strAnio"      => $strAnio,
                                    "strGenero"    => $strGenero,
                                    "strHorario"   => $strHorario,
                                    "strEdad"      => $strEdad,
                                    "strPais"      => $strPais,
                                    "strCiudad"    => $strCiudad,
                                    "strProvincia" => $strProvincia,
                                    "intLimite"    => $intLimite,
                                    "intIdRestaurante"=>$intIdRestaurante,
                                    "strParroquia" => $strParroquia);
            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoRespuesta::class)
                                     ->getResultadoProPublicaciones($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRespuesta,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getResultadosProIPN'
     * Método encargado de retornar el resultado promediado
     * IPN activa según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 08-11-2019
     * 
     * @author Kevin Baque
     * @version 1.1 17-08-2021 - Se agrega parámetro Restaurante, para realizar el filtro.
     *
     * @return array  $objResponse
     */
    public function getResultadosProIPN($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strFechaIni        = $arrayData['strFechaIni'] ? $arrayData['strFechaIni']:'';
        $strFechaFin        = $arrayData['strFechaFin'] ? $arrayData['strFechaFin']:'';
        $strGenero          = $arrayData['strGenero'] ? $arrayData['strGenero']:'';
        $strHorario         = $arrayData['strHorario'] ? $arrayData['strHorario']:'';
        $strEdad            = $arrayData['strEdad'] ? $arrayData['strEdad']:'';
        $strPais            = $arrayData['strPais'] ? $arrayData['strPais']:'';
        $strCiudad          = $arrayData['strCiudad'] ? $arrayData['strCiudad']:'';
        $strProvincia       = $arrayData['strProvincia'] ? $arrayData['strProvincia']:'';
        $strParroquia       = $arrayData['strParroquia'] ? $arrayData['strParroquia']:'';
        $intIdUsuario       = $arrayData['id_usuario'] ? $arrayData['id_usuario']:'';
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $intIdSucursal      = $arrayData['intIdSucursal'] ? $arrayData['intIdSucursal']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            if(empty($intIdRestaurante))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->find($intIdUsuario);
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $objTipoRol = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->find($objUsuario->getTIPOROLID()->getId());
                    if(!empty($objTipoRol) && is_object($objTipoRol))
                    {
                        $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                        if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                        {
                            $intIdRestaurante = '';
                        }
                        else
                        {
                            $objUsuarioRes = $this->getDoctrine()
                                                  ->getRepository(InfoUsuarioRes::class)
                                                  ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                            $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                            if(empty($intIdRestaurante))
                            {
                                $intIdRestaurante = '';
                            }
                        }
                    }
                }
            }
            if(!empty($strEdad))
            {
                 $arrayEdad = explode("(", $strEdad);
                 if(is_array($arrayEdad))
                 { 
                    $strEdad = trim($arrayEdad[0]);
                 }
            }

            if(!empty($strHorario))
            {
                 $arrayHorario = explode("(", $strHorario);
                 if(is_array($arrayHorario))
                 { 
                    $strHorario = trim($arrayHorario[0]);
                 }
            }

            $arrayParametros = array("strMes"      => $strMes,
                                    "strAnio"      => $strAnio,
                                    "strFechaIni"  => $strFechaIni,
                                    "strFechaFin"  => $strFechaFin,
                                    "strGenero"    => $strGenero,
                                    "strHorario"   => $strHorario,
                                    "strEdad"      => $strEdad,
                                    "strPais"      => $strPais,
                                    "strCiudad"    => $strCiudad,
                                    "strProvincia" => $strProvincia,
                                    "intIdRestaurante"=>$intIdRestaurante,
                                    "intIdSucursal"   => $intIdSucursal,
                                    "strParroquia" => $strParroquia);
            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoRespuesta::class)
                                     ->getResultadosProIPN($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRespuesta,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getPromedioRegistrosClt'
     * Método encargado de retornar el promedio de los registros
     * según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 12-08-2021
     *
     * @return array  $objResponse
     */
    public function getPromedioRegistrosClt($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['strEstado']    ? $arrayData['strEstado']:array('ACTIVO');
        $strMes             = $arrayData['strMes']       ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio']      ? $arrayData['strAnio']:'';
        $intIdusuario       = $arrayData['intIdusuario'] ? $arrayData['intIdusuario']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            $arrayParametros  = array("strMes"     => $strMes,
                                      "strAnio"    => $strAnio,
                                      "strEstado"  => $strEstado);
            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoRespuesta::class)
                                     ->getPromedioRegistrosClt($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 204;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getRegistrosClientes'
     * Método encargado de retornar reporte de registros de clientes
     * según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 12-08-2021
     *
     * @return array  $objResponse
     */
    public function getRegistrosClientes($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['strEstado']    ? $arrayData['strEstado']:array('ACTIVO');
        $strMes             = $arrayData['strMes']       ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio']      ? $arrayData['strAnio']:'';
        $intIdusuario       = $arrayData['intIdusuario'] ? $arrayData['intIdusuario']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            $arrayParametros  = array("strMes"     => $strMes,
                                      "strAnio"    => $strAnio,
                                      "strEstado"  => $strEstado);
            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoCliente::class)
                                     ->getRegistrosClientes($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 204;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getParametro'
     * Método encargado de retornar todos los parametro según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 11-11-2019
     * 
     * @return array  $objResponse
     */
    public function getParametro($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDescripcion    = $arrayData['strDescripcion'] ? $arrayData['strDescripcion']:'';
        $arrayParametro    = array();
        $strMensajeError   = '';
        $strStatus         = 400;
        $objResponse       = new Response;
        $boolSucces        = true;
        try
        {
            $arrayParametros = array('strDescripcion'=>$strDescripcion);
            $arrayParametro    = $this->getDoctrine()
                                      ->getRepository(AdmiParametro::class)
                                      ->getParametro($arrayParametros);
            if(isset($arrayParametro['error']) && !empty($arrayParametro['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayParametro['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayParametro['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayParametro,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'generarPass'
     * Método encargado de generar las contraseñas a todos los usuarios.
     *
     * @author Kevin Baque
     * @version 1.0 14-11-2019
     *
     * @return array  $objResponse
     */
    public function generarPass($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDestinatario  = $arrayData['strCorreo'] ? $arrayData['strCorreo']:'';
        $strAsunto        = 'Clave temporal Bitte';
        $strContrasenia   = uniqid();
        $strContrasenia   = substr($strContrasenia,0,4);
        $strMensajeCorreo = '<div class="">Estimado usuario.</div>
        <div class="">&nbsp;</div>
        <div class="">En base a su solicitud el sistema BITTE ha procedido a asignarle una clave temporal.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div><strong>Tu clave temporal es :'.$strContrasenia.'&nbsp;</strong></div>
        <div class="">&nbsp;</div>
        <div class="">Recuerda que para mayor seguridad luego de ingresar a BITTE es muy importante cambiar la contraseña.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">
        <div>
        <div class="">Nuestro equipo de asistencia estar&aacute; disponible para usted para lo que necesite.&nbsp;</div>
        <div>&nbsp;</div>
        </div>
        </div>
        <div style=\"font-family:Varela Round\"><b>Enjoy your Bitte</b>&nbsp;</div>';
        $strRemitente     = 'notificaciones@bitte.app';
        $objResponse      = new Response;
        $strRespuesta     = '';
        $arrayParametros  = array();
        $strStatus        = 400;
        $em               = $this->getDoctrine()->getManager();
        $strMensajeError  = '';
        try
        {
            $em->getConnection()->beginTransaction();
            if(empty($strDestinatario))
            {
                throw new \Exception('Es necesario enviar el correo.');
            }
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->findOneBy(array('CORREO'=>$strDestinatario));
            if(!is_object($objUsuario) && empty($objUsuario))
            {
                throw new \Exception('Usuario no existente.');
            }
            if(empty($strContrasenia))
            {
                throw new \Exception('No se ah generado la contraseña.');
            }
            $arrayParametros  = array('strAsunto'        => $strAsunto,
                                      'strMensajeCorreo' => $strMensajeCorreo,
                                      'strRemitente'     => $strRemitente,
                                      'strDestinatario'  => $strDestinatario);
            $objController    = new DefaultController();
            $objController->setContainer($this->container);
            $objController->enviaCorreo($arrayParametros);
            $objUsuario->setCONTRASENIA(md5($strContrasenia));
            $em->persist($objUsuario);
            $em->flush();
            $strMensajeError = 'Cambio de clave con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
                $em->getConnection()->close();
            }
            $strStatus       = 404;
            $strMensajeError = "Fallo al generar el correo, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $strMensajeError,
'clave'=>$strContrasenia,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getComparativosRestaurantes'
     * Método encargado de retornar comparacion entre restaurantes.
     * 
     * @author Kevin Baque
     * @version 1.0 15-11-2019
     * 
     * @return array  $arrayRespuesta
     * 
     */
    public function getComparativosRestaurantes($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intLimite          = $arrayData['intLimite'] ? $arrayData['intLimite']:'';
        $intIdRestaurante   = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $intIdTipoComida    = $arrayData['intIdTipoComida'] ? $arrayData['intIdTipoComida']:'';
        $intIdPais          = $arrayData['intIdPais'] ? $arrayData['intIdPais']:'';
        $intIdProvincia     = $arrayData['intIdProvincia'] ? $arrayData['intIdProvincia']:'';
        $intIdCiudad        = $arrayData['intIdCiudad'] ? $arrayData['intIdCiudad']:'';
        $intIdParroquia     = $arrayData['intIdParroquia'] ? $arrayData['intIdParroquia']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            $arrayParametros = array("intLimite"        => $intLimite,
                                    "intIdRestaurante" => $intIdRestaurante,
                                    "intIdTipoComida"  => $intIdTipoComida,
                                    "intIdPais"        => $intIdPais,
                                    "intIdProvincia"   => $intIdProvincia,
                                    "intIdCiudad"      => $intIdCiudad,
                                    "intIdParroquia"   => $intIdParroquia);

            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoRespuesta::class)
                                     ->getComparativosRestaurantes($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Falló al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            $boolSucces      = true;
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRespuesta,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getComparativosRestaurantes'
     * Método encargado de retornar comparacion entre restaurantes.
     * 
     * @author Kevin Baque
     * @version 1.0 15-11-2019
     * 
     * @return array  $arrayRespuesta
     * 
     */
    public function getVistasPublicidades($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strGenero          = $arrayData['strGenero'] ? $arrayData['strGenero']:'';
        $strEdad            = $arrayData['strEdad'] ? $arrayData['strEdad']:'';
        $strGlobal          = $arrayData['strGlobal'] ? $arrayData['strGlobal']:'';
        $strFechaIni        = $arrayData['strFechaIni'] ? $arrayData['strFechaIni']:'';
        $strFechaFin        = $arrayData['strFechaFin'] ? $arrayData['strFechaFin']:'';
        $intIdUsuario       = $arrayData['id_usuario'] ? $arrayData['id_usuario']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $intIdRestaurante   = '';
        $strStatus          = 400;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->find($intIdUsuario);
            if(!empty($objUsuario) && is_object($objUsuario))
            {
                $objTipoRol = $this->getDoctrine()
                                    ->getRepository(AdmiTipoRol::class)
                                    ->find($objUsuario->getTIPOROLID()->getId());
                if(!empty($objTipoRol) && is_object($objTipoRol))
                {
                    $strTipoRol = !empty($objTipoRol->getDESCRIPCION_TIPO_ROL()) ? $objTipoRol->getDESCRIPCION_TIPO_ROL():'';
                    if(!empty($strTipoRol) && $strTipoRol=="ADMINISTRADOR")
                    {
                        $intIdRestaurante = '';
                    }
                    else
                    {
                        $objUsuarioRes = $this->getDoctrine()
                                              ->getRepository(InfoUsuarioRes::class)
                                              ->findOneBy(array('USUARIOID'=>$intIdUsuario));
                        $intIdRestaurante = $objUsuarioRes->getRESTAURANTEID()->getId();
                        if(empty($intIdRestaurante))
                        {
                            $intIdRestaurante = '';
                        }
                    }
                }
            }
            $arrayParametros = array("strGenero"   => $strGenero,
                                     "strEdad"     => $strEdad,
                                     "strFechaIni" => $strFechaIni,
                                     "strFechaFin" => $strFechaFin,
                                     "intIdRestaurante"=>$intIdRestaurante,
                                     "strGlobal"   => $strGlobal);

            $arrayRespuesta   = $this->getDoctrine()
                                     ->getRepository(InfoVistaPublicidad::class)
                                     ->getVistasPublicidades($arrayParametros);
            if(isset($arrayRespuesta['error']) && !empty($arrayRespuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Falló al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            $boolSucces      = true;
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRespuesta,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createCodigoPromocion'
     * Método encargado de crear los codigos de las promociones según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 09-09-2019
     *
     * @return array  $objResponse
     */
    public function createCodigoPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante       = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $intIdPromocion         = $arrayData['intIdPromocion'] ? $arrayData['intIdPromocion']:'';
        $strEstado              = $arrayData['strEstado'] ? $arrayData['strEstado']:'';
        $strCodigo              = $arrayData['strCodigo'] ? $arrayData['strCodigo']:'';
        $strUsuarioCreacion     = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
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
                                  ->find($intIdRestaurante);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe restaurante con la parámetros enviados.');
            }
            $objPromocion = $this->getDoctrine()
                                  ->getRepository(InfoPromocion::class)
                                  ->find($intIdPromocion);
            if(!is_object($objPromocion) || empty($objPromocion))
            {
                throw new \Exception('No existe la promoción con identificador enviada por parámetro.');
            }
            $entityCodigoPromocion = new InfoCodigoPromocion();
            $entityCodigoPromocion->setRESTAURANTEID($objRestaurante);
            $entityCodigoPromocion->setPROMOCIONID($objPromocion);
            $entityCodigoPromocion->setESTADO(strtoupper($strEstado));
            $entityCodigoPromocion->setCODIGO($strCodigo);
            $entityCodigoPromocion->setUSRCREACION($strUsuarioCreacion);
            $entityCodigoPromocion->setFECREACION($strDatetimeActual);
            $em->persist($entityCodigoPromocion);
            $em->flush();
            $strMensajeError = 'Código creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un Código, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'editCodigoPromocion'
     * Método encargado de editar los codigos según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     *
     * @return array  $objResponse
     */
    public function editCodigoPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCodigoPromocion   = $arrayData['intIdCodigoPromocion'] ? $arrayData['intIdCodigoPromocion']:'';
        $strAccion              = $arrayData['strAccion'] ? $arrayData['strAccion']:'';
        $intIdPromocion         = $arrayData['idPromocion'] ? $arrayData['idPromocion']:'';
        $strCodigo              = $arrayData['strCodigo'] ? $arrayData['strCodigo']:'';
        $strEstado              = $arrayData['strEstado'] ? $arrayData['strEstado']:'';
        $strUsuarioCreacion     = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            if($strAccion=="DELETE_ALL" && !empty($intIdPromocion))
            {
                $strEstado        = "ELIMINADO";
                $arrayCodigoPromo = $this->getDoctrine()
                                         ->getRepository(InfoCodigoPromocion::class)
                                         ->findby(array("PROMOCION_ID"=>$intIdPromocion,
                                                        "ESTADO"=>"ACTIVO"));
                foreach($arrayCodigoPromo as $arrayItem)
                {
                    $objCodigoPromo = $this->getDoctrine()
                                        ->getRepository(InfoCodigoPromocion::class)
                                        ->find($arrayItem->getId());
                    if(is_object($objCodigoPromo) && !empty($objCodigoPromo))
                    {
                        
                        $objCodigoPromo->setESTADO(strtoupper($strEstado));
                        $objCodigoPromo->setUSRMODIFICACION($strUsuarioCreacion);
                        $objCodigoPromo->setFEMODIFICACION($strDatetimeActual);
                        $em->persist($objCodigoPromo);
                        $em->flush();
                    }
                }
                $strMensajeError = 'Se eliminaron todos los códigos.';
            }
            else
            {
                $strEstado = (!empty($strAccion) && $strAccion == "ACTIVAR" ? "ACTIVO":"ELIMINADO");
                $objCodigoPromo = $this->getDoctrine()
                                     ->getRepository(InfoCodigoPromocion::class)
                                    ->find($intIdCodigoPromocion);

                if(!is_object($objCodigoPromo) || empty($objCodigoPromo))
                {
                    throw new \Exception('Código no existe.');
                }
                if($objCodigoPromo->getESTADO()=="CANJEADO")
                {
                    $strStatus = 409;
                    throw new \Exception("Solo se puede Activar/Eliminar, códigos que no estén en estado: 'CANJEADO'.");
                }
                if(!empty($strEstado))
                {
                    $objCodigoPromo->setESTADO(strtoupper($strEstado));
                }
                $objCodigoPromo->setUSRMODIFICACION($strUsuarioCreacion);
                $objCodigoPromo->setFEMODIFICACION($strDatetimeActual);
                $em->persist($objCodigoPromo);
                $em->flush();
                $strMensajeError = 'Código editado con exito.!';
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError = "Fallo al crear un Código, intente nuevamente.\n ". $ex->getMessage();
            if($strStatus == 409)
            {
                $strMensajeError = $ex->getMessage();
            }
            else
            {
                $strStatus = 404;
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
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
     * Documentación para la función 'getCodigoPromocion'
     * Método encargado de retornar los codigos según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2020
     *
     * @return array  $objResponse
     */
    public function getCodigoPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPromocion         = $arrayData['idPromocion'] ? $arrayData['idPromocion']:'';
        $intIdRestaurante       = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();

            $arrayParametros = array('intIdPromocion'   => $intIdPromocion,
                                     'intIdRestaurante' => $intIdRestaurante);

            $arrayCodigo   = $this->getDoctrine()
                                   ->getRepository(InfoCodigoPromocion::class)
                                   ->getCodigoPromocionCriterio($arrayParametros);
            if(isset($arrayCodigo['error']) && !empty($arrayCodigo['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCodigo['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strStatus  = 404;
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCodigo['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCodigo,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getCiudadPorRestaurante'
     * Función encargada de retornar todos las ciudades por restaurantes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 18-06-2021
     * 
     * @return array  $objResponse
     */
    public function getCiudadPorRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $arrayResultado         = array();
        $strMensaje             = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        try
        {
            $arrayParametros = array('strEstado' => $strEstado);
            $arrayResultado  = (array) $this->getDoctrine()
                                            ->getRepository(InfoRestaurante::class)
                                            ->getCiudadPorRestaurante($arrayParametros);
            if(isset($arrayResultado['error']) && !empty($arrayResultado['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayResultado['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strStatus = 204;
            $strMensaje ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayResultado['error'] = $strMensaje;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayResultado,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createBanner'
     *
     * Método encargado de crear los banner según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 21-06-2021
     *
     * @return array  $objResponse
     */
    public function createBanner($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDescripcion         = $arrayData['strDescripcion']  ? $arrayData['strDescripcion']:'';
        $strEstado              = $arrayData['strEstado']       ? $arrayData['strEstado']:'ACTIVO';
        $strImagen              = $arrayData['strImagen']       ? $arrayData['strImagen']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            if(!empty($strImagen))
            {
                $strRutaImagen = $objController->getSubirImgBanner($strImagen,1);
            }
            $em->getConnection()->beginTransaction();

            $entityBanner = new InfoBanner();
            $entityBanner->setDESCRIPCION($strDescripcion);
            $entityBanner->setESTADO(strtoupper($strEstado));
            $entityBanner->setIMAGEN($strRutaImagen);
            $entityBanner->setUSRCREACION($strUsuarioCreacion);
            $entityBanner->setFECREACION($strDatetimeActual);
            $em->persist($entityBanner);
            $em->flush();
            $strMensajeError = 'Banner creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un banner, intente nuevamente.\n ". $ex->getMessage();
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
    /**
     * Documentación para la función 'editBanner'
     *
     * Método encargado de editar los banner según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 21-06-2021
     *
     * @return array  $objResponse
     */
    public function editBanner($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdBanner            = $arrayData['strIdBanner']     ? $arrayData['strIdBanner']:'';
        $strDescripcion         = $arrayData['strDescripcion']  ? $arrayData['strDescripcion']:'';
        $strEstado              = $arrayData['strEstado']       ? $arrayData['strEstado']:'ACTIVO';
        $strImagen              = $arrayData['strImagen']       ? $arrayData['strImagen']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            if(empty($strIdBanner))
            {
                throw new \Exception('Id del Banner es un campo obligatorio para realizar la búsqueda.');
            }
            $em->getConnection()->beginTransaction();
            $objBanner = $this->getDoctrine()
                              ->getRepository(InfoBanner::class)
                              ->find($strIdBanner);
            if(!is_object($objBanner) || empty($objBanner))
            {
                throw new \Exception('Banner no existe.');
            }
            if(!empty($strImagen))
            {
                $strRutaImagen = $objController->getSubirImgBanner($strImagen,1);
                if(!empty($objBanner->getIMAGEN()))
                {
                    $objController->getEliminarImgBanner($objBanner->getIMAGEN());
                }
            }
            if(!empty($strDescripcion))
            {
                $objBanner->setDESCRIPCION($strDescripcion);
            }
            if(!empty($strEstado))
            {
                $objBanner->setESTADO(strtoupper($strEstado));
            }
            if(!empty($strRutaImagen))
            {
                $objBanner->setIMAGEN($strRutaImagen);
            }
            $objBanner->setUSRMODIFICACION($strUsuarioCreacion);
            $objBanner->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objBanner);
            $em->flush();
            $strMensajeError = 'Banner creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar un banner, intente nuevamente.\n ". $ex->getMessage();
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
    /**
     * Documentación para la función 'getBanner'
     *
     * Método encargado de retornar todos los banner según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @return array  $objResponse
     */
    public function getBanner($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdBanner        = $arrayData['strIdBanner']     ? $arrayData['strIdBanner']:'';
        $strDescripcion     = $arrayData['strDescripcion']  ? $arrayData['strDescripcion']:'';
        $strEstado          = $arrayData['strEstado']       ? $arrayData['strEstado']:'';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $objResponse        = new Response;
        try
        {
            $objController = new DefaultController();
            $objController->setContainer($this->container);
            $arrayParametros = array('strIdBanner'    => $strIdBanner,
                                     'strDescripcion' => $strDescripcion,
                                     'strEstado'      => $strEstado);
            $arrayBanner     = $this->getDoctrine()
                                    ->getRepository(InfoBanner::class)
                                    ->getBannerCriterio($arrayParametros);
            if(!empty($arrayBanner["error"]))
            {
                throw new \Exception($arrayBanner['error']);
            }
            foreach($arrayBanner['resultados'] as &$arrayItemBanner)
            {
                $arrayRespuesta ['resultados'] []= array('strIdBanner'         =>   $arrayItemBanner['ID_BANNER'],
                                                         'strDescripcion'      =>   $arrayItemBanner['DESCRIPCION'],
                                                         'strEstado'           =>   $arrayItemBanner['ESTADO'],
                                                         'strImagen'           =>   $objController->getImgBase64Banner($arrayItemBanner['IMAGEN']));
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'createBitacora'
     *
     * Método encargado de crear la bitacora según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 13-07-2021
     *
     * @return array  $objResponse
     */
    public function createBitacora($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strAccion              = $arrayData['strAccion']            ? $arrayData['strAccion']:'';
        $strModulo              = $arrayData['strModulo']            ? $arrayData['strModulo']:'';
        $strUsuarioCreacion     = $arrayData['strUsuarioCreacion']   ? $arrayData['strUsuarioCreacion']:'';
        $intReferenciaId        = $arrayData['intReferenciaId']      ? $arrayData['intReferenciaId']:'';
        $strReferenciaValor     = $arrayData['strReferenciaValor']   ? $arrayData['strReferenciaValor']:'';
        $arrayBitacoraDetalle   = $arrayData['arrayBitacoraDetalle'] ? $arrayData['arrayBitacoraDetalle']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            error_log("Creacion de bitacora");
            error_log("--------------");
            error_log("strAccion         : ".$strAccion);
            error_log("strModulo         : ".$strModulo);
            error_log("intReferenciaId   : ".$intReferenciaId);
            error_log("strReferenciaValor: ".$strReferenciaValor);
            error_log("strUsuarioCreacion: ".$strUsuarioCreacion);
            error_log("--------------");
            $em->getConnection()->beginTransaction();
            $entityBitacora = new InfoBitacora();
            $entityBitacora->setACCION($strAccion);
            $entityBitacora->setMODULO($strModulo);
            $entityBitacora->setREFERENCIAID($intReferenciaId);
            $entityBitacora->setREFERENCIA_VALOR($strReferenciaValor);
            $entityBitacora->setFECREACION($strDatetimeActual->format('Y-m-d H:i:s'));
            if(!empty($strUsuarioCreacion))
            {
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(infoUsuario::class)
                                   ->findOneBy(array('id'=>$strUsuarioCreacion));
                if(!empty($objUsuario) && is_object($objUsuario))
                {
                    $entityBitacora->setUSUARIOID($objUsuario);
                }
            }
            $em->persist($entityBitacora);
            $em->flush();
            if(!empty($arrayBitacoraDetalle) && is_array($arrayBitacoraDetalle))
            {
                error_log("Creacion detalle bitacora");
                foreach($arrayBitacoraDetalle as $arrayItemDetalle)
                {
                    if(!empty($arrayItemDetalle) && ($arrayItemDetalle["VALOR_ANTERIOR"] != $arrayItemDetalle["VALOR_ACTUAL"])
                       || $strAccion == "Eliminación")
                    {
                        error_log("CAMPO          : ".$arrayItemDetalle["CAMPO"]);
                        error_log("VALOR_ANTERIOR : ".$arrayItemDetalle["VALOR_ANTERIOR"]);
                        error_log("VALOR_ACTUAL   : ".$arrayItemDetalle["VALOR_ACTUAL"]);
                        $entityDetalleBitacora = new InfoDetalleBitacora();
                        $entityDetalleBitacora->setBITACORAID($entityBitacora);
                        $entityDetalleBitacora->setCAMPO($arrayItemDetalle["CAMPO"]);
                        $strValorAnterior = (!empty($arrayItemDetalle["VALOR_ANTERIOR"])) ? $arrayItemDetalle["VALOR_ANTERIOR"] :"";
                        $entityDetalleBitacora->setVALORANTERIOR($strValorAnterior);
                        $strValorActual   = (!empty($arrayItemDetalle["VALOR_ACTUAL"]))   ? $arrayItemDetalle["VALOR_ACTUAL"]:"";
                        $entityDetalleBitacora->setVALORACTUAL($strValorActual);
                        $entityDetalleBitacora->setFECREACION($strDatetimeActual->format('Y-m-d H:i:s'));
                        if(!empty($arrayItemDetalle["USUARIO_ID"]))
                        {
                            $objUsuario = $this->getDoctrine()
                                               ->getRepository(infoUsuario::class)
                                               ->findOneBy(array('id'=>$arrayItemDetalle["USUARIO_ID"]));
                            if(!empty($objUsuario) && is_object($objUsuario))
                            {
                                $entityDetalleBitacora->setUSUARIOID($objUsuario);
                            }
                        }
                        $em->persist($entityDetalleBitacora);
                        $em->flush();
                    }
                }
            }
            $strMensajeError = 'Bitacora creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear una bitacora, intente nuevamente.\n ". $ex->getMessage();
            error_log($strMensajeError);
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

    /**
     * Documentación para la función 'getBitacora'
     *
     * Método encargado de retornar todos las bitacoras según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-07-2021
     * 
     * @return array  $objResponse
     */
    public function getBitacora($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdBitacora          = $arrayData['intIdBitacora']   ? $arrayData['intIdBitacora']:'';
        $strAccion              = $arrayData['strAccion']       ? $arrayData['strAccion']:'';
        $strModulo              = $arrayData['strModulo']       ? $arrayData['strModulo']:'';
        $strFechaIni            = $arrayData['strFechaIni']     ? $arrayData['strFechaIni']:'';
        $strFechaFin            = $arrayData['strFechaFin']     ? $arrayData['strFechaFin']:'';
        $arrayRespuesta    = array();
        $strMensajeError   = '';
        $strStatus         = 200;
        $objResponse       = new Response;
        try
        {
            $arrayParametros = array('intIdBitacora'  => $intIdBitacora,
                                     'strModulo'      => $strModulo,
                                     'strAccion'      => $strAccion,
                                     'strFechaIni'    => $strFechaIni,
                                     'strFechaFin'    => $strFechaFin);
            $arrayRespuesta  = $this->getDoctrine()
                                    ->getRepository(InfoBitacora::class)
                                    ->getBitacoraCriterio($arrayParametros);
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error']      = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getBitacoraDetalle'
     *
     * Método encargado de retornar todos los detalles de las bitacora según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 13-07-2021
     * 
     * @return array  $objResponse
     */
    public function getBitacoraDetalle($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdBitacora        = $arrayData['intIdBitacora'] ? $arrayData['intIdBitacora']:'';
        $arrayRespuesta       = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        try
        {
            $arrayRespuesta  = $this->getDoctrine()
                                    ->getRepository(InfoDetalleBitacora::class)
                                    ->getBitacoraDetalleCriterio(array('intIdBitacora' => $intIdBitacora));
            if(!empty($arrayRespuesta["resultados"]))
            {
                foreach($arrayRespuesta["resultados"] as &$arrayItem)
                {
                    if($arrayItem['CAMPO'] == "Foto" && !empty($arrayItem['VALOR_ANTERIOR']))
                    {
                        $objController = new DefaultController();
                        $objController->setContainer($this->container);
                        $arrayItem['VALOR_ANTERIOR'] = $objController->getImgBase64($arrayItem['VALOR_ANTERIOR']);
                    }
                }
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error']      = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'createCupon'
     *
     * Método encargado de crear los cupones según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 21-06-2021
     *
     * @author Kevin Baque
     * @version 1.1 11-11-2021 - Se agrega número de días vigentes al cupón de tipo "premio especial".
     *
     * @return array  $objResponse
     */
    public function createCupon($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDescripcion         = $arrayData['strDescripcion']     ? $arrayData['strDescripcion']:'';
        $strEstado              = $arrayData['strEstado']          ? $arrayData['strEstado']:'ACTIVO';
        $strRestaurante         = $arrayData['strRestaurante']     ? $arrayData['strRestaurante']:'';
        $strTipoCupon           = $arrayData['strTipoCupon']       ? $arrayData['strTipoCupon']:'';
        $strValor               = $arrayData['strValor']           ? $arrayData['strValor']:'';
        $strPrecio              = $arrayData['strPrecio']          ? $arrayData['strPrecio']:'';
        $strDiaVigente          = $arrayData['strDiaVigente']      ? $arrayData['strDiaVigente']:'';
        $strImagen              = $arrayData['strImagen']          ? $arrayData['strImagen']:'';
        $strUsuarioCreacion     = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strRutaImagen          = "";
        $strStatus              = 200;
        $boolSucces             = true;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $arrayBitacoraDetalle   = array();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            $objCupon = $this->getDoctrine()
                             ->getRepository(InfoCupon::class)
                             ->findOneBy(array("CUPON" => strtolower(str_replace(" ","_",$strDescripcion))));
            if(!empty($objCupon) && is_object($objCupon))
            {
                throw new \Exception('Cupón existente, por favor ingresar con otra descripción.');
            }
            $objTipoCupon = $this->getDoctrine()
                                 ->getRepository(AdmiTipoCupon::class)
                                 ->findOneBy(array("id"     =>$strTipoCupon,
                                                   "ESTADO" =>'ACTIVO'));
            if(!is_object($objTipoCupon) || empty($objTipoCupon))
            {
                throw new \Exception('No existe el tipo de cupón enviado por parámetro.');
            }
            $em->getConnection()->beginTransaction();
            $entityCupon = new InfoCupon();
            $entityCupon->setCUPON(strtolower(str_replace(" ","_",$strDescripcion)));
            $entityCupon->setESTADO(strtoupper($strEstado));
            $entityCupon->setVALOR(intval($strValor));
            $entityCupon->setTIPOCUPONID($objTipoCupon);
            $entityCupon->setPRECIO(intval($strPrecio));
            $entityCupon->setDIAVIGENTE(intval($strDiaVigente));
            if(!empty($strImagen))
            {
                $strRutaImagen = $objController->getSubirImgBanner($strImagen,1);
            }
            $entityCupon->setIMAGEN($strRutaImagen);
            $entityCupon->setUSRCREACION($strUsuarioCreacion);
            $entityCupon->setFECREACION($strDatetimeActual);
            $em->persist($entityCupon);
            $em->flush();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => strtolower(str_replace(" ","_",$strDescripcion)),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => strtoupper($strEstado),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Tipo de cupón",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => str_replace("_"," ",ucwords($objTipoCupon->getDESCRIPCION())),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Puntos",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => intval($strValor),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Precio",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => intval($strPrecio),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Días vigente",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => intval($strDiaVigente),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if($objTipoCupon->getDESCRIPCION() == "GENERAL_RESTAURANTE" || $objTipoCupon->getDESCRIPCION() == "UNICO_RESTAURANTE")
            {
                $objRestaurante = $this->getDoctrine()
                                       ->getRepository(InfoRestaurante::class)
                                       ->findOneBy(array('id'     => $strRestaurante,
                                                         'ESTADO' => 'ACTIVO'));
                if(!is_object($objRestaurante) || empty($objRestaurante))
                {
                    throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
                }
                $entityCuponRes = new InfoCuponRestaurante();
                $entityCuponRes->setCUPONID($entityCupon);
                $entityCuponRes->setESTADO(strtoupper($strEstado));
                $entityCuponRes->setRESTAURANTEID($objRestaurante);
                $entityCuponRes->setUSRCREACION($strUsuarioCreacion);
                $entityCuponRes->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponRes);
                $em->flush();
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Restaurante",
                                               'VALOR_ANTERIOR' => "",
                                               'VALOR_ACTUAL'   => $objRestaurante->getNOMBRECOMERCIAL(),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Creación",
                                            "strModulo"            => "Cupón",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $entityCupon->getId(),
                                            "strReferenciaValor"   => $entityCupon->getCUPON(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Cupón creado con éxito.!';
        }
        catch(\Exception $ex)
        {
            $strStatus = 204;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'editCupon'
     *
     * Método encargado de crear los cupones según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 21-06-2021
     *
     * @author Kevin Baque
     * @version 1.1 11-11-2021 - Se agrega número de días vigentes al cupón de tipo "premio especial".
     *
     * @return array  $objResponse
     */
    public function editCupon($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdcupon             = $arrayData['strIdcupon']         ? $arrayData['strIdcupon']:'';
        $strDescripcion         = $arrayData['strDescripcion']     ? $arrayData['strDescripcion']:'';
        $strEstado              = $arrayData['strEstado']          ? $arrayData['strEstado']:'ACTIVO';
        $strRestaurante         = $arrayData['strRestaurante']     ? $arrayData['strRestaurante']:'';
        $strTipoCupon           = $arrayData['strTipoCupon']       ? $arrayData['strTipoCupon']:'';
        $strValor               = $arrayData['strValor']           ? $arrayData['strValor']:'';
        $strPrecio              = $arrayData['strPrecio']          ? $arrayData['strPrecio']:'';
        $strDiaVigente          = $arrayData['strDiaVigente']      ? $arrayData['strDiaVigente']:'';
        $strImagen              = $arrayData['strImagen']          ? $arrayData['strImagen']:'';
        $strUsuarioCreacion     = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strBitacoraRestaurante = '';
        $strRutaImagen          = "";
        $strStatus              = 200;
        $boolSucces             = true;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            $objCupon = $this->getDoctrine()
                             ->getRepository(InfoCupon::class)
                             ->find($strIdcupon);
            if(empty($objCupon) || !is_object($objCupon))
            {
                throw new \Exception('No existe el cupón enviado por parámetro.');
            }
            $objTipoCupon = $this->getDoctrine()
                                 ->getRepository(AdmiTipoCupon::class)
                                 ->findOneBy(array("id"     =>$strTipoCupon,
                                                   "ESTADO" =>'ACTIVO'));
            if(!is_object($objTipoCupon) || empty($objTipoCupon))
            {
                throw new \Exception('No existe el tipo de cupón enviado por parámetro.');
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                           'VALOR_ANTERIOR' => $objCupon->getCUPON(),
                                           'VALOR_ACTUAL'   => strtolower(str_replace(" ","_",$strDescripcion)),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => $objCupon->getESTADO(),
                                           'VALOR_ACTUAL'   => strtoupper($strEstado),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Tipo de cupón",
                                           'VALOR_ANTERIOR' => str_replace("_"," ",ucwords($objCupon->getTIPOCUPONID()->getDESCRIPCION())),
                                           'VALOR_ACTUAL'   => str_replace("_"," ",ucwords($objTipoCupon->getDESCRIPCION())),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Puntos",
                                           'VALOR_ANTERIOR' => $objCupon->getVALOR(),
                                           'VALOR_ACTUAL'   => intval($strValor),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Precio",
                                           'VALOR_ANTERIOR' => $objCupon->getPRECIO(),
                                           'VALOR_ACTUAL'   => intval($strPrecio),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Días vigente",
                                           'VALOR_ANTERIOR' => $objCupon->getDIAVIGENTE(),
                                           'VALOR_ACTUAL'   => intval($strDiaVigente),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $em->getConnection()->beginTransaction();
            $objCupon->setCUPON(strtolower(str_replace(" ","_",$strDescripcion)));
            $objCupon->setESTADO(strtoupper($strEstado));
            $objCupon->setVALOR(intval($strValor));
            $objCupon->setTIPOCUPONID($objTipoCupon);
            $objCupon->setPRECIO(intval($strPrecio));
            $objCupon->setDIAVIGENTE(intval($strDiaVigente));
            if(!empty($objCupon->getIMAGEN()))
            {
                $objController->getEliminarImg($objCupon->getIMAGEN());
            }
            if(!empty($strImagen))
            {
                $strRutaImagen = $objController->subirfichero($strImagen,1);
            }
            $objCupon->setIMAGEN($strRutaImagen);
            $objCupon->setUSRMODIFICACION($strUsuarioCreacion);
            $objCupon->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objCupon);
            $em->flush();
            $objRelacionCupon = $this->getDoctrine()
                                     ->getRepository(InfoCuponRestaurante::class)
                                     ->findBy(array("CUPON_ID" =>$objCupon->getId()));
            if(!empty($objRelacionCupon) && is_array($objRelacionCupon))
            {
                foreach($objRelacionCupon as $item)
                {
                    $strBitacoraRestaurante = $item->getRESTAURANTEID()->getNOMBRECOMERCIAL();
                    $em->remove($item);
                }
                $em->flush();
            }
            if($objTipoCupon->getDESCRIPCION() == "GENERAL_RESTAURANTE" || $objTipoCupon->getDESCRIPCION() == "UNICO_RESTAURANTE")
            {
                $objRestaurante = $this->getDoctrine()
                                       ->getRepository(InfoRestaurante::class)
                                       ->findOneBy(array('id'     => $strRestaurante));
                if(!is_object($objRestaurante) || empty($objRestaurante))
                {
                    throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
                }
                $entityCuponRes = new InfoCuponRestaurante();
                $entityCuponRes->setCUPONID($objCupon);
                $entityCuponRes->setESTADO(strtoupper($strEstado));
                $entityCuponRes->setRESTAURANTEID($objRestaurante);
                $entityCuponRes->setUSRCREACION($strUsuarioCreacion);
                $entityCuponRes->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponRes);
                $em->flush();
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Restaurante",
                                               'VALOR_ANTERIOR' => $strBitacoraRestaurante,
                                               'VALOR_ACTUAL'   => $objRestaurante->getNOMBRECOMERCIAL(),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            if(!empty($arrayBitacoraDetalle))
            {
                $this->createBitacora(array("strAccion"            => "Modificación",
                                            "strModulo"            => "Cupón",
                                            "strUsuarioCreacion"   => $strUsuarioCreacion,
                                            "intReferenciaId"      => $objCupon->getId(),
                                            "strReferenciaValor"   => $objCupon->getCupon(),
                                            "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Cupón editado con éxito.!';
        }
        catch(\Exception $ex)
        {
            $strStatus = 204;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getCupon'
     *
     * Método encargado de retornar todos los cupones según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 27-08-2021
     * 
     * @return array  $objResponse
     */
    public function getCupon($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdCupon           = $arrayData['strIdCupon']          ? $arrayData['strIdCupon']:'';
        $strDescripcionTipo   = $arrayData['strDescripcionTipo']  ? $arrayData['strDescripcionTipo']:'';
        $strVerCuponAsignado  = $arrayData['strVerCuponAsignado'] ? $arrayData['strVerCuponAsignado']:'';
        $strUsuarioCreacion   = $arrayData['strUsuarioCreacion']  ? $arrayData['strUsuarioCreacion']:'';
        $arrayRespuesta       = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $boolSucces           = true;
        try
        {
            $arrayRespuesta  = $this->getDoctrine()
                                    ->getRepository(InfoCupon::class)
                                    ->getCupon(array('strIdCupon'          => $strIdCupon,
                                                     'strVerCuponAsignado' => $strVerCuponAsignado,
                                                     'strDescripcionTipo'  => $strDescripcionTipo));
            if(!empty($arrayRespuesta["error"]))
            {
                throw new \Exception($arrayRespuesta['error']);
            }
            foreach($arrayRespuesta['resultados'] as &$arrayItem)
            {
                if(!empty($arrayItem['strImagen']))
                {
                    $objController = new DefaultController();
                    $objController->setContainer($this->container);
                    $arrayItem['strImagen'] = $objController->getImgBase64($arrayItem['strImagen']);
                }
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error']      = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getTipoCupon'
     *
     * Método encargado de retornar todos los tipos de cupones según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 27-08-2021
     * 
     * @return array  $objResponse
     */
    public function getTipoCupon($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayRespuesta       = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $boolSucces           = true;
        try
        {
            $arrayRespuesta  = $this->getDoctrine()
                                    ->getRepository(AdmiTipoCupon::class)
                                    ->getTipoCupon(array());
            if(!empty($arrayRespuesta["error"]))
            {
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error']      = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    
    /**
     * Documentación para la función 'getResumenCliente'
     *
     * Método encargado de retornar los datos del cliente.
     * 
     * @author Kevin Baque
     * @version 1.0 07-09-2021
     * 
     * @return array  $objResponse
     */
    public function getResumenCliente($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCltEncuesta     = $arrayData['intIdCltEncuesta'] ? $arrayData['intIdCltEncuesta']:'';
        $strUsuarioCreacion   = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $arrayRespuesta       = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $boolSucces           = true;
        $intNumeroEncuesta    = 0;
        try
        {
            $objCltEncuesta  = $this->getDoctrine()
                                    ->getRepository(InfoClienteEncuesta::class)
                                    ->find($intIdCltEncuesta);
            if(empty($objCltEncuesta) || !is_object($objCltEncuesta))
            {
                throw new \Exception("No existe información con los parámetros recibidos.");
            }
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($objCltEncuesta->getCLIENTEID()->getId());
            if(empty($objCliente) || !is_object($objCliente))
            {
                throw new \Exception("No existe cliente con los parámetros recibidos.");
            }
            $arrayNumeroEncuesta = $this->getDoctrine()
                                        ->getRepository(InfoClienteEncuesta::class)
                                        ->getCantidadEncuestaCliente(array('clienteId'       => $objCliente->getId(),
                                                                           'strEstado'       => array('ACTIVO','PENDIENTE'),
                                                                           'strBanderaFecha' => "NO"));
            $arrayEncuestas = $this->getDoctrine()
                                   ->getRepository(InfoClienteEncuesta::class)
                                   ->getResumenCliente(array('intIdCliente' => $objCliente->getId()));
            $arrayRespuesta["ID_CLIENTE"]     = $objCliente->getId();
            $arrayRespuesta["CLIENTE"]        = $objCliente->getNOMBRE()." ".$objCliente->getAPELLIDO();
            $arrayRespuesta["CORREO"]         = $objCliente->getCORREO();
            $arrayRespuesta["EDAD"]           = $objCliente->getEDAD();
            $arrayRespuesta["GENERO"]         = $objCliente->getGENERO();
            $arrayRespuesta["FE_REGISTRO"]    = $objCliente->getFECREACION()->format('Y-m-d');
            $arrayRespuesta["NUM_ENCUESTA"]   = $arrayNumeroEncuesta["CANTIDAD"];
            $arrayRespuesta["arrayEncuestas"] = (!empty($arrayEncuestas["resultados"])) ? $arrayEncuestas["resultados"]:array();
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error']      = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getTipoPromocion'
     *
     * Método encargado de retornar todos los tipos de promociones según los parámetros enviados.
     * 
     * @author Kevin Baque
     * @version 1.0 11-11-2021
     * 
     * @return array  $objResponse
     */
    public function getTipoPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayRespuesta       = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $boolSucces           = true;
        try
        {
            $arrayRespuesta  = $this->getDoctrine()
                                    ->getRepository(AdmiTipoPromocion::class)
                                    ->getTipoPromocion($arrayData);
            if(!empty($arrayRespuesta["error"]))
            {
                throw new \Exception($arrayRespuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error']      = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

}
