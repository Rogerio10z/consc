-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS socars;
USE socars;

-- Tabela de Marcas
CREATE TABLE marca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_marca VARCHAR(50) NOT NULL
);
-- Tabela de Categorias
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(50) NOT NULL
);
-- Tabela de Modelos
CREATE TABLE modelo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_modelo VARCHAR(50) NOT NULL,
    ano INT,
    cor VARCHAR(30),
    preco DECIMAL(10,2),
    motor VARCHAR(50),
    descricao TEXT,
    imagem VARCHAR(255),
    id_marca INT,
    id_categoria INT,
    FOREIGN KEY (id_marca) REFERENCES marca(id),
    FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);
CREATE TABLE usuario (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    email VARCHAR (100),
    senha VARCHAR(255) NOT NULL,
    acesso ENUM('cliente', 'admin', 'admin_principal') NOT NULL
);

CREATE INDEX idx_modelo_marca ON modelo(id_marca);
CREATE INDEX idx_modelo_categoria ON modelo(id_categoria);
CREATE INDEX idx_modelo_preco ON modelo(preco);
CREATE INDEX idx_modelo_nome ON modelo(nome_modelo);
CREATE INDEX idx_usuario_acesso ON usuario(acesso);

-- Tabela: marca
INSERT INTO marca (nome_marca) VALUES
('Volkswagen'),
('Honda'),
('Chevrolet'),
('Fiat'),
('Hyundai');

-- Tabela: categoria
INSERT INTO categoria (nome_categoria) VALUES
('Sedan'),
('Hatch'),
('SUV');

INSERT INTO modelo (nome_modelo, ano, cor, preco, motor, descricao, imagem, id_marca, id_categoria) VALUES
('Voyage', 2023, 'Branco', 82000.00, '1.6 Flex', 'O Voyage 2023 oferece economia, confiabilidade e bom espaço interno, ideal para uso urbano e viagens.', 'uploads/voyage.png', 1, 1),
('Virtus', 2024, 'Prata', 98000.00, '1.0 TSI', 'O Virtus 2024 combina bom desempenho com conforto, sendo um dos sedãs compactos mais equilibrados do mercado.', 'uploads/virtus.png', 1, 1),
('Gol', 2022, 'Preto', 73000.00, '1.0 Flex', 'O Gol 2022 é um hatch tradicional no Brasil, confiável e econômico para o dia a dia.', 'uploads/gol.png', 1, 2),
('Polo', 2025, 'Vermelho', 120000.00, '1.0 TSI', 'O Polo 2025 traz visual renovado, motor turbo eficiente e bom pacote tecnológico.', 'uploads/polo.png', 1, 2),
('T-Cross', 2023, 'Cinza', 137000.00, '1.0 TSI', 'O T-Cross 2023 é um SUV versátil, com motor turbo eficiente e ótimo espaço interno.', 'uploads/tcross.png', 1, 3),
('Nivus', 2024, 'Azul', 125000.00, '1.0 TSI', 'Com visual moderno, o Nivus 2024 entrega bom desempenho e tecnologia para o uso diário.', 'uploads/nivus.png', 1, 3),

-- Honda

('City', 2024, 'Cinza', 109000.00, '1.5 Flex', 'O Honda City 2024 oferece sofisticação e economia em um sedã compacto.', 'uploads/city.png', 2, 1),
('Civic', 2022, 'Branco', 152000.00, '2.0 Flex', 'O Civic 2022 é referência em conforto e confiabilidade entre os sedãs médios.', 'uploads/civic.png', 2, 1),
('Fit', 2022, 'Prata', 95000.00, '1.5 Flex', 'O Honda Fit 2022 é prático, espaçoso e ideal para quem busca economia com qualidade.', 'uploads/fit.png', 2, 2),
('City Hatch', 2024, 'Vermelho', 112000.00, '1.5 Flex', 'O City Hatch 2024 entrega bom espaço interno e ótima dirigibilidade em um design moderno.', 'uploads/cityhatch.png', 2, 2),
('HR-V', 2023, 'Prata', 145000.00, '1.5 Flex', 'O HR-V 2023 é um SUV confortável e prático, com espaço interno e eficiência no consumo.', 'uploads/hrv.png', 2, 3),
('WR-V', 2022, 'Preto', 99000.00, '1.5 Flex', 'Compacto e robusto, o WR-V 2022 é ideal para a cidade e pequenas aventuras.', 'uploads/wrv.png', 2, 3),

-- Chevrolet

('Onix Plus', 2024, 'Branco', 97000.00, '1.0 Turbo', 'O Onix Plus 2024 é um sedã compacto com ótimo consumo e conectividade.', 'uploads/onixplus.png', 3, 1),
('Cobalt', 2020, 'Preto', 92000.00, '1.8 Flex', 'Espaçoso e confortável, o Cobalt 2020 é uma boa escolha para famílias.', 'uploads/cobalt.png', 3, 1),
('Onix', 2025, 'Preto', 98000.00, '1.0 Turbo', 'O Onix 2025 é referência em tecnologia e economia entre os hatches.', 'uploads/onix.png', 3, 2),
('Spin', 2023, 'Prata', 96000.00, '1.8 Flex', 'Ideal para famílias, o Spin 2023 oferece espaço e praticidade no dia a dia.', 'uploads/spin.png', 3, 2),
('Tracker', 2025, 'Vermelho', 135000.00, '1.0 Turbo', 'O Tracker 2025 é um SUV compacto eficiente, com bom desempenho e espaço.', 'uploads/tracker.png', 3, 3),

-- Fiat

('Cronos', 2023, 'Prata', 89000.00, '1.3 Flex', 'O Fiat Cronos 2023 oferece espaço, economia e bom acabamento em um sedã acessível.', 'uploads/cronos.png', 4, 1),
('Grand Siena', 2022, 'Branco', 75000.00, '1.0 Flex', 'Confiável e econômico, o Grand Siena 2022 é ideal para quem busca um sedã básico.', 'uploads/gsiena.png', 4, 1),
('Argo', 2024, 'Azul', 88000.00, '1.3 Flex', 'O Argo 2024 se destaca pelo visual moderno, bom desempenho e economia.', 'uploads/argo.png', 4, 2),
('Mobi', 2023, 'Vermelho', 69000.00, '1.0 Flex', 'Compacto e prático, o Mobi 2023 é ideal para o trânsito urbano.', 'uploads/mobi.png', 4, 2),
('Pulse', 2024, 'Cinza', 118000.00, '1.0 Turbo', 'Com design arrojado, o Pulse 2024 oferece boa performance e espaço interno.', 'uploads/pulse.png', 4, 3),
('Fastback', 2025, 'Preto', 132000.00, '1.3 Turbo', 'SUV coupé da Fiat, o Fastback 2025 entrega estilo e desempenho em um conjunto moderno.', 'uploads/fastback.png', 4, 3),

-- Hyundai
('HB20', 2022, 'Vermelho', 89000.00, '1.0 Turbo', 'O HB20 2025 é um hatch compacto moderno, com ótima eficiência e tecnologia.', 'uploads/hb20.png', 5, 2),
('Creta', 2024, 'Prata', 138000.00, '1.0 Turbo', 'O Creta 2024 é um SUV urbano com design atualizado, motor eficiente e conforto de sobra.', 'uploads/creta.png', 5, 3),
('HB20S', 2023, 'Prata', 95000.00, '1.0 Turbo', 'O HB20S 2023 oferece o equilíbrio entre economia e espaço, ideal para famílias.', 'uploads/hb20s.png', 5, 1),
('Tucson', 2023, 'Azul', 158000.00, '1.6 Turbo', 'O Tucson 2023 se destaca pelo conforto, robustez e ótimo desempenho nas estradas.', 'uploads/tucson.png', 5, 3),
('i30', 2022, 'Preto', 78000.00, '1.6 Flex', 'O i30 é um hatch médio com visual esportivo e excelente dirigibilidade.', 'uploads/i30.png', 5, 2);
 
INSERT INTO usuario (nome, email, senha, acesso) VALUES 
('Gabriel', 'gabrielwilliam234@gmail.com', '$2y$10$MrNepXhBt0iUNz1rxYCUlOQvxz1V3pvB74I30uQ08rBZJQ33Pnpha', 'admin_principal');
-- senha é 123
