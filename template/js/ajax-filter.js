$(document).ready(function () {

    var ajaxSort = function ( inputOption ) {

        var defaultOpt = {
            manufacturer: "ALL",
            sort: "DESC",
            min_price: '10',
            max_price: '9999'
        };

        var option = $.extend({}, defaultOpt, inputOption);

        $.post( "../../filter.php", option, function( data ) {

            var prods = JSON.parse(data),
                container = $('.reload-items');
            container.empty();
            $('#loader').show();
            setTimeout(function () {
                for(var k in prods) {
                    var str = '<div class="col-sm-4">' +
                        '<div class="product-image-wrapper">' +
                        '<div class="single-products">' +
                        '<div class="productinfo text-center">' +
                        '<img src="/upload/images/products/' + prods[k].id + '.jpg">' +
                        '<h2>$' + prods[k].price + '</h2>' +
                        '<p>'+
                        '<a href="/product/' + prods[k].id + '">' + prods[k].name + '</a>'+
                        '</p>'+
                        '<a href="/cart/add/' + prods[k].id + '" class="btn btn-default add-to-cart" data-id="' + prods[k].id + '">'+
                        '<i class="fa fa-shopping-cart"></i>В корзину'+
                        '</a>'+
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    container.append(str);
                    $('#loader').hide();
                }
            }, 1000);
        });
    };

    var sort = function () {
        var sort = $('[name="sort_price"]:checked').val();
        var manufacturer = $('#manufacturer option:selected').val();
        var max_price = $('#max_price').val();
        var min_price = $('#min_price').val();
        

        ajaxSort({
            sort: sort,
            manufacturer: manufacturer,
            max_price: max_price,
            min_price: min_price
        })
    };

    $('[name="sort_price"]').on('click', sort);

    $("#manufacturer").on('change', sort);
    
    $("#max_price").on('change input', sort);

    $("#min_price").on('change input', sort);
});