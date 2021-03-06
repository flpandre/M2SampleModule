<?php
/**
 * @author Andre Santos <flp_andre@yahoo.com.br>
 */

declare(strict_types=1);

namespace Andre\M2Sample\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigProvider implements ConfigProviderInterface
{
    /** @var string  */
    private const SAMPLE_DATA_CONFIG = 'sampleMessage';

    /** @var string  */
    private const XPATH_SAMPLE_MESSAGE = 'general/sample_group/sample_message';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Include custom config to checkout data
     *
     * @return array
     */
    public function getConfig(): array
    {
        return [
            self::SAMPLE_DATA_CONFIG => $this
                ->scopeConfig
                ->getValue(self::XPATH_SAMPLE_MESSAGE)
        ];
    }
}
