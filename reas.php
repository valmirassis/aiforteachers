<?php
require_once('header.php');
require_once('connection.php');
require_once 'vendor/autoload.php';
$Parsedown = new Parsedown();
 $Parsedown->setSafeMode(true); // evita HTML malicioso
?>

<div class="container mt-5">
    <h1> <i class="fas fa-file"></i> REAs Gerados</h1> <hr>
    <p>Selecione um tipo de REA para ver os REA gerados</p>
   <h3> <i class="fas fa-feather"></i> Histórico de criações</h3>
       <ul class="list-group">
        <?php
        // Agrupa pelo campo fk_type_rea_id e conta quantos REAs o usuário tem de cada tipo
        // Busca os tipos de REA dinamicamente da tabela type_rea
        $rea_types = [];
        $type_stmt = $conn->prepare("SELECT id, nome FROM type_rea");
        $type_stmt->execute();
        $type_result = $type_stmt->get_result();
        while ($type_row = $type_result->fetch_assoc()) {
            $rea_types[$type_row['id']] = $type_row['nome'];
        }
        $type_stmt->close();

        $stmt = $conn->prepare("SELECT fk_type_rea_id, COUNT(*) as total FROM rea GROUP BY fk_type_rea_id");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            echo '<div class="alert alert-info">Nenhum REA gerado ainda.</div>';
        }
        while ($row = $result->fetch_assoc()) {
            $type_name = $rea_types[$row['fk_type_rea_id']] ?? 'Tipo ' . $row['fk_type_rea_id'];
            ?>
            <li class="list-group-item"><a href="?rea=<?= htmlspecialchars($row['fk_type_rea_id']) ?>">
           <i class="fas fa-hashtag"></i>  <?= htmlspecialchars($type_name) ?> (<strong><?= $row['total'] ?></strong>)
            </a></li>
            <?php
        }
        ?>
    </ul>

<?php
if (isset($_GET['rea'])) {

    $rea = $_GET['rea'];
    if ($rea === '1') {
        // Exibe questões múltipla escolha
        $stmt = $conn->prepare("SELECT r.*, p.name FROM rea as r, person as p WHERE fk_type_rea_id = ? AND r.fk_person_id = p.id ORDER BY r.id DESC");
        $stmt->bind_param("s", $rea);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<hr>  <h4> <i class='fas fa-dice-four'></i> Questões Múltipla Escolha</h4>";
        echo '<div class="accordion" id="reaAccordion" style="margin-top: 20px;">';
        $index = 0;
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
            $collapseId = 'collapse' . $index;
            $headingId = 'heading' . $index;
            echo '<div class="card">';
            echo '<div class="card-header" id="' . $headingId . '">';
            echo '<h5 class="collapsed" data-toggle="collapse" data-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
            echo '<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> Criado por <b>' . htmlspecialchars($row['name']) . '</b> em <b>' . date('d/m/Y H:i:s', strtotime($row['created'])) . '</b>';
            echo '</h5>';
            echo '</div>';
            echo '<div id="' . $collapseId . '" class="collapse" aria-labelledby="' . $headingId . '" data-parent="#reaAccordion">';
            echo '<div class="card-body">';
            echo '<article>' . $Parsedown->text($row['content']) . '</article>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $index++;
             }
    } else {
            echo '<div class="alert alert-danger">Sem REAs gerados.</div>';
        }
        echo '</div>';
// ##########################################################
    } else if ($rea == 2) {
         // conversão de áudio em texto
        $stmt = $conn->prepare("SELECT r.*, p.name FROM rea as r, person as p WHERE fk_type_rea_id = ? AND r.fk_person_id = p.id ORDER BY r.id DESC");
        $stmt->bind_param("s", $rea);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<hr>  <h4> <i class='fas fa-dice-four'></i> Transcrições de áudio em texto</h4>";

        echo '<div class="accordion" id="reaAccordion" style="margin-top: 20px;">';
        $index = 0;
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
            $collapseId = 'collapse' . $index;
            $headingId = 'heading' . $index;
            echo '<div class="card">';
            echo '<div class="card-header" id="' . $headingId . '">';
            echo '<h5 class="collapsed" data-toggle="collapse" data-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
            echo '<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> Criado por <b>' . htmlspecialchars($row['name']) . '</b> em <b>' . date('d/m/Y H:i:s', strtotime($row['created'])) . '</b>';
            echo '</h5>';
            echo '</div>';
            echo '<div id="' . $collapseId . '" class="collapse" aria-labelledby="' . $headingId . '" data-parent="#reaAccordion">';
            echo '<div class="card-body">';
            $json = json_decode($row['content'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
                $lang = $json['result']['language'] ?? '-';
                $text = $json['result']['text'] ?? '';
                $uploaded_file_path = $json['result']['uploaded_file_path'] ?? '';
                $segments = $json['result']['segments'] ?? [];
                ?>
                <b>Resultado da transcrição</b>
                
                    <p><strong>Idioma detectado:</strong> <?=htmlspecialchars($lang ?? '-')?></p>
                          <div class="code p-2 bg-dark text-white rounded"><?=htmlspecialchars($text ?? '')?></div>
                   
                        <?php if (!empty($segments) && is_array($segments)): ?>
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-striped segments-table">
                            <thead>
                                <tr><th>#</th><th>Texto separado por frases</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($segments as $i => $seg): ?>
                                <tr>
                                <td><?=($i+1)?></td>
                                <td><?=htmlspecialchars(is_array($seg) ? ($seg['text'] ?? '') : $seg)?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                     <b>Arquivo enviado:</b><audio controls class="w-100" src="<?=htmlspecialchars($uploaded_file_path)?>"></audio>
                <?php
            } 
            echo '</div>';
                echo '</div>';
                echo '</div>';
                $index++;
            }
        } else {
                echo '<div class="alert alert-danger">Sem transcrições geradas.</div>';
            } 
         
echo '</div>';
// ##########################################################
    } else if ($rea == 3) {
        // Conversão de texto em áudio
        $stmt = $conn->prepare("SELECT r.*, p.name FROM rea as r, person as p WHERE fk_type_rea_id = ? AND r.fk_person_id = p.id ORDER BY r.id DESC");
        $stmt->bind_param("s", $rea);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<hr> <h4> <i class='fas fa-dice-four'></i> Conversões de texto em áudio </h4>";
        echo '<div class="accordion" id="reaAccordion" style="margin-top: 20px;">';
        $index = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $collapseId = 'collapse' . $index;
                $headingId = 'heading' . $index;
                echo '<div class="card">';
                echo '<div class="card-header" id="' . $headingId . '">';
                echo '<h5 class="collapsed" data-toggle="collapse" data-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
                echo '<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> Criado por <b>' . htmlspecialchars($row['name']) . '</b> em <b>' . date('d/m/Y H:i:s', strtotime($row['created'])) . '</b>';
                echo '</h5>';
                echo '</div>';
                echo '<div id="' . $collapseId . '" class="collapse" aria-labelledby="' . $headingId . '" data-parent="#reaAccordion">';
                echo '<div class="card-body">';
                $parts = explode('|', $row['content'], 2);
                $nameRea = explode("/", $parts[0]);
                ?>
                <b>Resultado da conversão em áudio</b>
                <audio controls class="w-100" src="<?=htmlspecialchars($parts[0])?>"></audio>
                    <div class="mt-2">
                    <a class="btn btn-outline-secondary" href="<?=htmlspecialchars($parts[0])?>" download="<?=htmlspecialchars($nameRea[2])?>">Baixar arquivo</a>
                </div>
                <b>Texto original:</b>
                <div class="mt-2">
                    <?=htmlspecialchars($parts[1] ?? '')?>
                </div>
                <?php
                echo '</div>';
                echo '</div>';
                echo '</div>';
                $index++;
            }
        } else {
            echo '<div class="alert alert-danger">Sem conversões de áudio geradas.</div>';
        }
        echo '</div>';
    } else if ($rea === '4') {
        // Exibe questões múltipla escolha
        $stmt = $conn->prepare("SELECT r.*, p.name FROM rea as r, person as p WHERE fk_type_rea_id = ? AND r.fk_person_id = p.id ORDER BY r.id DESC");
        $stmt->bind_param("s", $rea);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<hr>  <h4> <i class='fas fa-dice-four'></i> Atividades</h4>";
        echo '<div class="accordion" id="reaAccordion" style="margin-top: 20px;">';
        $index = 0;
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
            $collapseId = 'collapse' . $index;
            $headingId = 'heading' . $index;
            echo '<div class="card">';
            echo '<div class="card-header" id="' . $headingId . '">';
            echo '<h5 class="collapsed" data-toggle="collapse" data-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
            echo '<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> Criado por <b>' . htmlspecialchars($row['name']) . '</b> em <b>' . date('d/m/Y H:i:s', strtotime($row['created'])) . '</b>';
            echo '</h5>';
            echo '</div>';
            echo '<div id="' . $collapseId . '" class="collapse" aria-labelledby="' . $headingId . '" data-parent="#reaAccordion">';
            echo '<div class="card-body">';
            // echo '<article>' . $Parsedown->text($row['content']) . '</article>';
            $json = json_decode($row['content'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
               $tipo = $json['tipo'] ?? '-';
                $tema = $json['tema'] ?? '';
                $atividade = $json['atividade'] ?? '';
            }
            $types = [
                'A' => 'Estudo de caso',
                'B' => 'Quadro comparativo',
                'C' => 'Questões discursivas',
                'D' => 'Mapa mental'
            ];
            echo '<p><strong>Tipo de atividade:</strong> '.htmlspecialchars($types[$tipo] ?? $tipo);
            echo ' <strong>Tema:</strong> '.htmlspecialchars($tema).'</p>';
            echo '<h5>Atividade gerada:</h5>';
            $atividade = $Parsedown->text($atividade);
            $atividade = preg_replace('/<table>/', "<table class='table table-striped'>", $atividade);
            echo '<article>' . $atividade . '</article>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $index++;
             }
    } else {
            echo '<div class="alert alert-danger">Sem REAs gerados.</div>';
        }
        echo '</div>';
// ##########################################################
    } else if ($rea === '5') {
        // Exibe questões múltipla escolha
        $stmt = $conn->prepare("SELECT r.*, p.name FROM rea as r, person as p WHERE fk_type_rea_id = ? AND r.fk_person_id = p.id ORDER BY r.id DESC");
        $stmt->bind_param("s", $rea);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<hr>  <h4> <i class='fas fa-dice-four'></i> Roteiros</h4>";
        echo '<div class="accordion" id="reaAccordion" style="margin-top: 20px;">';
        $index = 0;
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
            $collapseId = 'collapse' . $index;
            $headingId = 'heading' . $index;
            echo '<div class="card">';
            echo '<div class="card-header" id="' . $headingId . '">';
            echo '<h5 class="collapsed" data-toggle="collapse" data-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
            echo '<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> Criado por <b>' . htmlspecialchars($row['name']) . '</b> em <b>' . date('d/m/Y H:i:s', strtotime($row['created'])) . '</b>';
            echo '</h5>';
            echo '</div>';
            echo '<div id="' . $collapseId . '" class="collapse" aria-labelledby="' . $headingId . '" data-parent="#reaAccordion">';
            echo '<div class="card-body">';
            // echo '<article>' . $Parsedown->text($row['content']) . '</article>';
           $json = json_decode($row['content'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
               $tipo = $json['tipo'] ?? '-';
                $tema = $json['tema'] ?? '';
                $roteiro = $json['roteiro'] ?? '';
            }
            $types = [
                'A' => 'Apresentação de slides',
                'B' => 'Aula',
                'C' => 'Vídeo aula',

            ];
            echo '<p><strong>Tipo de roteiro:</strong> '.htmlspecialchars($types[$tipo] ?? $tipo);
            echo ' <strong>Tema:</strong> '.htmlspecialchars($tema).'</p>';
            echo '<h5>Roteiro gerado:</h5>';
            $roteiro = $Parsedown->text($roteiro);
            $roteiro = preg_replace('/<table>/', "<table class='table table-striped'>", $roteiro);
            echo '<article>' . $roteiro . '</article>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $index++;
             }
    } else {
            echo '<div class="alert alert-danger">Sem REAs gerados.</div>';
        }
        echo '</div>';
// ##########################################################
    } else if ($rea === '6') {
        // Exibe questões múltipla escolha
        $stmt = $conn->prepare("SELECT r.*, p.name FROM rea as r, person as p WHERE fk_type_rea_id = ? AND r.fk_person_id = p.id ORDER BY r.id DESC");
        $stmt->bind_param("s", $rea);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<hr>  <h4> <i class='fas fa-dice-four'></i> Descrições</h4>";
        echo '<div class="accordion" id="reaAccordion" style="margin-top: 20px;">';
        $index = 0;
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
            $collapseId = 'collapse' . $index;
            $headingId = 'heading' . $index;
            echo '<div class="card">';
            echo '<div class="card-header" id="' . $headingId . '">';
            echo '<h5 class="collapsed" data-toggle="collapse" data-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
            echo '<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> Criado por <b>' . htmlspecialchars($row['name']) . '</b> em <b>' . date('d/m/Y H:i:s', strtotime($row['created'])) . '</b>';
            echo '</h5>';
            echo '</div>';
            echo '<div id="' . $collapseId . '" class="collapse" aria-labelledby="' . $headingId . '" data-parent="#reaAccordion">';
            echo '<div class="card-body">';
            // echo '<article>' . $Parsedown->text($row['content']) . '</article>';
           $json = json_decode($row['content'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
                $desc = $json['descricao'] ?? [];
               $tags = $desc['tags'] ?? '-';
                if (is_array($tags)) {
                $tags = implode(', ', $tags);
                 }
               $alt = $desc['alt_text'] ?? '';
                $long = $desc['descricao_longa'] ?? '';
                $ocr = $desc['texto_detectado'] ?? '';
                $nameImage = $json['imagem'] ?? '';
                $qalt = strlen($alt);
                $qlong = strlen($long);

            }
                 echo '<article class="resultado-md"> <b>Tags: </b> '.$tags.'</article>';
        echo '<article class="resultado-md"> <b>Texto alternativo ('.$qalt.'): </b> '.$alt.'</article>';
        echo '<article class="resultado-md"> <b>Descrição longa ('.$qlong.'): </b> '.$long.'</article>';
        if (!empty($ocr)) {
            echo '<article class="resultado-md"><strong>Texto detectado na imagem:</strong><br>'.$ocr.'</article>';
        }
        echo '<article class="resultado-md"><strong>Imagem enviada:</strong><br><img src="services/uploads/img/'.$nameImage.'" alt="Imagem enviada" style="max-width:100%;height:auto;"></article>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $index++;
             }
    } else {
            echo '<div class="alert alert-danger">Sem REAs gerados.</div>';
        }
        echo '</div>';
// ##########################################################
    } else if ($rea === '7')  {
        // Exibe Roteiros
        $stmt = $conn->prepare("SELECT r.*, p.name FROM rea as r, person as p WHERE fk_type_rea_id = ? AND r.fk_person_id = p.id ORDER BY r.id DESC");
        $stmt->bind_param("s", $rea);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<hr>  <h4> <i class='fas fa-dice-four'></i> Transformações</h4>";
        echo '<div class="accordion" id="reaAccordion" style="margin-top: 20px;">';
        $index = 0;
        if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
            $json = json_decode($row['content'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
               $tipo = $json['tipo'] ?? '-';
                $texto = $json['texto'] ?? '';
                $info="";
                if ($tipo === 'B' ) {
                    $info =  '<strong>Tom:</strong> '.htmlspecialchars($json['tom'] ?? '-');
                } elseif ($tipo === 'C' || $tipo === 'CPDF' || $tipo === 'F') {
                    $info =  ' <strong>Formato:</strong> '.htmlspecialchars($json['formato'] ?? '-');
                } elseif ($tipo === 'C' || $tipo === 'CPDF') {
                    $info =  ' <strong>Formato:</strong> '.htmlspecialchars($json['formato'] ?? '-');
                }
            }
            $types = [
                'A' => 'Tradução',
                'B' => 'Reescrita',
                'C' => 'Resumo',
                'D' => 'Revisão/correção',
                'E' => 'Expansão',
                'F' => 'Criação',
                'CPDF' => 'Resumo de PDF'

            ];
            $collapseId = 'collapse' . $index;
            $headingId = 'heading' . $index;
            echo '<div class="card">';
            echo '<div class="card-header" id="' . $headingId . '">';
            echo '<h5 class="collapsed" data-toggle="collapse" data-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
            echo '<i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> <b>' . htmlspecialchars($types[$tipo] ?? $tipo) . ':</b> criado  <b>' . htmlspecialchars($row['name']) . '</b> em <b>' . date('d/m/Y H:i:s', strtotime($row['created'])) . '</b>';
            echo '</h5>';
            echo '</div>';
            echo '<div id="' . $collapseId . '" class="collapse" aria-labelledby="' . $headingId . '" data-parent="#reaAccordion">';
            echo '<div class="card-body">';
      
            
            
            echo '<p><strong>Tipo de transformação:</strong> '.htmlspecialchars($types[$tipo] ?? $tipo);
            echo $info.'</p>';
            echo '<h5>Texto gerado:</h5>';
            $texto = $Parsedown->text($texto);
            $texto = preg_replace('/<table>/', "<table class='table table-striped'>", $texto);
            echo '<article>' . $texto . '</article>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $index++;
             }
    } else {
            echo '<div class="alert alert-danger">Sem REAs gerados.</div>';
        }
        echo '</div>';
// ##########################################################
    }else {
        echo '<div class="alert alert-danger">Sem REAs gerados.</div>';
    }
}

?>

</div>
<?php require_once('footer.php'); ?>