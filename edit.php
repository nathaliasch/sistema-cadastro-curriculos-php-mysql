<?php
session_start();
ob_start();
include_once "config.php";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Currículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
    <h2>Currículo</h2>
    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        //SQL para selecionar o registro
        $result_msg_cont = "SELECT * FROM users WHERE id=$id";
        
        //Seleciona os registros
        $resultado_msg_cont = $pdo->prepare($result_msg_cont);
        $resultado_msg_cont->execute();
        $row_user = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC);         
        ?>
    <form method="POST" action="proc_edit_msg.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Nome:</label>
        <input type="name" name="name" class="form-control" value="<?php echo $row_user['name']; ?>"><br><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" class="form-control" value="<?php echo $row_user['email']; ?>"><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" class="form-control" value="<?php echo $row_user['cpf']; ?>"><br><br>

        <label for="dt_birth">Data de Nascimento:</label>
        <input type="date" name="dt_birth" class="form-control" value="<?php echo $row_user['dt_birth']; ?>"><br><br>

        <label for="gender">Gênero:</label>
        <select name="gender" class="form-control">
            <option value="Masculino" <?php if($row_user['gender'] == "Masculino") echo "selected"; ?>>Masculino</option>
            <option value="Feminino" <?php if($row_user['gender'] == "Feminino") echo "selected"; ?>>Feminino</option>
            <option value="Outro" <?php if($row_user['gender'] == "Outro") echo "selected"; ?>>Outro</option>
        </select><br><br>

        <label for="marital_status">Estado Civil:</label>
        <select name="marital_status" class="form-control">
            <option value="Solteiro(a)" <?php if($row_user['marital_status'] == "Solteiro(a)") echo "selected"; ?>>Solteiro(a)</option>
            <option value="Casado(a)" <?php if($row_user['marital_status'] == "Casado(a)") echo "selected"; ?>>Casado(a)</option>
            <option value="Divorciado(a)" <?php if($row_user['marital_status'] == "Divorciado(a)") echo "selected"; ?>>Divorciado(a)</option>
            <option value="Viúvo(a)" <?php if($row_user['marital_status'] == "Viúvo(a)") echo "selected"; ?>>Viúvo(a)</option>
        </select><br><br>        

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
            }elseif(isset($row_user['professional_experience'])){ echo $row_user['professional_experience']; } ?>"><br><br>

            <label>Pretensão salarial: </label>
            <input type="number" name="salary_claim" class="form-control" value="<?php if(isset($data['salary_claim'])){
                echo $data['salary_claim'];
            }elseif(isset($row_user['salary_claim'])){ echo $row_user['salary_claim']; } ?>"><br><br>  

            <div class="form-group">
                <input type="submit" name = "SendEditCont" class="btn btn-primary" value="Enviar">
            </div>    
        </form>
    </body>
</html>
