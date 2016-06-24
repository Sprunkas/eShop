$(document).on('keyup change', '.quantity, .price', function() {
    var row = $(this).closest('tr').get(0);
    var rowPrice = $(row).find('.price').val();
    var rowQuantity = $(row).find('.quantity').val();

    $(row).find('.sum').val((rowPrice * rowQuantity).toFixed(2));

    var sum = 0;

    $('.sum').each(function() {
        sum += parseFloat($(this).val());
    });

    $('#total').val((sum).toFixed(2));

});

$(document).on('click', '#add', function() {
    $('tbody:last-child').append('<tr><td style="vertical-align: middle;"><span class="glyphicon glyphicon-menu-up"></span><br><span class="glyphicon glyphicon-menu-down"></span></td><td style="vertical-align: middle;"><div class="form-group"><label for="item"></label><input type="text" class="form-control" id="item" name="item[]" placeholder="Prekė"></div></td><td style="vertical-align: middle;"><div class="form-group"><label for="quantity"></label><input type="text" class="form-control quantity" name="quantity[]" placeholder="Kiekis"></div></td><td style="vertical-align: middle;"><div class="form-group"><label for="price"></label><input type="text" class="form-control price" name="price[]" placeholder="Kaina"></div></td><td style="vertical-align: middle;"><div class="form-group"><label for="sum"></label><input type="text" class="form-control sum" name="sum[]" placeholder="Suma" readonly></div></td><td style="vertical-align: middle;"><a href="#"><span class="glyphicon glyphicon-remove" style="color: red;"></span></a></td></tr>');
});

$(document).on('click', '.glyphicon-remove', function() {
    $(this).closest('tr').fadeOut(500, function() {
        $(this).remove();
    });
});

$(document).on('click', '.glyphicon-menu-up', function() {
    $('tbody tr td .glyphicon-menu-up').on('click', function() {
        var $row = $(this).closest('tr')
        $row.insertBefore($row.prev());
    });
});

$(document).on('click', '.glyphicon-menu-down', function() {
    $('tbody tr td .glyphicon-menu-down').on('click', function() {
        var $row = $(this).closest('tr')
        $row.insertAfter($row.next());
    });
});