<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoRespuesta;
use App\Entity\InfoUsuario;
use App\Entity\AdmiTipoRol;
use App\Entity\InfoUsuarioRes;
use App\Controller\DefaultController;

class InfoRespuestaController extends Controller
{
    /**
     * @Route("/getRespuesta")
     *
     * Documentación para la función 'getRespuesta'
     * Método encargado de retornar las respuestas de los clientes
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 15-09-2019
     * 
     * @return array  $objResponse
     */
    public function getRespuestaAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $intIdCltEncuesta       = $request->query->get("idCltEncuesta") ? $request->query->get("idCltEncuesta"):'';
        $intIdPregunta          = $request->query->get("idPregunta") ? $request->query->get("idPregunta"):'';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'';
        $arrayRespuesta         = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        try
        {
            $arrayParametros = array('intIdPregunta' => $intIdPregunta,
                                     'intIdCltEncuesta'=>$intIdCltEncuesta,
                                     'strEstado'     => $strEstado);
            $arrayRespuesta = $this->getDoctrine()
                                   ->getRepository(InfoRespuesta::class)
                                   ->getRespuestaCriterio($arrayParametros);
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
     * @Route("/getRespuestaDashboard")
     *
     * Documentación para la función 'getRespuestaDashboard'
     * Método encargado de retornar las respuestas de los clientes
     * según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 15-09-2019
     * 
     * @return array  $objResponse
     */
    public function getRespuestaDashboardAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strAnio                = $request->query->get("strAnio") ? $request->query->get("strAnio"):'';
        $intIdCltEncuesta       = $request->query->get("intIdCltEncuesta") ? $request->query->get("intIdCltEncuesta"):'';
        $strMes                 = $request->query->get("strMes") ? $request->query->get("strMes"):'';
        $conImagen              = $request->query->get("conImagen") ? $request->query->get("conImagen"):'NO';
        $strEstado              = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $intIdUsuario           = $request->query->get("id_usuario") ? $request->query->get("id_usuario"):'';
        $arrayRespuesta         = array();
        $strMensajeError        = '';
        $strStatus              = 400;
        $objResponse            = new Response;
        $objController          = new DefaultController();
        $objController->setContainer($this->container);
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
                    }
                }
            }
            $arrayParametros = array('strAnio'           => $strAnio,
                                     'strMes'            => $strMes,
                                     'intIdCltEncuesta'  => $intIdCltEncuesta,
                                     'intIdRestaurante'  => $intIdRestaurante,
                                     'strEstado'         => $strEstado);
            $arrayRespuesta = (array) $this->getDoctrine()
                                           ->getRepository(InfoRespuesta::class)
                                           ->getRespuestaDashboard($arrayParametros);
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
        if($conImagen == 'SI')
        {
            foreach ($arrayRespuesta['resultados'] as &$item)
            {
                if($item['IMAGEN'])
                {
                    $item['IMAGEN'] = $objController->getImgBase64($item['IMAGEN']);
                }
            }
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
}
