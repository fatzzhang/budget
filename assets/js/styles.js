// var x = document.getElementsById("buyWT");
// var x = $("#buyWT").val()

// $("#buyWT").click(function() {
//     console.log($(this).val());
//     $(":text").val($(this).val());
// });

// console.log(1 == 1);
// console.log(x);

// document.getElementById("demo").innerHTML = x[1].innerHTML;
// document.getElementById("demo").innerHTML = 55555;

$.ajax({
        url: 'https://local.budget.tw/api/item/set',
        type: 'post',
        data: { id: 1 },
        success: function(response) {
            console.log(response);
            console.log(response.data[0].name);
            // var a = 0;

            // response.data.forEach(function(a) {
            //     var res1 = $('<td></td>').text(a.name);
            //     var res2 = $('<td></td>').text(a.price);
            //     var res3 = $('<td></td>').text(a.status);
            //     var res4 = $("<td class='btn btn-danger'></td>").text("delete")
            //     var addres = $('<tr></tr>').append(res1, res2, res3, res4);
            //     $("tbody").append(addres);
            // })


            for (var a = 0; a < response.data.length; a++) {
                var res1 = $('<td></td>').text(response.data[a].name);
                var res2 = $('<td></td>').text(response.data[a].price);
                var res3 = $('<td></td>').text(response.data[a].status);
                var res4 = $("<td class='btn btn-danger'></td>").text("delete")
                var addres = $('<tr></tr>').append(res1, res2, res3, res4);
                $("tbody").append(addres);
                // a = a + 1;
            }

        }

    })
    //get post delete put ...

// {
//     code: 0,
//     data: [{}, {}, {}]
// }


$("#income_definite").click(
    function() {
        var x = $("#income_type").val();
        var y = $("#income_HM").val();
        var z = $("#income_note").val();

        console.log(x);
        console.log(y);
        console.log(z);
        var txt1 = $("<td></td>").text(x);
        var txt2 = $("<td></td>").text(y);
        var txt3 = $("<td></td>").text(z);
        var txt4 = $("<td class='btn btn-danger delete'></td>").text("delete")
        var tt = $("<tr></tr>").append(txt1, txt2, txt3, txt4);
        console.log(tt);
        $("tbody").append(tt);

        $("#income_type, #income_HM, #income_note").val("");

        var moneyX = $("#money").val();
        console.log(moneyX);
        var moneyY = moneyX * 1 + y * 1;
        $("#money").val(moneyY);
        console.log(moneyY);
    }
)

$("#definite").click(
    function() {
        var x = $("#buyWT").val();
        var y = $("#span").val();
        var z = $("#note").val();
        // $(":text").val($("#buyWT").val() + $("#span").val() + $("#note").val());
        // $(":text").val(x + y + z);

        console.log(x);
        console.log(y);
        console.log(z);
        var txt1 = $("<td></td>").text(x);
        var txt2 = $("<td></td>").text(y);
        var txt3 = $("<td></td>").text(z);
        var txt4 = $("<td class='btn btn-danger delete'></td>").text("delete")
        var tt = $("<tr></tr>").append(txt1, txt2, txt3, txt4);
        console.log(tt);
        $("tbody").append(tt);

        $("#buyWT, #span, #note").val("");

        var moneyX = $("#money").val();
        console.log(moneyX);
        var moneyY = moneyX - y;
        $("#money").val(moneyY);
        console.log(moneyY);
    }
)

$("#clear").click(
    function() {
        $("tbody").remove();
    }
)

// $(".delete").click(
//     function() {
//         $("td.delete").closest("tr").addClass("hilight");
//     }
// )

$(document).on("click", ".delete", function() {
    // $(this).remove();
    // $(this).closest("tr").addClass("hilight");
    $(this).closest("tr").remove();
});

// $(".delete").live("click", function() {
//     $("td.delete").closest("tr").addClass("hilight");
// }); <<<不懂這段為何不能執行


$(document).ready(function() {
    if ($(window).width() < 769) {
        $("header h1").css("font-size", "24px");

        $("section#item h1").css("font-size", "28px");
    } else {
        $("header h1").css("font-size", "58px");

        $("section#item h1").css("font-size", "60px");
    }
});