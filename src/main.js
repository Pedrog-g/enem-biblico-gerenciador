async function addNewParticipant(name, level){
  if(name){
    const formatedName = name.toUpperCase();
    const url = `http://localhost/certificado-enem-biblico/src/php/cadastrar-participante.php?nome=${encodeURIComponent(formatedName)}&nivel=${encodeURIComponent(level)}`;

    try{
      const response = await fetch(url);
      const result = await response.text()
      console.log(result)
      alert(result)
    }catch(error){
      alert(error)
    }
  }else{
    alert('Preencha os daados!');
    return
  }


}

function updateAnswers(id, correctAnswers){

}


const addNewParticipantForm = document.querySelector('#add_new_member_form');
addNewParticipantForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const nome = document.querySelector('#nome');
  const level = document.querySelector('#nivel');
  addNewParticipant(nome.value, level.value);
  nome.value = '';
  level.value = '';
})