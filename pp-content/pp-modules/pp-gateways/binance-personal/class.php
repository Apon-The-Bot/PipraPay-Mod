<?php
    class BinancePersonalGateway
    {
        public function info()
        {
            return [
                'title'       => 'Binance Personal',
                'logo'        => 'assets/logo.jpg',
                'currency'        => 'USD',
                'tab'        => 'global',

                'gateway_type'        => 'api',
            ];
        }

        public function color()
        {
            return [
                'primary_color'        => '#f0b90b',
                'text_color'        => '#000000',
                'btn_color'        => '#f0b90b',
                'btn_text_color'        => '#000000',
            ];
        }

        public function fields()
        {
            return [
                [
                    'name'  => 'binance_uid',
                    'label' => 'Binance UID',
                    'type'  => 'text',
                ],
                [
                    'name'  => 'api_key',
                    'label' => 'Api Key',
                    'type'  => 'text',
                ],
                [
                    'name'  => 'secret_key',
                    'label' => 'Secret Key',
                    'type'  => 'text',
                ],
                [
                    'name'  => 'qr_code',
                    'label' => 'Qr Code',
                    'type'  => 'image',
                ]
            ];
        }

        public function supported_languages()
        {
            return [
                'en' => 'English',
                'bn' => 'বাংলা',
                'hi' => 'हिन्दी',
                'ur' => 'اردو',
                'ar' => 'العربية',
            ];
        }

        public function lang_text()
        {
            return [
                '1' => [
                    'en' => 'Go to your Binance Mobile App or Website',
                    'bn' => 'আপনার Binance মোবাইল অ্যাপ বা ওয়েবসাইটে যান',
                    'hi' => 'अपने Binance मोबाइल ऐप या वेबसाइट पर जाएं',
                    'ur' => 'اپنی Binance موبائل ایپ یا ویب سائٹ پر جائیں',
                    'ar' => 'انتقل إلى تطبيق Binance على هاتفك أو إلى الموقع الإلكتروني',
                ],

                '2' => [
                    'en' => 'Choose "Send to Binance user"',
                    'bn' => '"Send to Binance user" অপশনটি নির্বাচন করুন',
                    'hi' => '"Send to Binance user" विकल्प चुनें',
                    'ur' => '"Send to Binance user" کا انتخاب کریں',
                    'ar' => 'اختر خيار "الإرسال إلى مستخدم Binance"',
                ],

                '3' => [
                    'en' => 'Enter the Binance UID "{binance_uid}"',
                    'bn' => 'Binance UID লিখুন "{binance_uid}"',
                    'hi' => 'Binance UID दर्ज करें "{binance_uid}"',
                    'ur' => 'Binance UID درج کریں "{binance_uid}"',
                    'ar' => 'أدخل Binance UID "{binance_uid}"',
                ],

                '4' => [
                    'en' => 'Or scan the QR Code',
                    'bn' => 'অথবা কিউআর কোড স্ক্যান করুন',
                    'hi' => 'या QR कोड स्कैन करें',
                    'ur' => 'یا QR کوڈ اسکین کریں',
                    'ar' => 'أو قم بمسح رمز QR',
                ],

                '5' => [
                    'en' => 'Enter amount: {amount} {currency}',
                    'bn' => 'পরিমাণ লিখুন: {amount} {currency}',
                    'hi' => 'राशि दर्ज करें: {amount} {currency}',
                    'ur' => 'رقم درج کریں: {amount} {currency}',
                    'ar' => 'أدخل المبلغ: {amount} {currency}',
                ],

                '6' => [
                    'en' => 'Check all details carefully and confirm the transfer',
                    'bn' => 'সব তথ্য ভালোভাবে যাচাই করে ট্রান্সফার নিশ্চিত করুন',
                    'hi' => 'सभी विवरण ध्यान से जांचें और ट्रांसफर की पुष्टि करें',
                    'ur' => 'تمام تفصیلات غور سے چیک کریں اور ٹرانسفر کی تصدیق کریں',
                    'ar' => 'تحقق من جميع التفاصيل بعناية ثم أكد التحويل',
                ],

                '7' => [
                    'en' => 'Enter the transaction ID in the box below and click "Submit"',
                    'bn' => 'নিচের বক্সে ট্রানজ্যাকশন আইডি লিখুন এবং "Submit" চাপুন',
                    'hi' => 'नीचे दिए गए बॉक्स में ट्रांज़ैक्शन ID दर्ज करें और "Submit" पर क्लिक करें',
                    'ur' => 'نیچے دیے گئے باکس میں ٹرانزیکشن ID درج کریں اور "Submit" پر کلک کریں',
                    'ar' => 'أدخل معرف المعاملة في الحقل أدناه ثم اضغط على "Submit"',
                ],

                'order_id' => [
                    'en' => 'Order ID',
                    'bn' => 'অর্ডার আইডি',
                    'hi' => 'ऑर्डर आईडी',
                    'ur' => 'آرڈر آئی ڈی',
                    'ar' => 'معرّف الطلب',
                ],

                'enter_order_id' => [
                    'en' => 'Enter Order ID',
                    'bn' => 'অর্ডার আইডি লিখুন',
                    'hi' => 'ऑर्डर आईडी दर्ज करें',
                    'ur' => 'آرڈر آئی ڈی درج کریں',
                    'ar' => 'أدخل معرّف الطلب',
                ],

                'verify' => [
                    'en' => 'Verify',
                    'bn' => 'যাচাই করুন',
                    'hi' => 'सत्यापित करें',
                    'ur' => 'تصدیق کریں',
                    'ar' => 'تحقق',
                ],
            ];
        }

        public function instructions($data)
        {
            return [
                [
                    'icon' => '',
                    'text' => '1',
                    'copy' => false,
                ],
                [
                    'icon' => '',
                    'text' => '2',
                    'copy' => false,
                ],
                [
                    'icon' => '',
                    'text' => '3',
                    'copy' => true,
                    'value' => $data['options']['binance_uid'] ?? '',
                    'vars' => [
                        '{binance_uid}' => $data['options']['binance_uid'] ?? ''
                    ]
                ],
                [
                    'icon' => '',
                    'text' => '4',
                    'action' => [
                        'type'  => 'image',
                        'label' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M7 17l0 .01" /><path d="M14 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M7 7l0 .01" /><path d="M4 15a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M17 7l0 .01" /><path d="M14 14l3 0" /><path d="M20 14l0 .01" /><path d="M14 14l0 3" /><path d="M14 20l3 0" /><path d="M17 17l3 0" /><path d="M20 17l0 3" /></svg>',
                        'value' => $data['options']['qr_code'] ?? '',
                    ]
                ],
                [
                    'icon' => '',
                    'text' => '5',
                    'copy' => true,
                    'value' => $data['transaction']['local_net_amount'],
                    'vars' => [
                        '{amount}' => $data['transaction']['local_net_amount'],
                        '{currency}' => $data['transaction']['local_currency']
                    ]
                ],
                [
                    'icon' => '',
                    'text' => '6',
                    'copy' => false
                ],
                [
                    'icon' => '',
                    'text' => '7',
                    'copy' => false
                ],
            ];
        }

        function process_payment($data = []){
            set_env('binance-personal-pp_amount'.$data['transaction']['ref'], $data['transaction']['local_net_amount']);
?>
            <form class="payment-form-submit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="bpid" value="<?php echo $data['transaction']['ref']?>">

                <div class="form-group  mt-3">
                    <label class="form-label"><?php echo $data['lang']['order_id']?></label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="order_id" placeholder="<?php echo $data['lang']['enter_order_id']?>" required=""> 
                    </div>
                </div>

                <button class="btn btn-primary w-100 payment-form-btn mt-3" type="submit"><?php echo $data['lang']['verify']?></button>
            </form>

            <script data-cfasync="false">
                document.addEventListener("DOMContentLoaded", function() {
                    const form = document.querySelector(".payment-form-submit");
                    const mobileWrapper = form.querySelector(`.form-group[style*="display: none"]`);
                    const submitBtn = form.querySelector(".payment-form-btn");

                    form.addEventListener("submit", function(e) {
                        e.preventDefault();

                        const formData = new FormData(form);

                        submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

                        fetch("<?php echo pp_ipn_url($data['gateway']['gateway_id'])?>", { // replace "" with your PHP AJAX URL if needed
                            method: "POST",
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            submitBtn.innerHTML = `<?php echo $data['lang']['verify'] ?>`;

                            if(data.status === "true") {
                                success(data);
                            } else if(data.status === "false") {
                                if(data.visible_number && data.visible_number === "true") {
                                    mobileWrapper.style.display = "block";
                                }
                                failed(data.title, data.message);
                            } else {
                                failed("Unexpected Response", "Please try again later.");
                            }
                        })
                        .catch(err => {
                            submitBtn.innerHTML = `<?php echo $data['lang']['verify']?>`;
                            console.error(err);
                            failed("Request Error", "Something went wrong. Please try again.");
                        });
                    });
                });
            </script>
<?php

        }
    
        function ipn($data = []){
            $bpid = $_POST['bpid'] ?? '';
            $order_id = $_POST['order_id'] ?? '';
            $transaction_amount = (get_env('binance-personal-pp_amount'.$bpid) == "") ? 0 : get_env('binance-personal-pp_amount'.$bpid);

            if($order_id == ""){
                echo json_encode(['status' => 'false', 'title' => 'Incomplete Information', 'message' => 'Please fill in all required fields before proceeding.']);
            }else{
                if(pp_check_transaction_id($order_id)){
                    echo json_encode(['status' => 'false', 'title' => 'Duplicate Transaction ID', 'message' => 'This Transaction ID is already exits. Please provide a different one.']);
                }else{
                    $transaction_details = pp_check_transaction($bpid);

                    if($transaction_details == true){
                        $transaction_details = json_decode($transaction_details, true);
                        
                        $endpoint = "https://api.binance.com/sapi/v1/pay/transactions";
                        
                        $timestamp = round(microtime(true) * 1000);
                        
                        $params = [
                            'limit' => 100,       // Max 100 transactions per request
                            'timestamp' => $timestamp
                        ];

                        $query = http_build_query($params);

                        $signature = hash_hmac('sha256', $query, ($data['gateway']['options']['secret_key'] ?? ''));

                        $url = $endpoint . "?" . $query . "&signature=" . $signature;

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            "X-MBX-APIKEY: ".($data['gateway']['options']['api_key'] ?? '')
                        ]);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Verify SSL
                        
                        $response = curl_exec($ch);
                    
                        curl_close($ch);

                        // Convert JSON to array
                        $data_res = json_decode($response, true);

                        if(isset($data_res['data'])){

                        }else{
                            echo json_encode(['status' => "false", 'title' => 'Incomplete Information', 'message' => $data_res['msg']]);
                            exit();
                        }

                        // Initialize result
                        $amount = null;
                        
                        // Loop through data
                        foreach ($data_res['data'] as $transaction) {
                            if ($transaction['orderId'] === $order_id && $transaction['currency'] === "USDT") {
                                $amount = $transaction['amount'];
                                break; // Stop loop once matched
                            }
                        }
                        
                        if ($amount !== null) {
                            if($transaction_amount <= $amount){
                                pp_set_transaction_status($bpid, 'completed', $data['gateway']['gateway_id'], $order_id);

                                echo json_encode(['status' => "true", 'title' => 'Transaction Verified', 'message' => 'Your transaction has been verified successfully.']);
                            }else{
                                echo json_encode(['status' => "false", 'title' => 'Incomplete Information', 'message' => 'The order does not meet the required amount!']);
                            }
                        } else {
                            echo json_encode(['status' => "false", 'title' => 'Incomplete Information', 'message' => 'The Order ID you entered is incorrect. Try again!']);
                        }
                    }else{
                        echo json_encode(['status' => "false", 'title' => 'Incomplete Information', 'message' => 'The Transaction ID you entered is incorrect. Try again!']);
                    }
                }
            }
        }
    }
