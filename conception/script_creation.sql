-- ----------------------------------------------------------
-- Script MYSQL pour mcd 
-- ----------------------------------------------------------


-- ----------------------------
-- Table: gc5dx_series
-- ----------------------------
CREATE TABLE gc5dx_series (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  short_name VARCHAR(5) NOT NULL,
  start_year INT NOT NULL,
  end_year INT NOT NULL,
  description TEXT NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  CONSTRAINT series_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


-- ----------------------------
-- Table: gc5dx_planets
-- ----------------------------
CREATE TABLE gc5dx_planets (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  designation VARCHAR(15) NOT NULL,
  galaxy ENUM('UNKNOWN') NOT NULL,
  status ENUM('UNKNOWN') NOT NULL,
  description TEXT NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  CONSTRAINT planets_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


-- ----------------------------
-- Table: gc5dx_seasons
-- ----------------------------
CREATE TABLE gc5dx_seasons (
  id INT NOT NULL AUTO_INCREMENT,
  year INT NOT NULL,
  description TEXT NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  id_series INT NOT NULL,
  CONSTRAINT seasons_PK PRIMARY KEY (id),
  CONSTRAINT seasons_id_series_FK FOREIGN KEY (id_series) REFERENCES gc5dx_series (id)
)ENGINE=InnoDB;


-- ----------------------------
-- Table: gc5dx_episodes
-- ----------------------------
CREATE TABLE gc5dx_episodes (
  id INT NOT NULL AUTO_INCREMENT,
  number INT NOT NULL,
  title VARCHAR(50) NOT NULL,
  original_air_date DATE NOT NULL,
  synopsis TEXT NOT NULL,
  is_two_parts TINYINT(1) NOT NULL,
  part INT,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  id_seasons INT NOT NULL,
  CONSTRAINT episodes_PK PRIMARY KEY (id),
  CONSTRAINT episodes_id_seasons_FK FOREIGN KEY (id_seasons) REFERENCES gc5dx_seasons (id)
)ENGINE=InnoDB;

-- ----------------------------
-- Table: gc5dx_parted_episodes
-- ----------------------------
CREATE TABLE gc5dx_parted_episodes (
  id_part_one INT NOT NULL,
  id_part_two INT NOT NULL,
  CONSTRAINT parted_episodes_PK PRIMARY KEY (id_part_one, id_part_two),
  CONSTRAINT parted_episodes_part_one_FK FOREIGN KEY (id_part_one) REFERENCES gc5dx_episodes (id),
  CONSTRAINT parted_episodes_part_two_FK FOREIGN KEY (id_part_two) REFERENCES gc5dx_episodes (id)
)ENGINE=InnoDB;


-- ----------------------------
-- Table: gc5dx_races
-- ----------------------------
CREATE TABLE gc5dx_races (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(150) NOT NULL,
  alignement ENUM('UNKNOWN') NOT NULL,
  threat_level INT NOT NULL,
  is_extinct TINYINT(1) NOT NULL,
  description TEXT NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  id_origin_planets INT NOT NULL,
  id_episodes INT NOT NULL,
  CONSTRAINT races_PK PRIMARY KEY (id),
  CONSTRAINT races_id_planets_FK FOREIGN KEY (id_origin_planets) REFERENCES gc5dx_planets (id),
  CONSTRAINT races_id_episodes_FK FOREIGN KEY (id_episodes) REFERENCES gc5dx_episodes (id)
)ENGINE=InnoDB;


-- ----------------------------
-- Table: gc5dx_ships
-- ----------------------------
CREATE TABLE gc5dx_ships (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(150) NOT NULL,
  class VARCHAR(150) NOT NULL,
  crew_capacity INT NOT NULL,
  is_destroyed TINYINT(1) NOT NULL,
  description TEXT NOT NULL,
  id_races INT NOT NULL,
  CONSTRAINT ships_PK PRIMARY KEY (id),
  CONSTRAINT ships_id_races_FK FOREIGN KEY (id_races) REFERENCES gc5dx_races (id)
)ENGINE=InnoDB;