<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EnviarCorreoCommand extends Command
{
    protected static $defaultName = 'app:enviarCorreo';

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
        $io = new SymfonyStyle($input, $output);
        $correo = $input->getArgument('correo');
        $cuerpo = $input->getArgument('cuerpo');
        $encabezado = $input->getArgument('encabezado');

        if ($correo) {
            $io->note(sprintf('You passed: %s', $correo));
        }

        if ($input->getOption('option1')) {
            // ...
        }
        $transport =( new \Swift_SmtpTransport('gator3009.hostgator.com',25))
                                           ->setUsername('notificaciones@bitte.app')
                                           ->setPassword('Bitte2019');
        $mailer = new \Swift_Mailer($transport);

        $objMessage =  (new \Swift_Message())
                                        ->setSubject($encabezado)
                                        ->setFrom("notificaciones_bitte@massvision.tv")
                                        ->setTo($correo)
                                        ->setBody($cuerpo);
       $strRespuesta =  $mailer->send($objMessage);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
