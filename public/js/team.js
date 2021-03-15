"use strict";

// Class definition

var SBKanbanBoard = function() {
    var sb_teams = function() {
        var kanban = new jKanban({
            element: '#Sb_teams',
            gutter: '0',
            click: function(el) {
                alert(el.innerHTML);
            },
            boards: [{
                    'id': '_admin',
                    'title': 'Admin',
                    'class': 'light-success',
                    'item': [ {
                        'title': `
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-success mr-3">
                                    <img alt="Pic" src="/media/svg/avatars/001-boy.svg" />
                                </div>
                                <div class="d-flex flex-column align-items-start">
                                    <span class="text-dark-50 font-weight-bold mb-1">Member admin name</span>
                                    <span class="label label-inline label-light-success font-weight-bold">Admin</span>
                                </div>
                            </div>
                        `,
                    }]
                },
                {
                    'id': '_memberslist',
                    'title': 'Profiles Available for Connection<br><small>Drag profile to add in your team</small>',
                    'class': 'light-dark',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                        	            <img alt="Pic" src="/media/svg/avatars/001-boy.svg" />
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">person one</span>
                        	            <span class="label label-inline label-light-success font-weight-bold">Instagram</span>
                        	        </div>
                        	    </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-success mr-3">
                                        <img alt="Pic" src="/media/svg/avatars/001-boy.svg" />
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span class="text-dark-50 font-weight-bold mb-1">person two</span>
                                        <span class="label label-inline label-light-success font-weight-bold">Facebook</span>
                                    </div>
                                </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-success mr-3">
                                        <img alt="Pic" src="/media/svg/avatars/001-boy.svg" />
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span class="text-dark-50 font-weight-bold mb-1">person 3</span>
                                        <span class="label label-inline label-light-success font-weight-bold">Facebook</span>
                                    </div>
                                </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-success mr-3">
                                        <img alt="Pic" src="/media/svg/avatars/001-boy.svg" />
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span class="text-dark-50 font-weight-bold mb-1">person 4</span>
                                        <span class="label label-inline label-light-success font-weight-bold">Google</span>
                                    </div>
                                </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-success mr-3">
                                        <img alt="Pic" src="/media/svg/avatars/001-boy.svg" />
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span class="text-dark-50 font-weight-bold mb-1">person 5</span>
                                        <span class="label label-inline label-light-success font-weight-bold">Twitter</span>
                                    </div>
                                </div>
                            `,
                        }
                    ]
                },
                {
                    'id': '_invited',
                    'title': 'Invited Members',
                    'class': 'light-info',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                                        <span class="symbol-label font-size-h4">SB</span>
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">Member y</span>
                        	            <span class="label label-inline label-light-dark font-weight-bold">Done</span>
                        	        </div>
                        	    </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                                        <span class="symbol-label font-size-h4">SB</span>
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">Member x</span>
                        	            <span class="label label-inline label-light-warning font-weight-bold">Due</span>
                        	        </div>
                        	    </div>
                            `,
                        }
                    ]
                }
            ]
        });

        var toDoButton = document.getElementById('inviteMembers');
        toDoButton.addEventListener('click', function() {
            kanban.addElement(
                '_invited', {
                    'title': `
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-light-primary mr-3">
                                <span class="symbol-label font-size-h4">SB</span>
                            </div>
                            <div class="d-flex flex-column align-items-start">
                                <span class="text-dark-50 font-weight-bold mb-1">Chanchal</span>
                                <span class="label label-inline label-light-warning font-weight-bold">In progress</span>
                            </div>
                        </div>
                    `
                }
            );
        });

        var addBoardDefault = document.getElementById('addDefault');
        addBoardDefault.addEventListener('click', function() {
            kanban.addBoards(
                [{
                    'id': '_default',
                    'title': 'New Board',
                    'class': 'primary-light',
                    'item': [ 
                    ]
                }]
            )
        });

        var removeBoard = document.getElementById('removeBoard');
        removeBoard.addEventListener('click', function() {
            kanban.removeBoard('_admin');
        });
    }

    // Public functions
    return {
        init: function() {
            sb_teams();
        }
    };
}();

jQuery(document).ready(function() {
    SBKanbanBoard.init();
});
