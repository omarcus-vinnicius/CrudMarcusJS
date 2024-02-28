<?php

namespace Events;


abstract class Status
{

    /// erros
    const ERRO_ID_NOT_FOUND = 'Desculpe, ID Não encontrado';
    const ERRO_ID_NOT_NUMBER = 'Esse ID nao corresponder ao um numero';

    const ERRO_CREATE_USERS = 'Não foi possivel criar esse usuario';


    /// sucesso

    const CREATE_SUCESS = 'Usuario criado com sucesso';
    const DELETED_SUCESS = 'Usuario deletado com sucesso';
    const UPDATE_SUCESS = 'Usuario atualizado com sucesso';


}