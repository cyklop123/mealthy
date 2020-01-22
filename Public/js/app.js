$(document).ready(function () {
    //dodaj produkt
    $('#add_product').submit(function () {
        $(".message").empty();

        var name = $('input[name="poduct_name"]').val();
        var cal = $('input[name="callories"]').val();
        var prot = $('input[name="proteins"]').val();
        var fat = $('input[name="fats"]').val();
        var carbs = $('input[name="carbs"]').val();

        if(isEmpty(name) || isEmpty(cal) || isEmpty(prot) || isEmpty(fat) || isEmpty(carbs))
        {
            $('.message').text('Uzupełnij wszystkie pola!');
            return false;
        }

        if(isFloat(cal) || isFloat(prot) || isFloat(fat) || isFloat(carbs))
        {
            $('.message').text('Podana wartość nie jest liczbą!');
            return false;
        }
    });

    //wybierz produkt
    $('#choose_product').submit(function () {
        $('.message').empty();

        if($('.results').is(':empty') || !$('input[name="choosed"]').is(':checked'))
        {
            $('.message').text("Nie wybrałeś żanego produktu!");
            return false;
        }

        var quantity = $('input[name="quantity"]').val().trim();

        if(quantity == "")
        {
            $('.message').text("Nie podałeś ilości!");
            return false;
        }

        if(isFloat(quantity))
        {
            $('.message').text("Ilość musi być liczbą!");
            return false;
        }

        if(quantity <= 0)
        {
            $('.message').text("Ilość musi być większa od 0!");
            return false;
        }

    });
    var timeout;
    $('#product').on('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(doneTyping,500);
    });
    $('#product').on('keydown', function () {
        clearTimeout(timeout);
    });
    function doneTyping() {
        var name = $('#product').val();
        $(".results").empty();
        if(name.length > 2) {
            $.ajax({
                url: '?page=products',
                data: {
                    name: name
                },
                dataType: 'json'
            })
                .done((res) => {
                    //console.log(res);
                    for (var i = 0; i < res.length; i++) {
                        var input = $(`<input type="radio" name="choosed" value="${res[i].product_id}" id="r${i}">`);
                        var label = $(`<label for="r${i}">${res[i].product_name}</label>`)
                        $(".results").append(input);
                        $(".results").append(label);
                        $(".results").append("<hr>")
                    }
                })
        }
    }

    //podsumowanie
    $(document).on('click',".fa-trash",function () {
        var id = $(this).attr('value');

        if(confirm("Czy na pewno chcesz usunąć ten produkt?")) {
            $.ajax({
                url: '?page=delete_product',
                data: {
                    id: id
                }
            })
                .done((res)=>{
                    console.log(res);
                    if(res==1)
                    {
                        $(this).parent().parent().remove();
                    }
                })
        }
    });

    $(document).on('click', "button[name='choose_product']" ,function () {
        $(location).attr("href","?page=choose_product&meal=" + $(this).val() + "&date="+$("#datepick").val());
    });

    $("#datepick").on('change',function () {
        var data = $(this).val();

        if(data != '')
        {
            dataObj = new Date(data);
            today = new Date();
            if(dataObj <= today)
            {
                $.ajax({
                    url: '?page=get_summary',
                    data: {
                        date: data
                    },
                    dataType: 'json'
                })
                    .done((res)=>{
                        if(res.length != 0)
                        {
                            $("#summary").empty();
                            var cal=0;
                            var prot=0;
                            var fat=0;
                            var carb=0;
                            for(var i=0; i<res.length; i++)
                            {
                                var meal = $(`<div class="meal"></div>`);
                                var table = $(`<table></table>`);
                                meal.append(table);
                                var thead = $(`<thead><tr><th>${res[i].name}</th><th>kaloryczność</th><th>białka</th><th>tłuszcze</th><th>węglowodany</th></tr></thead>`);
                                table.append(thead);
                                var tbody = $(`<tbody></tbody>`);
                                table.append(tbody);
                                if(res[i].products.length != 0)
                                {
                                    for(var j=0; j<res[i].products.length; j++)
                                    {
                                        var tr = $(`<tr></tr>`);
                                        tbody.append(tr);
                                        var p = res[i].products[j];
                                        tr.append(`<td><i class="fas fa-trash" title="Usuń" value="${p.id}"></i> ${p.name}</td><td>${p.callories} kcal</td><td>${p.proteins} g</td><td>${p.fats} g</td><td>${p.carbs} g</td>`);
                                        cal += parseFloat(p.callories);
                                        prot += parseFloat(p.proteins);
                                        fat += parseFloat(p.fats);
                                        carb += parseFloat(p.carbs);
                                    }
                                }
                                else
                                {
                                    tbody.append(`<tr><td>Brak danych</td></tr>`)
                                }

                                meal.append(`<button name="choose_product" value="${i+1}">wybierz produkt</button>`);

                                $("#summary").append(meal);
                                $(`#summary`).append(`<hr>`)
                            }
                            cal = Math.round(cal*100,2)/100;
                            prot = Math.round(prot*100,2)/100;
                            fat = Math.round(fat*100,2)/100;
                            carb = Math.round(carb*100,2)/100;
                            $(`#summary`).append(`<div class="meal"><table><thead><tr><th>podsumowanie</th><th>kalorie</th><th>białka</th><th>tłuszcze</th><th>węglowodany</th></tr></thead><tbody><td></td><td>${cal} kcal</td><td>${prot} g</td><td>${fat} g</td><td>${carb} g</td></tbody></tbody></table></div>`);
                        }
                    })
            }
        }

    })

    //common
    function isFloat(str) {
        return isNan(parseFloat(str));
    }

    function isEmpty(str) {
        if(str.trim() == "")
            return true;
        return false;
    }

})