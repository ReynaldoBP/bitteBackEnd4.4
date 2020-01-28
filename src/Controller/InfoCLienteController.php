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
            '<!DOCTYPE html>
            <html lang="en">
            <head>
            <title>ENJOY YOUR BITTE </title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

            <style>
                .text {
                  color: #FFF;
                  margin: 0 auto;
                  text-align: center;
                  font-weight: 700;
                  font: italic bold 100px Georgia, Serif;
                  text-shadow: -4px 3px 0 #72A5E4, -14px 7px 0 #0a0e27;
                }

                .text-2 {
                  color: #FFF;
                  margin: 0 auto;
                  text-align: center;
                  font-weight: 300;
                  font: italic bold 50px Georgia, Serif;
                  text-shadow: -4px 3px 0 #72A5E4, -14px 7px 0 #0a0e27;
                }
            </style>

            </head>
            <body  style = "background-image: url("/public/images/iconoBitte.jpeg");background-repeat: repeat;background-size: 300px 300px;" >
                <div style = "background:rgb(0,0,0,0.5);height: 70rem;">

                
            <div class="text-center" style="padding-top: 7em;" >  <!--
                text-shadow: 1px 1px 2px black, 0 0 1em #72A5E4, 0 0 0.2em #72A5E4;
            -->
            <h1 class="text" style = "color: #ffffff;">ENJOY YOUR BITTE </h1>
            <p class="text-2" style = "color: #ffffff;">Se ha completado tu registro!</p> 
            </div>
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
