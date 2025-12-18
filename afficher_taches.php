<?php

require_once 'config.php';

// Récupérer les tâches du plus récent au plus ancien
$sql = "SELECT * FROM taches ORDER BY date_creation DESC";
$stmt = $pdo->query($sql);
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($taches) > 0) {
    foreach ($taches as $tache) {
        $date_creation = date('d/m/Y H:i', strtotime($tache['date_creation']));
        $date_modification = date('d/m/Y H:i', strtotime($tache['date_modification']));
        
        // Calcul du temps écoulé
        $now = new DateTime();
        $created = new DateTime($tache['date_creation']);
        
        
        
        echo '<div class="task-item">';
        echo '<div class="task-description">' . nl2br(htmlspecialchars($tache['description'])) . '</div>';
        echo '<div class="task-time">' . ' (créée le ' . $date_creation . ')</div>';
        
        echo '<div class="task-actions">';
        echo '<button class="btn edit-btn" onclick="modifierTache(' . $tache['id'] . ', \'' . addslashes($tache['description']) . '\')">Modifier</button>';
        echo '<button class="btn delete-btn" onclick="supprimerTache(' . $tache['id'] . ')">Supprimer</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="empty-tasks">';
    echo '📭 Aucune tâche pour le moment. Ajoutez votre première tâche !';
    echo '</div>';
}
?>