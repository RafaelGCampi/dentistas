window.onload = function () {
    list();
};

function list(data = null) {
    $("#list tbody").html(
        '<div class="spinner-border" style="position: absolute;display: block;top: 25%;left: 50%;" role="status"><span class="sr-only">Carregando...</span></div>'
    );
        $.ajax({
            url: "/dentistas/list",
            type: "GET",
            success: function (data) {
                list_tbody(data)
            },
            error: function (data) {
                $("#list tbody").html(
                    $("<tr>").append(
                        $("<td colspan=4>").html(
                            $("<center>").html(
                                $("<b>").text(
                                    "Não foram encontrados dentistas."
                                )
                            )
                        )
                    )
                );
            },
        });
}

function list_tbody(data) {
    $("#list tbody").html("");
    if (data.length > 0) {
        data.forEach(function (dentista, key) {
            popula_tabela(dentista);
        });
    } else {
        $("#list tbody").html(
            $("<tr>").append(
                $("<td colspan=4>").html(
                    $("<center>").html(
                        $("<b>").text("Não foram encontrados dentistas.")
                    )
                )
            )
        );
    }
}

function popula_tabela(dentista) {
    $("#list tbody").append(`<tr>
                        <td>${dentista.nome}</td>
                        <td>${dentista.email}</td>
                        <td>${dentista.cro}</td>
                        <td>${dentista.cro_uf}</td>
                        <td><div class="dentistas-list">
                        <button class="btn btn-primary" onclick="dentista_open_edit(this, ${dentista.id})" title="Editar dentista">Editar</button>
                        <button class="btn btn-danger" onclick="delete_dentista(this, ${dentista.id})" title="Excluir dentista">Deletar</button>
                          </div></td>
                        </tr>`);
}

function store_dentista(el) {
    event.preventDefault();
    let formData = new FormData(el);
    let button = $(el).find("button");
    button.attr("disabled", true);
    button.html("Salvando...");
    $.ajax({
        url: "/dentistas/store",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
            alert("Registro salvo com sucesso !");

            button.attr("disabled", false);
            button.html("Salvar");
            if ($("#id").val() >= 1) {
                $("#modal-geral").modal("hide");
            } else {
                limpa_form();
            }
            list();
        },
        error: function (erro) {
            if (!erro.responseJSON) {
                $("#erro").html(erro.responseText);
            } else {
                $("#erro").html("");
                $.each(erro.responseJSON.errors, function (key, value) {
                    $("#erro").attr("hidden", false);
                    $("#erro").append(value + "<br>");
                    // console.log(erro.responseJSON);
                });
            }

            button.html("Salvar");
            button.attr("disabled", false);
        },
    });
    return false;
}

function dentista_open_create() {
    $("#modal-geral").modal("show");
    $("#modal-body-geral").html("Carregando....");
    $("#modal-geral-title").html("Criação de dentistas");
    $(".modal-content").css("width", "800px");
    $("#modal-body-geral").load("/dentistas/form", () => {
        $("#especialidades").select2({
            placeholder: "Selecione as especialidades",
            allowClear: true,
            language: {
                noResults: function () {
                    return "Nenhuma especialidade encontrada.";
                },
            },
        });
    });
}

function limpa_form() {
    $("input").val("");
    $("select").val("");
    $("textarea").val("");
}

function delete_dentista(button, id_dentista) {
    if (confirm("Deseja deletar dentista?")) {
        $.ajax({
            url: "/dentistas/delete/" + id_dentista,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "DELETE",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                list();
                $(button).html("Deletar");
                $(button).attr("disabled", false);
            },
            error: function (erro) {
                if (!erro.responseJSON) {
                    console.log(erro.responseText);
                    $("#erro").html(erro.responseText);
                } else {
                    $("#erro").html("");
                    $.each(erro.responseJSON.errors, function (key, value) {
                        $("#erro").attr("hidden", false);
                        $("#erro").append(value + "<br>");
                        // console.log(erro.responseJSON);
                    });
                }

                $(button).html("Deletar");
                $(button).attr("disabled", false);
            },
        });
    }
}

function dentista_open_edit(button, id_dentista) {
    $.ajax({
        url: "/dentistas/edit/" + id_dentista,
        type: "GET",
        success: function (dentista) {
            $("#modal-geral").modal("show");
            $("#modal-body-geral").html("Carregando....");
            $("#modal-geral-title").html("Edição de Dentistas");
            $(".modal-content").css("width", "800px");
            $("#modal-body-geral").load("/dentistas/form", () => {
                console.log('dentista',dentista);
                $("#id").val(dentista.id);
                $("#nome").val(dentista.nome);
                $("#email").val(dentista.email);
                $("#cro").val(dentista.cro);
                $("#cro_uf").val(dentista.cro_uf);

                //passando especialidades
                let especialidades = new Array();
                dentista.especialidades?.forEach(function (item) {
                    especialidades.push(item.id);
                });

                $("#especialidades").val(especialidades);

                $("#especialidades").select2({
                    placeholder: "Selecione as especialidades",
                    allowClear: true,
                    language: {
                        noResults: function () {
                            return "Nenhuma especialidade encontrada.";
                        },
                    },
                });
            });
        },
        error: function (error) {},
    });
}

function _search_dentista() {
    $("#list tbody").html(
        '<div class="spinner-border" style="position: absolute;display: block;top: 25%;left: 50%;" role="status"><span class="sr-only">Carregando...</span></div>'
    );
    let formData = new FormData($('#search_dentista')[0]);
    let button = $('#search_dentista').find("button");
    button.attr("disabled", true);
    button.html("Buscando...");
    $.ajax({
        url: "/dentistas/search",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
            list_tbody(result);
            button.html("Buscar");
            button.attr("disabled", false);
        },
        error: function (erro) {
            button.html("Salvar");
            button.attr("disabled", false);
        },
    });
    return false;
}
