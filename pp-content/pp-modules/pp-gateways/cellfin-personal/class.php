<?php
    class CellfinPersonalGateway
    {
        public function info()
        {
            return [
                'title'       => 'Cellfin Personal',
                'logo'        => 'assets/logo.jpg',
                'currency'        => 'BDT',
                'tab'        => 'mfs',

                'gateway_type'        => 'automation',
                'sender_key'        => 'cellfin',
                'sender_type'        => 'Personal',
            ];
        }

        public function color()
        {
            return [
                'primary_color'        => '#00803d',
                'text_color'        => '#FFFFFF',
                'btn_color'        => '#00803d',
                'btn_text_color'        => '#FFFFFF',
            ];
        }

        public function supported_languages()
        {
            return [
                'en' => 'English',
                'bn' => 'বাংলা',
            ];
        }

        public function lang_text()
        {
            return [
                '1' => [
                    'en' => 'Go to your Cellfin Mobile App.',
                    'bn' => 'আপনার সেলফিন মোবাইল অ্যাপে যান।',
                ],

                '2' => [
                    'en' => 'Choose "Fund Transfer"',
                    'bn' => '“Fund Transfer” নির্বাচন করুন',
                ],

                '3' => [
                    'en' => 'Choose "CellFin"',
                    'bn' => '“CellFin” নির্বাচন করুন',
                ],

                '4' => [
                    'en' => 'Enter the Number: {mobile_number}',
                    'bn' => 'নম্বর লিখুন: {mobile_number}',
                ],

                '5' => [
                    'en' => 'Enter the Amount: {amount} {currency}',
                    'bn' => 'পরিমাণ লিখুন: {amount} {currency}',
                ],

                '6' => [
                    'en' => 'Now enter your Cellfin PIN to confirm.',
                    'bn' => 'এখন নিশ্চিত করতে আপনার সেলফিন পিন লিখুন।',
                ],

                '7' => [
                    'en' => 'Put the Transaction ID in the box below and press Verify',
                    'bn' => 'ট্রানজ্যাকশন আইডি নিচের বক্সে লিখুন এবং যাচাই করুন চাপুন।',
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
                    'copy' => false
                ],
                [
                    'icon' => '',
                    'text' => '3',
                    'copy' => false,
                ],
                [
                    'icon' => '',
                    'text' => '4',
                    'copy' => true,
                    'value' => $data['options']['mobile_number'],
                    'vars' => [
                        '{mobile_number}' => $data['options']['mobile_number']
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
    }
