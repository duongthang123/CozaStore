$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function loadMore()
{
    const page = $('#page').val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: { page},
        url: '/services/load-product',
        success: function(result)
        {
            if(result.html !== '')
            {
                $('#loadProduct').append(result.html);
                $('#page').val(page + 1);
            }else{
                $('#btn-loadMore').css('display', 'none');
            }
        }
    })
}

function quickViewProduct(id)
{
    $.ajax({
        type: 'GET',
        dataType: 'json',
        data: {id},
        url: '/san-pham/quickView',
        success: function(result)
        {
            if(result.error == false)
            {
                $('#productThumb').attr('src', result.products.thumb);
                $('#productNameShow').text(result.products.name);
                $('#productPriceShow').text(result.products.price);
                $('#productDesShow').text(result.products.description);
                $('#productIdShow').val(result.products.id);
            }else{
                alert("Có lỗi");
            }
        }
    })
}