
$(function () {
    $('.datetimepicker').datetimepicker({
        // inline: true,
        // sideBySide: true,
        format: 'DD/MM/YYYY, HH:mm',
        userCurrent: false,
        locale: 'pt-br',
        icons: {
            time: 'fas fa-clock fa-2x',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-arrow-circle-left',
                next: 'fas fa-arrow-circle-right',
                today: 'far fa-calendar-check-o',
                clear: 'fas fa-trash',
                close: 'far fa-times'
        }
    });
});

