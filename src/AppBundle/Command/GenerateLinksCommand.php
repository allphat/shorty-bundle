<?php

namespace AppBundle\Command;

use AppBundle\Entity\ShortyGeneratedEntity;
use AppBundle\Shortener\Shortener;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GenerateLinksCommand extends ContainerAwareCommand
{
    const DEFAULT_LIMIT = 1000;

    protected function configure()
    {
        $this
        ->setName('shorty:links:generate')
        ->setDescription('Generates uri for shor links')
        ->setHelp("This command allows you to generate short uris")
        ->addArgument('number', InputArgument::OPTIONAL, 'number to generate (default 1000)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = $input->getArgument('number');
        if (!$number) {
            $number = self::DEFAULT_LIMIT;
        }
        $manager = $this->getContainer()->get('shorty_manager');
        while ($number > 0) {
            $created = $this->createEntry();
            if ($created) {
                $number--;
            }
        }
    }

    /**
     * generates and nsert uri in shorty_generated table
     * @return [type] [description]
     */
    protected function createEntry()
    {
        try {
            $shortyGenerated = new ShortyGeneratedEntity();
            $shortyGenerated->setIsUsed(false);
            $shortyGenerated->setCode(Shortener::generateRandomUri());

            $this->getContainer()->get('doctrine')
                ->getRepository('AppBundle:ShortyGeneratedEntity')
                ->save($shortyGenerated);

            return true;
        } catch (\UniqueConstraintViolationException $e) {
           echo'duplicate';
           return false;
        }
    }
}