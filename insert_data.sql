-- Insertion de données dans la table clients
INSERT INTO clients (firstname, lastname, sex, age, email) VALUES
('Zeinab', 'Salifou', 'Female', 26, 'zeinabsali@gmail.com'),
('Kouassi', 'Koffi', 'Male', 30, 'kouassi.koffi@uqtr.ca'),
('Dion', 'Marlene', 'Female', 23, 'dionmarlene@uqtr.ca'),
('Jules', 'Trudel', 'Male', 40, 'jules.trud@uqtr.ca');

-- Insertion de données dans la table activities
INSERT INTO activities (name, description, season) VALUES
('Football', 'Outdoor team sport', 'fall'),
('Skiing', 'Winter mountain sport', 'winter'),
('Swimming', 'Water-based activity', 'summer');

-- Insertion de données dans la table subscriptions
INSERT INTO subscriptions (client_id, activity_id, date) VALUES
(1, 1, '2024-11-20'),
(2, 2, '2024-11-21'),
(3, 3, '2024-12-15'),
(4, 1, '2024-12-16');
