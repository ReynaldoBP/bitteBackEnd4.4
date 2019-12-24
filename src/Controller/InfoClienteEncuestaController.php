<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoClienteEncuesta;
use Doctrine\ORM\EntityManagerInterface;

class InfoClienteEncuestaController extends AbstractController
{
    /**
     * @Route("/editInfoClienteEncuesta")
     *
     * Documentación para la función 'getEditInfoCltEncuestaPend'
     * Método encargado de editar las encuestas según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 24-12-2019
     * 
     * @return array  $objResponse
     */
    public function editInfoClienteEncuestaAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado              = $request->query->get("strEstado") ? $request->query->get("strEstado"):'PENDIENTE';
        $strUsuarioCreacion     = $request->query->get("usuarioCreacion") ? $request->query->get("usuarioCreacion"):'CRONTAB';
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
}
