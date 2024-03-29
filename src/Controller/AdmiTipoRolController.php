<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\AdmiTipoRol;
use Doctrine\ORM\EntityManagerInterface;
class AdmiTipoRolController extends AbstractController
{
    /**
     * @Route("/getTipoRol")
     */
    public function getTipoRolAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strEstado             = $request->query->get("estado") ? $request->query->get("estado"):'';
        $strDescripcion        = $request->query->get("descripcion") ? $request->query->get("descripcion"):'';
        $intIdTipoRol          = $request->query->get("idTipoRol") ? $request->query->get("idTipoRol"):'';
        $arrayTipoRol           = array();
        $strMensajeError       = '';
        $strStatus             = 400;
        $objResponse           = new Response;
        try
        {
            $arrayParametros = array('estado'      => $strEstado,
                                     'descripcion' => $strDescripcion,
                                     'idTipoRol'   => $intIdTipoRol);
                                     
            $arrayTipoRol     = $this->getDoctrine()
                                     ->getRepository(AdmiTipoRol::class)
                                     ->getTipoRol($arrayParametros);
            if( isset($arrayTipoRol['error']) && !empty($arrayTipoRol['error']) ) 
            {
                $strStatus  = 404;
                throw new \Exception($arrayTipoRol['error']);
            }
        }
        catch(\Exception $ex)
        {
            $strMensajeError = "Fallo al realizar la búsqueda, intente nuevamente.\n ". $ex->getMessage();
        }
        $arrayTipoRol['error'] = $strMensajeError;
        $objResponse->setContent(json_encode(array(
                                            'status'    => $strStatus,
                                            'resultado' => $arrayTipoRol,
                                            'succes'    => true
                                            )
                                        ));
        $objResponse->headers->set('Access-Control-Allow-Origin', '*');
        return $objResponse;
    }
}
