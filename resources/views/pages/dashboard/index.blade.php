@extends('layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @hasrole(\App\Models\Organisation\ACL::ROLE_ADMIN)
        @include('pages.dashboard.admin.admin-dashboard')
    @endhasrole
    @hasrole(\App\Models\Organisation\ACL::ROLE_HR_ADMIN)
        @include('pages.dashboard.admin.admin-dashboard')
    @endhasrole
    @hasrole(\App\Models\Organisation\ACL::ROLE_HR)
        @include('pages.dashboard.hr.hr-dashboard')
    @endhasrole
    @hasrole(\App\Models\Organisation\ACL::ROLE_HR_RECRUITS)
        @include('pages.dashboard.hr_recruits.hr-recruits-dashboard')
    @endhasrole
{{--    @hasrole(\App\Models\Organisation\ACL::ROLE_HELPDESK_ADMIN)--}}
{{--        @include('pages.dashboard.helpdesk_admin.helpdesk-admin-dashboard')--}}
{{--    @endhasrole--}}
    @hasrole(\App\Models\Organisation\ACL::ROLE_SUPERVISOR)
        @include('pages.dashboard.supervisor.supervisor-dashboard')
    @endhasrole
    @hasrole(\App\Models\Organisation\ACL::ROLE_STAFF)
        @include('pages.dashboard.staff.staff-dashboard')
    @endhasrole

@endsection

@push('page_scripts')
    <script>
        $(function () {
            var role_names = {!! json_encode($role_names, JSON_HEX_TAG) !!};
            var role_user_count = {!! json_encode($role_user_count, JSON_HEX_TAG) !!};
            var role_permission_count = {!! json_encode($role_permission_count, JSON_HEX_TAG) !!};


            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */
            var donutData        = {
                labels: role_names,
                datasets: [
                    {
                        data: role_user_count,
                        backgroundColor : ['#008080', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#f56954'],
                    }
                ]
            }

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData        = donutData;
            var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                    display: true,

                    position: 'right'
                }
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            var areaChartData = {
                labels  : role_names,
                datasets: [
                    {
                        label               : 'Permissions',
                        backgroundColor     : '#008080',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : role_permission_count
                    },
                    {
                        label               : 'Users',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : role_user_count
                    },
                ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp1 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp1

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false,
                legend: {
                    display: true,

                    position: 'bottom'
                }
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

        })
    </script>
@endpush

