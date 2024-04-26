<?php
class Payhere
{
    public function premium($cno, $address, $city, $fname, $lname, $emaili)
    {
        $amount = 1500;
        $merchant_id = '1226577'; // Replace your Merchant ID
        // $merchant_secret = 'NDgyNjY3NzExMjgxODQyMDAyNTIxMDQ5Nzg3MzY3MDE5NDEyNQ=='; iqube.me
        $merchant_secret = 'MzcwMDQ3MDQwMzU0ODYxMTQwMzc5ODQ0NDcwNTIyNDcwMDI4Njg=';
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
