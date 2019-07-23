<?php
namespace App\Command;

use App\Entity\GrumpyPuppy;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GrumpyPuppyCommand extends Command
{
    private $entityManager;

    protected static $defaultName = 'app:create-grumpy-puppy';

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    // ...

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
    $grumpyPuppy = new GrumpyPuppy();
    $grumpyPuppy->setBroken(0.12345678901);

    $output->writeln("Microtime: " . $grumpyPuppy->getBroken());

        $this->entityManager->persist($grumpyPuppy);
    $this->entityManager->flush();

        $output->writeln('GrumpyPuppy successfully generated!');
    }
}
