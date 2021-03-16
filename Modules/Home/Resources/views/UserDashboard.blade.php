@extends('home::layouts.UserLayout')
@section('title')
    <title>{{env('WEBSITE_TITLE')}} | Dashboard</title>
@endsection
@section('content')
    <!--begin::Content-->
    @if(session('failed'))
        <script>
            toastr.error("{{session('failed')}}");
        </script>
    @elseif(session('success'))
        <script>
            toastr.error("{{session('success')}}");
        </script>
    @endif
    <div class="content  d-flex flex-column flex-column-fluid" id="Sb_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Dashboard-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-3 col-sm-12">
                        <!--begin::Accounts-->
                        <a href="publishing/schedule_messages.html" class="card card-custom gutter-b card-stretch">
                            <!--begin::Body-->
                            <div class="card-body position-relative overflow-hidden">
                                <i class="far fa-edit fa-3x"></i>
                                <h4 class="mt-3 font-weight-bolder">Create a new post</h4>
                                <p>Publish, schedule or queue ....</p>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Accounts-->
                    </div>
                    <div class="col-xl-3 col-sm-12">
                        <!--begin::Accounts-->
                        <a href="publishing/calendar_view.html" class="card card-custom gutter-b card-stretch">
                            <!--begin::Body-->
                            <div class="card-body position-relative overflow-hidden">
                                <i class="far fa-calendar-alt fa-3x"></i>
                                <h4 class="mt-3 font-weight-bolder">Calendar view</h4>
                                <p>Check your Socio Calendar ...</p>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Accounts-->
                    </div>
                    <div class="col-xl-3 col-sm-12">
                        <!--begin::Accounts-->
                        <a href="reports/team_report.html" class="card card-custom gutter-b card-stretch">
                            <!--begin::Body-->
                            <div class="card-body position-relative overflow-hidden">
                                <i class="fas fa-chart-line fa-3x"></i>
                                <h4 class="mt-3 font-weight-bolder">Team reports</h4>
                                <p>Check your team reports and ...</p>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Accounts-->
                    </div>
                    <div class="col-xl-3 col-sm-12">
                        <!--begin::Accounts-->
                        <a href="#" class="card card-custom gutter-b card-stretch">
                            <!--begin::Body-->
                            <div class="card-body position-relative overflow-hidden">
                                <i class="far fa-clock fa-3x"></i>
                                <h4 class="mt-3 font-weight-bolder">Premium plan</h4>
                                <p>20 days remaining!!</p>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Accounts-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Mixed Widget 2-->
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title font-weight-bolder">Stats</h3>
                                <div class="card-toolbar">
                                    <select class="form-control selectpicker">
                                        <option>Today</option>
                                        <option>Yesterday</option>
                                        <option>Last 7 Days</option>
                                        <option>This Month</option>
                                        <option>Last Month</option>
                                        <option>This Year</option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body p-0 position-relative overflow-hidden">
                                <!--begin::Chart-->
                                <div id="line-adwords" class="card-rounded-bottom " style="height: 200px"></div>
                                <!--end::Chart-->

                                <!--begin::Stats-->
                                <div class="card-spacer mt-n25">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12 card border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                                                <i class="far fa-clock fa-3x"></i>
                                                                <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                        </span>
                                            <a href="#" class="font-weight-bold font-size-h6 text-center mt-2">
                                                Scheduled
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-12 card border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="far fa-calendar-check fa-3x"></i>
                                                            <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                        </span>
                                            <a href="#" class="font-weight-bold font-size-h6 text-center mt-2">
                                                Published
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-12 card border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="far fa-calendar-times fa-3x"></i>
                                                            <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                        </span>
                                            <a href="#" class="font-weight-bold font-size-h6 text-center mt-2">
                                                Failed
                                            </a>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 2-->
                    </div>

                    <div class="col-xl-4">
                        <!--begin::Accounts-->
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title font-weight-bolder">Sentiment Analysis</h3>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body pt-2 position-relative overflow-hidden">


                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Accounts-->
                    </div>

                    <div class="col-xl-4">
                        <!--begin::Accounts-->
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title font-weight-bolder">Accounts</h3>

                                <div class="card-toolbar">
                                    <a href="view-accounts" class="btn btn-sm">
                                        View Accounts
                                    </a>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body pt-2 position-relative overflow-hidden">
                                <button data-toggle="modal" data-target="#addAccountsModal"
                                        class="btn font-weight-bolder font-size-h6 px-8 py-4 my-3 col-12">+ Add Accounts
                                </button>
                                <small class="text-center">*Note: Click on "<b> Add Accounts </b>" button to add social
                                    profiles
                                </small>
                                <!-- begin:Add Accounts Modal-->
                                <div class="modal fade" id="addAccountsModal" tabindex="-1" role="dialog"
                                     aria-labelledby="addAccountsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addAccountsModalLabel">Add Accounts</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="">
                                                    <ul class="nav justify-content-center nav-pills" id="AddAccountsTab"
                                                        role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="facebook-tab-accounts"
                                                               data-toggle="tab" href="#facebook-add-accounts">
                                                                <span class="nav-text"><i
                                                                            class="fab fa-facebook fa-2x"></i></span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="twitter-tab-accounts"
                                                               data-toggle="tab" href="#twitter-add-accounts"
                                                               aria-controls="twitter">
                                                                <span class="nav-text"><i
                                                                            class="fab fa-twitter fa-2x"></i></span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="instagram-tab-accounts"
                                                               data-toggle="tab" href="#instagram-add-accounts"
                                                               aria-controls="instagram">
                                                                <span class="nav-text"><i
                                                                            class="fab fa-instagram fa-2x"></i></span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="linkedin-tab-accounts"
                                                               data-toggle="tab" href="#linkedin-add-accounts"
                                                               aria-controls="linkedin">
                                                                <span class="nav-text"><i
                                                                            class="fab fa-linkedin fa-2x"></i></span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="youtube-tab-accounts"
                                                               data-toggle="tab" href="#youtube-add-accounts"
                                                               aria-controls="youtube">
                                                                <span class="nav-text"><i
                                                                            class="fab fa-youtube fa-2x"></i></span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="pinterest-tab-accounts"
                                                               data-toggle="tab" href="#pinterest-add-accounts"
                                                               aria-controls="pinterest">
                                                                <span class="nav-text"><i
                                                                            class="fab fa-pinterest fa-2x"></i></span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="tumblr-tab-accounts"
                                                               data-toggle="tab" href="#tumblr-add-accounts"
                                                               aria-controls="tumblr">
                                                                <span class="nav-text"><i
                                                                            class="fab fa-tumblr fa-2x"></i></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content mt-5" id="AddAccountsTabContent">
                                                        <div class="tab-pane fade show active"
                                                             id="facebook-add-accounts" role="tabpanel"
                                                             aria-labelledby="facebook-tab-accounts">
                                                            <p>Socioboard needs permission to access and publish content
                                                                to Facebook on your behalf. To grant permission, you
                                                                must be an admin for your brand’s Facebook page.</p>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="/add-accounts/Facebook" type="button"
                                                                   class="btn btn-facebook font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Facebook Profile</a>
                                                                <a href="/add-accounts/Facebook" type="button"
                                                                   class="btn btn-facebook fb_page_btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Facebook FanPage</a>
                                                            </div>
                                                            <div class="mt-3 fb_page_div">
                                                                <span>Choose Facebook pages for posting</span>
                                                                <div class="scroll scroll-pull" data-scroll="true"
                                                                     data-wheel-propagation="true"
                                                                     style="height: 200px; overflow-y: scroll;">
                                                                    <!--begin::Page-->
                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                        <!--begin::Facebook Fanpage Profile picture-->
                                                                        <div class="symbol symbol-45 symbol-light mr-5">
                                                                                        <span class="symbol-label">
                                                                                            <img
                                                                                                    src="assets/media/svg/misc/006-plurk.svg"
                                                                                                    class="h-50 align-self-center"
                                                                                                    alt=""/>
                                                                                        </span>
                                                                        </div>
                                                                        <!--end::Facebook Fanpage Profile picture-->
                                                                        <!--begin::Section-->
                                                                        <div
                                                                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                            <!--begin::Info-->
                                                                            <div
                                                                                    class="d-flex flex-column align-items-cente py-2 w-75">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:;"
                                                                                   class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                    Facebook FanPage Name
                                                                                </a>
                                                                                <!--end::Title-->

                                                                                <!--begin::Data-->
                                                                                <span
                                                                                        class="text-muted font-weight-bold">
                                                                                                2M followers
                                                                                            </span>
                                                                                <!--end::Data-->
                                                                            </div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Section-->
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                                class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                            <input type="checkbox" value="1"/>
                                                                            <span></span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Page-->
                                                                    <!--begin::Page-->
                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                        <!--begin::Facebook Fanpage Profile picture-->
                                                                        <div class="symbol symbol-45 symbol-light mr-5">
                                                                                        <span class="symbol-label">
                                                                                            <img
                                                                                                    src="assets/media/svg/misc/006-plurk.svg"
                                                                                                    class="h-50 align-self-center"
                                                                                                    alt=""/>
                                                                                        </span>
                                                                        </div>
                                                                        <!--end::Facebook Fanpage Profile picture-->
                                                                        <!--begin::Section-->
                                                                        <div
                                                                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                            <!--begin::Info-->
                                                                            <div
                                                                                    class="d-flex flex-column align-items-cente py-2 w-75">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:;"
                                                                                   class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                    Facebook FanPage Name
                                                                                </a>
                                                                                <!--end::Title-->

                                                                                <!--begin::Data-->
                                                                                <span
                                                                                        class="text-muted font-weight-bold">
                                                                                                2M followers
                                                                                            </span>
                                                                                <!--end::Data-->
                                                                            </div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Section-->
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                                class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                            <input type="checkbox" value="1"/>
                                                                            <span></span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Page-->
                                                                    <!--begin::Page-->
                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                        <!--begin::Facebook Fanpage Profile picture-->
                                                                        <div class="symbol symbol-45 symbol-light mr-5">
                                                                                        <span class="symbol-label">
                                                                                            <img
                                                                                                    src="assets/media/svg/misc/006-plurk.svg"
                                                                                                    class="h-50 align-self-center"
                                                                                                    alt=""/>
                                                                                        </span>
                                                                        </div>
                                                                        <!--end::Facebook Fanpage Profile picture-->
                                                                        <!--begin::Section-->
                                                                        <div
                                                                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                            <!--begin::Info-->
                                                                            <div
                                                                                    class="d-flex flex-column align-items-cente py-2 w-75">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:;"
                                                                                   class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                    Facebook FanPage Name
                                                                                </a>
                                                                                <!--end::Title-->

                                                                                <!--begin::Data-->
                                                                                <span
                                                                                        class="text-muted font-weight-bold">
                                                                                                2M followers
                                                                                            </span>
                                                                                <!--end::Data-->
                                                                            </div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Section-->
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                                class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                            <input type="checkbox" value="1"/>
                                                                            <span></span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Page-->
                                                                    <!--begin::Page-->
                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                        <!--begin::Facebook Fanpage Profile picture-->
                                                                        <div class="symbol symbol-45 symbol-light mr-5">
                                                                                        <span class="symbol-label">
                                                                                            <img
                                                                                                    src="assets/media/svg/misc/006-plurk.svg"
                                                                                                    class="h-50 align-self-center"
                                                                                                    alt=""/>
                                                                                        </span>
                                                                        </div>
                                                                        <!--end::Facebook Fanpage Profile picture-->
                                                                        <!--begin::Section-->
                                                                        <div
                                                                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                            <!--begin::Info-->
                                                                            <div
                                                                                    class="d-flex flex-column align-items-cente py-2 w-75">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:;"
                                                                                   class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                    Facebook FanPage Name
                                                                                </a>
                                                                                <!--end::Title-->

                                                                                <!--begin::Data-->
                                                                                <span
                                                                                        class="text-muted font-weight-bold">
                                                                                                2M followers
                                                                                            </span>
                                                                                <!--end::Data-->
                                                                            </div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Section-->
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                                class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                            <input type="checkbox" value="1"/>
                                                                            <span></span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Page-->
                                                                    <!--begin::Page-->
                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                        <!--begin::Facebook Fanpage Profile picture-->
                                                                        <div class="symbol symbol-45 symbol-light mr-5">
                                                                                        <span class="symbol-label">
                                                                                            <img
                                                                                                    src="assets/media/svg/misc/006-plurk.svg"
                                                                                                    class="h-50 align-self-center"
                                                                                                    alt=""/>
                                                                                        </span>
                                                                        </div>
                                                                        <!--end::Facebook Fanpage Profile picture-->
                                                                        <!--begin::Section-->
                                                                        <div
                                                                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                            <!--begin::Info-->
                                                                            <div
                                                                                    class="d-flex flex-column align-items-cente py-2 w-75">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:;"
                                                                                   class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                    Facebook FanPage Name
                                                                                </a>
                                                                                <!--end::Title-->

                                                                                <!--begin::Data-->
                                                                                <span
                                                                                        class="text-muted font-weight-bold">
                                                                                                2M followers
                                                                                            </span>
                                                                                <!--end::Data-->
                                                                            </div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Section-->
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                                class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                            <input type="checkbox" value="1"/>
                                                                            <span></span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Page-->
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="javascript:;" type="button"
                                                                       class="btn btn-facebook font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Submit
                                                                        for adding pages</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="twitter-add-accounts"
                                                             role="tabpanel" aria-labelledby="twitter-tab-accounts">
                                                            <p>Please make sure you are logged in with the proper
                                                                account when you authorize Socioboard.</p>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="/add-accounts/Twitter" type="button"
                                                                   class="btn btn-twitter font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Twitter Profile</a>
                                                            </div>
                                                            <label class="checkbox mb-0 pt-5">
                                                                <input type="checkbox" name="sb-twt" checked/>
                                                                <span class="mr-2"></span>
                                                                Follow Socioboard on twitter for update & announcements
                                                            </label>
                                                        </div>
                                                        <div class="tab-pane fade" id="instagram-add-accounts"
                                                             role="tabpanel" aria-labelledby="instagram-tab-accounts">
                                                            <p>To allow Socioboard access to your Instagram account, you
                                                                must first give authorization from the Instagram
                                                                website.</p>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="javascript:;" type="button"
                                                                   class="btn btn-instagram font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Instagram Profile</a>
                                                                <a href="javascript:;" type="button"
                                                                   class="btn btn-instagram font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Business Account</a>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="linkedin-add-accounts"
                                                             role="tabpanel" aria-labelledby="linkedin-tab-accounts">
                                                            <p>Grant access to your profile to share updates and view
                                                                your feed.</p>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="/add-accounts/LinkedIn" type="button"
                                                                   class="btn btn-linkedin font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a LinkedIn Profile</a>
                                                                <a href="javascript:;" type="button"
                                                                   class="btn btn-linkedin linkedin_page_btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Company Profile</a>
                                                            </div>

                                                            <div class="mt-3 linkedin_page_div">
                                                                <span>Choose LinkedIn Company Pages for posting</span>
                                                                <div class="scroll scroll-pull" data-scroll="true"
                                                                     data-wheel-propagation="true"
                                                                     style="height: 200px; overflow-y: scroll;">
                                                                    <!--begin::Page-->
                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                        <!--begin::Linkedin Company Profile picture-->
                                                                        <div class="symbol symbol-45 symbol-light mr-5">
                                                                                        <span class="symbol-label">
                                                                                            <img
                                                                                                    src="assets/media/svg/misc/006-plurk.svg"
                                                                                                    class="h-50 align-self-center"
                                                                                                    alt=""/>
                                                                                        </span>
                                                                        </div>
                                                                        <!--end::Linkedin Company Profile picture-->
                                                                        <!--begin::Section-->
                                                                        <div
                                                                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                            <!--begin::Info-->
                                                                            <div
                                                                                    class="d-flex flex-column align-items-cente py-2 w-75">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:;"
                                                                                   class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                    Linkedin Company Page Name
                                                                                </a>
                                                                                <!--end::Title-->

                                                                                <!--begin::Data-->
                                                                                <span
                                                                                        class="text-muted font-weight-bold">
                                                                                                2M followers
                                                                                            </span>
                                                                                <!--end::Data-->
                                                                            </div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Section-->
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                                class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                            <input type="checkbox" value="1"/>
                                                                            <span></span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Page-->
                                                                    <!--begin::Page-->
                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                        <!--begin::Linkedin Company Profile picture-->
                                                                        <div class="symbol symbol-45 symbol-light mr-5">
                                                                                        <span class="symbol-label">
                                                                                            <img
                                                                                                    src="assets/media/svg/misc/006-plurk.svg"
                                                                                                    class="h-50 align-self-center"
                                                                                                    alt=""/>
                                                                                        </span>
                                                                        </div>
                                                                        <!--end::Linkedin Company Profile picture-->
                                                                        <!--begin::Section-->
                                                                        <div
                                                                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                            <!--begin::Info-->
                                                                            <div
                                                                                    class="d-flex flex-column align-items-cente py-2 w-75">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:;"
                                                                                   class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                                    Linkedin Company Page Name
                                                                                </a>
                                                                                <!--end::Title-->

                                                                                <!--begin::Data-->
                                                                                <span
                                                                                        class="text-muted font-weight-bold">
                                                                                                2M followers
                                                                                            </span>
                                                                                <!--end::Data-->
                                                                            </div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Section-->
                                                                        <!--begin::Checkbox-->
                                                                        <label
                                                                                class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                            <input type="checkbox" value="1"/>
                                                                            <span></span>
                                                                        </label>
                                                                        <!--end::Checkbox-->
                                                                    </div>
                                                                    <!--end::Page-->
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="javascript:;" type="button"
                                                                       class="btn btn-linkedin font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Submit
                                                                        for adding pages</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="youtube-add-accounts"
                                                             role="tabpanel" aria-labelledby="youtube-tab-accounts">
                                                            <p>To allow Socioboard access to your Youtube account, you
                                                                must first give authorization from the Youtube
                                                                website.</p>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="javascript:;" type="button"
                                                                   class="btn btn-youtube font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Connect
                                                                    your personal YouTube</a>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="pinterest-add-accounts"
                                                             role="tabpanel" aria-labelledby="pinterest-tab-accounts">
                                                            <p>Grant access to your profile to share updates and view
                                                                your feed.</p>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="javascript:;" type="button"
                                                                   class="btn btn-pinterest font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Pinterest Profile</a>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="tumblr-add-accounts"
                                                             role="tabpanel" aria-labelledby="tumblr-tab-accounts">
                                                            <p>Grant access to your profile to share updates and view
                                                                your feed.</p>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="javascript:;" type="button"
                                                                   class="btn btn-tumblr font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                                                    a Tumblr Profile</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end:Add Accounts Modal -->
                                @if(isset($ErrorMessage))
                                    <div style="color: red;text-align:center;">
                                        {{$ErrorMessage}}
                                    </div>
                                @else
                                    @if(isset($accounts) && $accounts['code'] === 200)
                                        <?php $count = 0; ?>
                                        @if(count($accounts['data'] [0][0]->SocialAccount)!==0)
                                            @foreach($accounts['data'] [0][0]->SocialAccount as $account)
                                                <?php if ($count == 5) break; ?>
                                            <!--begin::Item-->
                                                @if($account->join_table_teams_social_accounts->is_account_locked == true)
                                                    <div
                                                            class="d-flex align-items-center flex-wrap mb-5 mt-5  ribbon ribbon-clip ribbon-left">
                                                        <div class="ribbon-target" style="top: 12px;">
                                                            <span class="ribbon-inner bg-danger"></span> locked
                                                        </div>
                                                        @else
                                                            <div class="d-flex align-items-center flex-wrap mb-5 mt-5">
                                                            @endif
                                                            <!--begin::profile pic-->
                                                                <div class="symbol symbol-50 symbol-light mr-5">
                                                    <span class="symbol-label">
                                                        <img src="{{$account->profile_pic_url}}"
                                                             class="h-100 align-self-center" alt="avatar name"/>
                                                    </span>
                                                                </div>
                                                                <!--end::profile pic-->

                                                                <!--begin::Text-->
                                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                                    @if($account->join_table_teams_social_accounts->is_account_locked == true)
                                                                        <a
                                                                                class="font-weight-bold font-size-lg mb-1"
                                                                                disabled
                                                                        >{{$account->first_name}}{{$account->last_name}}  </a>
                                                                    @else
                                                                        <a href="{{$account->profile_url}}"
                                                                           target="_blank"
                                                                           class="font-weight-bold font-size-lg mb-1"
                                                                        >{{$account->first_name}}{{$account->last_name}}</a>
                                                                    @endif
                                                                    @if($account->account_type === 1 || $account->account_type === 2||$account->account_type === 3)
                                                                        <span
                                                                                class="text-muted font-weight-bold">Facebook</span>
                                                                    @elseif($account->account_type === 4 )
                                                                        <span
                                                                                class="text-muted font-weight-bold">Twitter</span>
                                                                    @elseif($account->account_type === 5 )
                                                                        <span
                                                                                class="text-muted font-weight-bold">Instagram</span>
                                                                    @elseif($account->account_type === 6 || $account->account_type === 7 )
                                                                        <span
                                                                                class="text-muted font-weight-bold">LinkedIN</span>
                                                                    @elseif($account->account_type === 9 )
                                                                        <span
                                                                                class="text-muted font-weight-bold">Youtube</span>
                                                                    @elseif($account->account_type === 8 || $account->account_type === 10 )
                                                                        <span
                                                                                class="text-muted font-weight-bold">Google</span>
                                                                    @else
                                                                        <span
                                                                                class="text-muted font-weight-bold">Pinterest</span>
                                                                    @endif
                                                                </div>
                                                                <!--end::Text-->

                                                                <span
                                                                        class="btn label label-xl label-inline my-lg-0 my-2 font-weight-bolder">connected</span>

                                                                <!--begin::Account Dropdown-->
                                                                <div class="dropdown dropdown-inline ml-2"
                                                                     data-toggle="tooltip"
                                                                     title="Quick actions" data-placement="left">
                                                                    <a href="javascript:;"
                                                                       class="btn btn-hover-light-primary btn-sm btn-icon"
                                                                       data-toggle="dropdown" aria-haspopup="true"
                                                                       aria-expanded="false">
                                                                        <i class="ki ki-bold-more-hor"></i>
                                                                    </a>
                                                                    <div
                                                                            class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                                                        <!--begin::Navigation-->
                                                                        <ul class="navi navi-hover">
                                                                            @if($account->join_table_teams_social_accounts->is_account_locked == true)
                                                                                <li class="navi-item">
                                                                                    <a href="javascript:;"
                                                                                       class="navi-link">
                                                                    <span class="navi-text">
                                                                        <span
                                                                                class="label label-xl label-inline label-primary"
                                                                                onclick="lock('{{$account->account_id}}',0 )"><i
                                                                                    class="fas fa-user-lock fa-fw text-white"></i>&nbsp; Un-Lock this account</span>
                                                                    </span>
                                                                                    </a>
                                                                                </li>
                                                                            @else
                                                                                <li class="navi-item">
                                                                                    <a href="javascript:;"
                                                                                       class="navi-link">
                                                                    <span class="navi-text">
                                                                        <span
                                                                                class="label label-xl label-inline label-primary"
                                                                                onclick="lock('{{$account->account_id}}',1 )"><i
                                                                                    class="fas fa-user-lock fa-fw text-white"></i>&nbsp; Lock this account</span>
                                                                    </span>
                                                                                    </a>
                                                                                </li>
                                                                            @endif
                                                                            <li class="navi-item">
                                                                                <a href="javascript:;" class="navi-link"
                                                                                   data-toggle="modal"
                                                                                   data-target="#accountDeleteModal">
                                                                    <span class="navi-text">
                                                                        <span
                                                                                class="label label-xl label-inline label-danger"><i
                                                                                    class="far fa-trash-alt fa-fw text-white"></i> Delete this account</span>
                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <!--end::Navigation-->
                                                                    </div>
                                                                </div>
                                                                <!--end::Account Dropdown-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <?php $count++; ?>
                                                            @endforeach
                                                            @else
                                                                <div style="color: Green;text-align:center;">
                                                                    Currently no Account has been added for this team
                                                                </div>
                                                            @endif
                                                            @elseif(isset($accounts) && $accounts['code'] === 400)
                                                                <div style="color: Red;text-align:center;">
                                                                    Can not get Accounts,please reload the page
                                                                </div>
                                                            @else
                                                                <div style="color: Red;text-align:center;">
                                                                    Can not get Accounts,please reload the page
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <!--end::Body-->
                            </div>
                            <!--end::Accounts-->
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--end::Dashboard-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
        <!--end::Content-->
        <!-- begin::Delete account modal-->
        <div class="modal fade" id="accountDeleteModal" tabindex="-1" role="dialog"
             aria-labelledby="accountDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountDeleteModalLabel">Delete Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="assets/media/svg/icons/Communication/Delete-user.svg"/><br>
                            <span
                                    class="font-weight-bolder font-size-h4 ">Are you sure wanna delete this account??</span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:;" type="button"
                               class="btn text-danger font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3"
                               data-dismiss="modal" id="account-delete">Delete it!!</a>
                            <a href="javascript:;" type="button"
                               class="btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3" data-dismiss="modal">No
                                thanks.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end::Delete account modal-->
        @endsection

        @section('scripts')

            <script>

                var optionsLine = {
                    chart: {
                        height: 328,
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 2,
                            blur: 4,
                            opacity: 1,
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    //colors: ["#3F51B5", '#2196F3'],
                    series: [{
                        name: "Scheduled",
                        data: [1, 15, 26, 20, 33, 27]
                    },
                        {
                            name: "Published",
                            data: [3, 33, 21, 42, 19, 32]
                        },
                        {
                            name: "Failed",
                            data: [0, 39, 52, 11, 29, 43]
                        }
                    ],
                    title: {
                        text: 'SocioBoard',
                        align: 'left',
                        offsetY: 25,
                        offsetX: 20
                    },
                    subtitle: {
                        text: 'Statistics',
                        offsetY: 55,
                        offsetX: 20
                    },
                    markers: {
                        size: 6,
                        strokeWidth: 0,
                        hover: {
                            size: 9
                        }
                    },
                    grid: {
                        show: true,
                        padding: {
                            bottom: 0
                        }
                    },
                    labels: ['01/15/2002', '01/16/2002', '01/17/2002', '01/18/2002', '01/19/2002', '01/20/2002'],
                    xaxis: {
                        tooltip: {
                            enabled: false
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        offsetY: -20
                    }
                }

                var chartLine = new ApexCharts(document.querySelector('#line-adwords'), optionsLine);
                chartLine.render();

                $(document).ready(function () {
                })

                function lock(id, type) {
                    var data = id;
                    if (type == 1) {
                        $.ajax({
                            url: '/lock-accounts/' + data,
                            type: 'GET',
                            processData: false,
                            cache: false,
                            success: function (response) {
                                if (response.code == 200) {
                                    toastr.success("Account Locked successfully!", "message", {
                                        timeOut: 1000,
                                        fadeOut: 1000,
                                        onHidden: function () {
                                            window.location.reload();
                                        }
                                    });

                                } else if (response.code == 400) {
                                    toastr.error(response.message, "Locking Error!");
                                } else if (response.code == 401) {
                                    toastr.error(response.message, "Locking failed!");
                                } else {
                                    toastr.error(response.message, "Lock error!");
                                }
                            },
                            error: function (error) {

                            }
                        })
                    } else if (type == 0) {
                        $.ajax({
                            url: '/unlock-accounts/' + data,
                            type: 'GET',
                            processData: false,
                            cache: false,
                            success: function (response) {
                                if (response.code == 200) {
                                    toastr.success(response.message, "Account Un-Locked successfully!", {
                                        timeOut: 1000,
                                        fadeOut: 1000,
                                        onHidden: function () {
                                            window.location.reload();
                                        }
                                    });
                                } else if (response.code == 400) {
                                    toastr.error(response.message, "Account Un-Locked successfully!");
                                } else if (response.code == 401) {
                                    toastr.error(response.message, "un-Locking failed!");
                                } else {
                                    toastr.error(response.message, "un-Locking failed!");
                                }
                            },
                            error: function (error) {

                            }
                        })
                    }
                }

            </script>

        @endsection

        @section('page-scripts')

            <script>
                // delete account
                $('#account-delete').click(function (event) {

                    toastr.error("Your account has been deleted!", "Deleted");
                });
            </script>

@endsection
