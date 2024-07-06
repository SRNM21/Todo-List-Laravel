import './bootstrap'
import jQuery from 'jquery'
window.$ = jQuery

const TOGGLE_TASK = 'TOGGLE_TASK'
const DELETE_TASK = 'DELETE_TASK'

$('div').on('click', '.checkbox', function (e) 
{  
    e.stopPropagation()
    e.stopImmediatePropagation()
    
    let card = $(this).parents('.todo-card')

    let id = card.data('id')
    let status = card.data('status')

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/',
        method: 'POST',
        data: {
            'func': TOGGLE_TASK,
            'id': id,
            'status': status 
        },
        success: function()
        {
            togglePending(card, status, status === 'done' ? 'pending' : 'done')
        },
        error: function (error) 
        {  
            console.error(error)
        }
    })
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

    let id = card.data('id')

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/',
        method: 'POST',
        data: {
            'func': DELETE_TASK,
            'id': id,
        },
        success: function()
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
        },
        error: function (error) 
        {  
            console.error(error)
        }
    })
})

$('.new-todo-form').on('submit', function (e) 
{
    e.preventDefault()

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/add-todo',
        method: 'POST',
        data: {
            'new_todo': $('.todo-input').val(),
        },
        success: function(response)
        {
            $('.todo-wrapper').append(response)
            $('.todo-input').val('')
        },
        error: function (error) 
        {  
            console.error(error)
        }
    })
})