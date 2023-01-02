async function listEnd(valor){
    if(valor.length >= 5){
        const dados = await fetch('loadEnd.php?zb_end=' + valor);
        const resposta = await dados.json();

        var html = "<ul class='dropdown'>";

        if(resposta['erro']){
            html += "<li>"+ resposta['msg'] +"</li>"
        }else{
            for(i=0; i<resposta['dados'].length; i++){
                html += "<li onclick='get_id_ende("+ resposta['dados'][i].zb_id + "," + 
                JSON.stringify(resposta['dados'][i].zb_end) +")'>"+ resposta['dados'][i].zb_end +"</li>"
            }
        }
        html += "</ul>";

        document.getElementById('resultado_pesquisa').innerHTML = html;
    }
}

function get_id_ende(id_ende, zb_end){
    document.getElementById("id_ende").value = id_ende;
    document.getElementById("zd_end").value = zb_end;
}

const fechar = document.getElementById('zd_end');
document.addEventListener('click', function(event){
    const validar_clique = fechar.contains(event.target);
    if(!validar_clique){
        document.getElementById('resultado_pesquisa').innerHTML ='';
    }
});

submit.addEventListener("keydown", function(event) {
    event.key === "Enter"
});