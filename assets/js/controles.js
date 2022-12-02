

const tabela = document.querySelector(".listar-usuarios")
const a = document.getElementById("action").value


document.querySelector("#xa").addEventListener("submit", async (e) => {

 
/*
    const p1 = document.getElementById("action").value
    const p2 = document.getElementById("id").value

  
    const dados = await fetch(`assets/class/controladores.class.php?p1=${p1}&p1=${p2}`)
    consultar(dados)*/
})  
async function renderizarMenu (x, y){

    const dados = await fetch(`assets/class/controladores.class.php?p1=${y}`)
    consultar(dados)

}
async function consultar(dados){

    console.log(dados)
    const response = await dados.text()
    console.log(response)
    tabela.innerHTML = response
}