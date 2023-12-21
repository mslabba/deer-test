import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// $(document).on('click', '#delete-product', function() {
//     console.log('Button clicked!');
// });

$(".delete-product").click(function (e) {
    e.preventDefault();

    var ele = $(this);

    if(confirm("Do you really want to delete?")) {
        var deleteUrl = ele.attr('data-delete-url');
        $.ajax({
            url: deleteUrl,
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("rowId")
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
});

document.querySelectorAll('.delete-product').forEach((element) => {
    element.addEventListener('click', function (e) {
        e.preventDefault();

        var ele = this;

        if (confirm("Do you really want to delete?")) {
            // Get the route URL from the data attribute
            var deleteUrl = ele.getAttribute('data-delete-url');

            axios.delete(deleteUrl, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: {

                    id: ele.closest("tr").getAttribute("rowId")
                }
            })
            .then(response => {
                console.log(response.data);
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});

$("#cart_quantity").on("change paste keyup", function() {
    var ele = this;
    var id = ele.closest("tr").getAttribute("rowId")
    var newSubTotalField = $('#subtotal_' + id);
    var originalPrice = newSubTotalField.attr('data-original-price');

    var updatedSubTotal = parseInt($(this).val()) * parseFloat(originalPrice);
    if (!isNaN(updatedSubTotal))
        newSubTotalField.text('AED ' + updatedSubTotal);

    $.ajax({
        url: 'cart/update',
        method: "patch",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        data: {
            id: id, 
        },
        success: function (response) {
            window.location.reload();
        }
    });    
 });

