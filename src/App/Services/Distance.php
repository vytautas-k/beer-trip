<?php

namespace App\Services;

use App\Entity\Internal\Point;
use Doctrine\Common\Collections\ArrayCollection;

class Distance
{
    private $distance;
    private $radius;

    /**
     * @param $distance
     * @param $radius
     */
    public function __construct($distance, $radius)
    {
        $this->distance = $distance;
        $this->radius = $radius;
    }

    /**
     * @param Point $point
     * @return array
     */
    public function getBoundaries(Point $point)
    {
        return [
            'lat' => [
                'min' => $point->getLatitude() - rad2deg($this->distance / $this->radius),
                'max' => $point->getLatitude() + rad2deg($this->distance / $this->radius),
            ],
            'lng' => [
                'min' => $point->getLongitude() - rad2deg($this->distance / $this->radius / cos(deg2rad($point->getLatitude()))),
                'max' => $point->getLongitude() + rad2deg($this->distance / $this->radius / cos(deg2rad($point->getLatitude()))),
            ],
        ];
    }

    /**
     * @param Point $one
     * @param Point $two
     * @return float
     */
    public function betweenPoints(Point $one, Point $two)
    {
        // convert latitude/longitude degrees for both coordinates to radians: radian = degree * π / 180
        $lat1 = deg2rad($one->getLatitude());
        $lng1 = deg2rad($one->getLongitude());
        $lat2 = deg2rad($two->getLatitude());
        $lng2 = deg2rad($two->getLongitude());

        // calculate great-circle distance
        $distance = acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lng1 - $lng2));

        // distance in human-readable format: earth's radius in km = ~6371
        return $this->radius * $distance;
    }

    /**
     * @param Point $point
     * @param array $items
     * @return ArrayCollection
     */
    public function getTripPoints(Point $point, array $items)
    {
        $points = new ArrayCollection();
        $start = $point;
        $traveled = 0;

        while (true) {
            $usedItem = null;
            $minDistance = $this->distance;

            foreach ($items as $key => $geocode) {
                // get distance between each point
                $resultDistance = $this->betweenPoints($point, $geocode->getPoint());

                // store point if it has lowest distance
                if ($resultDistance < $minDistance) {
                    $minDistance = $resultDistance;
                    $usedItem = $key;
                    $found = $geocode;
                }
            }

            $point = new Point($found->getLatitude(), $found->getLongitude());

            // check if distance from current point to starting point is not bigger than needs for return
            if (($this->distance - $traveled - $minDistance) < $this->betweenPoints($point, $start)) {
                break;
            }

            $found->setDistance($minDistance);
            $points->add($found);

            $traveled += $minDistance;

            if ($usedItem) {
                unset($items[$usedItem]);
            }
        }

        return $points;
    }
}
