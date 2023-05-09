<?php
session_start();
include_once 'config.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendEditCont = filter_input(INPUT_POST, 'SendEditCont', FILTER_SANITIZE_STRING);
if($SendEditCont){
    //Receber os dados do formulário
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $dt_birth = filter_input(INPUT_POST, 'dt_birth', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $marital_status = filter_input(INPUT_POST, 'marital_status', FILTER_SANITIZE_STRING);
    $education_level = filter_input(INPUT_POST, 'education_level', FILTER_SANITIZE_STRING);
    $courses = filter_input(INPUT_POST, 'courses', FILTER_SANITIZE_STRING);
    $professional_experience = filter_input(INPUT_POST, 'professional_experience', FILTER_SANITIZE_STRING);
    $salary_claim = filter_input(INPUT_POST, 'salary_claim', FILTER_SANITIZE_NUMBER_INT);    
    
    //Inserir no BD
    $result_msg_cont = "UPDATE users SET name=:name, email=:email, cpf=:cpf, dt_birth=:dt_birth, gender=:gender, marital_status=:marital_status, education_level=:education_level, courses=:courses, professional_experience=:professional_experience, salary_claim=:salary_claim WHERE id=$id";
    
    $update_msg_cont = $pdo->prepare($result_msg_cont);
    $update_msg_cont->bindParam(':name', $name);
    $update_msg_cont->bindParam(':email', $email);
    $update_msg_cont->bindParam(':cpf', $cpf);
    $update_msg_cont->bindParam(':dt_birth', $dt_birth);
    $update_msg_cont->bindParam(':gender', $gender);
    $update_msg_cont->bindParam(':marital_status', $marital_status);
    $update_msg_cont->bindParam(':education_level', $education_level);
    $update_msg_cont->bindParam(':courses', $courses);
    $update_msg_cont->bindParam(':professional_experience', $professional_experience);
    $update_msg_cont->bindParam(':salary_claim', $salary_claim);

    
    if($update_msg_cont->execute()){
        // inicie uma nova sessão
        session_start();

        // Armazene dados em variáveis de sessão
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username;    
        header("Location: msg_alter.php");
    }else{
        echo "<p style='color: #f00;'>Ops.. algo deu errado!</p>";        
    }
}