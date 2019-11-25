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
     */
    public function createCliente($arrayData)
    {
        $strIdentificacion  = isset($arrayData['identificacion']) ? $arrayData['identificacion']:'';
        $strDireccion       = isset($arrayData['direccion']) ? $arrayData['direccion']:'';
        $strEdad            = isset($arrayData['edad']) ? $arrayData['edad']:'';
        $strTipoComida      = isset($arrayData['tipoComida']) ? $arrayData['tipoComida']:'';
        $strEstado          = isset($arrayData['estado']) ? $arrayData['estado']:'';
        $strSector          = isset($arrayData['sector']) ? $arrayData['sector']:'';
        $strNombre          = isset($arrayData['nombre']) ? $arrayData['nombre']:'';
        $strApellido        = isset($arrayData['apellido']) ? $arrayData['apellido']:'';
        $strCorreo          = isset($arrayData['correo']) ? $arrayData['correo']:'';
        $strGenero          = isset($arrayData['genero']) ? $arrayData['genero']:'';
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
        try
        {
            $em->getConnection()->beginTransaction();
            $objClt  = $this->getDoctrine()
                            ->getRepository(InfoCliente::class)
                            ->findOneBy(array('CORREO'=>$strCorreo));
            if(is_object($objClt) || !empty($objClt))
            {
                throw new \Exception('Cliente ya existente.');
            }
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
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->findOneBy($arrayParametrosUsuario);
            if(!is_object($objUsuario) || empty($objUsuario))
            {
                throw new \Exception('No existe usuario con identificador enviado por parámetro.');
            }

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
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
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
            /*if($strAutenticacionRS == 'N')
            {
                $strDistractor     = substr(md5(time()),0,16);
                //$strActivaCltLocal = "http://127.0.0.1/bitteBackEnd/web/editCliente?jklasdqweuiorenm=".$strDistractor.$entityCliente->getId();
                $strActivaCltProd  = "http://bitte.app/bitteCore/web/editCliente?jklasdqweuiorenm=".$strDistractor.$entityCliente->getId();
                $strAsunto        = 'Bienvenido al mundo BITTE';
                $strMensajeCorreo = '<div class="">Bienvenido al mundo BITTE:</div>
                <div class="">&nbsp;</div>
                <div class="">BITTE le da la bienvenida a su sistema de an&aacute;lisis de datos de satisfacci&oacute;n cliente. BITE le va a permitir conocer la satisfacci&oacute;n de sus clientes bajo diferentes variables y a su vez le permitir&aacute; hacer distintos comparativos para conocer el impacto de mejoras que implemente en su restaurante. A su vez, BITTE permite a los usuarios del app compartir imagenes en redes sociales, que permitir&aacute;n a su establecimiento tener un marketing viral, tanto los datos de veces compartidas las imagen como el alcance de cada imagen, son datos estad&iacute;sticos, que dependiendo de su plan, su restaurante podr&aacute; conocer.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Es hora de premiar a su clientela fija reconoci&eacute;ndolos con premios que usted ya estableci&oacute; y podr&aacute; controlar, permitiendo crear un vinculo mas cercano con sus clientes.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">Nuestro equipo de asistencia estar&aacute; disponible para usted para lo que necesite. Por favor complete su registro de establecimiento y comience a recolectar las opiniones de sus clientes de manera ordenada para un an&aacute;lisis y tabulaci&oacute;n din&aacute;mica.&nbsp;</div>
                <div class="">&nbsp;</div>
                <div class="">
                <div>
                <div><strong>Estás a un paso de comenzar, solamente debes activar tu cuenta.&nbsp;</strong></div>
                <div><a href='.$strActivaCltProd.' target="_blank" >Activar mi cuenta</a></div>
                <div>&nbsp;</div>
                </div>
                </div>
                <div class="">Bienvenido al mundo BITTE.</div>';
                $strRemitente     = 'notificaciones_bitte@massvision.tv';
                $arrayParametros  = array('strAsunto'          => $strAsunto,
                                            'strMensajeCorreo' => $strMensajeCorreo,
                                            'strRemitente'     => $strRemitente,
                                            'strDestinatario'  => $strCorreo);
                $objController    = new DefaultController();
                $objController->setContainer($this->container);
                $objController->enviaCorreo($arrayParametros);
            }*/
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

}
