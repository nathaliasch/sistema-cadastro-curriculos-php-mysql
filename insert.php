<?php
session_start();
ob_start();
include_once "config.php";

//busca o id do usuário que está logado
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query_user = "SELECT dt_birth, gender, marital_status, education_level, courses, professional_experience, salary_claim FROM users where id = $id";

$result_user = $pdo->prepare($query_user);
$result_user->execute();

if(($result_user) AND ($result_user->rowCount() != 0)){
        $row_user = $result_user->fetch(PDO::FETCH_ASSOC);        
} else {    
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
   <div class="wrapper">
           <h2>Cadastre seu Currículo</h2>
        <p>Por favor, preencha os campos abaixo.</p>
        <?php
        // receber os dados do formulário
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //verifica se o usuário clicou no botão
        if(!empty($data['EditUser'])){
            $empty_input = false;
            $data = array_map('trim', $data);
            
        if(!$empty_input){

            // Prepara uma declaração de inserção
            $query_up_user = "INSERT INTO users (dt_birth, gender, marital_status, education_level, courses, professional_experience, salary_claim) VALUES (:dt_birth, :gender, :marital_status, :education_level, :courses, :professional_experience, :salary_claim) WHERE id=:id";
            $edit_user = $pdo->prepare($query_up_user);
            $edit_user->bindParam(":dt_birth", $data['dt_birth'], PDO::PARAM_STR);
            $edit_user->bindParam(":gender", $data['gender'], PDO::PARAM_STR);
            $edit_user->bindParam(":marital_status", $data['marital_status'], PDO::PARAM_STR);
            $edit_user->bindParam(":education_level", $data['education_level'], PDO::PARAM_STR);
            $edit_user->bindParam(":courses", $data['courses'], PDO::PARAM_STR);
            $edit_user->bindParam(":professional_experience", $data['professional_experience'], PDO::PARAM_STR);
            $edit_user->bindParam(":salary_claim", $data['salary_claim'], PDO::PARAM_INT);
            $edit_user->bindParam(":id", $data['id'], PDO::PARAM_INT);
            if($edit_user->execute()){
                header("Location: msg_insert.php");
            } else {
                echo "<p style='color: #f00;'>Ops.. algo deu errado!</p>";
            }
        }            
        }                
        ?>        

        <form id = "edit_user" method="POST" action="">                      
            
            <label>Data de nascimento: </label>
            <input type="date" name="dt_birth" class="form-control" id="dt_birth" placeholder="DD/MM/AAAA" value="<?php if(isset($data['dt_birth'])){
                echo $data['dt_birth'];
            }elseif(isset($row_user['dt_birth'])){echo $row_user['dt_birth']; } ?>"><br><br>

            <label>Sexo: </label>
            <select name="gender" class="form-control" id="gender">
                <option value="M" <?php if(isset($data['gender']) && $data['gender'] == "M"){ echo "selected"; }elseif(isset($row_user['gender']) && $row_user['gender'] == "M"){ echo "selected"; } ?>>Masculino</option>
                <option value="F" <?php if(isset($data['gender']) && $data['gender'] == "F"){ echo "selected"; }elseif(isset($row_user['gender']) && $row_user['gender'] == "F"){ echo "selected"; } ?>>Feminino</option>
                <option value="O" <?php if(isset($data['gender']) && $data['gender'] == "O"){ echo "selected"; }elseif(isset($row_user['gender']) && $row_user['gender'] == "O"){ echo "selected"; } ?>>Outro</option>
            </select><br><br>

            <label>Estado civil: </label>
            <input type="text" name="marital_status" class="form-control" id="name" value="<?php if(isset($data['marital_status'])){
                echo $data['marital_status'];
            }elseif(isset($row_user['marital_status'])){echo $row_user['marital_status']; } ?>"><br><br>

            <label>Escolaridade: </label>
            <input type="text" name="education_level" class="form-control" id="education_level" value="<?php 
            if(isset($data['education_level'])){
                echo $data['education_level'];
            }elseif(isset($row_user['education_level'])){echo $row_user['education_level']; } ?>"><br><br>

            <label>Cursos/Especializações: </label>
            <input type="text" name="courses" id="courses" class="form-control" value="<?php if(isset($data['courses'])){
                echo $data['courses'];
            }elseif(isset($row_user['courses'])){echo $row_user['courses']; } ?>"><br><br>            
            
            <label>Experiência profissional: </label>
            <input type="text" name="professional_experience" class="form-control" value="<?php if(isset($data['professional_experience'])){
                echo $data['professional_experience'];
            }elseif(isset($row_msg_cont['professional_experience'])){ echo $row_msg_cont['professional_experience']; } ?>"><br><br>

            <label>Pretensão salarial: </label>
            <input type="number" name="salary_claim" class="form-control" value="<?php if(isset($data['salary_claim'])){
                echo $data['salary_claim'];
            }elseif(isset($row_msg_cont['salary_claim'])){ echo $row_msg_cont['salary_claim']; } ?>"><br><br>  

            <div class="form-group">
                <input type="submit" name = "EditUser" class="btn btn-primary" value="Enviar">
            </div>    
        </form>
    </body>
</html>
