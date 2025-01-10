@extends('admin.layouts.app')
@section('title', 'User Details')
@section('subheader')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <a href="{{ route('admin.home') }}">
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                        Dashboard
                    </h5>
                </a>
                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!--begin::Page Title-->
                <a href="{{ route('admin.users.index') }}">
                    <span class="text-muted font-weight-bold mr-4">
                        Users
                    </span></a>
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-muted font-weight-bold mr-4">User Details</span>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!-- toolbar -->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="container">
        <!--Begin:: Portlet-->
        <div class="row">
            <div class="col-lg-12 order-1 order-xxl-2">
                <div class="card card-custom">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            <div class="card-body">
                                <div class="kt-widget__top">
                                    <div class="kt-widget__media kt-hidden">
                                    </div>
                                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-bolder kt-font-light" style="    margin-right: 15px;">
                                        @php
                                            //   dd($user);
                                        @endphp
                                        <span class="text-uppercase">{{ substr($user->name, 0, 2) }}</span>

                                    </div>
                                    <div class="kt-widget__content">
                                        <div class="kt-widget__head">
                                            <div class="kt-widget__user">
                                                <a href="#" class="kt-widget__username">
                                                    {{ $user->name }}
                                                </a>
                                                <span
                                                    class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success">User
                                                </span>
                                            </div>
                                        </div>
                                        <div class="kt-widget__subhead">
                                            <i class="flaticon2-new-email"></i>  Email :{{ $user->email }}
                                        </div>
                                        <div class="kt-widget__subhead">
                                            <i class="flaticon2-phone"></i>  Phone :{{ $user->phone }}</div>
                                        <div class="kt-widget__info">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End:: Portlet-->
                    <!--Begin:: Portlet-->
                    <div class="card-body">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_contacts_view_tab_1"
                                            role="tab">
                                            <i class="flaticon2-calendar-3"></i> Personal
                                        </a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a class="nav-link " data-toggle="tab" href="#kt_contacts_view_tab_2" role="tab">-->
                                    <!--        <i class="flaticon2-user-outline-symbol"></i> Residential-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content  kt-margin-t-20">
                                <!--Begin:: Tab Content-->
                                <div class="tab-pane active" id="kt_contacts_view_tab_1" role="tabpanel">
                                    <form class="kt-form kt-form--label-left" action="">
                                        <div class="kt-form__body">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row" style="    width: 100%;  margin-top: 20px;  float: left;">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <!--<label class="col-xl-3"></label>-->
                                                                <div class="col-lg-9 col-xl-6">
                                                                    <h3 class="kt-section__title kt-section__title-md">
                                                                        Personal Info:</h3>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row ">
                                                                <label class="col-md-4 col-form-label"> Name :</label>
                                                                <div class="col-md-6">
                                                                    <span
                                                                        class="form-control-plaintext kt-font-bolder">{{ $user->name }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label">Phone :</label>
                                                                <div class="col-md-6">
                                                                    <span class="form-control-plaintext kt-font-bolder">{{ $user->phone }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label">Email :</label>
                                                                <div class="col-md-6">
                                                                    <span class="form-control-plaintext kt-font-bolder">
                                                                        {{ $user->email }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid">
                                        </div>
                                        <div class="kt-form__actions">
                                        </div>
                                    </form>
                                </div>
                                <!--End:: Tab Content-->
                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_contacts_view_tab_2" role="tabpanel">
                                    <form class="kt-form kt-form--label-left" action="">
                                        <div class="kt-form__body">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid">
                                        </div>
                                        <div class="kt-form__actions">
                                        </div>
                                    </form>
                                </div>
                                <!--End:: Tab Content-->
                                <div
                                    class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid">
                                </div>
                                <div class="kt-form__actions">
                                </div>
                            </div>
                            <!--End:: Tab Content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
