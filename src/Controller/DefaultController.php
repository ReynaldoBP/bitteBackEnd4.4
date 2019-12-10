<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\InfoUsuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\PhpProcess;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * Documentación para la función 'enviaCorreo'
     * Método encargado de enviar correo según los parámetros recibidos.
     * 
     * @author Kevin Baque
     * @version 1.0 26-08-2019
     * 
     * @return array  $objResponse
     * 
     * @author Kevin Baque
     * @version 1.1 03-12-2019 - Se cambia la manera de instanciar la librería de envio de correo.
     *
     * @author Kevin Baque
     * @version 1.2 09-12-2019 - Se agrega logica para enviar correos de manera asincrona
     *
     */
    public function enviaCorreo($arrayParametros)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $strAsunto        = $arrayParametros['strAsunto'] ? $arrayParametros['strAsunto']:'';
        $strMensajeCorreo = $arrayParametros['strMensajeCorreo'] ? $arrayParametros['strMensajeCorreo']:'';
        $strRemitente     = $arrayParametros['strRemitente'] ? $arrayParametros['strRemitente']:'';
        $strDestinatario  = $arrayParametros['strDestinatario'] ? $arrayParametros['strDestinatario']:'';
        $strRespuesta     = '';
        //$objMessage =  (new \Swift_Message('Hello Email'))
        $objMessage =  (new \Swift_Message())
                                        ->setSubject($strAsunto)
                                        ->setFrom($strRemitente)
                                        ->setTo($strDestinatario)
                                        ->setBody($strMensajeCorreo, 'text/html');
        //$strRespuesta = $this->get('mailer')->send($objMessage);
        //--------------
        $script = $this->get('mailer')->send($objMessage);
        $process = new PhpProcess('<?php ' . $script);
        $process->run();
        $output = $process->getOutput();
        $strRespuesta = json_decode($output);
        //--------------
        return $strRespuesta;
    }
    /**
     * Documentación para la función 'subir_fichero'
     * Método encargado de subir una imagen al servidor según los parámetros recibidos.
     * 
     * @author Jorge Bermeo
     * @version 1.0 12-09-2019
     * 
     * @return array  $nombreImg
     *
     * @author Kevin Baque
     * @version 1.1 09-12-2019 - Se agrega logica para subir imagen de manera asincrona.
     *
     */
    public function subirfichero($imgBase64)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $base_to_php   = explode(',', $imgBase64);
        $data          = base64_decode($base_to_php[1]);
        $ext           = explode("/",explode(";",$base_to_php[0])[0])[1];
        $pos           = strpos($ext, "ico");
        if($pos > 0)
        {
            $ext = "ico";
        }
        $nombreImg     = ("bitte_".date("YmdHis").".".$ext);
        $strRutaImagen = ("images"."/".$nombreImg);
        //file_put_contents($strRutaImagen,$data);
        //--------------
        $process = new PhpProcess('<?php ' . file_put_contents($strRutaImagen,$data));
        $process->run();
        $output = $process->getOutput();
        $strRespuesta = json_decode($output);
        //--------------
        return $nombreImg;
    }
    /**
     * Documentación para la función 'getImgBase64'
     * Método encargado de subir una imagen al servidor según los parámetros recibidos.
     * 
     * @author Jorge Bermeo
     * @version 1.0 12-09-2019
     * 
     * @return array  $data
     *
     * @author Kevin Baque
     * @version 1.1 09-12-2019 - Se agrega logica para obtener imagen de manera asincrona.
     *
     */
    public function getImgBase64($nameImg)
    {
        error_reporting( error_reporting() & ~E_NOTICE );
        $img = @file_get_contents("images/".$nameImg);
        $ext   = explode('.', $nameImg)[1];
        //$data = ("data:image/".$ext.";base64," . base64_encode($img));
        //--------------
        $process = new PhpProcess('<?php ' . ("data:image/".$ext.";base64," . base64_encode($img)));
        $process->run();
        $output = $process->getOutput();
        $data = json_decode($output);
        //--------------
        return $data;
    }
}
