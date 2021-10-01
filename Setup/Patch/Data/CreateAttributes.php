<?php
/**
 * @author Andre Santos <flp_andre@yahoo.com.br>
 */

declare(strict_types=1);

namespace Andre\M2Sample\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateAttributes implements DataPatchInterface
{
    /** @var ModuleDataSetupInterface */
    private $moduleDataSetup;

    /** @var EavSetupFactory */
    private $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Create attributes
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(
            ['setup' => $this->moduleDataSetup]
        );
        $newAttributes = $this->getAttributes();

        foreach ($newAttributes as $code => $attribute) {
            $eavSetup->addAttribute(
                Product::ENTITY,
                $code,
                $attribute
            );
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases() : array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies() : array
    {
        return [];
    }

    /**
     * Get attributes data
     *
     * @return array[]
     */
    private function getAttributes(): array
    {
        return [
            'nickname' => [
                'type' => 'text',
                'frontend' => '',
                'label' => 'Nick Name',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'backend' => '',
                'global' => Attribute::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => false,
                'is_wysiwyg_enabled' => false,
                'unique' => false,
                'apply_to' => ''
            ],
            'prop65' => [
                'type' => 'int',
                'frontend' => '',
                'label' => 'Custom Prop',
                'input' => 'boolean',
                'class' => '',
                'source' => '',
                'backend' => '',
                'global' => Attribute::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => false,
                'is_wysiwyg_enabled' => false,
                'unique' => false,
                'apply_to' => ''
            ]
        ];
    }
}
