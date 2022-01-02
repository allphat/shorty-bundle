<?php

namespace Tests\Allphat\ShortyBundle\Command;

use Allphat\ShortyBundle\Command\GenerateLinksCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateLinksCommandTest extends KernelTestCase
{
    public function testExecute(): void
    {
        $this->markTestSkipped('to be launched in integration suite');
        
        /** @phpstan-ignore-next-line */
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new GenerateLinksCommand());

        $command = $application->find('shorty:links:generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'number' => 1
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains('links generated', $output);
    }
}
