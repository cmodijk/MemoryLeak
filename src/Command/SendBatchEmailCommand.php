<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class SendBatchEmailCommand extends Command
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        parent::__construct();

        $this->mailer = $mailer;
    }

    protected function configure(): void
    {
        $this->setName('send:batch:email');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        for ($x = 0; $x < 100; $x++) {
            $email = (new Email())
                ->to('my-test@test.com');

            $this->mailer->send($email);
        }

        return self::SUCCESS;
    }
}
