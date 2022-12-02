

const tabela = document.querySelector(".listar-usuarios")
const formulario = document.getElementById("formulario-cheques")


document.querySelector("#filtrar").addEventListener("submit", async (e) => {

    e.preventDefault()
    alert('aas')
 

    //const p1 = document.getElementById("action").value
    //const p2 = document.getElementById("id").value
    const dados = await fetch(`assets/class/chequesDevolvidos.class.php`)
    consultar(dados)
})  
async function consultar(dados){

    console.log(dados)
    const response = await dados.text()
    console.log(response)
    tabela.innerHTML = response
}

function limparFormulario(){

    formulario.reset()
  
}