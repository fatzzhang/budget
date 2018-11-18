(function(app, $) {
    'use strict'
    app.index = {
        init: () => {
            $.ajax({
                url: 'http://local.budget.tw/api/item/list',
                type: 'post',
                success: (res) => {
                    res.data.forEach(data => {
                        app.index.render.list(data, $("tbody"))    
                    })
                    
                }
            });
            app.index.bind();
        },
        render: {
            list: (data, target) => {
                const html = $(`
                    <tr>
                        <td>${data.name}</td>
                        <td>${data.price}</td>
                        <td>${data.status}</td>
                        <td><button class='btn btn-danger btn-sm'>delete</button></td>
                    </tr>
                `)
                target.append(html);
            }   
        },
        bind: () => {
            $("#definite").click(function() {
                const data = {
                    name: $("#buyWT").val(),
                    price: $("#span").val(),
                    status: $("#note").val(),
                }
                app.index.render.list(data, $("tbody"));
            })
        }
    }       
})(app, $)