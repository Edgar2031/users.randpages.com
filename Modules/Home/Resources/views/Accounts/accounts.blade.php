@extends('home::layouts.UserLayout')
@section('title')
    <title>{{env('WEBSITE_TITLE')}} - Accounts</title>
@endsection
@section('content')

    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="Sb_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Accounts-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-12">
                        <!--begin::Accounts-->
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title font-weight-bolder">Accounts</h3>
                                <div class="card-toolbar">
                                    <a href="javascript:;" class="btn btn-sm font-weight-bold" data-toggle="modal" data-target="#addAccountsModal">
                                        <i class="fas fa-plus fa-fw"></i> Add Accounts
                                    </a>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body pt-2 position-relative overflow-hidden">
                                <div class="row d-flex justify-content-center">
                                    <div
                                        class="col-md-1 col-sm-12 card bg-facebook border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                         <i class="fab fa-facebook-f fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                    <div
                                        class="col-md-1 col-sm-12 card bg-twitter border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="fab fa-twitter fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                    <div
                                        class="col-md-1 col-sm-12 card bg-instagram border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="fab fa-instagram fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                    <div
                                        class="col-md-1 col-sm-12 card bg-linkedin border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="fab fa-linkedin fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                    <div
                                        class="col-md-1 col-sm-12 card bg-youtube border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="fab fa-youtube fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                    <div
                                        class="col-md-1 col-sm-12 card bg-pinterest border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="fab fa-pinterest fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                    <div
                                        class="col-md-1 col-sm-12 card bg-tumblr border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="fab fa-tumblr fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                    <div
                                        class="col-md-1 col-sm-12 card bg-google border-0 px-6 py-8 rounded-xl mr-4 mb-7">
                                                    <span class="svg-icon svg-icon-3x d-block my-2">
                                                            <i class="fab fa-google fa-2x"></i>
                                                        <b class="font-weight-bold font-size-h2 float-right">00</b>
                                                    </span>
                                    </div>
                                </div>

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Accounts-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-icon">
                                <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6"
                                       type="text" name="username" autocomplete="off" placeholder="User Name"/>
                                <span><i class="far fa-user"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn font-weight-bolder font-size-h6 px-8 py-4 my-3">Search</button>
                    </div>
                </div>
                <div class="row">


                    @if(isset($ErrorMessage))
                        <div style="color: red;text-align:center;">
                            {{$ErrorMessage}}
                        </div>
                    @else
                        @if(isset($accounts))
                            @if(isset($accounts->data) && count($accounts->data) > 0)
                                @if($accounts->code  === 200 )
                                    @if(count($accounts->data[0][0]->SocialAccount)!==0)
                                        @foreach($accounts->data[0][0]->SocialAccount as $account)
                                            <div class="col-xl-3">
                                                <div class="card card-custom gutter-b card-stretch">
                                                    <div
                                                        class="card-body pt-2 position-relative overflow-hidden rounded  ribbon ribbon-top ribbon-ver">
                                                        @if($account->account_type === 1 || $account->account_type === 2 || $account->account_type === 3)
                                                            <div class="ribbon-target bg-facebook"
                                                                 style="top: -2px; right: 20px;">
                                                                <i class="fab fa-facebook-f"></i>
                                                            </div>
                                                        @elseif($account->account_type == 4)
                                                            <div class="ribbon-target" style="top: -2px; right: 20px;">
                                                                <i class="fab fa-twitter"></i>
                                                            </div>
                                                        @elseif($account->account_type == 5)
                                                            <div class="ribbon-target bg-instagram"
                                                                 style="top: -2px; right: 20px;">
                                                                <i class="fab fa-instagram"></i>
                                                                @elseif($account->account_type == 6 || $account->account_type === 7 )
                                                                    <div class="ribbon-target bg-linkedin"
                                                                         style="top: -2px; right: 20px;">
                                                                        <i class="fab fa-linkedin"></i>
                                                                    </div>
                                                            @endif
                                                            <!--begin::User-->
                                                                <div
                                                                    class="d-flex align-items-center  ribbon ribbon-clip ribbon-left">
                                                                    @if($account->join_table_teams_social_accounts->is_account_locked == true)
                                                                        <div class="ribbon-target" style="top: 12px;"
                                                                             onclick="lock('{{$account->account_id}}',0 )">
                                                                            <span class="ribbon-inner bg-danger"></span>
                                                                            <i
                                                                                class="fas fa-user-lock fa-fw mr-2 text-white"></i>
                                                                            Lock
                                                                        </div>
                                                                    @else
                                                                        <div class="ribbon-target" style="top: 80px;"
                                                                             onclick="lock('{{$account->account_id}}',1 )">
                                                                            <span class="ribbon-inner bg-info"></span>
                                                                            <i
                                                                                class="fas fa-lock-open fa-fw mr-2 text-white"></i>
                                                                            Un-Lock
                                                                        </div>
                                                                    @endif
                                                                    <div
                                                                        class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                                                        <div class="symbol-label"
                                                                             style="background-image:url({{$account->profile_pic_url}})"></div>
                                                                        <i class="symbol-badge bg-success"></i>
                                                                    </div>
                                                                    <div>
                                                                        <a href="{{$account->profile_url}}"
                                                                           target="_blank">
                                                                            {{$account->first_name}} {{$account->last_name}}
                                                                            <i
                                                                                class="flaticon2-correct text-primary icon-md ml-2"></i>
                                                                        </a>
                                                                        <div class="text-muted">
                                                                            @chanchalsantraofficial
                                                                        </div>
                                                                        <!-- begin:account star rating -->
                                                                        <div class="rating-css">
                                                                            <div class="star-icon">
                                                                                <input type="radio"
                                                                                       <?php if ($account->rating == 1) echo "checked";?> name="rating1{{$account->account_id}}"
                                                                                       id="rating1{{$account->account_id}}}"
                                                                                       onclick="ratingUpdate('1', '{{$account->account_id}}}');">
                                                                                <label
                                                                                    for="rating1{{$account->account_id}}"
                                                                                    class="fas fa-star"></label>
                                                                                <input type="radio"
                                                                                       <?php if ($account->rating == 2) echo "checked";?> name="rating1{{$account->account_id}}"
                                                                                       id="rating2{{$account->account_id}}}"
                                                                                       onclick="ratingUpdate('2', '{{$account->account_id}}');">
                                                                                <label
                                                                                    for="rating2{{$account->account_id}}"
                                                                                    class="fas fa-star"></label>
                                                                                <input type="radio"
                                                                                       <?php if ($account->rating == 3) echo "checked";?> name="rating1{{$account->account_id}}"
                                                                                       id="rating3{{$account->account_id}}"
                                                                                       onclick="ratingUpdate('3', '{{$account->account_id}}');">
                                                                                <label
                                                                                    for="rating3{{$account->account_id}}"
                                                                                    class="fas fa-star"></label>
                                                                                <input type="radio"
                                                                                       <?php if ($account->rating == 4) echo "checked";?> name="rating1{{$account->account_id}}"
                                                                                       id="rating4{{$account->account_id}}"
                                                                                       onclick="ratingUpdate('4', '{{$account->account_id}}');">
                                                                                <label
                                                                                    for="rating4{{$account->account_id}}"
                                                                                    class="fas fa-star"></label>
                                                                                <input type="radio"
                                                                                       <?php if ($account->rating == 5) echo "checked";?> name="rating1{{$account->account_id}}"
                                                                                       id="rating5{{$account->account_id}}"
                                                                                       onclick="ratingUpdate('5', '{{$account->account_id}}');">
                                                                                <label
                                                                                    for="rating5{{$account->account_id}}"
                                                                                    class="fas fa-star"></label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end:account star rating -->

                                                                        <div class="mt-2">
                                                                            <a href="{{$account->profile_url}}"
                                                                               class="btn btn-sm font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Profile</a>
                                                                            <a href="#"
                                                                               class="btn btn-sm font-weight-bold py-2 px-3 px-xxl-5 my-1">Chat</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::User-->

                                                                <!--begin::Contact-->
                                                                <div class="py-9">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mb-2">
                                                                    <span
                                                                        class="font-weight-bold mr-2">Following:</span>
                                                                        <a href="#" class=" text-hover-primary">9k</a>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mb-2">
                                                                    <span
                                                                        class="font-weight-bold mr-2">Followers:</span>
                                                                        <span class="">99</span>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <span
                                                                            class="font-weight-bold mr-2">Feeds:</span>
                                                                        <span class="">0</span>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                    <span
                                                                        class="font-weight-bold mr-2">Cron update:</span>
                                                                        <span class="switch switch-sm switch-icon"
                                                                              id="cronModify{{$account->account_id}}">
                                                        <label>
                                                          <input type="checkbox" id="cronUpdate{{$account->account_id}}"
                                                                 <?php if ($account->refresh_feeds == 2) echo "checked" ?> name="select"
                                                                 onclick="cronUpdate({{$account->account_id}}, {{$account->refresh_feeds}});">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                                    </div>
                                                                </div>
                                                                <!--end::Contact-->
                                                                <!-- begin:Delete button -->
                                                                <div>
                                                                    <a href="#"
                                                                       class="btn text-danger font-weight-bolder font-size-h6 px-8 py-4 my-3 col-12">Delete
                                                                        account</a>
                                                                </div>
                                                                <!-- end:Delete button -->

                                                            </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                    <div style="color: Green;text-align:center;">
                                                        Currently no Account has been added for this team
                                                    </div>
                                                @endif
                                                @elseif($accounts->code  === 400 )
                                                    <div style="color: Red;text-align:center;">
                                                        Can not get Accounts,please reload the page
                                                    </div>
                                                @endif
                                                @else
                                                    <div style="color: Red;text-align:center;">
                                                        Can not get Accounts,please reload the page
                                                    </div>
                                                @endif
                                                @endif
                                            </div>
                                        @endif
                                        <!--end::Row-->
                                            <!--end::Accounts-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
        <!--end::Content-->
        <!-- begin:Add Accounts Modal-->
        <div class="modal fade" id="addAccountsModal" tabindex="-1" role="dialog"
             aria-labelledby="addAccountsModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAccountsModalLabel">Add Accounts</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <ul class="nav justify-content-center nav-pills" id="AddAccountsTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="facebook-tab-accounts" data-toggle="tab"
                                       href="#facebook-add-accounts">
                                        <span class="nav-text"><i class="fab fa-facebook fa-2x"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="twitter-tab-accounts" data-toggle="tab"
                                       href="#twitter-add-accounts" aria-controls="twitter">
                                        <span class="nav-text"><i class="fab fa-twitter fa-2x"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="instagram-tab-accounts" data-toggle="tab"
                                       href="#instagram-add-accounts" aria-controls="instagram">
                                        <span class="nav-text"><i class="fab fa-instagram fa-2x"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="linkedin-tab-accounts" data-toggle="tab"
                                       href="#linkedin-add-accounts" aria-controls="linkedin">
                                        <span class="nav-text"><i class="fab fa-linkedin fa-2x"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="youtube-tab-accounts" data-toggle="tab"
                                       href="#youtube-add-accounts" aria-controls="youtube">
                                        <span class="nav-text"><i class="fab fa-youtube fa-2x"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pinterest-tab-accounts" data-toggle="tab"
                                       href="#pinterest-add-accounts" aria-controls="pinterest">
                                        <span class="nav-text"><i class="fab fa-pinterest fa-2x"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tumblr-tab-accounts" data-toggle="tab"
                                       href="#tumblr-add-accounts" aria-controls="tumblr">
                                        <span class="nav-text"><i class="fab fa-tumblr fa-2x"></i></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5" id="AddAccountsTabContent">
                                <div class="tab-pane fade show active" id="facebook-add-accounts" role="tabpanel"
                                     aria-labelledby="facebook-tab-accounts">
                                    <p>Socioboard needs permission to access and publish content to Facebook on your
                                        behalf.
                                        To grant permission, you must be an admin for your brand’s Facebook page.</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:;" type="button"
                                           class="btn btn-facebook font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a Facebook Profile</a>
                                        <a href="javascript:;" type="button"
                                           class="btn btn-facebook fb_page_btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a Facebook FanPage</a>
                                    </div>
                                    <div class="mt-3 fb_page_div">
                                        <span>Choose Facebook pages for posting</span>
                                        <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true"
                                             style="height: 200px; overflow-y: scroll;">
                                            <!--begin::Page-->
                                            <div class="d-flex align-items-center flex-grow-1">
                                                <!--begin::Facebook Fanpage Profile picture-->
                                                <div class="symbol symbol-45 symbol-light mr-5">
                                                <span class="symbol-label">
                                                    <img src="assets/media/svg/misc/006-plurk.svg"
                                                         class="h-50 align-self-center" alt=""/>
                                                </span>
                                                </div>
                                                <!--end::Facebook Fanpage Profile picture-->
                                                <!--begin::Section-->
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                        <!--begin::Title-->
                                                        <a href="javascript:;"
                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                            Facebook FanPage Name
                                                        </a>
                                                        <!--end::Title-->

                                                        <!--begin::Data-->
                                                        <span class="text-muted font-weight-bold">
                                                        2M followers
                                                    </span>
                                                        <!--end::Data-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Checkbox-->
                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
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
                                                    <img src="assets/media/svg/misc/006-plurk.svg"
                                                         class="h-50 align-self-center" alt=""/>
                                                </span>
                                                </div>
                                                <!--end::Facebook Fanpage Profile picture-->
                                                <!--begin::Section-->
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                        <!--begin::Title-->
                                                        <a href="javascript:;"
                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                            Facebook FanPage Name
                                                        </a>
                                                        <!--end::Title-->

                                                        <!--begin::Data-->
                                                        <span class="text-muted font-weight-bold">
                                                        2M followers
                                                    </span>
                                                        <!--end::Data-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Checkbox-->
                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
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
                                                    <img src="assets/media/svg/misc/006-plurk.svg"
                                                         class="h-50 align-self-center" alt=""/>
                                                </span>
                                                </div>
                                                <!--end::Facebook Fanpage Profile picture-->
                                                <!--begin::Section-->
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                        <!--begin::Title-->
                                                        <a href="javascript:;"
                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                            Facebook FanPage Name
                                                        </a>
                                                        <!--end::Title-->

                                                        <!--begin::Data-->
                                                        <span class="text-muted font-weight-bold">
                                                        2M followers
                                                    </span>
                                                        <!--end::Data-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Checkbox-->
                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
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
                                                    <img src="assets/media/svg/misc/006-plurk.svg"
                                                         class="h-50 align-self-center" alt=""/>
                                                </span>
                                                </div>
                                                <!--end::Facebook Fanpage Profile picture-->
                                                <!--begin::Section-->
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                        <!--begin::Title-->
                                                        <a href="javascript:;"
                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                            Facebook FanPage Name
                                                        </a>
                                                        <!--end::Title-->

                                                        <!--begin::Data-->
                                                        <span class="text-muted font-weight-bold">
                                                        2M followers
                                                    </span>
                                                        <!--end::Data-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Checkbox-->
                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
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
                                                    <img src="assets/media/svg/misc/006-plurk.svg"
                                                         class="h-50 align-self-center" alt=""/>
                                                </span>
                                                </div>
                                                <!--end::Facebook Fanpage Profile picture-->
                                                <!--begin::Section-->
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                        <!--begin::Title-->
                                                        <a href="javascript:;"
                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                            Facebook FanPage Name
                                                        </a>
                                                        <!--end::Title-->

                                                        <!--begin::Data-->
                                                        <span class="text-muted font-weight-bold">
                                                        2M followers
                                                    </span>
                                                        <!--end::Data-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Checkbox-->
                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
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
                                <div class="tab-pane fade" id="twitter-add-accounts" role="tabpanel"
                                     aria-labelledby="twitter-tab-accounts">
                                    <p>Please make sure you are logged in with the proper account when you authorize
                                        Socioboard.</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:;" type="button"
                                           class="btn btn-twitter font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a
                                            Twitter Profile</a>
                                    </div>
                                    <label class="checkbox mb-0 pt-5">
                                        <input type="checkbox" name="sb-twt" checked/>
                                        <span class="mr-2"></span>
                                        Follow Socioboard on twitter for update & announcements
                                    </label>
                                </div>
                                <div class="tab-pane fade" id="instagram-add-accounts" role="tabpanel"
                                     aria-labelledby="instagram-tab-accounts">
                                    <p>To allow Socioboard access to your Instagram account, you must first give
                                        authorization from the Instagram website.</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:;" type="button"
                                           class="btn btn-instagram font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a Instagram Profile</a>
                                        <a href="javascript:;" type="button"
                                           class="btn btn-instagram font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a Business Account</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="linkedin-add-accounts" role="tabpanel"
                                     aria-labelledby="linkedin-tab-accounts">
                                    <p>Grant access to your profile to share updates and view your feed.</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:;" type="button"
                                           class="btn btn-linkedin font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a LinkedIn Profile</a>
                                        <a href="javascript:;" type="button"
                                           class="btn btn-linkedin linkedin_page_btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a Company Profile</a>
                                    </div>

                                    <div class="mt-3 linkedin_page_div">
                                        <span>Choose LinkedIn Company Pages for posting</span>
                                        <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true"
                                             style="height: 200px; overflow-y: scroll;">
                                            <!--begin::Page-->
                                            <div class="d-flex align-items-center flex-grow-1">
                                                <!--begin::Linkedin Company Profile picture-->
                                                <div class="symbol symbol-45 symbol-light mr-5">
                                                <span class="symbol-label">
                                                    <img src="assets/media/svg/misc/006-plurk.svg"
                                                         class="h-50 align-self-center" alt=""/>
                                                </span>
                                                </div>
                                                <!--end::Linkedin Company Profile picture-->
                                                <!--begin::Section-->
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                        <!--begin::Title-->
                                                        <a href="javascript:;"
                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                            Linkedin Company Page Name
                                                        </a>
                                                        <!--end::Title-->

                                                        <!--begin::Data-->
                                                        <span class="text-muted font-weight-bold">
                                                        2M followers
                                                    </span>
                                                        <!--end::Data-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Checkbox-->
                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
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
                                                    <img src="assets/media/svg/misc/006-plurk.svg"
                                                         class="h-50 align-self-center" alt=""/>
                                                </span>
                                                </div>
                                                <!--end::Linkedin Company Profile picture-->
                                                <!--begin::Section-->
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                    <!--begin::Info-->
                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                        <!--begin::Title-->
                                                        <a href="javascript:;"
                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                            Linkedin Company Page Name
                                                        </a>
                                                        <!--end::Title-->

                                                        <!--begin::Data-->
                                                        <span class="text-muted font-weight-bold">
                                                        2M followers
                                                    </span>
                                                        <!--end::Data-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Checkbox-->
                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
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
                                <div class="tab-pane fade" id="youtube-add-accounts" role="tabpanel"
                                     aria-labelledby="youtube-tab-accounts">
                                    <p>To allow Socioboard access to your Youtube account, you must first give
                                        authorization
                                        from the Youtube website.</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:;" type="button"
                                           class="btn btn-youtube font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Connect
                                            your personal YouTube</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pinterest-add-accounts" role="tabpanel"
                                     aria-labelledby="pinterest-tab-accounts">
                                    <p>Grant access to your profile to share updates and view your feed.</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:;" type="button"
                                           class="btn btn-pinterest font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a Pinterest Profile</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tumblr-add-accounts" role="tabpanel"
                                     aria-labelledby="tumblr-tab-accounts">
                                    <p>Grant access to your profile to share updates and view your feed.</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:;" type="button"
                                           class="btn btn-tumblr font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Add
                                            a
                                            Tumblr Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:Add Accounts Modal -->
@endsection


        @section('scripts')
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <!-- facebook , linkedin pages toggle -->
            <script src="../js/accounts.js"></script>
            <script>

                // fb page list div open
                $(".fb_page_div").css({
                    display: "none"
                });
                $(".fb_page_btn").click(function () {
                    $(".fb_page_div").css({
                        display: "block"
                    });
                });


                // linkedin page list div open
                $(".linkedin_page_div").css({
                    display: "none"
                });
                $(".linkedin_page_btn").click(function () {
                    $(".linkedin_page_div").css({
                        display: "block"
                    });
                });

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
                                    toastr.error("Account Locked successfully!", "message", {
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
                                    toastr.error(response.message, "Account un-Locked successfully!", {
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
