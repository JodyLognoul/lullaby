<?php

namespace App\Infrastructure\Share\Serializer\Normalizer;

use App\Infrastructure\Share\Paginator\PaginatorInterface;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CollectionNormalizer implements NormalizerInterface
{
    const FORMAT = 'json';
    
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array()): array
    {
        $totalItems = null;

        if ($object instanceof PaginatorInterface) {
            $totalItems = $object->getTotalItems();
            $data['meta']['lastPage'] = (int) $object->getLastPage();
            $data['meta']['currentPage'] = (int) $object->getCurrentPage();
            $data['meta']['itemsPerPage'] = (int) $object->getItemsPerPage();
        } elseif (\is_array($object) || $object instanceof \Countable) {
            $totalItems = \count($object);
        }

        $data['meta']['totalItems'] = $totalItems;

        $data['data'] = [];
        foreach ($object as $obj) {
            $data['data'][] = $this->normalizer->normalize($obj, $format, $context);
        }

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return self::FORMAT === $format && is_iterable($data);
    }
}
