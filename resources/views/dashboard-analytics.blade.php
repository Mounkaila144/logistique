@extends('layouts.master')
@section('title') @lang('translation.analytics') @endsection
@section('css')

    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet">

@endsection
@section('content')


    <div class="row">
        <div class="col-xxl-5">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">

                                <div class="row align-items-end">
                                    <div class="col-sm-8">
                                        <div class="p-3">
                                            <p class="fs-16 lh-base">Si vous avez Besoin d'autre fonctionaliter veuille nous contacter sur whatsaap au<span
                                                    class="fw-semibold"> Numero </span> +227 97977199 <i
                                                    class="mdi mdi-arrow-right"></i></p>
                                            <div class="mt-3">
                                                <a
                                                    class="btn btn-success" href="https://wa.me/22797977199">Contactez</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="px-3">
                                            <img src="{{ URL::asset('build/images/user-illustarator-2.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Nombre de Transactions</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span
                                                class="counter-value" data-target="28.05">0</span>k</h2>
                                        <p class="mb-0 text-muted"><span
                                                class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                            </span>

                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="users" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Sessions</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span
                                                class="counter-value" data-target="97.66">0</span>k</h2>
                                        <p class="mb-0 text-muted"><span
                                                class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i> 3.96 %
                                            </span> vs. previous month</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="activity" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Avg. Visit Duration</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span
                                                class="counter-value" data-target="3">0</span>m
                                            <span class="counter-value" data-target="40">0</span>sec
                                        </h2>
                                        <p class="mb-0 text-muted"><span
                                                class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i> 0.24 %
                                            </span> vs. previous month</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="clock" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Bounce Rate</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span
                                                class="counter-value" data-target="33.48">0</span>%</h2>
                                        <p class="mb-0 text-muted"><span
                                                class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> 7.05 %
                                            </span> vs. previous month</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="external-link" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-7">
            <div class="row h-100">
                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Live Users By Country</h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    Export Report
                                </button>
                            </div>
                        </div><!-- end card header -->

                        <!-- card body -->
                        <div class="card-body">

                            <div id="users-by-country" data-colors='["--vz-light"]' class="text-center"
                                style="height: 252px"></div>

                            <div class="table-responsive table-card mt-3">
                                <table
                                    class="table table-borderless table-sm table-centered align-middle table-nowrap mb-1">
                                    <thead
                                        class="text-muted border-dashed border border-start-0 border-end-0 bg-light-subtle">
                                        <tr>
                                            <th>Duration (Secs)</th>
                                            <th style="width: 30%;">Sessions</th>
                                            <th style="width: 30%;">Views</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        <tr>
                                            <td>0-30</td>
                                            <td>2,250</td>
                                            <td>4,250</td>
                                        </tr>
                                        <tr>
                                            <td>31-60</td>
                                            <td>1,501</td>
                                            <td>2,050</td>
                                        </tr>
                                        <tr>
                                            <td>61-120</td>
                                            <td>750</td>
                                            <td>1,600</td>
                                        </tr>
                                        <tr>
                                            <td>121-240</td>
                                            <td>540</td>
                                            <td>1,040</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Sessions by Countries</h4>
                            <div>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    ALL
                                </button>
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    1M
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    6M
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div>
                                <div id="countries_charts"
                                    data-colors='["--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-danger", "--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-info"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div> <!-- end col-->

            </div> <!-- end row-->
        </div><!-- end col -->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Audiences Metrics</h4>
                    <div>
                        <button type="button" class="btn btn-soft-secondary btn-sm">
                            ALL
                        </button>
                        <button type="button" class="btn btn-soft-secondary btn-sm">
                            1M
                        </button>
                        <button type="button" class="btn btn-soft-secondary btn-sm">
                            6M
                        </button>
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            1Y
                        </button>
                    </div>
                </div><!-- end card header -->
                <div class="card-header p-0 border-0 bg-light-subtle">
                    <div class="row g-0 text-center">
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="854">0</span>
                                    <span class="text-success ms-1 fs-12">49%<i
                                            class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                </h5>
                                <p class="text-muted mb-0">Avg. Session</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="1278">0</span>
                                    <span class="text-success ms-1 fs-12">60%<i
                                            class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                </h5>
                                <p class="text-muted mb-0">Conversion Rate</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="3">0</span>m
                                    <span class="counter-value" data-target="40">0</span>sec
                                    <span class="text-success ms-1 fs-12">37%<i
                                            class="ri-arrow-right-up-line ms-1 align-middle"></i></span>
                                </h5>
                                <p class="text-muted mb-0">Avg. Session Duration</p>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div><!-- end card header -->
                <div class="card-body p-0 pb-2">
                    <div>
                        <div id="audiences_metrics_charts"
                            data-colors='["--vz-success", "--vz-light"]' class="apex-charts"
                            dir="ltr"></div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-6">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Audiences Sessions by Country</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span
                                    class="text-muted">Current Week<i
                                        class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Last Week</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Current Year</a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body p-0">
                    <div>
                        <div id="audiences-sessions-country-charts"
                            data-colors='["--vz-success", "--vz-info"]' class="apex-charts" dir="ltr">
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
