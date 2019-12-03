//for item 
$('#add_item').click(function () {
    let item = $('#item').val();
    let item_data1 = $('#item option:selected').text();
    let item_data = item_data1.split("=");

    let item_name = item_data[0];
    let item_price = item_data[1];

    let quantity = $('#quantity').val();


    $("#added_item li input").each(function (e) {

        let data1 = $(this).val();
        let data2 = data1.split(':');
        let id = data2[0];

        if (id == item) {
            $('.message').text('Item already added');
            e.preventPropagation();
            return false;
        } else {
            $('.message').text("");
        }
    });

    $('#added_item').append(
        "<li>" + item_name + " X " + quantity + " = " + item_price * quantity + " BDT <input type='hidden' name='items[]' value='" + item + ":" + quantity + "' />  <button  class='btn btn-sm text-danger' id='remove' >x</button></li>"
    );

    // sum added product price subtotal
    let sub_total1 = Number(quantity * item_price);
    let sub_total2 = Number($('.sub_total').val());
    let subtotal = sub_total1 + sub_total2;

    $('.sub_total').val(subtotal);

    calculation();
    // End sum added product price subtotal
});

//for package
$('#add_package').click(function () {
    let package_id = $('#packages').val();
    let package_data1 = $('#packages option:selected').text();
    let package_data = package_data1.split("=");

    let package_name = package_data[0];
    let package_price = package_data[1];

    let package_quantity = $('#package_quantity').val();


    $("#added_packages li input").each(function (event) {

        let data1 = $(this).val();
        let data2 = data1.split(":");
        let id = data2[0];

        if (id == package_id) {
            $('.message1').text("Package is already added");
            event.preventPropagation();
            return false;
        } else {
            $('.message1').text("");
        }

    });

    $('#added_packages').append(
        "<li>" + package_name + " X " + package_quantity + " = " + package_price * package_quantity + "<input type='hidden' name='packages[]' value='" + package_id + ":" + package_quantity + "' />  <button  class='btn btn-sm text-danger' id='remove' >x</button></li>"
    );

    // sum added product price subtotal

    let sub_total1 = Number(package_quantity * package_price);
    let sub_total2 = Number($('.sub_total').val());
    let subtotal = sub_total1 + sub_total2;

    $('.sub_total').val(subtotal);
    calculation();
});


//for remove added product
$(document).on('click', '#remove', function (event) {

    // subtract added product
    let li_text = $(this).parent().text();
    let li_text1 = li_text.split(" = ");
    let li_price = parseInt(li_text1[1]);


    let sub_total_old = Number($('.sub_total').val());
    $('.sub_total').val(sub_total_old - li_price);

    $(this).parent().remove();
    calculation();
});


//Calculation between create order page
let calculation = () => {

    let price = Number($(".sub_total").val());
    let vat = Number($(".vat").val());
    let discount = Number($(".discount").val());

    let discount_amount = (price * discount) / 100;
    let vat_amount = ((price - discount_amount) * vat) / 100;


    let total = Math.round((price + vat_amount) - discount_amount);

    $('.total').val(total);
};

$(document).on('keyup', ' .sub_total, .vat, .discount', function () {
    calculation();
});

// End Calculation between create order page