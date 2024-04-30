<?php
class Payhere
{
    public function premium($cno, $address, $city, $fname, $lname, $emaili)
    {
        $amount = 1500;
        $merchant_id = $_ENV['PAYHERE_MERCHANT_ID']; // Replace your Merchant ID
        $merchant_secret = $_ENV['PAYHERE_MERCHANT_SECRET'];
        $return_url = URLROOT . '/student/profile'; // Replace with your Return URL
        $cancel_url = URLROOT . '/cancel'; // Replace with your Cancel URL
        $notify_url = URLROOT . '/student/purchase_premium'; // Replace with your Notify URL
        $first_name = $fname;
        $last_name = $lname;
        $email = $emaili;
        $phone = $cno;
        $address = $address;
        $city = $city;
        $country = 'Sri Lanka';
        $order_id = $_SESSION['business_id'];
        $items = 'JobLink Premium Subscription';
        $currency = 'LKR';
        $mode = 'sandbox'; // sandbox or live
        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );
        $payhere_args = array(
            'merchant_id' => $merchant_id,
            'return_url' => $return_url,
            'cancel_url' => $cancel_url,
            'notify_url' => $notify_url,
            'order_id' => $order_id,
            'items' => $items,
            'currency' => $currency,
            'amount' => number_format($amount, 2, '.', ''),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'hash' => $hash,
            'mode' => $mode
        );
        return json_encode($payhere_args);
    }
}
