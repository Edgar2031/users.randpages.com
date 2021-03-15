"use strict";

// Class definition

var SBKanbanBoard = function() {
    var create_team = function() {
        let array=[];
        let data=[{name:"chanti"},{name:"harshad"}];
        array = data.map(element => {
            return {
                'title':  '<div class="d-flex align-items-center">'+
                    '<div class="symbol symbol-success mr-3">'+
                    '<img alt="Pic" src="/media/svg/avatars/001-boy.svg" />'+
                    '</div>'+
                    '<div class="d-flex flex-column align-items-start">'+
                    '<span class="text-dark-50 font-weight-bold mb-1">'+element.name+'</span>'+
                    '<span class="label label-inline label-light-success font-weight-bold">Info</span>'+
                    '</div>'+
                    '</div>'
            };
        });
        console.log('array',array);
        var kanban = new jKanban({
            element: '#create_team',
            gutter: '0',
            click: function(el) {
                alert(el.innerHTML);
            },
         //   dragEl           : function (el, source) { alert('true')},                     // callback when any board's item are dragged
            boards: [{
                    'id': '_memberslist',
                    'title': 'Profiles Available for Connection<br><small>Drag profile to add in your team</small>',
                    'class': 'light-dark',
                    'item':  array
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
                },
                {
                    'id': '_admin',
                    'title': 'Admin',
                    'class': 'light-success',
                    'item': [ {
                        'title': `
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-success mr-3">
                                    <span class="symbol-label font-size-h4">SB</span>
                                </div>
                                <div class="d-flex flex-column align-items-start">
                                    <span class="text-dark-50 font-weight-bold mb-1">Admin Member Name</span>
                                    <span class="label label-inline label-light-warning font-weight-bold">Admin</span>
                                </div>
                            </div>
                        `,
                    }
                    ]
                },
                {
                    'id': '_done',
                    'title': 'New Team Members',
                    'class': 'light-success',
                    'item': [ 
                    ]
                }
            ],
            dragBoards       : true,
            dropEl           : function (el, target, source, sibling) {
                console.log('e',target);
                console.log('tagret',target);
                console.log('source',source);
                console.log('sibling',sibling);
            },
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
            kanban.removeBoard('_done');
        });
    }

    // Public functions
    return {
        init: function() {
            create_team();
        }
    };
}();

jQuery(document).ready(function() {
    SBKanbanBoard.init();
});
