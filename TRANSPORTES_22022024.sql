-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         11.3.0-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para transportes
CREATE DATABASE IF NOT EXISTS `transportes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `transportes`;

-- Volcando estructura para procedimiento transportes.ActualizarNumeroVehiculoAsociados
DELIMITER //
CREATE PROCEDURE `ActualizarNumeroVehiculoAsociados`()
BEGIN
    DECLARE id_propio INT;
    DECLARE num_vehiculos INT;

    -- Cursor para recorrer los registros de la tabla 'propios'
    DECLARE cursor_propios CURSOR FOR SELECT id, vehiculos_asociados FROM propios;
    OPEN cursor_propios;

    -- Variables temporales
    SET id_propio = 0;

    -- Bucle para recorrer los registros
    propios_loop: LOOP
        FETCH cursor_propios INTO id_propio, num_vehiculos;

        -- Salir si no hay más registros
        IF id_propio = 0 THEN
            LEAVE propios_loop;
        END IF;

        -- Actualizar el campo 'numero_vehiculo_asociados' con la cantidad de elementos en 'vehiculos_asociados'
        UPDATE propios SET numero_vehiculo_asociados = JSON_LENGTH(num_vehiculos) WHERE id = id_propio;

    END LOOP;

    CLOSE cursor_propios;

END//
DELIMITER ;

-- Volcando estructura para tabla transportes.card
CREATE TABLE IF NOT EXISTS `card` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_piloto` varchar(191) NOT NULL,
  `direccion_piloto` varchar(191) NOT NULL,
  `correo_piloto` varchar(191) NOT NULL,
  `telefono_piloto` varchar(191) NOT NULL,
  `tipo_licencia` varchar(191) NOT NULL,
  `licencia` varchar(191) NOT NULL,
  `foto_piloto` varchar(191) NOT NULL,
  `dpi_piloto` varchar(191) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `antecedentes_penales` varchar(191) NOT NULL,
  `antecedentes_policiacos` varchar(191) NOT NULL,
  `renas` varchar(191) NOT NULL,
  `boleto_ornato` varchar(191) NOT NULL,
  `numero_vehiculo_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `card_numero_vehiculo_id_foreign` (`numero_vehiculo_id`),
  CONSTRAINT `card_numero_vehiculo_id_foreign` FOREIGN KEY (`numero_vehiculo_id`) REFERENCES `vehi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.card: ~2 rows (aproximadamente)
INSERT INTO `card` (`id`, `nombre_piloto`, `direccion_piloto`, `correo_piloto`, `telefono_piloto`, `tipo_licencia`, `licencia`, `foto_piloto`, `dpi_piloto`, `fecha_emision`, `fecha_vencimiento`, `antecedentes_penales`, `antecedentes_policiacos`, `renas`, `boleto_ornato`, `numero_vehiculo_id`, `created_at`, `updated_at`) VALUES
	(1, 'Gonzalo Emanuel', 'zona 6 xela 1', 'juan@gmail.com', '45474848', 'C', 'licencias/xs9tXYT75MIlfZ1UhGkHdSJP15IjPDAjBkFI1i0j.pdf', 'fotos_piloto/WgeBQHE1PUHatEPrbKafO6TTaEmbP9Vw4qG1Zkrh.pdf', 'dpi_pilotos/dv1IypbI6NmNWpa61pmquogMHoDLmxNDVsguzuk5.pdf', '2025-02-14', '2027-02-12', 'antecedentes_penales/JkMKCSwjQNqGSVdOryoNIVjLJ4vR5xtChMMWob1G.pdf', 'antecedentes_policiacos/RSezpg4eqaHCg6RDQmdQxDqODvb6uFxeJj5bVGDZ.pdf', 'renas/JTHYXC1ufO0TdCAEPd6aQsMIiKg5kW56QA3gKtUI.pdf', 'boleto_ornato/XYBCzLBNTU0xXvTiq0UUS1jQIgBXYf8urZZIvD37.pdf', 1, '2024-02-14 03:29:31', '2024-02-14 03:29:31'),
	(2, 'JuanC', 'zona 6 xela', 'gfrancod@gmail.com', '54547454', 'C', 'licencias/B8xJ5s1YCibHlbdVgiXn6mUyRwp5cs32zhVqzq7e.pdf', 'fotos_piloto/aaKavDbJeCp7IqOkJLO4PHIhQwNbU83gx6jzoP0P.jpg', 'dpi_pilotos/qo7BslgyvuwI6uqFhG5LIVGC8xlJKtmK9rVUU6dx.jpg', '2025-03-20', '2028-03-18', 'antecedentes_penales/Nk2BpkHui8fFDHgpSE8F6vyTpIgzZ7A84DGW2JPo.pdf', 'antecedentes_policiacos/agmfYPaTTTRpmTLnatHd5RyT1flvzcoC8IWoZgxi.pdf', 'renas/rOKsYasQjBSS38QRF3ZhS67304jCmE9g4yiiH1a1.pdf', 'boleto_ornato/m9pLkO19AgT8NvSmh8R0D1nU2fuFBgArtclqpYUC.pdf', 8, '2024-02-20 03:15:03', '2024-02-20 03:15:03'),
	(3, 'Cristiano Clonaldo Poz Tzikin', 'Zona 2 Colonia Portugal 1-2', 'crispoz@gmail.com', '177777777', 'C', 'licencias/fTX8dygcTfioZhshUbsdjJWajoT1c52rpZLvBaOn.pdf', 'fotos_piloto/9ldmH8gAwKMtBD4mtiJjyp1RVqD1iMsKs3czWFOC.jpg', 'dpi_pilotos/Xn3j1IFAWzypvRe0RjpZ14AHZ5GL2HdSINIaFLMb.png', '2024-02-22', '2025-02-22', 'antecedentes_penales/zVVeD3fM8flzDSMPJiIc4kRItzXrZPAq2mulxluK.pdf', 'antecedentes_policiacos/W6qSolBFTSgL2bydvTfkFpcpEwOAwl5hIi3WZ1na.pdf', 'renas/kwpXrKfswY19G26HdP7dESrI1x7aHGDRitepIJgZ.pdf', 'boleto_ornato/IXA4sZSxG5vJ6HBUwfDGbvbYMc4HmVUf3x73Tv88.pdf', 10, '2024-02-23 03:03:42', '2024-02-23 03:03:42');

-- Volcando estructura para tabla transportes.documentos
CREATE TABLE IF NOT EXISTS `documentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `antecedentes_policiacos` varchar(191) NOT NULL,
  `antecedentes_penales` varchar(191) NOT NULL,
  `renas` varchar(191) NOT NULL,
  `licentia_tipo` varchar(191) NOT NULL,
  `dpi` varchar(191) NOT NULL,
  `boleto_ornato` varchar(191) NOT NULL,
  `direccion_fiscal` varchar(191) NOT NULL,
  `correo_documento` varchar(191) NOT NULL,
  `telefono_documento` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.documentos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla transportes.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para procedimiento transportes.incrementarNumeroVehiculosAsociados
DELIMITER //
CREATE PROCEDURE `incrementarNumeroVehiculosAsociados`(
    IN p_nombre_propietario VARCHAR(255),
    IN p_vehiculo_asociado_id INT
)
BEGIN
    DECLARE v_numero_vehiculos INT;

    -- Obtener el número actual de vehículos asociados
    SELECT numero_vehiculos_asociados INTO v_numero_vehiculos
    FROM propios
    WHERE nombre_propietario = p_nombre_propietario;

    -- Incrementar el número de vehículos asociados
    UPDATE propios
    SET numero_vehiculos_asociados = v_numero_vehiculos + 1
    WHERE nombre_propietario = p_nombre_propietario;

    -- Asignar el vehículo asociado
    UPDATE propios
    SET vehiculos_asociados = JSON_ARRAY_APPEND(
        COALESCE(vehiculos_asociados, '[]'),
        '$',
        p_vehiculo_asociado_id
    )
    WHERE nombre_propietario = p_nombre_propietario;
END//
DELIMITER ;

-- Volcando estructura para tabla transportes.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.migrations: ~11 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_10_16_165727_create_propietarios_table', 1),
	(6, '2023_10_17_225229_create_documentos_table', 1),
	(7, '2023_11_02_214319_create_rutas_table', 1),
	(8, '2024_02_02_225732_create_vehi_table', 1),
	(9, '2024_02_05_220148_create_card_table', 1),
	(10, '2024_02_08_161019_create_propios_table', 1),
	(11, '2024_02_15_162003_create_propios_vehiculos_table', 2),
	(12, '2024_02_19_170151_cambiar_tipo_vehiculo_id_en_propios', 3);

-- Volcando estructura para tabla transportes.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.password_resets: ~0 rows (aproximadamente)

-- Volcando estructura para tabla transportes.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla transportes.propietarios
CREATE TABLE IF NOT EXISTS `propietarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) NOT NULL,
  `dpi` int(11) NOT NULL,
  `nit` varchar(191) NOT NULL,
  `nombre_transporte` varchar(191) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(191) NOT NULL,
  `direccion_fiscal` varchar(191) NOT NULL,
  `no_vehiculo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.propietarios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla transportes.propios
CREATE TABLE IF NOT EXISTS `propios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_propietario` varchar(191) NOT NULL,
  `dpi_propietario` varchar(191) NOT NULL,
  `nit_propietario` varchar(191) NOT NULL,
  `telefono_propietario` varchar(191) NOT NULL,
  `correo_propietario` varchar(191) NOT NULL,
  `direccion_fiscal` varchar(191) NOT NULL,
  `numero_vehiculos_asociados` int(11) NOT NULL DEFAULT 0,
  `vehiculos_asociados` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`vehiculos_asociados`)),
  `nombre_empresa` varchar(191) DEFAULT NULL,
  `nit_empresa` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehi_id` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `propios_vehi_id_foreign` (`vehi_id`(768))
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.propios: ~3 rows (aproximadamente)
INSERT INTO `propios` (`id`, `nombre_propietario`, `dpi_propietario`, `nit_propietario`, `telefono_propietario`, `correo_propietario`, `direccion_fiscal`, `numero_vehiculos_asociados`, `vehiculos_asociados`, `nombre_empresa`, `nit_empresa`, `created_at`, `updated_at`, `vehi_id`) VALUES
	(43, 'Juan c', 'dpi_propietario/3SGDYaBCXtBDYN2u0O3vhMof4QcvY4w3rgmMJfCR.pdf', '2546451', '5292909011', 'mail112123@gmail.com', 'zona 1 calle 5', 0, '["1","2","6"]', 'Municipalidad', '5255847', '2024-02-19 23:04:17', '2024-02-19 23:04:17', '["1","2","6"]'),
	(44, 'Gonzalo', 'dpi_propietario/GgY3JlhgqdrgS4hD8I5bbWueZAj6FOVwSkjj5Gfv.pdf', '529015', '529290901', 'mail123@gmail.com', 'zona 5 san mateo', 0, '["2","6"]', 'Municipalidad', '5255847', '2024-02-19 23:22:40', '2024-02-19 23:22:40', '["2","6"]'),
	(45, 'JuanCHOTUM', 'dpi_propietario/oPiR3ZXZ9azzgJCaX6s2leR2HFgEvrcIbzMa2Pni.pdf', '58451221', '41415500', 'mai1l@mail.com', 'zona 1', 0, '["1","2"]', 'Municipalidad', '5255847', '2024-02-19 23:48:29', '2024-02-19 23:48:29', '["1","2"]');

-- Volcando estructura para tabla transportes.propios_vehiculos
CREATE TABLE IF NOT EXISTS `propios_vehiculos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `propios_id` bigint(20) unsigned NOT NULL,
  `vehi_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `propios_vehiculos_propios_id_foreign` (`propios_id`),
  KEY `propios_vehiculos_vehi_id_foreign` (`vehi_id`),
  CONSTRAINT `propios_vehiculos_propios_id_foreign` FOREIGN KEY (`propios_id`) REFERENCES `propios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `propios_vehiculos_vehi_id_foreign` FOREIGN KEY (`vehi_id`) REFERENCES `vehi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.propios_vehiculos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla transportes.rutas
CREATE TABLE IF NOT EXISTS `rutas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_ruta` varchar(191) NOT NULL,
  `numero_ruta` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.rutas: ~1 rows (aproximadamente)
INSERT INTO `rutas` (`id`, `nombre_ruta`, `numero_ruta`, `created_at`, `updated_at`) VALUES
	(1, 'Xela', 1, '2024-02-13 22:05:42', '2024-02-13 22:05:42'),
	(2, 'XELA', 2, '2024-02-15 02:24:35', '2024-02-15 02:24:35'),
	(3, 'ZUNIL', 4, '2024-02-20 02:56:50', '2024-02-20 02:56:50');

-- Volcando estructura para tabla transportes.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin123@gmail.com', 'admin123@gmail.com', NULL, '$2y$10$FSPZ.HRuLeKTBdATKqQieO5VujKmPWGYkeNK70dzYodq5mJ96AzJ.', NULL, '2024-02-08 22:19:15', '2024-02-08 22:19:15'),
	(2, 'admin123@mail.com', 'admin123@mail.com', NULL, '$2y$10$eVcLsgmcs.e/XA1eEzhp9.C.OQ/.HbJ9vRnuBm69gsUrOB2.uhr22', NULL, '2024-02-13 22:05:07', '2024-02-13 22:05:07');

-- Volcando estructura para tabla transportes.vehi
CREATE TABLE IF NOT EXISTS `vehi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_vehi` varchar(191) NOT NULL,
  `placa_vehi` varchar(191) NOT NULL,
  `tarjeta_circulacion` varchar(191) NOT NULL,
  `titulo_propiedad` varchar(191) NOT NULL,
  `tipo_vehi` varchar(191) NOT NULL,
  `numero_ruta_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehi_numero_ruta_id_foreign` (`numero_ruta_id`),
  CONSTRAINT `vehi_numero_ruta_id_foreign` FOREIGN KEY (`numero_ruta_id`) REFERENCES `rutas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla transportes.vehi: ~6 rows (aproximadamente)
INSERT INTO `vehi` (`id`, `nombre_vehi`, `placa_vehi`, `tarjeta_circulacion`, `titulo_propiedad`, `tipo_vehi`, `numero_ruta_id`, `created_at`, `updated_at`) VALUES
	(1, 'CARRO POLICIA', 'P70951', 'tarjetas_circulacion/tni7AOSXWmHHBl0tQojZfVvR1vt8QLgHw7xOaAaP.pdf', 'titulos_propiedad/2c7SSmgJ6hqAKPkM0mpq4B0HpvBdJ3SG0GzSNgTc.pdf', 'CAMION', 1, '2024-02-13 22:06:21', '2024-02-13 22:06:21'),
	(2, 'camion1', '12AAAS', 'tarjetas_circulacion/0Y8RypAJ6qRALRUcYUAdr7rkbgtK7Xli8YZHULKK.pdf', 'titulos_propiedad/RM93IqYWVi2xHli1iB3msBXebLJFEeOtWY2v8zNZ.pdf', 'CAMION', 1, '2024-02-14 03:34:43', '2024-02-14 03:34:43'),
	(6, 'ambulancia', 'P8928A', 'tarjetas_circulacion/o46avz4OFJjV3xIk9uTNbMytbhkX1CLydSJNi3gD.pdf', 'titulos_propiedad/oKOUpmFxZFPLepzC0c9Kd31ehBAKhvRGmE3ce9Wz.pdf', 'SERVICIO', 1, '2024-02-14 22:52:04', '2024-02-14 22:52:04'),
	(8, 'PickUp Transito', 'P709512', 'tarjetas_circulacion/wJgvzi4xOhfZDAgogaRaHUQHQmRi9SgFufxpEwgg.pdf', 'titulos_propiedad/KWJ4LyhskfDiaRRPRfBbu9IkzRbT2Ry9bXHvWbG1.pdf', 'PERSONAL', 1, '2024-02-20 02:53:19', '2024-02-20 02:53:19'),
	(9, 'BONGO', 'P709512', 'tarjetas_circulacion/WQlei5foYvkZlthp0p3lE5OVg7mHzObq2X4m0Aa5.pdf', 'titulos_propiedad/CYSQjqDtGVZ5h0503wNdp4jECj50DpJBtNnXEeL7.pdf', 'CAMION', 2, '2024-02-20 02:55:17', '2024-02-20 02:55:17'),
	(10, 'ESCUELA Z1', 'M898001', 'tarjetas_circulacion/KeB0h7Cll2tGYeGdypEg8V5ozjdP4wD6yvejJ3ND.pdf', 'titulos_propiedad/KKsyqRT31ibXIbGuJmFay1XGUSFGt12wyqFO8PO5.pdf', 'BUS', 3, '2024-02-20 02:57:43', '2024-02-20 02:57:43');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
