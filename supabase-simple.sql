-- Import simple pour Supabase - CRM BhConnect
-- Ce fichier ne contient que les données essentielles

-- D'abord, exécuter les migrations Laravel pour créer les tables
-- Puis exécuter ce fichier pour ajouter les données

-- Utilisateurs
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES
(1, 'Admin', 'admin@example.com', '2025-01-01 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'token123', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 'Utilisateur Test', 'user@example.com', '2025-01-01 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'token456', '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- Clients
INSERT INTO clients (id, first_name, last_name, age, revenue, assigned_user_id, status, created_at, updated_at) VALUES
(1, 'Jean', 'Dupont', 35, 50000, 1, 'active', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 'Marie', 'Martin', 28, 45000, 1, 'active', '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- Rendez-vous
INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES
(1, 1, '2025-01-15 10:00:00', 'Rendez-vous Test 1', 'Description du rendez-vous test 1', 'scheduled', 'pending', 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 2, '2025-01-20 14:30:00', 'Rendez-vous Test 2', 'Description du rendez-vous test 2', 'scheduled', 'pending', 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- Tâches
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES
(1, 'Tâche Test 1', 'Description de la tâche test 1', 'pending', 'high', '2025-01-10 00:00:00', 1, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 'Tâche Test 2', 'Description de la tâche test 2', 'in_progress', 'medium', '2025-01-15 00:00:00', 2, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00');
