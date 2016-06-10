<?php

namespace AppBundle\Controller\Soap;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BookController.
 */
class BookController implements ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @Soap\Method("getBooks")
     * @Soap\Param("minDate", phpType="string")
     * @Soap\Param("maxDate", phpType="string")
     * @Soap\Param("minRate", phpType="float")
     * @Soap\Result(phpType="\AppBundle\Entity\Book[]")
     *
     * @param $minDate string
     * @param $maxDate string
     * @param $minRate float
     *
     * @return \AppBundle\Entity\Book[]
     */
    public function getBooksAction($minDate = null, $maxDate = null, $minRate = null)
    {
        /** @var \AppBundle\Repository\BookRepository $repo */
        $repo = $this->container->get('doctrine')->getManager()->getRepository('AppBundle:Book');
        $entities = $repo->findByConditions([
            'min_date' => $minDate,
            'max_date' => $maxDate,
            'min_rate' => $minRate,
        ]);

        return $entities->toArray();
    }
}
