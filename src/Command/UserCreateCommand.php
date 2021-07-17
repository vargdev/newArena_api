<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\UserService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:user:create',
    description: 'Add a short description for your command',
)]
class UserCreateCommand extends Command
{
    private const SUPER_ADMIN_OPTION = 'super-admin';

    public function __construct(
        private UserService $userService,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addOption(self::SUPER_ADMIN_OPTION, null, InputOption::VALUE_NONE, 'Set super-admin role')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $io->ask('Email');

        if (empty($email)) {
            throw new \InvalidArgumentException('Email can not empty!');
        }

        $password = $io->askHidden('Password');
        if (empty($password)) {
            throw new \InvalidArgumentException('Password can not empty!');
        }

        $this->userService->createOrUpdate(
            $email,
            $password,
            $input->getOption(self::SUPER_ADMIN_OPTION)
        );

        $io->success('User was create or updated!');

        return Command::SUCCESS;
    }
}
