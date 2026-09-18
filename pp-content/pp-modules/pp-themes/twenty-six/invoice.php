<?php
    if (!defined('PipraPay_INIT')) {
        http_response_code(403);
        exit('Direct access not allowed');
    }

    if(isset($_GET['lang'])){
        if($_GET['lang'] !== ""){
            pp_set_lang($_GET['lang']);
?>
            <script>
                location.href = '?lang=';
            </script>
<?php
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $data['lang']['invoice']?> - <?php echo $data['brand']['name'];?></title>
    <link rel="shortcut icon" href="<?php echo $data['brand']['favicon'];?>">
    <?php
       echo pp_assets('head');
    ?>

    <?php
        $seoTitle = trim($data['options']['seo_title'] ?? '');
        $seoDesc  = trim($data['options']['seo_description'] ?? '');
        $seoKey   = trim($data['options']['seo_keywords'] ?? '');
        $analyticsCode = trim($data['options']['analytics_code'] ?? '');

        if ($seoTitle !== '' && $seoTitle !== '--') {
            echo '<title>' . htmlspecialchars($seoTitle) . '</title>' . PHP_EOL;
            echo '<meta name="title" content="' . htmlspecialchars($seoTitle) . '">' . PHP_EOL;
            echo '<meta property="og:title" content="' . htmlspecialchars($seoTitle) . '">' . PHP_EOL;
        }

        if ($seoDesc !== '' && $seoDesc !== '--') {
            echo '<meta name="description" content="' . htmlspecialchars($seoDesc) . '">' . PHP_EOL;
            echo '<meta property="og:description" content="' . htmlspecialchars($seoDesc) . '">' . PHP_EOL;
        }

        if ($seoKey !== '' && $seoKey !== '--') {
            echo '<meta name="keywords" content="' . htmlspecialchars($seoKey) . '">' . PHP_EOL;
        }

        if ($analyticsCode !== '' && $analyticsCode !== '--') {
            echo $analyticsCode;
        }

        $bgStyle = 'background-color:#f8f9fa;';
        if (!empty($data['options']['enable_bg_image']) && $data['options']['enable_bg_image'] === 'enabled' && !empty($data['options']['background_image'])) {
            $bgImage = $data['options']['background_image'];
            $bgStyle = "background-image: url('{$bgImage}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;";
        }
    ?>

    <style>
        .container{
            margin-top: 20px !important;
            margin-bottom: 20px !important;
        }

        .padding-1{
            padding: 30px 40px;
        }
        .padding-2{
            padding: 0 40px 40px 40px;
        }

        @media only screen and (max-width: 600px) {
            .container{
                margin: 0px !important;
            }
        }

        .padding-1{
            padding: 20px 10px;
        }
        .padding-2{
            padding: 0 10px 20px 10px;
        }

        .btn-primary {
            --tblr-btn-border-color: transparent;
            --tblr-btn-hover-border-color: transparent;
            --tblr-btn-active-border-color: transparent;
            --tblr-btn-color: <?php echo $data['options']['text_color'];?>;
            --tblr-btn-bg: <?php echo $data['options']['primary_color'];?>;
            --tblr-btn-hover-color: <?php echo $data['options']['text_color'];?>;
            --tblr-btn-hover-bg: <?php echo pp_hexToRgba($data['options']['primary_color'], 0.80)?>;
            --tblr-btn-active-color: <?php echo $data['options']['text_color'];?>;
            --tblr-btn-active-bg: <?php echo pp_hexToRgba($data['options']['primary_color'], 0.80)?>;
            --tblr-btn-disabled-bg: <?php echo $data['options']['primary_color'];?>;
            --tblr-btn-disabled-color: <?php echo $data['options']['text_color'];?>;
            --tblr-btn-box-shadow: <?php echo $data['options']['text_color'];?>;
        }
    </style>
</head>
<body style="<?= $bgStyle ?> font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="container" style="max-width: 1000px; margin: 0 auto; background: white; border-radius: 4px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
        <div class="padding-1">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <img src="<?php echo $data['brand']['logo'];?>" alt="" style=" height: 40px; ">

                <div style="cursor: pointer; color: <?php echo $data['options']['primary_color'];?>" class="mb-2 text-" data-bs-target="#modal-language" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" style=" padding: 10px; background-color: <?php echo pp_hexToRgba($data['options']['primary_color'], 0.05)?>; border-radius: 100%; width: 40px; height: 40px; " viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-language"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6.371c0 4.418 -2.239 6.629 -5 6.629" /><path d="M4 6.371h7" /><path d="M5 9c0 2.144 2.252 3.908 6 4" /><path d="M12 20l4 -9l4 9" /><path d="M19.1 18h-6.2" /><path d="M6.694 3l.793 .582" /></svg></div>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; border-top: 1px solid #dee2e6; padding-top: 20px; margin-top: 20px;">
                <div style="display: flex; gap: 30px; flex-wrap: wrap;">
                    <div>
                        <div style="font-size: 0.85rem; color: #6c757d; margin-bottom: 3px; text-transform: uppercase; letter-spacing: 0.5px;"> <?php echo $data['lang']['invoice_date']?></div>
                        <div style="font-size: 1rem; font-weight: 600; color: #2c3e50;"><?php echo $data['invoice']['created_date']?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.85rem; color: #6c757d; margin-bottom: 3px; text-transform: uppercase; letter-spacing: 0.5px;"> <?php echo $data['lang']['due_date']?></div>
                        <div style="font-size: 1rem; font-weight: 600; color: #2c3e50;"><?php echo $data['invoice']['due_date']?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.85rem; color: #6c757d; margin-bottom: 3px; text-transform: uppercase; letter-spacing: 0.5px;"> <?php echo $data['lang']['payment_method']?></div>
                        <div style="font-size: 1rem; font-weight: 600; color: #2c3e50;"><?php echo ($data['invoice']['status'] == "paid") ? htmlspecialchars($data['invoice']['gateway'] ?? '') : ''?></div>
                    </div>
                </div>
                
                <?php
                   if($data['invoice']['status'] == "paid"){
                ?>
                        <div style="padding: 6px 15px;border-radius: 20px;font-size: 0.85rem;font-weight: 600;background-color: #2fb3442e;color: #2fb344;margin-top: 10px;">
                            <?php echo $data['lang']['badge_' . $data['invoice']['status']] ?? htmlspecialchars(ucfirst($data['invoice']['status'])); ?>
                        </div>
                <?php
                   }else{
                ?>
                        <div style="padding: 6px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; background-color: rgba(231, 76, 60, 0.1); color: #e74c3c; margin-top: 10px;">
                            <?php echo $data['lang']['badge_' . $data['invoice']['status']] ?? htmlspecialchars(ucfirst($data['invoice']['status'])); ?>
                        </div>
                <?php
                   }
                ?>
            </div>
        </div>
        
        <div class="padding-2" style="position: relative; z-index: 0;">
            <div class="row" style="margin-top: 10px;">
                <div class="col-lg-6" style="margin-bottom: 20px;">
                    <div style="background-color: #f8f9fa; border-radius: 6px; padding: 20px; border-left: 3px solid <?php echo $data['options']['primary_color'];?>;">
                        <div style="font-weight: 600; color: #2c3e50; margin-bottom: 10px; font-size: 1rem; display: flex; align-items: center;">
                             <?php echo $data['lang']['bill_from']?>
                        </div>
                        <strong style="color: #2c3e50;"><?php echo $data['brand']['name'];?></strong>
                        <div style="height:10px;"></div>
                        <address style="margin-bottom: 0;">
                            <strong> <?php echo $data['lang']['email']?>:</strong> <?php echo $data['brand']['support']['email'];?><br>
                            <strong> <?php echo $data['lang']['phone']?>:</strong> <?php echo $data['brand']['support']['phone'];?>
                        </address>
                    </div>
                </div>
                <div class="col-lg-6" style="margin-bottom: 20px;">
                    <div style="background-color: #f8f9fa; border-radius: 6px; padding: 20px; border-left: 3px solid <?php echo $data['options']['primary_color'];?>;">
                        <div style="font-weight: 600; color: #2c3e50; margin-bottom: 10px; font-size: 1rem; display: flex; align-items: center;">
                             <?php echo $data['lang']['bill_to']?>
                        </div>
                        <strong style="color: #2c3e50;"><?php echo $data['invoice']['customer']['name'];?></strong>
                        <div style="height:10px;"></div>
                        <address style="margin-bottom: 0;">
                            <strong> <?php echo $data['lang']['email']?>:</strong> <?php echo $data['invoice']['customer']['email'];?><br>
                            <strong> <?php echo $data['lang']['phone']?>:</strong> <?php echo $data['invoice']['customer']['mobile'];?>
                        </address>
                    </div>
                </div>
            </div>

            <div class="table-responsive" style="margin-top: 30px;">
                <table class="table" style="width: 100%; margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="width: 5%; background-color: #f8f9fa; color: #2c3e50; padding: 15px; font-weight: 600; border-bottom: 1px solid #dee2e6; text-align: center;">#</th>
                            <th style="width: 45%; background-color: #f8f9fa; color: #2c3e50; padding: 15px; font-weight: 600; border-bottom: 1px solid #dee2e6;"> <?php echo $data['lang']['description']?></th>
                            <th style="width: 10%; background-color: #f8f9fa; color: #2c3e50; padding: 15px; font-weight: 600; border-bottom: 1px solid #dee2e6; text-align: center;"> <?php echo $data['lang']['qty']?></th>
                            <th style="width: 20%; background-color: #f8f9fa; color: #2c3e50; padding: 15px; font-weight: 600; border-bottom: 1px solid #dee2e6; text-align: right;"> <?php echo $data['lang']['unit_price']?></th>
                            <th style="width: 20%; background-color: #f8f9fa; color: #2c3e50; padding: 15px; font-weight: 600; border-bottom: 1px solid #dee2e6; text-align: right;"> <?php echo $data['lang']['amount']?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $subtotal = 0;
                            $totalDiscount = 0;
                            $totalVAT = 0;
                            $grandTotal = 0;

                            if (!empty($data['items'])):
                                $counter = 1;
                                foreach ($data['items'] as &$item):

                                    $itemTotalBeforeDiscount = ($item['unitPrice'] ?? 0) * ($item['quantity'] ?? 0);

                                    $discountAmount = $item['discount'] ?? 0;

                                    $priceAfterDiscount = $itemTotalBeforeDiscount - $discountAmount;

                                    $vatAmount = $priceAfterDiscount * (($item['vat'] ?? 0) / 100);

                                    $item['total'] = $priceAfterDiscount + $vatAmount;

                                    $subtotal += $itemTotalBeforeDiscount;
                                    $totalDiscount += $discountAmount;
                                    $totalVAT += $vatAmount;
                                    $grandTotal += $item['total'];
                        ?>
                                    <tr style="background-color: rgba(52, 152, 219, 0.03);">
                                        <td style="padding: 15px; border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;"><?= $counter; ?></td>
                                        <td style="padding: 15px; border-bottom: 1px solid #dee2e6; vertical-align: middle;">
                                            <div style="color: #6c757d; font-size: 0.9rem;"><?= htmlspecialchars($item['description']); ?></div>
                                        </td>
                                        <td style="padding: 15px; border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;"><?= htmlspecialchars($item['quantity']); ?></td>
                                        <td style="padding: 15px; border-bottom: 1px solid #dee2e6; text-align: right; vertical-align: middle;"><?= money_round($item['unitPrice'] ?? 0, 2).$data['invoice']['currency']; ?></td>
                                        <td style="padding: 15px; border-bottom: 1px solid #dee2e6; text-align: right; vertical-align: middle;"><?= money_round($item['total'], 2).$data['invoice']['currency']; ?></td>
                                    </tr>
                        <?php
                                    $counter++;
                                endforeach;
                                unset($item);
                            endif;
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div style="background-color: #f8f9fa; border-radius: 6px; padding: 25px; margin-top: 30px;">
                <div class="row">
                    <div class="col-md-8">
                        <div style="margin-bottom: 15px;">
                            <h4 style="color: #2c3e50;"> <?php echo $data['lang']['note']?></h4>
                            <p style="color: #6c757d; margin-bottom: 0;">
                                <?php echo $data['invoice']['note'];?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 1rem;">
                            <span> <?php echo $data['lang']['subtotal']?>:</span>
                            <span><?php echo money_round($subtotal, 2).$data['invoice']['currency']?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 1rem;">
                            <span> <?php echo $data['lang']['shipping']?>:</span>
                            <span><?php echo money_round($data['invoice']['shippingFee'] ?? 0, 2).$data['invoice']['currency']?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 1rem;">
                            <span> <?php echo $data['lang']['tax']?>:</span>
                            <span><?php echo money_round($totalVAT, 2).$data['invoice']['currency']?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 1rem;">
                            <span> <?php echo $data['lang']['discount']?>:</span>
                            <span><?php echo money_round($totalDiscount, 2).$data['invoice']['currency']?></span>
                        </div>
                        
                        <?php
                            if($data['invoice']['status'] == "paid"){
                        ?>
                                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 600; color: #2fb344; border-top: 2px solid #dee2e6; padding-top: 15px; margin-top: 15px;">
                                    <span> <?php echo $data['lang']['total']?>:</span>
                                    <span><?php echo money_round($grandTotal + ($data['invoice']['shippingFee'] ?? 0), 2).$data['invoice']['currency']?></span>
                                </div>
                        <?php
                            }else{
                        ?>
                                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 600; color: #e74c3c; border-top: 2px solid #dee2e6; padding-top: 15px; margin-top: 15px;">
                                    <span> <?php echo $data['lang']['total_due']?>:</span>
                                    <span><?php echo money_round($grandTotal + ($data['invoice']['shippingFee'] ?? 0), 2).$data['invoice']['currency']?></span>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 30px; align-items: center;">
                <div class="col-md-12 d-flex  flex-md-row-reverse justify-content-md-start justify-content-center align-items-center gap-3">
                    <button onclick="window.print()" class="btn btn-success no-print">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 15a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2l0 -4" /></svg> <?php echo $data['lang']['print_invoice']?>
                    </button>
                    <?php
                       if($data['invoice']['status'] == "unpaid"){
                    ?>
                            <form action="" method="POST" id="form" enctype="multipart/form-data">
                                <?php pp_renderFormFields('invoice', $data); ?>
                                <button id="payButton" class="btn btn-primary no-print">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3l0 -8" /><path d="M3 10l18 0" /><path d="M7 15l.01 0" /><path d="M11 15l2 0" /></svg> <?php echo $data['lang']['pay_now']?>
                                </button>
                            </form>
                    <?php
                       }
                    ?>
                </div>
            </div>
            
            <div style="background-color: #f8f9fa; padding: 25px; text-align: center; margin-top: 30px;">
                <div class="row">
                    <div class="col-md-12">
                        <p style="color: #6c757d; margin-bottom: 0;">
                            <?php echo $data['brand']['name'];?> • <?php echo $data['brand']['address']['street'];?>, <?php echo $data['brand']['address']['city'];?> - <?php echo $data['brand']['address']['postal'];?> • <?php echo $data['brand']['address']['country'];?>
                        </p>
                        <p style="color: #6c757d; margin-bottom: 0; margin-top: 10px; font-size: 0.9rem;">
                            <?php echo $data['lang']['no_signature']?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-language" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableLabel"><?php echo $data['lang']['select_language']?></h5> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="form-group mt-1">
                        <label for="" class="form-label"><?php echo $data['lang']['language']?> <span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <select class="form-select" id="model-languages" onchange="hitLanguage()">
                                <option value="" selected><?php echo $data['lang']['select_a_language']?></option>
                                <?php foreach ($data['supported_languages'] ?? [] as $code => $language): ?>
                                    <option value="<?= htmlspecialchars($code) ?>"><?= htmlspecialchars($language) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal"><?php echo $data['lang']['close']?></button>
                </div>
            </div>
        </div>
    </div>

    <?php
       echo pp_assets('footer');
    ?>

    <script data-cfasync="false">
        function hitLanguage(){
            var language = document.querySelector("#model-languages").value;

            if(language !== ""){
                location.href = '?lang='+language;
            }
        }

        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault(); 

                var formData = $(this).serialize(); 

                document.querySelector("#payButton").innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>';

                $.ajax({
                    url: '<?php echo pp_site_address(); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: formData, 
                    success: function(data) {
                        document.querySelector("#payButton").innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3l0 -8" /><path d="M3 10l18 0" /><path d="M7 15l.01 0" /><path d="M11 15l2 0" /></svg> <?php echo $data['lang']['pay_now']?>';

                        if (data.status == "true") {
                            location.href = data.redirect;
                        } else {
                            createToast({
                                title: data.title,
                                description: data.message,
                                svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                                timeout: 6000
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        createToast({
                            title: '<?php echo addslashes($data['lang']['something_wrong'])?>',
                            description: '<?php echo addslashes($data['lang']['support_contact_text'])?>',
                            svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                            timeout: 6000
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
