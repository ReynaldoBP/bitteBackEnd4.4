<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoUsuario;
use App\Entity\AdmiTipoRol;
use App\Controller\ApiWebController;
use App\Controller\DefaultController;

class UsuarioController extends Controller
{

    /**
     * @Route("/getUsuario")
     *
     * Documentación para la función 'getUsuario'
     * Método encargado de retornar todos los usuarios según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 10-11-2019 Se agrega filtro por restaurante.
     * 
     * @return array  $objResponse
     */
    public function getUsuarioAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdUsuario           = $request->query->get("idUsuario") ? $request->query->get("idUsuario"):'';
        $intIdRestaurante       = $request->query->get("intIdRestaurante") ? $request->query->get("intIdRestaurante"):'';
        $strTipoRol             = $request->query->get("idRol") ? $request->query->get("idRol"):'';
        $strIdentificacion      = $request->query->get("identificacion") ? $request->query->get("identificacion"):'';
        $strNombres             = $request->query->get("nombres") ? $request->query->get("nombres"):'';
        $strApellidos           = $request->query->get("apellidos") ? $request->query->get("apellidos"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'';
        $strBandRes              = $request->query->get("strBandRes") ? $request->query->get("strBandRes"):'N';
        $arrayUsuarios          = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        try
        {
            $arrayParametros = array('intIdUsuario'     => $intIdUsuario,
                                    'strTipoRol'        => $strTipoRol,
                                    'strIdentificacion' => $strIdentificacion,
                                    'intIdRestaurante'  => $intIdRestaurante,
                                    'strNombres'        => $strNombres,
                                    'strApellidos'      => $strApellidos,
                                    'strEstado'         => $strEstado);
            if(!empty($strBandRes) && $strBandRes =='S')
            {
                if(!empty($strTipoRol))
                {
                    $arrayParametrosRol = array('ESTADO' => 'ACTIVO',
                                                'id'     => $strTipoRol);
                    $objTipoRol         = $this->getDoctrine()
                                               ->getRepository(AdmiTipoRol::class)
                                               ->findOneBy($intIdUsuario);
                    if(!is_object($objTipoRol) || empty($objTipoRol))
                    {
                        throw new \Exception('No existe rol con la descripción enviada por parámetro.');
                    }
                }
                else
                {
                    $objUsuario = $this->getDoctrine()
                                       ->getRepository(InfoUsuario::class)
                                       ->find($intIdUsuario);
                    if(!is_object($objUsuario) || empty($objUsuario))
                    {
                        throw new \Exception('No existe rol con la descripción enviada por parámetro.');
                    }
                }
                $arrayParametros['strTipoRolRes'] = $objUsuario->getTIPOROLID()->getDESCRIPCION_TIPO_ROL();
            }

            $arrayUsuarios   = $this->getDoctrine()
                                    ->getRepository(InfoUsuario::class)
                                    ->getUsuariosCriterio($arrayParametros);
            if(isset($arrayUsuarios['error']) && !empty($arrayUsuarios['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayUsuarios['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayUsuarios['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayUsuarios,
                                            'succes'    => true,
                                            'ROL'=>$intIdUsuario
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * @Route("/createUsuario")
     *
     * Documentación para la función 'createUsuario'
     * Método encargado de crear los usuarios según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     *
     * @author Kevin Baque
     * @version 1.1 07-06-2021 - Se agrega campo, para saber si el usuario recibirá notificaciones de las encuesta.
     *
     * @author Kevin Baque
     * @version 1.2 19-07-2021 - Se agrega lógica para ingresar historial de creación.
     *
     * @return array  $objResponse
     *
     */
    public function createUsuarioAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strTipoRol             = $request->query->get("idRol") ? $request->query->get("idRol"):'';
        $strIdentificacion      = $request->query->get("identificacion") ? $request->query->get("identificacion"):'';
        $strNombres             = $request->query->get("nombres") ? $request->query->get("nombres"):'';
        $strApellidos           = $request->query->get("apellidos") ? $request->query->get("apellidos"):'';
        $strContrasenia         = $request->query->get("contrasenia") ? $request->query->get("contrasenia"):'';
        $strImagen              = $request->query->get("imagen") ? $request->query->get("imagen"):'';
        $strCorreo              = $request->query->get("correo") ? $request->query->get("correo"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'';
        $strNotificacion        = $request->query->get("notificacion") ? $request->query->get("notificacion"):'NO';
        $strPais                = $request->query->get("pais") ? $request->query->get("pais"):'';
        $strCiudad              = $request->query->get("ciudad") ? $request->query->get("ciudad"):'';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 200;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        $objApiWebController    = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        $strDescripcion='';
        try
        {
            $em->getConnection()->beginTransaction();
            $arrayParametrosRol = array('ESTADO' => 'ACTIVO',
                                        'id'     => $strTipoRol);
            $objTipoRol         = $this->getDoctrine()
                                       ->getRepository(AdmiTipoRol::class)
                                       ->findOneBy($arrayParametrosRol);
            if(!is_object($objTipoRol) || empty($objTipoRol))
            {
                throw new \Exception('No existe rol con la descripción enviada por parámetro.');
            }
            $objUsuario         = $this->getDoctrine()
                                       ->getRepository(InfoUsuario::class)
                                       ->findOneBy(array('IDENTIFICACION'=>$strIdentificacion));
             if(is_object($objUsuario) && !empty($objUsuario))
            {
                throw new \Exception('Usuario ya existente.');
            }
            $objUsuario         = $this->getDoctrine()
                                       ->getRepository(InfoUsuario::class)
                                       ->findOneBy(array('CORREO'=>$strCorreo));
            if(is_object($objUsuario) && !empty($objUsuario))
            {
                throw new \Exception('Usuario ya existente.');
            }
            $entityUsuario = new InfoUsuario();
            $entityUsuario->setTIPOROLID($objTipoRol);
            $entityUsuario->setIDENTIFICACION($strIdentificacion);
            $entityUsuario->setNOMBRES($strNombres);
            $entityUsuario->setAPELLIDOS($strApellidos);
            //if(!empty($strContrasenia))
            //{
                $entityUsuario->setCONTRASENIA(md5($strContrasenia));
            //}
            $entityUsuario->setIMAGEN($strImagen);
            $entityUsuario->setCORREO($strCorreo);
            $entityUsuario->setESTADO(strtoupper($strEstado));
            $entityUsuario->setNOTIFICACION(strtoupper($strNotificacion));
            $entityUsuario->setPAIS($strPais);
            $entityUsuario->setCIUDAD($strCiudad);
            $entityUsuario->setUSRCREACION($strUsuarioCreacion);
            $entityUsuario->setFECREACION($strDatetimeActual);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Rol",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $objTipoRol->getDESCRIPCION_TIPO_ROL(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Identificación",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strIdentificacion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Nombres",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strNombres,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Apellidos",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strApellidos,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Correo",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strCorreo,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEstado,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Notificación",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strNotificacion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $em->persist($entityUsuario);
            $em->flush();
            $strMensajeError = 'Usuario creado con exito.!';

            $arrayUsuario    = array('id'             => $entityUsuario->getId(),
                                 'identificacion' => $entityUsuario->getIDENTIFICACION(),
                                 'nombres'        => $entityUsuario->getNOMBRES(),
                                 'apellido'       => $entityUsuario->getAPELLIDOS(),
                                 'correo'         => $entityUsuario->getCORREO(),
                                 'estado'         => $entityUsuario->getESTADO(),
                                 'usrCreacion'    => $entityUsuario->getUSRCREACION(),
                                 'feCreacion'     => $entityUsuario->getFECREACION(),
                                 'mensaje'        => $strMensajeError);        
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => "Creación",
                                                           "strModulo"            => "Usuario",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $entityUsuario->getId(),
                                                           "strReferenciaValor"   => $entityUsuario->getNOMBRES(). " ".$entityUsuario->getAPELLIDOS(),
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
        }
        catch(\Exception $ex)
        {
            $strStatus = 204;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $arrayUsuario["mensaje"] = $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $arrayUsuario,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    /**
     * @Route("/editUsuario")
     *
     * Documentación para la función 'editUsuario'
     * Método encargado de editar los usuarios según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 07-06-2021 - Se agrega campo, para saber si el usuario recibirá notificaciones de las encuesta.
     *
     * @author Kevin Baque
     * @version 1.2 19-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function editUsuarioAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strTipoRol             = $request->query->get("idRol") ? $request->query->get("idRol"):'';
        $intIdUsuario           = $request->query->get("idUsuario") ? $request->query->get("idUsuario"):'';
        $strIdentificacion      = $request->query->get("identificacion") ? $request->query->get("identificacion"):'';
        $strNombres             = $request->query->get("nombres") ? $request->query->get("nombres"):'';
        $strApellidos           = $request->query->get("apellidos") ? $request->query->get("apellidos"):'';
        $strContrasenia         = $request->query->get("contrasenia") ? $request->query->get("contrasenia"):'';
        $strImagen              = $request->query->get("imagen") ? $request->query->get("imagen"):'';
        $strCorreo              = $request->query->get("correo") ? $request->query->get("correo"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'';
        $strNotificacion        = $request->query->get("notificacion") ? $request->query->get("notificacion"):'';
        $strPais                = $request->query->get("pais") ? $request->query->get("pais"):'';
        $strCiudad              = $request->query->get("ciudad") ? $request->query->get("ciudad"):'';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $objApiWebController    = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        $em                     = $this->getDoctrine()->getManager();
        $strDescripcion='';
        try
        {
            $em->getConnection()->beginTransaction();
            $objUsuario = $this->getDoctrine()
                               ->getRepository(InfoUsuario::class)
                               ->findOneBy(array('id'=>$intIdUsuario));
            if(!is_object($objUsuario) || empty($objUsuario))
            {
                throw new \Exception('No existe usuario con la identificación enviada por parámetro.');
            }
            if(!empty($strTipoRol))
            {
                $arrayParametrosRol = array(//'ESTADO' => $strEstado,
                                            'id'     => $strTipoRol);
                $objTipoRol         = $this->getDoctrine()
                                           ->getRepository(AdmiTipoRol::class)
                                           ->findOneBy($arrayParametrosRol);
                if(!is_object($objTipoRol) || empty($objTipoRol))
                {
                    throw new \Exception('No existe rol con la descripción enviada por parámetro.');
                }
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Rol",
                                               'VALOR_ANTERIOR' => $objUsuario->getTIPOROLID()->getDESCRIPCION_TIPO_ROL(),
                                               'VALOR_ACTUAL'   => $objTipoRol->getDESCRIPCION_TIPO_ROL(),
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objUsuario->setTIPOROLID($objTipoRol);
            }
            if(!empty($strIdentificacion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Identificación",
                                               'VALOR_ANTERIOR' => $objUsuario->getIDENTIFICACION(),
                                               'VALOR_ACTUAL'   => $strIdentificacion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objUsuario->setIDENTIFICACION($strIdentificacion);
            }
            if(!empty($strNombres))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Nombres",
                                               'VALOR_ANTERIOR' => $objUsuario->getNOMBRES(),
                                               'VALOR_ACTUAL'   => $strNombres,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objUsuario->setNOMBRES($strNombres);
            }
            if(!empty($strApellidos))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Apellidos",
                                               'VALOR_ANTERIOR' => $objUsuario->getAPELLIDOS(),
                                               'VALOR_ACTUAL'   => $strApellidos,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objUsuario->setAPELLIDOS($strApellidos);
            }
            if(!empty($strContrasenia))
            {
                $objUsuario->setCONTRASENIA(md5($strContrasenia));
            }
            if(!empty($strImagen))
            {
                $objUsuario->setIMAGEN($strImagen);
            }
            if(!empty($strCorreo))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Correo",
                                               'VALOR_ANTERIOR' => $objUsuario->getCORREO(),
                                               'VALOR_ACTUAL'   => $strCorreo,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objUsuario->setCORREO($strCorreo);
            }
            if(!empty($strEstado))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                               'VALOR_ANTERIOR' => $objUsuario->getESTADO(),
                                               'VALOR_ACTUAL'   => $strEstado,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objUsuario->setESTADO(strtoupper($strEstado));
            }
            if(!empty($strNotificacion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Notificación",
                                               'VALOR_ANTERIOR' => $objUsuario->getNOTIFICACION(),
                                               'VALOR_ACTUAL'   => $strNotificacion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $objUsuario->setNOTIFICACION(strtoupper($strNotificacion));
            }
            if(!empty($strPais))
            {
                $objUsuario->setPAIS($strPais);
            }
            if(!empty($strCiudad))
            {
                $objUsuario->setCIUDAD($strCiudad);
            }
            $objUsuario->setUSRMODIFICACION($strUsuarioCreacion);
            $objUsuario->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objUsuario);
            $em->flush();
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $strMensajeError = 'Usuario editado con exito.!';
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => "Modificación",
                                                           "strModulo"            => "Usuario",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $objUsuario->getId(),
                                                           "strReferenciaValor"   => $objUsuario->getNOMBRES(). " ".$objUsuario->getAPELLIDOS(),
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar un Usuario, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
    
    /**
     * @Route("/getLogin")
     *
     * Documentación para la función 'editUsuario'
     * Método encargado de verificar si ingresa a la plataforma Web según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     * 
     * @return array  $objResponse
     */
    public function getLoginAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strCorreo     = $request->query->get("correo") ? $request->query->get("correo"):'';
        $strPass       = $request->query->get("contrasenia") ? $request->query->get("contrasenia"):'';
        $arrayUsuarios = array();
        $strMensaje    = '';
        $strStatus     = 400;
        $strSucces     = true;
        $objResponse   = new Response;
        try
        {
            $objUsuario   = $this->getDoctrine()
                                 ->getRepository(InfoUsuario::class)
                                 ->findBy(array('CORREO'      => $strCorreo,
                                                'CONTRASENIA' => md5($strPass)));
            if(empty($objUsuario))
            {
                $strStatus  = 404;
                $strSucces  = false;
                throw new \Exception('Usuario no existe.');
            }
            foreach($objUsuario as $objItemUsuario)
            {
                $arrayParametros = array('intIdUsuario'     => $objItemUsuario->getId(),
                                        'strTipoRol'        => $objItemUsuario->getTIPOROLID()->getId(),
                                        'strIdentificacion' => $objItemUsuario->getIDENTIFICACION(),
                                        'strNombres'        => $objItemUsuario->getNOMBRES(),
                                        'strApellidos'      => $objItemUsuario->getAPELLIDOS(),
                                        'strEstado'         => $objItemUsuario->getESTADO()
                                        );
            }
            $arrayUsuarios   = $this->getDoctrine()
                                    ->getRepository(InfoUsuario::class)
                                    ->getUsuariosCriterio($arrayParametros);
            if(isset($arrayUsuarios['error']) && !empty($arrayUsuarios['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayUsuarios['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            $strMensaje = $ex->getMessage();
        }
        $arrayUsuarios['error'] = $strMensaje;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayUsuarios,
                                            'succes'    => $strSucces
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * @Route("/generarPass")
     *
     * Documentación para la función 'generarPass'
     * Método encargado de generar las contraseñas a todos los usuarios.
     *
     * @author Kevin Baque
     * @version 1.0 01-08-2019
     *
     * @return array  $objResponse
     */
    public function generarPassAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDestinatario  = $request->query->get("correo") ? trim($request->query->get("correo")):'';
        $strAsunto        = 'Clave temporal Bitte';
        $strContrasenia   = uniqid();
        $strContrasenia   = substr($strContrasenia,0,4);
        $strMensajeCorreo = '<div class="">Bienvenida Usuario Administrador Restaurante:</div>
        <div class="">&nbsp;</div>
        <div class="">BITTE le da la bienvenida a su sistema de an&aacute;lisis de datos de satisfacci&oacute;n cliente. BITE le va a permitir conocer la satisfacci&oacute;n de sus clientes bajo diferentes variables y a su vez le permitir&aacute; hacer distintos comparativos para conocer el impacto de mejoras que implemente en su restaurante. A su vez, BITTE permite a los usuarios del app compartir imagenes en redes sociales, que permitir&aacute;n a su establecimiento tener un marketing viral, tanto los datos de veces compartidas las imagen como el alcance de cada imagen, son datos estad&iacute;sticos, que dependiendo de su plan, su restaurante podr&aacute; conocer.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Es hora de premiar a su clientela fija reconoci&eacute;ndolos con premios que usted ya estableci&oacute; y podr&aacute; controlar, permitiendo crear un vinculo mas cercano con sus clientes.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">Nuestro equipo de asistencia estar&aacute; disponible para usted para lo que necesite. Por favor complete su registro de establecimiento y comience a recolectar las opiniones de sus clientes de manera ordenada para un an&aacute;lisis y tabulaci&oacute;n din&aacute;mica.&nbsp;</div>
        <div class="">&nbsp;</div>
        <div class="">
        <div>
        <div><strong>Tu clave temporal es :'.$strContrasenia.'&nbsp;</strong></div>
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
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
}
