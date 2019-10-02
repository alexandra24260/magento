<?php
declare(strict_types=1);

namespace Epam\FirstModule\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Json
 */
class Json extends Action
{
    /**
     * @var JsonFactory
     */
    private $jsonResultFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonResultFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonResultFactory
    )
    {
        parent::__construct($context);
        $this->jsonResultFactory = $jsonResultFactory;
        $this->setParams();
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $mode = 'default';
        $result = $this->jsonResultFactory->create();
        $parameters = $this->getRequest()->getParams();
        if (isset($parameters['mode'])) {
            if ($parameters['mode'] === 'shuffle') {
                shuffle($this->dataArray['params']);
                $mode = $parameters['mode'];
            } elseif ($parameters['mode'] === 'sort') {
                sort($this->dataArray['params']);
                $mode = $parameters['mode'];
            }
        }
        $result->setData([
            'mode' => $mode,
            'params' => $this->dataArray,
        ]);

        return $result;
    }

    /**
     * Sets initial params for $this->data.
     */
    private function setParams()
    {
        $this->dataArray['params'] = ['value1', 'value2', 'value3'];
    }
}