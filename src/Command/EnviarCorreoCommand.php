<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EnviarCorreoCommand extends Command
{
    protected static $defaultName = 'app:enviarCorreo';

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
            ->addArgument('correo', InputArgument::REQUIRED, 'correo')
            ->addArgument('cuerpo', InputArgument::REQUIRED, 'cuerpo')
            ->addArgument('encabezado', InputArgument::REQUIRED, 'encabezado')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io     = new SymfonyStyle($input, $output);
        $correo = $input->getArgument('correo');
        $cuerpo = $input->getArgument('cuerpo');
        $encabezado = $input->getArgument('encabezado');

        if ($correo) {
            $io->note(sprintf('You passed: %s', $correo));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $objMessage =  (new \Swift_Message())
                                        ->setSubject($encabezado)
                                        ->setFrom("notificaciones@bitte.app")
                                        ->setTo($correo)
                                        ->setBody($cuerpo,'text/html');
       
       $strRespuesta = $this->container->get('mailer')->send($objMessage);
       $io->success($strRespuesta);

        return 0;
    }
}
