'use strict'

const baseUrl = 'http://localhost:8080/crudphp/users';


const getUser = async () => {

    const response = await fetch(`${baseUrl}`);

    return await response.json();
}


const getUserID = async (idusers) => {

    const response = await fetch(`${baseUrl}/${idusers}`);

    return await response.json();
}



const creatUser = async (newusers) => {

    const option = {
        method: 'POST',
        body: newusers,
    };

    const response = await fetch(`${baseUrl}`, option);

    const res = await response.json();

    console.log(res);

    return res;
}



const UpdateUser = async (index, users) => {

    ///** Method put trocado por post. o php slim não possue o method de put compativel com o multipart/form-data  *///
    ///** Então para suprir as necessidades do projeto, fiz essa alteracao enquanto crio o method put com multipart/form-data compativel *///

    const option = {
        method: 'POST',
        body: users,
    };

    const response = await fetch(`${baseUrl}/${index}`, option);
    const res = await response.json();

    return res;



}



const deleteUser = async (idusers) => {

    const option = {
        method: 'DELETE',
    }

    const response = await fetch(`${baseUrl}/${idusers}`, option);

    if (response.ok)
        location.reload();

}


export {

    getUser,
    getUserID,
    creatUser,
    UpdateUser,
    deleteUser

}