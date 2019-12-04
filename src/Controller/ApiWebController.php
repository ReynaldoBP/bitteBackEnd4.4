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
                case 'getComparativosRestaurantes':$arrayRespuesta = $this->getComparativosRestaurantes($arrayData);
                break;
                case 'getParametro':$arrayRespuesta = $this->getParametro($arrayData);
                break;
                case 'generarPass':$arrayRespuesta = $this->generarPass($arrayData);
                break;
                case 'getVistasPublicidades':$arrayRespuesta = $this->getVistasPublicidades($arrayData);
                break;
                 $objResponse->setContent(json_encode(array(
                                                     'status'    => 400,
                                                     'resultado' => "No existe método con la descripción enviado por parámetro",
                                                     'succes'    => true
                                                     )
                                                 ));
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
     * @return array  $objResponse
     */
    public function createRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strTipoComida          = $arrayData['tipoComida'] ? $arrayData['tipoComida']:'';
        $strIdTipoComida        = $arrayData['idTipoComida'] ? $arrayData['idTipoComida']:'';
        $strTipoIdentificacion  = $arrayData['tipoIdentificacion'] ? $arrayData['tipoIdentificacion']:'';
        $strIdentificacion      = $arrayData['identificacion'] ? $arrayData['identificacion']:'';
        $strRazonSocial         = $arrayData['razonSocial'] ? $arrayData['razonSocial']:'';
        $strNombreComercial     = $arrayData['nombreComercial'] ? $arrayData['nombreComercial']:'';
        $strRepresentanteLegal  = $arrayData['representanteLegal'] ? $arrayData['representanteLegal']:'';
        $strDireccionTributario = $arrayData['direcion'] ? $arrayData['direcion']:'';
        $strUrlCatalogo         = $arrayData['urlCatalogo'] ? $arrayData['urlCatalogo']:'';
        $strNumeroContacto      = $arrayData['numeroContacto'] ? $arrayData['numeroContacto']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $icoBase64              = $arrayData['rutaIcono'] ? $arrayData['rutaIcono']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64);
            }
            if(!empty($icoBase64))
            {
                $strRutaIcono  = $objController->subirfichero($icoBase64);
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
            $objTipoComida = $this->getDoctrine()
                                  ->getRepository(AdmiTipoComida::class)
                                  ->find($strIdTipoComida);
            if(!is_object($objTipoComida) || empty($objTipoComida))
            {
                $objTipoComida = $this->getDoctrine()
                                      ->getRepository(AdmiTipoComida::class)
                                      ->findOneBy(array('DESCRIPCION'=>$strTipoComida));
                if(!is_object($objTipoComida) || empty($objTipoComida))
                {
                    throw new \Exception('Tipo de comida no existe.');
                }
            }
            $objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->findOneBy(array('IDENTIFICACION'=>$strIdentificacion));
            if(is_object($objRestaurante) && !empty($objRestaurante))
            {
                throw new \Exception('Restaurante ya existente.');
            }
            $entityRestaurante = new InfoRestaurante();
            $entityRestaurante->setTIPOCOMIDAID($objTipoComida);
            $entityRestaurante->setTIPOIDENTIFICACION(strtoupper($strTipoIdentificacion));
            $entityRestaurante->setIDENTIFICACION($strIdentificacion);
            $entityRestaurante->setRAZONSOCIAL($strRazonSocial);
            $entityRestaurante->setNOMBRECOMERCIAL($strNombreComercial);
            $entityRestaurante->setREPRESENTANTELEGAL($strRepresentanteLegal);
            $entityRestaurante->setDIRECCIONTRIBUTARIO($strDireccionTributario);
            $entityRestaurante->setURLCATALOGO($strUrlCatalogo);
            $entityRestaurante->setIMAGEN($strRutaImagen);
            $entityRestaurante->setICONO($strRutaIcono);
            $entityRestaurante->setNUMEROCONTACTO($strNumeroContacto);
            $entityRestaurante->setESTADO(strtoupper($strEstado));
            $entityRestaurante->setUSRCREACION($strUsuarioCreacion);
            $entityRestaurante->setFECREACION($strDatetimeActual);
            $em->persist($entityRestaurante);
            $em->flush();
            $strMensajeError = 'Restaurante creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un restaurante, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'editRestaurante'
     * Método encargado de editar los restaurantes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @return array  $objResponse
     */
    public function editRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdTipoComida        = $arrayData['idTipoComida'] ? $arrayData['idTipoComida']:'';
        $strTipoIdentificacion  = $arrayData['tipoIdentificacion'] ? $arrayData['tipoIdentificacion']:'';
        $strIdentificacion      = $arrayData['identificacion'] ? $arrayData['identificacion']:'';
        $strIdRestaurante       = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $strRazonSocial         = $arrayData['razonSocial'] ? $arrayData['razonSocial']:'';
        $strNombreComercial     = $arrayData['nombreComercial'] ? $arrayData['nombreComercial']:'';
        $strRepresentanteLegal  = $arrayData['representanteLegal'] ? $arrayData['representanteLegal']:'';
        $strDireccionTributario = $arrayData['direcion'] ? $arrayData['direcion']:'';
        $strUrlCatalogo         = $arrayData['urlCatalogo'] ? $arrayData['urlCatalogo']:'';
        $strNumeroContacto      = $arrayData['numeroContacto'] ? $arrayData['numeroContacto']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $icoBase64              = $arrayData['rutaIcono'] ? $arrayData['rutaIcono']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            if(!empty($imgBase64))
            {
                $strRutaImagen = $objController->subirfichero($imgBase64);
            }
            if(!empty($icoBase64))
            {
                $strRutaIcono = $objController->subirfichero($icoBase64);
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
            if(!empty($strIdTipoComida))
            {
                $objTipoComida = $this->getDoctrine()
                                      ->getRepository(AdmiTipoComida::class)
                                      ->find($strIdTipoComida);
                if(!is_object($objTipoComida) || empty($objTipoComida))
                {
                    throw new \Exception('Tipo de comida no existe.');
                }
                $objRestaurante->setTIPOCOMIDAID($objTipoComida);
            }
            if(!empty($strTipoIdentificacion))
            {
                $objRestaurante->setTIPOIDENTIFICACION(strtoupper($strTipoIdentificacion));
            }
            if(!empty($strIdentificacion))
            {
                $objRestaurante->setIDENTIFICACION($strIdentificacion);
            }
            if(!empty($strRazonSocial))
            {
                $objRestaurante->setRAZONSOCIAL($strRazonSocial);
            }
            if(!empty($strNombreComercial))
            {
                $objRestaurante->setNOMBRECOMERCIAL($strNombreComercial);
            }
            if(!empty($strRepresentanteLegal))
            {
                $objRestaurante->setREPRESENTANTELEGAL($strRepresentanteLegal);
            }
            if(!empty($strDireccionTributario))
            {
                $objRestaurante->setDIRECCIONTRIBUTARIO($strDireccionTributario);
            }
            if(!empty($strUrlCatalogo))
            {
                $objRestaurante->setURLCATALOGO($strUrlCatalogo);
            }
            if(!empty($strNumeroContacto))
            {
                $objRestaurante->setNUMEROCONTACTO($strNumeroContacto);
            }
            if(!empty($strEstado))
            {
                $objRestaurante->setESTADO(strtoupper($strEstado));
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
            $strMensajeError = 'Restaurante editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un restaurante, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'createPublicidad'
     * Método encargado de crear las publicidades según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-09-2019
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
        $strPais                = $arrayData['pais'] ? $arrayData['pais']:'';
        $strProvincia           = $arrayData['provincia'] ? $arrayData['provincia']:'';
        $strCiudad              = $arrayData['ciudad'] ? $arrayData['ciudad']:'';
        $strParroquia           = $arrayData['parroquia'] ? $arrayData['parroquia']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
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
                $strRutaImagen = $objController->subirfichero($imgBase64);
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
            $entityPublicidad->setESTADO(strtoupper($strEstado));
            $entityPublicidad->setUSRCREACION($strUsuarioCreacion);
            $entityPublicidad->setFECREACION($strDatetimeActual);
            $em->persist($entityPublicidad);
            $em->flush();
            $strMensajeError = 'Publicidad creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
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
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayPublicidad,
                                            'succes'    => true
                                            )
                                        ));
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
        $strPais                = $arrayData['pais'] ? $arrayData['pais']:'';
        $strProvincia           = $arrayData['provincia'] ? $arrayData['provincia']:'';
        $strCiudad              = $arrayData['ciudad'] ? $arrayData['ciudad']:'';
        $strParroquia           = $arrayData['parroquia'] ? $arrayData['parroquia']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
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
                $strRutaImagen = $objController->subirfichero($imgBase64);
            }
            $objPublicidad = $this->getDoctrine()
                                  ->getRepository(InfoPublicidad::class)
                                  ->findOneBy(array('id'=>$intIdPublicidad));
            if(!is_object($objPublicidad) || empty($objPublicidad))
            {
                throw new \Exception('No existe publicidad con la identificación enviada por parámetro.');
            }
            if(!empty($strDescrPublicidad))
            {
                $objPublicidad->setDESCRIPCION($strDescrPublicidad);
            }
            if(!empty($strRutaImagen))
            {
                $objPublicidad->setIMAGEN($strRutaImagen);
            }
            if(!empty($strOrientacion))
            {
                $objPublicidad->setORIENTACION($strOrientacion);
            }
            if(!empty($strEdadMaxima))
            {
                $objPublicidad->setEDADMAXIMA($strEdadMaxima);
            }
            if(!empty($strEdadMinima))
            {
                $objPublicidad->setEDADMINIMA($strEdadMinima);
            }
            if(!empty($strGenero))
            {
                $objPublicidad->setGENERO($strGenero);
            }
            if(!empty($strPais))
            {
                $objPublicidad->setPAIS($strPais);
            }
            if(!empty($strProvincia))
            {
                $objPublicidad->setPROVINCIA($strProvincia);
            }
            if(!empty($strCiudad))
            {
                $objPublicidad->setCIUDAD($strCiudad);
            }
            if(!empty($strParroquia))
            {
                $objPublicidad->setPARROQUIA($strParroquia);
            }
            if(!empty($strEstado))
            {
                $objPublicidad->setESTADO(strtoupper($strEstado));
            }
            $objPublicidad->setUSRMODIFICACION($strUsuarioCreacion);
            $objPublicidad->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objPublicidad);
            $em->flush();
            $strMensajeError = 'Publicidad editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            
            $strMensajeError = "Fallo al editar un Publicidad, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'createPromocion'
     * Método encargado de crear las promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-09-2019
     * 
     * @author Kevin Baque Se cambia la sucursalID por RestauranteID
     * @version 1.1 08-11-2019
     * 
     * @return array  $objResponse
     */
    public function createPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante       = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $strDescrPromocion      = $arrayData['descrPromocion'] ? $arrayData['descrPromocion']:'';
        $imgBase64              = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $intCantPuntos          = $arrayData['cantPuntos'] ? $arrayData['cantPuntos']:'';
        $strAceptaGlobal        = $arrayData['aceptaGlobal'] ? $arrayData['aceptaGlobal']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strPremio              = $arrayData['premio'] ? $arrayData['premio']:'NO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
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
                $strRutaImagen = $objController->subirfichero($imgBase64);
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
            $entityPromocion = new InfoPromocion();
            $entityPromocion->setRESTAURANTEID($objRestaurante);
            $entityPromocion->setDESCRIPCIONTIPOPROMOCION($strDescrPromocion);
            $entityPromocion->setIMAGEN($strRutaImagen);
            $entityPromocion->setPREMIO($strPremio);
            $entityPromocion->setCANTIDADPUNTOS($intCantPuntos);
            $entityPromocion->setACEPTAGLOBAL($strAceptaGlobal);
            $entityPromocion->setESTADO(strtoupper($strEstado));
            $entityPromocion->setUSRCREACION($strUsuarioCreacion);
            $entityPromocion->setFECREACION($strDatetimeActual);
            $em->persist($entityPromocion);
            $em->flush();
            $strMensajeError = 'Promoción creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear una Promoción, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'editPromocion'
     * Método encargado de editar las promociones según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 13-09-2019
     * 
     * @author Kevin Baque Se cambia la sucursalID por RestauranteID.
     * @version 1.1 08-11-2019
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
        $intCantPuntos          = $arrayData['cantPuntos'] ? $arrayData['cantPuntos']:'';
        $strAceptaGlobal        = $arrayData['aceptaGlobal'] ? $arrayData['aceptaGlobal']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strPremio              = $arrayData['premio'] ? $arrayData['premio']:'NO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
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
                $strRutaImagen = $objController->subirfichero($imgBase64);
            }
            $objPromocion = $this->getDoctrine()
                                 ->getRepository(InfoPromocion::class)
                                 ->findOneBy(array('id'=>$intIdPromocion));
            if(!is_object($objPromocion) || empty($objPromocion))
            {
                throw new \Exception('No existe promoción con la identificación enviada por parámetro.');
            }
            if(!empty($intIdRestaurante))
            {
                $arrayParametros = array('ESTADO' => $strEstado,
                                         'id'     => $intIdRestaurante);
                $objRestaurante  = $this->getDoctrine()
                                        ->getRepository(InfoRestaurante::class)
                                        ->findOneBy($arrayParametros);
                if(!is_object($objRestaurante) || empty($objRestaurante))
                {
                    throw new \Exception('No existe el restaurante con la descripción enviada por parámetro.');
                }
                $objPromocion->setRESTAURANTEID($objRestaurante);
            }
            if(!empty($strDescrPromocion))
            {
                $objPromocion->setDESCRIPCIONTIPOPROMOCION($strDescrPromocion);
            }
            if(!empty($strRutaImagen))
            {
                $objPromocion->setIMAGEN($strRutaImagen);
            }
            if(!empty($strPremio))
            {
                $objPromocion->setPREMIO($strPremio);
            }
            if(!empty($intCantPuntos))
            {
                $objPromocion->setCANTIDADPUNTOS($intCantPuntos);
            }
            if(!empty($strAceptaGlobal))
            {
                $objPromocion->setACEPTAGLOBAL($strAceptaGlobal);
            }
            if(!empty($strEstado))
            {
                $objPromocion->setESTADO(strtoupper($strEstado));
            }
            $objPromocion->setUSRMODIFICACION($strUsuarioCreacion);
            $objPromocion->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objPromocion);
            $em->flush();
            $strMensajeError = 'Promoción editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            
            $strMensajeError = "Fallo al editar un Promoción, intente nuevamente.\n ". $ex->getMessage();
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
        $intIdCliente      = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strIdentificacion = $arrayData['identificacion'] ? $arrayData['identificacion']:'';
        $intIdRestaurante  = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $strNombres        = $arrayData['nombres'] ? $arrayData['nombres']:'';
        $strApellidos      = $arrayData['apellidos'] ? $arrayData['apellidos']:'';
        $strContador       = $arrayData['strContador'] ? $arrayData['strContador']:'';
        $strCupoDisponible = $arrayData['strCupoDisponible'] ? $arrayData['strCupoDisponible']:'NO';
        $strEstado         = $arrayData['estado'] ? $arrayData['estado']:'';
        $arrayCliente      = array();
        $strMensajeError   = '';
        $strStatus         = 400;
        $objResponse       = new Response;
        try
        {
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
                $strRutaImagen = $objController->subirfichero($imgBase64);
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
                $strRutaImagen = $objController->subirfichero($imgBase64);
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
     * @return array  $objResponse
     */
    public function getClienteEncuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['strEstado'] ? $arrayData['strEstado']:'';
        $strMes             = $arrayData['strMes'] ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio'] ? $arrayData['strAnio']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEncuesta(array('strEstado' => $strEstado,
                                                                  'strMes'    => $strMes,
                                                                  'strAnio'   => $strAnio));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltEncuesta,
                                            'succes'    => true
                                            )
                                        ));
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
     * @return array  $objResponse
     */
    public function getClienteEncuestaSemestral($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['strEstado'] ? $arrayData['strEstado']:'';
        $strLimite          = $arrayData['strLimite'] ? $arrayData['strLimite']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEncuestaSemestral(array('strEstado'  => $strEstado,
                                                                           'strLimite'  => $strLimite));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltEncuesta,
                                            'succes'    => true
                                            )
                                        ));
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
     * @return array  $objResponse
     */
    public function getClienteEncuestaSemanal($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['strEstado'] ? $arrayData['strEstado']:'';
        $strLimite          = $arrayData['strLimite'] ? $arrayData['strLimite']:'';
        $arrayCltEncuesta   = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEncuestaSemanal(array('strEstado'  => $strEstado,
                                                                         'strLimite'  => $strLimite));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltEncuesta,
                                            'succes'    => true
                                            )
                                        ));
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
     * @return array  $objResponse
     */
    public function editClienteEncuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdClienteEncuesta   = $arrayData['idClienteEncuesta'] ? $arrayData['idClienteEncuesta']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ELIMINADO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
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
            if(!empty($strEstado))
            {
                $objContenido->setESTADO(strtoupper($strEstado));
            }
            $objContenido->setUSRMODIFICACION($strUsuarioCreacion);
            $objContenido->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objContenido);
            $em->flush();
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
     * Documentación para la función 'editPromocionHistorial'
     * Método encargado de editar el historial de la promoción según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 30-09-2019
     * 
     * @return array  $objResponse
     *
     * @author Kevin Baque
     * @version 1.1 03-12-2019 - Se agrega envío de correo notificando que canjio puntos.
     *
     */
    public function editPromocionHistorial($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPromocionHist     = $arrayData['idPromocionHist'] ? $arrayData['idPromocionHist']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'COMPLETADO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $arrayPromocionHist = $this->getDoctrine()
                                       ->getRepository(InfoPromocionHistorial::class)
                                       ->findBy(array('id'     => $intIdPromocionHist,
                                                      'ESTADO' => 'PENDIENTE'));
            if(!is_array($arrayPromocionHist) || empty($arrayPromocionHist))
            {
                throw new \Exception('Promoción no existe o ha sido completada.');
            }
            foreach($arrayPromocionHist as $arrayItem)
            {
                $intIdPromocionHist = $arrayItem->getId();
            }
            $objPromocionHist = $this->getDoctrine()
                                     ->getRepository(InfoPromocionHistorial::class)
                                     ->find($intIdPromocionHist);
            if(!is_object($objPromocionHist) || empty($objPromocionHist))
            {
                throw new \Exception('Promoción no existe o ha sido completada.');
            }
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
            if($strEstado == 'COMPLETADO')
            {
                $strAsunto            = '¡CANJEASTE PUNTOS!';
                $strNombreUsuario     = $objCliente->getNOMBRE() .' '.$objCliente->getAPELLIDO();
                $strMensajeCorreo = '
                <div class="">¡Hola! '.$strNombreUsuario.'.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">FELICITACIONES!!!!&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Acabas de canjear '.$objPromocion->getCANTIDADPUNTOS().' puntos en el restaurante '.$objRestaurante->getNOMBRECOMERCIAL().' esperamos que tu premio est&eacute; delicioso.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">¡Sigue disfrutando de salir a comer con tus familiares y amigos!&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Recuerda siempre usar tu app BITTE para calificar tu experiencia, compartir en tus redes sociales, ganar m&aacute;s puntos y comer gratis.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Buen provecho,&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Bitte.&nbsp;</div>
                <div class="">&nbsp;</div>';
            }
            else if($strEstado == 'ELIMINADO')
            {
                $strAsunto            = '¡PERDISTE PUNTOS!';
                $strNombreUsuario     = $objCliente->getNOMBRE() .' '.$objCliente->getAPELLIDO();
                $strMensajeCorreo = '
                <div class="">¡Hola! '.$strNombreUsuario.'.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">¡LO SENTIMOS!&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Se han restado '.$objPromocion->getCANTIDADPUNTOS().' puntos en el restaurante '.$objRestaurante->getNOMBRECOMERCIAL().' pues este establecimiento ha notado que tu foto no corresponde a un plato de comida de ellos y a su vez pierdes un cup&oacute;n para el sorteo mensual de comidas gratuitas.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Sabemos que fue un error involuntario y te recomendamos a ser m&aacute;s cauteloso al momento de calificar.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">¡Sigue disfrutando de salir a comer con tus familiares y amigos!&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Recuerda siempre usar tu app BITTE para calificar tu experiencia, compartir en tus redes sociales, ganar m&aacute;s puntos y comer gratis.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Buen provecho,&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Bitte.&nbsp;</div>
                <div class="">&nbsp;</div>';
            }
            $strRemitente     = 'notificaciones_bitte@massvision.tv';
            $arrayParametros  = array('strAsunto'        => $strAsunto,
                                      'strMensajeCorreo' => $strMensajeCorreo,
                                      'strRemitente'     => $strRemitente,
                                      'strDestinatario'  => $objCliente->getCORREO());
            $objController    = new DefaultController();
            $objController->setContainer($this->container);
            $objController->enviaCorreo($arrayParametros);
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
        $intIdCliente           = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $arrayPromocionHist = $this->getDoctrine()
                                       ->getRepository(InfoPromocionHistorial::class)
                                       ->getPromocionCriterioWeb(array('intIdRestaurante' => $intIdRestaurante,
                                                                       'intIdCliente'     => $intIdCliente,
                                                                       'ESTADO'           => $strEstado));
            if(!is_array($arrayPromocionHist) || empty($arrayPromocionHist))
            {
                throw new \Exception('Promoción no existe o ha sido completada.');
            }
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al listar Historial de la promoción, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayPromocionHist,
                                            'succes'    => true
                                            )
                                        ));
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
     * @return array  $objResponse
     */
    public function createPromocionHistorial($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPromocion     = $arrayData['idPromocion'] ? $arrayData['idPromocion']:'';
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'PENDIENTE';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
        $intCantidadPuntos  = 0;
        $intCantPuntospromo = 0;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
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
            $entityPromocionHist = new InfoPromocionHistorial();
            $entityPromocionHist->setCLIENTEID($objCliente);
            $entityPromocionHist->setPROMOCIONID($objPromocion);
            $entityPromocionHist->setESTADO(strtoupper($strEstado));
            $entityPromocionHist->setUSRCREACION($strUsuarioCreacion);
            $entityPromocionHist->setFECREACION($strDatetimeActual);
            $em->persist($entityPromocionHist);
            $em->flush();
            $strMensajeError = 'Historial de la Promoción creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear el Historial de la Promoción, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'getRedesSocialMensual'
     * Método encargado de retornar las redes sociales mensual.
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 17-10-2019
     * 
     * @return array  $objResponse
     */
    public function getRedesSocialMensual($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strMes             = $arrayData['strMes'] ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio'] ? $arrayData['strAnio']:'';
        $arrayRedSocial     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $arrayRedSocial   = $this->getDoctrine()
                                     ->getRepository(InfoRedesSociales::class)
                                     ->getRedesSocialMensual(array('strMes'   => $strMes,
                                                                   'strAnio'  => $strAnio));
            if(isset($arrayRedSocial['error']) && !empty($arrayRedSocial['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRedSocial['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRedSocial['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRedSocial,
                                            'succes'    => true
                                            )
                                        ));
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
     * @return array  $objResponse
     */
    public function getClienteGenero($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strMes             = $arrayData['strMes'] ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio'] ? $arrayData['strAnio']:'';
        $arrayCltEncuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteGenero(array('strMes'   => $strMes,
                                                                'strAnio'  => $strAnio));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltEncuesta,
                                            'succes'    => true
                                            )
                                        ));
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
     * @return array  $objResponse
     */
    public function getClienteEdad($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strMes             = $arrayData['strMes'] ? $arrayData['strMes']:'';
        $strAnio            = $arrayData['strAnio'] ? $arrayData['strAnio']:'';
        $arrayCltEncuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $arrayCltEncuesta   = $this->getDoctrine()
                                       ->getRepository(InfoClienteEncuesta::class)
                                       ->getClienteEdad(array('strMes'   => $strMes,
                                                              'strAnio'  => $strAnio));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCltEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCltEncuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltEncuesta,
                                            'succes'    => true
                                            )
                                        ));
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
        $strFechaIni        = $arrayData['strFechaIni'] ? $arrayData['strFechaIni']:'';
        $strFechaFin        = $arrayData['strFechaFin'] ? $arrayData['strFechaFin']:'';
        $strGenero          = $arrayData['strGenero'] ? $arrayData['strGenero']:'';
        $strHorario         = $arrayData['strHorario'] ? $arrayData['strHorario']:'';
        $strEdad            = $arrayData['strEdad'] ? $arrayData['strEdad']:'';
        $strPais            = $arrayData['strPais'] ? $arrayData['strPais']:'';
        $strCiudad          = $arrayData['strCiudad'] ? $arrayData['strCiudad']:'';
        $strProvincia       = $arrayData['strProvincia'] ? $arrayData['strProvincia']:'';
        $strParroquia       = $arrayData['strParroquia'] ? $arrayData['strParroquia']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
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
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
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
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
            $arrayParametros = array("strMes"      => $strMes,
                                    "strAnio"      => $strAnio,
                                    "strGenero"    => $strGenero,
                                    "strHorario"   => $strHorario,
                                    "strEdad"      => $strEdad,
                                    "strPais"      => $strPais,
                                    "strCiudad"    => $strCiudad,
                                    "strProvincia" => $strProvincia,
                                    "intLimite"    => $intLimite,
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
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        try
        {
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
        <div class="">Bienvenido al mundo BITTE.</div>';
        $strRemitente     = 'notificaciones_bitte@massvision.tv';
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
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $boolSucces         = true;
        $objResponse        = new Response;
        try
        {
            $arrayParametros = array("strGenero"   => $strGenero,
                                     "strEdad"     => $strEdad,
                                     "strFechaIni" => $strFechaIni,
                                     "strFechaFin" => $strFechaFin,
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
}
