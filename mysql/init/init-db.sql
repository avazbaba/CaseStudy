CREATE TABLE IF NOT EXISTS User
(
    id
    INT
    AUTO_INCREMENT
    PRIMARY
    KEY,
    username
    VARCHAR
(
    255
) NOT NULL,
    password VARCHAR
(
    255
) NOT NULL,
    address VARCHAR
(
    255
) NULL,
    phone_number VARCHAR
(
    15
) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT username UNIQUE
(
    username
)
    );
