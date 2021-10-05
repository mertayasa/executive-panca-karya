<div class="row">
    <div class="col-12 col-md-7 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row col-12 align-items-center justify-content-between p-0">
                    <div class="col-8">
                        <h4>Grafik Pendapatan & Pengeluaran <span
                                id="incomeSelectedYear">{{ \Carbon\Carbon::now()->year }}</span>
                        </h4>
                    </div>
                    <div class="col-4 text-right px-0">
                        <div class="card-stats-title">
                            <div class="dropdown d-inline">
                                <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"
                                    id="orders-month">Pilih Tahun</a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    @foreach ($dashboard_data['years'] as $year)
                                        <li><a href="javascript:void(0)" class="dropdown-item"
                                                onclick="generateChartData('{{ $year }}')">{{ $year }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="myChart" height="350"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-5 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row col-12 align-items-center justify-content-between p-0">
					<div class="col-8">
                        <h4>Grafik Pendapatan & Pengeluaran <span
                                id="doughnutSelectedYear">{{ \Carbon\Carbon::now()->year }}</span>
                        </h4>
                    </div>
                    <div class="col-4 text-right px-0">
                        <div class="card-stats-title">
                            <div class="dropdown d-inline">
                                <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"
                                    id="orders-month">Pilih Tahun</a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    @foreach ($dashboard_data['years'] as $year)
                                        <li><a href="javascript:void(0)" class="dropdown-item"
                                                onclick="generateDoughnutChartData('{{ $year }}')">{{ $year }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="yearlyDoughnutChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row col-12 align-items-center justify-content-between p-0">
					<div class="col-12">
                        <h4>Grafik Pendapatan Berdasarkan Jenis</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="incomeByCategory"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row col-12 align-items-center justify-content-between p-0">
					<div class="col-12">
                        <h4>Grafik Pengeluaran Berdasarkan Jenis</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="expenditureByCategory"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-7 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row col-12 align-items-center justify-content-between p-0">
                    <div class="col-12">
                        <h4>Piutang s/d Sekarang</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('income.receivable.receivable_datatable')
            </div>
        </div>
    </div>

    <div class="col-12 col-md-5 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row col-12 align-items-center justify-content-between p-0">
					<div class="col-8">
                        <h4>Pendapatan & Pengeluaran Bulan <span id="monthlySelectedMonth">{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->isoFormat('MMMM') }}</span>
                        </h4>
                    </div>
                    <div class="col-4 text-right px-0">
                        <div class="card-stats-title">
                            <div class="dropdown d-inline">
                                <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"
                                    id="orders-month">Pilih Bulan</a>
                                <ul class="dropdown-menu dropdown-menu-sm">
									@php
										$months = ['01' => "Januari", '02' => "Februari", '03' => "Maret", '04' => "April", '05' => "Mei", '06' => "Juni", '07' => "Juli", '08' => "Agustus", '09' => "September", '10' => "Oktober", '11' => "November", '12' => "Desember"]
									@endphp
                                    @foreach ($months as $key => $month)
                                        <li><a href="javascript:void(0)" class="dropdown-item"
                                                onclick="generateMonthlyChartData('{{ $key }}')">{{ $month }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="monthlyBarChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let chart
        generateChartData()

        function generateChartData(year = null) {
            const url = "{{ route('dashboard.chart_income_expenditure') }}"
            let formData = year == null ? {
                year: 'now'
            } : {
                year: year
            }

            const incomeSelectedYear = document.getElementById('incomeSelectedYear')

            if (year != null) {
                incomeSelectedYear.innerHTML = year
            }

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.code === 1) {
                        if (year != null) {
                            chart.destroy()
                            chart = showChart(data)
                        } else {
                            chart = showChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

        function showChart(data) {
            let canvasForecast = $('#myChart');
            const labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ]
            let barChart = new Chart(canvasForecast, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            // lineTension: 0,
                            label: 'Pendapatan',
                            borderColor: "#6777ef",
                            backgroundColor: "#6777ef",
                            pointHoverBorderColor: "#6777ef",
                            pointBorderWidth: 0,
                            pointHoverRadius: 10,
                            pointHoverBorderWidth: 1,
                            pointRadius: 3,
                            fill: false,
                            borderWidth: 4,
                            data: data.income
                        },
                        {
                            // lineTension: 0,
                            label: 'Pengeluaran',
                            borderColor: "#FF0000",
                            backgroundColor: "#FF0000",
                            pointHoverBorderColor: "#FF0000",
                            pointBorderWidth: 0,
                            pointHoverRadius: 10,
                            pointHoverBorderWidth: 1,
                            pointRadius: 3,
                            fill: false,
                            borderWidth: 4,
                            data: data.expenditure
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // Can't just just `stacked: true` like the docs say
                    scales: {
                        yAxes: [{
                            // stacked: true,
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    animation: {
                        duration: 750,
                    },
                }
            });

            return barChart
        }

        let yearlyDoughnutChart
        generateDoughnutChartData()

        function generateDoughnutChartData(year = null) {
            const url = "{{ route('dashboard.chart_income_expenditure') }}"
            let formData = year == null ? {year: 'now', type:'doughnut'} : {year: year, type:'doughnut'}

            const doughnutSelectedYear = document.getElementById('doughnutSelectedYear')

            if (year != null) {
                doughnutSelectedYear.innerHTML = year
            }

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.code === 1) {
                        if (year != null) {
                            yearlyDoughnutChart.destroy()
                            yearlyDoughnutChart = showDoughnutChart(data)
                        } else {
                            yearlyDoughnutChart = showDoughnutChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

        function showDoughnutChart(data) {
            let doughnutChart = $('#yearlyDoughnutChart');
            const labels = ["Pendapatan", "Pengeluaran"]
            let doughtChartRating = new Chart(doughnutChart, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Keuangan',
                        backgroundColor: [
                            '#e76f51',
                            '#f4a261',
                        ],
                        pointBorderWidth: 0,
                        pointHoverRadius: 10,
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        fill: false,
                        borderWidth: 1,
                        data: [data.income, data.expenditure]
                    }, ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // plugins: {
                    //     tooltip: {
                    //         callbacks: {
                    //             title: tooltipItems => {
                    //                 return 'Rating ' + tooltipItems[0].label
                    //             },
                    //             label: tooltipItems => {
                    //                 return ''
                    //             },
                    //             afterLabel: tooltipItems => {
                    //                 return tooltipItems.formattedValue + ' Responden'
                    //             }
                    //         },
                    //     },
                    // },
                    animation: {
                        duration: 750,
                    },
                }
            });

            return doughtChartRating
        }

        let monthlyChartData
        generateMonthlyChartData()

        function generateMonthlyChartData(month = null) {
            const url = "{{ route('dashboard.chart_income_expenditure_monthly') }}"
            let formData = month == null ? {month: 'now'} : {month: month}

            const monthlySelectedMonth = document.getElementById('monthlySelectedMonth')
			const months = {'month01':"Januari", 'month02': "Februari", 'month03': "Maret", 'month04': "April", 'month05': "Mei", 'month06': "Juni", 'month07': "Juli", 'month08': "Agustus", 'month09': "September", 'month10': "Oktober", 'month11': "November", 'month12': "Desember"}

            if (month != null) {
				let monthIndex = 'month' + month
                monthlySelectedMonth.innerHTML = months[monthIndex]
            }

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.code === 1) {
                        if (month != null) {
                            monthlyChartData.destroy()
                            monthlyChartData = showMonthlyBarChart(data)
                        } else {
                            monthlyChartData = showMonthlyBarChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

		function showMonthlyBarChart(data) {
            let monthlyBarChartEl = $('#monthlyBarChart');
            let monthlyBarChart = new Chart(monthlyBarChartEl, {
                type: 'bar',
                data: {
                    labels: ['2021'],
                    datasets: [{
                            // lineTension: 0,
                            label: 'Pendapatan',
                            borderColor: "#6777ef",
                            backgroundColor: "#6777ef",
                            pointHoverBorderColor: "#6777ef",
                            pointBorderWidth: 0,
                            pointHoverRadius: 10,
                            pointHoverBorderWidth: 1,
                            pointRadius: 3,
                            fill: false,
                            borderWidth: 4,
                            data: data.income
                        },
                        {
                            // lineTension: 0,
                            label: 'Pengeluaran',
                            borderColor: "#FF0000",
                            backgroundColor: "#FF0000",
                            pointHoverBorderColor: "#FF0000",
                            pointBorderWidth: 0,
                            pointHoverRadius: 10,
                            pointHoverBorderWidth: 1,
                            pointRadius: 3,
                            fill: false,
                            borderWidth: 4,
                            data: data.expenditure
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // Can't just just `stacked: true` like the docs say
                    scales: {
                        yAxes: [{
                            // stacked: true,
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    animation: {
                        duration: 750,
                    },
                }
            });

            return monthlyBarChart
        }

        let incomeByCategory
        generateChartIncomeCategory()

        function generateChartIncomeCategory(month = null) {
            const url = "{{ route('dashboard.chart_income_by_category') }}"

            $.ajax({
                url: url,
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(data) {
					console.log(data)
                    if (data.code === 1) {
                        if (month != null) {
                            incomeByCategory.destroy()
                            incomeByCategory = showIncomeCategoryChart(data)
                        } else {
                            incomeByCategory = showIncomeCategoryChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

		function showIncomeCategoryChart(data) {
            let incomeCategoryEl = $('#incomeByCategory');
            const labels = data.labels
            let doughtChartRating = new Chart(incomeCategoryEl, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
							label: 'Pendapatan',
							backgroundColor: data.colors,
							pointBorderWidth: 0,
							pointHoverRadius: 10,
							pointHoverBorderWidth: 1,
							pointRadius: 3,
							fill: false,
							borderWidth: 1,
							data: data.income
						}, 
					]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // plugins: {
                    //     tooltip: {
                    //         callbacks: {
                    //             title: tooltipItems => {
                    //                 return 'Rating ' + tooltipItems[0].label
                    //             },
                    //             label: tooltipItems => {
                    //                 return ''
                    //             },
                    //             afterLabel: tooltipItems => {
                    //                 return tooltipItems.formattedValue + ' Responden'
                    //             }
                    //         },
                    //     },
                    // },
                    animation: {
                        duration: 750,
                    },
                }
            });

            return doughtChartRating
        }

        let expenditureByCategory
        generateChartExpenditureByCategory()

        function generateChartExpenditureByCategory(month = null) {
            const url = "{{ route('dashboard.chart_expen_by_category') }}"

            $.ajax({
                url: url,
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(data) {
					console.log(data)
                    if (data.code === 1) {
                        if (month != null) {
                            expenditureByCategory.destroy()
                            expenditureByCategory = showExpenCategoryChart(data)
                        } else {
                            expenditureByCategory = showExpenCategoryChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

		function showExpenCategoryChart(data) {
            let expenditureByCategoryEl = $('#expenditureByCategory');
            const labels = data.labels
            let expenditureByCategoryChart = new Chart(expenditureByCategoryEl, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
							label: 'Pengeluaran',
							backgroundColor: data.colors,
							pointBorderWidth: 0,
							pointHoverRadius: 10,
							pointHoverBorderWidth: 1,
							pointRadius: 3,
							fill: false,
							borderWidth: 1,
							data: data.expenditure
						}, 
					]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // plugins: {
                    //     tooltip: {
                    //         callbacks: {
                    //             title: tooltipItems => {
                    //                 return 'Rating ' + tooltipItems[0].label
                    //             },
                    //             label: tooltipItems => {
                    //                 return ''
                    //             },
                    //             afterLabel: tooltipItems => {
                    //                 return tooltipItems.formattedValue + ' Responden'
                    //             }
                    //         },
                    //     },
                    // },
                    animation: {
                        duration: 750,
                    },
                }
            });

            return expenditureByCategoryChart
        }
    </script>
@endpush
