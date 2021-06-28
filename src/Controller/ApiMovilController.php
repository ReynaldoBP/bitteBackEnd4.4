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
use App\Entity\InfoCuponHistorial;
use App\Entity\InfoPlantilla;
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
        $intIdUsuario       = isset($arrayData['idUsuario']) ? $arrayData['idUsuario']:'';
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
                    $arrayParametrosUsuario = array('ESTADO' => 'ACTIVO',
                                                    'id'     => $intIdUsuario);
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
                    $entityCliente->setUSUARIOID($objUsuario);
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
                    ///$strActivaCltLocal = "http://127.0.0.1/bitteBackEnd/web/editCliente?jklasdqweuiorenm=".$strDistractor.$entityCliente->getId();
                    //$strActivaCltProd  = "http://bitte.app/bitteCore/web/editCliente?jklasdqweuiorenm=".$strDistractor.$entityCliente->getId();
                    $strActivaCltProd  = "https://bitte.app:8080/editCliente?jklasdqweuiorenm=".$strDistractor.$entityCliente->getId();
                    $strUrlTermCond    ="https://la.bitte.app/privacy-policy/";
                    $strUrlRestaurante ="https://la.bitte.app/listado-restaurantes/";
                    $strAsunto         = $strWelcome.' Usuario Bitte';

                    $strMensajeCorreo = '<div class="">Hola '.$strNombreClt.' ,</div>
                   <div class="">&nbsp;</div>
                   <div class="">FELICITACIONES!!!!&nbsp;</div>
                   <div class="">&nbsp;</div>
                   <div class="">Has logrado con &eacute;xito registrarte en Bitte. Nuestra aplicaci&oacute;n te va a permitir ganar puntos para que puedas obtener comida y bebidas gratis en nuestros restaurantes participantes.&nbsp;</div>
                   <div class="">&nbsp;</div>
                   <div><strong>Est&aacute;s a un paso de comenzar, solamente debes activar tu cuenta.&nbsp;</strong></div>
                   <div><a href='.$strActivaCltProd.' target="_blank" >Activar mi cuenta</a></div>
                   <div class="">&nbsp;</div>
                   <div class="">En Bitte es muy importante seguir las reglas para que tus puntos sean v&aacute;lidos y no los pierdas. Puedes disfrutar de nuestra aplicaci&oacute;n siguiendo estos pasos:&nbsp;</div>
                   <div class="">1. Abre la aplicaci&oacute;n y elige tomar foto. Por GPS se ubica el restaurante donde estas y se autoriza para tomar la foto.&nbsp;</div>
                   <div class="">2. Solo se aceptan fotos de platos de comida.&nbsp;</div>
                   <div class="">3. Califica tu experiencia gastron&oacute;mica - GANASTE PUNTOS. &nbsp;</div>
                   <div class="">4. Comparte en redes sociales tu imagen si lo deseas - GANAS M&Aacute;S PUNTOS&nbsp;</div>
                   <div class="">5. Acumulas y canjea tus puntos en tus restaurantes favoritos. &nbsp;</div>
                   <div class="">6. Tus puntos tienen una vigencia de 8 meses.&nbsp;</div>
                   <div class="">7. Tus puntos son v&aacute;lidos solo en el restaurante donde comiste y calificaste.&nbsp;</div>
                   <div class="">8. El restaurante tiene la potestad de eliminar tus puntos si ve que la foto no concuerda con su men&uacute;.&nbsp;</div>
                   <div class="">&nbsp;</div>
                   <div class="">Para mayor informaci&oacute;n consulta <a href='.$strUrlTermCond.' target="_blank" >aqu&iacute;</a> los t&eacute;rminos y condiciones de uso.&nbsp;</div>
                   <div class="">Para información de los restaurantes participantes has click <a href='.$strUrlRestaurante.' target="_blank" >aqu&iacute;</a>.&nbsp;</div>
                   <div class="">
                    Bitte y su red de restaurantes te invitan a que salgas a disfrutar con tu familia y/o amigos experiencias &uacute;nicas.&nbsp;</div>
                   <div class="">&nbsp;</div>
                   <div class="">
                   <div>
                   <div>&nbsp;</div>
                   </div>
                   </div>
                   <div style=\"font-family:Varela Round\"><b>Enjoy your Bitte</b>&nbsp;</div>
                   <div class="">&nbsp;</div>';

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
        error_log("Hora Actual: ".$intHoraActual.':'.$intMinActual);
        try
        {
            $arrayCltEncuesta = $this->getDoctrine()
                                     ->getRepository(InfoClienteEncuesta::class)
                                     ->getVigenciaEncuesta(array('intIdCliente'=>$intIdCliente,
                                                                 'intIdSucursal'=>$intidSucursal));
            if(isset($arrayCltEncuesta['error']) && !empty($arrayCltEncuesta['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arraySucursal['error']);
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
                if(!empty($strDiaActual) && $strDiaActual==0)//Domingo
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
            $em->getConnection()->beginTransaction();
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
                                    'strEsAfiliado'         => $strEsAfiliado
                                    );
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
        /*if($conImagen == 'SI')
        {
            foreach ($arrayRestaurante['resultados'] as &$item)
            {
                if($item['IMAGEN'])
                {
                    $item['IMAGEN'] = $objController->getImgBase64($item['IMAGEN']);
                }
            }
        }

        if($conIcono == 'SI')
        {
            foreach ($arrayRestaurante['resultados'] as &$item)
            {
                if($item['ICONO'])
                {
                    $item['ICONO'] = $objController->getImgBase64($item['ICONO']);
                }
            }
        }
        $objParametro    = $this->getDoctrine()
                                ->getRepository(AdmiParametro::class)
                                ->findOneBy(array('ESTADO'      => 'ACTIVO',
                                                  'DESCRIPCION' => 'NUM_PUBLICIDAD'));
        if(!is_object($objParametro) || empty($objParametro))
        {
            throw new \Exception('No existe parametrizado el número de publicidad.');
        }*/
        $arrayResultado = array();
        foreach($arrayRestaurante['resultados'] as &$arrayItemRestaurante)
        {
            /*if($intContadorRes == $objParametro->getVALOR1())
            {
                $arrayPublicidad = (array) $this->getDoctrine()
                                                ->getRepository(InfoPublicidad::class)
                                                ->getPublicidadCriterioMovil(array('GENERO'      => 'TODOS',
                                                                                   'ORIENTACION' => 'HORIZONTAL'));
                if(empty($arrayPublicidad))
                {
                    $arrayItemRestaurante['ES_PUBLICIDAD'] = 'N';
                }
                else
                {
                    $arrayResultado ['resultados'] []= array('NOMBRE_COMERCIAL' =>   $arrayPublicidad['resultados'][0]['DESCRIPCION'],
                                                             'ICONO'            =>   (!empty($arrayPublicidad['resultados'][0]['IMAGEN']) && $conIcono == 'SI')? $objController->getImgBase64($arrayPublicidad['resultados'][0]['IMAGEN']) :null,
                                                             'ES_PUBLICIDAD'    =>  'S');
                    $intContadorRes                  = 0;
                    if((!empty($intIdRestaurante) && !empty($intIdCliente)) && (!empty($arrayPublicidad['resultados'][0]['ID_PUBLICIDAD'])))
                    {
                        $entityVistaPubl = new InfoVistaPublicidad();
                        $entityVistaPubl->setCLIENTEID($this->getDoctrine()->getRepository(InfoCliente::class)->find($intIdCliente));
                        $entityVistaPubl->setRESTAURANTEID($this->getDoctrine()->getRepository(InfoRestaurante::class)->find($intIdRestaurante));
                        $entityVistaPubl->setPUBLICIDADID($this->getDoctrine()->getRepository(InfoPublicidad::class)->find($arrayPublicidad['resultados'][0]['ID_PUBLICIDAD']));
                        $entityVistaPubl->setESTADO(strtoupper('ACTIVO'));
                        $entityVistaPubl->setUSRCREACION($strUsuarioCreacion);
                        $entityVistaPubl->setFECREACION($strDatetimeActual);
                        $em->persist($entityVistaPubl);
                        $em->flush();
                    }
                }
            }
            $intContadorRes ++;*/
            $arraySucursal["resultados"][$intIterador]["ES_AFILIADO"] = (!empty($item["ES_AFILIADO"]) && $item["ES_AFILIADO"] == "SI") ? 'S':'N';
            $arrayResultado ['resultados'] []= array('ID_RESTAURANTE'          =>   $arrayItemRestaurante['ID_RESTAURANTE'],
                                                     'TIPO_IDENTIFICACION'     =>   $arrayItemRestaurante['TIPO_IDENTIFICACION'],
                                                     'IDENTIFICACION'          =>   $arrayItemRestaurante['IDENTIFICACION'],
                                                     'RAZON_SOCIAL'            =>   $arrayItemRestaurante['RAZON_SOCIAL'],
                                                     'NOMBRE_COMERCIAL'        =>   $arrayItemRestaurante['NOMBRE_COMERCIAL'],
                                                     'REPRESENTANTE_LEGAL'     =>   $arrayItemRestaurante['REPRESENTANTE_LEGAL'],
                                                     'TIPO_COMIDA_ID'          =>   $arrayItemRestaurante['TIPO_COMIDA_ID'],
                                                     'DESCRIPCION_TIPO_COMIDA' =>   $arrayItemRestaurante['DESCRIPCION_TIPO_COMIDA'],
                                                     'DIRECCION_TRIBUTARIO'    =>   $arrayItemRestaurante['DIRECCION_TRIBUTARIO'],
                                                     'URL_CATALOGO'            =>   $arrayItemRestaurante['URL_CATALOGO'],
                                                     'NUMERO_CONTACTO'         =>   $arrayItemRestaurante['NUMERO_CONTACTO'],
                                                     'ESTADO'                  =>   $arrayItemRestaurante['ESTADO'],
                                                     //'IMAGEN'                  =>   $arrayItemRestaurante['IMAGEN'],
                                                     'IMAGEN'                  =>   (!empty($arrayItemRestaurante['IMAGEN']) && $conImagen == 'SI')? $objController->getImgBase64($arrayItemRestaurante['IMAGEN']) :null,
                                                     'ICONO'                   =>   (!empty($arrayItemRestaurante['ICONO']) && $conIcono == 'SI')? $objController->getImgBase64($arrayItemRestaurante['ICONO']) :null,
                                                     //'ICONO'                   =>   $arrayItemRestaurante['ICONO'],
                                                     'CANT_LIKE'               =>   $arrayItemRestaurante['CANT_LIKE'],
                                                     'PRO_ENCUESTAS'           =>   $arrayItemRestaurante['PRO_ENCUESTAS'],
                                                     'ID_LIKE'                 =>   $arrayItemRestaurante['ID_LIKE'] ? $arrayItemRestaurante['ID_LIKE']:null,
                                                     'ES_PUBLICIDAD'           =>  'N',
                                                     'ES_AFILIADO'             =>  (!empty($arrayItemRestaurante["ES_AFILIADO"]) && $arrayItemRestaurante["ES_AFILIADO"] == "SI") ? 'S':'N');
        }
        $arrayResultado['error'] = $strMensajeError;
        $em->getConnection()->commit();
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayResultado,
                                            'succes'    => true
                                            )
                                        ));
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
     * Método encargado de crear todas las respuesta según los parámetros recibidos.
     * Adicional crear las relaciones entre clt. y encuestas.
     * 
     * @author Kevin Baque
     * @version 1.0 04-09-2019
     * 
     * @return array  $objResponse
     *
     * @author Kevin Baque
     * @version 1.1 03-12-2019 - Se agrega envío de correo notificando que ganó puntos
     *
     * @author Kevin Baque
     * @version 1.2 25-01-2020 - Se comenta correo por nuevas politicas.
     *
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
        $strRespuesta       = $arrayData['respuesta'] ? $arrayData['respuesta']:'';
        $arrayPregunta      = $arrayData['arrayPregunta'] ? $arrayData['arrayPregunta']:'';
        $strEstado          = $arrayData['estado'] ? $arrayData['estado']:'ACTIVO';
        $strUsuarioCreacion = $arrayData['usuarioCreacion'] ? $arrayData['usuarioCreacion']:'';
        $strDatetimeActual  = new \DateTime('now');
        $arrayRespuesta     = array();
        $strEstadoPendiente = 'PENDIENTE';//TODO kbaque: estado original pendiente
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
            $objEncuesta   = $this->getDoctrine()
                                  ->getRepository(InfoEncuesta::class)
                                  ->find($intIdEncuesta);
            if(!is_object($objEncuesta) || empty($objEncuesta))
            {
                throw new \Exception('No existe la Encuesta con la descripción enviada por parámetro.');
            }
            $objContenido    = $this->getDoctrine()
                                    ->getRepository(InfoContenidoSubido::class)
                                    ->find($intIdContenido);
            if(!is_object($objContenido) || empty($objContenido))
            {
                throw new \Exception('No existe el contenido con la descripción enviada por parámetro.');
            }
            $objParametro    = $this->getDoctrine()
                                    ->getRepository(AdmiParametro::class)
                                    ->findOneBy(array('DESCRIPCION' => 'PUNTOS_ENCUESTA',
                                                      'ESTADO'      => 'ACTIVO'));
            if(!is_object($objParametro) || empty($objParametro))
            {
                throw new \Exception('No existe puntos de encuesta con la descripción enviada por parámetro.');
            }

            $objCltEncuesta  = $this->getDoctrine()
                                        ->getRepository(InfoClienteEncuesta::class)
                                        ->getClienteEncuestaRepetida(array('intClienteId'   => $intIdCliente,
                                                                           'intSucursalId'  => $intIdSucursal,
                                                                           'intEncuestaId'  => $intIdEncuesta,
                                                                           'intContenidoId' => $intIdContenido,
                                                                           'strFecha'       => date('Y-m-d'),
                                                                           'strEstado'      => $strEstadoPendiente
                                                                          ));
           if(is_object($objCltEncuesta))
           {  
               throw new \Exception('Ya existe la encuesta.');
           }

            $intValor = $objParametro->getVALOR1();
            $arrayRestaurantes = $this->getDoctrine()
                                      ->getRepository(InfoRestaurante::class)
                                      ->getRestauranteCriterio(array('intIdRestaurante' => $objRestaurante->getId()));
            if(!empty($arrayRestaurantes) && !empty($arrayRestaurantes['resultados']))
            {
                $arrayItemRestaurante = $arrayRestaurantes['resultados'][0];
                if(!empty($arrayItemRestaurante["ES_AFILIADO"]) && isset($arrayItemRestaurante["ES_AFILIADO"]) 
                    && $arrayItemRestaurante["ES_AFILIADO"] == "NO")
                {
                    $intValor = 0;
                }
            }
            $entityCltEncuesta = new InfoClienteEncuesta();
            $entityCltEncuesta->setCLIENTEID($objCliente);
            $entityCltEncuesta->setSUCURSALID($objSucursal);
            $entityCltEncuesta->setENCUESTAID($objEncuesta);
            $entityCltEncuesta->setESTADO(strtoupper($strEstadoPendiente));
            $entityCltEncuesta->setCONTENIDOID($objContenido);
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
                    $entityRespuesta = new InfoRespuesta();
                    $entityRespuesta->setRESPUESTA($strRespuesta);
                    $entityRespuesta->setPREGUNTAID($objPregunta);
                    $entityRespuesta->setCLTENCUESTAID($objCltEncuesta);
                    $entityRespuesta->setCLIENTEID($objCliente);
                    $entityRespuesta->setESTADO(strtoupper($strEstado));
                    $entityRespuesta->setUSRCREACION($strUsuarioCreacion);
                    $entityRespuesta->setFECREACION($strDatetimeActual);
                    $em->persist($entityRespuesta);
                    $em->flush();
                    /*$arrayRespuesta ['respuesta'][] = array('idRespuesta'     => $entityRespuesta->getId(),
                                                            'intIdCltEncuesta'=> $intIdCltEncuesta,
                                                            'respuesta'       => $entityRespuesta->getRESPUESTA(),
                                                            'estadoRespuesta' => $entityRespuesta->getESTADO(),
                                                            'nombreClt'       => $entityRespuesta->getCLIENTEID()->getNOMBRE(),
                                                            'apellidoClt'     => $entityRespuesta->getCLIENTEID()->getAPELLIDO(),
                                                            'correoClt'       => $entityRespuesta->getCLIENTEID()->getCORREO(),
                                                            'direccionClt'    => $entityRespuesta->getCLIENTEID()->getDIRECCION(),
                                                            'idPregunta'      => $entityRespuesta->getPREGUNTAID()->getId(),
                                                            'preguntaDescrip' => $entityRespuesta->getPREGUNTAID()->getDESCRIPCION(),
                                                            'preguntaObl'     => $entityRespuesta->getPREGUNTAID()->getOBLIGATORIA(),
                                                            'preguntaDesc'    => $entityRespuesta->getPREGUNTAID()->getDESCRIPCION(),
                                                            'usrCreacion'     => $entityRespuesta->getUSRCREACION(),
                                                            'feModificacion'  => $entityRespuesta->getFECREACION());*/
                }
                $strMensajeError = 'Respuesta creada con exito.!';
            }
        
        /*$strAsunto            = '¡GANASTE PUNTOS!';
        $strNombreUsuario     = $objCliente->getNOMBRE() .' '.$objCliente->getAPELLIDO();
        $strMensajeCorreo = '
        <div class="">¡Hola! '.$strNombreUsuario.'.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">FELICITACIONES!!!!&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Acabas de calificar el restaurante '.$objRestaurante->getNOMBRECOMERCIAL().'.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Has ganado '.$intValor.' puntos en este establecimiento. Adem&aacute;s, has ganado un cup&oacute;n para participar en sorteo mensual del Tenedor de oro por comidas gratis de nuestros restaurantes participantes.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Al final del mes sabr&aacute;s si eres el ganador del Tenedor de Oro.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">¡Sigue disfrutando de salir a comer con tus familiares y amigos!.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Recuerda siempre usar tu app BITTE para calificar tu experiencia, compartir en tus redes sociales, ganar m&aacute;s puntos y comer gratis.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Buen provecho,&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Bitte.&nbsp;</div>
        <div class="">&nbsp;</div>';
        $strRemitente     = 'notificaciones@bitte.app';
        $arrayParametros  = array('strAsunto'        => $strAsunto,
                                  'strMensajeCorreo' => $strMensajeCorreo,
                                  'strRemitente'     => $strRemitente,
                                  'strDestinatario'  => $objCliente->getCORREO());
        $objController    = new DefaultController();
        $objController->setContainer($this->container);
        $objController->enviaCorreo($arrayParametros);*/
        
        }
        catch(\Exception $ex)
        {
            $boolSucces = false;
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError ="Fallo al crear la respuesta, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }

        $arrayRespuesta['mensaje']          = $strMensajeError;
        $arrayRespuesta['intIdCltEncuesta'] = $intIdCltEncuesta;
        $objResponse->setContent(json_encode(array(
                                                    'status'           => $strStatus,
                                                    'objSucursal'      =>$objSucursal,
                                                    'resultado'        => $arrayRespuesta,
                                                    'succes'           => $boolSucces
                                            )
                                        ));


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
                    $arrayCliente   = array('idCliente'       => $objCliente->getId(),
                                            'autenticacionRS' => $objCliente->getAUTENTICACIONRS(),
                                            'identificacion'  => $objCliente->getIDENTIFICACION(),
                                            'nombre'          => $objCliente->getNOMBRE(),
                                            'apellido'        => $objCliente->getAPELLIDO(),
                                            'correo'          => $objCliente->getCORREO(),
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
                $objPlantilla  = $this->getDoctrine()
                                      ->getRepository(InfoPlantilla::class)
                                      ->findOneBy(array('DESCRIPCION'=>"CALIFICAR_COMPARTIR",
                                                        'ESTADO'     =>"ACTIVO"));

                $strTotalPuntos       = intval($objParametroRes->getVALOR1()) + intval($intPuntosPublicacion);
                $strAsunto            = '¡GANASTE PUNTOS!';
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
                                                    'RESTAURANTE_ID' => $intIdRestaurante));
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
                                                   'VALOR2'      => $intIdRestaurante));
            if(!empty($arrayParametro) && is_array($arrayParametro))
            {
                foreach($arrayParametro as $arrayItem)
                {
                    $arrayEncuesta = $this->getDoctrine()
                                          ->getRepository(InfoClienteEncuesta::class)
                                          ->getCantEncRes(array('intIdCliente'     =>$intIdCliente,
                                                                'intIdRestaurante' =>$intIdRestaurante));
                }
                if( (!empty($arrayParametro) && is_array($arrayParametro)) && 
                    (!empty($arrayEncuesta["resultados"]) && empty($arrayEncuesta["error"])))
                {
                    $arrayTemp      = $arrayEncuesta["resultados"][0];
                    $strEsPermitido = !empty($arrayTemp["ES_PERMITIDO"]) ? $arrayTemp["ES_PERMITIDO"]:"NO";
                    $strEsCanjeado  = !empty($arrayTemp["ES_CANJEADO"]) ? $arrayTemp["ES_CANJEADO"]:"NO";
                }
            }

            foreach($objPromocion as $arrayItem)
            {
                $boolContinuar = true;
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
    
                    $arrayPromocion []= array( 'idPromocion'   => $arrayItem->getId(),
                                            'textoProceso'     => $strPromocionActiva,
                                            'descripcion'      => $arrayItem->getDESCRIPCIONTIPOPROMOCION(),
                                            'imagen'           => $strRutaImagen ? $strRutaImagen:'',
                                            'cantPuntos'       => $arrayItem->getCANTIDADPUNTOS(),
                                            'aceptaGlobal'     => $arrayItem->getACEPTAGLOBAL(),
                                            'habilitar'        => (!empty($arraySucursal["resultados"])&& isset($arraySucursal["resultados"])) ? 'SI':'NO',
                                            'estado'           => $arrayItem->getESTADO());
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
            //consultar el estado a buscar
            $arrayCltPunto = $this->getDoctrine()
                                  ->getRepository(InfoClientePunto::class)
                                  ->findBy(array('CLIENTE_ID'     => $intIdCliente,
                                                 'RESTAURANTE_ID' => $intIdRestaurante));
            if(!is_array($arrayCltPunto) || empty($arrayCltPunto))
            {
                throw new \Exception('No tiene puntaje sufuciente.');
            }
            foreach($arrayCltPunto as $arrayItem)//1REGISTRO
            {
                $intCantidadPuntos = $intCantidadPuntos + $arrayItem->getCANTIDADPUNTOS();
            }
            $objPromocion = $this->getDoctrine()
                                 ->getRepository(InfoPromocion::class)
                                 ->find($intIdPromocion);
            if(!is_object($objPromocion) || empty($objPromocion))
            {
                throw new \Exception('No existe la Promoción.');
            }
            $intCantPuntospromo = $objPromocion->getCANTIDADPUNTOS();
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
                    $strAsunto        = 'CANJEAR PROMOCION';
                    $strMensajeCorreo = '
                    <div class=""><b>¡Hola! '.$strNombreUsuario.'.</b>&nbsp;</div>
                    <div class="">&nbsp;</div>
                    <div class="">FELICITACIONES!!!!&nbsp;</div>
                    <div class="">&nbsp;</div>
                    <div class="">Acabas de canjear '.$intCantPuntospromo.' puntos en el restaurante <strong>'.$objRestaurante->getNOMBRECOMERCIAL().'</strong>.&nbsp;</div>
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
                                         'strVerBitte'       => $strVerBitte);

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
                                  ->findOneBy(array('DESCRIPCION'=>"CALIFICAR_NO_AFILIADO"));
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
            $arrayParametros = array('estado'      => $strEstado,
                                     'idCiudad'    => $intCiudad,
                                     'idProvincia' => $strProvincia);
            $arrayCiudad     = $this->getDoctrine()
                                    ->getRepository(AdmiCiudad::class)
                                    ->getCiudad($arrayParametros);
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
     * @return array  $objResponse
     */
    public function canjearCupon($arrayData)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCliente          = $arrayData['intIdCliente'] ? $arrayData['intIdCliente']:'';
        $strCupon              = $arrayData['strCupon'] ? $arrayData['strCupon']:'';
        $strUsuarioCreacion    = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:'';
        $strDatetimeActual     = new \DateTime('now');
        $arrayRespuesta        = array();
        $strStatus             = 200;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        $boolSucces            = true;
        $strMensaje            = "Cupón canjeado con éxito";
        try
        {
            if(empty($intIdCliente) || empty($strCupon) || empty($strUsuarioCreacion))
            {
                throw new \Exception('Id cliente, cupón, usuario creación son campos obligatorios para realizar la transacción.');
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
                             ->findOneBy(array("CUPON"  => $strCupon,
                                               "ESTADO" => "ACTIVO"));
            if(!is_object($objCupon) || empty($objCupon))
            {
                throw new \Exception("No existe Cupón válido");
            }
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
            $objParametroCupon = $this->getDoctrine()
                                      ->getRepository(AdmiParametro::class)
                                      ->findOneBy(array('DESCRIPCION' => 'CANT_PUNTOS_CLT_CUPON',
                                                        'ESTADO'      => 'ACTIVO'));
            if(!is_object($objParametroCupon) || empty($objParametroCupon))
            {
                throw new \Exception('No existe el parametro CANT_PUNTOS_CLT_CUPON.');
            }
            $arrayRestaurantes = $this->getDoctrine()
                                      ->getRepository(InfoRestaurante::class)
                                      ->getRestauranteCriterio(array('strEstado'       => "ACTIVO",
                                                                     'strBanderaBitte' => "S"));
            if(empty($arrayRestaurantes['error']) && !empty($arrayRestaurantes['resultados']))
            {
                foreach ($arrayRestaurantes['resultados'] as $item)
                {
                    $intCantPuntos     = intval($objParametroCupon->getVALOR1());
                    $intCantidadPuntos = 0;
                    $objRestaurante    = $this->getDoctrine()
                                              ->getRepository(InfoRestaurante::class)
                                              ->find($item['ID_RESTAURANTE']);
                    $objInfoCltPunto   = $this->getDoctrine()
                                              ->getRepository(InfoClientePunto::class)
                                              ->findOneBy(array('CLIENTE_ID'     => $objCliente->getId(),
                                                                'RESTAURANTE_ID' => $item['ID_RESTAURANTE'],
                                                                'ESTADO'         => 'ACTIVO'));
                    if(!empty($objInfoCltPunto) && is_object($objInfoCltPunto))
                    {
                        $intCantidadPuntos = $intCantPuntos + intval($objInfoCltPunto->getCANTIDADPUNTOS());
                        $objInfoCltPunto->setCANTIDADPUNTOS($intCantidadPuntos);
                        $em->persist($objInfoCltPunto);
                        $em->flush();
                    }
                    else
                    {
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
            }
            else
            {
                throw new \Exception('No existe restaurantes, con los parámetros enviados.');
            }
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
        }
        catch(\Exception $ex)
        {
            $boolSucces = false;
            $strMensaje = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 204;
                $em->getConnection()->rollback();
            }
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensaje,
                                                   'succes'    => $boolSucces)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
}
