-- Script d'export de la base de données CRM BhConnect
-- Généré automatiquement pour Supabase

-- Export des données des utilisateurs
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES
(1, 'Admin', 'admin@example.com', '2025-01-01 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'token123', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 'Utilisateur Test', 'user@example.com', '2025-01-01 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'token456', '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- Export des données des clients
INSERT INTO clients (id, name, email, phone, address, company, created_at, updated_at) VALUES
(1, 'Client Test 1', 'client1@example.com', '+1234567890', '123 Rue Test, Ville', 'Entreprise Test 1', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 'Client Test 2', 'client2@example.com', '+0987654321', '456 Avenue Test, Ville', 'Entreprise Test 2', '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- Export des données des rendez-vous
INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES
(1, 1, 'Rendez-vous Test 1', 'Description du rendez-vous test 1', '2025-01-15 10:00:00', 'scheduled', 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 2, 'Rendez-vous Test 2', 'Description du rendez-vous test 2', '2025-01-20 14:30:00', 'scheduled', 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- Export des données des tâches
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES
(1, 'Tâche Test 1', 'Description de la tâche test 1', 'pending', 'high', '2025-01-10 00:00:00', 1, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 'Tâche Test 2', 'Description de la tâche test 2', 'in_progress', 'medium', '2025-01-15 00:00:00', 2, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00');

-- Export des données des objectifs de performance
INSERT INTO performance_objectives (id, objective_type, target_value, current_value, period, start_date, end_date, is_active, user_id, created_at, updated_at) VALUES
(1, 'clients_acquired', 100, 25, 'monthly', '2025-01-01', '2025-12-31', true, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(2, 'appointments_scheduled', 50, 12, 'monthly', '2025-01-01', '2025-12-31', true, 1, '2025-01-01 00:00:00', '2025-01-01 00:00:00');
