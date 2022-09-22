CREATE TABLE
  IF NOT EXISTS tipo (
    id INT auto_increment PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL
  );

CREATE TABLE
  IF NOT EXISTS pokemon (
    id INT auto_increment PRIMARY KEY NOT NULL,
    numero INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    ruta_imagen VARCHAR(255) NOT NULL,
    tipo1Id INT,
    tipo2Id INT,
    FOREIGN KEY (tipo1Id) REFERENCES tipo (id),
    FOREIGN KEY (tipo2Id) REFERENCES tipo (id)
  );

-- valores iniciales
INSERT INTO
  tipo (nombre)
VALUES
  ('BUG'),
  ('FIRE'),
  ('GRASS'),
  ('NUCLEAR'),
  ('PLASMA'),
  ('POISON'),
  ('ROCK'),
  ('VOID'),
  ('WATER');

-- seeder pokemons
INSERT INTO
  pokemon (
    numero,
    nombre,
    descripcion,
    ruta_imagen,
    tipo1Id,
    tipo2Id
  )
VALUES
  (
    004,
    'Charmander',
    'Bulbasaur se encuentra en la 1ª etapa de su línea evolutiva. Bulbasaur evoluciona a Ivysaur subiendo al nivel 16. Ivysaur evoluciona a Venusaur subiendo al nivel 32.',
    'charma.png',
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'FIRE'
      LIMIT
        1
    ),
    null
  ),
  (
    001,
    'Bulbasaur',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At incidunt voluptatem suscipit tempore distinctio fugit.',
    'bulba.png',
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'GRASS'
      LIMIT
        1
    ),
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'POISON'
      LIMIT
        1
    )
  ),
  (
    006,
    'Charizard',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At incidunt voluptatem suscipit tempore distinctio fugit.',
    'chari.png',
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'FIRE'
      LIMIT
        1
    ),
    null
  ),
  (
    007,
    'Squirtle',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At incidunt voluptatem suscipit tempore distinctio fugit.',
    'squi.png',
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'WATER'
      LIMIT
        1
    ),
    null
  ),
  (
    011,
    'Metapod',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At incidunt voluptatem suscipit tempore distinctio fugit.',
    'meta.png',
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'BUG'
      LIMIT
        1
    ),
    null
  ),
  (
    014,
    'Kakuna',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At incidunt voluptatem suscipit tempore distinctio fugit.',
    'kaku.png',
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'BUG'
      LIMIT
        1
    ),
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'POISON'
      LIMIT
        1
    )
  ),
  (
    015,
    'Beedril',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At incidunt voluptatem suscipit tempore distinctio fugit.',
    'bee.png',
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'BUG'
      LIMIT
        1
    ),
    (
      SELECT
        id
      FROM
        tipo
      WHERE
        nombre = 'POISON'
      LIMIT
        1
    )
  );

CREATE TABLE IF NOT EXISTS usuarios (
                                        id INT auto_increment PRIMARY KEY NOT NULL,
                                        usuario VARCHAR(100) NOT NULL,
    clave VARCHAR(100) NOT NULL);

INSERT INTO usuarios(usuario,clave) VALUES
                                        ("admin","admin"),
                                        ("Gustavo","Gustavo"),
                                        ("usuario1","1234"),
                                        ("root","root1234");