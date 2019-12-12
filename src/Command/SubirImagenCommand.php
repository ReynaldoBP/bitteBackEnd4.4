<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\InfoContenidoSubido;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SubirImagenCommand extends Command
{
    protected static $defaultName = 'app:subirImagen';

    private $container;

    public function __construct(ContainerInterface $container)
    {
      parent::__construct();
      $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('idContenido', InputArgument::REQUIRED, 'idContenido')
            ->addArgument('imagen', InputArgument::REQUIRED, 'imagen')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io          = new SymfonyStyle($input, $output);
        $arg1        = $input->getArgument('arg1');
        $idContenido = $input->getArgument('idContenido');
        $imgBase64   = $input->getArgument('imagen');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $base_to_php   = explode(',', $imgBase64);
        $data          = base64_decode($base_to_php[1]);
        $ext           = explode("/",explode(";",$base_to_php[0])[0])[1];
        $pos           = strpos($ext, "ico");
        if($pos > 0)
        {
            $ext = "ico";
        }
        $nombreImg     = ("bitte_".date("YmdHis").".".$ext);
        $strRutaImagen = ("/var/www/bitteBackEnd4.4/public/images"."/".$nombreImg);
        file_put_contents($strRutaImagen,$data);

        $em = $this->container->get('doctrine')->getManager();
        $em->getConnection()->beginTransaction();

        $objContenido = $this->container->get('doctrine')
                                    ->getRepository(InfoContenidoSubido::class)
                                    ->find($idContenido);
        if(!is_object($objContenido) || empty($objContenido))
        {
            throw new \Exception('No existe el contenido con identificador enviada por parámetro.');
        }
        else
        {
            $objContenido->setIMAGEN($strRutaImagen);
            $em->persist($objContenido);
            $em->flush();
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
