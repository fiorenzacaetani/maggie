# Progetto Maggie: AI-Powered Pantry & Shopping Manager
## Specifiche Architetturali del Database

### 1. Decisioni Chiave d'Architettura
- Astrazione delle Ricette: Basata su categorie merceologiche per flessibilità.
- Normalizzazione Unità (SI): Conversione interna in grammi/ml per calcoli uniformi.
- Protezione Mapping: Colonna 'match_type' (AUTO/MANUAL) per evitare sovrascritture AI su correzioni umane.
- Predizione Consumi: Basata su log transazionali (inventory_logs) anziché sola giacenza attuale.

### 2. Schema SQL Definitivo

-- A. Fondamenta (Unità e Categorie)
CREATE TABLE units (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50), 
    symbol VARCHAR(10) UNIQUE
);

CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    parent_id INT NULL, 
    name VARCHAR(100),
    FOREIGN KEY (parent_id) REFERENCES categories(id)
);

-- B. Anagrafica Prodotti e Alias
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    ean VARCHAR(13) UNIQUE,
    brand VARCHAR(100),
    name VARCHAR(255),
    base_unit_id INT,
    content_value FLOAT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (base_unit_id) REFERENCES units(id)
);

CREATE TABLE product_aliases (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT,
    alias_name VARCHAR(255) INDEX,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- C. Dispensa e Logica di Consumo
CREATE TABLE pantry (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT,
    current_quantity_base FLOAT DEFAULT 0,
    min_threshold_base FLOAT DEFAULT 0,
    avg_consumption_daily FLOAT DEFAULT 0,
    last_restock_date DATETIME,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE inventory_logs (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT,
    change_amount_base FLOAT,
    source ENUM('voice', 'receipt', 'manual', 'prediction', 'recipe_cooked'),
    ai_interaction_id BIGINT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- D. Retailer e Automazione
CREATE TABLE supermarket_mappings (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT,
    retailer_name VARCHAR(50),
    external_sku VARCHAR(255),
    external_name VARCHAR(255),
    external_unit VARCHAR(50),
    external_price DECIMAL(10,2),
    match_type ENUM('AUTO', 'MANUAL') DEFAULT 'AUTO',
    last_seen_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX (external_sku)
);

-- E. Sistema Ricette
CREATE TABLE recipes (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    servings INT DEFAULT 4,
    instructions TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE recipe_ingredients (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    recipe_id BIGINT,
    category_id INT,
    quantity_required_base FLOAT,
    unit_id INT,
    is_optional BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (unit_id) REFERENCES units(id)
);

-- F. Audit e Debug AI
CREATE TABLE ai_interactions_logs (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    input_type ENUM('text', 'voice', 'image'),
    raw_content TEXT,
    ai_response_json JSON,
    confidence_score FLOAT,
    tokens_used INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);