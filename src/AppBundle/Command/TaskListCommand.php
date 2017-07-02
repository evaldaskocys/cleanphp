<?php

namespace AppBundle\Command;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TaskListCommand
 *
 * @package AppBundle\Command
 */
class TaskListCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('task:list')
            ->setDescription('List tasks')
            ->addArgument(
                'author',
                InputArgument::OPTIONAL,
                'Filter by author ID'
            )
            ->addOption(
                'new',
                null,
                InputOption::VALUE_NONE,
                'Filter only new tasks'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $author = $input->getArgument('author');
        $new = $input->getOption('new');

        $rows = $this->toTableRows($this->getTasks($author, $new));
        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Created', 'Title', 'Author', 'Assignee'])
            ->setRows($rows)
        ;
        $table->render();
    }

    /**
     * @param $tasks
     * @return array
     */
    private function toTableRows($tasks)
    {
        $rows = [];
        foreach ($tasks as $task) {
            $rows[] = [
                $task->getId(),
                $task->getDateCreated()->format('Y-m-d H:i:s'),
                $task->getTitle(),
                $task->getAuthor()->getName(),
                $task->getAssignee() ? $task->getAssignee()->getName() : '',
            ];
        }
        return $rows;
    }

    /**
     * @param $author
     * @param $new
     * @return \AppBundle\Entity\Task[]|array
     */
    private function getTasks($author, $new)
    {
        $repo = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Task');
        if (!$author && !$new) {
            return $repo->findAll();
        }
            
        $filter = [];
        if ($author) {
            $filter['author'] = $author;
        }
        if ($new) {
            $filter['status'] = Task::STATUS_NEW;
        }

        return $repo->findBy($filter);
    }
}
