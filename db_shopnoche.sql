/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : db_shopnoche

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 23/02/2022 17:31:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_clientes
-- ----------------------------
DROP TABLE IF EXISTS `tb_clientes`;
CREATE TABLE `tb_clientes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cedula` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fechaNacimiento` date NULL DEFAULT NULL,
  `idEstado` int NOT NULL DEFAULT 1,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `passwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_clientes
-- ----------------------------
INSERT INTO `tb_clientes` VALUES (1, 'LUIS', 'ASIFUELA', '1715730071', 'luis.asifuela@gmailcom', '1982-01-29', 1, 'lasifuela', '12345678');

-- ----------------------------
-- Table structure for tb_detalle
-- ----------------------------
DROP TABLE IF EXISTS `tb_detalle`;
CREATE TABLE `tb_detalle`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `cantidad` int NOT NULL,
  `importe` double NOT NULL,
  `precio` double NOT NULL,
  `idProducto` int NOT NULL,
  `idFactura` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idProducto`(`idProducto`) USING BTREE,
  INDEX `idFactura`(`idFactura`) USING BTREE,
  CONSTRAINT `tb_detalle_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `tb_productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tb_detalle_ibfk_2` FOREIGN KEY (`idFactura`) REFERENCES `tb_facturas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_detalle
-- ----------------------------
INSERT INTO `tb_detalle` VALUES (1, 1, 7.8, 7.8, 3, 3);
INSERT INTO `tb_detalle` VALUES (2, 2, 15.6, 7.8, 3, 4);
INSERT INTO `tb_detalle` VALUES (3, 2, 15.6, 7.8, 3, 5);
INSERT INTO `tb_detalle` VALUES (4, 1, 7.9, 7.9, 1, 5);
INSERT INTO `tb_detalle` VALUES (5, 2, 49, 24.5, 2, 5);
INSERT INTO `tb_detalle` VALUES (6, 2, 49, 24.5, 2, 6);
INSERT INTO `tb_detalle` VALUES (7, 1, 97.87, 97.87, 4, 6);
INSERT INTO `tb_detalle` VALUES (8, 1, 7.9, 7.9, 1, 6);
INSERT INTO `tb_detalle` VALUES (9, 1, 7.8, 7.8, 3, 7);
INSERT INTO `tb_detalle` VALUES (10, 1, 24.5, 24.5, 2, 7);
INSERT INTO `tb_detalle` VALUES (11, 1, 7.9, 7.9, 1, 7);
INSERT INTO `tb_detalle` VALUES (12, 2, 49, 24.5, 2, 8);
INSERT INTO `tb_detalle` VALUES (13, 1, 97.87, 97.87, 4, 8);
INSERT INTO `tb_detalle` VALUES (14, 1, 7.9, 7.9, 1, 9);
INSERT INTO `tb_detalle` VALUES (15, 1, 7.8, 7.8, 3, 9);

-- ----------------------------
-- Table structure for tb_facturas
-- ----------------------------
DROP TABLE IF EXISTS `tb_facturas`;
CREATE TABLE `tb_facturas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `fechaCreacion` datetime(1) NULL DEFAULT NULL,
  `subtotal` double NOT NULL,
  `valorIva` double NOT NULL,
  `total` double NULL DEFAULT NULL,
  `idCliente` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idCliente`(`idCliente`) USING BTREE,
  CONSTRAINT `tb_facturas_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `tb_clientes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_facturas
-- ----------------------------
INSERT INTO `tb_facturas` VALUES (1, '2022-02-16 00:00:00.0', 49, 5.88, 54.88, 1);
INSERT INTO `tb_facturas` VALUES (2, '2022-02-16 00:00:00.0', 7.9, 0.948, 8.848, 1);
INSERT INTO `tb_facturas` VALUES (3, '2022-02-16 00:00:00.0', 7.8, 0.94, 8.74, 1);
INSERT INTO `tb_facturas` VALUES (4, '2022-02-16 00:00:00.0', 15.6, 1.87, 17.47, 1);
INSERT INTO `tb_facturas` VALUES (5, '2022-02-16 00:00:00.0', 127.2, 15.26, 142.46, 1);
INSERT INTO `tb_facturas` VALUES (6, '2022-02-16 00:00:00.0', 399.64, 47.96, 447.6, 1);
INSERT INTO `tb_facturas` VALUES (7, '2022-02-16 00:00:00.0', 88.1, 10.57, 98.67, 1);
INSERT INTO `tb_facturas` VALUES (8, '2022-02-16 00:00:00.0', 195.87, 23.5, 219.37, 1);
INSERT INTO `tb_facturas` VALUES (9, '2022-02-16 00:00:00.0', 23.6, 2.83, 26.43, 1);

-- ----------------------------
-- Table structure for tb_productos
-- ----------------------------
DROP TABLE IF EXISTS `tb_productos`;
CREATE TABLE `tb_productos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marca` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detalle` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `precio` double NOT NULL,
  `stock` int NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idEstado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_productos
-- ----------------------------
INSERT INTO `tb_productos` VALUES (1, 'MOUSE', 'CLICK', 'MOUSE INALAMBRICO CLICK', 7.9, 90, 'mouse.png', 0);
INSERT INTO `tb_productos` VALUES (2, 'MOCHILA', 'NOVA', 'MOCHILA AZUL', 24.5, 6, 'mochila.jpg', 1);
INSERT INTO `tb_productos` VALUES (3, 'TECLADO', 'LOGISTIC', 'TECLADO USB', 7.8, 4, 'teclado.jpg', 1);
INSERT INTO `tb_productos` VALUES (4, 'TABLET A6', 'SANSUMG', 'TABLET SANSUMG A6 CONEXION WIFI - 5G', 97.87, 10, '2022-02-04_23h03_10.png', 1);
INSERT INTO `tb_productos` VALUES (5, 'TABLET A6', 'huawei', 'Nuevo producto', 101.56, 15, 'icons8_password_48px.png', 1);

-- ----------------------------
-- Table structure for tb_rol
-- ----------------------------
DROP TABLE IF EXISTS `tb_rol`;
CREATE TABLE `tb_rol`  (
  `idRol` int NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idRol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_rol
-- ----------------------------
INSERT INTO `tb_rol` VALUES (1, 'CLIENTE');
INSERT INTO `tb_rol` VALUES (2, 'ADMINISTRADOR');

-- ----------------------------
-- Table structure for tb_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE `tb_usuarios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `passwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idEstado` int NULL DEFAULT 1,
  `idRol` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_usuarios
-- ----------------------------
INSERT INTO `tb_usuarios` VALUES (1, 'IVAN', 'ANCALLAY', 'ivan.ancallay@gmail.com', 'iancallay', '25d55ad283aa400af464c76d713c07ad', 1, 2);
INSERT INTO `tb_usuarios` VALUES (2, 'CHRISTIAN', 'ZAPATA', 'christian.zapata@gmail.com', 'christian.zapata', '25d55ad283aa400af464c76d713c07ad', 1, 2);

SET FOREIGN_KEY_CHECKS = 1;
