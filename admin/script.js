//Nur Atikah Hamzah
//A16CS0149

//////////////////////////////////////////////////////////////////////////////////LOGIN
//=======================RESTFUL API LOGIN===============================
$(function () {
    $('#formLogin').submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            type: "POST",
            url: "http://localhost/Mommy-Baby-Online-Shopping/Mbos/login",
            data: formData,
            dataType: "json",

            success: function (data, status, xhr) {
                if (data.status == "success") {
                    alert("Login Successfully");
                    window.location.replace("main.php");
                }
                else {
                    alert('Failed to Login');
                }
            },
            error: function () {
                alert('ef fef error' + status.log);
            }
        });
    });
});

//======================RESTFUL API REGISTER===============================
$(function () {
    $('#formRegister').submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            type: "POST",
            url: "http://localhost/Mommy-Baby-Online-Shopping/Mbos/register",
            data: formData,
            dataType: "json",

            success: function (data, status, xhr) {
                if (data.status == "success") {
                    alert("Successfully Register the Admin");
                    window.location.replace("index.php");
                }
                else {
                    alert('Not Register, Something when wrong');
                }
            },
            error: function () {
                alert('ef fef error' + status.log);
            }
        });
    });

});

//////////////////////////////////////////////////////////////////////////////////PRODUCTS
// get all list of products
$(function () {
    $.ajax({
        type: "GET",
        url: "http://localhost/Mommy-Baby-Online-Shopping/Mbos/products",
        dataType: "json",

        success: function (data, status, xhr) {
            for (var x in data) {

                var cat = "";
                if (data[x].category == 0)
                    cat = "Mother Clothes";
                if (data[x].category == 1)
                    cat = "Baby Clothes";
                if (data[x].category == 2)
                    cat = "Electronics";
                if (data[x].category == 3)
                    cat = "Others";
                
                var Company = "";
                if (data[x].productCompany == 0)
                    Company = "BabyMommy.co sdn bhd";
                if (data[x].productCompany == 1)
                    Company = "MyBabies sdn bhd";
                if (data[x].productCompany == 2)
                    Company = "MommyLovers.co";
                if (data[x].productCompany == 3)
                    Company = "BabiesHaul sdn bhd";
                
                var Availability = "";
                if (data[x].productAvailability == 0)
                    Availability = "In stock";
                if (data[x].productAvailability == 1)
                    Availability = "Not in stock";

                $("#productTable tbody").append("<tr>" +
                    "   <td id='ID'>" + data[x].id + "</td>" +
                    "   <td id='CAT'>" + cat + "</td>" +
                    "   <td id='NAME'>" + data[x].productName + "</td>" +
                    "   <td id='DESC'>" + data[x].productDescription + "</td>" +
                    "   <td id='COL'>" + data[x].productColor + "</td>" +
                    "   <td id='COM'>" + Company + "</td>" +
                    "   <td id='PRI'>" + data[x].productPrice + "</td>" +
                    "   <td id='QUAN'>" + data[x].productQuantity + "</td>" +
                    "   <td id='DATE'>" + data[x].DateArrived + "</td>" +
                    "   <td id='AVAI'>" + Availability + "</td>" +
                    "   <td> <div align = 'center'><img src='images/delete.png' height='20'></div></td>" +
                    "   <td> <div align = 'center'><a href='updateProducts.php?id="+data[x].id+"'>Update</a></div></td>" +
                    "</tr>");
            }
        },
        error: function () {
            alert(status);
        }
    });
});
 
 // delete product by id
 $('#productTable').on("click", "img", function (){
    var parentTR = $(this).parent().parent().parent();
    var id = parentTR.find('#ID').html();
    console.log(id);
    $.ajax({
        type: "DELETE",
        url: "http://localhost/Mommy-Baby-Online-Shopping/Mbos/products/" + id,
        dataType: "json",
        success: function (data, status) {
            if (data.status == "success"){
                alert("deletion succeed");
            }
            else {
                alert("deletion failed - no record found with the given ID");
            }
        },
        error: function () {
            alert("error" +status);
        }
    });
 });

 //insert new products
 $('#insert_products').on('submit', function (event) {
    event.preventDefault();
    if ($('#productName').val() == '') {
        alert("Please Enter Product Name");
        return false;
    }
    else {
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: "http://localhost/Mommy-Baby-Online-Shopping/Mbos/products/",
            type: "POST",
            data: formData,
            dataType: "json",

            success: function (data, status, xhr) {
                if (data == "success") {
                    alert('New products are successfully added!');
                }
            },

            error: function () {
                alert('Insert new products failed!');
            }
        });
    }
 });

