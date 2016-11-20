<?php

namespace App\Controller;

use App\Entity\Geocode;
use App\Entity\Internal\Point;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GeocodesController extends Controller
{
    /**
     * @param string $lat
     * @param string $lng
     * @return array
     */
    public function indexAction($lat, $lng)
    {
        if (!$lat || !$lng) {
            throw new BadRequestHttpException('Latitude ant longitude parameters are required.');
        }

        $start = new Point(floatval($lat), floatval($lng));

        $service = $this->get('distance');

        $boundaries = $service->getBoundaries($start);

        /** @var Geocode[] $geocodes */
        $geocodes = $this->getRepository(Geocode::class)->findAllByBoundaries($boundaries['lat'], $boundaries['lng']);

        // weed out all results that turns out to be too far
        foreach ($geocodes as $key => $geocode) {
            if ($service->betweenPoints($start, $geocode->getPoint()) > $this->getParameter('travel_distance')) {
                unset($geocodes[$key]);
            }
        }

        $result = [];

        if ($geocodes) {
            /** @var GeoCode[] $result */
            $result = $this->get('distance')->getTripPoints($start, $geocodes); // find route
        }

        return [
            'breweries' => $result,
            'start' => $start,
        ];
    }
}
