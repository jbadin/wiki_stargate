-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 22 mars 2026 à 12:52
-- Version du serveur : 8.0.45-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gc5dx_wiki-stargate`
--

-- --------------------------------------------------------

--
-- Structure de la table `gc5dx_episodes`
--

CREATE TABLE `gc5dx_episodes` (
  `id` int NOT NULL,
  `number` int NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `original_air_date` date NOT NULL,
  `synopsis` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_two_parts` tinyint(1) NOT NULL,
  `part` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id_seasons` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gc5dx_parted_episodes`
--

CREATE TABLE `gc5dx_parted_episodes` (
  `id_part_one` int NOT NULL,
  `id_part_two` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gc5dx_planets`
--

CREATE TABLE `gc5dx_planets` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `designation` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `galaxy` enum('Voie Lactée','Pégase') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Habitable','Inhabitable','Détruite','Inconnu') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `explored` tinyint NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gc5dx_races`
--

CREATE TABLE `gc5dx_races` (
  `id` int NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `alignement` enum('Allié','Ennemi','Neutre') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `threat_level` int NOT NULL,
  `is_extinct` tinyint(1) NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id_origin_planets` int NOT NULL,
  `id_episodes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gc5dx_seasons`
--

CREATE TABLE `gc5dx_seasons` (
  `id` int NOT NULL,
  `year` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id_series` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gc5dx_series`
--

CREATE TABLE `gc5dx_series` (
  `id` int NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `short_name` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_year` int NOT NULL,
  `end_year` int DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gc5dx_series`
--

INSERT INTO `gc5dx_series` (`id`, `name`, `short_name`, `start_year`, `end_year`, `img`, `description`, `created_at`, `updated_at`) VALUES
(3, 'fffffffffffff', 'fff', 1997, 2007, '/series_img/fff_69beac4cdd124.png', 'eeee', '2026-03-21 15:33:48', '2026-03-21 15:33:48'),
(4, 'Stargate SG-1', 'SG-1', 1997, 2007, '/series_img/sg-1_69beb8bbebb24.png', 'Stargate SG-1 est une série de science-fiction qui suit une équipe militaire chargée d’explorer la galaxie grâce à une porte des étoiles, un ancien dispositif permettant de voyager instantanément entre différentes planètes. L’équipe SG-1, composée du colonel Jack O’Neill, du scientifique Daniel Jackson, de l’officier Samantha Carter et de l’extraterrestre Teal’c, parcourt de nouveaux mondes, rencontre des civilisations variées et affronte des ennemis puissants comme les Goa’uld, des parasites se faisant passer pour des dieux. Au fil des missions, la série mêle action, humour et réflexion autour de la science, de la politique et des mythologies.', '2026-03-21 16:26:51', '2026-03-21 16:26:51'),
(5, 'Stargate Atlantis', 'SgA', 1999, 2522, '/series_img/sga_69bec0137bcf7.png', 'kudhkhdike', '2026-03-21 16:58:11', '2026-03-21 16:58:11');

-- --------------------------------------------------------

--
-- Structure de la table `gc5dx_ships`
--

CREATE TABLE `gc5dx_ships` (
  `id` int NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `crew_capacity` int NOT NULL,
  `is_destroyed` tinyint(1) NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_races` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `gc5dx_episodes`
--
ALTER TABLE `gc5dx_episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episodes_id_seasons_FK` (`id_seasons`);

--
-- Index pour la table `gc5dx_parted_episodes`
--
ALTER TABLE `gc5dx_parted_episodes`
  ADD PRIMARY KEY (`id_part_one`,`id_part_two`),
  ADD KEY `parted_episodes_part_two_FK` (`id_part_two`);

--
-- Index pour la table `gc5dx_planets`
--
ALTER TABLE `gc5dx_planets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gc5dx_races`
--
ALTER TABLE `gc5dx_races`
  ADD PRIMARY KEY (`id`),
  ADD KEY `races_id_planets_FK` (`id_origin_planets`),
  ADD KEY `races_id_episodes_FK` (`id_episodes`);

--
-- Index pour la table `gc5dx_seasons`
--
ALTER TABLE `gc5dx_seasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seasons_id_series_FK` (`id_series`);

--
-- Index pour la table `gc5dx_series`
--
ALTER TABLE `gc5dx_series`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gc5dx_ships`
--
ALTER TABLE `gc5dx_ships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ships_id_races_FK` (`id_races`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `gc5dx_episodes`
--
ALTER TABLE `gc5dx_episodes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gc5dx_planets`
--
ALTER TABLE `gc5dx_planets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gc5dx_races`
--
ALTER TABLE `gc5dx_races`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gc5dx_seasons`
--
ALTER TABLE `gc5dx_seasons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gc5dx_series`
--
ALTER TABLE `gc5dx_series`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `gc5dx_ships`
--
ALTER TABLE `gc5dx_ships`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gc5dx_episodes`
--
ALTER TABLE `gc5dx_episodes`
  ADD CONSTRAINT `episodes_id_seasons_FK` FOREIGN KEY (`id_seasons`) REFERENCES `gc5dx_seasons` (`id`);

--
-- Contraintes pour la table `gc5dx_parted_episodes`
--
ALTER TABLE `gc5dx_parted_episodes`
  ADD CONSTRAINT `parted_episodes_part_one_FK` FOREIGN KEY (`id_part_one`) REFERENCES `gc5dx_episodes` (`id`),
  ADD CONSTRAINT `parted_episodes_part_two_FK` FOREIGN KEY (`id_part_two`) REFERENCES `gc5dx_episodes` (`id`);

--
-- Contraintes pour la table `gc5dx_races`
--
ALTER TABLE `gc5dx_races`
  ADD CONSTRAINT `races_id_episodes_FK` FOREIGN KEY (`id_episodes`) REFERENCES `gc5dx_episodes` (`id`),
  ADD CONSTRAINT `races_id_planets_FK` FOREIGN KEY (`id_origin_planets`) REFERENCES `gc5dx_planets` (`id`);

--
-- Contraintes pour la table `gc5dx_seasons`
--
ALTER TABLE `gc5dx_seasons`
  ADD CONSTRAINT `seasons_id_series_FK` FOREIGN KEY (`id_series`) REFERENCES `gc5dx_series` (`id`);

--
-- Contraintes pour la table `gc5dx_ships`
--
ALTER TABLE `gc5dx_ships`
  ADD CONSTRAINT `ships_id_races_FK` FOREIGN KEY (`id_races`) REFERENCES `gc5dx_races` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
