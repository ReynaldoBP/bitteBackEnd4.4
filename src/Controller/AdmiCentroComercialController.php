<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\AdmiCentroComercial;
use App\Controller\DefaultController;
use App\Controller\ApiWebController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
class AdmiCentroComercialController extends FOSRestController
{

    /**
     * @Rest\Post("/createCentroComercial")
     *
     * Documentación para la función 'createCentroComercial'
     *
     * Método encargado de crear los centros comerciales según los parámetros enviados.
     *
     * @author Kevin Baque
     * @version 1.0 11-11-2022
     *
     * @return array  $objResponse
     */
    public function createCentroComercial(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayRequest         = json_decode($request->getContent(),true);
        $arrayData            = $arrayRequest['data'];
        $strNombre            = $arrayData['strNombre']          ? $arrayData['strNombre']:"";
        $strDireccion         = $arrayData['strDireccion']       ? $arrayData['strDireccion']:"";
        $strEstado            = $arrayData['strEstado']          ? $arrayData['strEstado']:"ACTIVO";
        $strUsuarioCreacion   = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:"";
        $strDatetimeActual    = new \DateTime('now');
        $arrayRespuesta       = array();
        $arrayBitacoraDetalle = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $boolSucces           = true;
        $em                   = $this->getDoctrine()->getManager();
        $objApiWeb            = new ApiWebController();
        $objApiWeb->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();
            $entityCC = new AdmiCentroComercial();
            $entityCC->setNOMBRE($strNombre);
            $entityCC->setDIRECCION($strDireccion);
            $entityCC->setESTADO(strtoupper($strEstado));
            $entityCC->setUSRCREACION($strUsuarioCreacion);
            $entityCC->setFECREACION($strDatetimeActual);
            $em->persist($entityCC);
            $em->flush();
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Nombre",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strNombre,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Direccion",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strDireccion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => "",
                                           'VALOR_ACTUAL'   => $strEstado,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWeb->createBitacora(array("strAccion"            => "Creación",
                                                 "strModulo"            => "Centro Comercial",
                                                 "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                 "intReferenciaId"      => $entityCC->getId(),
                                                 "strReferenciaValor"   => $entityCC->getNOMBRE(),
                                                 "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Centro Comercial creado con éxito.';
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
     * @Rest\Post("/editCentroComercial")
     *
     * Documentación para la función 'editCentroComercial'
     *
     * Método encargado de editar los centros comerciales según los parámetros enviados.
     *
     * @author Kevin Baque
     * @version 1.0 11-11-2022
     *
     * @return array  $objResponse
     */
    public function editCentroComercial(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayRequest         = json_decode($request->getContent(),true);
        $arrayData            = $arrayRequest['data'];
        $intIdCC              = $arrayData['intIdCC']            ? $arrayData['intIdCC']:"";
        $strNombre            = $arrayData['strNombre']          ? $arrayData['strNombre']:"";
        $strDireccion         = $arrayData['strDireccion']       ? $arrayData['strDireccion']:"";
        $strEstado            = $arrayData['strEstado']          ? $arrayData['strEstado']:"ACTIVO";
        $strUsuarioCreacion   = $arrayData['strUsuarioCreacion'] ? $arrayData['strUsuarioCreacion']:"";
        $strDatetimeActual    = new \DateTime('now');
        $arrayRespuesta       = array();
        $arrayBitacoraDetalle = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $boolSucces           = true;
        $em                   = $this->getDoctrine()->getManager();
        $objApiWeb            = new ApiWebController();
        $objApiWeb->setContainer($this->container);
        try
        {
            $em->getConnection()->beginTransaction();

            $objCC = $this->getDoctrine()
                                ->getRepository(AdmiCentroComercial::class)
                                ->find($intIdCC);
            if(!is_object($objCC) || empty($objCC))
            {
                throw new \Exception('No existe Centro Comercial con los parámetros enviados.');
            }
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Nombre",
                                           'VALOR_ANTERIOR' => $objCC->getNOMBRE(),
                                           'VALOR_ACTUAL'   => $strNombre,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Direccion",
                                           'VALOR_ANTERIOR' => $objCC->getDIRECCION(),
                                           'VALOR_ACTUAL'   => $strDireccion,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $arrayBitacoraDetalle[]= array('CAMPO'          => "Estado",
                                           'VALOR_ANTERIOR' => $objCC->getESTADO(),
                                           'VALOR_ACTUAL'   => $strEstado,
                                           'USUARIO_ID'     => $strUsuarioCreacion);
            $objCC->setNOMBRE($strNombre);
            $objCC->setDIRECCION($strDireccion);
            $objCC->setESTADO(strtoupper($strEstado));
            $objCC->setUSRMODIFICACION($strUsuarioCreacion);
            $objCC->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objCC);
            $em->flush();
            if ($em->getConnection()->isTransactionActive())
            {
                $em->getConnection()->commit();
                $em->getConnection()->close();
            }
            if(!empty($arrayBitacoraDetalle))
            {
                $objApiWeb->createBitacora(array("strAccion"            => "Modificación",
                                                 "strModulo"            => "Centro Comercial",
                                                 "strUsuarioCreacion"   => $strUsuarioCreacion,
                                                 "intReferenciaId"      => $objCC->getId(),
                                                 "strReferenciaValor"   => $objCC->getNOMBRE(),
                                                 "arrayBitacoraDetalle" => $arrayBitacoraDetalle));
            }
            $strMensajeError = 'Centro Comercial editado con éxito.';
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
     * @Rest\Post("/getCentroComercial")
     *
     * Documentación para la función 'getCentroComercial'
     * Método encargado de retornar todos los detalles de los centros comerciales según los parámetros enviados.
     *
     * @author Kevin Baque
     * @version 1.0 11-11-2022
     *
     * @return array  $objResponse
     */
    public function getCentroComercial(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $arrayRequest         = json_decode($request->getContent(),true);
        $arrayData            = $arrayRequest['data'];
        $arrayRespuesta       = array();
        $strMensajeError      = '';
        $strStatus            = 200;
        $objResponse          = new Response;
        $boolSucces           = true;
        try
        {
            $arrayRespuesta  = $this->getDoctrine()
                                    ->getRepository(AdmiCentroComercial::class)
                                    ->getCentroComercial($arrayData);
            if(!empty($arrayRespuesta["error"]))
            {
                throw new \Exception($arrayRespuesta['error']);
            }
            if(count($arrayRespuesta["resultados"])==0)
            {
                throw new \Exception("No existen Centros Comerciales con los parámetros enviados.");
            }
        }
        catch(\Exception $ex)
        {
            error_log("entro catch");
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