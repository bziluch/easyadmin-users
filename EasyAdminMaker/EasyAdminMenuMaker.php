<?php

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class EasyAdminMenuMaker extends AbstractMaker
{

    /**
     * Return the command name for your maker (e.g. make:report).
     */
    public static function getCommandName(): string
    {
        return 'make:easy-admin-menu';
    }

    /**
     * Configure the command: set description, input arguments, options, etc.
     *
     * By default, all arguments will be asked interactively. If you want
     * to avoid that, use the $inputConfig->setArgumentAsNonInteractive() method.
     * @param Command $command
     * @param InputConfiguration $inputConfig
     */
    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command->setDescription('Creates classes with table data')
            ->addArgument('schema', InputArgument::REQUIRED, sprintf('The name of database schema to model '));
    }

    /**
     * Configure any library dependencies that your maker requires.
     * @param DependencyBuilder $dependencies
     */
    public function configureDependencies(DependencyBuilder $dependencies)
    {
        // TODO: Implement configureDependencies() method.
    }

    /**
     * Called after normal code generation: allows you to do anything.
     * @param InputInterface $input
     * @param ConsoleStyle $io
     * @param Generator $generator
     */
    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $schema = $input->getArgument('schema');
        $io->success("Now generating Table classes for schema " . $schema);
        $userName = $_SERVER['DATABASE_USER'];
        $pass = $_SERVER['DATABASE_PASSWORD'];

        $mysql = new MysqlConnection($userName,$pass, $schema);
        $schemaMaker = new SchemaMaker($mysql,$schema);
        $schemaMaker->setSchemaTableList();
        $schemaMaker->createAllSchemaClasses();

        foreach ($schemaMaker->getTablesList() as $table){
        $io->success("Created Class for table " . implode('-', $table));
    }

    }

    public function interact(InputInterface $input, ConsoleStyle $io, Command $command)
    {
        $io->title('Create the database table classes...');
        $value = '';

        if (null === $input->getArgument('schema')) {
            $argument = $command->getDefinition()->getArgument('schema');
            $question = new Question($argument->getDescription());
            $value = $io->askQuestion($question);
            $input->setArgument('schema', $value);

        }
        $value = $input->getArgument('schema');
        $io->success("Table classes were made from schema " . $value);

        /*$input->setArgument('schema', $io->ask(
            'What is the name of the database schema',
            null,
            [Validator::class, 'notBlank']
        )
        );*/
    }
}