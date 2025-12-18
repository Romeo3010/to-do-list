<?php
// fichier: index.php
require_once 'config.php';

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id_tache = $_POST['id_tache'] ?? null;
    
    if ($action === 'ajouter') {
        $message = ajouter_tache($pdo);
    } elseif ($action === 'modifier' && $id_tache) {
        $message = modifier_tache($pdo, $id_tache);
    } elseif ($action === 'supprimer' && $id_tache) {
        $message = supprimer_tache($pdo, $id_tache);
    }
    
    // Redirection avec message
    header('Location: indexs.php?message=' . urlencode($message));
    exit();
}

function ajouter_tache($pdo) {
    $description = trim($_POST['description'] ?? '');
    
    if (!empty($description)) {
        $sql = "INSERT INTO taches (description) VALUES (:description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':description' => $description]);
        return 'Tâche ajoutée avec succès!';
    }
    return 'La description ne peut pas être vide.';
}

function modifier_tache($pdo, $id) {
    $description = trim($_POST['description'] ?? '');
    
    if (!empty($description)) {
        $sql = "UPDATE taches SET description = :description WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':description' => $description,
            ':id' => $id
        ]);
        return 'Tâche modifiée avec succès!';
    }
    return 'La description ne peut pas être vide.';
}

function supprimer_tache($pdo, $id) {
    $sql = "DELETE FROM taches WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return 'Tâche supprimée avec succès!';
}
?>