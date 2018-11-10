//vendors
import $ from 'jquery';
import 'bootstrap/js/dist/collapse';

//style
import '../scss/main.scss';


$(function() {
    $.ajax({
        url: 'http://local.budget.tw/api/item/list',
        type: 'post',
        data: { id: 1 },
        success: function(response) {
            for (var a = 0; a < response.data.length; a++) {
                var res1 = $('<td></td>').text(response.data[a].name);
                var res2 = $('<td></td>').text(response.data[a].price);
                var res3 = $('<td></td>').text(response.data[a].status);
                var res4 = $("<td><button class='btn btn-danger btn-sm'>delete</button></td>")
                var addres = $('<tr></tr>').append(res1, res2, res3, res4);
                $("tbody").append(addres);
            }

        }

    })

    $("#definite").click(
        function() {
            var x = $("#buyWT").val();
            var y = $("#span").val();
            var z = $("#note").val();
            var txt1 = $("<td></td>").text(x);
            var txt2 = $("<td></td>").text(y);
            var txt3 = $("<td></td>").text(z);
            var txt4 = $("<td><button class='btn btn-danger btn-sm'>delete</button></td>")
            var tt = $("<tr></tr>").append(txt1, txt2, txt3, txt4);
            $("tbody").append(tt);
        }
    )
})
