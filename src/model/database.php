<?PHP

ini_set('memory_limit', '1024M');

class Database
{

    private static $connection;

    private static function connect()
    {
        try {
            self::$connection = new PDO(DRIVER_BD . ':Server=' . SERVER . ';Database=' . DATABASE, USER, PASSWORD);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo 'Connection Error: ' . $error->getMessage();
        }
    }

    public static function select(string $query, array $parametros = [], $entidade = null)
    {

        //EXECUTA QUERY NO BANCO DE DADOS
        $stmt    = self::execute($query, $parametros);
        $dadosBd = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //SE RECEBER OBJETO COMO PARAMETRO, CONVERTE ENTRAPA PARA ARRAY DO OBJETO
        if ($entidade != null) {

            $arrayObj = [];

            foreach ($dadosBd as $dados) {
                $objeto = new $entidade();
                $keys = array_keys($dados);

                foreach ($keys as $key) {
                    $objeto->{$key} = $dados[$key];
                }
                $arrayObj[] = $objeto;
            }
            return $arrayObj;
        }
        return $dadosBd;
    }

    public static function executeInsertMultipleLines(string $query, array $parametros = [])
    {

        try {
            self::connect();
            $stmt = self::$connection->prepare($query);
            $stmt->execute($parametros);
        } catch (Exception $e) {
            echo 'ERRO BANCO: ';
            echo $e->getMessage();
            echo ('<br>');
            echo ('<br> QUERY:');
            echo $query;
            echo ('<br>');
            echo ('<br>');
        }
    }


    public static function execute(string $query, array $parametros = [], bool $ultimoId = false, string $mensagemErro = '')
    {

        try {
            self::connect();
            $stmt = self::$connection->prepare($query);
            self::setParametros($stmt, $parametros);
            $stmt->execute();
        } catch (Exception $e) {
            echo 'ERRO BANCO: ';
            echo $e->getMessage();
            echo ('<br>');
            echo ('<br> QUERY:');
            echo $query;
            echo ('<br>');
            echo ('<br>');
        }

        if ($ultimoId) {
            $stmt  = self::$connection->prepare('SELECT LAST_INSERT_ID() as id');
            $stmt->execute();
            $arrayRetorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (isset($arrayRetorno[0]) && isset($arrayRetorno[0]['id'])) {
                return $arrayRetorno[0]['id'];
            }
        }
        return $stmt;
    }

    private static function setParametros($statement, $parametros = array())
    {
        foreach ($parametros as $chave => $parametro) {
            self::setParametro($statement, $chave, $parametro);
        }
    }

    private static function setParametro($statement, $chave, $parametro)
    {
        $statement->bindparam($chave, $parametro);
    }
}
