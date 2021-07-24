<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\UserService;
use http\Exception\InvalidArgumentException;
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
    private const ADMIN_OPTION = 'admin';
    private const USER_OPTION = 'user';

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
            ->addOption(self::ADMIN_OPTION, null, InputOption::VALUE_NONE, 'Set admin role')
            ->addOption(self::USER_OPTION, null, InputOption::VALUE_NONE, 'Set user role')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $io->ask('Email');

        if (empty($email)) {
            throw new InvalidArgumentException('Email cannot be empty!');
        }

        $password = $io->askHidden('Password');
        if (empty($password)) {
            throw new InvalidArgumentException('Password cannot be empty!');
        }

        $username = $io->ask('Username');
        if (empty($username)) {
            throw new InvalidArgumentException('Username cannot be empty!');
        }

        $this->userService->createOrUpdate(
            $email,
            $password,
            $username,
            $input->getOption(self::SUPER_ADMIN_OPTION),
            $input->getOption(self::ADMIN_OPTION),
            $input->getOption(self::USER_OPTION)
        );

        $io->success('User was create or updated!');

        return Command::SUCCESS;
    }
}
