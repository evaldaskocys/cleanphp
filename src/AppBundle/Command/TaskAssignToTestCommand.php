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
class TaskAssignToTestCommand extends Command
{
    private $repoTask;
    private $repoUser;

    public function __construct(EntityRepository $repoTask, EntityRepository $repoUser)
    {
        $this->repoTask = $repoTask;
        $this->repoUser = $repoUser;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('task:assign:tester')
            ->setDescription('Get name of user')
            ->addArgument(
                'taskId',
                InputArgument::REQUIRED,
                'Task ID'
            )
            ->addArgument(
                'userId',
                InputArgument::REQUIRED,
                'User ID'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $taskId = $input->getArgument('taskId');
        $userId = $input->getArgument('userId');
        $task = $this->repoTask->find($taskId);
        $user = $this->repoUser->find($userId);

        $output->writeln($task->getTestingScenario());
        $output->writeln($user->getName());
    }
}
