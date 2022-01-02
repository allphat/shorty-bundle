<?php

namespace Allphat\ShortyBundle\Command;

use Allphat\ShortyBundle\Manager\ShortyManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GenerateCodesCommand extends Command
{
    const DEFAULT_LIMIT = 1000;
    
    /**
     * @var ShortyManager
     */
    private $shortyManager;

    public function __construct(ShortyManager $shortyManager)
    {
        $this->shortyManager = $shortyManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->setName('shorty:codes:generate')
        ->setDescription('Generates short codes')
        ->setHelp("This command allows you to generate short codes")
        ->addArgument('number', InputArgument::OPTIONAL, 'number to generate (default 1000)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $number = $input->getArgument('number');
        if (!$number) {
            $number = self::DEFAULT_LIMIT;
        }

        while ($number > 0) {
            $created = $this->create();
            if ($created) {
                $number--;
            }

            if ($number % 100 === 0) {
                $this->shortyManager->save();
            }
	   }

	   return Command::SUCCESS;
    }

    /**
     * generates and insert uri in shorty_generated table
     */
    protected function create(): bool
    {
        try {
            $this->shortyManager->createEntity();

            return true;
        } catch (UniqueConstraintViolationException $e) {
           return false;
        }
    }
}