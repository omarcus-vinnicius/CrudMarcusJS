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

    const option = {
        method: 'PUT',
        body: JSON.stringify(users),
        headers: {
            'content-type': 'application/json'
        }
    }

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