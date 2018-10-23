<?php
/**
 * Example Adjuster Module
 *
 * A simplest-case `AdjusterInterface` implementation.
 *
 * @link      https://oof.studio
 * @copyright Copyright (c) 2018 oof. LLC.
 */

namespace modules\exampleadjuster\adjusters;

use craft\commerce\base\AdjusterInterface;
use craft\commerce\elements\Order;
use craft\commerce\models\OrderAdjustment;

use modules\exampleadjuster\Example as ExampleModule;

/**
 * Example Adjuster
 * 
 * 5% discount on all line items.
 *
 * @author oof. Studio <hello@oof.studio>
 * @since 0.1
 */
class ExampleLineItemAdjuster implements AdjusterInterface
{
    // Constants
    // =========================================================================

    /**
     * The discount adjustment type.
     */
    const ADJUSTMENT_TYPE = 'oofbar-example-line-item';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function adjust(Order $order): array
    {
        $adjustments = [];
        foreach ($order->lineItems as $lineItem)
        {
            $adjustment = $this->_getEmptyOrderAdjustmentFor($order);
            $adjustment->lineItemId = $lineItem->id;

            // Calculate Price difference:
            $basePrice = $lineItem->getSubtotal();
            $discountAmount = $basePrice * -0.05;

            $adjustment->amount = $discountAmount;

            $adjustments[] = $adjustment;
        }
      
        return $adjustments;
    }

    // Private Methods
    // =========================================================================

    private function _getEmptyOrderAdjustmentFor(Order $order)
    {
        $adjustment = new OrderAdjustment();
        $adjustment->type = self::ADJUSTMENT_TYPE;
        $adjustment->name = '5% Discount';
        $adjustment->orderId = $order->id;
        $adjustment->description = 'A discount for nice people, like you!';
        $adjustment->sourceSnapshot = [
            'examplePrivateProp' => 'Criteria you want to make sure you have access to, in case you have to recalculate, later!'
        ];

        return $adjustment;
    }
}
