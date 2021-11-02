
<form id="redirectForm" method="post" action="https://www.cashfree.com/checkout/post/submit">
    <input type="hidden" name="appId" value="<?php echo $appId;?>"/>
    <input type="hidden" name="orderId" value="<?php echo $orderId;?>"/>
    <input type="hidden" name="orderAmount" value="<?php echo $orderAmount;?>"/>
    <input type="hidden" name="orderCurrency" value="<?php echo $orderCurrency;?>"/>
    <input type="hidden" name="orderNote" value="<?php echo $orderNote;?>"/>
    <input type="hidden" name="customerName" value="<?php echo $customerName;?>"/>
    <input type="hidden" name="customerEmail" value="<?php echo $customerEmail;?>"/>
    <input type="hidden" name="customerPhone" value="<?php echo $customerPhone;?>"/>
    <input type="hidden" name="returnUrl" value="<?php echo $returnUrl;?>"/>
    <input type="hidden" name="notifyUrl" value="<?php echo $notifyUrl;?>"/>
    <input type="hidden" name="signature" value="<?php echo $signature;?>"/>
</form>
                                
<script>document.getElementById("redirectForm").submit();</script>
