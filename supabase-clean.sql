-- Import propre pour Supabase - CRM BhConnect
-- Généré le 2025-10-01 09:35:11

-- Utilisateurs
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES (1, 'Admin', 'admin@example.com', NULL, '$2y$10$U1Bpq0/7mWL1ZSgsrUTvHuFPYSGitwDnNUotLKUu8.dyPlaDp5YVm', 'admin', 'jRCWXYjcUf', '2025-09-27 09:25:34', '2025-10-01 09:06:31');
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES (2, 'Employe Test', 'employee@example.com', NULL, '$2y$10$2OOOHq/QEAiTP6H2XdBHguIlB/75RpXy/a1t86GLBpRRI.AvzH5Nu', 'employee', NULL, '2025-09-28 04:24:05', '2025-09-28 04:24:05');
INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES (3, 'cecile', 'cecile@bh.com', NULL, '$2y$10$8.bC2sOQ0MijxIcU74kfG.N29OIRDCmpowBx2.aBt7v9JjNzbq3Va', 'employee', NULL, '2025-09-28 04:26:24', '2025-09-30 12:36:40');

-- Clients
INSERT INTO clients (id, first_name, last_name, age, revenue, assigned_user_id, status, created_at, updated_at) VALUES (2, 'gnfbfg', 'dhtsht', 20, 25000.00, NULL, 'prospect', '2025-09-28 04:34:36', '2025-09-28 05:05:31');

-- Rendez-vous
INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES (1, 2, '2025-10-04 06:34:00', 'test', 'test............................', 'planned', 'approved', 1, '2025-09-28 04:35:08', '2025-09-30 13:08:50');
INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES (2, 2, '2025-09-28 06:44:00', 'fdshdrrhdst', 'htdhry', 'planned', 'approved', 1, '2025-09-28 04:43:53', '2025-09-30 13:08:50');
INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES (3, 2, '2025-10-01 14:37:00', 'visa france', 'ihwdjkl', 'planned', 'approved', 3, '2025-09-30 12:38:35', '2025-09-30 13:10:31');
INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES (4, 2, '2025-10-01 09:00:00', 'Reunion de presentation', 'Presentation du nouveau produit a notre client', 'planned', 'rescheduled', 2, '2025-09-30 13:09:31', '2025-09-30 13:12:31');
INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES (5, 2, '2025-10-02 14:30:00', 'Negociation contrat', 'Discussion des termes du nouveau contrat', 'planned', 'pending', 2, '2025-09-30 13:09:31', '2025-09-30 13:09:31');
INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES (6, 2, '2025-10-03 10:00:00', 'Suivi projet', 'Point sur l avancement du projet en cours', 'planned', 'approved', 2, '2025-09-30 13:09:31', '2025-09-30 13:10:41');

-- Tâches
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (1, 'Appeler le client pour confirmer le RDV', 'Contacter le client pour confirmer le rendez-vous de demain et s assurer qu il est toujours disponible.', 'pending', 'high', '2025-10-01 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (2, 'Preparer la presentation du nouveau produit', 'Creer une presentation PowerPoint pour le nouveau produit a presenter lors de la reunion de vendredi.', 'in_progress', 'medium', '2025-10-03 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (3, 'Mettre a jour la base de donnees clients', 'Verifier et mettre a jour les informations de contact des clients dans la base de donnees.', 'pending', 'low', '2025-10-07 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (4, 'Analyser les performances du trimestre', 'Analyser les donnees de vente du trimestre et preparer un rapport pour la direction.', 'pending', 'urgent', '2025-10-02 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (5, 'Organiser la formation equipe', 'Planifier et organiser une session de formation pour l equipe sur les nouvelles procedures.', 'completed', 'medium', '2025-09-29 00:00:00', 2, , '2025-09-30 13:32:07', '2025-09-30 13:32:07');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (6, 'wdgyjtukhghj', 'wgtjgl', 'pending', 'urgent', '2025-10-04 00:00:00', 3, , '2025-09-30 13:35:17', '2025-09-30 13:35:17');
INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES (7, 'hbibyigh', 'ljnjlnjllhu', 'completed', 'high', '2025-10-01 00:00:00', 3, , '2025-09-30 13:37:08', '2025-09-30 13:38:47');

