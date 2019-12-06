<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\InfoCliente;
class InfoCLienteController extends Controller
{
    /**
     * @Route("/editCliente")
     *
     * Documentación para la función 'editCliente'
     * Método encargado de editar los clientes según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 03-10-2019
     * 
     * @return array  $objResponse
     *
     * @author Kevin Baque
     * @version 1.1 03-12-2019 - Se retorna pagina de bienvenida.
     *
     */
    public function editClienteAction(Request $request)
    {
        error_reporting( error_reporting() & ~E_NOTICE );

        $strEstado             = $request->query->get("estado") ? $request->query->get("estado"):'ACTIVO';
        $intIdCliente          = $request->query->get("idCliente") ? $request->query->get("idCliente"):'';
        $intIdClienteRS        = $request->query->get("jklasdqweuiorenm") ? $request->query->get("jklasdqweuiorenm"):'';
        $strMensajeError       = '';
        $strStatus             = 400;
        $objResponse           = new Response;
        $em                    = $this->getDoctrine()->getManager();
        try
        {
            if(!empty($intIdClienteRS) && $intIdClienteRS!= NULL)
            {
                $intIdCliente = substr($intIdClienteRS,16,strlen($intIdClienteRS));
                $strEstado    = 'ACTIVO';
            }
            $em->getConnection()->beginTransaction();
            $objCliente = $this->getDoctrine()
                               ->getRepository(InfoCliente::class)
                               ->findOneBy(array('id'=>$intIdCliente));
            if(!is_object($objCliente) || empty($objCliente))
            {
                throw new \Exception('No existe cliente con la identificación enviada por parámetro.');
            }
            if(!empty($strEstado))
            {
                $objCliente->setESTADO(strtoupper($strEstado));
            }
            $objCliente->setUSRMODIFICACION($strUsuarioCreacion);
            $objCliente->setFEMODIFICACION($strDatetimeActual);
            $em->persist($objCliente);
            $em->flush();
            $strMensajeError = 'Cliente editado con exito.!';
        }
        catch(\Exception $ex)
        {
            if ($em->getConnection()->isTransactionActive())
            {
                $strStatus = 404;
                $em->getConnection()->rollback();
            }
            $strMensajeError = "Fallo al editar el cliente, intente nuevamente.\n ". $ex->getMessage();
        }
        if ($em->getConnection()->isTransactionActive())
        {
            $em->getConnection()->commit();
            $em->getConnection()->close();
        }
        if(!empty($intIdClienteRS) && $intIdClienteRS!= NULL)
        {
            //header('Location: https://bitte.app/pages/login');
            //return $this->render('http://www.google.com/');
            return new Response(
            '<html lang="en">
            <head>
            <title>Bootstrap Example</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            </head>
            <body>

            <div class="jumbotron text-center" style = "background-color:#ffffff">
            <h1>Bienvenido al mundo BITTE</h1>
            <p>Se ha completado tu registro!</p> 
            </div>

            </body>
            </html>');
            
        }
        else
        {
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

}
