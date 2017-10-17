<?php

namespace Ruvents\ApiBundle\Normalizer;

use Ruvents\ApiBundle\Helper;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

abstract class AbstractApiNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * {@inheritdoc}
     */
    final public function supportsNormalization($data, $format = null, array $context = [])
    {
        return ($context[Helper::RUVENTS_API] ?? false) && $this->supportsApiNormalization($data, $format, $context);
    }

    abstract protected function supportsApiNormalization($data, $format = null, array $context = []): bool;
}
