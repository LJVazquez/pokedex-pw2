<?php
class BaseDatos
{
    private $host;
    private $port;
    private $user;
    private $password;
    private $dbname;

    private $database;

    function __construct()
    {
        $dbData = parse_ini_file('../db.ini');
        $this->host = $dbData['HOST'];
        $this->port = $dbData['PORT'];
        $this->user = $dbData['USER'];
        $this->password = $dbData['PASSWORD'];
        $this->dbname = $dbData['DBNAME'];

        $this->database = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port)
            or die('Error en conexion a db' . mysqli_connect_error());
    }

    function __destruct()
    {
        $this->database->close();
    }

    function connect(){

        try {
            $this->database = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname);
        } catch (PDOException $e) {
            die('Connection Failed: ' . $e->getMessage());
        }

    }

    public function selectAll($query)
    {
        $res = $this->database->query($query);
        $data = $res->fetch_all(MYSQLI_ASSOC);

        $res->close();
        return $data;
    }

    public function selectPreparedStatement($query, $types, $values)
    {
        $statement = $this->database->prepare($query);
        $statement->bind_param($types, ...$values);
        $statement->execute();

        $res = $statement->get_result();
        $data =  $res->fetch_all(MYSQLI_ASSOC);

        $res->close();
        return $data;
    }

    public function insertPreparedStatement($query, $types, $values)
    {
        $statement = $this->database->prepare($query);
        $statement->bind_param($types, ...$values);
        $statement->execute();

        if ($statement) {
            $statement->close();

            $insertedDataId = $this->database->insert_id;
            return $insertedDataId;
        }
    }

    public function updateAndDeletePreparedStatement($query, $types, $values)
    {
        $statement = $this->database->prepare($query);
        $statement->bind_param($types, ...$values);
        $statement->execute();

        if ($statement) {
            $statement->close();
            return $statement;
        }
    }
}

class PokeBd
{
    private $database;

    private $fetchAllPokemonQuery =
    'SELECT p.id, p.numero, p.nombre, p.descripcion, p.ruta_imagen, t1.nombre AS tipo_1, t2.nombre AS tipo_2
    FROM pokemon p
    LEFT JOIN tipo t1 ON p.tipo1Id = t1.id
    LEFT JOIN tipo t2 ON p.tipo2Id = t2.id;';

    private $fetchPokemonByIdQuery =
    'SELECT p.id, p.numero, p.nombre, p.descripcion, p.ruta_imagen, t1.nombre AS tipo_1, t2.nombre AS tipo_2
    FROM pokemon p
    LEFT JOIN tipo t1 ON p.tipo1Id = t1.id
    LEFT JOIN tipo t2 ON p.tipo2Id = t2.id
    WHERE p.id = ?;';

    private $searchPokemonQuery =
    "SELECT p.id, p.numero, p.nombre, p.descripcion, p.ruta_imagen, t1.nombre AS tipo_1, t2.nombre AS tipo_2
    FROM pokemon p
    LEFT JOIN tipo t1 ON p.tipo1Id = t1.id
    LEFT JOIN tipo t2 ON p.tipo2Id = t2.id
    WHERE p.nombre LIKE ? OR t1.nombre LIKE ? OR t2.nombre LIKE ?;";

    private $fetchTypesQuery =
    'SELECT * FROM tipo;';

    private $createPokemonQuery =
    'INSERT INTO pokemon (numero, nombre, descripcion, ruta_imagen, tipo1Id, tipo2Id) 
	VALUES (?, ?, ?, ?, ?, ?);';

    private $updatePokemonQuery =
    'UPDATE pokemon
    SET numero = ?, nombre = ?, descripcion = ?, ruta_imagen  = ?, tipo1Id = ?, tipo2Id = ?
    WHERE id = ?;';

    private $deletePokemonQuery =
    'DELETE FROM pokemon
    WHERE id = ?;';



    function __construct()
    {
        $this->database = new BaseDatos();
    }

    public function fetchAllPokemons()
    {
        return $this->database->selectAll($this->fetchAllPokemonQuery);
    }

    public function fetchPokemonById($id)
    {
        $statementTypes = 'i';
        $statementValues = [$id];
        $data = $this->database->selectPreparedStatement(
            $this->fetchPokemonByIdQuery,
            $statementTypes,
            $statementValues
        );

        if ($data) {
            return $data[0];
        }
    }

    public function searchPokemons($searchParam)
    {
        $searchParamWildcarded = "%$searchParam%";

        $statementTypes = 'sss';
        $statementValues = [$searchParamWildcarded, $searchParamWildcarded, $searchParamWildcarded];
        $data = $this->database->selectPreparedStatement(
            $this->searchPokemonQuery,
            $statementTypes,
            $statementValues
        );

        if ($data) {
            return $data;
        }
    }

    public function createPokemon($number, $name, $desc, $imageRoute, $type1, $type2)
    {
        $statementTypes = 'isssii'; //numero, nombre, desc, imagen, tipo, tipo
        $statementValues = [$number, $name, $desc, $imageRoute, $type1, $type2,];
        $pokeId = $this->database->insertPreparedStatement(
            $this->createPokemonQuery,
            $statementTypes,
            $statementValues
        );

        if ($pokeId) {
            return $this->fetchPokemonById($pokeId);
        }

        return null;
    }

    public function updatePokemon($id, $number, $name, $desc, $imageRoute, $type1, $type2)
    {

        $statementTypes = 'isssiii'; //numero, nombre, desc, imagen, tipo, tipo, id
        $statementValues = [$number, $name, $desc, $imageRoute, $type1, $type2, $id];
        $isEditSuccessfull = $this->database->updateAndDeletePreparedStatement(
            $this->updatePokemonQuery,
            $statementTypes,
            $statementValues
        );

        return $isEditSuccessfull;
    }

    public function deletePokemon($id)
    {

        $statementTypes = 'i';
        $statementValues = [$id];
        $isDeleteSuccessfull = $this->database->updateAndDeletePreparedStatement(
            $this->deletePokemonQuery,
            $statementTypes,
            $statementValues
        );

        return $isDeleteSuccessfull;
    }

    public function fetchTypes()
    {
        return $this->database->selectAll($this->fetchTypesQuery);
    }

}
