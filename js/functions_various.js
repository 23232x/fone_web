function CriaRequest() {
  try {
    request = new XMLHttpRequest();
  } catch (IEAtual) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (IEAntigo) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (falha) {
        request = false;
      }
    }
  }
  if (!request) alert("Seu Navegador não suporta Ajax!");
  else return request;
}

function show_contacts(){
  $('.secretary_contacts').show('500');
}

$(document).ready(function() {
  var url = get_url();

  $("#button_login").click(function() {
    var errors = 0;
    var msg = "";

    if ($("#user_ldap").val() == "") {
      msg += "Campo Login é Obrigatório<br/>";
      errors++;
    }

    if ($("#passwd_ldap").val() == "") {
      msg += "Campo Senha é Obrigatório<br/>";
      errors++;
    }

    if (errors > 0) {
      document.getElementById("msg_valida_login").style.display = "block";
      $("#return_valida_login").html(msg);
    } else {
      $.ajax({
        url: url + "login/authentication/",
        type: "POST",
        data: {
          user: $("#user_ldap").val(),
          password: $("#passwd_ldap").val()
        },
        // data: 'user=' + $('#user_ldap').val() + '&senha=' + $('#passwd_ldap').val(),
        success: function(data) {
          var t = JSON.parse(data);
          // console.log(t.return);
          if (t.return == false) {
            document.getElementById("msg_valida_login").style.display = "block";
            $("#return_valida_login").html(t.message);
          } else {
            console.log("true/logado");
            window.location.reload();
          }
        },
        error: function(data) {
          alert("Error");
        }
      });
    }
  });
});

// function login() {
//     var errors = 0;
//     var msg = "";
//     var res = document.getElementById('return_valida_login');
//     var input_user_ldap = document.getElementById('user_ldap').value;
//     var input_passwd_ldap = document.getElementById('passwd_ldap').value;
//     var url = get_url();
//     var data_result = "";

//     if (input_user_ldap == "") {
//         msg += "Campo Login é Obrigatório<br/>";
//         errors++;
//     }

//     if (input_passwd_ldap == "") {
//         msg += "Campo Senha é Obrigatório<br/>";
//         errors++;
//     }

//     if (errors > 0) {
//         document.getElementById('msg_valida_login').style.display = 'block';
//         res.innerHTML = msg;
//     } else {
//         // document.getElementById('loading').style.display = 'block';
//         var xmlreq = CriaRequest();

//         xmlreq.open("POST", url + "login/authentication/", true);

//         // var data = {
//         //     user: input_user_ldap,
//         //     password: input_passwd_ldap
//         // }

//         var data = JSON.stringify({
//             "name": "myname",
//             "email": "foo@bar.com",
//             "age": "15"
//         });

//         xmlreq.onreadystatechange = function () {

//             if (xmlreq.readyState === 4) {
//                 if (xmlreq.status === 200) {

//                 }
//             }

//         }
//         xmlreq.send(data);
//     }
// }

function get_url() {
  var url =
    window.location.protocol + "//" + window.location.host + "/fone_web/";
  return url;
}

// function get_contacts() {
//     var typed = document.getElementById('typed').value;
//     var result = document.getElementById('result_search');
//     var url = get_url();
//     var data_result = "";

//     if (typed.length >= 3) {
//         var xmlreq = CriaRequest();
//         xmlreq.open("GET", url + "contacts/get_contacts/?typed=" + typed, true);

//         xmlreq.onreadystatechange = function () {

//             if (xmlreq.readyState === 4) {

//                 if (xmlreq.status === 200) {
//                     var contacts = JSON.parse(xmlreq.responseText);
//                     for (var i = 0; i < contacts.length; i++) {
//                         data_result += '<a href="" ng-click="getContact" class="link_result" data-toggle="modal" data-target="#modal_date_contact"><div class="row_result">' + contacts[i].name + ' - ' + contacts[i].departament + ' - ' + contacts[i].number + '</div></a>';
//                     } //onclick - funcao

//                     result.innerHTML = data_result;
//                 }
//             }
//         };
//         xmlreq.send(null);
//     } else {
//         result.innerHTML = "";
//     }

// }

// function getContact() {
//     angular.module("resultApp", ['ui.bootstrap'])
//         .controller("ModalCtrl", function ($scope, $modal) {
//             $scope.getContact = function () {

//                 $scope.contact = {
//                     nome: 'Diego',
//                     // nomeContact: $contact.name,
//                     // emailContact: $contact.email,
//                     // departamentContact: $contact.departament,
//                     // telefoneContact: $contact.number
//                 }

//                 $modal.open({
//                     templateUrl: 'modal_date_contact',
//                     controller: 'Modal',
//                     resolve: {
//                         cliente: function () {
//                             return $scope.contact;
//                         }
//                     }
//                 });
//             }
//         })

//         .controller("Modal", function ($scope, $modalInstance, contact) {
//             $scope.contact = contact;
//             console.log(contact);
//             $scope.ok = function () {
//                 $modalInstance.close();
//             };
//         });
// }
//function date_now() {
//    var now = new Date;
//    var dia = now.getDate();
//    var mes = now.getMonth();
//    var ano = now.getFullYear();
//
//    if (dia < 10) {
//        dia = "0" + dia;
//    }
//    if (mes < 10) {
//        mes = "0" + (mes + 1);
//    }
//    var data = ano + "-" + mes + "-" + dia + "T00:00";
//
//    document.getElementById('inicio_chamado').value = data;
//    document.getElementById('termino_chamado').value = data;
//    document.getElementById('chegada_local').value = data;
//}
//
//function btn_salvar_chamado(tipo) {
//    if (tipo) {
//        document.getElementById("btn_salva_chamado_text").style.display = "block";
//    } else {
//        document.getElementById("btn_salva_chamado_text").style.display = "none";
//    }
//
//}
//
//function detele(id, url) {
//    document.getElementById('btn-delete-yes').href = url + id;
//}
//
//function valida_form(form) {
//    var errors = 0;
//    var msg = "";
//    var res = document.getElementById('return_valida_form');
//
//    var imput_numero_chamado = document.getElementById('numero_chamado').value;
//    var imput_condutor = document.getElementById('condutor').value;
//    var imput_tecnico = document.getElementById('tecnico').value;
//    var imput_inicio_chamado = document.getElementById('inicio_chamado').value;
//    var imput_termino_chamado = document.getElementById('termino_chamado').value;
//    var imput_chegada_local = document.getElementById('chegada_local').value;
//    var imput_paciente = document.getElementById('paciente').value;
//    var imput_sexo = document.getElementById('sexo').value;
//    var imput_idade = document.getElementById('idade').value;
//    var imput_rua = document.getElementById('rua').value;
//    var imput_bairro = document.getElementById('bairro').value;
//    var imput_origem = document.getElementById('origem').value;
//    var imput_local_chamado = document.getElementById('local_chamado').value;
//    var imput_desfecho_chamado = document.getElementById('desfecho_chamado').value;
//
//    if (imput_numero_chamado === "") {
//        msg += "Número do chamado é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_condutor === "") {
//        msg += "Condutor é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_tecnico === "") {
//        msg += "Técnico é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_inicio_chamado === "") {
//        msg += "Início do chamado é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_chegada_local === "") {
//        msg += "Chegada no local é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_termino_chamado === "") {
//        msg += "Término do chamado é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_paciente === "") {
//        msg += "Paciente é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_sexo === "") {
//        msg += "Sexo é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_idade === "") {
//        msg += "Idade é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_idade <= 0) {
//        msg += "Idade deve ser maior que 0<br/>";
//        errors++;
//    }
//
//    if (imput_rua === "") {
//        msg += "Rua é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_bairro === "") {
//        msg += "Bairro é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_origem === "") {
//        msg += "Origem do chamado é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_local_chamado === "") {
//        msg += "Local do chamado é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_desfecho_chamado === "") {
//        msg += "Desfecho do chamado é obrigatório<br/>";
//        errors++;
//    }
//
//    if (imput_inicio_chamado >= imput_termino_chamado) {
//        msg += "Término do chamado deve ser uma data maior que Início do chamado<br/>";
//        errors++;
//    }
//
//    if ((imput_inicio_chamado >= imput_chegada_local) || imput_chegada_local >= imput_termino_chamado) {
//        msg += "Chegada no local deve ser uma data mario que Início do chamado e menor que Término do chamado<br/>";
//        errors++;
//    }
//
//    if (errors > 0) {
//        document.getElementById('msg_valida_form').style.display = 'block';
//        res.innerHTML = msg;
//    } else {
//        valida_motivo(form);
//    }
//
//}
//
//function valida_motivo(form) {
//    var xmlreq = CriaRequest();
//    var res = document.getElementById('return_valida_form');
//    xmlreq.open("GET", "../../../sissamu/motivos/get_motivos", true);
//
//    xmlreq.onreadystatechange = function () {
//
//        if (xmlreq.readyState == 4) {
//
//            if (xmlreq.status == 200) {
//                var motivos = JSON.parse(xmlreq.responseText);
//                var count = 0;
//                for (var i = 0; i < motivos.length; i++) {
//                    if (document.getElementById(motivos[i].nome + motivos[i].id).checked) {
//                        count++;
//                    }
//                }
//                if (count === 0) {
//                    document.getElementById('msg_valida_form').style.display = 'block';
//                    res.innerHTML = "Você deve selecionar pelo mesno um Motivo / Tipo";
//                } else {
//                    valida_numero_chamado(form);
//                }
//            }
//        }
//    };
//    xmlreq.send(null);
//}
//
//function valida_numero_chamado(form) {
//    if (form == 2) {
//        envia_form(1, form);
//    } else {
//        var numero_chamado = document.getElementById('numero_chamado').value;
//        var xmlreq = CriaRequest();
//        var res = document.getElementById('return_valida_form');
//        xmlreq.open("GET", "../../../sissamu/chamados/valida_numero_chamado?nro_chamado=" + numero_chamado, true);
//
//        xmlreq.onreadystatechange = function () {
//
//            if (xmlreq.readyState == 4) {
//
//                if (xmlreq.status == 200) {
//                    var retorno = xmlreq.responseText;
//                    if (retorno === '0') {
//                        document.getElementById('msg_valida_form').style.display = 'block';
//                        res.innerHTML = "Já existe um chamado com esse número";
//                        envia_form(0, form);
//                    } else {
//                        envia_form(1, form);
//                    }
//                }
//            }
//        };
//        xmlreq.send(null);
//    }
//
//
//}
//
//function envia_form(form_validado, form) {
//    if (form_validado) {
//        if (form == 1) {
//            document.form_chamado.submit();
//        } else if (form == 2)
//            document.form_chamado_update.submit();
//    }
//}
//
//function get_info_chamado(id_chamado) {
//    document.getElementById('loading_modal').style.display = 'block';
//    document.getElementById('exibe_info_chamado_modal').innerHTML = "";
//    var msg = '';
//    var xmlreq = CriaRequest();
//    xmlreq.open("GET", "../../../sissamu/chamados/get_info_chamado?id_chamado=" + id_chamado, true);
//    xmlreq.onreadystatechange = function () {
//        if (xmlreq.readyState == 4) {
//            if (xmlreq.status == 200) {
//                document.getElementById('loading_modal').style.display = 'none';
//                var response_chamados = JSON.parse(xmlreq.responseText);
//                msg += "<br/><strong>Número do chamado: </strong>" + response_chamados.numero_chamado;
//                msg += "<br/><strong>Condutor: </strong>" + response_chamados.condutor;
//                msg += "<br/><strong>Técnico: </strong>" + response_chamados.tecnico;
//                msg += "<br/><strong>Início do chamado: </strong>" + response_chamados.inicio_chamado;
//                msg += "<br/><strong>Término do chamado: </strong>" + response_chamados.termino_chamado;
//                msg += "<br/><strong>Paciente: </strong>" + response_chamados.paciente;
//                msg += "<br/><strong>Sexo: </strong>" + response_chamados.sexo;
//                msg += "<br/><strong>Idade: </strong>" + response_chamados.idade;
//                msg += "<br/><strong>Rua: </strong>" + response_chamados.rua;
//                msg += "<br/><strong>Bairro: </strong>" + response_chamados.bairro;
//                msg += "<br/><strong>Origem do chamado: </strong>" + response_chamados.origem;
//                msg += "<br/><strong>Local do chamado: </strong>" + response_chamados.local_chamado;
//                msg += "<br/><strong>Desfecho do chamado: </strong>" + response_chamados.desfecho_chamado;
//                msg += "<br/><strong>Observações do chamado: </strong>" + response_chamados.observacoes;
//                msg += "<br/><strong>Motivo / Tipo: </strong>" + response_chamados.motivos;
//                msg += "<br/><strong>Chamado digitado por: </strong>" + response_chamados.usuario;
//                document.getElementById('exibe_info_chamado_modal').innerHTML = msg;
//            } else {
//                document.getElementById('loading_modal').style.display = 'none';
//                var response_chamados = "Erro: " + xmlreq.statusText;
//            }
//        }
//    };
//    xmlreq.send(null);
//}
//
//function exibe_filtros() {
//    $('#filtro_chamados').show(500);
//}
//
//jQuery(document).ready(function () {
//    jQuery('#floppy-disk').click(function () {
//        var dados = jQuery('#form_chamado').serialize();
//        jQuery.ajax({
//            headers: "Content-type: text/html; charset=iso-8859-1",
//            type: "POST",
//            url: "salva_chamados_nao_finalizados",
//            data: dados,
//            beforeSend: function () {
//
//            },
//            success: function (data)
//            {
//                var response_chamados = JSON.parse(data);
//                var res = document.getElementById('return_valida_form');
//                var div_mensagem = document.getElementById('msg_valida_form');
//
//                if (response_chamados.tipo) {
//                    r
//                    document.getElementById('msg_grava_atend').style.display = "block";
//                    setTimeout(function () {
//                        $('#msg_grava_atend').fadeOut(500);
//                    }, 2000);
//                    ;
//                } else {
//                    div_mensagem.style.display = 'block';
//                    res.innerHTML = response_chamados.mensagem;
//                }
//
//            }
//        });
//
//        return false;
//    });
//});
//
//function odometer(val, id) {
//    setTimeout(function () {
//        document.getElementById(id).innerHTML = val;
//    }, 1000);
//}
