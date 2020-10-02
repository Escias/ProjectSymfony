<?php


namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendDailyMailCommand extends Command
{
    protected static $defaultName = 'app:sendNotifMail';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Send a mail.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to send a mail...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->sendEmail();

        // ... put here the code to run in your command

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }

    public function sendEmail()
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('testytastytoast@mailinator.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);

        return new Response();

    }

    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        parent::__construct();
    }
}