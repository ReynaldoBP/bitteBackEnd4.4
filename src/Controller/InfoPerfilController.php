<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoPerfil;
use App\Entity\AdmiAccion;
use App\Entity\AdmiModulo;
use App\Entity\InfoModuloAccion;
use App\Entity\InfoUsuario;
use App\Controller\ApiWebController;
class InfoPerfilController extends Controller
{
    /**
     * @Route("/createPerfil")
     *
     * Documentación para la función 'createPerfil'
     * Método encargado de crear los perfiles según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 10-09-2019
     *
     * @author Kevin Baque
     * @version 1.1 21-07-2021 - Se agrega lógica para ingresar historial de creación.
     *
     * @return array  $objResponse
     */
    public function createPerfilAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdModuloAccion      = $request->query->get("idModuloAccion") ? $request->query->get("idModuloAccion"):'';
        $intIdUsuario           = $request->query->get("idUsuario") ? $request->query->get("idUsuario"):'';
        $strDescripcion         = $request->query->get("descripcion") ? $request->query->get("descripcion"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $arrayBitacoraDetalle   = array();
        $objApiWebController    = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();

            $arrayParametros = array('ESTADO' => 'ACTIVO',
                                     'id'     => $intIdModuloAccion);
            $objModuloAccion = $this->getDoctrine()
                                    ->getRepository(InfoModuloAccion::class)
                                    ->findOneBy($arrayParametros);
            if(!is_object($objModuloAccion) || empty($objModuloAccion))
            {
                throw new \Exception('No existe la relación entre modulo y acción con la descripción enviada por parámetro.');
            }
            $arrayParametrosUs = array('ESTADO' => 'ACTIVO',
                                       'id'     => $intIdUsuario);
            $objUsuario        = $this->getDoctrine()
                                      ->getRepository(InfoUsuario::class)
                                      ->findOneBy($arrayParametrosUs);
            if(!is_object($objUsuario) || empty($objUsuario))
            {
                throw new \Exception('No existe el usuario con la descripción enviada por parámetro.');
            }
            $arrayParametrosPerfil = array('ESTADO'      => 'ACTIVO',
                                           'DESCRIPCION' => $strDescripcion);
            $objPerfil             = $this->getDoctrine()
                                          ->getRepository(InfoPerfil::class)
                                          ->findOneBy($arrayParametrosPerfil);
            if(is_object($objPerfil) && !empty($objPerfil))
            {
                throw new \Exception('Perfil ya existente.');
            }
            $entityPerfil = new InfoPerfil();
            $entityPerfil->setMODULOACCIONID($objModuloAccion);
            $entityPerfil->setUSUARIOID($objUsuario);
            $entityPerfil->setDESCRIPCION($strDescripcion);
            $entityPerfil->setESTADO(strtoupper($strEstado));
            $entityPerfil->setUSRCREACION($strUsuarioCreacion);
            $entityPerfil->setFECREACION($strDatetimeActual);
            $em->persist($entityPerfil);
            $em->flush();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Módulo",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $objModuloAccion->getMODULOID()->getDESCRIPCION(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Acción",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $objModuloAccion->getACCIONID()->getDESCRIPCION(),
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => "Creación",
                                                           "strModulo"            => "Permisos",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $entityPerfil->getId(),
                                                           "strReferenciaValor"   => $objUsuario->getNOMBRES()." ".$objUsuario->getAPELLIDOS(),
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Perfil creado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un Perfil, intente nuevamente.\n ". $ex->getMessage();
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
     * @Route("/editPerfil")
     *
     * Documentación para la función 'editPerfil'
     * Método encargado de editar los perfiles según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 10-09-2019
     * 
     * @return array  $objResponse
     */
    public function editPerfilAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdModuloAccion      = $request->query->get("idModuloAccion") ? $request->query->get("idModuloAccion"):'';
        $intIdPerfil            = $request->query->get("idPerfil") ? $request->query->get("idPerfil"):'';
        $intIdUsuario           = $request->query->get("idUsuario") ? $request->query->get("idUsuario"):'';
        $strDescripcion         = $request->query->get("descripcion") ? $request->query->get("descripcion"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $strDatetimeActual      = new \DateTime('now');
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $objPerfil = $this->getDoctrine()
                              ->getRepository(InfoPerfil::class)
                              ->findOneBy(array('id'=>$intIdPerfil));
            if(!is_object($objPerfil) || empty($objPerfil))
            {
                throw new \Exception('No existe Perfil con la descripción enviada por parámetro.');
            }
            if(!empty($intIdModuloAccion))
            {
                $arrayParametros = array('ESTADO' => 'ACTIVO',
                                         'id'     => $intIdModuloAccion);
                $objModuloAccion = $this->getDoctrine()
                                        ->getRepository(InfoModuloAccion::class)
                                        ->findOneBy($arrayParametros);
                if(!is_object($objModuloAccion) || empty($objModuloAccion))
                {
                    throw new \Exception('No existe la relación entre modulo y acción con la descripción enviada por parámetro.');
                }
                $objPerfil->setMODULOACCIONID($objModuloAccion);
            }
            if(!empty($intIdUsuario))
            {
                $arrayParametrosUs = array('ESTADO' => 'ACTIVO',
                                           'id'     => $intIdUsuario);
                $objUsuario        = $this->getDoctrine()
                                          ->getRepository(InfoUsuario::class)
                                          ->findOneBy($arrayParametrosUs);
                if(!is_object($objUsuario) || empty($objUsuario))
                {
                    throw new \Exception('No existe el usuario con la descripción enviada por parámetro.');
                }
                $objPerfil->setUSUARIOID($objUsuario);
            }

            if(!empty($strDescripcion))
            {
                $objPerfil->setDESCRIPCION($strDescripcion);
            }
            if(!empty($strEstado))
            {
                $objPerfil->setESTADO(strtoupper($strEstado));
            }
            $objPerfil->setUSRMODIFICACION($strUsuarioCreacion);
            $objPerfil->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objPerfil);
            $em->flush();
            $strMensajeError = 'Perfil editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            
            $strMensajeError = "Fallo al editar un Perfil, intente nuevamente.\n ". $ex->getMessage();
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
     * @Route("/getPerfil")
     *
     * Documentación para la función 'getPerfil'
     * Método encargado de retornar todos los perfiles según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 10-09-2019
     * 
     * @return array  $objResponse
     */
    public function getPerfilAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdModuloAccion      = $request->query->get("idModuloAccion") ? $request->query->get("idModuloAccion"):'';
        $intIdPerfil            = $request->query->get("idPerfil") ? $request->query->get("idPerfil"):'';
        $intIdUsuario           = $request->query->get("idUsuario") ? $request->query->get("idUsuario"):'';
        $strDescripcion         = $request->query->get("descripcion") ? $request->query->get("descripcion"):'';
        $intIdRestaurante       = $request->query->get("intIdRestaurante") ? $request->query->get("intIdRestaurante"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'';
        $arrayPerfil          = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        try
        {
            $arrayParametros = array('intIdPerfil'   => $intIdPerfil,
                                    'intIdModuloAccion' => $intIdModuloAccion,
                                    'intIdUsuario'   => $intIdUsuario,
                                    'strDescripcion' => $strDescripcion,
                                    'strEstado'      => $strEstado,
                                    'intIdRestaurante' => $intIdRestaurante
                                    );
            $arrayPerfil   = $this->getDoctrine()
                                  ->getRepository(InfoPerfil::class)
                                  ->getPerfilCriterio($arrayParametros);
            if(isset($arrayPerfil['error']) && !empty($arrayPerfil['error']))
            {
                $strStatus  = 404;
                throw new \Exception($arrayPerfil['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError ="Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayPerfil['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayPerfil,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * @Route("/deletePerfil")
     *
     * Documentación para la función 'deletePerfil'
     * Método encargado de eliminar los perfiles según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 10-09-2019
     *
     * @author Kevin Baque
     * @version 1.1 21-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function deletePerfilAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdModuloAccion      = $request->query->get("idModuloAccion") ? $request->query->get("idModuloAccion"):'';
        $intIdPerfil            = $request->query->get("idPerfil") ? $request->query->get("idPerfil"):'';
        $intIdUsuario           = $request->query->get("idUsuario") ? $request->query->get("idUsuario"):'';
        $strDescripcion         = $request->query->get("descripcion") ? $request->query->get("descripcion"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $arrayBitacoraDetalle   = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objApiWebController    = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        $objResponse            = new Response;
        $strDatetimeActual      = new \DateTime('now');
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            if(!empty($intIdModuloAccion))
            {
                $arrayParametros = array('id' => $intIdModuloAccion);
                $objModuloAccion = $this->getDoctrine()
                                        ->getRepository(InfoModuloAccion::class)
                                        ->findOneBy($arrayParametros);
                if(!is_object($objModuloAccion) || empty($objModuloAccion))
                {
                    throw new \Exception('No existe la relación entre modulo y acción con la descripción enviada por parámetro.');
                }
            }
            if(!empty($intIdUsuario))
            {
                $arrayParametrosUs = array('id' => $intIdUsuario);
                $objUsuario        = $this->getDoctrine()
                                          ->getRepository(InfoUsuario::class)
                                          ->findOneBy($arrayParametrosUs);
                if(!is_object($objUsuario) || empty($objUsuario))
                {
                    throw new \Exception('No existe el usuario con la descripción enviada por parámetro.');
                }
            }
            $arrayParametrosPerfil = array ('MODULO_ACCION_ID' => $intIdModuloAccion,
                                            'USUARIO_ID'       => $intIdUsuario);
            $objPerfil = $this->getDoctrine()
                              ->getRepository(InfoPerfil::class)
                              ->findOneBy($arrayParametrosPerfil);
            if(!is_object($objPerfil) || empty($objPerfil))
            {
                throw new \Exception('No existe Perfil con la descripción enviada por parámetro.');
            }
            $intIdPerfil = $objPerfil->getId();
            $em->remove($objPerfil);
            $em->flush();
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Módulo",
                                           'VALOR_ANTERIOR' => $objModuloAccion->getMODULOID()->getDESCRIPCION(),
                                           'VALOR_ACTUAL'   => "",
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Acción",
                                           'VALOR_ANTERIOR' => $objModuloAccion->getACCIONID()->getDESCRIPCION(),
                                           'VALOR_ACTUAL'   => "",
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => "Modificación",
                                                           "strModulo"            => "Permisos",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $intIdPerfil,
                                                           "strReferenciaValor"   => $objUsuario->getNOMBRES()." ".$objUsuario->getAPELLIDOS(),
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Perfil eliminado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            
            $strMensajeError = "Fallo al eliminar un Perfil, intente nuevamente.\n ". $ex->getMessage();
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
