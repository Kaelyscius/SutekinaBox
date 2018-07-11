<?php

namespace App\SutekinaBox;


use App\Entity\SutekinaBox;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\Registry;

class SutekinaBoxRequestHandler
{

    private $em;

    private $assetsDirectory;

    private $sutekinaFactory;
    private $packages;


    /**
     * SutekinaBoxRequestHandler constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     * @param \App\SutekinaBox\SutekinaBoxFactory  $sutekinaBoxFactory
     *
     * @param \Symfony\Component\Workflow\Registry $registry
     *
     * @internal  param $em
     */
    public function __construct(EntityManagerInterface $entityManager, SutekinaBoxFactory $sutekinaBoxFactory)
    {
        $this->em = $entityManager;
        $this->sutekina = $sutekinaBoxFactory;
    }

    public function handle(SutekinaBoxRequest $request) : SutekinaBox
    {
        #Appel a notre factory
        $sutekina = $this->sutekina->createFromSutekinaBoxRequest($request);

        #insertion en BDD
        $this->em->persist($sutekina);
        $this->em->flush();

        return $sutekina;

    }

    /**
     * @param \App\Entity\SutekinaBox $sutekinaBox
     *
     * @return \App\SutekinaBox\SutekinaBoxRequest
     */
    public function prepareSutekinaBoxFromRequest(SutekinaBox $sutekinaBox)
    {
        return SutekinaBoxRequest::createFromSutekinaBox($sutekinaBox);
    }

}