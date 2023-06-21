<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoCliente;
use App\Entity\AdmiTipoRol;
use App\Controller\DefaultController;
use App\Entity\AdmiTipoClientePuntaje;
use App\Entity\InfoUsuario;
use App\Entity\AdmiParametro;
use App\Entity\InfoRestaurante;
use App\Entity\InfoEncuesta;
use App\Entity\InfoPregunta;
use App\Entity\InfoRespuesta;
use App\Entity\InfoPublicidad;
use App\Entity\InfoPromocion;
use App\Entity\InfoSucursal;
use App\Entity\InfoLikeRes;
use App\Entity\InfoClientePunto;
use App\Entity\InfoContenidoSubido;
use App\Entity\InfoRedesSociales;
use App\Entity\InfoClientePuntoGlobal;
use App\Entity\InfoOpcionRespuesta;
use App\Entity\InfoClienteEncuesta;
use App\Entity\InfoPromocionHistorial;
use App\Entity\InfoVistaPublicidad;
use App\Entity\AdmiTipoComida;
use App\Entity\InfoClienteInfluencer;
use App\Entity\InfoCodigoPromocion;
use App\Entity\InfoCodigoPromocionHistorial;
use App\Entity\AdmiCiudad;
use App\Entity\InfoCupon;
use App\Entity\AdmiTipoCupon;
use App\Entity\InfoCuponHistorial;
use App\Entity\InfoCuponRestaurante;
use App\Entity\InfoPlantilla;
use App\Entity\InfoUsuarioRes;
use App\Entity\InfoBanner;
use App\Entity\InfoTipoComidaRestaurante;
use App\Entity\AdmiTipoPromocion;
use App\Entity\InfoCuponPromocion;
use App\Entity\InfoCuponPromocionClt;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class ApiMovilController extends FOSRestController
{
   /**
   * @Rest\Post("/movilBitte/procesar")
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
              case 'createCliente':$arrayRespuesta = $this->createCliente($arrayData);
              break;
              case 'editCliente':$arrayRespuesta = $this->editCliente($arrayData);
              break;
              case 'getCliente':$arrayRespuesta = $this->getCliente($arrayData);
              break;
              case 'getRestaurante':$arrayRespuesta = $this->getRestaurante($arrayData);
              break;
              case 'getEncuesta':$arrayRespuesta = $this->getEncuesta($arrayData);
              break;
              case 'getPregunta':$arrayRespuesta = $this->getPregunta($arrayData);
              break;
              /*
                       [INI]FLUJO DEL MOVIL CREAR PUNTOS
              */
              case 'getSucursalPorUbicacion':$arrayRespuesta = $this->getSucursalPorUbicacion($arrayData);//0
              break;
              case 'createContenido':$arrayRespuesta = $this->createContenido($arrayData);//1
              break;
              case 'createRespuesta':$arrayRespuesta = $this->createRespuesta($arrayData);//2
              break;
              case 'editContenido':$arrayRespuesta = $this->editContenido($arrayData);//3
              break;
              /*
                       [FIN]FLUJO DEL MOVIL CREAR PUNTOS
              */
              case 'getLoginMovil':$arrayRespuesta = $this->getLoginMovil($arrayData);
              break;
              case 'getPublicidad':$arrayRespuesta = $this->getPublicidad($arrayData);
              break;
              case 'createLike':$arrayRespuesta = $this->createLike($arrayData);
              break;
              case 'deleteLike':$arrayRespuesta = $this->deleteLike($arrayData);
              break;
              case 'createRedesSociales':$arrayRespuesta = $this->createRedesSociales($arrayData);
              break;
              case 'getPromocion':$arrayRespuesta = $this->getPromocion($arrayData);
              break;
              case 'createPromocionHistorial':$arrayRespuesta = $this->createPromocionHistorial($arrayData);
              break;
              case 'getTipoComida':$arrayRespuesta = $this->getTipoComida($arrayData);
              break;
              case 'editPromocionHistorial':$arrayRespuesta = $this->editPromocionHistorial($arrayData);
              break;
              case 'getCantPtosResEnc':$arrayRespuesta = $this->getCantPtosResEnc($arrayData);
              break;
              case 'generarPass':$arrayRespuesta = $this->generarPass($arrayData);
              break;
              case 'generarClave':$arrayRespuesta = $this->generarClave($arrayData);
              break;
              case 'envioCorreoCalificacion':$arrayRespuesta = $this->envioCorreoCalificacion($arrayData);
              break;
              case 'createPunto':$arrayRespuesta = $this->createPunto($arrayData);//Obsoleto
              break;
              case 'createPuntoGlobal':$arrayRespuesta = $this->createPuntoGlobal($arrayData);//Obsoleto
              break;
              case 'enviCorreoPrueba':$arrayRespuesta = $this->enviCorreoPrueba($arrayData);//Obsoleto
              break;
              case 'getEditInfoCltEncuestaPend':$arrayRespuesta = $this->getEditInfoCltEncuestaPend($arrayData);
              break;
              case 'generaCodigoSucursal':$arrayRespuesta = $this->generaCodigoSucursal($arrayData);
              break;
              case 'getCiudad':$arrayRespuesta = $this->getCiudad($arrayData);
              break;
              case 'canjearCupon':$arrayRespuesta = $this->canjearCupon($arrayData);
              break;
              case 'getClienteEncuestaPorRangoDia':$arrayRespuesta = $this->getClienteEncuestaPorRangoDia($arrayData);
              break;
              case 'getContenido':$arrayRespuesta = $this->getContenido($arrayData);
              break;
              case 'getBanner':$arrayRespuesta = $this->getBanner($arrayData);
              break;
              case 'getSucursalPorRestaurante':$arrayRespuesta = $this->getSucursalPorRestaurante($arrayData);
              break;
              case 'getClienteEncuesta':$arrayRespuesta = $this->getClienteEncuesta($arrayData);
              break;
              case 'editRespuesta':$arrayRespuesta = $this->editRespuesta($arrayData);
              break;
              case 'getSucursalPorUsuario':$arrayRespuesta = $this->getSucursalPorUsuario($arrayData);
              break;
              default:
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
     * Documentación para la función 'createCliente'
     * Método encargado de crear todos los clientes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 26-08-2019
     * 
     * @return array  $objResponse
     *
     * @author Kevin Baque
     * @version 1.1 05-12-2019 - Se edita el correo de bienvenida.
     *
     * @author Kevin Baque
     * @version 1.2 28-01-2020 - Se edita el correo de bienvenida(link de restaurante y term. cond.).
     *
     * @author Kevin Baque
     * @version 1.3 18-06-2021 - Se agrega lógica para obtener la cantidad de puntos cuando se crear un cliente.
     *
     */
    public function createCliente($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdentificacion  = isset($arrayData['identificacion']) ? $arrayData['identificacion']:'';
        $strDireccion       = isset($arrayData['direccion']) ? $arrayData['direccion']:'';
        $strEdad            = ( isset($arrayData['edad']) && !empty($arrayData['edad']) )
                                     ? $arrayData['edad'] : 'SIN EDAD';
        $strTipoComida      = isset($arrayData['tipoComida']) ? $arrayData['tipoComida']:'';
        $strEstado          = isset($arrayData['estado']) ? $arrayData['estado']:'';
        $strSector          = isset($arrayData['sector']) ? $arrayData['sector']:'';
        $strNombre          = isset($arrayData['nombre']) ? $arrayData['nombre']:'';
        $strApellido        = isset($arrayData['apellido']) ? $arrayData['apellido']:'';
        $strCorreo          = isset($arrayData['correo']) ? $arrayData['correo']:'';
        $strGenero          = ( isset($arrayData['genero']) && !empty($arrayData['genero']) )
                                     ? $arrayData['genero'] : 'SIN GENERO';

        $intIdTipoCLiente   = isset($arrayData['idTipoCLiente']) ? $arrayData['idTipoCLiente']:'';
        $intIdUsuario       = isset($arrayData['idUsuario']) ? $arrayData['idUsuario']:'1';//1->Bernardo Influencer
        $strContrasenia     = isset($arrayData['contrasenia']) ? $arrayData['contrasenia']:'';
        $strAutenticacionRS = isset($arrayData['autenticacionRS']) ? $arrayData['autenticacionRS']:'';
        $strUsuarioCreacion = isset($arrayData['usuarioCreacion']) ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $arrayCliente       = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        $strEstado          = (!empty($strAutenticacionRS) && $strAutenticacionRS == 'N') ? 'INACTIVO':'ACTIVO';
        $boolBanderaCambio  = 0;
        $boolBanderaCliente = 0;
        $boolBanderaCltNew  = 0;
        try
        {
            $em->getConnection()->beginTransaction();
            if(empty($strNombre) && empty($strApellido))
            {
                $strNombre = explode('@',$strCorreo);
                $strNombre = $strNombre[0];
            }
            $entityCliente  = $this->getDoctrine()
                            ->getRepository(InfoCliente::class)
                            ->findOneBy(array('CORREO'=>$strCorreo));
            if(is_object($entityCliente) || !empty($entityCliente))
            {
                $strAuthRS = $entityCliente->getAUTENTICACIONRS();
                if($strAutenticacionRS == 'S' && $strAuthRS == 'N')
                {
                    $boolBanderaCambio  = 1;
                }
                else
                {
                    $boolBanderaCliente  = 1;
                }
            }
            else
            {
                $boolBanderaCltNew = 1;
            }
            if($boolBanderaCambio == 0)
            {
                if($boolBanderaCliente == 0)
                {
                    $objTipoCliente = $this->getDoctrine()
                                           ->getRepository(AdmiTipoClientePuntaje::class)
                                           ->findOneBy(array('ESTADO' => 'ACTIVO',
                                                             'id'     => $intIdTipoCLiente));
                    if(!is_object($objTipoCliente) || empty($objTipoCliente))
                    {
                        throw new \Exception('No existe tipo cliente con la descripción enviada por parámetro.');
                    }
                    $objUsuario = $this->getDoctrine()
                                       ->getRepository(InfoUsuario::class)
                                       ->findOneBy(array('ESTADO' => 'ACTIVO',
                                                         'id'     => $intIdUsuario));
                    $entityCliente = new InfoCliente();
                    $entityCliente->setAUTENTICACIONRS($strAutenticacionRS);
                    $entityCliente->setCONTRASENIA(md5($strContrasenia));
                    $entityCliente->setIDENTIFICACION($strIdentificacion);
                    $entityCliente->setDIRECCION($strDireccion);
                    $entityCliente->setEDAD($strEdad);
                    $entityCliente->setTIPOCOMIDA($strTipoComida);
                    $entityCliente->setGENERO($strGenero);
                    $entityCliente->setESTADO(strtoupper($strEstado));
                    $entityCliente->setSECTOR($strSector);
                    $entityCliente->setTIPOCLIENTEPUNTAJEID($objTipoCliente);
                    if(is_object($objUsuario) && !empty($objUsuario))
                    {
                        $entityCliente->setUSUARIOID($objUsuario);
                    }
                    $entityCliente->setNOMBRE($strNombre);
                    $entityCliente->setAPELLIDO($strApellido);
                    $entityCliente->setCORREO($strCorreo);
                    $entityCliente->setUSRCREACION($strUsuarioCreacion);
                    $entityCliente->setFECREACION($strDatetimeActual);
                    $em->persist($entityCliente);
                    $em->flush();
                    $strMensajeError = 'Usuario creado con exito.!';
                    $objParametroBandera = $this->getDoctrine()
                                                ->getRepository(AdmiParametro::class)
                                                ->findOneBy(array('DESCRIPCION' => 'BANDERA_PUNTOS_CLT_NUEVOS',
                                                                  'ESTADO'      => 'ACTIVO'));
                    if(!is_object($objParametroBandera) || empty($objParametroBandera))
                    {
                        throw new \Exception('No existe el parametro BANDERA_PUNTOS_CLT_NUEVOS.');
                    }
                    if($boolBanderaCltNew == 1 && $objParametroBandera->getVALOR1() == "S")
                    {
                        $objParametro    = $this->getDoctrine()
                                                ->getRepository(AdmiParametro::class)
                                                ->findOneBy(array('DESCRIPCION' => 'CANT_PUNTOS_CLT_NUEVOS',
                                                                  'ESTADO'      => 'ACTIVO'));
                        if(!is_object($objParametro) || empty($objParametro))
                        {
                            throw new \Exception('No existe el parametro CANT_PUNTOS_CLT_NUEVOS.');
                        }
                        $arrayRestaurantes = $this->getDoctrine()
                                                  ->getRepository(InfoRestaurante::class)
                                                  ->getRestauranteCriterio(array('strEstado'       => "ACTIVO",
                                                                                 'strBanderaBitte' => "S"));
                        if(empty($arrayRestaurantes['error']))
                        {
                            $intCantPuntos = intval($objParametro->getVALOR1());
                            foreach ($arrayRestaurantes['resultados'] as $item)
                            {
                                $objRestaurante = $this->getDoctrine()
                                                    ->getRepository(InfoRestaurante::class)
                                                    ->find($item['ID_RESTAURANTE']);
                                if(is_object($objRestaurante) && !empty($objRestaurante))
                                {
                                    $entityCltPunto = new InfoClientePunto();
                                    $entityCltPunto->setCLIENTEID($entityCliente);
                                    $entityCltPunto->setRESTAURANTEID($objRestaurante);
                                    $entityCltPunto->setCANTIDADPUNTOS($intCantPuntos);
                                    $entityCltPunto->setESTADO("ACTIVO");
                                    $entityCltPunto->setUSRCREACION($strUsuarioCreacion);
                                    $entityCltPunto->setFECREACION($strDatetimeActual);
                                    $em->persist($entityCltPunto);
                                    $em->flush();
                                }
                            }
                        }
                    }
                    if ($em->getConnection()->isTransactionActive())
                    {
                        $em->getConnection()->commit();
                        $em->getConnection()->close();
                    }
                }
                if($strAutenticacionRS == 'N')
                {
                    $strNombreClt      = !empty($entityCliente->getNOMBRE()) ? $entityCliente->getNOMBRE():'';
                    $strWelcome        = (!empty($entityCliente->getGENERO()) && $entityCliente->getGENERO() == "MASCULINO") ? "Bienvenido":"Bienvenida";
                    $strDistractor     = substr(md5(time()),0,16);
                    //$strActivaCltLocal = "http://127.0.0.1/editCliente?jklasdqweuiorenm=".$strDistractor.$entityCliente->getId();
                    $strActivaCltProd  = "https://bitte.app:8080/editCliente?jklasdqweuiorenm=".$strDistractor.$entityCliente->getId();
                    $strUrlTermCond    ="https://la.bitte.app/privacy-policy/";
                    $strUrlRestaurante ="https://la.bitte.app/listado-restaurantes/";
                    $strAsunto         = $strWelcome.' Usuario Bitte';

                    $objPlantilla  = $this->getDoctrine()
                                          ->getRepository(InfoPlantilla::class)
                                          ->findOneBy(array('DESCRIPCION'=>"BIENVENIDA",
                                                            'ESTADO'     =>"ACTIVO"));
                    if(!empty($objPlantilla) && is_object($objPlantilla))
                    {
                        $strMensajeCorreo   = stream_get_contents ($objPlantilla->getPLANTILLA());
                        $strCuerpoCorreo1   = '<a href='.$strActivaCltProd.' target="_blank" >Activar mi cuenta</a>';
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);
                    }
                   $arrayParametros  = array('strAsunto'        => $strAsunto,
                                             'strMensajeCorreo' => $strMensajeCorreo,
                                             'strRemitente'     => "notificaciones@bitte.app",
                                             'strDestinatario'  => $strCorreo);
                   $objController    = new DefaultController();
                   $objController->setContainer($this->container);
                   $objController->enviaCorreo($arrayParametros);
                }
                if($boolBanderaCliente == 1)
                {
                    throw new \Exception('Cliente ya existente. Se envió el correo de ingreso');   
                }
                else
                {
                   $arrayCliente = array('id'             => $entityCliente->getId(),
                                      'identificacion' => $entityCliente->getIDENTIFICACION(),
                                      'nombre'         => $entityCliente->getNOMBRE(),
                                      'apellido'       => $entityCliente->getAPELLIDO(),
                                      'correo'         => $entityCliente->getCORREO(),
                                      'direccion'      => $entityCliente->getDIRECCION(),
                                      'edad'           => $entityCliente->getEDAD(),
                                      'tipoComida'     => $entityCliente->getTIPOCOMIDA(),
                                      'genero'         => $entityCliente->getGENERO(),
                                      'estado'         => $entityCliente->getESTADO(),
                                      'sector'         => $entityCliente->getSECTOR(),
                                      'usrCreacion'    => $entityCliente->getUSRCREACION(),
                                      'feCreacion'     => $entityCliente->getFECREACION());
                }
            }
            else
            {
                $entityCliente->setAUTENTICACIONRS($strAutenticacionRS);
                $entityCliente->setESTADO(strtoupper($strEstado));
                $entityCliente->setEDAD($strEdad);
                $entityCliente->setTIPOCOMIDA($strTipoComida);
                $entityCliente->setGENERO($strGenero);
                $entityCliente->setUSRCREACION($strUsuarioCreacion);
                $entityCliente->setFECREACION($strDatetimeActual);
                $em->persist($entityCliente);
                $em->flush();
                $strMensajeError = 'Usuario creado con exito.!';
                $em->getConnection()->commit();
                $em->getConnection()->close();
                $arrayCliente = array('id'               => $entityCliente->getId(),
                                        'identificacion' => $entityCliente->getIDENTIFICACION(),
                                        'nombre'         => $entityCliente->getNOMBRE(),
                                        'apellido'       => $entityCliente->getAPELLIDO());
            }
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear el cliente, intente nuevamente.\n ". $ex->getMessage();
        }

        $arrayCliente['mensaje'] = $strMensajeError;
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
     * Documentación para la función 'editCliente'
     * Método encargado de editar todos los clientes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 26-08-2019
     * 
     * @return array  $objResponse
     */
    public function editCliente($arrayData)
    {
        $intIdCliente       = isset($arrayData['idCliente'] )? $arrayData['idCliente']:'';
        $strIdentificacion  = isset($arrayData['identificacion'] )? $arrayData['identificacion']:'';
        $strDireccion       = isset($arrayData['direccion'] )? $arrayData['direccion']:'';
        $strEdad            = isset($arrayData['edad'] )? $arrayData['edad']:'';
        $strTipoComida      = isset($arrayData['tipoComida'] )? $arrayData['tipoComida']:'';
        $strEstado          = isset($arrayData['estado'] )? $arrayData['estado']:'';
        $strSector          = isset($arrayData['sector'] )? $arrayData['sector']:'';
        $strNombre          = isset($arrayData['nombre'] )? $arrayData['nombre']:'';
        $strApellido        = isset($arrayData['apellido'] )? $arrayData['apellido']:'';
        $strCorreo          = isset($arrayData['correo'] )? $arrayData['correo']:'';
        $strGenero          = isset($arrayData['genero'] )? $arrayData['genero']:'';
        $intIdTipoCLiente   = isset($arrayData['idTipoCLiente'] )? $arrayData['idTipoCLiente']:'';
        $intIdUsuario       = isset($arrayData['idUsuario'] )? $arrayData['idUsuario']:'';
        $strContrasenia     = isset($arrayData['contrasenia'] )? $arrayData['contrasenia']:'';
        $strAutenticacionRS = isset($arrayData['autenticacionRS'] )? $arrayData['autenticacionRS']:'';
        $strUsuarioModif    = isset($arrayData['usuarioModificacion'] )? $arrayData['usuarioModificacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        $boolStatus         = true;
        try
        {
            $em->getConnection()->beginTransaction();
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe cliente con el identificador enviado por parámetro.');
            }
            if(!empty($intIdTipoCLiente))
            {
                $objTipoCliente = $this->getDoctrine()
                                ->getRepository(AdmiTipoClientePuntaje::class)
                                ->findOneBy(array('ESTADO' => 'ACTIVO',
                                                  'id'     => $intIdTipoCLiente));
                if(!is_object($objTipoCliente) || empty($objTipoCliente))
                {
                    throw new \Exception('No existe tipo cliente con la descripción enviada por parámetro.');
                }
                $objCliente->setTIPOCLIENTEPUNTAJEID($objTipoCliente);
            }
            if(!empty($intIdUsuario))
            {
                $objUsuario = $this->getDoctrine()
                            ->getRepository(InfoUsuario::class)
                            ->findOneBy(array('ESTADO' => 'ACTIVO',
                                              'id'     => $intIdUsuario));
                if(!is_object($objUsuario) || empty($objUsuario))
                {
                    throw new \Exception('No existe usuario con identificador enviado por parámetro.');
                }
                $objCliente->setUSUARIOID($objUsuario);
            }
            if(!empty($strContrasenia))
            {
                $objCliente->setCONTRASENIA(md5($strContrasenia));
            }
            if(!empty($strAutenticacionRS))
            {
                $objCliente->setAUTENTICACIONRS($strAutenticacionRS);
            }
            if(!empty($strIdentificacion))
            {
                $objCliente->setIDENTIFICACION($strIdentificacion);
            }
            if(!empty($strDireccion))
            {
                $objCliente->setDIRECCION($strDireccion);
            }
            if(!empty($strEdad))
            {
                $objCliente->setEDAD($strEdad);
            }
            if(!empty($strTipoComida))
            {
                $objCliente->setTIPOCOMIDA($strTipoComida);
            }
            if(!empty($strGenero))
            {
                $objCliente->setGENERO($strGenero);
            }
            if(!empty($strEstado))
            {
                $objCliente->setESTADO(strtoupper($strEstado));
            }
            if(!empty($strSector))
            {
                $objCliente->setSECTOR($strSector);
            }
            if(!empty($strNombre))
            {
                $objCliente->setNOMBRE($strNombre);
            }
            if(!empty($strApellido))
            {
                $objCliente->setAPELLIDO($strApellido);
            }
            if(!empty($strCorreo))
            {
                $objCliente->setCORREO($strCorreo);
            }
            $objCliente->setUSRMODIFICACION($strUsuarioModif);
            $objCliente->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objCliente);
            $em->flush();
            $strMensajeError = 'Cliente editado con exito.!';
        }
        catch(\Exception $ex)
        {
            $boolStatus = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al editar el cliente, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }
        $objResponse->setContent(json_encode(array( 'status'    => $strStatus,
                                                    'resultado' => $strMensajeError,
                                                    'succes'    => $boolStatus)));
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
     * @author Kevin Baque
     * @version 1.1 17-08-2019 se cambia el llamado de cant. puntos del movil por el web.
     * 
     * @return array  $objResponse
     */
    public function getCliente($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente      = isset($arrayData['idCliente'])? $arrayData['idCliente']:'';
        $strIdentificacion = isset($arrayData['identificacion'])? $arrayData['identificacion']:'';
        $strNombres        = isset($arrayData['nombres'])? $arrayData['nombres']:'';
        $strApellidos      = isset($arrayData['apellidos'])? $arrayData['apellidos']:'';
        $strEstado         = isset($arrayData['estado'])? $arrayData['estado']:'';
        $arrayCliente      = array();
        $strMensajeError   = '';
        $strStatus         = 400;
        $objResponse       = new Response;
        $boolStatus        = true;
        try
        {
            $arrayParametros = array('intIdCliente'     => $intIdCliente,
                                    'strIdentificacion' => $strIdentificacion,
                                    'strNombres'        => $strNombres,
                                    'strApellidos'      => $strApellidos,
                                    'strEstado'         => $strEstado);
            $arrayCliente   = $this->getDoctrine()
                                   ->getRepository(InfoCliente::class)
                                   ->getClienteCriterioMovil($arrayParametros);
            if(isset($arrayCliente['error']) && !empty($arrayCliente['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCliente['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            $boolStatus      = false;
        }
        $arrayCliente['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCliente,
                                            'succes'    => $boolStatus
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getSucursalPorUbicacion'
     * Método encargado de retornar todos las sucursales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 28-08-2019
     *
     * @author Nestor Naula
     * @version 1.1 04-10-2019 -  Se agrega la imagen a las coordenadas
     * @since 1.0
     * 
     * @author Kevin Baque
     * @version 1.2 04-12-2019 -  Se agrega la imagen si el cliente en sesión es Influencer.
     * 
     * @author Kevin Baque
     * @version 1.3 09-06-2021 - Se agrega logica para indicar si el cliente puede realizar el flujo de acuerdo al horario de atención.
     *
     * @return array  $objResponse
     *
     */
    public function getSucursalPorUbicacion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intidSucursal     = $arrayData['intIdSucursal'] ? $arrayData['intIdSucursal']:'';
        $strLatitud        = $arrayData['latitud'] ? $arrayData['latitud']:'';
        $strLongitud       = $arrayData['longitud'] ? $arrayData['longitud']:'';
        $strEstado         = $arrayData['estado'] ? $arrayData['estado']:'';
        $conImagen         = $arrayData['imagen'] ? $arrayData['imagen']:'NO';
        $intIdCliente      = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strCodigoSucursal = $arrayData['codigoSucursal'] ? $arrayData['codigoSucursal']:'';
        $strDescripcion    = $arrayData['descripcion'] ? $arrayData['descripcion']:'';
        $arraySucursal     = array();
        $strMensajeError   = '';
        $strStatus         = 400;
        $strMetros         = 0;
        $intIterador       = 0;
        $objResponse       = new Response;
        $boolError         = false;
        $boolSucces        = true;
        $arrayRespuesta    = array();
        $strImagenInfluencer = null;
        // Número entero que representa el día de la semana, de 0 (dom) a 6 (sab)
        $strDiaActual        = date("w");
        $intHoraActual       = date("G");
        $intMinActual        = date("i");
        error_log("Dia Actual: ".$strDiaActual." Hora Actual: ".$intHoraActual.':'.$intMinActual);
        try
        {
            $arrayCltEncuesta = $this->getDoctrine()
                                     ->getRepository(InfoClienteEncuesta::class)
                                     ->getVigenciaEncuesta(array('intIdCliente'=>$intIdCliente,
                                                                 'intIdSucursal'=>$intidSucursal));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCltEncuesta['error']);
            }
            if(isset($arrayCltEncuesta['resultados']) && intval($arrayCltEncuesta['resultados'][0]['CANTIDAD']) >0 )
            {
                $boolError = true;
                throw new \Exception("Estimado, ud. ya cuenta con una encuesta llena, solo es permitido una encuesta por día en el mismo restaurante.");
            }
            $objController   = new DefaultController();
            $objCltInfluencer = $this->getDoctrine()
                                    ->getRepository(InfoClienteInfluencer::class)
                                    ->findOneBy(array('ESTADO'      => 'ACTIVO',
                                                      'CLIENTE_ID'  => $intIdCliente));
            if(!empty($objCltInfluencer) && is_object($objCltInfluencer) && !empty($objCltInfluencer->getIMAGEN()))
            {
                $strImagenInfluencer = $objController->getImgBase64($objCltInfluencer->getIMAGEN());
            }
            $objParametro    = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findOneBy(array('ESTADO'      => 'ACTIVO',
                                                      'DESCRIPCION' => $strDescripcion));
            $arrayParametros = array('latitud' => $strLatitud,
                                    'longitud' => $strLongitud,
                                    'estado'   => $strEstado,
                                    'intIdCliente'=>$intIdCliente,
                                    'strDescripcion' =>$strDescripcion,
                                    'strCodigoSucursal' =>$strCodigoSucursal,
                                    'metros'   => $objParametro->getVALOR2());
            $arraySucursal   = $this->getDoctrine()
                                    ->getRepository(InfoSucursal::class)
                                    ->getSucursalPorUbicacion($arrayParametros);
            foreach ($arraySucursal["resultados"] as &$item)
            {
                $strAtencion = "";
                if($strDiaActual==0)//Domingo
                {
                    if(!empty($item["HORA_DOMINGO_INI"]) && isset($item["HORA_DOMINGO_INI"])
                       && !empty($item["HORA_DOMINGO_FIN"]) && isset($item["HORA_DOMINGO_FIN"]))
                    {
                        $arrayHoraIni = explode(":",$item["HORA_DOMINGO_INI"]);
                        $intHoraIni   = $arrayHoraIni[0];
                        $intMinIni    = $arrayHoraIni[1];
                        $arrayHoraFin = explode(":",$item["HORA_DOMINGO_FIN"]);
                        $intHoraFin   = $arrayHoraFin[0];
                        $intMinFin    = $arrayHoraFin[1];
                    }
                }
                elseif(!empty($strDiaActual) && $strDiaActual==6)//Sabado
                {
                    if(!empty($item["HORA_SABADO_INI"]) && isset($item["HORA_SABADO_INI"])
                       && !empty($item["HORA_SABADO_FIN"]) && isset($item["HORA_SABADO_FIN"]))
                    {
                        $arrayHoraIni = explode(":",$item["HORA_SABADO_INI"]);
                        $intHoraIni   = $arrayHoraIni[0];
                        $intMinIni    = $arrayHoraIni[1];
                        $arrayHoraFin = explode(":",$item["HORA_SABADO_FIN"]);
                        $intHoraFin   = $arrayHoraFin[0];
                        $intMinFin    = $arrayHoraFin[1];
                    }
                }
                elseif(!empty($strDiaActual) && $strDiaActual==5)//Viernes
                {
                    if(!empty($item["HORA_VIERNES_INI"]) && isset($item["HORA_VIERNES_INI"])
                       && !empty($item["HORA_VIERNES_FIN"]) && isset($item["HORA_VIERNES_FIN"]))
                    {
                        $arrayHoraIni = explode(":",$item["HORA_VIERNES_INI"]);
                        $intHoraIni   = $arrayHoraIni[0];
                        $intMinIni    = $arrayHoraIni[1];
                        $arrayHoraFin = explode(":",$item["HORA_VIERNES_FIN"]);
                        $intHoraFin   = $arrayHoraFin[0];
                        $intMinFin    = $arrayHoraFin[1];
                    }
                }
                elseif(!empty($strDiaActual) && $strDiaActual==4)//jueves
                {
                    if(!empty($item["HORA_JUEVES_INI"]) && isset($item["HORA_JUEVES_INI"])
                       && !empty($item["HORA_JUEVES_FIN"]) && isset($item["HORA_JUEVES_FIN"]))
                    {
                        $arrayHoraIni = explode(":",$item["HORA_JUEVES_INI"]);
                        $intHoraIni   = $arrayHoraIni[0];
                        $intMinIni    = $arrayHoraIni[1];
                        $arrayHoraFin = explode(":",$item["HORA_JUEVES_FIN"]);
                        $intHoraFin   = $arrayHoraFin[0];
                        $intMinFin    = $arrayHoraFin[1];
                    }
                }
                elseif(!empty($strDiaActual) && $strDiaActual==3)//Miercoles
                {
                    if(!empty($item["HORA_MIERCOLES_INI"]) && isset($item["HORA_MIERCOLES_INI"])
                       && !empty($item["HORA_MIERCOLES_FIN"]) && isset($item["HORA_MIERCOLES_FIN"]))
                    {
                        $arrayHoraIni = explode(":",$item["HORA_MIERCOLES_INI"]);
                        $intHoraIni   = $arrayHoraIni[0];
                        $intMinIni    = $arrayHoraIni[1];
                        $arrayHoraFin = explode(":",$item["HORA_MIERCOLES_FIN"]);
                        $intHoraFin   = $arrayHoraFin[0];
                        $intMinFin    = $arrayHoraFin[1];
                    }
                }
                elseif(!empty($strDiaActual) && $strDiaActual==2)//Martes
                {
                    if(!empty($item["HORA_MARTES_INI"]) && isset($item["HORA_MARTES_INI"])
                       && !empty($item["HORA_MARTES_FIN"]) && isset($item["HORA_MARTES_FIN"]))
                    {
                        $arrayHoraIni = explode(":",$item["HORA_MARTES_INI"]);
                        $intHoraIni   = $arrayHoraIni[0];
                        $intMinIni    = $arrayHoraIni[1];
                        $arrayHoraFin = explode(":",$item["HORA_MARTES_FIN"]);
                        $intHoraFin   = $arrayHoraFin[0];
                        $intMinFin    = $arrayHoraFin[1];
                    }
                }
                elseif(!empty($strDiaActual) && $strDiaActual==1)//Lunes
                {
                    if(!empty($item["HORA_LUNES_INI"]) && isset($item["HORA_LUNES_INI"])
                       && !empty($item["HORA_LUNES_FIN"]) && isset($item["HORA_LUNES_FIN"]))
                    {
                        $arrayHoraIni = explode(":",$item["HORA_LUNES_INI"]);
                        $intHoraIni   = $arrayHoraIni[0];
                        $intMinIni    = $arrayHoraIni[1];
                        $arrayHoraFin = explode(":",$item["HORA_LUNES_FIN"]);
                        $intHoraFin   = $arrayHoraFin[0];
                        $intMinFin    = $arrayHoraFin[1];
                    }
                }
                else
                {
                    $strAtencion = "N";
                }
                if(!empty($intHoraActual) && !empty($intHoraIni) && !empty($intHoraFin))
                {
                    if($intHoraActual >= $intHoraIni && $intHoraActual <= $intHoraFin)
                    {
                        $strAtencion = "S";
                        if($intHoraActual == $intHoraFin)
                        {
                            if($intMinActual >= $intMinIni && $intMinActual <= $intMinFin)
                            {
                                $strAtencion = "S";
                            }
                            else
                            {
                                $strAtencion = "N";
                            }
                        }
                    }
                    else
                    {
                        $strAtencion = "N";
                    }
                }
                else
                {
                    $strAtencion = "N";
                }
                $strAtencion        = "S";
                $arraySucursalRes   = $this->getDoctrine()
                                           ->getRepository(InfoSucursal::class)
                                           ->findOneById($item["ID_SUCURSAL"]);

                $arrayParametrosRes = array('intIdRestaurante'      => $arraySucursalRes->getRESTAURANTEID());
                $arrayRestaurante   = $this->getDoctrine()
                                           ->getRepository(InfoRestaurante::class)
                                           ->getRestauranteCriterioMovil($arrayParametrosRes);
                
                if($conImagen == 'SI')
                {
                    if(!empty($arrayRestaurante["resultados"]["0"]["IMAGEN"]))
                    {
                        $arraySucursal["resultados"][$intIterador]["IMAGEN"] = $objController->getImgBase64($arrayRestaurante["resultados"]["0"]["IMAGEN"]);
                    }
                    else
                    {
                        $arraySucursal["resultados"][$intIterador]["IMAGEN"] =  null;
                    }
                } 
                $arraySucursal["resultados"][$intIterador]["ES_AFILIADO"] = (!empty($item["ES_AFILIADO"]) && $item["ES_AFILIADO"] == "SI") ? 'S':'N';
                $arraySucursal["resultados"][$intIterador]["ATENCION"] = $strAtencion;
                $intIterador = $intIterador +1;
            }
         
            if(isset($arraySucursal['error']) && !empty($arraySucursal['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arraySucursal['error']);
            }
        }
        catch(\Exception $ex)
        {
            if($boolError)
            {
                $strMensajeError = $ex->getMessage();
            }
            else
            {
                $strMensajeError ="Falló al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            }
            $boolSucces = false;
        }
        $arraySucursal['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arraySucursal,
                                            'fotoInfluencer'=> $strImagenInfluencer,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getRestaurante'
     * Método encargado de retornar todos los restaurantes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 28-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 17-11-2019 - Se agrega insert a la tabla InfovistaPublicidad.
     *
     * @author Kevin Baque
     * @version 1.2 17-11-2019 - Se suprime las imagenes de publicidad.
     *
     * @author Kevin Baque
     * @version 1.3 16-06-2021 - Se agrega filtro de ciudad y si el restaurante es afiliado.
     *
     * @author Kevin Baque
     * @version 1.4 17-08-2021 - Se agrega valor de ipn.
     *
     * @return array  $objResponse
     */
    public function getRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante       = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $intIdCliente           = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strTipoComida          = $arrayData['tipoComida'] ? $arrayData['tipoComida']:'';
        $strTipoIdentificacion  = $arrayData['tipoIdentificacion'] ? $arrayData['tipoIdentificacion']:'';
        $strIdentificacion      = $arrayData['identificacion'] ? $arrayData['identificacion']:'';
        $strRazonSocial         = $arrayData['razonSocial'] ? $arrayData['razonSocial']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $conImagen              = $arrayData['imagen'] ? $arrayData['imagen']:'NO';
        $conIcono               = $arrayData['icono']  ? $arrayData['icono']:'NO';
        $intCiudad              = $arrayData['intCiudad'] ? $arrayData['intCiudad']:'';
        $strEsAfiliado          = $arrayData['strEsAfiliado'] ? $arrayData['strEsAfiliado']:'';
        $arrayRestaurante       = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $strMetros              = 0;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $objController    = new DefaultController();
            $objController->setContainer($this->container);
            $arrayParametros = array('strTipoComida'        => $strTipoComida,
                                    'intIdRestaurante'      => $intIdRestaurante,
                                    'intIdCliente'          => $intIdCliente,
                                    'strTipoIdentificacion' => $strTipoIdentificacion,
                                    'strIdentificacion'     => $strIdentificacion,
                                    'strRazonSocial'        => $strRazonSocial,
                                    'strEstado'             => $strEstado,
                                    'intEsRestaurante'      => '1',
                                    'intCiudad'             => $intCiudad,
                                    'strEsAfiliado'         => $strEsAfiliado);
            $arrayRestaurante   = (array) $this->getDoctrine()
                                               ->getRepository(InfoRestaurante::class)
                                               ->getRestauranteCriterioMovil($arrayParametros);
            if(isset($arrayRestaurante['error']) && !empty($arrayRestaurante['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayRestaurante['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayResultado = array();
        foreach($arrayRestaurante['resultados'] as &$arrayItemRestaurante)
        {
            $arrayResultadoProPreg = array();
            $objPregunta           = $this->getDoctrine()
                                          ->getRepository(InfoPregunta::class)
                                          ->findBy(array('ESTADO' => "ACTIVO"));
            if(!empty($objPregunta) && is_array($objPregunta))
            {
                foreach($objPregunta as $objItemPregunta)
                {
                    if($objItemPregunta->getOPCIONRESPUESTAID()->getDESCRIPCION() != "Comentario")
                    {
                        $arrayPromedioPregunta = $this->getDoctrine()
                                                      ->getRepository(InfoRespuesta::class)
                                                      ->getPromedioPregunta(array("intIdRestaurante" => $arrayItemRestaurante['ID_RESTAURANTE'],
                                                                                  "intValorPregunta" => $objItemPregunta->getOPCIONRESPUESTAID()->getVALOR(),
                                                                                  "intIdPregunta"    => $objItemPregunta->getId()));
                        if(!empty($arrayPromedioPregunta["resultados"]))
                        {
                            $arrayResultadoProPreg [] = $arrayPromedioPregunta["resultados"][0];
                        }
                    }
                }
            }
            //[INI] Calculo de IPN
            $arrayRespuestaIPN = $this->getDoctrine()
                                      ->getRepository(InfoRespuesta::class)
                                      ->getResultadosProIPN(array("intIdRestaurante"=>$arrayItemRestaurante['ID_RESTAURANTE']));
            if(!empty($arrayRespuestaIPN) && is_array($arrayRespuestaIPN))
            {
                $intValor1           = intval($arrayRespuestaIPN["resultados"][0]["CANT_1"]);
                $intValor2           = intval($arrayRespuestaIPN["resultados"][0]["CANT_2"]);
                $intValor3           = intval($arrayRespuestaIPN["resultados"][0]["CANT_3"]);
                $intValor4           = intval($arrayRespuestaIPN["resultados"][0]["CANT_4"]);
                $intValor5           = intval($arrayRespuestaIPN["resultados"][0]["CANT_5"]);
                $intValor6           = intval($arrayRespuestaIPN["resultados"][0]["CANT_6"]);
                $intValor7           = intval($arrayRespuestaIPN["resultados"][0]["CANT_7"]);
                $intValor8           = intval($arrayRespuestaIPN["resultados"][0]["CANT_8"]);
                $intValor9           = intval($arrayRespuestaIPN["resultados"][0]["CANT_9"]);
                $intValor10          = intval($arrayRespuestaIPN["resultados"][0]["CANT_10"]);
                $intDetractores      = $intValor1 + $intValor2 + $intValor3 + $intValor4 + $intValor5 + $intValor6;
                $intPasivos          = $intValor7 + $intValor8;
                $intPromotores       = $intValor9 + $intValor10;
                $intTotal            = $intDetractores + $intPasivos + $intPromotores;
                $intTotalPromotores  = 0;
                $intTotalDetractores = 0;
                $intIpn              = 0;
                if($intDetractores >0)
                {
                    $intTotalDetractores = ($intDetractores / $intTotal) * 100;
                }
                if($intPromotores>0)
                {
                    $intTotalPromotores  = ($intPromotores / $intTotal) * 100;
                }
                $intIpn              = $intTotalPromotores - $intTotalDetractores;
            }
            //[FIN] Calculo de IPN
            //[INI] Calculo de cant. de encuesta
            $intCantEncuesta   = 0;
            $arrayCantEncuesta = $this->getDoctrine()
                                      ->getRepository(InfoClienteEncuesta::class)
                                      ->getCantEncuesta(array('intIdCliente'     => $intIdCliente,
                                                              'intIdRestaurante' => $intIdRestaurante));
            $intCantEncuesta = (!empty($arrayCantEncuesta['resultados'])) ? intval($arrayCantEncuesta['resultados'][0]['CANTIDAD']):0;
            //[FIN] Calculo de cant. de encuesta
            //[INI] Tipos de comida
            $strDescripcionComida = "";
            $arrayTipoComida      = $this->getDoctrine()
                                         ->getRepository(InfoTipoComidaRestaurante::class)
                                         ->getRelacionComidaResCriterio(array("intIdRestaurante" => $arrayItemRestaurante['ID_RESTAURANTE']));
            if(isset($arrayTipoComida["resultados"]) && !empty($arrayTipoComida["resultados"]))
            {
                foreach($arrayTipoComida["resultados"] as $arrayItem)
                {
                    if($strDescripcionComida == "")
                    {
                        $strDescripcionComida = $arrayItem["DESCRIPCION_TIPO_COMIDA"];
                    }
                    else
                    {
                        $strDescripcionComida = $strDescripcionComida.",  ".$arrayItem["DESCRIPCION_TIPO_COMIDA"];
                    }
                }
            }
            //[FIN] Tipos de comida
            $arraySucursal["resultados"][$intIterador]["ES_AFILIADO"] = (!empty($item["ES_AFILIADO"]) && $item["ES_AFILIADO"] == "SI") ? 'S':'N';
            $arrayResultado ['resultados'] []= array('ID_RESTAURANTE'          =>   $arrayItemRestaurante['ID_RESTAURANTE'],
                                                     'TIPO_IDENTIFICACION'     =>   $arrayItemRestaurante['TIPO_IDENTIFICACION'],
                                                     'IDENTIFICACION'          =>   $arrayItemRestaurante['IDENTIFICACION'],
                                                     'RAZON_SOCIAL'            =>   $arrayItemRestaurante['RAZON_SOCIAL'],
                                                     'NOMBRE_COMERCIAL'        =>   $arrayItemRestaurante['NOMBRE_COMERCIAL'],
                                                     'REPRESENTANTE_LEGAL'     =>   $arrayItemRestaurante['REPRESENTANTE_LEGAL'],
                                                     'DESCRIPCION_TIPO_COMIDA' =>   $strDescripcionComida,
                                                     'DIRECCION_TRIBUTARIO'    =>   $arrayItemRestaurante['DIRECCION_TRIBUTARIO'],
                                                     'URL_CATALOGO'            =>   $arrayItemRestaurante['URL_CATALOGO'],
                                                     'URL_RED_SOCIAL'          =>   $arrayItemRestaurante['URL_RED_SOCIAL'],
                                                     'NUMERO_CONTACTO'         =>   $arrayItemRestaurante['NUMERO_CONTACTO'],
                                                     'ESTADO'                  =>   $arrayItemRestaurante['ESTADO'],
                                                     //'IMAGEN'                  =>   $arrayItemRestaurante['IMAGEN'],
                                                     'IMAGEN'                  =>   (!empty($arrayItemRestaurante['IMAGEN']) && $conImagen == 'SI')? $objController->getImgBase64($arrayItemRestaurante['IMAGEN']) :null,
                                                     'ICONO'                   =>   (!empty($arrayItemRestaurante['ICONO']) && $conIcono == 'SI')? $objController->getImgBase64($arrayItemRestaurante['ICONO']) :null,
                                                     //'ICONO'                   =>   $arrayItemRestaurante['ICONO'],
                                                     'CANT_LIKE'               =>   $arrayItemRestaurante['CANT_LIKE'],
                                                     'PRO_ENCUESTAS'           =>   $arrayItemRestaurante['PRO_ENCUESTAS'],
                                                     'ID_LIKE'                 =>   $arrayItemRestaurante['ID_LIKE'] ? $arrayItemRestaurante['ID_LIKE']:null,
                                                     'PRO_ENCUESTAS_CLT'       =>   $arrayItemRestaurante['PRO_ENCUESTAS_CLT'] ? $arrayItemRestaurante['PRO_ENCUESTAS_CLT']:null,
                                                     'PRO_ENCUESTAS_PRG'       =>   $arrayResultadoProPreg ? $arrayResultadoProPreg:null,
                                                     'ES_PUBLICIDAD'           =>  'N',
                                                     'ES_AFILIADO'             =>  'S',//(!empty($arrayItemRestaurante["ES_AFILIADO"]) && $arrayItemRestaurante["ES_AFILIADO"] == "SI") ? 'S':'N',
                                                     'IPN'                     =>  round($intIpn),
                                                     'CANT_ENCUESTA'           =>  $intCantEncuesta);
        }
        $arrayResultado['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayResultado,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getEncuesta'
     * Método encargado de listar las encuestas según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 02-09-2019
     *
     * @return array  $objResponse
     */
    public function getEncuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdEncuesta          = $arrayData['idEncuesta'] ? $arrayData['idEncuesta']:'';
        $strDescripcion         = $arrayData['descripcion'] ? $arrayData['descripcion']:'';
        $strTitulo              = $arrayData['titulo'] ? $arrayData['titulo']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $boolSucces             = true;
        $arrayPregunta          = array();
        $arrayEncuesta          = array();
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $arrayParametros = array('ESTADO'         => $strEstado);
            $objEncuesta     = $this->getDoctrine()
                                    ->getRepository(InfoEncuesta::class)
                                    ->findBy($arrayParametros);            
            if(empty($objEncuesta) && !is_array($objEncuesta))
            {
                throw new \Exception('La encuesta a buscar no existe.');
            }
            foreach($objEncuesta as $arrayItem)
            {
                $arrayParametrosPreg = array('ESTADO'     => 'ACTIVO',
                                             'ENCUESTA_ID' => $arrayItem->getId());
                $objPregunta         = $this->getDoctrine()
                                            ->getRepository(InfoPregunta::class)
                                            ->findBy($arrayParametrosPreg);
                if(!empty($objPregunta) && is_array($objPregunta))
                {
                    foreach($objPregunta as $arrayItemPregunta)
                    {
                        $arrayPregunta[] = array('idPregunta'      => $arrayItemPregunta->getId(),
                                                 'descripcion'     => $arrayItemPregunta->getDESCRIPCION(),
                                                 'obligatoria'     => $arrayItemPregunta->getOBLIGATORIA(),
                                                 'idTipoRespuesta' => $arrayItemPregunta->getOPCIONRESPUESTAID()->getId(),
                                                 'tipoRespuesta'   => $arrayItemPregunta->getOPCIONRESPUESTAID()->getTIPORESPUESTA(),
                                                 'cantOpcion'      => $arrayItemPregunta->getOPCIONRESPUESTAID()->getValor(),
                                                 'estado'          => $arrayItemPregunta->getESTADO());
                    }
                }
                $arrayEncuesta = array( 'descripcionEncuesta' => $arrayItem->getDESCRIPCION(),
                                        'tituloEncuesta'      => $arrayItem->getTITULO(),
                                        'idEncuesta'          => $arrayItem->getId(),
                                        'preguntas'           => $arrayPregunta);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces             = false;
            $strStatus              = 404;
            $strMensaje             ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            $arrayEncuesta['error'] = $strMensaje;
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayEncuesta,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getPregunta'
     * Método encargado de listar las preguntas según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 29-08-2019
     * 
     * @return array  $objResponse
     */
    public function getPregunta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strIdEncuesta          = $arrayData['idEncuesta'] ? $arrayData['idEncuesta']:'';
        $strIdPregunta          = $arrayData['idPregunta'] ? $arrayData['idPregunta']:'';
        $strDescripcion         = $arrayData['descripcion'] ? $arrayData['descripcion']:'';
        $strObligatoria         = $arrayData['obligatoria'] ? $arrayData['obligatoria']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        $boolStatus             = true;
        try
        {
            $arrayParametros = array('strIdPregunta'    => $strIdPregunta,
                                    'strIdEncuesta'     => $strIdEncuesta,
                                    'strDescripcion'    => $strDescripcion,
                                    'strObligatoria'    => $strObligatoria,
                                    'strEstado'         => $strEstado
                                    );
            $arrayEncuesta = $this->getDoctrine()
                                  ->getRepository(InfoPregunta::class)
                                  ->getPreguntaCriterioMovil($arrayParametros);
            if(isset($arrayEncuesta['error']) && !empty($arrayEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayEncuesta['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolStatus = false;
            $strMensaje ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayEncuesta['error'] = $strMensaje;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayEncuesta,
                                            'succes'    => $boolStatus
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createRespuesta'
     *
     * Método encargado de crear todas las respuesta según los parámetros recibidos.
     * Adicional crear las relaciones entre clt. y encuestas.
     * 
     * @author Kevin Baque
     * @version 1.0 04-09-2019
     *
     * @author Kevin Baque
     * @version 1.1 03-12-2019 - Se agrega envío de correo notificando que ganó puntos
     *
     * @author Kevin Baque
     * @version 1.2 25-01-2020 - Se comenta correo por nuevas politicas.
     *
     * @author Kevin Baque
     * @version 1.3 10-07-2021 - Se agrega lógica para envío de correo, 
     *                           en caso de que el usuario administrador Restaurante
     *                           tenga configurado que reciba las encuesta.
     *
     * @author Kevin Baque
     * @version 1.4 25-11-2022 - Nuevo Fluto con el tipo de cliente Promotor.
     *
     * @return array  $objResponse
     */
    public function createRespuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        date_default_timezone_set('America/Guayaquil');
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdSucursal      = $arrayData['idSucursal'] ? $arrayData['idSucursal']:'';
        $intIdEncuesta      = $arrayData['idEncuesta'] ? $arrayData['idEncuesta']:'';
        $intIdPregunta      = $arrayData['idPregunta'] ? $arrayData['idPregunta']:'';
        $intIdContenido     = $arrayData['idContenido'] ? $arrayData['idContenido']:'';
        $arrayPregunta      = $arrayData['arrayPregunta'] ? $arrayData['arrayPregunta']:'';
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strCorreoClt       = $arrayData['correoClt'] ? $arrayData['correoClt']:'';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $arrayRespuesta     = array();
        $strEstadoEncuesta  = 'PENDIENTE';//TODO kbaque: estado original pendiente
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        $boolSucces         = true;
        $strCuerpoCorreo    = "";
        $strResPositiva     = "★";
        $strNegativa        = "☆";
        $strTipoCliente     = "";
        $strCupon           =  "";
        $strDescripcionPromocion = "";
        $strFechaVigencia   = "";
        try
        {
            $em->getConnection()->beginTransaction();
            $objCliente     = $this->getDoctrine()
                                   ->getRepository(InfoCliente::class)
                                   ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe el cliente con la descripción enviada por parámetro.');
            }
            $strTipoCliente = $objCliente->getTIPOCLIENTEPUNTAJEID()->getDESCRIPCION();
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->find($intIdSucursal);
            if(!is_object($objSucursal) || empty($objSucursal))
            {
                throw new \Exception('No existe la sucursal con la descripción enviada por parámetro.');
            }
            $objRestaurante = $this->getDoctrine()
                                    ->getRepository(InfoRestaurante::class)
                                    ->find($objSucursal->getRESTAURANTEID());
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe restaurante con la descripción enviada por parámetro.');
            }
            $objEncuesta   = $this->getDoctrine()
                                  ->getRepository(InfoEncuesta::class)
                                  ->find($intIdEncuesta);
            if(!is_object($objEncuesta) || empty($objEncuesta))
            {
                throw new \Exception('No existe la Encuesta con la descripción enviada por parámetro.');
            }
            $objParametro    = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findOneBy(array('DESCRIPCION' => 'PUNTOS_ENCUESTA',
                                                      'ESTADO'      => 'ACTIVO'));
            if(!is_object($objParametro) || empty($objParametro))
            {
                throw new \Exception('No existe puntos de encuesta con la descripción enviada por parámetro.');
            }
            $intValor = $objParametro->getVALOR1();
            $arrayRestaurantes = $this->getDoctrine()
                                      ->getRepository(InfoRestaurante::class)
                                      ->getRestauranteCriterio(array('intIdRestaurante' => $objRestaurante->getId()));
            //Validación para los restaurantes afiliados, en caso de no ser afiliado no gana puntos, solo participa para un tenedor de oro.
            if(!empty($arrayRestaurantes) && !empty($arrayRestaurantes['resultados']))
            {
                $arrayItemRestaurante = $arrayRestaurantes['resultados'][0];
                if(!empty($arrayItemRestaurante["ES_AFILIADO"]) && isset($arrayItemRestaurante["ES_AFILIADO"]) 
                    && $arrayItemRestaurante["ES_AFILIADO"] == "NO")
                {
                    $intValor = 0;
                }
            }
            //Validaciones cuando el tipo es CLIENTE
            if($strTipoCliente == "CLIENTE")
            {
                $objContenido    = $this->getDoctrine()
                                        ->getRepository(InfoContenidoSubido::class)
                                        ->find($intIdContenido);
                if(!is_object($objContenido) || empty($objContenido))
                {
                    throw new \Exception('No existe el contenido con la descripción enviada por parámetro.');
                }
                $arrayCltEncuesta  = $this->getDoctrine()
                                          ->getRepository(InfoClienteEncuesta::class)
                                          ->getClienteEncuestaRepetida(array('intClienteId'   => $intIdCliente,
                                                                             'intSucursalId'  => $intIdSucursal,
                                                                             'intEncuestaId'  => $intIdEncuesta,
                                                                             'intContenidoId' => $intIdContenido,
                                                                             'strFecha'       => date('Y-m-d'),
                                                                             'strEstado'      => $strEstadoEncuesta));
                if(is_array($arrayCltEncuesta) && !empty($arrayCltEncuesta['resultados']))
                {  
                    throw new \Exception('Ya existe la encuesta.');
                }
            }
            //Validaciones para el nuevo flujo en caso del tipo sea diferente de "CLIENTE",
            //podrá realizar n respuesta por encuesta y automáticamente se registrará un cliente.
            elseif($strTipoCliente == "PROMOTOR")
            {
                $objTipoCliente = $this->getDoctrine()
                                       ->getRepository(AdmiTipoClientePuntaje::class)
                                       ->findOneBy(array('ESTADO' => 'ACTIVO',
                                                         'id'     => 1));
                if(!is_object($objTipoCliente) || empty($objTipoCliente))
                {
                    throw new \Exception('No existe tipo cliente con la descripción enviada por parámetro.');
                }
                $objUsuario = $this->getDoctrine()
                                   ->getRepository(InfoUsuario::class)
                                   ->findOneBy(array('ESTADO' => 'ACTIVO',
                                                     'id'     => 1));
                $strEstadoEncuesta = "ACTIVO";
                $intValor          = 0;
                //Parametros para crear un cliente
                $objTipoCliente    = $this->getDoctrine()
                                          ->getRepository(AdmiTipoClientePuntaje::class)
                                          ->findOneBy(array("ESTADO"      => "ACTIVO",
                                                            "DESCRIPCION" => "CLIENTE"));
                if(!is_object($objTipoCliente) || empty($objTipoCliente))
                {
                    throw new \Exception("No existe tipo cliente con la descripción enviada por parámetro.");
                }
                $strEdadClt   = (isset($arrayData["edad"]) && !empty($arrayData["edad"])) ? $arrayData["edad"] : "SIN EDAD";
                $strGeneroClt = (isset($arrayData["genero"]) && !empty($arrayData["genero"])) ? $arrayData["genero"] : "SIN GENERO";
                //Obtenemos el tipo de promoción Encuesta
                $objTipoPromocion = $this->getDoctrine()
                                            ->getRepository(AdmiTipoPromocion::class)
                                            ->findOneBy(array("DESCRIPCION"     =>"ENCUESTA",
                                                              "ESTADO" =>'ACTIVO'));
                if(!is_object($objTipoPromocion) || empty($objTipoPromocion))
                {
                    throw new \Exception('No existe el tipo de promoción "Encuesta" enviado por parámetro.');
                }
                //Buscamos una promoción de tipo encuesta con el restaurante en sesión
                $objPromocion = $this->getDoctrine()
                                        ->getRepository(InfoPromocion::class)
                                        ->findOneBy(array("ESTADO"          => "ACTIVO",
                                                          "TIPOPROMOCIONID" => $objTipoPromocion->getId(),
                                                          "RESTAURANTE_ID"  => $objRestaurante->getId()));
                //En caso de que la persona encuestada, indique que si desea el cupón el restaurante 
                //podrá redimir el cupón del encuestado, siempre y cuando el restaurante
                //tenga una promoción de tipo "Encuesta"
                if(!empty($strCorreoClt) && is_object($objPromocion))
                {
                    $strDescripcionPromocion = $objPromocion->getDESCRIPCIONTIPOPROMOCION();
                    //Validamos si existe un cliente con ese correo
                    $objCliente   = $this->getDoctrine()
                                         ->getRepository(InfoCliente::class)
                                         ->findOneBy(array("CORREO" => $strCorreoClt));
                    //Si no existe se crea
                    if(empty($objCliente) || !is_object($objCliente))
                    {
                        $strNombre = explode('@',$strCorreoClt);
                        $objCliente = new InfoCliente();
                        $objCliente->setAUTENTICACIONRS("N");
                        $objCliente->setNOMBRE($strNombre[0]);
                        $objCliente->setAPELLIDO("");
                        $objCliente->setEDAD($strEdadClt);
                        $objCliente->setGENERO($strGeneroClt);
                        $objCliente->setESTADO("ACTIVO");
                        $objCliente->setTIPOCLIENTEPUNTAJEID($objTipoCliente);
                        if(is_object($objUsuario) && !empty($objUsuario))
                        {
                            $objCliente->setUSUARIOID($objUsuario);
                        }
                        $objCliente->setCORREO($strCorreoClt);
                        $objCliente->setUSRCREACION($strUsuarioCreacion);
                        $objCliente->setFECREACION(new \DateTime('now'));
                        $em->persist($objCliente);
                        $em->flush();
                    }
                    $arrayCltEncuesta  = $this->getDoctrine()
                                              ->getRepository(InfoClienteEncuesta::class)
                                              ->getClienteEncuestaRepetida(array('intClienteId'   => $objCliente->getId(),
                                                                                 'intSucursalId'  => $intIdSucursal,
                                                                                 'intEncuestaId'  => $intIdEncuesta,
                                                                                 'strFecha'       => date('Y-m-d'),
                                                                                 'strEstado'      => $strEstadoEncuesta));
                    if(is_array($arrayCltEncuesta) && !empty($arrayCltEncuesta['resultados']))
                    {
                        throw new \Exception('Ya existe una encuesta con el mismo correo electrónico.');
                    }
                    //Creamos el cupón
                    $objTipoCupon = $this->getDoctrine()
                                         ->getRepository(AdmiTipoCupon::class)
                                         ->findOneBy(array("DESCRIPCION" => "ENCUESTA",
                                                           "ESTADO"      => "ACTIVO"));
                    if(!is_object($objTipoCupon) || empty($objTipoCupon))
                    {
                        throw new \Exception('No existe el tipo de cupón enviado por parámetro.');
                    }
                    $strDescCupon = substr(uniqid(),0,6);
                    $entityCupon = new InfoCupon();
                    $entityCupon->setCUPON($strDescCupon);
                    $entityCupon->setESTADO("CANJEADO");
                    $entityCupon->setTIPOCUPONID($objTipoCupon);
                    $entityCupon->setDIAVIGENTE(intval($objPromocion->getCANTDIASVIGENCIA()));
                    $entityCupon->setUSRCREACION($strUsuarioCreacion);
                    $entityCupon->setFECREACION(new \DateTime('now'));
                    $em->persist($entityCupon);
                    $em->flush();
                    $strCupon = $entityCupon->getCUPON();
                    //Ingresamos todos los datos necesarios para poder redimir la promoción desde la web
                    $entityCuponHistorial = new InfoCuponHistorial();
                    $entityCuponHistorial->setESTADO("CANJEADO");
                    $entityCuponHistorial->setCUPONID($entityCupon);
                    $entityCuponHistorial->setCLIENTEID($objCliente);
                    $entityCuponHistorial->setRESTAURANTEID($objRestaurante);
                    $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                    $entityCuponHistorial->setFECREACION($strDatetimeActual);
                    $em->persist($entityCuponHistorial);
                    $em->flush();
                    $entityCuponPromocionClt = new InfoCuponPromocionClt();
                    $entityCuponPromocionClt->setPROMOCIONID($objPromocion);
                    $entityCuponPromocionClt->setCUPONID($entityCupon);
                    $entityCuponPromocionClt->setCLIENTEID($objCliente);
                    $entityCuponPromocionClt->setESTADO("CANJEADO");
                    $objFechaVigencia     = new \DateTime('now');
                    $objFechaVigencia->add(new \DateInterval("P".intval($entityCupon->getDIAVIGENTE())."D"));
                    $strFechaVigencia     = date_format($objFechaVigencia,"Y/m/d");
                    $entityCuponPromocionClt->setFEVIGENCIA($objFechaVigencia);
                    $entityCuponPromocionClt->setUSRCREACION($strUsuarioCreacion);
                    $entityCuponPromocionClt->setFECREACION($strDatetimeActual);
                    $em->persist($entityCuponPromocionClt);
                    $em->flush();
                    $entityPromocionHist = new InfoPromocionHistorial();
                    $entityPromocionHist->setCLIENTEID($objCliente);
                    $entityPromocionHist->setPROMOCIONID($objPromocion);
                    $entityPromocionHist->setESTADO("PENDIENTE");
                    $entityPromocionHist->setUSRCREACION($strUsuarioCreacion);
                    $entityPromocionHist->setFECREACION($strDatetimeActual);
                    $em->persist($entityPromocionHist);
                    $em->flush();
                }
                else
                {
                    $objCliente   = $this->getDoctrine()
                                         ->getRepository(InfoCliente::class)
                                         ->findOneBy(array("CORREO" => $strCorreoClt));
                    //Si no existe se crea
                    if(empty($objCliente) || !is_object($objCliente))
                    {
                        $objCliente = new InfoCliente();
                        $objCliente->setAUTENTICACIONRS("N");
                        $objCliente->setNOMBRE("Encuestado");
                        $objCliente->setAPELLIDO("Anonimo");
                        $objCliente->setCORREO("");
                        $objCliente->setEDAD($strEdadClt);
                        $objCliente->setGENERO($strGeneroClt);
                        $objCliente->setESTADO("ACTIVO");
                        $objCliente->setTIPOCLIENTEPUNTAJEID($objTipoCliente);
                        if(is_object($objUsuario) && !empty($objUsuario))
                        {
                            $objCliente->setUSUARIOID($objUsuario);
                        }
                        $objCliente->setUSRCREACION($strUsuarioCreacion);
                        $objCliente->setFECREACION(new \DateTime('now'));
                        $em->persist($objCliente);
                        $em->flush();
                    }
                }
            }
            $entityCltEncuesta = new InfoClienteEncuesta();
            $entityCltEncuesta->setCLIENTEID($objCliente);
            $entityCltEncuesta->setSUCURSALID($objSucursal);
            $entityCltEncuesta->setENCUESTAID($objEncuesta);
            $entityCltEncuesta->setESTADO(strtoupper($strEstadoEncuesta));
            if(is_object($objContenido))
            {
                $entityCltEncuesta->setCONTENIDOID($objContenido);
            }
            $entityCltEncuesta->setUSRCREACION($strUsuarioCreacion);
            $entityCltEncuesta->setFECREACION($strDatetimeActual);
            $entityCltEncuesta->setCANTIDADPUNTOS($intValor);
            $em->persist($entityCltEncuesta);
            $em->flush();
            $intIdCltEncuesta = $entityCltEncuesta->getId();
            if(empty($intIdCltEncuesta))
            {
                $em->getConnection()->rollback();
                throw new \Exception('No ingreso la relación entre Cliente y encuesta, con la descripción enviada por parámetro.');
            }
            else
            {
                if ($em->getConnection()->isTransactionActive())
                {
                    $em->getConnection()->commit();
                    $em->getConnection()->close();
                }
                $objCltEncuesta  = $this->getDoctrine()
                                        ->getRepository(InfoClienteEncuesta::class)
                                        ->find($intIdCltEncuesta);
                if(!is_object($objCltEncuesta) || empty($objCltEncuesta))
                {
                    throw new \Exception('No existe la relación cliente encuesta con la descripción enviada por parámetro.');
                }
                $boolEnviarCorreo  = false;
                foreach ($arrayPregunta as $intIdPregunta => $strRespuesta) 
                {
                    $arrayParametrosPreg = array('ESTADO' => 'ACTIVO',
                                                 'id'     => $intIdPregunta);
                    $objPregunta    = $this->getDoctrine()
                                           ->getRepository(InfoPregunta::class)
                                           ->findOneBy($arrayParametrosPreg);
                    if(!is_object($objPregunta) || empty($objPregunta))
                    {
                        throw new \Exception('No existe la pregunta con la descripción enviada por parámetro.');
                    }
                    $objOpcionRespuesta = $this->getDoctrine()
                                               ->getRepository(InfoOpcionRespuesta::class)
                                               ->findOneBy(array("id"     => $objPregunta->getOPCIONRESPUESTAID()->getId(),
                                                                 "ESTADO" => "ACTIVO"));
                    if(!empty($objOpcionRespuesta) && is_object($objOpcionRespuesta))
                    {
                        if($objOpcionRespuesta->getTIPORESPUESTA()=="CERRADA")
                        {
                            if(intval($strRespuesta)<=3)
                            {
                                $boolEnviarCorreo = true;
                            }
                            $strEstrellas      = "";
                            $intTotalEstrellas = intval($objOpcionRespuesta->getVALOR());
                            for($i=0; $i < intval($objOpcionRespuesta->getVALOR()); $i++)
                            {
                                if($i >= $strRespuesta)
                                {
                                    $strEstrellas .= $strNegativa;
                                }
                                else
                                {
                                    $strEstrellas .= $strResPositiva;
                                }
                            }
                            $strCuerpoCorreo .= '
                            <tr>
                                <td class="x_x_x_p1"
                                    style="direction:ltr; text-align:center; color:#000000; font-family:\'UberMoveText-Regular\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:20px; line-height:26px; padding-bottom:20px; padding-top:7px">
                                    <b>'.$objPregunta->getDESCRIPCION().'</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="x_x_x_p1"
                                    style="direction:ltr; text-align:center; color:#000000; font-family:\'UberMoveText-Regular\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:35px; line-height:26px">
                                    '.$strEstrellas.'
                                </td>
                            </tr>';
                        }
                        else
                        {
                            $strCuerpoCorreo .= '
                            <tr>
                                <td class="x_x_x_p1"
                                    style="direction:ltr; text-align:center; color:#000000; font-family:\'UberMoveText-Regular\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:20px; line-height:26px; padding-bottom:20px; padding-top:7px">
                                    <b>'.$objPregunta->getDESCRIPCION().'</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="x_x_x_p1"
                                    style="direction:ltr; text-align:center; color:#000000; font-family:\'UberMoveText-Regular\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:20px; line-height:26px">
                                    '.$strRespuesta.'
                                </td>
                            </tr>';
                        }
                    }
                    $entityRespuesta = new InfoRespuesta();
                    $entityRespuesta->setRESPUESTA($strRespuesta);
                    $entityRespuesta->setPREGUNTAID($objPregunta);
                    $entityRespuesta->setCLTENCUESTAID($objCltEncuesta);
                    $entityRespuesta->setCLIENTEID($objCliente);
                    $entityRespuesta->setESTADO("ACTIVO");
                    $entityRespuesta->setUSRCREACION($strUsuarioCreacion);
                    $entityRespuesta->setFECREACION($strDatetimeActual);
                    $em->persist($entityRespuesta);
                    $em->flush();
                }
                if(!empty($strCuerpoCorreo) && $boolEnviarCorreo)
                {
                    $arrayUsuarioRes = $this->getDoctrine()
                                            ->getRepository(InfoUsuarioRes::class)
                                            ->findBy(array("RESTAURANTEID" => $objRestaurante->getId(),
                                                           "ESTADO"        => "ACTIVO"));
                    if(!empty($arrayUsuarioRes) && is_array($arrayUsuarioRes))
                    {
                        $objPlantilla   = $this->getDoctrine()
                                               ->getRepository(InfoPlantilla::class)
                                               ->findOneBy(array('DESCRIPCION' => "ENCUESTA_RESTAURANTE",
                                                                 'ESTADO'      => "ACTIVO"));
                        if(!empty($objPlantilla) && is_object($objPlantilla))
                        {
                            $strMensajeCorreo = stream_get_contents ($objPlantilla->getPLANTILLA());
                            $strCuerpoCorreo .= '
                            <tr>
                                <td class="x_p1"
                                    style="direction:ltr; text-align:justify; color:#000000; font-family:\'UberMoveText-Regular\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:15px; line-height:26px; padding-bottom:20px; padding-top:7px">
                                    <br><b>Para más información estadística, por favor has click <a href=\'http://www.bitte.app/\' target="_blank">Aquí.</a> con su usuario y contraseña.</b><br>
                                </td>
                            </tr>';
                            $strMensajeCorreo   = str_replace('strCuerpoCorreo',$strCuerpoCorreo,$strMensajeCorreo);
                            $strAsunto          = 'Nueva Encuesta';
                            $strRemitente       = 'notificaciones@bitte.app';
                            foreach($arrayUsuarioRes as $arrayItemUsuarioRes)
                            {
                                if(!empty($arrayItemUsuarioRes->getUSUARIOID()->getCORREO()) && $arrayItemUsuarioRes->getUSUARIOID()->getESTADO() == "ACTIVO"
                                   && $arrayItemUsuarioRes->getUSUARIOID()->getNOTIFICACION() == "SI")
                                {
                                    $arrayParametros    = array('strAsunto'        => $strAsunto,
                                                                'strMensajeCorreo' => $strMensajeCorreo,
                                                                'strRemitente'     => $strRemitente,
                                                                'strDestinatario'  => $arrayItemUsuarioRes->getUSUARIOID()->getCORREO());
                                                                //'strDestinatario'  => "baquekevin@hotmail.com");
                                    $objController      = new DefaultController();
                                    $objController->setContainer($this->container);
                                    $objController->enviaCorreo($arrayParametros);

                                }
                            }
                        }
                    }
                }
                if(!empty($strCorreoClt) && $strTipoCliente == "PROMOTOR")
                {
                    $objPlantilla   = $this->getDoctrine()
                                           ->getRepository(InfoPlantilla::class)
                                           ->findOneBy(array('DESCRIPCION' => "ENCUESTA_CUPON",
                                                             'ESTADO'      => "ACTIVO"));
                    if(!empty($objPlantilla) && is_object($objPlantilla))
                    {
                        $strMensajeCorreo = stream_get_contents ($objPlantilla->getPLANTILLA());
                        $strCuerpoCorreo = '
                        <tr>
                            <td class="x_p1"
                                style="direction:ltr; text-align:justify; color:#000000; font-family:\'UberMoveText-Regular\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:15px; line-height:26px; padding-bottom:20px; padding-top:7px">
                                <br><b>Presenta este código:
                                </b><br>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="direction:ltr; text-align:left">
                                <h2
                                    style="margin:0; color:#1ea5de; font-family:\'UberMove-Medium\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:34px; font-weight:normal; line-height:40px; padding:0; padding-bottom:7px; padding-top:7px">
                                    '.$strCupon.'
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td class="x_p1"
                                style="direction:ltr; text-align:justify; color:#000000; font-family:\'UberMoveText-Regular\',\'HelveticaNeue\',Helvetica,Arial,sans-serif; font-size:15px; line-height:26px; padding-bottom:20px; padding-top:7px">
                                <br><b>En el restaurante: <strong>'.$objRestaurante->getNOMBRECOMERCIAL().'</strong> y aprovecha la promoción: <strong>'.$strDescripcionPromocion.'</strong>, hasta el '.$strFechaVigencia.'
                                </b><br>
                            </td>
                        </tr>';
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo',$strCuerpoCorreo,$strMensajeCorreo);
                        $strAsunto          = 'GANASTE UN CUPON';
                        $strRemitente       = 'notificaciones@bitte.app';
                        $arrayParametros    = array('strAsunto'        => $strAsunto,
                                                    'strMensajeCorreo' => $strMensajeCorreo,
                                                    'strRemitente'     => $strRemitente,
                                                    'strDestinatario'  => $strCorreoClt);
                                                    //'strDestinatario'  => "baquekevin@hotmail.com");
                        $objController      = new DefaultController();
                        $objController->setContainer($this->container);
                        $objController->enviaCorreo($arrayParametros);
                    }
                }
                $strMensajeError = 'Respuesta creada con exito.!';
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }

        $arrayRespuesta['mensaje']          = $strMensajeError;
        $arrayRespuesta['intIdCltEncuesta'] = $intIdCltEncuesta;
        $strMensajeCupon                    = "Gracias por tu respuesta";
        if(!empty($strCupon))
        {
            $strMensajeCupon = "Promoción: ".$strDescripcionPromocion."\n".
                               "Cupón: ".$strCupon."\n".
                               "Válido hasta: ".$strFechaVigencia;
        }
        $objResponse->setContent(json_encode(array('status'      => $strStatus,
                                                   'objSucursal' => $objSucursal,
                                                   'resultado'   => $arrayRespuesta,
                                                   'promocion'   => $strDescripcionPromocion,
                                                   'cupon'       => $strMensajeCupon,
                                                   'succes'      => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getLoginMovil'
     * Método encargado de verificar si ingresa a la plataforma movil según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 06-09-2019
     * 
     * @return array  $objResponse
     *
     * @author Kevin Baque
     * @version 1.1 08-03-2020 - Se añade mensaje de retorno cuando el usuario aún no activa su cuenta.
     *
     * @author Kevin Baque
     * @version 1.2 23-11-2022 - Se añade arreglo de sucursales relacionadas al promotor.
     *
     */
    public function getLoginMovil($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strCorreo          = $arrayData['correo'] ? $arrayData['correo']:'';
        $strPass            = $arrayData['contrasenia'] ? $arrayData['contrasenia']:'';
        $strAutenticacionRS = $arrayData['autenticacionRS'] ? $arrayData['autenticacionRS']:'';
        $arrayCliente       = array();
        $strMensaje         = '';
        $strStatus          = 400;
        $strSucces          = true;
        $objResponse        = new Response;
        try
        {
            $arrayParametros = array('CORREO' => $strCorreo);
            if($strAutenticacionRS == 'N')
            {
                $arrayParametros['CONTRASENIA'] = md5($strPass);
            }
            $objCliente   = $this->getDoctrine()
                                 ->getRepository(InfoCliente::class)
                                 ->findOneBy($arrayParametros);
            if(empty($objCliente))
            {
                $strStatus  = 404;
                $strSucces  = false;
                throw new \Exception('Usuario y/o contraseña incorrectos.');
            }
            else
            {
                if($objCliente->getESTADO() != "ACTIVO" )
                {
                    $strStatus  = 404;
                    $strSucces  = false;
                    throw new \Exception('Estimado usuario su cuenta aún está inactiva por favor verifica tu correo con el asunto "Bienvenido Usuario Bitte" para activar tu cuenta.');
                }
                else
                {
                    $arraySucursalPorClt = $this->getDoctrine()
                                                ->getRepository(InfoSucursal::class)
                                                ->findBy(array("CLIENTE_ID"          => $objCliente->getId(),
                                                               "ESTADO"              => "ACTIVO"),
                                                         array('DESCRIPCION'         => "ASC"));
                    if(!empty($arraySucursalPorClt) && is_array($arraySucursalPorClt))
                    {
                        foreach($arraySucursalPorClt as $arraySucursalItem)
                        {
                            $arraySucursal[] = array("idSucursal"        => $arraySucursalItem->getId(),
                                                     "sucursal"          => $arraySucursalItem->getDESCRIPCION(),
                                                     "idRestaurante"     => $arraySucursalItem->getRESTAURANTEID()->getId(),
                                                     "nombreComercial"   => $arraySucursalItem->getRESTAURANTEID()->getNOMBRECOMERCIAL(),
                                                     "estado"            => $arraySucursalItem->getESTADO(),
                                                     "idCentroComercial" => $arraySucursalItem->getCENTRO_COMERCIAL_ID() ? 
                                                                              $arraySucursalItem->getCENTRO_COMERCIAL_ID()->getId():"",
                                                     "centroComercial"   => $arraySucursalItem->getCENTRO_COMERCIAL_ID() ?
                                                                              $arraySucursalItem->getCENTRO_COMERCIAL_ID()->getNOMBRE():"");
                        }
                        
                    }
                    $arrayCliente   = array('idCliente'       => $objCliente->getId(),
                                            'autenticacionRS' => $objCliente->getAUTENTICACIONRS(),
                                            'identificacion'  => $objCliente->getIDENTIFICACION(),
                                            'nombre'          => $objCliente->getNOMBRE(),
                                            'apellido'        => $objCliente->getAPELLIDO(),
                                            'correo'          => $objCliente->getCORREO(),
                                            'idTipo'          => $objCliente->getTIPOCLIENTEPUNTAJEID()->getId(),
                                            'tipoCliente'     => $objCliente->getTIPOCLIENTEPUNTAJEID()->getDESCRIPCION(),
                                            'edad'            => $objCliente->getEDAD(),
                                            'genero'          => $objCliente->getGENERO(),
                                            'strEstado'       => $objCliente->getESTADO());
                }
            }
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            $strMensaje = $ex->getMessage();
            $arrayCliente['error'] = $strMensaje;
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCliente,
                                            'sucursal'  => $arraySucursal,
                                            'succes'    => $strSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getPublicidad'
     * Método encargado de retornar las publicidades según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 06-09-2019
     * 
     * @author Kevin Baque
     * @version 1.1 17-1-2019 - Se agrega insert a la tabla InfovistaPublicidad.
     *
     * @return array  $objResponse
     */
    public function getPublicidad($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPublicidad        = $arrayData['idPublicidad'] ? $arrayData['idPublicidad']:'';
        $intIdCliente           = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdSucursal          = $arrayData['idSucursal'] ? $arrayData['idSucursal']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $conImagen              = $arrayData['imagen'] ? $arrayData['imagen']:'NO';
        $strOrientacion         = $arrayData['orientacion'] ? $arrayData['orientacion']:'';
        $arrayPublicidad        = array();
        $arrayCliente           = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $boolSucces             = true;
        $strDatetimeActual      = new \DateTime('now');
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController    = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
/*
            $objResponse->setContent(json_encode(array(
                                                    'status'    => $strStatus,
                                                    'resultado' => array('IMAGEN' => null),
                                                    'succes'    => 'true')
                                            ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
*/
            $em->getConnection()->beginTransaction();
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($intIdCliente);
            if(!empty($objCliente))
            {
                $arrayCliente   = array('idCliente'      => $objCliente->getId(),
                                        'identificacion' => $objCliente->getIDENTIFICACION(),
                                        'nombre'         => $objCliente->getNOMBRE(),
                                        'apellido'       => $objCliente->getAPELLIDO(),
                                        'correo'         => $objCliente->getCORREO(),
                                        'direccion'      => $objCliente->getDIRECCION(),
                                        'genero'         => $objCliente->getGENERO(),
                                        'edad'           => $objCliente->getEDAD(),
                                        'idComida'       => $objCliente->getTIPOCLIENTEPUNTAJEID()->getId());
            }
            if(!empty($intIdSucursal))
            {
                $objSucursal = $this->getDoctrine()
                                    ->getRepository(InfoSucursal::class)
                                    ->find($intIdSucursal);
                if(!empty($objSucursal))
                {
                    $arraySucursal = array('idSucursal'  => $objSucursal->getId(),
                                           'descripcion' => $objSucursal->getDESCRIPCION(),
                                           'pais'        => $objSucursal->getPAIS(),
                                           'ciudad'      => $objSucursal->getCIUDAD(),
                                           'provincia'   => $objSucursal->getPROVINCIA(),
                                           'parroquia'   => $objSucursal->getPARROQUIA());
                }
            }
            $arrayParametros = array('PAIS'      => $arraySucursal['pais'],
                                     'CIUDAD'    => $arraySucursal['ciudad'],
                                     'PROVINCIA' => $arraySucursal['provincia'],
                                     'PARROQUIA' => $arraySucursal['parroquia'],
                                     'EDAD'      => $arrayCliente['edad'],
                                     'GENERO'    => $arrayCliente['genero'],
                                    'ORIENTACION'=>strtoupper($strOrientacion));
            $arrayPublicidad = (array) $this->getDoctrine()
                                            ->getRepository(InfoPublicidad::class)
                                            ->getPublicidadCriterioMovil($arrayParametros);
            if(empty($arrayPublicidad) || $arrayPublicidad['cantidad']==0)
            {
                $arrayPublicidad = (array) $this->getDoctrine()
                                                ->getRepository(InfoPublicidad::class)
                                                ->getPublicidadCriterioMovil(array('GENERO' => 'TODOS',
                                                                                   'ORIENTACION'=>strtoupper($strOrientacion)));
                if(empty($arrayPublicidad))
                {
                    $strStatus  = 404;
                    throw new \Exception('No existen publicidades con la descripción enviada por parametro222s');
                }
            }
        }
        catch(\Exception $ex)
        {
            $strStatus  = 404;
            $boolSucces = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $strMensajeError          ="Falló al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            $arrayPublicidad['error'] = $strMensajeError;
        }
        foreach ($arrayPublicidad['resultados'] as $item)
        {
            $arrayPublicidadMovil = array('ID_PUBLICIDAD'    => $item['ID_PUBLICIDAD'],
                                          'IMAGEN'           => $item['IMAGEN'],
                                          'DESCRIPCION'      => $item['DESCRIPCION'],
                                          'EDAD_MAXIMA'      => $item['EDAD_MAXIMA'],
                                          'EDAD_MINIMA'      => $item['EDAD_MINIMA'],
                                          'GENERO'           => $item['GENERO'],
                                          'ESTADO'           => $item['ESTADO'],
                                          'USR_CREACION'     => $item['USR_CREACION'],
                                          'FE_CREACION'      => $item['FE_CREACION'],
                                          'USR_MODIFICACION' => $item['USR_MODIFICACION'],
                                          'FE_MODIFICACION'  => $item['FE_MODIFICACION'],
                                          'ERROR'            => $strMensajeError);
            if((!empty($objCliente) && is_object($objCliente)) && (!empty($objSucursal) && is_object($objSucursal)))
            {
                $entityVistaPubl = new InfoVistaPublicidad();
                $entityVistaPubl->setCLIENTEID($objCliente);
                $entityVistaPubl->setRESTAURANTEID($objSucursal->getRESTAURANTEID());
                $entityVistaPubl->setPUBLICIDADID($this->getDoctrine()->getRepository(InfoPublicidad::class)->find($item['ID_PUBLICIDAD']));
                $entityVistaPubl->setESTADO(strtoupper('ACTIVO'));
                $entityVistaPubl->setUSRCREACION($strUsuarioCreacion);
                $entityVistaPubl->setFECREACION($strDatetimeActual);
                $em->persist($entityVistaPubl);
                $em->flush();
                $em->getConnection()->commit();
            }
            if(!empty($item['IMAGEN']) && $conImagen == 'SI')
            {
                $arrayPublicidadMovil['IMAGEN'] = $objController->getImgBase64($item['IMAGEN']);
            }
        }
        $objResponse->setContent(json_encode(array(
                                                    'status'    => $strStatus,
                                                    'resultado' => $arrayPublicidadMovil,
                                                    'succes'    => $boolSucces)
                                            ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createLike'
     * Método encargado de crear todos los likes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-09-2019
     * 
     * @return array  $objResponse
     */
    public function createLike($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdRestaurante   = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
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
            $objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->find($intIdRestaurante);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe restaurante con identificador enviado por parámetro.');
            }

            $entityLike = new InfoLikeRes();
            $entityLike->setCLIENTEID($objCliente);
            $entityLike->setRESTAURANTEID($objRestaurante);
            $entityLike->setESTADO(strtoupper($strEstado));
            $entityLike->setUSRCREACION($strUsuarioCreacion);
            $entityLike->setFECREACION($strDatetimeActual);
            $em->persist($entityLike);
            $em->flush();
            $strMensajeError = 'Like creada con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear el like, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
            $arrayLike = array('id' => $entityLike->getId());
        }
        $arrayLike['mensaje'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayLike,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'deleteLike'
     * Método encargado de deletiar todos los likes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-09-2019
     * 
     * @return array  $objResponse
     */
    public function deleteLike($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdLike          = $arrayData['idLike'] ? $arrayData['idLike']:'';
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $objLike = $this->getDoctrine()
                            ->getRepository(InfoLikeRes::class)
                            ->find($intIdLike);
            if(!is_object($objLike) || empty($objLike))
            {
                throw new \Exception('No existe el Like con identificador enviada por parámetro.');
            }
            $em->remove($objLike);
            $em->flush();
            $strMensajeError = 'Like eliminado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al eliminar el like, intente nuevamente.\n ". $ex->getMessage();
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
     * Documentación para la función 'createPunto'
     * Método encargado de crear todos los puntos según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-09-2019
     * 
     * @return array  $objResponse
     */
    public function createPunto($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'PENDIENTE';
        $intCantPuntos      = $arrayData['cantPuntos'] ? $arrayData['cantPuntos']:'';
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdSucursal      = $arrayData['idSucursal'] ? $arrayData['idSucursal']:'';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
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
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->find($intIdSucursal);
            if(!is_object($objSucursal) || empty($objSucursal))
            {
                throw new \Exception('No existe sucursal con identificador enviado por parámetro.');
            }

            $entityCltPunto = new InfoClientePunto();
            $entityCltPunto->setCLIENTEID($objCliente);
            $entityCltPunto->setSUCURSALID($objSucursal);
            $entityCltPunto->setCANTIDADPUNTOS($intCantPuntos);
            $entityCltPunto->setESTADO(strtoupper($strEstado));
            $entityCltPunto->setUSRCREACION($strUsuarioCreacion);
            $entityCltPunto->setFECREACION($strDatetimeActual);
            $em->persist($entityCltPunto);
            $em->flush();
            $strMensajeError = 'Punto creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear el Punto, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
            $arrayCltPunto = array('id'             => $entityCltPunto->getId(),
                                  'cantPuntos'      => $entityCltPunto->getCANTIDADPUNTOS(),
                                  'estado'          => $entityCltPunto->getESTADO(),
                                  'usrCreacion'     => $entityCltPunto->getUSRCREACION(),
                                  'feCreacion'      => $entityCltPunto->getFECREACION());
        }
        $arrayCltPunto['strMensajeError'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltPunto,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'editContenido'
     * Método encargado de editar todos los contenidos según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 02-10-2019
     * 
     * @return array  $objResponse
     * 
     * @author Kevin Baque
     * @version 1.1 03-12-2019 - Se agrega envío de correo notificando que ganó puntos
     *
     * @author Kevin Baque
     * @version 1.2 17-12-2019 - Se modifica envío de correo notificando que ganó puntos por calificar y compartir.
     *
     * @author Kevin Baque
     * @version 1.3 23-06-2021 - Se agrega lógica para el envío de correos por medio de la tabla InfoPlantilla.
     *
     */
    public function editContenido($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdContenido     = $arrayData['idContenido'] ? $arrayData['idContenido']:'';
        $intIdRedSocial     = $arrayData['idRedSocial'] ? $arrayData['idRedSocial']:'NO COMPARTIDO';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdSucursal      = $arrayData['idSucursal'] ? $arrayData['idSucursal']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        $boolSucces         = true;
        try
        {
            $em->getConnection()->beginTransaction();
            $objCliente     = $this->getDoctrine()
                                   ->getRepository(InfoCliente::class)
                                   ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe el cliente con la descripción enviada por parámetro.');
            }
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->find($intIdSucursal);
            if(!is_object($objSucursal) || empty($objSucursal))
            {
                throw new \Exception('No existe la sucursal con la descripción enviada por parámetro.');
            }
            $objRestaurante = $this->getDoctrine()
                                    ->getRepository(InfoRestaurante::class)
                                    ->find($objSucursal->getRESTAURANTEID());
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe restaurante con la descripción enviada por parámetro.');
            }
            $objContenido = $this->getDoctrine()
                                 ->getRepository(InfoContenidoSubido::class)
                                 ->find($intIdContenido);
            if(!is_object($objContenido) || empty($objContenido))
            {
                throw new \Exception('No existe el contenido con identificador enviada por parámetro.');
            }
            $objParametro    = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findOneBy(array('DESCRIPCION' => 'PUNTOS_PUBLICACION',
                                                      'ESTADO'      => 'ACTIVO'));
            if(!is_object($objParametro) || empty($objParametro))
            {
                throw new \Exception('No existe puntos de encuesta con la descripción enviada por parámetro.');
            }
            $objParametroRes = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findOneBy(array('DESCRIPCION' => 'PUNTOS_ENCUESTA',
                                                      'ESTADO'      => 'ACTIVO'));
            if(!is_object($objParametroRes) || empty($objParametroRes))
            {
                throw new \Exception('No existe puntos de encuesta con la descripción enviada por parámetro.');
            }
            $objRedSocial = $this->getDoctrine()
                                 ->getRepository(InfoRedesSociales::class)
                                 ->findOneBy(array('id'     => $intIdRedSocial,
                                                   'ESTADO' => 'ACTIVO'));
            $intPuntosPublicacion = $objParametro->getVALOR1();

            if(!is_object($objRedSocial) || empty($objRedSocial))
            {
                throw new \Exception('No existe la red social con identificador enviada por parámetro.');
            }
            else
            {
                if($objRestaurante->getES_AFILIADO() == "NO")
                {
                    $objPlantilla     = $this->getDoctrine()
                                             ->getRepository(InfoPlantilla::class)
                                             ->findOneBy(array('DESCRIPCION'=>"CALIFICAR_NO_AFILIADO",
                                                               'ESTADO'     =>"ACTIVO"));
                    if(!empty($objPlantilla) && is_object($objPlantilla))
                    {
                        $strMensajeCorreo = stream_get_contents ($objPlantilla->getPLANTILLA());
                        $strCuerpoCorreo1 = "Acabas de ganar un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
                        $strMensajeCorreo = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);
                    }
                }
                else
                {
                    $objPlantilla  = $this->getDoctrine()
                                          ->getRepository(InfoPlantilla::class)
                                          ->findOneBy(array('DESCRIPCION'=>"CALIFICAR_COMPARTIR",
                                                            'ESTADO'     =>"ACTIVO"));
                    $strTotalPuntos       = intval($objParametroRes->getVALOR1()) + intval($intPuntosPublicacion);
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
                    if(!empty($objPlantilla) && is_object($objPlantilla))
                    {
                        $strMensajeCorreo   = stream_get_contents ($objPlantilla->getPLANTILLA());
                        $strCuerpoCorreo1   = "¡Hola! ".$strNombreUsuario.". Acabas de calificar el restaurante ".$objRestaurante->getNOMBRECOMERCIAL()." y compartir tu foto en redes sociales";
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);

                        $strCuerpoCorreo2   = "¡Has ganado ".$strTotalPuntos." puntos en este establecimiento!";
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo2',$strCuerpoCorreo2,$strMensajeCorreo);

                        $strCuerpoCorreo3   = "Además, has ganado un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo3',$strCuerpoCorreo3,$strMensajeCorreo);
                    }
                }
                if(!empty($strMensajeCorreo))
                {
                    $strAsunto        = '¡GANASTE PUNTOS!';
                    $strRemitente     = 'notificaciones@bitte.app';
                    $arrayParametros  = array('strAsunto'        => $strAsunto,
                                            'strMensajeCorreo' => $strMensajeCorreo,
                                            'strRemitente'     => $strRemitente,
                                            'strDestinatario'  => $objCliente->getCORREO());
                    $objController    = new DefaultController();
                    $objController->setContainer($this->container);
                    $objController->enviaCorreo($arrayParametros);
                }
                $objContenido->setREDESSOCIALESID($objRedSocial);
                $objContenido->setCANTIDADPUNTOS($intPuntosPublicacion);
                $objContenido->setUSRMODIFICACION($strUsuarioCreacion);
                $objContenido->setFEMODIFICACION($strDatetimeActual);
                $em->persist($objContenido);
                $em->flush();
                $strMensajeError = 'Contenido editado con exito.!';
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces         = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al editar el Contenido, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
            $arrayContenido = array('id'            => $objContenido->getId(),
                                  'descripcion'     => $objContenido->getDESCRIPCION(),
                                  'cantPuntos'      => $objContenido->getCANTIDADPUNTOS(),
                                  'estado'          => $objContenido->getESTADO(),
                                  'usrCreacion'     => $objContenido->getUSRCREACION(),
                                  'feCreacion'      => $objContenido->getFECREACION());
        }
        $arrayContenido['strMensajeError'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayContenido,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createContenido'
     * Método encargado de crear todos los contenidos según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-09-2019
     * 
     * @return array  $objResponse
     */
    public function createContenido($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdSucursal      = $arrayData['idSucursal'] ? $arrayData['idSucursal']:'';
        $intIdRedSocial     = $arrayData['idRedSocial'] ? $arrayData['idRedSocial']:'NO COMPARTIDO';
        $strDescripcion     = $arrayData['descripcion'] ? $arrayData['descripcion']:'';
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'PENDIENTE';
        $strImagen          = $arrayData['rutaImagen'] ? $arrayData['rutaImagen']:'';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        $objController      = new DefaultController();
        $objController->setContainer($this->container);
        $boolSucces         = true;
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
            $objRedSocial = $this->getDoctrine()
                                 ->getRepository(InfoRedesSociales::class)
                                 ->findOneBy(array('DESCRIPCION' => $intIdRedSocial,
                                                   'ESTADO'      => 'ACTIVO'));
            if(!is_object($objRedSocial) || empty($objRedSocial))
            {
                throw new \Exception('No existe la red social con identificador enviada por parámetro.');
            }

            if( empty($strImagen))
            {
                throw new \Exception('No existe la imagen enviada por parámetro.');
            }

            $entityContSub = new InfoContenidoSubido();
            $entityContSub->setCLIENTEID($objCliente);
            $entityContSub->setREDESSOCIALESID($objRedSocial);
            $entityContSub->setDESCRIPCION($strDescripcion);
            $entityContSub->setIMAGEN("");
            $entityContSub->setESTADO(strtoupper($strEstado));
            $entityContSub->setUSRCREACION($strUsuarioCreacion);
            $entityContSub->setFECREACION($strDatetimeActual);
            $entityContSub->setCANTIDADPUNTOS(0);
            if(!empty($intIdSucursal))
            {
                $objSucursal = $this->getDoctrine()
                                    ->getRepository(InfoSucursal::class)
                                    ->find($intIdSucursal);
                if(!empty($objSucursal) && is_object($objSucursal))
                {
                    $entityContSub->setSUCURSALID($objSucursal);
                }
            }
            $em->persist($entityContSub);
            $em->flush();
            $strMensajeError = 'Contenido creado con exito.!';

            $arrayParametros = array('strImagen'      => $strImagen,
                                     'intIdContenido' => $entityContSub->getId());

            $strRutaImagen = $objController->subirficheroMovil($arrayParametros);
            
        }
        catch(\Exception $ex)
        {
            $boolSucces         = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear el Contenido, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
            $arrayContenido = array('id'            => $entityContSub->getId(),
                                  'cantPuntos'      => $entityContSub->getDESCRIPCION(),
                                  'estado'          => $entityContSub->getESTADO(),
                                  'usrCreacion'     => $entityContSub->getUSRCREACION(),
                                  'feCreacion'      => $entityContSub->getFECREACION());
        }
        $arrayContenido['strMensajeError'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayContenido,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createRedesSociales'
     * Método encargado de crear todos las redes sociales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-09-2019
     * 
     * @return array  $objResponse
     */
    public function createRedesSociales($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDescripcion     = $arrayData['descripcion'] ? $arrayData['descripcion']:'';
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();

            $entityRedesSociales = new InfoRedesSociales();
            $entityRedesSociales->setDESCRIPCION($strDescripcion);
            $entityRedesSociales->setESTADO(strtoupper($strEstado));
            $entityRedesSociales->setUSRCREACION($strUsuarioCreacion);
            $entityRedesSociales->setFECREACION($strDatetimeActual);
            $em->persist($entityRedesSociales);
            $em->flush();
            $strMensajeError = 'Redes Sociales creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear las Redes Sociales, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
            $arrayRedesSoc = array('id'             => $entityRedesSociales->getId(),
                                  'descripcion'     => $entityRedesSociales->getDESCRIPCION(),
                                  'estado'          => $entityRedesSociales->getESTADO(),
                                  'usrCreacion'     => $entityRedesSociales->getUSRCREACION(),
                                  'feCreacion'      => $entityRedesSociales->getFECREACION()
                                );
        }
        $arrayRedesSoc[strMensajeError] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayRedesSoc,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getPromocion'
     * Método encargado de listar las promociones según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 02-09-2019
     *
     * @author Kevin Baque
     * @version 1.1 10-11-2019 Se agrega filtro por restaurante.
     *
     * @author Kevin Baque
     * @version 1.2 10-02-2020 - Se valida si el cliente está serca de una sucursal.
     *
     * @author Kevin Baque
     * @version 1.3 14-09-2020 - Se agrega validaciones por promocion especial.
     *
     * @author Kevin Baque
     * @version 1.4 12-09-2021 - Se agrega validaciones por promocion especial canjeando cupón.
     *
     * @return array  $objResponse
     */
    public function getPromocion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdSucursal          = $arrayData['idSucursal'] ? $arrayData['idSucursal']:'';
        $intIdRestaurante       = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $intIdCliente           = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strLatitud             = $arrayData['latitud'] ? $arrayData['latitud']:'';
        $strLongitud            = $arrayData['longitud'] ? $arrayData['longitud']:'';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $boolSucces             = true;
        $arrayPromocion         = array();
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $intCantPuntos          = 0;
        $strDescripcion         = 'CANTIDAD_DISTANCIA';
        $strDescripcionPromoEsp = 'PROMOCION_ESPECIAL';
        $boolContinuar          = true;
        $strEsPermitido         = "NO";
        $strEsCanjeado          = "NO";
        $objController->setContainer($this->container);
        try
        {
            $objPromocion     = $this->getDoctrine()
                                     ->getRepository(InfoPromocion::class)
                                     ->findBy(array('ESTADO'         => $strEstado,
                                                    'PREMIO'         => 'NO',
                                                    'RESTAURANTE_ID' => $intIdRestaurante),
                                              array('DESCRIPCIONTIPOPROMOCION' => 'ASC'));
            if(empty($objPromocion) && !is_array($objPromocion))
            {
                throw new \Exception('La promoción a buscar no existe.');
            }
            $objParametro    = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findOneBy(array('ESTADO'      => 'ACTIVO',
                                                      'DESCRIPCION' => $strDescripcion));
            $arraySucursal   = $this->getDoctrine()
                                    ->getRepository(InfoSucursal::class)
                                    ->getValidaCoordenadas(array('latitud'      => $strLatitud,
                                                                'longitud'     => $strLongitud,
                                                                'estado'       => $strEstado,
                                                                'intIdRestaurante' => $intIdRestaurante,
                                                                'metros'       => $objParametro->getVALOR2()));
            /*
            Bloque que valida una promocion especial, con las sgte. condiciones:
            -Que aparezca solamente cuando tenga una encuesta realizada mientras no haya consumido esa promocion.
             */
            $arrayParametro  = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findBy(array('ESTADO'      => 'ACTIVO',
                                                   'DESCRIPCION' => $strDescripcionPromoEsp,
                                                   'VALOR2'      => $intIdRestaurante,
                                                   'VALOR3'      => 'Cerveza de Cortesía'));
            if(!empty($arrayParametro) && is_array($arrayParametro))
            {
                foreach($arrayParametro as $arrayItem)
                {
                    $arrayEncuesta = $this->getDoctrine()
                                          ->getRepository(InfoClienteEncuesta::class)
                                          ->getCantEncRes(array('intIdCliente'     =>$intIdCliente,
                                                                'intIdRestaurante' =>$intIdRestaurante,
                                                                'strDescPromocion' => 'Cerveza de Cortesía'));
                }
                if( (!empty($arrayParametro) && is_array($arrayParametro)) && 
                    (!empty($arrayEncuesta["resultados"]) && empty($arrayEncuesta["error"])))
                {
                    $arrayTemp      = $arrayEncuesta["resultados"][0];
                    $strEsPermitido = !empty($arrayTemp["ES_PERMITIDO"]) ? $arrayTemp["ES_PERMITIDO"]:"NO";
                    $strEsCanjeado  = !empty($arrayTemp["ES_CANJEADO"]) ? $arrayTemp["ES_CANJEADO"]:"NO";
                }
            }
            /*
            Bloque que valida una promocion especial, con las sgte. condiciones:
            -Que aparezca solamente cuando no haya consumido esa promocion y lo canjió desde un cupón.
             */
            $arrayParametroPromoCupon  = $this->getDoctrine()
                                              ->getRepository(AdmiParametro::class)
                                              ->findBy(array('ESTADO'      => 'ACTIVO',
                                                             'DESCRIPCION' => $strDescripcionPromoEsp,
                                                             'VALOR2'      => $intIdRestaurante,
                                                             'VALOR3'      => '*Consumo por empleado del mes*'));
            if(!empty($arrayParametroPromoCupon) && is_array($arrayParametroPromoCupon))
            {
                $arrayEncuestaCupon = $this->getDoctrine()
                                           ->getRepository(InfoClienteEncuesta::class)
                                           ->getCantEncRes(array('intIdCliente'     => $intIdCliente,
                                                                 'intIdRestaurante' => $intIdRestaurante,
                                                                 'strDescPromocion' => '*Consumo por empleado del mes*'));
                if( (!empty($arrayParametroPromoCupon) && is_array($arrayParametroPromoCupon)) && 
                    (!empty($arrayEncuestaCupon["resultados"]) && empty($arrayEncuestaCupon["error"])))
                {
                    //error_log( print_r($arrayEncuestaCupon["resultados"], TRUE) );
                    $arrayEncuestaCuponTemp  = $arrayEncuestaCupon["resultados"][0];
                    $intCantCuponCanjeado    = !empty($arrayEncuestaCuponTemp["CANT_CUPON_CANJEADO"] >0) ? intval($arrayEncuestaCuponTemp["CANT_CUPON_CANJEADO"]):0;
                    $strEsCanjeadoPromoCupon = !empty($arrayEncuestaCuponTemp["ES_CANJEADO"]) ? $arrayEncuestaCuponTemp["ES_CANJEADO"]:"NO";
                }
            }
            //Recorremos todas las promociones
            foreach($objPromocion as $arrayItem)
            {
                $strFechaExpiracion = "";
                $boolContinuar = true;
                //Validamos las promociones especiales
                if(!empty($arrayParametro) && is_array($arrayParametro))
                {
                    foreach($arrayParametro as $arrayItemPromoEsp)
                    {
                        if($arrayItemPromoEsp->getVALOR1() == $arrayItem->getId() && 
                        (($strEsPermitido == "NO" && $strEsCanjeado == "NO")||($strEsPermitido == "SI" && $strEsCanjeado == "SI")))
                        {
                            $boolContinuar = false;
                        }
                    }
                }
                //Validamos las promociones especiales por cupón
                if(!empty($arrayParametroPromoCupon) && is_array($arrayParametroPromoCupon))
                {
                    foreach($arrayParametroPromoCupon as $arrayItemPromoEspCupon)
                    {
                        if($arrayItemPromoEspCupon->getVALOR1() == $arrayItem->getId() && $intCantCuponCanjeado == 0)
                        {
                            $boolContinuar = false;
                        }
                    }
                }
                /**
                 * Bloque que valida una promocion de tipo Cupón, con las sgte. condiciones:
                 * Que aparezca solamente cuando: 
                 *  -No haya consumido esa promocion 
                 *  -Lo canjió desde un cupón de tipo Premio Especial.
                 *  -Fecha de vigencia sea valida
                 */
                if($arrayItem->getTIPOPROMOCIONID()->getDESCRIPCION() == "CUPON")
                {
                    $boolContinuar = false;
                    $objRelCuponPromocionClt = $this->getDoctrine()
                                                    ->getRepository(InfoCuponPromocionClt::class)
                                                    ->findOneBy(array("PROMOCION_ID"   => $arrayItem->getId(),
                                                                      "CLIENTE_ID"     => $intIdCliente,
                                                                      "ESTADO"         => "PENDIENTE"));
                    if(is_object($objRelCuponPromocionClt))
                    {
                        $strFechaExpiracion = $objRelCuponPromocionClt->getFEVIGENCIA()->format('d/m/Y H:i');
                        $objFechaActual     = new \DateTime('now');
                        $objDiferencia      = $objFechaActual->diff($objRelCuponPromocionClt->getFEVIGENCIA());
                        //Valido que esté entre el rango del día
                        if(intval($objDiferencia->format('%R%a'))>=0)
                        {
                            //Valido que esté entre el rango de las horas
                            if(intval($objDiferencia->format('%R%h'))>=0)
                            {
                                //Valido que esté entre el rango de los minutos
                                if(intval($objDiferencia->format('%R%i'))>0)
                                {
                                    $boolContinuar = true;
                                }
                            }
                        }
                        error_log("objFechaActual: ".$objFechaActual->format('d/m/Y H:i'));
                        error_log("strFechaExpiracion: ".$strFechaExpiracion);
                        error_log("Diferencia dia : ".intval($objDiferencia->format('%R%a')));
                        error_log("Diferencia hora: ".intval($objDiferencia->format('%R%h')));
                        error_log("Diferencia min : ".intval($objDiferencia->format('%R%i')));
                    }
                }
                if($boolContinuar)
                {
                    $strRutaImagen = "";
                    if(!empty($arrayItem->getIMAGEN()))
                    {
                        $strRutaImagen = $objController->getImgBase64($arrayItem->getIMAGEN());
                    }

                    $arrayPromocionesActivas   = $this->getDoctrine()
                                                      ->getRepository(InfoPromocionHistorial::class)
                                                      ->findBy(array('CLIENTE_ID'  =>$intIdCliente,
                                                                     'ESTADO'      =>'PENDIENTE',
                                                                     'PROMOCION_ID'=>$arrayItem->getId()));
                    $strPromocionActiva= "";
                    if(isset($arrayPromocionesActivas) && !empty($arrayPromocionesActivas))
                    {
                         $strPromocionActiva = "Procesando";
                    }
                    //Presentar Bander si se trata de una promoción especial cupón.
                    $strPromoEspecial = "N";
                    if($arrayItem->getDESCRIPCIONTIPOPROMOCION() == "*Consumo por empleado del mes*")
                    {
                        $strPromoEspecial = "S";
                    }
                    $arrayPromocion []= array( 'idPromocion'   => $arrayItem->getId(),
                                            'textoProceso'     => $strPromocionActiva,
                                            'descripcion'      => $arrayItem->getDESCRIPCIONTIPOPROMOCION(),
                                            'imagen'           => $strRutaImagen ? $strRutaImagen:'',
                                            'cantPuntos'       => $arrayItem->getCANTIDADPUNTOS(),
                                            'aceptaGlobal'     => $arrayItem->getACEPTAGLOBAL(),
                                            'habilitar'        => (!empty($arraySucursal["resultados"])&& isset($arraySucursal["resultados"])) ? 'SI':'NO',
                                            'estado'           => $arrayItem->getESTADO(),
                                            'promoEspecial'    => $strPromoEspecial,
                                            'fechaExpiracion'  => $strFechaExpiracion
                                        );
                }
            }
            $arrayPuntos     = $this->getDoctrine()
                                    ->getRepository(InfoClientePunto::class)
                                    ->findBy(array('RESTAURANTE_ID' => $intIdRestaurante,
                                                   'CLIENTE_ID'     => $intIdCliente));
            if(empty($arrayPuntos) && !is_array($arrayPuntos))
            {
                $intCantPuntos = 0;
            }
            else
            {
                foreach($arrayPuntos as $arrayItemPuntos)
                {
                    $intCantPuntos = $intCantPuntos + $arrayItemPuntos->getCANTIDADPUNTOS();
                }
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces              = false;
            $strStatus               = 404;
            $strMensaje              ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            $arrayPromocion['error'] = $strMensaje;
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'puntaje'   => $intCantPuntos,
                                            'resultado' => $arrayPromocion,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'createPuntoGlobal'
     * Método encargado de crear todos los puntos globales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 20-09-2019
     * 
     * @return array  $objResponse
     */
    public function createPuntoGlobal($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'PENDIENTE';
        $intCantPuntos      = $arrayData['cantPuntos'] ? $arrayData['cantPuntos']:'';
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
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

            $entityCltPunto = new InfoClientePuntoGlobal();
            $entityCltPunto->setCLIENTEID($objCliente);
            $entityCltPunto->setCANTIDADPUNTOS($intCantPuntos);
            $entityCltPunto->setESTADO(strtoupper($strEstado));
            $entityCltPunto->setUSRCREACION($strUsuarioCreacion);
            $entityCltPunto->setFECREACION($strDatetimeActual);
            $em->persist($entityCltPunto);
            $em->flush();
            $strMensajeError = 'Punto creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear el Punto, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
            $arrayCltPunto = array('id'             => $entityCltPunto->getId(),
                                  'cantPuntos'      => $entityCltPunto->getCANTIDADPUNTOS(),
                                  'estado'          => $entityCltPunto->getESTADO(),
                                  'usrCreacion'     => $entityCltPunto->getUSRCREACION(),
                                  'feCreacion'      => $entityCltPunto->getFECREACION()
                                );
        }
        $arrayCltPunto['strMensajeError'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayCltPunto,
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
     * @version 1.0 29-09-2019
     * 
     * @author Kevin Baque
     * @version 1.1 17-08-2020 - Se agrega logica para canjear código.
     *
     * @author Kevin Baque
     * @version 1.2 11-11-2021 - Se agrega logica para canjear cupón de tipo premio especial.
     *
     * @return array  $objResponse
     */
    public function createPromocionHistorial($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdPromocion     = $arrayData['idPromocion'] ? $arrayData['idPromocion']:'';
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdRestaurante   = $arrayData['idRestaurante'] ? $arrayData['idRestaurante']:'';
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'PENDIENTE';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'usuario';
        $strDatetimeActual  = new \DateTime('now');
        $strMensajeError    = '';
        $strStatus          = 400;
        $intCantidadPuntos  = 0;
        $intCantPuntospromo = 0;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        $boolSucces         = true;
        $boolBanderaCodigo  = false;
        $strMensajePromocion = "Informele al mesero sobre su solicitud\n Y presente su identificación";
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
            $objRestaurante = $this->getDoctrine()
                                   ->getRepository(InfoRestaurante::class)
                                   ->find($intIdRestaurante);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe restaurante con identificador enviado por parámetro.');
            }
            $strRestauranteCodigo = $objRestaurante->getCODIGO();
            if(!empty($strRestauranteCodigo) && $strRestauranteCodigo == "SI")
            {
                $strMensajePromocion = "Revise su correo electrónico para obtener\n su código el cual debe presentar al momento\n de realizar su pedido y obtener su promoción";
            }
            //Consultar la cant. de puntos que tiene el cliente.
            $arrayCltPunto = $this->getDoctrine()
                                  ->getRepository(InfoClientePunto::class)
                                  ->findBy(array('CLIENTE_ID'     => $intIdCliente,
                                                 'RESTAURANTE_ID' => $intIdRestaurante));
            if(is_array($arrayCltPunto) && !empty($arrayCltPunto))
            {
                foreach($arrayCltPunto as $arrayItem)
                {
                    $intCantidadPuntos = $intCantidadPuntos + $arrayItem->getCANTIDADPUNTOS();
                }
            }
            //Consultar la cant. de puntos que vale la promoción.
            $objPromocion = $this->getDoctrine()
                                 ->getRepository(InfoPromocion::class)
                                 ->find($intIdPromocion);
            if(!is_object($objPromocion) || empty($objPromocion))
            {
                throw new \Exception('No existe la Promoción.');
            }
            //Lógica en caso de que la promoción sea '*Consumo por empleado del mes*'
            if($objPromocion->getDESCRIPCIONTIPOPROMOCION() == "*Consumo por empleado del mes*")
            {
                $arrayParametrosCodigo = array("PROMOCION_ID" => $objPromocion->getId(),
                                               "ESTADO"       => "ACTIVO");
                $objCuponHist = $this->getDoctrine()
                                     ->getRepository(InfoCuponHistorial::class)
                                     ->findOneBy(array("CLIENTE_ID"     => $objCliente->getId(),
                                                       "ESTADO"         => "PEND-PROMOCION",
                                                       "RESTAURANTE_ID" => $intIdRestaurante));
                if(is_object($objCuponHist) && !empty($objCuponHist))
                {
                    error_log("objCuponHist: ".$objCuponHist->getId());
                    $objCuponHist->setESTADO("CANJEADO");
                }
            }
            //Lógica en caso de que la promoción sea de tipo Cupon.
            if($objPromocion->getTIPOPROMOCIONID()->getDESCRIPCION() == "CUPON")
            {
                $objRelCuponPromocionClt = $this->getDoctrine()
                                                ->getRepository(InfoCuponPromocionClt::class)
                                                ->findOneBy(array("PROMOCION_ID"   => $objPromocion->getId(),
                                                                  "CLIENTE_ID"     => $intIdCliente,
                                                                  "ESTADO"         => "PENDIENTE"));
                $objRelCuponPromocionClt->setESTADO("CANJEADO");
                $em->persist($objRelCuponPromocionClt);
                $em->flush();
            }

            $intCantPuntospromo = $objPromocion->getCANTIDADPUNTOS();
            //Lógica para canjear promoción normal y con código
            if($intCantPuntospromo<=$intCantidadPuntos)
            {
                if($objPromocion->getCODIGO() == "SI")
                {
                    $arrayParametrosCodigo = array("PROMOCION_ID"=> $objPromocion->getId(),
                                                   "ESTADO"      => "ACTIVO");
                    $objCodigoPromocion    = $this->getDoctrine()
                                                  ->getRepository(InfoCodigoPromocion::class)
                                                  ->findOneBy($arrayParametrosCodigo);
                    if(!is_object($objCodigoPromocion) || empty($objCodigoPromocion))
                    {
                        throw new \Exception("No existe código válido");
                    }
                    $strNombreUsuario = $objCliente->getNOMBRE() .' '.$objCliente->getAPELLIDO();
                    $strDestinatario  = $objCliente->getCORREO();
                    $strAsunto        = '¡PROMOCIÓN CANJEADA!';
                    $strMensajeCorreo = '
                    <div class=""><b>¡Hola! '.$strNombreUsuario.'.</b>&nbsp;</div>
                    <div class="">&nbsp;</div>
                    <div class="">FELICITACIONES!!!!&nbsp;</div>
                    <div class="">&nbsp;</div>
                    <div class="">Acabas de canjear la promoción: <strong>'.$objPromocion->getDESCRIPCIONTIPOPROMOCION().'</strong> en el restaurante <strong>'.$objRestaurante->getNOMBRECOMERCIAL().'</strong>.&nbsp;</div>
                    <div class="">&nbsp;</div>
                    <div>Presenta este <strong>c&oacute;digo '.$objCodigoPromocion->getCODIGO().'</strong> al momento de realizar tu pedido al cajero. Esperamos que tu premio est&eacute; delicioso.&nbsp;</div>
                    <div class="">&nbsp;</div>
                    <div class="">Recuerda siempre usar tu app Bitte para calificar tu experiencia gastron&oacute;mica, compartir en tus redes sociales, ganar m&aacute;s puntos y comer gratis.&nbsp;</div>
                    <div class="">&nbsp;</div>
                    <div style=\"font-family:Varela Round\"><b>Enjoy your Bitte</b>&nbsp;</div>
                    <div class="">&nbsp;</div>';
                    $strRemitente     = 'notificaciones@bitte.app';

                    $arrayParametrosCorreo = array('strAsunto'        => $strAsunto,
                                                   'strMensajeCorreo' => $strMensajeCorreo,
                                                   'strRemitente'     => $strRemitente,
                                                   'strDestinatario'  => $strDestinatario);
                    $objController    = new DefaultController();
                    $objController->setContainer($this->container);
                    $objController->enviaCorreo($arrayParametrosCorreo);

                    $objCodigoPromocion->setESTADO("CANJEADO");
                    $entityCodigoPromocionHist = new InfoCodigoPromocionHistorial();
                    $entityCodigoPromocionHist->setCODIGO_PROMOCION_ID($objCodigoPromocion);
                    $entityCodigoPromocionHist->setESTADO("CANJEADO");
                    $entityCodigoPromocionHist->setCLIENTEID($objCliente);
                    $entityCodigoPromocionHist->setUSRCREACION($strUsuarioCreacion);
                    $entityCodigoPromocionHist->setFECREACION($strDatetimeActual);
                    $em->persist($entityCodigoPromocionHist);
                    $em->flush();
                    $boolBanderaCodigo = true;
                }
                $arrayPromociones   = $this->getDoctrine()
                                           ->getRepository(InfoPromocionHistorial::class)
                                           ->getPromoHistorialCriterio(array('intIdCliente'=>$intIdCliente,
                                                                             'strEstado'   =>'PENDIENTE'));
                if(isset($arrayPromociones['error']) && !empty($arrayPromociones['error']))
                {
                    $strStatus  = 404;
                    throw new \Exception($arrayPromociones['error']);
                }
                $intCantidadPromocion = $arrayPromociones['resultados'];
                $strNombreRestaurante = $arrayPromociones['resultados2'];
                //(puntajeCliente-puntjaePromocionesVigente) > puntajePromocion
                $intSumaPuntajeClt    = $intCantidadPuntos - $intCantidadPromocion;
                if($intSumaPuntajeClt >= $intCantPuntospromo)
                {
                    $entityPromocionHist = new InfoPromocionHistorial();
                    $entityPromocionHist->setCLIENTEID($objCliente);
                    $entityPromocionHist->setPROMOCIONID($objPromocion);
                    $entityPromocionHist->setESTADO(strtoupper($strEstado));
                    $entityPromocionHist->setUSRCREACION($strUsuarioCreacion);
                    $entityPromocionHist->setFECREACION($strDatetimeActual);
                    $em->persist($entityPromocionHist);
                    $em->flush();
                    $strMensajeError = 'Creado con exito.!';
                    $intIdPromocionHist = $entityPromocionHist->getId();
                }
                else
                {
                    $intResultado = $intCantPuntospromo - $intCantidadPuntos;
                    throw new \Exception('Puntaje actual insuficiente.Tiene promociones en '.$strNombreRestaurante. "pendientes");
                }
            }
            else
            {
                $intResultado = $intCantPuntospromo - $intCantidadPuntos;
                throw new \Exception('Cantidad de puntos insuficiente. Al momento ud. cuenta con '.$intCantidadPuntos.' puntos, por lo cual le hace falta: '.$intResultado.' puntos.');
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
            if($boolBanderaCodigo)
            {
                $objPromocionHist = $this->getDoctrine()
                                         ->getRepository(InfoPromocionHistorial::class)
                                         ->findOneBy(array('id'     => $intIdPromocionHist,
                                                           'ESTADO' => 'PENDIENTE'));
                if(!empty($objPromocionHist)&&is_object($objPromocionHist))
                {
                    $strEstado = "COMPLETADO";
                    $objPromocionHist->setESTADO(strtoupper($strEstado));
                    $objPromocionHist->setUSRMODIFICACION($strUsuarioCreacion);
                    $objPromocionHist->setFEMODIFICACION($strDatetimeActual);
                    $em->persist($objPromocionHist);
                    $em->flush();
                }
                if ($em->getConnection()->isTransactionActive())
                {
                    $em->getConnection()->commit();
                    $em->getConnection()->close();
                }
            }
            $arrayPromocionHist = array('id'             => $entityPromocionHist->getId(),
                                        'idCliente'      => $entityPromocionHist->getCLIENTEID()->getId(),
                                        'idPromocion'    => $entityPromocionHist->getPROMOCIONID()->getId(),
                                        'estado'         => $entityPromocionHist->getESTADO(),
                                        'usrCreacion'    => $entityPromocionHist->getUSRCREACION(),
                                        'feCreacion'     => $entityPromocionHist->getFECREACION()
                                );
        }
        $arrayPromocionHist['strMensajeError'] = $strMensajeError;
        $arrayPromocionHist['strMensaje']      = $strMensajePromocion;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayPromocionHist,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getTipoComida'
     * Método encargado de listar los tipos de comida según los parámetros recibidos.
     *
     * @author Kevin Baque
     * @version 1.0 15-10-2019
     *
     * @return array  $objResponse
     */
    public function getTipoComida($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdTipoComida        = $arrayData['idTipoComida'] ? $arrayData['idTipoComida']:'';
        $strEstado              = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $boolSucces             = true;
        $arrayTipoComida        = array();
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            $arrayParametros = array('ESTADO' => $strEstado);
            if(!empty($intIdTipoComida))
            {
                $arrayParametros['id'] = $intIdTipoComida;
            }
            $objTipoComida = $this->getDoctrine()
                                  ->getRepository(AdmiTipoComida::class)
                                  ->findBy($arrayParametros);
            if(empty($objTipoComida) && !is_array($objTipoComida))
            {
                throw new \Exception('El tipo de comida a buscar no existe.');
            }
            foreach($objTipoComida as $arrayItem)
            {
                $arrayTipoComida []= array('idTipoComida'     => $arrayItem->getId(),
                                           'descripcion'      => $arrayItem->getDESCRIPCION(),
                                           'estado'           => $arrayItem->getESTADO());
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces               = false;
            $strStatus                = 404;
            $strMensaje               ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            $arrayTipoComida['error'] = $strMensaje;
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayTipoComida,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'editPromocionHistorial'
     * Método encargado de eliminar el historial de la promoción según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 28-10-2019
     * 
     * @return array  $objResponse
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
            $objPromocionHist = $this->getDoctrine()
                                     ->getRepository(InfoPromocionHistorial::class)
                                     ->findOneBy(array('id'     => $intIdPromocionHist,
                                                       'ESTADO' => 'PENDIENTE'));
            if(!is_object($objPromocionHist) || empty($objPromocionHist))
            {
                throw new \Exception('Promoción ha sido redimida.');
            }
            $em->remove($objPromocionHist);
            $em->flush();
            $strMensajeError = 'Historial de la promoción eliminada con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al eliminar Historial de la promoción, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $strMensajeError,
                                            'succes'    => true)
                                            ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getCantPtosResEnc'
     * Método encargado de retornar todos los clientes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 11-11-2019 Se retorna el icono del restaurante, adicional se cambia el valor razon social por nombre comercial.
     * 
     * @author Kevin Baque
     * @version 1.2 18-06-2021 - Se agrega lógica para saber si el cliente en sesión puede ver el restaurante Bitte.
     *
     * @return array  $objResponse
     */
    public function getCantPtosResEnc($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente      = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $strEstado         = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $conIcono          = $arrayData['icono']  ? $arrayData['icono']:'SI';
        $intLimiteInicial  = $arrayData['limiteInicial'];
        $intLimiteFinal    = $arrayData['limiteFinal'];
        $strLetra          = $arrayData['letra'];
        $arrayPuntos       = array();
        $strMensajeError   = '';
        $strStatus         = 400;
        $objResponse       = new Response;
        $objController     = new DefaultController();
        $objController->setContainer($this->container);
        try
        {
            $objParametroVerBitte = $this->getDoctrine()
                                         ->getRepository(AdmiParametro::class)
                                         ->findOneBy(array('DESCRIPCION' => 'CLT_PERMITIDO_BITTE',
                                                           'ESTADO'      => 'ACTIVO'));
            if(!is_object($objParametroVerBitte) || empty($objParametroVerBitte))
            {
                throw new \Exception('No existe el parametro CLT_PERMITIDO_BITTE.');
            }
            $arrayVerBitte = explode(",",$objParametroVerBitte->getVALOR1());
            $strVerBitte   = (in_array($intIdCliente,$arrayVerBitte)==true)?"S":"N";
            if(empty($intLimiteInicial))
            {
                $intNumeroEncuesta  = $this->getDoctrine()
                                           ->getRepository(InfoClienteEncuesta::class)
                                           ->getCantidadEncuestaCliente(array('clienteId'=>$intIdCliente,
                                                                              'strEstado' =>array('ACTIVO','PENDIENTE')));

                $arrayParametrosTenedor = array('intIdCliente'     => $intIdCliente,
                                                'strEstado'        => 'PENDIENTE');

                $arrayTenedorOro   = $this->getDoctrine()
                                          ->getRepository(InfoPromocionHistorial::class)
                                          ->getPromoHistorialTenedorMovil($arrayParametrosTenedor);
            }
            if(true)//if(!empty($intLimiteFinal))
            {
                $arrayParametros = array('intIdCliente'      => $intIdCliente,
                                         'strEstado'         => $strEstado,
                                         'intLimiteInicial'  => $intLimiteInicial,
                                         'intLimiteFinal'    => $intLimiteFinal,
                                         'strVerBitte'       => $strVerBitte,
                                         'strLetra'          => $strLetra);

                $arrayPuntos   = $this->getDoctrine()
                                      ->getRepository(InfoClienteEncuesta::class)
                                      ->getCantPtosResEnc($arrayParametros);
            }
            if(isset($arrayPuntos['error']) && !empty($arrayPuntos['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayPuntos['error']);
            }
            if($conIcono == 'SI')
            {
                foreach ($arrayPuntos['resultados'] as &$item)
                {
                    if($item['ICONO'])
                    {
                        $item['ICONO'] = $objController->getImgBase64($item['ICONO']);
                    }
                }
                foreach ($arrayTenedorOro['resultados'] as &$item)
                {
                    if($item['imagen'])
                    {
                        $item['imagen'] = $objController->getImgBase64($item['imagen']);
                    }
                }
            }
            $arrayPuntos['resultadoTenedor'] = $arrayTenedorOro['resultados'];
            $arrayPuntos['numeroEncuestas'] = $intNumeroEncuesta['CANTIDAD'];
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayPuntos['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayPuntos,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'generarPass'
     * Método encargado de generar las contraseñas a todos los clientes.
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
        $strMensajeCorreo = '<div class="">Estimado cliente.</div>
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
        $boolSucces       = true;
        try
        {
            $em->getConnection()->beginTransaction();
            if(empty($strDestinatario))
            {
                throw new \Exception('Es necesario enviar el correo.');
            }
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->findOneBy(array('CORREO'=>$strDestinatario));
            if(!is_object($objCliente) && empty($objCliente))
            {
                throw new \Exception('Cliente no existente.');
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
            $objCliente->setCONTRASENIA(md5($strContrasenia));
            $em->persist($objCliente);
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
            $boolSucces      = false;
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
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'generarClave'
     * Método encargado de generar contraseña al clientes.
     *
     * @author Kevin Baque
     * @version 1.0 11-03-2020
     *
     * @return array  $objResponse
     */
    public function generarClave($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente     = $arrayData['intIdCliente'] ? $arrayData['intIdCliente']:'';
        $strClave         = $arrayData['strClave'] ? $arrayData['strClave']:'';
        $objResponse      = new Response;
        $strRespuesta     = '';
        $arrayParametros  = array();
        $strStatus        = 400;
        $em               = $this->getDoctrine()->getManager();
        $strMensajeError  = '';
        $boolSucces       = true;
        try
        {
            $em->getConnection()->beginTransaction();
            if(empty($intIdCliente))
            {
                throw new \Exception('Es necesario enviar el id del cliente.');
            }
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($intIdCliente);
            if(!is_object($objCliente) && empty($objCliente))
            {
                throw new \Exception('Cliente no existente.');
            }
            if(empty($strClave))
            {
                throw new \Exception('Es necesario enviar la nueva clave.');
            }
            $objCliente->setCONTRASENIA(md5($strClave));
            $em->persist($objCliente);
            $em->flush();
            $strMensajeError = 'Cambio de clave con éxito!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
                $em->getConnection()->close();
            }
            $strStatus       = 404;
            $boolSucces      = false;
            $strMensajeError = "Fallo al generar el cambio de clave, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $strMensajeError,
                                            'succes'    => $boolSucces)
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'enviCorreoPrueba'
     * Método encargado de enviar correos de pruebas.
     *
     * @author Kevin Baque
     * @version 1.0 03-12-2019
     *
     * @author Kevin Baque
     * @version 1.2 23-06-2021 - Se agrega lógica para el envío de correos por medio de la tabla InfoPlantilla.
     *
     * @return array  $objResponse
     */
    public function enviCorreoPrueba($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDestinatario  = $arrayData['strCorreo'] ? $arrayData['strCorreo']:'';
        $strRemitente     = 'notificaciones@bitte.app';
        $objResponse      = new Response;
        $strRespuesta     = '';
        $arrayParametros  = array();
        $strStatus        = 400;
        $strMensajeError  = '';
        $boolSucces       = true;
        try
        {
            $objPlantilla  = $this->getDoctrine()
                                  ->getRepository(InfoPlantilla::class)
                                  ->findOneBy(array('DESCRIPCION'=>"ENCUESTA_CUPON"));
            $strAsunto        = 'Prueba Correo';
/*
            $strMensajeCorreo   = stream_get_contents ($objPlantilla->getPLANTILLA());
            $strCuerpoCorreo1   = "¡Hola! Patricia Chiquito. Acabas de calificar el restaurante Bitte";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);

            $strCuerpoCorreo2   = "¡Has ganado 2 puntos en este establecimiento!";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo2',$strCuerpoCorreo2,$strMensajeCorreo);

            $strCuerpoCorreo3   = "Además, has ganado un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo3',$strCuerpoCorreo3,$strMensajeCorreo);


            $strMensajeCorreo = stream_get_contents ($objPlantilla->getPLANTILLA());
            $strCuerpoCorreo1   = "¡Hola! Patricia Chiquito. Acabas de calificar y compartir tu foto en redes sociales";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);

            $strCuerpoCorreo2   = "¡Has ganado 4 puntos en este establecimiento!";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo2',$strCuerpoCorreo2,$strMensajeCorreo);

            $strCuerpoCorreo3   = "Además, has ganado un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo3',$strCuerpoCorreo3,$strMensajeCorreo);

            $strMensajeCorreo = stream_get_contents ($objPlantilla->getPLANTILLA());
            $strCuerpoCorreo1   = "Acabas de ganar un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);
*/
            $strMensajeCorreo = stream_get_contents ($objPlantilla->getPLANTILLA());
            $strCuerpoCorreo1   = "Acabas de ganar un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
            $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);

            $arrayParametros    = array('strAsunto'        => $strAsunto,
                                        'strMensajeCorreo' => $strMensajeCorreo,
                                        'strRemitente'     => $strRemitente,
                                        'strDestinatario'  => $strDestinatario);
            $objController    = new DefaultController();
            $objController->setContainer($this->container);
            $strMensajeError = $objController->enviaCorreo($arrayParametros);
        }
        catch(\Exception $ex)
        {
            $strStatus       = 404;
            $boolSucces      = false;
            $strMensajeError = "Fallo al generar el correo, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $strMensajeError,
                                            'succes'    => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'envioCorreoCalificacion'
     *
     * Método encargado de enviar correo en caso de que el cliente no comparta contenido
     * 
     * @author Kevin Baque
     * @version 1.0 04-09-2019
     * 
     * @author Kevin Baque
     * @version 1.1 21-06-2021 - Se agrega lógica para restaurantes no afiliados.
     * 
     * @author Kevin Baque
     * @version 1.2 23-06-2021 - Se agrega lógica para el envío de correos por medio de la tabla InfoPlantilla.
     *
     * @return array  $objResponse
     *
     */
    public function envioCorreoCalificacion($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        date_default_timezone_set('America/Guayaquil');
        $intIdCliente       = $arrayData['idCliente'] ? $arrayData['idCliente']:'';
        $intIdSucursal      = $arrayData['idSucursal'] ? $arrayData['idSucursal']:'';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 400;
        $objResponse        = new Response;
        $em                 = $this->getDoctrine()->getManager();
        $boolSucces         = true;
        try
        {
            $em->getConnection()->beginTransaction();
            $objCliente     = $this->getDoctrine()
                                   ->getRepository(InfoCliente::class)
                                   ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe el cliente con la descripción enviada por parámetro.');
            }
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->find($intIdSucursal);
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

            $objParametro    = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findOneBy(array('DESCRIPCION' => 'PUNTOS_ENCUESTA',
                                                      'ESTADO'      => 'ACTIVO'));
            if(!is_object($objParametro) || empty($objParametro))
            {
                throw new \Exception('No existe puntos de encuesta con la descripción enviada por parámetro.');
            }
            $arrayRestaurantes = $this->getDoctrine()
                                      ->getRepository(InfoRestaurante::class)
                                      ->getRestauranteCriterio(array('intIdRestaurante' => $objRestaurante->getId()));
            if(!empty($arrayRestaurantes) && !empty($arrayRestaurantes['resultados']))
            {
                $strAsunto            = "¡GANASTE PUNTOS!";
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

                $arrayItemRestaurante = $arrayRestaurantes['resultados'][0];
                if(!empty($arrayItemRestaurante["ES_AFILIADO"]) && isset($arrayItemRestaurante["ES_AFILIADO"]) 
                    && $arrayItemRestaurante["ES_AFILIADO"] == "NO")
                {
                    $objPlantilla     = $this->getDoctrine()
                                             ->getRepository(InfoPlantilla::class)
                                             ->findOneBy(array('DESCRIPCION'=>"CALIFICAR_NO_AFILIADO",
                                                               'ESTADO'     =>"ACTIVO"));
                    if(!empty($objPlantilla) && is_object($objPlantilla))
                    {
                        $strMensajeCorreo = stream_get_contents ($objPlantilla->getPLANTILLA());
                        $strCuerpoCorreo1 = "Acabas de ganar un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
                        $strMensajeCorreo = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);
                    }
                }
                else
                {
                    $objPlantilla     = $this->getDoctrine()
                                             ->getRepository(InfoPlantilla::class)
                                             ->findOneBy(array('DESCRIPCION'=>"CALIFICAR",
                                                               'ESTADO'     =>"ACTIVO"));
                    if(!empty($objPlantilla) && is_object($objPlantilla))
                    {
                        $strMensajeCorreo   = stream_get_contents ($objPlantilla->getPLANTILLA());
                        $strCuerpoCorreo1   = "¡Hola! ".$strNombreUsuario.". Acabas de calificar el restaurante ".$objRestaurante->getNOMBRECOMERCIAL()." ";
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo1',$strCuerpoCorreo1,$strMensajeCorreo);

                        $strCuerpoCorreo2   = "¡Has ganado ".$objParametro->getVALOR1()." puntos en este establecimiento!";
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo2',$strCuerpoCorreo2,$strMensajeCorreo);

                        $strCuerpoCorreo3   = "Además, has ganado un cupón para participar en el sorteo mensual del Tenedor de Oro por comidas gratis de nuestros restaurantes participantes.";
                        $strMensajeCorreo   = str_replace('strCuerpoCorreo3',$strCuerpoCorreo3,$strMensajeCorreo);
                    }
                }
            }
            if(!empty($strMensajeCorreo))
            {
                $strRemitente     = 'notificaciones@bitte.app';
                $arrayParametros  = array('strAsunto'        => $strAsunto,
                                          'strMensajeCorreo' => $strMensajeCorreo,
                                          'strRemitente'     => $strRemitente,
                                          'strDestinatario'  => $objCliente->getCORREO());
                 $objMessage =  (new \Swift_Message())
                                            ->setSubject($strAsunto)
                                            ->setFrom("notificaciones@bitte.app")
                                            ->setTo($objCliente->getCORREO())
                                            ->setBody($strMensajeCorreo,'text/html');
                $strRespuesta = $this->container->get('mailer')->send($objMessage);
                /*$objController    = new DefaultController();
                $objController->setContainer($this->container);
                $objController->enviaCorreo($arrayParametros);*/
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces = false;
            $strMensajeError ="Fallo al crear la respuesta, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['mensaje']          = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                                    'status'           => $strStatus,
                                                    'resultado'        => $strMensajeError,
                                                    'succes'           => $boolSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getEditInfoCltEncuestaPend'
     * Método encargado de editar las encuestas según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 24-12-2019
     *
     * @return array  $objResponse
     */
    public function getEditInfoCltEncuestaPend($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado              = $arrayData['strEstado'] ? $arrayData['strEstado']:'PENDIENTE';
        $strUsuarioCreacion     = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'CRONTAB';
        $strMensajeError        = '';
        $strStatus              = 400;
        $boolSucces             = true;
        $strDatetimeActual      = new \DateTime('now');
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $arrayParametros = array('strEstado'      => $strEstado);
            $arrayEncuestas  = $this->getDoctrine()
                                            ->getRepository(InfoClienteEncuesta::class)
                                            ->getVigenciaEncuestaPend($arrayParametros);
            if(empty($arrayEncuestas) || !is_array($arrayEncuestas))
            {
                $strStatus  = 404;
                throw new \Exception('No existen encuestas con la descripción enviada por parametros');
            }
            foreach ($arrayEncuestas['resultados'] as $item)
            {
                $objEncuesta = $this->getDoctrine()
                                    ->getRepository(InfoClienteEncuesta::class)
                                    ->find($item['ID_CLT_ENCUESTA']);
                if(!is_object($objEncuesta) || empty($objEncuesta))
                {
                    throw new \Exception('No existe la Promoción.');
                }
                $objEncuesta->setESTADO('ACTIVO');
                $objEncuesta->setUSRMODIFICACION($strUsuarioCreacion);
                $objEncuesta->setFEMODIFICACION($strDatetimeActual);
                $em->persist($objEncuesta);
                $em->flush();
                $em->getConnection()->commit();
            }
        }
        catch(\Exception $ex)
        {
            $strStatus  = 404;
            $boolSucces = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $strMensajeError          ="Falló al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }

        $objResponse->setContent(json_encode(array(
                                                    'status'    => $strStatus,
                                                    'resultado' => $strMensajeError,
                                                    'succes'    => $boolSucces)
                                            ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'generaCodigoSucursal'
     * Método encargado de enviar correos de notificación indicando que se generó el codigo de sucursal.
     *
     * @author Kevin Baque
     * @version 1.0 20-06-2020
     *
     * @return array  $objResponse
     */
    public function generaCodigoSucursal($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strRemitente       = 'notificaciones@bitte.app';
        $objResponse        = new Response;
        $strRespuesta       = '';
        $arrayParametros    = array();
        $strStatus          = 400;
        $strMensajeError    = '';
        $boolSucces         = true;
        $em                 = $this->getDoctrine()->getManager();
        try
        {
            $arraySucursal = $this->getDoctrine()->getRepository(InfoSucursal::class)->getSucursales();
            foreach ($arraySucursal["resultados"] as $item)
            {
                $objSucursal = $this->getDoctrine()->getRepository(InfoSucursal::class)->find($item["ID_SUCURSAL"]);
                if(!is_object($objSucursal) || empty($objSucursal))
                {
                    throw new \Exception('No existe la sucursal con la descripción enviada por parámetro.');
                }
                $strAsunto        = 'CODIGO GENERADO';
                $strCodigo        = substr(uniqid(rand(), true), 4, 4);
                $strDia           = date("d");
                $strAnio          = date("Y");
                $strMes           = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"][date("n") - 1];
                /*$strMensajeCorreo = '
                <div class="">Hola '.$item["NOMBRE_COMERCIAL"].'&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">C&oacute;digo del '.$strDia.'/'.$strMes.'/'.$strAnio.': <strong>'.$strCodigo.'</strong>.&nbsp;</div>
                <div class="">Sucursal: <strong>'.$item["DESCRIPCION"].'</strong>.&nbsp;</div>
                <div class="">Este c&oacute;digo es para comensales qu&eacute; prefieren no habilitar el GPS en su dispositivo m&oacute;vil y le van a solicitar al restaurante este c&oacute;digo para poder tomar foto, calificar y compartir la foto en redes sociales. De esta manera podr&aacute;n ganar puntos por consumir en su restaurante.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div style=\"font-family:Varela Round\"><b>Enjoy your Bitte</b>&nbsp;</div>
                <div class="">&nbsp;</div>';
                $arrayParametros  = array('strAsunto'        => $strAsunto,
                                          'strMensajeCorreo' => $strMensajeCorreo,
                                          'strRemitente'     => $strRemitente,
                                          'strDestinatario'  => $item["CORREO"]);
                $objController    = new DefaultController();
                $objController->setContainer($this->container);
                $strMensajeError = $objController->enviaCorreo($arrayParametros);*/

                $objSucursal->setCODIGO_DIARIO($strCodigo);
                $em->persist($objSucursal);
                $em->flush();
            }
        }
        catch(\Exception $ex)
        {
            $strStatus       = 404;
            $boolSucces      = false;
            $strMensajeError = "Fallo al generar el correo, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getCiudad'.
     * 
     * Función encargada de retornar el listado de ciudades.
     *
     * @author Kevin Baque
     * @version 1.0 15-06-2021
     *
     * @return array  $objResponse
     */
    public function getCiudad($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado             = $arrayData['strEstado'] ? $arrayData['strEstado']:'ACTIVO';
        $intCiudad             = $arrayData['intCiudad'] ? $arrayData['intCiudad']:'';
        $strProvincia          = $arrayData['strProvincia'] ? $arrayData['strProvincia']:'';
        $arrayCiudad           = array();
        $strMensajeError       = '';
        $strStatus             = 200;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        $boolSucces            = true;
        try
        {
            $arrayParametros = array('strEstado'   => $strEstado,
                                     'idCiudad'    => $intCiudad,
                                     'idProvincia' => $strProvincia);
            $arrayCiudad     = $this->getDoctrine()
                                    ->getRepository(InfoRestaurante::class)
                                    ->getCiudadPorRestaurante($arrayParametros);
            if(isset($arrayCiudad['error']) && !empty($arrayCiudad['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayCiudad['error']);
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayCiudad['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayCiudad,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'canjearCupon'.
     * 
     * Función encargada de canjear cupón.
     *
     * @author Kevin Baque
     * @version 1.0 19-06-2021
     *
     * @author Kevin Baque
     * @version 1.1 19-06-2021 - Se agrega lógica para tipo de cupon en restaurantes.
     *
     * @author Kevin Baque
     * @version 1.2 11-11-2021 - Se agrega lógica para tipo de cupon premio especial.
     *
     * @return array  $objResponse
     */
    public function canjearCupon($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente          = $arrayData['intIdCliente'] ? $arrayData['intIdCliente']:'';
        $intIdRestaurante      = $arrayData['intIdRestaurante'] ? $arrayData['intIdRestaurante']:'';
        $strCupon              = $arrayData['strCupon'] ? $arrayData['strCupon']:'';
        $strUsuarioCreacion    = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $strDatetimeActual     = new \DateTime('now');
        $arrayRespuesta        = array();
        $strStatus             = 200;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        $boolSucces            = true;
        $strMensaje            = "Cupón canjeado con éxito";
        $intCantPuntos         = 0;
        $intCantidadPuntos     = 0;
        try
        {
            if(empty($intIdCliente) || empty($strCupon) || empty($strUsuarioCreacion) || empty($intIdRestaurante))
            {
                throw new \Exception('Id cliente, cupón, usuario creación, id restaurante son campos obligatorios para realizar la transacción.');
            }
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->find($intIdCliente);
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe cliente con el identificador enviado por parámetro.');
            }
            $objCupon = $this->getDoctrine()
                             ->getRepository(InfoCupon::class)
                             ->findOneBy(array("CUPON"  => strtolower($strCupon),
                                               "ESTADO" => "ACTIVO"));
            if(!is_object($objCupon) || empty($objCupon))
            {
                throw new \Exception("No existe Cupón válido");
            }
            $objRestaurante    = $this->getDoctrine()
                                      ->getRepository(InfoRestaurante::class)
                                      ->find($intIdRestaurante);
            if(!is_object($objRestaurante) || empty($objRestaurante))
            {
                throw new \Exception('No existe Restaurante con los parámetros enviados.');
            }
            /**
             * Bloque que valida si el cupon es de tipo general/restaurante o único/restaurante o general/promoción.
             */
            if($objCupon->getTIPOCUPONID()->getDESCRIPCION() == "GENERAL_RESTAURANTE")
            {
                $objCuponRes  = $this->getDoctrine()
                                     ->getRepository(InfoCuponRestaurante::class)
                                     ->findOneBy(array("CUPON_ID"       => $objCupon->getId(),
                                                       "RESTAURANTE_ID" => $objRestaurante->getId(),
                                                       "ESTADO"         => "ACTIVO"));
                if(!is_object($objCuponRes) && empty($objCuponRes))
                {
                    throw new \Exception("Cupón no válido.");
                }
                //[INI] Regla: No se permite ingresar más de un cupón en el mismo restaurante.
                $arrayVigenciaCupon = $this->getDoctrine()
                                           ->getRepository(InfoCuponHistorial::class)
                                           ->getVigenciaCuponHist(array('intIdCliente'     => $intIdCliente,
                                                                        'intIdRestaurante' => $intIdRestaurante));
                if(isset($arrayVigenciaCupon['error']) && !empty($arrayVigenciaCupon['error']))
                {
                    throw new \Exception($arrayVigenciaCupon['error']);
                }
                if(isset($arrayVigenciaCupon['resultados']) && intval($arrayVigenciaCupon['resultados'][0]['CANTIDAD']) >0 )
                {
                    throw new \Exception("Estimado, Usted ya ingreso un cupón, debe esperar 7 días para ingresar un nuevo cupón!");
                }
                //[FIN] Regla: No se permite ingresar más de un cupón en el mismo restaurante.
                $objCuponHist = $this->getDoctrine()
                                     ->getRepository(InfoCuponHistorial::class)
                                     ->findOneBy(array("CUPON_ID"       => $objCupon->getId(),
                                                       "CLIENTE_ID"     => $objCliente->getId(),
                                                       "RESTAURANTE_ID" => $objRestaurante->getId(),
                                                       "ESTADO"         => "CANJEADO"));
                if(is_object($objCuponHist) && !empty($objCuponHist))
                {
                    throw new \Exception("Cupón no válido, ya a sido canjeado.");
                }
                $entityCuponHistorial = new InfoCuponHistorial();
                $entityCuponHistorial->setESTADO("CANJEADO");
                $entityCuponHistorial->setCUPONID($objCupon);
                $entityCuponHistorial->setCLIENTEID($objCliente);
                $entityCuponHistorial->setRESTAURANTEID($objRestaurante);
                $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                $entityCuponHistorial->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponHistorial);
                $em->flush();
            }
            else if($objCupon->getTIPOCUPONID()->getDESCRIPCION() == "UNICO_RESTAURANTE")
            {
                $objCuponRes  = $this->getDoctrine()
                                     ->getRepository(InfoCuponRestaurante::class)
                                     ->findOneBy(array("CUPON_ID"       => $objCupon->getId(),
                                                       "RESTAURANTE_ID" => $objRestaurante->getId(),
                                                       "ESTADO"         => "ACTIVO"));
                if(!is_object($objCuponRes) && empty($objCuponRes))
                {
                    throw new \Exception("Cupón no válido.");
                }
                //[INI] Regla: No se permite ingresar más de un cupón en el mismo restaurante.
                $arrayVigenciaCupon = $this->getDoctrine()
                                           ->getRepository(InfoCuponHistorial::class)
                                           ->getVigenciaCuponHist(array('intIdCliente'     => $intIdCliente,
                                                                        'intIdRestaurante' => $intIdRestaurante));
                if(isset($arrayVigenciaCupon['error']) && !empty($arrayVigenciaCupon['error']))
                {
                    throw new \Exception($arrayVigenciaCupon['error']);
                }
                if(isset($arrayVigenciaCupon['resultados']) && intval($arrayVigenciaCupon['resultados'][0]['CANTIDAD']) >0 )
                {
                    throw new \Exception("Estimado, Usted ya ingreso un cupón, debe esperar 7 días para ingresar un nuevo cupón!");
                }
                //[FIN] Regla: No se permite ingresar más de un cupón en el mismo restaurante.
                $objCupon->setESTADO("CANJEADO");
                $em->persist($objCupon);
                $em->flush();
                $entityCuponHistorial = new InfoCuponHistorial();
                $entityCuponHistorial->setESTADO("CANJEADO");
                $entityCuponHistorial->setCUPONID($objCupon);
                $entityCuponHistorial->setCLIENTEID($objCliente);
                $entityCuponHistorial->setRESTAURANTEID($objRestaurante);
                $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                $entityCuponHistorial->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponHistorial);
                $em->flush();
            }
            else if($objCupon->getTIPOCUPONID()->getDESCRIPCION() == "GENERAL")
            {
                $objCuponHist = $this->getDoctrine()
                                     ->getRepository(InfoCuponHistorial::class)
                                     ->findOneBy(array("CUPON_ID"   => $objCupon->getId(),
                                                       "CLIENTE_ID" => $objCliente->getId(),
                                                       "ESTADO"     => "CANJEADO"));
                if(is_object($objCuponHist) && !empty($objCuponHist))
                {
                    throw new \Exception("Cupón no válido, ya a sido canjeado.");
                }
                $entityCuponHistorial = new InfoCuponHistorial();
                $entityCuponHistorial->setESTADO("CANJEADO");
                $entityCuponHistorial->setCUPONID($objCupon);
                $entityCuponHistorial->setCLIENTEID($objCliente);
                $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                $entityCuponHistorial->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponHistorial);
                $em->flush();
            }
            else if($objCupon->getTIPOCUPONID()->getDESCRIPCION() == "UNICO")
            {
                $objCupon->setESTADO("CANJEADO");
                $em->persist($objCupon);
                $em->flush();
                $entityCuponHistorial = new InfoCuponHistorial();
                $entityCuponHistorial->setESTADO("CANJEADO");
                $entityCuponHistorial->setCUPONID($objCupon);
                $entityCuponHistorial->setCLIENTEID($objCliente);
                $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                $entityCuponHistorial->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponHistorial);
                $em->flush();
            }
            else if($objCupon->getTIPOCUPONID()->getDESCRIPCION() == "EMPRESARIAL")
            {
                /**
                 * Empleado del mes: me dan un cupón en cualquier restaurante, 
                 * voy a puntos ingreso cupón, me debe aparecer en promociones, 
                 * "*Consumo por empleado del mes*"
                 */
                $strDescrPromocion = "*Consumo por empleado del mes*";
                $objCupon->setESTADO("CANJEADO");
                $em->persist($objCupon);
                $em->flush();
                $arrayPromocion = $this->getDoctrine()
                                       ->getRepository(InfoPromocion::class)
                                       ->findBy(array("ESTADO"                   => "ACTIVO",
                                                      "PREMIO"                   => "NO",
                                                      "DESCRIPCIONTIPOPROMOCION" => $strDescrPromocion,
                                                      "RESTAURANTE_ID"           => $intIdRestaurante));
                if(empty($arrayPromocion) || !is_array($arrayPromocion))
                {
                    $entityPromocion = new InfoPromocion();
                    $entityPromocion->setRESTAURANTEID($objRestaurante);
                    $entityPromocion->setDESCRIPCIONTIPOPROMOCION($strDescrPromocion);
                    $entityPromocion->setIMAGEN($objCupon->getIMAGEN());
                    $entityPromocion->setPREMIO("NO");
                    $entityPromocion->setCANTIDADPUNTOS(0);
                    $entityPromocion->setACEPTAGLOBAL('');
                    $entityPromocion->setESTADO("ACTIVO");
                    $entityPromocion->setCODIGO("NO");
                    $entityPromocion->setUSRCREACION($strUsuarioCreacion);
                    $entityPromocion->setFECREACION($strDatetimeActual);
                    $em->persist($entityPromocion);
                    $em->flush();

                    $entityAdmiParametro = new AdmiParametro();
                    $entityAdmiParametro->setDESCRIPCION("PROMOCION_ESPECIAL");
                    $entityAdmiParametro->setVALOR1($entityPromocion->getId());
                    $entityAdmiParametro->setVALOR2($intIdRestaurante);
                    $entityAdmiParametro->setVALOR3($strDescrPromocion);
                    $entityAdmiParametro->setESTADO("ACTIVO");
                    $entityAdmiParametro->setUSRCREACION($strUsuarioCreacion);
                    $entityAdmiParametro->setFECREACION($strDatetimeActual);
                    $em->persist($entityAdmiParametro);
                    $em->flush();
                }
                $entityCuponHistorial = new InfoCuponHistorial();
                $entityCuponHistorial->setESTADO("PEND-PROMOCION");
                $entityCuponHistorial->setCUPONID($objCupon);
                $entityCuponHistorial->setCLIENTEID($objCliente);
                $entityCuponHistorial->setRESTAURANTEID($objRestaurante);
                $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                $entityCuponHistorial->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponHistorial);
                $em->flush();
                //Envío de notificaciones a Massvision
                $strAsunto        = "¡CUPÓN CANJEADO!";
                $strNombreUsuario = $objCliente->getNOMBRE() .' '.$objCliente->getAPELLIDO();
                $strMensajeCorreo = '
                <div class="">Estimados &nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Se notifica que el cliente: '.$strNombreUsuario.', acaba de canjear el cupón: '.$objCupon->getCUPON().', en el restaurante: '.$objRestaurante->getNOMBRECOMERCIAL().'&nbsp;</div>
                <div class="">&nbsp;</div>
                <div style=\"font-family:Varela Round\"><b>Enjoy your Bitte</b>&nbsp;</div>
                <div class="">&nbsp;</div>';
                $strRemitente     = 'notificaciones@bitte.app';
                $arrayParametros  = array('strAsunto'        => $strAsunto,
                                          'strMensajeCorreo' => $strMensajeCorreo,
                                          'strRemitente'     => $strRemitente,
                                          'strDestinatario'  => array('bespinel@massvision.tv', 'pchiquito@massvision.ec', 'baquekevin@hotmail.com'));
                $objController    = new DefaultController();
                $objController->setContainer($this->container);
                $objController->enviaCorreo($arrayParametros);
                //Envío de notificaciones al Restaurante
                $strMensajeCorreo = '
                <div class="">Estimados &nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Estimado restaurante '.$objRestaurante->getNOMBRECOMERCIAL().', un usuario activó un consumo en su restaurante, &nbsp;</div>
                <div class="">por favor proceda a emitir factura por el valor de: $'.$objCupon->getPRECIO().', a nombre de la empresa IMFAD S.A. Ruc: 0992422718001 &nbsp;</div>
                <div class="">&nbsp;</div>
                <div style=\"font-family:Varela Round\"><b>Enjoy your Bitte</b>&nbsp;</div>
                <div class="">&nbsp;</div>';
                $arrayParametros  = array('strAsunto'        => $strAsunto,
                                          'strMensajeCorreo' => $strMensajeCorreo,
                                          'strRemitente'     => $strRemitente,
                                          'strDestinatario'  => array('bespinel@massvision.tv', 'pchiquito@massvision.ec', 'baquekevin@hotmail.com'));
                $objController    = new DefaultController();
                $objController->setContainer($this->container);
                $objController->enviaCorreo($arrayParametros);
                $strMensaje = "Cupón canjeado con éxito, por favor espere 24 horas para acercarse al restaurante y canjear la promoción: 'Consumo del empleado del mes'.";
            }
            else if($objCupon->getTIPOCUPONID()->getDESCRIPCION() == "GENERAL_PREMIO_ESPECIAL")
            {
                $objCuponHist = $this->getDoctrine()
                                     ->getRepository(InfoCuponHistorial::class)
                                     ->findOneBy(array("CUPON_ID"   => $objCupon->getId(),
                                                       "CLIENTE_ID" => $objCliente->getId(),
                                                       "ESTADO"     => "CANJEADO"));
                if(is_object($objCuponHist) && !empty($objCuponHist))
                {
                    throw new \Exception("Cupón no válido, ya a sido canjeado.");
                }
                $entityCuponHistorial = new InfoCuponHistorial();
                $entityCuponHistorial->setESTADO("CANJEADO");
                $entityCuponHistorial->setCUPONID($objCupon);
                $entityCuponHistorial->setCLIENTEID($objCliente);
                $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                $entityCuponHistorial->setFECREACION($strDatetimeActual);
                $objRelCuponPromocion = $this->getDoctrine()
                                             ->getRepository(InfoCuponPromocion::class)
                                             ->findOneBy(array("CUPON_ID"   => $objCupon->getId(),
                                                               "ESTADO"     => "ACTIVO"));
                if(!is_object($objRelCuponPromocion) || empty($objRelCuponPromocion))
                {
                    throw new \Exception("Cupón no válido.");
                }
                if($objRelCuponPromocion->getPROMOCIONID()->getRESTAURANTEID()->getid() != $intIdRestaurante)
                {
                    throw new \Exception("Cupón no válido, para el restaurante seleccionado.");
                }
                $entityCuponPromocionClt = new InfoCuponPromocionClt();
                $entityCuponPromocionClt->setPROMOCIONID($objRelCuponPromocion->getPROMOCIONID());
                $entityCuponPromocionClt->setCUPONID($objCupon);
                $entityCuponPromocionClt->setCLIENTEID($objCliente);
                $entityCuponPromocionClt->setESTADO("PENDIENTE");
                $objFechaVigencia     = new \DateTime('now');
                $objFechaVigencia->add(new \DateInterval("P".intval($objCupon->getDIAVIGENTE())."D"));
                $entityCuponPromocionClt->setFEVIGENCIA($objFechaVigencia);
                $entityCuponPromocionClt->setUSRCREACION($strUsuarioCreacion);
                $entityCuponPromocionClt->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponHistorial);
                $em->flush();
                $em->persist($entityCuponPromocionClt);
                $em->flush();
                $strMensaje = "Cupón canjeado con éxito, la fecha de vencimiento para canjear la promoción'".
                               $objRelCuponPromocion->getPROMOCIONID()->getDESCRIPCIONTIPOPROMOCION()."' es:".$objFechaVigencia->format('d/m/Y H:i');
            }
            else if($objCupon->getTIPOCUPONID()->getDESCRIPCION() == "UNICO_PREMIO_ESPECIAL")
            {
                $objCupon->setESTADO("CANJEADO");
                $entityCuponHistorial = new InfoCuponHistorial();
                $entityCuponHistorial->setESTADO("CANJEADO");
                $entityCuponHistorial->setCUPONID($objCupon);
                $entityCuponHistorial->setCLIENTEID($objCliente);
                $entityCuponHistorial->setUSRCREACION($strUsuarioCreacion);
                $entityCuponHistorial->setFECREACION($strDatetimeActual);
                $objRelCuponPromocion = $this->getDoctrine()
                                             ->getRepository(InfoCuponPromocion::class)
                                             ->findOneBy(array("CUPON_ID"   => $objCupon->getId(),
                                                               "ESTADO"     => "ACTIVO"));
                if(!is_object($objRelCuponPromocion) || empty($objRelCuponPromocion))
                {
                    throw new \Exception("Cupón no válido.");
                }
                if($objRelCuponPromocion->getPROMOCIONID()->getRESTAURANTEID()->getid() != $intIdRestaurante)
                {
                    throw new \Exception("Cupón no válido, para el restaurante seleccionado.");
                }
                $entityCuponPromocionClt = new InfoCuponPromocionClt();
                $entityCuponPromocionClt->setPROMOCIONID($objRelCuponPromocion->getPROMOCIONID());
                $entityCuponPromocionClt->setCUPONID($objCupon);
                $entityCuponPromocionClt->setCLIENTEID($objCliente);
                $entityCuponPromocionClt->setESTADO("PENDIENTE");
                $objFechaVigencia     = new \DateTime('now');
                $objFechaVigencia->add(new \DateInterval("P".intval($objCupon->getDIAVIGENTE())."D"));
                $entityCuponPromocionClt->setFEVIGENCIA($objFechaVigencia);
                $entityCuponPromocionClt->setUSRCREACION($strUsuarioCreacion);
                $entityCuponPromocionClt->setFECREACION($strDatetimeActual);
                $em->persist($entityCuponHistorial);
                $em->flush();
                $em->persist($objCupon);
                $em->flush();
                $em->persist($entityCuponPromocionClt);
                $em->flush();
                $strMensaje = "Cupón canjeado con éxito, la fecha de vencimiento para canjear la promoción'".
                               $objRelCuponPromocion->getPROMOCIONID()->getDESCRIPCIONTIPOPROMOCION()."' es:".$objFechaVigencia->format('d/m/Y H:i');
            }
            else
            {
                throw new \Exception("Cupón no válido.");
            }
            $intCantPuntos     = intval($objCupon->getVALOR());
            $intCantidadPuntos = 0;
            $objInfoCltPunto   = $this->getDoctrine()
                                      ->getRepository(InfoClientePunto::class)
                                      ->findOneBy(array('CLIENTE_ID'     => $objCliente->getId(),
                                                        'RESTAURANTE_ID' => $intIdRestaurante,
                                                        'ESTADO'         => 'ACTIVO'));
            if(!empty($objInfoCltPunto) && is_object($objInfoCltPunto) && $intCantPuntos > 0)
            {
                $intCantidadPuntos = $intCantPuntos + intval($objInfoCltPunto->getCANTIDADPUNTOS());
                $objInfoCltPunto->setCANTIDADPUNTOS($intCantidadPuntos);
                $em->persist($objInfoCltPunto);
                $em->flush();
            }
            else
            {
                if($intCantPuntos > 0)
                {
                    $intCantidadPuntos = $intCantPuntos;
                    $entityCltPunto = new InfoClientePunto();
                    $entityCltPunto->setCLIENTEID($objCliente);
                    $entityCltPunto->setRESTAURANTEID($objRestaurante);
                    $entityCltPunto->setCANTIDADPUNTOS($intCantPuntos);
                    $entityCltPunto->setESTADO("ACTIVO");
                    $entityCltPunto->setUSRCREACION($strUsuarioCreacion);
                    $entityCltPunto->setFECREACION($strDatetimeActual);
                    $em->persist($entityCltPunto);
                    $em->flush();
                }
            }
            if($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces = false;
            $strStatus  = 204;
            $strMensaje = ($ex->getMessage() != "") ? $ex->getMessage() : "Falló al canjear el cupón";
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
        }
        $objResponse->setContent(json_encode(array('status'             => $strStatus,
                                                   'resultado'          => $strMensaje,
                                                   'intCantCltPuntos'   => $intCantidadPuntos,
                                                   'intCantCuponPuntos' => $intCantPuntos,
                                                   'succes'             => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getClienteEncuestaPorRangoDia'.
     * 
     * Función encargada de retornar si el cliente tiene encuestas pendientes
     *
     * @author Kevin Baque
     * @version 1.0 10-07-2021
     *
     * @return array  $objResponse
     */
    public function getClienteEncuestaPorRangoDia($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente          = $arrayData['intIdCliente'] ? $arrayData['intIdCliente']:'';
        $arrayRespuesta        = array();
        $arrayCltEncuesta      = array();
        $arrayContenido        = array();
        $strMensajeError       = '';
        $strStatus             = 200;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        $boolSucces            = true;
        try
        {
            $arrayParametros  = array('intIdCliente' => $intIdCliente,
                                      'intCantDia'   => 30);
            $arrayCltEncuesta = $this->getDoctrine()
                                     ->getRepository(InfoClienteEncuesta::class)
                                     ->getClienteEncuestaPorRangoDia($arrayParametros);
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 204;
                throw new \Exception($arrayRespuesta['error']);
            }
            $arrayContenido = $this->getDoctrine()
                                   ->getRepository(InfoClienteEncuesta::class)
                                   ->getClienteContenidoPorRangoDia($arrayParametros);
            if(isset($arrayContenido['error']) && !empty($arrayContenido['error']))
            {
                $strStatus  = 204;
                throw new \Exception($arrayRespuesta['error']);
            }
            $arrayRespuesta["resultados"] = array_merge($arrayContenido["resultados"],$arrayCltEncuesta["resultados"]);
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'numCalificaciones' => (!empty($arrayContenido["resultados"])) ? count($arrayContenido["resultados"]): 0,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * Documentación para la función 'getContenido'.
     * 
     * Función encargada de retornar la imagen del contenido.
     *
     * @author Kevin Baque
     * @version 1.0 19-07-2021
     *
     * @return array  $objResponse
     */
    public function getContenido($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdContenido        = $arrayData['intIdContenido'] ? $arrayData['intIdContenido']:'';
        $arrayRespuesta        = array();
        $strMensajeError       = '';
        $strStatus             = 200;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        $boolSucces            = true;
        try
        {
            $objController = new DefaultController();
            $objController->setContainer($this->container);
            $objContenido  = $this->getDoctrine()
                                  ->getRepository(InfoContenidoSubido::class)
                                  ->find($intIdContenido);

            if(empty($objContenido) && !is_object($objContenido))
            {
                $strStatus  = 204;
                throw new \Exception("No existe información con los parámetros enviados.");
            }
            $arrayRespuesta['resultados'][] = array("IMAGEN"=>(!empty($objContenido->getIMAGEN())) ? $objController->getImgBase64($objContenido->getIMAGEN()):"");
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayRespuesta['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayRespuesta,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getBanner'
     *
     * Método encargado de retornar todos los banner según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 28-07-2021
     * 
     * @return array  $objResponse
     */
    public function getBanner($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdBanner          = $arrayData['intIdBanner']        ? $arrayData['intIdBanner']:'';
        $strDescripcion       = $arrayData['strDescripcion']     ? $arrayData['strDescripcion']:'';
        $strEstado            = $arrayData['strEstado']          ? $arrayData['strEstado']:'';
        $strUsuarioCreacion   = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $arrayRespuesta       = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        try
        {
            $objController = new DefaultController();
            $objController->setContainer($this->container);
            $arrayParametros = array('intIdBanner'    => $intIdBanner,
                                     'strDescripcion' => $strDescripcion,
                                     'strEstado'      => $strEstado);
            $arrayBanner     = $this->getDoctrine()
                                    ->getRepository(InfoBanner::class)
                                    ->getBannerCriterioMovil($arrayParametros);
            if(!empty($arrayBanner["error"]))
            {
                throw new \Exception($arrayBanner['error']);
            }
            foreach($arrayBanner['resultados'] as &$arrayItemBanner)
            {
                $arrayRespuesta ['resultados'] []= array('intIdBanner'         =>   $arrayItemBanner['ID_BANNER'],
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
     * Documentación para la función 'getSucursalPorRestaurante'
     *
     * Método encargado de retornar todos las sucursales según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 27-07-2021
     * 
     * @return array  $objResponse
     */
    public function getSucursalPorRestaurante($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdRestaurante   = $arrayData['intIdRestaurante']   ? $arrayData['intIdRestaurante']:'';
        $strEstado          = $arrayData['strEstado']          ? $arrayData['strEstado']:'ACTIVO';
        $strUsuarioCreacion = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $arrayRespuesta     = array();
        $strMensajeError    = '';
        $strStatus          = 200;
        $objResponse        = new Response;
        try
        {
            $objSucursal = $this->getDoctrine()
                                ->getRepository(InfoSucursal::class)
                                ->findBy(array("RESTAURANTEID"     => $intIdRestaurante,
                                               "ESTADOFACTURACION" => $strEstado),
                                         array("DESCRIPCION" => "ASC"));
            foreach($objSucursal as $objItem)
            {
                $arrayRespuesta ['resultados'] []= array('intIdSucursal'        => $objItem->getId(),
                                                         'strDescripcion'       => $objItem->getDESCRIPCION(),
                                                         'strEstadoFacturacion' => $objItem->getESTADOFACTURACION(),
                                                         'strNumContacto'       => $objItem->getNUMEROCONTACTO(),
                                                         'strDireccion'         => $objItem->getDIRECCION());
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
     * Documentación para la función 'getClienteEncuesta'.
     * 
     * Función encargada de retornar las respuesta de la encuesta.
     *
     * @author Kevin Baque
     * @version 1.0 30-08-2021
     *
     * @return array  $objResponse
     */
    public function getClienteEncuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCltEncuesta      = $arrayData['intIdCltEncuesta'] ? $arrayData['intIdCltEncuesta']:'';
        $arrayRespuesta        = array();
        $strMensajeError       = '';
        $strStatus             = 200;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        $boolSucces            = true;
        try
        {
            $objCltEncuesta = $this->getDoctrine()
                                   ->getRepository(InfoClienteEncuesta::class)
                                   ->find($intIdCltEncuesta);
            if(!is_object($objCltEncuesta) || empty($objCltEncuesta))
            {
                throw new \Exception("No existe encuesta con los parámetros enviados.");
            }
            $arrayInfoRespuesta = $this->getDoctrine()
                                       ->getRepository(InfoRespuesta::class)
                                       ->findBy(array("CLT_ENCUESTA_ID" => $intIdCltEncuesta));
            if(!is_array($arrayInfoRespuesta) || empty($arrayInfoRespuesta))
            {
                throw new \Exception("No existe respuestas con los parámetros enviados.");
            }
            foreach($arrayInfoRespuesta as $arrayItem)
            {
                $arrayRespuesta['resultados'][] = array("idPregunta"      => $arrayItem->getPREGUNTAID()->getId(),
                                                        "descripcion"     => $arrayItem->getPREGUNTAID()->getDESCRIPCION(),
                                                        "obligatoria"     => $arrayItem->getPREGUNTAID()->getOBLIGATORIA(),
                                                        "idTipoRespuesta" => $arrayItem->getPREGUNTAID()->getOPCIONRESPUESTAID()->getId(),
                                                        "tipoRespuesta"   => $arrayItem->getPREGUNTAID()->getOPCIONRESPUESTAID()->getTIPORESPUESTA(),
                                                        "cantOpcion"      => $arrayItem->getPREGUNTAID()->getOPCIONRESPUESTAID()->getValor(),
                                                        "estado"          => $arrayItem->getPREGUNTAID()->getESTADO(),
                                                        "idRespuesta"     => $arrayItem->getId(),
                                                        "respuesta"       => $arrayItem->getRespuesta());
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
     * Documentación para la función 'editRespuesta'.
     * 
     * Función encargada de retornar las respuesta de la encuesta.
     *
     * @author Kevin Baque
     * @version 1.0 30-08-2021
     *
     * @return array  $objResponse
     */
    public function editRespuesta($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayInfoRespuesta    = $arrayData['arrayRespuesta'] ? $arrayData['arrayRespuesta']:'';
        $arrayRespuesta        = array();
        $strMensajeError       = "Respuesta editada con éxito.";
        $strStatus             = 200;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        $boolSucces            = true;
        try
        {
            foreach ($arrayInfoRespuesta as $intIdRespuesta => $strRespuesta) 
            {
                $objRespuesta = $this->getDoctrine()
                                     ->getRepository(InfoRespuesta::class)
                                     ->find($intIdRespuesta);
                if(!is_object($objRespuesta) || empty($objRespuesta))
                {
                    throw new \Exception('No existe la respuesta con la descripción enviada por parámetro.');
                }
                $objRespuesta->setRESPUESTA($strRespuesta);
                $em->persist($objRespuesta);
                $em->flush();
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces      = false;
            $strMensajeError = $ex->getMessage();
            $strStatus       = 204;
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
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * Documentación para la función 'getSucursalPorUsuario'
     * Función encargada de retornar las sucursales con el tipo de promoción encuesta.
     * 
     * @author Kevin Baque
     * @version 1.0 24-03-2023
     * 
     * @return array  $objResponse
     *
     * @author Kevin Baque
     * @version 1.1 20-06-2023 - De acuerdo a lo solicitado por el cliente, en el móvil se debe presentar el nombre de sucursal
     *                           y para ello se realiza el cambio de nombre comercial que retorne el nombre de la sucursal
     * 
     */
    public function getSucursalPorUsuario($arrayData)
    {
        $intIdCliente       = $arrayData['intIdCliente'] ? $arrayData['intIdCliente']:'';
        $strMensaje         = '';
        $arraySucursal      = array();
        $strStatus          = 200;
        $strSucces          = true;
        $objResponse        = new Response;
        try
        {
            $arraySucursalPorClt = $this->getDoctrine()
                                        ->getRepository(InfoSucursal::class)
                                        ->findBy(array("CLIENTE_ID"        => $intIdCliente,
                                                       "ESTADO"            => "ACTIVO"),
                                                       array('DESCRIPCION' => "ASC"));
            if(!empty($arraySucursalPorClt) && is_array($arraySucursalPorClt))
            {
                //Obtenemos el tipo de promoción Encuesta
                $objTipoPromocion = $this->getDoctrine()
                                         ->getRepository(AdmiTipoPromocion::class)
                                         ->findOneBy(array("DESCRIPCION"     =>"ENCUESTA",
                                                           "ESTADO" =>'ACTIVO'));
                if(!is_object($objTipoPromocion) || empty($objTipoPromocion))
                {
                    throw new \Exception('No existe el tipo de promoción "Encuesta" enviado por parámetro.');
                }
                foreach($arraySucursalPorClt as $arraySucursalItem)
                {
                    //Buscamos una promoción de tipo encuesta con el restaurante en sesión
                    $objPromocion = $this->getDoctrine()
                                         ->getRepository(InfoPromocion::class)
                                         ->findOneBy(array("ESTADO"          => "ACTIVO",
                                                           "TIPOPROMOCIONID" => $objTipoPromocion->getId(),
                                                           "RESTAURANTE_ID"  => $arraySucursalItem->getRESTAURANTEID()->getId()));
                    $strDescripcionPromocion = (!empty($objPromocion) && is_object($objPromocion)) ?$objPromocion->getDESCRIPCIONTIPOPROMOCION():"";
                    $strMensajeMovil         = "Ingrese su correo electrónico para obtener un cupón";
                    /**
                     * El cliente solicitó que en el móvil se debe presentar el nombre de la sucursal por ende se realiza el sgte. cambio:
                     * Sucursal retorna el nombre comercial
                     * Nombre Comercial retorna el nombre de la sucursal
                     */
                    $arraySucursal[] = array("idSucursal"        => $arraySucursalItem->getId(),
                                             "sucursal"          => $arraySucursalItem->getRESTAURANTEID()->getNOMBRECOMERCIAL(),
                                             "idRestaurante"     => $arraySucursalItem->getRESTAURANTEID()->getId(),
                                             "nombreComercial"   => $arraySucursalItem->getDESCRIPCION(),
                                             "estado"            => $arraySucursalItem->getESTADO(),
                                             "idCentroComercial" => $arraySucursalItem->getCENTRO_COMERCIAL_ID() ? 
                                                                    $arraySucursalItem->getCENTRO_COMERCIAL_ID()->getId():"",
                                             "centroComercial"   => $arraySucursalItem->getCENTRO_COMERCIAL_ID() ?
                                                                    $arraySucursalItem->getCENTRO_COMERCIAL_ID()->getNOMBRE():"",
                                             "promocionEncuesta" => $strDescripcionPromocion,
                                             "admiteCupon"       => (!empty($strDescripcionPromocion) && $strDescripcionPromocion!="") ?"Si":"No",
                                             "mensajeMovil"      => (!empty($strDescripcionPromocion) && $strDescripcionPromocion!="") ?$strMensajeMovil:""
                                            );
                }
            }
            else
            {
                $strStatus  = 404;
                $strSucces  = false;
                throw new \Exception("No existe sucursales asociadas al cliente enviado por parámetro.");
            }
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            $strMensaje = $ex->getMessage();
            $arrayCliente['error'] = $strMensaje;
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'sucursal'  => $arraySucursal,
                                                   'succes'    => $strSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

}
