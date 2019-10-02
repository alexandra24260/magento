<?php
declare(strict_types=1);

namespace Epam\FirstModule\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Raw
 */
class Raw extends Action
{
    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        // Set default parameters.
        $width = 400;
        $height = 200;
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $parameters = $this->getRequest()->getParams();
        // Check if parameters are correct.
        if (isset($parameters['w']) && is_numeric($parameters['w'])) {
            $width = (int)$parameters['w'];
        }
        if (isset($parameters['h']) && is_numeric($parameters['h'])) {
            $height = (int)$parameters['h'];
        }
        $resultRaw->setHeader('Content-type', 'image/jpeg')
            ->setContents(file_get_contents('http://lorempixel.com/' . $width . '/' . $height . '/'));
        return $resultRaw;
    }
}
