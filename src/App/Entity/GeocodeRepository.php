<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class GeocodeRepository extends EntityRepository
{
    /**
     * @param array $latBoundary
     * @param array $lngBoundary
     * @return mixed
     */
    public function findAllByBoundaries(array $latBoundary, array $lngBoundary)
    {
        $qb = $this->createQueryBuilder('g');
        $qb->where($qb->expr()->andX(
            $qb->expr()->between('g.latitude', ':minLat', ':maxLat'),
            $qb->expr()->between('g.longitude', ':minLng', ':maxLng')
        ));
        $qb->setParameters([
            'minLat' => $latBoundary['min'],
            'maxLat' => $latBoundary['max'],
            'minLng' => $lngBoundary['min'],
            'maxLng' => $lngBoundary['max'],
        ]);

        return $qb->getQuery()->getResult();
    }
}
