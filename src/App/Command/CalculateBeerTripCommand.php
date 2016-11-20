<?php

namespace App\Command;

use App\Entity\Geocode;
use App\Entity\Internal\Point;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Stopwatch\Stopwatch;

class CalculateBeerTripCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('beertrip:calculate')
            ->setDescription('Calculates beer trip route')
            ->setHelp("This command allows to get list of breweries which can be visited.")
            ->addArgument('lat', InputArgument::REQUIRED, 'Latitude value of start coordinate.')
            ->addArgument('lng', InputArgument::REQUIRED, 'Longitude value of start coordinate.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('process');

        $io = new SymfonyStyle($input, $output);

        $start = new Point($input->getArgument('lat'), $input->getArgument('lng'));

        $service = $this->getContainer()->get('distance');

        $boundaries = $service->getBoundaries($start);

        /** @var Geocode[] $geocodes */
        $geocodes = $this->getContainer()->get('app.entity.geocode_repository')->findAllByBoundaries($boundaries['lat'], $boundaries['lng']);

        // weed out all results that turns out to be too far
        foreach ($geocodes as $key => $geocode) {
            if ($service->betweenPoints($start, $geocode->getPoint()) > $this->getContainer()->getParameter('travel_distance')) {
                unset($geocodes[$key]);
            }
        }

        /** @var GeoCode[] $result */
        $result = $this->getContainer()->get('distance')->getTripPoints($start, $geocodes); // find route

        if ($result) {
            $io->text([
                sprintf('<info>Found %d beer factories:</info>', $result->count()),
                sprintf(' -> HOME: %s, %s distance %d km', $start->getLatitude(), $start->getLongitude(), 0),
            ]);

            $total = 0;
            $beers = [];

            foreach ($result as $point) {
                $brewery = $point->getBrewery();
                $distance = round($point->getDistance());
                $total += $distance;
                $beers = array_merge($beers, $brewery->getBeers()->toArray());

                $io->text(sprintf(' -> [%d] %s: %s, %s distance %d km', $brewery->getId(), $brewery->getName(), $point->getLatitude(), $point->getLongitude(), $distance));
            }

            $distanceToStart = $this->getContainer()->get('distance')->betweenPoints($point->getPoint(), $start);

            $io->text(sprintf(' -> HOME: %s, %s distance %d km', $start->getLatitude(), $start->getLongitude(), $distanceToStart));

            $io->newLine();
            $io->text(sprintf('Total distance traveled:<comment> %d km</comment>', $total + $distanceToStart));

            $io->newLine(2);
            $io->text(sprintf('<info>Collected %d types of beer:</info>', count($beers)));

            foreach ($beers as $beer) {
                $io->text(sprintf(' -> %s', $beer->getName()));
            }
        } else {
            $io->text('<question>No beer factories were found. Maybe helicopter broke down?</question>');
        }

        $event = $stopwatch->stop('process');

        $io->newLine();
        $io->text(sprintf('Program took: %s ms', $event->getDuration()));
        $io->newLine();
    }
}
