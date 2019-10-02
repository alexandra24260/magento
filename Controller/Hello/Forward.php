<?php
declare(strict_types=1);

namespace Epam\FirstModule\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Forward
 */
class Forward extends Action
{
    /**
     * @return ResponseInterface|void
     */
    public function execute()
    {
        $this->_forward('raw', 'hello', 'firstmodule');
    }
}
