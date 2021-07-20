<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\AdmiTipoComida;
use App\Controller\ApiWebController;
class AdmiTipoComidaController extends Controller
{
    /**
     * @Route("/getTipoComida")
     *
     * Documentación para la función 'getTipoComida'
     * Método encargado de listar los tipos de comida según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 29-08-2019
     * 
     * @return array  $objResponse
     */
    public function getTipoComidaAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado       = $request->query->get("estado") ? $request->query->get("estado"):'';
        $intIdTipoComida = $request->query->get("idTipoComida") ? $request->query->get("idTipoComida"):'';
        $arrayParametros = array('estado'       => $strEstado,
                                 'idTipoComida' => $intIdTipoComida);
        $arrayTipoComida = array();
        $strMensajeError = '';
        $strStatus       = 400;
        $objResponse     = new Response;
        try
        {
            $arrayTipoComida = $this->getDoctrine()
                                    ->getRepository(AdmiTipoComida::class)
                                    ->getTipoComida($arrayParametros);
            if( isset($arrayTipoComida['error']) && !empty($arrayTipoComida['error']) ) 
            {
                $strStatus  = 404;
                throw new \Exception($arrayTipoComida['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError    = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayTipoComida['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayTipoComida,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * @Route("/editTipoComida")
     *
     * Documentación para la función 'editTipoComida'
     * Método encargado de editar los tipos de comida según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 29-08-2019
     * 
     * @author Kevin Baque
     * @version 1.1 19-07-2021 - Se agrega lógica para ingresar historial de modificación.
     *
     * @return array  $objResponse
     */
    public function editTipoComidaAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdTipoComida        = $request->query->get("idTipoComida") ? $request->query->get("idTipoComida"):'';
        $strDescripcion         = $request->query->get("descripcion") ? $request->query->get("descripcion"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $strDatetimeActual      = new \DateTime('now');
        $objApiWebController    = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $entityComida = $this->getDoctrine()
                                 ->getRepository(AdmiTipoComida::class)
                                 ->findOneBy(array('id'=>$intIdTipoComida));
            if(!empty($strDescripcion))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                               'VALOR_ANTERIOR' => $entityComida->getDESCRIPCION(),
                                               'VALOR_ACTUAL'   => $strDescripcion,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entityComida->setDESCRIPCION($strDescripcion);
            }
            if(!empty($strEstado))
            {
                $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                               'VALOR_ANTERIOR' => $entityComida->getESTADO(),
                                               'VALOR_ACTUAL'   => $strEstado,
                                               'USUARIO_ID'     => $strUsuarioCreacion);
                $entityComida->setESTADO(strtoupper($strEstado));
            }
            $entityComida->setUSRMODIFICACION($strUsuarioCreacion);
            $entityComida->setFEMODIFICACION($strDatetimeActual);
            $em->persist($entityComida);
            $em->flush();
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => "Modificación",
                                                           "strModulo"            => "Tipo de Comida",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $entityComida->getId(),
                                                           "strReferenciaValor"   => $entityComida->getDESCRIPCION(),
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Tipo de comida editado con exito.!';
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar un Tipo de comida, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

    /**
     * @Route("/createTipoComida")
     *
     * Documentación para la función 'createTipoComida'
     * Método encargado de crear los tipos de comida según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 29-08-2019
     *
     * @author Kevin Baque
     * @version 1.1 19-07-2021 - Se agrega lógica para ingresar historial de creación.
     *
     * @return array  $objResponse
     */
    public function createTipoComidaAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strDescripcion         = $request->query->get("descripcion") ? $request->query->get("descripcion"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $strDatetimeActual      = new \DateTime('now');
        $objApiWebController    = new ApiWebController();
        $objApiWebController->setContainer($this->container);
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $em                     = $this->getDoctrine()->getManager();
        try
        {
            $em->getConnection()->beginTransaction();
            $entityComida = new AdmiTipoComida();
            $entityComida->setDESCRIPCION($strDescripcion);
            $entityComida->setESTADO(strtoupper($strEstado));
            $entityComida->setUSRCREACION($strUsuarioCreacion);
            $entityComida->setFECREACION($strDatetimeActual);
            $em->persist($entityComida);
            $em->flush();
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Descripción",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strDescripcion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEstado,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWebController->createBitacora(array("strAccion"            => "Creación",
                                                           "strModulo"            => "Tipo de Comida",
                                                           "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                           "intReferenciaId"      => $entityComida->getId(),
                                                           "strReferenciaValor"   => $entityComida->getDESCRIPCION(),
                                                           "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Tipo de comida creado con exito.!';
        }
        catch(\Exception $ex)
        {
            $strStatus = 404;
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al crear un Tipo de comida, intente nuevamente.\n ". $ex->getMessage();
        }
        $objResponse->setContent(json_encode(array('status'    => $strStatus,
                                                   'resultado' => $strMensajeError,
                                                   'succes'    => true)));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }

}
