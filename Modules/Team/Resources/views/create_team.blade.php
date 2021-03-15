@extends('home::layouts.UserLayout')
@section('title')
    <title>{{env('WEBSITE_TITLE')}} - Teams</title>
@endsection
@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="/plugins/custom/kanban/kanban.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors Styles-->
@endsection
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="Sb_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->

            <div class="container-fluid ">
                <!--begin::Team-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Create Team
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Invite-->
                            <a href="javascript:;" class="btn btn-light-primary font-weight-bold ml-2"
                               data-toggle="modal" data-target="#teamInviteModal">Invite</a>
                            <!--end::Invite-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="create_team"></div>

                        <div class="mt-4">
                            <button class="btn font-weight-bold btn-light-primary mr-5" data-toggle="modal"
                                    data-target="#teamCreateModal">Add "Default" board
                            </button>
                            <button class="btn font-weight-bold btn-light-danger mr-5" id="inviteMembers">Invite
                                members
                            </button>
                            <button class="btn font-weight-bold btn-light-success" id="removeBoard">Remove "New team"
                                Board
                            </button>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
                <!--end::Team-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

    <!-- begin::Create team modal-->
    <div class="modal fade" id="teamCreateModal" tabindex="-1" role="dialog" aria-labelledby="teamDCreateModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="teamCreateModalLabel">Create team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="input-icon">
                            <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6"
                                   type="text" name="" placeholder="Team Name"/>
                            <span><i class="fas fa-users"></i></span>
                        </div>
                    </div>
                    <!--end::Form group-->
                    <div class="image-input image-input-empty image-input-outline" id="Sb_team_pic"
                         style="background-image: url(/media/logos/sb-icon.svg)">
                        <div class="image-input-wrapper"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                               data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="profile_avatar_remove"/>
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="remove" data-toggle="tooltip" title="Remove avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" type="button"
                           class="btn text-warning font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3">Create</a>
                        <a href="javascript:;" type="button"
                           class="btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3"
                           data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end::Delete account modal-->



    <!-- begin::Invite team modal-->
    <div class="modal fade" id="teamInviteModal" tabindex="-1" role="dialog" aria-labelledby="teamDInviteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="teamInviteModalLabel">Invite team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::User name-->
                    <div class="form-group">
                        <div class="input-icon">
                            <input class="form-control form-control-solid h-auto py-4 rounded-lg font-size-h6"
                                   type="text" name="" placeholder="Member Name"/>
                            <span><i class="fas fa-users"></i></span>
                        </div>
                    </div>
                    <!--end::User name-->
                    <!--begin::User email-->
                    <div class="form-group">
                        <div class="input-icon">
                            <input class="form-control form-control-solid h-auto py-4 rounded-lg font-size-h6"
                                   type="email" name="" placeholder="Member Emailid"/>
                            <span><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>
                    <!--end::User email-->
                    <!--begin::User permission-->
                    <div class="form-group">
                        <select class="form-control form-control-solid form-control-lg h-auto py-4 rounded-lg font-size-h6">
                            <option selected disabled>Select permission</option>
                            <option value="A">Approval required</option>
                            <option value="F">Full permission</option>
                        </select>
                    </div>
                    <!--end::User permission-->

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" type="button"
                           class="btn text-warning font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3"
                           data-dismiss="modal">Invite</a>
                        <a href="javascript:;" type="button"
                           class="btn font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3"
                           data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end::Delete account modal-->
@endsection

@section('scripts')
    <!--begin::Page Scripts(used by this page)-->
    <script src="/plugins/custom/kanban/kanban.bundle.js"></script>
    <script src="/js/create_team.js"></script>
    <!--end::Page Scripts-->
@endsection