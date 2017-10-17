<?php

namespace Ruvents\ApiBundle\Response;

use Symfony\Component\HttpFoundation\StreamedResponse;

class ApiStreamedIteratorResponse extends StreamedResponse
{
    /**
     * @var iterable
     */
    private $data;

    /**
     * @var null|callable
     */
    private $normalizer;

    /**
     * @param iterable      $data
     * @param null|callable $normalizer
     * @param int           $statusCode
     * @param array         $headers
     */
    public function __construct($data = [], callable $normalizer = null, int $statusCode = 200, array $headers = [])
    {
        $this->data = $data;
        $this->normalizer = $normalizer;
        $this->callback = function () {
            echo '[';

            $once = false;

            foreach ($this->data as $row) {
                if ($once) {
                    echo ',';
                } else {
                    $once = true;
                }

                if (null !== $this->normalizer) {
                    $row = call_user_func($this->normalizer, $this->data);
                }

                echo json_encode($row, ApiResponse::DEFAULT_ENCODING_OPTIONS);
                flush();
            }

            echo ']';
            flush();
        };

        parent::__construct(null, $statusCode, $headers);

        if (!$this->headers->has('Content-Type')) {
            $this->headers->set('Content-Type', ApiResponse::DEFAULT_CONTENT_TYPE);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function create($data = [], $status = 200, $headers = [])
    {
        return new static($data, null, $status, $headers);
    }

    /**
     * @param iterable $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param null|callable $normalizer
     *
     * @return $this
     */
    public function setNormalizer(callable $normalizer = null)
    {
        $this->normalizer = $normalizer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCallback(callable $callback)
    {
        throw new \LogicException('The callback cannot be overridden on ApiStreamedIteratorResponse.');
    }
}
