$(document).ready(function() {

    // variáveis de uso global
    var locale_now = $("input[name='locale_now']").val();
    var url = "/" + locale_now + "/";

    /*
     * Bloco envio de informações do formulário - INÍCIO
     */
    // Controle do envio de comentários para o controller
    $(".btn-submit").click(function(e){

        e.preventDefault();

        var _token = $("input[name='_token']").val();
        var nome = $("input[name='nome']").val();
        var email = $("input[name='email']").val();
        var comentario = $("textarea[name='comentario']").val();
        var url_local = url + "inserir";

        $.ajax({
            url: url_local,
            type: "POST",
            data: {_token:_token, nome:nome, email:email, comentario:comentario}
        }).done(function(data) {
            if ($.isEmptyObject(data.error)) {
                printMsg(data.success, "success");

                // limpa os valores dos campos
                $("input[name='nome']").val("");
                $("input[name='email']").val("");
                $("textarea[name='comentario']").val("");
            }
            else {
                printMsg(data.error, "error");
            }
        }).fail(function(data, textStatus, xhr) {
            printMsg(data.status + ": " + xhr , textStatus);
        });

    });

    function printMsg(msg, type) {

        if(type !== "") {

            // exibe a div para mensagem de erro
            var domElem = $(".print-error-msg");
            var domAlert = $("#alert");

            domElem.find("ul").html('').css('display','block');
            domElem.css('display','block');

            // dependendo do tipo da mensagem, altera também as cores da caixa de mensagem
            switch(type) {
                case "success":
                    domAlert.removeClass("alert-danger").addClass("alert-success");
                    break;
                case "error":
                    domAlert.removeClass("alert-success").addClass("alert-danger");
                    break;
            }

            // limpa todos os valores de mensagens anteriores
            domElem.find("ul").empty();

            if($.isArray(msg)) {
                $.each( msg, function( key, value ) {
                    domElem.find("ul").append("<li>" + value + "</li>");
                });
            }
            else {
                domElem.find("ul").append("<li>"+ msg + "</li>");
            }

        }
    }
    /*
     * Bloco envio de informações do formulário - FIM
     */



    /*
     * Bloco Carregamento Comentários - INÍCIO
     */
    // armazena a data/hora do último comentário
    var last_datetime = "";

    var loadComment = function(){

        var url_local = url + "comentarios/" + last_datetime;

        $.ajax({
            url: url_local,
            type: "GET"
        }).done(function(data) {

            if(data !== null && data.length > 0) {

                var domLu = $(".comments_inline");

                $.each(data, function(key, value) {
                    domLu.append('<li class="list-group-item" style="display:none;"><h4 class="list-group-item-heading" style="overflow-wrap: break-word;">' + data[key].nome + ' em ' + data[key].created_at + '</h4><p class="list-group-item-text" style="overflow-wrap: break-word;">' + data[key].comentario + '</p></li>');
                    $(".comments_inline li").fadeIn();
                    last_datetime = data[key].created_at;
                });

            }

        }).fail(function(data, textStatus, xhr) {

            $("#alert-comment").append('<h5>' + data.status + ": " + xhr , textStatus + '</h5>');
        });

    };

    // carrega comentário pela primeira vez antes dos 10s
    loadComment();
    // carrega comentários a cada 10s
    setInterval(loadComment, 10000);

    /*
     * Bloco Carregamento Comentários - FIM
     */



    /*
     * Bloco carregamento do gráfico - INÍCIO
     */

    var loadGraph = function(){

        var url_local = url + "grafico";

        $.ajax({
            url: url_local,
            type: "GET"
        }).done(function(data) {

            if(data !== null) { // && data.length > 0

                var options = {
                   responsive:true
                };

                var rotulos = [], dados = [];

                data["labels"].forEach(function(infos) {
                    rotulos.push(infos);
                });

                data["valores"].forEach(function(infos) {
                    dados.push(infos);
                });

                var dadosFinais = {
                    labels: rotulos,
                    datasets: [
                        {
                            label: "Comentários inseridos por dia",
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: dados
                        }
                    ]
                };

                var ctx = document.getElementById("grafico-comentarios").getContext("2d");
                var BarChart = new Chart(ctx).Bar(dadosFinais, options);
            }

        }).fail(function(data, textStatus, xhr) {

            $("#alert-grafico").append('<h5>' + data.status + ": " + xhr , textStatus + '</h5>');
        });

    };

    loadGraph();
    // carrega dados do gráfico a cada 30s
    setInterval(loadGraph, 30000);

    /*
     * Bloco carregamento do gráfico - FIM
     */



    /*
     * Bloco mudança de cores da página - INÍCIO
     */

    $("#btnColor1").click(switchNormal);
    $("#btnColor2").click(switchInverse);

    // Retorna os estilos padrões aos elementos
    function switchNormal() {
        $("nav").removeClass("navbar-jobtest-inverse").addClass("navbar-jobtest");
        $("#header").removeClass("jumbotron-inverse").addClass("jumbotron-normal");
        $("#footer").removeClass("jumbotron-footer-inverse").addClass("jumbotron-footer-normal");
    }

    // Substitui os estilos padrões pelos inversos
    function switchInverse() {
        $("nav").removeClass("navbar-jobtest").addClass("navbar-jobtest-inverse");
        $("#header").removeClass("jumbotron-normal").addClass("jumbotron-inverse");
        $("#footer").removeClass("jumbotron-footer-normal").addClass("jumbotron-footer-inverse");
    }
    /*
     * Bloco mudança de cores da página - FIM
     */


});