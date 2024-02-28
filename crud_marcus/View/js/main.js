'use strict'

import { getUser, creatUser, deleteUser, UpdateUser, getUserID } from "../service/service.js";
import { validationForm } from "../utils/validation.js";


const clearRows = () => {
  const row = document.querySelectorAll('#table-contacts>table>tbody tr');

  row.forEach(row => row.parentNode.removeChild(row))
}


const creatRows = ({ id, nome, email, celularContato, dataDeNascimento, img }) => {

  const newRow = document.createElement('tr');

  newRow.innerHTML = `
   
    <td class="table-contacts__content">${nome}</td>
    <td class="table-contacts__content">${email}</td>
    <td class="table-contacts__content">${celularContato}</td>
    <td class="table-contacts__content">${dataDeNascimento}</td>
    <td class="table-contacts__content"><img src="../uploades/${img}" class="img-users"  /></td>
    <td class="table-contacts__actions">
      <input
        type="image"
        src="./img/editar.png"
        id="edit-${id}"
        class="action" 
      />
      <input
        type="image"
        src="./img/delete.png"
        id="delete-${id}"
        class="action"
      />
    </td>
   `;


  document.querySelector('#data-list > #scroll-table > table > tbody').appendChild(newRow);

}


const getUsers = async () => {

  const readusers = await getUser();
  const listuser = await readusers.res;
  listuser.forEach(creatRows);


}


getUsers();



const errorMensager = async (action, res) => {

  let erroMsg = document.getElementById('msg');

  const restatus = await res;
  var resError = false;

  if (action == 'new') {
    if (restatus.status === 'true') {

      erroMsg.innerHTML = `${restatus.res}`;
      erroMsg.classList.add('sucess_msg');
      resError = true;


    } else {

      erroMsg.classList.add('error_msg');
      erroMsg.innerHTML = `${restatus.res}`;
      resError;
    }

  } else {

    if (restatus.status === 'true') {

      erroMsg.innerHTML = ` ${restatus.res} `;
      erroMsg.classList.add('sucess_msg');
      resError = true;

    } else {

      erroMsg.classList.add('error_msg');
      erroMsg.innerHTML = ` ${restatus.res}`;
      resError;

    }


  }

  return resError;

}



const form = document.getElementById('modal-form');

form.addEventListener('submit', async (e) => {

  // const img = document.getElementById('photoimg').file ? img.file : 'fotonull.png';
  // console.log(img);

  e.preventDefault();
  const formdata = new FormData(form);

  console.log([...formdata])

  const index = document.getElementById('name').dataset.index;

  if (validationForm() == true) {

    if (index == 'new') {

      clearRows();
      const res = creatUser(formdata);
      const resError = await errorMensager(index, res);
      setInterval(() => { if (resError == true) { location.reload(); } }, 3000);

    } else {

      clearRows();
      const res = UpdateUser(index, formdata)
      const resError = await errorMensager(index, res)
      setInterval(() => { if (resError == true) { location.reload(); } }, 3000);


    }

  }


});


const styleContactRegistrationButton = () => {

  const buttonRegisterContact = document.getElementById('senduser');

  buttonRegisterContact.value = "Atualizar";


}



const fillInInputs = ({ id, nome, email, celularContato, dataDeNascimento, img }) => {
  document.getElementById('name').value = nome;
  document.getElementById('email').value = email;
  document.getElementById('cellphone').value = celularContato;
  document.getElementById('birthday-date').value = dataDeNascimento;
  document.getElementById('imgusers').value = img;
  document.getElementById('name').dataset.index = id;
}


const getUpdateUserId = async (idUser) => {

  const getUserId = await getUserID(idUser);

  const resUser = getUserId.res[0];

  styleContactRegistrationButton();

  fillInInputs(resUser);

}

const choiceActionTable = (event) => {

  if (event.target.type == 'image') {

    const [action, index] = event.target.id.split('-');

    if (action == 'edit') {

      getUpdateUserId(index);

    } else {
      clearRows();
      const res = deleteUser(index)
      errorMensager(action, res);

    }
  }
}


document.querySelector('#data-list > #scroll-table > table > tbody').addEventListener('click', choiceActionTable)