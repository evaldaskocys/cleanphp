<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TaskListCommand
 *
 * @package AppBundle\Command
 */
class UserSendMailCommand extends Command
{
    private $repo;

    public function __construct(EntityRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('user:name')
            ->setDescription('Get name of user')
            ->addArgument(
                'userId',
                InputArgument::REQUIRED,
                'User ID'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userId = $input->getArgument('userId');
        $user = $this->repo->find(['id' => $userId]);

        $output->writeln($user->getName());
    }
}
