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
        var txt4 = $("<td class='btn btn-danger'></td>").text("delete")
        var tt = $("<tr></tr>").append(txt1, txt2, txt3, txt4);
        console.log(tt);
        $("tbody").append(tt);
    }
)