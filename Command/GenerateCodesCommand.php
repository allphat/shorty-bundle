<?php

namespace Alphat\Bundle\ShortyBundle\Command;

use Alphat\Bundle\ShortyBundle\Manager\ShortyManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GenerateCodesCommand extends ContainerAwareCommand
{
    const DEFAULT_LIMIT = 1000;

    protected function configure()
    {
        $this
        ->setName('shorty:codes:generate')
        ->setDescription('Generates short codes')
        ->setHelp("This command allows you to generate short codes")
        ->addArgument('number', InputArgument::OPTIONAL, 'number to generate (default 1000)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = $input->getArgument('number');
        if (!$number) {
            $number = self::DEFAULT_LIMIT;
        }

        $manager = $this->getContainer()->get('shorty.manager');

        while ($number > 0) {
            $created = $this->create($manager);
            if ($created) {
                $number--;
            }

            if ($number % 100 === 0) {
                $manager->saveEntity();
            }
        }
    }

    /**
     * generates and nsert uri in shorty_generated table
     * @param Alphat\Bundle\ShortyBundle\Manager\ShortyManager $manager
     * @return booolean
     */
    protected function create(ShortyManager $manager)
    {
        try {
            $manager->createEntity();

            return true;

        } catch (\UniqueConstraintViolationException $e) {
           echo'duplicate';
           return false;
        }
    }
}