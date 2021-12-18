<?php
// api/src/Serializer/MediaObjectNormalizer.php

namespace App\Serializer;

use App\Controller\MailController;
use App\Entity\Etudiant;
use App\Entity\MediaObject;
use App\Repository\EtudiantRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Vich\UploaderBundle\Storage\StorageInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

final class MediaObjectNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private const ALREADY_CALLED = 'MEDIA_OBJECT_NORMALIZER_ALREADY_CALLED';

    private $etudiantRepository;
    private $manager;
    public function __construct(
        private StorageInterface $storage,
        EtudiantRepository $etudiantRepository,
        EntityManagerInterface $manager,
        
        )
    {
        $this->etudiantRepository = $etudiantRepository;
        $this->manager = $manager;
    }

    public function normalize($object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $context[self::ALREADY_CALLED] = true;

        $object->contentUrl = $this->storage->resolveUri($object, 'file');
        $etudiant = $this->etudiantRepository->findOneBy([],['id' => 'desc']);

        if(strpos($object->filePath, 'bac') !== false )
        {
        $etudiant->setBacBenef($object->contentUrl);
        }else if(strpos($object->filePath, 'cni') !== false )
        {
            $etudiant->setCni($object->contentUrl);
        }
        else
        {
            $etudiant->setPhoto($object->contentUrl);
        }
        $etudiant->setMatricule(mt_rand(0,9999999999));
        $this->manager->flush($etudiant);
        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        if (isset($context[self::ALREADY_CALLED])) {
            return false;
        }

        return $data instanceof MediaObject;
    }
}