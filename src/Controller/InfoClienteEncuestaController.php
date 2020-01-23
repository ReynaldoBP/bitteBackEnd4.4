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
            $objSql = $em->getConnection()->prepare('CALL massvisi_bitte.ValidarPuntaje');
            $objSql->execute(); 
           
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
