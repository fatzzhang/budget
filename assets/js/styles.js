// var x = document.getElementsById("buyWT");
var x = ($("#buyWT").val())

// $("#buyWT").click(function() {
//     console.log($(this).val());
//     $(":text").val($(this).val());
// });

// console.log(1 == 1);
console.log(x);

// document.getElementById("demo").innerHTML = x[1].innerHTML;
// document.getElementById("demo").innerHTML = 55555;

$("#definite").click(
    function() {
        $(":text").val($("#buyWT").val() + $("#span").val() + $("#note").val());
    }
)