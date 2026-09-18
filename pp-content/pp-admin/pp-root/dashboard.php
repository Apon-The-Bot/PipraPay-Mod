<?php
    if (!defined('PipraPay_INIT')) {
        http_response_code(403);
        exit('Direct access not allowed');
    }

    if (!canAccessPage(json_decode($global_response_permission['response'][0]['permission'], true), 'dashboard', $global_user_response['response'][0]['role'])) {
        http_response_code(403);
        exit('Access denied. You need permission to perform this action. Please contact the admin.');
    }
?>

<style>
  #chart-gateway-statistics .apexcharts-legend.apexcharts-align-center.apx-legend-position-bottom{
      top: 263px !important;
  }
</style>

<div class="page-header d-print-none" aria-label="Page header">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <!-- Page pre-title -->
                <div class="page-pretitle">Dashboard</div>
                <h2 class="page-title">Dashboard</h2>
            </div>

            <div class="col-auto ms-auto d-print-none">
                <div class="page-pretitle">Last cron invocation</div>
                <h3 >
                    <?php
                        $lastCron = get_env('last-cron-invocation');

                        $userTimezone = ($global_response_brand['response'][0]['timezone'] ?? '') === '--' || empty($global_response_brand['response'][0]['timezone']) ? 'Asia/Dhaka' : $global_response_brand['response'][0]['timezone'];

                        echo empty($lastCron) ? 'Unknown' : timeAgo($lastCron);
                    ?>
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row g-4">
            <!-- Revenue -->
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body mb-0 pb-0">
                        <div class="card-title m-0 mb-1 fs-4">Total Payments</div>
                        <div class="h1 mb-0">
                            <?php
                                $count = 0;

                                $response_dashboard_info = json_decode( getData( $db_prefix.'transaction', ' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'" AND status NOT IN ("initiated")'), true );
                                if($response_dashboard_info['status'] == true){
                                    foreach($response_dashboard_info['response'] as $row){
                                        $count = $count+1;
                                    }
                                }

                                echo number_format($count, 0);
                            ?>
                        </div>
                    </div>
                    <div id="chart-total-payment"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body mb-0 pb-0">
                        <div class="card-title m-0 mb-1 fs-4">Pending Payments</div>
                        <div class="h1 mb-0">
                          <?php
                              $count = 0;

                              $response_dashboard_info = json_decode(getData($db_prefix.'transaction',' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'" AND status = "pending"'),true);
                              if($response_dashboard_info['status'] == true){
                                  foreach($response_dashboard_info['response'] as $row){
                                      $count = $count+1;
                                  }
                              }

                              echo number_format($count, 0);
                          ?>
                        </div>
                    </div>
                    <div id="chart-pending-payment"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body mb-0 pb-0">
                        <div class="card-title m-0 mb-1 fs-4">Unpaid Invoices</div>
                        <div class="h1 mb-0">
                          <?php
                              $count = 0;

                              $response_dashboard_info = json_decode(getData($db_prefix.'invoice',' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'" AND status = "unpaid"'),true);
                              if($response_dashboard_info['status'] == true){
                                  foreach($response_dashboard_info['response'] as $row){
                                      $count = $count+1;
                                  }
                              }

                              echo number_format($count, 0);
                          ?>
                        </div>
                    </div>
                    <div id="chart-unpaid-invoice"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body mb-0 pb-0">
                        <div class="card-title m-0 mb-1 fs-4">Customers</div>
                        <div class="h1 mb-0">
                            <?php
                                $count = 0;

                                $response_dashboard_info = json_decode(getData($db_prefix.'customer',' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'"'),true);
                                if($response_dashboard_info['status'] == true){
                                    foreach($response_dashboard_info['response'] as $row){
                                        $count = $count+1;
                                    }
                                }

                                echo number_format($count, 0);
                            ?>
                        </div>
                    </div>
                    <div id="chart-customer"></div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Transaction Statistics</h3>
                      <div class="card-actions btn-actions">
                        <div class="position-relative">
                            <span class="dashboard-transaction-statistics-loading"></span>
                            <svg onclick="toggleFilter('filterDropdown-transaction-statistics')" style="cursor:pointer"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icon-tabler-filter">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"></path>
                            </svg>

                            <!-- Dropdown -->
                            <div id="filterDropdown-transaction-statistics" class="card shadow position-absolute end-0 mt-2 p-3" style="width: 300px; display:none; z-index:1050;">
                                <label class="form-label fw-bold mb-2">Filter By</label>

                                <select class="form-select mb-2" id="dateFilter-transaction-statistics" onchange="handleFilterChangeTransactionStatistics(this.value)">
                                    <option value="today">
                                        Today
                                    </option>
                                    <option value="yesterday">
                                        Yesterday
                                    </option>
                                    <option value="this_week">
                                        This week
                                    </option>
                                    <option value="last_week">
                                        Last week
                                    </option>
                                    <option value="this_month">
                                        This month
                                    </option>
                                    <option value="last_month">
                                        Last month
                                    </option>
                                    <option value="this_year" selected>
                                        This year
                                    </option>
                                    <option value="previous_year">
                                        Previous year
                                    </option>
                                    <option value="custom">Custom Range</option>
                                </select>

                                <!-- Custom Range -->
                                <div id="customRange-transaction-statistics" class="d-none">
                                    <label class="form-label mt-2">Start Date</label>
                                    <input type="date" id="startDate-transaction-statistics" class="form-control">

                                    <label class="form-label mt-2">End Date</label>
                                    <input type="date" id="endDate-transaction-statistics" class="form-control">

                                    <button class="btn btn-primary mt-3 w-100" onclick="applyCustomRangeTransactionStatistics()">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                       <div id="chart-transaction-statistics" style="height: 303px !important; min-height: 303px !important;"></div>
                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Gateway Statistics</h3>
                      <div class="card-actions btn-actions">
                        <div class="position-relative">
                            <span class="dashboard-gateway-statistics-loading"></span>
                            <svg onclick="toggleFilter('filterDropdown-gateway-statistics')" style="cursor:pointer"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icon-tabler-filter">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"></path>
                            </svg>

                            <!-- Dropdown -->
                            <div id="filterDropdown-gateway-statistics" class="card shadow position-absolute end-0 mt-2 p-3" style="width: 300px; display:none; z-index:1050;">
                                <label class="form-label fw-bold mb-2">Filter By</label>

                                <select class="form-select mb-2" id="dateFilter-gateway-statistics" onchange="handleFilterChangeGatewayStatistics(this.value)">
                                    <option value="today">
                                        Today
                                    </option>
                                    <option value="yesterday">
                                        Yesterday
                                    </option>
                                    <option value="this_week">
                                        This week
                                    </option>
                                    <option value="last_week">
                                        Last week
                                    </option>
                                    <option value="this_month">
                                        This month
                                    </option>
                                    <option value="last_month">
                                        Last month
                                    </option>
                                    <option value="this_year" selected>
                                        This year
                                    </option>
                                    <option value="previous_year">
                                        Previous year
                                    </option>
                                    <option value="custom">Custom Range</option>
                                </select>

                                <!-- Custom Range -->
                                <div id="customRange-gateway-statistics" class="d-none">
                                    <label class="form-label mt-2">Start Date</label>
                                    <input type="date" id="startDate-gateway-statistics" class="form-control">

                                    <label class="form-label mt-2">End Date</label>
                                    <input type="date" id="endDate-gateway-statistics" class="form-control">

                                    <button class="btn btn-primary mt-3 w-100" onclick="applyCustomRangeGatewayStatistics()">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                       <div id="chart-gateway-statistics" style="height: 303px !important;"></div>
                    </div>
                </div>
            </div>



















        </div>
    </div>
</div>





<script>
    <?php
      $labels = [];
      $data   = [];

      // initialize last 30 days with 0
      for ($i = 29; $i >= 0; $i--) {
          $date = date('Y-m-d', strtotime("-$i days"));
          $labels[$date] = 0;
      }

      $response_dashboard_info = json_decode(getData($db_prefix.'customer',' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'" AND created_date >= DATE_SUB(CURDATE(), INTERVAL 29 DAY) GROUP BY DATE(created_date)', 'DATE(created_date) as day, COUNT(*) as total FROM'),true);
      foreach($response_dashboard_info['response'] as $row){                       
          if (isset($labels[$row['day']])) {
              $labels[$row['day']] = (int)$row['total'];
          }
      }

      // prepare JS arrays
      $chartLabels = json_encode(array_keys($labels));
      $chartData   = json_encode(array_values($labels));
    ?>
  
    function loadChartCustomer() {
        if (!window.ApexCharts) return;

        new ApexCharts(document.getElementById("chart-customer"), {
            chart: {
                type: "area",
                fontFamily: "inherit",
                height: 40,
                sparkline: { enabled: true },
                animations: { enabled: false }
            },
            dataLabels: { enabled: false },
            fill: {
                type: "solid",
                colors: [
                    "color-mix(in srgb, transparent, var(--tblr-success) 16%)"
                ]
            },
            stroke: {
                width: 2,
                curve: "smooth",
                lineCap: "round"
            },
            series: [{
                name: "Customers",
                data: <?= $chartData ?>
            }],
            tooltip: { theme: "dark" },
            grid: { strokeDashArray: 4 },
            xaxis: {
                type: "datetime",
                labels: { show: false },
                axisBorder: { show: false },
                tooltip: { enabled: false }
            },
            yaxis: {
                labels: { show: false }
            },
            labels: <?= $chartLabels ?>,
            colors: [
                "color-mix(in srgb, transparent, var(--tblr-success) 100%)"
            ],
            legend: { show: false }
        }).render();
    }

    loadChartCustomer();


    <?php
      $labels = [];
      $data   = [];

      // initialize last 30 days with 0
      for ($i = 29; $i >= 0; $i--) {
          $date = date('Y-m-d', strtotime("-$i days"));
          $labels[$date] = 0;
      }

      $response_dashboard_info = json_decode(getData($db_prefix.'invoice',' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'" AND status = "unpaid" AND created_date >= DATE_SUB(CURDATE(), INTERVAL 29 DAY) GROUP BY DATE(created_date)', 'DATE(created_date) as day, COUNT(*) as total FROM'),true);
      foreach($response_dashboard_info['response'] as $row){                       
          if (isset($labels[$row['day']])) {
              $labels[$row['day']] = (int)$row['total'];
          }
      }

      // prepare JS arrays
      $chartLabels = json_encode(array_keys($labels));
      $chartData   = json_encode(array_values($labels));
    ?>
  
    function loadChartUnpaidInvoice() {
        if (!window.ApexCharts) return;

        new ApexCharts(document.getElementById("chart-unpaid-invoice"), {
            chart: {
                type: "area",
                fontFamily: "inherit",
                height: 40,
                sparkline: { enabled: true },
                animations: { enabled: false }
            },
            dataLabels: { enabled: false },
            fill: {
                type: "solid",
                colors: [
                    "color-mix(in srgb, transparent, var(--tblr-danger) 16%)"
                ]
            },
            stroke: {
                width: 2,
                curve: "smooth",
                lineCap: "round"
            },
            series: [{
                name: "Unpaid Invoices",
                data: <?= $chartData ?>
            }],
            tooltip: { theme: "dark" },
            grid: { strokeDashArray: 4 },
            xaxis: {
                type: "datetime",
                labels: { show: false },
                axisBorder: { show: false },
                tooltip: { enabled: false }
            },
            yaxis: {
                labels: { show: false }
            },
            labels: <?= $chartLabels ?>,
            colors: [
                "color-mix(in srgb, transparent, var(--tblr-danger) 100%)"
            ],
            legend: { show: false }
        }).render();
    }

    loadChartUnpaidInvoice();

    <?php
      $labels = [];
      $data   = [];

      // initialize last 30 days with 0
      for ($i = 29; $i >= 0; $i--) {
          $date = date('Y-m-d', strtotime("-$i days"));
          $labels[$date] = 0;
      }

      $response_dashboard_info = json_decode(getData($db_prefix.'transaction',' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'" AND status = "pending" AND created_date >= DATE_SUB(CURDATE(), INTERVAL 29 DAY) GROUP BY DATE(created_date)', 'DATE(created_date) as day, COUNT(*) as total FROM'),true);
      foreach($response_dashboard_info['response'] as $row){                       
          if (isset($labels[$row['day']])) {
              $labels[$row['day']] = (int)$row['total'];
          }
      }

      // prepare JS arrays
      $chartLabels = json_encode(array_keys($labels));
      $chartData   = json_encode(array_values($labels));
    ?>
  
    function loadChartPendingPayment() {
        if (!window.ApexCharts) return;

        new ApexCharts(document.getElementById("chart-pending-payment"), {
            chart: {
                type: "area",
                fontFamily: "inherit",
                height: 40,
                sparkline: { enabled: true },
                animations: { enabled: false }
            },
            dataLabels: { enabled: false },
            fill: {
                type: "solid",
                colors: [
                    "color-mix(in srgb, transparent, var(--tblr-warning) 16%)"
                ]
            },
            stroke: {
                width: 2,
                curve: "smooth",
                lineCap: "round"
            },
            series: [{
                name: "Pending Payments",
                data: <?= $chartData ?>
            }],
            tooltip: { theme: "dark" },
            grid: { strokeDashArray: 4 },
            xaxis: {
                type: "datetime",
                labels: { show: false },
                axisBorder: { show: false },
                tooltip: { enabled: false }
            },
            yaxis: {
                labels: { show: false }
            },
            labels: <?= $chartLabels ?>,
            colors: [
                "color-mix(in srgb, transparent, var(--tblr-warning) 100%)"
            ],
            legend: { show: false }
        }).render();
    }

    loadChartPendingPayment();

    <?php
      $labels = [];
      $data   = [];

      // initialize last 30 days with 0
      for ($i = 29; $i >= 0; $i--) {
          $date = date('Y-m-d', strtotime("-$i days"));
          $labels[$date] = 0;
      }

      $response_dashboard_info = json_decode(getData($db_prefix.'transaction', ' WHERE brand_id = "'.$global_response_brand['response'][0]['brand_id'].'" AND status NOT IN ("initiated", "expired") AND created_date >= DATE_SUB(CURDATE(), INTERVAL 29 DAY) GROUP BY DATE(created_date)', 'DATE(created_date) as day, COUNT(*) as total FROM'),true);
      foreach($response_dashboard_info['response'] as $row){                       
          if (isset($labels[$row['day']])) {
              $labels[$row['day']] = (int)$row['total'];
          }
      }

      // prepare JS arrays
      $chartLabels = json_encode(array_keys($labels));
      $chartData   = json_encode(array_values($labels));
    ?>
  
    function loadChartTotalPayment() {
        if (!window.ApexCharts) return;

        new ApexCharts(document.getElementById("chart-total-payment"), {
            chart: {
                type: "area",
                fontFamily: "inherit",
                height: 40,
                sparkline: { enabled: true },
                animations: { enabled: false }
            },
            dataLabels: { enabled: false },
            fill: {
                type: "solid",
                colors: [
                    "color-mix(in srgb, transparent, var(--tblr-primary) 16%)"
                ]
            },
            stroke: {
                width: 2,
                curve: "smooth",
                lineCap: "round"
            },
            series: [{
                name: "Total Payments",
                data: <?= $chartData ?>
            }],
            tooltip: { theme: "dark" },
            grid: { strokeDashArray: 4 },
            xaxis: {
                type: "datetime",
                labels: { show: false },
                axisBorder: { show: false },
                tooltip: { enabled: false }
            },
            yaxis: {
                labels: { show: false }
            },
            labels: <?= $chartLabels ?>,
            colors: [
                "color-mix(in srgb, transparent, var(--tblr-primary) 100%)"
            ],
            legend: { show: false }
        }).render();
    }

    loadChartTotalPayment();

    function load_dashboard_transaction_statistics(){
        const el = document.getElementById('filterDropdown-transaction-statistics');
        el.style.display = el.style.display = 'none';

        var csrf_token_default = $('input[name="csrf_token_default"]').val();
        var date = $('#dateFilter-transaction-statistics').val();
        var start = $('#startDate-transaction-statistics').val();
        var end = $('#endDate-transaction-statistics').val();
        
        document.querySelector(".dashboard-transaction-statistics-loading").innerHTML = '<div class="spinner-border spinner-border-sm text-primary me-2">  <span class="visually-hidden">Loading...</span></div>';

        $.ajax({
            type: 'POST',
            url: '<?php echo $site_url.$path_admin ?>/dashboard',
            data: {action: "dashboard-transaction-statistics", csrf_token: csrf_token_default, date: date, start: start, end: end},
            dataType: 'json',
            success: function (res) {
                document.querySelector(".dashboard-transaction-statistics-loading").innerHTML = '';

                document.querySelectorAll('input[name="csrf_token"]').forEach(input => {
                    input.value = res.csrf_token;
                });
                document.querySelectorAll('input[name="csrf_token_default"]').forEach(input => {
                    input.value = res.csrf_token;
                });

                if (res.status === 'true') {
                    if (chartTransactionStatistics) {
                      chartTransactionStatistics.destroy();
                    }

                    chartTransactionStatistics = new ApexCharts(
                      document.getElementById("chart-transaction-statistics"),
                      {
                        chart: {
                          type: "line",
                          height: 288,
                          fontFamily: "inherit",
                          toolbar: { show: false },
                          animations: { enabled: false }
                        },

                        stroke: {
                          width: 2,
                          curve: "smooth",
                          lineCap: "round"
                        },

                        series: [
                          {
                            name: "Total",
                            data: res.total
                          },
                          {
                            name: "Complete",
                            data: res.complete
                          },
                          {
                            name: "Pending",
                            data: res.pending
                          }
                        ],

                        xaxis: {
                          type: "category",
                          categories: res.labels,
                          labels: { padding: 0 }
                        },

                        yaxis: {
                          labels: { padding: 4 }
                        },

                        grid: {
                          strokeDashArray: 4,
                          padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                          }
                        },

                        tooltip: {
                          theme: "dark"
                        },

                        legend: {
                          show: true,
                          position: "bottom"
                        },

                        colors: [
                          "var(--tblr-primary)",
                          "var(--tblr-success)",
                          "var(--tblr-warning)"
                        ]
                      }
                    );

                    chartTransactionStatistics.render();

                    load_dashboard_gateway_statistics();
                } else {
                    createToast({
                        title: res.title,
                        description: res.message,
                        svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                        timeout: 6000,
                        top: 70
                    });
                }
            },
            error: function (xhr, status, error) {
                createToast({
                    title: 'Something Wrong!',
                    description: 'For further assistance, please contact our support team.',
                    svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                    timeout: 6000,
                    top: 70
                });
            }
        });
    }

    load_dashboard_transaction_statistics();

    function handleFilterChangeTransactionStatistics(value) {
        const custom = document.getElementById('customRange-transaction-statistics');

        if (value === 'custom') {
            custom.classList.remove('d-none');
        } else {
            custom.classList.add('d-none');

            load_dashboard_transaction_statistics();
        }
    }

    function applyCustomRangeTransactionStatistics() {
        const start = document.getElementById('startDate-transaction-statistics').value;
        const end   = document.getElementById('endDate-transaction-statistics').value;

        if (!start && !end) {
            createToast({
                title: "Action required",
                description: 'Please select at least one date',
                svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                timeout: 6000,
                top: 70
            });
        }else{
          load_dashboard_transaction_statistics();
        }
    }

    function load_dashboard_gateway_statistics(){
        const el = document.getElementById('filterDropdown-gateway-statistics');
        el.style.display = el.style.display = 'none';

        var csrf_token_default = $('input[name="csrf_token_default"]').val();
        var date = $('#dateFilter-gateway-statistics').val();
        var start = $('#startDate-gateway-statistics').val();
        var end = $('#endDate-gateway-statistics').val();
        
        document.querySelector(".dashboard-gateway-statistics-loading").innerHTML = '<div class="spinner-border spinner-border-sm text-primary me-2">  <span class="visually-hidden">Loading...</span></div>';

        $.ajax({
            type: 'POST',
            url: '<?php echo $site_url.$path_admin ?>/dashboard',
            data: {action: "dashboard-gateway-statistics", csrf_token: csrf_token_default, date: date, start: start, end: end},
            dataType: 'json',
            success: function (res) {
                document.querySelector(".dashboard-gateway-statistics-loading").innerHTML = '';

                document.querySelectorAll('input[name="csrf_token"]').forEach(input => {
                    input.value = res.csrf_token;
                });
                document.querySelectorAll('input[name="csrf_token_default"]').forEach(input => {
                    input.value = res.csrf_token;
                });

                if (res.status === 'true') {

                    if (chartGatewayStatistics) {
                      chartGatewayStatistics.destroy();
                    }


                    // Transform data to totals like Chart.js
                    const data = res.gateway_labels.map(label => {
                        return res.data[label] ? res.data[label].reduce((a,b)=>a+b,0) : 0;
                    });

                        chartGatewayStatistics = new ApexCharts(
                            document.getElementById("chart-gateway-statistics"),
                            {
                                chart: {
                                    type: "donut",
                                    height: 290,
                                    fontFamily: "inherit",
                                    sparkline: { enabled: true },
                                    animations: { enabled: false }
                                },
                                series: data,
                                labels: res.gateway_labels,
                                colors: res.colors,
                                tooltip: { theme: "dark", fillSeriesColor: false },
                                grid: { strokeDashArray: 4 },
                                legend: { show: true, position: "bottom", offsetY: 12 }
                            }
                        );
                        chartGatewayStatistics.render();

                } else {
                    createToast({
                        title: res.title,
                        description: res.message,
                        svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                        timeout: 6000,
                        top: 70
                    });
                }
            },
            error: function (xhr, status, error) {
                createToast({
                    title: 'Something Wrong!',
                    description: 'For further assistance, please contact our support team.',
                    svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                    timeout: 6000,
                    top: 70
                });
            }
        });
    }

    function handleFilterChangeGatewayStatistics(value) {
        const custom = document.getElementById('customRange-gateway-statistics');

        if (value === 'custom') {
            custom.classList.remove('d-none');
        } else {
            custom.classList.add('d-none');

            load_dashboard_gateway_statistics();
        }
    }

    function applyCustomRangeGatewayStatistics() {
        const start = document.getElementById('startDate-gateway-statistics').value;
        const end   = document.getElementById('endDate-gateway-statistics').value;

        if (!start && !end) {
            createToast({
                title: "Action required",
                description: 'Please select at least one date',
                svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d63939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>`,
                timeout: 6000,
                top: 70
            });
        }else{
          load_dashboard_gateway_statistics();
        }
    }

    function toggleFilter(ClassfilterDropdown) {
        const el = document.getElementById(ClassfilterDropdown);
        el.style.display = el.style.display === 'none' ? 'block' : 'none';
    }
</script>