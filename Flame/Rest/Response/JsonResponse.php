<?php
/**
 * Class Json
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 19.08.13
 */
namespace Flame\Rest\Response;

use Nette\Object;
use Nette;

class JsonResponse extends Object implements Nette\Application\IResponse
{
	/** @var array|\stdClass */
	private $payload;

	/** @var string */
	private $contentType;

	/**
	 * @param  array|\stdClass|null  payload
	 * @param  string    MIME content type
	 */
	public function __construct($payload, $contentType = NULL)
	{
		$this->payload = $payload;
		$this->contentType = $contentType ? $contentType : 'application/json';
	}

	/**
	 * @return array|\stdClass
	 */
	final public function getPayload()
	{
		return $this->payload;
	}

	/**
	 * Returns the MIME content type of a downloaded file.
	 * @return string
	 */
	final public function getContentType()
	{
		return $this->contentType;
	}

	/**
	 * Sends response to output.
	 *
	 * @param Nette\Http\IRequest $httpRequest
	 * @param Nette\Http\IResponse $httpResponse
	 * @return void
	 */
	public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse)
	{
		$httpResponse->setContentType($this->contentType);
		$httpResponse->setExpiration(FALSE);

		if($this->payload !== null) {
			echo Nette\Utils\Json::encode($this->payload);
		}
	}

}