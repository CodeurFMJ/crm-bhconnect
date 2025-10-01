-- Export corrigé des données CRM BhConnect pour Supabase
-- Généré le 2025-10-01 09:28:44

-- Utilisateurs
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES (1, 'Admin', 'admin@example.com', NULL, '$2y$10$U1Bpq0/7mWL1ZSgsrUTvHuFPYSGitwDnNUotLKUu8.dyPlaDp5YVm', 'admin', 'jRCWXYjcUf', '2025-09-27 09:25:34', '2025-10-01 09:06:31');
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES (2, 'Employé Test', 'employee@example.com', NULL, '$2y$10$2OOOHq/QEAiTP6H2XdBHguIlB/75RpXy/a1t86GLBpRRI.AvzH5Nu', 'employee', NULL, '2025-09-28 04:24:05', '2025-09-28 04:24:05');
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES (3, 'cecile', 'cecile@bh.com', NULL, '$2y$10$8.bC2sOQ0MijxIcU74kfG.N29OIRDCmpowBx2.aBt7v9JjNzbq3Va', 'employee', NULL, '2025-09-28 04:26:24', '2025-09-30 12:36:40');

-- Clients
INSERT INTO clients (id, name, email, phone, address, company, created_at, updated_at) VALUES (2, '', '', '', '', '', '2025-09-28 04:34:36', '2025-09-28 05:05:31');

-- Rendez-vous
INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES (1, 2, '', '', '', 'planned', 1, '2025-09-28 04:35:08', '2025-09-30 13:08:50');
INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES (2, 2, '', '', '', 'planned', 1, '2025-09-28 04:43:53', '2025-09-30 13:08:50');
INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES (3, 2, '', '', '', 'planned', 3, '2025-09-30 12:38:35', '2025-09-30 13:10:31');
INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES (4, 2, '', '', '', 'planned', 2, '2025-09-30 13:09:31', '2025-09-30 13:12:31');
INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES (5, 2, '', '', '', 'planned', 2, '2025-09-30 13:09:31', '2025-09-30 13:09:31');
INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES (6, 2, '', '', '', 'planned', 2, '2025-09-30 13:09:31', '2025-09-30 13:10:41');

-- Tâches
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (1, 'Appeler le client pour confirmer le RDV', 'Contacter le client pour confirmer le rendez-vous de demain et s\'assurer qu\'il est toujours disponible.', 'pending', 'high', '2025-10-01 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (2, 'Préparer la présentation du nouveau produit', 'Créer une présentation PowerPoint pour le nouveau produit à présenter lors de la réunion de vendredi.', 'in_progress', 'medium', '2025-10-03 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (3, 'Mettre à jour la base de données clients', 'Vérifier et mettre à jour les informations de contact des clients dans la base de données.', 'pending', 'low', '2025-10-07 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (4, 'Analyser les performances du trimestre', 'Analyser les données de vente du trimestre et préparer un rapport pour la direction.', 'pending', 'urgent', '2025-10-02 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (5, 'Organiser la formation équipe', 'Planifier et organiser une session de formation pour l\'équipe sur les nouvelles procédures.', 'completed', 'medium', '2025-09-29 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (6, 'wdgyjtukhghj', 'wgtjgl', 'pending', 'urgent', '2025-10-04 00:00:00', 3, , '2025-09-30 13:35:17', '2025-09-30 13:35:17');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (7, 'hbibyigh', 'ljnjlnjllhu', 'completed', 'high', '2025-10-01 00:00:00', 3, , '2025-09-30 13:37:08', '2025-09-30 13:38:47');

