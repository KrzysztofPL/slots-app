<?php

namespace App\UI\Command;

use App\Application\Slots\Update\UseCase\UpdateAllDoctorSlots;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'docplanner:pull-slots',
    description: 'Add a short description for your command',
)]
final class DocplannerPullSlotsCommand extends Command
{
    private UpdateAllDoctorSlots $updateAllDoctorSlots;

    public function __construct(UpdateAllDoctorSlots $updateAllDoctorSlots)
    {
        parent::__construct();
        $this->updateAllDoctorSlots = $updateAllDoctorSlots;
    }

    // TODO this command could be used just to feed the command bus, whereas another long lived process would process the actual fetching
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->updateAllDoctorSlots->execute();
        $io->success('Slots pulled');

        return Command::SUCCESS;
    }
}
