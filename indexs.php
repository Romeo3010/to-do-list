<?php 
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Gestion des Tâches</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.5;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background-color: #3a6ea5;
            color: white;
            padding: 30px 25px;
        }
        
        .header h2 {
            font-size: 24px;
            margin-bottom: 8px;
            animation: defilement 15s linear infinite;
            text-align: center;
        }
        
        @keyframes defilement {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .content {
            padding: 25px;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 20px;
            color: #3a6ea5;
            margin-bottom: 15px;
            font-weight: bold;
        }
        
        .new-task-form {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 20px;
            border: 1px solid #e0e0e0;
        }
        
        .form-row {
            margin-bottom: 15px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
            font-size: 15px;
        }
        
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        .add-btn {
            background-color: #3a6ea5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 5px;
        }
        
        .task-list {
            margin-top: 10px;
        }
        
        .task-item {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
            font-size: 16px;
        }
        
        .task-description {
            margin-bottom: 5px;
            color: #333;
            line-height: 1.5;
        }
        
        .task-time {
            color: #777;
            font-size: 14px;
            margin-top: 8px;
        }
        
        .task-actions {
            position: absolute;
            right: 15px;
            top: 15px;
        }
        
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            font-size: 13px;
            cursor: pointer;
            margin-left: 5px;
        }
        
        .edit-btn {
            background-color: #f0f0f0;
            color: #555;
        }
        
        .delete-btn {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .task-item:nth-child(1) .task-time {
            color: #3a6ea5;
        }
        
        .task-item:nth-child(2) .task-time {
            color: #d89b2e;
        }
        
        .task-item:nth-child(3) .task-time {
            color: #777;
        }
        
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
        }
        
        .message-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .empty-tasks {
            text-align: center;
            padding: 30px;
            color: #777;
            font-style: italic;
        }
        
        .hidden {
            display: none;
        }
        
        .cancel-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 5px;
            margin-left: 10px;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
        }
        
        @media (max-width: 600px) {
            .container {
                border-radius: 0;
            }
            
            .content {
                padding: 15px;
            }
            
            .task-actions {
                position: static;
                margin-top: 10px;
                text-align: right;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>BONJOUR !Je vous souhaite une bonne gestion de vos tâches😎</h2>
        </div>  
        
        <div class="content">
            
            <div class="section">
                <h2 class="section-title">Nouvelle tâche</h2>
                <form action="index.php" method="POST" class="new-task-form" id="task-form">
                    <div class="form-row">
                        <label class="form-label">Description de la tâche</label>
                        <textarea name="description" id="description" placeholder="Entrez la description de votre tâche ici..." required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="add-btn" id="submit-btn">Ajouter</button>
                        <button type="button" class="cancel-btn hidden" id="cancel-btn">Annuler</button>
                    </div>
                    <input type="hidden" name="action" id="action" value="ajouter">
                    <input type="hidden" name="id_tache" id="id_tache" value="">
                </form>
            </div>
            
            <div class="section">
                <h2 class="section-title">Vos tâches</h2>
                <div class="task-list" id="task-list">
                    <?php

include'afficher_taches.php';

?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour modifier une tâche
        function modifierTache(id, description) {
            document.getElementById('description').value = description;
            document.getElementById('id_tache').value = id;
            document.getElementById('action').value = 'modifier';
            document.getElementById('submit-btn').textContent = 'Modifier';
            document.getElementById('cancel-btn').classList.remove('hidden');
            
            // Faire défiler vers le formulaire
            document.getElementById('description').focus();
        }
        
        // Fonction pour supprimer une tâche
        function supprimerTache(id) {
            if (confirm('Voulez-vous vraiment supprimer cette tâche ?')) {
                document.getElementById('id_tache').value = id;
                document.getElementById('action').value = 'supprimer';
                document.getElementById('task-form').submit();
            }
        }
        
        // Annuler la modification
        document.getElementById('cancel-btn').addEventListener('click', function() {
            resetForm();
        });
        
        // Réinitialiser le formulaire
        function resetForm() {
            document.getElementById('task-form').reset();
            document.getElementById('id_tache').value = '';
            document.getElementById('action').value = 'ajouter';
            document.getElementById('submit-btn').textContent = 'Ajouter';
            document.getElementById('cancel-btn').classList.add('hidden');
        }
        
        // Vérifier si on vient d'ajouter une tâche pour réinitialiser le formulaire
        window.onload = function() {
            if (window.location.search.includes('message=')) {
                resetForm();
            }
        };
    </script>
</body>
</html>