import './bootstrap'
import jQuery from 'jquery'
window.$ = jQuery

const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
const ADD_TASK = 'ADD_TASK'
const TOGGLE_TASK = 'TOGGLE_TASK'
const DELETE_TASK = 'DELETE_TASK'

$('div').on('click', '.checkbox', function (e) 
{  
    e.stopPropagation()
    e.stopImmediatePropagation()
    
    let card = $(this).parents('.todo-card')
    let status = card.data('status')

    ajax(
        {
            'func': TOGGLE_TASK,
            'id': card.data('id'),
            'status': status 
        },
        function()
        {
            togglePending(card, status, status === 'done' ? 'pending' : 'done')
        }
    )
})

function togglePending(card, status, newStatus) 
{  
    card.removeClass(status)
    card.addClass(newStatus)
    card.data('status', newStatus)
}

$('div').on('click', '.delete-btn', function (e) 
{  
    e.stopPropagation()
    e.stopImmediatePropagation()

    let card = $(this).parents('.todo-card')

    ajax(
        {
            'func': DELETE_TASK,
            'id': card.data('id'),
        },
        function()
        {
            card.animate({
                opacity: '0',
                transform: 'translateX(100px)'
            }, { 
                step: function() 
                {
                    card.css('opacity','0') 
                    card.css('-webkit-transform','translateX(100px)') 
                },
                duration: 600, 
                easing: 'linear', 
                complete: function () 
                { 
                    card.remove()
                } 
            }) 
        }
    )
})

$('.new-todo-form').on('submit', function (e) 
{
    e.preventDefault()

    ajax(
        {
            'func': ADD_TASK,
            'new_todo': $('.todo-input').val(),
        },
        function(response)
        {
            $('.todo-wrapper').append(response)
            $('.todo-input').val('')
        }
    )
})

function ajax(data, onSuccess)
{
    $.ajax({
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
        url: '/',
        method: 'POST',
        data: data,
        success: onSuccess,
        error: function (error) 
        {  
            console.error(error)
        }
    })
}