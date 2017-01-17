<?php
namespace base\view;

use base\core\http\appResponse;
use GuzzleHttp\Psr7;

/**
 * Class View
 *
 * This class's main task is to handle
 * the Response object and define a render() method
 * to use as common rendering for all the view classes
 *
 * You can attach models to use them in the render
 * Method.
 *
 * @package base\view
 */
class View
{
    /** @var array */
	protected $models;
    /** @var appResponse */
	protected $response;

	public function __construct()
    {
        $this->response = new appResponse();
    }

    /**
     * @return array
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @param array $models
     */
    public function setModels($models)
    {
        $this->models = $models;
    }

    /**
     * shorten the body setting process
     *
     * @param resource|string|null|int|float|bool|StreamInterface|callable $body
     */
    public function setResponseBody( $body )
    {
        $this->response = $this->response->withBody(new Psr7\AppendStream([Psr7\stream_for($body)]));
    }

    /**
     *
     * prepare response when exception occurs.
     *
     * @param \Exception $ex
     */
    public function setException(\Exception $ex)
    {
        $this->response = $this->response->withStatus($ex->getCode(),$ex->getMessage());
    }


    /**
     * generate output based on response object.
     *
     * @return string
     */
    public function render()
    {
        $header = "HTTP/".$this->response->getProtocolVersion()
            ." ".$this->response->getStatusCode()
            ." ".$this->response->getReasonPhrase();
        header($header);
        echo $this->response->getBody();
    }
}