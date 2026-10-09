//
document.querySelectorAll('.menu-item').forEach(element => {
    element.addEventListener('click', () => {
        document.querySelectorAll('.menu-item').forEach(element2 => {
            element2.classList.remove('active');
        });
        element.classList.add('active');
    });
});

const load_active_shift = function() {
    $.get( "/api/shift_active", function( data ) {
        let shifts_name = '';
        for(var i = 0; i < data.length; i++) {
            if(shifts_name.length > 0) {
                shifts_name += ' | ';
            }
            shifts_name += '<span class="badge hm-badge-color-oak">' + data[i].name + '</span>';
        }
        $('#active_shifts').html(shifts_name);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    load_active_shift();
    var intervalID = setInterval(load_active_shift, 5000);
});
