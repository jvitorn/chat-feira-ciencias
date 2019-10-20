// setInterval(function(){
//     var verificaInput = $("#message-user").val();

//     if(!botPerguntou && verificaInput == ""){
//         $.ajax({
//             type:"post",
//             url:'bot.php',
//             dataType: 'json',
//             data:{'botPergunta': 1,'id_pergunta':0},
//             // success
//             success:function(data){
//                 //apagando valores
//                 if(data.status == 1){
//                     var msgbot = $('#div_msg_bot').html();
//                     msgbot = msgbot.replace('$mensagem',data.msg);

//                     var dt = new Date();
//                     var hora = dt.getHours();
//                     var min = dt.getMinutes();

//                     msgbot = msgbot.replace('$dthr',hora+':'+min);
//                     $('#mostrar').append(msgbot);
//                     botPerguntou = true;
//                     id_pergunta_bot = data.id_pergunta;
//                 }
//             }
//         });    
//     }
	
// },10000 * 2);