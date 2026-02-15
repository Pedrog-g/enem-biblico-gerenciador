let participants = [];
let currentLevel = 1;
async function loadParticipants(){

  const response = await fetch("http://localhost/certificado-enem-biblico/src/php/listar-participantes.php");
  participants = await response.json();

  const firstBtn = document.querySelector(".tab-btn");
  showLevel(1, firstBtn);
}



function showLevel(level, btn){

  currentLevel = level;
  console.log(currentLevel)
  document.querySelectorAll(".tab-btn").forEach(b=>{

    const lvl = b.dataset.level;

    // remove todas as cores
    b.className = "tab-btn px-4 py-2 rounded-3xl font-semibold transition";

    // aplica cor inativa
    if(lvl == 1) b.classList.add("bg-blue-100","text-blue-700");
    if(lvl == 2) b.classList.add("bg-yellow-100","text-yellow-700");
    if(lvl == 3) b.classList.add("bg-green-100","text-green-700");
  });

  // botão ativo
  btn.classList.remove("bg-blue-100","bg-yellow-100","bg-green-100");

  if(level == 1) btn.classList.add("bg-blue-600","text-white");
  if(level == 2) btn.classList.add("bg-yellow-500","text-white");
  if(level == 3) btn.classList.add("bg-green-600","text-white");

  renderTable();
}

function renderTable(){
  const table = document.querySelector("#participants_table");

  let filtered = participants.filter(p => p.nivel == currentLevel);

  filtered.sort((a,b)=> b.acertos - a.acertos);

  let html = ""; // ✅ TEM QUE SER AQUI

  filtered.forEach((p, index)=>{

    let medal = "";
    let rowStyle = "";

    if(index === 0){
      medal = "🥇";
      rowStyle = "bg-yellow-50";
    }else if(index === 1){
      medal = "🥈";
      rowStyle = "bg-gray-50";
    }else if(index === 2){
      medal = "🥉";
      rowStyle = "bg-orange-50";
    }

    html += `
      <tr class="${rowStyle} hover:bg-blue-50 transition">
        <td class="p-4 font-bold text-lg flex justify-center">
          ${medal || (index+1)}
        </td>

        <td class="p-4 font-semibold text-slate-800 text-center">
          ${p.nome}
        </td>

        <td class="p-4 text-center">
          <input type="number" value="${p.acertos || ''}"
            class="w-20 border rounded p-1 text-center"
            onchange="updateAnswers(${p.id}, this.value)">
        </td>

        <td class="p-4 text-center flex justify-center">
          <button onclick="generateCertificate('${p.nome}', ${index+1}, ${p.acertos ? p.acertos : 0})"

            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
            Certificado
          </button>
        </td>
      </tr>
    `;
  });

  table.innerHTML = html; // ✅ TEM QUE VIR AQUI
}



function generateCertificate(nome, position, acertos){

  let tipo = "participacao";

  if(position == 1) tipo = "primeiro";
  if(position == 2) tipo = "segundo";
  if(position == 3) tipo = "terceiro";

  const url = `http://localhost/certificado-enem-biblico/src/php/gerar-certificado.php?nome=${encodeURIComponent(nome)}&tipo=${tipo}&nivel=${currentLevel}&acertos=${acertos}`;

  console.log(url);

  window.open(url, "_blank");
}


loadParticipants();